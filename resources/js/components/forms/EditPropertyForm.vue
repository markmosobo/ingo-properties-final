<template>
    <div class="listing-page">

        <div class="container-fluid px-2 px-md-4 py-3">

            <!-- HEADER -->
            <div class="listing-header mb-4">
                <div>
                    <h3 class="mb-1">Edit Listing</h3>
                    <p class="text-muted mb-0">
                        Update your property information and save your changes.
                    </p>
                </div>
            </div>


            <!-- ERROR -->
            <div
                v-if="message"
                class="alert alert-danger"
            >
                {{ message }}
            </div>


            <!-- SUCCESS -->
            <div
                v-if="successMessage"
                class="alert alert-success"
            >
                {{ successMessage }}
            </div>


            <div class="listing-card">

                <!-- =====================================================
                     BASIC INFORMATION
                ====================================================== -->

                <div class="card-heading">

                    <div>
                        <span class="section-kicker">
                            LISTING INFORMATION
                        </span>

                        <h4>
                            What are you listing?
                        </h4>

                        <p>
                            Update the category, location and listing status.
                        </p>
                    </div>

                </div>


                <div class="row g-4">

                    <!-- CATEGORY -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Property category
                        </label>

                        <select
                            v-model="form.category_id"
                            class="form-select form-select-lg"
                            @change="categoryChanged"
                        >

                            <option value="" disabled>
                                Select a category
                            </option>

                            <option
                                v-for="category in categories"
                                :key="category.id"
                                :value="String(category.id)"
                            >
                                {{ category.name }}
                            </option>

                        </select>

                    </div>


                    <!-- LOCATION -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Area / Location
                        </label>

                        <select
                            v-model="form.location_id"
                            class="form-select form-select-lg"
                        >

                            <option value="" disabled>
                                Select location
                            </option>

                            <option
                                v-for="location in locations"
                                :key="location.id"
                                :value="String(location.id)"
                            >
                                {{ location.name }}
                            </option>

                        </select>

                    </div>


                    <!-- STATUS -->
                    <div class="col-12">

                        <label class="form-label">
                            Listing status
                        </label>

                        <div class="choice-grid">

                            <button
                                v-if="allowRent"
                                type="button"
                                class="choice-card"
                                :class="{
                                    selected: form.property_status === 'rent'
                                }"
                                @click="form.property_status = 'rent'"
                            >

                                <span class="choice-icon">
                                    🏠
                                </span>

                                <span>
                                    <strong>For Rent</strong>

                                    <small>
                                        I'm looking for a tenant
                                    </small>
                                </span>

                            </button>


                            <button
                                v-if="allowSale"
                                type="button"
                                class="choice-card"
                                :class="{
                                    selected: form.property_status === 'sale'
                                }"
                                @click="form.property_status = 'sale'"
                            >

                                <span class="choice-icon">
                                    🏷️
                                </span>

                                <span>
                                    <strong>For Sale</strong>

                                    <small>
                                        I'm looking for a buyer
                                    </small>
                                </span>

                            </button>

                        </div>

                    </div>


                    <!-- TITLE -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Listing title
                        </label>

                        <input
                            type="text"
                            v-model="form.title"
                            class="form-control form-control-lg"
                            placeholder="e.g. Spacious 3 Bedroom House"
                        />

                    </div>


                    <!-- SPECIFIC LOCATION -->
                    <div class="col-md-6">

                        <label class="form-label">
                            Specific location
                        </label>

                        <input
                            type="text"
                            v-model="form.location"
                            class="form-control form-control-lg"
                            placeholder="e.g. Kakamega Town"
                        />

                    </div>


                    <!-- SOCIAL LINK -->
                    <div class="col-12">

                        <label class="form-label">

                            Social media link

                            <span class="optional">
                                Optional
                            </span>

                        </label>

                        <input
                            type="url"
                            v-model="form.social_link"
                            class="form-control form-control-lg"
                            placeholder="https://facebook.com/..."
                        />

                    </div>

                </div>


                <!-- =====================================================
                     PHOTOS
                ====================================================== -->

                <div class="section-divider"></div>

                <div class="card-heading">

                    <div>

                        <span class="section-kicker">
                            PHOTOS
                        </span>

                        <h4>
                            Property photos
                        </h4>

                        <p>
                            Manage your existing photos or add new ones.
                        </p>

                    </div>

                </div>


                <!-- EXISTING PHOTOS -->

                <div class="form-section">

                    <label class="form-label">
                        Current photos
                    </label>

                    <div
                        v-if="form.images && form.images.length"
                        class="existing-photo-grid"
                    >

                        <div
                            v-for="(image, index) in form.images"
                            :key="image.id"
                            class="existing-photo"
                        >

                            <img
                                :src="getImageUrl(image.name)"
                                :alt="'Property photo ' + (index + 1)"
                            />

                            <button
                                type="button"
                                class="remove-photo"
                                @click="removeImage(image)"
                                title="Remove photo"
                            >
                                ×
                            </button>

                        </div>

                    </div>


                    <div
                        v-else
                        class="empty-photos"
                    >

                        <i class="bi bi-image fs-2"></i>

                        <p class="mb-0 mt-2">
                            No photos currently uploaded.
                        </p>

                    </div>

                </div>


                <!-- ADD NEW PHOTOS -->

                <div class="form-section">

                    <label class="add-media-box">

                        <input
                            type="checkbox"
                            v-model="form.addNewMedia"
                            class="form-check-input"
                        />

                        <span>

                            <strong>
                                Add new photos
                            </strong>

                            <small>
                                Upload additional photos to this listing.
                            </small>

                        </span>

                    </label>

                </div>


                <div
                    v-if="form.addNewMedia"
                    class="upload-box"
                >

                    <label class="form-label mb-3">
                        New property photos
                    </label>

                    <Uploader
                        v-if="hasResponse"
                        server="/api/posts/media/upload"
                        :media="form.media.saved"
                        location="/storage/properties"
                        @init="initMedia"
                        @change="changeMedia"
                        @add="addMedia"
                        @remove="removeMedia"
                    />

                </div>


                <!-- =====================================================
                     PROPERTY DETAILS
                ====================================================== -->

                <div class="section-divider"></div>

                <div class="card-heading">

                    <div>

                        <span class="section-kicker">
                            PROPERTY DETAILS
                        </span>

                        <h4>
                            Tell us about the property
                        </h4>

                        <p>
                            Update the details people need to understand your listing.
                        </p>

                    </div>

                </div>


                <!-- LAND -->

                <template v-if="isLand">

                    <div class="row g-4">

                        <!-- LAND TYPE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Land type
                            </label>

                            <select
                                v-model="form.land_type"
                                class="form-select form-select-lg"
                            >

                                <option value="">
                                    Select land type
                                </option>

                                <option>
                                    Commercial Land
                                </option>

                                <option>
                                    Farmland
                                </option>

                                <option>
                                    Industrial Land
                                </option>

                                <option>
                                    Mixed-Use Land
                                </option>

                                <option>
                                    Quarry
                                </option>

                                <option>
                                    Residential Land
                                </option>

                            </select>

                        </div>


                        <!-- PROPERTY USE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Intended use
                            </label>

                            <select
                                v-model="form.property_use"
                                class="form-select form-select-lg"
                            >

                                <option value="">
                                    Select intended use
                                </option>

                                <option>
                                    Commercial
                                </option>

                                <option>
                                    Mixed
                                </option>

                                <option>
                                    Residential
                                </option>

                            </select>

                        </div>


                        <!-- LAND AREA -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Land size
                            </label>

                            <div class="input-group input-group-lg">

                                <input
                                    type="number"
                                    step="0.01"
                                    v-model="form.land_area"
                                    class="form-control"
                                    placeholder="e.g. 2"
                                />

                                <span class="input-group-text">
                                    Acres
                                </span>

                            </div>

                        </div>


                        <!-- DESCRIPTION -->
                        <div class="col-12">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea
                                v-model="form.description"
                                rows="5"
                                class="form-control"
                                placeholder="Describe the land, access road, nearby landmarks, title deed information, water, electricity, etc."
                            ></textarea>

                        </div>

                    </div>

                </template>


                <!-- HOUSE / APARTMENT -->

                <template v-else>

                    <div class="row g-4">

                        <!-- PROPERTY TYPE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Property type
                            </label>

                            <select
                                v-model="form.property_type_id"
                                class="form-select form-select-lg"
                            >

                                <option value="">
                                    Select property type
                                </option>

                                <option
                                    v-for="type in propertytypes"
                                    :key="type.id"
                                    :value="String(type.id)"
                                >
                                    {{ type.name }}
                                </option>

                            </select>

                        </div>


                        <!-- ADDRESS -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Address / Landmark
                            </label>

                            <input
                                type="text"
                                v-model="form.address"
                                class="form-control form-control-lg"
                                placeholder="e.g. Near Kakamega Market"
                            />

                        </div>


                        <!-- SIZE -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Size
                            </label>

                            <div class="input-group input-group-lg">

                                <input
                                    type="number"
                                    v-model="form.size"
                                    class="form-control"
                                    placeholder="e.g. 1200"
                                />

                                <span class="input-group-text">
                                    sq ft
                                </span>

                            </div>

                        </div>


                        <!-- ESTATE -->
                        <div class="col-md-6">

                            <label class="form-label">

                                Estate / Building name

                                <span class="optional">
                                    Optional
                                </span>

                            </label>

                            <input
                                type="text"
                                v-model="form.estate_name"
                                class="form-control form-control-lg"
                                placeholder="Estate or building name"
                            />

                        </div>


                        <!-- BEDROOMS -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Bedrooms
                            </label>

                            <select
                                v-model="form.bedrooms"
                                class="form-select form-select-lg"
                            >

                                <option value="">
                                    Select
                                </option>

                                <option
                                    v-for="n in 10"
                                    :key="n"
                                    :value="String(n)"
                                >
                                    {{ n }}
                                </option>

                                <option value="10+">
                                    10+
                                </option>

                            </select>

                        </div>


                        <!-- BATHROOMS -->
                        <div class="col-md-6">

                            <label class="form-label">
                                Bathrooms
                            </label>

                            <select
                                v-model="form.bathrooms"
                                class="form-select form-select-lg"
                            >

                                <option value="">
                                    Select
                                </option>

                                <option
                                    v-for="n in 10"
                                    :key="n"
                                    :value="String(n)"
                                >
                                    {{ n }}
                                </option>

                                <option value="10+">
                                    10+
                                </option>

                            </select>

                        </div>

                    </div>

                </template>


                <!-- =====================================================
                     FEATURES
                ====================================================== -->

                <template v-if="!isLand">

                    <div class="section-divider"></div>

                    <div class="card-heading">

                        <div>

                            <span class="section-kicker">
                                FEATURES
                            </span>

                            <h4>
                                Features & amenities
                            </h4>

                            <p>
                                Select everything currently available at the property.
                            </p>

                        </div>

                    </div>


                    <div class="feature-grid">

                        <label
                            v-for="feature in features"
                            :key="feature.key"
                            class="feature-option"
                            :class="{
                                selected: isFeatureSelected(feature.key)
                            }"
                        >

                            <input
                                type="checkbox"
                                v-model="form[feature.key]"
                            />

                            <span class="feature-check">
                                ✓
                            </span>

                            <span>
                                {{ feature.label }}
                            </span>

                        </label>

                    </div>


                    <!-- PARKING -->

                    <div class="form-section mt-4">

                        <label class="form-label">
                            Parking available?
                        </label>

                        <div class="inline-options">

                            <label
                                class="mini-choice"
                                :class="{
                                    selected:
                                        String(form.parking_space) === '1'
                                }"
                            >

                                <input
                                    type="radio"
                                    v-model="form.parking_space"
                                    value="1"
                                />

                                Yes

                            </label>


                            <label
                                class="mini-choice"
                                :class="{
                                    selected:
                                        String(form.parking_space) === '2'
                                }"
                            >

                                <input
                                    type="radio"
                                    v-model="form.parking_space"
                                    value="2"
                                />

                                No

                            </label>

                        </div>

                    </div>

                </template>


                <!-- =====================================================
                     PRICING & CONTACT
                ====================================================== -->

                <div class="section-divider"></div>

                <div class="card-heading">

                    <div>

                        <span class="section-kicker">
                            PRICING & CONTACT
                        </span>

                        <h4>
                            Price and contact information
                        </h4>

                        <p>
                            Update the price and how interested people can reach you.
                        </p>

                    </div>

                </div>


                <div class="row g-4">

                    <!-- PRICE -->

                    <div class="col-md-6">

                        <label class="form-label">
                            {{ form.property_status === 'rent'
                                ? 'Rental Price'
                                : 'Sale Price'
                            }}
                        </label>

                        <div class="input-group input-group-lg">

                            <span class="input-group-text">
                                KSh
                            </span>

                            <input
                                type="number"
                                v-model="form.price"
                                class="form-control"
                                placeholder="e.g. 2500000"
                            />

                        </div>

                    </div>


                    <!-- PAYMENT PERIOD ONLY FOR RENT -->

                    <div
                        v-if="form.property_status === 'rent'"
                        class="col-md-6"
                    >

                        <label class="form-label">
                            Payment period
                        </label>

                        <select
                            v-model="form.price_period"
                            class="form-select form-select-lg"
                        >

                            <option value="Month">
                                Per Month
                            </option>

                            <option value="Quarter">
                                Per Quarter
                            </option>

                            <option value="Year">
                                Per Year
                            </option>

                        </select>

                    </div>


                    <!-- PHONE -->

                    <div class="col-md-6">

                        <label class="form-label">
                            Contact phone
                        </label>

                        <input
                            type="tel"
                            v-model="form.phone_number"
                            class="form-control form-control-lg"
                        />

                    </div>


                    <!-- NEGOTIABLE -->

                    <div class="col-12">

                        <label class="negotiable-box">

                            <input
                                type="checkbox"
                                v-model="form.negotiable"
                                class="form-check-input"
                            />

                            <span>

                                <strong>
                                    Price is negotiable
                                </strong>

                                <small>
                                    Let interested buyers or tenants know you're open to discussion.
                                </small>

                            </span>

                        </label>

                    </div>


                    <!-- DESCRIPTION -->

                    <div class="col-12">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            v-model="form.description"
                            rows="5"
                            class="form-control"
                            placeholder="Describe the property, its condition, neighbourhood, nearby facilities and anything else people should know."
                        ></textarea>

                    </div>

                </div>


                <!-- =====================================================
                     SAVE
                ====================================================== -->

                <div class="wizard-actions">

                    <button
                        type="button"
                        class="btn btn-outline-secondary rounded-pill px-4"
                        @click="cancel"
                        :disabled="loading"
                    >
                        ← Cancel
                    </button>


                    <button
                        type="button"
                        class="btn btn-success rounded-pill px-5"
                        @click="submit"
                        :disabled="loading"
                    >

                        <span
                            v-if="loading"
                            class="spinner-border spinner-border-sm me-2"
                        ></span>

                        {{ loading ? 'Saving Changes...' : 'Save Changes' }}

                    </button>

                </div>

            </div>

        </div>

    </div>
</template>


<script>

import axios from "axios";
import Swal from "sweetalert2";
import Uploader from "vue-media-upload";


const toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000
});


export default {

    components: {
        Uploader
    },


    props: {

        id: {
            type: String,
            required: false
        },

        indexRoute: {
            type: String,
            required: false
        },

        storedMedia: {
            type: Array,
            default: () => []
        }

    },


    data() {

        return {

            categories: [],
            propertytypes: [],
            locations: [],

            message: "",
            successMessage: "",
            user: [],

            hasResponse: true,
            loading: false,

            form: {

                category_id: "",
                location_id: "",
                social_link: "",

                title: "",
                id_image: "",

                location: "",
                address: "",

                property_type_id: "",
                size: "",
                estate_name: "",

                bedrooms: "",
                bathrooms: "",
                parking_space: "",

                price: "",
                price_period: "Month",

                phone_number: "",

                negotiable: false,

                created_by: "",
                property_status: "",

                description: "",

                land_area: "",
                land_type: "",
                property_use: "",

                electricity: false,
                air_conditioning: false,
                alarm: false,
                balcony: false,
                chandelier: false,
                car_parking: false,
                dining_area: false,
                dishwasher: false,
                gym: false,
                hot_water: false,
                kitchen_cabinets: false,
                kitchen_shelf: false,
                microwave: false,
                pets_allow: false,
                pop_ceiling: false,
                prepaid_meter: false,
                refrigerator: false,
                swimming_pool: false,
                tv: false,
                wardrobe: false,
                wifi: false,

                images: [],

                addNewMedia: false,

                media: {
                    list: [],
                    saved: [],
                    added: [],
                    removed: []
                }

            },


            features: [

                {
                    key: "electricity",
                    label: "24 Hour Electricity"
                },

                {
                    key: "air_conditioning",
                    label: "Air Conditioning"
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
                    label: "Car Parking"
                },

                {
                    key: "dining_area",
                    label: "Dining Area"
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
                    label: "Hot Water"
                },

                {
                    key: "kitchen_cabinets",
                    label: "Kitchen Cabinets"
                },

                {
                    key: "kitchen_shelf",
                    label: "Kitchen Shelf"
                },

                {
                    key: "microwave",
                    label: "Microwave"
                },

                {
                    key: "pets_allow",
                    label: "Pets Allowed"
                },

                {
                    key: "pop_ceiling",
                    label: "POP Ceiling"
                },

                {
                    key: "prepaid_meter",
                    label: "Pre-Paid Meter"
                },

                {
                    key: "refrigerator",
                    label: "Refrigerator"
                },

                {
                    key: "swimming_pool",
                    label: "Swimming Pool"
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

        isLand() {

            return (
                String(this.form.category_id) === "5" ||
                String(this.form.category_id) === "6"
            );

        },


        isRentCategory() {

            return (
                String(this.form.category_id) === "1" ||
                String(this.form.category_id) === "3" ||
                String(this.form.category_id) === "5"
            );

        },


        isSaleCategory() {

            return (
                String(this.form.category_id) === "2" ||
                String(this.form.category_id) === "4" ||
                String(this.form.category_id) === "6"
            );

        },


        allowRent() {

            return !this.isSaleCategory;

        },


        allowSale() {

            return !this.isRentCategory;

        }

    },


    methods: {

        categoryChanged() {

            if (this.isRentCategory && !this.isSaleCategory) {

                this.form.property_status = "rent";

            }

            else if (this.isSaleCategory && !this.isRentCategory) {

                this.form.property_status = "sale";

            }

        },


        isFeatureSelected(key) {

            return (
                this.form[key] === true ||
                this.form[key] === 1 ||
                this.form[key] === "1"
            );

        },


        getData() {

            this.loading = true;

            axios
                .get("/api/property/" + this.$route.params.id)

                .then((response) => {

                    /*
                     * Current API should return:
                     *
                     * {
                     *     property: {...}
                     * }
                     */

                    const property =
                        response.data.property || response.data;


                    this.form = {

                        ...this.form,
                        ...property,

                        category_id:
                            property.category_id != null
                                ? String(property.category_id)
                                : "",

                        location_id:
                            property.location_id != null
                                ? String(property.location_id)
                                : "",

                        property_type_id:
                            property.property_type_id != null
                                ? String(property.property_type_id)
                                : "",

                        property_status:
                            property.property_status || "",

                        negotiable:
                            Boolean(property.negotiable),

                        images:
                            property.images || [],

                        addNewMedia: false,

                        media: {
                            list: [],
                            saved: property.images || [],
                            added: [],
                            removed: []
                        }

                    };


                    console.log("Edit property:", this.form);

                })

                .catch((error) => {

                    console.error(error);

                    this.message =
                        "Unable to load the property.";

                })

                .finally(() => {

                    this.loading = false;

                });

        },


        initMedia(media) {

            this.form.media.list = media;

        },


        changeMedia(media) {

            this.form.media.list = media;

        },


        addMedia(addedImage, addedMedia) {

            this.form.media.added = addedMedia;

        },


        removeMedia(removedImage, removedMedia) {

            this.form.media.removed = removedMedia;

        },


        getImageUrl(fileName) {

            return "/storage/properties/" + fileName;

        },


        removeImage(media) {

            Swal.fire({

                title: "Remove photo?",

                text: "This photo will be removed from the listing.",

                icon: "warning",

                showCancelButton: true,

                confirmButtonText: "Remove",

                cancelButtonText: "Cancel"

            }).then((result) => {

                if (!result.isConfirmed) {
                    return;
                }


                axios
                    .delete("/api/propertyimage/" + media.id)

                    .then(() => {

                        toast.fire({
                            title: "Photo Removed",
                            text: "The property photo has been removed.",
                            icon: "success"
                        });

                        this.getData();

                    })

                    .catch((error) => {

                        console.error(error);

                        toast.fire({
                            title: "Unable to remove photo",
                            text: "Please try again.",
                            icon: "error"
                        });

                    });

            });

        },


        loadLists() {

            axios
                .get("/api/lists")

                .then((response) => {

                    this.categories =
                        response.data.lists.categories || [];

                    this.propertytypes =
                        response.data.lists.propertytypes || [];

                    this.locations =
                        response.data.lists.locations || [];

                })

                .catch((error) => {

                    console.error(error);

                    this.message =
                        "Unable to load listing categories and locations.";

                });

        },


        validate() {

            this.message = "";


            if (!this.form.category_id) {

                this.message =
                    "Please select a property category.";

                return false;

            }


            if (!this.form.location_id) {

                this.message =
                    "Please select a location.";

                return false;

            }


            if (!this.form.property_status) {

                this.message =
                    "Please select whether the property is for rent or sale.";

                return false;

            }


            if (!this.form.title || !this.form.title.trim()) {

                this.message =
                    "Please enter a listing title.";

                return false;

            }


            if (!this.form.location || !this.form.location.trim()) {

                this.message =
                    "Please enter the specific location.";

                return false;

            }


            if (this.isLand) {

                if (!this.form.land_type) {

                    this.message =
                        "Please select the land type.";

                    return false;

                }


                if (!this.form.land_area) {

                    this.message =
                        "Please enter the land size.";

                    return false;

                }

            }

            else {

                if (!this.form.property_type_id) {

                    this.message =
                        "Please select the property type.";

                    return false;

                }

            }


            if (!this.form.price) {

                this.message =
                    "Please enter the property price.";

                return false;

            }


            if (!this.form.phone_number) {

                this.message =
                    "Please enter a contact phone number.";

                return false;

            }


            if (
                !this.form.description ||
                !this.form.description.trim()
            ) {

                this.message =
                    "Please add a description.";

                return false;

            }


            return true;

        },


        submit() {

            if (!this.validate()) {
                return;
            }


            this.loading = true;

            this.message = "";
            this.successMessage = "";


            /*
             * Clean up values that should not be sent
             * as part of a normal property update.
             */

            const payload = {
                ...this.form,

                media: this.form.media,

                images: undefined,

                addNewMedia: undefined
            };


            axios
                .put(
                    "/api/property/" + this.$route.params.id,
                    payload
                )

                .then((response) => {

                    console.log(response);

                    toast.fire({

                        title: "Property Updated",

                        text: "Your property has been updated successfully.",

                        icon: "success"

                    });


                    this.getData();

                    /*
                     * Redirect ONLY after successful update.
                     */
                    const roleId = Number(this.user.role_id);

                    if (roleId === 1 || roleId === 2) {

                    this.$router.push("/all-properties");

                    } else {

                    this.$router.push("/my-properties");

                    }

                })

                .catch((error) => {

                    console.error(error);

                    if (
                        error.response &&
                        error.response.data &&
                        error.response.data.message
                    ) {

                        this.message =
                            error.response.data.message;

                    }

                    else {

                        this.message =
                            "Something went wrong while updating the listing.";

                    }

                })

                .finally(() => {

                    this.loading = false;

                });

        },


        cancel() {

            this.$router.push(
                this.indexRoute || "/all-properties"
            );

        }

    },


    mounted() {

        this.loadLists();
        const storedUser =
        localStorage.getItem("user");
        this.user = JSON.parse(storedUser);
        this.form.phone_number =
          this.user.phone || "";
        this.getData();

    }

};

</script>


<style scoped>

/* ============================================================
   PAGE
============================================================ */

.listing-page {

    background: #f6f8fa;

    min-height: 100vh;

}


/* ============================================================
   HEADER
============================================================ */

.listing-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

}


.listing-header h3 {

    font-weight: 700;

    color: #1f2937;

}


/* ============================================================
   CARD
============================================================ */

.listing-card {

    background: #ffffff;

    border: 1px solid #e7ebee;

    border-radius: 18px;

    padding: 30px;

    box-shadow:
        0 3px 15px rgba(0, 0, 0, 0.03);

}


.card-heading {

    margin-bottom: 25px;

}


.card-heading h4 {

    margin: 5px 0 5px;

    font-weight: 700;

    color: #20262c;

}


.card-heading p {

    margin: 0;

    color: #7a858f;

}


.section-kicker {

    font-size: 11px;

    font-weight: 700;

    color: #198754;

    letter-spacing: 1px;

}


.section-divider {

    height: 1px;

    background: #edf0f2;

    margin: 35px 0;

}


/* ============================================================
   FORM
============================================================ */

.form-label {

    font-weight: 600;

    color: #343a40;

    margin-bottom: 9px;

}


.optional {

    font-size: 11px;

    font-weight: 500;

    color: #89929a;

    margin-left: 5px;

}


.form-control,
.form-select {

    border-color: #dce2e6;

}


.form-control:focus,
.form-select:focus {

    border-color: #198754;

    box-shadow:
        0 0 0 0.2rem rgba(25, 135, 84, 0.1);

}


/* ============================================================
   CHOICES
============================================================ */

.choice-grid {

    display: grid;

    grid-template-columns:
        repeat(2, minmax(0, 1fr));

    gap: 15px;

}


.choice-card {

    border: 1px solid #dfe5e8;

    background: #fff;

    border-radius: 13px;

    padding: 17px;

    text-align: left;

    display: flex;

    align-items: center;

    gap: 14px;

    transition: 0.2s ease;

}


.choice-card:hover {

    border-color: #198754;

    transform: translateY(-1px);

}


.choice-card.selected {

    border-color: #198754;

    background: #f0faf5;

}


.choice-icon {

    font-size: 28px;

}


.choice-card strong,
.choice-card small {

    display: block;

}


.choice-card small {

    color: #8a939b;

    margin-top: 3px;

}


/* ============================================================
   PHOTOS
============================================================ */

.existing-photo-grid {

    display: grid;

    grid-template-columns:
        repeat(auto-fill, minmax(180px, 1fr));

    gap: 15px;

}


.existing-photo {

    position: relative;

    border-radius: 12px;

    overflow: hidden;

    background: #f5f7f8;

    aspect-ratio: 4 / 3;

}


.existing-photo img {

    width: 100%;

    height: 100%;

    object-fit: cover;

    display: block;

}


.remove-photo {

    position: absolute;

    top: 8px;

    right: 8px;

    width: 32px;

    height: 32px;

    border: 0;

    border-radius: 50%;

    background: rgba(220, 53, 69, 0.95);

    color: #fff;

    font-size: 20px;

    line-height: 1;

}


.remove-photo:hover {

    background: #dc3545;

}


.empty-photos {

    text-align: center;

    padding: 35px;

    border: 1px dashed #cbd5d0;

    border-radius: 14px;

    color: #8a939b;

}


.add-media-box {

    border: 1px solid #e1e6e9;

    padding: 15px;

    border-radius: 11px;

    display: flex;

    align-items: center;

    gap: 12px;

    cursor: pointer;

}


.add-media-box span {

    display: flex;

    flex-direction: column;

}


.add-media-box small {

    color: #8a939b;

    margin-top: 3px;

}


.upload-box {

    border: 1px dashed #cbd5d0;

    border-radius: 15px;

    padding: 25px;

    background: #fbfdfc;

    margin-top: 15px;

}


/* ============================================================
   FEATURES
============================================================ */

.feature-grid {

    display: grid;

    grid-template-columns:
        repeat(3, minmax(0, 1fr));

    gap: 10px;

}


.feature-option {

    border: 1px solid #e0e5e8;

    border-radius: 10px;

    padding: 11px 13px;

    display: flex;

    align-items: center;

    gap: 9px;

    cursor: pointer;

    font-size: 13px;

    background: #fff;

    transition: 0.15s ease;

}


.feature-option:hover {

    border-color: #198754;

}


.feature-option.selected {

    border-color: #198754;

    background: #f2faf6;

}


.feature-option input {

    display: none;

}


.feature-check {

    width: 20px;

    height: 20px;

    border: 1px solid #cfd7dc;

    border-radius: 5px;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 12px;

    color: transparent;

}


.feature-option.selected .feature-check {

    background: #198754;

    border-color: #198754;

    color: #fff;

}


/* ============================================================
   PARKING
============================================================ */

.inline-options {

    display: flex;

    gap: 12px;

}


.mini-choice {

    min-width: 100px;

    border: 1px solid #dfe5e8;

    padding: 11px 17px;

    border-radius: 10px;

    cursor: pointer;

    text-align: center;

}


.mini-choice input {

    display: none;

}


.mini-choice.selected {

    border-color: #198754;

    background: #f2faf6;

    color: #198754;

    font-weight: 600;

}


/* ============================================================
   NEGOTIABLE
============================================================ */

.negotiable-box {

    border: 1px solid #e1e6e9;

    padding: 15px;

    border-radius: 11px;

    display: flex;

    align-items: center;

    gap: 12px;

    cursor: pointer;

}


.negotiable-box span {

    display: flex;

    flex-direction: column;

}


.negotiable-box small {

    color: #8a939b;

    margin-top: 3px;

}


/* ============================================================
   BUTTONS
============================================================ */

.wizard-actions {

    margin-top: 35px;

    padding-top: 22px;

    border-top: 1px solid #edf0f2;

    display: flex;

    justify-content: space-between;

    align-items: center;

}


/* ============================================================
   MOBILE
============================================================ */

@media (max-width: 768px) {

    .listing-card {

        padding: 20px;

    }


    .choice-grid {

        grid-template-columns: 1fr;

    }


    .feature-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }


    .existing-photo-grid {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }

}


@media (max-width: 480px) {

    .feature-grid {

        grid-template-columns: 1fr;

    }


    .existing-photo-grid {

        grid-template-columns: 1fr 1fr;

    }


    .wizard-actions {

        gap: 10px;

    }

}

</style>