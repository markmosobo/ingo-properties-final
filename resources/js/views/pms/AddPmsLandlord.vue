<template>
    <TheMaster>
        <div class="card px-2">
       <div class="card-body">
          <!-- General Form Elements -->
         <form @submit.prevent="submit">
         <fieldset v-if="step == 1">

            <h5 class="card-title text-center mb-4">Add Landlord</h5>

            <div class="row g-3">

               <!-- First Name -->
               <div class="col-md-6">
               <label class="form-label">First Name *</label>
               <input
                  type="text"
                  class="form-control"
                  placeholder="First Name"
                  v-model="form.first_name"
                  required
               />
               </div>

               <!-- Last Name -->
               <div class="col-md-6">
               <label class="form-label">Last Name *</label>
               <input
                  type="text"
                  class="form-control"
                  placeholder="Last Name"
                  v-model="form.last_name"
                  required
               />
               </div>

               <!-- Email -->
               <div class="col-md-6">
               <label class="form-label">Email Address</label>
               <input
                  type="email"
                  class="form-control"
                  placeholder="Email Address"
                  v-model="form.email"
               />
               </div>

               <!-- Phone -->
               <div class="col-md-6">
               <label class="form-label">Phone Number</label>
               <input
                  type="text"
                  class="form-control"
                  placeholder="Phone Number"
                  v-model="form.phone_no"
               />
               </div>

               <!-- Address -->
               <div class="col-md-6">
               <label class="form-label">Physical Address</label>
               <input
                  type="text"
                  class="form-control"
                  placeholder="Physical Address"
                  v-model="form.address"
               />
               </div>

               <!-- ID -->
               <div class="col-md-6">
               <label class="form-label">National ID Number</label>
               <input
                  type="text"
                  class="form-control"
                  placeholder="National ID Number"
                  v-model="form.id_number"
               />
               </div>

               <!-- Commission % -->
               <div class="col-md-6">
               <label class="form-label">Commission Percentage</label>
               <input
                  type="number"
                  class="form-control"
                  placeholder="e.g 8"
                  v-model="form.commission"
                  :disabled="disableCommission"
               />
               </div>

               <!-- Fixed Commission -->
               <div class="col-md-6">
               <label class="form-label">Fixed Commission</label>
               <input
                  type="number"
                  class="form-control"
                  placeholder="e.g 12000"
                  v-model="form.fixed_commission"
                  :disabled="disableFixedCommission"
               />
               </div>

            </div>

            <!-- Submit -->
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
 
 
          <!-- End General Form Elements -->
       </div>
    </div>
    </TheMaster>
    
 
 
    <!--  actual form -->
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
    form: {
      first_name: '',
      last_name: '',
      email: '',
      phone_no: '',
      address: '',
      id_number: '',

      commission: '',
      fixed_commission: ''
    },
    submitting: false,
    submitted: false,
    step: 1
       }   
    },
    computed: {
      disableCommission() {
         return this.form.fixed_commission !== '' && this.form.fixed_commission !== null;
      },
      disableFixedCommission() {
         return this.form.commission !== '' && this.form.commission !== null;
      }
    },
    watch: {
      'form.commission'(val) {
         if (val !== '' && val !== null) {
            this.form.fixed_commission = '';
         }
      },
      'form.fixed_commission'(val) {
         if (val !== '' && val !== null) {
            this.form.commission = '';
         }
      }
    },    
    methods: {
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
      async submit() {
      if (!this.form.commission && !this.form.fixed_commission) {
         toast.fire(
            'Error',
            'Enter either commission percentage OR fixed commission',
            'error'
         );
         return;
      }

      this.submitting = true;

      try {
         await this.submitForm();
         this.submitted = true;
      } catch (error) {
         console.error(error);
      } finally {
         this.submitting = false;
      }
      },
       async submitForm(){
          axios.post("api/landlords", this.form)
          .then(function (response) {
             console.log(response);
             // this.step = 1;
             toast.fire(
                'Success!',
                'Landlord added!',
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
          this.$router.push('/pmslandlords')
       }
 
    },
    mounted() {
    }
 
 }
 </script>
    
 
 
