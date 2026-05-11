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
    
                        <li>
                            <router-link to="/statements/" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            This Month</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/pmsyearstatements" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            This Year</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link to="/pmsallstatements" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            All Time</a>
                            </router-link>
                        </li>

                      </ul> -->
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">Unpaid/Partially Paid Invoices <span>| {{statements.length}} invoices to settle</span></h5>
                      <p class="card-text">
                        <div class="row">
                          <div class="col d-flex">
                            <button class="me-2" v-if="statements.length !== 0" @click="exportToExcel">Export</button>
                     <!--        <button v-if="invoicestosettlesmsnotsent.length !== 0" class="me-2" @click="sendSms">Send Bulk SMS ({{invoicestosettlesmsnotsent.length}} Pending)
                            </button> -->
                     
                        
                          <!-- <button v-if="statements.length !== 0" @click="generatePDF">Generate PDF</button> -->
                          </div>
                            <div class="col-auto d-flex justify-content-end">
                              <div class="btn-group" role="group">
                                <button
                                  id="btnGroupDrop1"
                                  type="button"
                                  style="background-color: darkgreen; border-color: darkgreen;"
                                  class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
                                  data-toggle="dropdown"
                                  data-bs-toggle="dropdown"
                                  aria-haspopup="true"
                                  aria-expanded="false"
                                >
                                  <i class="ri-add-line"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                  <a @click="navigateTo('/awaitinginvoicing')" class="dropdown-item" href="#">
                                    <i class="ri-file-list-2-fill mr-2"></i>Draft Invoices
                                  </a>
                                  <a @click="navigateTo('/invoicestosettle')" class="dropdown-item" href="#">
                                    <i class="ri-file-edit-fill mr-2"></i>Unpaid/Partial Invoices
                                  </a>
                                  <a @click="navigateTo('/settledinvoices')" class="dropdown-item" href="#">
                                    <i class="ri-bank-card-fill mr-2"></i>Settled Invoices
                                  </a>
                                  <a @click="navigateTo('/managedproperties')" class="dropdown-item" href="#">
                                    <i class="ri-building-fill mr-2"></i>Properties
                                  </a>
                                  <a @click="navigateTo('/pmstenants')" class="dropdown-item" href="#">
                                    <i class="ri-user-fill mr-2"></i>Tenants
                                  </a>
                                  <a @click="navigateTo('/pmslandlords')" class="dropdown-item" href="#">
                                    <i class="ri-user-fill mr-2"></i>Landlords
                                  </a>
                                </div>
                              </div>
                            </div>
                        </div> 
            
                      </p>
                    <div v-if="isLoadingStatements" class="text-center py-5">
                      <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                      </div>
                      <div class="mt-2">Loading statements…</div>
                    </div>   

                    <table v-if="!isLoadingStatements" id="AllStatementsTable" class="table table-borderless">
                      <thead>
                        <tr>
                          <th scope="col">Tenant</th>
                          <th scope="col">Property</th>
                          <th scope="col">Detail</th>
                          <th scope="col">Due</th>
                          <th scope="col">Paid</th>
                          <th scope="col">Bal</th>
                          <th scope="col">Invoiced</th>                            
                          <th scope="col">Status</th>
                          <th scope="col">Remind</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="statement in statements" :key="statement.id">
                          <td>{{ statement.tenant ? statement.tenant.first_name + ' ' + statement.tenant.last_name : 'N/A' }}</td>
                          <td>{{statement.property.name}}</td>                            
                          <td>{{statement.details}}</td>
                          <td>{{formatNumber(statement.total)}}</td>
                          <td>{{formatNumber(statement.paid)}}</td>
                          <td>{{formatNumber(statement.balance)}}</td>
                          <td>{{format_date(statement.created_at)}}</td>                            
                          <td>
                            <span v-if="statement.status == 1" class="badge bg-success"><i class="bi bi-clipboard2-check"></i> Settled</span>
                            <span v-else-if="statement.status == 0" class="badge bg-warning text-dark"><i class="bi bi-clipboard2-x"></i> Not Settled</span>
                            <span v-else class="badge bg-info text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Vacant</span>
                          </td>
                          <td>
                             <button
                              @click="sendEmailReminder(statement)"
                              class="btn btn-sm btn-light"
                              title="Send Email Reminder"
                              :disabled="statement.isLoadingEmail"
                            >
                              <span v-if="statement.isLoadingEmail">
                                <i class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></i>
                              </span>
                              <span v-else>
                                <i class="ri-mail-send-line" style="color: #007bff;"></i>
                              </span>
                            </button>
                            <button @click="sendWhatsAppReminder(statement, $event)" class="btn btn-sm btn-light" title="Send WhatsApp Reminder">
                              <i class="ri-whatsapp-line" style="color: #25D366;"></i>
                            </button>
                          </td>
                          <td>
                            <div class="btn-group" role="group">
                              <button id="btnGroupDrop1" type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Action
                              </button>
                              <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                <a @click="navigateTo('/viewstatement/'+statement.id)" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View Details</a>                                            
                                <a v-if="statement.status == 0 && statement.water_bill == null" @click="invoiceTenant(statement.id)" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Invoice</a>
                                <a v-if="statement.status == 0 && statement.water_bill !== null" @click="settleTenant(statement)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Settle Invoice</a>
                                <a @click="print(statement)" class="dropdown-item" href="#"><i class="ri-printer-line mr-2"></i>Print Invoice</a> 
                                <a @click="editInvoice(statement)" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit Invoice</a> 
                                <a @click="deleteInvoice(statement.id)" class="dropdown-item" href="#"><i class="ri-delete-bin-line mr-2"></i>Delete Invoice</a>                                 
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>

                      <div><strong>Total: 
                        Due: {{ formatNumber(calculateTotal('total')) }},
                        Paid: {{ formatNumber(calculateTotal('paid')) }},
                        Bal: {{ formatNumber(calculateTotal('balance')) }}
                      </strong>
                      </div>     
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="settleTenantModal" tabindex="-1" aria-labelledby="settleTenantModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">

                          <!-- HEADER -->
                          <div class="modal-header">
                            <h5 class="modal-title" id="settleTenantModalLabel">Settle Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>

                          <!-- BODY -->
                          <div class="modal-body">

                            <!-- INVOICE SUMMARY -->
                            <div class="alert alert-light border mb-3">
                              <strong>Invoice:</strong> #{{ selectedStatement.ref_no }} <br>

                              <strong>Status:</strong>
                              <span v-if="selectedStatement && selectedStatement.paid >= selectedStatement.total" class="text-success">
                                PAID
                              </span>
                              <span v-else class="text-warning">
                                PENDING
                              </span>
                            </div>

                            <p v-if="selectedStatement && selectedStatement.tenant">
                              <strong>Tenant Name:</strong>
                              {{ selectedStatement.tenant.first_name }} {{ selectedStatement.tenant.last_name }}
                            </p>

                            <p v-else>
                              <strong>Tenant Name:</strong> N/A
                            </p>

                            <!-- FINANCIAL BREAKDOWN -->
                            <div v-if="selectedStatement" class="row mb-3">

                              <div class="col-sm-4">
                                <small class="text-muted">Total</small>
                                <div><strong>{{ formatNumber(selectedStatement.total) }}</strong></div>
                              </div>

                              <div class="col-sm-4">
                                <small class="text-muted">Paid</small>
                                <div class="text-success">
                                  <strong>{{ formatNumber(selectedStatement.paid) }}</strong>
                                </div>
                              </div>

                              <div class="col-sm-4">
                                <small class="text-muted">Balance</small>
                                <div :class="selectedStatement.balance > 0 ? 'text-danger' : 'text-success'">
                                  <strong>{{ formatNumber(selectedStatement.balance) }}</strong>
                                </div>
                              </div>

                            </div>

                            <!-- LAST MONTH STATUS -->
                            <label v-if="lastmonthBalance < 0" class="form-label">
                              <span style="color: green;">
                                Overpayment: <strong>KES {{ lastmonthstatement.balance }}</strong>
                              </span>
                            </label>

                            <label v-if="lastmonthstatement.balance > 0" class="form-label">
                              <span style="color: red;">
                                Last Month Arrears: <strong>KES {{ lastmonthstatement.balance }}</strong>
                              </span>
                            </label>

                            <!-- PAYMENT METHOD -->
                            <div class="row">
                              <div class="col-sm-6">

                                <strong>Payment Method:</strong>

                                <select
                                  name="category"
                                  v-model="form.payment_method"
                                  class="form-select"
                                  id="payment-method-1">

                                  <option value="0" disabled>Select Payment</option>
                                  <option value="Mpesa" selected>MPESA</option>
                                  <option value="Cash">Cash</option>
                                  <option value="Bank">Bank Transfer</option>

                                </select>

                                <small class="text-muted">
                                  Select how the tenant is paying this invoice
                                </small>

                                <div v-if="errors.payment_method" class="text-danger">
                                  {{ errors.payment_method }}
                                </div>

                              </div>

                              <!-- MPESA CODE -->
                              <div v-if="form.payment_method === 'Mpesa'" class="col-sm-6">

                                <strong>MPESA Code:</strong>

                                <input
                                  type="text"
                                  name="mpesa_code"
                                  v-model="form.mpesa_code"
                                  class="form-control"
                                  placeholder="e.g. QKJ3X9L2">

                                <small class="text-muted">
                                  Optional but recommended for audit trail
                                </small>

                                <div v-if="errors.mpesa_code" class="text-danger">
                                  {{ errors.mpesa_code }}
                                </div>

                              </div>
                            </div>

                            <!-- AMOUNT -->
                            <div class="row mt-3">

                              <div class="col-sm-6">

                                <strong>Amount Paid:</strong>

                                <input
                                  type="number"
                                  :disabled="!form.payment_method"
                                  name="cash"
                                  v-model="form.cash"
                                  class="form-control">

                                <small class="text-muted">
                                  Suggested: {{ formatNumber(selectedStatement.balance) }}
                                </small>

                                <div v-if="errors.cash" class="text-danger">
                                  {{ errors.cash }}
                                </div>

                                <!-- WARNING -->
                                <div v-if="form.cash && form.cash != selectedStatement.balance"
                                    class="alert alert-warning p-2 mt-2">
                                  Amount differs from balance.
                                </div>

                              </div>

                              <div class="col-sm-6">

                                <strong>Balance Preview</strong>

                                <h6 v-if="lastmonthBalance < 0">
                                  {{ payableOverAmount }}
                                </h6>

                                <h6 v-else>
                                  {{ payableAmount }}
                                </h6>

                              </div>

                            </div>

                            <!-- OVERPAYMENT ACTION -->
                            <p v-if="lastmonthBalance < 0">
                              <button
                                @click.prevent="applyOverPayment"
                                :disabled="!form.cash"
                                class="btn btn-sm btn-outline-success mt-2">

                                Apply Overpayment

                              </button>
                            </p>

                            <!-- INFO FOOTER -->
                            <small class="text-muted d-block mt-3">
                              A receipt will be generated automatically after settlement.
                            </small>

                          </div>

                          <!-- FOOTER -->
                          <div class="modal-footer">

                            <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                              Close
                            </button>

                            <button
                              type="button"
                              style="background-color: darkgreen; border-color: darkgreen;"
                              class="btn btn-primary rounded-pill"
                              :disabled="!form.cash || !form.payment_method"
                              @click.prevent="confirmSettleTenant">

                              Settle Tenant

                            </button>

                          </div>

                        </div>
                      </div>
                    </div>

                    <!--Edit Invoice Modal -->
                    <div class="modal fade" id="EditInvoiceModal" tabindex="-1" aria-labelledby="EditInvoiceModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="EditInvoiceModalLabel">Edit Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>#{{selectedStatement.ref_no}}</p>
                            <p>{{ tenant}}</p>
                            <p v-if="selectedStatement">
                              <div class="row">
                                <div class="col-sm-6">
                                  <strong>Amount Due(Inclusive of Water Bill):</strong> 
                                 <input type="text" name="total" v-model="form.total" class="form-control">
                                </div>
                              </div>   
                            </p>
                            <p v-if="selectedStatement">
                              <div class="row">
                                <div class="col-sm-6">
                                  <strong>Balance:</strong> 
                                 <input type="text" name="balance" v-model="form.balance" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                 <strong>Water Bill:</strong>
                                 <input type="text" name="water_bill" v-model="form.water_bill" class="form-control">
                                </div>
                              </div>   
                            </p>

                            

                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click.prevent="confirmEditInvoice">Save changes</button>
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
    import jsPDF from 'jspdf';
    import * as XLSX from 'xlsx';
    import IngoLogo from '@/assets/img/apex-logo.png';

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
          statements: [],
          payments: [],
          awaitinginvoicing: [],
          invoicestosettlesmsnotsent: [],
          invoicestosettlesmssent: [],
          collectedTotal: 0,
          expensesTotal: 0,
          user: [],
          authorizationCode: '',
          accessToken: '',
          selectedStatement: {}, // Initialize as an empty object
          property: '',
          logoBase64: '',
          paymentMethod: '',
          accountNo: '',
          paybillNo: '',
          name: '',
          tenant: '',
          phoneNumber: '',
          unitNumber: '',
          refNo: '',
          details: '',
          date: '',
          status: '',
          paid: '',
          balance: '',
          total: '',
          amountPaid: '',
          isAmountValid: true,
          lastmonthstatement: [],
          lastmonthBalance: '',
          overPayment: false,
          isLoadingStatements: false,

          form: {
            payment_method: '',
            cash: '',
            mpesa_code: '',
            balance: '',
            amountPaid: '',
            balAmount: ''
          },
          isLoadingEmail: false,
          errors: {
            cash: '',
            mpesa_code: ''
          },
        }
      },
      methods: {
        navigateTo(location){
            this.$router.push(location)
        },
         invoiceTenant(id){
            this.$router.push('invoicestatement/'+id)
        },
        async sendEmailReminder(statement) {
          // Set the loading state for this specific statement
          statement.isLoadingEmail = true; // Start spinner for the specific row

          this.dueAmount = statement.total;
          this.dueWater = statement.water_bill;
          this.tenantId = statement.pms_tenant_id;
          this.rentMonth = statement.rent_month;
          this.details = statement.details;
          this.refNo = statement.ref_no;
          this.createdAt = statement.created_at;
          this.invoicedAt = statement.updated_at;
          this.propertyId = statement.pms_property_id;
          this.unitId = statement.pms_unit_id;
          this.waterBillAmount = statement.water_bill;
          this.water = this.waterBillAmount === 0 ? '' : '(Incl. Water Bill)';

          // Check if tenantEmail is provided
          if (!statement.tenant.email_address) {
            statement.isLoadingEmail = false; // Stop loading on error
            Swal.fire({
              title: 'Error sending email',
              text: 'Please ensure ' + statement.tenant.first_name + ' ' + statement.tenant.last_name + ' has a valid email address. To update, click on View Tenant on the Action button',
              icon: 'warning',
            });
            return;
          }

          // Calculate the due date (5th of the rent month)
          this.dueDate = this.calculateDueDate(statement.rent_month);

          // Check the property ID and get the relevant info
          if (statement.pms_property_id === 5) {
            this.accountNo = statement.unit.account_number;
            this.paybillNo = statement.unit.paybill_number;
          } else {
            this.accountNo = statement.property.account_number;
            this.paybillNo = statement.property.paybill_number;
          }

          // Generate the invoice content and create a Blob
          const invoiceContent = this.buildInvoiceContent();
          const blob = new Blob([invoiceContent], { type: 'text/html' });
          const file = new File([blob], 'invoice.html', { type: 'text/html' });

          // Prepare form data to send the email request to the backend
          const formData = new FormData();
          formData.append('name', statement.tenant.first_name + ' ' + statement.tenant.last_name);
          formData.append('email', statement.tenant.email_address);
          formData.append('due_water', this.dueWater);
          formData.append('due_amount', this.dueAmount);
          formData.append('account_no', this.accountNo);
          formData.append('paybill_no', this.paybillNo);
          formData.append('subject', this.rentMonth + ' Invoice Payment Reminder');
          formData.append('message', `Dear ${statement.tenant.first_name} ${statement.tenant.last_name}, this is a kind reminder that your invoice no. ${this.refNo} generated on ${this.format_date(this.createdAt)} is due on ${this.dueDate}. To service this invoice, pay via M-Pesa paybill number: ${this.paybillNo} account number: ${this.accountNo} amount: ${this.dueAmount}`);
          formData.append('invoice', file);

          try {
            await axios.post('/api/send-tenantinvoice', formData, {
              headers: { 'Content-Type': 'multipart/form-data' }
            });

            toast.fire(`To: ${statement.tenant.email_address}`, 'Email has been sent successfully.', 'success');
          } catch (error) {
            Swal.fire({
              title: 'Error sending email',
              text: error.response?.data?.message || error.message,
              icon: 'warning',
            });
          } finally {
            statement.isLoadingEmail = false; // Stop spinner for this specific row
          }
        },

        buildInvoiceContent() {
          // Determine whether to include the row
          const logoBase64 = this.logoBase64 || ''; // Fallback if no logo is provided
          const watermarkText = 'INVOICE';
          // Build the HTML content for the receipt
          const receiptHTML = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Invoice Of Payment - ${this.refNo}</title>
              <style>
                body {
                  font-family: Arial, sans-serif;
                  margin: 0;
                  padding: 0;
                  background-color: #f5f5f5;
                }
                .receipt {
                  max-width: 600px;
                  margin: 20px auto;
                  padding: 20px;
                  background-color: #fff;
                  border: 2px solid #ccc;
                  display: flex;
                  flex-direction: column;
                }
                 .watermark {
                    position: absolute;
                    top: 50%;
                    left: 50%;
                    transform: translate(-50%, -50%) rotate(-45deg);
                    font-size: 80px;
                    color: rgba(0, 0, 0, 0.1); /* Adjust the transparency as needed */
                    white-space: nowrap;
                    z-index: 0;
                    pointer-events: none; /* Prevents watermark from interfering with other elements */
                  }
                .receipt-header {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  margin-bottom: 50px;
                }
                .company-info {
                  text-align: left;
                }
                .company-info img {
                  max-width: 150px;
                  height: auto;
                }
                .receipt-info {
                  margin-bottom: 50px;
                }
                .receipt-info p {
                  margin: 5px 0;
                  color: #555;
                }
                 .additional-info {
                  margin-bottom: 30px;
                  font-size: 16px;
                  color: #333333;
                }
                .additional-info p {
                  margin: 8px 0;
                }
                .payment-info {
                  margin-bottom: 30px;
                  font-size: 16px;
                  color: #333333;
                  text-align: center;
                }
                .payment-info p {
                  margin: 8px 0;
                }
                .receipt-table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 50px;
                }
                .receipt-table th, .receipt-table td {
                  padding: 8px;
                  border-bottom: 1px solid #ccc;
                }
                .receipt-table th {
                  text-align: left;
                  background-color: #f2f2f2;
                  color: #333;
                }
                .receipt-table td {
                  text-align: left;
                  color: #666;
                }
                .receipt-footer {
                  text-align: center;
                  margin-top: auto;
                }
                .receipt-footer p {
                  margin: 5px 0;
                  color: #777;
                }
              </style>
            </head>
            <body>
            <div class="watermark">${watermarkText}</div>
              <div class="receipt">
                <div class="receipt-header">
                  <div class="company-logo">
                    <img src="${logoBase64}" alt="Company Logo" style="max-width: 150px; height: auto;">
                  </div>
                  <div class="company-info">
                    <p>Kakamega-Webuye Rd, ACK Building</p>
                    <p>Phone: (0720) 020-401 </p>
                    <p> Email: propertapril@gmail.com</p>
                    <p> Website: www.aprilproperties.co.ke</p>
                  </div>
                </div>
                <div class="receipt-info">
                  <p><strong>#${this.refNo}</strong></p>
                  <p><strong>Invoice Date:</strong> ${this.format_date(this.invoicedAt ?? 'N/A')}</p>
                  <p><strong>Due Date:</strong>  ${this.dueDate ?? 'N/A'}</p>
                  
                </div>
                <div class="additional-info">
                    <p><strong>Invoiced To</strong></p>
                    <p><strong></strong> ${this.invoicedTenantFullName}</p>
                    <p><strong></strong> ${this.name ?? 'Victoria Apartments'} - ${this.unitName}</p>
                    <p><strong></strong> ${this.rentMonth}</p>
                </div>
                <table class="receipt-table">
                  <thead>
                    <tr>
                      <th>Description</th>
                      <th>Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Total Rent Due ${this.water}</td>
                      <td>KES ${this.formatNumber(this.dueAmount)}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total Amount Due:</th>
                      <td>KES ${this.formatNumber(this.dueAmount)}</td>
                    </tr>
                  </tfoot>
                </table>
                <div class="payment-info">
                  <p><strong>Payment Options:</strong></p>
                  <p>Mobile Money: Paybill - ${this.paybillNo ?? 'N/A'} Account Number - ${this.accountNo ?? 'N/A'}</p>
                </div>
                <div class="receipt-footer">
                  <p>Printed on ${this.format_date(new Date().toLocaleString())}</p>
                </div>
              </div>
            </body>
            </html>
          `;

          return receiptHTML;
        },
        async sendWhatsAppReminder(statement, event) {
          event.preventDefault();

          /* -------------------------------
            Validate tenant phone number
          --------------------------------*/
          if (!statement.tenant || !statement.tenant.phone_number) {
            Swal.fire({
              title: 'Error Sending WhatsApp',
              text: 'Please ensure the tenant has a valid phone number.',
              icon: 'warning',
            });
            return;
          }

          /* -------------------------------
            Ensure payment methods exist
          --------------------------------*/
          if (!this.payments || !this.payments.length) {
            Swal.fire({
              title: 'Payment Methods Missing',
              text: 'No payment methods have been configured.',
              icon: 'warning',
            });
            return;
          }

          /* -------------------------------
            Calculate due date
          --------------------------------*/
          const dueDate = this.calculateDueDate(statement.rent_month);

          /* ------------------------------------
            Build payment instructions (ALL)
          -------------------------------------*/
          let paymentInstructions = '';

          this.payments.forEach((payment, index) => {
            paymentInstructions += `${index + 1}. ${payment.name} – ${payment.method}\n`;

            if (payment.method === 'MPESA Paybill') {
              paymentInstructions +=
                `   Paybill Number: ${payment.paybill_number}\n` +
                `   Account Number: ${payment.account_number}\n`;
            }

            if (payment.method === 'MPESA Till Number') {
              paymentInstructions +=
                `   Till Number: ${payment.till_number}\n`;
            }

            if (payment.method === 'Bank Transfer') {
              paymentInstructions +=
                `   Account Number: ${payment.account_number}\n`;
            }

            paymentInstructions += `\n`;
          });

          /* ------------------------------------
            WhatsApp message (PROFESSIONAL)
          -------------------------------------*/
          const message =
        `Dear ${statement.tenant.first_name} ${statement.tenant.last_name},

        We hope you are well.

        This is a courteous reminder regarding your rent invoice for the month of ${statement.rent_month}.
        Invoice Number: ${statement.ref_no}
        Invoice Date: ${this.format_date(statement.created_at)}
        Due Date: ${dueDate}

        Amount Payable: KES ${this.formatNumber(statement.total)}

        Kindly make payment using any of the following official Ingo Properties payment options:

        ${paymentInstructions}
        Once payment has been made, please share the confirmation for our records.

        Should you have any questions or require clarification, please do not hesitate to contact us.

        Warm regards,
        Ingo Properties
        Property Management Team`;

          /* ------------------------------------
            Open WhatsApp
          -------------------------------------*/
          const whatsappUrl =
            `https://api.whatsapp.com/send?phone=${statement.tenant.phone_number}` +
            `&text=${encodeURIComponent(message)}`;

          window.open(whatsappUrl, '_blank');

          /* ------------------------------------
            Success feedback
          -------------------------------------*/
          toast.fire(
            'WhatsApp Sent',
            `Reminder sent successfully to ${statement.tenant.phone_number}`,
            'success'
          );
        },
        async loadPayments() {
          const res = await axios.get('/api/lists/payments');
          this.payments = res.data.payments;
        },
        calculateDueDate(rentMonth) {
          let dueDate = new Date(rentMonth);
          dueDate.setDate(5);

          const day = String(dueDate.getDate()).padStart(2, '0');
          const month = String(dueDate.getMonth() + 1).padStart(2, '0');
          const year = dueDate.getFullYear();

          return `${day}/${month}/${year}`;
        }, 
        deleteInvoice(id){
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
            axios.delete('/api/pmsstatement/'+id).then(() => {
            toast.fire(
              'Deleted!',
              'Invoice has been deleted.',
              'success'
            )
            this.reloadLists();
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
        editInvoice(statement)
        {
          this.selectedStatement = statement;
          this.form.paid = this.selectedStatement.paid;
          this.form.balance = this.selectedStatement.balance;
          this.form.total = this.selectedStatement.total;
          this.form.water_bill = this.selectedStatement.water_bill;
          this.firstName = this.selectedStatement.tenant.first_name;
          this.lastName = this.selectedStatement.tenant.last_name;
          this.tenant = this.firstName + " " + this.lastName;
          // Show the modal after fetching data
            const modal = new bootstrap.Modal(document.getElementById('EditInvoiceModal'));
            modal.show();
        },
        async confirmEditInvoice() {
          if (this.selectedStatement && this.selectedStatement.id) {
            // Implement your logic to invoice the tenant here
            console.log("Editing invoice with statement ID:", this.selectedStatement.id);
            await this.saveEditInvoice();

            // Close the modal after invoicing
            const modal = bootstrap.Modal.getInstance(document.getElementById('EditInvoiceModal'));
            modal.hide();
            this.reloadLists()
          }
        },
        saveEditInvoice() {
            return new Promise((resolve, reject) => {
                let payload; // Define payload variable outside the if-else blocks

                  payload = {
                      total: this.form.total,
                      paid: this.form.paid,
                      balance: this.form.balance,
                      water_bill: this.form.water_bill,
                  };
               

                axios.put("/api/edit-statement/" + this.selectedStatement.id, payload)
                    .then(response => {
                        console.log(response);
                         toast.fire(
                              'Success!',
                              'Invoice updated!',
                              'success'
                          );
                        resolve(); // Resolve the promise when settleTenant completes successfully
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error); // Reject the promise if there's an error
                    });
            });
        },
        getCurrentTimestamp() {
          const now = new Date();
          const year = now.getFullYear();
          const month = String(now.getMonth() + 1).padStart(2, '0');
          const day = String(now.getDate()).padStart(2, '0');
          const hours = String(now.getHours()).padStart(2, '0');
          const minutes = String(now.getMinutes()).padStart(2, '0');
          const seconds = String(now.getSeconds()).padStart(2, '0');

          return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
        },
        async settleTenant(statement) {
          try {
            this.selectedStatement = statement;
            this.status = this.selectedStatement.status;
            this.paid = this.selectedStatement.paid;
            this.balance = this.selectedStatement.balance;
            this.total = this.selectedStatement.total;
            this.unitNumber = this.selectedStatement.tenant.pms_unit_id;
            this.propertyId = statement.pms_property_id;

            if (this.propertyId) {
              await this.getProperty(this.propertyId);
              // make sure you assign a safe fallback
              this.name = this.property?.name || statement.property?.name || 'N/A';
            }
            this.getUnit(this.unitNumber);
            this.refNo = this.selectedStatement.ref_no;
            this.firstName = this.selectedStatement.tenant.first_name;
            this.lastName = this.selectedStatement.tenant.last_name;
            this.tenant = this.firstName + " " + this.lastName;
            this.rentMonth = this.selectedStatement.rent_month;
            this.waterBillAmount = this.selectedStatement.water_bill;

            // Fetch last month's statement asynchronously
            await this.checkLastMonthStatement();

            console.log(this.selectedStatement);

            this.form.cash = ''; // Reset the form field
            this.errors.cash = ''; // Reset the error message

            // Show the modal after fetching data
            const modal = new bootstrap.Modal(document.getElementById('settleTenantModal'));
            modal.show();
          } catch (error) {
            console.error("Error settling tenant:", error);
          }
        },
        async checkLastMonthStatement() {
          try {
            const response = await axios.get('/api/pmslastmonthtenantstatements/' + this.selectedStatement.pms_tenant_id);
            if (response.data?.pmslastmonthtenantstatements?.length > 0) {
              this.lastmonthstatement = response.data.pmslastmonthtenantstatements[0];
              this.lastmonthBalance = this.lastmonthstatement.balance;
              console.log("OverPayment", this.lastmonthstatement);
            } else {
              console.log("No last month statement found for the tenant.");
            }
          } catch (error) {
            console.error("Error fetching last month tenant statements:", error);
            throw error; // Propagate the error upwards
          }
        },
        async confirmSettleTenant() {
          try {

            if (!this.form.cash) {
              this.errors.cash = 'Amount paid is required.';
              return;
            }

            if (this.selectedStatement && this.selectedStatement.id) {

              console.log("Settling tenant with statement ID:", this.selectedStatement.id);

              // 1. WAIT FOR BACKEND UPDATE FIRST
              await this.settleInvoice();

              // 2. OPEN PRINT WINDOW
              const printWindow = window.open("", "_blank");

              const receiptContent = this.buildReceiptContent();

              printWindow.document.open();
              printWindow.document.write(receiptContent);
              printWindow.document.close();

              // 3. WAIT FOR FULL RENDER
              printWindow.onload = async () => {

                try {
                  const images = Array.from(printWindow.document.images);

                  // 4. WAIT FOR IMAGE DECODING (CRITICAL FIX)
                  await Promise.all(
                    images.map(img => {
                      if (img.decode) {
                        return img.decode().catch(() => {});
                      }
                    })
                  );

                  // 5. FINAL PRINT
                  setTimeout(() => {
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                  }, 200);

                } catch (e) {
                  console.warn("Print fallback triggered:", e);
                  printWindow.print();
                  printWindow.close();
                }
              };

              toast.fire(
                'Success!',
                'Invoice updated!',
                'success'
              );

              // 6. CLOSE MODAL
              const modal = bootstrap.Modal.getInstance(
                document.getElementById('settleTenantModal')
              );
              modal.hide();

              // 7. RESET FORM
              this.form.cash = '';
              this.form.payment_method = 'Mpesa';

              this.reloadLists();
            }

          } catch (error) {
            console.error("Error in settlement:", error);
          }
        },
        settleInvoice() {
            return new Promise((resolve, reject) => {
                let payload; // Define payload variable outside the if-else blocks
                this.paid_at = this.getCurrentTimestamp();

                if (this.lastmonthBalance >= 0) {
                    payload = {
                        mpesa_code: this.form.mpesa_code,
                        payment_method: this.form.payment_method,
                        paid: Number(this.paid) + Number(this.form.cash),
                        balance: this.payableAmount,
                        paid_at: this.paid_at
                    };
                } else {
                    payload = {
                        mpesa_code: this.form.mpesa_code,
                        payment_method: this.form.payment_method,
                        paid: Number(this.paid),
                        balance: this.payableOverAmount,
                        paid_at: this.paid_at
                    };
                }

                if (this.lastmonthBalance < 0) {
                    this.updateLastMonthStatement();
                }

                axios.put("/api/pmssettlestatement/" + this.selectedStatement.id, payload)
                    .then(response => {
                        // console.log("bitch don't", response);
                        this.statement = response.data.statement;
                        this.amountPaid = this.statement.paid;
                        this.balAmount = this.statement.balance;
                        // self.step = 1;
                        // toast.fire(
                        //     'Success!',
                        //     'Invoice updated!',
                        //     'success'
                        // );
                        resolve(); // Resolve the promise when settleTenant completes successfully
                    })
                    .catch(error => {
                        console.log(error);
                        reject(error); // Reject the promise if there's an error
                    });
            });
        },
        loadLogo() {
          fetch(IngoLogo)
            .then(response => response.blob())
            .then(blob => {
              const reader = new FileReader();
              reader.readAsDataURL(blob);
              reader.onloadend = () => {
                this.logoBase64 = reader.result;
                // console.log(this.logoBase64)
              };
            })
            .catch(error => {
              console.error('Error converting image to base64:', error);
            });
        },
        async print(statement) {
            console.log("merc",statement);
            this.name = statement.property.name;
            this.firstName = statement.tenant.first_name;
            this.lastName = statement.tenant.last_name;
            this.tenant = this.firstName + " " + this.lastName;
            this.phoneNumber = statement.tenant.phone_number;
            this.unitNumber = statement.tenant.pms_unit_id;
            this.tenantId = statement.pms_tenant_id;
            this.propertyId = statement.pms_property_id;
            this.unitId = statement.pms_unit_id;
            await this.getProperty(this.propertyId);              
            this.refNo = statement.ref_no;
            this.details = statement.details;
            this.date = statement.created_at;
            this.status = statement.status;
            this.paid = statement.paid;
            // this.balance = statement.balance;
            this.balance = statement.total - statement.paid;
            this.invoiceDate = statement.updated_at;
            this.payDate = statement.created_at;
            this.rentInvoiceMonth = statement.rent_month;
            // Assuming this.payDate is already assigned with statement.created_at
            let payDate = new Date(this.payDate);

            // Create a new Date object for dueDate based on payDate
            this.dueDate = statement.rent_month;
            console.log("stevo", this.dueDate)

            this.total = statement.total;
            this.payment = statement.payment_method;
            this.statementId = statement.id;
            this.waterBill = statement.water_bill;
            if(this.total == this.paid) {
               this.paymentMethod = 'SETTLED'; 
             } 
             else{
                this.paymentMethod = 'NOT SETTLED'
             }
            //unit info
            // this.unitName = statement.unit.unit_number;
            // this.unitRent = statement.unit.monthly_rent;
            // this.unitSecurityFee = statement.unit.security_fee;
            // this.unitGarbageFee = statement.unit.garbage_fee;
            // this.unitType = statement.unit.type;

            // Open a new window for printing
            const printWindow = window.open("", "_blank");

            // Build the content for printing
            const receiptContent = this.buildPrintContent();

            // Write the content to the new window
            printWindow.document.write(receiptContent);

            // Close the document stream
            printWindow.document.close();

           // Wait for the content to be fully loaded
            printWindow.onload = function() {
                // Find the logo image element
                const logoImage = printWindow.document.querySelector('img');

                if (logoImage) {
                    // Ensure the image is loaded
                    logoImage.onload = function() {
                        // Trigger the print dialog after the image has loaded
                        printWindow.print();
                    };

                    // Handle case where the image might already be cached
                    if (logoImage.complete) {
                        logoImage.onload();  // Manually trigger onload if image is already loaded
                    }
                } else {
                    // If there's no image, just print immediately
                    printWindow.print();
                }
            };
        },
        buildPrintContent() {
          const logoBase64 = this.logoBase64;

          /* ------------------------------------
            Build Payment Methods Dynamically
          -------------------------------------*/
          let paymentMethodsHTML = '';

          this.payments.forEach((payment, index) => {
            paymentMethodsHTML += `
              <div style="margin-bottom: 12px;">
                <strong>${index + 1}. ${payment.name}</strong> (${payment.method})<br>
            `;

            if (payment.method === 'MPESA Paybill') {
              paymentMethodsHTML += `
                Paybill Number: <strong>${payment.paybill_number}</strong><br>
                Account Number: <strong>${payment.account_number}</strong><br>
              `;
            }

            if (payment.method === 'MPESA Till Number') {
              paymentMethodsHTML += `
                Till Number: <strong>${payment.till_number}</strong><br>
              `;
            }

            if (payment.method === 'Bank Transfer') {
              paymentMethodsHTML += `
                Bank Account: <strong>${payment.account_number}</strong><br>
              `;
            }

            paymentMethodsHTML += `</div>`;
          });

          /* ------------------------------------
            HTML Template
          -------------------------------------*/
          const receiptHTML = `
          <!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Rent Invoice - ${this.refNo}</title>

            <style>
              body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                color: #333;
              }

              .receipt {
                max-width: 750px;
                margin: 20px auto;
                padding: 25px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
                position: relative;
              }

              .watermark {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-45deg);
                font-size: 75px;
                color: rgba(0,0,0,0.06);
                pointer-events: none;
              }

              .header {
                display: flex;
                justify-content: space-between;
                border-bottom: 2px solid #e0e0e0;
                padding-bottom: 15px;
                margin-bottom: 25px;
              }

              .logo img {
                max-width: 150px;
              }

              .company {
                text-align: right;
                font-size: 0.95rem;
                line-height: 1.5;
              }

              .info p {
                margin: 4px 0;
                font-size: 0.95rem;
              }

              .section-title {
                font-weight: 600;
                margin-top: 20px;
                margin-bottom: 10px;
                font-size: 1rem;
              }

              .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
              }

              .table th, .table td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
              }

              .table th {
                background: #f9f9f9;
                text-align: left;
              }

              .payment-box {
                margin-top: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 6px;
              }

              .footer {
                text-align: center;
                margin-top: 25px;
                font-size: 0.85rem;
                color: #777;
              }
            </style>
          </head>

          <body>
            <div class="receipt">
              <div class="watermark">INVOICE</div>

              <!-- HEADER -->
              <div class="header">
                <div class="logo">
                  <img src="${logoBase64}" />
                </div>

                <div class="company">
                  <strong>Ingo Properties</strong><br>
                  Cosyard Business Center<br>
                  Kakamega – Mumias Road<br>
                  0759 509 462<br>
                  ingoproperties@gmail.com
                </div>
              </div>

              <!-- INVOICE INFO -->
              <div class="info">
                <p><strong>Invoice No:</strong> ${this.refNo}</p>
                <p><strong>Rent Month:</strong> ${this.rentInvoiceMonth}</p>
                <p><strong>Invoice Date:</strong> ${this.format_date(this.invoiceDate ?? 'N/A')}</p>
                <p><strong>Due Date:</strong> ${this.convertDate(this.dueDate ?? 'N/A')}</p>
                <p><strong>Status:</strong> ${this.paymentMethod}</p>
              </div>

              <!-- TENANT -->
              <div class="section-title">Invoiced To</div>
              <div class="info">
                <p>${this.tenant}</p>
                <p>${this.name}</p>
                <p>${this.details}</p>
              </div>

              <!-- CHARGES -->
              <table class="table">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Total Rent (Incl. Water)</td>
                    <td>KES ${this.formatNumber(this.total)}</td>
                  </tr>

                  <tr>
                    <td>Total Paid</td>
                    <td>KES ${this.formatNumber(this.paid)}</td>
                  </tr>
                </tbody>

                <tfoot>
                  <tr>
                    <th>Balance Due</th>
                    <th>KES ${this.formatNumber(this.balance)}</th>
                  </tr>
                </tfoot>
              </table>

              <!-- PAYMENT METHODS -->
              <div class="payment-box">
                <strong>Payment Options (Pay to Ingo Properties):</strong>
                <br><br>
                ${paymentMethodsHTML}
              </div>

              <!-- FOOTER -->
              <div class="footer">
                Generated on ${new Date().toLocaleString()}
              </div>

            </div>
          </body>
          </html>
          `;

          return receiptHTML;
        },
        printReceipt() {
          this.submit()
            .then(() => {

              this.$router.go(-1);

              const printWindow = window.open("", "_blank");

              const receiptContent = this.buildReceiptContent();

              printWindow.document.open();
              printWindow.document.write(receiptContent);
              printWindow.document.close();

              // Wait for full DOM load
              printWindow.onload = () => {

                const images = printWindow.document.images;
                let loaded = 0;

                // If no images, print immediately
                if (images.length === 0) {
                  printWindow.focus();
                  printWindow.print();
                  printWindow.close();
                  return;
                }

                // Track image loading
                for (let img of images) {

                  img.onload = () => {
                    loaded++;

                    if (loaded === images.length) {
                      setTimeout(() => {
                        printWindow.focus();
                        printWindow.print();
                        printWindow.close();
                      }, 200); // small buffer for rendering stability
                    }
                  };

                  // If already cached
                  if (img.complete) {
                    loaded++;
                  }
                }

                // Safety fallback (in case some images don't trigger onload)
                setTimeout(() => {
                  if (loaded >= images.length) {
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                  }
                }, 1500);

              };

              toast.fire(
                'Success!',
                'Receipt generated successfully!',
                'success'
              );

            })
            .catch(error => {
              console.error("Error during submission:", error);
            });
        },

        buildReceiptContent() {
          const logoBase64 = this.logoBase64;

          const showGarbageFeeRow = this.unitGarbageFee !== 0;
          const showSecurityFeeRow = this.unitSecurityFee !== 0;
          const showWaterBillRow = this.waterBillAmount > 0;

          const isFullyPaid = this.balAmount <= 0;

          const receiptHTML = `
          <!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Receipt - ${this.refNo}</title>

            <style>
              body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
                color: #333;
              }

              .receipt {
                max-width: 750px;
                margin: 20px auto;
                padding: 25px;
                background-color: #fff;
                border-radius: 10px;
                box-shadow: 0 0 15px rgba(0,0,0,0.1);
                position: relative;
              }

              .watermark {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%) rotate(-45deg);
                font-size: 70px;
                color: rgba(0,0,0,0.05);
                pointer-events: none;
                white-space: nowrap;
              }

              .receipt-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 2px solid #e0e0e0;
                padding-bottom: 15px;
                margin-bottom: 25px;
              }

              .logo img {
                max-width: 150px;
              }

              .company {
                text-align: right;
                font-size: 0.9rem;
                line-height: 1.5;
              }

              .info p {
                margin: 4px 0;
                font-size: 0.95rem;
              }

              .section-title {
                font-weight: 600;
                margin: 20px 0 10px;
                font-size: 1rem;
              }

              .table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 10px;
              }

              .table th, .table td {
                padding: 10px;
                border-bottom: 1px solid #ddd;
              }

              .table th {
                background: #f9f9f9;
                text-align: left;
              }

              .payment-highlight {
                margin-top: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 8px;
                font-size: 0.95rem;
              }

              .status {
                font-weight: bold;
                color: ${isFullyPaid ? 'green' : 'orange'};
              }

              .footer {
                text-align: center;
                margin-top: 25px;
                font-size: 0.85rem;
                color: #777;
              }
            </style>
          </head>

          <body>

            <div class="receipt">
              <div class="watermark">RECEIPT</div>

              <!-- HEADER -->
              <div class="receipt-header">
                <div class="logo">
                  <img src="${logoBase64}" />
                </div>

                <div class="company">
                  <strong>Ingo Properties</strong><br>
                  Cosyard Business Center<br>
                  Kakamega – Mumias Road<br>
                  0759 509 462<br>
                  ingoproperties@gmail.com
                </div>
              </div>

              <!-- RECEIPT INFO -->
              <div class="info">
                <p><strong>Receipt No:</strong> ${this.refNo}</p>
                <p><strong>Type:</strong> Tenant Payment Receipt</p>
                <p><strong>Date:</strong> ${new Date().toLocaleString('en-GB')}</p>
                <p><strong>Tenant:</strong> ${this.tenant}</p>
                <p><strong>Property:</strong> ${this.name}</p>
                <p><strong>Unit:</strong> ${this.unitName || this.unitNumber}</p>
                <p><strong>Payment Method:</strong> ${this.form.payment_method || 'Cash / M-PESA'}</p>
                <p><strong>Status:</strong> 
                  <span class="status">
                    ${isFullyPaid ? 'FULLY PAID' : 'PARTIALLY PAID'}
                  </span>
                </p>
              </div>

              <!-- BREAKDOWN -->
              <table class="table">
                <thead>
                  <tr>
                    <th>Description</th>
                    <th>Amount</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <td>Rent Payment</td>
                    <td>KES ${this.formatNumber(this.unitRent)}</td>
                  </tr>

                  ${showWaterBillRow ? `
                  <tr>
                    <td>Water Bill</td>
                    <td>KES ${this.formatNumber(this.waterBillAmount)}</td>
                  </tr>` : ''}

                  ${showGarbageFeeRow ? `
                  <tr>
                    <td>Garbage Collection Fee</td>
                    <td>KES ${this.formatNumber(this.unitGarbageFee)}</td>
                  </tr>` : ''}

                  ${showSecurityFeeRow ? `
                  <tr>
                    <td>Security Fee</td>
                    <td>KES ${this.formatNumber(this.unitSecurityFee)}</td>
                  </tr>` : ''}
                </tbody>

                <tfoot>
                  <tr>
                    <th>Total Amount</th>
                    <th>KES ${this.formatNumber(this.total)}</th>
                  </tr>
                  <tr>
                    <th>Amount Paid</th>
                    <th>KES ${this.formatNumber(this.amountPaid)}</th>
                  </tr>
                  <tr>
                    <th>Outstanding Balance</th>
                    <th>KES ${this.formatNumber(this.balAmount)}</th>
                  </tr>
                </tfoot>
              </table>

              <!-- PAYMENT NOTE -->
              <div class="payment-highlight">
                Payment has been applied to rent and associated charges for this billing period.
              </div>

              <!-- AUDIT FOOTER -->
              <div class="footer">
                Prepared by: ${this.user.first_name} ${this.user.last_name} <br>
                Generated At: ${new Date().toLocaleString('en-GB', { hour12: false })} <br><br>
                This is a computer-generated receipt and does not require a signature.
              </div>

            </div>

          </body>
          </html>
          `;

          return receiptHTML;
        },
        updateLastMonthStatement() {
            axios.put('/api/pmslastmonthtenantstatement/' + this.$route.params.tenantId)
                .then((response) => {
                        console.log("Tenant.", response);
                })
                .catch((error) => {
                    console.error("Error fetching last month tenant statements:", error);
                });
        },
         convertDate(dateStr) {
          const date = new Date(dateStr);
          const day = String(date.getDate()).padStart(2, '0');
          const month = String(date.getMonth() + 1).padStart(2, '0');
          const year = date.getFullYear();

          return `${day}/${month}/${year}`;
        },
        applyOverPayment()
        {
          this.overPayment = true;
          this.newTotal =  this.total + this.lastmonthstatement.balance;
          this.paid = -this.lastmonthstatement.balance + this.form.cash;
          console.log("changed", this.newTotal)
        },
        getUnit(unitNumber) {
            axios.get('/api/pmsunit/' + parseInt(unitNumber))
                .then((response) => {
                  this.unit = response.data.unit;
                  this.unitName = this.unit.unit_number;
                  this.unitRent = this.unit.monthly_rent;
                  this.unitSecurityFee = this.unit.security_fee;
                  this.unitGarbageFee = this.unit.garbage_fee;
                  this.unitType = this.unit.type;
                    console.log("unit", response);
                    // Further processing of the response data if needed
                })
                .catch((error) => {
                    console.error("Error fetching unit:", error);
                });
        },
        exportToExcel() {
          const invoicesData = this.statements.map(statement => ({
            "H/S NO": statement.unit ? statement.unit.unit_number : 'N/A',
            "TENANT": statement.tenant ? statement.tenant.first_name + ' ' + statement.tenant.last_name : 'N/A',
            "DUE": this.formatNumber(statement.total),
            "RENT": statement.unit ? this.formatNumber(statement.unit.monthly_rent) : 'N/A',
            "GARBAGE": statement.unit ? this.formatNumber(statement.unit.garbage_fee) : 'N/A',
            "WATER": this.formatNumber(statement.water_bill ?? "N/A"),
            "PAID": this.formatNumber(statement.paid),
            "BALANCE": this.formatNumber(statement.balance),
          }));

          const worksheet = XLSX.utils.json_to_sheet(invoicesData);
          const workbook = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(workbook, worksheet, "INVOICES TO SETTLE");

          XLSX.writeFile(workbook, "INVOICES TO SETTLE.xlsx");
        },
        capitalizeFirstLetter(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
        },
        formatMonth(value){
            if(value){
              return moment(String(value)).format('MMM YYYY');
            }
        },
        formatNumber(value) {
            // Check if the value is not a number
            if (isNaN(value)) {
                return value; // Return as it is
            }
            
            // Convert the value to a string
            let stringValue = value.toString();

            // Split the string into integer and decimal parts
            let parts = stringValue.split('.');

            // Format the integer part with commas
            parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');

            // If there's a decimal part, limit it to 2 decimal places
            if (parts.length > 1) {
                parts[1] = parts[1].substring(0, 2);
            } else {
                parts.push('00'); // If no decimal part exists, append '00'
            }

            // Join the parts back together with a decimal point
            return parts.join('.');
        },

        format_date(value){
          if(value){
            return moment(String(value)).format('DD/MM/YYYY')
          }
        },
        capitalizeFirstLetter(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
        },
        async loginUwazii() {
          try {
            const data = JSON.stringify({
              "username": "Ingo_Properties",
              "password": "Mosobo*123#"
            });

            const config = {
              method: 'post',
              maxBodyLength: Infinity,
              url: 'https://restapi.uwaziimobile.com/v1/authorize',
              headers: {
                'Content-Type': 'application/json'
              },
              data: data
            };

            const response = await axios(config);
            this.authorizationCode = response.data.data.authorization_code; // Save authorizationCode into this.authorizationCode
            console.log(this.authorizationCode);
          } catch (error) {
            console.log(error);
          }
        },

        async getAccessToken() {
          try {
            const data = JSON.stringify({
              "authorization_code": this.authorizationCode
            });

            const config = {
              method: 'post',
              maxBodyLength: Infinity,
              url: 'https://restapi.uwaziimobile.com/v1/accesstoken',
              headers: {
                'Content-Type': 'application/json'
              },
              data: data
            };

            const response = await axios(config);
            this.accessToken = response.data.data.access_token; // Save accessToken into this.accessToken
            console.log(this.accessToken);
          } catch (error) {
            console.log(error);
          }
        },

        async sendSms() {
          await this.loginUwazii();
          await this.getAccessToken();

          //Uncomment and use this block to send an SMS once the token is obtained.
          // try {
          //   const data = JSON.stringify({
          //     "senderID": "Uwazii",
          //     "text": "Hello Mark, We send sms to #number#",
          //     "type": "sms",
          //     "number": [
          //       "254790659917"
          //     ],
          //     // "id_group": [17],
          //     // "id_group_excluded": [24, 26]
          //   });

          //   const config = {
          //     method: 'post',
          //     maxBodyLength: Infinity,
          //     url: 'https://restapi.uwaziimobile.com/v1/send',
          //     headers: {
          //       'X-Access-Token': this.accessToken,
          //       'Content-Type': 'application/json'
          //     },
          //     data: data
          //   };

          //   const response = await axios(config);
          //   console.log(JSON.stringify(response.data));
          // } catch (error) {
          //   console.log(error);
          // }

          const payload = {
                'token' : this.accessToken,
          }
                axios.post('/api/sendsms', payload )
                .then((response) => {
                        console.log("sms status", response);
                })
                .catch((error) => {
                    console.error("Error sending sms:", error);
                });
        },

        getFormattedDate() {
          const today = new Date();
          const year = today.getFullYear();
          const month = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
          const day = String(today.getDate()).padStart(2, '0');

          return `${year}-${month}-${day}`;
        },


        generatePDF() {
            let pdfName = 'Full Statement';
            var doc = new jsPDF('landscape');
            const maxRowsPerPage = 13; // Adjust this value based on the number of rows you want per page

            // Add top-left header
            const rightHeaderText = 'Ingo Properties\nKakamega-Webuye Rd, ACK Building\nTel: 0720 020 401\nP. O. Box 2973-50100, Kakamega\nEmail: propertIngo@gmail.com';
            const rightHeaderFontSize = 12;
            const rightheaderX = 20; // Adjust the X coordinate
            const rightheaderY = 10;

            doc.setFontSize(rightHeaderFontSize);
            doc.setTextColor(44, 62, 80);
            doc.text(rightHeaderText, rightheaderX, rightheaderY, { align: 'left' });

            // Add top-right header
            const headerText = 'Generated on: ' + new Date().toLocaleString();
            const headerFontSize = 12;
            const headerX = doc.internal.pageSize.width - 20; // Adjust the X coordinate
            const headerY = 10;

            doc.setFontSize(headerFontSize);
            doc.setTextColor(44, 62, 80);
            doc.text(headerText, headerX, headerY, { align: 'right' });

            // Add image at the top
            const imageUrl = '/images/apex-logo.png'; // Replace with the URL of your image
            const imageWidth = 50; // Adjust the width of the image as needed
            const imageHeight = 50; // Adjust the height of the image as needed
            const imageX = (doc.internal.pageSize.width - imageWidth) / 2;
            const imageY = 20;
            doc.addImage(imageUrl, 'JPEG', imageX, imageY, imageWidth, imageHeight);

           // Add title
            const titleText = (' Full Rent Statement').toUpperCase();
            const titleFontSize = 18;
            const titleWidth = doc.getStringUnitWidth(titleText) * titleFontSize / doc.internal.scaleFactor;
            const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
            const titleY = imageY + imageHeight + 10;

            doc.setFontSize(titleFontSize);
            doc.setTextColor(44, 62, 80); // Set text color to a dark shade
            doc.text(titleText, titleX, titleY);



            // // Add subtitle with date information
            // doc.setFontSize(14);
            // doc.setTextColor(52, 73, 94); // Set text color to a slightly lighter shade
            // doc.text('Generated on: ' + new Date().toLocaleString(), 20, imageY + imageHeight + 20);

            const netRentTotal = this.totalPaid - this.totalAmountPaid;          

            doc.setFontSize(14);
            doc.setTextColor(52, 73, 94); // Set text color to a slightly lighter shade

            let textY = imageY + imageHeight + 20; // Initial y-coordinate for the first text

            doc.text('Total Rent Collected: '  + 'KES ' + this.formatNumber(this.totalPaid), 20, textY);
            textY += 10; // Increment y-coordinate for the next text

            doc.text('Total Expenses Incurred: '  + 'KES ' + this.formatNumber(this.totalAmountPaid), 20, textY);
            textY += 10; // Increment y-coordinate for the next text

            doc.text('Total Rent Less Expenses: ' + 'KES ' + this.formatNumber(netRentTotal) , 20, textY);
            textY += 10; // Increment y-coordinate for the next text
            

            doc.setFontSize(12);
            doc.setTextColor(0);

            let headerYPos = imageY + imageHeight + 45;
            let cellHeight = 10;
            let cellPadding = 2;
            let lineHeight = 5;
            let columnWidths = [60, 30, 70, 30, 30, 30];
            let columnHeaders = ['Invoiced On', 'Status', 'Detail', 'Total', 'Paid', 'Bal'];

            let xPos = 20;
            doc.setDrawColor(0);

            for (let i = 0; i < columnWidths.length; i++) {
                doc.rect(xPos, headerYPos, columnWidths[i], cellHeight);
                doc.setTextColor(0); // Set text color to black
                doc.text(columnHeaders[i], xPos + cellPadding, headerYPos + cellHeight - cellPadding);
                xPos += columnWidths[i];
            }


            let currentPage = 1;
            let currentRow = 0;

            this.statements.forEach((statement, index) => {
                if (currentRow >= maxRowsPerPage) {
                    doc.addPage();
                    headerYPos = 20;
                    currentRow = 0;
                    currentPage++;
                    xPos = 20;
                    for (let i = 0; i < columnWidths.length; i++) {
                        doc.rect(xPos, headerYPos, columnWidths[i], cellHeight, 'F');
                        doc.setTextColor(0); // Set text color to black
                        doc.text(columnHeaders[i], xPos + cellPadding, headerYPos + cellHeight - cellPadding);
                        xPos += columnWidths[i];
                    }
                    headerYPos += cellHeight;
                }

                let yPos = headerYPos + (currentRow + 1) * lineHeight;
                xPos = 20;
                for (let i = 0; i < columnWidths.length; i++) {
                    doc.rect(xPos, yPos, columnWidths[i], cellHeight);
                    switch (i) {
                        case 0:
                            doc.text(this.format_date(statement.updated_at), xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                        case 1:
                        let statusText;

                        if (statement.status === 1) {
                            statusText = 'Settled';
                        } else if (statement.status === 0) {
                            statusText = 'Not Settled';
                        } else {
                            statusText = 'Vacant';
                        }
                            doc.text(statusText, xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                        case 2:
                            doc.text(statement.details, xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                        case 3:
                            doc.text(this.formatNumber(statement.total), xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                        case 4:
                            doc.text(this.formatNumber(statement.paid), xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                        case 5:
                            doc.text(this.formatNumber(statement.balance), xPos + cellPadding, yPos + cellHeight - cellPadding);
                            break;
                    }
                    xPos += columnWidths[i];
                }
                currentRow++;

            });
            

            // Add subtitle with date information
            
            // Add footer
            doc.setFontSize(10);
            doc.text('Generated on: ' + new Date().toLocaleString(), 20, doc.internal.pageSize.height - 10);



            // Call the function to add expenses to the PDF with pagination
            let totalPages = this.addExpensesToPDF(this.expenses, doc);
            // Save the PDF
            // let fileName = 'Full Statement' + '_Page_' + currentPage + '.pdf';
            let fileName = 'Full Statement' + '_Total_Pages_' + totalPages + '.pdf';

            doc.save(fileName);
        },
        // Function to add expenses to the PDF with pagination
        addExpensesToPDF(expenses, doc) {
            // Add content headers for expenses
            doc.addPage(); // Add a new page for Expenses
            doc.setFontSize(14);
            doc.setTextColor(44, 62, 80);
            doc.text('Expenses', 20, 20);

            doc.setFontSize(12);
            doc.setTextColor(0);

            // Draw table headers and borders dynamically based on the HTML structure
            let expenseHeaderYPos = 30;
            let expenseCellHeight = 10;
            let expenseCellPadding = 2;
            let expenseLineHeight = 5;
            let expenseColumnWidths = [60, 40, 60, 30, 60];

            // Define column headers for Expenses
            let expenseColumnHeaders = ['Type', 'Amount(KES)', 'Expended To', 'Checked By', 'Checked On'];

            // Draw headers with borders dynamically based on calculated column widths
            let expenseXPos = 20;
            doc.setDrawColor(0);
            doc.setFillColor(255, 255, 255); // Set header background color to white

            for (let i = 0; i < expenseColumnWidths.length; i++) {
                doc.setFillColor(255, 255, 255); // Set fill color to white
                doc.rect(expenseXPos, expenseHeaderYPos, expenseColumnWidths[i], expenseCellHeight, 'F');
                doc.setTextColor(0); // Set text color to black
                doc.text(expenseColumnHeaders[i], expenseXPos + expenseCellPadding, expenseHeaderYPos + expenseCellHeight - expenseCellPadding);
                expenseXPos += expenseColumnWidths[i];
            }


            let currentPage = 1;
            let currentRow = 0;
            const maxRowsPerPage = 28; // Adjust this value based on the number of rows you want per page

            // Iterate through expenses and add them to the PDF with dynamic borders
            expenses.forEach((expense, index) => {
                if (currentRow >= maxRowsPerPage) {
                    doc.addPage(); // Add a new page if the maximum rows per page is exceeded
                    expenseHeaderYPos = 20;
                    currentRow = 0;
                    currentPage++;
                    expenseXPos = 20;
                    // Draw headers for expenses on new page
                    for (let i = 0; i < expenseColumnWidths.length; i++) {
                        doc.rect(expenseXPos, expenseHeaderYPos, expenseColumnWidths[i], expenseCellHeight, 'F');
                        doc.setTextColor(0); // Set text color to black
                        doc.text(expenseColumnHeaders[i], expenseXPos + expenseCellPadding, expenseHeaderYPos + expenseCellHeight - expenseCellPadding);
                        expenseXPos += expenseColumnWidths[i];
                    }
                    expenseHeaderYPos += expenseCellHeight;
                }

                let yPos = expenseHeaderYPos + (currentRow + 1) * expenseLineHeight;
                expenseXPos = 20;
                // Add expense data
                for (let i = 0; i < expenseColumnWidths.length; i++) {
                    doc.rect(expenseXPos, yPos, expenseColumnWidths[i], expenseCellHeight);
                    switch (i) {
                        case 0:
                            doc.text(this.capitalizeFirstLetter(expense.payment_type), expenseXPos + expenseCellPadding, yPos + expenseCellHeight - expenseCellPadding);
                            break;
                        case 1:
                            doc.text(this.formatNumber(expense.amount_paid), expenseXPos + expenseCellPadding, yPos + expenseCellHeight - expenseCellPadding);
                            break;
                        case 2:
                            doc.text(expense.paid_to, expenseXPos + expenseCellPadding, yPos + expenseCellHeight - expenseCellPadding);
                            break;
                        case 3:
                            doc.text(`${expense.user.first_name} ${expense.user.last_name}`, expenseXPos + expenseCellPadding, yPos + expenseCellHeight - expenseCellPadding);
                            break;
                        case 4:
                            doc.text(this.format_date(expense.created_at), expenseXPos + expenseCellPadding, yPos + expenseCellHeight - expenseCellPadding);
                            break;
                    }
                    expenseXPos += expenseColumnWidths[i];
                }
                currentRow++;
            });
  
            doc.setFontSize(10);
            doc.text('Generated on: ' + new Date().toLocaleString(), 20, doc.internal.pageSize.height - 10);

            return currentPage; // Return the total number of pages used for expenses
        },
        async getProperty() {
            try {
                const response = await axios.get('/api/pmsproperty/' + this.propertyId);
                this.property = response.data.property;
                this.accountNo = response.data.property.account_number;
                this.paybillNo = response.data.property.paybill_number;
                console.log("property", response);
            } catch (error) {
                console.error("Error fetching property data:", error);
            }
        },

        async getUnitInfo() {
            try {
                const response = await axios.get(`/api/pmsunit/${this.unitId}`);
                this.unit = response.data.unit;
                this.accountNo = response.data.unit.account_number;
                this.paybillNo = response.data.unit.paybill_number;
                console.log("Ingothings", response);
            } catch (error) {
                console.error("Error fetching unit data:", error);
            }
        },

        loadLists() {
          this.isLoadingStatements = true; // 👈 start spinner

          axios.get('api/lists/invoices-to-settle')
            .then((response) => {
              this.statements = response.data.invoicestosettle;
              this.awaitinginvoicing = response.data.awaitinginvoicing;
              this.invoicestosettlesmsnotsent = response.data.invoicestosettlesmsnotsent;
              this.invoicestosettlesmssent = response.data.invoicestosettlesmssent;
              this.expenses = response.data.pmsexpenses;

              this.totalAmountPaid = this.calculateTotalAmountPaid();

              setTimeout(() => {
                  $("#AllStatementsTable").DataTable();
              }, 10);
            })
            .catch((error) => {
              console.error(error);
            })
            .finally(() => {
              this.isLoadingStatements = false; // 👈 stop spinner
            });
        }, 
        reloadLists() {
          this.isLoadingStatements = true; // 👈 start spinner

          axios.get('api/lists/invoices-to-settle')
            .then((response) => {
              this.statements = response.data.invoicestosettle;
              this.awaitinginvoicing = response.data.awaitinginvoicing;
              this.invoicestosettlesmsnotsent = response.data.invoicestosettlesmsnotsent;
              this.invoicestosettlesmssent = response.data.invoicestosettlesmssent;
              this.expenses = response.data.pmsexpenses;

              this.totalAmountPaid = this.calculateTotalAmountPaid();

            })
            .catch((error) => {
              console.error(error);
            })
            .finally(() => {
              this.isLoadingStatements = false; // 👈 stop spinner
            });
        },                
        calculateTotalAmountPaid() {
        if (!this.expenses || this.expenses.length === 0) {
              return 0; // If expenses data is empty or undefined, return 0
            }

            // Use reduce to sum up the amount_paid property for all expenses
            return this.expenses.reduce((total, expense) => total + expense.amount_paid, 0);
        },
        calculateTotal(property) {
          // Function to calculate total for Total, Paid, and Bal columns

          return this.statements.reduce((total, statement) => total + (statement[property] || 0), 0);
        },
      },
      components : {
          TheMaster,
      },
      computed:
      {
        // Computed property to calculate total due
        totalDue() {
          return this.calculateTotal('total');
        },
        // Computed property to calculate total paid
        totalPaid() {
          return this.calculateTotal('paid');
        },
        // Computed property to calculate total balance
        totalBalance() {
          return this.calculateTotal('balance');
        },
        payableAmount() {

            if (this.paid > 0) {
              return this.balance - this.form.cash;
            }
            else
            {
               return this.total - this.form.cash; // Multiply inputValue by 2 (change this multiplier as needed)
            } 
          
       
        },
        payableOverAmount() {
            return this.total - this.paid; // Multiply inputValue by 2 (change this multiplier as needed                              
        }, 
      },      
      mounted(){
        this.loadLists();
        this.loadPayments();
        this.loadLogo();                        
        // this.loginUwazii();
        this.formattedDate = this.getFormattedDate();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);

      }
    }
    </script>
    
    
    