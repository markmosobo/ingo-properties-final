<template>
    <TheMaster>
        <div class="container mt-3">
            <div class="row">
              <div class="col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Property Details</h5>
                    <p class="card-text">
                      <strong>Property ID:</strong>{{ property.id }} <br>
                      <strong>Title:</strong> {{ property.title }} <br>
                      <strong>Category:</strong>  {{ property.category_id }}<br>
                      <strong>Estate:</strong>  {{ property.estate_name }}<br>
                      <strong>Property Type:</strong>  {{ property.property_type_id }} <br>
                      <strong>Featured:</strong>
                        <span v-if="property.featured == 0" class="badge bg-success">No</span>
                        <span v-else class="badge bg-warning"> Yes</span>
                      <br>
                      <strong>Status:</strong>
                        <span v-if="property.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>   
                        <span v-else-if="property.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                        <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Closed</span>
                      <br>
                      <strong>Price:</strong> KSH {{ property.price }} <br>
                      <strong>Address:</strong> {{ property.address }} <br>
                      <strong>Location:</strong>  {{ property.location}} <br>
                      <strong>Bathrooms:</strong>  {{ property.bathrooms}} <br>
                      <strong>Bedrooms:</strong>  {{ property.bedrooms}} <br>
                      <strong>Parking space:</strong>  {{ property.parking_space}} <br>
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
                    <img :src="getPhoto() + property.images[0].name" class="img-thumbnail avatar"  alt="User Image">

                    <ul class="list-group">
                     <li class="list-group-item"> {{property.description}} </li>
    
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
        property: []
    }
   },
   methods: {
    getPhoto()
    {
        return "/storage/properties/";
    },
    getData(){
      axios.get('/api/property/'+this.$route.params.id, {
      }).then((response) => {
          this.property = response.data.property
          // console.log(response)
          console.log("data", this.property)
      })
    }
   },
   mounted(){
    this.getData();
   }
}
</script>