@extends('index_layout')

@section('content')
<body id="mountains_bg">

<div class="flex_centered">
  <div class="centered_form">
    <form class="form-style-7">
      <ul>
      <li>
          <label for="email">E-mail</label>
          <input type="email" name="email" maxlength="100" required id="email">
          <span>Enter your username / e-mail</span>
      </li>
      <li>
          <label for="password">Password</label>
          <input type="password" name="password" maxlength="100" required id="password">
          <span>Enter your password</span>
      </li>
      <div class="redirect_button">
        <input type="button" value="Sign In" onclick="login()">
      </div>
      </ul>
    </form>
  </div>
  
</div>

<script>
  function login() {
    var email = document.getElementById("email").value,
        password = document.getElementById("password").value;

    var data = {
      email: email,
      password: password
    };

    fetch('http://172.20.10.12:8000/api/auth/login', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json'
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
        localStorage.setItem('token', result.access_token);
        location.href="/dashboard";
        // console.log('pindah ke dashboard');
      }).catch(err => {
        console.log('error');
      })
  }
</script>
</body>
</html>
@endsection