@extends('layouts.admin')
@section('title', __('adminstaticwords.TermsCondition'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('adminstaticwords.TermsAndConditionText')}}</h4>
    @if ($config)
      <div class="admin-form-block z-depth-1">
        {!! Form::model($config, ['method' => 'PATCH', 'route' => 'term&con']) !!}
          <div class="form-group{{ $errors->has('terms_condition') ? ' has-error' : '' }}">
            {!! Form::label('terms_condition', __('adminstaticwords.TermsAndConditionText')) !!}
            {!! Form::textarea('terms_condition', null, ['id' => 'editor1', 'class' => 'form-control']) !!}
            <small class="text-danger">{{ $errors->first('terms_condition') }}</small>
          </div>
          <div class="btn-group pull-right">
            <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Save')}}</button>
          </div>
          <div class="clear-both"></div>
        {!! Form::close() !!}
      </div>
    @endif
  </div>
@endsection

@section('custom-script')
  <script>
    $(function () {
      CKEDITOR.replace('editor1');
    });
  </script>
@endsection