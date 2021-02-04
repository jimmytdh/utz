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
            font-size: 12px !important;
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
            margin-top: 40px;
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
            max-height: 100px;
            /*border:1px solid #ccc;*/
            height:100px;
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
            <center>early pregnancy worksheet</center>
        </strong>
        <br>
        <table width="100%">
            <tr>
                <td width="33%">scan:</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="scan_type" value="Transvaginal" data-table="early" @if($early->scan_type=='Transvaginal') checked @endif> transvaginal
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="scan_type" value="Transabdominal" data-table="early" @if($early->scan_type=='Transabdominal') checked @endif> transabdominal
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="33%">gestational sac visualized</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="gestational_sac" data-table="early" value="Y" @if($early->gestational_sac=='Y') checked @endif> yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="gestational_sac" data-table="early" value="N" @if($early->gestational_sac=='N') checked @endif> no
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="5%"></td>
                <td width="28%">location</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="location" data-table="early" value="Intrauterine" @if($early->location=='Intrauterine') checked @endif> intrauterine
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="location" data-table="early" value="Extrauterine" @if($early->location=='Extrauterine') checked @endif> extrauterine
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>borders</td>
                <td>
                    <label>
                        <input type="checkbox" name="borders" data-table="early" value="Thick and Well-Defined" @if($early->borders=='Thick and Well-Defined') checked @endif> thick and well-defined
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="borders" data-table="early" value="Abnormal" @if($early->borders=='Abnormal') checked @endif> abnormal
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>means sac diameter</td>
                <td>
                    <label>
                        <input type="checkbox" name="mean_sac" data-table="early" value="Present" @if($early->mean_sac=='Present') checked @endif> present
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="mean_sac" data-table="early" value="Absent" @if($early->mean_sac=='Absent') checked @endif> absent
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>yolk sac</td>
                <td colspan="2"><span id="yolk_sac" data-title="Enter Yolk Sac" data-value="{{ $early->yolk_sac }}">{{ $early->yolk_sac }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td>subchorionic hemorrhage</td>
                <td colspan="2"><span id="subchrionic" data-title="Enter Subchorionic Hemorrhage" data-value="{{ $early->subchrionic }}">{{ $early->subchrionic }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="33%">fetus recognized</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="fetus" data-table="early" value="Yes" @if($early->fetus=='Yes') checked @endif> yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="fetus" data-table="early" value="No" @if($early->fetus=='No') checked @endif> no
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="5%"></td>
                <td width="28%">number</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="number" data-table="early" value="1" @if($early->number==1) checked @endif> single
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" name="number" data-table="early" value="2" @if($early->number > 1) checked @endif> multiple <span id="number" style="visibility: {{ ($early->number > 1) ? 'visible' : 'hidden' }};" data-title="Enter Number" data-value="{{ $early->number }}">@if($early->number > 1) {{ $early->number }} @endif</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>well formed</td>
                <td>
                    <label>
                        <input type="checkbox" name="well_formed" data-table="early" value="Y" @if($early->well_formed=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="well_formed" data-table="early" value="N" @if($early->well_formed=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>heart motion</td>
                <td>
                    <label>
                        <input type="checkbox" name="heart_motion" data-table="early" value="Y" @if($early->heart_motion=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="heart_motion" data-table="early" value="N" @if($early->heart_motion=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>body movement</td>
                <td>
                    <label>
                        <input type="checkbox" name="body_movement" data-table="early" value="Y" @if($early->body_movement=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="body_movement" data-table="early" value="N" @if($early->body_movement=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>crl</td>
                <td colspan="2"><span id="crl" data-title="Enter CRL">{{ $early->crl }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>age of gestation based on today's scan: </td>
                <td width="59%"><span class="earlyEdit" data-name="gestational_age" data-title="Age of Gestation Based on Today's Scan ">{{ $early->gestational_age }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td colspan="3">other findings:</td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="15%">right ovary: </td>
                <td><span class="earlyEdit" data-name="right_ovary" data-title="Findings Right Ovary">{{ $early->right_ovary }}</span></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="15%">left ovary: </td>
                <td><span class="earlyEdit" data-name="left_ovary" data-title="Findings Left Ovary">{{ $early->left_ovary }}</span></td>
            </tr>
        </table>
        <br>
        <br>
        remarks:
        <div class="remarks" style="text-transform: none;">
            <span id="remarks" data-title="Remarks">{{ $early->remarks }}</span>
        </div>
        <div class="sign">
            <?php
                $doc = \App\Doctor::find($early->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                <span id="ob_doctor" data-type="select" data-title="Select OB-GYN Sonologist" data-value="{{ $early->ob_doctor }}">
                    @if($early->ob_doctor && $doc)
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
@include('xeditable.earlyPregnancy')
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
            }else if(table === 'early'){
                if(box.attr("name")=='number'){
                    console.log(box.val())
                    if(box.val()==1){
                        $('#number').css('visibility','hidden');
                    }else{
                        $('#number').css('visibility','visible');
                        return true;
                    }
                }
                var earlyData = {
                    'name' : box.attr("name"),
                    'value': box.val(),
                    'pk': earlyID
                };
                $.ajax({
                    url: earlyUrl,
                    type: 'POST',
                    data: earlyData
                });
            }
        } else {
            box.prop("checked", false);
        }
    });
</script>
</body>

</html>