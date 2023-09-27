<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Contact Details</h5>
                    <p v-for="contact in contacts" class="card-text">
                      <strong>Primary Phone: </strong>(+254) {{contact.phone}} <br>
                      <strong>Secondary Phone: </strong>(+254) {{contact.phone_2}} <br>
                      <strong>Email Address: </strong>  {{contact.email}}<br>
                      <strong>Physical Address: </strong>  {{contact.address}}<br>
                      <!-- <strong>Property Type:</strong>  hgjhh <br> -->
                      <!-- <strong>Featured:</strong>
                        <span v-if="property.featured == 0" class="badge bg-success">No</span>
                        <span v-else class="badge bg-warning"> No</span>
                      <br>
                      <strong>Status:</strong>
                        <span v-if="property.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>   
                        <span v-else-if="property.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                        <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed</span>
                      <br> -->
                      <div class="text-center">
                    <button @click="navigateTo('/edit-contact/'+contact.id )" class="btn btn-sm btn-secondary rounded-pill">Edit</button>
                    </div><br>
                    </p>
                    
                  </div>
                </div>
              </div>
              


              
            </div>
            <div class="row">
                <div class="col-lg-12">
                <div class="card top-selling overflow-auto">

                    <div class="card-body pb-0">
                    <h5 class="card-title">All Our Social Links <span>| Today</span></h5>
                    <p class="card-text">
                    
                    <router-link to="/add-sociallink" custom v-slot="{ href, navigate, isActive }">
                        <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill "
                            @click="navigate"
                        >
                            Add Social Link
                        </a>
                    </router-link>

                    </p>    
                    <table id="AllSocialLinksTable" class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="link in sociallinks" :key="link.id">
                            <td>{{link.name}}</td>
                            <td>{{link.link}}</td>
                            <td>
                                <span v-if="link.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Inactive</span>   
                                <span v-if="link.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Active</span>

                            </td>
                            <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a @click="navigateTo('/edit-sociallink/'+link.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a @click="deleteSocialLink(link.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete</a>   
                                    <a v-if="link.status == 0" @click="activateSocial(link.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Activate</a>
                                    <a v-if="link.status == 1" @click="deactivateSocial(link.id)" class="dropdown-item" href="#"><i class="ri-refresh-fill mr-2"></i>Deactivate</a>

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
        </div>
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
            contacts: [],
            sociallinks: []
        }
      },
      methods: {
        navigateTo(location){
            this.$router.push(location)
        },
        activateSocial(id){
          axios.put('api/activatesocial/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Social has been activated',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deactivateSocial(id){
          axios.put('api/deactivatesocial/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Social has been deactivated',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deleteSocialLink(id){
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
                  axios.delete('/api/sociallink/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Social link has been deleted.',
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
             this.contacts = response.data.lists.contacts;
             this.sociallinks = response.data.lists.sociallinks;
             console.log("contacts", this.contacts)
             console.log("social", this.sociallinks)
             setTimeout(() => {
                            $("#AllSocialLinksTable").DataTable();
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
    
    
    