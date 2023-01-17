<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\User;

class EventController extends Controller
{

    public function index()
    {
        return Event::all();
    }

    public function createEvent(Request $request)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required'
        ]);

        $request->request->add([
            'user_id' => auth()->user()->id,
            'approved' => true,
            'approved_by' => '2',
        ]);
        return Event::create($request->all());
    }

    public function editEvent(Request $request, $event_id)
    {
        $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required'
        ]);

        $current_event = Event::find($event_id);
        $current_event->update($request->all());
        return $current_event;
    }

    public function deleteEvent(Request $request, $event_id)
    {
        $current_event = Event::find($event_id);
        return $current_event->delete();
    }

    public function search($key)
    {
        return Event::where('title', 'like', '%' . $key . '%')
            ->orwhere('desc', 'like', '%' . $key . '%')
            ->get();
    }


    public function singleEvent(Request $request, $event_id)
    {
        return Event::findorfail($event_id);
    }
}
