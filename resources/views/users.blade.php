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
              <h2>User Management</h2>
            </div>
            <div>
              <button type="button" class="btn btn-primary btn-create pull-right" data-toggle="modal" data-target="#modal-user-create"><i class="fa fa-plus"></i>Add</button>
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
              @foreach($users as $user)
              <?php $i++; ?>
              <tr>
                <td class="text-center">{{$i}}</td>
                <td class="text-center user-name"> {{$user->name}} </td>
                <td class="text-center" user_id="{{$user->id}}">
                  <div class="btn-group" role="group">
                    <button class="btn btn-sm btn-warning btn-edit" style="width: 80px;"><i class="fa fa-edit"></i>edit</button>
                    <button class="btn btn-sm btn-danger btn-delete" style="width: 80px; "><i class="fa fa-trash"></i>delete</button>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          {{ $users->appends(request()->input())->links() }}
        </div>
      </div>
    </div>
  </div>
</div>

<div id="modal-user-create" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title pull-left">Create User</h4>
      </div>
      <form id="form-create-user" action="{{url('/create_user')}}" method="post" oninput='password_confirm.setCustomValidity(password.value != password_confirm.value ? "Passwords do not match." : "")'>
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
              <input type="text" name="name" class="form-control"  placeholder="User Name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input id="password-create" type="password" name="password" class="form-control" >
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="password_confirm" class="form-control" >
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
<div id="modal-user-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title pull-left">Edit User</h4>
      </div>
      <form id="form-edit-user" action="{{url('/edit_user')}}" method="post">
        <div class="modal-body">
          <input type="hidden" name="_token" value="{{csrf_token()}}">
          <input type="hidden" name="id" id="inputId">
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">User Name</label>
            <div class="col-sm-10">
              <input id="input-name-edit" type="text" name="name" class="form-control" placeholder="User Name">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
              <input id="password-edit" type="password" name="password" class="form-control">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-sm-2 col-form-label">Password Confirm</label>
            <div class="col-sm-10">
              <input type="password" name="password_confirm" class="form-control">
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
    $('#form-create-user').validate({
      rules: {
        name: "required",
        password: {
          required: true,
          minlength: 8
        },
        password_confirm: {
          required: true,
          minlength: 8,
          equalTo: "#password-create"
        }
      }
    });

    $('#form-edit-user').validate({
      rules: {
        name: "required",
        password: {
          required: true,
          minlength: 8
        },
        password_confirm: {
          required: true,
          minlength: 8,
          equalTo: "#password-edit"
        }
      }
    });

    $('.btn-edit').click(function(){
      $('#inputId').val($(this).closest('td').attr('user_id'));
      $('#input-name-edit').val($(this).closest('tr').find('.user-name').text());
      $('#modal-user-edit').modal();
    })

    $('.btn-delete').click(function(){
      var user_id = $(this).closest('td').attr('user_id');
      if(confirm('Are you sure to delete this user?')){
        document.location = '{{url("/delete_user?id=")}}' + user_id;
      }
    })
    
  });

</script>
@endsection