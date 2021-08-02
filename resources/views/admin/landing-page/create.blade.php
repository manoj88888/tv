@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateBlock'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/customize/landing-page')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateBlock')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'LandingPageController@store', 'files' => true]) !!}
            <div class="form-group{{ $errors->has('heading') ? ' has-error' : '' }}">
                {!! Form::label('heading', __('adminstaticwords.Heading')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterHeading')}} eg:Join next hour"></i>
                {!! Form::text('heading', null, ['class' => 'form-control', 'placeholder'=>__('adminstaticwords.PleaseEnterHeading')]) !!}
                <small class="text-danger">{{ $errors->first('heading') }}</small>
            </div>
            <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('adminstaticwords.Detail')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterDetail')}}"></i>
                {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'placeholder'=>__('adminstaticwords.PleaseEnterDetail')]) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
            </div>
            <div class="pad_plus_border">
              <div class="form-group{{ $errors->has('button') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-xs-6">
                    {!! Form::label('button', __('adminstaticwords.Button')) !!}
                  </div>
                  <div class="col-xs-5 text-right">
                    <label class="switch">
                      {!! Form::checkbox('button', 1, 1, ['class' => 'checkbox-switch']) !!}
                      <span class="slider round"></span>
                    </label>
                  </div>
                </div>
                <div class="col-xs-12">
                  <small class="text-danger">{{ $errors->first('button') }}</small>
                </div>
              </div>
              <div class="bootstrap-checkbox form-group{{ $errors->has('button_link') ? ' has-error' : '' }}">
                <div class="row">
                  <div class="col-md-7">
                    {!! Form::label('button_link', __('adminstaticwords.ButtonLink')) !!}
                  </div>
                  <div class="col-md-5 pad-0">
                    <div class="make-switch">
                      {!! Form::checkbox('button_link', 1, 1, ['class' => 'bootswitch', "data-on-text"=>"Login", "data-off-text"=>"Register", "data-size"=>"small"]) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <small class="text-danger">{{ $errors->first('button_link') }}</small>
                </div>
              </div>
              <div class="form-group{{ $errors->has('button_text') ? ' has-error' : '' }} button_text">
                {!! Form::label('button_text', __('adminstaticwords.ButtonText')) !!}
                {!! Form::text('button_text', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('button_text') }}</small>
              </div>
            </div>
            <div class="bootstrap-checkbox form-group{{ $errors->has('left') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-md-7">
                  <h5 class="bootstrap-switch-label">{{__('adminstaticwords.ImagePosition')}}</h5>
                </div>
                <div class="col-md-5 pad-0">
                  <div class="make-switch">
                    {!! Form::checkbox('left', 1, 1, ['class' => 'bootswitch', "data-on-text"=>"Left", "data-off-text"=>"Right", "data-size"=>"small"]) !!}
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <small class="text-danger">{{ $errors->first('left') }}</small>
              </div>
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image', 'Image') !!} <p class="inline info"></p>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.ProjectImage')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
              </label>
              <p class="info">{{__('adminstaticwords.ChooseAImage')}}</p>
              <small class="text-danger">{{ $errors->first('image') }}</small>
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
