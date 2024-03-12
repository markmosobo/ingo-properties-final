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
    
                        <li><a class="dropdown-item" @click="year()" href="#">This Year</a></li>
                        <li><a class="dropdown-item" @click="quarter()" href="#">This Quarter</a></li>
                        <li><a class="dropdown-item" @click="lastYear()" href="#">Last Year</a></li>
                      </ul>
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">{{property.name}} Statements <span>| This Year</span></h5>
                      <p class="card-text">
                   

            
                      </p>
    
                      <table id="AllStatementsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Transaction On</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Bal</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="statement in propertystatements" :key="statement.id">
                            <td>{{format_date(statement.updated_at)}}</td>
                            <td>{{statement.ref_no}}</td>
                            <td>
                              <span v-if="statement.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Paid</span>
                              <span v-else class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Not Paid</span>
                            </td>
                            <td>{{statement.details}}</td>
                            <td>{{formatNumber(statement.total)}}</td>
                            <td>{{formatNumber(statement.paid)}}</td>
                            <td>{{formatNumber(statement.balance)}}</td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/viewstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <!-- <a v-if="user.id == 1" @click="navigateTo('/editstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a> -->
                                  <a v-if="statement.status == 0" @click="settleTenant(statement.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Settle</a>
                                  </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td col="12">Total</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ formatNumber(calculateTotal('total')) }}</td>
                            <td>{{ formatNumber(calculateTotal('paid')) }}</td>
                            <td>{{ formatNumber(calculateTotal('balance')) }}</td>
                            <td></td>
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
          property: [],
          propertystatements: [],
          user: [],
          commission: []
        }
      },
      methods: {
        getProperty()
        {
          axios.get('/api/pmsproperty/'+ this.$route.params.id).then((response) => {
            this.property = response.data.property[0];
            this.commission = this.property.commission; 
            console.log("dat", this.commission)
          }).catch(() => {
              console.log('error')
          })
        },
        navigateTo(location){
            this.$router.push(location)
        },
        settleTenant(id){
            this.$router.push('/settlestatement/'+id)
        },
        formatNumber(value) {
          // Use the toLocaleString method to format the number with commas and decimal places
          return value.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          });
        },
        format_date(value){
          if(value){
            return moment(String(value)).format('lll')
          }
        },        
        getPropertyStatements() {
             axios.get('/api/yearpmspropertystatements/'+this.$route.params.id).then((response) => {
             this.propertystatements = response.data.yearpmspropertystatements;
             console.log("props", response)
             setTimeout(() => {
                  $("#AllStatementsTable").DataTable();
              }, 10);
    
             });
        },
        year()
        {
          this.$router.push('/yearpmspropertystatements/'+ this.$route.params.id)
        },
        quarter()
        {
          this.$router.push('/quarterpmspropertystatements/'+ this.$route.params.id)
        },
        lastYear()
        {
          this.$router.push('/lastyearpmspropertystatements/'+ this.$route.params.id)
        }
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.getProperty();
        this.getPropertyStatements();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);

      },
      computed: {
      // Calculate total based on the provided key ('total', 'paid', 'balance')
      calculateTotal() {
          return (key) => {
            return this.formatNumber(
              this.propertystatements.reduce((acc, statement) => acc + parseFloat(statement[key]), 0)
            );
          };
        },
      },      
    }
    </script>
    
    
    