@extends('layouts.admin')
@section('title',__('adminstaticwords.Edit')." "." - $actor->name")
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/actors')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.EditActor')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($actor, ['method' => 'PATCH', 'action' => ['ActorController@update', $actor->id], 'files' => true]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('adminstaticwords.Name')) !!}
                 <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterActorName')}} eg:Tom Hardy"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
               <div class="form-group{{ $errors->has('biography') ? ' has-error' : '' }}">
                {!! Form::label('biography', __('adminstaticwords.Biography')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterActorBiography')}} "></i>
                {!! Form::textarea('biography', null, ['class' => 'form-control','row'=>'3', 'placeholder' => __('adminstaticwords.PleaseEnterActorBiography')]) !!}
                <small class="text-danger">{{ $errors->first('biography') }}</small>
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image',__('adminstaticwords.ActorImage')) !!}
               <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.UploadActorImage')}}"></i>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.ActorImage')}}">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
              </label>
              <p class="info">{{__('adminstaticwords.ChooseCustomImage')}}</p>
              <small class="text-danger">{{ $errors->first('image') }}</small>
            </div>
            <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Update')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
