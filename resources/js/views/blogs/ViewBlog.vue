<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Blog Details</h5>
                    <p class="card-text">
                      <strong>Blog ID:</strong>{{ blog.id }} <br>
                      <strong>Title:</strong> {{ blog.title }} <br>
                      <!-- <strong>Category:</strong>  {{ blog.category_id }}<br> -->
                      <strong>Featured:</strong>
                        <span v-if="blog.featured == 0" class="badge bg-success">No</span>
                        <span v-else class="badge bg-warning"> Yes</span>
                      <br>
                      <strong>Status:</strong>
                        <span v-if="blog.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>   
                        <span v-else-if="blog.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                        <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Archived</span>
                      <br>
                    </p>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Description</h5>
                    <ul class="list-group">
                     <li class="list-group-item"> {{blog.content}} </li>
    
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Feature Photo</h5>
                    <img :src="getPhoto() + blog.image_path" class="img-thumbnail avatar"  alt="User Image">

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
        blog: []
    }
   },
   methods: {
    getPhoto()
    {
        return "/storage/blogs/";
    },
    getData(){
      axios.get('/api/blog/'+this.$route.params.id, {
      }).then((response) => {
          this.blog = response.data.blog
          // console.log(response)
          console.log("data", this.blog)
      })
    }
   },
   mounted(){
    this.getData();
   }
}
</script>