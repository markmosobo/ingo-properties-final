<template>
  <TheMaster>
    <section class="section dashboard" v-if="user">

      <!-- WEBSITE -->
      <h5 class="fw-bold mb-3">Website</h5>
      <div class="row g-3">
        <div
          v-for="card in websiteCards"
          :key="card.title"
          class="col-xxl-2 col-md-3 col-sm-4"
        >
          <div
            class="card stat-card h-100"
            role="button"
            @click="navigateTo(card.route)"
          >
            <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
                <div>
                  <h6 class="text-uppercase text-muted mb-1">{{ card.title }}</h6>
                  <small class="text-muted">{{ card.subtitle }}</small>
                </div>
                <div class="icon-circle">
                  <i :class="card.icon"></i>
                </div>
              </div>

              <div v-for="stat in card.stats" :key="stat.label" class="mb-2">
                <h4 class="fw-bold mb-0">{{ stat.value }}</h4>
                <small class="text-muted">{{ stat.label }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- PMS -->
      <h5 class="fw-bold mt-4 mb-3">Property Management System</h5>
      <div class="row g-3">
        <div
          v-for="card in pmsCards"
          :key="card.title"
          class="col-xxl-2 col-md-3 col-sm-4"
        >
          <div
            class="card stat-card h-100"
            role="button"
            @click="navigateTo(card.route)"
          >
            <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
                <div>
                  <h6 class="text-uppercase text-muted mb-1">{{ card.title }}</h6>
                  <small class="text-muted">{{ card.subtitle }}</small>
                </div>
                <div class="icon-circle">
                  <i :class="card.icon"></i>
                </div>
              </div>

              <div v-for="stat in card.stats" :key="stat.label" class="mb-2">
                <h4 class="fw-bold mb-0">{{ stat.value }}</h4>
                <small class="text-muted">{{ stat.label }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- SYSTEM -->
      <h5 class="fw-bold mt-4 mb-3">System</h5>
      <div class="row g-3">
        <div
          v-for="card in systemCards"
          :key="card.title"
          class="col-xxl-2 col-md-3 col-sm-4"
        >
          <div
            class="card stat-card h-100"
            role="button"
            @click="navigateTo(card.route)"
          >
            <div class="card-body">
              <div class="d-flex justify-content-between mb-3">
                <div>
                  <h6 class="text-uppercase text-muted mb-1">{{ card.title }}</h6>
                  <small class="text-muted">{{ card.subtitle }}</small>
                </div>
                <div class="icon-circle">
                  <i :class="card.icon"></i>
                </div>
              </div>

              <div v-for="stat in card.stats" :key="stat.label" class="mb-2">
                <h4 class="fw-bold mb-0">{{ stat.value }}</h4>
                <small class="text-muted">{{ stat.label }}</small>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </TheMaster>
</template>

<script>
import TheMaster from '@/components/dashboard/TheMaster.vue'
import axios from 'axios'

export default {
  name: 'Home',
  components: { TheMaster },

  data() {
    return {
      user: null,

      openproperties: [],
      closedproperties: [],
      projectscount: 0,
      testimonialscount: 0,
      blogscount: 0,
      approvedblogscount: 0,

      pmspropertiescount: 0,
      pmsunitscount: 0,
      landlordscount: 0,
      activetenantscount: 0,
      rentedunitscount: 0,
      vacatedunitscount: 0,
      awaitinginvoicingcount: 0,
      invoicedcount: 0,

      staffcount: 0,
      regularuserscount: 0
    }
  },

  computed: {
    websiteCards() {
      return [
        {
          title: 'Listings',
          subtitle: 'Website',
          icon: 'bi bi-building',
          route: '/all-properties',
          stats: [
            { label: 'Open', value: this.openproperties.length },
            { label: 'Closed', value: this.closedproperties.length }
          ]
        },
        {
          title: 'Projects',
          subtitle: 'Website',
          icon: 'bi bi-grid',
          route: '/all-projects',
          stats: [
            { label: 'Projects', value: this.projectscount },
            { label: 'Testimonials', value: this.testimonialscount }
          ]
        },
        {
          title: 'Blogs',
          subtitle: 'Website',
          icon: 'bi bi-chat',
          route: '/all-blogs',
          stats: [
            { label: 'Approved', value: this.approvedblogscount },
            { label: 'Uploaded', value: this.blogscount }
          ]
        }
      ]
    },

    pmsCards() {
      return [
        {
          title: 'Properties',
          subtitle: 'PMS',
          icon: 'bi bi-building',
          route: '/pmsproperties',
          stats: [
            { label: 'Managed', value: this.pmspropertiescount },
            { label: 'Units', value: this.pmsunitscount }
          ]
        },
        {
          title: 'Landlords',
          subtitle: 'PMS',
          icon: 'bi bi-people',
          route: '/pmslandlords',
          stats: [
            { label: 'Landlords', value: this.landlordscount },
            { label: 'Active Tenants', value: this.activetenantscount }
          ]
        },
        {
          title: 'Units',
          subtitle: 'PMS',
          icon: 'bi bi-house-door',
          route: '/pmsunits',
          stats: [
            { label: 'Rented', value: this.rentedunitscount },
            { label: 'Vacated', value: this.vacatedunitscount }
          ]
        },
        {
          title: 'Invoices',
          subtitle: 'PMS',
          icon: 'bi bi-file-earmark-text',
          route: '/invoicestosettle',
          stats: [
            { label: 'Awaiting', value: this.awaitinginvoicingcount },
            { label: 'Settled', value: this.invoicedcount }
          ]
        }
      ]
    },

    systemCards() {
      return [
        {
          title: 'Users',
          subtitle: 'System',
          icon: 'bi bi-people',
          route: '/all-users',
          stats: [
            { label: 'Staff', value: this.staffcount },
            { label: 'Users', value: this.regularuserscount }
          ]
        }
      ]
    }
  },

  methods: {
    navigateTo(route) {
      this.$router.push(route)
    },

    loadLists() {
      axios.get('api/lists').then(res => {
        const d = res.data.lists
        this.openproperties = d.openproperties
        this.closedproperties = d.closedproperties
        this.projectscount = d.projectscount
        this.testimonialscount = d.testimonialscount
        this.blogscount = d.blogscount
        this.approvedblogscount = d.approvedblogscount
        this.pmspropertiescount = d.pmspropertiescount
        this.pmsunitscount = d.pmsunitscount
        this.landlordscount = d.landlordscount
        this.activetenantscount = d.activetenantscount
        this.rentedunitscount = d.rentedunitscount
        this.vacatedunitscount = d.vacatedunitscount
        this.awaitinginvoicingcount = d.awaitinginvoicingcount
        this.invoicedcount = d.invoicedcount
        this.staffcount = d.staffcount
        this.regularuserscount = d.regularuserscount
      })
    }
  },

  mounted() {
    this.user = JSON.parse(localStorage.getItem('user'))
    this.loadLists()
  }
}
</script>

<style scoped>
.stat-card {
  border: none;
  transition: all 0.25s ease;
  cursor: pointer;
}
.stat-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0,0,0,.08);
}
.icon-circle {
  width: 42px;
  height: 42px;
  border-radius: 50%;
  background: #f1f5f9;
  display: flex;
  align-items: center;
  justify-content: center;
}
.icon-circle i {
  font-size: 1.2rem;
}
</style>