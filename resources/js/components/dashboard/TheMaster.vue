<template>
  <TheHeader />
  <TheSidebar />
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <!-- <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav> -->
    </div>
    <!-- End Page Title -->

    <slot></slot>

  </main><!-- End #main -->
  <TheFooter />
</template>

<script>
import TheHeader from "./TheHeader.vue";
import TheSidebar from "./TheSidebar.vue";
import TheFooter from "./TheFooter.vue";

export default {
  name: 'TheMaster',
  components: {
    TheHeader,
    TheSidebar,
    TheFooter,
  },
  mounted() {
    document.body.classList.remove("toggle-sidebar");
  }
};
</script>

<style scoped>
.main, #main, body {
  font-family: 'Open Sans', 'Nunito', 'Poppins', sans-serif;
  font-weight: 400; /* default */
  color: #333;       /* optional: consistent text color */
}

.pagetitle h1 {
  font-family: 'Poppins', 'Open Sans', sans-serif;
  font-weight: 600;  /* headings slightly bolder */
}

slot {
  font-family: inherit; /* ensure slot content inherits font */
}
</style>
