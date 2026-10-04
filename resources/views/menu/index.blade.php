<!DOCTYPE html>
<html lang="en">

<!-- Basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Site Metas -->
<title>{{ $settings['company_name'] ?? 'Plante Pharma' }}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">

<!-- Site Icons -->
@php
	$faviconPath = $settings['favicon'] ?? 'images/logo.png';
	$logoPath = $settings['logo'] ?? 'images/logo.png';

	$resolve = function ($path) {
		if (empty($path)) return asset('images/default-image.png');
		if (filter_var($path, FILTER_VALIDATE_URL)) return $path;
		if (file_exists(public_path($path))) return asset($path);
		if (\Illuminate\Support\Facades\Storage::disk('public')->exists($path)) return asset('storage/' . $path);
		return asset('images/default-image.png');
	};
@endphp

<link rel="shortcut icon" href="{{ $resolve($faviconPath) }}" type="image/x-icon" />
<link rel="apple-touch-icon" href="{{ $resolve($logoPath) }}">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- Site CSS -->
<link rel="stylesheet" href="style.css">
<!-- Responsive CSS -->
<link rel="stylesheet" href="css/responsive.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="css/custom.css">
<script src="js/modernizr.js"></script> <!-- Modernizr -->

<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

<!-- Font Awesome CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body id="page-top" class="politics_version">

	<!-- LOADER -->
	<div id="preloader">
	    <div class="loader">
	        <div class="loader-logo">
	            <img src="{{ asset('images/logo.png') }}" alt="Loading..." class="img-fluid" style="width: 100px;">
	        </div>
	        <div class="loader-animation">
	            <div class="loader-dot"></div>
	            <div class="loader-dot"></div>
	            <div class="loader-dot"></div>
	        </div>
	    </div>
	</div>

	<style>
	    /* Preloader Styles */
	    #preloader {
	        position: fixed;
	        top: 0;
	        left: 0;
	        width: 100%;
	        height: 100%;
	        background: #ffffff;
	        z-index: 9999;
	        display: flex;
	        justify-content: center;
	        align-items: center;
	        transition: opacity 0.5s ease, visibility 0.5s ease;
	    }

	    #preloader.hidden {
	        opacity: 0;
	        visibility: hidden;
	    }

	    .loader {
	        text-align: center;
	    }

	    .loader-logo {
	        margin-bottom: 20px;
	        animation: bounce 2s infinite;
	    }

	    .loader-animation {
	        display: flex;
	        justify-content: center;
	        gap: 8px;
	        margin-top: 20px;
	    }

	    .loader-dot {
	        width: 12px;
	        height: 12px;
	        background: #4CAF50;
	        border-radius: 50%;
	        display: inline-block;
	        animation: scale 1.4s infinite ease-in-out;
	    }

	    .loader-dot:nth-child(1) { animation-delay: 0s; }
	    .loader-dot:nth-child(2) { animation-delay: 0.2s; }
	    .loader-dot:nth-child(3) { animation-delay: 0.4s; }

	    @keyframes bounce {
	        0%, 100% { transform: translateY(0); }
	        50% { transform: translateY(-10px); }
	    }

	    @keyframes scale {
	        0%, 100% { transform: scale(0.5); opacity: 0.5; }
	        50% { transform: scale(1); opacity: 1; }
	    }
	</style>

	<script>
	    // Hide preloader when page is fully loaded
	    window.addEventListener('load', function() {
	        setTimeout(function() {
	            const preloader = document.getElementById('preloader');
	            if (preloader) {
	                preloader.classList.add('hidden');
	                // Remove preloader from DOM after animation completes
	                setTimeout(() => {
	                    preloader.style.display = 'none';
	                }, 500);
	            }
	        }, 1000); // Adjust this delay as needed
	    });
	</script>
	<!-- END LOADER -->

	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
		<div class="container">
				<a class="navbar-brand js-scroll-trigger" href="#page-top">
					@php $navLogo = $settings['logo'] ?? 'images/logo.png'; @endphp
					<img class="img-fluid" src="{{ $resolve($navLogo) }}" width="125" alt="" />
				</a>
			<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
				data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
				aria-label="Toggle navigation">
				Menu
				<i class="fa fa-bars"></i>
			</button>
			<div class="collapse navbar-collapse" id="navbarResponsive">
				<ul class="navbar-nav text-uppercase ml-auto">
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger active" href="#home">{{ $settings['nav_home_en'] ?? 'Home' }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#about">{{ $settings['nav_about_en'] ?? 'About Us' }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#categories">{{ $settings['nav_categories_en'] ?? 'Categories' }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#portfolio">{{ $settings['nav_partner_en'] ?? 'Partner' }}</a>
					</li>
					<li class="nav-item">
						<a class="nav-link js-scroll-trigger" href="#contact">{{ $settings['nav_contact_en'] ?? 'Contact Us' }}</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button"
							data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fas fa-globe"></i> EN
						</a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown">
							<a class="dropdown-item active" href="#" data-lang="en">English</a>
							<a class="dropdown-item" href="#" data-lang="es">Español</a>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<div id="home" class="ct-header ct-header--slider ct-slick-custom-dots">
    <div class="ct-slick-homepage" data-arrows="true" data-autoplay="false">
        @foreach($slides as $slide)
        <div class="ct-header tablex item" data-background="{{ $slide->image_url ?? asset('images/default-slide.jpg') }}">
            <div class="ct-u-display-tablex">
                <div class="inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-8 slider-inner">
								@php
									$lang = session('language', 'en');
									$heroTitleSetting = $settings['hero_title_' . $lang] ?? $settings['hero_title_en'] ?? 'Welcome to Plante Pharma';
									$heroButtonSetting = $settings['hero_button_' . $lang] ?? $settings['hero_button_en'] ?? 'About Plante Pharma';
									$heroDescriptionSetting = $settings['hero_description_' . $lang] ?? $settings['hero_description_en'] ?? '';

									// Prefer settings values (admin) over slide values when available
									$displayTitle = $heroTitleSetting ?: ($slide->title ?? 'Welcome to Plante Pharma');

									$displayButtonText = $heroButtonSetting ?: ($slide->button_text ?? 'About Plante Pharma');
									$displayButtonLink = $settings['hero_button_link'] ?? ($slide->button_link ?? '#about');
								@endphp

								<h1 class="big animated">
									@if($loop->first)
										@php $slideLogo = $settings['logo'] ?? 'images/logo.png'; @endphp
										<img src="{{ $resolve($slideLogo) }}" width="175" alt="Plante Pharma Logo" />
									@endif
									{{ $displayTitle }}
								</h1>

								@if(!empty($displayDescription))
									<p class="lead">{{ $displayDescription }}</p>
								@endif

								@if(!empty($displayButtonText))
									<a class="btn-new from-middle animated" href="{{ $displayButtonLink }}">
										{{ $displayButtonText }}
									</a>
								@endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Fallback slides if no slides in database --}}
        @if($slides->isEmpty())
		<div class="ct-header tablex item" data-background="{{ asset('uploads/banner4.jpg') }}">
            <div class="ct-u-display-tablex">
                <div class="inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-lg-8 slider-inner">
								<h1 class="big animated">
									@php $heroLogo = $settings['logo'] ?? 'images/logo.png'; @endphp
									<img src="{{ $resolve($heroLogo) }}" width="175" alt="Plante Pharma Logo" />
									{{ $settings['hero_title_en'] ?? 'Welcome to Plante Pharma' }}
								</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ct-header tablex item" data-background="{{ asset('uploads/banner1.jpg') }}">
            <div class="ct-u-display-tablex">
                <div class="inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 slider-inner">
                                <h1 class="big animated">{{ $settings['hero_title_en'] ?? 'Welcome to Plante Pharma' }}</h1>
                                <a class="btn-new from-middle animated" href="#about">
                                    {{ $settings['hero_button_en'] ?? 'About Plante Pharma' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="ct-header tablex item" data-background="{{ asset('uploads/banner2.jpg') }}">
            <div class="ct-u-display-tablex">
                <div class="inner">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-lg-8 slider-inner">
                                <h1 class="big animated">{{ $settings['hero_title_en'] ?? 'Welcome to Plante Pharma' }}</h1>
                                <a class="btn-new from-middle animated" href="#about">
                                    {{ $settings['hero_button_en'] ?? 'About Plante Pharma' }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div><!-- .ct-slick-homepage -->
</div><!-- .ct-header -->

	<div id="about" class="section wb">
		<div class="container">
			<div class="row">
				<div class="col-md-8">
					<div class="message-box">
						<h2>{{ $settings['about_title_en'] ?? 'About Plante Pharma' }}</h2>
						<p>{{ $settings['about_description_en'] ?? 'Plante Pharma is a producer of Medicine and dietary supplements, intended for sale only in pharmacies. From the beginning of our activity in the pharmaceutical market, we focus on innovation and the effectiveness of recipes and products.' }}</p>
						<p>{{ $settings['about_description_en_2'] ?? 'Our manufacturing site offers advanced capabilities and a rich technological experience where everyday a team of committed and competent employees work to develop and manufacture safe and efficient pharmaceutical products. Innovation, the highest quality and effective operation of products are always key issues for us.' }}</p>
					</div><!-- end messagebox -->
				</div><!-- end col -->

				<div class="col-md-4">
					<div class="right-box-pro wow fadeIn">
						@php $aboutImg = $settings['about_image'] ?? 'images/logo.png'; @endphp
						<img src="{{ $resolve($aboutImg) }}" alt="" class="img-fluid img-rounded fat-ab">
					</div><!-- end media -->
				</div><!-- end col -->
			</div><!-- end row -->

			<hr>
			<div class="row">
				<div class="col-md-4">
					<div class="services-inner-box">
						<div class="ser-icon">
							<i class="fas fa-lightbulb"></i>
						</div>
						<h2>{{ $settings['mission_title_en'] ?? 'Our Mission & Vision' }}</h2>
						<p>{{ $settings['mission_description_en'] ?? 'Always offer a premium and effective product in the health segment at prices affordable to everyone, including proper advice guaranteeing optimal results. Our mission is to acquire and maintain a stable and constantly expanding group of satisfied customers that bring profit to the Company and maintain a stable market position as a large, professional and reliable producer of cosmetics popular on the world market, with particular emphasis on the European Union market.' }}</p>
					</div>
				</div><!-- end col -->
				<div class="col-md-4">
					<div class="services-inner-box">
						<div class="ser-icon">
							<i class="fas fa-comments"></i>
						</div>
						<h2>{{ $settings['why_choose_title_en'] ?? 'Why Choose us?' }}</h2>
						<p>{{ $settings['why_choose_description_en'] ?? 'Plante Pharma products have an effective formulation and innovative combination of ingredients. The selection of raw materials is based on their purity and safety. All active ingredients are highly bioavailable and clinically tested with a determined mechanism of action. Quality & Regulatory Compliance is a core value of our company implemented at all the levels, from the manufacturing to the delivery of our products.' }}</p>
					</div>
				</div><!-- end col -->
				<div class="col-md-4">
					<div class="services-inner-box">
						<div class="ser-icon">
							<i class="fas fa-star"></i>
						</div>
						<h2>{{ $settings['values_title_en'] ?? 'Our Values' }}</h2>
						<p>{{ $settings['values_description_en'] ?? 'To treat every employee with dignity & respect and create a culture of continuous learning & growth. To develop a long term & transparent relationship with our business associates by entering into value added ventures which are mutually beneficial. To share the benefits of our success with the communities and be socially responsible. To nurture talent & enhance teamwork.' }}</p>
					</div>
				</div><!-- end col -->
			</div><!-- end row -->
		</div><!-- end container -->
	</div><!-- end section -->

        @php $lang = session('language', 'en'); @endphp
        <div id="categories" class="section lb">
		<div class="container">
				<div class="section-title text-center">
					<h3>
						{{ $settings['nav_categories_' . $lang] ?? 'Categories Product' }}
					</h3>
				</div><!-- end title -->

			<div class="gallery-list row">
				@if(isset($items) && $items->count() > 0)
					@foreach($items as $item)
					<div class="col-md-4 col-sm-6 gallery-grid gal_a gal_b">
						<div class="gallery-single spi-hr fix">
							<img src="{{ $item->cover_image_url }}" class="img-fluid" alt="{{ $item['name_' . $lang] ?? $item->name }}" />
							<div class="text-hover">
								<h3>
									<b><br>{{ __('Trade Name') }}: </b>
									{{ $item['trade_name_' . $lang] ?? $item['name_' . $lang] ?? $item->trade_name ?? $item->name }}<br>
									<b>{{ __('Form') }}: </b> {{ $item['origin_' . $lang] ?? $item->origin ?? 'N/A' }}<br>
									<b>{{ __('Packaging') }}: </b> {{ $item['packaging_' . $lang] ?? $item->packaging ?? 'N/A' }} <br>
									<b>{{ __('Composition') }}:</b> {{ \Illuminate\Support\Str::limit($item['composition_' . $lang] ?? $item->composition ?? ($item['desc_' . $lang] ?? $item->description ?? ''), 120) }} <br>
								</h3>
							</div>
							<div class="img-overlay">
								<a href="{{ $item->cover_image_url }}" data-rel="prettyPhoto[gal]"></a>
							</div>
							<div class="mt-2 px-3 pb-3">
								<div class="d-flex justify-content-between align-items-center">
									<div class="fw-medium">{{ $item['name_' . $lang] ?? $item->name }}</div>
									<div class="text-success">{{ $item->currency ?? '' }} {{ $item->normal_price ?? '' }}</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<div class="col-12 text-center">
						<div class="loading-products">No products found</div>
					</div>
				@endif
			</div>
		</div>
	</div>


	<div id="portfolio" class="section lb">
		<div class="container">
				<div class="section-title text-center">
					<h3>
						{{ $settings['nav_partner_' . $lang] ?? 'Partners List' }}
					</h3>
				</div><!-- end title -->

			<div class="gallery-list row">
				@if(isset($partners) && $partners->count() > 0)
					@foreach($partners as $partner)
					<div class="col-md-4 col-sm-6 gallery-grid gal_a gal_b">
						<div class="gallery-single spi-hr fix">
							<img src="{{ $partner->image_url }}" class="img-fluid" alt="{{ $partner->name[$lang] ?? 'Partner' }}" onerror="this.src='{{ asset('images/default-image.png') }}'" />
							<div class="text-hover">
								<h3>
									<b>{{ __('Partner Name') }}: </b>
									{{ $partner->name[$lang] ?? 'N/A' }}<br>
									<b>{{ __('Description') }}: </b> {{ \Illuminate\Support\Str::limit($partner->description[$lang] ?? '', 150) }}<br>
									@if(!empty($partner->website_link))
										<b><a href="{{ $partner->website_link }}" target="_blank" style="color: #426792;">{{ __('Visit Website') }}</a></b>
									@endif
								</h3>
							</div>
							<div class="img-overlay">
								<a href="{{ $partner->image_url }}" data-rel="prettyPhoto[gal]"></a>
							</div>
						</div>
					</div>
					@endforeach
				@else
					<div class="col-12 text-center">
						<div class="loading-products">No partners found</div>
					</div>
				@endif
			</div>
		</div>
	</div>

	<div id="blog" class="section lb">
		<div class="container">
				<div class="section-title text-center">
					<h3>{{ $settings['quality_title_en'] ?? 'Quality Assurance' }}</h3>
				</div><!-- end title -->

			<div class="row">
				<div class="col-md-4 col-sm-6 col-lg-4">
					<figure class="snip1401">
						@php $strategyImg = $settings['strategy_image'] ?? 'uploads/1111.jpg'; @endphp
						<img src="{{ $resolve($strategyImg) }}" alt="Strategy" />
						<figcaption>
							<h3>&nbsp;{{ $settings['strategy_title_en'] ?? 'Strategy' }}</h3>
							<p>{{ $settings['strategy_description_en'] ?? 'Product – choose the right product within the health group, offering the highest quality at fair and affordable prices' }}</p>
							<ul>
								<li><a href="{{ $settings['strategy_link'] ?? 'quality.html' }}">
										<font color="426792">[Read More...]</font>
									</a></li>
							</ul>
						</figcaption>
						<i class="ion-ios-home-outline"></i>
						<a href="#"></a>
					</figure>
				</div>
				<div class="col-md-4 col-sm-6 col-lg-4">
					<figure class="snip1401 hover">
						@php $qualityImg = $settings['quality_card_image'] ?? 'uploads/blog-02.jpg'; @endphp
						<img src="{{ $resolve($qualityImg) }}" alt="Quality" />
						<figcaption>
							<h3>&nbsp;{{ $settings['quality_card_title_en'] ?? 'Quality' }}</h3>
							<p>{{ $settings['quality_card_description_en'] ?? 'Plante Pharma products have an effective formulation and innovative combination of ingredients.' }}</p>
							<ul>
								<li><a href="{{ $settings['quality_card_link'] ?? 'quality.html' }}">
										<font color="426792">[Read More...]</font>
									</a></li>
							</ul>
						</figcaption>
					</figure>
				</div>
				<div class="col-md-4 col-sm-6 col-lg-4">
					<figure class="snip1401">
						@php $manufacturingImg = $settings['manufacturing_image'] ?? 'uploads/blog-03.jpg'; @endphp
						<img src="{{ $resolve($manufacturingImg) }}" alt="Manufacturing" />
						<figcaption>
							<h3>{{ $settings['manufacturing_title_en'] ?? 'Manufacturing' }}</h3>
							<p>{{ $settings['manufacturing_description_en'] ?? 'All our products are manufactured in the EU under GMP standards using top quality manufacturing equipment and strict quality control.' }}</p>
							<ul>
								<li><a href="{{ $settings['manufacturing_link'] ?? 'quality.html' }}">
										<font color="426792">[Read More...]</font>
									</a></li>
							</ul>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>
	</div>

	<div id="contact" class="section db">
    <div class="container">
        <div class="section-title text-center">
            <h3>Contact us</h3>
            {{ $settings['contact_description_en'] ?? 'Plante Pharma is growing fast and we are looking to expand our network of distributors worldwide. We want to develop a real partnership with each distributor, offering them a line of Ready-to-market products, with all the technical, commercial and marketing support needed to ensure their success.' }}

            <br>
            <a href="mailto:{{ $settings['contact_email'] ?? 'info@plantepharma.eu' }}">
                <font color="FFFFFF">{{ $settings['contact_email'] ?? 'info@plantepharma.eu' }}</font>
            </a>
        </div><!-- end title -->

        <div class="row">
            <div class="col-md-12">
				<div class="contact_form">
					@if(session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif
					@if($errors->any())
						<div class="alert alert-danger">{{ $errors->first('message') }}</div>
					@endif
					<div id="message"></div>
					<form id="contactForm" name="sentMessage" action="{{ route('contact.submit') }}" method="POST" novalidate="novalidate">
						@csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" name="name" id="name" type="text" placeholder="Your Name"
                                        required="required"
                                        data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger name-error"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="email" id="email" type="email" placeholder="Your Email"
                                        required="required"
                                        data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger email-error"></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="phone" id="phone" type="tel" placeholder="Your Phone"
                                        data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger phone-error"></p>
                                </div>
                                <!-- Optional Subject Field -->
                                <div class="form-group">
                                    <input class="form-control" name="subject" id="subject" type="text" placeholder="Subject (Optional)"
                                        data-validation-required-message="Please enter a subject.">
                                    <p class="help-block text-danger subject-error"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" name="message" id="message_text" placeholder="Your Message"
                                        required="required"
                                        data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger message-error"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button id="sendMessageButton" class="btn-new from-middle animated"
                                    data-text="Send Message" type="submit">
                                    <font color="FFFFFF">Send Message</font>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- end col -->
        </div><!-- end row -->
    </div><!-- end container -->
</div>


	<!-- end section -->

	<div class="copyrights">
		<div class="container">
			<div class="footer-distributed">
				<div class="footer-left">
					<p class="footer-company-name">All Rights Reserved. &copy; {{ date('Y') }} <a href="#">{{ $settings['company_name'] ?? 'Plante Pharma' }}</a></p>
				</div>
			</div>
		</div><!-- end container -->
	</div><!-- end copyrights -->

	<a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

	<!-- ALL JS FILES -->
	<script src="js/all.js"></script>
	<!-- Camera Slider -->
	<script src="js/jquery.mobile.customized.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/parallaxie.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/animated-slider.js"></script>
	<!-- Contact form JavaScript -->
	<script src="js/jqBootstrapValidation.js"></script>
	<script src="js/contact_me.js"></script>
	<!-- ALL PLUGINS -->
	<script src="js/custom.js"></script>

	<!-- Language Switcher Script -->
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			// Load settings from backend for dynamic content
			let settings = @json($settings);

			// Language translations
			const translations = {
				en: {
					// Navigation
					'home': settings.nav_home_en || 'Home',
					'about': settings.nav_about_en || 'About Us',
					'partner': settings.nav_partner_en || 'Partner',
					'quality': settings.nav_quality_en || 'Quality',
					'contact': settings.nav_contact_en || 'Contact Us',
					'categories': settings.nav_categories_en || 'Categories',
					'language': 'EN',

					// Hero Section
					'welcome': settings.hero_title_en || 'Welcome to Plante Pharma',
					'aboutBtn': settings.hero_button_en || 'About Plante Pharma',

					// About Section
					'aboutTitle': settings.about_title_en || 'About Plante Pharma',
					'aboutText': settings.about_description_en || 'About description text',

					// Mission, Vision, Values
					'missionTitle': settings.mission_title_en || 'Our Mission & Vision',
					'missionText': settings.mission_description_en || 'Mission description text',

					'whyUsTitle': settings.why_choose_title_en || 'Why Choose us?',
					'whyUsText': settings.why_choose_description_en || 'Why choose us text',

					'valuesTitle': settings.values_title_en || 'Our Values',
					'valuesText': settings.values_description_en || 'Values description text',

					// Quality Section
					'qualityTitle': settings.quality_title_en || 'Quality Assurance',
					'strategyTitle': settings.strategy_title_en || 'Strategy',
					'strategyText': settings.strategy_description_en || 'Strategy description',
					'qualityCardTitle': settings.quality_card_title_en || 'Quality',
					'qualityCardText': settings.quality_card_description_en || 'Quality description',
					'manufacturingTitle': settings.manufacturing_title_en || 'Manufacturing',
					'manufacturingText': settings.manufacturing_description_en || 'Manufacturing description',

					// Contact Section
					'contactDescription': settings.contact_description_en || 'Contact description text'
				},
				es: {
					// Navigation
					'home': settings.nav_home_es || 'Inicio',
					'about': settings.nav_about_es || 'Sobre Nosotros',
					'partner': settings.nav_partner_es || 'Socio',
					'quality': settings.nav_quality_es || 'Calidad',
					'contact': settings.nav_contact_es || 'Contáctenos',
					'categories': settings.nav_categories_es || 'Categorías',
					'language': 'ES',

					// Hero Section
					'welcome': settings.hero_title_es || 'Bienvenido a Plante Pharma',
					'aboutBtn': settings.hero_button_es || 'Sobre Plante Pharma',

					// About Section
					'aboutTitle': settings.about_title_es || 'Sobre Plante Pharma',
					'aboutText': settings.about_description_es || 'Descripción sobre nosotros',

					// Mission, Vision, Values
					'missionTitle': settings.mission_title_es || 'Nuestra Misión y Visión',
					'missionText': settings.mission_description_es || 'Descripción de misión',

					'whyUsTitle': settings.why_choose_title_es || '¿Por qué elegirnos?',
					'whyUsText': settings.why_choose_description_es || 'Descripción de por qué elegirnos',

					'valuesTitle': settings.values_title_es || 'Nuestros Valores',
					'valuesText': settings.values_description_es || 'Descripción de valores',

					// Quality Section
					'qualityTitle': settings.quality_title_es || 'Garantía de Calidad',
					'strategyTitle': settings.strategy_title_es || 'Estrategia',
					'strategyText': settings.strategy_description_es || 'Descripción de estrategia',
					'qualityCardTitle': settings.quality_card_title_es || 'Calidad',
					'qualityCardText': settings.quality_card_description_es || 'Descripción de calidad',
					'manufacturingTitle': settings.manufacturing_title_es || 'Fabricación',
					'manufacturingText': settings.manufacturing_description_es || 'Descripción de fabricación',

					// Contact Section
					'contactDescription': settings.contact_description_es || 'Descripción de contacto'
				}
			};

			// Set default language
			let currentLang = localStorage.getItem('language') || 'en';

			// Update language selection in dropdown
			function updateLanguageSelection() {
				// Update dropdown text
				document.querySelector('#languageDropdown i').nextSibling.textContent = ' ' + translations[currentLang].language;

				// Update active state in dropdown
				document.querySelectorAll('[data-lang]').forEach(el => {
					if (el.dataset.lang === currentLang) {
						el.classList.add('active');
					} else {
						el.classList.remove('active');
					}
				});
			}

			// Translate the page
			function translatePage() {
				// Navigation - use data attributes instead of text matching
				const navItems = {
					'home': document.querySelector('a[href="#home"]'),
					'about': document.querySelector('a[href="#about"]'),
					'partner': document.querySelector('a[href="#portfolio"]'),
					'quality': document.querySelector('a[href="#blog"]'),
					'contact': document.querySelector('a[href="#contact"]'),
					'categories': document.querySelector('a[href="#categories"]')
				};

				// Update navigation text
				for (const [key, element] of Object.entries(navItems)) {
					if (element && translations[currentLang][key]) {
						element.textContent = translations[currentLang][key];
					}
				}

				// Hero section
				const heroTitle = document.querySelector('.big.animated');
				if (heroTitle && heroTitle.textContent.includes('Welcome')) {
					heroTitle.textContent = translations[currentLang].welcome;
				}

				const aboutBtn = document.querySelector('.btn-new.from-middle.animated');
				if (aboutBtn && aboutBtn.textContent.includes('About')) {
					aboutBtn.textContent = translations[currentLang].aboutBtn;
				}

				// About section
				const aboutTitle = document.querySelector('#about h2');
				if (aboutTitle) aboutTitle.textContent = translations[currentLang].aboutTitle;

				const aboutText = document.querySelector('#about .message-box p');
				if (aboutText) aboutText.textContent = translations[currentLang].aboutText;

				// Mission, Vision, Values
				const sections = document.querySelectorAll('.services-inner-box');
				if (sections.length >= 3) {
					// Mission
					sections[0].querySelector('h2').textContent = translations[currentLang].missionTitle;
					sections[0].querySelector('p').textContent = translations[currentLang].missionText;

					// Why Us
					sections[1].querySelector('h2').textContent = translations[currentLang].whyUsTitle;
					sections[1].querySelector('p').textContent = translations[currentLang].whyUsText;

					// Values
					sections[2].querySelector('h2').textContent = translations[currentLang].valuesTitle;
					sections[2].querySelector('p').textContent = translations[currentLang].valuesText;
				}

				// Quality section
				const qualityTitle = document.querySelector('#blog .section-title h3');
				if (qualityTitle) {
					qualityTitle.innerHTML = `<img src="images/plante_shape.png" width="45">&nbsp;${translations[currentLang].qualityTitle}`;
				}

				// Contact section
				const contactDescription = document.querySelector('#contact .section-title');
				if (contactDescription) {
					const emailLink = contactDescription.querySelector('a');
					const textContent = contactDescription.childNodes[2].textContent.trim();
					if (textContent.includes('Plante Pharma is growing fast')) {
						contactDescription.childNodes[2].textContent = ' ' + translations[currentLang].contactDescription;
					}
				}

				// Update language selection in dropdown
				updateLanguageSelection();
			}

			// Handle language switch
			document.querySelectorAll('[data-lang]').forEach(link => {
				link.addEventListener('click', function (e) {
					e.preventDefault();
					currentLang = this.dataset.lang;
					localStorage.setItem('language', currentLang);
					translatePage();

					// Persist selection server-side so server-rendered content (hero) updates
					try {
						const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
						fetch("{{ route('language.change') }}", {
							method: 'POST',
							headers: {
								'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
								'X-CSRF-TOKEN': token
							},
							body: new URLSearchParams({ language: currentLang }),
							credentials: 'same-origin'
						}).then(resp => {
							if (resp.ok) {
								// reload to let server render chosen language
								window.location.reload();
							}
						}).catch(() => {
							// ignore network errors, client-side translation still applies
						});
					} catch (err) {
						// fail silently
					}
				});
			});

			// Initialize the page with the correct language
			translatePage();
		});
	</script>
</body>
</html>
