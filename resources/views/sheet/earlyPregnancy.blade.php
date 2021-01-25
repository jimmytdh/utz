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
                    <h2><strong>{{ $data->fname }} {{ $data->mname }} {{ $data->lname }}</strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <div class="row">
                        <div class="col-md-12 mx-0">
                            <form id="msform">
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
                                        <div class="form-group">
                                            <label>GP:</label>
                                            <input type="text" class="form-control-sm" name="gp_code">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-4">
                                                <label>LMP:</label>
                                                <input type="text" class="form-control-sm" name="lmp">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label>PMP:</label>
                                                <input type="text" class="form-control-sm" name="pmp">
                                            </div>
                                            <div class="form-group col-sm-4">
                                                <label>Menstrual Age:</label>
                                                <input type="text" class="form-control-sm" name="menstrual_age">
                                            </div>
                                        </div>
                                    </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Scan</label>
                                                <select class="form-control" name="scan_type">
                                                    <option>Transvaginal</option>
                                                    <option>Transabdominal</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Gestational Sac Visualised</label>
                                                <select class="form-control" name="gestational_sac">
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Location</label>
                                                <select class="form-control" name="location">
                                                    <option>Intrauterine</option>
                                                    <option>Extrauterine</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Borders</label>
                                                <select class="form-control" name="borders">
                                                    <option>Thick and Well-Defined</option>
                                                    <option>Abnormal</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Mean Sac Diameter</label>
                                                <select class="form-control" name="mean_sac">
                                                    <option>Present</option>
                                                    <option>Absent</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Yolk Sac</label>
                                            <input type="text" name="yolk_sac" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Subchorionic Hemorrhage</label>
                                            <input type="text" name="subchrionic" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Fetus Recognized</label>
                                                <select class="form-control" name="location">
                                                    <option>Yes</option>
                                                    <option>No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Number</label>
                                                <input type="number" value="1" min="1" class="form-control" name="number">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Well Formed</label>
                                                <select class="form-control" name="well_formed">
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>Heart Motion</label>
                                                <select class="form-control" name="heart_motion">
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Body Movement</label>
                                                <select class="form-control" name="body_movement">
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label>CRL</label>
                                                <input type="text" name="crl" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Age of Gestation Based on Today's Scan:</label>
                                            <input type="text" class="form-control" name="gestational_age">
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
                                            <textarea class="form-control" rows="4" style="resize: none;"></textarea>
                                        </div>
                                    </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="" class="next action-button" value="Confirm" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <h2 class="fs-title text-center">Success !</h2> <br><br>

                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5>Successfully Saved</h5>
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
@endsection