<template>
    <TheMaster>
    <div class="container mt-3">
       <div class="row">
         <div class="col-lg-6">             
         <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{form.unit_number}}</h5>
               <p class="card-text">
                  <strong>Full Name:</strong> {{form.first_name}} {{form.last_name}} <br>
                  <strong>ID Number:</strong> {{form.id_number}} <br>
                  <strong>Phone:</strong> {{form.phone_number}}<br>
                  <strong>Property:</strong> {{property}}<br>
                  <strong>Unit:</strong> {{unit}}<br>
                  <strong>Status: </strong>
                  <span v-if="form.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Vacated</span>   
                  <span v-else-if="form.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Renting</span>
                  <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed </span>                  
               </p>
            </div>
          </div>
         </div> 
<!--          <div class="col-lg-6">             
         <div class="card">
            <div class="card-body">
              <h5 class="card-title">Meter Numbers</h5>
               <p class="card-text">
                  <strong>Electricity:</strong> {{form.electricity_meter ?? 'N/A'}} <br>
                  <strong>Water:</strong> {{form.water_meter ?? 'N/A'}} <br>
  
               </p>              
            </div>
          </div>
         </div>  -->         
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
          role_id: '',
          title: '',
          
          },
          message: "",
          successMessage: "",
          loading: false,
          step: 1, 
          roles: [],
          property: '',
          unit: ''
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
        getTenant() {
             axios.get('/api/pmstenant/'+this.$route.params.id).then((response) => {
     
             this.form = response.data.tenant;
             this.property = this.form.property.name;
             this.unit = this.form.unit.unit_number;
             console.log("props", this.form)
    
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
      this.getTenant()
    }
 
 }
 </script>
    
 
 
