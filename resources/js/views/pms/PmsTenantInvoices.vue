<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
            <!-- Top Selling / Property Statements -->
            <div class="col-12">
              <div class="card top-selling overflow-auto">

                <div class="card-body pb-0">

                  <!-- HEADER -->
                  <h5 class="card-title d-flex justify-content-between align-items-center">
                    <span>{{ tenantName }}'s Statements</span>
                    <span class="text-muted small">
                      Invoice Statements • {{ selectedMonthsLabel || 'All Time' }}
                    </span>
                  </h5>

                  <!-- MONTH FILTER (cleaned) -->
                  <div class="row mb-4">
                    <div class="col-md-4">

                      <label class="form-label fw-semibold">Filter by Rent Month</label>

                      <div class="dropdown w-100">
                        <button
                          class="btn btn-outline-secondary w-100 d-flex justify-content-between align-items-center"
                          data-bs-toggle="dropdown"
                        >
                          <span>{{ selectedMonthsLabel }}</span>
                          <i class="bi bi-chevron-down"></i>
                        </button>

                        <div class="dropdown-menu w-100 p-3 shadow-sm" style="max-height: 300px; overflow-y:auto;">

                          <div
                            v-for="month in availableMonths"
                            :key="month"
                            class="form-check mb-2"
                          >
                            <input
                              class="form-check-input"
                              type="checkbox"
                              :value="month"
                              v-model="selectedMonths"
                              :id="'m-' + month"
                            />
                            <label class="form-check-label" :for="'m-' + month">
                              {{ month }}
                            </label>
                          </div>

                          <hr>

                          <div class="d-flex justify-content-between">
                            <button class="btn btn-sm btn-light" @click="clearMonthFilter">
                              Clear
                            </button>
                            <small class="text-muted">
                              {{ selectedMonths.length }} selected
                            </small>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- ACTION ROW (like tenant UI style) -->
                  <div class="row mb-3">
                    <div class="col d-flex flex-wrap gap-2">

                      <button
                        class="btn btn-sm btn-outline-primary"
                        v-if="filteredStatements.length"
                        @click="exportToExcel"
                      >
                        Export
                      </button>

                      <button
                        class="btn btn-sm btn-outline-dark"
                        v-if="filteredStatements.length"
                        @click="printInvoice"
                      >
                        Print Tenant Statement
                      </button>

                      <button
                        class="btn btn-sm btn-success"
                        v-if="filteredStatements.length"
                        @click="generatePDF"
                      >
                        Generate Rent Statement
                      </button>
                    </div>
                  </div>      

                  <!-- LOADING -->
                  <div v-if="isLoadingStatements" class="text-center py-4">
                    <div class="spinner-border text-primary"></div>
                    <div class="mt-2">Loading statements…</div>
                  </div>

                  <!-- TABLE -->
                  <div v-else class="table-responsive">
                    <table class="table table-borderless align-middle">

                      <thead>
                        <tr>
                          <th>Unit</th>
                          <th>Rent Month</th>
                          <th>Due</th>
                          <th>Paid</th>
                          <th>Balance</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>

                      <tbody>
                        <tr v-for="statement in filteredStatements" :key="statement.id">

                          <td>{{ statement.unit_number || 'N/A' }}</td>

                          <td>{{ statement.rent_month }}</td>

                          <td>{{ formatNumber(statement.total) }}</td>
                          <td>{{ formatNumber(statement.paid) }}</td>
                          <td>{{ formatNumber(statement.balance) }}</td>

                          <td>
                            <span v-if="statement.status == 1" class="badge bg-success">
                              Settled
                            </span>

                            <span v-else-if="statement.water_bill == 0" class="badge bg-info text-dark">
                              Not Invoiced
                            </span>

                            <span v-else class="badge bg-warning text-dark">
                              Not Settled
                            </span>
                          </td>

                          <td>
                            <div class="btn-group">
                              <button class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                Action
                              </button>

                              <div class="dropdown-menu">

                                <a class="dropdown-item" @click="navigateTo('/viewstatement/' + statement.id)">
                                  View
                                </a>

                                <a class="dropdown-item" @click="printReceipt(statement)">
                                  Print Receipt
                                </a>

                              </div>
                            </div>
                          </td>

                        </tr>
                      </tbody>

                    </table>
                  </div>

                  <!-- TOTALS -->
                  <div class="mt-3">
                    <strong>
                      Total:
                      Due: {{ formatNumber(calculateFilteredTotal('total')) }},
                      Paid: {{ formatNumber(calculateFilteredTotal('paid')) }},
                      Bal: {{ formatNumber(calculateFilteredTotal('balance')) }}
                    </strong>
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
          tenant: [],
          statements: [],
          user: [],
          tenantId: this.$route.params.id,
          logoBase64: '',
          tenantName: '',
          tenantUnit: '',
          tenantProperty: '',
          paymentMethod: '',
          accountNo: '',
          paybillNo: '',
          selectedStatement: {}, // Initialize as an empty object
          property: '',
          name: '',
          tenant: '',
          phoneNumber: '',
          unitNumber: '',
          refNo: '',
          details: '',
          date: '',
          invoiceDate: '',
          payDate: '',
          status: '',
          paid: '',
          balance: '',
          total: '',
          waterBill: '',
          isAmountValid: true,
          lastmonthstatement: [],
          lastmonthBalance: '',
          overPayment: false,
          payMethod: '',
          form: {
            water_bill : '',
            payment_method: '',
            cash: '',
            mpesa_code: '',
            balance: '',
            amountPaid: '',
            balAmount: ''
          },
          errors: {
            water_bill: '',
            cash: '',
            mpesa_code: ''
          },
          loading: false,

            isLoadingStatements: false,

            selectedMonths: [],
            selectedStatus: "",
            availableMonths: [],          
        }
      },
      methods: {
        getTenant()
        {
          axios.get('/api/pmstenant/'+ this.$route.params.id).then((response) => {
            this.tenant = response.data.tenant;
            this.fName = this.tenant.first_name;
            this.lName = this.tenant.last_name;
            this.tenantName = this.fName + " " + this.lName;
            this.tenantProperty = this.tenant.property.name;
            this.tenantPropertyId = this.tenant.property.id;
            this.getProperty(this.tenantPropertyId);
            this.tenantUnit = this.tenant.unit.unit_number;
            this.tenantUnitType = this.tenant.unit.type;
            console.log("dat", this.tenant)
          }).catch(() => {
              console.log('error')
          })
        },
        navigateTo(location){
            this.$router.push(location)
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
        getCurrentTimestamp() {
          const now = this.format_date(new Date());
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
            this.unitNumber = this.selectedStatement.pms_unit_id;
            this.getUnit(this.unitNumber);
            this.refNo = this.selectedStatement.ref_no;
            this.firstName = this.selectedStatement.tenant.first_name;
            this.lastName = this.selectedStatement.tenant.last_name;
            this.tenant = this.firstName + " " + this.lastName;
            this.date = this.selectedStatement.created_at;
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
           // Validate amount
          if (!this.form.cash) {
            this.errors.cash = 'Amount paid is required.';
            return;
          }
          if (this.selectedStatement && this.selectedStatement.id) {
            // Implement your logic to invoice the tenant here
            console.log("Settling tenant with statement ID:", this.selectedStatement.id);
            await this.settleInvoice();

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
            toast.fire(
                'Success!',
                'Invoice updated!',
                'success'
            );

            // Close the modal after invoicing
            const modal = bootstrap.Modal.getInstance(document.getElementById('settleTenantModal'));
            modal.hide();
            //reset form
            this.form.cash = '';
            this.form.payment_method = 'Mpesa';
            this.getTenantStatements()
          }
        },
        invoiceTenant(statement) {
          this.selectedStatement = statement;
          this.form.water_bill = ''; // Reset the form field
          this.errors.water_bill = ''; // Reset the error message
          const modal = new bootstrap.Modal(document.getElementById('invoiceTenantModal'));
          modal.show();
        },
        confirmInvoiceTenant() {
          // Validate water_bill
          if (!this.form.water_bill) {
            this.errors.water_bill = 'Water bill is required.';
            return;
          }

          if (this.selectedStatement && this.selectedStatement.id) {
            // Show loading spinner
            this.loading = true;
            this.successMessage = '';

            // Implement your logic to invoice the tenant here
            console.log("Invoicing tenant with statement ID:", this.selectedStatement.id);
            axios.put("/api/pmsinvoicestatement/" + this.selectedStatement.id, this.form)
              .then(response => {
                console.log(response);
                this.successMessage = 'Tenant invoiced!';
                toast.fire(
                  'Success!',
                  'Tenant invoiced!',
                  'success'
                );
              })
              .catch(error => {
                console.log(error);
                // Handle the error appropriately
                toast.fire(
                  'Error!',
                  'An error occurred while invoicing the tenant.',
                  'error'
                );
              })
              .finally(() => {
                // Hide loading spinner
                this.loading = false;

                // Close the modal after invoicing
                const modal = bootstrap.Modal.getInstance(document.getElementById('invoiceTenantModal'));
                modal.hide();

                // Reset form
                this.form.water_bill = '';
                this.form.cash = '';
                this.getTenantStatements();
              });
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
        formatMonth(dateString) {
          // Parse the date string using Moment.js and format it
           return moment(dateString).format('MMM YYYY');
        }, 
        calculateFilteredTotal(field) {
          return this.filteredStatements.reduce((sum, item) => {
            let value = 0;

            if (field === 'balance') {
              value = (item.total || 0) - (item.paid || 0);
            } else {
              value = item[field] || 0;
            }

            return sum + value;
          }, 0);
        },         
         calculateTotalAmountPaid() {
        if (!this.expenses || this.expenses.length === 0) {
              return 0; // If expenses data is empty or undefined, return 0
            }

            // Use reduce to sum up the amount_paid property for all expenses
            return this.expenses.reduce((total, expense) => total + expense.amount_paid, 0);
        },
        calculateTotal(tenant) {
          // Function to calculate total for Total, Paid, and Bal columns

          return this.statements.reduce((total, statement) => total + (statement[tenant] || 0), 0);
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
        getProperty()
        {
            axios.get('/api/pmsproperty/'+this.tenantPropertyId).then((response) => {
                this.property = response.data.property
                this.accountNo = response.data.property.account_number
                this.paybillNo = response.data.property.paybill_number
                console.log("property", response)
            })
        },   
        getTenantStatements() {
             axios.get('/api/pmstenantinvoices/'+this.$route.params.id).then((response) => {
             this.statements = response.data.pmstenantinvoices;
             if(this.totalDue == this.totalPaid) {
               this.paymentMethod = 'SETTLED'; 
             } 
             else{
                this.paymentMethod = 'NOT SETTLED'
             }

             console.log("invoices", response)
             setTimeout(() => {
                  $("#AllStatementsTable").DataTable();
              }, 10);
    
             });
        },
        getCurrentDate() {
          const now = new Date();
          const day = String(now.getDate()).padStart(2, '0');
          const month = String(now.getMonth() + 1).padStart(2, '0'); // January is 0, so we add 1
          const year = now.getFullYear();
          return `${day}/${month}/${year}`;
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
        async printInvoice() {
          const summary = this.tenantSummary;

          // 🛑 Guard
          if (!summary) {
            console.warn('Tenant summary not ready yet');
            return;
          }

          const printWindow = window.open('', '_blank');

          const invoiceContent = this.buildTenantStatementContent(summary);

          printWindow.document.open();
          printWindow.document.write(invoiceContent);
          printWindow.document.close();

          // wait for DOM
          printWindow.onload = () => {
            const images = printWindow.document.images;
            let loaded = 0;

            // no images → print immediately
            if (images.length === 0) {
              printWindow.focus();
              printWindow.print();
              printWindow.close();
              return;
            }

            // track image loading (logo included)
            for (let img of images) {
              img.onload = () => {
                loaded++;

                if (loaded === images.length) {
                  setTimeout(() => {
                    printWindow.focus();
                    printWindow.print();
                    printWindow.close();
                  }, 200);
                }
              };

              // already cached images
              if (img.complete) {
                loaded++;
              }
            }

            // safety fallback (prevents infinite hang)
            setTimeout(() => {
              if (loaded >= images.length) {
                printWindow.focus();
                printWindow.print();
                printWindow.close();
              }
            }, 1500);
          };
        },
        buildInvoiceContent() {
          // Determine whether to include the row
          const showExpensesDeductionRow = this.expenses !== 0;
          const logoBase64 = this.logoBase64;
          const watermarkText = this.paymentMethod;
          // Build the HTML content for the receipt
          const receiptHTML = `
            <!DOCTYPE html>
            <html lang="en">
            <head>
              <meta charset="UTF-8">
              <meta name="viewport" content="width=device-width, initial-scale=1.0">
              <title>Invoice Of Payment</title>
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
                    <p>Cosyard Business Center, Kakamega Mumias Road, Kakamega.</p>
                    <p>Phone: (0720) 020-401 </p>
                    <p> Email: propertIngo@gmail.com</p>
                    <p> Website: www.Ingoproperties.co.ke</p>
                  </div>
                </div>
                <div class="receipt-info">
                  <p><strong>Invoice For:</strong>${this.currentMonth}</p>
                  <p><strong>Printed On:</strong>  ${new Date().toLocaleString()}</p>
                  
                </div>
                <div class="additional-info">
                  <p><strong>Invoiced To:</strong></p>
                  <p><strong></strong> ${this.tenantName}</p>
                  <p><strong></strong> ${this.tenantProperty} - ${this.tenantUnit}</p>
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
                      <td>Total Rent Due (Incl. Water Bill)</td>
                      <td>KES ${this.formatNumber(this.totalDue)}</td>
                    </tr>
                    <tr>
                      <td>Total Amount Paid</td>
                      <td>KES ${this.formatNumber(this.totalPaid)}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total Balance:</th>
                      <td>KES ${this.formatNumber(this.totalBalance)}</td>
                    </tr>
                  </tfoot>
                </table>
                <div class="payment-info">
                  <p><strong>Payment Options:</strong></p>
                  <p>Bank Transfer: Account Number 123456789</p>
                  <p>Mobile Money: Paybill - ${this.paybillNo ?? 'N/A'} Account Number - ${this.accountNo ?? 'N/A'}</p>
                </div>
                <div class="receipt-footer">
                  <p>Generated on ${new Date().toLocaleString()}</p>
                </div>
              </div>
            </body>
            </html>
          `;

          return receiptHTML;
        },
        buildTenantStatementContent(summary) {
          const logoBase64 = this.logoBase64;
          const reference = this.generateReference(summary);

          const statusColor =
            summary.status === 'SETTLED' ? '#16a34a' :
            summary.status === 'PARTIAL' ? '#f59e0b' :
            summary.status === 'UNPAID' ? '#ef4444' :
            '#6b7280';

          return `
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <title>Tenant Statement</title>

        <style>
        body {
          font-family: 'Segoe UI', system-ui, sans-serif;
          background: #f6f7fb;
          margin: 0;
          padding: 0;
          color: #1f2937;
        }

        .page {
          max-width: 900px;
          margin: 30px auto;
          padding: 0 15px;
        }

        .card {
          background: #fff;
          border-radius: 14px;
          padding: 28px;
          box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        }

        .header {
          display: flex;
          justify-content: space-between;
          padding-bottom: 20px;
          border-bottom: 1px solid #eee;
          margin-top: 10px;
        }

        .logo img { max-width: 160px; }

        .company {
          text-align: right;
          font-size: 0.9rem;
          color: #4b5563;
        }

        .meta {
          display: grid;
          grid-template-columns: repeat(3, 1fr);
          gap: 16px;
          margin: 24px 0 30px;
          padding: 18px;
          background: #f9fafb;
          border-radius: 10px;
        }

        table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 32px;
        }

        thead th {
          padding: 12px;
          background: #f3f4f6;
        }

        tbody td {
          padding: 16px 12px;
          border-bottom: 1px solid #eee;
        }

        tfoot td {
          padding: 18px 12px;
          font-weight: bold;
        }

        .highlight {
          color: #0f766e;
          font-weight: 600;
        }

        .footer {
          margin-top: 40px;
          text-align: center;
          font-size: 0.85rem;
          color: #6b7280;
        }
        </style>
        </head>

        <body>
        <div class="page">
        <div class="card">

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

        <!-- DOCUMENT TITLE (CENTERED + CAPS + BOLD) -->
        <h2 style="
          margin: 20px 0 10px 0;
          text-align: center;
          text-transform: uppercase;
          color: #1f2937;
          font-size: 20px;
          font-weight: 800;
          letter-spacing: 1px;
        ">
          Tenant Statement
        </h2>

        <!-- META -->
        <div class="meta">
          <div><strong>Tenant</strong><br>${summary.tenantName}</div>
          <div><strong>Property</strong><br>${summary.property}</div>
          <div><strong>Unit</strong><br>${summary.unit}</div>
          <div><strong>Period</strong><br>${summary.period}</div>
          <div><strong>Status</strong><br style="color:${statusColor}">${summary.status}</div>
          <div><strong>Reference</strong><br>${reference}</div>
        </div>

        <table>
        <thead>
        <tr>
          <th>Description</th>
          <th>Amount (KES)</th>
        </tr>
        </thead>

        <tbody>
        <tr>
          <td>Total Rent</td>
          <td>${this.formatNumber(summary.totalRent)}</td>
        </tr>

        <tr>
          <td>Total Paid</td>
          <td>${this.formatNumber(summary.totalPaid)}</td>
        </tr>
        </tbody>

        <tfoot>
        <tr>
          <td>Balance</td>
          <td class="highlight">${this.formatNumber(summary.balance)}</td>
        </tr>
        </tfoot>
        </table>

        <div class="footer">
        This statement was system-generated by Ingo Properties Management System.
        </div>

        </div>
        </div>
        </body>
        </html>
        `;
        }, 
        generateReference(summary) {
          if (!summary) return 'TEN-NA';

          const propertyId = summary.propertyId ?? 'P0';
          const unit = summary.unit ?? 'U0';
          const tenantId = summary.tenantId ?? 'T0';

          const monthMap = {
            January: 1, February: 2, March: 3, April: 4,
            May: 5, June: 6, July: 7, August: 8,
            September: 9, October: 10, November: 11, December: 12,
          };

          const months = this.filteredStatements
            .map(s => s.rent_month)
            .filter(Boolean)
            .sort((a, b) => {
              const [m1, y1] = a.split(' ');
              const [m2, y2] = b.split(' ');
              return (y1 * 100 + monthMap[m1]) - (y2 * 100 + monthMap[m2]);
            });

          if (!months.length) {
            return `TEN-${propertyId}-${unit}-${tenantId}-NA`;
          }

          const first = months[0];
          const last = months[months.length - 1];

          const period = first === last ? first : `${first}-to-${last}`;

          return `TEN-${propertyId}-${unit}-${tenantId}-${period}`;
        },               
        settleInvoice() {
            return new Promise((resolve, reject) => {
                let payload; // Define payload variable outside the if-else blocks
                this.paid_at = this.getCurrentTimestamp();

                if (this.lastmonthBalance >= 0) {
                    payload = {
                        mpesa_code: this.form.mpesa_code,
                        payment_method: this.form.payment_method,
                        paid: this.paid + this.form.cash,
                        balance: this.payableAmount,
                        paid_at: this.paid_at
                    };
                } else {
                    payload = {
                        mpesa_code: this.form.mpesa_code,
                        payment_method: this.form.payment_method,
                        paid: this.paid,
                        balance: this.payableOverAmount,
                        paid_at: this.paid_at
                    };
                }

                if (this.lastmonthBalance < 0) {
                    this.updateLastMonthStatement();
                }

                axios.put("/api/pmssettlestatement/" + this.selectedStatement.id, payload)
                    .then(response => {
                        console.log(response);
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
        print(statement) {
            console.log("merc",statement);
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
            this.invoiceDate = statement.updated_at;
            this.payDate = statement.paid_at;
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
            const receiptContent = this.buildPrintContent();

            // Write the content to the new window
            printWindow.document.write(receiptContent);

            // Close the document stream
            printWindow.document.close();

            // Trigger the print dialog
            printWindow.print();
        },
        buildPrintContent() {
          // Determine whether to include the row
          const showExpensesDeductionRow = this.expenses !== 0;
          const logoBase64 = this.logoBase64;
          const watermarkText = this.paymentMethod;
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
                    <p>Cosyard Business Center, Kakamega Mumias Road, Kakamega.</p>
                    <p>Phone: (0720) 020-401 </p>
                    <p> Email: propertIngo@gmail.com</p>
                    <p> Website: www.Ingoproperties.co.ke</p>
                  </div>
                </div>
                <div class="receipt-info">
                  <p><strong>#${this.refNo}</strong></p>
                  <p><strong>Invoice Date:</strong> ${this.format_date(this.invoiceDate ?? 'N/A')}</p>
                  <p><strong>Payment Date:</strong>  ${this.format_date(this.payDate ?? 'N/A')}</p>
                  <p><strong>Payment Mode:</strong> ${this.payment ?? 'N/A'}</p>
                  
                </div>
                <div class="additional-info">
                    <p><strong>Invoiced To</strong></p>
                    <p><strong></strong> ${this.tenant}</p>
                    <p><strong></strong> ${this.name} - ${this.unitName}</p>
                    <p><strong></strong> ${this.details}</p>
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
                      <td>Total Rent Due (Incl. Water Bill)</td>
                      <td>KES ${this.formatNumber(this.total)}</td>
                    </tr>
                    <tr>
                      <td>Total Amount Paid</td>
                      <td>KES ${this.formatNumber(this.paid)}</td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Total Balance:</th>
                      <td>KES ${this.formatNumber(this.balance)}</td>
                    </tr>
                  </tfoot>
                </table>
                <div class="payment-info">
                  <p><strong>Payment Options:</strong></p>
                  <p>Bank Transfer: Account Number 123456789</p>
                  <p>Mobile Money: Paybill - ${this.paybillNo} Account Number - ${this.accountNo}</p>
                </div>
                <div class="receipt-footer">
                  <p>Generated on ${new Date().toLocaleString()}</p>
                </div>
              </div>
            </body>
            </html>
          `;

          return receiptHTML;
        },
        printReceipt(statement) {
          // ❌ DO NOT ROUTE BEFORE PRINT (causes broken receipt / missing logo)
          // this.$router.push('/settledinvoices');

          const printWindow = window.open("", "_blank");

          const receiptContent = this.buildReceiptContent(statement);

          printWindow.document.open();
          printWindow.document.write(receiptContent);
          printWindow.document.close();

          // ✅ WAIT FOR FULL RENDER (IMPORTANT FOR LOGO + STYLES)
          printWindow.onload = () => {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
          };

          // ✅ ROUTE AFTER PRINT (safe delay)
          setTimeout(() => {
            this.$router.push('/settledinvoices');
          }, 800);
        },

        buildReceiptContent(statement) {
          const logoBase64 = this.logoBase64 || '';

          const showGarbageFeeRow = statement.unit.garbage_fee !== 0;
          const showSecurityFeeRow = statement.unit.security_fee !== 0;
          const showWaterBillRow = statement.water_bill !== 0;

          const isFullyPaid = this.balance <= 0;

          return `
          <!DOCTYPE html>
          <html lang="en">
          <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Payment Receipt - ${statement.ref_no}</title>

            <style>
              body {
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                margin: 0;
                padding: 0;
                background: #f4f4f4;
                color: #333;
              }

              .receipt {
                max-width: 750px;
                margin: 20px auto;
                padding: 25px;
                background: #fff;
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

              .payment-highlight {
                margin-top: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 8px;
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

              <!-- INFO -->
              <div class="info">
                <p><strong>Receipt No:</strong> ${statement.ref_no}</p>
                <p><strong>Date:</strong> ${this.format_date(new Date())}</p>
                <p><strong>Tenant:</strong> ${statement.tenant.first_name} ${statement.tenant.last_name}</p>
                <p><strong>Details:</strong> ${statement.details}</p>
                <p><strong>Rent Month:</strong> ${statement.rent_month}</p>
                <p><strong>Payment Method:</strong> ${statement.payment_method || 'N/A'}</p>
                <p><strong>Status:</strong> 
                  <span class="status">
                    ${isFullyPaid ? 'FULLY PAID' : 'PARTIALLY PAID'}
                  </span>
                </p>
              </div>

              <!-- TABLE -->
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
                    <td>KES ${this.formatNumber(statement.unit.monthly_rent)}</td>
                  </tr>

                  ${showWaterBillRow ? `
                  <tr>
                    <td>Water Bill</td>
                    <td>KES ${this.formatNumber(statement.water_bill)}</td>
                  </tr>` : ''}

                  ${showGarbageFeeRow ? `
                  <tr>
                    <td>Garbage Collection Fee</td>
                    <td>KES ${this.formatNumber(statement.unit.garbage_fee)}</td>
                  </tr>` : ''}

                  ${showSecurityFeeRow ? `
                  <tr>
                    <td>Security Fee</td>
                    <td>KES ${this.formatNumber(statement.unit.security_fee)}</td>
                  </tr>` : ''}
                </tbody>

                <tfoot>
                  <tr>
                    <th>Total</th>
                    <th>KES ${this.formatNumber(statement.total)}</th>
                  </tr>
                  <tr>
                    <th>Paid</th>
                    <th>KES ${this.formatNumber(statement.paid)}</th>
                  </tr>
                  <tr>
                    <th>Balance</th>
                    <th>KES ${this.formatNumber(statement.balance)}</th>
                  </tr>
                </tfoot>
              </table>

              <!-- NOTE -->
              <div class="payment-highlight">
                Payment applied successfully to tenant account.
              </div>

              <!-- FOOTER -->
              <div class="footer">
                Prepared by: ${this.user.first_name} ${this.user.last_name}<br>
                Generated: ${new Date().toLocaleString('en-GB', { hour12: false })}<br><br>
                This is a system-generated receipt.
              </div>
            </div>
          </body>
          </html>
          `;
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
          XLSX.utils.book_append_sheet(workbook, worksheet, "INVOICES");

          // Customize the filename with a timestamp
          const timestamp = new Date().toISOString().slice(0, 19).replace(/-/g, "").replace(/:/g, "").replace(/T/g, "_");
          const filename = `${this.tenantName}_${this.currentMonth}_INVOICES_${timestamp}.xlsx`;
          
          XLSX.writeFile(workbook, filename);
        },
        generatePDF() {
          const statements = this.filteredStatements;
          const summary = this.tenantSummary;

          if (!summary) {
            console.warn('Summary not ready yet');
            return;
          }

          const doc = new jsPDF('landscape', 'mm', 'a4');

          const pageWidth = doc.internal.pageSize.getWidth();
          const pageHeight = doc.internal.pageSize.getHeight();

          // =========================
          // COMPANY (FORMATTED CLEAN)
          // =========================
          const company = {
            name: "INGO PROPERTIES",
            address1: "COSYARD BUSINESS CENTRE",
            address2: "KAKAMEGA – MUMIAS ROAD",
            phone: "0759 509 462",
            email: "ingoproperties@gmail.com"
          };

          // =========================
          // HEADER
          // =========================
          const addHeader = () => {
            doc.addImage(
              this.logoBase64 || '/images/apex-logo.png',
              'PNG',
              20,
              10,
              40,
              20
            );

            const infoX = pageWidth - 20;

            doc.setFontSize(12);
            doc.setFont(undefined, 'bold');
            doc.text(company.name.toUpperCase(), infoX, 10, { align: 'right' });

            doc.setFontSize(10);
            doc.setFont(undefined, 'normal');
            doc.text(company.address1.toUpperCase(), infoX, 16, { align: 'right' });
            doc.text(company.address2.toUpperCase(), infoX, 22, { align: 'right' });
            doc.text(company.phone, infoX, 28, { align: 'right' });
            doc.text(company.email, infoX, 34, { align: 'right' });
          };

          // =========================
          // FOOTER (PAGE NUMBERS)
          // =========================
          const addFooter = (page, total) => {
            doc.setFontSize(9);
            doc.setTextColor(120);

            doc.text(
              `Page ${page} of ${total}`,
              pageWidth / 2,
              pageHeight - 8,
              { align: 'center' }
            );

            doc.setTextColor(0);
          };

          // =========================
          // TITLE BLOCK
          // =========================
          const addTitle = () => {
            doc.setFont(undefined, 'bold');
            doc.setFontSize(16);

            doc.text('RENT STATEMENT', pageWidth / 2, 38, { align: 'center' });

            doc.setFont(undefined, 'normal');
            doc.setFontSize(12);

            doc.text(
              `TENANT: ${summary.tenantName}`.toUpperCase(),
              pageWidth / 2,
              46,
              { align: 'center' }
            );

            doc.setFontSize(10);

            doc.text(
              `PERIOD: ${summary.period}`.toUpperCase(),
              pageWidth / 2,
              53,
              { align: 'center' }
            );
          };

          // =========================
          // TABLE CONFIG
          // =========================
          const headers = [
            'H/S No.',
            'Rent Month',
            'Due',
            'Rent',
            'Garbage',
            'Water',
            'Paid',
            'Balance',
            'Date Paid'
          ];

          const widths = [18, 30, 18, 18, 18, 18, 18, 18, 30];

          const rowHeight = 8;
          const bottomLimit = pageHeight - 15;

          const drawTableHeader = (y) => {
            let x = 20;
            doc.setFont(undefined, 'bold');

            headers.forEach((h, i) => {
              doc.rect(x, y, widths[i], rowHeight);
              doc.text(h, x + 2, y + 6);
              x += widths[i];
            });

            doc.setFont(undefined, 'normal');
          };

          // =========================
          // INIT
          // =========================
          let y = 58;
          let page = 1;

          addHeader();
          addTitle();

          // =========================
          // INFO BLOCK
          // =========================
          doc.setFontSize(11);

          doc.text(`Property: ${summary.property}`, 20, y); y += 6;
          doc.text(`Unit: ${summary.unit}`, 20, y); y += 6;
          doc.text(`Status: ${summary.status}`, 20, y); y += 10;

          // =========================
          // SUMMARY BOX
          // =========================
          const boxX = 20;
          const boxY = y;
          const boxW = 160;
          const boxH = 22;

          doc.setDrawColor(200);
          doc.rect(boxX, boxY, boxW, boxH);

          doc.setFontSize(10);

          doc.text(`Total Rent: KES ${this.formatNumber(summary.totalRent)}`, boxX + 4, boxY + 7);
          doc.text(`Total Paid: KES ${this.formatNumber(summary.totalPaid)}`, boxX + 4, boxY + 14);
          doc.text(`Balance: KES ${this.formatNumber(summary.balance)}`, boxX + 80, boxY + 7);

          y = boxY + boxH + 10;

          drawTableHeader(y);
          y += rowHeight;

          // =========================
          // ROWS (WITH PAGINATION)
          // =========================
          statements.forEach((s) => {

            if (y + rowHeight > bottomLimit) {
              doc.addPage();
              page++;

              addHeader();
              drawTableHeader(20);

              y = 28;
            }

            let cx = 20;

            const values = [
              s.unit?.unit_number ?? 'N/A',
              s.rent_month ?? this.format_date(s.paid_at)?.slice(3, 10) ?? 'N/A',
              s.total ?? 0,
              s.unit?.monthly_rent ?? 0,
              s.unit?.garbage_fee ?? 0,
              s.water_bill ?? 0,
              s.paid ?? 0,
              s.balance ?? 0,
              this.format_date(s.paid_at) ?? 'N/A'
            ];

            values.forEach((v, i) => {
              doc.rect(cx, y, widths[i], rowHeight);

              const text = this.formatNumber(v);
              const isNumber = i !== 0 && i !== 1 && i !== 8;

              if (isNumber) {
                doc.text(text, cx + widths[i] - 2, y + 6, { align: 'right' });
              } else {
                doc.text(text, cx + 2, y + 6);
              }

              cx += widths[i];
            });

            y += rowHeight;
          });

          // =========================
          // PAGE NUMBERS (FINAL PASS)
          // =========================
          const totalPages = doc.internal.getNumberOfPages();

          for (let i = 1; i <= totalPages; i++) {
            doc.setPage(i);
            addFooter(i, totalPages);
          }

          // =========================
          // EXPORT
          // =========================
          const blob = doc.output('blob');
          const url = URL.createObjectURL(blob);

          window.open(url, '_blank');
        },
      //   generatePDF() {
      //       let pdfName = 'Full Statement';
      //       var doc = new jsPDF('landscape');
      //       const maxRowsPerPage = 13; // Adjust this value based on the number of rows you want per page

      //       // Add top-left header
      //       const rightHeaderText = 'Ingo Properties\nKakamega-Webuye Rd, ACK Building\nTel: 0720 020 401\nP. O. Box 2973-50100, Kakamega\nEmail: propertIngo@gmail.com';
      //       const rightHeaderFontSize = 12;
      //       const rightheaderX = 20; // Adjust the X coordinate
      //       const rightheaderY = 10;

      //       doc.setFontSize(rightHeaderFontSize);
      //       doc.setTextColor(44, 62, 80);
      //       doc.text(rightHeaderText, rightheaderX, rightheaderY, { align: 'left' });

      //       // Add top-right header
      //       const headerText = 'Generated on: ' + new Date().toLocaleString()+'\n'+'Tenant: '+this.tenantName+'\n'+'ID Number: '+this.tenant.id_number + '\n'+'Phone: '+this.tenant.phone_number+'\n'+this.tenant.property.name+'\n'+this.tenant.unit.unit_number;
      //       const headerFontSize = 12;
      //       const headerX = doc.internal.pageSize.width - 20; // Adjust the X coordinate
      //       const headerY = 10;

      //       doc.setFontSize(headerFontSize);
      //       doc.setTextColor(44, 62, 80);
      //       doc.text(headerText, headerX, headerY, { align: 'right' });


      //       // Add image at the top
      //       const imageUrl = '/images/apex-logo.png'; // Replace with the URL of your image
      //       const imageWidth = 50; // Adjust the width of the image as needed
      //       const imageHeight = 50; // Adjust the height of the image as needed
      //       const imageX = (doc.internal.pageSize.width - imageWidth) / 2;
      //       const imageY = 20;
      //       doc.addImage(imageUrl, 'JPEG', imageX, imageY, imageWidth, imageHeight);

      //       // Add title
      //       const titleText = (this.tenantName+"'s "+this.formatMonth(new Date)+' Rent Statement').toUpperCase();
      //       const titleFontSize = 18;
      //       const titleWidth = doc.getStringUnitWidth(titleText) * titleFontSize / doc.internal.scaleFactor;
      //       const titleX = (doc.internal.pageSize.width - titleWidth) / 2;
      //       const titleY = imageY + imageHeight + 10;

      //       doc.setFontSize(titleFontSize);
      //       doc.setTextColor(44, 62, 80); // Set text color to a dark shade
      //       doc.text(titleText, titleX, titleY);

      //       // // Add subtitle with date information
      //       // doc.setFontSize(14);
      //       // doc.setTextColor(52, 73, 94); // Set text color to a slightly lighter shade
      //       // doc.text('Generated on: ' + new Date().toLocaleString(), 20, imageY + imageHeight + 20);

      //       // const roundedCommission = Math.round(this.property.commission * 100);
      //       // const commissionTotal = roundedCommission/100*this.totalPaid;

      //       // const netRemissionTotal = Math.round(this.totalPaid - (this.totalAmountPaid + commissionTotal));

      //       // Add content headers
      //       // doc.setFontSize(14);
      //       // doc.setTextColor(44, 62, 80);
      //       // doc.text(roundedCommission +'% Commission: '+ 'KES ' +this.formatNumber(commissionTotal), 20, imageY + imageHeight + 35);



      //       doc.setFontSize(14);
      //       doc.setTextColor(52, 73, 94); // Set text color to a slightly lighter shade

      //       let textY = imageY + imageHeight + 20; // Initial y-coordinate for the first text

      //       doc.text('Total Rent Due: ' + 'KES ' + this.formatNumber(this.totalDue), 20, textY);
      //       textY += 10; // Increment y-coordinate for the next text

      //       doc.text('Total Rent Paid: '+ 'KES ' +this.formatNumber(this.totalPaid), 20, textY);
      //       textY += 10; // Increment y-coordinate for the next text

      //       doc.text('Total Balance: ' + 'KES ' + this.formatNumber(this.totalBalance) , 20, textY);
      //       textY += 10; // Increment y-coordinate for the next text

      //       doc.setFontSize(12);
      //       doc.setTextColor(0);

      //       let headerYPos = imageY + imageHeight + 45;
      //       let cellHeight = 10;
      //       let cellPadding = 2;
      //       let lineHeight = 5;
      //       let columnWidths = [60, 30, 70, 30, 30, 30];
      //       let columnHeaders = ['Invoiced On', 'Status', 'Detail', 'Due', 'Paid', 'Bal'];

      //       let xPos = 20;
      //       doc.setDrawColor(0);

      //       for (let i = 0; i < columnWidths.length; i++) {
      //           doc.rect(xPos, headerYPos, columnWidths[i], cellHeight);
      //           doc.setTextColor(0); // Set text color to black
      //           doc.text(columnHeaders[i], xPos + cellPadding, headerYPos + cellHeight - cellPadding);
      //           xPos += columnWidths[i];
      //       }

      //       let currentPage = 1;
      //       let currentRow = 0;

      //       this.statements.forEach((statement, index) => {
      //           if (currentRow >= maxRowsPerPage) {
      //               doc.addPage();
      //               headerYPos = 20;
      //               currentRow = 0;
      //               currentPage++;
      //               xPos = 20;
      //               for (let i = 0; i < columnWidths.length; i++) {
      //                   doc.rect(xPos, headerYPos, columnWidths[i], cellHeight, 'F');
      //                   doc.setTextColor(0); // Set text color to black
      //                   doc.text(columnHeaders[i], xPos + cellPadding, headerYPos + cellHeight - cellPadding);
      //                   xPos += columnWidths[i];
      //               }
      //               headerYPos += cellHeight;
      //           }

      //           let yPos = headerYPos + (currentRow + 1) * lineHeight;
      //           xPos = 20;
      //           for (let i = 0; i < columnWidths.length; i++) {
      //               doc.rect(xPos, yPos, columnWidths[i], cellHeight);
      //               switch (i) {
      //                   case 0:
      //                       doc.text(this.format_date(statement.updated_at), xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //                   case 1:
      //                       let statusText = statement.status == 1 ? 'Settled' : 'Not Settled';
      //                       doc.text(statusText, xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //                   case 2:
      //                       doc.text(statement.details, xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //                   case 3:
      //                       doc.text(this.formatNumber(statement.total), xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //                   case 4:
      //                       doc.text(this.formatNumber(statement.paid), xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //                   case 5:
      //                       doc.text(this.formatNumber(statement.balance), xPos + cellPadding, yPos + cellHeight - cellPadding);
      //                       break;
      //               }
      //               xPos += columnWidths[i];
      //           }
      //           currentRow++;

      //       });
            

      //       // Add subtitle with date information
            
      //       // Add footer
      //       doc.setFontSize(10);
      //       doc.text('Generated on: ' + new Date().toLocaleString(), 20, doc.internal.pageSize.height - 10);





      //       // Call the function to add expenses to the PDF with pagination
      //       // let totalPages = this.addExpensesToPDF(this.expenses, doc);
      //       // Save the PDF
      //       let fileName = this.tenantName +"'s ' "+ this.formatMonth(new Date)+' Rent Statement' + '_Page_' + currentPage + '.pdf';
      //       // let fileName = this.property.name+" "+this.formatMonth(this.property.created_at)+' Rent Statement' + '_Total_Pages_' + totalPages + '.pdf';

      //       doc.save(fileName);
      // },
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.getTenant();
        this.getTenantStatements();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);
        this.loadLogo();        
        this.currentDate = this.getCurrentDate(); // Set the initial date
        this.updateTime(); // Set the initial time
        setInterval(this.updateTime, 1000); // Update the time every second
        this.currentMonth = this.getCurrentMonth(); // Set the initial date

      },
      watch: {
        tenant(newVal) {
          if (newVal) {
            const summary = this.tenantSummary;
            const ref = this.generateReference(summary);
            console.log(ref);
          }
        }
      },      
      computed: {
        filteredStatements() {
          if (!this.selectedMonths.length) return this.statements;

          return this.statements.filter(s =>
            this.selectedMonths.includes(s.rent_month)
          );
        },
        selectedMonthsLabel() {
          if (!this.selectedMonths.length) {
            return 'All Months';
          }

          if (this.selectedMonths.length === 1) {
            return this.selectedMonths[0];
          }

          if (this.selectedMonths.length <= 3) {
            return this.selectedMonths.join(', ');
          }

          return `${this.selectedMonths.length} months selected`;
        },        
        statementPeriod() {
          if (!this.filteredStatements.length) return 'N/A';

          const monthMap = {
            January: 1,
            February: 2,
            March: 3,
            April: 4,
            May: 5,
            June: 6,
            July: 7,
            August: 8,
            September: 9,
            October: 10,
            November: 11,
            December: 12,
          };

          const parsedMonths = this.filteredStatements
            .map(s => s.rent_month)
            .filter(Boolean)
            .map(m => {
              const [monthName, year] = m.split(' ');
              return {
                label: m,
                year: Number(year),
                month: monthMap[monthName],
              };
            });

          if (!parsedMonths.length) return 'N/A';

          // Sort chronologically
          parsedMonths.sort((a, b) =>
            a.year !== b.year
              ? a.year - b.year
              : a.month - b.month
          );

          const first = parsedMonths[0].label;
          const last = parsedMonths[parsedMonths.length - 1].label;

          return first === last ? first : `${first} – ${last}`;
        }, 
        tenantSummary() {
          // 🛑 Guard: tenant not loaded yet
          if (!this.tenant || !this.tenant.property || !this.tenant.unit) {
            return null;
          }

          const totalRent = this.filteredStatements.reduce(
            (sum, s) => sum + Number(s.total || 0),
            0
          );

          const totalPaid = this.filteredStatements.reduce(
            (sum, s) => sum + Number(s.paid || 0),
            0
          );

          const balance = totalRent - totalPaid;

          let status = 'UNKNOWN';
          if (totalPaid === 0) status = 'UNPAID';
          else if (totalPaid < totalRent) status = 'PARTIAL';
          else status = 'SETTLED';

          return {
            tenantId: this.tenant.id,
            tenantName: `${this.tenant.first_name} ${this.tenant.last_name}`,
            propertyId: this.tenant.property.id,
            property: this.tenant.property.name,
            unit: this.tenant.unit.unit_number,
            period: this.statementPeriod,
            totalRent,
            totalPaid,
            balance,
            status,
          };
        },
        printableStatements() {
          return this.filteredStatements;
        },
        availableMonths() {
          const months = new Set();

          this.statements.forEach(s => {
            if (s.rent_month) {
              months.add(s.rent_month);
            }
          });

          return Array.from(months);
        },       
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
        totalGarbage() {
          return this.calculateTotal('garbage_fee');
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
    }
    </script>
    
    
    