@extends('layout')

@section('heads')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')

<div class="flex_centered-calc">

  <div class="centered_form">
    <form class="budget_form">
        
     <div class="budget_form__container">

      <div>
        <label for="budget"> Total Budget: </label>
        <input type="number" id="budget" name="budget" required>
        <select id="currency" name="currency">
          <option value="US">USD</option>
          <option value="ID">IDR</option>
          <option value="KR">WON</option>
        </select>
      </div>

        <h1>Enter your budget for the whole trip.</h1>
      </div>

      <div class="budget_form__container">
          <label for="r-budget">Remaining Budget:</label>
          <p>0</p>
          <h1>This is the remaining budget you have</h1>
      </div>

      <div>
        <button class="button">
          <span>Confirm</span>
      </div>
    </form>

  </div>
</div>

@endsection