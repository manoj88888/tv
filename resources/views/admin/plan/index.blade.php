@extends('layouts.admin')
@section('title',__('adminstaticwords.ChangeSubscription'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
    </div>
    <div class="content-block box-body">
      <table id="plan_table" class="table table-hover">
        <thead>
          <tr class="table-heading-row">
            
            <th>{{__('adminstaticwords.ID')}}</th>
            <th>{{__('adminstaticwords.Name')}}</th>
            <th>{{__('adminstaticwords.Email')}}</th>
            <th>{{__('adminstaticwords.Plans')}}</th>
            <th>{{__('adminstaticwords.Sub.Expire')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>
        <tbody>
          
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
      
      var table = $('#plan_table').DataTable({
          processing: true,
          serverSide: true,
           responsive: true,
         autoWidth: false,
         scrollCollapse: true,
       
          ajax: "{{ route('plan.index') }}",
          columns: [
              {data: 'DT_RowIndex', name: 'DT_RowIndex'},
              {data: 'username', name: 'username'},
              {data : 'useremail', name: 'useremail'},
              {data : 'planname', name: 'planname'},
              {data : 'subscription_to', name : 'subscription_to'},
              {data : 'action', name: 'action'}
      
          ],
          dom : 'lBfrtip',
          buttons : [
            'csv','excel','pdf','print'
          ],
          order : [[0,'DESC']]
      });
      
    });
  </script>
@endsection
