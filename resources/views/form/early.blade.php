@extends('layout.app')
@section("title","Early Pregnancy: $patient->fname $patient->mname $patient->lname")
@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ url('/register/vas') }}" method="post" id="formSubmit">
                <div id="admissionSection">
                    <h2 class="title-header">Admission Form</h2>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>Admission Type</label>
                            <select class="custom-select">
                                <option value=""></option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Date</label>
                            <input type="date" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Time Started</label>
                            <input type="time" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Time Ended</label>
                            <input type="time" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Room/Bed No.</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ward</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Referring Physician</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Indication for Scan</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>G: &nbsp;&nbsp;&nbsp;P:</label>
                            <input type="text" class="form-control" value="0-0-0-0">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>LMP</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>PMP</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Menstrual Age</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="pull-right">
                        <button type="button" id="btnNext" class="btn btn-warning btn-flat">
                            Next
                            <i class="fa fa-angle-double-right"></i>
                        </button>
                    </div>
                </div>
                <div id="formSection" class="hidden">
                    <h2 class="title-header">Early Pregnancy Worksheet</h2>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Scan</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Gestational Sac Visualized</label>
                            <select class="custom-select">

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>Location</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Borders</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-2">
                            <label>Means Sac Diameter</label>
                            <select class="custom-select">

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Yolk Sac</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Subchorionic Hemorrhage</label>
                            <select class="custom-select">

                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="pull-right">
                        <button type="button" id="btnBack" class="btn btn-warning btn-flat">
                            <i class="fa fa-angle-double-left"></i>
                            Back</button>
                        <button type="submit" id="btnSubmit" class="btn btn-success btn-flat">
                            <i class="fa fa-check-circle"></i>
                            Update</button>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection

@section('js')
    <script>
        $("#formSubmit").on('submit',function(e){
            e.preventDefault();
        });

        $("#btnNext").on('click',function(){
            $("#admissionSection").addClass('hidden');
            $("#formSection").removeClass('hidden');
        });

        $("#btnBack").on('click',function(){
            $("#admissionSection").removeClass('hidden');
            $("#formSection").addClass('hidden');
        });
    </script>
@endsection