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
            background: #a4a4a4;
            font-size: 12px;
            font-family: Arial;
        }
        body {
            position: relative;
        }
        #print {
            background: #fff;
            width: 793px;
            /*height: 1122px;*/
            height: 1110px;
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
            margin-top: 50px;
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
        table { width: 100%; }
        .editable { cursor: pointer; }
        .buttons {
            text-align: center;
            width: 100%;
            margin:10px 0;
        }
        .sonographics tr td {
            padding: 6px 3px;
            vertical-align: top;
        }
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
        <table width="100%">
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
                <td>admission no.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">patient name:
                    <span>
                        <span id="fname" data-type="text" data-value="{{ $patient->fname }}" data-title="Enter First Name">{{ $patient->fname }}</span>
                        <span id="mname" data-type="text" data-value="{{ $patient->mname }}" data-title="Enter Middle Name">{{ $patient->mname }}</span>
                        <span id="lname" data-type="text" data-value="{{ $patient->lname }}" data-title="Enter Last Name">{{ $patient->lname }}</span>
                    </span>
                </td>

                <td>
                    age: <span id="age">{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    date of birth: <span id="dob" data-value="{{ $patient->dob }}" data-type="date" data-title="Date of Birth">{{ date('M d, Y',strtotime($patient->dob)) }}</span>
                </td>
            </tr>
            <tr>
                <?php
                $g = substr($adm->gp_code,0,1);
                $p = substr($adm->gp_code,-1);
                ?>
                <td colspan="3">G: <span id="g">{{ $g }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span id="p">{{ $p }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <span id="gp_code" data-value="{{ $adm->gp_code }}" data-title="GP">{{ $adm->gp_code }}</span> )</td>
            </tr>
            <tr>
                <td colspan="2">ward: <span id="ward" data-value="{{ $adm->ward }}" data-title="Enter Ward">{{ $adm->ward }}</span></td>
                <td>room/bed no.: <span id="room" data-value="{{ $adm->room }}" data-title="Enter Room No.">{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">referring physician: <span id="referring_doctor" data-value="{{ $adm->referring_doctor }}" data-title="Enter Referring Physician">{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">indication for scan: <span id="scan_indication" data-value="{{ $adm->scan_indication }}" data-title="Enter Indication for Scan">{{ $adm->scan_indication }}</span></td>
            </tr>

        </table>
        <hr>
        <br>
        <strong>
            <center>sonographic findings worksheet</center>
        </strong>
        <br>
        <table class="sonographics">
            <tr>
                <td width="15%">scan:</td>
                <td width="20%">
                    <label>
                        <input type="checkbox" name="scan" data-table="sonographic" value="Transrectal" @if($sono->scan=='Transrectal') checked @endif> Transrectal
                    </label>
                </td>
                <td width="20%">
                    <label>
                        <input type="checkbox" name="scan" data-table="sonographic" value="Transvaginal" @if($sono->scan=='Transvaginal') checked @endif> Transvaginal
                    </label>
                </td>
                <td width="20%">
                    <label>
                        <input type="checkbox" name="scan" data-table="sonographic" value="Sis" @if($sono->scan=='Sis') checked @endif> Sis
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" name="scan" data-table="sonographic" value="Transabdominal" @if($sono->scan=='Transabdominal') checked @endif> Transabdominal
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="5">cervix: <span class="edit" data-name="cervix" data-title="Cervix">{{ $sono->cervix }}</span></td>
            </tr>
            <tr>
                <td colspan="5">uterine corpus: <span class="edit" data-name="uterine" data-title="Uterine Corpus">{{ $sono->uterine }}</span></td>
            </tr>
            <tr>
                <td colspan="5">endometrium: <span class="edit" data-name="endometrium" data-title="Endometrium">{{ $sono->endometrium }}</span></td>
            </tr>
            <tr>
                <td>ovaries</td>
                <td colspan="4">right: <span class="edit" data-name="right_ovary" data-title="Right Ovary">{{ $sono->right_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">follicles:</td>
                <td colspan="3"><span class="edit" data-name="right_follicles" data-title="Follicles (right)">{{ $sono->right_follicles }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="4">left: <span class="edit" data-name="left_ovary" data-title="Left Ovary">{{ $sono->left_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">follicles:</td>
                <td colspan="3"><span class="edit" data-name="left_follicles" data-title="Follicles (left)">{{ $sono->left_follicles }}</span></td>
            </tr>
            <tr>
                <td colspan="5" style="height: 150px;">
                    Other findings:

                    <p style="padding: 10px; text-transform: none;">
                        <span class="textarea" data-name="findings" data-title="Other Findings">{{ $sono->findings }}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="height: 150px;">
                    Remarks:

                    <p style="padding: 10px; text-transform: none;">
                        <span class="textarea" data-name="remarks" data-title="Remarks">{{ $sono->remarks }}</span>
                    </p>
                </td>
            </tr>
        </table>

        <div class="sign">
            <?php
            $doc = \App\Doctor::find($sono->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                <span id="ob_doctor" data-type="select" data-title="Select OB-GYN Sonologist" data-value="{{ $sono->ob_doctor }}">
                    @if($sono->ob_doctor)
                        Dr. {{ $doc->fname }} {{ $doc->mname }} {{ $doc->lname }}
                    @endif
                </span>
            </div>
            ob-gyn sonologist <small style="text-transform: none;"><em>(Signature over Printed Name)</em></small>
        </div>
        <div style="clear: both"></div>
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
@include('xeditable.sonographic')
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
            }else if(table === 'sonographic'){

                var sonographicData = {
                    'name' : box.attr("name"),
                    'value': box.val(),
                    'pk': sonoID
                };
                $.ajax({
                    url: sonoURL,
                    type: 'POST',
                    data: sonographicData
                });
                console.log(sonographicData);
            }
        } else {
            box.prop("checked", false);
        }
    });
</script>
</body>
</html>