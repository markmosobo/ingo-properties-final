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
                                <li class="breadcrumb-item"> <a href="#">Our Blogs</a></li>
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

        <!-- BLOG -->
        <section>
            <div class="container">
                <div class="row">
                    <!-- BLOG START -->
                    <div class="col-lg-8">
                        <!-- Start Custom Preloader -->
                        <div v-if="isLoading" class="text-center mt-3">
                            <div class="spinner-border text-primary" role="status">
                            </div>
                        </div>
                        <!-- End Custom Preloader -->

                        <div v-else class="row">
                            <div v-for="blog in blogs" :key="blog.id" class="col-md-6 col-lg-6">
                                <div class="blog__grid mt-0">
                                    <!-- BLOG  -->
                                    <div class="card__image">
                                        <div class="card__image-header h-250">
                                            <!-- <img src="images/blog3.jpg" alt="" class="img-fluid w100 img-transition"> -->
                                            <img :src="getPhoto() + blog.image_path" alt="" class="img-fluid w100 img-transition">

                                            <div class="info"> {{blog.category['name']}}</div>
                                        </div>
                                        <div class="card__image-body">
                                            <!-- <span class="badge badge-secondary p-1 text-capitalize mb-3">May 08, 2019
                                            </span> -->
                                            <h6 class="text-capitalize">
                                                <a href="#"  @click="viewBlog(blog.id)" >{{blog.title}} </a>
                                            </h6>
                                            <p class=" mb-0">
                                                {{blog.content.substring(0,100)+".."}}

                                            </p>


                                        </div>
                                        <div class="card__image-footer">
                                            <!-- <figure>
                                                <img src="images/profile-blog.jpg" alt="" class="img-fluid rounded-circle">
                                            </figure> -->
                                            <ul class="list-inline my-auto">
                                                <li class="list-inline-item">

                                                    <a href="#">
                                                        {{format_date(blog.created_at)}}
                                                    </a>

                                                </li>

                                            </ul>
                                            <ul class="list-inline my-auto ml-auto">
                                                <li class="list-inline-item">
                                                    <a href="#" @click="viewBlog(blog.id)" class="btn btn-sm rounded-pill btn-success "><small
                                                            class="text-white ">read more <i
                                                                class="fa fa-angle-right ml-1"></i></small></a>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                    <!-- END BLOG -->
                                </div>
                            </div>
                    
                        </div>

                    </div>
                    <!-- END BLOG  -->

                    <!-- WIDGET BLOG -->
                    <div class="col-lg-4">
                        <div class="sticky-top">
                            <!-- <aside>
                                <div class="widget__sidebar mt-0">
                                    <div class="widget__sidebar__header">
                                        <h6 class="text-capitalize">search</h6>
                                    </div>
                                    <div class="widget__sidebar__body">
                                        <div class="input-group">
                                            <input type="text" name="search_term_string" class="form-control"
                                                placeholder="Search article . . .">
                                            <span class="input-group-btn">
                                                <button type="submit" class="btn-search btn"><i
                                                        class="fa fa-search"></i></button>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </aside> -->
                            <aside>
                                <div class="widget__sidebar">
                                    <div class="widget__sidebar__header">
                                        <h6 class="text-capitalize">category</h6>
                                    </div>
                                    <div class="widget__sidebar__body">
                                        <ul class="list-unstyled">
                                            <li v-for="category in blogcategories" :key="category.id">
                                                <a href="#" class="text-capitalize">
                                                    {{category.name}}
                                                    <!-- <span class="badge badge-success">14</span> -->
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                </div>
                            </aside>
                            <!-- <aside>
                                <div class="widget__sidebar">
                                    <div class="widget__sidebar__header">
                                        <h6 class="text-capitalize">recents news</h6>
                                    </div>
                                    <div class="widget__sidebar__body">
                                        <div class="widget__sidebar__body-img">
                                            <img src="images/gallery.jpg" alt="" class="img-fluid">

                                            <div class="widget__sidebar__body-heading">
                                                <h6 class="text-capitalize">
                                                    tips memilih rumah bagi kelurga muda
                                                </h6>

                                            </div>
                                            <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                            </span>
                                        </div>
                                        <div class="widget__sidebar__body-img">
                                            <img src="images/gallery1.jpg" alt="" class="img-fluid">

                                            <div class="widget__sidebar__body-heading">
                                                <h6 class="text-capitalize">
                                                    tips memilih rumah bagi kelurga muda
                                                </h6>

                                            </div>
                                            <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                            </span>
                                        </div>
                                        <div class="widget__sidebar__body-img">
                                            <img src="images/gallery2.jpg" alt="" class="img-fluid">
                                            <div class="widget__sidebar__body-heading">
                                                <h6 class="text-capitalize">
                                                    twe are experience more than 10 years
                                                </h6>

                                            </div>
                                            <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                            </span>
                                        </div>
                                        <div class="widget__sidebar__body-img">
                                            <img src="images/gallery3.jpg" alt="" class="img-fluid">

                                            <div class="widget__sidebar__body-heading">
                                                <h6 class="text-capitalize">
                                                    tips & trick in real estate
                                                </h6>

                                            </div>
                                            <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                            </span>
                                        </div>

                                        <div class="widget__sidebar__body-img">
                                            <img src="images/gallery4.jpg" alt="" class="img-fluid">

                                            <div class="widget__sidebar__body-heading">
                                                <h6 class="text-capitalize">
                                                    how buy real estate dream house
                                                </h6>
                                            </div>
                                            <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </aside>
                            <aside>
                                <div class="widget__sidebar">
                                    <div class="widget__sidebar__header">
                                        <h6 class="text-capitalize">tags</h6>
                                    </div>
                                    <div class="widget__sidebar__body">
                                        <div class="blog__tags p-0">
                                            <ul class="list-inline">

                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #property
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #wfh
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #estate
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #real estate
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #listing
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #rent
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #sell
                                                    </a>
                                                </li>

                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #family
                                                    </a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #happy
                                                    </a>
                                                </li>

                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #agents
                                                    </a>
                                                </li>

                                                <li class="list-inline-item">
                                                    <a href="#">
                                                        #promo
                                                    </a>
                                                </li>


                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </aside> -->
                        </div>
                    </div>
                    <!-- END WIDGET BLOG -->
                </div>
            </div>
        </section>
        <!-- END LISTING LIST -->
    </Branch>
</template>

<script>
import axios from "axios";
import Branch from "../components/Branch.vue";
import moment from 'moment';

export default{
    data(){
        return {
            blogs: [],
            isLoading: true, // Add loading state
        }
    },
    components: {
        Branch
    },
    methods: {
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        getPhoto()
        {
            return "/storage/blogs/";
        },
        viewBlog(id){
            this.$router.push('/ourblogs/'+id)
        },
        getData(){
            axios.get('api/lists').then((response) => {
                this.isLoading = true; // Set isLoading to true before making the API call

                this.blogs = response.data.lists.ourblogs
                this.blogcategories = response.data.lists.blogcategories
                // Set isLoading to false once data is loaded
                this.isLoading = false;

                console.log(response)
            })
        }
    },
    mounted(){
        this.getData();
    }
}
</script>