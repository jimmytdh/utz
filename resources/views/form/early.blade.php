@extends('layout.app')
@section("title","Early Pregnancy: $patient->fname $patient->mname $patient->lname")
@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form action="{{ url('/register/vas') }}" method="post" id="formSubmit">
                <div id="admissionSection" class="hidden">
                    <h2 class="title-header">Admission Form</h2>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>Admission Type</label>
                            <select class="custom-select" name="admission_type">
                                <option value="">Select...</option>
                                <option {{ ($adm->admission_type=='private') ? 'selected':'' }} value="private">Private Division</option>
                                <option {{ ($adm->admission_type=='clinical') ? 'selected':'' }} value="clinical">Clinical Division</option>
                                <option {{ ($adm->admission_type=='opd') ? 'selected':'' }} value="opd">Out-Patient</option>
                                <option {{ ($adm->admission_type=='in') ? 'selected':'' }} value="in">In-Patient</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ ($adm->date_started) ? date('Y-m-d',strtotime($adm->date_started)):'' }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Time Started</label>
                            <input type="time" name="date_started" value="{{ ($adm->date_started) ? date('H:i',strtotime($adm->date_started)):'' }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Time Ended</label>
                            <input type="time" name="date_ended" value="{{ ($adm->date_ended) ? date('H:i',strtotime($adm->date_ended)):'' }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Room/Bed No.</label>
                            <input type="text" name="room" value="{{ $adm->room }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Ward</label>
                            <input type="text" name="ward" value="{{ $adm->ward }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Referring Physician</label>
                            <input type="text" name="referring_doctor" value="{{ $adm->referring_doctor }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Indication for Scan</label>
                            <input type="text" name="scan_indication" value="{{ $adm->scan_indication }}" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <?php
                                $g = substr($adm->gp_code,0,1);
                                $p = substr($adm->gp_code,-1);
                            ?>
                            <label>G: <span id="g">{{ $g }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span id="p">{{ $p }}</span> </label>
                            <input type="text" class="form-control" name="gp_code" value="{{ $adm->gp_code }}">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>LMP</label>
                            <input type="text" name="lmp" value="{{ $adm->lmp }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>PMP</label>
                            <input type="text" name="pmp" value="{{ $adm->pmp }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Menstrual Age</label>
                            <input type="text" name="menstrual_age" value="{{ $adm->menstrual_age }}" class="form-control">
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
                <div id="formSection" class="">
                    <h2 class="title-header">Early Pregnancy Worksheet</h2>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Scan</label>
                            <select class="custom-select" name="scan_type">
                                <option value="">Select</option>
                                <option @if($early->scan_type=='Transvaginal') selected @endif>Transvaginal</option>
                                <option @if($early->scan_type=='Transabdominal') selected @endif>Transabdominal</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Gestational Sac Visualized</label>
                            <select class="custom-select">

                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Location</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Borders</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-4">
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
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Fetus Recognized</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Number</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label>Well Formed</label>
                            <select class="custom-select">

                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>Heart Motion</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label>&nbsp;</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Body Movement</label>
                            <select class="custom-select">

                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>CRL</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Right Ovary</label>
                            <textarea class="form-control" rows="4" style="resize: none;"></textarea>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Left Ovary</label>
                            <textarea class="form-control" rows="4" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>Remarks</label>
                            <textarea class="form-control" rows="4" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <label>OB-GYN Sonologist</label>
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