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
            margin-top: 10px;
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
                <td>date of birth: <span>{{ date('M d, Y',strtotime($patient->dob)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">admission no.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
                <td>age: <span>{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">patient name: <span>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</span></td>
                <td>room/bed no.: <span>{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">ward: <span>{{ $adm->ward }}</span></td>
            </tr>
            <tr>
                <td colspan="3">referring physician: <span>{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">indication for scan: <span>{{ $adm->scan_indication }}</span></td>
            </tr>
            <tr>
                <?php
                    $g = substr($adm->gp_code,0,1);
                    $p = substr($adm->gp_code,-1);
                ?>
                <td>G: {{ $g }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: {{ $p }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( {{ $adm->gp_code }} )</td>
                <td>lmp: <span>{{ $adm->lmp }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; pmp: <span>{{ $adm->pmp }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>menstrual age: <span>{{ $adm->menstrual_age }}</span></td>
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
                        <input type="checkbox" @if($early->scan_type=='Transvaginal') checked @endif> transvaginal
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->scan_type=='Transabdominal') checked @endif> transabdominal
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
                        <input type="checkbox" @if($early->gestational_sac=='Y') checked @endif> yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->gestational_sac=='N') checked @endif> no
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
                        <input type="checkbox" @if($early->location=='Intrauterine') checked @endif> intrauterine
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->location=='Extrauterine') checked @endif> extrauterine
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>borders</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->borders=='Thick and Well-Defined') checked @endif> thick and well-defined
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->borders=='Abnormal') checked @endif> abnormal
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>means sac diameter</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->mean_sac=='Present') checked @endif> present
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->mean_sac=='Absent') checked @endif> absent
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>yolk sac</td>
                <td colspan="2"><span>{{ $early->yolk_sac }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td>subchorionic hemorrhage</td>
                <td colspan="2"><span>{{ $early->subchrionic }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="33%">fetus recognized</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->fetus=='Yes') checked @endif> yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->fetus=='No') checked @endif> no
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
                        <input type="checkbox" @if($early->number==1) checked @endif> single
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->number > 1) checked @endif> multiple <span>@if($early->number > 1) {{ $early->number }} @endif</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>well formed</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->well_formed=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->well_formed=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>heart motion</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->heart_motion=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->heart_motion=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>body movement</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->body_movement=='Y') checked @endif> yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->body_movement=='N') checked @endif> no
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>crl</td>
                <td colspan="2"><span>{{ $early->crl }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td>age of gestation based on today's scan: </td>
                <td width="59%"><span>{{ $early->gestational_age }}</span></td>
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
                <td><span>{{ $early->right_ovary }}</span></td>
            </tr>
            <tr>
                <td width="15%"></td>
                <td width="15%">left ovary: </td>
                <td><span>{{ $early->left_ovary }}</span></td>
            </tr>
        </table>
        <br>
        <br>
        remarks:
        <div class="remarks" style="text-transform: none;">
            {!! nl2br($early->remarks) !!}
        </div>
        <div class="sign">
            <?php
                $doc = \App\Doctor::find($early->ob_doctor);
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