@extends('layouts.admin')
@section('title',__('adminstaticwords.Reports'))
@section('content')
  <div class="content-main-block mrg-t-40">
    <h4 class="admin-form-text">{{__('adminstaticwords.AllReports')}}</h4>
    <div class="content-block box-body">
      <table id="full_detail_table" class="table table-hover">
        <thead>
        <tr class="table-heading-row">
          <th>#</th>
          <th>{{__('adminstaticwords.Date')}}</th>
          <th>{{__('adminstaticwords.SubscribedPackage')}}</th>
          <th>{{__('adminstaticwords.PaidAmount')}}</th>
          <th>{{__('adminstaticwords.Method')}}</th>
          <th>{{__('adminstaticwords.User')}}</th>
        </tr>
        </thead>
        <tbody>
          @if (isset($all_reports) && count($all_reports->data) > 0)
            @php
              $sell = null;
            @endphp
            @foreach ($all_reports->data as $key => $report)
              @php
                \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
               
                $customer_id = \Stripe\Customer::retrieve($report->customer);
                $user = Illuminate\Support\Facades\DB::table('users')->where('email', '=', $customer_id->email)->first();
                $sell = $sell + (($report->plan->amount/100));
              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>
                  {{date('d/m/Y',$report->items->data[0]->created)}}
                </td>
                <td>
                  {{$report->items->data[0]->plan->id}}
                </td>
                <td>
                  <i class="{{$currency_symbol}}"></i> {{$report->plan->amount/100}}
                </td>
                <td>
                  Stripe
                </td>
                <td>
                  @if (isset($user))
                    {{$user->name ? $user->name : ''}}
                  @else
                   {{__('adminstaticwords. UserRemoved')}}
                  @endif
                </td>
              </tr>
            @endforeach
          @endif
          @if (isset($paypal_subscriptions) && count($paypal_subscriptions) > 0)
            @foreach ($paypal_subscriptions as $key => $item)
              @php
                $sell = 0;
                $date = $item->created_at->toDateString();
                //$sells = $sell + $item->price; 

              @endphp
              <tr>
                <td>
                  {{$key+1}}
                </td>
                <td>
                  {{$date}}
                </td>
                <td>
                  {{$item->plan ? $item->plan->name : 'N/A'}}
                </td>
                <td>
                  <i class="{{$currency_symbol}}"></i> {{$item->price}}
                </td>
                <td>
                  Paypal
                </td>
                <td>
                  {{$item->user ? $item->user->name : 'N/A'}}
                </td>
              </tr>
            @endforeach
          @endif
        </tbody>
      </table>
      <br/>
      <br/>
      <div class="total-sell" style="margin-top: 20px">
        <h5>{{__('adminstaticwords.TotalSells')}} <i class="{{$currency_symbol}}"></i>{{isset($sells) ? $sells : ''}}</h5>
      </div>
    </div>
  </div>
@endsection
