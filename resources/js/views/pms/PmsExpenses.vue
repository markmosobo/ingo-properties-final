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
                      <h5 class="card-title">All Expenses <span>| Today</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-pmsexpense" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Tenant
                          </a>
                      </router-link>
            
                      </p>
    
                      <table id="AllPropertiesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Amount(KES)</th>
                            <th scope="col">Description</th>
                            <th scope="col">House No.</th>
                            <th scope="col">Unit No</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="property in properties" :key="property.id">
                            <td>{{property.title}}</td>
                            <td>{{(property.price).toLocaleString()}}</td>
                            <td>{{property.location}}</td>
                            <td>{{property.location}}</td>
                            <td>{{(property.price).toLocaleString()}}</td>
                            <td>
                              <span v-if="property.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>   
                              <span v-else-if="property.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                              <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed</span>

                            </td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <!-- <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                             -->
                                  <a v-if="property.created_by == user.id" @click="navigateTo('/editproperty/'+property.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a v-if="property.status == 0" @click="approveProperty(property.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Approve</a>
                                  <a v-if="property.featured == 0 && property.status == 1" @click="featureProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Feature</a>
                                  <a v-if="property.featured == 1 && property.status == 1" @click="unfeatureProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Unfeature</a>
                                  <a v-if="property.status == 1" @click="closeProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Close</a>
                                  <a v-if="property.status == 2" @click="reopenProperty(property.id)" class="dropdown-item" href="#"><i class="ri-refresh-fill mr-2"></i>Reopen</a>
                                  <a @click="deleteProperty(property.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete</a>
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
          user: []
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
             axios.get('api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.propertytypes = response.data.lists.propertytypes;
             this.properties = response.data.lists.properties;
             console.log("props", response)
             setTimeout(() => {
                  $("#AllPropertiesTable").DataTable();
              }, 10);
    
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
    
    
    