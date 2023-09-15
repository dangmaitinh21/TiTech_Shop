<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Head -->
  @include('authPage.head')
</head>
<body class="hold-transition {{ $title === 'Login' ? 'login-page' : 'register-page' }}">


<div class="{{ $title === 'Login' ? 'login-box' : 'register-box' }}">
  <div class="{{ $title === 'Login' ? 'login-logo' : 'register-logo' }}">
    <a href="#"><b>{{ $title }}</b> Account</a>
  </div>

  <div class="card">
    <div class="card-body {{ $title === 'Login' ? 'login-card-body' : 'register-card-body' }}">
      <p class="{{ $title === 'Login' ? 'login-box-msg' : 'register-box-msg' }}">{{ $title === 'Login' ? 'Sign in to start your session' : 'Register a new membership' }}</p>

      @include('components.alert')

      @if($title === 'Login')
      <div>
        <form action="/login/authentication" method="post">
          <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>

          </div>
          <!-- create token of form with @csrf (syntax of Blade Template) -->
          @csrf 
        </form>

        <p class="mb-1">
          <a href="#">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="/register" class="text-center">Register a new membership</a>
        </p>
      </div>

      @else
      <div>
        <form action="/register/add" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" value="{{ old('password') }}" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>

            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>

          </div>
        </form>
        <a href="/login" class="text-center">I already have a membership</a>
      </div>
      @endif
    </div>

  </div>
</div>


<!-- Footer -->
@include('authPage.footer')
</body>
</html>
