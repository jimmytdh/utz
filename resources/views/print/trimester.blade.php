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
        input[type=checkbox],input[type=radio] {
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
            <center>Second and Third Trimester Worksheet</center>
        </strong>
        <br>
        <table>
            <tr>
                <td width="40%">Number of Fetus:</td>
                <td width="30%">
                    <label>
                        <input type="checkbox" @if($tri->fetus_no == 1) checked @endif> Single
                    </label>
                </td>
                <td width="30%">
                    <label>
                        <input type="checkbox" @if($tri->fetus_no > 1) checked @endif>
                        Multiple <span style="visibility: {{ ($tri->fetus_no > 1) ? 'visible' : 'hidden' }};">{{ $tri->fetus_no }}</span>
                    </label>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>Presentation: <span>{{ $tri->presentation }}</span></td>
                <td>Heart Activity: <span>{{ $tri->heart_activity }}</span></td>
                <td>Gender: <span>@if($tri->gender) {{ ($tri->gender=='g') ? 'Girl':'Boy' }} @endif</span></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="25%">BPD: <span>{{ $tri->bpd }}</span></td>
                <td width="25%">HC: <span>{{ $tri->hc }}</span></td>
                <td width="25%">FL: <span>{{ $tri->fl }}</span></td>
                <td width="25%">FAC: <span>{{ $tri->fac }}</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2">SEFW: <span>{{ $tri->sefw }}</span></td>
                <td colspan="2">Others: <span>{{ $tri->others }}</span></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="4">
                    <strong>Age of Gestation Based on Today's Scan: </strong>
                    <span>{{ $tri->gestation_age }}</span>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td width="50%">
                    <strong>Amniotic Fluid</strong>

                    <ol>
                        <li>AFI: <span>{{ $tri->afi }}</span></li>
                        <li>Single Vertical Pocket: <span>{{ $tri->single_vertical }}</span></li>
                    </ol>
                    <br>
                    <strong>Placenta</strong>
                    <ol style="list-style: none">
                        <li>Location: <span>{{ $tri->location }}</span></li>
                        <li>Grade: <span>{{ $tri->grade }}</span></li>
                        <li>Abnormality: <span>{{ $tri->abnormality }}</span></li>
                    </ol>
                    <br>
                    Cord Vessels: <span>{{ $tri->cord_vessels }}</span>
                    <br>
                    <br>
                    <span>Biophysical Score</span>
                    <br>
                    <table style="width: 200px;">
                        <tr>
                            <td></td>
                            <th>0</th>
                            <th>2</th>
                        </tr>
                        <tr>
                            <td>NST</td>
                            <th><input type="checkbox" name="nst" value="0" @if($tri->nst==0) checked @endif></th>
                            <th><input type="checkbox" name="nst" value="2" @if($tri->nst==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>Amniotic Fluid</td>
                            <th><input type="checkbox" name="amniotic" value="0" @if($tri->amniotic==0) checked @endif></th>
                            <th><input type="checkbox" name="amniotic" value="2" @if($tri->amniotic==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>Body Movement</td>
                            <th><input type="checkbox" name="body_movement" value="0" @if($tri->body_movement==0) checked @endif></th>
                            <th><input type="checkbox" name="body_movement" value="2" @if($tri->body_movement==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>Fetal Tone</td>
                            <th><input type="checkbox" name="fetal_tone" value="0" @if($tri->fetal_tone==0) checked @endif></th>
                            <th><input type="checkbox" name="fetal_tone" value="2" @if($tri->fetal_tone==2) checked @endif></th>
                        </tr>
                        <tr>
                            <td>Fetal Breathing</td>
                            <th><input type="checkbox" name="fetal_breathing" value="0" @if($tri->fetal_breathing==0) checked @endif></th>
                            <th><input type="checkbox" name="fetal_breathing" value="2" @if($tri->fetal_breathing==2) checked @endif></th>
                        </tr>
                    </table>
                    <br>
                    <?php
                        $nst = ($tri->nst==2) ? 2 : 0;
                        $amniotic = ($tri->amniotic==2) ? 2 : 0;
                        $body_movement = ($tri->body_movement==2) ? 2 : 0;
                        $fetal_tone = ($tri->fetal_tone==2) ? 2 : 0;
                        $fetal_breathing = ($tri->fetal_breathing==2) ? 2 : 0;
                    $total = $nst + $amniotic + $body_movement + $fetal_tone + $fetal_breathing;
                    ?>
                    <span><strong>Total: </strong></span> &nbsp;&nbsp;&nbsp;<span id="total">{{ $total }}</span>
                </td>
                <td>
                    <span>Fetal Anatomic Survey:</span>
                    <br>
                    <ul style="list-style: none">
                        <li>
                            <label>
                                <input type="checkbox" name="cerebral" value="Y" data-table="trimester" @if($tri->cerebral=='Y') checked @endif> Cerebral Ventricles
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="cranium" value="Y" data-table="trimester" @if($tri->cranium=='Y') checked @endif> Cranium
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="face" value="Y" data-table="trimester" @if($tri->face=='Y') checked @endif> Face
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="spine" value="Y" data-table="trimester" @if($tri->spine=='Y') checked @endif> Spine
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="heart" value="Y" data-table="trimester" @if($tri->heart=='Y') checked @endif> Heart 4-CH View
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="stomach" value="Y" data-table="trimester" @if($tri->stomach=='Y') checked @endif> Stomach
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="abnormal_wall" value="Y" data-table="trimester" @if($tri->abnormal_wall=='Y') checked @endif> Ant. Abnormal Wal
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="insertion" value="Y" data-table="trimester" @if($tri->insertion=='Y') checked @endif> Insertion of Umbilical Vessels
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="kidneys" value="Y" data-table="trimester" @if($tri->kidneys=='Y') checked @endif> Kidneys
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" name="bladder" value="Y" data-table="trimester" @if($tri->bladder=='Y') checked @endif> Bladder
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
                                <input type="checkbox" name="atypical_finds" value="Y" data-table="trimester" @if($tri->atypical_finds=='Y') checked @endif> Atypical Findings:
                                <br>
                                @if($tri->atypical_finds=='Y')
                                    <small><em><span class="edit" data-name="atypical_finds_desc" data-title="Atypical Findings">{{ $tri->atypical_finds_desc }}</span></em></small>
                                @endif
                            </label>
                        </li>
                    </ul>
                </td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td><label>Other Findings:</label></td>
            </tr>
            <tr>
                <td><br>{!! nl2br($tri->other_findings) !!}</td>
            </tr>
        </table>
        <br>
        <br>
        <label>Remarks:</label>
        <div class="remarks" style="text-transform: none;">
            <br>
            {!! nl2br($tri->remarks) !!}
        </div>
        <div class="sign">
            <?php
            $doc = \App\Doctor::find($tri->ob_doctor);
            ?>
            <div class="b-border" style="text-align: center">
                @if($tri->ob_doctor && $doc)
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