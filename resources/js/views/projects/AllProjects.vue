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
                      <h5 class="card-title">All Projects <span>| Today</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-project" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Project
                          </a>
                      </router-link>
            
                      </p>
    
                      <table id="AllProjectsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Preview</th>
                            <th scope="col">Name</th>
                            <th scope="col">Location</th>
                            <th scope="col">Description</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="project in projects" :key="project.id">
                            <th scope="row"><a href="#">
                              <img :src="getPhoto() + project.image_path" />
                            </a></th>
                            <td>{{project.name}}</td>
                            <td>{{project.location}}</td>
                            <td>{{project.description}}</td>
                            <td>
                              <span v-if="project.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Ongoing</span>   
                              <span v-else-if="project.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                              <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed</span>

                            </td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/viewproject/'+project.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <a @click="navigateTo('/editproject/'+project.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a v-if="project.status == 0" @click="completeProject(project.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Complete</a>
                                  <a v-if="project.featured == 0 && project.status == 1" @click="featureProject(project.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Feature</a>
                                  <a v-if="project.featured == 1 && project.status == 1" @click="unfeatureProject(project.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Unfeature</a>
                                  <a v-if="project.status == 1" @click="closeProject(project.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Close</a>
                                  <a v-if="project.status == 2" @click="reopenProject(project.id)" class="dropdown-item" href="#"><i class="ri-refresh-fill mr-2"></i>Reopen</a>
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
          projects: [],
          user: []
        }
      },
      methods: {
        getPhoto()
        {
            return "/storage/projects/";
        },
        navigateTo(location){
            this.$router.push(location)
        },
        completeProject(id){
          axios.put('api/completeproject/'+ id).then((response) => {
            // toast.fire(
            //   'Successful',
            //   'Project has been completed',
            //   'success'
            // ); 
            console.log(response)
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        featureProject(id){
          axios.put('api/featureproject/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Project has been featured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        unfeatureProject(id){
          axios.put('api/unfeatureproject/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Project has been unfeatured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        closeProject(id){
          axios.put('api/closeproject/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Project has been closed',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        reopenProject(id){
          axios.put('api/reopenproject/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Project has been reopened',
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
             this.properties = response.data.lists.properties;
             this.projects = response.data.lists.projects;
             setTimeout(() => {
                  $("#AllProjectsTable").DataTable();
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
    
    
    