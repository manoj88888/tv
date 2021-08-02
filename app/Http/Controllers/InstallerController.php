<?php
namespace App\Http\Controllers;

use App\Allcountry;
use App\Country;
use App\CurrencyList;
use App\CurrencyNew;
use App\Config;
use App\multiCurrency;
use App\seo;
use App\Store;
use App\User;
use Artisan;
use Carbon\Carbon;
use Crypt;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan as FacadesArtisan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Image;
use Session;



class InstallerController extends Controller
{

    public function verifylicense()
    {
        $getstatus = @file_get_contents('../public/step2.txt');
        $getstatus = Crypt::decrypt($getstatus);

        if ($getstatus == 'complete') {
            return view('install.verifylicense');
        } else {
            return redirect()->route('servercheck');
        }
    }

   

    public function verify()
    {

        if (env('IS_INSTALLED') == 0) {

            $getstatus = @file_get_contents('../public/step2.txt');
            $getstatus = Crypt::decrypt($getstatus);

            if ($getstatus == 'complete') {
                return view('install.verify');
            } else {
                return redirect()->route('servercheck');
            }

        } else {
            return redirect('/');
        }

    }

    public function eula()
    {

        if (env('IS_INSTALLED') == 0) {
            $getdraft = @file_get_contents('../public/draft.txt');
            if ($getdraft) {
                $getdraft = Crypt::decrypt($getdraft);

                if ($getdraft == 'gotoserverpage') {
                    return redirect()->route('servercheck');
                }

                if ($getdraft == 'gotoverifypage') {
                    return redirect()->route('verifyApp');
                }

                if ($getdraft == 'gotostep1') {
                    return redirect()->route('installApp');
                }

                if ($getdraft == 'gotostep2') {
                    return redirect()->route('db.setup');
                }

               
            }

            return view('install.eula');
        } else {
            return redirect('/');
        }

    }

    public function storeserver()
    {

        if (env('IS_INSTALLED') == 0) {
            $status = 'complete';
            $status = Crypt::encrypt($status);
            @file_put_contents('../public/step2.txt', $status);

            $draft = 'gotoverifypage';
            $draft = Crypt::encrypt($draft);
            @file_put_contents('../public/draft.txt', $draft);

            return redirect()->route('verifyApp');
        } else {
            return redirect('/');
        }

    }

    public function serverCheck(Request $request)
    {

        if (env('IS_INSTALLED') == 0) {
            $getstatus = @file_get_contents('../public/step1.txt');
            $getstatus = Crypt::decrypt($getstatus);
            if ($getstatus == 'complete') {
                return view('install.servercheck');
            } else {
                return redirect()->route('eulaterm');
            }
        } else {
            return redirect('/');
        }
    }

    public function storeeula(Request $request)
    {

        if (isset($request->eula)) {

            $status = 'complete';
            $status = Crypt::encrypt($status);
            @file_put_contents('../public/step1.txt', $status);

            $draft = 'gotoserverpage';
            $draft = Crypt::encrypt($draft);
            @file_put_contents('../public/draft.txt', $draft);

            return redirect()->route('servercheck');

        } else {
            notify()->error('Please Accept Terms and conditions first !');
            return back();
        }

    }

    public function getBasicSetup()
    {

        if (env('IS_INSTALLED') == 0) {
            $getstatus = @file_get_contents('../public/step4.txt');
            $getstatus = Crypt::decrypt($getstatus);
            if ($getstatus == 'complete') {
                ini_set('memory_limit', '-1');

                try
                {
                    \DB::connection()
                        ->getPdo();

                    if (env('IS_INSTALLED') == 0) {

                        if (!\Schema::hasTable('configs')) {
                            
                            
                            Artisan::call('migrate');
                           
                            Artisan::call('migrate', [
                                '--path' => 'vendor/laravel/cashier/database/migrations',
                                '--force' => true,
                            ]);

                            Artisan::call('migrate', [
                                '--path' => 'vendor/laravel/passport/database/migrations',
                                '--force' => true,
                            ]);

                            Artisan::call('migrate --path=database/migrations/update_v3_1');

                            Artisan::call('migrate --path=database/migrations/update_v3_2');
                            
                            Artisan::call('db:seed');

                        }

                        $getstatus = @file_get_contents('../public/step4.txt');
                        $getstatus = Crypt::decrypt($getstatus);

                        if ($getstatus == 'complete') {

                            return view('install.index');
                        }

                    } else {
                        return redirect('/');
                    }

                } catch (\Exception $e) {

                    $this->changeEnv(['DB_HOST' => env('DB_HOST'), 'DB_PORT' => env("DB_PORT"), 'DB_DATABASE' => '', 'DB_USERNAME' => '', 'DB_PASSWORD' => '','SESSION_DRIVER' => 'file']);

                    notify()->error($e->getMessage());
                    return redirect()->route('db.setup');

                }

                return view('install.index');
            }
        } else {
            return redirect('/');
        }
    }

    public function storeBasicSetup(Request $request)
    {

        $request->validate([
            'APP_NAME' =>'required',
            'APP_URL' => 'required',
        ]);


        $env_update = $this->changeEnv(['APP_NAME' => preg_replace('/\s+/', '', $request->APP_NAME), 'APP_URL' => $request->APP_URL,'SESSION_DRIVER' => 'database']);


        $newGenral = Config::first();
        $newGenral->title = preg_replace('/\s+/', '', $request->APP_NAME);
        $newGenral->save();

         $apistatus = $this->update_status('1');

        if ($apistatus == 1) {

            $this->changeEnv(['IS_INSTALLED' => '1']);
            \Artisan::call('cache:clear');
            \Artisan::call('view:clear');

        } else {

            \Artisan::call('cache:clear');
            \Artisan::call('view:clear');
            notify()->error('Oops Please try again !');
            return redirect()->route('installApp')->withInput();

        }

        Session::flush();

        $remove_step_files = array('step1.txt', 'step2.txt', 'step3.txt', 'step4.txt','draft.txt');

        foreach ($remove_step_files as $key => $file) {
            
            unlink(public_path(). '/' . $file);

        }

        \Artisan::call('cache:clear');
        \Artisan::call('view:clear');

        session()->flash('success','Installation successfull !');
        return redirect('/');

        

    }

    public function getDatabaseSetup()
    {

        if (env('IS_INSTALLED') == 0) {
            $getstatus = @file_get_contents('../public/step3.txt');
            $getstatus = Crypt::decrypt($getstatus);

            if ($getstatus == 'complete') {
                return view('install.dbsetup');
            } else {
                return redirect()
                    ->route('installApp');
            }
        } else {
            return redirect('/');
        }

    }

    public function step2(Request $request)
    {
        $request->validate([
            'DB_HOST' => 'required',
            'DB_PORT' => 'required',
            'DB_DATABASE' => 'required',
            'DB_USERNAME' => 'required'
        ],
        [
            'DB_HOST.required' => 'Please enter a datbase host name.',
            'DB_PORT.required' => 'Please enter a datbase port.',
            'DB_DATABASE.required' => 'Please enter a database name.',
            'DB_USERNAME.required' => 'Please enter a datbase username.'

        ]);

        $env_update = $this->changeEnv(['DB_HOST' => $request->DB_HOST, 'DB_PORT' => $request->DB_PORT, 'DB_DATABASE' => $request->DB_DATABASE, 'DB_USERNAME' => $request->DB_USERNAME, 'DB_PASSWORD' => $request->DB_PASSWORD]);

        try {

            \DB::connection()
                ->getPdo();

            if ($env_update) {
                $status = 'complete';
                $status = Crypt::encrypt($status);
                @file_put_contents('../public/step4.txt', $status);

                $draft = 'gotostep3';
                $draft = Crypt::encrypt($draft);
                @file_put_contents('../public/draft.txt', $draft);

                return redirect()->route('installApp');
            }

        } catch (\Exception $e) {

            notify()->error($e->getMessage());
            return redirect()->route('db.setup')->withInput($request->except('DB_PASSWORD'));

        }

    }

   

    public function storeStep4(Request $request)
    {

        $useralready = User::first();

        if (isset($useralready)) {

            User::query()->truncate();

        }

        $request->validate(['name' => 'required|string|max:255', 'email' => 'required|string|email|max:255|unique:users', 'password' => 'required|string|min:8|confirmed', 'password_confirmation' => 'required', 'logo' => 'mimes:jpg,jpeg,png,bmp', ]);

        $dir = 'images/user';
        $leave_files = array('index.php');

        foreach (glob("$dir/*") as $file) {
            if (!in_array(basename($file), $leave_files)) {
                unlink($file);
            }
        }

        $user = new User;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = 'a';
        $user->password = Hash::make($request->password);
        $user->country_id = $request->country;
        $user->state_id = $request->state_id;
        $user->city_id = $request->city_id;

        if ($file = $request->file('profile_photo')) {

            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/user/';
            $image = time() . $file->getClientOriginalName();
            $optimizeImage->resize(200, 200, function ($constraint) {
                $constraint->aspectRatio();
            });
            $optimizeImage->save($optimizePath . $image);

            $user->image = $image;

        }

        $user->save();

        $status = 'complete';
        $status = Crypt::encrypt($status);
        @file_put_contents('../public/step7.txt', $status);

        $draft = 'gotostep5';
        $draft = Crypt::encrypt($draft);
        @file_put_contents('../public/draft.txt', $draft);

        return redirect()->route('get.step5');

    }

    public function getstep5()
    {

        if (env('IS_INSTALLED') == 0) {
            $getstatus = @file_get_contents('../public/step6.txt');
            $getstatus = Crypt::decrypt($getstatus);

            if ($getstatus == 'complete') {
                return view('install.step5');
            }
        } else {
            return redirect('/');
        }

    }

    
  

 

    public function update_status($status)
    {
    
        $token = (file_exists(public_path() . '/intialize.txt') && file_get_contents(public_path() . '/intialize.txt') != null) ? file_get_contents(public_path() . '/intialize.txt') : '0';

       $d = \Request::getHost();
       $domain = str_replace("www.", "", $d);   

        $ch = curl_init();

        $options = array(
            CURLOPT_URL => "https://mediacity.co.in/purchase/public/api/updatestatus",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 20,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_POSTFIELDS => "status=$status&domain=$domain",
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                "Authorization: Bearer " . $token
            ) ,
        );

        curl_setopt_array($ch, $options);
        
        $response = curl_exec($ch);
        if (curl_errno($ch) > 0)
        {
            $message = "Error connecting to API.";
            return 2;
        }
        
        $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($responseCode == 200)
        {
            $body = json_decode($response);
            return $body->status;
        }
        else
        {
            return 2;
        }
    
    }

    protected function changeEnv($data = array())
    {
        {
            if (count($data) > 0) {

                // Read .env-file
                $env = file_get_contents(base_path() . '/.env');

                // Split string on every " " and write into array
                $env = preg_split('/\s+/', $env);

                // Loop through given data
                foreach ((array) $data as $key => $value) {
                    // Loop through .env-data
                    foreach ($env as $env_key => $env_value) {
                        // Turn the value into an array and stop after the first split
                        // So it's not possible to split e.g. the App-Key by accident
                        $entry = explode("=", $env_value, 2);

                        // Check, if new key fits the actual .env-key
                        if ($entry[0] == $key) {
                            // If yes, overwrite it with the new one
                            $env[$env_key] = $key . "=" . $value;
                        } else {
                            // If not, keep the old one
                            $env[$env_key] = $env_value;
                        }
                    }
                }

                // Turn the array back to an String
                $env = implode("\n\n", $env);

                // And overwrite the .env with the new data
                file_put_contents(base_path() . '/.env', $env);

                return true;

            } else {

                return false;
            }
        }
    }

}
