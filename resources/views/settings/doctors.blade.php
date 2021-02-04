@extends('layout.app')

@section('title','Manage Doctors')
@section('css')
    <link href="{{ url('/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-editable/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-editable/css/style.css') }}">
    <style>
        .editable { cursor: pointer; }
        .btn-success { background: #118146 !important; color: #fff !important;}
        .btn-circle { border-radius: 50%; }
    </style>
@endsection

@section('content')
    <div id="loader-wrapper" style="visibility: hidden;">
        <div id="loader"></div>
    </div>
    <h2 class="title-header">Manage Doctors</h2>
    <div class="row">
        <div class="col-sm-3">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Doctor</h3>
                </div>
                <form action="{{ route('add.doctor') }}" id="submitForm">
                <div class="box-body">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" required autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Middle Name</label>
                        <input type="text" class="form-control" name="mname" autocomplete="off"/>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" required autocomplete="off"/>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="submit" id="btnSave" class="btn btn-success btn-block">
                        <i class="fa fa-save"></i> Save
                    </button>
                </div>
                </form>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <div class="col-sm-9">
            <div class="table-responsive p-2">
                <table id="dataTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Date Created</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal" tabindex="-1" role="dialog" id="modalLoadError">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Unable to Fetch Data</h5>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <button class="btn btn-default btn-block" onclick="window.location.replace('{{ url('/patients') }}')">
                                <i class="fa fa-times"></i> Cancel
                            </button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn btn-success btn-block" onclick="window.location.reload();">
                                <i class="fa fa-refresh"></i> Reload
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ url('/js/smart-formatter.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/plugins/bootstrap-editable/js/bootstrap-editable.js') }}"></script>
    <script>

        $(document).ready(function() {

            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/settings/doctors') }}",
                columns: [
                    { data: 'fname', name: 'fname'},
                    { data: 'mname', name: 'mname'},
                    { data: 'lname', name: 'lname'},
                    { data: 'created_at', name: 'created_at'}
                ],
                order: [[3, 'desc']],
                drawCallback: function (settings) {
                    makeEditable();
                }
            });


            function makeEditable()
            {
                $.fn.editable.defaults.mode = 'popup';
                $('.edit').editable({
                    url: "{{ route('update.doctor') }}",
                    type: 'text',
                    emptytext: 'N/A'
                });
            }

            $('#dataTable').on('click','.btn-delete',function(){
                var id = $(this).data('id');
                if(confirm("Are you sure you want to delete this record?") == true) {
                    var id = id;
                    $.ajax({
                        type: "POST",
                        url: "{{ route("destroy.doctor") }}",
                        data: { id: id },
                        dataType: 'json',
                        success: function(res) {
                            var oTable = $('#dataTable').dataTable();
                            oTable.fnDraw(false);
                        },
                        error: function(err){
                            console.log('error');
                        }
                    });
                }
            });

            $("#submitForm").on('submit',function (e) {
                e.preventDefault();
                $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Submitting...');
                $('#btnSave').attr('disabled',true);
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('add.doctor') }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        var oTable = $('#dataTable').dataTable();
                        oTable.fnDraw(false);
                        setTimeout(function(){
                            $('#btnSave').html('<i class="fa fa-save"></i> Save');
                            $('#btnSave').attr('disabled',false);
                            $('#submitForm').trigger('reset');
                        },1000);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });


        });
    </script>
@endsection