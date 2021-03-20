@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        <h4>Limit Per Day Settings</h4> 
    </div>

    <div class="card-body">
        <div class="card-body table-responsive">
            <table id="table" class=" table table-bordered table-striped table-hover datatable datatable-Venue">
                <thead class="bg-light">
                    <tr>
                        <th>No.</th>
                        <th>Full Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                
            </table>
        </div>

    </div>

    <form method="post" id="myForm" class="form-horizontal ">
            @csrf
            <div class="modal" id="formModal">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content">
                
                        <!-- Modal Header -->
                        <div class="modal-header bg-light">
                            <p class="modal-title text-info font-weight-bold">Modal Heading</p>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                
                        <!-- Modal body -->
                        <div class="modal-body">
                            <span id="form_result"></span>
                            
                            <div class="form-group">
                                <label class="control-label col-md-4" >Full Date : </label>
                                <input type="number" id="fulldate" name="fulldate" class="form-control" placeholder="Choose a number" required /> 
                                <span class="invalid-feedback" role="alert">
                                    <strong id="error-fulldate"></strong>
                                </span>
                            </div>
    

                            <input type="hidden" name="action" id="action" value="Add" />
                            <input type="hidden" name="hidden_id" id="hidden_id" />
                        </div>
                
                        <!-- Modal footer -->
                        <div class="modal-footer bg-light">
                            <input type="submit" name="action_button" id="action_button" class="btn btn-info" value="Save" />
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                
                    </div>
                </div>
            </div>
        </form>

</div>
<div class="loading"></div>
@endsection
@section('scripts')
@parent
<script>
  $(document).ready(function(){
            $('.loading').hide()
            $('#table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('admin.fulldates.index') }}",
                    beforeSend: function() { $('.loading').show() },
                    complete: function() { $('.loading').hide() },
                },
                columns: [
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'fulldate',
                        name: 'fulldate'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ]
            });

            $('#create_record').click(function(){
                $('#myForm')[0].reset();
                $('.form-control').removeClass('is-invalid')
                $('.modal-title').text('Add New Record');
                $('#action_button').val('Save');
                $('#action').val('Add');
                $('#form_result').html('');
                $('#formModal').modal('show');
            });


            $('#myForm').on('submit', function(event){
                event.preventDefault();
                $('.form-control').removeClass('is-invalid')
                var action_url = "{{ route('admin.fulldates.store') }}";
                var type = "POST";

                if($('#action').val() == 'Edit'){
                    var id = $('#hidden_id').val();
                    action_url = "/admin/fulldates/" + id;
                    type = "PUT";
                }

                $.ajax({
                    url: action_url,
                    method:type,
                    data:$(this).serialize(),
                    dataType:"json",
                    success:function(data){
                        var html = '';
                        if(data.errors){
                            $.each(data.errors, function(key,value){
                                if(key == $('#'+key).attr('id')){
                                    $('#'+key).addClass('is-invalid')
                                    $('#error-'+key).text(value)
                                }
                            })
                        }
                        if(data.success){
                            //html = '<div class="alert alert-success">' + data.success + '</div>';
                            $('.form-control').removeClass('is-invalid')
                            $('#myForm')[0].reset();
                            $('#formModal').modal('hide');
                           
                            $.alert({
                                title: 'success',
                                content: data.success,
                                type: 'green',
                                })
                            $('#table').DataTable().ajax.reload();
                        }
                        $('#form_result').html(html);
                    }
                });
            });


            $(document).on('click', '.edit', function(){
                $('#myForm')[0].reset();
                $('.form-control').removeClass('is-invalid')
                $('#form_result').html('');
                var id = $(this).attr('edit');

                $.ajax({
                    url :"/admin/fulldates/"+id+"/edit",
                    dataType:"json",
                    success:function(data){
                        $.each(data.result, function(key,value){
                            if(key == $('#'+key).attr('id')){
                                $('#'+key).val(value)
                            }
                        })
                        $('#hidden_id').val(id);
                        $('.modal-title').text('Edit Record');
                        $('#action_button').val('Update');
                        $('#action').val('Edit');
                        $('#formModal').modal('show');
                    }
                })
            });


            $(document).on('click', '.delete', function(){
                var id = $(this).attr('delete');

                $.confirm({
                    title: 'Confirmation',
                    content: 'You really want to delete this record?',
                    autoClose: 'cancel|10000',
                    type: 'red',
                    buttons: {
                        confirm: {
                            text: 'confirm',
                            btnClass: 'btn-blue',
                            keys: ['enter', 'shift'],
                            action: function(){
                                return $.ajax({
                                    url:"/admin/fulldates/"+id,
                                    method:'DELETE',
                                    data: {
                                        _token: '{!! csrf_token() !!}',
                                    },
                                    dataType:"json",
                                    beforeSend:function(){
                                        $('#' + id).text('Deleting...');
                                    },
                                    success:function(data){
                                        if(data.success){
                                            setTimeout(function(){
                                                $('#' + id).text('Deleted');
                                                $('#table').DataTable().ajax.reload();
                                                // $.alert({
                                                //     title: 'success',
                                                //     content: 'Click ok to continue.',
                                                //     type: 'blue',
                                                // })
                                            }, 2000);
                                        }
                                    }
                                })
                            }
                        },
                        cancel:  {
                            text: 'cancel',
                            btnClass: 'btn-red',
                            keys: ['enter', 'shift'],
                            // action: function(){
                            //     $.alert('Canceled!');
                            // }
                        }
                    }
                });
                
            });

        })
</script>
@endsection