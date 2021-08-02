@extends('layouts.admin')
@section('title',__('adminstaticwords.AllMenus'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('menu.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateMenu')}}</a>
      {{-- <a href="{{url('admin/update-to-english')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> Update Genre to english</a> --}}
      <!-- Delete Modal -->
      <a type="button" class="btn btn-danger btn-md z-depth-0" data-toggle="modal" data-target="#bulk_delete"><i class="material-icons left">delete</i> {{__('adminstaticwords.DeleteSelected')}}</a>   
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
              {!! Form::open(['method' => 'POST', 'action' => 'MenuController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <p class="info">{{__('adminstaticwords.DragAnDrop')}}</p>
    <div class="content-block box-body">
      <table id="menutable" class="table table-hover db">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              
            </th>
            <th>{{__('adminstaticwords.Menu')}}</th>
            <th>{{__('adminstaticwords.CreatedAt')}}</th>
            <th>{{__('adminstaticwords.UpdatedAt')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>
        @if ($menus)
          <tbody>
        
          </tbody>
        @endif
      </table>
    </div>
  </div>
@endsection
@section('custom-script')
 <script>
    $(function () {
      
      var table = $('#menutable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('menu.index') }}",
          columns: [

               {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
               {data: 'name', name: 'name'},
               {data: 'created_at', name: 'created_at'},
               {data: 'updated_at', name: 'updated_at'},
            
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
    var app = new Vue({});
      $('table.db tbody').sortable({
        cursor: "move",
        revert: true,
        placeholder: 'sort-highlight',
        connectWith: '.connectedSortable',
        forcePlaceholderSize: true,
        zIndex: 999999,
        axis: 'y',
        update: function(event, ui) {
          var data = $(this).sortable('serialize');
          app.$http.post('{{route('menu_reposition')}}', {item: data}).then((response) => {
            console.log(data);
            
            console.log(response);
          }).catch((e) => {
            console.log($(this).sortable('serialize'));
            console.log(e);
            console.log('err');
          });
        }
      });
      $(window).resize(function() {
        $('table.db tr').css('min-width', $('table.db').width());
      });
  </script>
@endsection