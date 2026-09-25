<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">All Testimonials <span>| Only approved testimonials appear on website</span></h5>
                      <p class="card-text">
                   
                      <router-link to="#" custom v-slot="{ href, navigate, isActive }">
                        <a
                          :href="href"
                          :class="{ active: isActive }"
                           @click="openModal"
                          class="btn btn-sm btn-primary rounded-pill me-2"
                          style="background-color: darkgreen; border-color: darkgreen;"
                        >
                          Add Testimonial
                        </a>
                      </router-link>
            
                      </p> 
    
                      <table id="AllTestimonialsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <!-- <th scope="col">Preview</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Label</th>
                            <th scope="col">Body</th>
                            <th scope="col">Status</th>
                            <th scope="col">Added On</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <!-- SPINNER -->
                          <tr v-if="loading">
                            <td colspan="6" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading testimonials...</div>
                            </td>
                          </tr>

                          <!-- DATA -->
                          <tr v-else v-for="user in testimonials" :key="user.id">
                            <td>{{user.full_name}}</td>
                            <td>{{user.label}}</td>
                            <td>{{user.body ?? 'N/A'}}</td>

                            <td>
                              <span v-if="user.status == 0" class="badge bg-warning text-dark">
                                <i class="bi bi-exclamation-triangle me-1"></i> Pending
                              </span>

                              <span v-else-if="user.status == 1" class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i> Approved
                              </span>

                              <span v-else class="badge bg-light text-dark">
                                <i class="bi bi-star me-1"></i> Inactive
                              </span>
                            </td>

                            <td>{{ format_date(user.created_at) }}</td>

                            <td>
                              <div class="btn-group" role="group">
                                <button type="button"
                                  class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
                                  data-toggle="dropdown">
                                  Action
                                </button>

                                <div class="dropdown-menu">
                                  <a @click="editModal(user)" class="dropdown-item">
                                    <i class="ri-pencil-fill mr-2"></i>Edit
                                  </a>

                                  <a v-if="user.status == 0"
                                    @click="approveTestimonial(user.id)"
                                    class="dropdown-item">
                                    <i class="ri-check-fill mr-2"></i>Approve
                                  </a>

                                  <a @click="deleteTestimonial(user.id)" class="dropdown-item">
                                    <i class="ri-delete-bin-line mr-2"></i>Delete
                                  </a>
                                </div>
                              </div>
                            </td>
                          </tr>

                        </tbody>
                      </table>
    
                    </div>

                 <!-- Add Testimonial Modal -->
                <div class="modal fade" id="addTestimonialModal" tabindex="-1" role="dialog" aria-labelledby="addTestimonialModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addTestimonialModalLabel">Add Testimonial</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                        <!-- Full Name Field -->
                        <div class="form-group">
                          <label for="fullName"><strong>Full Name:</strong></label>
                          <input 
                            type="text" 
                            id="fullName" 
                            v-model="form.full_name" 
                            placeholder="Enter full name" 
                            class="form-control"
                          />
                          <div v-if="errors.full_name" class="text-danger">{{ errors.full_name }}</div>
                        </div>

                        <!-- Label Field -->
                        <div class="form-group">
                          <label for="label"><strong>Label:</strong></label>
                          <input 
                            type="text" 
                            id="label" 
                            v-model="form.label" 
                            placeholder="Enter label (e.g., 'CEO, Tech Corp')" 
                            class="form-control"
                          />
                          <div v-if="errors.label" class="text-danger">{{ errors.label }}</div>
                        </div>

                        <!-- Testimonial Body Field -->
                        <div class="form-group">
                          <label for="body"><strong>Testimonial:</strong></label>
                          <textarea 
                            id="body" 
                            v-model="form.body" 
                            placeholder="Write the testimonial..." 
                            class="form-control" 
                            rows="4"
                          ></textarea>
                          <div v-if="errors.body" class="text-danger">{{ errors.body }}</div>
                        </div>
                      </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal">Close</button>
                        <button type="button" @click="submitTestimonial" class="btn btn-primary" style="background-color: darkgreen; border-color: darkgreen;">Save</button>
                      </div>
                    </div>
                  </div>
                </div>

                <!--Edit Testimonial Modal -->
                <div class="modal fade" id="EditTestimonialModal" tabindex="-1" aria-labelledby="EditTestimonialModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="EditTestimonialModalLabel">Edit Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Full Name Field -->
                        <div class="form-group">
                          <label for="fullName"><strong>Full Name:</strong></label>
                          <input 
                            type="text" 
                            id="fullName" 
                            v-model="form.full_name" 
                            placeholder="Enter full name" 
                            class="form-control"
                          />
                          <div v-if="errors.full_name" class="text-danger">{{ errors.full_name }}</div>
                        </div>

                        <!-- Label Field -->
                        <div class="form-group">
                          <label for="label"><strong>Label:</strong></label>
                          <input 
                            type="text" 
                            id="label" 
                            v-model="form.label" 
                            placeholder="Enter label (e.g., 'CEO, Tech Corp')" 
                            class="form-control"
                          />
                          <div v-if="errors.label" class="text-danger">{{ errors.label }}</div>
                        </div>

                        <!-- Testimonial Body Field -->
                        <div class="form-group">
                          <label for="body"><strong>Testimonial:</strong></label>
                          <textarea 
                            id="body" 
                            v-model="form.body" 
                            placeholder="Write the testimonial..." 
                            class="form-control" 
                            rows="4"
                          ></textarea>
                          <div v-if="errors.body" class="text-danger">{{ errors.body }}</div>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click.prevent="confirmEditTestimonial">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

    
                  </div>
                </div><!-- End Top Selling -->
    
            </div>
        </section>
    </TheMaster>
    </template>
    
    <script>
     import TheMaster from "@/components/dashboard/TheMaster.vue";
     import axios from "axios";
    import Swal from 'sweetalert2';
    import "jquery/dist/jquery.min.js";
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    import moment from 'moment';

    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    
    window.toast = toast;
    
    export default {
      data(){
        return {
          testimonials: [],
          loading: false,
          user: [],
          form: {
            full_name: '',
            label: '',
            body: ''
          },
          errors: {
            full_name: '',
            label: '',
            body: ''
          },
          defaultPassword: ''
        }
      },
      methods: {
         openModal() {
          // $('#addInvoiceModal').modal('show'); // Show the modal using jQuery
          const modal = new bootstrap.Modal(document.getElementById('addTestimonialModal'));
          modal.show();
        },
        closeModal() {
          // $('#addInvoiceModal').modal('hide'); // Hide the modal using jQuery
          const modal = bootstrap.Modal.getInstance(document.getElementById('addTestimonialModal'));
          modal.hide();
        },
        editModal(user)
        {
          this.selectedTestimonial = user;
          this.form.body = user.body;
          this.form.full_name = user.full_name;
          this.form.label = user.label;
          // Show the modal after fetching data
            const modal = new bootstrap.Modal(document.getElementById('EditTestimonialModal'));
            modal.show();
        },
        confirmEditTestimonial() {
          let payload = {
              body: this.form.body,
              full_name: this.form.full_name,
              label: this.form.label,
          };

          axios.put("/api/edit-testimonial/" + this.selectedTestimonial.id, payload)
              .then(response => {
                  console.log(response);
                  toast.fire(
                      'Success!',
                      'Testimonial updated!',
                      'success'
                  );
              })
              .catch(error => {
                  console.log(error);
              })
              .finally(() => {
                  // Reference the modal instance directly and hide it
                  const modalElement = document.getElementById('EditTestimonialModal');
                  const modalInstance = bootstrap.Modal.getInstance(modalElement);
                  if (modalInstance) {
                      modalInstance.hide();
                  }
                  this.loadLists();
              });
      },



        submitTestimonial() {

            // Axios PUT request to invoice the tenant
            axios.post('/api/testimonial', this.form)
              .then(response => {
                toast.fire(
                  'Success!',
                  'Testimonial saved!',
                  'success'
                );
              })
              .catch(error => {
                console.error(error);

                // Display error toast notification
                toast.fire(
                  'Error!',
                  'An error occurred while saving the testimonial.',
                  'error'
                );
              })
              .finally(() => {

                // // Close the modal after invoicing
                const modal = bootstrap.Modal.getInstance(document.getElementById('addTestimonialModal'));
                modal.hide();

                // Reset form fields
                this.form.full_name = '';
                this.form.label = '';
                this.form.body = '';

                // Reload the lists (loadLists ensures updated data is fetched)
                this.loadLists();
              });
        },
        approveTestimonial(id){
          axios.put('/api/approvetestimonial/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Testimonial has been approved',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deleteTestimonial(id){
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  axios.delete('/api/testimonial/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Testimonial has been deleted.',
                    'success'
                  )
                  this.loadLists();
                  }).catch(() => {
                    Swal.fire(
                    'Failed!',
                    'There was something wrong.',
                    'warning'
                  )
                  }); 
                  }else if(result.isDenied) {
                    console.log('cancelled')
                  }
                                   
                })
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        resetPassword(user)
        {
          const modal = new bootstrap.Modal(document.getElementById('settleTenantModal'));
            modal.show();
        },
        confirmResetPassword()
        {

        },
        getPhoto()
        {
            return "testimonials/";
        },
        navigateTo(location){
            this.$router.push(location)
        },
        activateUser(id){
          axios.put('api/activateuser/'+ id).then(() => {
            toast.fire(
              'Successful',
              'User has been activated',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deactivateUser(id){
          axios.put('api/deactivateuser/'+ id).then(() => {
            toast.fire(
              'Successful',
              'User has been deactivated',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        loadLists() {
          this.loading = true;

          axios.get('api/lists/testimonials').then((response) => {
            this.testimonials = response.data.testimonials;
            this.defaultPassword = response.data.defaultPassword.default_password;

            console.log(this.testimonials);

            setTimeout(() => {
              $("#AllTestimonialsTable").DataTable();
            }, 10);

          }).finally(() => {
            this.loading = false;
          });
        },
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.loadLists();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);

      }
    }
    </script>
    
    
    