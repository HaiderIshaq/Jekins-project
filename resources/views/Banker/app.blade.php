<!DOCTYPE html>
<html>
<head>
	@include('Banker.head')
</head>

      
          

<title>@yield('title','KGT ERP ')</title>
<body>
	@include('Banker.header')
	@include('Banker.sidebar')
    

	
<div class="main-container">
    <div class="pd-ltr-20  customscroll-10-p height-100-p xs-pd-20-10">
  
    @yield('content')
	@include('Banker.footer')
	
	</div>
</div>

	




</body>
</html>
