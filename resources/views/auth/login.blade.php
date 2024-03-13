


	@include('layouts.head')

	<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center pd-20">
		<div class="login-box bg-white box-shadow pd-30 border-radius-5">
			<img src="vendors/images/login-img.png" alt="login" class="login-img">
			<h2 class="text-center mb-30">Login</h2>
			
            <form method="POST" action="{{ route('login') }}">
            @csrf
				<div class="input-group custom input-group-lg">
                
					<input type="text" class="form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-user" aria-hidden="true"></i></span>
					</div>
                   
				</div>
				<div class="input-group custom input-group-lg">
					<input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" >
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					<div class="input-group-append custom">
						<span class="input-group-text"><i class="fa fa-lock" aria-hidden="true"></i></span>
					</div>
				</div>
                
        
				<div class="row">
					<div class="col-sm-6">
						<div class="input-group">
							<!--
								use code for form submit
								<input class="btn btn-outline-primary btn-lg btn-block" type="submit" value="Sign In">
							-->
							<button type="submit" class="btn btn-outline-primary btn-lg btn-block" value="Sign in">
                            {{ __('Login') }}
                            </button>
						</div>
					</div>
					
				</div>
			</form>

		</div>
	</div>
</body>
</html>