<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
<div class="col-lg-6">
  <div class="card">
    <div class="card-body">

      <h5 class="card-title">Contact Details</h5>

      <!-- LOADING -->
      <div v-if="loading" class="text-center py-4">
        <div class="spinner-border text-success"></div>
        <div class="text-muted mt-2">Loading contacts...</div>
      </div>

      <!-- EMPTY -->
      <div v-else-if="!contacts.length" class="text-muted text-center py-4">
        No contact details found.
      </div>

      <!-- DATA -->
      <div v-else v-for="contact in contacts" :key="contact.id" class="card-text">

        <strong>Primary Phone:</strong> (+254) {{ contact.phone }} <br>
        <strong>Secondary Phone:</strong> (+254) {{ contact.phone_2 }} <br>
        <strong>Email Address:</strong> {{ contact.email }} <br>
        <strong>Physical Address:</strong> {{ contact.address }} <br>

        <div class="text-center mt-2">
          <button
            @click="navigateTo('/edit-contact/' + contact.id)"
            class="btn btn-sm btn-secondary rounded-pill"
          >
            Edit
          </button>
        </div>

        <hr>

      </div>

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

  <!-- LOADING -->
  <tr v-if="loading">
    <td colspan="4" class="text-center py-5">
      <div class="spinner-border text-success"></div>
      <div class="text-muted mt-2">Loading social links...</div>
    </td>
  </tr>

  <!-- EMPTY -->
  <tr v-else-if="!sociallinks.length">
    <td colspan="4" class="text-center text-muted py-4">
      No social links found.
    </td>
  </tr>

  <!-- DATA -->
  <tr v-else v-for="link in sociallinks" :key="link.id">

    <td>{{ link.name }}</td>

    <td>{{ link.link }}</td>

    <td>
      <span v-if="link.status == 0" class="badge bg-warning text-dark">
        Inactive
      </span>

      <span v-else class="badge bg-success">
        Active
      </span>
    </td>

    <td>
      <div class="btn-group">

        <button
          class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
          data-bs-toggle="dropdown"
        >
          Action
        </button>

        <div class="dropdown-menu">

          <a
            @click="navigateTo('/edit-sociallink/' + link.id)"
            class="dropdown-item"
          >
            <i class="ri-pencil-line me-2"></i>Edit
          </a>

          <a
            @click="deleteSocialLink(link.id)"
            class="dropdown-item"
          >
            <i class="ri-delete-bin-line me-2"></i>Delete
          </a>

          <a
            v-if="link.status == 0"
            @click="activateSocial(link.id)"
            class="dropdown-item"
          >
            Activate
          </a>

          <a
            v-if="link.status == 1"
            @click="deactivateSocial(link.id)"
            class="dropdown-item"
          >
            Deactivate
          </a>

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
            sociallinks: [],
            loading: false
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
  this.loading = true;

  axios.get('api/lists/contacts').then((response) => {
    this.contacts = response.data.contacts;
    this.sociallinks = response.data.sociallinks;

    console.log("contacts", this.contacts);
    console.log("social", this.sociallinks);

    setTimeout(() => {
      $("#AllSocialLinksTable").DataTable();
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
      }
    }
    </script>
    
    
    