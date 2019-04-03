@extends('layout')


@section('heads')
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/stylesheet-timeline.css') }}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css" media="screen">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

@endsection


@section('content')

<div class="outside" >
 <div class="calendar">
  <div class="main-gallery" id="days-list">

  </div>
  
 </div>
 <div class="inside" id="leaves_bg">
  <div class="time">
   <div class="containing">

    <div class="right scrollbar" id="activity-list">

    </div>
    
   </div>    
  </div>
  <div class="addevent scrollbar" id="style-1">
   <div class="flexer" id="sitombol">
    <div class="addbutton" onclick="myFunction()">+ Event</div>
    <div class="addbutton" onclick="myFunction2()">+ Suggestion</div>
   </div>
   <div class="theform hilang" id="banciKhals">
    <i class="backbutton fas fa-chevron-circle-left" onclick="myFunction()"></i>

    <p class="form_header">
       Add your custom event
       </p>
    <form class="form-style-7">
          <ul>
         
          <li>
               <label for="event">Event Name</label>
               <input type="text" id="event-input" name="event" maxlength="100" required>
               <span>Enter the title of your event</span>
          </li>
        <li>
            <label for="description">Description</label>
            <input class="texting" id="description-input" type="text" id="description">
         <span>Enter a short description for your event</span>
        </li>
          <li>
               <label for="datefrom">Hour</label>
               <input type="time" value="From" name="from" placeholder="From" id="hour" required>
               <span>Enter hour</span>
          </li>
          <li>
              <label>Budget</label>
              <input type="text" id="budget-input" required>
              <p class="texting">Value:$ <span id="demo"></span></p>
              <span>Drag slider to change value</span>
        </li>
          <li>
               <input type="button" value="Create" onclick="submitCustom()" >
          </li>
           </ul>
       </form>
   </div>

   <div class="nantihilang hilang" id="good">
    <div class="secondform" id="suggested-list">
      <div class="hundred"> 
      <i class="backbutton fas fa-chevron-circle-left" onclick="myFunction2()"></i>
      </div>
      
    </div>
      
        <form class="form-style-7 popup hilang" id="kaode">
          <ul>
              <i class="backbutton3 fas fa-chevron-circle-left" onclick="myFunction3()"></i>
              <li>
                 <div class="flexcolor">Time</div>
                <div class="flexa">
                <span class="texting">Hour:</span>
                 <input type="time" id="hour-suggested" value="From" name="from" placeholder="From" id="hour" required>
                 <span class="texting">Duration:</span>
                 <input type="time" value="From" name="from" placeholder="From" id="duration" required>
                 </div>
                 <span>Enter starting hour and duration</span>
              </li>
              <li>
               <input type="button" value="Create" onclick="submitSugg()" >
              </li>
          </ul>
        </form>
     
      
    </div>
   </div>
   
 </div>
</div>

<script>

  function myFunction() {
    document.getElementById('banciKhals').classList.toggle('hilang');
    document.getElementById('sitombol').classList.toggle('hilang');
  }
  function myFunction2() {
    document.getElementById('good').classList.toggle('hilang');
    document.getElementById('sitombol').classList.toggle('hilang');
  }

</script>


<script>
var slider = document.getElementById("myRange");
var output = document.getElementById("demo");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>

<script src="{{ secure_asset('js/timeline.js') }}"></script>

@endsection