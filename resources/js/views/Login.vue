<template>
    <main class="background-image">
      <div class="container">
        <section
          class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
        >
          <div class="container">
            <div class="row justify-content-center">
              <div
                class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
              >
                <div class="d-flex justify-content-center py-4">
                  <router-link to="/">
                  <a
                    href="#"
                    class="logo d-flex align-items-center w-auto"
                  >
                    <!-- <img src="@/assets/img/logo.png" alt="" /> -->
                    <img src="/images/ingo-colored-logo.png" alt="">
                    <span class="d-none d-lg-block">IPMC</span>
                  </a>
                  </router-link>
                </div>
                <!-- End Logo -->
  
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="pt-4 pb-2">
                      <h5 class="card-title text-center pb-0 fs-4">
                        Login to Your Account
                      </h5>
                      <p class="text-center small">
                        Enter your username & password to login
                      </p>
                    </div>
  
                    <form v-on:submit.prevent="login_user" class="row g-3 needs-validation" novalidate>
                      <div class="col-12">
                        <label for="yourUsername" class="form-label"
                          >Email</label
                        >
                          <input
                            type="text"
                            name="username"
                            class="form-control"
                            id="yourUsername"
                            v-model="form.email"
                            required
                          />
                          <div class="invalid-feedback">
                            Please enter your email.
                          </div>
                      </div>
  
                      <div class="col-12">
                        <label for="yourPassword" class="form-label"
                          >Password</label
                        >
                        <input
                          type="password"
                          name="password"
                          class="form-control"
                          id="yourPassword"
                          v-model="form.password"
                          required
                        />
                        <div class="invalid-feedback">
                          Please enter your password!
                        </div>
                      </div>
  
                      <div class="col-12">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="remember"
                            value="true"
                            id="rememberMe"
                          />
                          <label class="form-check-label" for="rememberMe"
                            >Remember me</label
                          >
                        </div>
                      </div>
                      <div class="col-12">
                        <button class="btn btn-success rounded-pill w-100" type="submit">
                          Login
                        </button>
                      </div>
                      <div class="col-12">
                        <p class="small mb-0">
                          Don't have account?
                          <router-link to="/register"> create Account</router-link>
                        </p>
                      </div>
                    </form>
                  </div>
                </div>
  
                <div class="credits">
                  <!-- All the links in the footer should remain intact. -->
                  <!-- You can delete the links only if you purchased the pro version. -->
                  <!-- Licensing information: https://bootstrapmade.com/license/ -->
                  <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                  <!-- Designed by
                  <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </main>
  </template>
  <script>
  import axios from 'axios';
  import Swal from 'sweetalert2'

  export default ({
    data(){
      return {
        form: {
          email: '',
          password: ''
        }
      }
    },
    methods: {
        deleteInvoice(id){
          Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#006400',
            cancelButtonColor: '#FFA500',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) { 
            //send request to the server
            axios.delete('/api/pmsstatement/'+id).then(() => {
            toast.fire(
              'Deleted!',
              'Invoice has been deleted.',
              'success'
            )
            this.loadLists();
            }).catch(() => {
              Swal.fire(
              'Failed!',
              'There was something wrong.',
              'warning'
            )
            }); 
            }else if(result.isDenied) {
              console.log('cancelled')
            }
                             
          })
        },
      login_user(){
        axios.post('api/login', this.form).then((response) => {
          console.log(response);
          this.form.email = '';
          this.form.password = '';
          if(response["data"]["status"] == "error")
         {
           Swal.fire({
            title: 'Oops!',
            text:   response.data.data,
            icon: 'warning',
          
          });
         }
         else
         {
          localStorage.setItem('user', JSON.stringify(response.data.user))
           this.$router.push('/dashboard')
          //  Swal.fire({
          //   title: 'Hurry',
          //   text:   "You have been logged-in successfully",
          //   icon: 'success',
          
          // });
         }
        }).catch((error) => {
          console.log(error)
        })
      }
    }
  });
  </script>

  <style scoped>
.background-image {
  background-image: url('@/assets/img/ingo.png');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  height: 100vh;
  width: 100%;
}

.container {
  height: 100%;
  align-items: center;
  justify-content: center;
}
</style>