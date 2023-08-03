@extends('layouts.admin.template');

@section('content')
<section class="section">
    <div class="section-header">
        <h1>User Configuration</h1>
    
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Account</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 col-xl-4">
                        <div class="row align-items-center">
                            <div class="col-xl-8 col-md-8 mx-auto"> 
                                @if($users['id_level'] > 1)
                                    @if($users['id_level'] != 2)
                                    <div class="badge badge-info m-1"><div>Guest</div></div> 
                                    @else
                                    <div class="badge badge-primary m-1"><div>Admin</div></div> 
                                    @endif
                                @else
                                <div class="badge badge-warning text-dark m-1"><div>Super Admin</div></div> 
                                @endif
                                <div id="ImagesProfile">
                                    <img src="{{url('images/' .$users['profile'])}}" style="border-radius: 10%;object-fit:cover" alt="" width="210px" height="210px">
                                </div>
                                <div class="text-left m-3">
                                    <div><strong>Join Date:</strong></div>
                                    <div><strong>{{ $users['created_at'] }}</strong></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-8">
                        <input type="hidden" id="id" value="{{ $users['id']}}">
                        <div class="form-group">
                          <label for="username">Username</label>
                          <label class="float-right text-primary"><a onclick="ChangePassword()" class="toggle">Change Password ?</a></label>
                          <input type="text" class="form-control" id="username" placeholder="" value="{{ $users['username']}}" disabled>
                        </div>
                        <div class="form-change-password">
                        <form action="" id="form-password">
                            <div class="form-group">
                                <label for="oldPassword">Old Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="oldPassword" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="newPassword">New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="newPassword" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="confirmPassword">Confirm New Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" id="confirmPassword" placeholder="">
                                <div class="invalid-feedback not-match"></div>
                            </div>
                            <div class="form-check mt-2">
                                <input type="checkbox" class="form-check-input" value="1" id="show-pw">
                                <label class="form-check-label" for="show-pw">Show Password</label>
                            </div>
                            <div class="float-right"> 
                                <button class="btn btn-primary btn-update-pw">Update</button>
                            </div>
                        </form>
                        </div>
                        <div class="form-input">
                            <form enctype="multipart/form-data" id="form-input">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{ $users['id']}}">
                            <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="" value="{{ $users['name'] }}">
                            </div>
                            <div class="form-group">
                            <label for="profile">Profile Image</label>
                            <input type="file" class="form-control-file" name="profile" id="profile">
                            </div>
                            <div class="float-right"> 
                                <button class="btn btn-primary btn-update">Update</button>
                            </div>
                            </form>
                        </div>
                    </div>
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


    $('#form-input').submit(function(){
        var id = $('#id').val()
        var name = $('#name').val()
        var profile = $('#profile').val()
        
        $.ajax({
        method: 'post',
        dataType: 'json',
        url : `{{route('admin.user-update')}}`,
        contentType: false,
        processData: false,
        data: new FormData(this),
        beforeSend: function() {
                    $('.btn-update').attr('disable', 'disabled')
                    $('.btn-update').html("<i class='fa fa-spin fa-spinner'></i> Loading")
        },
        complete: function() {
                    $('.btn-update').removeAttr('disable')
                    $('.btn-update').html("Update")
        },
        success: function(response){
            console.log(response);
            iziToast.success({
                            position: 'topRight',
                            title: 'Success',
                            message: 'Successfully updated record!',
            });
            $("#ImagesProfile").load(location.href + " #ImagesProfile");        
        },
         error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
                }
                
        })
        return false;
    })

    $(document).ready(function(){
        $('.form-change-password').hide()
    })
    function ChangePassword(){
        if($('.toggle').html() != 'Back'){
            $('.form-change-password').show()
            $('.form-input').hide()
            $('.toggle').html('Back')
            $('#confirmPassword').removeClass('is-invalid');
        }else{
            $('.form-change-password').hide()
            $('.form-input').show()
            $('.toggle').html('Change Password ?')
            $('#form-password').trigger('reset')
        }
    }

    $('#show-pw').on('change', function() {
        if ($('#confirmPassword').attr('type') == "password" && $('#newPassword').attr('type') == "password") {
            $('#confirmPassword').attr('type', 'text');
            $('#newPassword').attr('type', 'text');
            $('#toggle-eye').removeClass('fa-eye-slash')
            $('#toggle-eye').addClass('fa-eye')
        } else {
            $('#confirmPassword').attr('type', 'password');
            $('#newPassword').attr('type', 'password');
            $('#toggle-eye').removeClass('fa-eye')
            $('#toggle-eye').addClass('fa-eye-slash')
        }
    })

    $('#newPassword, #confirmPassword').on('keyup', function() {
        if ($('#confirmPassword').val() != '' && $('#newPassword') != '') {
            if ($('#newPassword').val() == $('#confirmPassword').val()) {
                $('#confirmPassword').addClass('is-valid');
                $('#confirmPassword').removeClass('is-invalid');
            } else {
                $('#confirmPassword').addClass('is-invalid');
                $('.not-match').html('Password not match')
                $('#confirmPassword').removeClass('is-valid');
            }
        } else {
            $('#confirmPassword').removeClass('is-valid');
            $('#confirmPassword').removeClass('is-invalid');
        }
    });
</script>
@endsection