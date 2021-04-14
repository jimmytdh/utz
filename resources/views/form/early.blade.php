@extends('layout.app')
@section("title","Early Pregnancy: $patient->fname $patient->mname $patient->lname")
@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fa fa-check-circle"></i> Successfully Saved!
                </div>
            @endif
            <form method="post" id="formSubmit">
                {{ csrf_field() }}
                <div id="admissionSection" class="">
                    <h3 class="title-header">Admission Form</h3>
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
                            <input type="text" class="form-control" name="gp_code" value="{{ $adm->gp_code }}" data-inputmask='"mask": "9-9-9-9"' data-mask>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>LMP</label>
                            <input type="text" name="lmp" value="{{ $adm->lmp }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>AOG</label>
                            <input type="text" name="menstrual_age" value="{{ $adm->menstrual_age }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>EDC</label>
                            <input type="text" name="edc" value="{{ $adm->edc }}" class="form-control">
                        </div>
                    </div>
{{--                    <hr>--}}
{{--                    <div class="pull-right">--}}
{{--                        <button type="button" id="btnNext" class="btn btn-warning btn-flat">--}}
{{--                            Next--}}
{{--                            <i class="fa fa-angle-double-right"></i>--}}
{{--                        </button>--}}
{{--                    </div>--}}
                </div>
                <div id="formSection" class="">
                    <h3 class="title-header">Early Pregnancy Worksheet</h3>
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
                            <select class="custom-select" name="gestational_sac">
                                <option value="">Select</option>
                                <option @if($early->gestational_sac=='Y') selected @endif value="Y">Yes</option>
                                <option @if($early->gestational_sac=='N') selected @endif value="N">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-4">
                            <label>Location</label>
                            <select class="custom-select" name="location">
                                <option value="">Select</option>
                                <option @if($early->location=='Intrauterine') selected @endif >Intrauterine</option>
                                <option @if($early->location=='Extrauterine') selected @endif>Extrauterine</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Borders</label>
                            <select class="custom-select" name="borders">
                                <option value="">Select</option>
                                <option @if($early->borders=='Thick and Well-Defined') selected @endif >Thick and Well-Defined</option>
                                <option @if($early->borders=='Abnormal') selected @endif>Abnormal</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Means Sac Diameter</label>
                            <select class="custom-select" name="mean_sac">
                                <option value="">Select</option>
                                <option @if($early->mean_sac=='Present') selected @endif >Present</option>
                                <option @if($early->mean_sac=='Absent') selected @endif>Absent</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Yolk Sac</label>
                            <input type="text" value="{{ $early->yolk_sac }}" name="yolk_sac" class="form-control">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Subchorionic Hemorrhage</label>
                            <input type="text" value="{{ $early->subchrionic }}" name="subchrionic" class="form-control">
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Fetus Recognized</label>
                            <select class="custom-select" name="fetus">
                                <option value="">Select</option>
                                <option @if($early->fetus=='Yes') selected @endif >Yes</option>
                                <option @if($early->fetus=='No') selected @endif>No</option>
                            </select>
                        </div>
                        <div class="form-group {{ ($early->number==1) ? 'col-4':'col-3' }}">
                            <label>Number</label>
                            <select class="custom-select" name="number" id="number">
                                <option value="">Select</option>
                                <option @if($early->number==1) selected @endif value="1">Single</option>
                                <option @if($early->number>1) selected @endif value="2">Multiple</option>
                            </select>
                        </div>
                        <div class="form-group col-1 {{ ($early->number==1) ? 'hidden':'' }}" id="multiple">
                            <label>Enter #</label>
                            <input type="number" value="{{ $early->number }}" class="form-control" name="number">
                        </div>
                        <div class="form-group col-4">
                            <label>Well Formed</label>
                            <select class="custom-select" name="well_formed">
                                <option value="">Select</option>
                                <option @if($early->well_formed=='Y') selected @endif value="Y">Yes</option>
                                <option @if($early->well_formed=='N') selected @endif value="N">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-3">
                            <label>Heart Motion</label>
                            <select class="custom-select" name="heart_motion">
                                <option value="">Select</option>
                                <option @if($early->heart_motion=='Y') selected @endif value="Y">Yes</option>
                                <option @if($early->heart_motion=='N') selected @endif value="N">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-1">
                            <label>&nbsp;</label>
                            <input type="text" class="form-control" name="heart_motion_desc" value="{{ $early->heart_motion_desc }}">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Body Movement</label>
                            <select class="custom-select" name="body_movement">
                                <option value="">Select</option>
                                <option @if($early->body_movement=='Y') selected @endif value="Y">Yes</option>
                                <option @if($early->body_movement=='N') selected @endif value="N">No</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-4">
                            <label>CRL</label>
                            <input type="text" class="form-control" name="crl" value="{{ $early->crl }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Age of Gestation Based on Today's Scan:</label>
                        <input type="text" name="gestational_age" value="{{ $early->gestational_age }}" class="form-control" />
                    </div>
                    <hr>
{{--                    <div class="form-row">--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Right Ovary</label>--}}
{{--                            <textarea class="form-control" rows="5" style="resize: none;" name="right_ovary">{!! $early->right_ovary !!}</textarea>--}}
{{--                        </div>--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            <label>Left Ovary</label>--}}
{{--                            <textarea class="form-control" rows="5" style="resize: none;" name="left_ovary">{!! $early->left_ovary !!}</textarea>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Other Findings:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="other_findings">{!! $early->other_findings !!}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Remarks:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="remarks">{!! $early->remarks !!}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">OB-GYN Sonologist:</h3>
                            <select class="custom-select" name="ob_doctor">
                                <option value="0">Select</option>
                                @foreach($doctors as $d)
                                <option value="{{ $d->id }}" @if($early->ob_doctor==$d->id) selected @endif>Dr. {{ $d->fname }} {{ $d->mname }} {{ $d->lname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="pull-right">
{{--                        <button type="button" id="btnBack" class="btn btn-warning btn-flat">--}}
{{--                            <i class="fa fa-angle-double-left"></i>--}}
{{--                            Back</button>--}}
                        <a href="{{ url('patient/history/'.$patient->id) }}" class="btn btn-primary">
                            <i class="fa fa-angle-double-left"></i> Back
                        </a>
                        <button type="button" class="btn btn-danger" onclick="deleteRecord({{ $adm->id }})">
                            <i class="fa fa-trash"></i> Delete
                        </button>
                        <a href="{{ url('print/earlyPregnancy/'.$adm->id) }}" class="btn btn-warning" target="_blank">
                            <i class="fa fa-print"></i> Print
                        </a>
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
    <script src="{{ asset('/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <script>
        $('[data-mask]').inputmask();
        // $('input').on('keyup keypress', function(e) {
        //     var keyCode = e.keyCode || e.which;
        //     if (keyCode === 13) {
        //         e.preventDefault();
        //         return false;
        //     }
        // });
        function deleteRecord(admID)
        {
            var c = confirm('Are you sure you want to delete this record?');
            if(c){
                $.ajax({
                    url: "<?php echo e(route('delete.admission')); ?>",
                    type: "POST",
                    data: {
                        admID: admID
                    },
                    success: function(){
                        window.location.replace("<?php echo e(url('patient/history/'.$patient->id)); ?>");
                    }
                });
            }
        }

        // $("#btnNext").on('click',function(){
        //     $("#admissionSection").addClass('hidden');
        //     $("#formSection").removeClass('hidden');
        // });
        //
        // $("#btnBack").on('click',function(){
        //     $("#admissionSection").removeClass('hidden');
        //     $("#formSection").addClass('hidden');
        // });

        $("#number").on('change',function(){
            var num = $(this).val();
            if(num > 1){
                $(this).parent().removeClass('col-4').addClass('col-3');
                $("#multiple").removeClass('hidden');
            }else{
                $(this).parent().removeClass('col-3').addClass('col-4');
                $("#multiple").addClass('hidden');
            }
        });
    </script>
@endsection