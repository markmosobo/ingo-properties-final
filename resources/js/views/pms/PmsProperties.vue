<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
      
                    <div class="card-body pb-0">
                      <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                          Managed Properties <span>| Overview</span>
                        </h5>

                        <button
                          class="btn btn-sm btn-success rounded-pill"
                          @click="navigateTo('/add-pmsproperty')"
                        >
                          <i class="ri-add-circle-line me-1"></i>
                          Add Property
                        </button>
                      </div>
                      <div v-if="loading" class="text-center py-5">
                        <div class="spinner-border text-success" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Loading properties...</p>
                      </div>

                      <div v-else>
                        <table id="AllPropertiesTable" class="table table-borderless">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Landlord</th>
                              <th>Number of Units</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr v-for="property in properties" :key="property.id">
                              <td>{{property.name}}</td>
                              <td>{{property.landlord.first_name}} {{property.landlord.last_name}}</td>
                              <td>{{property.units.length}}</td>
                              <td>
                                <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                    <a @click="navigateTo('/pmsproperties/'+property.id )" class="dropdown-item"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a @click="navigateTo('/pmsunits/'+property.id )" class="dropdown-item"><i class="ri-eye-fill mr-2"></i>View Units</a>
                                    <a @click="navigateTo('/pmspropertystatements/'+property.id )" class="dropdown-item"><i class="ri-eye-fill mr-2"></i>View Invoices</a>
                                    <a @click="navigateTo('/propertyawaitinginvoicing/'+property.id)" class="dropdown-item"><i class="ri-file-list-2-fill mr-2"></i>Awaiting Invoicing</a>
                                    <a @click="navigateTo('/propertyinvoicestosettle/'+property.id)" class="dropdown-item"><i class="ri-file-edit-fill mr-2"></i>Invoices to Settle</a>
                                    <a @click="navigateTo('/propertysettledinvoices/'+property.id)" class="dropdown-item"><i class="ri-bank-card-fill mr-2"></i>Settled Invoices</a>
                                    <a @click="navigateTo('/edit-pmsproperty/'+property.id )" class="dropdown-item"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a @click="deleteProperty(property.id)" class="dropdown-item"><i class="ri-delete-bin-line mr-2"></i>Delete</a>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
    
                  </div>
                </div>
                <!-- End Top Selling -->
    
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
          loading: true
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
                  text: "All units associated with property will be deleted. You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#006400',
                  cancelButtonColor: '#FFA500',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  axios.delete('/api/pmsproperty/'+id).then(() => {
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
          this.loading = true; // start spinner
          axios.get('api/lists').then((response) => {
            this.properties = response.data.lists.pmsproperties;
            console.log("props", this.properties);

            setTimeout(() => {
                $("#AllPropertiesTable").DataTable();
            }, 10);

          }).catch((error) => {
            console.error(error);
          }).finally(() => {
            this.loading = false; // stop spinner
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
    
    
    