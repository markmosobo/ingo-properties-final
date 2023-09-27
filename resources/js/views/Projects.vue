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
                                <li class="breadcrumb-item"> <a href="#">Our Projects</a></li>
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

    <!-- LISTING LIST -->
    <section>
        <div class="profile__agency">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <!-- ARCHIVE CATEGORY -->
                        <div class=" wrapper__list__category ">
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
                        <!-- End ARCHIVE CATEGORY -->


                    </div>
                    <div class="col-lg-8">
                        <div class="row no-gutters">
                            <div v-for="project in projects" :key="project.id" class="col-lg-12 mt-0">
                                <div class="row">
                                    <div class="col-md-6 col-lg-6">
                                        <a href="#" class="profile__agency-logo">
                                            <img :src="getPhoto() + project.image_path" alt="" class="img-fluid">
                                            <div v-if="project.status == 0" class="total__property-agent">ongoing</div>
                                            <div v-else class="total__property-agent">complete</div>
                                        </a>
                                    </div>
                                    <div class="col-md-6 col-lg-6 my-auto">
                                        <div class="profile__agency-info">
                                            <h5 class="text-capitalize">
                                                <a href="#" @click="viewProject(project.id)">{{project.name}}</a>
                                            </h5>
                                            <p class="text-capitalize mb-1">{{project.location}}
                                            </p>

                                            <!-- <ul class="list-unstyled mt-2">
                                                <li><a href="#" class="text-capitalize"><span><i
                                                                class="fa fa-building"></i> office :</span> 123 456
                                                        789</a>
                                                </li>
                                                <li><a href="#" class="text-capitalize"><span><i
                                                                class="fa fa-phone"></i> mobile :</span> 123 456
                                                        789</a></li>
                                                <li><a href="#" class="text-capitalize"><span><i class="fa fa-fax"></i>
                                                            fax : </span> 342 655</a></li>
                                                <li><a href="#" class="text-capitalize"><span><i
                                                                class="fa fa-envelope"></i> email :</span>
                                                        agents@property.com</a></li>
                                            </ul>
                                            <p class="mb-0 mt-3">
                                                <button class="btn btn-social btn-social-o facebook mr-1">
                                                    <i class="fa fa-facebook-f"></i>
                                                </button>
                                                <button class="btn btn-social btn-social-o twitter mr-1">
                                                    <i class="fa fa-twitter"></i>
                                                </button>

                                                <button class="btn btn-social btn-social-o linkedin mr-1">
                                                    <i class="fa fa-linkedin"></i>
                                                </button>
                                                <button class="btn btn-social btn-social-o instagram mr-1">
                                                    <i class="fa fa-instagram"></i>
                                                </button>

                                                <button class="btn btn-social btn-social-o youtube mr-1">
                                                    <i class="fa fa-youtube"></i>
                                                </button>
                                            </p> -->

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- END LISTING LIST -->

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
        projects: [],
        categories: []
    }
  },
  methods: {
    getPhoto()
    {
        return "/storage/projects/";
    },
    viewProject(id){
        this.$router.push('/ourprojects/'+id)
    },
    navigate(id){
        this.$router.push('/categoryproperties/'+id)
    },
    loadLists(){
        axios.get('api/lists').then((response) => {
            this.projects = response.data.lists.projects
            console.log(this.projects)
        }).catch((error) => {
            console.log(error)
        })
    },
    getProps(){
        axios.get('/api/lists').then((response) => {
            this.categories = response.data.lists.categories
        })
    }
  },
  mounted(){
    this.loadLists();
    this.getProps();
  }


};

</script>

