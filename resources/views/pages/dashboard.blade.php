@extends('layout')

@section('heads')
<link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css') }}">
@endsection

@section('content')
<body id="trees_bg">

  <div class="main-gallery" id="trying">
     <div class="gallery-cell" >
       <p>New Plan</p>
       <a href="myplan">+</a>
     </div>
     {{-- <div class="gallery-cell">
       <a href="timeline"><p>A trip to Japan</p></a>
     </div>
     <div class="gallery-cell"></div>
     <div class="gallery-cell"></div>
     <div class="gallery-cell"></div> --}}
  </div>


  <script src="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.pkgd.js">
  </script>

  <script>
    function fetchitinerary() {
    fetch('http://172.20.10.12:8000/api/dashboard', {
      method: 'get',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': 'Bearer ' + localStorage.getItem('token')
      },
    }).then(res => res.json())
    .then(res => {
      res.forEach(r => {
        var node = document.createElement('div');
        node.id = r.id;
        node.innerHTML = r.name;
        node.classList.add("gallery-cell");
        document.getElementById('trying').appendChild(node);
      });

      var elem = document.querySelector('#trying');
      var flkty = new Flickity( elem, {
        // options
        // cellAlign: 'left',
        // contain: true
      });
    });
  }

  window.onload = () => {
    fetchitinerary();
  }    

  </script>

</body>
</html>
@endsection