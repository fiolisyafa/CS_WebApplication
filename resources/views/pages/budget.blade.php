@extends('layout')

@section('heads')
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/stylesheet.css') }}">
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
          <p id="remainingBudgethtml">0</p>
          <h1>This is the remaining budget you have</h1>
      </div>

      <div>
        <button type="button" class="button" onclick="submitbudget()">
          <span>Confirm</span>
      </div>
    </form>

  </div>
</div>


{{-- SUBMIT BUDGET JAVASCRIPT --}}
<script>
function submitbudget() {
    var budget = document.getElementById("budget").value;

    var data = {
      budget: budget,
    };

    var current = localStorage.getItem('currentItinerary');
    fetch(`https://mochinerary.id/api/itinerary/${current}/budget/edit`, {
     method: 'put',
     headers: {
       'Content-Type': 'application/json',
       'Accept': 'application/json',
       'Authorization': 'Bearer ' + localStorage.getItem('token'),
     },
     body: JSON.stringify(data)
    })
      .then(res => {
        if (!res.ok) {
            throw Error(res.statusText);
        }
        return res.json();
      })
      .then(result => {
        fetchBudget();
        console.log(result);
        console.log('berhasil');
      }).catch(err => {
        console.log('error');
      })
  }

  function fetchBudget() {
    var current = localStorage.getItem('currentItinerary');
    var itinerary = JSON.parse(localStorage.getItem('itinerary'));
    var people = itinerary.number_of_people;

    fetch(`https://mochinerary.id/api/itinerary/${current}/budget`, {
      method: 'get',
       headers: {
         'Content-Type': 'application/json',
         'Accept': 'application/json',
         'Authorization': 'Bearer ' + localStorage.getItem('token'),
       },
      })
      .then(res => {
        if (!res.ok) {
            throw Error(res.statusText);
        }
        return res.json();
      })
      .then(result => {
        var remainingBudget = result.budget;

        result.spendings.forEach(s => {
          remainingBudget -= (s * people);
        });

        document.querySelector('#remainingBudgethtml').innerHTML = remainingBudget;
        console.log(people);
        console.log(result);
        console.log(remainingBudget);
        console.log('berhasil');
      }).catch(err => {
        console.log('error');
      });
  }

  function displayBudget() {
    var current = JSON.parse(localStorage.getItem('itinerary'));
    console.log(current.budget);
    if (current) {
      document.getElementById('budget').value = current.budget
    }
  }

  window.onload = () => {
    fetchBudget();
    displayBudget();
  }
</script>
</body>
</html>
@endsection