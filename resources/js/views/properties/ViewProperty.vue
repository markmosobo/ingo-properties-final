<template>
    <TheMaster>
        <div class="container mt-3 mb-5">

            <!-- LOADING -->
            <div v-if="loading" class="text-center py-5">
                <div class="spinner-border text-success" role="status"></div>
                <p class="mt-2 text-muted">Loading property...</p>
            </div>

            <!-- PROPERTY -->
            <div v-else-if="property.id">

                <!-- HEADER -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">

                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">

                            <div>
                                <div class="mb-2">
                                    <span class="badge bg-success me-2">
                                        {{ categoryName }}
                                    </span>

                                    <span
                                        v-if="property.status == 0"
                                        class="badge bg-warning text-dark"
                                    >
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        Pending
                                    </span>

                                    <span
                                        v-else-if="property.status == 1"
                                        class="badge bg-success"
                                    >
                                        <i class="bi bi-check-circle me-1"></i>
                                        Approved
                                    </span>

                                    <span
                                        v-else
                                        class="badge bg-secondary"
                                    >
                                        Closed
                                    </span>
                                </div>

                                <h3 class="mb-1">
                                    {{ property.title }}
                                </h3>

                                <div class="text-muted">
                                    <i class="bi bi-geo-alt me-1"></i>
                                    {{ property.location || 'Location not specified' }}
                                </div>
                            </div>

                            <div class="text-md-end mt-3 mt-md-0">

                                <div class="property-price">
                                    KSh {{ formatPrice(property.price) }}
                                </div>

                                <small
                                    v-if="property.price_period"
                                    class="text-muted"
                                >
                                    {{ property.price_period }}
                                </small>

                                <div v-if="property.negotiable" class="mt-1">
                                    <span class="badge bg-light text-success border">
                                        Negotiable
                                    </span>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>


                <!-- IMAGE GALLERY -->
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">

                        <h5 class="card-title mb-3">
                            <i class="bi bi-images me-2"></i>
                            Property Photos
                        </h5>

                        <div
                            v-if="property.images && property.images.length"
                            class="row g-2"
                        >

                            <!-- MAIN IMAGE -->
                            <div class="col-lg-8">
                                <img
                                    :src="getPhoto() + property.images[0].name"
                                    class="gallery-main"
                                    alt="Property Image"
                                >
                            </div>

                            <!-- OTHER IMAGES -->
                            <div
                                v-if="property.images.length > 1"
                                class="col-lg-4"
                            >
                                <div class="row g-2">

                                    <div
                                        v-for="(image, index) in property.images.slice(1)"
                                        :key="image.id"
                                        class="col-6 col-lg-12"
                                    >
                                        <img
                                            :src="getPhoto() + image.name"
                                            class="gallery-small"
                                            :alt="'Property Image ' + (index + 2)"
                                        >
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div
                            v-else
                            class="text-center text-muted py-5"
                        >
                            <i class="bi bi-image fs-1"></i>
                            <p class="mt-2 mb-0">
                                No photos available for this listing.
                            </p>
                        </div>

                    </div>
                </div>


                <div class="row g-3">

                    <!-- LEFT COLUMN -->
                    <div class="col-lg-7">

                        <!-- PROPERTY INFORMATION -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-info-circle me-2"></i>
                                    Listing Information
                                </h5>

                                <div class="row">

                                    <div class="col-md-6 info-item">
                                        <span class="label">Property ID</span>
                                        <strong>#{{ property.id }}</strong>
                                    </div>

                                    <div class="col-md-6 info-item">
                                        <span class="label">Category</span>
                                        <strong>{{ categoryName }}</strong>
                                    </div>

                                    <div
                                        v-if="property.location"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Location</span>
                                        <strong>{{ property.location }}</strong>
                                    </div>

                                    <div
                                        v-if="property.address"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Address</span>
                                        <strong>{{ property.address }}</strong>
                                    </div>

                                    <div
                                        v-if="property.estate_name"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Estate</span>
                                        <strong>{{ property.estate_name }}</strong>
                                    </div>

                                    <div
                                        v-if="property.property_type_id"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Property Type</span>
                                        <strong>{{ property.property_type_id }}</strong>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- LAND DETAILS -->
                        <div
                            v-if="isLand"
                            class="card border-0 shadow-sm mb-3"
                        >
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-map me-2"></i>
                                    Land Details
                                </h5>

                                <div class="row">

                                    <div
                                        v-if="property.land_area"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Land Area</span>
                                        <strong>
                                            {{ property.land_area }} Acres
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.land_type"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Land Type</span>
                                        <strong>
                                            {{ property.land_type }}
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.property_use"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Property Use</span>
                                        <strong>
                                            {{ property.property_use }}
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.electricity"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Electricity</span>
                                        <strong class="text-success">
                                            <i class="bi bi-check-circle me-1"></i>
                                            Available
                                        </strong>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- BUILDING / HOUSE DETAILS -->
                        <div
                            v-if="!isLand"
                            class="card border-0 shadow-sm mb-3"
                        >
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-house me-2"></i>
                                    Property Details
                                </h5>

                                <div class="row">

                                    <div
                                        v-if="property.bedrooms"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Bedrooms</span>
                                        <strong>
                                            {{ property.bedrooms }}
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.bathrooms"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Bathrooms</span>
                                        <strong>
                                            {{ property.bathrooms }}
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.parking_space"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Parking</span>
                                        <strong>
                                            {{ property.parking_space }}
                                        </strong>
                                    </div>

                                    <div
                                        v-if="property.size"
                                        class="col-md-6 info-item"
                                    >
                                        <span class="label">Size</span>
                                        <strong>
                                            {{ property.size }}
                                        </strong>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- FEATURES -->
                        <div
                            v-if="activeFeatures.length"
                            class="card border-0 shadow-sm mb-3"
                        >
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-check2-square me-2"></i>
                                    Features & Amenities
                                </h5>

                                <div class="row">

                                    <div
                                        v-for="feature in activeFeatures"
                                        :key="feature.key"
                                        class="col-md-6 mb-2"
                                    >
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill text-success me-2"></i>
                                            {{ feature.label }}
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>


                        <!-- DESCRIPTION -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-file-text me-2"></i>
                                    Description
                                </h5>

                                <p
                                    v-if="property.description"
                                    class="description"
                                >
                                    {{ property.description }}
                                </p>

                                <p
                                    v-else
                                    class="text-muted mb-0"
                                >
                                    No description provided.
                                </p>

                            </div>
                        </div>

                    </div>


                    <!-- RIGHT COLUMN -->
                    <div class="col-lg-5">

                        <!-- PRICE CARD -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-cash-stack me-2"></i>
                                    Pricing
                                </h5>

                                <div class="pricing-box">

                                    <!-- SALE -->
                                    <template v-if="property.property_status === 'sale'">

                                        <div class="small text-muted">
                                            Asking Price
                                        </div>

                                        <div class="property-price">
                                            KSh {{ formatPrice(property.price) }}
                                        </div>

                                        <div
                                            v-if="property.negotiable"
                                            class="mt-2"
                                        >
                                            <span class="badge bg-success">
                                                Price Negotiable
                                            </span>
                                        </div>

                                    </template>

                                    <!-- RENT -->
                                    <template v-else-if="property.property_status === 'rent'">

                                        <div class="small text-muted">
                                            Rental Price
                                        </div>

                                        <div class="property-price">
                                            KSh {{ formatPrice(property.price) }}
                                        </div>

                                        <div class="text-muted">
                                            Per {{ property.price_period || 'Month' }}
                                        </div>

                                        <div
                                            v-if="property.negotiable"
                                            class="mt-2"
                                        >
                                            <span class="badge bg-success">
                                                Price Negotiable
                                            </span>
                                        </div>

                                    </template>

                                    <!-- FALLBACK -->
                                    <template v-else>

                                        <div class="small text-muted">
                                            Price
                                        </div>

                                        <div class="property-price">
                                            KSh {{ formatPrice(property.price) }}
                                        </div>

                                    </template>

                                </div>

                            </div>
                        </div>


                        <!-- STATUS -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-bar-chart me-2"></i>
                                    Listing Status
                                </h5>

                                <div class="status-row">
                                    <span>Status</span>

                                    <span
                                        v-if="property.status == 0"
                                        class="badge bg-warning text-dark"
                                    >
                                        Pending
                                    </span>

                                    <span
                                        v-else-if="property.status == 1"
                                        class="badge bg-success"
                                    >
                                        Approved
                                    </span>

                                    <span
                                        v-else
                                        class="badge bg-secondary"
                                    >
                                        Closed
                                    </span>
                                </div>

                                <div class="status-row">
                                    <span>Featured</span>

                                    <span
                                        v-if="property.featured"
                                        class="badge bg-warning text-dark"
                                    >
                                        Yes
                                    </span>

                                    <span
                                        v-else
                                        class="badge bg-light text-dark border"
                                    >
                                        No
                                    </span>
                                </div>

                            </div>
                        </div>


                        <!-- ACTIVITY -->
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-clock-history me-2"></i>
                                    Activity
                                </h5>

                                <div class="activity-item">
                                    <i class="bi bi-plus-circle text-success"></i>

                                    <div>
                                        <strong>Listing Created</strong>

                                        <div class="text-muted small">
                                            {{ formatDate(property.created_at) }}
                                        </div>
                                    </div>
                                </div>

                                <div class="activity-item">
                                    <i class="bi bi-pencil-square text-primary"></i>

                                    <div>
                                        <strong>Last Updated</strong>

                                        <div class="text-muted small">
                                            {{ formatDate(property.updated_at) }}
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <!-- CONTACT -->
                        <div
                            v-if="property.phone_number"
                            class="card border-0 shadow-sm mb-3"
                        >
                            <div class="card-body">

                                <h5 class="card-title">
                                    <i class="bi bi-telephone me-2"></i>
                                    Contact
                                </h5>

                                <div class="phone-box">
                                    <div class="small text-muted">
                                        Contact Number
                                    </div>

                                    <strong>
                                        {{ property.phone_number }}
                                    </strong>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <!-- ERROR / EMPTY -->
            <div
                v-else
                class="card border-0 shadow-sm"
            >
                <div class="card-body text-center py-5">

                    <i class="bi bi-exclamation-circle fs-1 text-muted"></i>

                    <h5 class="mt-3">
                        Property not found
                    </h5>

                    <p class="text-muted mb-0">
                        The property could not be loaded.
                    </p>

                </div>
            </div>

        </div>
    </TheMaster>
</template>


<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";

export default {
    components: {
        TheMaster,
    },

    data() {
        return {
            loading: true,

            property: {
                images: []
            },

            /*
             * Keep this mapping here for now.
             * Later we can replace category IDs with
             * the actual category name returned by /api/lists.
             */
            categories: {
                1: "House for Rent",
                2: "House for Sale",
                3: "Apartment for Rent",
                4: "Apartment for Sale",
                5: "Land for Rent",
                6: "Land for Sale",
            },

            featureList: [
                {
                    key: "electricity",
                    label: "Electricity"
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
                    label: "Prepaid Meter"
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

        /*
         * Categories 5 and 6 are land.
         */
        isLand() {
            return [5, 6].includes(Number(this.property.category_id));
        },

        categoryName() {
            return (
                this.categories[this.property.category_id] ||
                "Property"
            );
        },

        /*
         * Only display features whose value is 1/true.
         */
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

        formatPrice(price) {
            if (!price) {
                return "—";
            }

            return Number(price).toLocaleString("en-KE");
        },

        formatDate(date) {
            if (!date) {
                return "—";
            }

            return new Date(date).toLocaleString("en-KE", {
                day: "2-digit",
                month: "short",
                year: "numeric",
                hour: "2-digit",
                minute: "2-digit"
            });
        },

        getData() {

            this.loading = true;

            axios.get("/api/property/" + this.$route.params.id)
                .then((response) => {

                    this.property = response.data.property || {
                        images: []
                    };

                    /*
                     * Safety fallback in case API returns no images.
                     */
                    if (!this.property.images) {
                        this.property.images = [];
                    }

                    console.log("data", this.property);

                })
                .catch((error) => {

                    console.error(
                        "Unable to load property:",
                        error
                    );

                    this.property = {
                        images: []
                    };

                })
                .finally(() => {

                    this.loading = false;

                });
        }
    },

    mounted() {
        this.getData();
    }
};
</script>


<style scoped>

.property-price {
    font-size: 1.35rem;
    font-weight: 700;
    color: #198754;
}

.gallery-main {
    width: 100%;
    height: 430px;
    object-fit: cover;
    border-radius: 8px;
    display: block;
}

.gallery-small {
    width: 100%;
    height: 135px;
    object-fit: cover;
    border-radius: 8px;
    display: block;
}

.info-item {
    padding: 12px 10px;
    border-bottom: 1px solid #eee;
}

.info-item .label {
    display: block;
    font-size: 0.78rem;
    color: #6c757d;
    margin-bottom: 3px;
}

.info-item strong {
    font-size: 0.95rem;
}

.feature-item {
    padding: 8px 0;
}

.description {
    white-space: pre-line;
    line-height: 1.7;
    color: #495057;
}

.pricing-box {
    background: #f8f9fa;
    padding: 18px;
    border-radius: 8px;
}

.status-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.status-row:last-child {
    border-bottom: none;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #eee;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-item > i {
    font-size: 1.2rem;
}

.phone-box {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
}

.card-title {
    font-weight: 600;
}

@media (max-width: 991px) {

    .gallery-main {
        height: 350px;
    }

    .gallery-small {
        height: 150px;
    }
}

@media (max-width: 575px) {

    .gallery-main {
        height: 280px;
    }

    .gallery-small {
        height: 110px;
    }

}

</style>