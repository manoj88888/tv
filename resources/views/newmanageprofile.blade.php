@extends('layouts.theme')
@section('title','User Dashboard')
@section('main-wrapper')
<style>
    .activeScreen {
        background-color: #2eb82e !important;
        cursor: pointer;
    }
    
    .column-container {
      cursor:pointer !important;
    }
</style>


    <div class="container" style="padding:0;background-color:white;width:100%;">
        <!-- Content -->
        <h1 style="font-size:large;" class="title"><b>MANAGE YOUR PROFILE</b></h1>
        
        <ul class="menu" style="padding-left:28px;">
            <li><a href="{{ url('account') }}">Overview</a></li>
            <li><a href="{{ url('/manageprofile/mus/'.Auth::user()->id)}} " class="menu-item-active">Profiles</a></li>
        </ul>
        
        @if(!isset($result))
		    <h4 style="color:black;padding-left:28px;">{{ __('staticwords.noprofileavailable') }}</h4>
        @else
            <h4> Hey {{ Auth::user()->name }} select your personal profile and start browsing AlphaTV: </h4>
        @endif
    </div>
    
    <div class="jumbotron flex-bx" style="background-color:white;">
        @if(isset($result->screen1))
            @if($result->screen1 == $result->activescreen)
                <div class="container activeScreen column-container" style="height: 60px;">
            @else
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('{{ $result->screen1 }}','{{ 1 }}')">
            @endif
                <div class="column">
                    <b class="icon-avatar">1</b><span>{{ $result->screen1 }}</span>
                    <span data-toggle="modal" data-target="#EditScreen1Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        @endif
        
        @if(isset($result->screen2))
            @if($result->screen2 == $result->activescreen)
                <div class="container activeScreen column-container" style="height: 60px;">
            @else
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('{{ $result->screen2 }}','{{ 2 }}')">
            @endif
                <div class="column">
                    <b class="icon-avatar">2</b><span>{{ $result->screen2 }}</span>
                    <span data-toggle="modal" data-target="#EditScreen2Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        @endif
        
        @if(isset($result->screen3))
            @if($result->screen3 == $result->activescreen)
                <div class="container activeScreen column-container" style="height: 60px;">
            @else
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('{{ $result->screen3 }}','{{ 3 }}')">
            @endif
                <div class="column">
                    <b class="icon-avatar">3</b><span>{{ $result->screen3 }}</span>
                    <span data-toggle="modal" data-target="#EditScreen3Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        @endif
        
        @if(isset($result->screen4))
            @if($result->screen4 == $result->activescreen)
                <div class="container activeScreen column-container" style="height: 60px;">
            @else
                <div class="container background-white column-container" style="height: 60px;" onclick="changescreen('{{ $result->screen4 }}','{{ 4 }}')">
            @endif
                <div class="column">
                    <b class="icon-avatar">4</b><span>{{ $result->screen4 }}</span>
                    <span data-toggle="modal" data-target="#EditScreen4Modal" class="glyphicon glyphicon-pencil icon-edit"></span>
                </div>
            </div>
        @endif
    </div>

<!--------------------- Edit Screen1 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen1Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 1</b></h4>
                </div>
                <div class="modal-body">
                    <form action="{{ route('mus.pro.update', Auth::user()->id) }}" method="POST"> 
                    {{ csrf_field() }}
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 1 Name</label>
                            @if(isset($result->screen1))
                                <input type="text" class="form-control screenName" id="usr1" name="screen1" value="{{ $result->screen1 }}" />
                            @else
                                <input type="text" class="form-control screenName" id="usr1" name="screen1" value="" />
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn full-btn background-gray" style="background-color: #050076;" value="Update Me">
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen1 Modal End ------------------------->

<!--------------------- Edit Screen2 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen2Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 2</b></h4>
                </div>
                <form action="{{ route('mus.pro.update',Auth::user()->id) }}" method="POST">
				{{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 2 Name</label>
                            @if(isset($result->screen2))
                                <input type="text" class="form-control screenName" id="usr2" name="screen2" value="{{ $result->screen2 }}" />
                            @else
                                <input type="text" class="form-control screenName" id="usr2" name="screen2" value="" />
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen2 Modal End ------------------------->

<!--------------------- Edit Screen3 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen3Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 3</b></h4>
                </div>
                <form action="{{ route('mus.pro.update',Auth::user()->id) }}" method="POST">
				{{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 3 Name</label>
                            @if(isset($result->screen3))
                                <input type="text" class="form-control screenName" id="usr2" name="screen3" value="{{ $result->screen3 }}" />
                            @else
                                <input type="text" class="form-control screenName" id="usr2" name="screen3" value="" />
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen3 Modal End ------------------------->

<!--------------------- Edit Screen4 Modal Start ------------------------->
    <div class="modal fade" id="EditScreen4Modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                    &times;
                    </button>
                    <h4 class="modal-title"><b>Edit Screen 4</b></h4>
                </div>
                <form action="{{ route('mus.pro.update',Auth::user()->id) }}" method="POST">
				{{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usr" class="text-gray">Screen 4 Name</label>
                            @if(isset($result->screen4))
                                <input type="text" class="form-control screenName" id="usr4" name="screen4" value="{{ $result->screen4 }}" />
                            @else
                                <input type="text" class="form-control screenName" id="usr4" name="screen4" value="" />
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn full-btn background-gray" style="background-color: #050076;"> Update </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!--------------------- Edit Screen4 Modal End ------------------------->
@endsection

{{--
@section('custom-script')
	<script>
        $('#EditScreen1Modal, #EditScreen2Modal, #EditScreen3Modal, #EditScreen4Modal').on('hidden.bs.modal', function (e) {
          $(this).find(".screenName").val('').end();
        })
	</script>
@endsection
--}}

@section('custom-script')
<script>
	function changescreen(screen,count){
    console.log(screen, count);
    
		$.ajax({
			type : 'GET',
			data : {screen : screen, count : count},
			url  : '{{ url('/changescreen/'.Auth::user()->id) }}',
			success : function(data){
				console.log(data);
				location.reload(); 
			}
		});
	}
</script>
@endsection