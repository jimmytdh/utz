<html lang="en">
<head>
    <title>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</title>
    <style>
        @page { margin: 0.5cm }
        body { margin: 0px; }
        body {
            font-family: Arial;
            position: relative;
            font-size: 13px;
            margin-top: 2.5cm;
            margin-bottom: 1cm;
        }
        #print {
            margin: 0px auto;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;

            /** Extra personal styles **/
            text-align: center;
        }

        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
            color: #8c8c8c;
            text-align: center;
        }

        .wrapper {
            padding:20px 50px;
        }
        .b-border, span {
            border-bottom: 1px solid #111;
            font-weight: bold;
        }
        .sign {
            width: 290px;
            float: right;
            margin-top: 30px;
        }

        .logo {
            width: 70px;
            position: absolute;
            top: 0;
        }
        .doh { right: 40px;}
        .csmc { left: 40px; }
        .ob { left: 120px; }
        input[type=checkbox] {
            display: inline;
            font-size: 10pt;
        }
        table { width: 100%;border-collapse: collapse; }
        label { font-weight: bold; }
    </style>
</head>
<body>
<div id="print">
    <header>
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
    </header>
    <div class="wrapper">
        <table>
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
                <td width="30%">Time Started:<span>{{ date('h:i A',strtotime($adm->date_started)) }}</span></td>
                <td width="30%">Time Ended: <span>{{ date('h:i A',strtotime($adm->date_ended)) }}</span></td>
                <td width="40%">Date: <span>{{ date('M d, Y',strtotime($adm->date_started)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">Hospital No.: <span>{{ $patient->hospital_no }}</span></td>
                <td>Date of Birth: <span>{{ date('M d, Y',strtotime($patient->dob)) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">Admission No.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
                <td>Age: <span>{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">Patient Name:<span>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</span></td>
                <td>Room/Bed No.: <span>{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">Ward: <span>{{ $adm->ward }}</span></td>
            </tr>
            <tr>
                <td colspan="3">Referring Physician: <span>{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">Indication for Scan: <span>{{ $adm->scan_indication }}</span></td>
            </tr>
            <tr>
                <?php
                $g = substr($adm->gp_code,0,1);
                $p = substr($adm->gp_code,-1);
                ?>
                <td>G: <span>{{ $g }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span>{{ $p }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <span>{{ $adm->gp_code }}</span> )</td>
                <td colspan="2">LMP: <span>{{ $adm->lmp }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AOG: <span>{{ $adm->menstrual_age }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EDC: <span>{{ $adm->edc }}</span></td>
            </tr>
        </table>
        <hr>
        <br>
        <strong>
            <center>Early Pregnancy Worksheet</center>
        </strong>
        <br>
        <table width="100%">
            <tr>
                <td width="33%"><label>Scan:</label></td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->scan_type=='Transvaginal') checked @endif> Transvaginal
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->scan_type=='Transabdominal') checked @endif> Transabdominal
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table width="100%">
            <tr>
                <td width="33%"><label>Gestational Sac Visualized</label></td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->gestational_sac=='Y') checked @endif> Yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->gestational_sac=='N') checked @endif> No
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="5%"></td>
                <td width="28%">Location</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->location=='Intrauterine') checked @endif> Intrauterine
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->location=='Extrauterine') checked @endif> Extrauterine
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Borders</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->borders=='Thick and Well-Defined') checked @endif> Thick and Well-Defined
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->borders=='Abnormal') checked @endif> Abnormal
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Means Sac Diameter</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->mean_sac=='Present') checked @endif> Present
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->mean_sac=='Absent') checked @endif> Absent
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Yolk Sac</td>
                <td colspan="2"><span>{{ $early->yolk_sac }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td>Subchorionic Hemorrhage</td>
                <td colspan="2"><span>{{ $early->subchrionic }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="33%"><label>Fetus Recognized</label></td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->fetus=='Yes') checked @endif> Yes
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->fetus=='No') checked @endif> No
                    </label>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="5%"></td>
                <td width="28%">Number</td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->number==1) checked @endif> Single
                    </label>
                </td>
                <td width="33%">
                    <label>
                        <input type="checkbox" @if($early->number > 1) checked @endif> Multiple <span id="number" style="visibility: {{ ($early->number > 1) ? 'visible' : 'hidden' }};">@if($early->number > 1) {{ $early->number }} @endif</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Well Formed</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->well_formed=='Y') checked @endif> Yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->well_formed=='N') checked @endif> No
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Heart Motion</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->heart_motion=='Y') checked @endif> Yes
                    </label>
                    &nbsp;&nbsp;&nbsp;
                    <span>{{ $early->heart_motion_desc }}</span>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->heart_motion=='N') checked @endif> No
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Body Movement</td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->body_movement=='Y') checked @endif> Yes
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($early->body_movement=='N') checked @endif> No
                    </label>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>CRL</td>
                <td colspan="2"><span>{{ $early->crl }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label>Age of Gestation Based on Today's Scan: </label></td>
                <td width="59%"><span>{{ $early->gestational_age }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label>Other Findings:</label></td>
            </tr>
            <tr>
                <td><br>{!! nl2br($early->other_findings) !!}</td>
            </tr>
        </table>
        <br>
        <br>
        <label>Remarks:</label>
        <div class="remarks" style="text-transform: none;">
            <br>
            {!! nl2br($early->remarks) !!}
        </div>
        <div class="sign">
            <?php
            $doc = \App\Doctor::find($early->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                @if($early->ob_doctor && $doc)
                    Dr. {{ $doc->fname }} {{ $doc->mname }} {{ $doc->lname }}
                @endif
            </div>
            OB-Gyn Sonologist <small><em>(Signature over Printed Name)</em></small>
        </div>
        <div style="clear: both;"></div>
        <footer class="footer">
            <br />
            NOTE: This report is based on Ultrasonographic findings and should be correlated clinically and with laboratory results.
        </footer>

    </div>
</div>

</body>

</html>