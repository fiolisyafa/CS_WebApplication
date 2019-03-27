@extends('layout')

@section('heads')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
      <!-- Flexes the two halves of the page (Form and Checkbox)       -->
      
      <div class="flex_row">


        <form class="my-plan_form">
          <div class="my-plan_form__container">

            <div>
              <label for="name"> Trip name: </label>
              <input type="text" id="tripname" name="name">
            </div>
            <div>
              <label for="description"> Description: </label>
              <textarea id="description" name="name"></textarea>
            </div>
            <div>
              <label for="people"> No. of People: </label>
              <input type="number" id="people" name="people">
            </div>
            <div>
              <label for="date"> From: </label>
              <input type="date" id="fromdate" name="date">

{{--               <label for="location"> Country: </label>
              <select id="fromcountry" name="country">
                <option value="JKT">Jakarta, Indonesia</option>
                <option value="JPN">Tokyo, Japan</option>
                <option value="USA">San Francisco, USA</option>
              </select> --}}
            </div>
            <div>
              <label for="date"> Until: </label>
              <input type="date" id="untildate" name="date">

              <label for="location"> Country: </label>
              <select id="tocountry" name="country">
              </select>
            </div>
            <div>
              <label for="budget"> Estimated budget: </label>
              <input type="number" id="estimated-budget" name="budget">
              <select id="currency" name="currency">
                <option value="USD">USD</option>
                <option value="ID">IDR</option>
                <option value="KR">WON</option>
              </select>
            </div>


        </div>
      </form>


    <!-- Right half of the page as a container -->

    <div>


      <div class="checkbox-container">
        <h1>Categories:</h1>
      </div>

      <div class="checkbox-container" id="activitytypecontainer"> 
      </div>

      <div class="my-plan_button">
        <button class="button" onclick="submitmyplan()">
        <span>Submit</span>
      </div>
    </div>

  </div>


</div>

<script>
function submitmyplan() {
    var tocountry = document.getElementById("tocountry").value,
        budget = document.getElementById("estimated-budget").value,
        tripname = document.getElementById("tripname").value,
        description = document.getElementById("description").value,
        fromdate = document.getElementById("fromdate").value,
        untildate = document.getElementById("untildate").value,
        people = document.getElementById("people").value,
        activities = [];

        var checkboxes = document.querySelectorAll('.activitycheckbox');

        checkboxes.forEach(check => {
          if (check.checked) {
            activities.push(check.value);
          }
        });

    var data = {
      city_id: tocountry,
      budget: budget,
      name: tripname,
      description: description,
      date_from: fromdate,
      date_to: untildate,
      number_of_people: people,
      activities: activities
    };

    fetch('http://localhost/api/dashboard/create', {
      method: 'post',
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
        console.log(result);
        console.log('berhasil');
      }).catch(err => {
        console.log('error');
      })
  }

  function fetchCities() {
    fetch('http://172.20.10.12:8000/api/dashboard/cities', {
      method: 'get',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      },
    }).then(res => res.json())
    .then(res => {
      res.forEach(r => {
        var node = document.createElement('option');
        node.value = r.id;
        node.innerHTML = r.city + ', ' + r.country;
        document.getElementById('tocountry').appendChild(node);
      });
      
    });
  }

  function fetchActivityTypes() {
    fetch('http://172.20.10.12:8000/api/dashboard/activitytype', {
      method: 'get',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      },
    }).then(res => res.json())
    .then(res => {
      res.forEach(r => {
        var checkbox = document.createElement("input");
        checkbox.type = "checkbox";
        checkbox.id = "check-" + r.id;
        checkbox.name = "activitytype";
        checkbox.classList.add('activitycheckbox');
        checkbox.value = r.id;

        var label = document.createElement("label");
        label.htmlFor = "check-" + r.id;
        label.innerHTML = r.type;

        document.getElementById('activitytypecontainer').appendChild(checkbox);
        document.getElementById('activitytypecontainer').appendChild(label);
      });
      
    });
  }

  window.onload = () => {
    fetchCities();
    fetchActivityTypes();
  }

</script>

@endsection