@extends('layout.app')
@section('title','Patients')
@section('css')
    <link href="{{ url('/plugins/DataTables/datatables.min.css') }}" rel="stylesheet">
    <style>
        .btn-circle { border-radius: 50%; }
    </style>
@endsection
@section('content')
    <h2 class="title-header">Patients</h2>
    <table id="dataTable" class="table-sm table-hover table-striped table-bordered" style="width:100%;">
        <thead>
        <tr>
            <th>Admission No.</th>
            <th>Hospital No.</th>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
        <tfoot>
        <tr>
            <th>Admission No.</th>
            <th>Hospital No.</th>
            <th>Full Name</th>
            <th>Date of Birth</th>
            <th>Age</th>
            <th>Action</th>
        </tr>
        </tfoot>
    </table>
@endsection

@section('modal')
    <div class="modal" tabindex="-1" role="dialog" id="patientModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title" id="modalTitle">Add Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="javascript:void(0)" id="patientForm" name="patientForm" method="POST">

                <div class="modal-body">
                    <input type="hidden" name="id" id="id" sf="numbers">
                    <div class="form-group">
                        <label for="hospital_no">Hospital No.</label>
                        <input type="text" class="form-control" id="hospital_no" name="hospital_no" sf="numbers">
                    </div>
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control" required sf="ucfirst">
                    </div>
                    <div class="form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" name="mname" id="mname" class="form-control" sf="ucfirst">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control" required sf="ucfirst">
                    </div>
                    <div class="form-group">
                        <label for="dob">Date of Birth</label>
                        <input type="date" name="dob" id="dob" class="form-control" required sf="numbers">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fa fa-close"></i>
                        Close</button>
                    <button type="submit" class="btn btn-danger" id="btnSave">
                        <i class="fa fa-save"></i>
                        Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" role="dialog" id="formModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Select Worksheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a href="#" class="btn btn-lg btn-success btn-block" id="linkEarlyPregnancy">
                            Early Pregnancy Worksheet
                        </a>
                        <a href="#" class="btn btn-lg btn-info btn-block" id="linkSonographicFindings">
                            Sonographic Findings Worksheet
                        </a>
                        <a href="#" class="btn btn-lg btn-warning btn-block" id="linkSecondThirdTrimester">
                            Second and Third Trimester Worksheet
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/plugins/DataTables/datatables.min.js') }}"></script>
    <script src="{{ url('/js/smart-formatter.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('input').attr('autocomplete','off');
            $('#patientForm').smart_format();
            $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('/patients') }}",
                columns: [
                    { data: 'admission_no', name: 'admission_no'},
                    { data: 'hospital_no', name: 'hospital_no'},
                    { data: 'full_name', name: 'full_name'},
                    { data: 'dob', name: 'dob'},
                    { data: 'age', name: 'age'},
                    { data: 'action', name: 'action'},
                ],
                order: [[0, 'desc']],
                dom: 'Bfrtip',
                buttons: [
                    {
                        text: '<i class="fa fa-user-plus"></i> Add New Patient',
                        action: function ( e, dt, node, config ) {
                            $('#patientForm').trigger('reset');
                            $('#modalTitle').html('Add Patient');
                            $('#patientModal').modal('show');
                            $('#id').val('');
                            $('#patientForm').smart_format();
                        }
                    }
                ]
            });
        });

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url:"{{ url('patient/update') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res) {
                    $('#modalTitle').html('Edit Patient');
                    $('#patientModal').modal('show');
                    $('#id').val(res.id);
                    $('#hospital_no').val(res.hospital_no);
                    $('#fname').val(res.fname);
                    $('#mname').val(res.mname);
                    $('#lname').val(res.lname);
                    $('#dob').val(res.dob);
                }
            });
        }

        function deleteFunc(id) {
            if(confirm("Are you sure you want to delete this record?") == true) {
                var id = id;
                $.ajax({
                    type: "POST",
                    url: "{{ url("patient/destroy") }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#dataTable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }

        $('#patientForm').submit(function(e) {
            e.preventDefault();
            $('#btnSave').html('<i class="fa fa-spinner fa-spin"></i> Submitting...');
            $('#btnSave').attr('disabled',true);
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('patient/store') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    var oTable = $('#dataTable').dataTable();
                    oTable.fnDraw(false);
                    setTimeout(function(){
                        $('#btnSave').html('<i class="fa fa-save"></i> Submit');
                        $('#btnSave').attr('disabled',false);
                        var title = $('#modalTitle').html();
                        if(title === 'Add Patient'){
                            $('#patientForm')[0].reset();
                        }
                    },1000);
                },
                error: function(data){
                    console.log(data);
                }
            });
        });

        $(document).on('click','#btnAdmit',function(){
            var id = $(this).data('id');
            $('#linkEarlyPregnancy').attr('href',"{{ url('/patient/earlypregnancy/') }}/"+id);
            $('#linkSonographicFindings').attr('href',"{{ url('/patient/sonographicfindings/') }}/"+id);
            $('#linkSecondThirdTrimester').attr('href',"{{ url('/patient/trimester/') }}/"+id);
        });
    </script>
@endsection