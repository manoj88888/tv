@extends('layouts.admin')
@section('title',__('adminstaticwords.EditGenre').''." - $genre->name")
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/genres')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.EditGenre')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::model($genre, ['method' => 'PATCH', 'action' => ['GenreController@update', $genre->id],'files' => true]) !!}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('adminstaticwords.Name')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterGenreName')}} eg:Drama"></i>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
             <div class="form-group{{ $errors->has('genre') ? ' has-error' : '' }} input-file-block">
              {!! Form::label('image', __('adminstaticwords.GenreImage')) !!}
              <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.UploadGenreImage')}}"></i>
              {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
              <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="genre image">
                <i class="icon fa fa-check"></i>
                <span class="js-fileName">{{isset($genre->image) ? $genre->image :__('adminstaticwords.ChooseAFile')}}</span>
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
