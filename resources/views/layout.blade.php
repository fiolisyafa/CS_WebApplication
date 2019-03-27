<!DOCTYPE html>
<html>
	<head>
		<title>Mytinerary</title>

		{{-- Meta --}}
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		{{-- Stylesheets --}}
		
{{-- 		@if(Request::is('timeline'))
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css" media="screen">
	  	

		@endif --}}


		  <link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway:800" rel="stylesheet">
		  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
		  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/flickity/1.0.0/flickity.css" media="screen">

			{{-- Javascript --}}
			<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>
			@yield('heads')
	</head>
	<body>
		<header class="header">
			<input class="menu-btn" type="checkbox" id="menu-btn" />
			<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
			<a href="{{ url('dashboard') }}"><img src="{{ asset('img/icons/mochi.png') }}" class="logo"></a>

			<ul class="menu">
				<li><a href="{{ url('myplan') }}"><i class="fas fa-info"></i></a></li>
				<li><a href="{{ url('timeline') }}"><i class="fas fa-calendar-alt"></i></a></li>
				<li><a href="{{ url('budget') }}"><i class="fas fa-hand-holding-usd"></i></a></li>
				<li><a href="#" onclick="logout()"><i class="fas fa-sign-out-alt"></i></a></li>
			</ul>
		</header>

		@yield('content')

		<script src="{{ asset('js/logout.js') }}"></script>

	</body>

</html>