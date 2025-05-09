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

        @include('layouts.components.styles')
		@livewireStyles()
		@yield('style')
		<style>
			.checkin-checkout{text-align: center;}
			</style>
						<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css" />

			<style>
				/* Custom Toastify Style */
				.toastify {
					background-color: #38cab3!important; /* Gradient background */
					color: white; /* Text color */
					border-radius: 5px; /* Rounded corners */
					font-size: 14px; /* Increase font size */
					padding: 10px 20px; /* Padding around the text */
				}

				/* Custom Close Button */
				.toastify .toast-close {
					color: white; /* Close button color */
					font-size: 14px; /* Close button font size */
				}

				/* Optional: Change position of Toastify */
				.toastify-right {
					right: 10px; /* Custom right positioning */
				}
				.toastify-top {
					top: 10px; /* Custom top positioning */
				}
			</style>

			<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

	</head>

	<body class="ltr main-body app sidebar-mini">

		<!-- Loader -->
		<div id="global-loader">
			<img src="{{asset('assets/img/loader.svg')}}" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->

		<!-- Page -->
		<div class="page">

			<div> 

                @include('layouts.components.app-header')

                @include('layouts.components.app-sidebar')
				

			</div>

			<!-- main-content -->
			<div class="main-content app-content">

				<!-- container -->
				<div class="main-container container-fluid">
				
                    @yield('content')

				</div>
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->

            @include('layouts.components.sidebar-right')

            @include('layouts.components.modal')

            @yield('modal')

            @include('layouts.components.footer')

		</div>
		<!-- End Page -->

        @include('layouts.components.scripts')
		@livewireScripts()

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

			@yield('script')
			<script>
					Livewire.on('success', message => {
						Toastify({
						text: message,
						backgroundColor: "#38cab3",
						duration: 3000
					}).showToast();
					});
				</script>
			

		<script>
			$(document).ready(function(){
				$('#toggleCheck').change(function(){
					if(this.checked) {
						// Change to Check In when toggled ON
						$('#checkOutTime').text("00:00:00");
						$('#checked_status').text("Checked In");
						} else {
						// Change to Check Out when toggled OFF
						$('#checked_status').text("Checked Out");
						$('#checkInTime').text("00:00:00");
						}
					});
				});
			</script>
			<!-- Listen for the event -->
			<script>
				document.getElementById('toggleCheck').addEventListener('change', function() {
					var isChecked = this.checked; // Get the checkbox state
					
					var status = isChecked ? 'Checked In' : 'Checked Out'; // Set status based on checkbox
					console.log(status);
					// AJAX request to update the status in the backend
					fetch('{{route("update-attendance-status")}}', {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'X-CSRF-TOKEN': '{{ csrf_token() }}' // CSRF token for security
						},
						body: JSON.stringify({ status: status })
					})
					.then(response => response.json())
					.then(data => {
						console.log(data); // Handle response data
						document.getElementById('checked_status').innerText = data.status; // Update status on page
						document.getElementById('checkInTime').innerText = data.records.total_time_checkin; // Update status on page
						document.getElementById('checkOutTime').innerText = data.records.total_time_checkout; // Update status on page
						document.getElementById(data.records.today_date_str).click();
					  })
					.catch(error => console.error('Error:', error));
				});
			</script>
		
    </body>
</html>
