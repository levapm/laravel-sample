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
              <h2>Assign Order</h2>
              <label id="last_update" class="control-label"></label>
              <label id="every" class="control-label">Every</label>
              <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle btn-sync-minutes" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{Session::get('update_interval', '5')}} </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                  <a class="dropdown-item update-interval" href="#">5</a>
                  <a class="dropdown-item update-interval" href="#">10</a>
                  <a class="dropdown-item update-interval" href="#">15</a>
                  <a class="dropdown-item update-interval" href="#">20</a>
                  <a class="dropdown-item update-interval" href="#">30</a>
                </div>
              </div>
              <label id="min">min</label>
              <button class="btn btn-primary btn-update"><i class="fa fa-refresh"></i>Update Now</button>
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
          <table class="table table-hover">
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
                <th> Edit </th>
              </tr>
            </thead>
            <tbody>
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
                <td>
                  <button class="btn btn-sm btn-edit btn-warning" order_id="{{$record->id}}"><i class="fa fa-edit"></i>edit</button>
                </td>
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
<div id="modal-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title pull-left">Edit Order</h4>
      </div>
      <form action="{{url('/edit_order')}}" method="post">
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="inputId">
          <div class="form-group row">
            <label for="inputCustomer" class="col-sm-2 col-form-label">Customer Name</label>
            <div class="col-sm-10">
              <input type="text" name="customer_name" class="form-control" id="inputCustomer" placeholder="Customer Name" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputQuantity" class="col-sm-2 col-form-label">Total Quantity</label>
            <div class="col-sm-10">
              <input type="text" name="quantity" class="form-control" id="inputQuantity" placeholder="Total Quantity" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="inputCost" class="col-sm-2 col-form-label">Total Quantity</label>
            <div class="col-sm-10">
              <input type="text" name="total_cost" class="form-control" id="inputCost" placeholder="Total Quantity" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label for="selectPicker" class="col-sm-2 col-form-label">Picking Personnel</label>
            <div class="col-sm-10">
              <select class="form-control" name="picker_id" id="selectPicker">
                @foreach($data['pickers'] as $picker)
                <option value="{{$picker->id}}">{{$picker->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ok</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
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

  $('.update-interval').click(function() {
    // $('.btn-sync-minutes').text($(this).text());
    $.post('{{url("/set_interval")}}', {
        _token: "{{csrf_token()}}",
        interval: $(this).text()
      })
      .done(function(res) {
        $('.btn-sync-minutes').text(res.interval);
        update_interval = parseInt(res.interval);
        clearInterval(timer);
        timer = setInterval(sendRequest, 1000 * 60 * update_interval);
        toastr.success("Update interval has been changed.");
      })
      .fail(function() {
        toastr.error("Update interval hasn't been changed");
      });
  });

  $('.btn-edit').click(function() {
    var customer_name = $(this).closest('tr').find('.td-customer_name').text();
    var quantity = $(this).closest('tr').find('.td-quantity').text();
    var total_cost = $(this).closest('tr').find('.td-total_cost').text();
    var picker_id = $(this).closest('tr').find('.td-picker_id').attr('picker_id');
    $('#inputCustomer').val(customer_name);
    $('#inputQuantity').val(quantity);
    $('#inputCost').val(total_cost);
    $('#selectPicker').val(picker_id);
    $('#inputId').val($(this).attr('order_id'));
    $('#modal-edit').modal();
  });

  $('.btn-update').click(function(){
  //  sendRequest();
    document.location = document.location;
  })
</script>
@endsection