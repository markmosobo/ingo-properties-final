<template>
    <TheMaster>
        <div class="card px-2">
       <div class="card-body">
          <!-- General Form Elements -->
          <form @submit.prevent="">
          <fieldset v-if="step == 1">
             <h5 class="card-title text-center">Add user</h5>
 
             <div class="row m-auto p-auto justify-content- g-3 needs-validation" novalidate="" autocomplete="off">
                <div class="row  mb-3"></div>
 
                <div class="row mb-3"></div>
                <div class="form-group row">
                   <input
                      type="hidden"
                      id="user_id"
                      name="user_id"
                      value="1"
                      class="form-control"
                   />
                    <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">First Name*</label>
                      <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="First Name"
                            id="first_name"
                            name="first_name"
                            v-model="form.first_name"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback" v-if="!form.first_name">Please enter first name!</div>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Last Name</label>
                      <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="Last Name"
                            id="last_name"
                            name="last_name"
                            v-model="form.last_name"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback" v-if="!form.last_name">Please enter last name!</div>
                      </div>
                   </div>
 
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                   <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Email Address</label>
                      <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="Email Address"
                            id="email"
                            name="email"
                            v-model="form.email"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback" v-if="!form.email">Please enter email address!</div>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <label for="validationCustom04" class="form-label"
                      >Role</label
                      >
                      <div class="col-sm-10">
                         <select name="role" v-model="form.role_id" class="form-select" id="role">
                            <option value="0" selected>Select Role</option>
                            <option v-for="role in roles" :value="role.id"
                            :selected="role.id == form.role_id" :key="role.id">{{ role.name}}</option>
 
                         </select>
 
                        <div class="invalid-feedback" v-if="!form.role_id">Please select role!</div>
                      </div>
                   </div>

                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                   <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Phone Number</label>
                      <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="Phone Number"
                            id="phone_number"
                            name="phone_number"
                            v-model="form.phone_number"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback" v-if="!form.phone_number">Please enter phone number!</div>
                      </div>
                   </div>

                </div>

             </div>

          <p class="mt-3">Users should change it after first time login. The default password is: <strong>{{defaultPassword}}</strong></p>
          <p>To change default password click<h7 @click="changeDefaultPassword"> here</h7></p>

             <!--  button -->
             <div class="col-lg-12 felx mt-4 row">
                <div class="col-sm-6 col-lg-6">
                    <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                </div>
                <div class="col-sm-6 col-lg-6 text-end">
                    <button type="submit" @click.prevent="submit()" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-sm btn-primary rounded-pill">Submit</button>
                </div>
            </div>
          </fieldset>
 
          </form>

          <!-- Modal -->
           <div class="modal fade" id="settleTenantModal" tabindex="-1" aria-labelledby="settleTenantModalLabel" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="settleTenantModalLabel">Change Default Password</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">
                   <p>
                     <div class="row">
                       <div class="col-sm-12">
                         <strong>Default Password:</strong>
                         <input type="text" name="default_password" v-model="form.default_password" class="form-control">
                         <div v-if="errors.password" class="text-danger">{{ errors.password }}</div>
                       </div>
                     </div>    
                   </p>

                   

                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click.prevent="confirmChangePassword">Update</button>
                 </div>
               </div>
             </div>
           </div>
 
 
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
          role_id: '',
          title: '',
          default_password: ''
          
          },
          defaultPassword: '',
          errors: {
            password: '',
          },
          loading: false,
          message: "",
          successMessage: "",
          loading: false,
          step: 1, 
          roles: [],
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
       loadLists() {
          axios.get('api/lists').then((response) => {
          this.roles = response.data.lists.roles;
          this.defaultPassword = response.data.lists.defaultPassword.default_password;
          this.form.default_password = this.defaultPassword;
 
          });
       },
       changeDefaultPassword()
       {
         const modal = new bootstrap.Modal(document.getElementById('settleTenantModal'));
            modal.show();
       },
       confirmChangePassword() {
           // Validate amount
          if (!this.form.default_password) {
            this.errors.password = 'Password field is required.';
            return;
          }
          if (this.form.default_password) {
            // Implement your logic to invoice the tenant here
             axios.put("api/defaultpassword", this.form)
             .then(function (response) {
                console.log(response);
                // this.step = 1;
                toast.fire(
                   'Success!',
                   'Default password updated!',
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
            // Close the modal after invoicing
            const modal = bootstrap.Modal.getInstance(document.getElementById('settleTenantModal'));
            modal.hide();
            //reset form
            this.loadLists()
          }
        },
       validateForm() {
          let isValid = true;
          if (!this.form.first_name) {
              isValid = false;
              document.getElementById('first_name').classList.add('is-invalid');
          } else {
              document.getElementById('first_name').classList.remove('is-invalid');
          }
          if (!this.form.last_name) {
              isValid = false;
              document.getElementById('last_name').classList.add('is-invalid');
          } else {
              document.getElementById('last_name').classList.remove('is-invalid');
          }
          if (!this.form.phone_number) {
              isValid = false;
              document.getElementById('phone_number').classList.add('is-invalid');
          } else {
              document.getElementById('phone_number').classList.remove('is-invalid');
          }
          if (!this.form.email) {
              isValid = false;
              document.getElementById('email').classList.add('is-invalid');
          } else {
              document.getElementById('email').classList.remove('is-invalid');
          }
          if (!this.form.role_id) {
              isValid = false;
              document.getElementById('role').classList.add('is-invalid');
          } else {
              document.getElementById('role').classList.remove('is-invalid');
          }
          return isValid;
       },
       submit(){
        if (this.validateForm()) {                         
          axios.post("api/users", this.form)
          .then(function (response) {
             console.log(response);
             // this.step = 1;
             toast.fire(
                'Success!',
                'User added!',
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
          this.$router.push('/all-users')
         }
       }
 
    },
    mounted() {
       this.loadLists();
    }
 
 }
 </script>
    
 
 
 <style lang="css" scoped>
 /*Profile Pic Start*/
 .picture-container {
    position: relative;
    cursor: pointer;
    text-align: center;
 }
 
 .picture {
    width: 106px;
    height: 106px;
    background-color: #99999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
 }
 
 .picture:hover {
    border-color: #2ca8ff;
 }
 
 .content.ct-wizard-green .picture:hover {
    border-color: #05ae0e;
 }
 
 .content.ct-wizard-blue .picture:hover {
    border-color: #3472f7;
 }
 
 .content.ct-wizard-orange .picture:hover {
    border-color: #ff9500;
 }
 
 .content.ct-wizard-red .picture:hover {
    border-color: #ff3b30;
 }
 
 .picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
 }
 
 .picture-src {
    width: 100%;
 
 }</style>