<template>
    <TheMaster>
        <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Edit Social Link</h5>
    
        <!-- Vertical Form -->
        <form class="row g-3">
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Name</label>
            <input type="text" v-model="form.name" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Link</label>
            <input type="text" v-model="form.link" class="form-control" id="inputNanme4">
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
              name: '',
              link: ''
             
             },
             message: "",
             successMessage: "",
             loading: false,
          }   
       },
       methods: {
        getSocialLink(){
        axios.get('/api/sociallink/'+this.$route.params.id, {
        }).then((response) => {
            this.form = response.data.sociallink
            // console.log(response)
            console.log("data", this.form)
        })
        },
        submit(){
            axios.put('/api/sociallink/'+this.$route.params.id, this.form)
            .then((response) => {

                    toast.fire({
                    title: 'Social Link Updated',
                    text: "social link updated ",
                    icon: 'success',
                })
                this.getSocialLink();
            })
        }
    },
    mounted(){
        this.getSocialLink();
    }
}
</script>