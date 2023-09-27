<template>
    <!-- HEADER -->
    <header class="jumbotron bg-theme-v5">
    <div class="bg-overlay"></div>

   <!-- NAVBAR -->
    <nav class="navbar navbar-hover navbar-expand-lg navbar-soft navbar-transparent">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <!-- <img src="logo.png" alt="">
                    <img src="images/logo-blue-stiky.png" alt=""> -->
                    <img src="images/Untitled design (1)-PhotoRoom.png-PhotoRoom.png" alt="">
                    <img src="images/Untitled design (1).png" alt="">
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
                            <a class="nav-link active dropdown-toggle" href="#" data-toggle="dropdown"> Properties </a>
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
                        <li>
                            <a href="#" class="btn btn-primary text-capitalize">
                                <i class="fa fa-plus-circle mr-1"></i> add listing</a>
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
                                                href="search-result.html">
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

    <!-- HERO -->
    <div class="wrap__intro d-flex align-items-md-center  ">
        <div class="container  ">
            <div class="row align-items-center justify-content-start flex-wrap">
                <div class="col-lg-12 mx-auto">
                    <div class="wrap__intro-heading" data-aos="fade-up">

                        <h1 class="text-capitalize">
                            Because you are worth </h1>
                        <p>Your Property, Our Priority </p>

                        <div class="bg__overlay-black p-4">
                            <div class="search__property">
                                <div class="position-relative">
                                    <ul class="nav nav-tabs nav-tabs-02 mb-3 justify-content-start" id="pills-tab"
                                        role="tablist">
                                        <li class="nav-item mr-1">
                                            <a class="nav-link active" id="buy-tab" data-toggle="pill" href="#buy"
                                                role="tab" aria-controls="buy" aria-selected="true">Buy </a>
                                        </li>
                                        <li class="nav-item mr-1">
                                            <a class="nav-link" id="rent-tab" data-toggle="pill" href="#rent"
                                                role="tab" aria-controls="rent" aria-selected="false">Rent</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade active show" id="buy" role="tabpanel"
                                            aria-labelledby="buy-tab">
                                            <div class=" search__container">
                                                <form @submit.prevent="searchProperty()">
                                                <div class="row input-group no-gutters">
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select" >
                                                            <option selected>Type Property</option>
                                                            <option 
                                                                v-for="item in propertytypes" :key="item.id"
                                                                :value="item.id"
                                                                :selected="item.id == form.propertytype_id">{{ item.name }} 
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Area From">Area From </option>
                                                            <option>1500</option>
                                                            <option>1200</option>
                                                            <option>900</option>
                                                            <option>600</option>
                                                            <option>300</option>
                                                            <option>100</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
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
                                                            <option>10+</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Bathrooms">Bathrooms</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10+</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Locations">Locations</option>
                                                            <option 
                                                                v-for="item in locations" :key="item.id"
                                                                :value="item.id"
                                                                :selected="item.id == form.location_id">{{ item.name }} 
                                                            </option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 input-group-append">
                                                        <button class="btn btn-primary btn-block" type="submit">
                                                            <i class="fa fa-search"></i> <span
                                                                class="ml-1 text-uppercase">search</span>
                                                        </button>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="rent" role="tabpanel"
                                            aria-labelledby="rent-tab">
                                            <div class=" search__container">
                                                <div class="row input-group no-gutters">
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option selected>Type Property</option>
                                                                <option 
                                                                    v-for="item in propertytypes" :key="item.id"
                                                                    :value="item.id"
                                                                    :selected="item.id == form.propertytype_id">{{ item.name }} 
                                                                </option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Area From">Area From </option>
                                                            <option>1500</option>
                                                            <option>1200</option>
                                                            <option>900</option>
                                                            <option>600</option>
                                                            <option>300</option>
                                                            <option>100</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
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
                                                            <option>10+</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Bathrooms">Bathrooms</option>
                                                            <option>1</option>
                                                            <option>2</option>
                                                            <option>3</option>
                                                            <option>4</option>
                                                            <option>5</option>
                                                            <option>6</option>
                                                            <option>7</option>
                                                            <option>8</option>
                                                            <option>9</option>
                                                            <option>10+</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2">
                                                        <select class="select_option form-control" name="select">
                                                            <option data-display="Locations">Locations</option>
                                                            <option>United Kingdom</option>
                                                            <option>American Samoa</option>
                                                            <option>Belgium</option>
                                                            <option>Canada</option>
                                                            <option>Delaware</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-lg-2 input-group-append">
                                                        <button class="btn btn-primary btn-block" type="submit">
                                                            <i class="fa fa-search"></i> <span
                                                                class="ml-1 text-uppercase">search</span>
                                                        </button>
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
    </div>
    <!-- END HERO -->
    </header>
    <!-- END HEADER -->
    
</template>

<script>
import axios from 'axios';
export default {
  name: "MainHeader",
  data(){
    return {
        propertytypes: [],
        locations: [],
        form: {
            propertytype_id: '',
            bathrooms: '',
            bathrooms: '',
            area: '',
            location_id: ''
        }
    }
  },
  methods: {
    getPhoto()
        {
            return "images/";
        },
    searchProperty(){
        axios.post('api/search', this.form).then((response) => {
            console.log(response)
        }).catch((error) => {
            console.log(error)
        })
        console.log(this.form)
    },
    loadLists() {
             axios.get('api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.locations = response.data.lists.locations;
             this.propertytypes = response.data.lists.propertytypes;
             console.log("propertytypes", response)
             this.featuredproperties = response.data.lists.properties;
    
             });
        }
  },
  mounted(){
    this.loadLists();
  }

};
</script>