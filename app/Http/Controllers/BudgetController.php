<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Itinerary;
use App\SelectedActivity;
use App\SuggestedActivity;
use App\CustomActivity;

class BudgetController extends Controller
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
    public function index()
    {
        //
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
    public function store(Request $request)
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
        $user_id = auth()->user()->id;
        $budget = Itinerary::where('user_id', $user_id)->where('id', $id)->pluck('budget');
        $selected = SelectedActivity::where('user_id', $user_id)->where('itinerary_id', $id)->pluck('activity_id');

        $selectSpendings = SuggestedActivity::whereIn('id', $selected)->pluck('fee');
        $customSpendings = CustomActivity::where('user_id', $user_id)->where('itinerary_id', $id)->pluck('fee');
        $collection = collect([$selectSpendings, $customSpendings])->flatten();

        return response()->json([
            'budget' => $budget,
            'spendings' => $collection,
        ]);
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
            'budget' => ['required', 'integer'],
        ]);

        $itinerary = Itinerary::find($id);
        $itinerary->budget = $request->input('budget');
        $itinerary->save();

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
        //
    }
}
