<template>
  <TheMaster>
    <div class="card px-2">
      <div class="card-body">

        <form @submit.prevent="submit">
          <fieldset v-if="step === 1">

            <h5 class="card-title text-center mb-4">
              Edit Landlord
            </h5>

            <div class="row g-3">

              <!-- hidden user -->
              <input type="hidden" v-model="form.user_id" />

              <div class="col-md-6">
                <label class="form-label">First Name *</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.first_name"
                  required
                />
              </div>

              <div class="col-md-6">
                <label class="form-label">Last Name *</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.last_name"
                  required
                />
              </div>

              <div class="col-md-6">
                <label class="form-label">Email Address</label>
                <input
                  type="email"
                  class="form-control"
                  v-model="form.email"
                />
              </div>

              <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.phone_no"
                />
              </div>

              <div class="col-md-6">
                <label class="form-label">Physical Address</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.address"
                />
              </div>

              <div class="col-md-6">
                <label class="form-label">National ID Number</label>
                <input
                  type="text"
                  class="form-control"
                  v-model="form.id_number"
                />
              </div>

              <!-- COMMISSION % -->
              <div class="col-md-6">
                <label class="form-label">
                  Commission Percentage (%)
                </label>
                <input
                  type="number"
                  min="0"
                  max="100"
                  step="0.01"
                  class="form-control"
                  placeholder="e.g 8"
                  v-model.number="form.commission"
                  :disabled="disableCommissionPercentage"
                />
              </div>

              <!-- FIXED COMMISSION -->
              <div class="col-md-6">
                <label class="form-label">
                  Fixed Commission (KES)
                </label>
                <input
                  type="number"
                  min="0"
                  step="0.01"
                  class="form-control"
                  placeholder="e.g 12000"
                  v-model.number="form.fixed_commission"
                  :disabled="disableFixedCommission"
                />
              </div>

            </div>

            <div class="d-flex justify-content-end mt-4">
              <button
                type="submit"
                class="btn btn-success rounded-pill px-4"
                :disabled="submitting"
              >
                <span v-if="!submitting">Submit</span>
                <span v-else>Submitting...</span>
              </button>
            </div>

          </fieldset>
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
  timer: 3000,
});

export default {
  components: { TheMaster },

  data() {
    return {
      step: 1,
      submitting: false,

      form: {
        user_id: 1,
        first_name: "",
        last_name: "",
        email: "",
        phone_no: "",
        address: "",
        id_number: "",

        // MUST match migration
        commission: null,        // decimal(8,2)
        fixed_commission: null,  // decimal(10,2)
      },
    };
  },

  computed: {
    // Disable % if fixed exists
    disableCommissionPercentage() {
      return this.form.fixed_commission > 0;
    },

    // Disable fixed if % exists
    disableFixedCommission() {
      return this.form.commission > 0;
    },
  },

  watch: {
    // If % is entered → clear fixed
    "form.commission"(val) {
      if (val > 0) {
        this.form.fixed_commission = null;
      }
    },

    // If fixed is entered → clear %
    "form.fixed_commission"(val) {
      if (val > 0) {
        this.form.commission = null;
      }
    },
  },

  methods: {
    async getLandlord() {
      try {
        const res = await axios.get(
          `/api/landlord/${this.$route.params.id}`
        );

        const landlord = res.data.landlord;

        this.form = {
          user_id: landlord.user_id,
          first_name: landlord.first_name,
          last_name: landlord.last_name,
          email: landlord.email,
          phone_no: landlord.phone_no,
          address: landlord.address,
          id_number: landlord.id_number,
          commission: landlord.commission,
          fixed_commission: landlord.fixed_commission,
        };
      } catch (error) {
        console.error(error);
      }
    },

    async submit() {
      this.submitting = true;

      try {
        await axios.put(
          `/api/landlord/${this.$route.params.id}`,
          this.form
        );

        toast.fire(
          "Success!",
          "Landlord updated successfully",
          "success"
        );

        this.$router.push("/pmslandlords");
      } catch (error) {
        console.error(error);
      } finally {
        this.submitting = false;
      }
    },
  },

  mounted() {
    this.getLandlord();
  },
};
</script>