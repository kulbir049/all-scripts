<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Rasoi Software – Laravel Bootstrap 5 Admin & Dashboard Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template"/>

		<!-- Title -->
		<title> Rasoi Software – Laravel Bootstrap 5 Admin & Dashboard Template </title>

		@include('layouts.components.custom-styles')
		@livewireStyles
	</head>
	<body class="ltr error-page1">

		@yield('class')

            <!-- Loader -->
            <div id="global-loader">
                <img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
            </div>
            <!-- /Loader -->


            <div class="square-box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="page" >

                @yield('content')

            </div>
        </div>

		@include('layouts.components.custom-scripts')
		@if(session('error'))
		<script>
			Toastify({
				text: "{{ session('error') }}",
				backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc3a0)",
				duration: 3000
			}).showToast();
		</script>
		@endif

		@if(session('success'))
		<script>
			Toastify({
				text: "{{ session('success') }}",
				backgroundColor: "linear-gradient(to right, #56ab2f, #a8e063)",
				duration: 3000
			}).showToast();
		</script>
		@endif
		@livewireScripts
    </body>
</html>
