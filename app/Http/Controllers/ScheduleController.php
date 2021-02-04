<?php

namespace App\Http\Controllers;

use App\Patient;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        return view('schedule');
    }

    public function store(Request $req)
    {

        $date = $req->date." ".$req->time;
        $data = array(
            'title' => $req->name,
            'start_date' => Carbon::parse($date)->format('Y-m-d H:i:s'),
            'end_date' => Carbon::parse($date)->addHour(2)->format('Y-m-d H:i:s'),
            'allDay' => false,
            'color' => '#3c8dbc'
        );
        Schedule::create($data);
    }

    public function getSchedule()
    {
        $start = Carbon::now()->addMonth(-6)->startOfDay()->format('Y-m-d H:i:s');
        $end = Carbon::now()->addMonth(6)->endOfDay()->format('Y-m-d H:i:s');

        $sched = Schedule::whereBetween('start_date',[$start,$end])->get();

        $result = array();
        foreach($sched as $s)
        {
            $result[] = array(
                'id' => $s->id,
                'title' => $s->title,
                'start' => Carbon::parse($s->start_date)->format('Y-m-d H:i:s'),
                'end' => Carbon::parse($s->end_date)->format('Y-m-d H:i:s'),
                'allDay' => ($s->allDay==1) ? true : false,
                'backgroundColor' => $s->color,
                'borderColor' => $s->color
            );
        }

        return $result;
    }

    public function update(Request $req)
    {
        $id = $req->id;
        $start = $req->start;
        $end = $req->end;
        if(!$req->end){
            $end = Carbon::parse($start)->endOfDay();
        }
        $data = array(
            'title' => $req->title,
            'start_date' => $start,
            'end_date' => $end,
            'allDay' => ($req->allDay=='true') ? true: false,
            'color' => $req->color
        );
        if($id){
            Schedule::find($id)->update($data);
            return 0;
        }else{
            $s = Schedule::create($data);
            return $s->id;
        }
    }

    public function destroy($id)
    {
        Schedule::find($id)->delete();
    }
}
