<template>
  <div class="listing-page">
    <div class="container-fluid px-2 px-md-4 py-3">

      <!-- Header -->
      <div class="listing-header mb-4">
        <div>
          <h3 class="mb-1">Create a Listing</h3>
          <p class="text-muted mb-0">
            Add a few details and publish your property.
          </p>
        </div>
      </div>

      <!-- Progress -->
      <div class="progress-card mb-4">
        <div class="step-progress">

          <div
            v-for="item in steps"
            :key="item.number"
            class="progress-step"
            :class="{
              active: step === item.number,
              completed: step > item.number
            }"
          >
            <div class="step-circle">
              <span v-if="step > item.number">✓</span>
              <span v-else>{{ item.number }}</span>
            </div>

            <div class="step-label">
              <strong>{{ item.title }}</strong>
              <small>{{ item.subtitle }}</small>
            </div>
          </div>

        </div>
      </div>


      <form @submit.prevent="submit">

        <!-- =====================================================
             STEP 1
        ====================================================== -->
        <div v-show="step === 1" class="listing-card">

          <div class="card-heading">
            <div>
              <span class="section-kicker">STEP 1 OF 5</span>
              <h4>Let's start with the basics</h4>
              <p>Tell us what you're listing and where it is.</p>
            </div>
          </div>

          <!-- Category -->
          <div class="form-section">

            <label class="form-label">
              What are you listing?
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

            <small class="form-hint">
              Choose the category that best describes your property.
            </small>

          </div>


          <!-- Location -->
          <div class="form-section">

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


          <!-- Status -->
          <div class="form-section">

            <label class="form-label">
              What are you doing with this property?
            </label>

            <div class="choice-grid">

              <button
                v-if="allowRent"
                type="button"
                class="choice-card"
                :class="{ selected: form.property_status === 'rent' }"
                @click="form.property_status = 'rent'"
              >
                <span class="choice-icon">🏠</span>
                <span>
                  <strong>For Rent</strong>
                  <small>I'm looking for a tenant</small>
                </span>
              </button>

              <button
                v-if="allowSale"
                type="button"
                class="choice-card"
                :class="{ selected: form.property_status === 'sale' }"
                @click="form.property_status = 'sale'"
              >
                <span class="choice-icon">🏷️</span>
                <span>
                  <strong>For Sale</strong>
                  <small>I'm looking for a buyer</small>
                </span>
              </button>

            </div>

          </div>


          <!-- Social -->
          <div class="form-section">

            <label class="form-label">
              Social media link
              <span class="optional">Optional</span>
            </label>

            <input
              type="url"
              v-model="form.social_link"
              class="form-control form-control-lg"
              placeholder="https://facebook.com/..."
            />

            <small class="form-hint">
              Add a Facebook, Instagram or other social media link if you have one.
            </small>

          </div>


          <!-- Navigation -->
          <div class="wizard-actions">

            <div></div>

            <button
              type="button"
              class="btn btn-success rounded-pill px-4"
              @click="next"
            >
              Continue
              <span class="ms-2">→</span>
            </button>

          </div>

        </div>


        <!-- =====================================================
             STEP 2 - PHOTOS
        ====================================================== -->
        <div v-show="step === 2" class="listing-card">

          <div class="card-heading">
            <div>
              <span class="section-kicker">STEP 2 OF 5</span>
              <h4>Add photos</h4>
              <p>
                Good photos help people understand your property quickly.
              </p>
            </div>
          </div>


          <div class="photo-tip">

            <div class="tip-icon">
              📷
            </div>

            <div>
              <strong>Take clear, well-lit photos</strong>

              <p class="mb-0">
                Show the outside, main rooms and important features.
                You can upload multiple photos.
              </p>
            </div>

          </div>


          <!-- EXISTING UPLOADER - LEFT UNCHANGED -->
          <div class="upload-box">

            <label class="form-label mb-3">
              Property photos
            </label>

            <Uploader
              server="/api/posts/media/upload"
              @change="changeMedia"
            />

          </div>


          <div class="wizard-actions">

            <button
              type="button"
              class="btn btn-outline-secondary rounded-pill px-4"
              @click="prev"
            >
              ← Back
            </button>

            <button
              type="button"
              class="btn btn-success rounded-pill px-4"
              @click="next"
            >
              Continue →
            </button>

          </div>

        </div>


        <!-- =====================================================
             STEP 3 - PROPERTY DETAILS
        ====================================================== -->
        <div v-show="step === 3" class="listing-card">

          <div class="card-heading">
            <div>
              <span class="section-kicker">STEP 3 OF 5</span>

              <h4>
                Tell us about the property
              </h4>

              <p>
                These details help potential buyers or tenants understand
                what you're offering.
              </p>
            </div>
          </div>


          <!-- ================= LAND ================= -->
          <template v-if="isLand">

            <div class="row g-4">

              <div class="col-md-6">
                <label class="form-label">
                  Listing title
                </label>

                <input
                  type="text"
                  v-model="form.title"
                  class="form-control form-control-lg"
                  placeholder="e.g. 2 Acres Prime Farmland"
                />
              </div>


              <div class="col-md-6">
                <label class="form-label">
                  Specific location
                </label>

                <input
                  type="text"
                  v-model="form.location"
                  class="form-control form-control-lg"
                  placeholder="e.g. Kakamega, near..."
                />
              </div>


              <div class="col-md-6">

                <label class="form-label">
                  Land type
                </label>

                <select
                  v-model="form.land_type"
                  class="form-select form-select-lg"
                >
                  <option value="">Select land type</option>
                  <option>Commercial Land</option>
                  <option>Farmland</option>
                  <option>Industrial Land</option>
                  <option>Mixed-Use Land</option>
                  <option>Quarry</option>
                  <option>Residential Land</option>
                </select>

              </div>


              <div class="col-md-6">

                <label class="form-label">
                  Intended use
                </label>

                <select
                  v-model="form.property_use"
                  class="form-select form-select-lg"
                >
                  <option value="">Select intended use</option>
                  <option>Commercial</option>
                  <option>Mixed</option>
                  <option>Residential</option>
                </select>

              </div>


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

            </div>

          </template>


          <!-- ================= PROPERTY ================= -->
          <template v-else>

            <div class="row g-4">

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

                <small class="form-hint">
                  Keep it short and descriptive.
                </small>

              </div>


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


              <div class="col-md-6">

                <label class="form-label">
                  Estate / Building name
                  <span class="optional">Optional</span>
                </label>

                <input
                  type="text"
                  v-model="form.estate_name"
                  class="form-control form-control-lg"
                  placeholder="Estate or building name"
                />

              </div>


              <!-- Bedrooms -->
              <div class="col-md-6">

                <label class="form-label">
                  Bedrooms
                </label>

                <select
                  v-model="form.bedrooms"
                  class="form-select form-select-lg"
                >
                  <option value="">Select</option>
                  <option v-for="n in 10" :key="n" :value="String(n)">
                    {{ n }}
                  </option>
                  <option value="10+">10+</option>
                </select>

              </div>


              <!-- Bathrooms -->
              <div class="col-md-6">

                <label class="form-label">
                  Bathrooms
                </label>

                <select
                  v-model="form.bathrooms"
                  class="form-select form-select-lg"
                >
                  <option value="">Select</option>
                  <option v-for="n in 10" :key="n" :value="String(n)">
                    {{ n }}
                  </option>
                  <option value="10+">10+</option>
                </select>

              </div>

            </div>

          </template>


          <div class="wizard-actions">

            <button
              type="button"
              class="btn btn-outline-secondary rounded-pill px-4"
              @click="prev"
            >
              ← Back
            </button>

            <button
              type="button"
              class="btn btn-success rounded-pill px-4"
              @click="next"
            >
              Continue →
            </button>

          </div>

        </div>


        <!-- =====================================================
             STEP 4
        ====================================================== -->
        <div v-show="step === 4" class="listing-card">

          <div class="card-heading">

            <div>

              <span class="section-kicker">
                STEP 4 OF 5
              </span>

              <h4>
                Features, price & contact
              </h4>

              <p>
                Add the information people need before contacting you.
              </p>

            </div>

          </div>


          <!-- LAND -->
          <template v-if="isLand">

            <div class="row g-4">

              <div class="col-md-6">

                <label class="form-label">
                  Price
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


              <div class="col-md-6">

                <label class="form-label">
                  Contact phone
                </label>

                <input
                  type="tel"
                  v-model="form.phone_number"
                  class="form-control form-control-lg"
                />

                <small class="form-hint">
                  This is automatically taken from your account.
                </small>

              </div>


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


              <div class="col-12">

                <label class="negotiable-box">

                  <input
                    type="checkbox"
                    v-model="form.negotiable"
                    class="form-check-input"
                  />

                  <span>
                    <strong>Price is negotiable</strong>
                    <small>Let interested buyers know that you're open to discussion.</small>
                  </span>

                </label>

              </div>

            </div>

          </template>


          <!-- PROPERTY -->
          <template v-else>

            <!-- Facilities -->
            <div class="form-section">

              <label class="form-label">
                What does the property have?
              </label>

              <div class="feature-grid">

                <label
                  v-for="feature in features"
                  :key="feature.key"
                  class="feature-option"
                  :class="{ selected: form[feature.key] }"
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

            </div>


            <!-- Parking -->
            <div class="form-section">

              <label class="form-label">
                Parking available?
              </label>

              <div class="inline-options">

                <label
                  class="mini-choice"
                  :class="{ selected: String(form.parking_space) === '1' }"
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
                  :class="{ selected: String(form.parking_space) === '2' }"
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


            <!-- Price -->
            <div class="row g-4">

              <div class="col-md-6">

                <label class="form-label">
                  Price
                </label>

                <div class="input-group input-group-lg">

                  <span class="input-group-text">
                    KSh
                  </span>

                  <input
                    type="number"
                    v-model="form.price"
                    class="form-control"
                    placeholder="e.g. 25000"
                  />

                </div>

              </div>


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
                  <option value="Month">Per Month</option>
                  <option value="Quarter">Per Quarter</option>
                  <option value="Year">Per Year</option>
                </select>

              </div>


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


              <div class="col-12">

                <label class="negotiable-box">

                  <input
                    type="checkbox"
                    v-model="form.negotiable"
                    class="form-check-input"
                  />

                  <span>
                    <strong>Price is negotiable</strong>
                    <small>Let people know you're open to offers.</small>
                  </span>

                </label>

              </div>


              <div class="col-12">

                <label class="form-label">
                  Description
                </label>

                <textarea
                  v-model="form.description"
                  rows="5"
                  class="form-control"
                  placeholder="Describe the property, its condition, neighbourhood, nearby facilities and anything else a buyer or tenant should know."
                ></textarea>

              </div>

            </div>

          </template>


          <div class="wizard-actions">

            <button
              type="button"
              class="btn btn-outline-secondary rounded-pill px-4"
              @click="prev"
            >
              ← Back
            </button>

            <button
              type="button"
              class="btn btn-success rounded-pill px-4"
              @click="next"
            >
              Review Listing →
            </button>

          </div>

        </div>


        <!-- =====================================================
             STEP 5 - REVIEW
        ====================================================== -->
        <div v-show="step === 5" class="listing-card">

          <div class="card-heading">

            <div>

              <span class="section-kicker">
                STEP 5 OF 5
              </span>

              <h4>
                Review your listing
              </h4>

              <p>
                Everything look good? Publish your listing.
              </p>

            </div>

          </div>


          <!-- Summary -->
          <div class="review-card">

            <div class="review-row">

              <span>Category</span>

              <strong>
                {{ categoryName }}
              </strong>

            </div>


            <div class="review-row">

              <span>Listing status</span>

              <strong>
                {{ form.property_status === 'sale' ? 'For Sale' : 'For Rent' }}
              </strong>

            </div>


            <div class="review-row">

              <span>Title</span>

              <strong>
                {{ form.title || 'Not provided' }}
              </strong>

            </div>


            <div class="review-row">

              <span>Location</span>

              <strong>
                {{ form.location || selectedLocationName || 'Not provided' }}
              </strong>

            </div>


            <div class="review-row">

              <span>Price</span>

              <strong>
                KSh {{ formattedPrice }}
                <span v-if="form.property_status === 'rent'">
                  / {{ pricePeriodLabel }}
                </span>
              </strong>

            </div>


            <div class="review-row">

              <span>Contact</span>

              <strong>
                {{ form.phone_number || 'Not provided' }}
              </strong>

            </div>

          </div>


          <!-- Description -->
          <div class="review-section">

            <h6>Description</h6>

            <p>
              {{ form.description || 'No description provided.' }}
            </p>

          </div>


          <!-- Photos -->
          <div class="review-section">

            <h6>Photos</h6>

            <div class="photo-count">

              <span class="photo-count-icon">
                📷
              </span>

              <span>
                {{ form.media.length }} photo(s) uploaded
              </span>

            </div>

          </div>


          <!-- Confirmation -->
          <div class="publish-notice">

            <div class="notice-icon">
              ✓
            </div>

            <div>

              <strong>Ready to publish?</strong>

              <p class="mb-0">
                Your listing will be submitted with the information above.
              </p>

            </div>

          </div>


          <div
            v-if="message"
            class="alert alert-danger mt-4"
          >
            {{ message }}
          </div>


          <div
            v-if="successMessage"
            class="alert alert-success mt-4"
          >
            {{ successMessage }}
          </div>


          <div class="wizard-actions">

            <button
              type="button"
              class="btn btn-outline-secondary rounded-pill px-4"
              @click="prev"
              :disabled="loading"
            >
              ← Back
            </button>


            <button
              type="submit"
              class="btn btn-success rounded-pill px-5"
              :disabled="loading"
            >

              <span
                v-if="loading"
                class="spinner-border spinner-border-sm me-2"
              ></span>

              {{ loading ? 'Publishing...' : 'Publish Listing' }}

            </button>

          </div>

        </div>

      </form>

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


  data() {

    return {

      user: [],

      step: 1,

      loading: false,

      message: "",

      successMessage: "",


      steps: [
        {
          number: 1,
          title: "Basics",
          subtitle: "Category & location"
        },
        {
          number: 2,
          title: "Photos",
          subtitle: "Show your property"
        },
        {
          number: 3,
          title: "Details",
          subtitle: "Property information"
        },
        {
          number: 4,
          title: "Price",
          subtitle: "Features & contact"
        },
        {
          number: 5,
          title: "Review",
          subtitle: "Publish"
        }
      ],


      categories: [],

      propertytypes: [],

      locations: [],


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

        media: [],

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

        wifi: false

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

    },


    categoryName() {

      const category = this.categories.find(
        item => String(item.id) === String(this.form.category_id)
      );

      return category ? category.name : "Not selected";

    },


    selectedLocationName() {

      const location = this.locations.find(
        item => String(item.id) === String(this.form.location_id)
      );

      return location ? location.name : "";

    },


    formattedPrice() {

      if (!this.form.price) {
        return "Not provided";
      }

      return Number(this.form.price).toLocaleString();

    },


    pricePeriodLabel() {

      const labels = {
        Month: "month",
        Quarter: "quarter",
        Year: "year"
      };

      return labels[this.form.price_period] || "month";

    }

  },


  methods: {


    categoryChanged() {

      /*
       * Automatically select the only valid status
       * where the category restricts it.
       */

      if (this.isRentCategory && !this.isSaleCategory) {

        this.form.property_status = "rent";

      } else if (this.isSaleCategory && !this.isRentCategory) {

        this.form.property_status = "sale";

      } else if (
        this.form.property_status !== "rent" &&
        this.form.property_status !== "sale"
      ) {

        this.form.property_status = "";

      }

    },


    next() {

      this.message = "";

      if (!this.validateStep()) {
        return;
      }

      if (this.step < 5) {
        this.step++;
        window.scrollTo({
          top: 0,
          behavior: "smooth"
        });
      }

    },


    prev() {

      this.message = "";

      if (this.step > 1) {

        this.step--;

        window.scrollTo({
          top: 0,
          behavior: "smooth"
        });

      }

    },


    validateStep() {

      if (this.step === 1) {

        if (!this.form.category_id) {
          this.message = "Please select a category.";
          return false;
        }

        if (!this.form.location_id) {
          this.message = "Please select a location.";
          return false;
        }

        if (!this.form.property_status) {
          this.message = "Please select whether the property is for rent or sale.";
          return false;
        }

      }


      if (this.step === 2) {

        if (!this.form.media || this.form.media.length === 0) {

          this.message =
            "Please upload at least one photo before continuing.";

          return false;

        }

      }


      if (this.step === 3) {

        if (!this.form.title.trim()) {

          this.message = "Please enter a listing title.";
          return false;

        }

        if (!this.form.location.trim()) {

          this.message = "Please enter the specific location.";
          return false;

        }


        if (this.isLand) {

          if (!this.form.land_type) {

            this.message = "Please select the land type.";
            return false;

          }

          if (!this.form.land_area) {

            this.message = "Please enter the land size.";
            return false;

          }

        } else {

          if (!this.form.property_type_id) {

            this.message = "Please select the property type.";
            return false;

          }

        }

      }


      if (this.step === 4) {

        if (!this.form.price) {

          this.message = "Please enter the property price.";
          return false;

        }

        if (!this.form.phone_number) {

          this.message = "Please enter a contact phone number.";
          return false;

        }

        if (!this.form.description.trim()) {

          this.message = "Please add a description.";
          return false;

        }

      }


      return true;

    },


    changeMedia(media) {

      this.form.media = media;

    },


    loadLists() {

      axios
        .get("api/lists")
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


    submit() {

      if (!this.validateStep()) {
        return;
      }


      this.loading = true;

      this.message = "";

      this.successMessage = "";


      axios
        .post("api/properties", this.form)

        .then((response) => {

          console.log(response);

          this.loading = false;

          toast.fire(
            "Success!",
            "Property added successfully!",
            "success"
          );


          /*
           * IMPORTANT:
           * Navigation happens only after the API succeeds.
           */

            /*
            * Redirect based on the logged-in user's role.
            *
            * role_id 1 or 2:
            * → all-properties
            *
            * Any other role:
            * → my-properties
            */

            const roleId = Number(this.user.role_id);

            if (roleId === 1 || roleId === 2) {

            this.$router.push("/all-properties");

            } else {

            this.$router.push("/my-properties");

            }

        })

        .catch((error) => {

          this.loading = false;

          console.error(error);


          if (
            error.response &&
            error.response.data &&
            error.response.data.message
          ) {

            this.message =
              error.response.data.message;

          } else {

            this.message =
              "Something went wrong while publishing the listing. Please try again.";

          }

        });

    }

  },


  mounted() {

    this.loadLists();


    const storedUser =
      localStorage.getItem("user");


    if (storedUser) {

      try {

        this.user = JSON.parse(storedUser);

        this.form.created_by =
          this.user.id;

        this.form.phone_number =
          this.user.phone || "";

      } catch (error) {

        console.error(
          "Unable to read logged-in user.",
          error
        );

      }

    }

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
   PROGRESS
============================================================ */

.progress-card {
  background: #ffffff;
  border: 1px solid #e8ecef;
  border-radius: 16px;
  padding: 20px;
}

.step-progress {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
}

.step-progress::before {
  content: "";
  position: absolute;
  top: 19px;
  left: 8%;
  right: 8%;
  height: 2px;
  background: #e9ecef;
  z-index: 0;
}

.progress-step {
  position: relative;
  z-index: 1;
  display: flex;
  align-items: center;
  gap: 10px;
  background: #fff;
  padding: 0 8px;
}

.step-circle {
  width: 38px;
  height: 38px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #e9ecef;
  color: #6c757d;
  font-weight: 700;
}

.progress-step.active .step-circle,
.progress-step.completed .step-circle {
  background: #198754;
  color: #fff;
}

.step-label {
  display: flex;
  flex-direction: column;
  line-height: 1.2;
}

.step-label strong {
  font-size: 13px;
}

.step-label small {
  color: #8a939b;
  font-size: 11px;
}


/* ============================================================
   CARD
============================================================ */

.listing-card {
  background: #ffffff;
  border: 1px solid #e7ebee;
  border-radius: 18px;
  padding: 30px;
  box-shadow: 0 3px 15px rgba(0, 0, 0, 0.03);
}

.card-heading {
  margin-bottom: 30px;
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


/* ============================================================
   FORM
============================================================ */

.form-section {
  margin-bottom: 28px;
}

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
  box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.1);
}

.form-hint {
  display: block;
  margin-top: 7px;
  color: #8a939b;
  font-size: 12px;
}


/* ============================================================
   CHOICES
============================================================ */

.choice-grid {
  display: grid;
  grid-template-columns: repeat(2, minmax(0, 1fr));
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
   PHOTO UPLOAD
============================================================ */

.photo-tip {
  display: flex;
  align-items: flex-start;
  gap: 14px;
  padding: 16px;
  border-radius: 12px;
  background: #f3f8f5;
  margin-bottom: 25px;
}

.tip-icon {
  font-size: 25px;
}

.photo-tip strong {
  display: block;
  margin-bottom: 4px;
}

.photo-tip p {
  color: #68727b;
  font-size: 13px;
}

.upload-box {
  border: 1px dashed #cbd5d0;
  border-radius: 15px;
  padding: 25px;
  background: #fbfdfc;
}


/* ============================================================
   FEATURES
============================================================ */

.feature-grid {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
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
   REVIEW
============================================================ */

.review-card {
  border: 1px solid #e1e6e9;
  border-radius: 14px;
  overflow: hidden;
}

.review-row {
  display: flex;
  justify-content: space-between;
  gap: 20px;
  padding: 15px 18px;
  border-bottom: 1px solid #edf0f2;
}

.review-row:last-child {
  border-bottom: 0;
}

.review-row span {
  color: #7d8790;
}

.review-row strong {
  text-align: right;
  color: #252b30;
}

.review-section {
  margin-top: 25px;
}

.review-section h6 {
  font-weight: 700;
}

.review-section p {
  color: #68727b;
  line-height: 1.7;
}

.photo-count {
  display: inline-flex;
  align-items: center;
  gap: 10px;
  background: #f3f8f5;
  padding: 11px 15px;
  border-radius: 10px;
}

.photo-count-icon {
  font-size: 20px;
}

.publish-notice {
  display: flex;
  gap: 13px;
  align-items: flex-start;
  background: #f3f8f5;
  border-radius: 12px;
  padding: 17px;
  margin-top: 25px;
}

.notice-icon {
  width: 28px;
  height: 28px;
  background: #198754;
  color: #fff;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
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

  .step-progress::before {
    display: none;
  }

  .step-label {
    display: none;
  }

  .progress-step {
    background: transparent;
    padding: 0;
  }

  .step-progress {
    justify-content: space-between;
  }

  .choice-grid {
    grid-template-columns: 1fr;
  }

  .feature-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
  }

  .review-row {
    flex-direction: column;
    gap: 5px;
  }

  .review-row strong {
    text-align: left;
  }

}


@media (max-width: 480px) {

  .feature-grid {
    grid-template-columns: 1fr;
  }

  .wizard-actions {
    gap: 10px;
  }

}

</style>