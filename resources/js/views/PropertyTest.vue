<template>
    <Branch>
        <!-- HEADER -->
        <header>
            <meta property="og:url" content="https://ingoproperties.co.ke/properties/{{property.id}}" />
            <meta property="og:type" content="article" />
            <meta property="og:title" content="{{property.title}}" />
            <meta property="og:description" content="{{property.description}}" />
            <meta property="og:image" content="https://ingoproperties.co.ke/storage/properties/{{image1}}" />

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
                                    <router-link to="/allproperties">
                                        <a href="#">Our Properties</a>
                                    </router-link> 
                                </li>
                                <li class="breadcrumb-item active"> <span class="text-capitalize"> {{property.title}}</span>
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
    <!-- SINGLE DETAIL -->
    <section class="single__Detail">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- TITLE PROPERTY AND PRICE  -->
                    <div class="single__detail-area pt-0 pb-4">
                        <div class="row">
                            <div class="col-md-8 col-lg-8">
                                <div class="single__detail-area-title">
                                    <h3 class="text-capitalize">{{property.title}}</h3>
                                    <p> {{property.address}}</p>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4">
                                <div class="single__detail-area-price">
                                    <h3 v-if="property.property_status == 'rent'" class="text-capitalize text-gray">KES {{formatNumber(property.price)}}/{{property.price_period ? property.price_period : 'Month'}}</h3>
                                    <h3 v-else class="text-capitalize text-gray">KES {{formatNumber(property.price)}}</h3>
                                    <ul class="list-inline">
                                        <li class="list-inline-item">
                                            <a href="#" class="badge badge-success p-2 rounded"><i
                                                    class="fa fa-exchange"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="badge badge-success p-2 rounded"><i
                                                    class="fa fa-heart"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#" class="badge badge-success p-2 rounded"><i
                                                    class="fa fa-print"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END TITLE PROPERTY AND PRICE  -->

                    <!-- SLIDER IMAGE DETAIL -->

                    <div class="row justify-content-center">
                        <div class="col-md-8">
                        <!-- Slideshow container -->
                        <div class="slider-container">
                            <img class="slider" :src="getPhoto() + currentImage" alt="Image 1">
                            <div class="thumbnail-container">
                                <div class="slider">
                                <img v-for="item in property.images"
                                 :key="item.id" 
                                 class="thumbnail"
                                 :src="getPhoto() + item.name"
                                 alt="Image 1"
                                 @click="changeImage(item.id)">
                       <!--          <img class="thumbnail" :src="getPhoto() + image2" alt="Image 2" @click="changeImage(image2)">
                                <img class="thumbnail" :src="getPhoto() + image3" alt="Image 3" @click="changeImage(image3)"> -->
                                </div>    
                            </div>
                        </div>

                        </div>
                    </div>

                    <!-- END SLIDER IMAGE DETAIL -->
                </div>
                <div class="col-lg-4 pt-5">
                    <!-- FORM FILTER -->
                    <div class="products__filter mb-30">
                        <!-- <div class="products__filter__group">
                            <div class="products__filter__header">

                                <h5 class="text-center text-capitalize">property filter</h5>
                            </div>
                            <div class="products__filter__body">
                                <div class="form-group">

                                    <select class="wide select_option">
                                        <option data-display="Property Status">Property Status</option>
                                        <option>For Sale</option>
                                        <option>For Rent</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Property Type">Property Type</option>
                                        <option>Residential</option>
                                        <option>Commercial</option>
                                        <option>Land</option>
                                        <option>Luxury</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Area From">Area From </option>
                                        <option>1500</option>
                                        <option>1200</option>
                                        <option>900</option>
                                        <option>600</option>
                                        <option>300</option>
                                        <option>100</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Locations">Locations</option>
                                        <option>United Kingdom</option>
                                        <option>American Samoa</option>
                                        <option>Belgium</option>
                                        <option>Canada</option>
                                        <option>Delaware</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="wide select_option">
                                        <option data-display="Bedrooms">Bedrooms</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <select class="wide select_option">
                                            <option data-display="Bathrooms">Bathrooms</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="mb-3">Price range</label>
                                    <div class="filter__price">
                                        <input class="price-range" type="text" name="my_range" value="" />
                                    </div>
                                </div>

                                <div class="form-group mb-0 mt-2">

                                    <a class="btn btn-outline-primary btn-block text-capitalize advanced-filter"
                                        data-toggle="collapse" href="#multiCollapseExample1"
                                        aria-controls="multiCollapseExample1"><i class="fa fa-plus-circle"></i> advanced
                                        filter
                                    </a>

                                    <div class="collapse multi-collapse" id="multiCollapseExample1">
                                        <div class="advancedfilter">
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox2" type="checkbox">
                                                <label for="checkbox2" class="label-brand text-capitalize">
                                                    Air Conditioning
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox3" type="checkbox">
                                                <label for="checkbox3" class="label-brand text-capitalize">
                                                    Swiming Pool
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox4" type="checkbox">
                                                <label for="checkbox4" class="label-brand text-capitalize">
                                                    Central Heating
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox5" type="checkbox">
                                                <label for="checkbox5" class="label-brand text-capitalize">
                                                    Spa & Massage
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox6" type="checkbox">
                                                <label for="checkbox6" class="label-brand text-capitalize">
                                                    Pets Allow
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox7" type="checkbox">
                                                <label for="checkbox7" class="label-brand text-capitalize">
                                                    Air Conditioning
                                                </label>

                                            </div>

                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox8" type="checkbox">
                                                <label for="checkbox8" class="label-brand text-capitalize">
                                                    Gym
                                                </label>

                                            </div>

                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox9" type="checkbox">
                                                <label for="checkbox9" class="label-brand text-capitalize">
                                                    Alarm
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox10" type="checkbox">
                                                <label for="checkbox10" class="label-brand text-capitalize">
                                                    Window Covering
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox11" type="checkbox">
                                                <label for="checkbox11" class="label-brand text-capitalize">
                                                    Free WiFi
                                                </label>

                                            </div>
                                            <div class="checkbox checkbox-success">
                                                <input id="checkbox12" type="checkbox">
                                                <label for="checkbox12" class="label-brand text-capitalize">
                                                    Car Parking
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="products__filter__footer">
                                <div class="form-group mb-0">
                                    <button class="btn btn-success rounded-pill text-capitalize btn-block"><i
                                            class="fa fa-search ml-1"></i> search
                                        property </button>

                                </div>
                            </div>
                        </div> -->
                        <div class=" wrapper__list__category">
                            <!-- CATEGORY -->
                            <div class="widget widget__archive">
                                <div class="widget__title">
                                    <h5 class="text-dark mb-0 text-center">Property Categories </h5>
                                </div>
                                <ul class="list-unstyled">
                                    <li v-for="category in categories" :key="category.id">
                                        <a @click="navigate(category.id)" href="#" class="text-capitalize">
                                            {{category.name}}
                                            <!-- <span class="badge badge-success">14</span> -->
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- END CATEGORY -->
                        </div>

                    </div>
                    <!-- END FORM FILTER -->
                    <!-- FORM FILTER -->
                    <!-- <div class="products__filter mb-30">
                        <div class="products__filter__group">
                            <div class="products__filter__header">

                                <h5 class="text-center text-capitalize">simulation calculator </h5>
                            </div>
                            <div class="products__filter__body">
                                <div class="form-group">
                                    <label>Sale Price</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>

                                        </div>
                                        <input type="text" class="form-control" placeholder="$130.000">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Down Payment</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="$6.000">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Long Term (Years)</label>
                                    <select class="select_option wide">

                                        <option value="1">10</option>
                                        <option value="2">15</option>
                                        <option value="3">20</option>
                                        <option value="4">25</option>
                                    </select>

                                </div>

                                <div class="form-group">
                                    <label>Interest Rate</label>

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>

                                        </div>
                                        <input type="text" class="form-control" placeholder="10%">
                                    </div>
                                </div>
                            </div>
                            <div class="products__filter__footer">
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary text-capitalize btn-block"> calculate
                                        <i class="fa fa-calculator ml-1"></i>
                                    </button>

                                </div>
                            </div>
                        </div>
                    </div> -->

                    <!-- END FORM FILTER -->
                    <!-- <div class="sticky-top">
                        <div class="profile__agent mb-30">
                            <div class="profile__agent__group">

                                <div class="profile__agent__header">
                                    <div class="profile__agent__header-avatar">
                                        <figure>
                                            <img src="images/profile-blog.jpg" alt="" class="img-fluid">
                                        </figure>

                                        <ul class="list-unstyled mb-0">
                                            <li>
                                                <h5 class="text-capitalize">jhon doe</h5>
                                            </li>
                                            <li><a href="tel:123456"><i
                                                        class="fa fa-phone-square mr-1"></i>(123)456-7890</a></li>
                                            <li><a href="javascript:void(0)"><i class=" fa fa-building mr-1"></i>
                                                    Company name</a>
                                            </li>
                                            <li> <a href="javascript:void(0)" class="text-primary">View My Listing</a>
                                            </li>
                                        </ul>


                                    </div>

                                </div>
                                <div class="profile__agent__body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group mb-0">
                                        <textarea class="form-control required" rows="5" required="required"
                                            placeholder="I'm interest in [ Listing Single ]"></textarea>
                                    </div>
                                </div>
                                <div class="profile__agent__footer">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary text-capitalize btn-block"> send message <i
                                                class="fa fa-paper-plane ml-1"></i></button>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="download mb-0">
                            <h5 class="text-center text-capitalize">Property Attachments</h5>
                            <div class="download__item">
                                <a href="#" target="_blank"><i class="fa fa-file-pdf-o mr-3"
                                        aria-hidden="true"></i>Download Document.Pdf</a>
                            </div>
                            <div class="download__item">
                                <a href="#" target="_blank"><i class="fa fa-file-word-o mr-3"
                                        aria-hidden="true"></i>Presentation
                                    2016-17.Doc</a>
                            </div>
                        </div>


                    </div> -->
                </div>
                <div class="col-lg-8">
                    <!-- DESCRIPTION -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="single__detail-desc">
                                <h6 class="text-capitalize detail-heading">description</h6>
                                <p>{{property.description}}</p>

                                <!-- <div class="show__more">
                                    <p>{{property.description}}</p>
                                   
                                    
                                    <a href="javascript:void(0)" class="show__more-button ">read more</a>
                                </div> -->
                            </div>
                            <div class="clearfix"></div>

                            <!-- PROPERTY DETAILS SPEC -->
                            <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">property details</h6>
                                <!-- INFO PROPERTY DETAIL -->
                                <div class="property__detail-info">
                                    <div v-if="property.category_id == 3 || property.category_id == 4 || property.category_id == 7" class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Property ID:</b> {{property.id}}</li> -->
                                                <li><b>Price:</b> KES {{formatNumber(property.price)}}</li>
                                                <li><b>Property Size:</b> {{property.size}} Sq Ft</li>
                                                <li><b>Bedrooms:</b> {{property.bedrooms}}</li>
                                                <li><b>Bathrooms:</b> {{property.bathrooms}}</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Garage:</b> 1</li>
                                                <li><b>Garage Size:</b> 458 SqFt</li> -->
                                                <li><b>Property Status:</b> for {{property.property_status}}</li>
                                                <li><b>Property Location:</b> {{property.location}}</li>
                                                <li v-if="property.status == 1"><b>Current Status:</b> Open</li>
                                                <li v-else><b>Current Status:</b> Closed</li>
                                                <li v-if="property.negotiable == 1"><b>Negotiable:</b> Yes</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div v-else-if="property.category_id == 1 || property.category_id == 2" class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Property ID:</b> {{property.id}}</li> -->
                                                <li><b>Price:</b> KES {{property.price}}</li>
                                                <li><b>Property Size:</b> {{property.size}} Sq Ft</li>
                                                <li><b>Estate Name:</b> {{property.estate_name}}</li>
                                                <li v-if="property.negotiable == 1"><b>Negotiable:</b> Yes</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Garage:</b> 1</li>
                                                <li><b>Garage Size:</b> 458 SqFt</li> -->
                                                <li><b>Property Status:</b> for {{property.property_status}}</li>
                                                <li><b>Property Location:</b> {{property.location}}</li>
                                                <li v-if="property.status == 1"><b>Current Status:</b> Open</li>
                                                <li v-else><b>Current Status:</b> Closed</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div v-else class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Property ID:</b> {{property.id}}</li> -->
                                                <li><b>Price:</b> KES {{formatNumber(property.price)}}</li>
                                                <li><b>Land Area:</b> {{property.land_area}} Acre(s)</li>
                                                <li><b>Land Type:</b> {{property.land_type}}</li>
                                                <li v-if="property.negotiable == 1"><b>Negotiable:</b> Yes</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <!-- <li><b>Garage:</b> 1</li>
                                                <li><b>Garage Size:</b> 458 SqFt</li> -->
                                                <li><b>Property Status:</b> for {{property.property_status}}</li>
                                                <li><b>Property Location:</b> {{property.location}}</li>
                                                <li v-if="property.status == 1"><b>Current Status:</b> Open</li>
                                                <li v-else><b>Current Status:</b> Closed</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- <h6 class="text-primary">Additional details</h6>
                                    <div class="row">
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Property ID:</b> RV151</li>
                                                <li><b>Price:</b> $484,400</li>
                                                <li><b>Property Size:</b> 1466 Sq Ft</li>
                                                <li><b>Bedrooms:</b> 4</li>
                                                <li><b>Bathrooms:</b> 2</li>
                                            </ul>
                                        </div>
                                        <div class="col-md-6 col-lg-6">
                                            <ul class="property__detail-info-list list-unstyled">
                                                <li><b>Garage:</b> 1</li>
                                                <li><b>Garage Size:</b> 458 SqFt</li>
                                                <li><b>Year Built:</b> 2019-01-09</li>
                                                <li><b>Property Type:</b> Full Family Home</li>
                                                <li><b>Property Status:</b> For rent</li>
                                            </ul>
                                        </div>
                                    </div> -->

                                </div>
                                <!-- END INFO PROPERTY DETAIL -->
                            </div>
                            <!-- END PROPERTY DETAILS SPEC -->
                            <div class="clearfix"></div>

                            <!-- FEATURES -->
                            <div v-if="property.category_id == 1 || property.category_id == 2 || property.category_id == 3 
                            || property.category_id == 4 || property.category_id == 7" class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">features</h6>
                                <ul class="list-unstyled icon-checkbox">
                                    <li v-if="property.electricity == 1">24 hour electricity</li>
                                    <li v-if="property.air_conditioning == 1">air conditioning</li>
                                    <li v-if="property.alarm == 1">alarm</li>
                                    <li v-if="property.balcony == 1">balcony</li>
                                    <li v-if="property.chandelier == 1">chandelier</li>
                                    <li v-if="property.car_parking == 1">car parking</li>
                                    <li v-if="property.dining_area == 1">dining area</li>
                                    <li v-if="property.dishwasher == 1">dishwasher</li>
                                    <li v-if="property.gym == 1">Gym</li>
                                    <li v-if="property.hot_water == 1">hot water</li>
                                    <li v-if="property.kitchen_cabinets == 1">kitchen cabinets</li>
                                    <li v-if="property.kitchen_shelf == 1">kitchen shelf</li>
                                    <li v-if="property.microwave == 1">microwave</li>
                                    <li v-if="property.pets_allow == 1">pets allow</li>
                                    <li v-if="property.pop_ceiling == 1">pop ceiling</li>
                                    <li v-if="property.prepaid_meter == 1">pre-paid meter</li>
                                    <li v-if="property.refrigerator == 1">refrigerator</li>
                                    <li v-if="property.swimming_pool == 1">swimming pool</li>
                                    <li v-if="property.tv == 1">tv</li>
                                    <li v-if="property.wardrobe == 1">wardrobe</li>
                                    <li v-if="property.wifi == 1">wifi</li>

                                </ul>
                            </div>
                            <!-- END FEATURES -->

                            <!-- FLOR PLAN -->
                            <!-- <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">floor plan</h6>
                                <div id="accordion" class="floorplan" role="tablist">
                                    <div class="card">
                                        <div class="card-header" role="tab" id="headingOne">
                                            <a class="text-capitalize" data-toggle="collapse" href="#collapseOne"
                                                aria-expanded="true" aria-controls="collapseOne">
                                                first floor <span class="badge badge-light rounded p-1 ml-2">460 sq
                                                    ft</span>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" role="tabpanel"
                                            aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <figure>
                                                    <img src="images/floorplan.jpg" alt="" class="img-fluid">
                                                </figure>

                                                Excepteur sint ocaec at cupdatat proident suntin culpa qui officia
                                                deserunt mol anim id esa laborum
                                                perspiciat.
                                                Duis aute irure dolor reprehenderit in voluptate velit essle cillum
                                                dolore eu fugiat nulla pariatur.

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" role="tab" id="headingTwo">

                                            <a class="collapsed text-capitalize" data-toggle="collapse"
                                                href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                second floor <span class="badge badge-light rounded p-1 ml-2">460 sq
                                                    ft</span>
                                            </a>
                                        </div>
                                        <div id="collapseTwo" class="collapse" role="tabpanel"
                                            aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body">
                                                <figure>
                                                    <img src="images/floorplan2.jpg" alt="" class="img-fluid">
                                                </figure>
                                                They offers a host of logistic management services and supply chain . We
                                                provide innovative solutions
                                                with the best. tempor incididunt ut labore et dolor empor tempor
                                                incididunt innovative solutions

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" role="tab" id="headingThree">
                                            <a class="collapsed text-capitalize" data-toggle="collapse"
                                                href="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                garage <span class="badge badge-light rounded p-1 ml-2">460 sq ft</span>
                                            </a>
                                        </div>
                                        <div id="collapseThree" class="collapse" role="tabpanel"
                                            aria-labelledby="headingThree" data-parent="#accordion">
                                            <div class="card-body">
                                                <figure>
                                                    <img src="images/floorplan3.jpg" alt="" class="img-fluid">
                                                </figure>
                                                They offers a host of logistic management services and supply chain . We
                                                provide innovative solutions
                                                with the best. tempor incididunt ut labore et dolor empor tempor
                                                incididunt innovative solutions

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div> -->
                            <!-- END FLOR PLAN -->
                            <!-- <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">property video</h6>
                                <div class="single__detail-features-video">
                                    <figure class=" mb-0">
                                        <div class="home__video-area text-center">
                                            <img src="images/bg13.jpg" alt="" class="img-fluid">
                                            <a href="https://youtu.be/dQtLx6dsbcI" class="play-video-1 ">
                                                <i class="icon fa fa-play text-white"></i>
                                            </a>
                                        </div>

                                    </figure>
                                </div>
                            </div> -->


                            <!-- LOCATION -->
                            <!-- <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">location</h6>
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="pills-map-location-tab" data-toggle="pill"
                                            href="#pills-map-location" role="tab" aria-controls="pills-map-location"
                                            aria-selected="true">
                                            <i class="fa fa-map-marker"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="pills-street-view-tab" data-toggle="pill"
                                            href="#pills-street-view" role="tab" aria-controls="pills-street-view"
                                            aria-selected="false">
                                            <i class="fa fa-street-view "></i></a>
                                    </li>


                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-map-location" role="tabpanel"
                                        aria-labelledby="pills-map-location-tab">
                                        <div id="map-canvas">
                                            <iframe class="h600 w100"
                                                src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d50446.89789906054!2d-122.41577600000001!3d37.791654!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xd473843de08ff793!2sBetter%20Property%20Management!5e0!3m2!1sen!2sus!4v1591226304089!5m2!1sen!2sus"
                                                style="border:0;" allowfullscreen="" aria-hidden="false"
                                                tabindex="0"></iframe>
                                        </div>

                                    </div>
                                    <div class="tab-pane fade" id="pills-street-view" role="tabpanel"
                                        aria-labelledby="pills-street-view-tab">
                                        <iframe class="h600 w100"
                                            src="https://www.google.com/maps/embed?pb=!4v1553797194458!6m8!1m7!1sR4K_5Z2wRHTk9el8KLTh9Q!2m2!1d36.82551718071267!2d-76.34864590837246!3f305.15097!4f0!5f0.7820865974627469"
                                            style="border:0;" allowfullscreen></iframe>
                                    </div>


                                </div>
                            </div> -->
                            <!-- END LOCATION -->

                            <!-- PROPERTY VIEWS -->
                            <!-- <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">property views</h6>
                                <div class="wrapper">
                                    <canvas id="myChart" class="chart"></canvas>
                                </div>
                            </div> -->
                            <!-- END PROPERTY VIEWS -->

                            <!-- NEARBY -->
                            <!-- <div class="single__detail-features">
                                <h6 class="text-capitalize detail-heading">what's nearby</h6>
                                <div class="single__detail-features-nearby">
                                    <h6 class="text-capitalize"><span>
                                            <i class="fa fa-building "></i></span>education</h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span>Eladia's Kids</span>
                                            <p>2.5 km</p>
                                        </li>
                                        <li>
                                            <span>Brooklyn Brainery</span>
                                            <p>3.5 km</p>

                                        </li>
                                        <li>
                                            <span>Wikdom Senior High Scool</span>
                                            <p>2.5 km</p>
                                        </li>

                                    </ul>

                                    <h6 class="text-capitalize"><span><i class="fa fa-ambulance"></i></span>health &
                                        medical
                                    </h6>
                                    <ul class="list-unstyled">
                                        <li>
                                            <span>Eladia's Kids</span>
                                            <p>2.5 km</p>
                                        </li>
                                        <li>
                                            <span>Brooklyn Brainery</span>
                                            <p>3.5 km</p>

                                        </li>
                                        <li>
                                            <span>Wikdom Senior High Scool</span>
                                            <p>2.5 km</p>
                                        </li>
                                    </ul>
                                </div>
                            </div> -->
                            <!-- END NEARBY -->

                            <!-- RATE US  WRITE -->
                            <!-- <div class="single__detail-features">
                                <h5 class="text-capitalize detail-heading">Write a Review</h5>
                                <div class="single__detail-features-review">

                                    <div class="media mt-4">
                                        <img class="mr-3 img-fluid rounded-circle" src="images/profile-blog.jpg" alt="">
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
                                        <img class="mr-3 img-fluid rounded-circle" src="images/profile-blog.jpg" alt="">
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

                                    <button type="submit" class="btn btn-success rounded-pill float-right "> Submit review <i
                                            class="fa fa-paper-plane ml-2"></i></button>
                                </div>
                            </div> -->
                            <!-- END RATE US  WRITE -->
                        </div>
                    </div>
                    <!-- END DESCRIPTION -->
                </div>
            </div>

            <!-- SIMILIAR PROPERTY -->
            <!-- <div class="row">
                <div class="col-lg-12">
                    <div class="similiar__item">
                        <h6 class="text-capitalize detail-heading">
                            similiar properties
                        </h6>
                        <div class="similiar__property-carousel owl-carousel owl-theme">
                            <div class="item">
                                <div class="card__image">
                                    <div class="card__image-header h-250">
                                        <div class="ribbon text-capitalize">featured</div>
                                        <img src="images/gallery16.jpg" alt="" class="img-fluid w100 img-transition">
                                        <div class="info"> for sale</div>
                                    </div>
                                    <div class="card__image-body">
                                        <span class="badge badge-primary text-capitalize mb-2">house</span>
                                        <h6 class="text-capitalize">
                                            <a href="#">vila in coral gables</a>
                                        </h6>

                                        <p class="text-capitalize">
                                            <i class="fa fa-map-marker"></i>
                                            west flaminggo road, las vegas
                                        </p>
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
                                    <div class="card__image-footer">
                                        <figure>
                                            <img src="images/profile-blog.jpg" alt="" class="img-fluid rounded-circle">
                                        </figure>
                                        <ul class="list-inline my-auto">
                                            <li class="list-inline-item">
                                                <a href="#">
                                                    tom wilson <br>
                                                </a>

                                            </li>

                                        </ul>
                                        <ul class="list-inline my-auto ml-auto">
                                            <li class="list-inline-item">

                                                <h6 class="text-primary">$350.000</h6>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div> -->
            <!-- END SIMILIAR PROPERTY -->
            <!-- href="https://wa.me/6281228430523?text=Hi%20Qiscus" -->
            <!-- <a href=" https://wa.me/254790659917?text=I'm%20interested%20in%20a%20property%20on%20website" data-action="share/whatsapp/share"  class="floating" >
            <i class="fab fa-whatsapp fab-icon"></i>
            </a> -->
        </div>
    </section>
    <!-- END SINGLE DETAIL -->
    </Branch>
</template>

<script>
import Branch from "../components/Branch.vue";
import axios from 'axios';
import numeral from 'numeral';

export default {
    data() {
        return {
            property: [],
            categories: [],
            image1: [],
            image2: [],
            image3: [],
            image4: [],
            image5: [],
            currentImage: []
        }
    },
    components: {
        Branch,
    },
    methods: {
        getPhoto()
        {
            return "/storage/properties/";
        },
        getData() {
            axios.get('/api/property/'+this.$route.params.id, {
            }).then((response) => {
                this.property = response.data.property[0]
                console.log("data", this.property)
                this.image1 = this.property.images[0].name;
                this.image2 = this.property.images[1].name;
                this.image3 = this.property.images[2].name;
                this.image4 = this.property.images[3].name;
                this.image5 = this.property.images[4].name;
                this.currentImage = this.property.images[0].name;
                console.log(this.image5)

            })
        },
        changeImage(id) {
            // Change the main image source
            this.prop = this.property.images.filter(item => item.id === id);
            this.currentImage = this.prop[0].name;

            // Remove the 'active-thumbnail' class from all thumbnails
            // const thumbnails = document.querySelectorAll('.thumbnail');
            // thumbnails.forEach(thumbnail => {
            //     thumbnail.classList.remove('active-thumbnail');
            // });

            // // Add the 'active-thumbnail' class to the clicked thumbnail
            // const clickedThumbnail = document.querySelector(`[src="${imageSrc}"]`);
            // clickedThumbnail.classList.add('active-thumbnail');
        },
        loadLists(){
            axios.get('/api/lists').then((response) => {
                this.categories = response.data.lists.categories
            })
        },
        formatNumber(value) {
          return numeral(value).format('0,0');
        },
        navigate(id){
            this.$router.push('/categoryproperties/'+id)
        }
    },
    mounted() {
        this.getData();
        this.loadLists();
    }


};

</script>

<style>
/* CSS for image slider */
.slider-container {
    position: relative;
}

.slider {
    max-width: 100%;
    height: auto;
    display: flex;
    transition: transform 0.5s ease;
}

.thumbnail-container {
    display: flex;
    justify-content: center;
    margin-top: 10px;
}

.thumbnail {
    width: 100px;
    height: 60px;
    margin: 0 5px;
    cursor: pointer;
}

/* Style for active thumbnail */
.active-thumbnail {
    border: 2px solid blue;
}
</style>