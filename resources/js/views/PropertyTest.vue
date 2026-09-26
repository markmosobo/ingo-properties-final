<template>
    <Branch>

        <!-- HEADER -->
        <header>
            <!-- NAVBAR -->
            <nav class="navbar navbar-hover navbar-expand-lg navbar-soft">
                <div class="container">

                    <a class="navbar-brand" href="#">
                        <img
                            src="/images/ingo-colored-logo.png"
                            alt="Ingo Properties"
                            class="img-fluid"
                        >
                    </a>

                    <button
                        class="navbar-toggler"
                        type="button"
                        data-toggle="collapse"
                        data-target="#main_nav99"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div
                        class="collapse navbar-collapse"
                        id="main_nav99"
                    >

                        <ul class="navbar-nav mx-auto">

                            <li class="nav-item">
                                <router-link
                                    to="/"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
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

                                <a
                                    class="nav-link dropdown-toggle"
                                    href="#"
                                    data-toggle="dropdown"
                                >
                                    Properties
                                </a>

                                <ul class="dropdown-menu dropdown-menu-left animate fade-up">

                                    <li>
                                        <router-link
                                            to="/saleproperties"
                                            custom
                                            v-slot="{ href, navigate, isActive }"
                                        >
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
                                        <router-link
                                            to="/rentproperties"
                                            custom
                                            v-slot="{ href, navigate, isActive }"
                                        >
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
                                        <router-link
                                            to="/allproperties"
                                            custom
                                            v-slot="{ href, navigate, isActive }"
                                        >
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
                                <router-link
                                    to="/ourprojects"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
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
                                <router-link
                                    to="/ourblogs"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
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
                                <router-link
                                    to="/aboutus"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
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
                                <router-link
                                    to="/contactus"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
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

                        <!-- LOGIN / DASHBOARD -->
                        <ul class="navbar-nav">

                            <li v-if="isEmpty">
                                <router-link
                                    to="/login"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
                                    <a
                                        :href="href"
                                        :class="{ active: isActive }"
                                        class="btn rounded-pill btn-success text-capitalize"
                                        @click="navigate"
                                    >
                                        <i class="fa fa-sign-in mr-1"></i>
                                        Sign In
                                    </a>
                                </router-link>
                            </li>

                            <li v-else>
                                <router-link
                                    to="/dashboard"
                                    custom
                                    v-slot="{ href, navigate, isActive }"
                                >
                                    <a
                                        :href="href"
                                        :class="{ active: isActive }"
                                        class="btn rounded-pill btn-success text-capitalize"
                                        @click="navigate"
                                    >
                                        <i class="fa fa-user mr-1"></i>
                                        Dashboard
                                    </a>
                                </router-link>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

            <!-- BREADCRUMB -->
            <div class="bg-light">

                <div class="container">

                    <div class="row">

                        <div class="col-lg-12">

                            <div class="section__breadcrumb-v1">

                                <ol class="breadcrumb mb-0 bg-light">

                                    <li class="breadcrumb-item">
                                        <router-link to="/">
                                            <a href="#">
                                                <i class="fa fa-home"></i>
                                                Home
                                            </a>
                                        </router-link>
                                    </li>

                                    <li class="breadcrumb-item">
                                        <router-link to="/allproperties">
                                            <a href="#">
                                                Our Properties
                                            </a>
                                        </router-link>
                                    </li>

                                    <li class="breadcrumb-item active">
                                        <span class="text-capitalize">
                                            {{ property.title }}
                                        </span>
                                    </li>

                                </ol>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        <div class="clearfix"></div>

        <!-- SINGLE DETAIL -->
        <section class="single__Detail">

            <div class="container">

                <div class="row">

                    <div class="col-lg-12">

                        <!-- TITLE + PRICE -->
                        <div class="single__detail-area pt-0 pb-4">

                            <div class="row">

                                <div class="col-md-8 col-lg-8">

                                    <div class="single__detail-area-title">

                                        <h3 class="text-capitalize">
                                            {{ property.title }}
                                        </h3>

                                        <p>
                                            <i class="fa fa-map-marker mr-1"></i>
                                            {{ property.address || property.location }}
                                        </p>

                                    </div>

                                </div>

                                <div class="col-md-4 col-lg-4">

                                    <div class="single__detail-area-price">

                                        <h3
                                            v-if="property.property_status === 'rent'"
                                            class="text-capitalize text-gray"
                                        >
                                            KES {{ formatNumber(property.price) }}
                                            /
                                            {{ property.price_period || 'Month' }}
                                        </h3>

                                        <h3
                                            v-else
                                            class="text-capitalize text-gray"
                                        >
                                            KES {{ formatNumber(property.price) }}
                                        </h3>

                                        <ul class="list-inline">

                                            <li class="list-inline-item">
                                                <a
                                                    href="#"
                                                    class="badge badge-success p-2 rounded"
                                                >
                                                    <i class="fa fa-exchange"></i>
                                                </a>
                                            </li>

                                            <li class="list-inline-item">
                                                <a
                                                    href="#"
                                                    class="badge badge-success p-2 rounded"
                                                >
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </li>

                                            <li class="list-inline-item">
                                                <a
                                                    href="#"
                                                    class="badge badge-success p-2 rounded"
                                                    @click.prevent="printPage"
                                                >
                                                    <i class="fa fa-print"></i>
                                                </a>
                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!-- ============================== -->
                        <!-- MODERN IMAGE GALLERY -->
                        <!-- ============================== -->

                        <div class="row justify-content-center">

                            <div class="col-md-10 col-lg-9">

                                <div
                                    v-if="property.images && property.images.length"
                                    class="property-gallery"
                                >

                                    <!-- MAIN IMAGE -->
                                    <div class="main-image-wrapper">

                                        <img
                                            :src="getPhoto() + currentImage"
                                            class="main-property-image"
                                            alt="Property Image"
                                        >

                                        <!-- IMAGE COUNTER -->
                                        <div class="image-counter">
                                            {{ currentImageIndex + 1 }}
                                            /
                                            {{ property.images.length }}
                                        </div>

                                        <!-- PREVIOUS -->
                                        <button
                                            v-if="property.images.length > 1"
                                            type="button"
                                            class="gallery-arrow gallery-arrow-left"
                                            @click="previousImage"
                                            aria-label="Previous image"
                                        >
                                            <i class="fa fa-chevron-left"></i>
                                        </button>

                                        <!-- NEXT -->
                                        <button
                                            v-if="property.images.length > 1"
                                            type="button"
                                            class="gallery-arrow gallery-arrow-right"
                                            @click="nextImage"
                                            aria-label="Next image"
                                        >
                                            <i class="fa fa-chevron-right"></i>
                                        </button>

                                    </div>

                                    <!-- THUMBNAILS -->
                                    <div
                                        v-if="property.images.length > 1"
                                        class="thumbnail-gallery"
                                    >

                                        <!-- LEFT THUMBNAIL ARROW -->
                                        <button
                                            type="button"
                                            class="thumbnail-arrow"
                                            @click="scrollThumbnails('left')"
                                            aria-label="Scroll thumbnails left"
                                        >
                                            <i class="fa fa-chevron-left"></i>
                                        </button>

                                        <!-- THUMBNAIL WINDOW -->
                                        <div
                                            ref="thumbnailContainer"
                                            class="thumbnail-scroll"
                                        >

                                            <div
                                                v-for="(item, index) in property.images"
                                                :key="item.id"
                                                class="thumbnail-item"
                                                :class="{
                                                    'active-thumbnail':
                                                        currentImageIndex === index
                                                }"
                                                @click="selectImage(index)"
                                            >

                                                <img
                                                    :src="getPhoto() + item.name"
                                                    :alt="'Property Image ' + (index + 1)"
                                                >

                                            </div>

                                        </div>

                                        <!-- RIGHT THUMBNAIL ARROW -->
                                        <button
                                            type="button"
                                            class="thumbnail-arrow"
                                            @click="scrollThumbnails('right')"
                                            aria-label="Scroll thumbnails right"
                                        >
                                            <i class="fa fa-chevron-right"></i>
                                        </button>

                                    </div>

                                </div>

                                <!-- NO IMAGE -->
                                <div
                                    v-else
                                    class="no-property-image"
                                >
                                    <i class="fa fa-image"></i>

                                    <p>
                                        No property images available.
                                    </p>
                                </div>

                            </div>

                        </div>

                        <!-- END IMAGE GALLERY -->

                    </div>


                    <!-- SIDEBAR -->
                    <div class="col-lg-4 pt-5">

                        <div class="products__filter mb-30">

                            <div class="wrapper__list__category">

                                <!-- CATEGORY -->
                                <div class="widget widget__archive">

                                    <div class="widget__title">

                                        <h5 class="text-dark mb-0 text-center">
                                            Property Categories
                                        </h5>

                                    </div>

                                    <ul class="list-unstyled">

                                        <li
                                            v-for="category in categories"
                                            :key="category.id"
                                        >

                                            <a
                                                @click.prevent="navigate(category.id)"
                                                href="#"
                                                class="text-capitalize"
                                            >
                                                {{ category.name }}
                                            </a>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>


                    <!-- DESCRIPTION / DETAILS -->
                    <div class="col-lg-8">

                        <!-- DESCRIPTION -->
                        <div class="row">

                            <div class="col-lg-12">

                                <div class="single__detail-desc">

                                    <h6 class="text-capitalize detail-heading">
                                        Description
                                    </h6>

                                    <p class="property-description">
                                        {{ property.description }}
                                    </p>

                                </div>

                                <div class="clearfix"></div>


                                <!-- PROPERTY DETAILS -->
                                <div class="single__detail-features">

                                    <h6 class="text-capitalize detail-heading">
                                        Property Details
                                    </h6>

                                    <!-- APARTMENTS -->
                                    <div
                                        v-if="
                                            property.category_id == 3 ||
                                            property.category_id == 4 ||
                                            property.category_id == 7
                                        "
                                        class="row"
                                    >

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Price:</b>
                                                    KES {{ formatNumber(property.price) }}
                                                </li>

                                                <li v-if="property.size">
                                                    <b>Property Size:</b>
                                                    {{ property.size }} Sq Ft
                                                </li>

                                                <li v-if="property.bedrooms">
                                                    <b>Bedrooms:</b>
                                                    {{ property.bedrooms }}
                                                </li>

                                                <li v-if="property.bathrooms">
                                                    <b>Bathrooms:</b>
                                                    {{ property.bathrooms }}
                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Property Status:</b>
                                                    For {{ property.property_status }}
                                                </li>

                                                <li v-if="property.location">
                                                    <b>Property Location:</b>
                                                    {{ property.location }}
                                                </li>

                                                <li>
                                                    <b>Current Status:</b>
                                                    <span
                                                        :class="
                                                            property.status == 1
                                                                ? 'text-success'
                                                                : 'text-danger'
                                                        "
                                                    >
                                                        {{ property.status == 1 ? 'Open' : 'Closed' }}
                                                    </span>
                                                </li>

                                                <li v-if="property.negotiable == 1">
                                                    <b>Negotiable:</b>
                                                    Yes
                                                </li>

                                            </ul>

                                        </div>

                                    </div>


                                    <!-- HOUSE -->
                                    <div
                                        v-else-if="
                                            property.category_id == 1 ||
                                            property.category_id == 2
                                        "
                                        class="row"
                                    >

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Price:</b>
                                                    KES {{ formatNumber(property.price) }}
                                                </li>

                                                <li v-if="property.size">
                                                    <b>Property Size:</b>
                                                    {{ property.size }} Sq Ft
                                                </li>

                                                <li v-if="property.estate_name">
                                                    <b>Estate Name:</b>
                                                    {{ property.estate_name }}
                                                </li>

                                                <li v-if="property.bedrooms">
                                                    <b>Bedrooms:</b>
                                                    {{ property.bedrooms }}
                                                </li>

                                                <li v-if="property.bathrooms">
                                                    <b>Bathrooms:</b>
                                                    {{ property.bathrooms }}
                                                </li>

                                                <li v-if="property.negotiable == 1">
                                                    <b>Negotiable:</b>
                                                    Yes
                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Property Status:</b>
                                                    For {{ property.property_status }}
                                                </li>

                                                <li v-if="property.location">
                                                    <b>Property Location:</b>
                                                    {{ property.location }}
                                                </li>

                                                <li>
                                                    <b>Current Status:</b>

                                                    <span
                                                        :class="
                                                            property.status == 1
                                                                ? 'text-success'
                                                                : 'text-danger'
                                                        "
                                                    >
                                                        {{ property.status == 1 ? 'Open' : 'Closed' }}
                                                    </span>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>


                                    <!-- LAND -->
                                    <div
                                        v-else
                                        class="row"
                                    >

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Price:</b>
                                                    KES {{ formatNumber(property.price) }}
                                                </li>

                                                <li v-if="property.land_area">
                                                    <b>Land Area:</b>
                                                    {{ property.land_area }} Acre(s)
                                                </li>

                                                <li v-if="property.land_type">
                                                    <b>Land Type:</b>
                                                    {{ property.land_type }}
                                                </li>

                                                <li v-if="property.property_use">
                                                    <b>Property Use:</b>
                                                    {{ property.property_use }}
                                                </li>

                                                <li v-if="property.negotiable == 1">
                                                    <b>Negotiable:</b>
                                                    Yes
                                                </li>

                                            </ul>

                                        </div>

                                        <div class="col-md-6">

                                            <ul class="property__detail-info-list list-unstyled">

                                                <li>
                                                    <b>Property Status:</b>
                                                    For {{ property.property_status }}
                                                </li>

                                                <li v-if="property.location">
                                                    <b>Property Location:</b>
                                                    {{ property.location }}
                                                </li>

                                                <li>
                                                    <b>Current Status:</b>

                                                    <span
                                                        :class="
                                                            property.status == 1
                                                                ? 'text-success'
                                                                : 'text-danger'
                                                        "
                                                    >
                                                        {{ property.status == 1 ? 'Open' : 'Closed' }}
                                                    </span>

                                                </li>

                                            </ul>

                                        </div>

                                    </div>

                                </div>


                                <!-- FEATURES -->
                                <div
                                    v-if="activeFeatures.length"
                                    class="single__detail-features"
                                >

                                    <h6 class="text-capitalize detail-heading">
                                        Features
                                    </h6>

                                    <ul class="list-unstyled icon-checkbox">

                                        <li
                                            v-for="feature in activeFeatures"
                                            :key="feature.key"
                                        >
                                            <i class="fa fa-check-circle mr-2"></i>
                                            {{ feature.label }}
                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </Branch>
</template>


<script>

import Branch from "../components/Branch.vue";
import axios from "axios";
import numeral from "numeral";

export default {

    components: {
        Branch,
    },

    data() {

        return {

            property: {
                images: []
            },

            categories: [],

            currentImage: "",

            currentImageIndex: 0,

            featureList: [

                {
                    key: "electricity",
                    label: "24 hour electricity"
                },

                {
                    key: "air_conditioning",
                    label: "Air conditioning"
                },

                {
                    key: "alarm",
                    label: "Alarm"
                },

                {
                    key: "balcony",
                    label: "Balcony"
                },

                {
                    key: "chandelier",
                    label: "Chandelier"
                },

                {
                    key: "car_parking",
                    label: "Car parking"
                },

                {
                    key: "dining_area",
                    label: "Dining area"
                },

                {
                    key: "dishwasher",
                    label: "Dishwasher"
                },

                {
                    key: "gym",
                    label: "Gym"
                },

                {
                    key: "hot_water",
                    label: "Hot water"
                },

                {
                    key: "kitchen_cabinets",
                    label: "Kitchen cabinets"
                },

                {
                    key: "kitchen_shelf",
                    label: "Kitchen shelf"
                },

                {
                    key: "microwave",
                    label: "Microwave"
                },

                {
                    key: "pets_allow",
                    label: "Pets allowed"
                },

                {
                    key: "pop_ceiling",
                    label: "POP ceiling"
                },

                {
                    key: "prepaid_meter",
                    label: "Pre-paid meter"
                },

                {
                    key: "refrigerator",
                    label: "Refrigerator"
                },

                {
                    key: "swimming_pool",
                    label: "Swimming pool"
                },

                {
                    key: "tv",
                    label: "TV"
                },

                {
                    key: "wardrobe",
                    label: "Wardrobe"
                },

                {
                    key: "wifi",
                    label: "Wi-Fi"
                }

            ]

        };

    },


    computed: {

        activeFeatures() {

            return this.featureList.filter(feature => {

                return (
                    this.property[feature.key] === 1 ||
                    this.property[feature.key] === true
                );

            });

        }

    },


    methods: {

        getPhoto() {

            return "/storage/properties/";

        },


        getData() {

            axios
                .get("/api/property/" + this.$route.params.id)

                .then((response) => {

                    console.log("PROPERTY API:", response.data);

                    /*
                     * IMPORTANT:
                     *
                     * Your new API response is:
                     *
                     * {
                     *     id: 179,
                     *     title: "...",
                     *     images: [...]
                     * }
                     *
                     * NOT:
                     *
                     * property[0]
                     */

                    this.property = response.data.property || response.data;

                    /*
                     * Make sure images is always an array.
                     */

                    if (
                        !this.property.images ||
                        !Array.isArray(this.property.images)
                    ) {

                        this.property.images = [];

                    }


                    /*
                     * Set first image as main image.
                     */

                    if (this.property.images.length > 0) {

                        this.currentImageIndex = 0;

                        this.currentImage =
                            this.property.images[0].name;

                    } else {

                        this.currentImageIndex = 0;

                        this.currentImage = "";

                    }


                    console.log(
                        "Loaded property:",
                        this.property
                    );

                    console.log(
                        "Images:",
                        this.property.images
                    );

                })

                .catch((error) => {

                    console.error(
                        "Unable to load property:",
                        error
                    );

                    this.property = {
                        images: []
                    };

                    this.currentImage = "";

                    this.currentImageIndex = 0;

                });

        },


        /*
         * Select thumbnail
         */

        selectImage(index) {

            if (
                !this.property.images ||
                !this.property.images.length
            ) {
                return;
            }

            this.currentImageIndex = index;

            this.currentImage =
                this.property.images[index].name;

            this.scrollThumbnailIntoView(index);

        },


        /*
         * Next main image
         */

        nextImage() {

            if (
                !this.property.images ||
                this.property.images.length <= 1
            ) {
                return;
            }

            this.currentImageIndex++;

            if (
                this.currentImageIndex >=
                this.property.images.length
            ) {

                this.currentImageIndex = 0;

            }

            this.currentImage =
                this.property.images[
                    this.currentImageIndex
                ].name;

            this.scrollThumbnailIntoView(
                this.currentImageIndex
            );

        },


        /*
         * Previous main image
         */

        previousImage() {

            if (
                !this.property.images ||
                this.property.images.length <= 1
            ) {
                return;
            }

            this.currentImageIndex--;

            if (this.currentImageIndex < 0) {

                this.currentImageIndex =
                    this.property.images.length - 1;

            }

            this.currentImage =
                this.property.images[
                    this.currentImageIndex
                ].name;

            this.scrollThumbnailIntoView(
                this.currentImageIndex
            );

        },


        /*
         * Move thumbnail strip
         */

        scrollThumbnails(direction) {

            const container =
                this.$refs.thumbnailContainer;

            if (!container) {
                return;
            }

            const scrollAmount = 350;

            if (direction === "left") {

                container.scrollBy({
                    left: -scrollAmount,
                    behavior: "smooth"
                });

            } else {

                container.scrollBy({
                    left: scrollAmount,
                    behavior: "smooth"
                });

            }

        },


        /*
         * Make selected thumbnail visible
         */

        scrollThumbnailIntoView(index) {

            this.$nextTick(() => {

                const container =
                    this.$refs.thumbnailContainer;

                if (!container) {
                    return;
                }

                const thumbnails =
                    container.querySelectorAll(
                        ".thumbnail-item"
                    );

                if (!thumbnails[index]) {
                    return;
                }

                thumbnails[index].scrollIntoView({
                    behavior: "smooth",
                    block: "nearest",
                    inline: "center"
                });

            });

        },


        /*
         * Categories
         */

        loadLists() {

            axios
                .get("/api/lists")

                .then((response) => {

                    this.categories =
                        response.data.lists.categories;

                })

                .catch((error) => {

                    console.error(
                        "Unable to load categories:",
                        error
                    );

                    this.categories = [];

                });

        },


        /*
         * Format price
         */

        formatNumber(value) {

            if (
                value === null ||
                value === undefined ||
                value === ""
            ) {

                return "—";

            }

            return numeral(value).format("0,0");

        },


        /*
         * Category navigation
         */

        navigate(id) {

            this.$router.push(
                "/categoryproperties/" + id
            );

        },


        /*
         * Print property
         */

        printPage() {

            window.print();

        }

    },


    mounted() {

        this.getData();

        this.loadLists();

    }

};

</script>


<style>

/* =========================================
   PROPERTY GALLERY
========================================= */

.property-gallery {
    width: 100%;
}


/* =========================================
   MAIN IMAGE
========================================= */

.main-image-wrapper {

    position: relative;

    width: 100%;

    height: 520px;

    overflow: hidden;

    border-radius: 12px;

    background: #f1f3f5;

    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.10);

}


.main-property-image {

    width: 100%;

    height: 100%;

    object-fit: cover;

    display: block;

    transition: transform 0.3s ease;

}


.main-image-wrapper:hover
.main-property-image {

    transform: scale(1.01);

}


/* =========================================
   IMAGE COUNTER
========================================= */

.image-counter {

    position: absolute;

    top: 15px;

    right: 15px;

    background: rgba(0, 0, 0, 0.65);

    color: #fff;

    padding: 6px 12px;

    border-radius: 20px;

    font-size: 13px;

    font-weight: 600;

    z-index: 5;

}


/* =========================================
   MAIN IMAGE ARROWS
========================================= */

.gallery-arrow {

    position: absolute;

    top: 50%;

    transform: translateY(-50%);

    width: 45px;

    height: 45px;

    border: none;

    border-radius: 50%;

    background: rgba(0, 0, 0, 0.55);

    color: #fff;

    display: flex;

    align-items: center;

    justify-content: center;

    cursor: pointer;

    z-index: 5;

    transition: all 0.2s ease;

}


.gallery-arrow:hover {

    background: rgba(25, 135, 84, 0.95);

    transform: translateY(-50%) scale(1.08);

}


.gallery-arrow-left {

    left: 15px;

}


.gallery-arrow-right {

    right: 15px;

}


/* =========================================
   THUMBNAIL AREA
========================================= */

.thumbnail-gallery {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-top: 12px;

    width: 100%;

}


/* =========================================
   THUMBNAIL SCROLL WINDOW
========================================= */

.thumbnail-scroll {

    display: flex;

    align-items: center;

    gap: 10px;

    overflow-x: auto;

    scroll-behavior: smooth;

    flex: 1;

    padding: 4px 2px 8px;

    scrollbar-width: thin;

}


/* Chrome / Edge scrollbar */

.thumbnail-scroll::-webkit-scrollbar {

    height: 6px;

}


.thumbnail-scroll::-webkit-scrollbar-track {

    background: #f1f1f1;

    border-radius: 10px;

}


.thumbnail-scroll::-webkit-scrollbar-thumb {

    background: #bbb;

    border-radius: 10px;

}


.thumbnail-scroll::-webkit-scrollbar-thumb:hover {

    background: #198754;

}


/* =========================================
   THUMBNAILS
========================================= */

.thumbnail-item {

    flex: 0 0 auto;

    width: 110px;

    height: 75px;

    border-radius: 8px;

    overflow: hidden;

    cursor: pointer;

    border: 3px solid transparent;

    background: #f1f3f5;

    transition: all 0.2s ease;

}


.thumbnail-item img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    display: block;

}


.thumbnail-item:hover {

    transform: translateY(-2px);

    border-color: #198754;

}


.thumbnail-item.active-thumbnail {

    border-color: #198754;

    box-shadow:
        0 0 0 2px rgba(25, 135, 84, 0.15);

}


/* =========================================
   THUMBNAIL ARROWS
========================================= */

.thumbnail-arrow {

    flex: 0 0 auto;

    width: 38px;

    height: 38px;

    border: none;

    border-radius: 50%;

    background: #198754;

    color: #fff;

    display: flex;

    align-items: center;

    justify-content: center;

    cursor: pointer;

    transition: all 0.2s ease;

}


.thumbnail-arrow:hover {

    background: #146c43;

    transform: scale(1.05);

}


/* =========================================
   NO IMAGE
========================================= */

.no-property-image {

    height: 350px;

    background: #f8f9fa;

    border-radius: 12px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    color: #adb5bd;

}


.no-property-image i {

    font-size: 60px;

    margin-bottom: 15px;

}


/* =========================================
   DESCRIPTION
========================================= */

.property-description {

    white-space: pre-line;

    line-height: 1.8;

}


/* =========================================
   FEATURES
========================================= */

.icon-checkbox li {

    position: relative;

    padding: 8px 0 8px 0;

    text-transform: capitalize;

}


.icon-checkbox li i {

    color: #198754;

}


/* =========================================
   MOBILE
========================================= */

@media (max-width: 991px) {

    .main-image-wrapper {

        height: 430px;

    }

}


@media (max-width: 767px) {

    .main-image-wrapper {

        height: 350px;

        border-radius: 8px;

    }

    .gallery-arrow {

        width: 40px;

        height: 40px;

    }

    .thumbnail-item {

        width: 90px;

        height: 65px;

    }

    .thumbnail-arrow {

        width: 34px;

        height: 34px;

    }

}


@media (max-width: 575px) {

    .main-image-wrapper {

        height: 280px;

    }

    .thumbnail-gallery {

        gap: 5px;

    }

    .thumbnail-scroll {

        gap: 6px;

    }

    .thumbnail-item {

        width: 80px;

        height: 58px;

    }

    .thumbnail-arrow {

        width: 32px;

        height: 32px;

    }

    .image-counter {

        top: 10px;

        right: 10px;

        font-size: 12px;

        padding: 5px 9px;

    }

}

</style>