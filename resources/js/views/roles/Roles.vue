<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <!-- <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div> -->
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">All Roles <span></span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-role" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-success rounded-pill "
                            @click="navigate"
                          >
                            Add Role
                          </a>
                      </router-link>
            
                      </p>

                      <table id="AllCategoriesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Created On</th>
                            <!--<th scope="col">Action</th>-->
                          </tr>
                        </thead>
                        <tbody>

                          <!-- LOADING SPINNER -->
                          <tr v-if="loading">
                            <td colspan="2" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading roles...</div>
                            </td>
                          </tr>

                          <!-- EMPTY STATE -->
                          <tr v-else-if="!categories.length">
                            <td colspan="2" class="text-center text-muted py-4">
                              No roles found.
                            </td>
                          </tr>

                          <!-- DATA -->
                          <tr v-else v-for="category in categories" :key="category.id">
                            
                            <td>
                              <span class="badge bg-dark text-uppercase">
                                {{ category.name }}
                              </span>
                            </td>

                            <td>
                              {{ format_date(category.created_at) }}
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
          categories: [],
          loading: false,
        }
      },
      methods: {
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        navigateTo(location){
            this.$router.push(location)
        },
        deleteCategory(id){
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
                  axios.delete('/api/category/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Category has been deleted.',
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

          axios.get('api/lists/roles')
            .then((response) => {
              this.categories = response.data.roles;

            setTimeout(() => {
                $("#AllCategoriesTable").DataTable();
            }, 10);
            })
            .finally(() => {
              this.loading = false;
            });
        }        

      },
      components : {
          TheMaster,
      },
      mounted(){
        this.loadLists();
      }
    }
    </script>
    
    
    