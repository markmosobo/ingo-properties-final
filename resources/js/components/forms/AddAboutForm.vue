<template>
    <div class="card px-2">
        <div class="card-body">
        <h5 class="card-title">Add About</h5>
    
        <!-- Vertical Form -->
        <form class="row g-3">
            <div class="col-12">
            <label for="inputNanme4" class="form-label">Title</label>
            <input type="text" v-model="form.title" class="form-control" id="inputNanme4">
            </div>

            <div class="col-12">
            <label for="inputNanme4" class="form-label">Description</label>
            <input type="teaxtarea" v-model="form.description" class="form-control" id="inputNanme4">
            </div>

            <div class="col-sm-6">
               <label for="inputPassword" class="form-label">Add Feature Photo</label>
               <div class="col-sm-10">
                  <!-- <img src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no" class="picture-src" id="wizardPicturePreview" title=""> -->
                  <input type="file" @change="onChangePhoto" name="image" id="wizard-picture" class="form-control">

               <div class="invalid-feedback">Please enter photo!</div>
               </div>
            </div>
    
            <div class="col-lg-12 felx mt-4 row">
                    <div class="col-sm-6 col-lg-6">
                        <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                    </div>
                    <div class="col-sm-6 col-lg-6 text-end">
                        <button type="submit" @click.prevent="submit()" class="btn btn-primary">Submit</button>
                    </div>
                </div>
        </form><!-- Vertical Form -->
    
        </div>
    </div>
    </template>
    
    <script>
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
       data () {
          return {
             form: {
              title: '',
              description: '',
              image: ''
             
             },
             message: "",
             successMessage: "",
             loading: false,
          }   
       },
       methods: {
         onChangePhoto(e) {
            console.log('loadings');
            let file = e.target.files[0];
            console.log(file)
            let reader = new FileReader();
            reader.onloadend = (file) => {
               // console.log('RESULT', reader.result)
               this.form.image = reader.result;
            }
            reader.readAsDataURL(file);
         },
          submit(){
             axios.post("api/abouts", this.form)
             .then(function (response) {
                console.log(response);
                // this.step = 1;
                toast.fire(
                   'Success!',
                   'About info added!',
                   'success'
                )
             })
             .catch(function (error) {
                console.log(error);
                // Swal.fire(
                //    'error!',
                //    // phone_error + id_error + pass_number,
                //    'error'
                // )
             });
             this.$router.push('/all-abouts')
    
          }
    
       },
       mounted() {
       }
    
    }
    </script>