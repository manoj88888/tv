@extends('layouts.admin')
@section('title',__('adminstaticwords.EditPost'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
     <h4 class="admin-form-text"><a href="{{url('admin/blog')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.EditPost')}}</h4> 
    {!! Form::model($blog, ['method' => 'PATCH', 'action' => ['BlogController@update', $blog->id], 'files' => true]) !!}
    <div class="row">
      <div class="col-md-10">
          <div class="row admin-form-block z-depth-1">
        <div class="col-md-6">
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              {!! Form::label('title', __('adminstaticwords.BlogTitle')) !!} - <p class="inline info">{{__('adminstaticwords.EnterBlogTitle')}}</p>
              {!! Form::text('title', null, ['class' => 'form-control','autocomplete'=>'off','required']) !!}
              <small class="text-danger">{{ $errors->first('title') }}</small>
          </div> 
          
          <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('image', __('adminstaticwords.Image')) !!} 
            {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
            <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Image')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
            </label>
            <p class="info">{{__('adminstaticwords.ChooseCustomImage')}}</p>
            <small class="text-danger">{{ $errors->first('image') }}</small>
          </div> 
           <div class=" form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail',__('adminstaticwords.Description')) !!} - <p class="inline info">{{__('adminstaticwords.PleaseEnterBlogDescription')}}</p>
                {!! Form::textarea('detail', null, ['id' => 'detail','autocomplete'=>'off', 'class' => 'form-control ckeditor', '']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
            </div>
            <div class="menu-block">
              <h6 class="menu-block-heading">{{__('adminstaticwords.PleaseSelectMenu')}}</h6>
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
                        <input @foreach($blog->blog_m as $getbm) @if($getbm->menu_id == $menu->id) checked @endif @endforeach type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"  ></label>
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
                  {!! Form::checkbox('is_active', null, null, ['class' => 'checkbox-switch']) !!}
                  <span class="slider round"></span>
                </label>
              </div>
            </div>
            <div class="col-xs-12">
              <small class="text-danger">{{ $errors->first('is_active') }}</small>
            </div>
          </div>     
                   
          <div class="btn-group pull-right">
              <button type="submit" class="btn btn-success">{{__('adminstaticwords.Update')}}</button>
          </div>
          <div class="clear-both"></div>
        </div>  
    
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
    $(document).ready(function(){
      var check = [];
    
    $('.one').each(function(index){

      if($(this).is(':checked')){
        check.push(1);
      }else{
        check.push(0);
      }

    });
   
    var flag = 1;

    if (jQuery.inArray(0, check) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

     if(flag == 0){
      $('.all').prop('checked',false);
     }else{
       $('.all').prop('checked',true);
     }

  });

    // if one checkbox is unchecked remove checked on all menu option

    $(".one").click(function(){
      if($(this).is(':checked'))
      {
       
        var checked = [];
       $('.one').each(function(){
        if($(this).is(':checked')){
          checked.push(1);
        }else{
          checked.push(0);
        }
       })
       
       var flag = 1;

    if (jQuery.inArray(0, checked) == -1) {
            flag = 1;

        } else {
            flag = 0;
        }

       if(flag == 0){
        $('.all').prop('checked',false);
       }else{
         $('.all').prop('checked',true);
       }
      }
      else{
        
        $('.all').prop('checked',false);
      }
    });

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