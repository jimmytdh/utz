@extends('layout.app')
@section('title','Sonographic Findings Worksheet')
@section('css')
    <link rel="stylesheet" href="{{ url('/css/step.css') }}">
@endsection
@section('content')
    <h2 class="title-header">Sonographic Findings Worksheet</h2>
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
                                        <div class="form-group">
                                            <label>GP:</label>
                                            <input type="text" class="form-control-sm" name="gp_code">
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

                                    </div> <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="form-group">
                                            <label>Scan</label>
                                            <select class="form-control" name="scan">
                                                <option>Transrectal</option>
                                                <option>Transvaginal</option>
                                                <option>SIS</option>
                                                <option>Transabdominal</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Cervix: </label>
                                            <input type="text" name="cervix" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Uterine Corpus: </label>
                                            <input type="text" name="uterine" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Endometrium: </label>
                                            <input type="text" name="endometrium" class="form-control">
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Right Ovary:</label>
                                                <input type="text" name="right_ovary" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label><em>Follicles:</em></label>
                                                <input type="text" name="right_follicles" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-sm-6">
                                                <label>Left Ovary:</label>
                                                <input type="text" name="left_ovary" class="form-control">
                                            </div>
                                            <div class="form-group col-sm-6">
                                                <label><em>Follicles:</em></label>
                                                <input type="text" name="left_follicles" class="form-control">
                                            </div>
                                        </div>
                                    </div> <input type="button" name="previous" class="previous action-button-previous" value="Previous" /> <input type="button" name="next" class="next action-button" value="Next Step" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-card">
                                        <div class="form-group">
                                            <label>Other Findings:</label>
                                            <input type="text" class="form-control" name="findings">
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
                    url: "{{ url('patient/sonographicfindings/'.$data->id) }}",
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