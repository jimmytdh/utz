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
    <h2 class="title-header">Manage Users</h2>
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive p-2">
                <table id="dataTable" class="table table-striped">
                    <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Level</th>
                        <th>Date Added</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
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
                ajax: "{{ url('/settings/users') }}",
                columns: [
                    { data: 'fname', name: 'fname'},
                    { data: 'mname', name: 'mname'},
                    { data: 'lname', name: 'lname'},
                    { data: 'username', name: 'username'},
                    { data: 'level', name: 'level'},
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
                    url: "{{ route('update.level') }}",
                    source: [
                        {value: 'admin', text: 'Admin'},
                        {value: 'standard', text: 'Standard'},
                        {value: 'denied', text: 'Denied'}
                    ],
                    emptytext: 'N/A'
                });
            }


        });
    </script>
@endsection