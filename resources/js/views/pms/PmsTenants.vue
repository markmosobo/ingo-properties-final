<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="filter">
                      <!--                       <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul> -->
                    </div>
    
                    <div class="card-body pb-0">
                         <h5 class="card-title">All Tenants <span>| {{ tenants.length }} total</span></h5>                      <p class="card-text">
                         <div class="row">
                          <div class="col d-flex">
                   
                            <router-link to="/add-pmstenant" custom v-slot="{ href, navigate, isActive }">
                                <a
                                  :href="href"
                                  :class="{ active: isActive }"
                                  class="btn btn-sm btn-primary rounded-pill mr-2"
                                  style="background-color: darkgreen; border-color: darkgreen;"
                                  @click="navigate"
                                >
                                  Add Tenant & Invoice
                                </a>
                            </router-link>

                          <router-link to="/add-pmscurrenttenant" custom v-slot="{ href, navigate, isActive }">
                                <a
                                  :href="href"
                                  :class="{ active: isActive }"
                                  class="btn btn-sm btn-primary rounded-pill"
                                  style="background-color: orange; border-color: orange;"
                                  @click="navigate"
                                >
                                  Add Tenant
                                </a>
                            </router-link>
                            </div>
                          <div class="col-auto d-flex justify-content-end">
                          <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="ri-add-line"></i>
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                     <a @click="navigateTo('/managedproperties' )" class="dropdown-item" href="#"><i class="ri-building-fill mr-2"></i>Properties</a>                                     
                                    <a @click="navigateTo('/pmslandlords' )" class="dropdown-item" href="#"><i class="ri-user-fill mr-2"></i>Landlords</a>
                                    <a @click="navigateTo('/pmstenants' )" class="dropdown-item" href="#"><i class="ri-user-fill mr-2"></i>Tenants</a>
                                </div>
                              </div>
                            </div>
                        </div>  
            
                      </p>
    
                      <table id="AllPropertiesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Full Name</th>
                            <th scope="col">Property</th>
                            <th scope="col">Unit No</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <!-- LOADING SPINNER -->
                          <tr v-if="loading">
                            <td colspan="5" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading tenants...</div>
                            </td>
                          </tr>

                          <!-- DATA ROWS -->
                          <tr v-else v-for="tenant in tenants" :key="tenant.id">
                            <td>{{tenant.first_name}} {{tenant.last_name}}</td>
                            <td>{{tenant.property.name}}</td>
                            <td>{{tenant.unit.unit_number}}</td>
                            <td>
                              <span v-if="tenant.status == 0" class="badge bg-warning text-dark">
                                <i class="bi bi-exclamation-triangle me-1"></i> Vacated
                              </span>
                              <span v-else-if="tenant.status == 1" class="badge bg-success">
                                <i class="bi bi-check-circle me-1"></i> Renting
                              </span>
                              <span v-else class="badge bg-light text-dark">
                                <i class="bi bi-star me-1"></i> Closed
                              </span>
                            </td>

                            <td>
                              <div class="btn-group" role="group">
                                <button
                                  type="button"
                                  class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
                                  style="background-color: darkgreen; border-color: darkgreen;"
                                  data-bs-toggle="dropdown"
                                >
                                  Action
                                </button>

                                <div class="dropdown-menu">
                                  <a class="dropdown-item" @click="navigateTo('/pmstenant/'+tenant.id)">
                                    <i class="ri-eye-fill mr-2"></i>View
                                  </a>

                                  <a class="dropdown-item" @click="navigateTo('/pmstenantinvoices/'+tenant.id)">
                                    <i class="ri-eye-fill mr-2"></i>View Invoices
                                  </a>

                                  <a class="dropdown-item" @click="navigateTo('/edit-pmstenant/'+tenant.id)">
                                    <i class="ri-pencil-fill mr-2"></i>Edit
                                  </a>

                                  <a
                                    class="dropdown-item"
                                    href="#"
                                    @click.prevent="openAttachModal(tenant)"
                                  >
                                    <i class="ri-attachment-2 mr-2"></i>
                                    Attach Documents
                                  </a>                                  

                                  <a
                                    v-if="tenant.status == 1"
                                    class="dropdown-item"
                                    @click="vacateTenant(tenant.id)"
                                  >
                                    <i class="ri-eye-close-fill mr-2"></i>Vacate
                                  </a>

                                  <a
                                    v-if="tenant.status == 2"
                                    class="dropdown-item"
                                    @click="reopenTenant(tenant.id)"
                                  >
                                    <i class="ri-refresh-fill mr-2"></i>Reopen
                                  </a>

                                  <a class="dropdown-item" @click="deleteTenant(tenant.id)">
                                    <i class="ri-delete-bin-line mr-2"></i>Delete
                                  </a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <!--show total tenants-->
                        <div><strong>Total Tenants: {{tenants.length}}</strong></div>
                    </div>
    
                  </div>
                </div><!-- End Top Selling -->
    
                <!-- Attach Documents Modal -->
                <div
                  class="modal fade"
                  id="attachDocsModal"
                  tabindex="-1"
                  aria-hidden="true"
                >
                  <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">

                      <!-- Header -->
                      <div class="modal-header">
                        <div>
                          <h5 class="modal-title">
                            Attach Documents – {{ selectedTenant?.first_name }} {{ selectedTenant?.last_name }}
                          </h5>

                          <small class="text-muted">
                            {{ selectedTenant?.property?.name }} • Unit {{ selectedTenant?.unit?.unit_number }}
                          </small>
                        </div>

                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>

                      <!-- Body -->
                      <div class="modal-body">

                        <!-- EXISTING DOCUMENTS -->
                        <div class="mb-4">
                          <h6 class="fw-bold mb-3">Tenant Documents</h6>

                          <div v-if="selectedTenant?.tenant_documents?.length">
                            <ul class="list-group">

                              <li
                                v-for="doc in selectedTenant.tenant_documents"
                                :key="doc.id"
                                class="list-group-item d-flex justify-content-between align-items-center"
                              >
                                <!-- Left -->
                                <div>
                                  <span class="badge bg-primary text-uppercase mb-1">
                                    {{ doc.type }}
                                  </span>

                                  <br />

                                  <small class="text-muted">
                                    {{ doc.file_name }}
                                  </small>
                                </div>

                                <!-- Right -->
                                <a
                                  :href="`/storage/${doc.file_path}`"
                                  target="_blank"
                                  class="btn btn-sm btn-outline-success rounded-pill"
                                >
                                  View
                                </a>
                              </li>

                            </ul>
                          </div>

                          <div v-else class="text-muted small">
                            No documents uploaded for this tenant yet.
                          </div>
                        </div>

                        <hr />

                        <!-- UPLOAD SECTION -->
                        <div class="mb-3">
                          <label class="form-label">Document Type</label>
                          <select v-model="docForm.type" class="form-select">
                            <option value="">Select type</option>
                            <option value="agreement">Tenant Agreement</option>
                            <option value="id">ID / Passport</option>
                            <option value="contract">Contract</option>
                            <option value="other">Other</option>
                          </select>
                        </div>

                        <div class="mb-3">
                          <label class="form-label">Select File</label>
                          <input
                            type="file"
                            class="form-control"
                            @change="handleFile"
                            accept=".pdf,.doc,.docx,.jpg,.png"
                          />

                          <small class="text-muted">
                            Allowed: PDF, DOC, DOCX, JPG, PNG (Max 5MB)
                          </small>
                        </div>

                        <!-- CONTEXT INFO -->
                        <div class="alert alert-light border mt-3">
                          <small>
                            <strong>Property:</strong> {{ selectedTenant?.property?.name }} <br>
                            <strong>Unit:</strong> {{ selectedTenant?.unit?.unit_number }} <br>
                            <strong>Rent:</strong> KES {{ selectedTenant?.unit?.monthly_rent }}
                          </small>
                        </div>

                      </div>

                      <!-- Footer -->
                      <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">
                          Cancel
                        </button>

                        <button
                          class="btn btn-success"
                          :disabled="uploading"
                          @click="uploadDocument"
                        >
                          <span
                            v-if="uploading"
                            class="spinner-border spinner-border-sm me-2"
                          ></span>

                          Upload Document
                        </button>
                      </div>

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
          tenants: [],
          categories: [],
          user: [],
          loading: false,
          selectedTenant: null,
          uploading: false,
          docForm: {
            type: "",
            file: null,
          }          
        }
      },
      methods: {
        openAttachModal(tenant) {
          this.selectedTenant = tenant;
          this.docForm = { type: "", file: null };

          const modal = new bootstrap.Modal(
            document.getElementById("attachDocsModal")
          );
          modal.show();
        },

        handleFile(e) {
          this.docForm.file = e.target.files[0];
        },

        uploadDocument() {
          if (!this.docForm.type || !this.docForm.file) {
            toast.fire("Missing data", "Select document type and file", "warning");
            return;
          }

          this.uploading = true;

          const formData = new FormData();
          formData.append("type", this.docForm.type);
          formData.append("file", this.docForm.file);
          formData.append("tenant_id", this.selectedTenant.id);

          axios
            .post("/api/users/upload-document", formData, {
              headers: { "Content-Type": "multipart/form-data" },
            })
            .then(() => {
              toast.fire("Uploaded", "Document attached successfully", "success");
              bootstrap.Modal.getInstance(
                document.getElementById("attachDocsModal")
              ).hide();
            })
            .catch(() => {
              toast.fire("Error", "Upload failed", "error");
            })
            .finally(() => {
              this.uploading = false;
            });
        },         
        getPhoto()
        {
            return "/storage/properties/";
        },
        navigateTo(location){
            this.$router.push(location)
        },
        vacateTenant(id){
          axios.put('api/vacatetenant/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Tenant has been vacated',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        reopenTenant(id){
          axios.put('api/reopentenant/'+ id).then(() => {
            toast.fire(
              'Successful',
              'tenant has been reopened',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        deleteTenant(id){
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#006400',
                  cancelButtonColor: '#FFA500',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  axios.delete('/api/pmstenant/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Tenant has been deleted.',
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

          axios.get('api/lists/tenants')
            .then((response) => {
              this.tenants = response.data.tenants;

              setTimeout(() => {
                  $("#AllPropertiesTable").DataTable();
              }, 10);

            })
            .finally(() => {
              this.loading = false;
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
    
    
    