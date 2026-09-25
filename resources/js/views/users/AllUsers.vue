<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <!-- <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul> -->
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">System Users <span>| All Users</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-user" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-success rounded-pill"
                            @click="navigate"
                          >
                            Add User
                          </a>
                      </router-link>
            
                      </p> 
    
                      <table id="AllUsersTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <!-- <th scope="col">Preview</th> -->
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                            <th scope="col">Registered On</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <!-- LOADING -->
                          <tr v-if="loading">
                            <td colspan="7" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading users...</div>
                            </td>
                          </tr>

                          <!-- EMPTY STATE -->
                          <tr v-else-if="!users.length">
                            <td colspan="7" class="text-center text-muted py-4">
                              No users found.
                            </td>
                          </tr>

                          <!-- DATA ROWS -->
                          <tr v-else v-for="user in users" :key="user.id">

                            <td>{{ user.first_name }} {{ user.last_name }}</td>

                            <td>{{ user.email ?? 'N/A' }}</td>

                            <td>{{ user.phone ?? 'N/A' }}</td>

                            <td>
                              {{ user.role?.name ?? 'N/A' }}
                            </td>

                            <td>
                              <span v-if="user.status == 0" class="badge bg-warning text-dark">
                                Pending
                              </span>

                              <span v-else-if="user.status == 1" class="badge bg-success">
                                Active
                              </span>

                              <span v-else class="badge bg-dark">
                                Inactive
                              </span>
                            </td>

                            <td>{{ format_date(user.created_at) }}</td>

                            <!-- ACTION -->
                            <td>
                              <div class="btn-group">

                                <button
                                  type="button"
                                  class="btn btn-sm btn-success rounded-pill dropdown-toggle"
                                  data-bs-toggle="dropdown"
                                >
                                  Action
                                </button>

                                <div class="dropdown-menu">

                                  <a
                                    @click="navigateTo('/viewuser/' + user.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-eye-line me-2 text-primary"></i>
                                    View
                                  </a>

                                  <a
                                    @click="navigateTo('/edituser/' + user.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-pencil-line me-2 text-primary"></i>
                                    Edit
                                  </a>

                                  <a
                                    @click="resetPassword(user)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-lock-line me-2 text-warning"></i>
                                    Reset Password
                                  </a>

                                  <a
                                    v-if="user.status == 2"
                                    @click="activateUser(user.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-check-line me-2 text-success"></i>
                                    Activate
                                  </a>

                                  <a
                                    v-if="user.status == 1"
                                    @click="deactivateUser(user.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-close-circle-line me-2 text-danger"></i>
                                    Deactivate
                                  </a>

                                </div>

                              </div>
                            </td>

                          </tr>

                        </tbody>
                      </table>
    
                    </div>

                   <div class="modal fade" id="settleTenantModal" tabindex="-1" aria-labelledby="settleTenantModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title" id="settleTenantModalLabel">Reset Password</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                       </div>
                       <div class="modal-body">
                         <p>
                           <div class="row">
                             <div class="col-sm-12">
                               <strong>{{user.first_name}} {{user.last_name}}</strong>
                               <p>Are you sure you want to reset password?The new password to login shall be: <strong>{{defaultPassword}}</strong></p>
                             </div>
                           </div>    
                         </p>

                         

                       </div>
                       <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                         <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click.prevent="confirmResetPassword">Yes</button>
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
          users: [],
          user: [],
          defaultPassword: '',
          loading: false,
        }
      },
      methods: {
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
            return "users/";
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

          axios.get('api/lists/users')
            .then((response) => {
              this.users = response.data.users;
              this.defaultPassword = response.data.defaultPassword.default_password;

              setTimeout(() => {
                  $("#AllUsersTable").DataTable();
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
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);

      }
    }
    </script>
    
    
    