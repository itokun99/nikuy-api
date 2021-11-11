<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Resources\EventCollection;
use Carbon\Carbon;

class EventController extends Controller
{
    //
    public function getEvents(Request $request)
    {
        $category = $request->get('category');
        $timenow = Carbon::now();

        $events = Event::with(['penulis']);

        if ($request->has('category')) {
            if ($category == 'incomming-event') {
                $events = $events->where('waktu', '>=', $timenow);
            }
        }

        $events = $events->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('waktu', 'asc')
            ->paginate(10);

        return new EventCollection($events);
    }
}
