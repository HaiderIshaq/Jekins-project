	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>@yield('title')</title>

	<!-- Site favicon -->
	<!-- <link rel="shortcut icon" href="images/favicon.ico"> -->

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv=“Content-Security-Policy” content=“default-src ‘self’ gap://ready file://* *; style-src ‘self’ ‘unsafe-inline’; script-src ‘self’ ‘unsafe-inline’ ‘unsafe-eval’”/>
	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" href="{{ asset('vendors/styles/style.css') }}">
	<link rel="stylesheet" href="/css/app.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet">



<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<!-- 
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css"> -->


<script>

$(document).ready(function(){
    $(".dateElement").datepicker({dateFormat: 'dd/mm/yyyy','language' : 'en'});
    // alert('here')
  });

</script>


	