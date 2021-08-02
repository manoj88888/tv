<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Svg\Tag\Rect;

class BackupController extends Controller
{
    public function get(){

        Artisan::call('backup:list');
        
        $html  =   '<pre>';
        $html .=    Artisan::output();
        $html .=   '</pre>';
        
        return view('admin.backup.index',compact('html'));

    }
    public function updatepath(Request $request){
        $env_update = $this->changeEnv(['BINARY_PATH' =>$request->BINARY_PATH]);
        return back()->with('added','Binary Path Successfully added !');
    }

    public function process(Request $request){

        if(env('DEMO_LOCK') == 1){
            notify()->error("This action is disabled in demo !");
            return back();
        }
       
        set_time_limit(0);

        if($request->type == 'all'){
            Artisan::call('backup:run');
        }

        if($request->type == 'onlyfiles'){

            Artisan::call('backup:run --only-files');

        }

        if($request->type == 'onlydb'){

            Artisan::call('backup:run --only-db');

        }

        // notify()->success('Backup completed !','Done');

        return back()->with('added','Backup completed !','Done');

    }

    public function download(Request $request, $filename){

        if(env('DEMO_LOCK') == 1){
            // notify()->error("This action is disabled in demo !");
            return back()->with('delete','This action is disabled in demo !');
        }

        if (! $request->hasValidSignature()) {
            // notify()->error('Download Link is invalid or expired !');
            return redirect(route('admin.backup.settings'))->with('delete','Download Link is invalid or expired !');
        }

        $filePath = storage_path().'/app/'.config('app.name').'/'.$filename;

        $fileContent = file_get_contents($filePath);

        $response = response($fileContent, 200, [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);

        return $response;

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
