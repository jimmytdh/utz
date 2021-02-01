@extends('layout.app')
@section('title','Early Pregnancy Worksheet')
@section('css')
    <link rel="stylesheet" href="{{ url('/css/step.css') }}">
@endsection
@section('content')
    <h2 class="title-header">Early Pregnancy Worksheet</h2>
    <div class="container-fluid" id="grad1">
        <div class="row justify-content-center mt-0">
            <div class="col-11 col-sm-9 col-md-7 col-lg-6 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2><strong>{{ $data->fname }} {{ $data->mname }} {{ $data->lname }} <small class="text-danger">({{ \App\Http\Controllers\ConfigController::age($data->dob) }}y/o)</small></strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform" method="post" action="javascript:void(0)">
                                {{ csrf_field() }}
                                <input type="hidden" name="patient_id" value="{{ $data->id }}">
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="account"><strong>Admission</strong></li>
                                    <li id="personal"><strong>Worksheet</strong></li>
                                    <li id="payment"><strong>Findings and Remarks</strong></li>
                                    <li id="confirm"><strong>Complete</strong></li>
                                </ul> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-card">
                                        <div class="form-group">
                                            <select name="admission_type" class="form-control">
                                                <option value="private">Private Division</option>
                                                <option value="clinical">Clinical Division</option>
                                                <option value="opd">Out-Patient</option>
                                                <option value="in">In-Patient</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Date:</label>
                                            <input type="date" class="form-control-sm" name="date"value="{{ date('Y-m-d') }}" >
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Time Started:</label>
                                                <input type="time" class="form-control-sm" name="date_started">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Time Ended:</label>
                                                <input type="time" class="form-control-sm" name="date_ended">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Room/Bed No.:</label>
                                                <input type="text" class="form-control-sm" name="room">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Ward:</label>
                                                <input type="text" class="form-control-sm" name="ward">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Referring Physician:</label>
                                            <input type="text" class="form-control-sm" name="referring_doctor">
                                        </div>
                                        <div class="form-group">
                                            <label>Indication for Scan:</label>
                                            <input type="text" class="form-control-sm" name="scan_indication">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>GP:</label>
                                                <input type="text" class="form-control-sm" name="gp_code">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>LMP:</label>
                                                <input type="text" class="form-control-sm" name="lmp">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>PMP:</label>
                                                <input type="text" class="form-control-sm" name="pmp">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Menstrual Age:</label>
                                                <input type="text" class="form-control-sm" name="menstrual_age">
                                            </div>
                                        </div>
                                    </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="form-group">
                                            <label>Number of Fetus</label>
                                            <select class="form-control" name="fetus_no">
                                                <option>Singleton</option>
                                                <option>Multiple</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Presentation</label>
                                            <input type="text" name="presentation" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Heart Activity</label>
                                                <input type="text" name="heart_activity" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Gender</label>
                                                <select class="form-control" name="gender">
                                                    <option value="g">Girl</option>
                                                    <option value="b">Boy</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Biometry</label>
                                            <input type="text" name="biometry" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>BPD</label>
                                                <input type="text" name="bpd" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>HC</label>
                                                <input type="text" name="hc" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>FL</label>
                                                <input type="text" name="fl" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>FAC</label>
                                                <input type="text" name="fac" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>SEFW</label>
                                                <input type="text" name="sefw" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Others</label>
                                                <input type="text" name="others" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Age of Gestation Based on Today's Scan</label>
                                            <input type="text" name="gestation_age" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>AMNIOTIC FLUID</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>AFI</label>
                                                <input type="text" name="afi" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Single Vertical Pocket</label>
                                                <input type="text" name="single_vertical" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>PLACENTA</label>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Location</label>
                                                <input type="text" name="location" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Grade</label>
                                                <input type="text" name="grade" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Abnormality</label>
                                            <input type="text" name="abnormality" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Cord Vessels</label>
                                            <input type="text" name="cord_vessels" class="form-control">
                                        </div>
                                    </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title">Other Findings</h2>
                                        <div class="form-group">
                                            <label>Right Ovary:</label>
                                            <input type="text" class="form-control" name="right_ovary">
                                        </div>
                                        <div class="form-group">
                                            <label>Left Ovary:</label>
                                            <input type="text" class="form-control" name="left_ovary">
                                        </div>
                                        <div class="form-group">
                                            <label>Remarks:</label>
                                            <textarea class="form-control" rows="4" style="resize: none;" id="remarks" name="remarks"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>OB-GYN Sonologist</label>
                                            <select name="ob_doctor" id="" class="form-control">
                                                @foreach($doctors as $doc)
                                                    <option value="{{ $doc->id }}">Dr. {{ $doc->fname }} {{ ($doc->mname) ? $doc->mname[0]: '' }}. {{ $doc->lname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="submit" name="" id="btnSubmit" class="next action-button" value="Confirm" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="text-center saving">
                                            <i class="fa fa-spin fa-spinner"></i> Please wait... Saving Data...
                                        </div>
                                        <div class="success" style="display: none;">
                                            <h2 class="fs-title text-center">Successfully Saved!</h2> <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-3"> <img src="{{ url("/images/check.png") }}" class="fit-image"> </div>
                                            </div> <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <a href="{{ url('/patient/history/'.$data->id) }}" class="btn btn-warning">
                                                        <i class="fa fa-book"></i> View Patient History
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ url('/js/step.js') }}"></script>
    <script type="text/javascript">
        var enterDisabled = true;
        $(document).ready(function(){
            $(window).keydown(function(event){
                if(enterDisabled && event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            });

            $('#remarks').focus(function(){
                enterDisabled = false;
            });
            $('#remarks').focusout(function(){
                enterDisabled = true;
            });
            $('#msform').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: "{{ url('patient/earlypregnancy/'.$data->id) }}",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: (data) => {
                        console.log(data);
                        setTimeout(function(){
                            $('.saving').css('display','none');
                            $('.success').css('display','block');
                        },2000);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
            });

        });
    </script>
@endsection