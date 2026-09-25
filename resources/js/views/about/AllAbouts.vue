<template>
  <TheMaster>
    <section class="section dashboard">
      <div class="row">

        <!-- ABOUT SECTION -->
        <div class="card">

          <div class="filter">
            <a class="icon" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-three-dots"></i>
            </a>
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

            <h5 class="card-title">
              About Us Information
              <span v-if="loading">| Loading...</span>
              <span v-else>| Today</span>
            </h5>

            <!-- SPINNER -->
            <div v-if="loading" class="text-center py-4">
              <div class="spinner-border text-success"></div>
              <div class="text-muted mt-2">Loading about content...</div>
            </div>

            <!-- EMPTY -->
            <div v-else-if="!abouts.length" class="text-muted text-center py-4">
              No about information found.
            </div>

            <!-- DATA -->
            <div v-else v-for="about in abouts" :key="about.id" class="news">

              <div class="post-item clearfix">
                <img :src="getPhoto() + about.image" />

                <h4>
                  <a href="#">{{ about.title }}</a>
                </h4>

                <p>{{ about.description }}</p>

                <div class="text-center">
                  <button
                    @click="navigateTo('/edit-about/' + about.id)"
                    class="btn btn-sm btn-secondary rounded-pill"
                  >
                    Edit
                  </button>
                </div>

                <br>

              </div>

            </div>

          </div>
        </div>

        <!-- SERVICES SECTION -->
        <div class="col-12">
          <div class="card top-selling overflow-auto">

            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-three-dots"></i>
              </a>
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

              <h5 class="card-title">
                All Our Services
                <span v-if="loading">| Loading...</span>
                <span v-else>| Today</span>
              </h5>

              <p class="card-text">
                <router-link to="/add-service" custom v-slot="{ href, navigate, isActive }">
                  <a
                    :href="href"
                    :class="{ active: isActive }"
                    class="btn btn-sm btn-primary rounded-pill"
                    @click="navigate"
                  >
                    Add Service
                  </a>
                </router-link>
              </p>

              <!-- SPINNER -->
              <div v-if="loading" class="text-center py-4">
                <div class="spinner-border text-success"></div>
                <div class="text-muted mt-2">Loading services...</div>
              </div>

              <!-- EMPTY -->
              <div v-else-if="!services.length" class="text-muted text-center py-4">
                No services found.
              </div>

              <!-- TABLE -->
              <table v-else id="AllServicesTable" class="table table-borderless">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="service in services" :key="service.id">

                    <td>{{ service.title }}</td>

                    <td>{{ truncate(service.description, 100) }}</td>

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
                            @click="navigateTo('/edit-service/' + service.id)"
                            class="dropdown-item"
                          >
                            <i class="ri-pencil-fill me-2"></i>Edit
                          </a>

                          <a
                            @click="deleteService(service.id)"
                            class="dropdown-item"
                          >
                            <i class="ri-delete-bin-line me-2"></i>Delete
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
            services: [],
            loading: false
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
  this.loading = true;

  axios.get('api/lists/abouts')
    .then((response) => {
      this.abouts = response.data.abouts;
      this.services = response.data.services;

      setTimeout(() => {
          $("#AllServicesTable").DataTable();
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
    
    
    