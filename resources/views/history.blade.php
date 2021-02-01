@extends('layout.app')

@section('css')
    <style>
        a:hover {
            text-decoration: none;
        }
        table tr td{
            font-size: 1.1em;
            text-transform: uppercase;
            color: #cc322e;
            font-weight: bold;
        }
    </style>
@endsection

@section('content')
    <h2 class="title-header">Patient History</h2>
    <div class="col-md-12">
        <table class="table table-striped">
            <tr>
                <th>Hospital Number</th>
                <td>:</td>
                <td>{{ $patient->hospital_no }}</td>
                <th>Date of Birth</th>
                <td>:</td>
                <td>{{ date('M d, Y',strtotime($patient->dob)) }}</td>
            </tr>
            <tr>
                <th>Patient Name</th>
                <td>:</td>
                <td>{{ $patient->fname }} {{ $patient->mname }} {{ $patient->lname }}</td>
                <th>Age</th>
                <td>:</td>
                <td>{{ \App\Http\Controllers\ConfigController::age($patient->dob) }} y/o</td>
            </tr>
        </table>
    </div>
    <hr>
    <div class="row">
        @if(count($admission)==0)
            <div class="text-danger text-center col-md-12">
                <h2>*** No History Found! ***</h2>
            </div>
        @endif
        @foreach($admission as $adm)
        <?php
            $box = 'bg-green';
            $sheet = 'Early Pregnancy';
            $type = 'Private Division';
            switch ($adm->sheet){
                case "sonographics":
                    $box = 'bg-yellow';
                    $sheet = 'Sonographic Findings';
                    break;
                case "trimister":
                    $box = 'bg-info';
                    $sheet = '2nd and 3rd Trimister';
                    break;
            }

            switch ($adm->admission_type){
                case 'clinical':
                    $type = 'Clinical Division';
                    break;
                case 'opd':
                    $type = 'Out-Patient';
                    break;
                case 'in':
                    $type = 'In-Patient';
                    break;
            }
        ?>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <a href="{{ request()->url() }}/{{ $adm->id }}/{{ $adm->sheet }}" class="info-box-a" target="_blank">
            <div class="info-box {{ $box }}">
                <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">{{ date('M d, Y h:i a',strtotime($adm->date_started)) }}</span>
                    <span class="info-box-number">{{ $sheet }}</span>
                    <div class="progress">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                    <span class="progress-description">
                        {{ $type }}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
            </a>
        </div>
        @endforeach
    </div>
@endsection