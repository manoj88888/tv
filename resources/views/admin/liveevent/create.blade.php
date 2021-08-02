@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateLiveEvent'))
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
  <h4 class="admin-form-text"><a href="{{url('admin/liveevent')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateLiveEvent')}}</h4>
  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">



        {!! Form::open(['method' => 'POST', 'action' => 'LiveEventController@store', 'files' => true]) !!}
        

        <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
          {!! Form::label('title',__('adminstaticwords.EventTitle')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterLiveEventTitle')}} Eg:Avatar"></i>
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('adminstaticwords.EnterLiveEventTitle')]) !!}
          <small class="text-danger">{{ $errors->first('title') }}</small>
        </div>
            
          {{-- <div id="movie_slug" class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
          {!! Form::label('slug', 'Movie Slug') !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Enter movie slug Eg:Avatar"></i>
          {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Please enter movie slug']) !!}
          <small class="text-danger">{{ $errors->first('slug') }}</small>
        </div> --}}

       
       
        {{-- select to upload code start from here --}}
        <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">
          {!! Form::label('selecturls', __('adminstaticwords.AddVideo')) !!}
          <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddVideo')}}"></i>
          {!! Form::select('selecturl', array('iframeurl' =>__('adminstaticwords.IFrameURL'), 'customurl' => __('adminstaticwords.CustomURLAndM3u8URL')), null, ['class' => 'form-control select2','id'=>'selecturl']) !!}
           <small class="text-danger">{{ $errors->first('selecturl') }}</small>
         </div>


         <div id="ifbox" style="display: none;" class="form-group">
          <label for="iframeurl">{{__('adminstaticwords.IFRAMEURL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>
          <input  type="text" class="form-control" name="iframeurl" placeholder="">
        </div>


        
        {{-- custom /m3u8 --}}
        <div id="ready_url" style="display: none;" class="form-group{{ $errors->has('ready_url') ? ' has-error' : '' }}">
         <label id="customurl"></label>
         <p class="inline info"> - {{__('adminstaticwords.PleaseEnterYourVideoUrl')}}</p>
         {!! Form::text('ready_url', null, ['class' => 'form-control','id'=>'apiUrl']) !!}
         <small class="text-danger">{{ $errors->first('ready_url') }}</small>
       </div>
    
      <div class="form-group" style="display: none">
        <div class="row">
          <div class="col-xs-6">
            {!! Form::label('',__('adminstaticwords.ChooseCustomThumbnailAndPoster')) !!}
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
              {!! Form::label('thumbnail',__('adminstaticwords.Thumbnail')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>
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

      <div class="form-group{{ $errors->has('start_time') ? ' has-error' : '' }}">
        {!! Form::label('start_time', __('adminstaticwords.EventStartTime')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterStartTime')}} eg:"></i>
       <input type="datetime-local" name="start_time" class="form-contrrol" >
        <small class="text-danger">{{ $errors->first('start_time') }}</small>
      </div>

       <div class="form-group{{ $errors->has('end_time') ? ' has-error' : '' }}">
        {!! Form::label('end_time', __('adminstaticwords.EventEndTime')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterEndTime')}} eg:"></i>
       {{--  {!! Form::datetime('end_time',  null, ['class' => 'form-control', ]) !!} --}}
        <input type="datetime-local" name="end_time" class="form-contrrol" >
        <small class="text-danger">{{ $errors->first('end_time') }}</small>
      </div>

       <div class="form-group{{ $errors->has('organized_by') ? ' has-error' : '' }}">
        {!! Form::label('organized_by', __('adminstaticwords.EventOrganizedBy')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterOrganizedBy')}} "></i>
        {!! Form::text('organized_by',  null, ['class' => 'form-control', ]) !!}
        <small class="text-danger">{{ $errors->first('organized_by') }}</small>
      </div>
  

      <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        {!! Form::label('description',__('adminstaticwords.Description')) !!}
        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterLiveEventDescription')}}"></i>
        {!! Form::textarea('description', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}
        <small class="text-danger">{{ $errors->first('description') }}</small>
      </div>

      <div class="form-group{{ $errors->has('Status') ? ' has-error' : '' }}">
        <div class="row">
          <div class="col-xs-6">
            {!! Form::label('status', __('adminstaticwords.Status')) !!}
          </div>
          <div class="col-xs-5 pad-0">
            <label class="switch">
              {!! Form::checkbox('status', 1, 0, ['class' => 'checkbox-switch']) !!}
              <span class="slider round"></span>
            </label>
          </div>
        </div>
        <div class="col-xs-12">
          <small class="text-danger">{{ $errors->first('status') }}</small>
        </div>
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
</div>

@endsection

@section('custom-script')


<script>
  $(document).ready(function(){

    $('#ifbox').show();

    $('#selecturl').change(function(){  
       selecturl = document.getElementById("selecturl").value;
        if (selecturl == 'iframeurl') {
          $('#ifbox').show();
          $('#ready_url').hide();
        }else if(selecturl=='customurl'){
         $('#ifbox').hide();
         $('#ready_url').show();
         $('#ready_url_text').text('Enter Custom URL or M3U8 URL');
       }
    });
  });
   
</script>


@endsection
