@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateAudio'))
<style type="text/css">
  body{
    background-color: #efefef;
  }
  .container-4 input#hyv-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
  .container-4 input#vimeo-search {
    width: 500px;
    height: 30px;
    border: 1px solid #c6c6c6;
    font-size: 10pt;
    float: left;
    padding-left: 15px;
    -webkit-border-top-left-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-top-left-radius: 5px;
    -moz-border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
  }
  .container-4 button.icon {
    height: 30px;
    background: #f0f0f0 url('images/searchicon.png') 10px 1px no-repeat;
    background-size: 24px;
    -webkit-border-top-right-radius: 5px;
    -webkit-border-bottom-right-radius: 5px;
    -moz-border-radius-topright: 5px;
    -moz-border-radius-bottomright: 5px;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
    border: 1px solid #c6c6c6;
    width: 50px;
    margin-left: -44px;
    color: #4f5b66;
    font-size: 10pt;
  }

</style>
@section('content')
<div class="admin-form-main-block">
  <h4 class="admin-form-text"><a href="{{url('admin/audio')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateAudio')}}</h4>
  <div class="row">
     <div class="col-md-6">
     <div class="admin-form-block z-depth-1">

        {!! Form::open(['method' => 'POST', 'action' => 'AudioController@store', 'files' => true]) !!}
        

        <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          {!! Form::label('title', __('adminstaticwords.AudioTitle')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterAudioTitle')}} Eg:Avatar"></i>
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('adminstaticwords.EnterAudioTitle')]) !!}
          <small class="text-danger">{{ $errors->first('title') }}</small>
        </div>
       
        {{-- select to upload code start from here --}}
        <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
          {!! Form::label('selecturls', __('adminstaticwords.AddAudio')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddAudio')}}"></i>
          {!! Form::select('selecturl', array('audiourl' => __('adminstaticwords.AudioURL'),
           'upload_audio' => __('adminstaticwords.UploadAudio')), null, ['class' => 'form-control select2','id'=>'selecturl']) !!}
           <small class="text-danger">{{ $errors->first('selecturl') }}</small>
         </div>


         <div id="ifbox" style="display: none;" class="form-group">
          <label for="audiourl">{{__('adminstaticwords.AudioURL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="audiourl" placeholder="">
        </div>

          <div class="form-group{{ $errors->has('upload_audio') ? ' has-error' : '' }} input-file-block" id="uploadaudio" style="display: none;">
            {!! Form::label('upload_audio', __('adminstaticwords.UploadAudio')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>
            {!! Form::file('upload_audio', ['class' => 'input-file', 'id'=>'upload_audio']) !!}
            <label for="upload_audio" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.UploadAudio')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
            </label>
            <p class="info">{{__('adminstaticwords.ChooseCustomUploadAudio')}}</p>
            <small class="text-danger">{{ $errors->first('upload_audio') }}</small>
          </div>


       {{-- upload video --}}
       {{-- <div id="upload_audio" style="display: none;" class="form-group{{ $errors->has('upload_audio') ? ' has-error' : '' }} input-file-block">
         {!! Form::label('upload_audio', 'Upload Video in 360p') !!} - <p class="inline info">Choose A Video</p>
              {!! Form::file('upload_audio', ['class' => 'input-file', 'id'=>'upload_audio']) !!}
              <label for="upload_audio" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Upload Video in 360p Quality">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">Choose a File</span>
              </label>
              <small class="text-danger">{{ $errors->first('upload_audio') }}</small>
     </div> --}}
     {{-- select to upload or add links code ends here --}}

     <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
      {!! Form::label('a_language', __('adminstaticwords.AudioLanguages')) !!}
      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectAudioLanguage')}}"></i>
      <div class="input-group">
        {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
        <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
      </div>
      <small class="text-danger">{{ $errors->first('a_language') }}</small>
    </div>
    <div class="form-group{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">
      {!! Form::label('maturity_rating', __('adminstaticwords.MaturityRating')) !!}
      <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectMaturityRating')}}"></i>
      {!! Form::select('maturity_rating', array('all age' => __('adminstaticwords.AllAge'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}
      <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>
    </div>
    <div class="form-group" style="display: none">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')) !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch for-custom-image">
            {!! Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']) !!}
            <span class="slider round"></span>
          </label>
        </div>
      </div>
    </div>
    <div class="upload-image-main-block">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('thumbnail', __('adminstaticwords.Thumbnail')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>
            {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}
            <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Thumbnail')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
            </label>
            <p class="info">{{__('adminstaticwords.ChooseCustomThumbnail')}}</p>
            <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('poster', __('adminstaticwords.Poster')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>
            {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}
            <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Poster')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
            </label>
            <p class="info">{{__('adminstaticwords.ChooseCustomPoster')}}</p>
            <small class="text-danger">{{ $errors->first('poster') }}</small>
          </div>
        </div>
      </div>
    </div>
    
    <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('featured', __('adminstaticwords.Featured')) !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            {!! Form::checkbox('featured', 1, 0, ['class' => 'checkbox-switch']) !!}
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('featured') }}</small>
      </div>
    </div>

    <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
      <div class="row">
        <div class="col-xs-6">
          {!! Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')) !!}
        </div>
        <div class="col-xs-5 pad-0">
          <label class="switch">
            <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
            <span class="slider round"></span>
          </label>
        </div>
      </div>
      <div class="col-xs-12">
        <small class="text-danger">{{ $errors->first('is_protect') }}</small>
      </div>
    </div>
    <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
      {!! Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')) !!}
      {!! Form::password('password', null, ['class' => 'form-control','id'=>'password']) !!}
      <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
      <small class="text-danger">{{ $errors->first('password') }}</small>
    </div>



  <div class="form-group">
    <label for="">{{__('adminstaticwords.MetaKeyword:')}} </label>
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterMetaKeyword')}}"></i>
    <input name="keyword" type="text" class="form-control" data-role="tagsinput"/>
  </div>


  <div class="menu-block">
    <h6 class="menu-block-heading">{{__('adminstaticwords.PleaseSelectMenu')}}</h6>
    @if (isset($menus) && count($menus) > 0)
    <ul>
      @foreach ($menus as $menu)
      <li>
        <div class="inline">
          <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
          <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
        </div>
        {{$menu->name}}
      </li>
      @endforeach
    </ul>
    @endif
  </div>


  <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">
    {!! Form::label('rating', __('adminstaticwords.Ratings')) !!}
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterRatings')}} eg:8"></i>
    {!! Form::text('rating',  null, ['class' => 'form-control', ]) !!}
    <small class="text-danger">{{ $errors->first('rating') }}</small>
  </div>
  <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">
    {!! Form::label('genre_id',__('adminstaticwords.Genre')) !!}
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectGenres')}}"></i>
    <div class="input-group">
      {!! Form::select('genre_id[]', $genre_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
      <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>
    </div>
    <small class="text-danger">{{ $errors->first('genre_id') }}</small>
  </div>

  <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
    {!! Form::label('detail', __('adminstaticwords.Description')) !!}
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterAudioDescription')}}"></i>
    {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
    <small class="text-danger">{{ $errors->first('detail') }}</small>
  </div>
  <div class="btn-group pull-right">
    <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
    <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>
  </div>
<div class="clear-both"></div>
{!! Form::close() !!}
</div>
</div>
</div>
</div>
<!-- Add Language Modal -->
<div id="AddLangModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('adminstaticwords.AddLanguage')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
      <div class="modal-body">
        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
          {!! Form::label('language', __('adminstaticwords.Language')) !!}
          {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('language') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info">{{__('adminstaticwords.Reset')}}</button>
          <button type="submit" class="btn btn-success">{{__('adminstaticwords.Create')}}</button>
        </div>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>


<!-- Add Genre Modal -->
<div id="AddGenreModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">{{__('adminstaticwords.AddGenre')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'GenreController@store']) !!}
      <div class="modal-body admin-form-block">
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          {!! Form::label('name', __('adminstaticwords.Name')) !!}
          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
          <small class="text-danger">{{ $errors->first('name') }}</small>
        </div>
      </div>
      <div class="modal-footer">
        <div class="btn-group pull-right">
          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>
        </div>
      </div>
      <div class="clear-both"></div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
@endsection

@section('custom-script')


<script>
  $(document).ready(function(){
   $('#ifbox').show();
   $('#selecturl').change(function(){  
     selecturl = document.getElementById("selecturl").value;
      if (selecturl == 'audiourl') {
    $('#ifbox').show();
    $('#uploadaudio').hide();

  }else if (selecturl == 'upload_audio') {
   $('#uploadaudio').show();
   $('#ifbox').hide();

 }

});
 

  $('input[name="is_protect"]').click(function(){
    if($(this).prop("checked") == true){
      $('.is_protect').fadeIn();
    }
    else if($(this).prop("checked") == false){
      $('.is_protect').fadeOut();
    }
  });
});
</script>


<script type="text/javascript">
    $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
@endsection
