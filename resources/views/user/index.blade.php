@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')
<!-- main wrapper -->
<section id="main-wrapper" class="main-wrapper home-page user-account-section">
    <div class="container-fluid">
    <h4 class="heading">{{__('staticwords.dashboard')}}</h4>
    <div class="panel-setting-main-block">
        
    <div class="panel-setting">
        <div class="row">
            <div class="col-md-6">
                <h4 class="panel-setting-heading">{{__('staticwords.yourdetails')}}</h4>
                <p>{{__('staticwords.updateyourprofiledetails')}}</p>
            </div>
            
            <div class="col-md-3">
                <p class="info">{{__('staticwords.youremail')}}: {{$auth->email}}</p>
            </div>
            {{--
            <div class="col-md-3">
                <div class="panel-setting-btn-block text-right">
                    <a href="{{url('account/profile')}}" class="btn btn-setting">{{__('staticwords.editdetail')}}</a>
                </div>
            </div>
            --}}
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="edit-profile-block">
                    {{-- 
                    <h4 class="panel-setting-heading">{{__('staticwords.changenameandgender')}}</h4>
                    <div class="info">{{__('staticwords.wanttochangeagenameandgender')}}</div>
                    --}}
                    {!! Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']) !!}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                {!! Form::label('name',__('staticwords.username')) !!}
                                <input type="text" required class="form-control"  name="name"  @if(isset(Auth::user()->name)) value="{{Auth::user()->name}}" @endif/>
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            </div>
                            <div class="form-group{{ $errors->has('change_gender') ? ' has-error' : '' }}">
                                {!! Form::label('gender', __('staticwords.changegender')) !!}
                                <select name="gender" required>
                                    @if(auth()->user()->gender == 'Male')
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    @else
                                    <option value="Male">Male</option>
                                    <option selected value="Female">Female</option>
                                    @endif
                                </select>
                                <small class="text-danger">{{ $errors->first('change_gender') }}</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="search form-group{{ $errors->has('dob') ? ' has-error' : '' }}">
                                {{-- \Carbon\Carbon::parse(Auth::user()->dob)->format('m/d/Y') --}}
                                {!! Form::label('dob',__('staticwords.dateofbirth')) !!}
                                <input type="date" required class="form-control"  name="dob"  @if(isset(Auth::user()->dob)) value="{{ \Carbon\Carbon::parse(Auth::user()->dob)->format('m/d/Y') }}" @endif/>
                                <small class="text-danger">{{ $errors->first('dob') }}</small>
                            </div>
                            <div class="search form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {!! Form::label('mobile', __('staticwords.mobileno')) !!}
                                <input type="number" class="form-control"  name="mobile" @if(isset(Auth::user()->mobile)) value="{{Auth::user()->mobile}}"@endif/>   
                                <small class="text-danger">{{ $errors->first('mobile') }}</small>
                            </div>
                            <div class="btn-group pull-right">
                                {!! Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']) !!}
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('staticwords.changemail')}}</h4> 
                        {{-- <div class="info">{{__('staticwords.currentemail')}}: {{auth()->user()->email}}</div> --}}
                        {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
                        <div class="form-group{{ $errors->has('new_email') ? ' has-error' : '' }}">
                            {!! Form::label('new_email',__('staticwords.newemail')) !!}
                            {!! Form::text('new_email', null, ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('new_email') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {!! Form::label('current_password', __('staticwords.currentpassword')) !!}
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                        </div>
                        <div class="btn-group pull-right">
                            {!! Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="edit-profile-block">
                        <h4 class="panel-setting-heading">{{__('staticwords.changepassword')}}</h4>
                        {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {!! Form::label('current_password', __('staticwords.currentpassword')) !!}
                            {!! Form::password('current_password', ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                        </div>
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            {!! Form::label('new_password', __('staticwords.newpassword')) !!}
                            {!! Form::password('new_password', ['class' => 'form-control']) !!}
                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                        </div>
                        <div class="btn-group pull-right">
                            {!! Form::submit(__('staticwords.update'), ['class' => 'btn btn-success']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        </div>
            <div class="panel-setting">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="panel-setting-heading">{{__('staticwords.yourmembership')}}</h4>
                        <p>{{__('staticwords.wanttochangemembership')}}</p>
                    </div>
                    <div class="col-md-3">
                        @php
                            $bfree = null;
                            $config=App\Config::first();
                            $auth=Auth::user();
                            if ($auth->is_admin==1) {
                                $bfree=1;
                            }else{
                                $ps=App\PaypalSubscription::where('user_id',$auth->id)->first();
                                    if (isset($ps)) {
                                   $current_date = Illuminate\Support\Carbon::now();
                                    if (date($current_date) <= date($ps->subscription_to)) {
                                      
                                      if ($ps->package_id==100 || $ps->package_id == 0) {
                                          $bfree=1;
                                      }else{
                                        $bfree=0;
                                      }
                                    }
                                }
                             }
                        @endphp
                        
                        @if($auth->is_admin==1)
                            <p class="info">{{__('staticwords.currentsubscriptionfree')}}</p>
                        @else
                            @if($bfree==1)
                                <p class="info">{{__('staticwords.currentsubscritptionfreetill')}}
                                    <strong>{{date('F j, Y  g:i:a',strtotime($ps->subscription_to))}} </strong>
                                </p>
                            @elseif($bfree==0)
                            @if(isset($ps))
                                @php
                                $psn=App\Package::where('id',$ps->package_id)->first();
                                @endphp
                                <p class="info">{{__('staticwords.currentsubscription')}}: {{ucfirst($psn['name'])}}</p>
                            @endif
                            @else
                            @if($current_subscription != null)
                                <p class="info">{{__('staticwords.currentsubscription')}}: {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</p>
                            @endif
                            @endif
                        @endif
                    </div>
                    <div class="col-md-3">
                        <div class="panel-setting-btn-block text-right">
                            @if($current_subscription != null && $method == 'stripe') 
                                @if($auth->subscription($current_subscription->name)->cancelled())
                                    <a href="{{route('resumeSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                                @else
                                    {{-- <a href="{{route('cancelSub', $current_subscription->stripe_plan)}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a> --}}
                                    <a href="{{ url('account/purchaseplan') }}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.upgradechangesubscription')}}</a>
                                @endif
                                @elseif($current_subscription != null && $method == 'paypal')
                                @if($current_subscription->status == 0)
                                    <a href="{{route('resumeSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.resumesubscription')}}</a>
                                @elseif ($current_subscription->status == 1)
                                    {{-- <a href="{{route('cancelSubPaypal')}}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.cancelsubscription')}}</a> --}}
                                    <a href="{{ url('account/purchaseplan') }}" class="btn btn-setting"><i class="fa fa-edit"></i>{{__('staticwords.upgradechangesubscription')}}</a>
                                @endif
                                @else 
                                @if($auth->is_admin == 1)
                                @else              
                                    <a href="{{url('account/purchaseplan')}}" class="btn btn-setting">{{__('staticwords.subscribenow')}}</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-setting">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="panel-setting-heading">{{__('staticwords.yourpaymenthistory')}}</h4>
                        <p>{{__('staticwords.viewyourpaymenthistory')}}.</p>
                    </div>
                    <div class="col-md-offset-3 col-md-3">
                        <div class="panel-setting-btn-block text-right">
                            <a href="{{url('account/billing_history')}}" class="btn btn-setting">{{__('staticwords.viewdetails')}}</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- 
            <div class="panel-setting">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="panel-setting-heading">Parent Controll</h4>
                        <p>Change your parent controll settings.</p>
                    </div>
                    <div class="col-md-offset-3 col-md-3">
                        <div class="panel-setting-btn-block text-right">
                            <a href="#" class="btn btn-setting"><i class="fa fa-edit"></i>Change Settings</a>
                        </div>
                    </div>
                </div>
            </div>
            --}}
        </div>
    </div>
</section>
<!-- end main wrapper -->
@endsection