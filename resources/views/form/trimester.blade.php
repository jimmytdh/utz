@extends('layout.app')
@section("title","2nd and 3rd Trimester: $patient->fname $patient->mname $patient->lname")
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

                </div>
                <div id="formSection" class="">
                    <h3 class="title-header">2nd and 3rd Trimester Worksheet</h3>
                    <div class="form-row">
                        <div class="form-group {{ ($tri->number==1 || $tri->number==0) ? 'col-3':'col-2' }}">
                            <label>Number of Fetus</label>
                            <select class="custom-select" name="fetus_no" id="number">
                                <option value="">Select</option>
                                <option @if($tri->fetus_no==1) selected @endif value="1">Single</option>
                                <option @if($tri->fetus_no>1) selected @endif value="2">Multiple</option>
                            </select>
                        </div>
                        <div class="form-group col-1 {{ ($tri->number==1 || $tri->number==0) ? 'hidden':'' }}" id="multiple">
                            <label>Enter #</label>
                            <input type="number" value="{{ $tri->number }}" class="form-control" name="fetus_no">
                        </div>
                        <div class="form-group col-3">
                            <label>Presentation:</label>
                            <input type="text" name="presentation" value="{{ $tri->presentation }}" class="form-control" />
                        </div>
                        <div class="form-group col-3">
                            <label>Heart Activity:</label>
                            <input type="text" name="heart_activity" value="{{ $tri->heart_activity }}" class="form-control" />
                        </div>
                        <div class="form-group col-3">
                            <label>Gender</label>
                            <select class="custom-select" name="gender">
                                <option value="">Select</option>
                                <option @if($tri->gender=='Girl') selected @endif>Girl</option>
                                <option @if($tri->gender=='Boy') selected @endif>Boy</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>BPD:</label>
                            <input type="text" name="bpd" value="{{ $tri->bpd }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>HC:</label>
                            <input type="text" name="hc" value="{{ $tri->hc }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>FL:</label>
                            <input type="text" name="fl" value="{{ $tri->fl }}" class="form-control" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>FAC:</label>
                            <input type="text" name="fac" value="{{ $tri->fac }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>SEFW:</label>
                            <input type="text" name="sefw" value="{{ $tri->sefw }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>Others:</label>
                            <input type="text" name="others" value="{{ $tri->others }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Age of Gestation Based on Today's Scan:</label>
                        <input type="text" name="gestation_age" value="{{ $tri->gestation_age }}" class="form-control" />
                    </div>

                    <h3 class="text-danger">Amniotic Fluid</h3>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>AFI:</label>
                            <input type="text" name="afi" value="{{ $tri->afi }}" class="form-control" />
                        </div>
                        <div class="form-group col-6">
                            <label>Single Vertical Pocket:</label>
                            <input type="text" name="single_vertical" value="{{ $tri->single_vertical }}" class="form-control" />
                        </div>
                    </div>

                    <h3 class="text-danger">Placenta</h3>
                    <div class="form-row">
                        <div class="form-group col-4">
                            <label>Location:</label>
                            <input type="text" name="location" value="{{ $tri->location }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>Grade:</label>
                            <input type="text" name="grade" value="{{ $tri->grade }}" class="form-control" />
                        </div>
                        <div class="form-group col-4">
                            <label>Abnormality:</label>
                            <input type="text" name="abnormality" value="{{ $tri->abnormality }}" class="form-control" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Cord Vessels:</label>
                        <input type="text" name="cord_vessels" value="{{ $tri->cord_vessels }}" class="form-control" />
                    </div>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label>Biophysical Score:</label>
                            <table class="table table-sm table-striped">
                                <tr>
                                    <td></td>
                                    <th>Null</th>
                                    <th>0</th>
                                    <th>2</th>
                                </tr>
                                <tr>
                                    <td>NSD</td>
                                    <th><input type="radio" name="nst" value="-1" @if($tri->nst==-1) checked @endif></th>
                                    <th><input type="radio" name="nst" value="0" @if($tri->nst==0) checked @endif></th>
                                    <th><input type="radio" name="nst" value="2" @if($tri->nst==2) checked @endif></th>
                                </tr>
                                <tr>
                                    <td>Amniotic Fluid</td>
                                    <th><input type="radio" name="amniotic" value="-1" @if($tri->amniotic==-1) checked @endif></th>
                                    <th><input type="radio" name="amniotic" value="0" @if($tri->amniotic==0) checked @endif></th>
                                    <th><input type="radio" name="amniotic" value="2" @if($tri->amniotic==2) checked @endif></th>
                                </tr>
                                <tr>
                                    <td>Body Movement</td>
                                    <th><input type="radio" name="body_movement" value="-1" @if($tri->body_movement==-1) checked @endif></th>
                                    <th><input type="radio" name="body_movement" value="0" @if($tri->body_movement==0) checked @endif></th>
                                    <th><input type="radio" name="body_movement" value="2" @if($tri->body_movement==2) checked @endif></th>
                                </tr>
                                <tr>
                                    <td>Fetal Tone</td>
                                    <th><input type="radio" name="fetal_tone" value="-1" @if($tri->fetal_tone==-1) checked @endif></th>
                                    <th><input type="radio" name="fetal_tone" value="0" @if($tri->fetal_tone==0) checked @endif></th>
                                    <th><input type="radio" name="fetal_tone" value="2" @if($tri->fetal_tone==2) checked @endif></th>
                                </tr>
                                <tr>
                                    <td>Fetal Breathing</td>
                                    <th><input type="radio" name="fetal_breathing" value="-1" @if($tri->fetal_breathing==-1) checked @endif></th>
                                    <th><input type="radio" name="fetal_breathing" value="0" @if($tri->fetal_breathing==0) checked @endif></th>
                                    <th><input type="radio" name="fetal_breathing" value="2" @if($tri->fetal_breathing==2) checked @endif></th>
                                </tr>
                            </table>
                        </div>
                        <div class="form-group col-6">
                            <label>Fatal Anatomic Survey:</label>
                            <select multiple name="fatal_anatomic[]" class="custom-select" id="fatal_anatomic" size="7">
                                <option @if($tri->cerebral=='Y') selected @endif value="cerebral">Cerebral Bentricles</option>
                                <option @if($tri->cranium=='Y') selected @endif value="cranium">Cranium</option>
                                <option @if($tri->face=='Y') selected @endif value="face">Face</option>
                                <option @if($tri->spine=='Y') selected @endif value="spine">Spine</option>
                                <option @if($tri->heart=='Y') selected @endif value="heart">Heart 4-CH View</option>
                                <option @if($tri->stomach=='Y') selected @endif value="stomach">Stomach</option>
                                <option @if($tri->abnormal_wall=='Y') selected @endif value="abnormal_wall">Ant. Abnormal Wal</option>
                                <option @if($tri->insertion=='Y') selected @endif value="insertion">Insertion of Umbilical Vessels</option>
                                <option @if($tri->kidneys=='Y') selected @endif value="kidneys">Kidneys</option>
                                <option @if($tri->bladder=='Y') selected @endif value="bladder">Bladder</option>
                                <option @if($tri->upper_extremities=='Y') selected @endif value="upper_extremities">Upper Extremities</option>
                                <option @if($tri->lower_extremities=='Y') selected @endif value="lower_extremities">Lower Extremities</option>
                                <option @if($tri->atypical_finds=='Y') selected @endif value="atypical_finds">Atypical Findings</option>
                            </select>

                            <input type="text" value="{{ $tri->atypical_finds_desc }}" name="atypical_finds_desc" id="atypical_finds_desc" class="form-control mt-2 @if($tri->atypical_finds!='Y') hidden @endif" placeholder="Atypical Findings" />
                        </div>
                    </div>
                    <hr>

                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Other Findings:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="other_findings">{!! $tri->other_findings !!}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Remarks:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="remarks">{!! $tri->remarks !!}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">OB-GYN Sonologist:</h3>
                            <select class="custom-select" name="ob_doctor">
                                <option value="0">Select</option>
                                @foreach($doctors as $d)
                                    <option value="{{ $d->id }}" @if($tri->ob_doctor==$d->id) selected @endif>Dr. {{ $d->fname }} {{ $d->mname }} {{ $d->lname }}</option>
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
                        <a href="{{ url('print/trimester/'.$adm->id) }}" class="btn btn-warning" target="_blank">
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
                $(this).parent().removeClass('col-3').addClass('col-2');
                $("#multiple").removeClass('hidden');
            }else{
                $(this).parent().removeClass('col-2').addClass('col-3');
                $("#multiple").addClass('hidden');
            }
        });

        $("#fatal_anatomic").on('change',function (){
            var obj = $(this).val();
            if(obj.indexOf('atypical_finds') !== -1){
                $("#atypical_finds_desc").removeClass('hidden');
            }else{
                $("#atypical_finds_desc").addClass('hidden');
            }
        });
    </script>
@endsection