<template>
    <Branch>
                <!-- HEADER -->
                <header>
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
                                <li class="breadcrumb-item"> <a href="#">Properties for Rent</a></li>
                                <!-- <li class="breadcrumb-item active"> <span class="text-capitalize"> Luxury family home</span>
                                </li> -->

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

        <!-- <div class="search__area bg__shadow">
            <div class="container">
                <div class="search__area-inner">
                    <div class="row">
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="wide select_option">
                                    <option data-display="Property Status">Property Status</option>
                                    <option>For Sale</option>
                                    <option>For Rent</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="wide select_option">
                                    <option data-display="Property Type">Property Type</option>
                                    <option>Residential</option>
                                    <option>Commercial</option>
                                    <option>Land</option>
                                    <option>Luxury</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
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
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="wide select_option">
                                    <option data-display="Locations">Locations</option>
                                    <option>United Kingdom</option>
                                    <option>American Samoa</option>
                                    <option>Belgium</option>
                                    <option>Canada</option>
                                    <option>Delaware</option>
                                    <option>Indonesia</option>
                                    <option>Malaysia</option>
                                    <option>Japan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
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
                        </div>
                        <div class="col-6 col-lg-3 col-md-3">
                            <div class="form-group">
                                <select class="wide select_option">
                                    <option data-display="Bathrooms">Bathrooms</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>


                                </select>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <div class="filter__price">
                                    <input class="price-range" type="text" name="my_range" value="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="form-group">
                                <button class="btn btn-success rounded-pill text-uppercase btn-block"> search <i
                                        class="fa fa-search ml-1"></i></button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->

        <!-- LISTING LIST -->
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tabs__custom-v2 ">
                                    <!-- FILTER VERTICAL -->
                                    <ul class="nav nav-pills myTab" role="tablist">
                                        <li class="list-inline-item mr-auto">
                                            <span  style="color:brown;" class="title-text">Sort by</span>
                                            <div class="btn-group">
                                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    Based Properties
                                                </a>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="javascript:void(0)">Low to High Price</a>
                                                    <a class="dropdown-item" href="javascript:void(0)">High to Low Price
                                                    </a>
                                                    <a class="dropdown-item" href="javascript:void(0)">Sell Properties</a>

                                                    <a class="dropdown-item" href="javascript:void(0)">Rent Properties</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="nav-item">
                                            <a style="color:brown;" class="nav-link" data-toggle="pill" href="#pills-tab-one" role="tab"
                                                aria-controls="pills-tab-one" aria-selected="true">
                                                <span class="fa fa-th-list"></span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a style="color:brown;" class="nav-link active" data-toggle="pill" href="#pills-tab-two" role="tab"
                                                aria-controls="pills-tab-two" aria-selected="false">
                                                <span class="fas fa-th-large"></span></a>
                                        </li>
                                    </ul>



                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade" id="pills-tab-one" role="tabpanel"
                                            aria-labelledby="pills-tab-one">
                                            <div class="row">
                                                <div v-for="property in rentproperties" :key="property.id" class="col-lg-12">
                                                    <div class="card__image card__box-v1">
                                                        <div class="row no-gutters">
                                                            <div class="col-md-4 col-lg-3 col-xl-4">
                                                                <div class="card__image__header h-250">
                                                                    <a @click="viewProperty(property.id)" href="#">
                                                                        <div v-if="property.property_status == 1" style="background-color:brown;" class="ribbon text-capitalize">featured</div>
                                                                        <img :src="getPhoto() + property.images[0].name" alt=""
                                                                            class="img-fluid w100 img-transition">
                                                                        <div v-if="property.property_status == 'sale'" class="info"> for sale</div>
                                                                        <div v-else="property.property_status == 'rent'" class="info"> for rent</div>

                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 col-lg-6 col-xl-5 my-auto">
                                                                <div class="card__image__body">

                                                                    <span v-if="property.property_type_id !== null"
                                                                        class="badge badge-success text-capitalize mb-2">{{property.type['name']}}</span>
                                                                    <span v-if="property.land_type !== null"
                                                                    class="badge badge-success text-capitalize mb-2">{{property.land_type}}</span>    
                                                                    <h6>
                                                                        <a @click="viewProperty(property.id)" href="#">{{property.title}}</a>
                                                                    </h6>
                                                                    <div class="card__image__body-desc">
                                                                        <!-- <p class="text-capitalize">
                                                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, alias!

                                                                            </p> -->
                                                                        <p class="text-capitalize">
                                                                            <i class="fa fa-map-marker"></i>
                                                                            {{property.location}}
                                                                        </p>
                                                                    </div>

                                                                    <ul v-if="property.land_type == null" class="list-inline card__content">
                                                                        <li class="list-inline-item">

                                                                            <span>
                                                                                baths <br>
                                                                                <i class="fa fa-bath"></i> {{property.bathrooms}}
                                                                            </span>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            <span>
                                                                                beds <br>
                                                                                <i class="fa fa-bed"></i> {{property.bedrooms}}
                                                                            </span>
                                                                        </li>
                                                                        <!-- <li class="list-inline-item">
                                                                            <span>
                                                                                rooms <br>
                                                                                <i class="fa fa-inbox"></i> 10
                                                                            </span>
                                                                        </li> -->
                                                                        <li class="list-inline-item">
                                                                            <span>
                                                                                area <br>
                                                                                <i class="fa fa-map"></i> {{property.size}} sq ft
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                    <ul v-if="property.land_type !== null" class="list-inline card__content">
                                                                        <li class="list-inline-item">
                                                                            <span>
                                                                                land area <br>
                                                                                <i class="fa fa-map"></i> {{property.land_area}} acres
                                                                            </span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div
                                                                class="col-md-4 col-lg-3 col-xl-3 my-auto card__image__footer-first">
                                                                <div class="card__image__footer">
                                                                    <!-- <figure>
                                                                        <img src="images/logo.jpg" alt=""
                                                                            class="img-fluid rounded-circle">
                                                                    </figure> -->
                                                                    <ul class="list-inline my-auto">
                                                                        <li class="list-inline-item name">
                                                                            <a href="#">
                                                                                <span v-if="property.status == 1" class="text-success">Offer : open</span>
                                                                                <span v-else class="text-dark">Offer : closed</span>
                                                                            </a>

                                                                        </li>


                                                                    </ul>
                                                                    <ul class="list-inline my-auto ml-auto price">
                                                                        <li class="list-inline-item ">

                                                                            <h6>KSH{{property.price.toLocaleString()}}</h6>
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
                                        <div class="tab-pane fade show active" id="pills-tab-two" role="tabpanel"
                                            aria-labelledby="pills-tab-two">
                                            <div class="row">
                                                <div v-for="property in rentproperties" :key="property.id" class="col-md-4 col-lg-4">
                                                    <div class="card__image card__box-v1">
                                                        <div class="card__image-header h-250">
                                                            <div v-if="property.featured == 1" style="background-color:brown;" class="ribbon text-capitalize">featured</div>
                                                            <img @click="viewProperty(property.id)" :src="getPhoto() + property.images[0].name" alt=""
                                                                class="img-fluid w100 img-transition">

                                                            <div v-if="property.property_status == 'sale'" class="info"> for sale</div>
                                                            <div v-else="property.property_status == 'rent'" class="info"> for rent</div>
                                                        </div>
                                                        <div class="card__image-body">
                                                            <span v-if="property.property_type_id !== null"
                                                                class="badge badge-success text-capitalize mb-2">{{property.type['name']}}</span>
                                                            <span v-if="property.land_type !== null"
                                                            class="badge badge-success text-capitalize mb-2">{{property.land_type}}</span>  
                                                            <h6 @click="viewProperty(property.id)" class="text-capitalize">
                                                                {{property.title}}
                                                            </h6>

                                                            <p class="text-capitalize">
                                                                <i class="fa fa-map-marker"></i>
                                                                {{property.location}}
                                                            </p>
                                                            <ul v-if="property.property_type_id !== null" class="list-inline card__content">
                                                                <li class="list-inline-item">

                                                                    <span>
                                                                        baths <br>
                                                                        <i class="fa fa-bath"></i> {{property.bathrooms}}
                                                                    </span>
                                                                </li>
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        beds <br>
                                                                        <i class="fa fa-bed"></i> {{property.bedrooms}}
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
                                                                        <i class="fa fa-map"></i> {{property.size}} sq ft
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                            <ul v-if="property.land_type !== null" class="list-inline card__content">
                                                                <li class="list-inline-item">
                                                                    <span>
                                                                        land area <br>
                                                                        <i class="fa fa-map"></i> {{property.land_area}} acres
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="card__image-footer">
                                                            <!-- <figure>
                                                                <img src="images/logo.jpg" alt=""
                                                                    class="img-fluid rounded-circle">
                                                            </figure> -->
                                                            <ul class="list-inline my-auto">
                                                                <li class="list-inline-item ">
                                                                    <a href="#">
                                                                        <span v-if="property.status == 1" class="text-success">Offer : open</span>
                                                                        <span v-else class="text-dark">Offer : closed</span>
                                                                    </a>

                                                                </li>

                                                            </ul>
                                                            <ul class="list-inline my-auto ml-auto">
                                                                <li class="list-inline-item">

                                                                    <h6>KSH{{(property.price).toLocaleString()}}</h6>
                                                                </li>

                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cleafix"></div>
                                        </div>



                                    </div>
                                    <!-- END FILTER VERTICAL -->
                                </div>
                            </div>
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
import axios from "axios";

export default {
    data(){
        return {
            rentproperties: [],

        }
    },
    components: {
      Branch,
    },
    methods: {
        viewProperty(id){
            this.$router.push('/properties/'+id)
        },
        getPhoto()
        {
            return "/storage/properties/";
        },
        loadLists() {
             axios.get('api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.propertytypes = response.data.lists.propertytypes;
             this.rentproperties = response.data.lists.rentproperties;

           })
        }
    },
    mounted(){
        this.loadLists();
    }

};

</script>