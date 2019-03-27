@extends('index_layout')

@section('content')
<body id="blue_mountains_bg">

  <div class="flex_centered">

    <div class="index_slider">

      <input type="radio" name="slider" title="slide1" checked="checked" class="index_slider__nav"/>
      <input type="radio" name="slider" title="slide2" class="index_slider__nav"/>
      <input type="radio" name="slider" title="slide3" class="index_slider__nav"/>
      <input type="radio" name="slider" title="slide4" class="index_slider__nav"/>

      <div class="index_slider__inner">
        <div class="index_slider__contents">
          <i class="fas fa-cogs"></i>
          <h2 class="index_slider__caption">Fully Customizable</h2>
          <p class="index_slider__txt">Create your personalised daily itinerary to assist you on your trip.</p>
        </div>

        <div class="index_slider__contents">
          <i class="fas fa-laugh-beam"></i>
          <h2 class="index_slider__caption">User-friendly interface</h2>
          <p class="index_slider__txt">Our easy-to-use features will help you breeze through your planning process.</p>
        </div>

        <div class="index_slider__contents">
          <i class="fas fa-wallet"></i>
          <h2 class="index_slider__caption">Budget tracker</h2>
          <p class="index_slider__txt">Avoid credit card debt by not going over budget on your vacation.</p>
        </div>

        <div class="index_slider__contents">
          <i class="fas fa-comment-dollar" id="free-to-use"></i>
          <h2 class="index_slider__caption">Free to use</h2>
          <p class="index_slider__txt">No monthly subscriptions or whatnot. Sign up and start making one right away.</p>
        </div>

      </div>
    </div>


  <div class="centered_form">
    <form class="form-style-7" onSubmit="return checkPassword(this)">
      <ul>
      <li>
          <label for="fullname">Full Name</label>
          <input type="text" name="fullname" maxlength="100" required id="fullname">
          <span>Enter your full name</span>
      </li>
      <li>
          <label for="email">E-mail</label>
          <input type="email" name="email" maxlength="100" required id="email">
          <span>Enter a valid email address (for verification)</span>
      </li>
      <li>
          <label for="password">Password</label>
          <input type="password" name="password" maxlength="100" required id="password">
          <span>Enter your password</span>
      </li>
      <li>
          <label for="reenter-password">Re-enter password</label>
          <input type="password" name="repassword" maxlength="100" required id="repassword">
          <span>Re-enter your password</span>
      </li>

      <div class="submit_button">
        <input type="button" value="Sign Up" onclick="signup()">
      </div>

      <div class="redirect_button">
        <p class="login_text">Have an account?</p>
        <a href="login">Login</a>
      </div>

      </ul>
    </form>
  </div>
  
</div>




<script type="text/javascript">
//auto expand textarea
function adjust_textarea(h) {
    h.style.height = "20px";
    h.style.height = (h.scrollHeight)+"px";
}
</script>















<script>
  function signup() {
    var fullname = document.getElementById("fullname").value,
        email = document.getElementById("email").value,
        password = document.getElementById("password").value,
        repassword = document.getElementById("repassword").value;

    var data = {
      username: fullname,
      email: email,
      password: password,
      password_confirmation: repassword
    };

    fetch('http://mochinerary.id/api/register', {
      method: 'post',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
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