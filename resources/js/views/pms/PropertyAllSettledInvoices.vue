<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
    
                    <div class="card-body pb-0">
                      <h5 class="card-title d-flex align-items-center justify-content-between">
                        <span>{{ property.name }}</span>

                        <small class="text-muted">
                          Invoice Statements • {{ selectedMonthsLabel || 'All Time' }}
                        </small>
                      </h5>

                      <!-- 🔍 MONTH FILTER UI -->
                      <div class="row mb-4">
                        <div class="col-md-5">

                          <label class="form-label fw-semibold">
                            Filter by Rent Month
                          </label>

                          <!-- DROPDOWN -->
                          <div class="dropdown w-100">
                            <button
                              class="btn btn-outline-secondary w-100 d-flex justify-content-between align-items-center"
                              type="button"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                              <span>{{ selectedMonthsLabel }}</span>
                              <i class="bi bi-chevron-down"></i>
                            </button>

                            <div
                              class="dropdown-menu w-100 p-3 shadow-sm"
                              style="max-height: 320px; overflow-y: auto;"
                            >
                              <!-- MONTH LIST -->
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
                                  :id="'month-' + month"
                                >
                                <label
                                  class="form-check-label"
                                  :for="'month-' + month"
                                >
                                  {{ month }}
                                </label>
                              </div>

                              <hr class="my-2">

                              <!-- ACTIONS -->
                              <div class="d-flex justify-content-between">
                                <button
                                  class="btn btn-sm btn-light"
                                  @click.stop="clearMonthFilter"
                                >
                                  Clear
                                </button>

                                <small class="text-muted align-self-center">
                                  {{ selectedMonths.length }} selected
                                </small>
                              </div>
                            </div>
                          </div>

                        </div>
                      </div>

                      <p class="card-text">
                        <div class="row">
                          <div class="col d-flex">
                            <button class="me-2" v-if="filteredStatements.length !== 0" @click="exportToExcel">
                              Export
                            </button>
                            <button v-if="filteredStatements.length !== 0" @click="printInvoice" class="me-2">
                              Print Landlord Statement
                            </button>
                            <button v-if="filteredStatements.length !== 0" @click="generatePDF">
                              Generate Rent Statement
                            </button>
                          </div>
                        </div>
                      </p>

                      <!-- LOADING -->
                      <div v-if="isLoadingStatements" class="text-center py-5">
                        <div class="spinner-border text-primary"></div>
                        <div class="mt-2">Loading statements…</div>
                      </div>

                      <!-- TABLE -->
                      <table v-if="!isLoadingStatements" id="AllStatementsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th>H/S No.</th>
                            <th>Tenant</th>
                            <th>Due</th>
                            <th>Rent</th>
                            <th>Garbage</th>
                            <th>Water</th>
                            <th>Paid</th>
                            <th>Paid On</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>

                        <tbody>
                          <tr v-for="statement in filteredStatements" :key="statement.id">
                            <td>{{ statement.unit_number ?? 'N/A' }}</td>

                            <td>
                              {{
                                statement.tenant
                                  ? statement.tenant.first_name + ' ' + statement.tenant.last_name
                                  : 'N/A'
                              }}
                            </td>

                            <td>{{ formatNumber(statement.total) }}</td>
                            <td>{{ statement.unit ? formatNumber(statement.unit.monthly_rent) : 'N/A' }}</td>
                            <td>{{ statement.unit ? formatNumber(statement.unit.garbage_fee) : 'N/A' }}</td>
                            <td>{{ formatNumber(statement.water_bill ?? 0) }}</td>
                            <td>{{ formatNumber(statement.paid) }}</td>
                            <td>{{ format_date(statement.paid_at) }}</td>

                            <td>
                              <span v-if="statement.status == 0 && !statement.water_bill" class="badge bg-info text-dark">
                                Not Invoiced
                              </span>

                              <span v-else-if="statement.status == 1" class="badge bg-success">
                                Settled
                              </span>

                              <span v-else class="badge bg-warning text-dark">
                                Not Settled
                              </span>
                            </td>

                            <td>
                              <div class="btn-group">
                                <button class="btn btn-sm btn-primary dropdown-toggle"
                                  data-bs-toggle="dropdown">
                                  Action
                                </button>

                                <div class="dropdown-menu">
                                  <a @click="navigateTo('/viewstatement/' + statement.id)" class="dropdown-item">
                                    View
                                  </a>

                                  <a @click="printReceipt(statement)" class="dropdown-item">
                                    Print Receipt
                                  </a>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>

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
                </div>
                <!-- End Top Selling -->
    
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
            selectedMonths: [],
            selectedStatus: "",
            availableMonths: [],
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
            logoBase64: null,
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
        generateReference(summary) {
          const propertyId = this.property?.id ?? 'P0';

          const months = this.filteredStatements
            .map(s => s.rent_month)
            .filter(Boolean)
            .sort((a, b) => {
              const monthMap = {
                January: 1, February: 2, March: 3, April: 4,
                May: 5, June: 6, July: 7, August: 8,
                September: 9, October: 10, November: 11, December: 12,
              };

              const [m1, y1] = a.split(' ');
              const [m2, y2] = b.split(' ');

              return (y1 * 100 + monthMap[m1]) - (y2 * 100 + monthMap[m2]);
            });

          if (!months.length) {
            return `INV-${propertyId}-NA`;
          }

          const first = months[0];
          const last = months[months.length - 1];

          // ✅ FIX: single month case
          if (first === last) {
            return `INV-${propertyId}-${first}`;
          }

          return `INV-${propertyId}-${first}-to-${last}`;
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
        printInvoice() {
          const printWindow = window.open("", "_blank");

          const invoiceContent = this.buildInvoiceContent(this.landlordSummary);

          printWindow.document.write(invoiceContent);
          printWindow.document.close();

          printWindow.onload = () => printWindow.print();
        },
        buildInvoiceContent(summary) {
          const logoBase64 = this.logoBase64;
          const reference = this.generateReference(summary);
          const rentLessCommission =
            Number(summary.totalRent || 0) - Number(summary.commission || 0);

          const netRemmission =
            rentLessCommission - Number(summary.expenses || 0);

          const showExpensesDeductionRow = Number(summary.expenses) !== 0;

          const collected = Number(summary.totalPaid || 0);
          const expected = Number(summary.totalRent || 0);

          let status = 'UNKNOWN';

          if (collected === 0) {
            status = 'NO COLLECTION';
          } else if (collected < expected) {
            status = 'PARTIAL';
          } else {
            status = 'SETTLED';
          }

          // override for landlord payout reality
          if (netRemmission < 0) {
            status = 'DEFICIT';
          }

          const receiptHTML = `
        <!DOCTYPE html>
        <html lang="en">
        <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Landlord Statement</title>

        <style>
        body {
          font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
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

        .invoice-card {
          background: #fff;
          border-radius: 14px;
          padding: 28px;
          box-shadow: 0 10px 30px rgba(0,0,0,0.08);
          position: relative;
        }

        .accent-bar {
          height: 6px;
          background: linear-gradient(90deg, #0f766e, #16a34a);
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

        .total-row {
          background: #f9fafb;
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
        <div class="invoice-card">

        <div class="accent-bar"></div>

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

        <div class="meta">
          <div><strong>Landlord</strong><br>${this.landlord}</div>
          <div><strong>Property</strong><br>${this.property.name}</div>
          <div><strong>Period</strong><br>${this.statementPeriod}</div>
          <div><strong>Generated On</strong><br>${new Date().toLocaleDateString()}</div>
          <div><strong>Status</strong><br>${status}</div>
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
          <td>Total Rent Collected</td>
          <td>${this.formatNumber(summary.totalRent)}</td>
        </tr>

        <tr>
          <td>
            Management Commission
            <small>
              (${summary.commissionMeta.type}
              ${summary.commissionMeta.value})
            </small>
          </td>
          <td>${this.formatNumber(summary.commission)}</td>
        </tr>

        <tr>
          <td>Rent After Commission</td>
          <td>${this.formatNumber(rentLessCommission)}</td>
        </tr>

        ${showExpensesDeductionRow ? `
        <tr>
          <td>Less: Expenses</td>
          <td>${this.formatNumber(summary.expenses)}</td>
        </tr>` : ''}
        </tbody>

        <tfoot>
        <tr class="total-row">
          <td>Net Amount Remitted</td>
          <td class="highlight">${this.formatNumber(netRemmission)}</td>
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
              this.statements = response.data.propertyallinvoices;
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
        clearMonthFilter() {
          this.selectedMonth = "";
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

              this.property = prop;

              const landlord = prop.landlord ?? {};
              this.fName = landlord.first_name ?? '';
              this.lName = landlord.last_name ?? '';
              this.landlord = `${this.fName} ${this.lName}`;
              this.landlordPhone = landlord.phone_no ?? '';
              this.landlordAddress = landlord.address ?? '';
              this.landlordEmail = landlord.email ?? '';

              this.unitsNo = prop.units_no ?? 0;

              // ✅ SINGLE SOURCE OF TRUTH
              this.commission = response.data.commission ?? {
                source: 'system',
                type: 'none',
                value: 0
              };

              console.log("Property + commission loaded:", response.data);
            })
            .catch((err) => {
              console.log('Error fetching property:', err);
            });
        },
        calculateCommissionAmount(statements) {
          const months = new Set(
            statements.map(s => s.rent_month).filter(Boolean)
          );

          // FIXED COMMISSION (per month)
          if (this.commission.type === 'fixed') {
            return months.size * Number(this.commission.value || 0);
          }

          // PERCENTAGE COMMISSION (per rent row)
          if (this.commission.type === 'percentage') {
            return statements.reduce((sum, s) => {
              return sum + (this.commission.value / 100) * Number(s.total || 0);
            }, 0);
          }

          return 0;
        },
        buildStatementSummary() {
          const totalRent = this.filteredStatements.reduce(
            (sum, s) => sum + Number(s.total || 0),
            0
          );

          const expenses = this.calculateExpenses();

          // ✅ CORRECT COMMISSION
          const commissionAmount = this.calculateCommissionAmount(this.filteredStatements);

          return {
            totalRent,
            commission: commissionAmount,
            expenses
          };
        },
        generatePDF() {
            const statements = this.filteredStatements;

            // 🔥 SINGLE SOURCE OF TRUTH
            const summary = this.landlordSummary;

            const doc = new jsPDF('landscape', 'mm', 'a4');
            const pageWidth = doc.internal.pageSize.getWidth();

        // =========================
        // HEADER
        // =========================
        const logoWidth = 40;
        const logoHeight = 20;
        const logoX = 20;
        const logoY = 10;

        doc.addImage(
            this.logoBase64 || '/images/apex-logo.png',
            'PNG',
            logoX,
            logoY,
            logoWidth,
            logoHeight
        );

        // Right-side company block (RESTORED)
        const infoX = pageWidth - 20;

        doc.setFontSize(12);
        doc.text("Ingo Properties", infoX, 10, { align: 'right' });
        doc.setFontSize(10);
        doc.text("Cosyard Business Centre", infoX, 16, { align: 'right' });
        doc.text("Kakamega – Mumias Road", infoX, 22, { align: 'right' });
        doc.text("0759 509 462", infoX, 28, { align: 'right' });
        doc.text("ingoproperties@gmail.com", infoX, 34, { align: 'right' });

            // =========================
            // TITLE
            // =========================
            const title =
                `${this.property.name} - ${this.statementPeriod} Rent Statement`.toUpperCase();

            doc.setFontSize(16);
            doc.text(title, pageWidth / 2, 35, { align: 'center' });

            // =========================
            // SUMMARY (🔥 NOW MATCHES UI EXACTLY)
            // =========================
            doc.setFontSize(11);

            doc.text(`Total Rent: KES ${this.formatNumber(summary.totalRent)}`, 20, 45);
            doc.text(`Commission: KES ${this.formatNumber(summary.commission)}`, 20, 52);
            doc.text(`Expenses: KES ${this.formatNumber(summary.expenses)}`, 20, 59);
            doc.text(`Net Remission: KES ${this.formatNumber(summary.netRemmission)}`, 20, 66);

            // =========================
            // TABLE HEADER (unchanged)
            // =========================
            const headers = [
                'H/S No.',
                'Tenant Name',
                'Due',
                'Rent',
                'Garbage',
                'Water',
                'Paid',
                'Balance',
                'Date Paid'
            ];

            const columnWidths = [20, 50, 20, 20, 20, 20, 20, 20, 30];

            let tableY = 80;
            let xPos = 20;

            doc.setFontSize(10);

            headers.forEach((header, i) => {
                doc.rect(xPos, tableY, columnWidths[i], 8);
                doc.text(header, xPos + 2, tableY + 6);
                xPos += columnWidths[i];
            });

            // =========================
            // TABLE ROWS (UNCHANGED DATA SOURCE)
            // =========================
            let rowY = tableY + 8;
            let currentRow = 0;
            const maxRowsPerPage = 25;

            statements.forEach(statement => {

                if (currentRow >= maxRowsPerPage) {
                    doc.addPage();
                    rowY = 20;
                    currentRow = 0;

                    let x = 20;
                    headers.forEach((header, i) => {
                        doc.rect(x, rowY, columnWidths[i], 8);
                        doc.text(header, x + 2, rowY + 6);
                        x += columnWidths[i];
                    });

                    rowY += 8;
                }

                let x = 20;

                const values = [
                    statement.unit?.unit_number ?? 'N/A',
                    statement.tenant
                        ? `${statement.tenant.first_name} ${statement.tenant.last_name}`
                        : 'Vacant',
                    statement.total ?? 0,
                    statement.unit?.monthly_rent ?? 0,
                    statement.unit?.garbage_fee ?? 0,
                    statement.water_bill ?? 0,
                    statement.paid ?? 0,
                    statement.balance ?? 0,
                    this.format_date(statement.paid_at) ?? 'N/A'
                ];

                values.forEach((val, i) => {
                    doc.rect(x, rowY, columnWidths[i], 8);
                    doc.text(this.formatNumber(val), x + 2, rowY + 6);
                    x += columnWidths[i];
                });

                rowY += 8;
                currentRow++;
            });

            // =========================
            // EXPORT
            // =========================
            const pdfBlob = doc.output('blob');
            const pdfUrl = URL.createObjectURL(pdfBlob);

            window.open(pdfUrl, '_blank');
        },
        getPropertyExpenses()
        {
          axios.get('/api/pmsallpropertyexpenses/'+ this.$route.params.id).then((response) => {
            this.expenses = response.data.pmsallpropertyexpenses;

            this.totalAmountPaid = this.calculateTotalAmountPaid();
            this.netRemmission = this.rentLessCommission - (this.totalAmountPaid);            
            console.log("2", this.totalAmountPaid)
            console.log("ruto", this.expenses)
          }).catch(() => {
              console.log('error')
          })
        },
        getInvoiceStatus(statement) {
            if (statement.paid == 0) return "UNPAID";

            if (statement.paid < statement.total) return "PARTIAL";

            if (statement.paid >= statement.total) return "PAID";

            return "UNKNOWN";
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
      },
      components : {
          TheMaster,
      },
      computed:
      {
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
        landlordSummary() {
          const totalRent = this.filteredStatements.reduce(
            (sum, s) => sum + Number(s.total || 0),
            0
          );

          const totalPaid = this.filteredStatements.reduce(
            (sum, s) => sum + Number(s.paid || 0),
            0
          );

          const expenses = Number(this.totalAmountPaid || 0);

          // ✅ SINGLE SOURCE OF TRUTH
          const commissionAmount = this.calculateCommissionAmount(this.filteredStatements);

          const rentLessCommission = totalRent - commissionAmount;
          const netRemmission = rentLessCommission - expenses;

          return {
            totalRent,
            totalPaid,
            commission: commissionAmount,
            commissionMeta: this.commission,
            expenses,
            rentLessCommission,
            netRemmission,
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