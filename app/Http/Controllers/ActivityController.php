<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SuggestedActivity;
use App\Itinerary;
use App\Preference;

class ActivityController extends Controller
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
        $preference = Preference::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->pluck('activity_type_id');

        return response()->json(
            SuggestedActivity::whereIn('activity_type_id', $preference)->get()
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $selected = SelectedActivity::where('user_id', auth()->user()->id)->where('itinerary_id', $id)->pluck('activity_id')->get();
        // return response()->json([
        //     'selected' = SuggestedActivity::where('id', $selected)->get();
        //     ''
        // ]);
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
        // $this->validate($request, [
        //     'name' => 'required',
        //     'description' => 'nullable',
        //     'fee' => ['required', 'integer'],
        //     'city_id' => ['required', 'integer', 'exist:cities'],
        //     'activity_type_id' => ['required', 'integer'],
        //     'image' => ['nullable', 'string']
        // ]);

        // $activity = SuggestedActivity::find($id);
        // $activity->name = $request->input('name');
        // $activity->description = $request->input('description');
        // $activity->fee = $request->input('fee');
        // $activity->city_id = $request->input('city_id');
        // $activity->activity_type_id = $request->input('activity_type_id');
        // $activity->image = $request->input('image');
        // $activity->save();

        // return redirect('pages.suggestedactivity');  

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
