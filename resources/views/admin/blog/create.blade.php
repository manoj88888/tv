@extends('layouts.admin')
@section('title',__('adminstaticwords.CreatePost'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin/blog')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreatePost')}}</h4>
    <div class="row">
      <div class="col-md-10">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'BlogController@store', 'files' => true]) !!}
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', __('adminstaticwords.BlogTitle')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterBlogTitle ')}}eg:Arrow"></i>
                {!! Form::text('title', null, ['class' => 'form-control', 'autofocus', 'autocomplete'=>'off','required', 'placeholder'=> __('adminstaticwords.EnterBlogTitle ')]) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
            
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
                    {!! Form::label('image', __('adminstaticwords.Image')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
                    {!! Form::file('image', ['class' => 'input-file','required', 'id'=>'image']) !!}
                    <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.BlogThumbnail')}}">
                      <i class="icon fa fa-check"></i>
                      <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
                    </label>
                    <p class="info">{{__('adminstaticwords.ChooseCustomImage')}}</p><span class="text-danger">*</span>
                    <small class="text-danger">{{ $errors->first('image') }}</small>
                  </div>
                </div>
               
          </div>
           
              <div class=" form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('adminstaticwords.Description')) !!} - <p class="inline info">{{__('adminstaticwords.PleaseEnterBlogDescription')}}</p>
                {!! Form::textarea('detail', null, ['id' => '','autocomplete'=>'off', 'class' => 'form-control ckeditor', 'required']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
            </div>

             <div class="menu-block">
              <h6 class="menu-block-heading">{{__('adminstaticwords.PleaseSelectMenu')}}</h6>
               <small class="text-danger">{{ $errors->first('menu') }}</small>
              @if (isset($menus) && count($menus) > 0)
                <ul>
                     <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input all" name="menu[]" value="100" id="checkbox{{100}}" >
                        <label for="checkbox{{100}}" class="material-checkbox"></label>
                      </div>
                      {{__('adminstaticwords.AllMenus')}}
                    </li>
                  @foreach ($menus as $menu)
                    <li>
                      <div class="inline">
                        <input type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" >
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                      </div>
                      {{$menu->name}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
             <div class="form-group{{ $errors->has('is_active') ? ' has-error' : '' }} switch-main-block">
            <div class="row">
              <div class="col-xs-4">
                {!! Form::label('is_active', __('adminstaticwords.Status')) !!}
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

@section('custom-script')
  <script>
    $(document).ready(function(){

      $('.upload-image-main-block').hide();
      $('.for-custom-image input').click(function(){
        if($(this).prop("checked") == true){
          $('.upload-image-main-block').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.upload-image-main-block').fadeOut();
        }
      });
    });
  </script>
  <script type="text/javascript">
    // when click all menu  option all checkbox are checked

    $(".all").click(function(){
      if($(this).is(':checked')){
        $('.one').prop('checked',true);
      }
      else{
        $('.one').prop('checked',false);
      }
    })
  </script>
  
@endsection