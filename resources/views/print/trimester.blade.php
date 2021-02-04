<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</title>
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-editable/css/bootstrap-editable.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-editable/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}">
    <link href="{{ url('/') }}/css/font-awesome.css" rel="stylesheet">
    <style>
        body {
            background: #a4a4a4 !important;
            font-size: 11px !important;
            font-family: Arial;
            position: relative;
        }
        #print {
            background: #fff;
            width: 793px;
            height: 1100px;
            border: 1px solid #ccc;
            margin: 0px auto;
            text-transform: uppercase;
        }
        .head {
            text-align: center;
            margin-top: 20px;
            text-transform: none;
        }
        .wrapper {
            padding:20px 50px;
        }
        .b-border, span {
            border-bottom: 1px solid #111;
            font-weight: bold;
        }
        .sign {
            width: 270px;
            float: right;
            margin-top: 10px;
        }
        .remarks {
            height:35px;
            padding: 10px;
        }
        .footer {
            text-transform: none;    
            font-size: 11px;
            color: #8c8c8c;
            text-align: center;
            margin-top: 30px;
            visibility: hidden;
        }
        .logo {
            width: 80px;
            position: absolute;
            top: 30px;
            visibility: hidden;
        }
        .doh { right: 20px;}
        .csmc { left: 20px; }
        .ob { left: 110px; }
        .editable { cursor: pointer; }
        .buttons {
            text-align: center;
            width: 100%;
            margin:10px 0;
        }
        td { vertical-align: top; }
        table { width: 100%; }
        @media print {

            body * {
                visibility: hidden !important;
            }
            #print  * {
                visibility: visible !important;
            }
            .editable {
                border-bottom: 1px solid #000;
            }
            .buttons {
                display: none;
            }
        }
    </style>
</head>
<body>
<div class="buttons">
    <a href="{{ url('patient/history/'.$patient->id) }}" class="btn btn-primary" style="text-decoration: none;">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <button class="btn btn-warning" onclick="window.print();return false;">
        <i class="fa fa-print"></i> Print
    </button>
    <button class="btn btn-danger" onclick="deleteRecord({{ $adm->id }})">
        <i class="fa fa-trash"></i> Delete Record
    </button>
</div>
<div id="print">
    <img src="{{ url('/images/logo.png') }}" class="logo csmc">
    <img src="{{ url('/images/doh.png') }}" class="logo doh">
    <img src="{{ url('/images/ob_logo.png') }}" class="logo ob">
    <div class="head">
        Republic of the Philippines<br>
        Department of Health - Regional Office No. VII<br>
        <strong>CEBU SOUTH MEDICAL CENTER</strong><br>
        San Isidro, Talisay City, Cebu<br>
        Department of Obstetrics & Gynecology<br>
        <strong>OB-GYN ULTRASOUND UNIT</strong>
    </div>

    <div class="wrapper">
        <table>
            <tr>
                <td width="25%">
                    <label>
                        <input type="checkbox" name="admission_type" value="private" data-table="admission" @if($adm->admission_type=='private') checked @endif> PRIVATE DIVISION
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" name="admission_type" value="clinical" data-table="admission" @if($adm->admission_type=='clinical') checked @endif> CLINICAL DIVISION
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" name="admission_type" value="opd" data-table="admission" @if($adm->admission_type=='opd') checked @endif> OUT-PATIENT
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" name="admission_type" value="in" data-table="admission" @if($adm->admission_type=='in') checked @endif> IN-PATIENT
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="30%">time started: <span id="date_started" data-type="combodate" data-title="Select Time" data-value="{{ date('h:i A',strtotime($adm->date_started)) }}">{{ date('h:i A',strtotime($adm->date_started)) }}</span></td>
                <td width="30%">time ended: <span id="date_ended" data-type="combodate" data-title="Select Time" data-value="{{ date('h:i A',strtotime($adm->date_ended)) }}">{{ date('h:i A',strtotime($adm->date_ended)) }}</span></td>
                <td width="40%">date: <span id="date" data-value="{{ date('M d, Y',strtotime($adm->date_started)) }}" data-type="date" data-title="Date of Visit">{{ date('M d, Y',strtotime($adm->date_started)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">hospital no.: <span id="hospital_no" data-title="Enter Hospital No.">{{ $patient->hospital_no }}</span></td>
                <td>date of birth: <span id="dob" data-value="{{ $patient->dob }}" data-type="date" data-title="Date of Birth">{{ date('M d, Y',strtotime($patient->dob)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">admission no.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
                <td>age: <span id="age">{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">patient name:
                    <span>
                        <span id="fname" data-type="text" data-value="{{ $patient->fname }}" data-title="Enter First Name">{{ $patient->fname }}</span>
                        <span id="mname" data-type="text" data-value="{{ $patient->mname }}" data-title="Enter Middle Name">{{ $patient->mname }}</span>
                        <span id="lname" data-type="text" data-value="{{ $patient->lname }}" data-title="Enter Last Name">{{ $patient->lname }}</span>
                    </span>
                </td>
                <td>room/bed no.: <span id="room" data-value="{{ $adm->room }}" data-title="Enter Room No.">{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">ward: <span id="ward" data-value="{{ $adm->ward }}" data-title="Enter Ward">{{ $adm->ward }}</span></td>
            </tr>
            <tr>
                <td colspan="3">referring physician: <span id="referring_doctor" data-value="{{ $adm->referring_doctor }}" data-title="Enter Referring Physician">{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">indication for scan: <span id="scan_indication" data-value="{{ $adm->scan_indication }}" data-title="Enter Indication for Scan">{{ $adm->scan_indication }}</span></td>
            </tr>
            <tr>
                <?php
                $g = substr($adm->gp_code,0,1);
                $p = substr($adm->gp_code,-1);
                ?>
                <td>G: <span id="g">{{ $g }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span id="p">{{ $p }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <span id="gp_code" data-value="{{ $adm->gp_code }}" data-title="GP">{{ $adm->gp_code }}</span> )</td>
                <td>lmp: <span id="lmp" data-value="{{ $adm->lmp }}" data-title="Enter LMP">{{ $adm->lmp }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pmp: <span id="pmp" data-value="{{ $adm->pmp }}" data-title="Enter PMP">{{ $adm->pmp }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>menstrual age: <span id="menstrual_age" data-value="{{ $adm->menstrual_age }}" data-title="Enter Menstrual Age">{{ $adm->menstrual_age }}</span></td>
            </tr>
        </table>
        <hr>
        <br>
        <strong>
            <center>second and third trimester worksheet</center>
        </strong>
        <br>
        <table>
            <tr>
                <td width="40%">number of fetus:</td>
                <td width="30%">
                    <label>
                        <input type="checkbox" name="fetus_no" data-table="trimester" value="1" @if($tri->fetus_no == 1) checked @endif> single
                    </label>
                </td>
                <td width="30%">
                    <label>
                        <input type="checkbox" name="fetus_no" data-table="trimester" value="2" @if($tri->fetus_no > 1) checked @endif>
                        multiple <span class="edit" id="fetus_no" data-name="fetus_no" style="visibility: {{ ($tri->fetus_no > 1) ? 'visible' : 'hidden' }};" data-title="Enter Fetus No." data-value="{{ $tri->fetus_no }}">{{ $tri->fetus_no }}</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>presentation: <span class="edit" data-name="presentation" data-title="Presentation">{{ $tri->presentation }}</span></td>
                <td>heart activity: <span class="edit" data-name="heart_activity" data-title="Heart Activity">{{ $tri->heart_activity }}</span></td>
                <td>gender: <span id="gender" data-type="select" data-title="Gender">@if($tri->gender) {{ ($tri->gender=='g') ? 'Girl':'Boy' }} @endif</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="25%">bpd: <span class="edit" data-name="bpd" data-title="BPD">{{ $tri->bpd }}</span></td>
                <td width="25%">hc: <span class="edit" data-name="hc" data-title="HC">{{ $tri->hc }}</span></td>
                <td width="25%">fl: <span class="edit" data-name="fl" data-title="FL">{{ $tri->fl }}</span></td>
                <td width="25%">fac: <span class="edit" data-name="fac" data-title="FAC">{{ $tri->fac }}</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">sefw: <span class="edit" data-name="sefw" data-title="SEFW">{{ $tri->sefw }}</span></td>
                <td colspan="2">others: <span class="edit" data-name="others" data-title="OTHERS">{{ $tri->others }}</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">
                    <strong>age of gestation based on today's scan: </strong>
                    <span class="edit" data-name="gestation_age" data-title="Age of Gestation">{{ $tri->gestation_age }}</span>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="50%">
                    <strong>amniotic fluid</strong>

                    <ol>
                        <li>afi: <span class="edit" data-name="afi" data-title="AFI">{{ $tri->afi }}</span></li>
                        <li>single vertical pocket: <span class="edit" data-name="single_vertical" data-title="Single Vertical Pocket">{{ $tri->single_vertical }}</span></li>
                    </ol>
                    <br>
                    <strong>placenta</strong>
                    <ol style="list-style: none">
                        <li>location: <span class="edit" data-name="location" data-title="Location">{{ $tri->location }}</span></li>
                        <li>grade: <span class="edit" data-name="grade" data-title="Grade">{{ $tri->grade }}</span></li>
                        <li>abnormality: <span class="edit" data-name="abnormality" data-title="Abnormality">{{ $tri->abnormality }}</span></li>
                    </ol>
                    <br>
                    Cord vessels: <span class="edit" data-name="cord_vessels" data-title="Cord Vessels">{{ $tri->cord_vessels }}</span>
                    <br>
                    <br>
                    <span>biophysical score</span>
                    <br>
                    <table style="width: 200px;">
                        <tr>
                            <td></td>
                            <th>0</th>
                            <th>2</th>
                        </tr>
                        <tr>
                            <td>nst</td>
                            <th><input type="radio" name="nst" value="0" @if($tri->nst==0) checked @endif></th>
                            <th><input type="radio" name="nst" value="2" @if($tri->nst==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>amniotic fluid</td>
                            <th><input type="radio" name="amniotic" value="0" @if($tri->amniotic==0) checked @endif></th>
                            <th><input type="radio" name="amniotic" value="2" @if($tri->amniotic==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>body movement</td>
                            <th><input type="radio" name="body_movement" value="0" @if($tri->body_movement==0) checked @endif></th>
                            <th><input type="radio" name="body_movement" value="2" @if($tri->body_movement==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>fetal tone</td>
                            <th><input type="radio" name="fetal_tone" value="0" @if($tri->fetal_tone==0) checked @endif></th>
                            <th><input type="radio" name="fetal_tone" value="2" @if($tri->fetal_tone==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>fetal breathing</td>
                            <th><input type="radio" name="fetal_breathing" value="0" @if($tri->fetal_breathing==0) checked @endif></th>
                            <th><input type="radio" name="fetal_breathing" value="2" @if($tri->fetal_breathing==2) checked @endif></th>
                        </tr>
                    </table>
                    <br>
                    <span><strong>Total: </strong></span>
                    <br>
                    <br>
                    <span><strong>doppler velocimetry: </strong></span>
                    <br>
                    <br>
                    <strong>Other Findings</strong>
                    <div class="remarks" style="text-transform: none;">
                        <span class="edit" data-name="other_findings" data-title="Other Findings">{{ $tri->other_findings }}</span>
                    </div>
                </td>
                <td>
                    <strong class="b-border"><em>fatal anatomic survey:</em></strong>
                    <br>
                    <br>
                    <ul style="list-style: none">
                        <li>
                            <label>
                                <input type="checkbox" name="cerebral" value="Y" data-table="trimester" @if($tri->cerebral=='Y') checked @endif> cerebral ventricles
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="cranium" value="Y" data-table="trimester" @if($tri->cranium=='Y') checked @endif> cranium
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="face" value="Y" data-table="trimester" @if($tri->face=='Y') checked @endif> face
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="spine" value="Y" data-table="trimester" @if($tri->spine=='Y') checked @endif> spine
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="heart" value="Y" data-table="trimester" @if($tri->heart=='Y') checked @endif> heart 4-ch view
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="stomach" value="Y" data-table="trimester" @if($tri->stomach=='Y') checked @endif> stomach
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="abnormal_wall" value="Y" data-table="trimester" @if($tri->abnormal_wall=='Y') checked @endif> ant. abnormal wal
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="insertion" value="Y" data-table="trimester" @if($tri->insertion=='Y') checked @endif> insertion of umbilical vessels
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="kidneys" value="Y" data-table="trimester" @if($tri->kidneys=='Y') checked @endif> kidneys
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="bladder" value="Y" data-table="trimester" @if($tri->bladder=='Y') checked @endif> bladder
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="upper_extremities" value="Y" data-table="trimester" @if($tri->upper_extremities=='Y') checked @endif> Upper Extremities
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="lower_extremities" value="Y" data-table="trimester" @if($tri->lower_extremities=='Y') checked @endif> Lower Extremities
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="atypical_finds" value="Y" data-table="trimester" @if($tri->atypical_finds=='Y') checked @endif> Atypical findings:
                                @if($tri->atypical_finds)
                                    <small><em><span class="edit" data-name="atypical_finds_desc" data-title="Atypical Findings">{{ $tri->atypical_finds_desc }}</span></em></small>
                                @endif
                            </label>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
        <br>
        remarks:
        <div class="remarks" style="text-transform: none;">
            <span class="edit" data-name="remarks" data-title="Remarks">{{ $tri->remarks }}</span>
        </div>
        <div class="sign">
            <?php
            $doc = \App\Doctor::find($tri->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                <span id="ob_doctor" data-type="select" data-title="Select OB-GYN Sonologist" data-value="{{ $tri->ob_doctor }}">
                    @if($tri->ob_doctor && $doc)
                        Dr. {{ $doc->fname }} {{ $doc->mname }} {{ $doc->lname }}
                    @endif
                </span>
            </div>
            ob-gyn sonologist <small style="text-transform: none;"><em>(Signature over Printed Name)</em></small>
        </div>
        <div style="clear: both;"></div>
        <div class="footer">
            NOTE: This report is based on Ultrasonographic findings and should be correlated clinically and with laboratory results.
        </div>

    </div>
</div>
<div class="buttons">
    <a href="{{ url('patient/history/'.$patient->id) }}" class="btn btn-primary" style="text-decoration: none;">
        <i class="fa fa-arrow-left"></i> Back
    </a>
    <button class="btn btn-warning" onclick="window.print();return false;">
        <i class="fa fa-print"></i> Print
    </button>
    <button class="btn btn-danger" onclick="deleteRecord({{ $adm->id }})">
        <i class="fa fa-trash"></i> Delete Record
    </button>
</div>
<script src="{{ asset('/js/jquery.min.js') }}"></script>
<script src="{{ url('/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-editable/js/bootstrap-editable.js') }}"></script>
@include('xeditable.patients')
@include('xeditable.admission')
@include('xeditable.trimester')
<script>
    // the selector will match all input controls of type :checkbox
    // and attach a click event handler
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var box = $(this);
        var table = box.data('table');
        if (box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            box.prop("checked", true);

            if(table === 'admission')
            {
                var admissionData = {
                    'name' : box.attr("name"),
                    'value': box.val(),
                    'pk': admID
                };
                $.ajax({
                    url: admUrl,
                    type: 'POST',
                    data: admissionData
                });
            }else if(table === 'trimester'){
                if(box.attr("name")=='fetus_no'){
                    console.log(box.val())
                    if(box.val()==1){
                        $('#fetus_no').css('visibility','hidden');
                    }else{
                        $('#fetus_no').css('visibility','visible');
                        return true;
                    }
                }
                var data = {
                    'name' : box.attr("name"),
                    'value': box.val(),
                    'pk': triID
                };

            }
        } else {
            box.prop("checked", false);
            var data = {
                'name' : box.attr("name"),
                'value': '',
                'pk': triID
            };
        }
        $.ajax({
            url: triURL,
            type: 'POST',
            data: data
        });
    });

    $("input:radio").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var box = $(this);
        var table = box.data('table');
        if (box.is(":checked")) {
            box.prop("checked", true);
                var data = {
                    'name' : box.attr("name"),
                    'value': box.val(),
                    'pk': triID
                };
                $.ajax({
                    url: triURL,
                    type: 'POST',
                    data: data
                });
        } else {
            box.prop("checked", false);
        }
    });
</script>
</body>

</html>