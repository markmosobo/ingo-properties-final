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
                      <h5 class="card-title">All Listings <span>| Today</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-property" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Listing
                          </a>
                      </router-link>
            
                      </p>
    
                      <table id="AllPropertiesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price(KES)</th>
                            <th scope="col">Location</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <!-- LOADING -->
                          <tr v-if="loading">
                            <td colspan="6" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading listings...</div>
                            </td>
                          </tr>

                          <!-- EMPTY STATE -->
                          <tr v-else-if="!properties.length">
                            <td colspan="6" class="text-center text-muted py-4">
                              No listings available.
                            </td>
                          </tr>

                          <!-- DATA -->
                          <tr v-else v-for="property in properties" :key="property.id">

                            <!-- IMAGE -->
                            <td>
                              <img
                                v-if="property.images?.length"
                                :src="getPhoto() + property.images[0].name"
                                style="width:60px;height:45px;object-fit:cover;border-radius:6px;"
                              />
                              <span v-else class="text-muted small">No image</span>
                            </td>

                            <td>{{ property.title }}</td>

                            <td>{{ property.price?.toLocaleString() ?? '0' }}</td>

                            <td>{{ property.location }}</td>

                            <td>
                              <span v-if="property.status == 0" class="badge bg-warning text-dark">
                                Pending
                              </span>

                              <span v-else-if="property.status == 1" class="badge bg-success">
                                Approved
                              </span>

                              <span v-else class="badge bg-light text-dark">
                                Closed
                              </span>
                            </td>

                            <td>
                              <div class="btn-group">

                                <button
                                  type="button"
                                  class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
                                  data-bs-toggle="dropdown"
                                >
                                  Action
                                </button>

                                <div class="dropdown-menu">

                                  <a
                                    v-if="property.created_by == user.id"
                                    @click="navigateTo('/editproperty/' + property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-pencil-line me-2 text-primary"></i>
                                    Edit
                                  </a>

                                  <a
                                    v-if="property.status == 0"
                                    @click="approveProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-check-line me-2 text-success"></i>
                                    Approve
                                  </a>

                                  <a
                                    v-if="property.featured == 0 && property.status == 1"
                                    @click="featureProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-star-line me-2 text-warning"></i>
                                    Feature
                                  </a>

                                  <a
                                    v-if="property.featured == 1 && property.status == 1"
                                    @click="unfeatureProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-star-fill me-2 text-warning"></i>
                                    Unfeature
                                  </a>

                                  <a
                                    v-if="property.status == 1"
                                    @click="closeProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-close-circle-line me-2 text-danger"></i>
                                    Close
                                  </a>

                                  <a
                                    v-if="property.status == 2"
                                    @click="reopenProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-refresh-line me-2 text-info"></i>
                                    Reopen
                                  </a>

                                  <a
                                    @click="deleteProperty(property.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-delete-bin-line me-2 text-danger"></i>
                                    Delete
                                  </a>

                                </div>

                              </div>
                            </td>

                          </tr>

                        </tbody>
                      </table>
    
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
          properties: [],
          categories: [],
          propertytypes: [],
          user: [],
          loading: false,
        }
      },
      methods: {
        getPhoto()
        {
            return "/storage/properties/";
        },
        navigateTo(location){
            this.$router.push(location)
        },
        approveProperty(id){
          axios.put('api/approveproperty/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Property has been approved',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        featureProperty(id){
          axios.put('api/featureproperty/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Property has been featured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        unfeatureProperty(id){
          axios.put('api/unfeatureproperty/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Property has been unfeatured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        closeProperty(id){
          axios.put('api/closeproperty/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Property has been closed',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        reopenProperty(id){
          axios.put('api/reopenproperty/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Property has been reopened',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deleteProperty(id){
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
                  axios.delete('/api/property/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Property has been deleted.',
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
        loadLists() {
          this.loading = true;

          axios.get('api/lists/listings')
            .then((response) => {
              this.categories = response.data.categories;
              this.propertytypes = response.data.propertytypes;
              this.properties = response.data.properties;

                    setTimeout(() => {
                          $("#AllPropertiesTable").DataTable();
                      }, 10);

            })
            .finally(() => {
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
    
    
    