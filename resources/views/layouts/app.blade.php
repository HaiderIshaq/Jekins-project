<!DOCTYPE html>
<html>
<head>
	@include('layouts.head')
</head>

      
          

<title>@yield('title','KGT ERP ')</title>
<body>
	@include('layouts.header')
	@include('layouts.sidebar')
    

	
<div class="main-container">
    <div class="pd-ltr-20  customscroll-10-p height-100-p xs-pd-20-10">
  
    @yield('content')
	@include('layouts.footer')
	
	</div>
</div>

		@if (Request::path() != '/home')
			<script src="{{ asset('js/app.js') }}"></script>
		@endif
		<script src="{{ asset('js/script.js') }}"></script>
	
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>    
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>    



</body>
</html>
