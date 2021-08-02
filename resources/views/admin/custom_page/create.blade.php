@extends('layouts.admin')
@section('title',__('adminstaticwords.CustomPage'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/custom_page')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateCustomPage')}}</h4>
    <div class="row">
      <div class="col-md-10">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'CustomPageController@store']) !!}
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', __('adminstaticwords.CustomPageTitle')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterCustomPageTitle')}} eg:About us"></i>
                {!! Form::text('title', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.PleaseEnterYourCustomPageTitle')]) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
            
              <div class=" form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('adminstaticwords.Description')) !!} - <p class="inline info">{{__('adminstaticwords.PleaseEnterCustomPageDescription')}}</p>
                {!! Form::textarea('detail', null, ['id' => '','autocomplete'=>'off', 'class' => 'form-control ckeditor', 'required']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
            </div>

            <div class="form-group{{ $errors->has('in_show_menu') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  {!! Form::label('in_show_menu', __('adminstaticwords.ShowInMenu')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('in_show_menu', 1, 1, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('in_show_menu') }}</small>
              </div>
            </div>

            <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} switch-main-block">
              <div class="row">
                <div class="col-xs-4">
                  {!! Form::label('is_active',__('adminstaticwords.Status')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">                
                    {!! Form::checkbox('is_active', 1, 1, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('is_active') }}</small>
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
@endsection

