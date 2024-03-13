<meta charset="utf-8">
	<title>Registration</title>

	<!-- Site favicon -->
	<!-- <link rel="shortcut icon" href="images/favicon.ico"> -->

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="vendors/styles/style.css">

	
<div class="login-wrap customscroll d-flex align-items-center flex-wrap justify-content-center ">
    <div class="login-box bg-white box-shadow pd-20 border-radius-5" style="max-width:550px;padding: 34px;">
        <img src="vendors/images/login-img.png" alt="login" class="login-img">
        <h2 class="text-center mb-30"></h2>
        
        <form method="POST" action="{{ route('register') }}">
        @csrf
            <div class="input-group custom input-group-lg">

                <div class="row">
                    <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Your name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
                    <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Your email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
            
               
            </div>
            <div class="input-group custom input-group-lg">
                
                <div class="row">
                    <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Your password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm your password">
                    </div>
                </div>

            </div>

            <div class="form-group" >
                
                <div class="row">

                <div class="col-md-6">
                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required  placeholder="Your phone-number">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <select name="region" class="form-control" id="city">
                            <option value="" selected disabled>Select your city</option> 
                            <option value="Karachi">Karachi</option>   
                            <option value="Islamabad">Isalamabad</option>   
                            <option value="Lahore">Lahore</option>   
                            <option value="Peshawar">Peshawar</option>   
                            <option value="Quetta">Quetta</option>   
                        </select>
                    </div>
                </div>
                
            </div>

            <div class="form-group" style="margin-top:25px">
                
                <div class="row">

                <div class="col-md-12">
                    <input id="company" type="text" class="form-control @error('company') is-invalid @enderror" name="company" required  placeholder="Your company-name">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12" style="margin-top:25px">
                    <input id="designation" type="text" class="form-control @error('designation') is-invalid @enderror" name="designation" required  placeholder="Your designation">

                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                
            </div>
            
            
            <div class="input-group custom input-group-lg" style="margin-top:25px">
                <div class="input-group sm-0" >
                
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                
                </div>
            </div>
        </form>

    </div>
</div>
<script src="js/script.js"></script>
</body>
</html>