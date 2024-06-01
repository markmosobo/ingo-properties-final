<template>
    <!-- <Main> -->

    <!-- HEADER -->
    <header class="jumbotron bg-theme-v5">
    <div class="bg-overlay"></div>

   <!-- NAVBAR -->
    <nav class="navbar navbar-hover navbar-expand-lg navbar-soft navbar-transparent">
            <div class="container">
                <router-link to="/" custom v-slot="{ href, navigate, isActive }">
                <a 
                class="navbar-brand" 
                :href="href"
                :class="{ active: isActive }"
                @click="navigate"

                >
                    <!-- <img src="images/logo-blue.png" alt="">
                    <img src="images/logo-blue-stiky.png" alt=""> -->
                    <img src="/images/ingo-white_logo.png" alt="">
                    <img src="/images/ingo-colored-logo.png" alt="">
                </a>
                </router-link>
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

        <!-- HERO -->
        <div class="wrap__intro d-flex align-items-md-center ">
            <div class="container  ">
                <div class="row align-items-center justify-content-start flex-wrap">
                    <div class="col-md-10 mx-auto">
                        <div class="wrap__intro-heading text-center" data-aos="fade-up">
                            <!-- <h4>the walls property</h4> -->
                            <h1>
                                Helping you find the property of your dreams </h1>
                            <p>Because You Are Worth It</p>

                            <!-- SEARCH BAR -->
                            <div class="wrapper__section">
                                <div class="wrapper__section__components">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form @submit.prevent="searchProperty">
                                            <!-- <h3 class="section_heading mt-4">Form Search with Categories</h3> -->
                                            <div class=" search__container">
                                                <div class="row input-group no-gutters">
                                                    <div class="col-sm-12 col-md-5">
                                                        <input type="text" v-model="form.search" class="form-control" aria-label="Text input"
                                                            placeholder="Search for Homes by Address, Town, City . . . .">
                                                    </div>


                                                    <div class="col-sm-12 col-md-4 input-group">

                                                        <select v-model="form.category_id" class="select_option form-control" name="select"
                                                            id="categories">
                                                            <option selected>All Categories</option>
                                                            <option v-for="category in categories" :key="category.id"
                                                            :value="category.id"
                                                            :selected="category.id == form.category_id">{{category.name}}</option>

                                                        </select>

                                                    </div>
                                                    <div class="col-sm-12 col-md-3 input-group-append">
                                                        <button class="btn btn-success btn-block" type="submit">
                                                            <i class="fa fa-search"></i> <span
                                                                class="ml-1 text-uppercase">Search</span>
                                                        </button>

                                                    </div>
                                                </div>
                                            </div>
                                            </form>
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

    <!-- FEATURED PROPERTIES -->
    <section class="featured__property bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            featured properties
                        </h2>
                        <p class="text-center text-capitalize">handpicked exclusive properties by our team.</p>

                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div v-for="property in homefeaturedproperties" :key="property.id" class="col-md-4 col-lg-4">
                            <div class="card__image card__box-v1">
                                <div class="card__image-header h-250">
                                    <div style="background-color:brown;" class="ribbon text-capitalize">featured</div>
                                    <img @click="viewProperty(property.id)" :src="getPropertyPhoto() + property.images[0].name" alt=""
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
                                        <li v-if="property.category_id == '3' || property.category_id == '4'" class="list-inline-item">

                                            <span>
                                                baths <br>
                                                <i class="fa fa-bath"></i> {{property.bathrooms}}
                                            </span>
                                        </li>
                                        <li v-if="property.category_id == '3' || property.category_id == '4'" class="list-inline-item">
                                            <span>
                                                beds <br>
                                                <i class="fa fa-bed"></i> {{property.bedrooms}}
                                            </span>
                                        </li>
                                        <!-- <li class="list-inline-item">
                                            <span>
                                                rooms <br>
                                                <i class="fa fa-inbox"></i> 3
                                            </span>
                                        </li> -->
                                        <li v-bind:hidden="property.size == null" class="list-inline-item">
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

                                            <h6>KSH{{formatNumberWithCommas(property.price)}}</h6>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- END FEATURED PROPERTIES -->

    <!-- RECENT PROPERTY -->
    <section class="featured__property bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            Recent Properties
                        </h2>
                        <p class="text-center text-capitalize">We provide full service at every step.</p>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div v-for="property in recentproperties" :key="property.id" class="col-md-4 col-lg-4">
                            <div class="card__image card__box-v1">
                                <div class="card__image-header h-250">
                                    <!-- <div v-if="property.featured == 1" style="background-color:brown;" class="ribbon text-capitalize">featured</div> -->
                                    <img @click="viewProperty(property.id)" :src="getPropertyPhoto() + property.images[0].name" alt=""
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
                                        <li v-if="property.category_id == '3' || property.category_id == '4'" class="list-inline-item">

                                            <span>
                                                baths <br>
                                                <i class="fa fa-bath"></i> {{property.bathrooms}}
                                            </span>
                                        </li>
                                        <li v-if="property.category_id == '3' || property.category_id == '4'" class="list-inline-item">
                                            <span>
                                                beds <br>
                                                <i class="fa fa-bed"></i> {{property.bedrooms}}
                                            </span>
                                        </li>
                                        <!-- <li class="list-inline-item">
                                            <span>
                                                rooms <br>
                                                <i class="fa fa-inbox"></i> 3
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

                                            <h6>KSH{{formatNumberWithCommas(property.price)}}</h6>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END RECENT PROPERTY -->

    <!-- POPULAR CITY -->
    <section class="wrap__heading ">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            our projects 
                        </h2>
                        <p class="text-center text-capitalize">find properties in these places.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div v-for="project in featuredproject" :key="project.id" class="col-lg-5 col-xl-5 col-padd">
                    <!-- CARD IMAGE -->

                    <a href="#">
                        <div class="card__image-hover-style-v3">
                            <div class="card__image-hover-style-v3-thumb h-475">
                                <img :src="getProjectPhoto() + project.image_path" alt="" class="img-fluid w-100">
                            </div>
                            <div class="overlay">
                                <div class="desc">
                                    <h6 class="text-capitalize">{{project.location}}</h6>
                                    <p class="text-capitalize">{{project.name}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-7 col-xl-7">
                    <div class="row">
                        <div v-for="project in homeprojects" :key="project.id" class="col-md-6 col-padd">
                            <!-- CARD IMAGE -->
                            <a href="#">
                                <div class="card__image-hover-style-v3">
                                    <div class="card__image-hover-style-v3-thumb h-230">
                                        <img :src="getProjectPhoto() + project.image_path" alt="" class="img-fluid w-100">
                                    </div>
                                    <div class="overlay">
                                        <div class="desc">
                                            <h6 class="text-capitalize">{{project.location}}</h6>
                                            <p class="text-capitalize">{{project.name}}</p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END POPULAR CITY -->

    <!-- ABOUT -->
    <section class="home__about">
        <div class="container">
            <div v-for="about in abouts" :key="about.id" class="row">
                <div class="col-lg-6">
                    <div class="title__leading">
                        <!-- <h6 class="text-uppercase">trusted By thousands</h6> -->
                        <h2 class="text-capitalize">why choose us?</h2>
                        <p>
                            {{about.title}}
                        </p>
                        <p>
                            {{about.description.substring(0,500)+"..."}}
                        </p>
                        <router-link to="/aboutus" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="btn rounded-pill btn-success mt-3 text-capitalize"
                                @click="navigate"
                            > 
                            read more
                            <i class="fa fa-angle-right ml-3 "></i></a>
                            </router-link>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about__image">
                        <div class="about__image-top">
                            <div class="about__image-top-hover">
                                <!-- <img src="images/gallery.jpg" alt="" class="img-fluid"> -->
                                <img :src="getAboutPhoto() + about.image" alt="" class="img-fluid">

                            </div>

                        </div>
                        <div class="about__image-bottom">
                            <div class="about__image-bottom-hover">
                                <img :src="getAboutPhoto() + about.image" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ABOUT -->

    <!-- BLOG -->
    <section class="blog__home bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-6 mx-auto">
                    <div class="title__head">
                        <h2 class="text-center text-capitalize">
                            latest blogs
                        </h2>
                        <p class="text-center text-capitalize">Find Of The Most Popular Real Estate Company All Around
                            Kenya.</p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row">
                <div v-for="blog in recentblogs" :key="blog.id" class="col-md-4">
                    <!-- BLOG  -->
                    <div class="card__image">
                        <div class="card__image-header h-250">
                            <img :src="getBlogPhoto() + blog.image_path" alt="" class="img-fluid w100 img-transition">
                            <div class="info"> {{blog.category['name']}}</div>
                        </div>
                        <div class="card__image-body">
                            <!-- <span class="badge badge-secondary p-1 text-capitalize mb-3">May 08, 2019 </span> -->
                            <h6 class="text-capitalize">
                                <a href="#" @click="viewBlog(blog.id)">{{blog.title}} </a>
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
                                <li class="list-inline-item ">
                                    <a href="#">
                                        {{format_date(blog.created_at)}}
                                    </a>

                                </li>

                            </ul>
                            <ul class="list-inline my-auto ml-auto">
                                <li class="list-inline-item ">
                                    <a href="#" @click="viewBlog(blog.id)" class="btn btn-sm btn-success "><small
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
    </section>
    <!-- END BLOG -->
    <a href=" https://wa.me/254759509462?text=Hello!%20Ingo%20Properties," data-action="share/whatsapp/share"  class="floating" >
    <i class="fab fa-whatsapp fab-icon"></i>
    </a>

    <Footer />


<!-- </Main> -->
</template>

<script>
// import Main from "../components/Main.vue";
import Footer from "../components/Footer.vue";
import axios from 'axios';
import moment from 'moment';

export default {
    data() {
        return {
            homefeaturedproperties: [],
            recentproperties: [],
            homefeaturedproperty1: [],
            homefeaturedproperty2: [],
            homefeaturedproperty3: [],
            propertytypes: [],
            locations: [],
            services: [],
            recentblogs: [],
            abouts: [],
            homeprojects: [],
            featuredproject: [],
            user: [],
            form: {
                category_id: '',
                search: '',
            }
        }
    },
    methods: {
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        viewBlog(id){
            this.$router.push('/ourblogs/'+id)
        },
        viewProperty(id){
            this.$router.push('/properties/'+id)
        },
         formatNumberWithCommas(number) {
          return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        },
        getPhoto()
        {
            return "images/";
        },
        getPropertyPhoto()
        {
            return "/storage/properties/";
        },
        getBlogPhoto()
        {
            return "/storage/blogs/";
        },
        getAboutPhoto()
        {
            return "/storage/about/";
        },
        getProjectPhoto()
        {
            return "/storage/projects/";
        },
        searchProperty(){
            axios.post('api/search', this.form).then((response) => {
                const searchResults = response.data.properties
                this.$router.push({
                    name: 'SearchResultPage',
                    props: { searchResults }
                })
            }).catch((error) => {
                console.log(error)
            })
        },
        loadLists() {
            axios.get('api/lists').then((response) => {
            this.categories = response.data.lists.categories;
            this.propertytypes = response.data.lists.propertytypes;
            this.locations = response.data.lists.locations;
            this.homefeaturedproperties = response.data.lists.homefeaturedproperties;
            this.recentproperties = response.data.lists.recentproperties;
            this.services = response.data.lists.services;
            // this.homefeaturedproperty2 = this.homefeaturedproperties[1].title;
            // this.homefeaturedproperty3 = this.homefeaturedproperties[2].title;
            this.recentblogs = response.data.lists.recentblogs;
            this.abouts = response.data.lists.abouts;
            this.homeprojects = response.data.lists.homeprojects;
            this.featuredproject = response.data.lists.featuredproject;
            console.log("home 1" ,this.featuredproject)
            console.log("home 2" ,this.homeprojects)

            });
        }
    },
    components: {
        // Main,
        Footer

    },
    mounted()
    {
        this.loadLists();
        this.user = JSON.parse(localStorage.getItem('user'));

    },
    created(){
        this.loadLists();
    },
    computed: {
        isEmpty: function(){
            return jQuery.isEmptyObject(this.user);
        }
    }


};

</script>
<style>
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

/* CSS styles for the carousel container and images */
    .carousel {
      position: relative;
      width: 500px;
      height: 300px;
      overflow: hidden;
    }
    
    .carousel-inner {
      width: 100%;
      height: 100%;
      display: flex;
    }
    
    .carousel-slide {
      width: 100%;
      height: 100%;
      flex-shrink: 0;
      opacity: 0;
      transition: opacity 0.5s ease;
    }
    
    .carousel-slide.active {
      opacity: 1;
    }
    
    .carousel-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    
    /* Navigation radio buttons */
    .carousel-nav {
      position: absolute;
      bottom: 10px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
    }
    
    .carousel-nav label {
      display: block;
      width: 12px;
      height: 12px;
      background: #aaa;
      border-radius: 50%;
      margin: 5px;
      cursor: pointer;
    }
    
    .carousel-nav input[type="radio"] {
      display: none;
    }
    
    .carousel-nav input[type="radio"]:checked + label {
      background: #333;
    }
</style>