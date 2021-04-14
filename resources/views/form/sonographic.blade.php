@extends('layout.app')
@section("title","Sonographic Findings: $patient->fname $patient->mname $patient->lname")
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
                        <div class="form-group col-sm-4">
                            <label>Referring Physician</label>
                            <input type="text" name="referring_doctor" value="{{ $adm->referring_doctor }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <label>Indication for Scan</label>
                            <input type="text" name="scan_indication" value="{{ $adm->scan_indication }}" class="form-control">
                        </div>
                        <div class="form-group col-sm-4">
                            <?php
                            $g = substr($adm->gp_code,0,1);
                            $p = substr($adm->gp_code,-1);
                            ?>
                            <label>G: <span id="g">{{ $g }}</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span id="p">{{ $p }}</span> </label>
                            <input type="text" class="form-control" name="gp_code" value="{{ $adm->gp_code }}" data-inputmask='"mask": "9-9-9-9"' data-mask>
                        </div>
                    </div>
                </div>
                <div id="formSection" class="">
                    <h3 class="title-header">Sonographic Findings Worksheet</h3>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Scan</label>
                            <select class="custom-select" name="scan">
                                <option value="">Select</option>
                                <option @if($sono->scan=='Transrectal') selected @endif>Transrectal</option>
                                <option @if($sono->scan=='Transvaginal') selected @endif>Transvaginal</option>
                                <option @if($sono->scan=='SIS') selected @endif>SIS</option>
                                <option @if($sono->scan=='Transabdominal') selected @endif>Transabdominal</option>
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Cervix</label>
                            <input type="text" name="cervix" class="form-control" value="{{ $sono->cervix }}" />
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Uterine</label>
                            <input type="text" name="uterine" class="form-control" value="{{ $sono->uterine }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Endometrium</label>
                            <input type="text" name="endometrium" class="form-control" value="{{ $sono->endometrium }}" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Right Ovary</label>
                            <input type="text" name="right_ovary" class="form-control" value="{{ $sono->right_ovary }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label><em>Follicles</em></label>
                            <input type="text" name="right_follicles" class="form-control" value="{{ $sono->right_follicles }}" />
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-sm-6">
                            <label>Left Ovary</label>
                            <input type="text" name="left_ovary" class="form-control" value="{{ $sono->left_ovary }}" />
                        </div>
                        <div class="form-group col-sm-6">
                            <label><em>Follicles</em></label>
                            <input type="text" name="left_follicles" class="form-control" value="{{ $sono->left_follicles }}" />
                        </div>
                    </div>

                    <hr>

                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Other Findings:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="findings">{!! $sono->findings !!}</textarea>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">Remarks:</h3>
                            <textarea class="form-control" rows="6" style="resize: none;" name="remarks">{!! $sono->remarks !!}</textarea>
                        </div>
                    </div>

                    <hr>
                    <div class="form-row">
                        <div class="form-group col-sm-12">
                            <h3 class="text-danger">OB-GYN Sonologist:</h3>
                            <select class="custom-select" name="ob_doctor">
                                <option value="0">Select</option>
                                @foreach($doctors as $d)
                                    <option value="{{ $d->id }}" @if($sono->ob_doctor==$d->id) selected @endif>Dr. {{ $d->fname }} {{ $d->mname }} {{ $d->lname }}</option>
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
                        <a href="{{ url('print/sonographic/'.$adm->id) }}" class="btn btn-warning" target="_blank">
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

        function deleteRecord(admID)
        {
            var c = confirm('Are you sure you want to delete this record?');
            if(c){
                $.ajax({
                    url: "{{ route('delete.admission') }}",
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
    </script>
@endsection