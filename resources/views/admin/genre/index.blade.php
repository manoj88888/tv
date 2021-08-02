@extends('layouts.admin')
@section('title',__('adminstaticwords.AllGenres'))
@section('content')

  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('genres.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateGenre')}}</a>
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
              {!! Form::open(['method' => 'POST', 'action' => 'GenreController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <table id="genreTable" class="table table-hover" style="width:100%">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              
            </th>
            <th>{{__('adminstaticwords.Sort')}}</th>
            <th>{{__('adminstaticwords.Image')}}</th>
            <th>{{__('adminstaticwords.GenreName')}}</th>
            <th>{{__('adminstaticwords.CreatedAt')}}</th>
             <th>{{__('adminstaticwords.UpdatedAt')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>

        <tbody id="tablecontents">
          
        </tbody>
        
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
      "use strict";

      var table = $('#genreTable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('genres.index') }}",
          columns: [
              
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
               {data: 'sort', name: 'sort'},
               {data: 'image', name: 'image'},
              {data: 'name', name: 'name'},
               
                {data: 'created_at', name: 'created_at'},
            
            {data: 'updated_at', name: 'updated_at'},
            
              {data: 'action', name: 'action',searchable: false}
             
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ]
          
      });

      $( "#tablecontents" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

        function sendOrderToServer() {

          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });

          $.ajax({
            type: "GET", 
            dataType: "json", 
            url: "{{ url('genre-sort') }}",
            data: {
               order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }

      
    });
  </script>
@endsection
