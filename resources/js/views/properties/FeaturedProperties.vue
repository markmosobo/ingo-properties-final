<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Featured properties -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="card-body pb-0">
                    <h5 class="card-title">Featured Properties <span>| Properties that are featured</span></h5>
                    <table id="PropertiesTable" class="table table-borderless">
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
                          <tr v-for="property in featuredproperties" :key="property.id">
                            <th scope="row"><a href="#">
                              <img :src="getPhoto() + property.images[0].name" />
                            </a></th>
                            <td>{{property.title.substring(0,20)+".."}}</td>
                            <td>{{(property.price).toLocaleString()}}</td>
                            <td>{{property.location}}</td>
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
                                  <a @click="navigateTo('/viewproperty/'+property.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <!-- <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a v-if="property.status == 0" @click="approveProperty(property.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Approve</a>
                                  <a v-if="property.featured == 0 && property.status == 1" @click="featureProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Feature</a> -->
                                  <a v-if="property.featured == 1 && property.status == 1" @click="unfeatureProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Unfeature</a>
                                  <!-- <a v-if="property.status == 1" @click="closeProperty(property.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Close</a>
                                  <a v-if="property.status == 2" @click="reopenProperty(property.id)" class="dropdown-item" href="#"><i class="ri-refresh-fill mr-2"></i>Reopen</a> -->
                                  </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--End Featured properties -->
    
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
          featuredproperties: [],
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
        loadLists() {
             axios.get('api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.propertytypes = response.data.lists.propertytypes;
             this.featuredproperties = response.data.lists.featuredproperties;
             setTimeout(() => {
                  $("#PropertiesTable").DataTable();
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
    
    
    