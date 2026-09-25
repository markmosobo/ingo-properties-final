<template>
    <Branch>
        <!-- HEADER -->
        <header>
            <meta property="og:url" content="https://ingoproperties.co.ke/properties/{{service.id}}" />
            <meta property="og:type" content="article" />
            <meta property="og:title" content="{{service.title}}" />
            <meta property="og:description" content="{{service.description}}" />
            <!-- <meta property="og:image" content="https://ingoproperties.co.ke/storage/properties/{{image1}}" /> -->

            <!-- NAVBAR TOP -->
            <!-- <div class="topbar d-none d-sm-block">
                <div class="container ">
                    <div class="row">
                        <div class="col-sm-12 col-md-5">
                            <div class="topbar-left">
                                <div class="topbar-text">
                                    Monday, March 22, 2020
                                    Because You are Worth
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="list-unstyled topbar-right">
                                <ul class="topbar-link">
                                    <li><a href="#" title="">Career</a></li>
                                    <li>
                                        <router-link to="/contact" custom v-slot="{ href, navigate, isActive }">
                                        <a
                                            :href="href"
                                            @click="navigate"
                                        > 
                                        Contact Us</a>
                                        </router-link>
                                    </li>
                                    <li v-if="isEmpty">
                                        <router-link to="/login" custom v-slot="{ href, navigate, isActive }">
                                        <a
                                            :href="href"
                                            @click="navigate"
                                        > Login / Register</a>
                                    </router-link>
                                    </li>
                                </ul>
                                <ul class="topbar-sosmed">
                                    <li>
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- END NAVBAR TOP -->
            <!-- NAVBAR -->
            <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
                <div class="container">
                    <a class="navbar-brand" href="#">
                        <!-- <img src="images/logo-blue-stiky.png" alt="" class="img-fluid"> -->
                        <img src="/images/ingo-colored-logo.png" alt="" class="img-fluid">

                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav99">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="main_nav99">
                        <ul class="navbar-nav mx-auto ">
                            <li class="nav-item">
                                <router-link to="/" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="nav-link"
                                    @click="navigate"
                                > 
                                Home
                                </a>
                                </router-link>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown"> Properties </a>
                                <ul class="dropdown-menu dropdown-menu-left animate fade-up">
                                    <li>
                                        <router-link to="/saleproperties" custom v-slot="{ href, navigate, isActive }">
                                        <a
                                            :href="href"
                                            :class="{ active: isActive }"
                                            class="dropdown-item"
                                            @click="navigate"
                                        > 
                                        For Sale
                                        </a>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/rentproperties" custom v-slot="{ href, navigate, isActive }">
                                        <a
                                            :href="href"
                                            :class="{ active: isActive }"
                                            class="dropdown-item"
                                            @click="navigate"
                                        > 
                                        For Rent
                                        </a>
                                        </router-link>
                                    </li>
                                    <li>
                                        <router-link to="/allproperties" custom v-slot="{ href, navigate, isActive }">
                                        <a
                                            :href="href"
                                            :class="{ active: isActive }"
                                            class="dropdown-item"
                                            @click="navigate"
                                        > 
                                        Featured Properties
                                        </a>
                                        </router-link>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item">
                                <router-link to="/ourprojects" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="nav-link"
                                    @click="navigate"
                                > 
                                Projects
                                </a>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/ourblogs" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="nav-link"
                                    @click="navigate"
                                > 
                                Blogs
                                </a>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/aboutus" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="nav-link"
                                    @click="navigate"
                                > 
                                About Us
                                </a>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link to="/contactus" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="nav-link"
                                    @click="navigate"
                                > 
                                Contact
                                </a>
                                </router-link>
                            </li>
                        </ul>


                        <!-- Search bar.// -->
                        <ul class="navbar-nav ">
                            <li v-if="isEmpty">
                                <router-link to="/login" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="btn rounded-pill btn-success text-capitalize"
                                    @click="navigate"
                                > 
                                <!-- <a href="login.php" class="btn btn-primary text-capitalize"> -->
                                <i class="fa fa-sign-in mr-1"></i> Sign In</a>
                                </router-link>
                            </li>
                            <li v-else>
                                <router-link to="/dashboard" custom v-slot="{ href, navigate, isActive }">
                                <a
                                    :href="href"
                                    :class="{ active: isActive }"
                                    class="btn rounded-pill btn-success text-capitalize"
                                    @click="navigate"
                                > 
                                <!-- <a href="login.php" class="btn btn-primary text-capitalize"> -->
                                <i class="fa fa-user mr-1"></i> Dashboard</a>
                                </router-link>
                            </li>
                        </ul>
                        <!-- Search content bar.// -->
                        <div class="top-search navigation-shadow">
                            <div class="container">
                                <div class="input-group ">
                                    <form action="#">

                                        <div class="row no-gutters mt-3">
                                            <div class="col">
                                                <input class="form-control border-secondary border-right-0 rounded-0"
                                                    type="search" value="" placeholder="Search " id="example-search-input4">
                                            </div>
                                            <div class="col-auto">
                                                <a class="btn btn-outline-secondary border-left-0 rounded-0 rounded-right"
                                                    href="#">
                                                    <i class="fa fa-search"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Search content bar.// -->
                    </div> <!-- navbar-collapse.// -->
                </div>
            </nav>
            <!-- END NAVBAR -->
        <!-- BREADCRUMB -->
        <div class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section__breadcrumb-v1">
                            <ol class="breadcrumb mb-0 bg-light">
                                <li class="breadcrumb-item">
                                    <router-link to="/">
                                    <a href="#"><i class="fa fa-home"></i>Home </a>
                                    </router-link>
                                </li>
                                <li class="breadcrumb-item">
                                    <router-link to="/ourservices">
                                        <a href="#">Our Services</a>
                                    </router-link> 
                                </li>
                                <li class="breadcrumb-item active"> <span class="text-capitalize"> {{service.title}}</span>
                                </li>

                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END BREADCRUMB -->
        </header>
        <div class="clearfix"></div>
        <!-- END HEADER -->    
        <!-- LISTING LIST -->
        <section class="profile__agents">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- LOCATION -->
                        <div class="single__detail-features tabs__custom">
                            <!-- <h5 class="text-capitalize detail-heading"> description</h5> -->
                   
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="pills-tab-one" role="tabpanel"
                                    aria-labelledby="pills-tab-one">
                                    <div class="single__detail-desc">
                                        <h5 class="text-capitalize detail-heading"> {{service.title}}</h5>
                                        <!-- <div class="show__more"> -->
                                            <p>{{service.description}}</p>
                                            <!-- <a href="javascript:void(0)" class="show__more-button ">read more</a> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="tab-pane fade" id="pills-tab-two" role="tabpanel"
                                    aria-labelledby="pills-tab-two">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery16.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">vila in coral gables</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!

                </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery17.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">Ample Apartment At Last Floor</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
            
                                </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery18.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">Ample Apartment At Last Floor</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
            
                                </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery8.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">Family Home For Sale</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery9.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">Luxury Villa With Pool</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery10.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">184 Lexington Avenue</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>
                                                                </li>

                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card__image card__box-v1">
                                                <div class="row no-gutters">
                                                    <div class="col-md-4 col-lg-3 col-xl-4">
                                                        <div class="card__image__header h-250">
                                                            <a href="#">
                                                                <div class="ribbon text-capitalize">sold out</div>
                                                                <img src="images/gallery11.jpg" alt=""
                                                                    class="img-fluid w100 img-transition">
                                                                <div class="info"> for sale</div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                        <div class="card__image__body">

                                                            <span
                                                                class="badge badge-primary text-capitalize mb-2">house</span>
                                                            <h6>
                                                                <a href="#">The Citizen Apartment 5th Floor</a>
                                                            </h6>
                                                            <div class="card__image__body-desc">
                                                                <!-- <p class="text-capitalize">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!
                
                                    </p> -->
                                                                <p class="text-capitalize">
                                                                    <i class="fa fa-map-marker"></i>
                                                                    west flaminggo road, las vegas
                                                                </p>
                                                            </div>

                                                            <ul class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> 2
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        rooms <br>
                                                                        <i class="fa fa-inbox"></i> 3
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        area <br>
                                                                        <i class="fa fa-map"></i> 4300 sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                        <div class="card__image__footer">
                                                            <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure>
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item name">
                                                                    <a href="#">
                                                                        tom wilson
                                                                    </a>

                                                                </li>


                                                            </ul>
                                                            <ul class="list-inline  my-auto ml-auto price">
                                                                <li class="list-inline-item ">

                                                                    <h6>$350.000</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="clearfix"></div>

                                </div>

                                <div class="tab-pane fade" id="pills-tab-four" role="tabpanel"
                                    aria-labelledby="pills-tab-four">

                                    <!-- RATE US  WRITE -->
                                    <div class="single__detail-features-review ">
                                        <div class="media mt-4">
                                            <img src="images/profile-blog.jpg" alt="" class="img-fluid rounded-circle mr-3">
                                            <div class="media-body">
                                                <h6 class="mt-0">Jhon doe</h6>
                                                <span class="mb-3">Mei 13, 2020</span>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">3/5</li>
                                                </ul>
                                                <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                    ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                                                    viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                                                    Donec
                                                    lacinia congue felis in faucibus.</p>

                                                <div class="media mt-4">
                                                    <a class="pr-3" href="#">
                                                        <img src="images/logo.jpg" alt="" class="img-fluid rounded-circle">
                                                    </a>
                                                    <div class="media-body">
                                                        <h6 class="mt-0">Mark </h6>
                                                        <span class="mb-3">Mei 13, 2020</span>
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item">
                                                                <i class="fa fa-star selected"></i>
                                                                <i class="fa fa-star selected"></i>
                                                                <i class="fa fa-star selected"></i>
                                                                <i class="fa fa-star selected"></i>
                                                                <i class="fa fa-star selected"></i>
                                                            </li>
                                                            <li class="list-inline-item">5/5</li>
                                                        </ul>
                                                        <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus
                                                            scelerisque ante sollicitudin. </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="media mt-4">
                                            <img src="images/profile-blog.jpg" alt="" class="img-fluid rounded-circle mr-3">
                                            <div class="media-body">
                                                <h6 class="mt-0">Jhon Doe</h6>
                                                <span class="mb-3">Mei 13, 2020</span>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                    </li>
                                                    <li class="list-inline-item">5/5</li>
                                                </ul>
                                                <p> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                    ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus
                                                    viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                                                    Donec
                                                    lacinia congue felis in faucibus.</p>


                                            </div>
                                        </div>
                                        <!-- COMMENT -->
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="mb-2">Your rating for this listing:</p>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star selected"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </li>
                                                    <li class="list-inline-item">3/5</li>
                                                </ul>
                                                <div class="form-group">
                                                    <label>Your Name</label>
                                                    <input type="text" class="form-control" required="required">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>What's your Email?</label>
                                                    <input type="email" class="form-control" required="required">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Subject</label>
                                                    <input type="text" class="form-control" required="required">

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Your message</label>
                                                    <textarea class="form-control" rows="4"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary float-right "> Submit review <i
                                                class="fa fa-paper-plane ml-2"></i></button>
                                        <!-- END COMMENT -->
                                    </div>

                                    <!-- END RATE US  WRITE -->
                                    <div class="clearfix"></div>
                                </div>


                            </div>
                            <!-- END FILTER VERTICAL -->
                        </div>
                        <!-- END LOCATION -->
                    </div>
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <!-- ARCHIVE CATEGORY -->
                            <aside class=" wrapper__list__category">
                                <!-- CATEGORY -->
                                <div class="widget widget__archive">
                                    <div class="widget__title">
                                        <h5 class="text-dark mb-0 text-center"> Property Categories</h5>
                                    </div>
                                    <ul class="list-unstyled">
                                    <li v-for="category in categories" :key="category.id">
                                        <a href="#" class="text-capitalize">
                                            {{category.name}}
                                            <!-- <span class="badge badge-success">14</span> -->
                                        </a>
                                    </li>
                                </ul>
                                </div>
                                <!-- END CATEGORY -->
                            </aside>
                            <!-- End ARCHIVE CATEGORY -->
                
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- END LISTING LIST -->
    </Branch>
</template>

<script>
import Branch from "../components/Branch.vue";
import axios from 'axios';

export default {
    data() {
        return {
            service: [],
            categories: [],
        }
    },
    components: {
        Branch,
    },
    methods: {
        getData() {
            axios.get('/api/service/'+this.$route.params.id, {
            }).then((response) => {
                this.service = response.data.service
                console.log("data", this.project)


            })
        },
        loadLists(){
            axios.get('/api/lists').then((response) => {
                this.categories = response.data.lists.categories
            })
        }
    },
    mounted() {
        this.getData();
        this.loadLists();
    }


};

</script>

<style>
body {
 font-family: sans-serif;
}

/* Add WA floating button CSS */
.floating {
 position: fixed;
 width: 60px;
 height: 60px;
 bottom: 40px;
 right: 40px;
 background-color: #25d366;
 color: #fff;
 border-radius: 50px;
 text-align: center;
 font-size: 30px;
 box-shadow: 2px 2px 3px #999;
 z-index: 100;
}

.fab-icon {
 margin-top: 16px;
}

.slideshow {
  position: relative;
  width: 100%;
  max-width: 600px;
  margin: 0 auto;
  overflow: hidden;
}

.slides {
  display: flex;
  animation: slideshow 12s infinite;
}

@keyframes slideshow {
    0% { transform: translateX(0%); }
  25% { transform: translateX(-100%); }
  50% { transform: translateX(-200%); }
  75% { transform: translateX(-300%); }
  100% { transform: translateX(0%); }
}

.slides img {
  flex: 0 0 100%;
  width: 100%;
  height: auto;
}
     
</style>