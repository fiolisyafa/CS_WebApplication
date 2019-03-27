<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\SuggestedActivity;
use App\SelectedActivity;
use App\CustomActivity;
use App\Itinerary;
use App\Preference;

class UsersActivityController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        // $selected = SelectedActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get();
        // $suggested = SuggestedActivity::whereIn('id', $selected->pluck('activity_id'))->get();

        // $custom = CustomActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get();

        // return response()->json([$suggested, $selected, $custom]); 
    }
    public function returnSelected($id)
    {
        $selected = SelectedActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get();  

        return response()->json($selected);
    }
    public function returnSuggested($id)
    {
        $selected = SelectedActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get(); 
        $suggested = SuggestedActivity::whereIn('id', $selected->pluck('id'))->get();

        return response()->json($suggested);
    }
    public function returnCustom($id)
    {
        $custom = CustomActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get();       
        return response()->json($custom);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function getCities()
    {
        $cities = City::all();

        return response()->json($cities);
    }

    public function getActivityTypes()
    {
        $preferences = ActivityType::all();

        return response()->json($preferences);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeSuggested(Request $request, $id, $ac_id)
    {
        $request->validate([
            'activity_id' => 'exist:suggested_activities',
            'date_time' => 'required'
        ]);

        $activity = SelectedActivity::create([
            'user_id' => auth()->user()->id,
            'itinerary_id' => $id,
            'activity_id' => $ac_id,
            'date_time' => $request->input('date_time'),
        ]);

        return response()->json($activity);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustom(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'fee' => ['required', 'integer'],
            'city_id' => ['required', 'integer', 'exists:cities'],
            'activity_type_id' => ['required', 'integer'],
            'date_time' => ['required', 'dateTime']
        ]);

        $activity = CustomActivity::create([
            'user_id' => auth()->user()->id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'fee' => $request->input('fee'),
            'city_id' => $request->input('city_id'),
            'itinerary_id' => $id,
            'activity_type_id' => $request->input('activity_type_id'),
            'date_time' => $request->input('date_time'),
        ]);

        return response()->json($activity);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (SelectedActivity::where('itinerary_id', $id)) {
            return response()->json(SelectedActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get());
        }
        elseif (CustomActivity::find($id)) {
            return response()->json(CustomActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->get());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'fee' => ['required', 'integer'],
            'city_id' => ['required', 'integer', 'exist:cities,id'],
            'activity_type_id' => ['required', 'integer'],
            'date_time' => ['required', 'dateTime']
        ]);

        $custom = CustomActivity::find($id);
        $custom->name = $request->input('name');
        $custom->description = $request->input('description');
        $custom->fee = $request->input('fee');
        $custom->city_id = $request->input('city_id');
        $custom->activity_type_id = $request->input('activity_type_id');
        $custom->date_time = $request->input('date_time');
        $custom->save();

        return response()->json($custom);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $ac_id)
    {
        $selectedActivity = SelectedActivity::where('activity_id', $ac_id);
        $customActivity = CustomActivity::find($ac_id);

        if ($selectedActivity) {
            if ($selectedActivity->user_id = auth()->user()->id) {
                $selectedActivity->delete();
                return response()->json($selectedActivity);
            }
        }
        elseif ($customActivity) {
            if ($customActivity->user_id = auth()->user()->id) {
                $customActivity->delete();
                return response()->json($customActivity);
            }
        }
        if ($selectedActivity->user_id = auth()->user()->id) {
            $selectedActivity->delete();
            return response()->json($selectedActivity);
        }

    }
}
