<template>
    <TheMaster>
        <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Edit Service</h5>
    
        <!-- Vertical Form -->
        <form class="row g-3">
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Title</label>
            <input type="text" v-model="form.title" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Description</label>
            <textarea v-model="form.description" class="form-control" id="inputNanme4"></textarea>
            </div>

            <div class="col-lg-12 felx mt-4 row">
                    <div class="col-sm-6 col-lg-6">
                        <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                    </div>
                    <div class="col-sm-6 col-lg-6 text-end">
                        <button type="submit" @click.prevent="submit()" class="btn btn-sm btn-primary rounded-pill">Update</button>
                    </div>
                </div>
        </form><!-- Vertical Form -->
    
        </div>
        </div>
    </TheMaster>
</template>

<script>
import TheMaster from "@/components/dashboard/TheMaster.vue";
import axios from "axios";
import Swal from 'sweetalert2';


const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});

window.toast = toast;
export default {
   components : {
       TheMaster,
   },
   data () {
          return {
             form: {
              title: '',
              description: ''
             
             },
             message: "",
             successMessage: "",
             loading: false,
          }   
       },
       methods: {
        getService(){
        axios.get('/api/service/'+this.$route.params.id, {
        }).then((response) => {
            this.form = response.data.service
            // console.log(response)
            console.log("data", this.form)
        })
        },
        submit(){
            axios.put('/api/service/'+this.$route.params.id, this.form)
            .then((response) => {

                    toast.fire({
                    title: 'Service Updated',
                    text: "service updated ",
                    icon: 'success',
                })
                this.getService();
            })
            this.$router.push('/all-abouts')
        }
    },
    mounted(){
        this.getService();
    }
}
</script>