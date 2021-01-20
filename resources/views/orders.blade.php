@extends('layout.master')
@section('main-panel')
<div class="content-wrapper">
  <!-- <div class="row">
    <div class="searchbox">
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card control-pannel">
    </div>
  </div> -->
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">

          <div class="card-description">
            <div class="control-pannel">
              <h2>Orders</h2>
              <label id="last_update" class="control-label"></label>
              <label id="every" class="control-label">Every {{Session::get('update_interval', '5')}} min</label>
            </div>
            <form action="{{url('/assign_order')}}" method="get" class="searchbox">
              <label class="control-label">Customer Name</label>
              <input class="form-control" name="customer_name" value="{{$data['customer_name']}}">
              <label class="control-label">Picking Personnel</label>
              <input class="form-control" name="picker" value="{{$data['picker']}}">
              <label class="control-label">Status</label>
              <select class="form-control" name="status">
                <option value="all"> All </option>
                <option value="not_assigned" @if($data['status']=="not_assigned" ) selected @endif>Not Assigned</option>
                <option value="not_started" @if($data['status']=="not_started" ) selected @endif>Not Started</option>
                <option value="picking" @if($data['status']=="picking" ) selected @endif>Picking</option>
                <option value="finished" @if($data['status']=="finished" ) selected @endif>Finished</option>
              </select>
              <button type="submit" class="btn btn-primary btn-search pull-right">Search</button>
            </form>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th> Custommer Name </th>
                <th> Total Quantity </th>
                <th> Total Cost </th>
                <th> Picking Personnel </th>
                <th> Assign Time </th>
                <th> Start Time </th>
                <th> End Time </th>
                <th> Elapsed Time </th>
                <th> Note </th>
              </tr>
            </thead>
            <tbody class="tbl-orders">
              @foreach($records as $record)
              @if(empty($record->assign_time))
              <tr class="table-danger">
              @elseif(!empty($record->assign_time) && empty($record->start_time))
              <tr class="table-warning">
              @elseif(!empty($record->start_time) && empty($record->end_time))
              <tr class="table-primary">
              @else
              <tr class="table-success">
              @endif
                <td class="py-1 td-customer_name">{{$record->customer_name}}</td>
                <td class="td-quantity"> {{$record->quantity}} </td>
                <td class="td-total_cost">{{$record->total_cost}}</td>
                <td class="td-picker_id" picker_id="{{$record->picker_id}}"><?php if (!empty($record->picker_id)) echo App\Picker::find($record->picker_id)->name; ?></td>
                <td> {{$record->assign_time}} </td>
                <td>{{$record->start_time}}</td>
                <td>{{$record->end_time}}</td>
                <td>{{$record->elapsed_time}}</td>
                <td>{{$record->note}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $records->appends(request()->input())->links() }}
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
var local_timer = setInterval(setLabel, 1000 * 1);

function setLabel() {
  $('#last_update').text("Update Time " + update_time);
}
</script>
@endsection