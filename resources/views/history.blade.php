@extends('layout.app')
@section("title","History: $patient->fname $patient->mname $patient->lname")
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
        .btn {
            position: relative;
        }
        .btn .fa {
            font-size: 2rem;
            position: absolute;
            left: 10px;
            top: 10px;
        }
        .btn-success a, .btn-info a {
            color: #fff;
        }
    </style>
@endsection

@section('content')
    <div id="loader-wrapper" style="visibility: hidden;">
        <div id="loader"></div>
    </div>


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
    <div class="row mb-4">
        <div class="col-lg-4 col-sm-12 mb-2">
            <a class="btn btn-success btn-block btn-sm btn-admit" href="{{ route('add.earlyPregnancy',$patient->id) }}">
                <i class="fa fa-plus-circle"></i>
                Early Pregnancy<br>Worksheet
            </a>
        </div>
        <div class="col-lg-4 col-sm-12 mb-2">
            <a class="btn btn-warning btn-block btn-sm btn-admit" href="{{ route('add.sonographic',$patient->id) }}">
                <i class="fa fa-plus-circle"></i>
                Sonographic Findings<br>Worksheet
            </a>
        </div>
        <div class="col-lg-4 col-sm-12 mb-2">
            <a class="btn btn-info btn-block btn-sm btn-admit" href="{{ route('add.trimester',$patient->id) }}">
                <i class="fa fa-plus-circle"></i>
                Second and Third<br>Trimester Worksheet
            </a>
        </div>
    </div>
    <hr>
    <h2 class="title-header">Patient History</h2>
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
            $type = 'Not Set';
            $icon = 'fa-hourglass';
            switch ($adm->sheet){
                case "early_pregnancy":
                    $icon = 'stethoscope';
                    break;

                case "sonographics":
                    $box = 'bg-yellow';
                    $sheet = 'Sonographic Findings';
                    $icon = 'wheelchair';
                    break;
                case "trimester":
                    $box = 'bg-info';
                    $sheet = '2nd and 3rd Trimister';
                    $icon = 'heartbeat';
                    break;
            }

            switch ($adm->admission_type){
                case 'private':
                    $type = 'Private Division';
                    break;
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
            <a href="{{ request()->url() }}/{{ $adm->id }}/{{ $adm->sheet }}" class="info-box-a">
            <div class="info-box {{ $box }}" style="color: #fff;">
                <span class="info-box-icon"><i class="fa fa-{{ $icon }}"></i></span>
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

@section('js')
<script>
    $(document).ready(function(){
        $('.btn-admit').on('click',function(e){
            e.preventDefault();
            var href = $(this).attr('href');
            $('#loader-wrapper').css('visibility','visible');
            setTimeout(function () {
                $.ajax({
                    url: href,
                    type: 'GET',
                    success: function(res){
                        window.location.replace("{{ url('/patient/history/'.$patient->id) }}/"+ res.id + "/" + res.type);
                    }
                });
            },2000);
        });
    });
</script>
@endsection