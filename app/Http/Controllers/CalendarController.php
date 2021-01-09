<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calendars;

class CalendarController extends Controller
{
    public static function displayCalendar (){
        $calendar = Calendars::get();
        
        return view('calendar', [ 'calendar' => $calendar ? $calendar->toArray(): [] ] );
    }

    public static function createEvent (Request $request) {
        // Remove old event
        Calendars::truncate( );
        
        // Create new event
        $events = json_decode($request->input('events'), true);
        foreach ($events as $key => $event) {
            Calendars::create( $event );
        }
        
        die(
            json_encode(
                array(
                    'success' => true
                )
            )
        );
    }
}
