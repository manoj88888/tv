@extends('layouts.admin')
@section('title','Progressive Web App Setting | ')
@section('content')
	<div class="box admin-form-main-block">
		<div class="box-header with-border">
			<div class="box-title">
				{{__('adminstaticwords.ProgressiveWebAppSetting')}}
			</div>		
		</div>

		<div class="box-body">
			<div class="nav-tabs-custom">

				  <!-- Nav tabs -->
				  <ul id="myTabs" class="nav nav-tabs" role="tablist">
				    
				    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">{{__('adminstaticwords.AppSetting')}}</a></li>
				    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">{{__('adminstaticwords.UpdateIcons')}}</a></li>
				    
				  </ul>

				  <!-- Tab panes -->
				  <div class="tab-content">
				    <div role="tabpanel" class="tab-pane active" id="home">

				    	<div class="callout callout-success">
				    		<i class="fa fa-info-circle"></i>
				    		 {{__('adminstaticwords.ProgessiveWebAppRequirements')}}
				    		 <ul>
				    		 	<li><b>{{__('adminstaticwords.Https')}}</b> {{__('adminstaticwords.HttpsNote')}}</li>
				    		 	<li><b>{{__('adminstaticwords.StartURL')}}</b> {{__('adminstaticwords.StartURLNote')}}</li>
				    		 	<li><b>{{__('adminstaticwords.AllIconsSize')}}</b> {{__('adminstaticwords.AllIconsSizeNote')}}</li>
				    		 </ul>
				    	</div>

				    	<div class="callout callout-info">
				    		<p><i class="fa fa-info-circle"></i>
				    		 {{__('adminstaticwords.SettingsNote')}} (,){{__('adminstaticwords.SettingsNoteRemaining')}}</p>
				    		 <p>{{__('adminstaticwords.ReadMoreAbout')}} <a target="_blank" href="https://developers.google.com/web/progressive-web-apps" title="Click to open">{{__('adminstaticwords.ProgressiveWebApp')}}</a> {{__('adminstaticwords.Here')}}...</p>
				    	</div>

				    	<div class="callout callout-danger">
				    		<p><i class="fa fa-info-circle"></i> {{__('adminstaticwords.ImportantNotes')}}
				    		<ul>
				    			<li>{{__('adminstaticwords.ImportantNotesOne')}} <u>{{__('adminstaticwords.start_url')}}</u> {{__('adminstaticwords.ShouldBe ')}}<b>https://yourdomain.com/public/?launcher=true</b> </li>
				    			<li>{{__('adminstaticwords.ImportantNotesTwo')}}  <u>{{__('adminstaticwords.start_url')}}</u> {{__('adminstaticwords.ShouldBe ')}} <b>/?launcher=true</b> </li>
				    			<li>{{__('adminstaticwords.ImportantNotesThree')}} <u>{{__('adminstaticwords.Subdomain')}}</u> {{__('adminstaticwords.ImportantNotesThree
				    			Remaining')}}  <u>{{__('adminstaticwords.start_url')}}</u> {{__('adminstaticwords.ShouldBe ')}}:
									<ol type="i">
										<li><b>https://test.yourdomain.com/public/?launcher=true</b></li>
									</ol>
								{{__('adminstaticwords.UrlContentsNotPublic')}}  <u>{{__('adminstaticwords.start_url')}}</u> {{__('adminstaticwords.ShouldBe ')}}:
									<ol type="i">
										<li><b>https://test.yourdomain.com/?launcher=true</b></li>
									</ol>
				    			</li>
				    		</ul>
				    	</div>

				    	<form action="{{ route('pwa.setting.update') }}" method="POST">
				    		@csrf
				    		<div class="form-group">
				    			<button type="submit" class="pull-right btn btn-danger btn-md">
					    		<i class="fa fa-save"></i> {{__('adminstaticwords.SaveChanges')}}
					    	</button>
				    		</div>
				    		<br><br>
				    		<div class="form-group">
				    			<label>{{__('adminstaticwords.ManifestSetting')}}:</label>
				    			<textarea name="app_setting" class="form-control" id="" cols="30" rows="20">{{ $setting }}</textarea>
				    		</div>
				    		<div class="form-group">
				    			<label>{{__('adminstaticwords.ServiceWorkerSetting')}}:</label>
				    			<textarea name="sw_setting" class="form-control" id="" cols="30" rows="20">{{ $sw }}</textarea>
				    		</div>
					    	<button type="submit" class="btn btn-danger btn-md">
					    		<i class="fa fa-save"></i> {{__('adminstaticwords.SaveChanges')}}
					    	</button>
				    	</form>
				    </div>
				    <div role="tabpanel" class="tab-pane" id="profile">
				    
				    	<form action="{{ route('pwa.icons.update') }}" method="POST" enctype="multipart/form-data">
				    		@csrf
					    	<button type="submit" class="pull-right btn btn-danger btn-md">
					    			<i class="fa fa-save"></i>{{__('adminstaticwords.UpdateIcons')}}
					    	</button>
					    	<br><br>
				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (36x36)</label>
						    				<input id="icon1" type="file" class="form-control" name="icon36">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview1" alt="preview" src="{{ url('/images/icons/icon36x36.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (48x48)</label>
						    				<input id="icon2" type="file" class="form-control" name="icon48">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview2" alt="preview" src="{{ url('/images/icons/icon48x48.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (72x72)</label>
						    				<input id="icon3" type="file" class="form-control" name="icon72">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview3" alt="preview" src="{{ url('/images/icons/icon72x72.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (96x96)</label>
						    				<input id="icon4" type="file" class="form-control" name="icon96">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview4" alt="preview" src="{{ url('/images/icons/icon96x96.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (144x144)</label>
						    				<input id="icon5" type="file" class="form-control" name="icon144">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview5" alt="preview" src="{{ url('/images/icons/icon144x144.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (168x168)</label>
						    				<input id="icon6" type="file" class="form-control" name="icon168">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview6" alt="preview" src="{{ url('/images/icons/icon168x168.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (192x192)</label>
						    				<input id="icon7" type="file" class="form-control" name="icon192">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview7" alt="preview" src="{{ url('/images/icons/icon192x192.png') }}">
				    				</div>
				    			</div>
				    		</div>

				    		<div class="well">
				    			<div class="row">
				    				<div class="col-md-6">
				    					<div class="form-group">
						    				<label>{{__('adminstaticwords.Icon')}} (256x256)</label>
						    				<input id="icon8" type="file" class="form-control" name="icon256">
						    			</div>
				    				</div>

				    				<div class="col-md-6">
				    					<img id="preview8" alt="preview" src="{{ url('/images/icons/icon256x256.png') }}">
				    				</div>
				    			</div>
				    		</div>
				    		<p></p>
							<div class="form-group">
								<button type="submit" class="pull-left btn btn-danger btn-md">
					    			<i class="fa fa-save"></i> {{__('adminstaticwords.UpdateIcons')}}
					    		</button>
					    		<br>
							</div>
				    	</form>
				    </div>
				  </div>

			</div>
		</div>
	</div>
@endsection
@section('custom-script')
  <script src="{{ url('js/pwasetting.js') }}"></script>
@endsection