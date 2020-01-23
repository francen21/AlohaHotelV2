@extends('layouts.app')

@section('content')

<nav class="navbar navbar-default navbar-transparent navbar-fixed-top" color-on-scroll="200">
    <!-- if you want to keep the navbar hidden you can add this class to the navbar "navbar-burger"-->
    <div class="container">
        <div class="navbar-header">
            <button id="menu-toggle" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a href="/home" class="navbar-brand">
                Aloha Hotel | Booking
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right navbar-uppercase">
                <li class="dropdown">
                    <a href="#gaia" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-share-alt"></i> Share
                    </a>
                    <ul class="dropdown-menu dropdown-danger">
                        <li>
                            <a href="#"><i class="fa fa-facebook-square"></i> Facebook</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>


<div class="section section-header">
    <div class="parallax filter filter-color-red">
        <div class="image"
            style="background-image: url('assets/img/header-1.jpeg')">
        </div>
        <div class="container">
            <div class="content">
                <div class="title-area">
                    <h1 class="title-modern">Aloha Hotel</h1>
                    <div class="separator line-separator">♦</div>
                </div>

                <div class="button-get-started">
                    <a class="btn btn-white btn-fill btn-lg ">
                        Book
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="section section-our-team-freebie">
    <div class="parallax filter filter-color-black">
        <div class="image" style="background-image:url('assets/img/header-2.jpeg')">
        </div>
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="title-area">
                        <h2>Rooms</h2>
                        <div class="separator separator-danger">✻</div>
                        <p class="description">We build by getting to know you, your needs and creating the best service.</p>
                    </div>
                </div>

                <div class="team">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card card-member">
                                        <div class="content">
                                            <div class="avatar avatar-danger">
                                            </div>
                                            <div class="description">
                                                <h3 class="title">Regular</h3>
                                                <p class="small-text">1 - 2 Persons</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-member">
                                        <div class="content">
                                            <div class="avatar avatar-danger">
                                            </div>
                                            <div class="description">
                                                <h3 class="title">Deluxe</h3>
                                                <p class="small-text">1 - 4 persons</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="section section-our-clients-freebie">
    <div class="container">
        <div class="title-area">
            <h5 class="subtitle text-gray">Here are some</h5>
            <h2>Clients Testimonials</h2>
            <div class="separator separator-danger">∎</div>
        </div>

        <ul class="nav nav-text" role="tablist">
            <li class="active">
                <a href="#testimonial1" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-bordered-sm" src="assets/img/faces/face_5.jpg"/>
                    </div>
                </a>
            </li>
            <li>
                <a href="#testimonial2" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-bordered-sm" src="assets/img/faces/face_6.jpg"/>
                    </div>
                </a>
            </li>
            <li>
                <a href="#testimonial3" role="tab" data-toggle="tab">
                    <div class="image-clients">
                        <img alt="..." class="img-bordered-sm" src="assets/img/faces/face_2.jpg"/>
                    </div>
                </a>
            </li>
        </ul>


        <div class="tab-content">
            <div class="tab-pane active" id="testimonial1">
                <p class="description">
                    "Really clean!!"
Stopped here over night on the way to Seattle. The hotel smells fresh and clean. The room was spotless and fresh also. The pool area is hot as a sauna. We are very pleased with our hotel choice and look forward to a nice night. We would stay here again if in the area.

                </p>
            </div>
            <div class="tab-pane" id="testimonial2">
                <p class="description">"Excellent Hotel and Staff"
                    This is one of the best hotels we stayed in. Room was large with a sitting area with a couch. The room was very, very clean and modern. The staff at the front desk was very friendly, helpful and professional. They even gave us a bottle of water for being a Choice Hotel member. The lobby was nice and clean. Breakfast area was large. There were several kitchen staff members constantly monitoring the breakfast items. There was plenty for everyone, including tons of bacon. I definitely would stay at this hotel again.
                </p>
            </div>
            <div class="tab-pane" id="testimonial3">
                <p class="description"> "A wonderful Stay!!!"
                    We had a great, spacious room. Upkeep was perfect at this hotel, it looked brand new. Our bed was comfortable. We had a Jacuzzi room, it was perfect and we could see the TV while sitting in the hot tub. We liked that! It was a quiet hotel and we slept great! The continental breakfast was also very good. We found the front desk to be friendly and helpful as well.
                </p>
            </div>

        </div>

    </div>
</div>


<div class="section section-small section-get-started">
    <div class="parallax filter">
        <div class="image"
            style="background-image: url('assets/img/office-1.jpeg')">
        </div>
        <div class="container">
            <div class="title-area">
                <h2 class="text-white">Do you want to work with us?</h2>
                <div class="separator line-separator">♦</div>
                <p class="description"> We are keen on creating a second skin for anyone with a sense of style! We design our clothes having our customers in mind and we never disappoint!</p>
            </div>

            <div class="button-get-started">
                <a href="#gaia" class="btn btn-danger btn-fill btn-lg">Contact Us</a>
            </div>
        </div>
    </div>
</div>


<footer class="footer footer-big footer-color-black" data-color="black">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-md-offset-1 col-sm-3">
                <div class="info">
                    <h5 class="title">Follow us on</h5>
                    <nav>
                        <ul>
                            <li>
                                <a href="#" class="btn btn-social btn-facebook btn-simple">
                                    <i class="fa fa-facebook-square"></i> Facebook
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <hr>
        <div class="copyright">
             © <script> document.write(new Date().getFullYear()) </script> Made with love
        </div>
    </div>
</footer>

@endsection
