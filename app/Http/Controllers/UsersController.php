<?php
namespace App\Http\Controllers;

use App\Config;
use App\Mail\WelcomeUser;
use App\Multiplescreen;
use App\Package;
use App\PaypalSubscription;
use App\User;
use Auth;
use Carbon\Carbon;
use DataTables;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mail;
use Response;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPosts()
    {

        $users = DB::table('users')->select('*');

        return DataTables::of($users)->make(true);
    }

    public function index(Request $request)
    {
        $auth_id = Auth::id();

        $users = \DB::table('users')->select('id', 'name', 'is_admin', 'email', 'created_at', 'updated_at', 'is_blocked')
            ->where('id', '!=', $auth_id)->get();

        if ($request->ajax()) {
            return \Datatables::of($users)->addIndexColumn()->addColumn('checkbox', function ($user) {
                $html = '<div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="' . $user->id . '" id="checkbox' . $user->id . '">
                    <label for="checkbox' . $user->id . '" class="material-checkbox"></label>
                  </div>';

                return $html;
            })->addColumn('created_at', function ($user) {
                return date('F d, Y',strtotime($user->created_at));

            })->addColumn('updated_at', function ($user) {

               return date('F d, Y',strtotime($user->updated_at));
            })->editColumn('status', function ($user) {
                if ($user->is_blocked == 0) {
                    return '<button class="btn btn-danger btn-sm status" data-id="' . $user->id . '">'.__('adminstaticwords.Block').'</button>';
                } else {
                    return '<button class="btn btn-success btn-sm status" data-id="' . $user->id . '">'.__('adminstaticwords.Unblock').'</button>';
                }

            })->addColumn('action', function ($user) {
                $btn = ' <div class="admin-table-action-block">
                    <a href="' . route('change_subscription_show', $user->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.ChangeSubscription').'" class="btn-default btn-floating"><i class="material-icons">compare_arrows</i></a>
                    <a href="' . route('users.edit', $user->id) . '" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.Edit').'" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>';

                if ($user->is_admin == 1) {
                    $btn .= '<a type="button" class="btn-danger btn-floating disabled" disabled="disabled" data-toggle="tooltip" data-original-title="'.__('adminstaticwords.YoucanNotDeleteAdmin').'"><i class="material-icons">delete</i> </a></div>';
                } else {
                    $btn .= '<button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#deleteModal' . $user->id . '"><i class="material-icons">delete</i> </button></div>';
                }

                $btn .= '<div id="deleteModal' . $user->id . '" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">'.__('adminstaticwords.AreYouSure').'</h4>
                      <p>'.__('adminstaticwords.DeleteWarrning').'</p>
                    </div>
                    <div class="modal-footer">
                      <form method="POST" action="' . route("users.destroy", $user->id) . '">
                        ' . method_field("DELETE") . '
                        ' . csrf_field() . '
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">'.__('adminstaticwords.No').'</button>
                          <button type="submit" class="btn btn-danger">'.__('adminstaticwords.Yes').'</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>';

                return $btn;
            })->rawColumns(['checkbox', 'created_at', 'updated_at', 'action', 'status'])
                ->make(true);
        }

        return view('admin.users.index', compact('users'));
    }

    // change is_blocked in datatable
    public function changestatus($id)
    {   
        $user = User::findOrFail($id);
        if ($user->is_blocked == 0) {
            $user->is_blocked = 1;
        } else {
            $user->is_blocked = 0;
        }
        $user->update();
        return Response::json($user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $request->validate(['name' => 'required', 'image' => 'nullable|image|mimes:jpeg,png,jpg', 'email' => 'required|email|unique:users', 'password' => 'required', 'confirm_password' => 'required|same:password']);

        $input = $request->except('confirm_password');

        $dateOfBirth = $request->dob;

        if (isset($request->dob)) {
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');
            $input['age'] = $age;

        }

        $input['password'] = bcrypt($request->password);

        if (!isset($input['is_admin'])) {
            $input['is_admin'] = 0;
        } else {
            $input['is_admin'] = 1;
        }

        if (!isset($input['is_assistant'])) {
            $input['is_assistant'] = 0;
        } else {
            $input['is_assistant'] = 1;
        }

        if ($file = $request->file('image')) {
            $name = 'user_' . $file->getClientOriginalName();
            $file->move('images/users', $name);
            $input['image'] = $name;
        }
        $input['status'] = '1';

        $user = User::create($input);

        $config = Config::first();

        if ($config->wel_eml == 1) {
            Mail::to($input['email'])->send(new WelcomeUser($user));
        }
        return back()->with('added', 'User has been created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_age(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        // $input = $request->all();
        
        $user->name = $request->name;
        $user->gender = $request->gender;
        // $dateOfBirth = $request->dob;
        
        // if (isset($request->dob)) {
        //     $user->dob = $request->dob;
        //     $today = date("m-d-y");
        //     $diff = date_diff(date_create($dateOfBirth), date_create($today));
        //     $age = $diff->format('%y');
        //     $user->age = $age;
        //     dd($user, $age, 111);
        // }
        // dd(222);
        
        // $user->dob = \Carbon\Carbon::parse($request->dob)->format('m-d-Y');
        $user->dob = $request->dob;
        $user->mobile = $request->mobile;
        $user->save();
        return back()->with('added', 'Your Details Has Been Updated');
    }
    
    public function update_name_gender(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->gender = $request->gender;
        $user->save();
        return back()->with('added', 'Your Details Has Been Updated');
    }

    public function update(Request $request, $id)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $user = User::findOrFail($id);

        $request->validate(['name' => 'required', 'image' => 'nullable|image|mimes:jpeg,png,jpg', 'email' => 'required|email', 'role' => 'nullable', 'confirm_password' => 'same:password']);

        $user->name = $request->name;
        $user->email = $request->email;
        // $user->is = $request->is_admin;
        $dateOfBirth = $request->dob;
        if (isset($dateOfBirth)) {
            $today = date("Y-m-d");
            $diff = date_diff(date_create($dateOfBirth), date_create($today));
            $age = $diff->format('%y');
            $user->age = $age;
            $user->dob = $request->dob;
        }

        if ($request->password == "") {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($request->password);
        }

        if (!isset($request->is_admin)) {
            $user->is_admin = 0;
        } else {
            $user->is_admin = 1;
        }

        if (!isset($request->is_assistant)) {
            $user->is_assistant = 0;
        } else {
            $user->is_assistant = 1;
        }

        if ($file = $request->file('image')) {
            $name = 'user_' . $file->getClientOriginalName();
            if ($user->image != '') {
                unlink(public_path() . '/images/users/' . $user->image);
            }
            $file->move('images/users', $name);
            $user->image = $name;
        }

        $user->save();
        return redirect('admin/users')
            ->with('updated', 'User has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $user = User::findOrFail($id);

        if ($user->image) {
            unlink(public_path() . 'images/users/' . $user->image);
        }
        if (isset($user->paypal_subscriptions)) {
            foreach ($user->paypal_subscriptions as $subscribe_user) {
                $subscribe_user->delete();
            }
        }

        $user->delete();
        return back()
            ->with('deleted', 'User has been deleted');
    }

    public function bulk_delete(Request $request)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $validator = Validator::make($request->all(), ['checked' => 'required']);

        if ($validator->fails()) {

            return back()
                ->with('deleted', 'Please select one of them to delete');
        }

        foreach ($request->checked as $checked) {

            $user = User::findOrFail($checked);

            if (isset($user->paypal_subscriptions)) {
                foreach ($user->paypal_subscriptions as $subscribe_user) {
                    $subscribe_user->delete();
                }
            }

            User::destroy($checked);
        }

        return back()->with('deleted', 'Users has been deleted');
    }

    public function change_subscription_show($id)
    {

        $user = User::findOrFail($id);

        $plans = Package::all();
        //$plan_list = Package::pluck('name', 'id')->all();

        $user_stripe_plan = null;
        $last_payment = null;
        if (isset($plans)) {
            if ($user->stripe_id != null) {
                foreach ($plans as $plan) {
                    if ($user->subscribed($plan->plan_id)) {
                        $user_stripe_plan = $plan;
                    }
                }
            }
            if (isset($user->paypal_subscriptions) && count($user->paypal_subscriptions) > 0) {
                //Check Paypal Subscription of user
                $last_payment = $user
                    ->paypal_subscriptions
                    ->last();
            }

        }

        return view('admin.users.change_sub', compact('user', 'user_stripe_plan', 'last_payment', 'plans'));
    }

    public function change_subscription(Request $request)
    {
        if(env('DEMO_LOCK') == 1){
            return back()->with('deleted','This action is disabled in the demo !');
        }
        $request->validate(['plan_id' => 'required', 'user_id' => 'required']);

        $user = User::findOrFail($request->user_id);
        $change_plan = Package::findOrFail($request->plan_id);
        $multiplescreen = Multiplescreen::where('user_id', $request->user_id)->first();

        if ($request->user_stripe_plan_id != null) {

            $user_stripe_plan = Package::findOrFail($request->user_stripe_plan_id);
            $user->subscription($user_stripe_plan->plan_id)->swap($change_plan->plan_id);
            return back()->with('added', 'User subscription has been changed!');

        } else if ($request->last_payment_id != null) {

            $last_payment = PaypalSubscription::findOrFail($request->last_payment_id);
            $current_date = Carbon::now();
            $end_date = null;

            if ($change_plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($change_plan->interval_count);
            } else if ($change_plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($change_plan->interval_count);
            } else if ($change_plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($change_plan->interval_count);
            } else if ($change_plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($change_plan->interval_count);
            }

            $last_payment->package_id = $change_plan->id;
            $last_payment->price = $change_plan->amount;
            $last_payment->status = 1;
            $last_payment->method = 'by Admin';
            $last_payment->subscription_from = $current_date;
            $last_payment->subscription_to = $end_date;
            $last_payment->save();

            if(isset($mlt_screen) && $mlt_screen ==1){
                if (isset($multiplescreen)) {

                    $multiplescreen->delete();
                    $muser = new Multiplescreen;

                    $muser->user_id = $user->id;

                    if ($change_plan->screens == 1) {
                        $muser->screen1 = $user->name;

                    } elseif ($change_plan->screens == 2) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen1";
                    } elseif ($change_plan->screens == 3) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                    } elseif ($change_plan->screens == 4) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                        $muser->screen4 = "Screen4";
                    }

                    $muser->pkg_id = $change_plan->id;
                    $muser->save();

                } else {

                    $muser = new Multiplescreen;

                    $muser->user_id = $user->id;
                    $muser->pkg_id = $change_plan->id;

                    if ($change_plan->screens == 1) {
                        $muser->screen1 = $user->name;

                    } elseif ($change_plan->screens == 2) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen1";
                    } elseif ($change_plan->screens == 3) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                    } elseif ($change_plan->screens == 4) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                        $muser->screen4 = "Screen4";
                    }

                    $muser->save();
                }
            }
            

            return back()->with('added', 'User subscription has been changed!');

        } else if ($request->user_stripe_plan_id != null && $request->last_payment_id != null) {

            $current_date = Carbon::now();
            $end_date = null;

            if ($change_plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($change_plan->interval_count);
            } else if ($change_plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($change_plan->interval_count);
            } else if ($change_plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($change_plan->interval_count);
            } else if ($change_plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($change_plan->interval_count);
            }

            if(isset($mlt_screen) && $mlt_screen == 1){
                $muser = new Multiplescreen;
                $exist = Multiplescreen::where('user_id', $user->id)->first();

                $getpkgid;
                $screen;
                if (!isset($exist)) {

                    foreach ($user->paypal_subscriptions as $value) {

                        if ($value->status == 1) {

                            $getpkgid = $value->package_id;

                            $pkg = Package::where('id', $value->package_id)->first();

                            if (isset($pkg)) {
                                $screen = $pkg->screens;
                                $muser->pkg_id = $pkg->id;

                                $muser->user_id = $user->id;

                                if ($screen == 1) {
                                    $muser->screen1 = $user->name;

                                } elseif ($screen == 2) {
                                    $muser->screen1 = $user->name;
                                    $muser->screen2 = "Screen2";
                                } elseif ($screen == 3) {
                                    $muser->screen1 = $user->name;
                                    $muser->screen2 = "Screen2";
                                    $muser->screen3 = "Screen3";
                                } elseif ($screen == 4) {
                                    $muser->screen1 = $user->name;
                                    $muser->screen2 = "Screen2";
                                    $muser->screen3 = "Screen3";
                                    $muser->screen4 = "Screen4";
                                }

                                $muser->save();

                            }
                        }
                    }

                } else {

                    $exist->delete();
                    $screen = $pkg->screens;
                    $muser->pkg_id = $pkg->id;

                    $muser->user_id = $user->id;

                    if ($screen == 1) {
                        $muser->screen1 = $user->name;

                    } elseif ($screen == 2) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                    } elseif ($screen == 3) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                    } elseif ($screen == 4) {
                        $muser->screen1 = $user->name;
                        $muser->screen2 = "Screen2";
                        $muser->screen3 = "Screen3";
                        $muser->screen4 = "Screen4";
                    }

                    $muser->save();
                }
            }
            

            $created_subscription = PaypalSubscription::create(['user_id' => $user->id, 'payment_id' => 'by admin', 'user_name' => $user->name, 'package_id' => $change_plan->id, 'price' => $change_plan->amount, 'status' => 1, 'method' => 'by Admin', 'subscription_from' => $current_date, 'subscription_to' => $end_date]);

            return back()->with('added', 'User subscription has been changed!');
        } else {

            if(isset($mlt_screen) && $mlt_screen == 1){
                $muser = new Multiplescreen;

                $muser->user_id = $user->id;
                $muser->pkg_id = $change_plan->id;

                if ($change_plan->screens == 1) {
                    $muser->screen1 = $user->name;

                } elseif ($change_plan->screens == 2) {
                    $muser->screen1 = $user->name;
                    $muser->screen2 = "Screen1";
                } elseif ($change_plan->screens == 3) {
                    $muser->screen1 = $user->name;
                    $muser->screen2 = "Screen2";
                    $muser->screen3 = "Screen3";
                } elseif ($change_plan->screens == 4) {
                    $muser->screen1 = $user->name;
                    $muser->screen2 = "Screen2";
                    $muser->screen3 = "Screen3";
                    $muser->screen4 = "Screen4";
                }

                $muser->save();
            }

            

            $current_date = Carbon::now();
            $end_date = null;

            if ($change_plan->interval == 'month') {
                $end_date = Carbon::now()->addMonths($change_plan->interval_count);
            } else if ($change_plan->interval == 'year') {
                $end_date = Carbon::now()->addYears($change_plan->interval_count);
            } else if ($change_plan->interval == 'week') {
                $end_date = Carbon::now()->addWeeks($change_plan->interval_count);
            } else if ($change_plan->interval == 'day') {
                $end_date = Carbon::now()->addDays($change_plan->interval_count);
            }
            $created_subscription = PaypalSubscription::create(['user_id' => $user->id, 'payment_id' => 'by admin', 'user_name' => $user->name, 'package_id' => $change_plan->id, 'price' => $change_plan->amount, 'status' => 1, 'method' => 'by Admin', 'subscription_from' => $current_date, 'subscription_to' => $end_date]);
            return back()->with('added', 'User subscription has been changed!');
        }
        return back()->with('error', 'Some issue to change this user subscription');

    }
    
    /**
     * VIP Subscription
     *
     * @return \Illuminate\Http\Response
     */
    public function vipSubscription($planId, $couponId)
    {
        $coupon = \App\CouponCode::where('id',$couponId)->first();
        $paypalSubscriptionsData = [
            'user_id' => auth()->user()->id,
            'payment_id' => 'vip subscription',
            'user_name' => auth()->user()->name,
            'package_id' => $planId,
            'price' => '0.00',
            'coupon' => $coupon->coupon_code,
            'status' => 1,
            'method' => 'vip',
            'subscription_from' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
            'subscription_to' => \Carbon\Carbon::now()->addDays($coupon->day_for_free)->format('Y-m-d H:i:s'),

        ];

        $multiplescreensData = [
            'screen1' => auth()->user()->name,
            'screen2' => 'screen2',
            'screen3' => 'screen3',
            'screen4' => 'screen4',
            'user_id' => auth()->user()->id,
            'activescreen' => auth()->user()->name,
            'screen_1_used' => 'Yes',
            'screen_2_used' => 'No',
            'screen_3_used' => 'No',
            'screen_4_used' => 'No',
            'pkg_id' => $planId,
        ];

        \App\PaypalSubscription::create($paypalSubscriptionsData);
        \App\Multiplescreen::create($multiplescreensData);

        return redirect('account')->with('added', 'Your VIP Subscription Activeted');
    }

}
