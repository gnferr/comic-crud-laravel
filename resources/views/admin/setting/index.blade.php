@extends('layouts.admin.template')

@section('content')
<section class="section">
    <div class="section-header d-flex justify-content-between">
        <h1>Users List</h1>
        <button class="btn btn-primary" id="addButton" onclick="Create()"><i class="fas fa-plus"></i> Create</button>
    </div>
    <div class="section-body">
       <div class="card" id="form-input">
        <div class="card-header">
            <h4>Create New Account</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="username">Username <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="username" placeholder="Enter username...">
                <div class="invalid-feedback UsernameError"></div>
            </div>
            <div class="row">
                <div class="form-group col">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" placeholder="Enter name...">
                    <div class="invalid-feedback NameError"></div>
                </div>
                <div class="form-group col">
                    <label for="level">Level </label>
                    <select name="level" id="level" class="form-control">
                        <option value="2">Admin</option>
                        <option value="3">Guest</option>
                    </select>
                </div>
            </div>
            <div class="text-warning">
                <i>* Password default : guest12345</i>
            </div>
            {{-- <div class="row">
                <div class="form-group col">
                    <label for="name">Password</label>
                    <input type="text" class="form-control" id="name" placeholder="" value="Jhon Doe">
                </div>
                <div class="form-group col">
                    <label for="name">Confirm Password</label>
                    <input type="text" class="form-control" id="name" placeholder="" value="Jhon Doe">
                </div>
            </div> --}}
            <div class="float-right">
             <button class="btn btn-secondary" onclick="clearField()">Reset</button>
             <button class="btn btn-primary" id="buttonCreate">Submit</button>
            </div>
        </div>
       </div>
       <div class="card">
        <div class="card-header">
            <h4>List</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table" id="table-users" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Name</th>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      {{-- <tr>
                        <th scope="row">1</th>
                        <td>Jhon Doe</td>
                        <td>jhondoe22x</td>
                        <td>2023-07-28 19:03:46</td>
                        <td>
                            <div>
                                <button class="btn btn-primary"><i class="fas fa-edit"></i></button>
                                <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                      </tr> --}}
                    </tbody>
                  </table>
            </div>
        </div>
       </div>
    </div>
</section>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    $(document).ready(function(){
        $('#table-users').dataTable({
            ajax: "{{route('admin.user-list')}}",
            columns: [{
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'avatar',
                    name: 'avatar'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'level',
                    name: 'level'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
        })
    })

    $('#buttonCreate').click(function(){
        var username = $('#username').val()
        var name = $('#name').val()
        var level = $('#level').val()

        $.ajax({
            method: 'post',
            url: '{{route('admin.user-create')}}',
            dataType: 'json',
            data: {
                username:username,
                name:name,
                level:level
            },
            beforeSend: function() {
                    $('#buttonCreate').attr('disable', 'disabled')
                    $('#buttonCreate').html("<i class='fa fa-spin fa-spinner'></i> Loading")
            },
            complete: function() {
                        $('#buttonCreate').removeAttr('disable')
                        $('#buttonCreate').html("Create")
            },
            success:function(response){
                console.log(response);
                clearField()
                iziToast.success({
                            position: 'topRight',
                            title: 'Success',
                            message: 'Successfully inserted record!',
                });
                $('#table-users').DataTable().ajax.reload();
            },
            error: function(response) {
                console.log(response);
                if(response.responseJSON.errors.username){
                        $('.UsernameError').html(response.responseJSON.errors.username[0])
                        $('#username').addClass('is-invalid')
                    }else{
                        $('.UsernameError').html('')
                        $('#username').removeClass('is-invalid')
                    }
                    if(response.responseJSON.errors.name){
                        $('.NameError').html(response.responseJSON.errors.name[0])
                        $('#name').addClass('is-invalid')
                    }else{
                        $('.NameError').html('')
                        $('#name').removeClass('is-invalid')
                    }
            }
        })
        return false;
    })


    $(document).ready(function(){
        $('#form-input').hide()
        // console.log($('#addButton').prop('outerText').replace(' ',''));
    })
    function Create(){
        if($('#addButton').prop('outerText').replace(' ','') != 'Close'){
            // console.log('1');
            $('#form-input').show()
            $('#addButton').html("<i class='fas fa-undo'></i> Close")
            $('#addButton').removeClass('btn-primary').addClass('btn-danger')
        } else {
            // console.log('2');
            $('#form-input').hide()
            $('#addButton').html("<i class='fas fa-plus'></i> Create")
            $('#addButton').removeClass('btn-danger').addClass('btn-primary')
        }
    }

    function clearField(){
        $('#username').val('')
        $('#name').val('')
    }
</script>
@endsection