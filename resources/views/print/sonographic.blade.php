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
                <td colspan="2">Admission No.: <span>{{ date('Y') }}-{{ str_pad($adm->id,4,0,STR_PAD_LEFT) }}</span></td>
            </tr>
            <tr>
                <td colspan="2">Patient Name:<span>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</span></td>
                <td>Age: <span>{{ \App\Http\Controllers\ConfigController::age($patient->dob) }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date of Birth: <span>{{ date('M d, Y',strtotime($patient->dob)) }}</span></td>
            </tr>
            <tr>
                <?php
                $g = substr($adm->gp_code,0,1);
                $p = substr($adm->gp_code,-1);
                ?>
                <td colspan="3">G: <span>{{ $g }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P: <span>{{ $p }}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ( <span>{{ $adm->gp_code }}</span> )</td>
            </tr>
            <tr>
                <td colspan="2">Ward: <span>{{ $adm->ward }}</span></td>
                <td>Room/Bed No.: <span>{{ $adm->room }}</span></td>
            </tr>
            <tr>
                <td colspan="3">Referring Physician: <span>{{ $adm->referring_doctor }}</span></td>
            </tr>
            <tr>
                <td colspan="3">Indication for Scan: <span>{{ $adm->scan_indication }}</span></td>
            </tr>
        </table>
        <hr>
        <br>
        <strong>
            <center>Sonographic Findings Worksheet</center>
        </strong>
        <br>
        <table class="sonographics">
            <tr>
                <td width="15%">Scan:</td>
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
                        <input type="checkbox" @if($sono->scan=='SIS') checked @endif> SIS
                    </label>
                </td>
                <td>
                    <label>
                        <input type="checkbox" @if($sono->scan=='Transabdominal') checked @endif> Transabdominal
                    </label>
                </td>
            </tr>
            <tr>
                <td width="15%">&nbsp;</td>
                <td colspan="2">
                    <label>
                        <input type="checkbox" @if($sono->scan=='Transrectal + Transabdominal') checked @endif> Transrectal + Transabdominal
                    </label>
                </td>
                <td colspan="2">
                    <label>
                        <input type="checkbox" @if($sono->scan=='Transvaginal + Transabdominal') checked @endif> Transvaginal + Transabdominal
                    </label>
                </td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">Cervix: <span>{{ $sono->cervix }}</span></td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">Uterine Corpus: <span>{{ $sono->uterine }}</span></td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5">Endometrium: <span>{{ $sono->endometrium }}</span></td>
            </tr>
            <tr>
                <td colspan="5">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="5"><label>Ovaries</label></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="4">Right: <span>{{ $sono->right_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">Others:</td>
                <td colspan="3"><span>{{ $sono->right_follicles }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="4">Left: <span>{{ $sono->left_ovary }}</span></td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right;font-style: italic">Others:</td>
                <td colspan="3"><span>{{ $sono->left_follicles }}</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label>Other Findings:</label></td>
            </tr>
            <tr>
                <td><br>{!! nl2br($sono->findings) !!}</td>
            </tr>
        </table>
        <br>
        <br>
        <label>Remarks:</label>
        <div class="remarks" style="text-transform: none;">
            <br>
            {!! nl2br($sono->remarks) !!}
        </div>
        <div class="sign">
            <?php
            $doc = \App\Doctor::find($sono->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                @if($sono->ob_doctor && $doc)
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