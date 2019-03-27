@extends('layout')


@section('heads')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet-timeline.css') }}">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css" media="screen">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

@endsection


@section('content')

<div class="outside" id="leaves_bg">
 <div class="calendar">
  <div class="main-gallery js-flickity">
     <div class="gallery-cell">Day 1</div>
     <div class="gallery-cell">Day 2</div>
     <div class="gallery-cell">Day 3</div>
     <div class="gallery-cell">Day 4</div>
     
  </div>
  
 </div>
 <div class="inside">
  <div class="time">
   <div class="containing">
    <!-- <div class="left">
     <div class="box">00:00</div>
     <div class="box">01:00</div>
     <div class="box">02:00</div>
     <div class="box">03:00</div>
    </div> -->
    <div class="right scrollbar" id="leaves_bg">
     <div class="all">
      <div class="duration">
       <div class="part1">
        14:00
       </div>
       <div class="part2">
        45 min
       </div>
      </div>
      <div class="items">
       <div class="part3">
        Nelayan Resto
       </div>
       <div class="part4">
        $15
       </div> 
      </div>
      <span class="close">x</span>        
     </div>
     <div class="all">
      <div class="duration">
       <div class="part1">
        14:00
       </div>
       <div class="part2">
        45 min
       </div>
      </div>
      <div class="items">
       <div class="part3">
        Nelayan Resto
       </div>
       <div class="part4">
        $15
       </div> 
      </div>
      <span class="close">x</span>        
     </div>
     <div class="all">
      <div class="duration">
       <div class="part1">
        14:00
       </div>
       <div class="part2">
        45 min
       </div>
      </div>
      <div class="items">
       <div class="part3">
        Nelayan Resto
       </div>
       <div class="part4">
        $15
       </div> 
      </div>
      <span class="close">x</span>        
     </div>

    </div>
    
   </div>    
  </div>
  <div class="addevent scrollbar" id="style-1">
   <div class="flexer" id="sitombol">
    <div class="addbutton" onclick="myFunction()">+ Event</div>
    <div class="addbutton" onclick="myFunction2()">+ Suggestion</div>
   </div>
   <div class="theform hilang" id="banciKhals">
    <p class="form_header">
       Add your custom event
       </p>
    <form class="form-style-7">
          <ul>
         
          <li>
               <label for="event">Event Name</label>
               <input type="text" name="event" maxlength="100" required>
               <span>Enter the title of your event</span>
          </li>
        <li>
            <label for="description">Description</label>
            <input class="texting" type="text" id="description">
         <span>Enter a short description for your event</span>
        </li>
          <li>
               <label for="datefrom">Time</label>
              <div class="flexa">
              <span class="texting">Hour:</span>
               <input type="time" value="From" name="from" placeholder="From" id="hour" required>
               <span class="texting">Duration:</span>
               <input type="time" value="From" name="from" placeholder="From" id="duration" required>
               </div>
               <span>Enter starting hour and duration</span>
          </li>
          <li>
               <label for="Location">Location</label>
               <input type="text" name="Location" maxlength="100" id="location" required>
               <span>Enter the location of the event</span>
          </li>
          <li>
              <label>Budget</label>
              <input type="range" min="1" max="100000" value="500" class="slider" id="Budget" required>
              <p class="texting">Value:$ <span id="demo"></span></p>
              <span>Drag slider to change value</span>
        </li>
          <li>
               <input type="submit" value="Create" onclick="myFunction()" >
          </li>
           </ul>
       </form>
   </div>
   <div class="secondform hilang" id="good">
      <div class="insidesuggestion">
        <div class="category">
          Cafe
        </div>
        <div class="theitem">
          Kopi Kalyan
        </div>
      </div>
      <div class="insidesuggestion">
        <div class="category">
          Mountain
        </div>
        <div class="theitem">
          Klabat
        </div>
      </div>
      <div class="insidesuggestion">
        <div class="category">
          contoh
        </div>
        <div class="theitem">
          item
        </div>
      </div>
      <div class="insidesuggestion">
        <div class="category">
          contoh
        </div>
        <div class="theitem">
          item
        </div>
      </div>
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

@endsection