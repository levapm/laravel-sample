@extends('layout.master')
@section('main-panel')
<div class="content-wrapper">
  <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-description">
            <div class="control-pannel">
              <h2>Picking Process Summary</h2>
              <label id="datetime" class="control-label"></label>
            </div>
            <div>
              <a href="{{url('/dashboard')}}" class="btn btn-primary pull-right"><i class="fa fa-refresh"></i>Refresh</a>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center"> Quantity of Items to be Picked </th>
                <th class="text-center" style="width:14%;"> Cost of Items to be Picked </th>
                <th class="text-center" style="width:14%;"> Quantity of Items Picked until Now </th>
                <th class="text-center" style="width:14%;"> Remaining Quantity </th>
                <th class="text-center" style="width:14%;"> Remaining Percent </th>
                <th class="text-center" style="width:16%;"> Quantity Picked per Hour </th>
                <th class="text-center" style="width:16%;"> Average finish time </th>
              </tr>
            </thead>
            <tbody>
              <tr class="stats">
                <td class="text-center">{{$data['quantityToBePicked']}}</td>
                <td class="text-center">{{$data['costToBePicked']}}</td>
                <td class="text-center">{{$data['quantityPickedUntilNow']}}</td>
                <td class="text-center">{{$data['quantityRemaining']}}</td>
                <td class="text-center">{{$data['remainingPercent']}}</td>
                <td class="text-center">{{$data['quantityPickedPerHour']}}</td>
                <td class="text-center">{{$data['averageFinishTime']}}</td>
              </tr>
            </tbody>
          </table>
          {{ $pickers->links() }}
        </div>
      </div>
    </div>
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <div class="card-description">
            <div class="control-pannel">
              <h2>Picker Personnel Summary</h2>
              <label id="datetime" class="control-label"></label>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center"> Picker Personnel </th>
                <th class="text-center"> Total Quantity </th>
                <th class="text-center"> Quantity Picked until Now </th>
                <th class="text-center"> Quantity currently Picking </th>
                <th class="text-center"> Remaining Quantity </th>
                <th class="text-center"> Remaining Percent </th>
              </tr>
            </thead>
            <tbody>
              @foreach($data['pickerInfoes'] as $info)
              <tr class="stats">
                <td class="text-center">{{$info['name']}}</td>
                <td class="text-center">{{$info['totalQuantity']}}</td>
                <td class="text-center">{{$info['pickedQuanty']}}</td>
                <td class="text-center">{{$info['currentlyPicking']}}</td>
                <td class="text-center">{{$info['remaining']}}</td>
                <td class="text-center">{{$info['percentRemaining']}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('script')
<script>
  var now = new Date();
  var year = now.getFullYear();
  var month = now.getMonth() + 1;
  var date = now.getDate();
  var hours = now.getHours();
  var minutes = now.getMinutes();
  var strDate = "DATE: " + date + "/" + month + "/" + year;
  var strTime = "TIME: " + hours + ":" + minutes;
  var datetime = strDate + " " + strTime;
  $('#datetime').text(datetime);

</script>
@endsection