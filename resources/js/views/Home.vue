<template>
    <TheMaster>
      <section v-if="user.role_id == 1" class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Listings Card -->
            <div @click="goListings" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card sales-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Listings <span>| Website</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{openproperties.length}}</h6>
                      <span class="text-success small pt-1 fw-bold">Open</span> <span class="text-muted small pt-2 ps-1">listings</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building" style="color:forestgreen;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{closedproperties.length}}</h6>
                      <span class="text-success small pt-1 fw-bold">Closed</span> <span class="text-muted small pt-2 ps-1">listings</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Listings Card -->

            <!-- Projects Card -->
            <div @click="goProjects" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card revenue-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Projects <span> | Website</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-grid" style="color:brown;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{projectscount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1">projects</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-chat"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{testimonialscount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1">testimonials</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Projects Card -->

            <!-- Users Card -->
            <div @click="goUsers" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-primary">Users<span> | System</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-people" style="color: blue;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ staffcount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Staff</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-person-lines-fill" style="color: teal;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ regularuserscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">System</span> <span class="text-muted small pt-2 ps-1">users</span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div><!-- End Users Card -->

            <!-- Blogs Card -->
            <div @click="goBlogs" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-info">Blogs<span> | Website</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-chat" style="color: teal;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ approvedblogscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Approved</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-chat" style="color: salmon;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ blogscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Blogs Card -->

            <!-- Properties Card -->
            <div @click="goProperties" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Properties<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-building" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ pmspropertiescount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Managed</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-house-door" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ pmsunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Units</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Properties Card -->

            <!-- Landlords Card -->
            <div @click="goLandlords" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Landlords<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-people" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ landlordscount }}</h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">landlords</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-people" style="color: firebrick;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ activetenantscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Active</span> <span class="text-muted small pt-2 ps-1">tenants</span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Landlords Card -->

            <!-- Units Card -->
            <div class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Units<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-house-door" style="color: firebrick;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ rentedunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Rented</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-box-arrow-right" style="color: darkcyan;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ vacatedunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Vacated</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Units Card -->

            <!-- Invoices Card -->
            <div @click="goInvoices" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card sales-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Invoices <span>| PMS</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{awaitinginvoicingcount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Awaiting</span> <span class="text-muted small pt-2 ps-1">settling</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-text" style="color:forestgreen;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{invoicedcount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Settled</span> <span class="text-muted small pt-2 ps-1">invoices</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Invoices Card -->




          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->


      </div>
      </section>

      <section v-if="user.role_id == 2" class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Listings Card -->
            <div @click="goListings" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card sales-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Listings <span>| Website</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{openproperties.length}}</h6>
                      <span class="text-success small pt-1 fw-bold">Open</span> <span class="text-muted small pt-2 ps-1">listings</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building" style="color:forestgreen;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{closedproperties.length}}</h6>
                      <span class="text-success small pt-1 fw-bold">Closed</span> <span class="text-muted small pt-2 ps-1">listings</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Listings Card -->

            <!-- Projects Card -->
            <div @click="goProjects" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card revenue-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Projects <span> | Website</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-grid" style="color:brown;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{projectscount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1">projects</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-chat"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{testimonialscount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1">testimonials</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Projects Card -->

            <!-- Blogs Card -->
            <div @click="goBlogs" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-info">Blogs<span> | Website</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-chat" style="color: teal;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ approvedblogscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Approved</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <i class="bi bi-chat" style="color: salmon;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ blogscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Uploaded</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div><!-- End Blogs Card -->

            <!-- Properties Card -->
            <div @click="goProperties" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Properties<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-building" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ pmspropertiescount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Managed</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-house-door" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ pmsunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Units</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Properties Card -->

            <!-- Landlords Card -->
            <div @click="goLandlords" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Landlords<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-people" style="color: darkslategray;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ landlordscount }}</h6>
                      <span class="text-success small pt-1 fw-bold"></span> <span class="text-muted small pt-2 ps-1">landlords</span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-people" style="color: firebrick;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ activetenantscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Active</span> <span class="text-muted small pt-2 ps-1">tenants</span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Landlords Card -->

            <!-- Units Card -->
            <div class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card customers-card shadow-sm">
                <div class="card-body">
                  <h5 class="card-title text-secondary">Units<span> | PMS</span></h5>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-house-door" style="color: firebrick;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ rentedunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Rented</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-light">
                      <!-- Using bi-people for all tenants -->
                      <i class="bi bi-box-arrow-right" style="color: darkcyan;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ vacatedunitscount }}</h6>
                      <span class="text-success small pt-1 fw-bold">Vacated</span> <span class="text-muted small pt-2 ps-1"></span>
                    </div>
                  </div>                  
                </div>
              </div>
            </div>
            <!-- End Units Card -->

            <!-- Invoices Card -->
            <div @click="goInvoices" class="col-xxl-2 col-md-3 col-sm-4 mb-3">
              <div class="card info-card sales-card">

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
                </div> -->

                <div class="card-body">
                  <h5 class="card-title">Invoices <span>| PMS</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{awaitinginvoicingcount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Awaiting</span> <span class="text-muted small pt-2 ps-1">settling</span>

                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-file-earmark-text" style="color:forestgreen;"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{invoicedcount}}</h6>
                      <span class="text-success small pt-1 fw-bold">Settled</span> <span class="text-muted small pt-2 ps-1">invoices</span>

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Invoices Card -->




          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->


      </div>
      </section>

      <section v-if="user.role_id == 3" class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

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

                <div @click="viewListings()" class="card-body">
                  <h5 class="card-title">Your Listings <span>| Properties added by you</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-building"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{myproperties.length}}</h6>
                      <!-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

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
                </div> -->

                <div @click="viewProfile()" class="card-body">
                  <h5 class="card-title">Your Profile <span>| Change details</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6></h6>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->


          </div>
        </div><!-- End Left side columns -->

        <!-- Right side columns -->


      </div>
      </section>      
    </TheMaster>
    </template>
    
    <script>
    import TheMaster from '@/components/dashboard/TheMaster.vue'
    import axios from 'axios';
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
    // import store from '../store'

    export default {
      name: 'Home',
      components: {
        TheMaster,
      },
      data(){
        return {
          user: [],
          properties: [],
          blogs: [],
          openproperties: [],
          closedproperties: [],
          myproperties: [],
          userclosedproperties: [],
          users: [],
          userscount: '',
          landlordscount: '',
          tenantscount: '',
          projectscount: '',
          blogscount: '',
          approvedblogscount: '',
          staffcount: '',
          testimonialscount: '',
          regularuserscount: '',
          pmspropertiescount: '',
          pmsunitscount: '',
          activetenantscount: '',
          rentedunitscount: '',
          vacatedunitscount: '',
          awaitinginvoicingcount: '',
          invoicedcount: ''

        }
      },
      methods: {
        goListings()
        {
          this.$router.push('/all-properties')
        },
        goProjects()
        {
          this.$router.push('/all-projects')
        },
        goUsers()
        {
          this.$router.push('/all-users')
        },
        goBlogs()
        {
          this.$router.push('/all-blogs')
        },
        goProperties()
        {
          this.$router.push('/pmsproperties')
        },
        goLandlords()
        {
          this.$router.push('/pmslandlords')
        },
        goTenants()
        {
          this.$router.push('/pmstenants')
        }, 
        goInvoices()
        {
          this.$router.push('/invoicestosettle')
        },     
        viewListings()
        {
          this.$router.push('/my-properties');
        },
        viewProfile()
        {
          this.$router.push('/profile');
        },
        navigateTo(location){
            this.$router.push(location)
        },
        loadLists(){
          axios.get('api/lists').then((response) => {
            this.properties = response.data.lists.properties;
            this.openproperties = response.data.lists.openproperties;
            this.closedproperties = response.data.lists.closedproperties;
            this.users = response.data.lists.users;
            this.userscount = response.data.lists.userscount;
            this.landlordscount = response.data.lists.landlordscount;
            this.tenantscount = response.data.lists.tenantscount;
            this.activetenantscount = response.data.lists.activetenantscount;
            this.projectscount = response.data.lists.projectscount;
            this.blogscount = response.data.lists.blogscount;
            this.approvedblogscount = response.data.lists.approvedblogscount;
            this.staffcount = response.data.lists.staffcount;
            this.regularuserscount = response.data.lists.regularuserscount;
            this.testimonialscount = response.data.lists.testimonialscount;

            this.pmspropertiescount = response.data.lists.pmspropertiescount;
            this.pmsunitscount = response.data.lists.pmsunitscount;
            this.rentedunitscount = response.data.lists.rentedunitscount;
            this.vacatedunitscount = response.data.lists.vacatedunitscount;
            this.awaitinginvoicingcount = response.data.lists.awaitinginvoicingcount;
            this.invoicedcount = response.data.lists.invoicedcount;

          })
        },
        getData(){
            axios.get('api/myproperties/'+this.user.id).then((response)=>{
                this.myproperties = response.data.myproperties;
                setTimeout(() => {
                  $("#PropertiesTable").DataTable();
              }, 10);
            })
        }
      },
      mounted(){
        this.loadLists();
        this.user = localStorage.getItem('user');
        this.user = JSON.parse(this.user);
        this.getData();
      }
    }
    </script>
    