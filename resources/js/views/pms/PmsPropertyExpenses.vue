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
                      <h5 class="card-title">{{property.name}} Expenses <span>| All Expenses</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-pmsexpense" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Expense
                          </a>
                      </router-link>
            
                      </p>
    
                      <table id="AllExpensesTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Type</th>
                            <th scope="col">Amount(KES)</th>
                            <th scope="col">Expended To</th>
                            <th scope="col">Checked By</th>
                            <th scope="col">Checked On</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="expense in propertyexpenses" :key="expense.id">
                            <td>{{capitalizeFirstLetter(expense.payment_type)}}</td>
                            <td>{{formatNumber(expense.amount_paid)}}</td>
                            <td>{{expense.paid_to}}</td>
                            <td>{{expense.user.first_name}} {{expense.user.last_name}}</td>
                            <td>{{format_date(expense.created_at)}}</td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <!-- <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                             -->
                                  <a v-if="expense.created_by == user.id" @click="navigateTo('/editexpense/'+expense.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a class="dropdown-item" @click="generateInvoice(expense.id)" href="#"><i class="ri-printer-fill mr-2"></i>Download Invoice</a>
                                  <a @click="deleteExpense(expense.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete</a>
                                  </div>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td>{{ formatNumber(calculateTotal('total')) }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
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
    import moment  from 'moment';
    import jsPDF from 'jspdf';

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
          propertyexpenses: [],
          property: [],
          user: [],
        }
      },
      methods: {
        format_date(value){
          if(value){
            return moment(String(value)).format('MMM Do YYYY')
          }
        },
        formatNumber(value) {
          // Use the toLocaleString method to format the number with commas and decimal places
          return value.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
          });
        },
        navigateTo(location){
            this.$router.push(location)
        },
        generateInvoice(id) {
          //get expense
          axios.get('/api/pmsexpense/'+id).then((response) => {
              this.pmsexpense = response.data.pmsexpense
                        // Create a new instance of jsPDF
          const pdf = new jsPDF();
          var img = new Image();
          img.src = '/images/ingo-colored-logo.png';

          pdf.addImage(img, 'PNG', 10, 10, 50, 50, { align: "center" })
          pdf.setFont("helvetica");
          pdf.setFontSize(20);
          pdf.text("Expense Report", 100, 20, { align: "center" });

          // Invoice Information
          pdf.setFontSize(12);
          pdf.text("Reference Number: ", 10, 40);
          pdf.text("Date: " + new Date(this.pmsexpense['created_at']).toLocaleDateString(), 10, 50);

          // Customer Information
          pdf.text("Expended To: "+ this.pmsexpense.paid_to, 10, 70);
          pdf.text("Checked By: "+this.pmsexpense.user.first_name + " "+ this.pmsexpense.user.last_name, 10, 80);
          pdf.text("Property: "+this.pmsexpense.property.name, 10, 90);
          pdf.text("Unit: "+this.pmsexpense.unit.unit_number, 10, 100);

          // Add a horizontal line
          pdf.line(10, 110, 200, 110);

          // Table Header
          // pdf.setFontType("bold");
          pdf.text("Property", 20, 120);
          pdf.text("Remarks", 80, 120);
          pdf.text("Cost", 160, 120);

          // Table Rows
          // pdf.setFontType("normal");
          pdf.text(this.pmsexpense.property.name+" - "+this.pmsexpense.unit.unit_number, 20, 130);
          pdf.text(this.pmsexpense.payment_type+" by "+this.pmsexpense.paid_to, 80, 130);
          pdf.text("KES "+this.pmsexpense.amount_paid.toFixed(2), 160, 130);


          // Total
          // pdf.setFontType("bold");
          pdf.text("Total: KES " + this.pmsexpense.amount_paid.toFixed(2), 160, 160);
          pdf.text("Balance: KES " + "0.00", 160, 170);
          // Add content to the PDF
          // pdf.text('Hello, this is a PDF generated with Vue.js!', 10, 10);

          // Save the PDF
          pdf.save(this.pmsexpense.paid_to+'-pdf.pdf');
              console.log("user", response)
          })

        },
        deleteExpense(id){
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
                  axios.delete('/api/pmsexpense/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Expense has been deleted.',
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
        capitalizeFirstLetter(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
        },
        getProperty()
        {
          axios.get('/api/pmsproperty/'+ this.$route.params.id).then((response) => {
            this.property = response.data.property[0] 
            console.log("dat", this.property)
          }).catch(() => {
              console.log('error')
          })
        },
        getPropertyExpenses() {
             axios.get('/api/pmspropertyexpenses/'+this.$route.params.id).then((response) => {
             this.propertyexpenses = response.data.pmspropertyexpenses;
             console.log("expenses", response)
             setTimeout(() => {
                  $("#AllExpensesTable").DataTable();
              }, 10);
    
             });
          },
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.getProperty();
        this.getPropertyExpenses();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);

      },
      computed: {
      // Calculate total based on the provided key ('total', 'paid', 'balance')
      calculateTotal() {
          return (key) => {
            return this.formatNumber(
              this.propertyexpenses.reduce((acc, statement) => acc + parseFloat(statement[key]), 0)
            );
          };
        },
      }
    }
    </script>
    
    
    