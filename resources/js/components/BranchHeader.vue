<template>
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
                                    <router-link to="/properties" custom v-slot="{ href, navigate, isActive }">
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
                            <router-link to="/blogs" custom v-slot="{ href, navigate, isActive }">
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
                            <router-link to="/about" custom v-slot="{ href, navigate, isActive }">
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
                            <router-link to="/contact" custom v-slot="{ href, navigate, isActive }">
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
                            <li class="breadcrumb-item"> <a href="#">Property</a></li>
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
</template>

<script>
export default {
  name: "BranchHeader",
  data(){
    return {
        user: []
    }
  },
  mounted()
    {
        this.user = JSON.parse(localStorage.getItem('user'));

    },
    computed: {
        isEmpty: function(){
            return jQuery.isEmptyObject(this.user);
        }
    }

};
</script>