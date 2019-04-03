@extends('layout')

@section('heads')
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/stylesheet.css') }}">
@endsection

@section('content')
<body id="trees_bg">

  <div class="main-gallery" id="trying">
     <div class="gallery-cell" onclick="myFunction()">
       <p>New Plan</p>
       <a>+</a>
     </div>
  </div>


  <script src="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js">
  </script>

  <script>
    var list = [];
    function fetchitinerary() {
    // fetch('http://mochinerary.id/api/dashboard', {
      fetch('https://mochinerary.id/api/dashboard', {
        method: 'get',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'Authorization': 'Bearer ' + localStorage.getItem('token')
        },
      }).then(res => res.json())
      .then(res => {
        list = res;
        res.forEach(r => {
          var node = document.createElement('div');
          node.id = r.id;
          node.innerHTML = r.name;
          node.classList.add("gallery-cell");
          document.getElementById('trying').appendChild(node);
        });

        var elem = document.querySelector('#trying');
        var flkty = new Flickity( elem, {
        });
        flkty.on('change', function(event) {
          console.log(list[event - 1]);
          localStorage.setItem('currentItinerary', list[event - 1].id);
          localStorage.setItem('itinerary', JSON.stringify(list[event - 1]));
        });
      });
    }

    function deleteFunction(itinerary) {
      fetch(`https://mochinerary.id/api/dashboard/${itinerary}/delete`, {
        method: 'delete',
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
        fetchItinerary();
      });     
    }

  window.onload = () => {
    fetchitinerary();
  }    

  </script>
  <script>
  function myFunction() {
    localStorage.removeItem('itinerary');
    localStorage.removeItem('currentItinerary');
    location.href = "myplan";
  }
</script>

</body>
</html>
@endsection