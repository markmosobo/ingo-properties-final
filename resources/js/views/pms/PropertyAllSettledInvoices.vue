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
    
                        <li>
                            <router-link :to="`/propertysettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
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
                            <router-link :to="`/propertylastmonthsettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            Last Month</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="`/propertylastninetysettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            Last 90 Days</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="`/propertyquartersettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            This Quarter</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="`/propertylastyearsettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            Last Year</a>
                            </router-link>
                        </li>
                        <li>
                            <router-link :to="`/propertyallsettledinvoices/${propertyId}`" custom v-slot="{ href, navigate, isActive }">
                            <a
                                :href="href"
                                :class="{ active: isActive }"
                                class="dropdown-item"
                                @click="navigate"
                            >
                            All Time</a>
                            </router-link>
                        </li>

                      </ul>
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">Settled Invoices - {{property.name}} <span>| All Time</span></h5>
                      <p class="card-text">
                   
<!--                       <router-link to="/add-pmslandlord" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Landlord
                          </a>
                      </router-link> -->
                      <div class="row">
                        <div class="col d-flex">
                          <button class="me-2" v-if="statements.length !== 0" @click="exportToExcel">Export</button>
                          <button v-if="statements.length !== 0" @click="printInvoice" class="me-2">Print Invoice</button>
                          <button v-if="statements.length !== 0" @click="generatePDF">Generate Rent Statement</button>
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
                            <th scope="col">H/S No.</th>
                            <th scope="col">Tenant</th>
                            <th scope="col">Due</th>
                            <th scope="col">Rent</th>
                            <th scope="col">Garbage</th>
                            <th scope="col">Water</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Paid On</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="statement in statements" :key="statement.id">
                            <td>{{ statement.unit_number ?? 'N/A' }}</td>
                            <td>{{ statement.tenant ? statement.tenant.first_name + ' ' + statement.tenant.last_name : 'N/A' }}</td>
                            <td>{{formatNumber(statement.total)}}</td>
                            <td>{{ statement.unit ? formatNumber(statement.unit.monthly_rent) : 'N/A' }}</td>
                            <td>{{ statement.unit ? formatNumber(statement.unit.garbage_fee) : 'N/A' }}</td>
                            <td>{{formatNumber(statement.water_bill ?? "N/A")}}</td>
                            <td>{{formatNumber(statement.paid)}}</td>
                            <td>{{format_date(statement.paid_at)}}</td>
                            <td>
                              <span v-if="statement.status == 0 && statement.water_bill == null" class="badge bg-info text-dark"><i class="bi bi-clipboard2-x"></i> Not Invoiced</span>
                              <span v-else-if="statement.status == 1" class="badge bg-success"><i class="bi bi-clipboard2-check"></i> Settled</span>
                              <span v-else-if="statement.status == 0 && statement.water_bill !== null" class="badge bg-warning text-dark"><i class="bi bi-clipboard2-x"></i> Not Settled</span>
                              <span v-else class="badge bg-dark text-light"><i class="bi bi-exclamation-triangle me-1"></i> Vacant</span>
                            </td>
                            <!-- <td>{{format_date(statement.created_at)}}</td> -->
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/viewstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <a @click="printReceipt(statement)" class="dropdown-item" href="#"><i class="ri-printer-line mr-2"></i>Print Receipt</a>
                  
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
                    <div class="modal fade" id="invoiceTenantModal" tabindex="-1" aria-labelledby="invoiceTenantModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="invoiceTenantModalLabel">Invoice Tenant</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <p>#{{selectedStatement.ref_no}}</p>
                            <p v-if="selectedStatement && selectedStatement.tenant">
                              <strong>Tenant Name:</strong> {{ selectedStatement.tenant.first_name }} {{ selectedStatement.tenant.last_name }}
                            </p>
                            <p v-else>
                              <strong>Tenant Name:</strong> N/A
                            </p>
                            <p v-if="selectedStatement">
                              <strong>Amount Due:</strong> {{ formatNumber(selectedStatement.total) }}
                            </p>
                            <p v-else>
                              <strong>Amount Due:</strong> N/A
                            </p>
                            <p>
                              <strong>Water Bill:</strong>
                              <input type="number" name="water_bill" v-model="form.water_bill" class="form-control">
                              <div v-if="errors.water_bill" class="text-danger">{{ errors.water_bill }}</div>
                            </p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                              <button type="button" style="background-color: darkgreen; border-color: darkgreen;" class="btn btn-primary" @click="confirmInvoiceTenant">
                              <span v-if="loading">
                                <i class="fa fa-spinner fa-spin"></i> Invoicing...
                              </span>
                              <span v-else>
                                Invoice Tenant
                              </span>
                            </button>
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
            allstatements: [],
            collectedTotal: 0,
            expensesTotal: 0,
            user: [],
            property: '',
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
            statementId: '',
            waterBill: '',
            unitRent: '',
            unitSecurityFee: '',
            unitGarbageFee: '',
            unitName: '',
            payment: '',
            date: new Date(), // Current date,
            currentTime: '',
            currentMonth:'',
            unitsNo: '',
            currentDate: '',
            netRemmission: '',
            rentLessCommission: '',
            landlordPhone: '',
            landlordEmail: '',
            landlordAddress: '',
            logoBase64: '',
            propertyId: '',
            selectedStatement: {}, // Initialize as an empty object
            form: {
              water_bill : ''
            },
            errors: {
              water_bill: ''
            },
            loading: false,
            isLoadingStatements: false,


        }
      },
      // created() {
      //   this.loadLogo();
      // },
      methods: {
        navigateTo(location){
            this.$router.push(location)
        },
         invoiceTenant(id){
            this.$router.push('invoicestatement/'+id)
        },
        settleTenant(id, tenantId){
            // this.$router.push('/settlestatement/'+id)
            this.$router.push({ 
              name: 'settlestatement', // Assuming you have named routes
              params: { 
                id: id,
                tenantId: tenantId
              } 
            });

        },
        capitalizeFirstLetter(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
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
        loadLogo() {
          fetch(IngoLogo)
            .then(response => response.blob())
            .then(blob => {
              const reader = new FileReader();
              reader.readAsDataURL(blob);
              reader.onloadend = () => {
                this.logoBase64 = reader.result;
                console.log(this.logoBase64)
              };
            })
            .catch(error => {
              console.error('Error converting image to base64:', error);
            });
        },
        printInvoice(){
            // Open a new window for printing
            const printWindow = window.open("", "_blank");

            // Build the content for printing
            const invoiceContent = this.buildInvoiceContent();

            // Write the content to the new window
            printWindow.document.write(invoiceContent);

            // Close the document stream
            printWindow.document.close();

            // Trigger the print dialog
            printWindow.print();
        },
        buildInvoiceContent(refNo) {
          const showExpensesDeductionRow = this.expenses !== 0;
          const logoBase64 = this.logoBase64;

          const receiptHTML = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Invoice Of Payment</title>
              <style>
                body {
                  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                  margin: 0;
                  padding: 0;
                  background-color: #f4f4f4;
                  color: #333;
                }
                .receipt {
                  max-width: 700px;
                  margin: 20px auto;
                  padding: 25px;
                  background-color: #fff;
                  border-radius: 10px;
                  box-shadow: 0 0 15px rgba(0,0,0,0.1);
                }
                .receipt-header {
                  display: flex;
                  justify-content: space-between;
                  align-items: center;
                  margin-bottom: 30px;
                  border-bottom: 2px solid #e0e0e0;
                  padding-bottom: 15px;
                }
                .company-logo img {
                  max-width: 160px;
                  height: auto;
                }
                .company-info {
                  text-align: right;
                  line-height: 1.5;
                }
                .company-info p {
                  margin: 2px 0;
                  font-size: 0.95rem;
                }
                .receipt-info {
                  margin-bottom: 25px;
                }
                .receipt-info p {
                  margin: 4px 0;
                  font-size: 0.95rem;
                }
                .receipt-info strong {
                  display: inline-block;
                  width: 150px;
                }
                .receipt-table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 20px;
                  font-size: 0.95rem;
                }
                .receipt-table th, .receipt-table td {
                  padding: 10px;
                  border-bottom: 1px solid #ddd;
                }
                .receipt-table th {
                  background-color: #f9f9f9;
                  text-align: left;
                }
                .receipt-table td {
                  text-align: left;
                }
                .receipt-table tfoot th, .receipt-table tfoot td {
                  font-weight: bold;
                  font-size: 1rem;
                }
                .receipt-footer {
                  text-align: center;
                  font-size: 0.85rem;
                  color: #777;
                  margin-top: 20px;
                }
              </style>
            </head>
            <body>
              <div class="receipt">
                <div class="receipt-header">
                  <div class="company-logo">
                    <img src="${logoBase64}" alt="Company Logo">
                  </div>
                  <div class="company-info">
                    <p>Cosyard Business Center</p>
                    <p>Kakamega Mumias Road, Kakamega</p>
                    <p>Phone: 0759509462</p>
                    <p>Email: ingoproperties@gmail.com</p>
                  </div>
                </div>

                <div class="receipt-info">
                  <p><strong>Invoice For:</strong> ${this.landlord}</p>
                  <p><strong>Property:</strong> ${this.property.name} - ${this.unitsNo} Units</p>
                  <p><strong>Month:</strong> ${this.currentMonth}</p>
                  <p><strong>Date:</strong> ${new Date().toLocaleString()}</p>
                  <p><strong>Payment Status:</strong> Unsettled</p>
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
                      <td>Total Rent Less Commission</td>
                      <td>KES ${this.formatNumber(this.rentLessCommission)}</td>
                    </tr>
                    <tr>
                      <td>Total Due Remitted</td>
                      <td>KES ${this.formatNumber(this.totalPaid)}</td>
                    </tr>
                    ${showExpensesDeductionRow ? `
                    <tr>
                      <td>Total Expenses</td>
                      <td>KES ${this.formatNumber(this.totalAmountPaid)}</td>
                    </tr>
                    ` : ''}
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Net Remission:</th>
                      <td>KES ${this.formatNumber(this.netRemmission)}</td>
                    </tr>
                  </tfoot>
                </table>

                <div class="receipt-footer">
                  <p>PDF Generated on ${new Date().toLocaleDateString()}</p>
                </div>
              </div>
            </body>
            </html>
          `;

          return receiptHTML;
        },

        exportToExcel() {
          const invoicesData = this.statements.map(statement => ({
            "PROPERTY": statement.property ? statement.property.name : 'N/A',
            "H/S NO": statement.unit ? statement.unit.unit_number : 'N/A',
            "TENANT": statement.tenant ? statement.tenant.first_name + ' ' + statement.tenant.last_name : 'N/A',
            "DUE": this.formatNumber(statement.total),
            "RENT": statement.unit ? this.formatNumber(statement.unit.monthly_rent) : 'N/A',
            "GARBAGE": statement.unit ? this.formatNumber(statement.unit.garbage_fee) : 'N/A',
            "WATER": this.formatNumber(statement.water_bill ?? "N/A"),
            "PAID": this.formatNumber(statement.paid),
            "BALANCE": this.formatNumber(statement.balance),
            "PAID ON": this.format_date(statement.paid_at ?? "N/A"),
          }));

          const worksheet = XLSX.utils.json_to_sheet(invoicesData);
          const workbook = XLSX.utils.book_new();
          XLSX.utils.book_append_sheet(workbook, worksheet, "SETTLED INVOICES");

          // Customize the filename with a timestamp
          const timestamp = new Date().toISOString().slice(0, 19).replace(/-/g, "").replace(/:/g, "").replace(/T/g, "_");
          const filename = `SETTLED_INVOICES_${timestamp}.xlsx`;
          
          XLSX.writeFile(workbook, filename);
        },
        generatePDF() {
            // Safe values
            const commissionPercent = this.property.commission ?? 0;
            const totalPaid = this.totalPaid ?? 0;
            const totalExpenses = this.totalAmountPaid ?? 0;

            const commissionTotal = (commissionPercent / 100) * totalPaid;
            const netRemmission = totalPaid - (totalExpenses + commissionTotal);
            const rentLessCommission = totalPaid - commissionTotal;

            const doc = new jsPDF('portrait', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.getWidth();
            
            // ----- HEADER -----
            // Logo on left
            const logoWidth = 40;
            const logoHeight = 20;
            const logoX = 20;
            const logoY = 10;
            const logoImg = this.logoBase64 || '/images/apex-logo.png'; // fallback logo
            doc.addImage(logoImg, 'PNG', logoX, logoY, logoWidth, logoHeight);

            // Company info on right
            const infoX = pageWidth - 20;
            const infoY = 10;
            doc.setFontSize(12);
            doc.setTextColor(33, 37, 41);
            doc.text("Ingo Properties", infoX, infoY, { align: 'right' });
            doc.text("Cosyard Business Centre, Kakamega Mumias Road", infoX, infoY + 6, { align: 'right' });
            doc.text("Tel: 0759509462 | Email: ingoproperties@gmail.com", infoX, infoY + 12, { align: 'right' });

            // ----- TITLE -----
            doc.setFontSize(16);
            doc.setTextColor(0, 0, 0);
            const title = `${this.property.name} ${this.currentMonth} Rent Statement`.toUpperCase();
            doc.text(title, pageWidth / 2, logoY + 35, { align: 'center' });

            // ----- PROPERTY & LANDLORD INFO -----
            doc.setFontSize(11);
            doc.setTextColor(50, 50, 50);
            const propY = logoY + 45;
            doc.text(`Statement For: ${this.landlord}`, 20, propY);
            doc.text(`Property: ${this.property.name} (${this.unitsNo} Units)`, 20, propY + 6);
            doc.text(`Phone: ${this.landlordPhone} | Email: ${this.landlordEmail}`, 20, propY + 12);
            doc.text(`Generated On: ${new Date().toLocaleString()}`, 20, propY + 18);
            doc.text(`Payment Status: Unsettled`, 20, propY + 24);

            // ----- SUMMARY BOX -----
            const boxY = propY + 32;
            doc.setDrawColor(200);
            doc.setFillColor(245, 245, 245);
            doc.rect(20, boxY, pageWidth - 40, 28, 'FD');

            doc.setFontSize(11);
            doc.setTextColor(0);
            doc.text(`Total Rent Less Commission: KES ${this.formatNumber(rentLessCommission)}`, 25, boxY + 8);
            doc.text(`Total Due Remitted: KES ${this.formatNumber(totalPaid)}`, 25, boxY + 14);
            doc.text(`Total Expenses: KES ${this.formatNumber(totalExpenses)}`, 25, boxY + 20);
            doc.text(`Net Remission: KES ${this.formatNumber(netRemmission)}`, pageWidth - 25, boxY + 20, { align: 'right' });

            // ----- TABLE OF STATEMENTS -----
            const headers = ['H/S No.', 'Tenant Name', 'Due', 'Rent', 'Garbage', 'Water', 'Paid', 'Balance', 'Date Paid'];
            const columnWidths = [20, 50, 20, 20, 20, 20, 20, 20, 30];
            let tableY = boxY + 38;

            doc.setFontSize(10);
            doc.setTextColor(33, 37, 41);
            
            // Draw headers
            let xPos = 20;
            headers.forEach((header, i) => {
                doc.setFillColor(220, 220, 220);
                doc.rect(xPos, tableY, columnWidths[i], 8, 'FD');
                doc.text(header, xPos + 2, tableY + 6);
                xPos += columnWidths[i];
            });

            let rowY = tableY + 8;
            const maxRowsPerPage = 25;
            let currentRow = 0;

            this.allstatements.forEach(statement => {
                if (currentRow >= maxRowsPerPage) {
                    doc.addPage();
                    rowY = 20;
                    currentRow = 0;

                    // Redraw table headers on new page
                    xPos = 20;
                    headers.forEach((header, i) => {
                        doc.setFillColor(220, 220, 220);
                        doc.rect(xPos, rowY, columnWidths[i], 8, 'FD');
                        doc.text(header, xPos + 2, rowY + 6);
                        xPos += columnWidths[i];
                    });
                    rowY += 8;
                }

                xPos = 20;
                const values = [
                    statement.unit?.unit_number ?? 'N/A',
                    statement.tenant ? `${statement.tenant.first_name} ${statement.tenant.last_name}` : 'Vacant',
                    statement.total ?? 0,
                    statement.unit?.monthly_rent ?? 0,
                    statement.unit?.garbage_fee ?? 0,
                    statement.water_bill ?? 0,
                    statement.paid ?? 0,
                    statement.balance ?? 0,
                    this.format_date(statement.paid_at) ?? 'N/A'
                ];

                values.forEach((val, i) => {
                    doc.rect(xPos, rowY, columnWidths[i], 8);
                    doc.text(this.formatNumber(val), xPos + 2, rowY + 6);
                    xPos += columnWidths[i];
                });

                rowY += 8;
                currentRow++;
            });

            // ----- FOOTER -----
            doc.setFontSize(10);
            doc.setTextColor(100);
            doc.text(`Generated by Ingo Properties on ${new Date().toLocaleString()}`, 20, doc.internal.pageSize.getHeight() - 10);

            // Save
            const fileName = `${this.property.name} ${this.formatMonth(new Date())} Rent Statement.pdf`;
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
        printReceipt(statement) {
            console.log("alone",statement);
            this.name = statement.property.name;
            this.firstName = statement.tenant.first_name;
            this.lastName = statement.tenant.last_name;
            this.tenant = this.firstName + " " + this.lastName;
            this.phoneNumber = statement.tenant.phone_number;
            this.unitNumber = statement.tenant.pms_unit_id;
            this.tenantId = statement.pms_tenant_id;
            // this.getUnit(this.unitNumber);
            this.refNo = statement.ref_no;
            this.details = statement.details;
            this.date = statement.created_at;
            this.status = statement.status;
            this.paid = statement.paid;
            this.balance = statement.balance;
            this.total = statement.total;
            this.payment = statement.payment_method;
            this.statementId = statement.id;
            this.waterBill = statement.water_bill;
            //unit info
            this.unitName = statement.unit.unit_number;
            this.unitRent = statement.unit.monthly_rent;
            this.unitSecurityFee = statement.unit.security_fee;
            this.unitGarbageFee = statement.unit.garbage_fee;
            this.unitType = statement.unit.type;

            // Open a new window for printing
            const printWindow = window.open("", "_blank");

            // Build the content for printing
            const receiptContent = this.buildReceiptContent();

            // Write the content to the new window
            printWindow.document.write(receiptContent);

            // Close the document stream
            printWindow.document.close();

            // Trigger the print dialog
            printWindow.print();
        },
        buildReceiptContent() {
            // Determine whether to include the row
            const showGarbageFeeRow = this.unitGarbageFee !== 0;
            const showSecurityFeeRow = this.unitSecurityFee !== 0;
            // Build the HTML content for the receipt
            const receiptHTML = `
                <!DOCTYPE html>
                <html lang="en">
                <head>
                  <meta charset="UTF-8">
                  <meta name="viewport" content="width=device-width, initial-scale=1.0">
                  <title>Receipt Of Payment</title>
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
                      border-radius: 10px;
                    }
                    .receipt-header {
                      text-align: center;
                      margin-bottom: 20px;
                    }
                    .receipt-header h1 {
                      margin: 10px 0;
                      color: #333;
                    }
                    .receipt-info {
                      margin-bottom: 20px;
                    }
                    .receipt-info p {
                      margin: 5px 0;
                      color: #555;
                    }
                    .receipt-table {
                      width: 100%;
                      border-collapse: collapse;
                      margin-bottom: 20px;
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
                    }
                    .receipt-footer p {
                      margin: 5px 0;
                      color: #777;
                    }
                  </style>
                </head>
                <body>
                  <div class="receipt">
                    <div class="receipt-header">
                      <h1>Ingo Properties</h1>
                      <p>Cosyard Business Center, Kakamega Mumias Road, Kakamega.</p>
                      <p>Phone: (0759) 509-462 | Email: ingoproperties@gmail.com</p>
                    </div>
                    <div class="receipt-info">
                      <p><strong>Invoice Number:</strong> ${this.refNo}</p>
                      <p><strong>Receipt Date:</strong> ${new Date().toLocaleString()}</p>
                      <p><strong>Rent Month:</strong> ${this.formatMonth(this.date)}</p>
                      <p><strong>Tenant:</strong> ${this.tenant}</p>
                      <p><strong>Property:</strong> ${this.property.name} - ${this.unitName}</p>
                      <p><strong>Payment Mode:</strong> ${this.payment}</p>
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
                          <td>Rent Payment</td>
                          <td>KES ${this.formatNumber(this.unitRent)}</td>
                        </tr>
                        <tr>
                          <td>Water Bill</td>
                          <td>KES ${this.formatNumber(this.waterBill)}</td>
                        </tr>
                        <!-- Conditionally include garbage collection fee row -->
                          ${showGarbageFeeRow ? `
                          <tr>
                            <td>Garbage Collection Fee</td>
                            <td>KES ${this.formatNumber(this.unitGarbageFee)}</td>
                          </tr>
                          ` : ''}
                          </tr>
                          <!-- Conditionally include security fee row -->
                          ${showSecurityFeeRow ? `
                          <tr>
                            <td>Security Fee</td>
                            <td>KES ${this.formatNumber(this.unitSecurityFee)}</td>
                          </tr>
                          ` : ''}
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>Total:</th>
                          <td>KES ${this.formatNumber(this.total)}</td>
                        </tr>
                        <tr>
                          <th>Paid:</th>
                          <td>KES ${this.formatNumber(this.paid)}</td>
                        </tr>
                        <tr>
                          <th>Balance:</th>
                          <td>KES ${this.formatNumber(this.balance)}</td>
                        </tr>
                      </tfoot>
                    </table>
                    <div class="receipt-footer">
                      <p>You were served by ${this.user.first_name} ${this.user.last_name}. Thank you for your payment.</p>
                      <p>This receipt acknowledges the payment received for the above property management services.</p>
                    </div>
                  </div>
                </body>
                </html>
            `;

            return receiptHTML;
        },
        formatMonth(value) {
            if (value) {
                return moment(String(value)).format('MMM YYYY');
            }
        },
        getCurrentTime() {
          const now = new Date();
          const hours = String(now.getHours()).padStart(2, '0');
          const minutes = String(now.getMinutes()).padStart(2, '0');
          const seconds = String(now.getSeconds()).padStart(2, '0');
          return `${hours}:${minutes}:${seconds}`;
        },
        updateTime() {
          this.currentTime = this.getCurrentTime();
        },
        getCurrentMonth() {
          const now = new Date();
          const options = { month: 'short', year: 'numeric' }; // 'short' for abbreviated month name, 'numeric' for year
          return now.toLocaleDateString('en-US', options);
        },
        getCurrentDate() {
          const now = new Date();
          const day = String(now.getDate()).padStart(2, '0');
          const month = String(now.getMonth() + 1).padStart(2, '0'); // January is 0, so we add 1
          const year = now.getFullYear();
          return `${day}/${month}/${year}`;
        },
        loadLists() {
          this.isLoadingStatements = true; // 🔄 start spinner

          axios.get('/api/propertyallsettledinvoices/' + this.$route.params.id)
            .then((response) => {
              // Settled invoices
              this.statements = response.data.propertyallsettledinvoices;
              // All invoices (unsettled & vacant)
              this.allstatements = response.data.propertyallinvoices;

              console.log("all", this.allstatements);

              // Initialize DataTable after DOM update
              setTimeout(() => {
                  $("#AllStatementsTable").DataTable();
              }, 10);
        })
            .catch((error) => {
              console.error(error);
            })
            .finally(() => {
              this.isLoadingStatements = false; // ✅ stop spinner
            });
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
                    console.log("unit", this.unit);
                    // Further processing of the response data if needed
                })
                .catch((error) => {
                    console.error("Error fetching unit:", error);
                });
                },
        getProperty() {
          axios.get('/api/pmsproperty/' + this.$route.params.id)
            .then((response) => {
              const prop = response.data.property;

              // Save property
              this.property = prop;

              // Landlord info safely
              const landlord = prop.landlord ?? {};
              this.fName = landlord.first_name ?? '';
              this.lName = landlord.last_name ?? '';
              this.landlord = `${this.fName} ${this.lName}`;
              this.landlordPhone = landlord.phone_no ?? '';
              this.landlordAddress = landlord.address ?? '';
              this.landlordEmail = landlord.email ?? '';
              this.commission = landlord.commission ?? 0;
              this.fixedCommission = landlord.fixed_commission ?? 0;

              // Property details
              this.unitsNo = prop.units_no ?? 0;

              // Safely calculate commission and rent less commission
              const totalPaidSafe = this.totalPaid ?? 0;

              if (this.commission > 0) {
                this.propertyCommission = ((this.commission / 100) * totalPaidSafe).toFixed(2);
              } else {
                this.propertyCommission = this.fixedCommission ?? 0;
              }

              this.rentLessCommission = totalPaidSafe - (Number(this.propertyCommission) ?? 0);

              console.log("Property data loaded safely:", response);
            })
            .catch((err) => {
              console.log('Error fetching property:', err);
            });
        },
        getPropertyExpenses()
        {
          axios.get('/api/pmsallpropertyexpenses/'+ this.$route.params.id).then((response) => {
            this.expenses = response.data.pmsallpropertyexpenses;
            // this.commission = this.property.landlord.commission;
            // this.fixedCommission = this.property.landlord.fixed_commission;
            this.totalAmountPaid = this.calculateTotalAmountPaid();
            this.netRemmission = this.rentLessCommission - (this.totalAmountPaid);            
            console.log("2", this.totalAmountPaid)
            console.log("ruto", this.expenses)
          }).catch(() => {
              console.log('error')
          })
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
        }
      },      
      mounted(){
        this.loadLists();
        this.getProperty();
        this.getPropertyExpenses();
        this.loadLogo();
        this.propertyId = this.$route.params.id;
        this.currentDate = this.getCurrentDate(); // Set the initial date
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);
        this.updateTime(); // Set the initial time
        setInterval(this.updateTime, 1000); // Update the time every second
        this.currentMonth = this.getCurrentMonth(); // Set the initial date

      }
    }
</script>
    
    
  <style scoped>
    .active-link {
      background-color: darkgreen;
      border-color: darkgreen;
      color: white; /* Optional: to ensure the text is visible */
    }
  </style>