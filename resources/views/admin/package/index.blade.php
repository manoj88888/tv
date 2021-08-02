@extends('layouts.admin')
@section('title',__('adminstaticwords.AllPackages'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('packages.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreatePackage')}}</a>
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>
      <!-- Modal -->
      <div id="bulk_delete" class="delete-modal modal fade" role="dialog">
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
              {!! Form::open(['method' => 'POST', 'action' => 'PackageController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('adminstaticwords.PackageName')}}</th>
            <th>{{__('adminstaticwords.Amount')}}</th>
            <th>{{__('adminstaticwords.Interval')}}</th>
            <th>{{__('adminstaticwords.IntervalCount')}}</th>
            <th>{{__('adminstaticwords.TrailPeriod')}}</th>
            <th>{{__('adminstaticwords.Status')}}</th>
           
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>
        @if ($packages)
          <tbody>
            @foreach ($packages as $key => $package)
           {{--  @if($package->delete_status == 0) --}}

              <tr>
                <td>
                @if($package->status == 0)
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$package->id}}" id="checkbox{{$package->id}}">
                    <label for="checkbox{{$package->id}}" class="material-checkbox"></label>
                  </div>
                @endif
                  {{$key+1}}
                </td>
                <td>{{$package->name}}</td>
                <td><i class="{{$package->currency_symbol}}"></i>{{$package->amount}}</td>
                <td>{{$package->interval}}</td>
                <td>{{$package->interval_count}}</td>
                <td>{{$package->trial_period_days}}</td>
                <td>
                    <form action="{{ route('pkgstatus',$package->id) }}" method="POST">
                      {{ csrf_field() }}
                    @if($package->status == 0)
                    <input type="hidden" value="1" name="status">
                    <button type="submit" class="btn btn-sm btn-danger">{{__('adminstaticwords.Deactive')}}</button>
                    @else
                    <input type="hidden" value="0" name="status">
                    <button type="submit" class="btn btn-sm btn-success">{{__('adminstaticwords.Active')}}</button>
                    @endif
                    </form>
                </td>
                <td>
                  <div class="admin-table-action-block">
                    @if($package->status == 0)
                      <a href="{{route('packages.edit', $package->id)}}" data-toggle="tooltip" data-original-title="{{__('adminstaticwords.Edit')}}" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$package->id}}deleteModal"><i class="material-icons">delete</i> </button>
                    @else
                      <a  data-toggle="tooltip" data-original-title="{{__('adminstaticwords.RestorePackage')}}" style="cursor: not-allowed" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                      
                    @endif
                  </div>
                </td>
              </tr>
              {{-- @endif --}}
              <!-- Delete Modal -->
              <div id="{{$package->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                      {!! Form::open(['method' => 'DELETE', 'action' => ['PackageController@softDelete', $package->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                          <input type="submit" class="btn btn-danger" value="{{__('adminstaticwords.Yes')}}">
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
@endsection
@section('custom-script')
  <script>
    $(function(){
      $('#checkboxAll').on('change', function(){
        if($(this).prop("checked") == true){
          $('.material-checkbox-input').attr('checked', true);
        }
        else if($(this).prop("checked") == false){
          $('.material-checkbox-input').attr('checked', false);
        }
      });
    });
  </script>

  <script>
    $(function() {
      $('#cb3').change(function() {
        $('#status').val(+ $(this).prop('checked'))
      })
    })
  </script>

  
@endsection
