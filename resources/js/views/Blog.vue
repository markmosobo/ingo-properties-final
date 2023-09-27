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
                                <li class="breadcrumb-item">
                                    <router-link to="/ourblogs">
                                        <a href="#">Our Blogs</a>
                                    </router-link> 
                                </li>
                                <li class="breadcrumb-item active"> <span class="text-capitalize"> {{blog.title}}</span>
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

        <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="single__blog-detail">
                        <h1>
                            {{blog.title}}
                        </h1>

                        <div class="single__blog-detail-info">
                            <ul class="list-inline">
                                <!-- <li class="list-inline-item">
                                    <figure class="image-profile">
                                        <img src="images/profile-blog.jpg" class="img-fluid" alt="">
                                    </figure>
                                </li> -->
                                <li class="list-inline-item">

                                    <span>
                                        by
                                    </span>
                                    <a href="#">
                                        {{blog.author.first_name}} {{blog.author.last_name}},
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        {{format_date(blog.created_at)}}
                                    </span>
                                </li>

                                <li class="list-inline-item">
                                    <span class="text-dark text-capitalize ml-1">
                                        in
                                    </span>
                                    <a href="#">
                                        {{blog.category.name}}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <figure>
                            <img :src="getPhoto() + blog.image_path" class="img-fluid" alt="">
                        </figure>

                        <p class="drop-cap">
                            {{blog.content}}
                        </p>


                        <!-- AUTHOR -->
                        <!-- Profile author -->
                        <div class="wrap__profile">
                            <div class="wrap__profile-author">
                                <!-- <figure>
                                    <img src="images/profile-blog.jpg" alt="" class="img-fluid img-circle">
                                </figure> -->
                                <div class="wrap__profile-author-detail">
                                    <div class="wrap__profile-author-detail-name">author</div>
                                    <h5>{{blog.author.first_name}} {{blog.author.last_name}}</h5>
                                    <!-- <p>Hi, nice to meet you let me introduce for you, I am Jhon Doe freelancer designer
                                        &amp; web programmer from
                                        base lampung</p> -->
                                    <ul class="list-inline">
                                        <button class="btn btn-social btn-social-o facebook mr-1">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="btn btn-social btn-social-o twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button class="btn btn-social btn-social-o linkedin mr-1">
                                <i class="fab fa-linkedin"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-instagram"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-tiktok"></i>
                            </button>
                            <button class="btn btn-social btn-social-o youtube mr-1">
                                <i class="fab fa-youtube"></i>
                            </button>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- END AUTHOR -->


                        <!-- <div class="row">
                            <div v-show="blog.id >=2" class="col-md-6">
                                <div class="single_navigation-prev">
                                    <a href="#">
                                        <span>previous post</span>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Rem, similique.
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="single_navigation-next text-left text-md-right">
                                    <a href="#">
                                        <span>next post</span>
                                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Perferendis, nesciunt.
                                    </a>
                                </div>
                            </div>
                        </div> -->
                        <div class="clearfix"></div>

                    </div>
                </div>
                <!-- WIDGET BLOG -->
                <div class="col-lg-4">
                    <div class="sticky-top">

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
                                                <!-- <span class="badge badge-primary">14</span> -->
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </aside>
                        <aside>
                            <div class="widget__sidebar">
                                <div class="widget__sidebar__header">
                                    <h6 class="text-capitalize">recents blogs</h6>
                                </div>
                                <div class="widget__sidebar__body">
                                    <!-- ONE -->
                                    <div v-for="blog in recentblogs" :key="blog.id" class="widget__sidebar__body-img">
                                        <img :src="getPhoto() + blog.image_path" alt="" class="img-fluid">
                                        <!-- <span class="badge badge-secondary p-1 text-capitalize mb-1">May 08, 2019
                                        </span> -->
                                        <div class="widget__sidebar__body-heading">
                                            <h6 class="text-capitalize" href="#"  @click="viewBlog(blog.id)" >
                                                {{blog.title}}
                                            </h6>

                                        </div>
                                        <span class="badge badge-secondary p-1 text-capitalize mb-1">{{format_date(blog.created_at)}}
                                        </span>
                                    </div>

                                </div>
                            </div>
                        </aside>

                    </div>
                </div>
            </div>
            <!-- END WIDGET BLOG -->
        </div>
        </section>
    </Branch>
</template>
<script>
import axios from "axios";
import Branch from "../components/Branch.vue";
import moment from 'moment';
export default{
    data(){
        return {
            blog: [],
            blogcategories: [],
            recentblogs: []
        }
    },
    components: {
        Branch
    },
    methods:{
        getPhoto()
        {
            return "/storage/blogs/";
        },
        viewBlog(id){
            this.$router.push('/blogs/'+id)
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        getData(){
            axios.get('/api/blog/'+this.$route.params.id).then((response) => {
                this.blog = response.data.blog
                console.log(response)
            })
        },
        loadLists(){
            axios.get('/api/lists').then((response) => {
                this.blogcategories = response.data.lists.blogcategories;
                this.recentblogs = response.data.lists.recentblogs;
            })
        }
    },
    mounted(){
        this.getData();
        this.loadLists();
    }
}
</script>