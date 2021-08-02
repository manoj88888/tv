@extends('layouts.admin')
@section('title',__('adminstaticwords.StaticTranslation'))
@section('content')
<div class="box admin-form-main-block mrg-t-40">
	<div class="box-header with-border">
		<a title="Cancel and go back" href="{{ url()->previous() }}" class=" btn-floating">
			<i class="material-icons">reply</i></a>
		</a>
		<div class="box-title">{{__('adminstaticwords.StaticWordTranslationsForLanguage')}}: {{ $findlang->name }}
		</div>
	</div>

	<ul class="nav nav-tabs">
	   <li class="active"><a data-toggle="tab" href="#home">{{__('adminstaticwords.FrontEndTranslation')}}</a></li>
	   <li><a data-toggle="tab" href="#menu1">{{__('adminstaticwords.BackEndTranslation')}}</a></li>
	</ul>
	<br/> 
	<div class="callout callout-info">
		<i class="fa fa-info-circle"></i> {{__('adminstaticwords.LanguageInstruction')}}
	</div>
	<div class="tab-content">
	    <div id="home" class="tab-pane fade in active">
		   	<form action="{{ route('static.trans.update',$findlang->local) }}" method="POST">
		   	@csrf
				<div class="box-body">
						
					<textarea name="transfile" class="form-control" name="" id="" cols="100" rows="20">{{ $file }}</textarea>
				</div>
				<div class="box-footer">

					 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
					
					<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Update')}}</button>

				</div>
			</form>
	    </div>
	   <div id="menu1" class="tab-pane fade">
		    <div id="home" class="tab-pane fade in active">
			   	<form action="{{ route('static.admin.trans.update',$findlang->local) }}" method="POST">
			   	@csrf
					<div class="box-body">
						<textarea name="admintransfile" class="form-control" id="" cols="100" rows="20">{{ $adminfile }}</textarea>
					</div>
					<div class="box-footer">

						 <button type="reset" class="btn btn-info"><i class="material-icons left">toys</i> {{__('adminstaticwords.Reset')}}</button>
						
						<button type="submit" class="btn btn-success"><i class="material-icons left">add_to_photos</i> {{__('adminstaticwords.Update')}}</button>

					</div>
				</form>
		    </div>
	   </div>
	
	</div>


		
</div>
@endsection