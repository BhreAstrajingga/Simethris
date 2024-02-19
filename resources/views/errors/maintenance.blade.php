<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>
		Simethris 2023
	</title>
	<meta name="description" content="Page Title">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
	<!-- Call App Mode on ios devices -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Remove Tap Highlight on Windows Phone IE -->
	<meta name="msapplication-tap-highlight" content="no">
	<!-- smartadmin base css -->
	<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/vendors.bundle.css') }}">
	<link id="appbundle" rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/app.bundle.css') }}">
	<link id="mytheme" rel="stylesheet" media="screen, print" href="#">
	<link id="myskin" rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/skins/skin-master.css') }}">
	<!-- Place favicon.ico in the root directory -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon.png') }}">
	<link rel="mask-icon" href="{{ asset('img/logo.png') }}" color="#5bbad5">

	<!-- You can add your own stylesheet here to override any styles that comes before it
		<link rel="stylesheet" media="screen, print" href="css/your_styles.css">-->
	<link rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/skins/skin-master.css') }}">
	<link rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/fa-light.css') }}">
	<link rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/fa-regular.css') }}">
	<link rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/fa-solid.css') }}">
	<link rel="stylesheet" media="screen, print" href="{{ asset('css/smartadmin/fa-brands.css') }}">
	@yield('style')

</head>

<body class="mod-bg-1 mod-nav-link footer-function-fixed nav-function-minify nav-function-fixed">
	<!-- BEGIN Page Wrapper -->
	<div class="page-wrapper">
		<div class="page-inner">
			<div class="page-content-wrapper">
				<!-- BEGIN Page Content -->
				<!-- the #js-page-content id is needed for some plugins to initialize -->
				<main id="js-page-content" role="main" class="page-content">
					<!-- welcome message -->
					<div class="row mb-3">
						<div class="col text-center">
							<h1 class="hidden-md-down text-warning">Under Maintenance 🛠</h1>
							<h1 class="display-4 fw-700">{{env('APP_NAME')}}</h1>
							{{-- <h1 class="display-4 hidden-sm-up">Selamat Datang di {{env('APP_NAME')}}</h1> --}}
							<h4 class="hidden-md-down">
								<div class="d-flex flex-start w-100">
									<div class="d-flex flex-fill">
										<div class="flex-fill">
											<span class="text-muted js-get-date"></span>
										</div>
									</div>
								</div>
							</h4>
							<span></span>
							<span>To err is human; to forgive, divine.</span>
							<h3 class="fw-700 mb-0 mt-3 text-danger">
								We are sory You have experienced a technical error.
							</h3>
							<h3 class="fw-500 mb-0 mt-3">Contact the Administrator for further information.
							</h3>
							<img src="{{ asset('img/under-maintenance.svg') }}" class="position-absolute pos-top pos-left opacity-15" style="" alt="">
						</div>
					</div>
				</main>
				<!-- this overlay is activated only when mobile menu is triggered -->
				<div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
				<!-- BEGIN Page Footer -->

	<script src="{{ asset('js/vendors.bundle.js') }}"></script>
	<script src="{{ asset('js/app.bundle.js') }}"></script>

</body>

</html>
