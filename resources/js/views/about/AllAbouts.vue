<template>
    <TheMaster>
        <section class="section dashboard">
              <div class="row">
                  <div class="card">
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
                    <h5 class="card-title">About Us Information <span>| Today</span></h5>

                    <div v-for="about in abouts" :key="about.id" class="news">
                      <div class="post-item clearfix">
                        <img :src="getPhoto() + about.image" />
                        <h4><a href="#">{{about.title}}
                        </a></h4>
                        <p>{{about.description}}
                          </p>
                          <div class="text-center">
                            <button @click="navigateTo('/edit-about/'+about.id )" class="btn btn-sm btn-secondary rounded-pill">Edit</button>
                          </div><br>
                      </div>

                    </div><!-- End sidebar recent posts-->

                  </div>
                </div>
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
                      <h5 class="card-title">All Our Services <span>| Today</span></h5>
                      <p class="card-text">
                      
                      <router-link to="/add-service" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill "
                            @click="navigate"
                          >
                            Add Service 
                          </a>
                      </router-link>
            
                      </p>    
                      <table id="AllServicesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="service in services" :key="service.id">
                            <td>{{service.title}}</td>
                            <td>{{truncate(service.description, 100)}}</td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a @click="navigateTo('/edit-service/'+service.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a @click="deleteService(service.id)" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>Delete</a>   
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
            abouts: [],
            services: []
        }
      },
      methods: {
        getPhoto()
        {
            return "/storage/about/";
        },
        truncate(value, length) {
          if (value.length > length) {
              return value.substring(0, length) + "...";
          } else {
              return value;
            }
        },
        navigateTo(location){
            this.$router.push(location)
        },
        deleteService(id){
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
                  axios.delete('/api/service/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Service has been deleted.',
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
             this.abouts = response.data.lists.abouts;
             this.services = response.data.lists.services;
             console.log("services", this.services)
             console.log("abouts", this.abouts)
             setTimeout(() => {
                            $("#AllServicesTable").DataTable();
                        }, 10);
    
             });
          },
          
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.loadLists();
      }
    }
    </script>
    
    
    