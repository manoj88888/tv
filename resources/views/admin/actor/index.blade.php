@extends('layouts.admin')
@section('title',__('adminstaticwords.AllActors'))
@section('content')
<div class="content-main-block mrg-t-40">
  <div class="admin-create-btn-block">
    <a href="{{route('actors.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateActor')}}</a>
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
            {!! Form::open(['method' => 'POST', 'action' => 'ActorController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
            <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content-block box-body table-responsive">
    <table id="actorTable" class="table table-hover">
      <thead>
        <tr class="table-heading-row">
          <th>
            <div class="inline">
              <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
              <label for="checkboxAll" class="material-checkbox"></label>
            </div>
            #
          </th>
            <th>{{__('adminstaticwords.Image')}}</th>
            <th>{{__('adminstaticwords.Name')}}</th>
            <th>{{__('adminstaticwords.Biography')}}</th>
            <th>{{__('adminstaticwords.BirthPlace')}}</th>
      
            <th>{{__('adminstaticwords.Actions')}}</th>
        </tr>
      </thead>
      @if ($actors)
      <tbody>
       
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
  $(function () {

    var table = $('#actorTable').DataTable({
      processing: true,
      serverSide: true,
      responsive: true,
      autoWidth: false,
      scrollCollapse: true,


      ajax: "{{ route('actors.index') }}",
      columns: [

      {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
      {data: 'image', name: 'image'},
      {data: 'name', name: 'name'},
      {data: 'biography', name: 'biography'},
      {data: 'place_of_birth', name: 'place_of_birth'},

      {data: 'action', name: 'action',searchable: false}

      ],
      dom : 'lBfrtip',
      buttons : [
      'csv','excel','pdf','print'
      ],
      order : [[0,'desc']]
    });

  });
</script>
@endsection