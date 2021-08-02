@extends('layouts.admin')
@section('title',__('adminstaticwords.SocialIconSetting'))
@section('content')
 <div class="admin-form-main-block mrg-t-40">
   
 <h4 class="admin-form-text"><a href="{{url('admin/')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.SocialIconSetting')}}</h4>
<div class="row">
		<div class="col-md-6">
			 <div class="admin-form-block z-depth-1">
			 	<form action="{{ route('socialic') }}" method="POST">
			 		{{ csrf_field() }}
				<label for=""><i class="fa fa-facebook"></i> {{__('adminstaticwords.FacebookURL')}}:</label>
				<input autofocus="" placeholder="http://facebook.com/mediacity" type="text" class="form-control" name="url1" value="{{ $si->url1 }}">
				<br>
				<label for=""><i class="fa fa-twitter"></i> {{__('adminstaticwords.TwitterURL')}}:</label>
				<input type="text" placeholder="http://twitter.com/mediacity" class="form-control" name="url2" value="{{ $si->url2 }}">
				<br>
				<label for=""><i class="fa fa-youtube"></i> {{__('adminstaticwords.YoutubeURL')}}:</label>
				<input type="text" placeholder="http://youtube.com/mediacity" class="form-control" name="url3" value="{{ $si->url3 }}">

				<br>
				<button type="submit" class="btn btn-md btn-primary">{{__('adminstaticwords.Save')}}</button>
				</form>


				</div>
			 	
			 	
			 </div>
		</div>
</div>
 @endsection