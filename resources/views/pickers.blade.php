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
              <h2>Picking Personnel</h2>
            </div>
            <div>
              <button type="button" class="btn btn-primary btn-create pull-right" data-toggle="modal" data-target="#modal-picker-create"><i class="fa fa-plus"></i>Add</button>
            </div>
          </div>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th class="text-center"> No </th>
                <th class="text-center"> Name </th>
                <th class="text-center"> Action </th>
              </tr>
            </thead>
            <tbody>
              <?php $i = 0; ?>
              @foreach($pickers as $picker)
              <?php $i++; ?>
              <tr>
                <td class="text-center">{{$i}}</td>
                <td class="text-center picker-name"> {{$picker->name}} </td>
                <td class="text-center" picker_id="{{$picker->id}}">
                  <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-warning btn-edit" style="width: 80px;"><i class="fa fa-edit"></i>edit</button>
                    <button class="btn btn-sm btn-danger btn-delete" style="width: 80px; "><i class="fa fa-trash"></i>delete</button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $pickers->appends(request()->input())->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal-picker-create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title pull-left">Create Personnel</h4>
      </div>
      <form id="form-create-picker" action="{{url('/create_picker')}}" method="post" oninput='password_confirm.setCustomValidity(password.value != password_confirm.value ? "Passwords do not match." : "")'>
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control"  placeholder="Personnel Name">
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
<div id="modal-picker-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title pull-left">Edit Personnel</h4>
      </div>
      <form id="form-edit-picker" action="{{url('/edit_picker')}}" method="post">
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="inputId">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
              <input id="input-name-edit" type="text" name="name" class="form-control" placeholder="Personnel Name">
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

  $(document).ready(function(){
    $('#form-create-picker').validate({
      rules: {
        name: "required",
      }
    });

    $('#form-edit-picker').validate({
      rules: {
        name: "required",
      }
    });

    $('.btn-edit').click(function(){
      $('#inputId').val($(this).closest('td').attr('picker_id'));
      $('#input-name-edit').val($(this).closest('tr').find('.picker-name').text());
      $('#modal-picker-edit').modal();
    })

    $('.btn-delete').click(function(){
      var picker_id = $(this).closest('td').attr('picker_id');
      if(confirm('Are you sure to delete this picker?')){
        document.location = '/delete_picker?id=' + picker_id;
      }
    })
    
  });

</script>
@endsection