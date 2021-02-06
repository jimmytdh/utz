<?php

namespace App\Http\Controllers;

use App\Admission;
use App\Patient;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        return view('home');
    }

    public function chart()
    {
        return array(
            'scheduled' => self::countScheduled(),
            'yesterday' => self::countYesterday(),
            'today' => self::countToday(),
            'minor' => self::countMinor(),
            'area' => self::transactionChart(),
            'donut' => self::categoricalChart()
        );
    }

    public function countScheduled()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();

        $from = min($start,$end);
        $till = max($start,$end);

        $count = Schedule::where(function($q) use($from,$till){
                            $q->whereBetween('start_date',[$from,$till]);
                        })
                        ->orwhere(function($q) use($from,$till){
                            $q->whereBetween('end_date',[$from,$till]);
                        })
                        ->count();
        return $count;
    }

    public function countYesterday()
    {
        $start = Carbon::yesterday()->startOfDay();
        $end = Carbon::yesterday()->endOfDay();
        $patient = DB::table('admissions')
            ->select(DB::raw('count(*) as total'))
            ->whereBetween('date_started',[$start,$end])
            ->groupBy('patient_id')
            ->get();
        return count($patient);
    }

    public function countToday()
    {
        $start = Carbon::now()->startOfDay();
        $end = Carbon::now()->endOfDay();
        $patient = DB::table('admissions')
                    ->select(DB::raw('count(*) as total'))
                    ->whereBetween('date_started',[$start,$end])
                    ->groupBy('patient_id')
                    ->get();
        return count($patient);
    }

    public function countMinor()
    {
        $start = Carbon::now()->startOfYear();
        $end = Carbon::now()->endOfYear();
        $date = Carbon::now()->addYear(-18)->format('Y-m-d');
//        $count = Patient::where('dob','>',$date)
//
//                    ->count();
//        return $count;
        $patient = DB::table('admissions')
                ->leftJoin('patients','patients.id','=','admissions.patient_id')
                ->select(DB::raw('count(admissions.id) as total'))
                ->whereBetween('date_started',[$start,$end])
                ->where('patients.dob','>',$date)
                ->groupBy('patient_id')
                ->get();
        return count($patient);
    }

    public function transactionChart()
    {
        $data['label'] = array();
        $data['early'] = array();
        $data['sono'] = array();
        $data['tri'] = array();

        for($i=0; $i<=6; $i++)
        {
            $date = Carbon::now()->addDay(-6)->addDay($i);
            $start = Carbon::parse($date)->startOfDay();
            $end = Carbon::parse($date)->endOfDay();
            $data['early'][] = self::countPerSheet('early_pregnancy',$start,$end);
            $data['sono'][] = self::countPerSheet('sonographics',$start,$end);
            $data['tri'][] = self::countPerSheet('trimester',$start,$end);
            $data['label'][] = $date->format("M d");
        }
        return $data;
    }

    public function categoricalChart()
    {
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();

        $data['early'] = self::countPerSheet('early_pregnancy',$start,$end);
        $data['sono'] = self::countPerSheet('sonographics',$start,$end);
        $data['tri'] = self::countPerSheet('trimester',$start,$end);

        return $data;
    }

    public function countPerSheet($sheet,$start,$end)
    {
        $count = Admission::whereBetween('date_started',[$start,$end])
                    ->where('sheet',$sheet)
                    ->count();
        return $count;
    }

}
