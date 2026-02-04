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
                </div>
                -->
                <div class="card-body pb-0">
                  <h5 class="card-title">Payment Methods <span></span></h5>
                  <p class="card-text">
               
                  <router-link to="#" custom v-slot="{ href, navigate, isActive }">
                    <a
                      :href="href"
                      :class="{ active: isActive }"
                       @click="openModal"
                      class="btn btn-sm btn-primary rounded-pill me-2"
                      style="background-color: darkgreen; border-color: darkgreen;"
                    >
                      Add Payment Method
                    </a>
                  </router-link>
        
                  </p> 

                  <table id="AllPaymentsTable" class="table table-borderless">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Method</th>
                        <th scope="col">Account No.</th>
                        <th scope="col">Paybill No.</th>
                        <th scope="col">Till No.</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="payment in payments" :key="payment.id">
                        <td>{{payment.name}}</td>
                        <td>{{(payment.method)}}</td>
                        <td>{{payment.account_number ?? 'N/A'}}</td>
                        <td>{{payment.paybill_number ?? 'N/A'}}</td>
                        <td>{{payment.till_number ?? 'N/A'}}</td>
                        <td>
                          <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" 
                              style="background-color: darkgreen; border-color: darkgreen;" aria-expanded="false">
                              Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                              <!-- <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                             -->
                              <a @click="editModal(payment)" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                              <a @click="deletePayment(payment.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete</a>
                              </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>

                </div>

               <!-- Add Payment Modal -->
                <div class="modal fade" id="addPaymentModal" tabindex="-1" role="dialog" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="addPaymentModalLabel">Add Payment Method</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      
                      <div class="modal-body">
                        <!-- Full Name Field -->
                        <div class="form-group">
                          <label for="fullName"><strong>Account Name:</strong></label>
                          <input 
                            type="text" 
                            id="fullName" 
                            v-model="form.name" 
                            placeholder="Enter account name" 
                            class="form-control"
                          />
                          <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
                        </div>

                        <!-- Method Field -->
                        <div class="form-group">
                          <label for="label"><strong>Payment Method:</strong></label>
                          <select
                            id="label"
                            v-model="form.method"
                            class="form-control"
                          >
                            <option disabled value="">Please select a method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="MPESA Paybill">MPESA Paybill</option>
                            <option value="MPESA Till Number">MPESA Till Number</option>
                          </select>
                          <div v-if="errors.method" class="text-danger">{{ errors.method }}</div>
                        </div>


                        <!-- account no. field -->
                        <div v-if="form.method == 'Bank Transfer' || form.method == 'MPESA Paybill'" class="form-group">
                          <label for="body"><strong>Account Number:</strong></label>
                          <input 
                            type="number" 
                            id="fullName" 
                            v-model="form.account_number" 
                            placeholder="Enter account number" 
                            class="form-control"
                          />
                        </div>

                        <!-- till no. field -->
                        <div v-if="form.method == 'MPESA Till Number'" class="form-group">
                          <label for="body"><strong>Till Number:</strong></label>
                          <input 
                            type="number" 
                            id="fullName" 
                            v-model="form.till_number" 
                            placeholder="Enter till number" 
                            class="form-control"
                          />
                          </div>
                        </div>
                      
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="closeModal">Close</button>
                        <button type="button" @click="submitPayment" class="btn btn-primary" style="background-color: darkgreen; border-color: darkgreen;">Save</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Edit Payment Modal -->
                <div class="modal fade" id="EditPaymentModal" tabindex="-1" aria-labelledby="EditPaymentModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="EditPaymentModalLabel">Edit Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <!-- Account Name Field -->
                        <div class="form-group">
                          <label for="accountName"><strong>Account Name:</strong></label>
                          <input 
                            type="text" 
                            id="accountName" 
                            v-model="form.name" 
                            placeholder="Enter account name" 
                            class="form-control"
                          />
                          <div v-if="errors.name" class="text-danger">{{ errors.name }}</div>
                        </div>

                        <!-- Payment Method Field -->
                        <div class="form-group">
                          <label for="paymentMethod"><strong>Payment Method:</strong></label>
                          <select
                            id="paymentMethod"
                            v-model="form.method"
                            class="form-control"
                          >
                            <option disabled value="">Please select a method</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="MPESA Paybill">MPESA Paybill</option>
                            <option value="MPESA Till Number">MPESA Till Number</option>
                          </select>
                          <div v-if="errors.method" class="text-danger">{{ errors.method }}</div>
                        </div>

                        <!-- Account Number Field -->
                        <div v-if="form.method === 'Bank Transfer' || form.method === 'MPESA Paybill'" class="form-group">
                          <label for="accountNumber"><strong>Account Number:</strong></label>
                          <input 
                            type="number" 
                            id="accountNumber" 
                            v-model="form.account_number" 
                            placeholder="Enter account number" 
                            class="form-control"
                          />
                        </div>

                        <!-- Till Number Field -->
                        <div v-if="form.method === 'MPESA Till Number'" class="form-group">
                          <label for="tillNumber"><strong>Till Number:</strong></label>
                          <input 
                            type="number" 
                            id="tillNumber" 
                            v-model="form.till_number" 
                            placeholder="Enter till number" 
                            class="form-control"
                          />
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click.prevent="confirmEditPayment">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>

               
              </div>


            </div>
          </div><!-- End Top Selling -->
    
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
          payments: [],
          user: [],
          form: {
            full_name: '',
            label: '',
            body: ''
          },
          errors: {
            full_name: '',
            label: '',
            body: ''
          },
          defaultPassword: ''
        }
      },
      methods: {
         openModal() {
          const modal = new bootstrap.Modal(document.getElementById('addPaymentModal'));
          modal.show();
        },
        closeModal() {
          const modal = bootstrap.Modal.getInstance(document.getElementById('addPaymentModal'));
          modal.hide();
        },
        editModal(payment)
        {
          this.selectedPayment = payment;
          this.form.name = payment.name;
          this.form.method = payment.method;
          this.form.account_number = payment.account_number;
          this.form.till_number = payment.till_number;
          this.form.paybill_number = payment.paybill_number;
          // Show the modal after fetching data
            const modal = new bootstrap.Modal(document.getElementById('EditPaymentModal'));
            modal.show();
        },
        confirmEditPayment() {
        let payload = {
            name: this.form.name,
            method: this.form.method,
            account_number: this.form.account_number,
            till_number: this.form.till_number,
            paybill_number: this.form.paybill_number,
        };

        axios.put("/api/edit-payment/" + this.selectedPayment.id, payload)
          .then(response => {
              console.log(response);
              toast.fire(
                  'Success!',
                  'Payment updated!',
                  'success'
              );
          })
          .catch(error => {
              console.log(error);
          })
          .finally(() => {
              // Reference the modal instance directly and hide it
              const modalElement = document.getElementById('EditPaymentModal');
              const modalInstance = bootstrap.Modal.getInstance(modalElement);
              if (modalInstance) {
                  modalInstance.hide();
              }
              this.loadLists();
          });
        },
        submitPayment() {

            // Axios PUT request to invoice the tenant
            axios.post('/api/payment', this.form)
              .then(response => {
                toast.fire(
                  'Success!',
                  'Payment saved!',
                  'success'
                );
              })
              .catch(error => {
                console.error(error);

                // Display error toast notification
                toast.fire(
                  'Error!',
                  'An error occurred while saving the payment method.',
                  'error'
                );
              })
              .finally(() => {

                // // Close the modal after invoicing
                const modal = bootstrap.Modal.getInstance(document.getElementById('addPaymentModal'));
                modal.hide();

                // Reset form fields
                this.form.full_name = '';
                this.form.label = '';
                this.form.body = '';

                // Reload the lists (loadLists ensures updated data is fetched)
                this.loadLists();
              });
        },
        deletePayment(id){
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
                  axios.delete('/api/payment/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Payment has been deleted.',
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
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        navigateTo(location){
            this.$router.push(location)
        },
        loadLists() {
             axios.get('api/lists').then((response) => {
             this.payments = response.data.lists.payments;
             setTimeout(() => {
                  $("#AllPaymentsTable").DataTable();
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