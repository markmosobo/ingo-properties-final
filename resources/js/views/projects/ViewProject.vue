<template>
  <TheMaster>
    <div class="container mt-3">

      <div class="row g-3">

        <!-- LEFT COLUMN -->
        <div class="col-lg-6">

          <!-- BASIC DETAILS -->
          <div class="card shadow-sm">
            <div class="card-body">

              <h5 class="card-title mb-3">Project Details</h5>

              <p class="mb-2">
                <strong>ID:</strong> {{ project.id ?? '---' }}
              </p>

              <p class="mb-2">
                <strong>Name:</strong> {{ project.name ?? '---' }}
              </p>

              <p class="mb-2">
                <strong>Location:</strong> {{ project.location ?? '---' }}
              </p>

              <p class="mb-2">
                <strong>Featured:</strong>
                <span v-if="project.featured == 1" class="badge bg-warning">Yes</span>
                <span v-else class="badge bg-secondary">No</span>
              </p>

              <p class="mb-0">
                <strong>Status:</strong>

                <span v-if="project.status == 0" class="badge bg-warning text-dark">
                  Ongoing
                </span>

                <span v-else-if="project.status == 1" class="badge bg-success">
                  Completed
                </span>

                <span v-else class="badge bg-dark">
                  Closed
                </span>

              </p>

            </div>
          </div>

          <!-- ACTIVITY -->
          <div class="card shadow-sm mt-3">
            <div class="card-body">

              <h5 class="card-title mb-3">Activity Stats</h5>

              <ul class="list-group list-group-flush">
                <li class="list-group-item text-muted">
                  No activity logs available yet.
                </li>
              </ul>

            </div>
          </div>

        </div>

        <!-- RIGHT COLUMN -->
        <div class="col-lg-6">

          <div class="card shadow-sm">

            <div class="card-body">

              <h5 class="card-title mb-3">Project Preview</h5>

              <!-- IMAGE -->
              <div class="mb-3 text-center">

                <img
                  v-if="project.image_path"
                  :src="getPhoto() + project.image_path"
                  class="img-fluid rounded"
                  style="max-height: 280px; object-fit: cover;"
                />

                <div v-else class="text-muted">
                  No image available
                </div>

              </div>

              <!-- DESCRIPTION -->
              <h6 class="fw-bold">Description</h6>

              <p class="text-muted" style="white-space: pre-line;">
                {{ project.description ?? 'No description provided.' }}
              </p>

            </div>

          </div>

        </div>

      </div>

    </div>
  </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";

export default {
  components: { TheMaster },

  data() {
    return {
      project: {}
    };
  },

  methods: {
    getPhoto() {
      return "/storage/projects/";
    },

    getData() {
      axios.get('/api/project/' + this.$route.params.id)
        .then((response) => {
          this.project = response.data.project;
        })
        .catch(() => {
          this.project = {};
        });
    }
  },

  mounted() {
    this.getData();
  }
};
</script>