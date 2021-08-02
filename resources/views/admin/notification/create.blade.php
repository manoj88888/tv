@extends('layouts.admin')
@section('title',__('adminstaticwords.CreateNotification'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">
    <h4 class="admin-form-text"><a href="{{url('admin')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreateNotification')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'NotificationController@store']) !!}
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                {!! Form::label('title', __('adminstaticwords.NotificationTitle')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterNotificationTitle')}}"></i>
                {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('title') }}</small>
            </div>
             <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                {!! Form::label('description', __('adminstaticwords.NotificationDescription')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseEnterNotificationDescription')}}"></i>
                {!! Form::text('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('description') }}</small>
            </div>
            @php
            $movie=App\Movie::orderBy('created_at', 'desc')
              
               ->get();;
            @endphp
            <div class="form-group{{ $errors->has('movie_id') ? ' has-error' : '' }}">
                {!! Form::label('movie_id', __('adminstaticwords.SelectMovies')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectMovieLatest15MoviesYouAddedAreVisible')}}"></i>
                
                <select class="form-control select2" name="movie_id" >
                  <option value="">{{__('adminstaticwords.PleaseSelect')}}</option>
                  @foreach($movie as $movies)
                   
                  <option value="{{$movies->id}}" name="{{$movies->id}}">{{$movies->title}}</option>
                  @endforeach
                </select>
              
                <small class="text-danger">{{ $errors->first('movie_id') }}</small>
            </div>
             @php
            $livetv=App\Movie::orderBy('created_at', 'desc')->where('live',1)
             
               ->get();;
            @endphp
            <div class="form-group{{ $errors->has('livetv') ? ' has-error' : '' }}">
                {!! Form::label('livetv', __('adminstaticwords.SelectLiveTv')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectMovieLatest15MoviesYouAddedAreVisible')}}"></i>
                
                <select class="form-control select2" name="livetv">
                   <option value="">{{__('adminstaticwords.PleaseSelect')}}</option>
                  @foreach($livetv as $movies)
                   
                  <option value="{{$movies->id}}" name="{{$movies->id}}">{{$movies->title}}</option>
                  @endforeach
                </select>
              
                <small class="text-danger">{{ $errors->first('livetv') }}</small>
            </div>

            @php
            $tv=App\TvSeries::orderBy('created_at', 'desc')
             
               ->get();

           
            @endphp
            <div class="form-group{{ $errors->has('tv_id') ? ' has-error' : '' }}">
                {!! Form::label('tv_id', __('adminstaticwords.SelectTvSeries')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectTvSeriesLatest15TvSeriesYouAddedAreVisible')}}"></i>
               
                <select class="form-control select2" name="tv_id">
                   <option value="">{{__('adminstaticwords.PleaseSelect')}}</option>

                     @foreach($tv as $tvs)
                     @php
                      $seasons=App\Season::where('tv_series_id',$tvs->id)->first();
                     @endphp
                      @if(isset($seasons) )
                  <option value="{{$seasons->id}}" name="{{$seasons->id}}">{{$tvs->title}}</option>
                  @endif
                @endforeach
                </select>
                
                <small class="text-danger">{{ $errors->first('tv_id') }}</small>
            </div>
            @php
            $audio = App\Audio::orderby('id', 'desc')->get();
           
            @endphp
            <div class="form-group{{ $errors->has('audio_id') ? ' has-error' : '' }}">
                {!! Form::label('radio_id', __('adminstaticwords.SelectRadioSeries')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectTvSeriesLatest15TvSeriesYouAddedAreVisible')}}"></i>
               
                <select class="form-control select2" name="audio_id">
                   <option value="">{{__('adminstaticwords.PleaseSelect')}}</option>

                     @foreach($audio as $aud)
                    
                  <option value="{{$aud->id}}" name="{{$aud->id}}">{{$aud->title}}</option>
                @endforeach
                </select>
                
                <small class="text-danger">{{ $errors->first('audio_id') }}</small>
            </div>
            @php
            $user=App\User::all();
            @endphp
             <div class="form-group{{ $errors->has('user_id') ? ' has-error' : '' }}">
                {!! Form::label('user_id', __('adminstaticwords.SelectUsers')) !!}
                <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="{{__('adminstaticwords.PleaseSelectUsersYouCanSelectMultipeUsers')}}"></i>
                <select class="form-control select2" name="user_id[]" multiple="true" required="true">
                  <option value="0">{{__('adminstaticwords.AllUsers')}}</option>
                     @foreach($user as $users)
                  <option value="{{$users->id}}">{{$users->name}}</option>
                    @endforeach
                </select>
                <small class="text-danger">{{ $errors->first('user_id') }}</small>
            </div>
            
            <div class="btn-group pull-right">
              <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
              <button type="submit" class="btn btn-success"><i class="material-icons left">near_me</i> {{__('adminstaticwords.Send')}}</button>
            </div>
            <div class="clear-both"></div>
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
@endsection
