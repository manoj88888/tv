@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateAudioLanguage'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/audio_language')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a>{{__('adminstaticwords.CreateAudioLanguage')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}
            <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">
              {!! Form::label('language', __('adminstaticwords.Language')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterAudioAndSubtitleLanguage')}} eg:English"></i>
              {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' =>__('adminstaticwords.PleaseEnterAudioAndSubtitleLanguage')]) !!}
              <small class="text-danger">{{ $errors->first('language') }}</small>
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
@endsection
