<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Campaign With Us</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets-landing/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets-landing/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets-landing/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets-landing/favicon/site.webmanifest') }}">

    <!--stylesheet-->
    <link rel="stylesheet" href="{{ asset('assets-landing/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets-landing/css/style.css') }}">
</head>

<body>

    <!--preloader start-->
    <div class="preloader">
        <img src="{{ asset('assets-landing/images/loading-logo.png') }}" alt="image">
    </div>
    <!--preloader end-->

    <!--header section start-->
    <header class="header header-1">
        <div class="container">
            <div class="header__wrapper">
                <div class="header__logo">
                    <a href="index.html">
                        <img src="{{ asset('assets-landing/images/footer-logo.png') }}" class="img-fluid"
                            alt="logo">
                    </a>
                </div>
                <div class="header__nav">
                    <ul class="header__nav-primary">
                        <li><a href="index.html"><i class="fad fa-home-alt"></i></a></li>
                        <li class="nav__dropdown dropdown-wrapper" id="menu-1">
                        <a href="#" class="nav__dropdown-info dropdown-info"> Home</a>
                        </li>
                        <li><a href="#video">About</a></li>
                        <li><a href="#feature">Features</a></li>
                        <li><a href="#feedback">feedback</a></li>
                        <li><a href="#faq">FAQs</a></li>
                        <li><a href="#preview">Preview</a></li>
                        <li><a href="#campaign">Campaigns</a></li>
                        <li><a href="{{route('login')}}" type="button" class="btn btn-outline-primary btn-lg">Admin Login</a></li>
                    </ul>
                    <span><i class="fas fa-times"></i></span>
                </div>
                <div class="header__bars">
                    <div class="header__bars-bar header__bars-bar-1"></div>
                    <div class="header__bars-bar header__bars-bar-2"></div>
                    <div class="header__bars-bar header__bars-bar-3"></div>
                </div>
            </div>
        </div>
    </header>
    <!--header section end-->

    <!--hero section start-->
    <section class="hero">
        <div class="hero__wrapper">
            <div class="container">
                <div class="row align-items-lg-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <h1 class="main-heading color-black">Campaign on the fingertips!</h1>
                        <p class="paragraph"><span>CWS<sup>TM</sup></span> is an app that helps you earn
                            points as you campaign daily by using systematic
                            algorithms to generate campaigns.</p>
                        <div class="download-buttons">
                            <a href="#" class="google-play">
                                <i class="fab fa-google-play"></i>
                                <div class="button-content">
                                    <h6>GET IT ON <span>Android</span></h6>
                                </div>
                            </a>
                            <a href="#" class="apple-store">
                                <i class="fab fa-apple"></i>
                                <div class="button-content">
                                    <h6>GET IT ON <span>IOS</span></h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="questions-img hero-img">
                            <img src="{{ asset('assets-landing/images/phone-01.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--hero section end-->

    <!--feature section start-->
    <section class="feature" id="intro">
        <div class="container">
            <h2 class="section-heading color-black">Get surprised by campaigning with us.</h2>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--1" >
                        <div class="icon icon-1">
                            <i class="fad fa-user-check"></i>
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-1">
                                <h3>Join in Easy Steps</h3>
                                <p class="paragraph dark">Create an account with your details and get verified for points and payments</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--2">
                        <div class="icon icon-2">
                            <i class="fad fa-chart-pie"></i>
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-2">
                                <h3>Track Your Campaign</h3>
                                <p class="paragraph dark">Campaign daily, and earn rewards! Personalize messages, reach your audience, and turn your efforts into points.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--3">
                        <div class="icon icon-3">
                            <i class="fad fa-chart-line"></i>
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-3">
                                <h3>Improve Your Campaign</h3>
                                <p class="paragraph dark">Boost Your Campaign: Earn more rewards by personalizing messages and targeting the right audience with CWS.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="feature__box feature__box--4">
                        <div class="icon icon-4">
                            <i class="fad fa-money-bill-wave"></i>
                        </div>
                        <div class="feature__box__wrapper">
                            <div class="feature__box--content feature__box--content-4">
                                <h3>Transfer Your Points</h3>
                                <p class="paragraph dark">Convert Your Points to Cash: Earn, campaign, and easily transfer your points into real money with CWS..</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--feature section end-->

    <!--video section start-->
    <div class="video" id="video">
        <div class="video__wrapper">
            <div class="container">
                <div class="video__play">
                    <button type="button" data-toggle="modal" data-target="#videoModal">
                        <i class="fad fa-play"></i>
                    </button>
                    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-close">
                                    <button type="button" data-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="ytdefer yt-video" style="width: 100%; height: 100%;"
                                        data-src="2BrCE_zxM0U"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="video__background">
                    <img src="{{ asset('assets-landing/images/video-bg-1.png') }}" alt="image" class="texture-1">
                    <img src="{{ asset('assets-landing/images/video-img.png') }}" alt="image" class="phone">
                    <img src="{{ asset('assets-landing/images/video-bg-2.png') }}" alt="image" class="texture-2">
                </div>
            </div>
        </div>
    </div>
    <!--video section end-->

    <!--growth section start-->
    <section class="growth" id="feature">
        <div class="growth__wrapper">
            <div class="container">
                <h2 class="section-heading color-black">App that assists exponential growth.</h2>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-user-check"></i>
                            </div>
                            <div class="content">
                                <h3>Start Easily</h3>
                                <p class="paragraph dark">Download CWS, campaign, and start earning rewards right away with just a few clicks.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-chart-line"></i>
                            </div>
                            <div class="content">
                                <h3>Improve Growth</h3>
                                <p class="paragraph dark">Accelerate Growth: Earn more by expanding your reach and optimizing your campaigns with CWS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-solar-system"></i>
                            </div>
                            <div class="content">
                                <h3>CWS Algorithms</h3>
                                <p class="paragraph dark">Campaign daily by using systematic algorithms to generate campaigns.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-person-sign"></i>
                            </div>
                            <div class="content">
                                <h3>Expand Campaign</h3>
                                <p class="paragraph dark">Reach more voters, personalize your messages, and increase your earnings with CWS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-chart-pie"></i>
                            </div>
                            <div class="content">
                                <h3>View Campaign Statistics</h3>
                                <p class="paragraph dark">Track your progress, analyze performance, and optimize your efforts with real-time data on CWS.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="growth__box">
                            <div class="icon">
                                <i class="fad fa-ballot"></i>
                            </div>
                            <div class="content">
                                <h3>Measure Results</h3>
                                <p class="paragraph dark">Monitor your campaign impact and earnings with precise analytics on CWS.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="button__wrapper">
                        <a href="#" class="button">
                            <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
                        </a>
                        <a href="#" class="button">
                            <span>LEARN MORE <i class="fad fa-long-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--growth section end-->

    <!--step section start-->
    <section class="step">
        <div class="step__wrapper">
            <div class="container">
                <h2 class="section-heading color-black">Jumpstart your growth in just few clicks.</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="step__box">
                            <div class="image">
                                <img src="{{ asset('assets-landing/images/phone-01.png') }}" alt="image">
                            </div>
                            <div class="content">
                                <h3>EASY TO<span>Register.</span></h3>
                                <p class="paragraph dark">Join the app in 3 easy steps and get
                                    started with your campaign started.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="step__box">
                            <div class="image">
                                <img src="{{ asset('assets-landing/images/phone-02.png') }}" alt="image">
                            </div>
                            <div class="content">
                                <h3>SIMPLE TO<span>Campaign.</span></h3>
                                <p class="paragraph dark">Once you’re signed up you can create
                                    share as many campaign posts as possible.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="step__box">
                            <div class="image">
                                <img src="{{ asset('assets-landing/images/phone-03.png') }}" alt="image">
                            </div>
                            <div class="content">
                                <h3>FUN TO<span>Earn.</span></h3>
                                <p class="paragraph dark">Earn points as you campaign, convert your points and withdraw.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="button__wrapper">
                        <a href="#" class="button">
                            <span>GET STARTED <i class="fad fa-long-arrow-right"></i></span>
                        </a>
                        <a href="#" class="button">
                            <span>LEARN MORE <i class="fad fa-long-arrow-right"></i></span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--step section end-->

    <!--client section start-->
    <section class="clients-sec" id="feedback">
        <div class="container">
            <h2 class="section-heading color-black">Hear from the campaign team.</h2>
            <div class="testimonial__wrapper">
                <div class="client client-01 active">
                    <div class="image">
                        <img src="{{ asset('assets-landing/images/testimonial-img-01.png') }}" alt="image">
                    </div>
                    <div class="testimonial">
                        <div class="testimonial__wrapper">
                            <p>"Ready to make a difference and earn rewards? Download the CWS app today! Join our campaign, earn points for your actions, and help us drive real change. Your impact starts here!"</p>
                            <h4>— </h4>
                        </div>
                    </div>
                </div>
                <div class="client client-02">
                    <div class="image">
                        <img src="{{ asset('assets-landing/images/testimonial-img-02.png') }}" alt="image">
                    </div>
                    <div class="testimonial">
                        <div class="testimonial__wrapper">
                            <p>“Want to contribute to a cause and be rewarded for it? The CWS app lets you earn points as you campaign. Download now, start earning, and make a meaningful difference!”</p>
                            <h4>— DAVID SPADE</h4>
                        </div>
                    </div>
                </div>
                <div class="client client-03">
                    <div class="image">
                        <img src="{{ asset('assets-landing/images/testimonial-img-03.png') }}" alt="image">
                    </div>
                    <div class="testimonial">
                        <div class="testimonial__wrapper">
                            <p>“Turn your passion into points! Download the CWS app and start earning rewards as you engage with our campaign. Your efforts will not only drive change but also earn you awesome perks!”</p>
                            <h4>— DAVID SPADE</h4>
                        </div>
                    </div>
                </div>
                <div class="client client-04">
                    <div class="image">
                        <img src="{{ asset('assets-landing/images/testimonial-img-04.png') }}" alt="image">
                    </div>
                    <div class="testimonial">
                        <div class="testimonial__wrapper">
                            <p>“Join the CWS community and be a campaign superstar! Download the app to start earning points for your support and stay updated on the latest campaign news and events. Your journey to making a difference starts now!”</p>
                            <h4>— DAVID SPADE</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clients">
                <div class="clients__info">
                    <h3>All 275</h3>
                    <p class="paragraph dark">Constituencies in all 16 regions accross the country. Get affiliated, Campaign with us, lets win!</p>
                </div>
                <div class="swiper-container clients-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('assets-landing/images/client-img.png') }}"
                                    alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('assets-landing/images/client-img.png') }}"
                                    alt="image"></a>
                        </div>
                        <div class="swiper-slide clients-slide">
                            <a href="#"><img src="{{ asset('assets-landing/images/client-img.png') }}"
                                    alt="image"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--client section end-->

    <!--questions section start-->
    <section class="questions" id="faq">
        <div class="questions__wrapper">
            <div class="container">
                <h2 class="section-heading color-black">Some frequently asked questions.</h2>
                <div class="row align-items-lg-center">
                    <div class="col-lg-6 order-2 order-lg-1">
                        <div id="accordion">
                            <div class="card" id="card-1">
                                <div class="card-header" id="heading-1">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse-1"
                                            aria-expanded="true" aria-controls="collapse-1">
                                            What is Campaign With Us?
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse-1" class="collapse show" aria-labelledby="heading-1"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Campaign With Us is an affiliate campaign platform that allows users to earn rewards by sharing campaign messages, liking posts, and reading content. By engaging with the platform, users accumulate points which can be converted adn withdrawn</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-2">
                                <div class="card-header" id="heading-2">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-2" aria-expanded="false"
                                            aria-controls="collapse-2">
                                            How do I get started with Campaign With Us?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-2" class="collapse" aria-labelledby="heading-2"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Download the app, create an account, and follow the onboarding instructions. You’ll be guided on how to share campaign messages, like posts, and read content to start earning points.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-3">
                                <div class="card-header" id="heading-3">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-3" aria-expanded="false"
                                            aria-controls="collapse-3">
                                            How do I earn points on the platform?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-3" class="collapse" aria-labelledby="heading-3"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Points can be earned by sharing the platform’s URL and campaign posts on social media, liking campaign posts, and reading campaign messages. Each action contributes to your total points.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-4">
                                <div class="card-header" id="heading-4">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-4" aria-expanded="false"
                                            aria-controls="collapse-4">
                                            How are points converted for withdrawal?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-4" class="collapse" aria-labelledby="heading-4"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Accumulated points can be converted into money directly through the app. You can request a withdrawal once you reach the minimum threshold for payment.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-5">
                                <div class="card-header" id="heading-5">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-5" aria-expanded="false"
                                            aria-controls="collapse-5">
                                            What is the minimum amount required for withdrawal?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-5" class="collapse" aria-labelledby="heading-5"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">The minimum withdrawal amount is specified in the app. Ensure you have accumulated at least this amount before making a withdrawal request.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-6">
                                <div class="card-header" id="heading-6">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-6" aria-expanded="false"
                                            aria-controls="collapse-6">
                                            Can I share campaign messages directly from the app?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-6" class="collapse" aria-labelledby="heading-6"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Yes, you are supposed to share campaign messages and URLs directly from the app to your preferred social media platforms.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-7">
                                <div class="card-header" id="heading-7">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-7" aria-expanded="false"
                                            aria-controls="collapse-7">
                                            Is my personal information secure?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-7" class="collapse" aria-labelledby="heading-7"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Yes, we prioritize your privacy and use secure methods to protect your personal information. For more details, please review our privacy policy available in the app.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card" id="card-7">
                                <div class="card-header" id="heading-7">
                                    <h5 class="mb-0 hidden">
                                        <button class="btn btn-link collapsed" data-toggle="collapse"
                                            data-target="#collapse-7" aria-expanded="false"
                                            aria-controls="collapse-7">
                                            Can I participate in multiple campaigns simultaneously?
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapse-7" class="collapse" aria-labelledby="heading-7"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <p class="paragraph">Yes, you can participate in and promote multiple campaigns at the same time through the app.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2">
                        <div class="questions-img">
                            <img src="{{ asset('assets-landing/images/phone-01.png') }}" alt="image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>
    <!--questions section end-->

    <!--screenshot section start-->
    <section class="screenshot" id="preview">
        <div class="screenshot__wrapper">
            <div class="container">
                <div class="screenshot__info">
                    <h2 class="section-heading color-black">Have a look at what’s inside the app.</h2>
                    <div class="screenshot-nav">
                        <div class="screenshot-nav-prev"><i class="fad fa-long-arrow-left"></i></div>
                        <div class="screenshot-nav-next"><i class="fad fa-long-arrow-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="swiper-container screenshot-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('assets-landing/images/phone-01.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('assets-landing/images/phone-02.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('assets-landing/images/phone-03.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('assets-landing/images/phone-04.png') }}" alt="image">
                    </div>
                    <div class="swiper-slide screenshot-slide">
                        <img src="{{ asset('assets-landing/images/phone-05.png') }}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--screenshot section end-->

    <!--related blog section start-->
    <section class="related-blog blog" id="campaign">
        <div class="related-blog__wrapper">
            <h2 class="section-heading color-black">Campaign Posts from our MPs.</h2>
            <div class="blog__content">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="blog-single.html">
                                <div class="blog__single blog__single--1">
                                    <div class="blog__single-image">
                                        <img src="{{ asset('assets-landing/images/blog-img-1.png') }}"
                                            alt="image">
                                    </div>
                                    <div class="blog__single-info">
                                        <h3>New features coming in 2020 to our app.</h3>
                                        <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17, 2020</h4>
                                        <p class="paragraph dark">Suisque metus tortor ultricies ac ligula neced
                                            eleifend dales felise morbi nec tempor isvel ultricies lideula. </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-8">
                            <a href="blog-single.html">
                                <div class="blog__single blog__single--2">
                                    <div class="blog__single-image">
                                        <img src="{{ asset('assets-landing/images/blog-img-2.png') }}"
                                            alt="image">
                                    </div>
                                    <div class="blog__single-info">
                                        <h3>New features coming in 2020 to our app.</h3>
                                        <h4>12 <i class="fad fa-comment"></i><span>|</span>Dec 17, 2020</h4>
                                        <p class="paragraph dark">Suisque metus tortor ultricies ac ligula neced
                                            eleifend dales felise morbi nec tempor isvel ultricies lideula. </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <a href="blog.html" class="button">
                <span>JOIN THE CAMPAIGN<i class="fad fa-long-arrow-right"></i></span>
            </a>
        </div>
    </section>
    <!--related blog section end-->



    <!--footer start-->
    <footer class="footer">
        <div class="footer__wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer__info">
                            <div class="footer__info--logo">
                                <img src="{{ asset('assets-landing/images/footer-logo.png') }}" alt="image">
                            </div>
                            <div class="footer__info--content">
                                <p class="paragraph dark">CWS is an app that helps you earn
                                    points as you campaign daily by using systematic
                                    algorithms to generate campaigns.</p>
                                <div class="social">
                                    <ul>
                                        <li class="facebook"><a href="#"><i class="fab fa-facebook-f"></i></a>
                                        </li>
                                        <li class="twitter"><a href="#"><i class="fab fa-twitter"></i></a></li>
                                        <li class="linkedin"><a href="#"><i class="fab fa-linkedin-in"></i></a>
                                        </li>
                                        <li class="youtube"><a href="#"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="footer__content-wrapper">
                            <div class="footer__list">
                                <ul>
                                    <li>Explore</li>
                                    <li><a href="#">About</a></li>
                                    <li><a href="#">Features</a></li>
                                    <li><a href="#">How It Works</a></li>
                                    <li><a href="#">Our Faithfuls</a></li>
                                </ul>
                            </div>
                            <div class="footer__list">
                                <ul>
                                    <li>Help</li>
                                    <li><a href="#">FAQ</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Support</a></li>
                                    <li><a href="#">Contact</a></li>
                                </ul>
                            </div>
                            <div class="download-buttons">
                                <h5>Download</h5>
                                <a href="#" class="google-play">
                                    <i class="fab fa-google-play"></i>
                                    <div class="button-content">
                                        <h6>GET IT ON <span>Android</span></h6>
                                    </div>
                                </a>
                                <a href="#" class="apple-store">
                                    <i class="fab fa-apple"></i>
                                    <div class="button-content">
                                        <h6>GET IT ON <span>IOS</span></h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="footer__copy">
                        <h6>&copy; CWS. All Rights Reserved 2024</h6>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--footer end-->

    <script src="{{ asset('assets-landing/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/popper-1.16.0.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/bootstrap.min.js') }}"></script>
    <script>
        $(window).on('load', function() {
            $("body").addClass("loaded");
        });
    </script>
    <script src="{{ asset('assets-landing/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/ytdefer.min.js') }}"></script>
    <script src="{{ asset('assets-landing/js/script.js') }}"></script>
</body>

</html>
