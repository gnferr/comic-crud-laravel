@extends('layouts.admin.template');

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Comic</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-md-6 col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>List Data</h4>
                        <button class="btn btn-primary" id="flip-card-insert"><i class="fas fa-plus"></i> Add</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table" id='table-comic' width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Cover</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Genre</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($comic as $key => $val)
                                        <tr>
                                            <td>{{ $key + 1}}</td>
                                            <td><img src="{{$val->cover}}" width="50px"></td>
                                            <td data-toggle="tooltip" title="{{$val->title}}">{{$val->title}}</td>
                                            <td title="{{$val->type}}">{{$val->type}}</td>
                                            <td data-toggle="tooltip" title="{{$val->genre}}"" style=" max-width: 150px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;">{{$val->genre}}</td>
                                            <td data-toggle="tooltip" title="{{$val->description}}"" style=" max-width: 150px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;">{{$val->description}}
                                            </td>
                                            <td>
        
                                                <div class='dropdown'>
                                                    <button class='btn btn-primary dropdown-toggle' type='button' id='dropdownMenuButton2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                        Action
                                                    </button>
                                                    <div class='dropdown-menu'>
                                                        <a class='dropdown-item has-icon' data-target='#UpdateData' data-toggle='modal' data-backdrop='static'><i class='fas fa-info text-warning'></i> Detail</a>
                                                        <a class='dropdown-item has-icon flip-card-btn-turn-to-back' id="update-comic" data-id='{{$val->id}}' data-title='{{$val->title}}' data-type='{{$val->type}}' data-genre='{{$val->genre}}' data-description='{{$val->description}}' data-cover='{{$val->cover}}'><i class='fas fa-edit text-primary'></i> Edit</a>
                                                        <div class='dropdown-divider'></div>
                                                        <a class='dropdown-item has-icon text-danger' data-target='#DeleteData' data-toggle='modal'><i class='fas fa-trash'></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flip-card-3D-wrapper col-md-6 col-xl">
                <div id="flip-card">
                    <div class="flip-card-front">
                        <div class="card-flip-back">
                            <div class="card">
                            <div class="card-header">
                                <h4>Insert Data</h4>
                            </div>
                            <div class="card-body">
                                {{-- <form> --}}
                                    <input type="hidden" name="id" id="id">
                                    <div class="form-group">
                                      <label for="title">Title</label>
                                      <input type="text" class="form-control" id="title" placeholder="E.g Vagabond">
                                      <div class="invalid-feedback titleError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control">
                                            <option value="manga">Manga [JP]</option>
                                            <option value="manhwa">Manhwa [KR]</option>
                                            <option value="manhua">Manhua [CN]</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <select name="genre" id="genre" class="form-control select2" multiple>
                                            <option value="action">Action</option>
                                            <option value="comedy">Comedy</option>
                                            <option value="bully">Bully</option>
                                            <option value="shounen">Shounen</option>
                                            <option value="sport">Sport</option>
                                            <option value="demon">Demon</option>
                                            <option value="fantasy">Fantasy</option>
                                        </select>
                                        <div class="invalid-feedback genreError"></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="description">Description</label>
                                      <textarea name="description" id="description" class="form-control" placeholder="Description..." style="height: 100px" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover">cover</label>
                                        <input type="text" class="form-control" id="cover" placeholder="E.g https://www.pngmart.com/files/21/Among-Us-Character-PNG.png">
                                      </div>
                                    {{-- <div class="form-group">
                                        <label for="cover">Cover</label>
                                        <input type="file" class="form-control-file" id="cover" accept="png,jpg,jpeg">
                                    </div> --}}
                                    <div class="float-right"> 
                                        <button type="reset" class="btn btn-secondary">Reset</button>
                                        <button class="btn btn-primary" id="btn-submit">Submit</button>
                                    </div>
                                  {{-- </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="flip-card-back">
                        <div class="card-flip-back">
                        <div class="card">
                            <div class="card-header">
                                <h4>Update Data</h4>
                            </div>
                            <div class="card-body">
                                {{-- <form> --}}
                                    <input type="hidden" name="id" id="id2">
                                    <div class="form-group">
                                      <label for="title">Title</label>
                                      <input type="text" class="form-control" id="title2" placeholder="E.g Vagabond">
                                      <div class="invalid-feedback titleError"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="type">Type</label>
                                        <select name="type" id="type2" class="form-control">
                                            <option value="manga">Manga [JP]</option>
                                            <option value="manhwa">Manhwa [KR]</option>
                                            <option value="manhua">Manhua [CN]</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <select name="genre" id="genre2" class="form-control select2" multiple>
                                            <option value="action">Action</option>
                                            <option value="comedy">Comedy</option>
                                            <option value="bully">Bully</option>
                                            <option value="shounen">Shounen</option>
                                            <option value="sport">Sport</option>
                                            <option value="demon">Demon</option>
                                            <option value="fantasy">Fantasy</option>
                                        </select>
                                        <div class="invalid-feedback genreError"></div>
                                    </div>
                                    <div class="form-group">
                                      <label for="description">Description</label>
                                      <textarea name="description" id="description2" class="form-control" placeholder="Description..." style="height: 100px" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="cover">Cover</label>
                                        <input type="text" class="form-control" id="cover2" placeholder="">
                                      </div>
                                    {{-- <div class="form-group">
                                        <label for="cover">Cover</label>
                                        <input type="file" class="form-control-file" id="cover2" accept="png,jpg,jpeg">
                                    </div> --}}
                                    <div class="float-right"> 
                                        {{-- <button type="reset" class="btn btn-secondary">Reset</button> --}}
                                        <button class="btn btn-primary" id="btn-update">Update</button>
                                    </div>
                                  {{-- </form> --}}
                            </div>
                        </div>
                    </div></div>
                </div>
            </div>
            {{-- <div class="col-md-6 col-xl card-flip-front">
                <div class="card">
                    <div class="card-header">
                        <h4>Input Data</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" placeholder="E.g Vagabond">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option>Manga [JP]</option>
                                    <option>Manhwa [KR]</option>
                                    <option>Manhua [CN]</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select name="genre" id="genre" class="form-control select2" multiple="multiple">
                                    <option>Action</option>
                                    <option>Comedy</option>
                                    <option>Bully</option>
                                    <option>Shounen</option>
                                    <option>Sport</option>
                                    <option>Demon</option>
                                    <option>Fantasy</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" id="description" class="form-control" placeholder="Description..." style="height: 100px" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cover">Cover</label>
                                <input type="file" class="form-control-file" id="cover" accept="png,jpg,jpeg">
                            </div>
                            <div class="float-right"> 
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button class="btn btn-primary" id="btn-submit">Submit</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>  --}}
            {{-- <div class="col-md-6 col-xl card-flip-back">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Data</h4>
                    </div>
                    <div class="card-body">
                        <form>
                            <div class="form-group">
                              <label for="title">Title</label>
                              <input type="text" class="form-control" id="title" placeholder="E.g Vagabond">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control">
                                    <option>Manga [JP]</option>
                                    <option>Manhwa [KR]</option>
                                    <option>Manhua [CN]</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="genre">Genre</label>
                                <select name="genre" id="genre" class="form-control select2" multiple="multiple">
                                    <option>Action</option>
                                    <option>Comedy</option>
                                    <option>Bully</option>
                                    <option>Shounen</option>
                                    <option>Sport</option>
                                    <option>Demon</option>
                                    <option>Fantasy</option>
                                </select>
                            </div>
                            <div class="form-group">
                              <label for="description">Description</label>
                              <textarea name="description" id="description" class="form-control" placeholder="Description..." style="height: 100px" ></textarea>
                            </div>
                            <div class="form-group">
                                <label for="cover">Cover</label>
                                <input type="file" class="form-control-file" id="cover" accept="png,jpg,jpeg">
                            </div>
                            <div class="float-right"> 
                                <button type="reset" class="btn btn-secondary">Reset</button>
                                <button class="btn btn-primary" id="btn-submit">Submit</button>
                            </div>
                          </form>
                    </div>
                </div>
            </div>  --}}
        </div>
    </div>
</section>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
{{-- delete --}}
  <div class="modal fade" id="DeleteData" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddDataLabel">Delete?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= csrf_field(); ?>
                <input type="hidden" name="id" id="delete-id">
                <div>Are you sure?</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger btn-delete">Delete</button>
            </div>

        </div>
    </div>
</div>
<style>
    td p{
        max-width: 150px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
</style>
<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    
    // Datatable Column
    $(document).ready(function(){
        $("#table-comic").DataTable({
            // processing:true,
            ajax: "{{route('admin.comic-list')}}",
            columns: [{
                    data: 'index',
                    name: 'index'
                },
                {
                    data: 'cover',
                    name: 'cover'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'type',
                    name: 'type'
                },
                {
                    data: 'genre',
                    name: 'genre'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'action',
                    name: 'action'
                },

            ],
        })
    })
    
    // Insert Function
    $('#btn-submit').click(function(){
        var id = $('#id').val()
        var title = $('#title').val()
        var type = $('#type').val()
        var genre = $('#genre').val()
        var description = $('#description').val()
        var cover = $('#cover').val()

        $.ajax({
            method: 'post',
            url:'{{route('admin.comic-create')}}',
            dataType:'json',
            data: {
                id:id,
                title:title,
                type:type,
                genre:genre,
                description:description,
                cover:cover,
            },
            beforeSend: function() {
                    $('#btn-submit').attr('disable', 'disabled')
                    $('#btn-submit').html("<i class='fa fa-spin fa-spinner'></i>")
            },
            complete: function() {
                    $('#btn-submit').removeAttr('disable')
                    $('#btn-submit').html("Submit")
            },
            success: function(response){
                
                iziToast.success({
                            position: 'topRight',
                            title: 'Success',
                            message: 'Successfully inserted record!',
                        });
                clearField()
                $('#table-comic').DataTable().ajax.reload();
            },
            error: function(response) {
                    if(response.responseJSON.errors.title){
                        $('.titleError').html(response.responseJSON.errors.title[0])
                        $('#title').addClass('is-invalid')
                    }else{
                        $('.titleError').html('')
                        $('#title').removeClass('is-invalid')
                    }
                    if(response.responseJSON.errors.genre){
                        $('.genreError').html(response.responseJSON.errors.genre[0])
                        $('#genre').addClass('is-invalid')
                    }else{
                        $('.genreError').html('')
                        $('#genre').removeClass('is-invalid')
                    }
                }
            // error: function(xhr, ajaxOptions, thrownError) {
            //         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            //     }
        })
    })

    // Update Function
    $('#btn-update').click(function(){
        var id = $('#id2').val()
        var title = $('#title2').val()
        var type = $('#type2').val()
        var genre = $('#genre2').val()
        var description = $('#description2').val()
        var cover = $('#cover2').val()

        $.ajax({
            method: 'post',
            url:'{{route('admin.comic-create')}}',
            dataType:'json',
            data: {
                id:id,
                title:title,
                type:type,
                genre:genre,
                description:description,
                cover:cover,
            },
            beforeSend: function() {
                    $('#btn-update').attr('disable', 'disabled')
                    $('#btn-update').html("<i class='fa fa-spin fa-spinner'></i>")
            },
            complete: function() {
                    $('#btn-update').removeAttr('disable')
                    $('#btn-update').html("Update")
            },
            success: function(response){
                iziToast.success({
                            position: 'topRight',
                            title: 'Success',
                            message: 'Successfully updated record!',
                        });
                $('#table-comic').DataTable().ajax.reload();
            },
            error: function(response) {
                    if(response.responseJSON.errors.title){
                        $('.titleError').html(response.responseJSON.errors.title[0])
                        $('#title2').addClass('is-invalid')
                    }else{
                        $('.titleError').html('')
                        $('#title2').removeClass('is-invalid')
                    }
                    if(response.responseJSON.errors.genre){
                        $('.genreError').html(response.responseJSON.errors.genre[0])
                        $('#genre2').addClass('is-invalid')
                    }else{
                        $('.genreError').html('')
                        $('#genre2').removeClass('is-invalid')
                    }
                }
            // error: function(xhr, ajaxOptions, thrownError) {
            //         alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError)
            //     }
        })
    })

    // Get ID Comic For Update
    function getID(id){
        $.ajax({
            type: 'post',
            url: '{{route('admin.comic-edit')}}',
            data: {id:id},
            dataType: 'json',
            success:function(response){
                console.log(response);
                var genre = response.genre
                var genreArray = genre.split(',')

                $('#id2').val(response.id)
                $('#title2').val(response.title)
                $('#type2').val(response.type)
                $('#genre2').val(genreArray).change()
                $('#description2').val(response.description)
                $('#cover2').val(response.cover)
            }
        })
    }

    $('.btn-delete').click(function(){
        var id = $('#delete-id').val()
        $.ajax({
            type: 'post',
            url: '{{route('admin.comic-delete')}}',
            data: {id:id},
            dataType: 'json',
            success:function(response){
                iziToast.success({
                            position: 'topRight',
                            title: 'Success',
                            message: 'Successfully deleted record!',
                 });
                 $('#DeleteData').modal('hide');
                 $('#table-comic').DataTable().ajax.reload();
            }
        })
    })
   

    // FLIP CARD EFFECT
    $(document).ready(function () {
    var form = 'insert'
    $(document).on('click', '.flip-card-update', function() {
        // console.log('oke');
        if (form == 'insert') {
            form = 'update'
            document.getElementById('flip-card').classList.toggle('do-flip');
        };
    })
    $(document).on('click', '#flip-card-insert', function() {
        // console.log('oke');
        if (form == 'update') {
            form = 'insert'
            document.getElementById('flip-card').classList.toggle('do-flip');
        };
    })
    })

    $(document).on('click', '#deleteBook', function() {
       $('#delete-id').val($(this).data('id'));
    })

   

    // $(document).on('click', '#update-comic', function() {
    //     var genre = $(this).data('genre')
    //     var genreArray = genre.split(',')

    //     // genreArray.forEach(function(valToSelect){
    //     //     $('select#genre2').find('option[value="' + valToSelect + '"]').attr('selected',true);
    //     // });
    //     $('#title2').val($(this).data('title'))
    //     $('#type2').val($(this).data('type'))
    //     $('#description2').val($(this).data('description'))
    //     $('#genre2').val(genreArray).change()
    //     $('#cover2').val($(this).data('cover'))
    // })

    function clearField(){
        $('#title').val('')
        $('#type').val('')
        $('#description').val('')
        $('#genre').val('').change()
        $('#cover').val('')
    }
</script>
@endsection