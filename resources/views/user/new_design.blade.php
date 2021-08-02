@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')

    <div style="padding:0;background-color:white;width:100%;" class="container">
        <!-- Content -->
        <h1 style="font-size:large;" class="title"><b>MANAGE YOUR ACCOUNT</b></h1>
        <ul class="menu" style="padding-left:28px;">
            <li><a href="{{ url('account') }}" class="menu-item-active">Overview</a></li>
            <li><a href="{{ url('/manageprofile/mus/'.Auth::user()->id)}} ">Profiles</a></li>
        </ul>
        <!-- Content -->
    </div>
    <div class="jumbotron flex-bx" style="background-color:white;">
        <div class="container background-white">
            <div class="page-header">
                <h5 style="color:black;">Your Subscription</h5>
            </div>
            <div class="sp-between-flex">
                <b>Current plan:</b>
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
               <b>{{__('staticwords.currentplanfree')}}</b>
              @else
                @if($bfree==1)

                  <b>{{__('staticwords.currentsubscritptionfreetill')}}
                    <strong>{{date('F j, Y  g:i:a',strtotime($ps->subscription_to))}} </strong></b>

                @elseif($bfree==0)
                
                 @if(isset($ps))
                    @php
                       $psn=App\Package::where('id',$ps->package_id)->first();
                    @endphp
                   <b>{{__('staticwords.currentplan')}}: {{ucfirst($psn['name'])}}</b>
                  @endif
               @else

                  @if($current_subscription != null)
                    <b>{{__('staticwords.currentplan')}}: {{$method == 'stripe' ? ucfirst($current_subscription->name) : ucfirst($current_subscription->plan->name)}}</b>
                  @endif
                @endif
              @endif
                <a href="{{ url('account/purchaseplan') }}" class="btn btn-link"> Change Plan </a>
            </div>
            @if(!empty($paypalSubscription))
            <div class="sp-between-flex">
                <b>Subscription Period : </b>
                <b>{{\Carbon\Carbon::parse($paypalSubscription->subscription_from)->format('m-d-Y')}} To {{\Carbon\Carbon::parse($paypalSubscription->subscription_to)->format('m-d-Y')}} </b><b></b><b></b>
            </div>
            @endif
            
        </div>
        <div class="container background-white">
            <div class="page-header">
                <h5 style="color:black;">Your Account</h5>
            </div>
            <div class="account-info">
                <div class="sp-between-flex">
                    <b>Personal Info</b>
                    <button type="button" class="btn btn-link" data-toggle="modal" data-target="#UpdateProfileModal"> Update Info </button>
                </div>
                <span> <b> Full Name : </b> {{ Auth::user()->name }} </span><br><br>
                <span> <b> Birth Date : </b> {{ date('m-d-Y', strtotime(Auth::user()->dob)) }} </span><br><br>
                <span> <b> Gender : </b> {{ Auth::user()->gender }} </span><br><br>
                <span> <b> Mobile No. : </b> {{Auth::user()->mobile }} </span>
            </div>
            <div class="account-info mt-1">
                <div class="sp-between-flex">
                    <span>Email</span>
                    <span>
                        <b>{{ Auth::user()->email }} </b>
                    </span>
                    <button
                        type="button"
                        class="btn btn-link"
                        data-toggle="modal"
                        data-target="#EmailChangeModal"
                        >
                    CHANGE EMAIL
                    </button>
                </div>
            </div>
            <div class="account-info mt-1">
                <div class="sp-between-flex">
                    <span>Password</span>
                    <button
                        type="button"
                        class="btn btn-link"
                        data-toggle="modal"
                        data-target="#PasswordChangeModal"
                        >
                    UPDATE PASSWORD
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Update profile-->
    <div class="modal fade" id="UpdateProfileModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Update Personal Information</b></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['method' => 'POST', 'action' => 'UsersController@update_age']) !!}
                        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            {!! Form::label('name',__('staticwords.username')) !!}
                            <input type="text" required class="form-control"  name="name"  @if(isset(Auth::user()->name)) value="{{Auth::user()->name}}" @endif/>
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        </div>
                        
                        <div class="form-group">
                        <label for="birthdate" class="text-gray">Date Of Birth</label>
                        <input type="date" required class="form-control" name="dob"/>
                    </div>
                        
                        <div class="form-group{{ $errors->has('change_gender') ? ' has-error' : '' }}">
                            {!! Form::label('gender', __('staticwords.changegender')) !!}
                            <select name="gender" class="form-control" id="sel1" required>
                                @if(auth()->user()->gender == 'Female')
                                    <option value="Male">Male</option>
                                    <option selected value="Female">Female</option>
                                @else
                                    <option selected value="Male">Male</option>
                                    <option value="Female">Female</option>
                                @endif
                            </select>
                            <small class="text-danger">{{ $errors->first('change_gender') }}</small>
                        </div>
                        
                        <div class="search form-group{{ $errors->has('mobile') ? ' has-error' : '' }}">
                            {!! Form::label('mobile', __('staticwords.mobileno')) !!}
                            <input type="number" class="form-control"  name="mobile" @if(isset(Auth::user()->mobile)) value="{{ Auth::user()->mobile }}" @endif/>
                            <small class="text-danger">{{ $errors->first('mobile') }}</small>
                        </div>
                        
                        <div class="modal-footer"> 
                            {!! Form::submit(__('staticwords.update'), ['class' => 'btn btn-primary full-btn background-gray']) !!}
                            {{-- <button type="button" class="btn btn-primary full-btn background-gray" style="background-color: #050076;" data-dismiss="modal"> Update </button><br /> --}}
                            <button type="button" class="btn full-btn btn-default mt-1" data-dismiss="modal"> Cancel </button>
                        </div>
                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Change Email -->
    <div class="modal fade" id="EmailChangeModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>UPDATE EMAIL</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('new_email') ? ' has-error' : '' }}">
                        {!! Form::label('new_email',__('staticwords.newemail')) !!}
                        <input type="email" required class="form-control" name="new_email" id="newMail" required />
                        <small class="text-danger">{{ $errors->first('new_email') }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="sendMyOTP" onclick="sendOTP({{ Auth::user()->id }})" class="btn btn-primary full-btn background-gray" style="background-color: #050076;" data-dismiss="modal" data-toggle="modal" data-target="#UpdateEmailModal">
                    Send OTP </button><br/>
                    <button type="button" class="btn full-btn btn-default mt-1" data-dismiss="modal"> Cancel </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Change Password -->
    <div class="modal fade" id="PasswordChangeModal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                {!! Form::open(['method' => 'POST', 'action' => 'UserAccountController@update_profile']) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        &times;
                        </button>
                        <h4 class="modal-title"><b>Update Password</b></h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                            {!! Form::label('current_password', __('staticwords.currentpassword')) !!}
                            {!! Form::password('current_password', ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('current_password') }}</small>
                        </div>
                        
                        <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            {!! Form::label('new_password', __('staticwords.newpassword')) !!}
                            {!! Form::password('new_password', ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('new_password') }}</small>
                        </div>
                        
                        <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            {!! Form::label('confirm_password', __('staticwords.confirmpassword')) !!}
                            {!! Form::password('confirm_password', ['class' => 'form-control', 'required' => 'required']) !!}
                            <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {!! Form::submit(__('staticwords.update'), ['class' => 'btn btn-primary full-btn background-gray']) !!}
                        {{-- <button type="submit" class="btn btn-primary full-btn background-gray" style="background-color: #050076;" data-dismiss="modal"> Update </button><br /> --}}
                        <button type="button" class="btn full-btn btn-default mt-1" data-dismiss="modal"> Cancel </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    <!-- Modal Emal change-->
    <div class="modal fade" id="UpdateEmailModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">
              &times;
            </button>
            <h4 class="modal-title"><b>Email Verification</b></h4>
          </div>
          <div class="modal-body">
              <div class="alert alert-info">
                A verification code has been send to your email address {{ Auth::user()->email }}. Please Enter the code below to continue.
              </div>
              <div>
                <label for="verification-code-container" class="text-gray">
                  VERIFICATION CODE
                </label>
                <div class="verification-code-container">
                  <input type="text" style="margin-right: 4px" class="form-control" id="verificationCode" maxlength="5" />
                </div>
                <span
                  >Didn't recieve an email? Take a quick peak through your junk
                  and span folders Or
                  <button class="btn btn-link no-padding" onclick="sendOTP({{ Auth::user()->id }})">
                    Send Again
                  </button> </span> <br />
                <div class="gap-2"></div>
                <span>Still having an issue with verification?</span><br />
                <h5>Email us at support@alphatv@global</h5>
              </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn full-btn background-gray" style="background-color: #050076;" data-dismiss="modal" onclick="updateMyEmail()">
              Update My Email
            </button>
          </div>
        </div>
      </div>
    </div>
@endsection

@section('custom-script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    // function validateEmail(email) {
    //     var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    //     console.log(re.test(email));
    //     return re.test(email);
    // }
    
    function sendOTP(user_id){
        // if (validateEmail(email)) {
        	$.ajax({
        		type : 'POST',
        		data : {user_id : user_id},
        		url : '{{ url('sendmyotp/'.Auth::user()->id) }}',
        		success : function(data){
        			console.log(data);
        			toastr.success('Project created Successfully');
        		}
        	});
        // }
        // else {
        //     alert(11);
        // }
    }
    
    function updateMyEmail(){
        var newEmail = $("#newMail").val();
        var verificationCode = $("#verificationCode").val()
        $.ajax({
    		type : 'POST',
    		data : {newEmail : newEmail, verificationCode : verificationCode},
    		url : '{{ url('update-my-email/'.Auth::user()->id) }}',
    		success : function(){
    		  //  location.reload();
    		}
    	});
    }
</script>

@endsection