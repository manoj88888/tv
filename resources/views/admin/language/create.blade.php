@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateLanguage'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/languages')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateLanguage')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'LanguageController@store']) !!}
            <div class="form-group{{ $errors->has('local') ? ' has-error' : '' }}">
                {!! Form::label('local', __('adminstaticwords.local')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Please enter language local name eg:en"></i>
                {!! Form::text('local', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterLanguageLocalName')]) !!}
                <small class="text-danger">{{ $errors->first('local') }}</small>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('adminstaticwords.Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterLanguageName')}} eg:English"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterLanguageName')]) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>

            <div class="form-group">
              <label for="">{{__('adminstaticwords.SetDefault')}}</label>
              <br>
              <label class="switch">
                     <input name="def" type="checkbox" class="checkbox-switch" id="logo_chk">
                    <span class="slider round"></span>
                </label>
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
