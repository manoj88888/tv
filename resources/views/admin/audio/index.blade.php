@extends('layouts.admin')
@section('title',__('adminstaticwords.AllAudio'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('audio.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateAudio')}}</a>
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
              {!! Form::open(['method' => 'POST', 'action' => 'AudioController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body">
      <table id="audioTable" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            <th>
              <div class="inline">
                <input id="checkboxAll" type="checkbox" class="filled-in" name="checked[]" value="all" id="checkboxAll">
                <label for="checkboxAll" class="material-checkbox"></label>
              </div>
              #
            </th>
            <th>{{__('adminstaticwords.Thumbnail')}}</th>
            <th>{{__('adminstaticwords.AudioTitle')}}</th>
            <th>{{__('adminstaticwords.Featured')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>
          @if ($audio)
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
      
      var table = $('#audioTable').DataTable({
          processing: true,
          serverSide: true,
         responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
         
          ajax: "{{ route('audio.index') }}",
          columns: [
              
              {data: 'checkbox', name: 'checkbox',orderable: false, searchable: false},
            
              {data: 'thumbnail', name: 'thumbnail'},
              {data: 'title', name: 'title'},
           
              {data: 'featured', name: 'featured',searchable: false},
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
  </script>
@endsection