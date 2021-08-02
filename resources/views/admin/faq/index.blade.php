@extends('layouts.admin')
@section('title',__('adminstaticwords.AllFAQs'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <div class="admin-create-btn-block">
      <a href="{{route('faqs.create')}}" class="btn btn-danger btn-md"><i class="material-icons left">add</i> {{__('adminstaticwords.CreateFaq')}}</a>
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
              {!! Form::open(['method' => 'POST', 'action' => 'FaqController@bulk_delete', 'id' => 'bulk_delete_form']) !!}
                <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content-block box-body table-responsive">
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
            <th>{{__('adminstaticwords.FaqQuestion')}}</th>
            <th>{{__('adminstaticwords.FaqAnswer')}}</th>
            <th>{{__('adminstaticwords.CreatedAt')}}</th>
            <th>{{__('adminstaticwords.UpdatedAt')}}</th>
            <th>{{__('adminstaticwords.Actions')}}</th>
          </tr>
        </thead>
        @if ($faqs)
          <tbody>
            @php ($no = 1)
            @foreach ($faqs as $faq)
              <tr>
                <td>
                  <div class="inline">
                    <input type="checkbox" form="bulk_delete_form" class="filled-in material-checkbox-input" name="checked[]" value="{{$faq->id}}" id="checkbox{{$faq->id}}">
                    <label for="checkbox{{$faq->id}}" class="material-checkbox"></label>
                  </div>
                  {{$no}}
                  @php ($no++)
                </td>
                <td>{!! $faq->question !!}</td>
                <td>{!! $faq->answer !!}</td>
                <td>{{date('F d, Y',strtotime($faq->created_at))}}</td>
                <td>{{date('F d, Y',strtotime($faq->updated_at))}}</td>
                <td>
                  <div class="admin-table-action-block">
                    <a href="{{route('faqs.edit', $faq->id)}}" data-toggle="tooltip" data-original-title="Edit" class="btn-info btn-floating"><i class="material-icons">mode_edit</i></a>
                    <button type="button" class="btn-danger btn-floating" data-toggle="modal" data-target="#{{$faq->id}}deleteModal"><i class="material-icons">delete</i> </button>
                  </div>
                </td>
              </tr>
              <!-- Delete Modal -->
              <div id="{{$faq->id}}deleteModal" class="delete-modal modal fade" role="dialog">
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
                      {!! Form::open(['method' => 'DELETE', 'action' => ['FaqController@destroy', $faq->id]]) !!}
                          <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">{{__('adminstaticwords.No')}}</button>
                          <button type="submit" class="btn btn-danger">{{__('adminstaticwords.Yes')}}</button>
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
@endsection