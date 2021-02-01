<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</title>
    <style>
        html {
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
            position: absolute;
            text-transform: none;
            bottom: 10px;
            font-size: 11px;
            color: #8c8c8c;
            left: 130px;
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
        table { width: 100%; }
        .sonographics tr td {
            padding: 6px 3px;
            vertical-align: top;
        }
        @media print {
            body * {
                visibility: hidden;
            }
            #print  * {
                visibility: visible;
            }
        }
    </style>
</head>
<body>
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
                        <input type="checkbox" @if($adm->admission_type=='private') checked @endif> PRIVATE DIVISION
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" @if($adm->admission_type=='clinical') checked @endif> CLINICAL DIVISION
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" @if($adm->admission_type=='opd') checked @endif> OUT-PATIENT
                    </label>
                </td>
                <td width="25%">
                    <label>
                        <input type="checkbox" @if($adm->admission_type=='in') checked @endif> IN-PATIENT
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="30%">time started: <span>{{ date('h:i A',strtotime($adm->date_started)) }}</span></td>
                <td width="30%">time ended: <span>{{ date('h:i A',strtotime($adm->date_ended)) }}</span></td>
                <td width="40%">date: <span>{{ date('M d, Y',strtotime($adm->date_started)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">hospital no.: <span>{{ $patient->hospital_no }}</span></td>
                <td>admission no.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">patient name: <span>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</span></td>

                <td>
                    age: <span>&nbsp;&nbsp;&nbsp;{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}&nbsp;&nbsp;&nbsp;</span>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    date of birth: <span>{{ date('M d, Y',strtotime($patient->dob)) }}</span>
                </td>
            </tr>
            <tr>
                <?php
                $g = substr($adm->gp_code,0,1);
                $p = substr($adm->gp_code,-1);
                ?>
                <td colspan="3">G: {{ $g }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: {{ $p }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( {{ $adm->gp_code }} )</td>
            </tr>
            <tr>
                <td colspan="2">ward: <span>{{ $adm->ward }}</span></td>
                <td>room/bed no.: <span>{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">referring physician: <span>{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">indication for scan: <span>{{ $adm->scan_indication }}</span></td>
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
                        <input type="checkbox" @if($sono->scan=='Transrectal') checked @endif> Transrectal
                    </label>
                </td>
                <td width="20%">
                    <label>
                        <input type="checkbox" @if($sono->scan=='Transvaginal') checked @endif> Transvaginal
                    </label>
                </td>
                <td width="20%">
                    <label>
                        <input type="checkbox" @if($sono->scan=='Sis') checked @endif> Sis
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($sono->scan=='Transabdominal') checked @endif> Transabdominal
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="5">cervix: <span>{{ $sono->cervix }}</span></td>
            </tr>
            <tr>
                <td colspan="5">uterine corpus: <span>{{ $sono->uterine }}</span></td>
            </tr>
            <tr>
                <td colspan="5">endometrium: <span>{{ $sono->endometrium }}</span></td>
            </tr>
            <tr>
                <td>ovaries</td>
                <td colspan="4">right: <span>{{ $sono->right_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">follicles:</td>
                <td colspan="3"><span>{{ $sono->right_follicles }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="4">left: <span>{{ $sono->left_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">follicles:</td>
                <td colspan="3"><span>{{ $sono->left_follicles }}</span></td>
            </tr>
            <tr>
                <td colspan="5" style="height: 150px;">
                    Other findings:

                    <p style="padding: 10px; text-transform: none;">
                        {!! nl2br($sono->findings) !!}
                    </p>
                </td>
            </tr>
            <tr>
                <td colspan="5" style="height: 150px;">
                    Remarks:

                    <p style="padding: 10px; text-transform: none;">
                        {!! nl2br($sono->remarks) !!}
                    </p>
                </td>
            </tr>
        </table>

        <div class="sign">
            <?php
            $doc = \App\Doctor::find($sono->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">Dr. {{ $doc->fname }} {{ $doc->mname }} {{ $doc->lname }}</div>
            ob-gyn sonologist <small style="text-transform: none;"><em>(Signature over Printed Name)</em></small>
        </div>
        <div style="clear: both"></div>
        <div class="footer">
            NOTE: This report is based on Ultrasonographic findings and should be correlated clinically and with laboratory results.
        </div>
    </div>
</div>
</body>
</html>