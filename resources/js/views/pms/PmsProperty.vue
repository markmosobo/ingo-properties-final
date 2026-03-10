<template>
  <TheMaster>
<div class="container mt-4">

  <!-- Property + Landlord Card -->
  <div class="card mb-4 shadow-sm border-0">
    <div class="card-body d-flex flex-wrap justify-content-between">

      <!-- Left: Property Info -->
      <div class="flex-fill me-3 mb-3">
        <h4 class="card-title mb-2">{{ property.name }}</h4>
        <div class="d-flex flex-wrap gap-2">
          <span class="badge bg-primary">
            <i class="bi bi-key me-1"></i> ID: {{ property.id }}
          </span>
          <span class="badge bg-info text-dark">
            <i class="bi bi-building me-1"></i> Units: {{ property.units_no }}
          </span>
          <span class="badge bg-warning text-dark">
            <i class="bi bi-percent me-1"></i>
            <span v-if="property.commission !== null">
              {{ property.commission }}%
            </span>
            <span v-else-if="property.fixed_commission !== null">
              KES {{ property.fixed_commission }}
            </span>
            <span v-else>Not Set</span>
          </span>
        </div>
      </div>

      <!-- Right: Landlord Info -->
      <div class="flex-fill mb-3" v-if="property.landlord && property.landlord.first_name">
        <h5 class="card-title mb-2">Landlord</h5>
        <p class="mb-1"><i class="bi bi-person-fill me-1"></i> {{ property.landlord.first_name }} {{ property.landlord.last_name }}</p>
        <p v-if="property.landlord.email" class="mb-1"><i class="bi bi-envelope-fill me-1"></i> {{ property.landlord.email }}</p>
        <p v-if="property.landlord.phone_no" class="mb-0"><i class="bi bi-telephone-fill me-1"></i> {{ property.landlord.phone_no }}</p>
      </div>

    </div>
  </div>

  <!-- Property Images -->
  <div v-if="property.images && property.images.length > 0" class="card mb-4 shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title mb-3">Property Images</h5>
      <div class="row g-3">
        <div v-for="(image, index) in property.images" :key="index" class="col-md-3 col-sm-6">
          <img :src="getImagePath(image)" class="img-fluid rounded shadow-sm" alt="Property Image">
        </div>
      </div>
    </div>
  </div>
  <div v-else class="mb-4 text-center text-muted fst-italic">
    No images available
  </div>

  <!-- Units Table -->
  <div class="card shadow-sm border-0">
    <div class="card-body">
      <h5 class="card-title mb-3">Units</h5>
      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Unit</th>
              <th>Type</th>
              <th>Deposit</th>
              <th>Monthly Rent</th>
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
                <span :class="unit.status === 1 ? 'badge bg-success' : 'badge bg-danger'">
                  {{ unit.status === 1 ? 'Active' : 'Inactive' }}
                </span>
              </td>
            </tr>
            <tr v-if="!property.units.length">
              <td colspan="5" class="text-center text-muted fst-italic">
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
  components: {
    TheMaster,
  },

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
        landlord: {
          first_name: "",
          last_name: "",
          email: "",
          phone_no: "",
        },
      },
    };
  },

  methods: {
    getImagePath(path) {
      return path ? "/storage/properties/" + path : "";
    },

    getData(){
      axios.get('/api/pmsproperty/'+this.$route.params.id, {
      }).then((response) => {
          this.property = response.data.property
          // console.log(response)
          console.log("data", this.property)
      })
    }
  },

  mounted() {
    this.getData();
  },
};
</script>