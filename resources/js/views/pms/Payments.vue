<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
                <div class="col-lg-12">
                <div class="card top-selling overflow-auto">

                    <div class="card-body pb-0">
                    <h5 class="card-title">Payment Methods <span>| Today</span></h5>
                    <p class="card-text">
                    
                    <router-link to="/add-payment" custom v-slot="{ href, navigate, isActive }">
                        <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill "
                            @click="navigate"
                        >
                            Add Payment Method
                        </a>
                    </router-link>

                    </p>    
                    <table id="AllPaymentsTable" class="table table-borderless">
                        <thead>
                        <tr>
                            <th scope="col">Method</th>
                            <th scope="col">Paybill</th>
                            <th scope="col">Account No.</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="payment in payments" :key="link.id">
                            <td>{{payment.method}}</td>
                            <td>{{payment.paybill}}</td>
                            <td>{{payment.account_number}}</td>
                            <td>
                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                    <a @click="navigateTo('/edit-payment/'+payment.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a @click="deletePayment(payment.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete</a>   

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
                    'Payment method has been deleted.',
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
      }
    }
    </script>
    
    
    