<template>
    <TheMaster>
        <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Edit Contact</h5>
    
        <!-- Vertical Form -->
        <form class="row g-3">
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Primary Phone</label>
            <input type="text" v-model="form.phone" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Secondary Phone</label>
            <input type="text" v-model="form.phone_2" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Email</label>
            <input type="text" v-model="form.email" class="form-control" id="inputNanme4">
            </div>
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Primary Phone</label>
            <textarea v-model="form.address" class="form-control" id="inputNanme4"></textarea>
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
              phone: '',
              phone_2: '',
              email: '',
              address: ''
             
             },
             message: "",
             successMessage: "",
             loading: false,
          }   
       },
       methods: {
        getContact(){
        axios.get('/api/contact/'+this.$route.params.id, {
        }).then((response) => {
            this.form = response.data.contact
            // console.log(response)
            console.log("data", this.form)
        })
        },
        submit(){
            axios.put('/api/contact/'+this.$route.params.id, this.form)
            .then((response) => {

                    toast.fire({
                    title: 'Contact Updated',
                    text: "contact updated ",
                    icon: 'success',
                })
                this.getContact();
            })
        }
    },
    mounted(){
        this.getContact();
    }
}
</script>