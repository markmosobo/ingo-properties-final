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
                                <li class="breadcrumb-item"> <a href="#">About Us</a></li>
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

        <!-- ABOUT -->
        <section class="home__about bg-light">
            <div class="container">
                <div v-for="about in abouts" :key="about.id" class="row">
                    <div class="col-lg-6">
                        <div class="title__leading">
                            <h6 class="text-uppercase text-success mb-3">because You are worth it</h6>
                            <h2 class="text-capitalize">{{about.title}} </h2>
                            <p>
                                {{about.description}}

                            </p>

                            <!-- <a href="#" class="btn btn-primary mt-3 text-capitalize"> read more
                                <i class="fa fa-angle-right ml-3 "></i></a> -->
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about__image">
                            <div class="about__image-top">
                                <div class="about__image-top-hover">
                                    <img :src="getPhoto() + about.image" alt="" class="img-fluid">
                                </div>

                            </div>
                            <div class="about__image-bottom">
                                <div class="about__image-bottom-hover">
                                    <img :src="getPhoto() + about.image" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END ABOUT -->

            <!-- LISTING LIST -->
        <section>
            <div class="profile__agency">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-7">
                            <div class="title__head">
                                <h2 class="text-center text-capitalize">our services</h2>
                                <p class="text-center text-capitalize">At Ingo Properties, we ensure to provide listings that are of high standards.
                                    Our properties provide the highest value at the best prices. </p>
                            </div>
                        </div>
                    </div>
                        
                    <!-- <div class="col-lg-12"> -->
                        <div class="row">
                            <div v-for="service in homeservices" :key="service.id" class="col-lg-4">
                                <div class="cards mt-0">
                                
                                    <div class="profile__agency-body">
                                        <div class="profile__agency-info">
                                            <h5 class="text-capitalize">
                                                <a href="#" target="_blank">{{service.title}}</a>
                                            </h5>
                                            <p class="text-capitalize mb-1">{{service.description.substring(0,100)+"..."}}
                                            </p>
                                            
                                            <p @click="viewService(service.id)" class="mb-0 mt-3">
                                                <button class="btn btn-success btn-sm rounded-pill mr-1">
                                                    Read More
                                                    <i class="fa fa-angle-right ml-3 "></i>                                                </button>
                                       
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                      
                        </div>
                    
                    <!-- </div> -->

                </div>
            </div>
        </section>

        <!-- <section class="projects__partner ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-7">
                        <div class="title__head">
                            <h2 class="text-center text-capitalize">our other successful projects</h2>
                            <p class="text-center text-capitalize">brand partners successful projects trusted many clients
                                building real estate since 1985 we experiance </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="projects__partner-logo">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item">
                                    <img src="images/partner-logo6.png" alt="" class="img-fluid">
                                </li>
                                <li class="list-inline-item">
                                    <img src="images/partner-logo7.png" alt="" class="img-fluid">
                                </li>
                                <li class="list-inline-item">
                                    <img src="images/partner-logo8.png" alt="" class="img-fluid">
                                </li>
                                <li class="list-inline-item">
                                    <img src="images/partner-logo1.png" alt="" class="img-fluid">
                                </li>
                                <li class="list-inline-item">
                                    <img src="images/partner-logo5.png" alt="" class="img-fluid">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- OUR TEAM -->
        <!-- <section class="bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="title__head">
                            <h2 class="text-center text-capitalize">
                                our Team
                            </h2>
                            <p class="text-center text-capitalize">see our top of the month teams</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="wrap-agent">
                            <div class="team-member">
                                <div class="team-img">
                                    <img alt="team member" class="img-fluid w-100" src="images/team11.jpg">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <h5>
                                            Hi There !
                                        </h5>
                                        <p>
                                            I am Senior Agent Property
                                        </p>
                                        <a class="btn btn-primary" href="#">
                                            Agent Profile
                                        </a>
                                    </div>
                                    <ul class="list-inline s-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-facebook">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-twitter">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-google-plus">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="team-title">
                                    <h6>
                                        Martin Smith
                                    </h6>
                                    <span>
                                        Agent Real Estate
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="wrap-agent">
                            <div class="team-member">
                                <div class="team-img">
                                    <img alt="team member" class="img-fluid w-100" src="images/team12.jpg">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <h5>
                                            Hi There !
                                        </h5>
                                        <p>
                                            I am Senior Agent Property
                                        </p>
                                        <a class="btn btn-primary" href="#">
                                            Agent Profile
                                        </a>
                                    </div>
                                    <ul class="list-inline s-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-facebook">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-twitter">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-google-plus">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="team-title">
                                    <h5>
                                        Martin Smith
                                    </h5>
                                    <span>
                                        Agent Real Estate
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="wrap-agent">
                            <div class="team-member">
                                <div class="team-img">
                                    <img alt="team member" class="img-fluid w-100" src="images/team13.jpg">
                                </div>
                                <div class="team-hover">
                                    <div class="desk">
                                        <h5>
                                            Hi There !
                                        </h5>
                                        <p>
                                            I am Senior Agent Property
                                        </p>
                                        <a class="btn btn-primary" href="#">
                                            Agent Profile
                                        </a>
                                    </div>
                                    <ul class="list-inline s-link mb-0">
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-facebook">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-twitter">
                                                </i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a href="#">
                                                <i class="fa fa-google-plus">
                                                </i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="team-title">
                                    <h5>
                                        Martin Smith
                                    </h5>
                                    <span>
                                        Agent Real Estate
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- END TEAM -->
    </Branch>
</template>

<script>
import Branch from "../components/Branch.vue";
import axios from 'axios';

export default {
  components: {
    Branch,

  },
  data() {
    return {
        abouts: [],
        homeservices: []
    }
  },
  methods: {
    getPhoto()
    {
        return "/storage/about/";
    },
    viewService(id){
        this.$router.push('/ourservices/'+id)
    },
    loadLists(){
        axios.get('api/abouts').then((response) => {
            this.abouts = response.data.lists.abouts
            console.log(this.abouts)
        }).catch((error) => {
            console.log(error)
        })
    },
    getServices(){
        axios.get('api/lists').then((response) => {
            this.homeservices = response.data.lists.homeservices
        })
    }
  },
  mounted(){
    this.loadLists();
    this.getServices();
  }


};

</script>

