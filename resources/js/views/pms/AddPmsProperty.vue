<template>
  <TheMaster>
    <div class="card px-2">
      <div class="card-body">

        <form @submit.prevent="submit">

          <h5 class="card-title text-center">Add Property</h5>

          <div class="row g-3">

            <!-- NAME -->
            <div class="col-sm-6">
              <label class="form-label">Name *</label>
              <input
                type="text"
                class="form-control"
                v-model="form.name"
                required
              />
            </div>

            <!-- UNITS -->
            <div class="col-sm-6">
              <label class="form-label">Number of Units *</label>
              <input
                type="number"
                class="form-control"
                v-model="form.units_no"
                required
              />
            </div>

            <!-- LANDLORD -->
            <div class="col-sm-6">
              <label class="form-label">
                Landlord
                <small>
                  (if not listed, click
                  <strong @click="addLandlord">here</strong>)
                </small>
              </label>

              <select v-model="form.landlord_id" class="form-select">
                <option value="" disabled>Select Landlord</option>
                <option
                  v-for="l in landlords"
                  :key="l.id"
                  :value="l.id"
                >
                  {{ l.first_name }} {{ l.last_name }}
                </option>
              </select>
            </div>

            <!-- COMMISSION MODE -->
            <div class="col-sm-12">
              <label class="form-label">Commission Setup</label>

              <select v-model="form.use_override" class="form-select">
                <option :value="false">
                  Use landlord commission (default)
                </option>
                <option :value="true">
                  Override commission for this property
                </option>
              </select>

              <small class="text-muted">
                Landlord has default commission unless overridden here.
              </small>
            </div>

            <!-- OVERRIDE SECTION -->
            <div v-if="form.use_override" class="row g-3">

              <!-- TYPE -->
              <div class="col-sm-6">
                <label class="form-label">Commission Type</label>
                <select
                  v-model="form.commission_type"
                  class="form-select"
                >
                  <option value="percentage">Percentage (%)</option>
                  <option value="fixed">Fixed Amount (KES)</option>
                </select>
              </div>

              <!-- PERCENTAGE -->
              <div class="col-sm-6" v-if="isPercentage">
                <label class="form-label">% Commission</label>
                <input
                  type="number"
                  step="0.01"
                  class="form-control"
                  v-model.number="form.commission"
                  placeholder="e.g 5"
                />
              </div>

              <!-- FIXED -->
              <div class="col-sm-6" v-if="isFixed">
                <label class="form-label">Fixed Commission (KES)</label>
                <input
                  type="number"
                  step="0.01"
                  class="form-control"
                  v-model.number="form.fixed_commission"
                  placeholder="e.g 12000"
                />
              </div>

            </div>

          </div>

          <!-- BUTTON -->
          <div class="text-end mt-4">
            <button
              type="submit"
              class="btn rounded-pill"
              style="background-color: darkgreen; border-color: darkgreen;"
              :disabled="submitting"
            >
              <span v-if="!submitting">Submit</span>
              <span v-else>Submitting...</span>
            </button>
          </div>

        </form>

      </div>
    </div>
  </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import axios from "axios";
import Swal from "sweetalert2";

const toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 3000
});

export default {
  components: { TheMaster },

  data() {
    return {
      form: {
        name: "",
        units_no: "",
        landlord_id: "",

        // COMMISSION SYSTEM
        use_override: false,
        commission_type: "percentage",
        commission: null,
        fixed_commission: null,

        created_by: "",
        property_status: "",
        media: []
      },

      landlords: [],
      submitting: false
    };
  },

  computed: {
    isPercentage() {
      return this.form.commission_type === "percentage";
    },

    isFixed() {
      return this.form.commission_type === "fixed";
    }
  },

  watch: {
    // disable override resets everything
    "form.use_override"(val) {
      if (!val) {
        this.form.commission = null;
        this.form.fixed_commission = null;
        this.form.commission_type = "percentage";
      }
    },

    // switch types resets opposite field
    "form.commission_type"(val) {
      if (val === "percentage") {
        this.form.fixed_commission = null;
      }

      if (val === "fixed") {
        this.form.commission = null;
      }
    }
  },

  methods: {
    addLandlord() {
      this.$router.push("/add-pmslandlord");
    },

    async submit() {
      this.submitting = true;

      // FINAL SAFETY CLEANUP
      if (!this.form.use_override) {
        this.form.commission = null;
        this.form.fixed_commission = null;
        this.form.commission_type = null;
      }

      if (this.form.use_override && this.form.commission_type === "percentage") {
        this.form.fixed_commission = null;
      }

      if (this.form.use_override && this.form.commission_type === "fixed") {
        this.form.commission = null;
      }

      try {
        const res = await axios.post("api/pmsproperties", this.form);

        toast.fire("Success!", "Property added!", "success");

        this.$router.push("/pmsunits/" + res.data.property.id);

      } catch (err) {
        console.log(err);
      } finally {
        this.submitting = false;
      }
    },

    loadLists() {
      axios.get("api/lists/landlords").then(res => {
        this.landlords = res.data.landlords;
      });
    }
  },

  mounted() {
    this.loadLists();

    const user = JSON.parse(localStorage.getItem("user"));
    this.form.created_by = user.id;
  }
};
</script>

<style scoped>
.card-title {
  font-weight: 600;
}
</style>