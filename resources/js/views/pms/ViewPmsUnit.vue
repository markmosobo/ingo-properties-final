<template>
  <TheMaster>
    <div class="container mt-4">

      <div class="card shadow-sm border-0">
        <div class="card-body">

          <!-- Header -->
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">{{ form.unit_number }}</h4>

            <span
              v-if="form.status == 0"
              class="badge bg-warning text-dark"
            >
              Vacant
            </span>
            <span
              v-else-if="form.status == 1"
              class="badge bg-success"
            >
              Occupied
            </span>
            <span
              v-else
              class="badge bg-secondary"
            >
              Closed
            </span>
          </div>

          <!-- Property Info -->
          <div v-if="property" class="mb-3 text-muted">
            <strong>Property:</strong> {{ property.name }}
          </div>

          <hr />

          <!-- Unit Details -->
          <div class="row mb-3">
            <div class="col-md-6">
              <p><strong>Type:</strong> {{ form.type }}</p>
              <p><strong>Deposit:</strong> KES {{ form.deposit }}</p>
              <p><strong>Monthly Rent:</strong> KES {{ form.monthly_rent }}</p>
            </div>

            <div class="col-md-6">
              <p><strong>Security Fee:</strong> KES {{ form.security_fee }}</p>
              <p><strong>Garbage Fee:</strong> KES {{ form.garbage_fee }}</p>
              <p><strong>Water Deposit:</strong> KES {{ form.water_deposit }}</p>
              <p><strong>Electricity Deposit:</strong> KES {{ form.electricity_deposit }}</p>
            </div>
          </div>

          <hr />

          <!-- Meter Numbers -->
          <div class="mb-3">
            <h6 class="fw-bold">Meter Numbers</h6>
            <p class="mb-1">
              <strong>Electricity:</strong>
              {{ form.electricity_meter ?? 'N/A' }}
            </p>
            <p class="mb-0">
              <strong>Water:</strong>
              {{ form.water_meter ?? 'N/A' }}
            </p>
          </div>

          <hr />

          <!-- Tenants -->
          <div>
            <h6 class="fw-bold mb-2">Tenants</h6>

            <div v-if="tenants.length">
              <ul class="list-group list-group-flush">
                <li
                  class="list-group-item px-0"
                  v-for="tenant in tenants"
                  :key="tenant.id"
                >
                  <strong>
                    {{ tenant.first_name }} {{ tenant.last_name }}
                  </strong>
                  <br />
                  <small class="text-muted">
                    {{ formatPhone(tenant.phone_number) }} · {{ tenant.email_address }}
                  </small>
                </li>
              </ul>
            </div>

            <p v-else class="text-muted fst-italic mb-0">
              No tenant assigned to this unit
            </p>
          </div>

          <hr />

          <!-- Actions -->
          <div class="d-flex justify-content-end gap-2">
            <button class="btn btn-outline-secondary" @click="back">
              Back
            </button>
          </div>

        </div>
      </div>

    </div>
  </TheMaster>
</template>
    
 <script>
 import TheMaster from "@/components/dashboard/TheMaster.vue";

 import axios from "axios";
 import Swal from 'sweetalert2';

 
 const toast = Swal.mixin({
     toast: true,
     position: 'top-end',
     showConfirmButton: false,
     timer: 3000
 });
 
 window.toast = toast;
 
 export default {
    components : {
       TheMaster,
    },
    data () {
       return {
      form: {},
      property: null,
      tenants: [],
      message: "",
      successMessage: "",
      loading: false,
      step: 1, 
      roles: [],
       }   
    },
    methods: {
      formatPhone(phone) {
      if (!phone) return '';

      phone = String(phone).replace(/\D/g, '');

      if (phone.startsWith('0')) {
         return '+254' + phone.substring(1);
      }

      if (phone.startsWith('254')) {
         return '+' + phone;
      }

      if (phone.startsWith('+254')) {
         return phone;
      }

      return '+254' + phone;
      },
       //ID upload
       onChangePhoto(e) {
         console.log('loadings');
         let file = e.target.files[0];
         console.log(file)
         let reader = new FileReader();
         reader.onloadend = (file) => {
            // console.log('RESULT', reader.result)
            this.form.image = reader.result;
         }
         reader.readAsDataURL(file);
       },
         getUnit() {
         axios.get('/api/pmsunit/' + this.$route.params.id)
            .then((response) => {
               this.form = response.data.unit;
               this.property = response.data.property;
               this.tenants = response.data.tenants;
            });
         },       
       submit(){
          axios.put("/api/pmsunit/"+this.$route.params.id, this.form)
          .then(function (response) {
             console.log(response);
             // this.step = 1;
             toast.fire(
                'Success!',
                'Unit updated!',
                'success'
             )
          })
          .catch(function (error) {
             console.log(error);
             // Swal.fire(
             //    'error!',
             //    // phone_error + id_error + pass_number,
             //    'error'
             // )
          });
          this.$router.push('/pmsunits/'+this.form.pms_property_id)
       },
       back(){
         this.$router.push('/pmsunits/'+this.form.pms_property_id)
       }
 
    },
    mounted() {
      this.getUnit()
    }
 
 }
 </script>
    
 
 
