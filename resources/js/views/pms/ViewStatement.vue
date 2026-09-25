<template>
    <TheMaster>
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Statement Details</h5>
                            <hr class="mb-4">

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Invoice No.</div>
                                        <div><strong>{{refNo}}</strong></div>
                                    </div>
                                </div>
                            </div>

<!--                             <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Invoice Date</div>
                                        <div v-if="invoice !== null"><strong>{{format_date(invoice.created_at)}}</strong></div>
                                        <div v-else><strong>N/A</strong></div>
                                    </div>
                                </div>
                            </div>  -->                           

                             <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Property</div>
                                        <div><strong>{{name}}</strong></div>
                                    </div>
                                </div>
                            </div>

                             <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Unit</div>
                                        <div><strong>{{unitName}}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Tenant</div>
                                        <div><strong>{{tenant}}</strong></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Phone Number</div>
                                        <div><strong>0{{phoneNumber}}</strong></div>
                                    </div>
                                </div>
                            </div>                           

                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-between">
                                        <div>Details</div>
                                        <div><strong>{{details}}</strong></div>
                                    </div>
                                </div>
                            </div>                             

                            <div class="row mt-4">
                                <div class="col-sm-6">
                                    <!-- <button @click.prevent="editStatement()" v-if="user.role_id == 1" style="background-color: orange; border-color: orange;" class="btn btn-dark w-100">Edit</button> -->
                                </div>
                                <div class="col-sm-6 text-end">
                                    <!-- Additional buttons can be added here if needed -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card px-2">
                        <div class="card-body">
                            <h5 class="card-title text-primary">Invoice</h5>
                            <hr class="mb-4">

                            <form class="row g-3 needs-validation" novalidate method="post" autocomplete="off" @submit.prevent="submit">
                                <div class="row mb-3"></div>

                                <!-- Default Table -->
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Rent</th>
                                            <th scope="col">Garbage</th>
                                            <th scope="col">Water</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{formatNumber(unitRent)}}</td>
                                            <td>{{formatNumber(unitGarbageFee)}}</td>
                                            <td v-if="waterBill !== null">{{formatNumber(waterBill)}}</td>
                                            <td v-else>N/A</td>
                                            <td v-if="status == 1" scope="row"><span style="color: green;">Settled</span></td>
                                            <td v-else scope="row"><span style="color: red;">Unsettled</span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Security</th>
                                            <td></td>
                                            <td></td>
                                            <td>{{formatNumber(unitSecurityFee)}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Paid</th>
                                            <td></td>
                                            <td></td>
                                            <td>{{formatNumber(paid)}}</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Balance</th>
                                            <td></td>
                                            <td></td>
                                            <td>{{formatNumber(balance)}}</td>
                                        </tr>                                                                                
                                        <tr>
                                            <th scope="row">Due</th>
                                            <td></td>
                                            <td></td>
                                            <td><strong>KES. {{formatNumber(total)}}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <!-- End Default Table Example -->

                                <div class="row mt-4">
                                    <div class="col-sm-6">
                                        <button @click.prevent="cancel()" class="btn btn-dark w-100">Back</button>
                                    </div>
                                    <div class="col-sm-6 text-end">
                                        <button @click.prevent="settleTenant()" type="submit" v-if="status == 0 && waterBill !== null" class="btn btn-primary w-100" style="background-color: darkgreen; border-color: darkgreen;">Settle</button>
                                        <button @click.prevent="invoiceTenant()" type="submit" v-else-if="status == 0 && waterBill == null" class="btn btn-primary w-100" style="background-color: darkgreen; border-color: darkgreen;">Invoice</button>
                                        <button @click="printReceipt" v-else class="btn btn-primary w-100" style="background-color: darkgreen; border-color: darkgreen;">Print Receipt</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </TheMaster>
</template>

<script>
import TheMaster from '@/components/dashboard/TheMaster.vue'
import axios from 'axios';
import Swal from 'sweetalert2';
import moment from 'moment';
import IngoLogo from '@/assets/img/apex-logo.png';

const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;

export default {
    data() {
        return {
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
            invoice: '',
            logoBase64: '',
            user: [],
            invoiceTenantPermission: '',
            settleInvoicePermission: ''
        }
    },
    components: {
        TheMaster,
    },
    methods: {
        getStatement() {
            axios.get('/api/pmsstatement/' + this.$route.params.id).then((response) => {
                this.statement = response.data.pmsstatement[0]
                this.name = this.statement.property.name;
                this.firstName = this.statement.tenant.first_name;
                this.lastName = this.statement.tenant.last_name;
                this.tenant = this.firstName + " " + this.lastName;
                this.phoneNumber = this.statement.tenant.phone_number;
                this.unitNumber = this.statement.tenant.pms_unit_id;
                this.tenantId = this.statement.pms_tenant_id;
                this.getUnit(this.unitNumber);
                this.refNo = this.statement.ref_no;
                this.details = this.statement.details;
                this.date = this.statement.created_at;
                this.rentMonth = this.statement.rent_month;
                this.status = this.statement.status;
                this.paid = this.statement.paid;
                this.balance = this.statement.balance;
                this.total = this.statement.total;
                this.payment = this.statement.payment_method;
                this.statementId = this.statement.id;
                this.waterBill = this.statement.water_bill;
                this.paymentMethod = this.statement.payment_method;
                console.log("statement", this.statement)
            })
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
        getInvoiceDate()
        {
          axios.get('/api/pmsinvoicedatethrostatement/'+ this.$route.params.id)
          .then((response) => {
            this.invoice = response.data.invoice;
            // this.invoiceDate = this.invoice.created_at;
            console.log("date", response)
          })
          .catch((error) => {
                    console.error("Error fetching unit:", error);            
          })
        },
        cancel() {
          this.$router.go(-1);
        },
        viewInvoice()
        {
          this.$router.push('/invoicestatement/'+this.statementId)
        },
        editStatement() {
            this.$router.push('/editstatement/' + this.statementId)
        },
        settleTenant() {
            this.$router.push({
                name: 'settlestatement', // Assuming you have named routes
                params: {
                    id: this.statementId,
                    tenantId: this.tenantId
                }
            });
        },
        invoiceTenant() {
            this.$router.push('/invoicestatement/' + this.statementId)
        },
        submit() {
            let self = this;  // Store the reference to this
            let payload = {
                // mpesa_code: this.form.mpesa_code,
                // payment_method: this.form.payment_method,
                paid: this.paid,
                balance: this.balance
            };

            axios.put("/api/pmssettlestatement/" + this.$route.params.id, payload)
                .then(function (response) {
                    console.log(response);
                    // self.step = 1;
                    toast.fire(
                        'Success!',
                        'Invoice updated!',
                        'success'
                    );
                })
                .catch(function (error) {
                    console.log(error);
                    // Swal.fire(
                    //    'error!',
                    //    // phone_error + id_error + pass_number,
                    //    'error'
                    // )
                });

            this.$router.push('/settledinvoices');
        },
        printReceipt() {
        this.$router.push('/settledinvoices');

        const printWindow = window.open("", "_blank");
        const receiptContent = this.buildReceiptContent();

        printWindow.document.open();
        printWindow.document.write(receiptContent);
        printWindow.document.close();

        // ✅ IMPORTANT TRICK: wait for full render before printing
        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
            printWindow.close();
        };
        },
        buildReceiptContent() {
        const logoBase64 = this.logoBase64 || '';

        const showGarbageFeeRow = this.unitGarbageFee !== 0;
        const showSecurityFeeRow = this.unitSecurityFee !== 0;
        const showWaterBillRow = this.waterBill !== 0;

        const isFullyPaid = this.balance <= 0;

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

            .payment-highlight {
                margin-top: 20px;
                padding: 15px;
                background: #f9f9f9;
                border-radius: 8px;
                font-size: 0.95rem;
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

            <!-- INFO -->
            <div class="info">
                <p><strong>Receipt No:</strong> ${this.refNo}</p>
                <p><strong>Date:</strong> ${new Date().toLocaleString('en-GB')}</p>
                <p><strong>Tenant:</strong> ${this.tenant}</p>
                <p><strong>Details:</strong> ${this.details}</p>
                <p><strong>Rent Month:</strong> ${this.rentMonth}</p>
                <p><strong>Payment Method:</strong> ${this.paymentMethod || 'Cash / M-PESA'}</p>
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
                    <td>KES ${this.formatNumber(this.unitRent)}</td>
                </tr>

                ${showWaterBillRow ? `
                <tr>
                    <td>Water Bill</td>
                    <td>KES ${this.formatNumber(this.waterBill)}</td>
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
                    <th>KES ${this.formatNumber(this.paid)}</th>
                </tr>
                <tr>
                    <th>Balance</th>
                    <th>KES ${this.formatNumber(this.balance)}</th>
                </tr>
                </tfoot>
            </table>

            <!-- NOTE -->
            <div class="payment-highlight">
                Payment has been applied to rent and associated charges for this billing period.
            </div>

            <!-- FOOTER -->
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
        formatMonth(value) {
            if (value) {
                return moment(String(value)).format('MMM YYYY');
            }
        },
         format_date(value){
          if(value){
            return moment(String(value)).format('lll');
          }
        }, 
        formatNumber(value) {
            // Use the toLocaleString method to format the number with commas and decimal places
            return value.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        },
    },
    mounted() {
        this.getStatement();
        this.getInvoiceDate();
        this.loadLogo();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);
        this.userId = this.user.id;
        // Get the current date
        const todayDate = new Date();

        // Convert to desired format dd/mm/yy
        this.formattedTodayDate = todayDate.toLocaleDateString('en-GB', {
          day: '2-digit',
          month: '2-digit',
          year: '2-digit'
        });
    }
}
</script>

<style scoped>
.section {
    padding: 20px;
}

.card {
    border-radius: 10px;
}

.card-title {
    font-size: 1.25rem;
}

.label {
    font-weight: bold;
    color: #333;
}

.row.mb-3 {
    margin-bottom: 1rem;
}

.row.mt-4 {
    margin-top: 1rem;
}

.text-end {
    text-align: right;
}
</style>
