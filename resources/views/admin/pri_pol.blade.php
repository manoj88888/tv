@extends('layouts.admin')
@section('title', __('adminstaticwords.PrivacyPolicy'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('adminstaticwords.PrivacyPolicyText')}}</h4>
    @if ($config)
      <div class="admin-form-block z-depth-1">
        {!! Form::model($config, ['method' => 'PATCH', 'route' => 'pri_pol']) !!}
        <div class="form-group{{ $errors->has('privacy_pol') ? ' has-error' : '' }}">
          {!! Form::label('privacy_pol', __('adminstaticwords.PrivacyPolicyText')) !!}
          {!! Form::textarea('privacy_pol', null, ['id' => 'editor1', 'class' => 'form-control']) !!}
          <small class="text-danger">{{ $errors->first('privacy_pol') }}</small>
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