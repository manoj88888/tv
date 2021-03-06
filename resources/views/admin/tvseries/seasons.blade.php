@extends('layouts.admin')
@section('title',__('adminstaticwords.ManageSeason'))
@section('content')
<div class="admin-form-main-block mrg-t-40">
  <h4 class="admin-form-text"><a href="{{url('admin/tvseries')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.ManageSeasons')}} <span>{{__('adminstaticwords.Of')}}{{$tv_series->title}}
    @if ($tv_series->tmdb == 'Y')
      <span class="min-info">{!!$tv_series->tmdb == 'Y' ? '<i class="material-icons">check_circle</i> by tmdb' : ''!!}</span>
    @endif
  </span></h4>
  <div class="admin-create-btn-block">
    <a id="createButton" onclick="showCreateForm()" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateSeason')}}</a>
  </div>
  <div class="row">
    <div class="col-md-6">
      <div class="admin-form-block z-depth-1">
        <div id="createForm">
          {!! Form::open(['method' => 'POST', 'action' => 'TvSeriesController@store_seasons', 'files' => true]) !!}
            <div class="form-group{{ $errors->has('season_no') ? ' has-error' : '' }}">
              <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
              {!! Form::label('season_no', __('adminstaticwords.SeasonNo.')) !!}
              {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
              <small class="text-danger">{{ $errors->first('season_no') }}</small>
            </div>
            <div class="form-group{{ $errors->has('season_slug') ? ' has-error' : '' }}">
              {!! Form::label('season_slug',__('adminstaticwords.SeasonSlug')) !!}
              {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
              <small class="text-danger">{{ $errors->first('season_slug') }}</small>
            </div>
            <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
                {!! Form::label('a_language', __('adminstaticwords.AudioLanguages')) !!}
                <p class="inline info"> - {{__('adminstaticwords.PleaseSelectAudioLanguage')}}</p>
                <div class="input-group">
                  {!! Form::select('a_language[]', $a_lans, null, ['class' => 'form-control select2', 'multiple']) !!}
                  <a href="#" data-toggle="modal" data-target="#AddLangModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                </div>
                <small class="text-danger">{{ $errors->first('a_language') }}</small>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch for-custom-image">
                    {!! Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
            </div>
            <div class="upload-image-main-block">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                    {!! Form::label('thumbnail', __('adminstaticwords.Thumbnail')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
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
                    {!! Form::label('poster',__('adminstaticwords.Poster')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
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

            <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    <input type="checkbox" name="is_protect" class="checkbox-switch" id="is_protect">
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('is_protect') }}</small>
              </div>
            </div>
            <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="display: none;">
              {!! Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')) !!}
              {!! Form::password('password', null, ['class' => 'form-control','id'=>'password']) !!}
              <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
             
            </div>
             <small class="text-danger">{{ $errors->first('password') }}</small>
          
            {{ Form::hidden('tv_series_id', $id) }}
            <div class="switch-field">
              <div class="switch-title">{{__('adminstaticwords.WantIMDBRatingsAndMoreOrCustom')}}?</div>
              <input type="radio" id="switch_left" class="imdb_btn" name="tmdb" value="Y" checked/>
              <label for="switch_left">{{__('adminstaticwords.TMDB')}}</label>
              <input type="radio" id="switch_right" class="custom_btn" name="tmdb" value="N" />
              <label for="switch_right">{{__('adminstaticwords.Custom')}}</label>
            </div>
            <div id="custom_dtl" class="custom-dtl">
              <div class="form-group{{ $errors->has('actor_id') ? ' has-error' : '' }}">
                  {!! Form::label('actor_id', __('adminstaticwords.Actors')) !!}
                  <p class="inline info"> - {{__('adminstaticwords.PleaseSelectTvseriesSeasonsActor')}}</p>
                  {!! Form::select('actor_id[]', $actor_ls, null, ['class' => 'form-control select2', 'multiple']) !!}
                  <small class="text-danger">{{ $errors->first('actor_id') }}</small>
              </div>
              <div class="form-group{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                {!! Form::label('publish_year', __('adminstaticwords.PublishYear')) !!}
                {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                <small class="text-danger">{{ $errors->first('publish_year') }}</small>
              </div>
              <div class="form-group{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                {!! Form::label('trailer_url',__('adminstaticwordsTrailerURL')) !!}
                {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('adminstaticwords.PleaseEnterTrailerUrl')]) !!}
                <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
              </div>
              <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                {!! Form::label('detail', __('adminstaticwords.Description')) !!}
                {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('detail') }}</small>
              </div>
            </div>
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Create')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
        @if(isset($seasons))
          @foreach($seasons as $key => $season)
            @php
                $all_languages = App\AudioLanguage::all();
                // get old audio language values
                $old_lans = collect();
                $a_lans = collect();
                if ($season->a_language != null){
                  $old_list = explode(',', $season->a_language);
                  for ($i = 0; $i < count($old_list); $i++) {
                    $old1 = App\AudioLanguage::find($old_list[$i]);
                    if ( isset($old1) ) {
                      $old_lans->push($old1);
                    }
                  }
                }
                $a_lans = $all_languages->diff($old_lans);
               

            @endphp
            <div id="editForm{{$season->id}}" class="edit-form">
              {!! Form::model($season, ['method' => 'PATCH', 'files' => true, 'action' => ['TvSeriesController@update_seasons', $season->id]]) !!}
               <input type="hidden" name="tvseries" value="{{$tv_series->title}}">
                <div class="form-group{{ $errors->has('season_no') ? ' has-error' : '' }}">
                  {!! Form::label('season_no', __('adminstaticwords.SeasonNo.')) !!}
                  {!! Form::number('season_no', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_no') }}</small>
                </div>
                <div class="form-group{{ $errors->has('season_slug') ? ' has-error' : '' }}">
                  {!! Form::label('season_slug',__('adminstaticwords.SeasonSlug')) !!}
                  {!! Form::text('season_slug', null, ['class' => 'form-control', 'min' => '0']) !!}
                  <small class="text-danger">{{ $errors->first('season_slug') }}</small>
                </div>
                {{ Form::hidden('tv_series_id', $id) }}
                <div class="form-group{{ $errors->has('a_language') ? ' has-error' : '' }}">
                  {!! Form::label('a_language', __('adminstaticwords.AudioLanguages')) !!}
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
               
                <div class="form-group">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::label('', __('adminstaticwords.ChooseCustomThumbnailAndPoster')) !!}
                    </div>
                    <div class="col-xs-5 pad-0">
                      <label class="switch for-custom-image">
                        {!! Form::checkbox('', 1, 0, ['class' => 'checkbox-switch']) !!}
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                </div>
                <div class="upload-image-main-block">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('thumbnail') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('thumbnail',__('adminstaticwords.Thumbnail')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
                        {!! Form::file('thumbnail', ['class' => 'input-file', 'id'=>'thumbnail'.$season->id]) !!}
                        <label for="thumbnail{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Thumbnail')}}">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
                        </label>
                        <p class="info">{{__('adminstaticwords.ChooseCustomThumbnail')}}</p>
                        <small class="text-danger">{{ $errors->first('thumbnail') }}</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group{{ $errors->has('poster') ? ' has-error' : '' }} input-file-block">
                        {!! Form::label('poster', __('adminstaticwords.Poster')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
                        {!! Form::file('poster', ['class' => 'input-file', 'id'=>'poster'.$season->id]) !!}
                        <label for="poster{{$season->id}}" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Poster')}}">
                          <i class="icon fa fa-check"></i>
                          <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
                        </label>
                        <p class="info">{{__('adminstaticwords.ChooseCustomPoster')}}</p>
                        <small class="text-danger">{{ $errors->first('poster') }}</small>
                      </div>
                    </div>
                  </div>
                </div>
                
                <div class="form-group{{ $errors->has('is_protect') ? ' has-error' : '' }}">
                  <div class="row">
                    <div class="col-xs-6">
                      {!! Form::label('is_protect', __('adminstaticwords.ProtectedVideo?')) !!}
                    </div>
                    <div class="col-xs-5 pad-0">
                      <label class="switch">
                        <input type="checkbox" name="is_protect" {{ $season->is_protect == 1 ? 'checked' : '' }} class="checkbox-switch" id="is_protect">
                        <span class="slider round"></span>
                      </label>
                    </div>
                  </div>
                  <div class="col-xs-12">
                    <small class="text-danger">{{ $errors->first('is_protect') }}</small>
                  </div>
                </div>
                <div class="search form-group{{ $errors->has('password') ? ' has-error' : '' }} is_protect" style="{{ $season->is_protect == 1 ? '' : 'display:none' }}">
                  {!! Form::label('password', __('adminstaticwords.ProtectedPasswordForVideo')) !!}
                  <input type="password" id="password" name="password" value="{{ $season->password }}" class="form-control">
                  <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                  
                </div>
                <small class="text-danger">{{ $errors->first('password') }}</small>

                <div class="switch-field">
                  <div class="switch-title">{{__('adminstaticwords.WantIMDBRatingsAndMoreOrCustom')}}?</div>
                  <input type="radio" id="switch_left{{$season->id}}" class="imdb_btn" name="tmdb" value="Y" {{$season->tmdb == 'Y' ? 'checked' : ''}}/>
                  <label for="switch_left{{$season->id}}" onclick="hide_custom({{$season->id}})">{{__('adminstaticwords.TMDB')}}</label>
                  <input type="radio" id="switch_right{{$season->id}}" class="custom_btn" name="tmdb" value="N" {{$season->tmdb != 'Y' ? 'checked' : ''}}/>
                  <label for="switch_right{{$season->id}}" onclick="show_custom({{$season->id}})">{{__('adminstaticwords.Custom')}}</label>
                </div>
                <div id="custom_dtl{{$season->id}}" class="custom-dtl">
                  @php
                    // get old actor list
                    $actor_ls = App\Actor::all();
                    $old_actor = collect();
                    if ($season->actor_id != null){
                      $old_list = explode(',', $season->actor_id);
                      for ($i = 0; $i < count($old_list); $i++) {
                        $old3 = App\Actor::find(trim($old_list[$i]));
                        if ( isset($old3) ) {
                          $old_actor->push($old3);
                        }
                      }
                    }
                    $old_actor = $old_actor->filter(function($value, $key) {
                      return  $value != null;
                    });
                    $actor_ls = $actor_ls->diff($old_actor);

                  @endphp

                  <div class="form-group{{ $errors->has('actor_id') ? ' has-error' : '' }}">
    									{!! Form::label('actor_id', __('adminstaticwords.Actors')) !!}
                      <p class="inline info"> - {{__('adminstaticwords.PleaseSelectTvseriesSeasonsActor')}}</p>
                      <div class="input-group">
                        <select name="actor_id[]" id="actor_id" class="form-control select2" multiple="multiple">
                          @if(isset($old_actor) && count($old_actor) > 0)
                            @foreach($old_actor as $old)
                              <option value="{{$old->id}}" selected="selected">{{$old->name}}</option>
                            @endforeach
                          @endif
                          @if(isset($actor_ls))
                            @foreach($actor_ls as $rest)
                              <option value="{{$rest->id}}">{{$rest->name}}</option>
                            @endforeach
                          @endif
                        </select>
                        <a href="#" data-toggle="modal" data-target="#AddActorModal" class="input-group-addon"><i class="material-icons left">add</i></a>
                      </div>
    									<small class="text-danger">{{ $errors->first('actor_id') }}</small>
    							</div>


                  <div class="form-group{{ $errors->has('publish_year') ? ' has-error' : '' }}">
                    {!! Form::label('publish_year', __('adminstaticwords.PublishYear')) !!}
                    {!! Form::number('publish_year', null, ['class' => 'form-control', 'min' => '0']) !!}
                    <small class="text-danger">{{ $errors->first('publish_year') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('trailer_url') ? ' has-error' : '' }}">
                    {!! Form::label('trailer_url',__('adminstaticwords.TrailerURL')) !!}
                    {!! Form::text('trailer_url', null, ['class' => 'form-control','placeholder'=>__('adminstaticwords.PleaseEnterTrailerUrl')]) !!}
                    <small class="text-danger">{{ $errors->first('trailer_url') }}</small>
                  </div>
                  <div class="form-group{{ $errors->has('detail') ? ' has-error' : '' }}">
                    {!! Form::label('detail',__('adminstaticwords.Description')) !!}
                    {!! Form::text('detail', null, ['class' => 'form-control']) !!}
                    <small class="text-danger">{{ $errors->first('detail') }}</small>
                  </div>
                </div>
                <div class="btn-group pull-right">
                  <button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i>{{__('adminstaticwords.UpdateSeason')}}</button>
                </div>
                <div class="clear-both"></div>
              {!! Form::close() !!}
            </div>
          @endforeach
        @endif
      </div>
    </div>
    <div class="col-md-6">
      <div class="admin-form-block content-block z-depth-1">
        <table class="table table-hover">
          <thead>
          <tr class="table-heading-row side-table">
            <th>#</th>
            <th>{{__('adminstaticwords.Thumbnail')}}</th>
            <th>{{__('adminstaticwords.Season')}}</th>
            <th>{{__('adminstaticwords.Episodes')}}</th>
            <th>{{__('adminstaticwords.ByTMDB')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
          </thead>
          @if ($seasons)
            <tbody>
            @foreach ($seasons as $key => $season)
              <tr>
                <td>{{$key+1}}</td>
                <td>
                  @if ($season->thumbnail != null)
                    <img src="{{ asset('images/tvseries/thumbnails/'.$season->thumbnail) }}" width="45px" class="img-responsive" alt="image">
                   
                  @endif
                </td>
                <td>
                  Season {{$season->season_no}}
                </td>
                <td>
                  @if (isset($season->episodes) && count($season->episodes) > 0)
                    {{count($season->episodes)}} episodes
                  @else
                    N/A
                  @endif
                </td>
                <td>{!!$season->tmdb == 'Y' ? '<i class="material-icons done">done</i>' : '-'!!}</td>
                <td>
                  <div class="admin-table-action-block side-table-action">
                    <a id="editButton{{$season->id}}" onclick="showForms({{$season->id}})" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <a href="{{route('show_episodes', $season->id)}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.ManageEpisodes')}}" class="btn-success btn-floating"><i class="material-icons">settings</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$season->id}}deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="{{$season->id}}deleteModal" class="delete-modal modal fade" role="dialog">
                <div class="modal-dialog modal-sm">
                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <div class="delete-icon"></div>
                    </div>
                    <div class="modal-body text-center">
                      <h4 class="modal-heading">{{__('adminstaticwords.AreYouSure')}}</h4>
                      <p>{{__('adminstaticwords.DeleteWarrning')}}</p>
                    </div>
                    <div class="modal-footer">
                      {!! Form::open(['method' => 'DELETE', 'action' => ['TvSeriesController@destroy_seasons', $season->id]]) !!}
                      {!! Form::reset(__('adminstaticwords.No'), ['class' => 'btn btn-gray', 'data-dismiss' => 'modal']) !!}
                      {!! Form::submit(__('adminstaticwords.Yes'), ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
            </tbody>
          @endif
        </table>
      </div>
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
        <h5 class="modal-title">{{__('adminstaticwords.AddActor')}}</h5>
      </div>
      {!! Form::open(['method' => 'POST', 'action' => 'ActorController@store', 'files' => true]) !!}
        <div class="modal-body admin-form-block">
          <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              {!! Form::label('name',__('adminstaticwords.Name')) !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
              <small class="text-danger">{{ $errors->first('name') }}</small>
          </div>
          <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }} input-file-block">
            {!! Form::label('image', __('adminstaticwords.Image')) !!} - <p class="inline info">{{__('adminstaticwords.HelpBlockText')}}</p>
            {!! Form::file('image', ['class' => 'input-file', 'id'=>'image']) !!}
            <label for="image" class="btn btn-danger js-labelFile" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Image')}}">
              <i class="icon fa fa-check"></i>
              <span class="js-fileName">{{__('adminstaticwords.ChooseAFile')}}</span>
            </label>
            <p class="info">{{__('adminstaticwords.ChooseCustomImage')}}</p>
            <small class="text-danger">{{ $errors->first('image') }}</small>
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
          {!! Form::label('language',__('adminstaticwords.Language')) !!}
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
@endsection

@section('custom-script')
  <script>
    $(document).ready(function(){
      $('#createForm').siblings().hide();
      $('.custom-dtl').hide();
      $('.upload-image-main-block').hide();
      $('.subtitle_list').hide();
      $('input[name="subtitle"]').click(function(){
        if($(this).prop("checked") == true){
          $('.subtitle_list').fadeIn();
        }
        else if($(this).prop("checked") == false){
          $('.subtitle_list').fadeOut();
        }
      });
    });

    $('input[name="is_protect"]').click(function(){
      if($(this).prop("checked") == true){
        $('.is_protect').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.is_protect').fadeOut();
      }
    }); 

    $('.for-custom-image input').click(function(){
      if($(this).prop("checked") == true){
        $('.upload-image-main-block').fadeIn();
      }
      else if($(this).prop("checked") == false){
        $('.upload-image-main-block').fadeOut();
      }
    });
    let showCreateForm = () => {
      $('#createForm').show().siblings().hide();
    };
    let showForms = (id) => {
      let editForm = '#editForm' + id;
      $(editForm).show().siblings().hide();
      var custom_dtl = '#custom_dtl'+id;
      var custom_check = '#switch_right'+id;
      if ($(custom_check).is(':checked')) {
        $(custom_dtl).show();
      }
    };
    let hide_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).hide();
    };
    let show_custom = (id) => {
      var custom_dtl = '#custom_dtl'+id;
      $(custom_dtl).show();
    };
  </script>
  
<script>
     $(document).ready(function() {
  var SITEURL = '{{URL::to('')}}';

 
        $.ajax({
            type: "GET",
            url: SITEURL + "/admin/tvshow/upload_video/converting",
            success: function (data) {
           console.log('Success:',data);
            },
            error: function (data) {
                console.log('Error:', data);
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
