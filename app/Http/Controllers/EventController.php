<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventLocation;
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
        $fields = $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required',
            'city' => 'required',
            'street' => 'required',
            'venue' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'approved_by' => 'required',
        ]);

        $event = Event::create([
            'user_id' => auth()->user()->id,
            'company_id' => $fields['company_id'],
            'approved' => true,
            'approved_by' => $fields['approved_by'],
            'title' => $fields['title'],
            'desc' => $fields['desc'],
            'event_start_time' => $fields['event_start_time'],
            'event_end_time' => $fields['event_end_time'],
            'event_deadline' => $fields['event_deadline']
        ]);

        $location = $event->location()->create([
            'city' => $fields['city'],
            'street' => $fields['street'],
            'venue' => $fields['venue'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude']
        ]);

        $response = [
            'response' => 201,
            'message' => 'Event created successfully !',
            'event' => $event,
            'event_location' => $location
        ];

        return response($response, 201);
    }

    public function editEvent(Request $request, $event_id)
    {
        $fields = $request->validate([
            'company_id' => 'required',
            'title' => 'required',
            'desc' => 'required',
            'event_start_time' => 'required',
            'event_end_time' => 'required',
            'event_deadline' => 'required',
            'city' => 'required',
            'street' => 'required',
            'venue' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'approved_by' => 'required',
        ]);

        $current_event = Event::find($event_id);
        $current_event->update([
            'user_id' => auth()->user()->id,
            'company_id' => $fields['company_id'],
            'approved' => true,
            'approved_by' => $fields['approved_by'],
            'title' => $fields['title'],
            'desc' => $fields['desc'],
            'event_start_time' => $fields['event_start_time'],
            'event_end_time' => $fields['event_end_time'],
            'event_deadline' => $fields['event_deadline']
        ]);
        $location = $current_event->location()->update([
            'city' => $fields['city'],
            'street' => $fields['street'],
            'venue' => $fields['venue'],
            'latitude' => $fields['latitude'],
            'longitude' => $fields['longitude']
        ]);

        $response = [
            'response' => 201,
            'message' => 'Event updated successfully !',
            'event' => $current_event,
            'event_location' => [
                'city' => $fields['city'],
                'street' => $fields['street'],
                'venue' => $fields['venue'],
                'latitude' => $fields['latitude'],
                'longitude' => $fields['longitude']
            ]
        ];

        return response($response, 201);
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
