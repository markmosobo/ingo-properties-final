<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Project Details</h5>
                    <p class="card-text">
                      <strong>Project ID:</strong>{{ project.id }} <br>
                      <strong>Name:</strong> {{ project.name }} <br>
                      <strong>Location:</strong>  {{ project.location }}<br>
                      <strong>Featured:</strong>
                        <span v-if="project.featured == 0" class="badge bg-success">No</span>
                        <span v-else class="badge bg-warning"> Yes</span>
                      <br>
                      <strong>Status:</strong>
                        <span v-if="project.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Ongoing</span>   
                        <span v-else-if="project.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Completed</span>
                        <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed</span>
                      <br>
                    </p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Activity Stats</h5>
                    <ul class="list-group">
                     <li class="list-group-item"> Listing created by max at 12:00 pm </li>
    
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <img :src="getPhoto() + project.image_path" class="img-thumbnail avatar"  alt="User Image">

                    <ul class="list-group">
                     <li class="list-group-item"> {{project.description}} </li>
    
                    </ul>
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
   components : {
       TheMaster,
   },
   data() {
    return {
        project: []
    }
   },
   methods: {
    getPhoto()
    {
        return "/storage/projects/";
    },
    getData(){
      axios.get('/api/project/'+this.$route.params.id, {
      }).then((response) => {
          this.project = response.data.project
          // console.log(response)
          console.log("data", this.project)
      })
    }
   },
   mounted(){
    this.getData();
   }
}
</script>