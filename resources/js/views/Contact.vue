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
                                <li class="breadcrumb-item"> <a href="#">Contact Us</a></li>
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

        <!-- Form contact -->
        <section class="wrap__contact-form">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h5>contact us</h5>
                    <div class="row">
                        <form @submit.prevent="submit">
                        <div v-if="isEmpty" class="col-md-6">
                            <div class="form-group form-group-name">
                                <label>Your name <span class="required"></span></label>
                                <input type="text" v-model="form.name" class="form-control" name="name" required="">

                            </div>
                        </div>
                        <div v-if="isEmpty" class="col-md-6">
                            <div class="form-group form-group-name">
                                <label>Your email <span class="required"></span></label>
                                <input type="email" v-model="form.email" class="form-control" name="email" required="">

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-group-name">
                                <label>Subject <span class="required"></span></label>
                                <input type="text" v-model="form.subject" class="form-control" name="subject" required="">

                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Your message </label>
                                <textarea class="form-control" v-model="form.message" rows="9" name="message"></textarea>
                            </div>
                            <div class="form-group float-right mb-0">
                                <button type="submit" class="btn rounded-pill btn-success btn-contact">Submit</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-4">
                    <div class="wrap__contact-open-hours">
                        <h5 class="text-capitalize">open hours</h5>
                        <ul class="list-unstyled">
                            <li class="d-flex align-items-center justify-content-between"><span>Monday - Friday</span>
                                <span>8 AM - 5 PM</span></li>
                            <li class="d-flex align-items-center justify-content-between"><span>Saturday</span> <span>9
                                    AM - 4 PM</span></li>
                            <li class="d-flex align-items-center justify-content-between"><span>Sunday</span>
                                <span>Closed</span></li>
                        </ul>
                    </div>
                    <h5>Info location</h5>
                    <div v-for="contact in contacts" :key="contact.id" class="wrap__contact-form-office">
                        <ul class="list-unstyled">
                            <li>
                                <span>
                                    <i class="fa fa-home"></i>
                                </span>

                                {{contact.address}}


                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:">(+254) {{contact.phone}}</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-phone"></i>
                                    <a href="tel:">(+254) {{contact.phone_2}}</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-envelope"></i>
                                    <a href="mailto:">{{contact.email}}</a>
                                </span>

                            </li>
                            <li>
                                <span>
                                    <i class="fa fa-globe"></i>
                                    <a href="#" target="_blank"> www.ingoproperties.co.ke</a>
                                </span>
                            </li>
                        </ul>

                        <div class="social__media">
                            <h5>find us</h5>
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white facebook">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white telegram">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="btn btn-social rounded text-white linkedin">
                                        <i class="fab fa-linkedin"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- End Form contact  -->
    </Branch>
</template>

<script>
import axios from "axios";
import Branch from "../components/Branch.vue";

export default {
  components: {
    Branch,

  },
  data(){
    return {
        contacts: [],
        user: [],
        form: {
            name: '',
            email: '',
            subject: '',
            message: '',
            user_id: ''
        }
    }
  },
  methods: {
    loadLists(){
        axios.get('api/lists').then((response) => {
            this.contacts = response.data.lists.contacts
            console.log(this.contacts)
        }).catch((error) => {
            console.log(error)
        })
    },
    submit(){
        axios.post('api/messages',this.form).then((response) =>{
            console.log(response)
        })
    }
  },
  mounted(){
    this.loadLists();
    this.user = JSON.parse(localStorage.getItem('user'));
    this.form.user_id = this.user.id;
  },
  computed: {
        isEmpty: function(){
            return jQuery.isEmptyObject(this.user);
        }
    }


};

</script>