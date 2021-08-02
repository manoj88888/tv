@extends('layouts.admin')
@section('title',__('adminstaticwords.CreatePackage'))
@section('content')
  <div class="admin-form-main-block mrg-t-40">  
    <h4 class="admin-form-text"><a href="{{url('admin/packages')}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.GoBack')}}" class="btn-floating"><i class="material-icons">reply</i></a> {{__('adminstaticwords.CreatePackage')}}</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="admin-form-block z-depth-1">
          {!! Form::open(['method' => 'POST', 'action' => 'PackageController@store']) !!}
            <div class="form-group{{ $errors->has('plan_id') ? ' has-error' : '' }}">
                {!! Form::label('plan_id', __('adminstaticwords.PlanID')) !!}
                <p class="inline info"> - {{__('adminstaticwords.UniquePackage')}}</p>
                {!! Form::text('plan_id', null, ['class' => 'form-control', 'required' => 'required', 'data-toggle' => 'popover','data-content' => __('adminstaticwords.UniquePackage').' ex. basic10', 'data-placement' => 'bottom']) !!}
                <small class="text-danger">{{ $errors->first('plan_id') }}</small>
            </div>
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                {!! Form::label('name', __('adminstaticwords.PackageName')) !!}
                <p class="inline info"> - {{__('adminstaticwords.PleaseEnterYourPlanName')}}</p>
                {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                <small class="text-danger">{{ $errors->first('name') }}</small>
            </div>
  			    {!! Form::hidden('currency', $currency_code) !!}
    
            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                {!! Form::label('amount', __('adminstaticwords.YourPlanAmount')) !!}
                <p class="inline info"> -{{__('adminstaticwords.PlanAmountMinMax')}}</p>
                <div class="input-group">
                  <span class="input-group-addon simple-input"><i class="{{$currency_symbol}}"></i></span>
                  {!! Form::number('amount', null, ['min' => 1, 'step'=>'0.01', 'class' => 'form-control', 'required' => 'required']) !!}  
                </div>
                <input type="text" name="currency_symbol" id="currency_symbol" value="{{$currency_symbol}}" hidden="true">
                <small class="text-danger">{{ $errors->first('amount') }}</small>
            </div>

           <div class="row">
            <div class="col-lg-12">
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('interval_count') ? ' has-error' : '' }}">
                        {!! Form::label('interval_count', __('adminstaticwords.YourPlanDuration')) !!}
                        <p class="inline info"> - {{__('adminstaticwords.PleaseEnterPlanDuration')}} </p>
                        {!! Form::number('interval_count', null, ['min' => 1, 'class' => 'form-control', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('interval_count') }}</small>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group{{ $errors->has('interval') ? ' has-error' : '' }}">
                        {!! Form::label('interval', __('adminstaticwords.PlanDurationUnit')) !!}
                        <p class="inline info"> - {{__('adminstaticwords.PlanDurationUnitDescription')}}</p>
                        {!! Form::select('interval', ['day'=>'Daily', 'week' => 'Weekly', 'month' => 'Monthly', 'year' => 'yearly'], ['month' => 'Monthly'], ['class' => 'form-control select2', 'required' => 'required']) !!}
                        <small class="text-danger">{{ $errors->first('interval') }}</small>
                     </div>
                </div> 
             </div>   
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
                        <input type="checkbox" class="filled-in material-checkbox-input one" name="menu[]" value="{{$menu->id}}" id="checkbox{{$menu->id}}">
                        <label for="checkbox{{$menu->id}}" class="material-checkbox"></label>
                      </div>
                      {{$menu->name}}
                    </li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="form-group{{ $errors->has('trial_period_days') ? ' has-error' : '' }}">
                {!! Form::label('trial_period_days', __('adminstaticwords.YourPlanTrailPeriodDays')) !!}
                <p class="inline info"> - {{__('adminstaticwords.YourPlanTrailPeriodDaysDescription')}}</p>
                {!! Form::number('trial_period_days', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{ $errors->first('trial_period_days') }}</small>
            </div>
            
            <div class="form-group{{ $errors->has('screen') ? ' has-error' : '' }}">
                {!! Form::label('screen', __('adminstaticwords.Screens')) !!}
                <p class="inline info"> - {{__('adminstaticwords.ScreensDescription')}}</p>
                {!! Form::number('screens', null, ['class' => 'form-control', 'min' => '1', 'max' => '4']) !!}
                <small class="text-danger">{{ $errors->first('screen') }}</small>
            </div>

            <!-----------  for download limit ------------------>

            <div class="form-group{{ $errors->has('download') ? ' has-error' : '' }}">
              <div class="row">
                <div class="col-xs-6">
                  {!! Form::label('download', __('adminstaticwords.DoYouWantDownloadLimit')) !!}
                </div>
                <div class="col-xs-5 pad-0">
                  <label class="switch">
                    {!! Form::checkbox('download', 1, 0, ['class' => 'checkbox-switch seriescheck','id'=>'download_enable']) !!}
                    <span class="slider round"></span>
                  </label>
                </div>
              </div>
              <div class="col-xs-12">
                <small class="text-danger">{{ $errors->first('download') }}</small>
              </div>
            </div>
            <small class="text-danger">{{ $errors->first('downloadlimit') }}</small>
            <div id="downloadlimit" class="form-group{{ $errors->has('downloadlimit') ? ' has-error' : '' }}" style="display:none">
                {!! Form::label('downloadlimit', __('adminstaticwords.DownloadLimit')) !!}
                <p class="inline info"> - {{__('adminstaticwords.DoYouWantDownloadLimitDescription')}}</p>
                {!! Form::number('downloadlimit', null, ['class' => 'form-control']) !!}
                <small class="text-danger">{{__('adminstaticwords.Note')}} :- {{__('adminstaticwords.DownloadNote')}}.</small>
                
            </div>

            <!--------------- end download limit ------------------->

            <div class="form-group{{ $errors->has('status') ? ' has-error' : '' }}">
                {!! Form::label('status', 'Status') !!}
                <p class="inline info"> -{{__('adminstaticwords.PleaseSelectStatus')}}</p>
                {!! Form::select('status', array('0' => __('adminstaticwords.Inactive'), '1' => __('adminstaticwords.Active')), null, ['class' => 'form-control select2', 'placeholde' => '']) !!}
                <small class="text-danger">{{ $errors->first('status') }}</small>
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
<script>
$('#download_enable').on('change',function(){
  if($('#download_enable').is(':checked')){
    //show
    $('#downloadlimit').show();
  }else{
    //hide
     $('#downloadlimit').hide();
  }
});
</script>
@endsection