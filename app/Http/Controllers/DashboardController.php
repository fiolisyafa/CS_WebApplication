<?php

namespace App\Http\Controllers;

use App\User;
use App\Itinerary;
use App\City;
use App\ActivityType;
use App\Preference;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user_id = auth()->user('id');
        // $user = User::find($user_id);

        // return response()->json(Itinerary::where('user_id', $user_id));   

        return response()->json(
            Itinerary::where('user_id', auth()->user()->id)->get()
        );
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
    public function store(Request $request)
    {
        $request->validate([
            'city_id' => ['required'],
            'budget' => ['required', 'integer'],
            'name' => 'required',
            'description' => 'required',
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
            'number_of_people' => ['required', 'integer'],
            'activities' => ['required', 'array', 'min:1', 'max:12']
        ]);

        $itinerary = Itinerary::create([
            'user_id' => auth()->user()->id,
            'city_id' => $request->input('city_id'),
            'budget' => $request->input('budget'),
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'date_from' => $request->input('date_from'),
            'date_to' => $request->input('date_to'),
            'number_of_people' => $request->input('number_of_people')
        ]);

        //[1, 2, 3, 4]

        foreach ($request->get('activities') as $activity) {
            Preference::create([
                'user_id' => auth()->user()->id,
                'itinerary_id' => $itinerary['id'],
                'activity_type_id' => $activity,
            ]);

        $preference = Preference::where('user_id', auth()->user()->id)->where('itinerary_id', $itinerary['id']);
        }

        return response()->json([$itinerary, $preference]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Itinerary::where('user_id', auth()->user()->id)->where('id', $id)->get());
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
            'city_id' => ['required', 'exists:cities,id'],
            'budget' => ['required', 'integer'],
            'name' => 'required',
            'description' => 'string',
            'date_from' => ['required', 'date'],
            'date_to' => ['required', 'date'],
            'number_of_people' => ['required', 'integer'],
            'activities' => ['required', 'array', 'min:1', 'max:12']
        ]);

        $itinerary = Itinerary::find($id);
        $itinerary->city_id = $request->input('city_id');
        $itinerary->budget = $request->input('budget');
        $itinerary->name = $request->input('name');
        $itinerary->description = $request->input('description');
        $itinerary->date_from = $request->input('date_from');
        $itinerary->date_to = $request->input('date_to');
        $itinerary->number_of_people = $request->input('number_of_people');
        $itinerary->save();

        $preference = Preference::where('user_id', auth()->user()->id)->where('itinerary_id', $itinerary['id']);
        $preference->delete();

        foreach ($request->get('activities') as $activity) {
            Preference::create([
                'user_id' => auth()->user()->id,
                'itinerary_id' => $itinerary['id'],
                'activity_type_id' => $activity,
            ]);
        }

        return response()->json($itinerary);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $itinerary = Itinerary::find($id);
        $preference = Preference::where('itinerary_id', $id);
        if ($itinerary->user_id = auth()->user()->id) {
            $preference->delete();
            $itinerary->delete();
        }

        return response()->json($itinerary);
    }
}
