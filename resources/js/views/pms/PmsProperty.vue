<template>
  <TheMaster>
    <div class="container mt-4">

      <!-- PROPERTY CARD -->
      <div class="card mb-4 shadow-sm border-0">
        <div class="card-body d-flex flex-wrap justify-content-between">

          <!-- LEFT -->
          <div class="flex-fill me-3 mb-3">
            <h4 class="card-title mb-2">{{ property.name }}</h4>

            <div class="d-flex flex-wrap gap-2">

              <span class="badge bg-primary">
                ID: {{ property.id }}
              </span>

              <span class="badge bg-info text-dark">
                Units: {{ property.units_no }}
              </span>

              <span
                class="badge d-flex align-items-center gap-1"
                :class="commissionBadgeClass"
              >
                <i class="bi" :class="commissionIcon"></i>

                <span>
                  <strong>Commission:</strong>
                  {{ formattedCommission.label }}

                </span>
              </span>

            </div>
          </div>

          <!-- RIGHT (LANDLORD) -->
          <div
            class="flex-fill mb-3"
            v-if="property.landlord"
          >
            <h5 class="mb-2">Landlord</h5>

            <p class="mb-1">
              {{ property.landlord.first_name }}
              {{ property.landlord.last_name }}
            </p>

            <p v-if="property.landlord.email" class="mb-1">
              {{ property.landlord.email }}
            </p>

            <p v-if="property.landlord.phone_no">
              {{ property.landlord.phone_no }}
            </p>
          </div>

        </div>
      </div>

      <!-- IMAGES -->
      <div v-if="property.images.length" class="card mb-4 shadow-sm border-0">
        <div class="card-body">
          <h5 class="mb-3">Property Images</h5>

          <div class="row g-3">
            <div
              v-for="(image, i) in property.images"
              :key="i"
              class="col-md-3 col-sm-6"
            >
              <img
                :src="getImagePath(image)"
                class="img-fluid rounded shadow-sm"
              />
            </div>
          </div>
        </div>
      </div>

      <!-- UNITS -->
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="mb-3">Units</h5>

          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Unit</th>
                  <th>Type</th>
                  <th>Deposit</th>
                  <th>Rent</th>
                  <th>Status</th>
                </tr>
              </thead>

              <tbody>
                <tr v-for="unit in property.units" :key="unit.id">
                  <td>{{ unit.unit_number }}</td>
                  <td>{{ unit.type }}</td>
                  <td>KES {{ unit.deposit }}</td>
                  <td>KES {{ unit.monthly_rent }}</td>
                  <td>
                    <span
                      :class="unit.status === 1
                        ? 'badge bg-success'
                        : 'badge bg-danger'"
                    >
                      {{ unit.status === 1 ? 'Active' : 'Inactive' }}
                    </span>
                  </td>
                </tr>

                <tr v-if="!property.units.length">
                  <td colspan="5" class="text-center text-muted">
                    No units found
                  </td>
                </tr>
              </tbody>

            </table>
          </div>

        </div>
      </div>

    </div>
  </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import axios from "axios";

export default {
  components: { TheMaster },

  data() {
    return {
      property: {
        id: null,
        name: "",
        units_no: 0,
        commission: null,
        fixed_commission: null,
        images: [],
        units: [],
        landlord: {}
      }
    };
  },

  computed: {
    // CLEAN FORMATTED DISPLAY
    formattedCommission() {
      const c = this.property.commission;
      const f = this.property.fixed_commission;

      if (c !== null) {
        return {
          label: `${c}%`,
          type: "percentage"
        };
      }

      if (f !== null) {
        return {
          label: `KES ${Number(f).toLocaleString()}`,
          type: "fixed"
        };
      }

      return {
        label: "Not Set",
        type: "none"
      };
    },

    // ICON
    commissionIcon() {
      switch (this.formattedCommission.type) {
        case "percentage":
          return "bi-percent";
        case "fixed":
          return "bi-cash-coin";
        default:
          return "bi-dash-circle";
      }
    },

    // BADGE COLOR
    commissionBadgeClass() {
      switch (this.formattedCommission.type) {
        case "percentage":
          return "bg-success";
        case "fixed":
          return "bg-primary";
        default:
          return "bg-secondary";
      }
    }
  },

  methods: {
    getImagePath(img) {
      return img ? "/storage/properties/" + img.name : "";
    },

    getData() {
      axios
        .get("/api/pmsproperty/" + this.$route.params.id)
        .then(res => {
          this.property = res.data.property;
        });
    }
  },

  mounted() {
    this.getData();
  }
};
</script>