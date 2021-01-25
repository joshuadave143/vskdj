@extends('layouts.login')

@section('content')
<div class="content">
	<!-- BEGIN LOGIN FORM -->
    <form class="login-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}

		<h3 class="form-title">Login to your account</h3>
		<div class="alert alert-error display-hide">
			<button class="close" data-close="alert"></button>
			<span>
				 Enter any username and password.
			</span>
		</div> 

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
			<label class="control-label visible-ie8 visible-ie9">E-Mail Address</label>
			<div class="input-icon">
				<i class="fa fa-user"></i>
				<input class="form-control placeholder-no-fix"id="email" type="email" autocomplete="off" placeholder="E-Mail Address" name="email" value="{{ old('email') }}" required autofocus/>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>
		</div>
        
		<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
			<label class="control-label visible-ie8 visible-ie9">Password</label>
			<div class="input-icon">
				<i class="fa fa-lock"></i>
				<input id="password" class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="password" required/>
                @if ( $errors->has('password') )
                    <span class="help-block">
                        <strong>{{ $error->first('password') }}</strong>
                    </span>
                @endif
            </div>
		</div>
		<div class="form-actions">
			<label class="checkbox">
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
			<button type="submit" class="btn btn-info pull-right">
			Login </button>
		</div>
		<div class="create-account">
			<p>
				 Don't have an account yet ?&nbsp; <a href="/register" id="register-btn">Create an account</a>
			</p>
		</div>
	</form>
	<!-- END LOGIN FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
	 2019 &copy; Develop by Joshua Dave F. Tonido
</div>
@endsection
