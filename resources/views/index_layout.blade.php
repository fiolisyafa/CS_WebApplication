<!DOCTYPE html>
<html>
    <head>
        <title>Mytinerary</title>

        {{-- Meta --}}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        {{-- Stylesheets --}}
        <link rel="stylesheet" type="text/css" href="{{ asset('css/stylesheet.css')   }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Quicksand|Raleway:800" rel="stylesheet">

        {{-- Javascript --}}
        <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jQuery/jquery-1.4.2.min.js"></script>

        <script>  
        // Function to check Whether both passwords 
        // is same or not. 
        function checkPassword(form) { 
          password1 = form.password1.value; 
          password2 = form.password2.value; 

          // If password not entered 
          if (password1 == '') 
            alert ("Please enter Password"); 
              
          // If confirm password not entered 
          else if (password2 == '') 
              alert ("Please enter confirm password"); 
                
          // If Not same return False.     
          else if (password1 != password2) { 
              alert ("\nPassword did not match: Please try again") 
              return false; 
          } 

          // If same return True. 
          else{ 
              alert("Password Match: Welcome") 
              return true; 
          } 
        } 

        </script> 
</head>
@yield('content')

