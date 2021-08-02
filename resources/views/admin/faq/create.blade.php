@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateFAQ'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/faqs')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateFaq')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'FaqController@store']) !!}
            <div class="form-group{{ $errors->has('question') ? ' has-error' : '' }}">
                {!! Form::label('question', __('adminstaticwords.FaqQuestion')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterYourFaqQuestion')}}"></i>
                {!! Form::text('question', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('adminstaticwords.PleaseEnterYourFaqQuestion')]) !!}
                <small class="text-danger">{{ $errors->first('question') }}</small>
            </div>
            <div class="form-group{{ $errors->has('answer') ? ' has-error' : '' }}">
                {!! Form::label('answer', __('adminstaticwords.FaqAnswer')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterYourFaqAnswer')}}"></i>
                {!! Form::textarea('answer', null, ['class' => 'form-control materialize-textarea', 'rows' => '5', 'placeholder' => __('adminstaticwords.PleaseEnterYourFaqAnswer')]) !!}
                <small class="text-danger">{{ $errors->first('answer') }}</small>
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
