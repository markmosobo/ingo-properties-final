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
    
                        <li><a class="dropdown-item" @click="month()" href="#">This Month</a></li>
                        <li><a class="dropdown-item" @click="year()" href="#">This Year</a></li>
                        <li><a class="dropdown-item" @click="all()" href="#">All Time</a></li>
                      </ul>
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">{{property.name}} Statements <span>| All Time</span></h5>
                      <p class="card-text">
                   
                        <button @click="generatePDF">Download PDF</button>
            
                      </p>
    
                      <table id="AllStatementsTable" ref="table" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Transaction On</th>
                            <!-- <th scope="col">Invoice</th> -->
                            <th scope="col">Status</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Total</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Bal</th>
                            <!-- <th scope="col">Action</th> -->
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="statement in propertystatements" :key="statement.id">
                            <td>{{format_date(statement.updated_at)}}</td>
                            <!-- <td>{{statement.ref_no}}</td> -->
                            <td>
                              <span v-if="statement.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Paid</span>
                              <span v-else class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Not Paid</span>
                            </td>
                            <td>{{statement.details}}</td>
                            <td>{{formatNumber(statement.total)}}</td>
                            <td>{{formatNumber(statement.paid)}}</td>
                            <td>{{formatNumber(statement.balance)}}</td>
                       <!--      <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/viewstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <a v-if="user.id == 1" @click="navigateTo('/editstatement/'+statement.id )" class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a v-if="statement.status == 0" @click="settleTenant(statement.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Settle</a>
                                  </div>
                              </div>
                            </td> -->
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
    import jsPDF from 'jsPDF'

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
          propertyexpenses: [],
          user: [],
          commission: [],
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
        capitalizeFirstLetter(str) {
          return str.charAt(0).toUpperCase() + str.slice(1);
        },        
        getPropertyStatements() {
             axios.get('/api/pmspropertystatements/'+this.$route.params.id).then((response) => {
             this.propertystatements = response.data.pmspropertystatements;
             console.log("props", response)
             setTimeout(() => {
                  $("#AllStatementsTable").DataTable();
              }, 10);
    
             });
        },
        getPropertyExpenses()
        {
          axios.get('/api/pmspropertyexpenses/'+this.$route.params.id).then((response) => {
            this.propertyexpenses = response.data.pmspropertyexpenses;
            console.log("expenses", this.propertyexpenses)
          })
        },
        generatePDF()
        {
          // Create a new jsPDF instance
          const doc = new jsPDF('landscape');

          // Add text to the top left corner
            const topLeftText = 'Generated on: '  + new Date().toLocaleString();
            const topLeftFontSize = 12;
            doc.setFontSize(topLeftFontSize);
            doc.setTextColor(44, 62, 80); // Set text color to a dark shade

            // Adjust the X and Y coordinates based on your design
            const topLeftX = 20;
            const topLeftY = 20;

            doc.text(topLeftText, topLeftX, topLeftY);

          // Add image
          const imageUrl = '/images/ingo-pdf-logo.png'; // Replace with the URL of your image
          const imageWidth = 50; // Adjust the width of the image as needed

          // Calculate the center of the page
          const centerX = doc.internal.pageSize.width / 2;
          const imageX = centerX - imageWidth / 2;

          // Add the image at the center top
          doc.addImage(imageUrl, 'JPEG', imageX, 20, imageWidth, 50);

          // Add a title beneath the image
          const titleText = 'Your Title Here';
          const titleFontSize = 18;
          doc.setFontSize(titleFontSize);
          doc.setTextColor(44, 62, 80); // Set text color to a dark shade

          // Calculate the X coordinate to center the title
          const titleX = centerX - (doc.getStringUnitWidth(titleText) * titleFontSize) / 2;

          // Adjust the Y coordinate based on your design
          const titleY = 80;

          doc.text(titleText, titleX, titleY);
// Define the table headers
const headers = ['Transaction On', 'Status', 'Detail', 'Total', 'Paid', 'Bal'];

// Define the data from propertystatements
const data = propertystatements.map(statement => [
  format_date(statement.updated_at),
  statement.status == 1 ? 'Paid' : 'Not Paid',
  statement.details,
  formatNumber(statement.total),
  formatNumber(statement.paid),
  formatNumber(statement.balance),
]);

// Set initial Y position
let yPos = 20;

// Add headers to the PDF
headers.forEach((header, index) => {
  doc.text(header, 10 + index * 30, yPos);
});

// Increment Y position
yPos += 10;

// Add data to the PDF
data.forEach(row => {
  row.forEach((value, index) => {
    doc.text(value, 10 + index * 30, yPos);
  });
  yPos += 10;
});

// Add footer
doc.setFontSize(10);
doc.text('Because You Are Worth', 10, doc.internal.pageSize.height - 10);

          // Save or display the PDF
          doc.save('generated.pdf');
        },
        downloadPDF() {
          // Define the PDF name and create a new jsPDF instance
          let pdfName = 'Full Statement';
          var doc = new jsPDF('landscape');

          // Add top-right header
          const headerText = 'Ingo Properties Management & Consultancy';
          const headerFontSize = 12;
          const headerX = doc.internal.pageSize.width - 20; // Adjust the X coordinate
          const headerY = 10;

          doc.setFontSize(headerFontSize);
          doc.setTextColor(44, 62, 80);
          doc.text(headerText, headerX, headerY, { align: 'right' });

          // Add image above the statement report
          const imageUrlAboveStatement = '/images/ingo-colored-logo.png'; // Replace with the URL of your image

          // Adjust the X coordinate to push the image to the extreme right
          const imageWidth = 50; // Adjust the width of the image as needed
          const maxXCoordinate = doc.internal.pageSize.width - imageWidth - 20; // Calculate the maximum X coordinate

          doc.addImage(imageUrlAboveStatement, 'JPEG', maxXCoordinate, 20, imageWidth, 50);



          // Add a title to the PDF with styling
          doc.setFontSize(18);
          doc.setTextColor(44, 62, 80); // Set text color to a dark shade
          doc.text('Full Statement', 20, 20);

          // Add a subtitle with date information
          doc.setFontSize(14);
          doc.setTextColor(52, 73, 94); // Set text color to a slightly lighter shade
          doc.text('Generated on: ' + new Date().toLocaleString(), 20, 30);

          // Add content to the PDF, e.g., property name
          doc.setFontSize(12);
          doc.setTextColor(0); // Reset text color to default
          doc.text('Property Name: ' + this.property.name, 20, 45);


          // Customize additional content as needed


         // Add property statements from the data retrieved
          doc.setFontSize(14);
          doc.setTextColor(44, 62, 80);
          doc.text('Property Statements:', 20, 60);

          doc.setFontSize(12);
          doc.setTextColor(0);

          // Draw table headers and borders dynamically based on the HTML structure
          let headerYPos = 70;
          let cellHeight = 10;
          let cellPadding = 2;
          let lineHeight = 5;
          let columnWidths = [60, 40, 70, 30, 30, 30];

          // Define column headers
          let columnHeaders = ['Transaction On', 'Status', 'Detail', 'Total', 'Paid', 'Bal'];

        // Draw headers with borders dynamically based on calculated column widths
        let xPos = 20;
        doc.setDrawColor(0);
        doc.setFillColor(255, 255, 255); // Set header background color to white

        for (let i = 0; i < columnWidths.length; i++) {
          doc.rect(xPos, headerYPos, columnWidths[i], cellHeight, 'F');
          doc.setTextColor(0); // Set text color to black
          doc.text(columnHeaders[i], xPos + cellPadding, headerYPos + cellHeight - cellPadding);
          xPos += columnWidths[i];
        }

          // Iterate through property statements and add them to the PDF with dynamic borders
          this.propertystatements.forEach((statement, index) => {
            let yPos = headerYPos + (index + 1) * lineHeight;

            // Draw borders for each cell dynamically based on calculated column widths
            xPos = 20;
            for (let i = 0; i < columnWidths.length; i++) {
              doc.rect(xPos, yPos, columnWidths[i], cellHeight);

              // Add content to cells dynamically based on column index
              switch (i) {
                case 0:
                  doc.text(this.format_date(statement.updated_at), xPos + cellPadding, yPos + cellHeight - cellPadding);
                  break;
                case 1:
                  let statusText = statement.status == 1 ? 'Paid' : 'Not Paid';
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
          });

          // Add footer
          doc.setFontSize(10);
          doc.text('Because You Are Worth', 20, doc.internal.pageSize.height - 10);

          //expenses section
          // Add a new page for Expenses
          doc.addPage();

          doc.setFontSize(14);
          doc.setTextColor(44, 62, 80);
          doc.text('Expenses:', 20, 20);

          doc.setFontSize(12);
          doc.setTextColor(0);

          // Draw table headers and borders dynamically based on the HTML structure
          let expenseHeaderYPos = 30;
          let expenseCellHeight = 10;
          let expenseCellPadding = 2;
          let expenseLineHeight = 5;
          let expenseColumnWidths = [60, 40, 70, 30, 60];

          // Define column headers for Expenses
          let expenseColumnHeaders = ['Type', 'Amount(KES)', 'Expended To', 'Checked By', 'Checked On'];

          // Draw headers with borders dynamically based on calculated column widths
          let expenseXPos = 20;
          doc.setDrawColor(0);
          doc.setFillColor(255, 255, 255); // Set header background color to white

          for (let i = 0; i < expenseColumnWidths.length; i++) {
            doc.rect(expenseXPos, expenseHeaderYPos, expenseColumnWidths[i], expenseCellHeight, 'F');
            doc.setTextColor(0); // Set text color to black
            doc.text(expenseColumnHeaders[i], expenseXPos + expenseCellPadding, expenseHeaderYPos + expenseCellHeight - expenseCellPadding);
            expenseXPos += expenseColumnWidths[i];
          }

          // Iterate through expenses and add them to the PDF with dynamic borders
          this.propertyexpenses.forEach((expense, index) => {
            let expenseYPos = expenseHeaderYPos + (index + 1) * expenseLineHeight;

            // Draw borders for each cell dynamically based on calculated column widths
            expenseXPos = 20;
            for (let i = 0; i < expenseColumnWidths.length; i++) {
              doc.rect(expenseXPos, expenseYPos, expenseColumnWidths[i], expenseCellHeight);

              // Add content to cells dynamically based on column index
              switch (i) {
                case 0:
                  doc.text(this.capitalizeFirstLetter(expense.payment_type), expenseXPos + expenseCellPadding, expenseYPos + expenseCellHeight - expenseCellPadding);
                  break;
                case 1:
                  doc.text(this.formatNumber(expense.amount_paid), expenseXPos + expenseCellPadding, expenseYPos + expenseCellHeight - expenseCellPadding);
                  break;
                case 2:
                  doc.text(expense.paid_to, expenseXPos + expenseCellPadding, expenseYPos + expenseCellHeight - expenseCellPadding);
                  break;
                case 3:
                  doc.text(`${expense.user.first_name} ${expense.user.last_name}`, expenseXPos + expenseCellPadding, expenseYPos + expenseCellHeight - expenseCellPadding);
                  break;
                case 4:
                  doc.text(this.format_date(expense.created_at), expenseXPos + expenseCellPadding, expenseYPos + expenseCellHeight - expenseCellPadding);
                  break;
              }

              expenseXPos += expenseColumnWidths[i];
            }
          });
          // Add footer
          doc.setFontSize(10);
          doc.text('Because You Are Worth', 20, doc.internal.pageSize.height - 10);

          // Save the PDF with a meaningful name
          let fileName = this.property.name.replace(/\s/g, '_') + '_' + pdfName + '.pdf';
          doc.save(fileName);
        },

        month()
        {
          this.$router.push('/monthpmspropertystatements/'+ this.$route.params.id)
        },
        year()
        {
          this.$router.push('/yearpmspropertystatements/'+ this.$route.params.id)
        },
        all()
        {
          this.$router.push('/pmspropertystatements/'+ this.$route.params.id)
        }
      },
      components : {
          TheMaster,
      },
      mounted(){
        this.getProperty();
        this.getPropertyStatements();
        this.getPropertyExpenses();
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
    
    
    