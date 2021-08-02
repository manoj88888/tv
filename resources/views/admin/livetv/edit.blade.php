@extends('layouts.admin')

@section('title',"Edit Movie - $movie->title")

<style type="text/css">

    body{

            background-color: #efefef;

        }

        .container-4 input#hyv-search {

            width: 500px;

            height: 30px;

            border: 1px solid #c6c6c6;

            font-size: 10pt;

            float: left;

            padding-left: 15px;

            -webkit-border-top-left-radius: 5px;

            -webkit-border-bottom-left-radius: 5px;

            -moz-border-top-left-radius: 5px;

            -moz-border-bottom-left-radius: 5px;

            border-top-left-radius: 5px;

            border-bottom-left-radius: 5px;

        }

         .container-4 input#vimeo-search {

            width: 500px;

            height: 30px;

            border: 1px solid #c6c6c6;

            font-size: 10pt;

            float: left;

            padding-left: 15px;

            -webkit-border-top-left-radius: 5px;

            -webkit-border-bottom-left-radius: 5px;

            -moz-border-top-left-radius: 5px;

            -moz-border-bottom-left-radius: 5px;

            border-top-left-radius: 5px;

            border-bottom-left-radius: 5px;

        }

        .container-4 button.icon {

            height: 30px;

            background: #f0f0f0 url('images/searchicon.png') 10px 1px no-repeat;

            background-size: 24px;

            -webkit-border-top-right-radius: 5px;

            -webkit-border-bottom-right-radius: 5px;

            -moz-border-radius-topright: 5px;

            -moz-border-radius-bottomright: 5px;

            border-top-right-radius: 5px;

            border-bottom-right-radius: 5px;

            border: 1px solid #c6c6c6;

            width: 50px;

            margin-left: -44px;

            color: #4f5b66;

            font-size: 10pt;

        }

    

</style>

@section('content')

<div class="admin-form-main-block">

  <h4 class="admin-form-text"><a href="{{url('admin/livetv')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}k" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.EditLiveTv')}}</h4>

  <div class="row">

    <div class="col-md-6">

     <div class="admin-form-block z-depth-1">



       {!! Form::model($movie, ['method' => 'PATCH', 'action' => ['LiveTvController@update',$movie->id], 'files' => true]) !!}



   



       <div id="movie_title" class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

        {!! Form::label('title', __('adminstaticwords.LiveTvTitle')) !!}

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterLivetvTitle')}}"></i>

        <input {{ $movie->fetch_by == 'byID' ? "readonly=readonly" : "" }} id="mv_t" type="text" class="form-control" name="title" value="{{ $movie->title }}">

        <small class="text-danger">{{ $errors->first('title') }}</small>

      </div>



      <div id="movie_slug" class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">

        {!! Form::label('slug', __('adminstaticwords.LiveTvSlug')) !!}

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterLivetvSlug')}}"></i>

        <input type="text" class="form-control" name="slug" value="{{ $movie->title }}">

        <small class="text-danger">{{ $errors->first('slug') }}</small>

      </div>







      <div class="form-group">

        <label for="">{{__('adminstaticwords.MetaKeyword')}}: </label>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterMetaKeyword')}}"></i>

        <input name="keyword" type="text" class="form-control" value="{{ $movie->keyword }}" data-role="tagsinput"/>





      </div>



      <div class="form-group">

        <label for="">{{__('adminstaticwords.MetaDescription')}}: </label>

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.EnterMetaDescription')}}"></i>

        <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $movie->description }}</textarea>

      </div>



      {{-- select to upload code start from here --}}

      <div class="form-group{{ $errors->has('selecturl') ? ' has-error' : '' }}">

        {!! Form::label('selecturls', __('adminstaticwords.AddVideo')) !!}

        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectOneOfTheOptionsToAddVideo')}}"></i>

        <select class="form-control select2" id="selecturl" name="selecturl">

         

          @if($video_link['iframeurl']!='')

          <option value="iframeurl" selected="">{{__('adminstaticwords.IFRAMEURL')}}</option>

          @else

            <option value="iframeurl">{{__('adminstaticwords.IFRAMEURL')}}</option>

          @endif

          

         

           @if($video_link['ready_url']!='')

           <option value="customurl" selected="">{{__('adminstaticwords.CustomURLYoutubeURLVimeoURL')}}</option>

            @else

             <option value="customurl">{{__('adminstaticwords.CustomURLYoutubeURLVimeoURL')}}</option>

          @endif

          



         

        </select>

       

        <small class="text-danger">{{ $errors->first('selecturl') }}</small>

      </div>      

      <div id="ifbox"  style="{{$video_link['iframeurl']!='' ? '' : "display: none" }}" class="form-group">

        <label for="iframeurl">{{__('adminstaticwords.IframeURL')}}: </label> <a data-toggle="modal" data-target="#embdedexamp"><i class="fa fa-question-circle-o"> </i></a>

        <input  type="text" value="{{$video_link['iframeurl']}}" class="form-control" name="iframeurl" placeholder="{{__('adminstaticwords.IframeURL')}}">

      </div>



      <!-- Modal -->

      <div  class="modal fade" id="embdedexamp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

        <div class="modal-dialog" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

              <h6 class="modal-title" id="myModalLabel">{{__('adminstaticwords.EmbdedURLExamples')}}: </h6>

            </div>

            <div class="modal-body">

              <p style="font-size: 15px;"><b>{{__('adminstaticwords.Youtube')}}:</b> {{__('adminstaticwords.YoutubeUrlLink')}} </p>



              <p style="font-size: 15px;"><b>{{__('adminstaticwords.GoogleDrive')}}:</b>{{__('adminstaticwords.GoogleDriveLink')}}</p>



              <p style="font-size: 15px;"><b>{{__('adminstaticwords.Openload')}}:</b> {{__('adminstaticwords.OpenloadLink')}} </p>

            </div>



          </div>

        </div>

      </div>



      {{-- youtube and vimeo url --}}

      <div id="ready_url" style="{{$video_link['ready_url']!='' ? '' : "display: none" }}" class="form-group{{ $errors->has('ready_url') ? ' has-error' : '' }}">

       <label id="ready_url_text"></label>

       <p class="inline info"> {{__('adminstaticwords.PleaseEnterYourVideoUrl')}}</p>

       {!! Form::text('ready_url',$video_link['ready_url'], ['class' => 'form-control','id'=>'apiUrl']) !!}

       <small class="text-danger">{{ $errors->first('ready_url') }}</small>

     </div>

    



    



  



   {{-- select to upload or add links code ends here --}}



   <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">

    {!! Form::label('a_language', __('adminstaticwords.AudioLanguages')) !!}

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectAudioLanguage')}}"></i>

    <div class="input-group">

      <select name="a_language[]" id="a_language" class="form-control select2" multiple="multiple">

        @if(isset($old_lans) && count($old_lans) > 0)

        @foreach($old_lans as $old)

        <option value="{{$old->id}}" selected="selected">{{$old->language}}</option> 

        @endforeach

        @endif

        @if(isset($a_lans))

        @foreach($a_lans as $rest)

        <option value="{{$rest->id}}">{{$rest->language}}</option> 

        @endforeach

        @endif

      </select>  

      <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>

    </div>

    <small class="text-danger">{{ $errors->first('a_language') }}</small>

  </div>

  <div class="form-group{{ $errors->has('maturity_rating') ? ' has-error' : '' }}">

    {!! Form::label('maturity_rating', __('adminstaticwords.MaturityRating')) !!}

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectMaturityRating')}}"></i>

    {!! Form::select('maturity_rating', array('all age' => __('adminstaticwords.AllAAge'), '13+' =>'13+', '16+' => '16+', '18+'=>'18+'), null, ['class' => 'form-control select2']) !!}

    <small class="text-danger">{{ $errors->first('maturity_rating') }}</small>

  </div>

  <div class="form-group" style="display: none">

    <div class="row">

      <div class="col-xs-6">

        {!! Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')) !!}

      </div>

      <div class="col-xs-5 pad-0">

        <label class="switch for-custom-image">

          {!! Form::checkbox('', 1, 1, ['class' => 'checkbox-switch']) !!}

          <span class="slider round"></span>

        </label>

      </div>

    </div>

  </div>

  <div class="upload-image-main-block">

    <div class="row">

      <div class="col-md-6">

        <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">

          {!! Form::label('thumbnail',__('adminstaticwords.Thumbnail')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>

          {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail']) !!}

          <label for="thumbnail" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Thumbnail')}}">

            <i class="icon fa fa-check"></i>

            <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>

          </label>

          <p class="info">{{__('adminstaticwords.ChooseCustomThumbnail')}}</p>

          <small class="text-danger">{{ $errors->first('thumbnail') }}</small>

        </div>

      </div>

      <div class="col-md-6">

        <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">

          {!! Form::label('poster', __('adminstaticwords.Poster')) !!} - <p class="info">{{__('adminstaticwords.HelpBlockText')}}</p>

          {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster']) !!}

          <label for="poster" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Poster')}}">

            <i class="icon fa fa-check"></i>

            <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>

          </label>

          <p class="info">{{__('adminstaticwords.ChooseCustomPoster')}}</p>

          <small class="text-danger">{{ $errors->first('poster') }}</small>

        </div>

      </div>

    </div>

  </div>



           

            <div class="form-group{{ $errors->has('featured') ? ' has-error' : '' }}">

              <div class="row">

                <div class="col-xs-6">

                  {!! Form::label('featured', __('adminstaticwords.Featured')) !!}

                </div>

                <div class="col-xs-5 pad-0">

                  <label class="switch">                

                    {!! Form::checkbox('featured', 1, $movie->featured, ['class' => 'checkbox-switch']) !!}

                    <span class="slider round"></span>

                  </label>

                </div>

              </div>

              <div class="col-xs-12">

                <small class="text-danger">{{ $errors->first('featured') }}</small>

              </div>

            </div>



            <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">

              <div class="row">

                <div class="col-xs-6">

                  {!! Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')) !!}

                </div>

                <div class="col-xs-5 pad-0">

                  <label class="switch">

                    <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect" {{ $movie->is_protect == 1 ? 'checked' : '' }}>

                    <span class="slider round"></span>

                  </label>

                </div>

              </div>

              <div class="col-xs-12">

                <small class="text-danger">{{ $errors->first('is_protect') }}</small>

              </div>

            </div>

             <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="{{ $movie->is_protect == 1 ? '' : 'display:none' }}" >

              {!! Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')) !!}

              <input type="password" id="password" name="password" value="{{ $movie->password }}" class="form-control">

              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>

              <small class="text-danger">{{ $errors->first('password') }}</small>

            </div>



            <div class="form-group{{ $errors->has('livetvicon') ? ' has-error' : '' }}">

              <div class="row">

                <div class="col-xs-6">

                  {!! Form::label('livetvicon', __('adminstaticwords.LiveTvIconShow')) !!}

                </div>

                <div class="col-xs-5 pad-0">

                  <label class="switch">                

                    {!! Form::checkbox('livetvicon', 1, $movie->livetvicon, ['class' => 'checkbox-switch']) !!}

                    <span class="slider round"></span>

                  </label>

                </div>

              </div>

              <div class="col-xs-12">

                <small class="text-danger">{{ $errors->first('livetvicon') }}</small>

              </div>

            </div>

            <div class="menu-block">

              <h6 class="menu-block-heading">{{__('adminstaticwords.PleaseSelectMenu')}}</h6>

              @if (isset($menus) && count($menus) > 0)

              <ul>

                @foreach ($menus as $menu)

                <li>

                  <div class="inline">

                    @php

                    $checked = null;

                    if (isset($menu->menu_data) && count($menu->menu_data) > 0) {

                      if ($menu->menu_data->where('movie_id', $movie->id)->where('menu_id', $menu->id)->first() != null) {

                        $checked = 1;

                      }

                    }

                    @endphp

                    @if ($checked == 1)

                    <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}" checked>

                    <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>

                    @else

                    <input type="checkbox" class="filled-in material-checkbox-input" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">

                    <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>

                    @endif

                  </div>

                  {{$menu->name}}

                </li>

                @endforeach

              </ul>

              @endif

            </div>

            

          

  <input type="text" name="director_id" value="0" hidden="true">

  <input type="text" name="actor_id" value="0" hidden="true">

  <input type="text" name="duration" value="0" hidden="true">

          <div class="form-group{{ $errors->has('rating') ? ' has-error' : '' }}">

    {!! Form::label('rating', __('adminstaticwords.Ratings')) !!}

    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterRatings')}} eg:8"></i>

    {!! Form::text('rating',  null, ['class' => 'form-control', ]) !!}

    <small class="text-danger">{{ $errors->first('rating') }}</small>

  </div>

          

          <div class="form-group{{ $errors->has('genre_id') ? ' has-error' : '' }}">

           {!! Form::label('genre_id',__('adminstaticwords.Genre')) !!}

           <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectGenres')}}"></i>

           <div class="input-group">

            <select name="genre_id[]" id="genre_id" class="form-control select2" multiple="multiple">

              @if(isset($old_genre) && count($old_genre) > 0)

              @foreach($old_genre as $old)

              <option value="{{$old->id}}" selected="selected">{{$old->name}}</option> 

              @endforeach

              @endif

              @if(isset($genre_ls))

              @foreach($genre_ls as $rest)

              <option value="{{$rest->id}}">{{$rest->name}}</option> 

              @endforeach

              @endif

            </select>  

            <a href="#" data-toggle="modal" data-target="#AddGenreModal" class="input-group-addon"><i class="material-icons left">add</i></a>

          </div>

          <small class="text-danger">{{ $errors->first('genre_id') }}</small>

        </div>

      

     

      

       

       <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">

         {!! Form::label('detail', __('adminstaticwords.Description')) !!}

         <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterLiveTvDescription')}}"></i>

         {!! Form::textarea('detail', null, ['class' => 'form-control materialize-textarea', 'rows' => '5']) !!}

         <small class="text-danger">{{ $errors->first('detail') }}</small>

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







<!-- Add Language Modal -->

<div id="AddLangModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-sm">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">{{__('adminstaticwords.AddLanguage')}}</h5>

      </div>

      {!! Form::open(['method' => 'POST', 'action' => 'AudioLanguageController@store']) !!}

      <div class="modal-body">

        <div class="form-group{{ $errors->has('language') ? ' has-error' : '' }}">

          {!! Form::label('language', __('adminstaticwords.Language')) !!}

          {!! Form::text('language', null, ['class' => 'form-control', 'required' => 'required']) !!}

          <small class="text-danger">{{ $errors->first('language') }}</small>

        </div>

      </div>

      <div class="modal-footer">

        <div class="btn-group pull-right">

          <button type="reset" class="btn btn-info">{{__('adminstaticwords.Reset')}}</button>

          <button type="submit" class="btn btn-success">{{__('adminstaticwords.Create')}}</button>

        </div>

      </div>

      {!! Form::close() !!}

    </div>

  </div>

</div>

<!-- Add Director Modal -->

<div id="AddDirectorModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">{{__('adminstaticwords.AddDirector')}}</h5>

      </div>

      {!! Form::open(['method' => 'POST', 'action' => 'DirectorController@store', 'files' => true]) !!}

      <div class="modal-body admin-form-block">          

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

          {!! Form::label('name', 'Name') !!}

          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

          <small class="text-danger">{{ $errors->first('name') }}</small>

        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">

          {!! Form::label('image', 'Director Image') !!} - <p class="inline info">Help block text</p>

          {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}

          <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Director pic">

            <i class="icon fa fa-check"></i>

            <span class="js-fileName">Choose a File</span>

          </label>

          <p class="info">Choose custom image</p>

          <small class="text-danger">{{ $errors->first('image') }}</small>

        </div>

      </div>  

      <div class="modal-footer">            

        <div class="btn-group pull-right">

          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>

          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>

        </div>

        <div class="clear-both"></div>

      </div>  

      {!! Form::close() !!}

    </div>

  </div>

</div>

<!-- Add Actor Modal -->

<div id="AddActorModal" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">Add Actor</h5>

      </div>

      {!! Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]) !!}

      <div class="modal-body admin-form-block">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

          {!! Form::label('name', 'Name') !!}

          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

          <small class="text-danger">{{ $errors->first('name') }}</small>

        </div>

        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">

          {!! Form::label('image', 'Director Image') !!} - <p class="inline info">Help block text</p>

          {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}

          <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="Director pic">

            <i class="icon fa fa-check"></i>

            <span class="js-fileName">Choose a File</span>

          </label>

          <p class="info">Choose custom image</p>

          <small class="text-danger">{{ $errors->first('image') }}</small>

        </div>

      </div>

      <div class="modal-footer">

        <div class="btn-group pull-right">

          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> Reset</button>

          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> Create</button>

        </div>

      </div>  

      <div class="clear-both"></div>

      {!! Form::close() !!}

    </div>

  </div>

</div>

<!-- Add Genre Modal -->

<div id="AddGenreModal" class="modal fade" role="dialog">

  <div class="modal-dialog modal-sm">

    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">{{__('adminstaticwords.AddGenre')}}</h5>

      </div>

      {!! Form::open(['method' => 'POST', 'action' => 'GenreController@store']) !!}

      <div class="modal-body admin-form-block">

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

          {!! Form::label('name', __('adminstaticwords.Name')) !!}

          {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}

          <small class="text-danger">{{ $errors->first('name') }}</small>

        </div>

      </div>

      <div class="modal-footer">

        <div class="btn-group pull-right">

          <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>

          <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>

        </div>

      </div>

      <div class="clear-both"></div>

      {!! Form::close() !!}

    </div>

  </div>

</div>

@endsection



@section('custom-script')

<script>

  $(document).ready(function(){

   

    $('#selecturl').change(function(){  

     selecturl = document.getElementById("selecturl").value;

     if (selecturl == 'iframeurl') {

    $('#ifbox').show();

       $('#subtitle_section').hide();

    $('#uploadvideo').hide();

    $('#ready_url').hide();

    





  }else if (selecturl == 'uploadvideo') {

   $('#uploadvideo').show();

      $('#subtitle_section').show();

   $('#ready_url').hide();

   $('#ifbox').hide();

   



 }else if(selecturl=='customurl'){

       $('#ifbox').hide();

       $('#uploadvideo').hide();

       $('#ready_url').show();

          $('#subtitle_section').hide();

          

       $('#ready_url_text').text('Enter Custom URL or Vimeo or Youtube URL');

   }

    else if (selecturl == 'youtubeapi') {

   $('#uploadvideo').hide();

   $('#ready_url').show();

      $('#subtitle_section').hide();

  

   $('#ifbox').hide();

   $('#ready_url_text').text('Import From Youtube API');



 }else if(selecturl=='vimeoapi'){

   $('#ifbox').hide();

   $('#uploadvideo').hide();

   $('#ready_url').show();

      $('#subtitle_section').hide();

  

   $('#ready_url_text').text('Import From Vimeo API');



 }



});

    var i= 1;

    $('#add').click(function(){  

     i++;  

     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="file" name="sub_t[]"/></td><td><input type="text" name="sub_lang[]" placeholder="Subtitle Language" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm btn_remove">X</button></td></tr>');  

   });



    $(document).on('click', '.btn_remove', function(){  

     var button_id = $(this).attr("id");   

     $('#row'+button_id+'').remove();  

   });  



   

    @if($movie->tmdb == 'N')

    $('#custom_dtl').show();

    @endif

    @if ($movie->subtitle == 0)

    $('.subtitle_list').hide();

    $('#subtitle-file').hide();

    @endif 

    @if($movie->series == 0)

    $('.movie_id').hide();

    @endif

    $('input[name="subtitle"]').click(function(){

     if($(this).prop("checked") == true){

       $('.subtitle_list').fadeIn();

       $('#subtitle-file').fadeIn();

     }

     else if($(this).prop("checked") == false){

      $('.subtitle_list').fadeOut();

      $('#subtitle-file').fadeOut();

    }

  });

  $('input[name="is_protect"]').click(function(){

    if($(this).prop("checked") == true){

      $('.is_protect').fadeIn();

    }

    else if($(this).prop("checked") == false){

      $('.is_protect').fadeOut();

    }

  });

   

  });

</script>

{{-- vimeo api code --}}



<script>

        $(document).ready(function() {

           var videourl;

            vimeoApiCall();

            $("#vpageTokenNext").on( "click", function( event ) {
                $("#vpageToken").val($("#vpageTokenNext").val());

                vimeoApiCall();

            });

            $("#vpageTokenPrev").on( "click", function( event ) {

                $("#vpageToken").val($("#vpageTokenPrev").val());

                vimeoApiCall();

            });

            $("#vimeo-searchBtn").on( "click", function( event ) {

                vimeoApiCall();

                return false;

            });

            jQuery( "#vimeo-search" ).autocomplete({

              source: function( request, response ) {

                //console.log(request.term);

                var sqValue = [];

                var accesstoken='{{env('VIMEO_ACCESS')}}';

                var myvimeourl='https://api.vimeo.com/videos?query=videos'+'&access_token=' + accesstoken +'&per_page=1';

                console.log(myvimeourl);

                jQuery.ajax({

                    type: "GET",

                    url: myvimeourl,

                    dataType: 'jsonp',

                    

                    success: function(data){

                        console.log(data[1]);

                        obj = data[1];

                        jQuery.each( obj, function( key, value ) {

                            sqValue.push(value[0]);

                        });

                        response( sqValue);

                    }

                });

              },

              select: function( event, ui ) {

                setTimeout( function () { 

                    vimeoApiCall();

                }, 300);

              }

            });  

        });

function vimeoApiCall(){

  console.log('yeah i am here');

    var accesstoken='{{env('VIMEO_ACCESS')}}';

    var text=$("#vimeo-search").val();

   var next=  $("#vpageTokenNext").val();

   console.log('jxhh'+next);

   var prev= $("#vpageTokenPrev").val();

    var myvimeourl=null;

   if (next != null && next !='') {

     myvimeourl='https://api.vimeo.com'+next;
   }else if (prev != null && prev !='') {

       myvimeourl='https://api.vimeo.com'+prev;

   }else{

       myvimeourl='https://api.vimeo.com/videos?query='+ text + '&access_token=' + accesstoken+'&per_page=5';

   }

  

   console.log('url'+myvimeourl);

    $.ajax({

        cache: false,

     

        dataType: 'json',

        type: 'GET',

       

        url: myvimeourl,



    })

    .done(function(data) {

      console.log(data);

    // alert('duhjf');

        if ( data.paging.previous === null) {$("#vpageTokenPrev").hide();}else{$("#vpageTokenPrev").show();}

        if ( data.paging.next === null) {$("#vpageTokenNext").hide();}else{$("#vpageTokenNext").show();}

        var items = data.data, videoList = "";

     

        $("#vpageTokenNext").val(data.paging.next);

        $("#vpageTokenPrev").val(data.paging.previous);

        console.log(items);

        $.each(items, function(index,e) {

             

             videourl=e.link;

               // console.log(videourl);

            videoList = videoList 

            + '<li class="hyv-video-list-item" ><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.name+'" src="'+e.pictures.sizes[3].link+'" height="90"></span></p></div><div class="hyv-content-wrapper"><p  class="hyv-content-link">'+e.name+'<span class="title">'+e.description.substr(0, 105)+'</span><span class="stat attribution">by <span>'+e.user.name+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideovimeoURl("'+videourl+'")>Add</button></div></li>';

              

          

        });



        $("#vimeo-watch-related").html(videoList);

       

    });



}

</script>

<script>

  $('#movi_id').on('change',function(){

    if ($('#movi_id').is(':checked')){



      $('#txt2').text("Movie Created By Title:");

      $('#mv_t').removeAttr('readonly','readonly');

      $('#mv_i').attr('readonly','readonly');



    }else{

     $('#mv_i').removeAttr('readonly','readonly');

     $('#mv_t').attr('readonly','readonly');

     $('#txt2').text("Movie Created By ID:");

   }

 });



 

</script>



{{-- youtube API code --}}

<script>

        $(document).ready(function() {

           var videourl;

            youtubeApiCall();

            $("#pageTokenNext").on( "click", function( event ) {

                $("#pageToken").val($("#pageTokenNext").val());

                youtubeApiCall();

            });

            $("#pageTokenPrev").on( "click", function( event ) {

                $("#pageToken").val($("#pageTokenPrev").val());

                youtubeApiCall();

            });

            $("#hyv-searchBtn").on( "click", function( event ) {

                youtubeApiCall();

                return false;

            });

            jQuery( "#hyv-search" ).autocomplete({

              source: function( request, response ) {

                //console.log(request.term);

                var sqValue = [];

                jQuery.ajax({

                    type: "POST",

                    url: "http://suggestqueries.google.com/complete/search?hl=en&ds=yt&client=youtube&hjson=t&cp=1",

                    dataType: 'jsonp',

                    data: jQuery.extend({

                        q: request.term

                    }, {  }),

                    success: function(data){

                        console.log(data[1]);

                        obj = data[1];

                        jQuery.each( obj, function( key, value ) {

                            sqValue.push(value[0]);

                        });

                        response( sqValue);

                    }

                });

              },

              select: function( event, ui ) {

                setTimeout( function () { 

                    youtubeApiCall();

                }, 300);

              }

            });  

        });

function youtubeApiCall(){

    $.ajax({

        cache: false,

        data: $.extend({

            key: '{{env('YOUTUBE_API_KEY')}}',

            q: $('#hyv-search').val(),

            part: 'snippet'

        }, {maxResults:15,pageToken:$("#pageToken").val()}),

        dataType: 'json',

        type: 'GET',

        timeout: 5000,

        url: 'https://www.googleapis.com/youtube/v3/search'

    })

    .done(function(data) {

        if (typeof data.prevPageToken === "undefined") {$("#pageTokenPrev").hide();}else{$("#pageTokenPrev").show();}

        if (typeof data.nextPageToken === "undefined") {$("#pageTokenNext").hide();}else{$("#pageTokenNext").show();}

        var items = data.items, videoList = "";

        $("#pageTokenNext").val(data.nextPageToken);

        $("#pageTokenPrev").val(data.prevPageToken);

        // console.log(items);

        $.each(items, function(index,e) {

             

             videourl="https://www.youtube.com/watch?v="+e.id.videoId;

               console.log(videourl);

            videoList = videoList 

            + '<li class="hyv-video-list-item" ><div class="hyv-content-wrapper"><p  class="hyv-content-link" title="'+e.snippet.title+'"><span class="title">'+e.snippet.title+'</span><span class="stat attribution">by <span>'+e.snippet.channelTitle+'</span></span></p><button class="bn btn-info btn-sm inline" onclick=setVideoURl("'+videourl+'")>Add</button></div><div class="hyv-thumb-wrapper"><p class="hyv-thumb-link"><span class="hyv-simple-thumb-wrap"><img alt="'+e.snippet.title+'" src="'+e.snippet.thumbnails.default.url+'" height="90"></span></p></div></li>';

              

          

        });



        $("#hyv-watch-related").html(videoList);

       

    });

}

    </script>

<script type="text/javascript">

  function setVideoURl(videourls){

    console.log(videourls);

  $('#apiUrl').val(videourls); 

    $('#myyoutubeModal').modal("hide");

  }

</script>

<script type="text/javascript">

  function setVideovimeoURl(videourls){

    console.log(videourls);
  $('#apiUrl').val(videourls); 

    $('#myvimeoModal').modal("hide");

  }

</script>

<script type="text/javascript">

  $(document).ready(function(){ 

    $('#selecturl').change(function() {

     $('#apiUrl').val('');  

        var opval = $(this).val(); //Get value from select element

        if(opval=="youtubeapi"){ //Compare it and if true

            $('#myyoutubeModal').modal("show"); //Open Modal

        }

        if(opval=="vimeoapi"){ //Compare it and if true

            $('#myvimeoModal').modal("show"); //Open Modal

        }

    });

});

</script>

<script type="text/javascript">

    $(".toggle-password").click(function() {



  $(this).toggleClass("fa-eye fa-eye-slash");

  var input = $($(this).attr("toggle"));

  if (input.attr("type") == "password") {

    input.attr("type", "text");

  } else {

    input.attr("type", "password");

  }

});

</script>

@endsection