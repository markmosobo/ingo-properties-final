<template>
  <main class="background-image">
    <section
      class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
    >
      <div class="container">
        <div class="row justify-content-center">
          <div
            class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
          >

            <!-- Logo -->
            <div class="d-flex justify-content-center py-4">
              <router-link
                to="/"
                class="logo d-flex align-items-center w-auto"
              >
                <img
                  src="/images/ingo-colored-logo.png"
                  alt="IPMC Logo"
                />

                <span class="d-none d-lg-block ms-2">
                  IPMC
                </span>
              </router-link>
            </div>


            <!-- Login Card -->
            <div class="card login-card mb-3 w-100">
              <div class="card-body">

                <!-- Heading -->
                <div class="mb-4 text-center">
                  <h4 class="fw-bold mb-1">
                    Welcome Back
                  </h4>

                  <p class="text-muted small mb-0">
                    Sign in to continue to IPMC
                  </p>
                </div>


                <!-- Login Form -->
                <form
                  @submit.prevent="login_user"
                  class="row g-3"
                >

                  <!-- Email -->
                  <div class="col-12">
                    <label class="form-label">
                      Email
                    </label>

                    <input
                      type="email"
                      class="form-control"
                      placeholder="you@example.com"
                      v-model.trim="form.email"
                      autocomplete="email"
                      required
                    />
                  </div>


                  <!-- Password -->
                  <div class="col-12">
                    <label class="form-label">
                      Password
                    </label>

                    <div class="password-wrapper">

                      <input
                        :type="
                          isPasswordVisible
                            ? 'text'
                            : 'password'
                        "
                        class="form-control"
                        placeholder="Enter your password"
                        v-model="form.password"
                        autocomplete="current-password"
                        minlength="8"
                        required
                      />

                      <button
                        type="button"
                        class="password-toggle"
                        @click="togglePasswordVisibility"
                        tabindex="-1"
                        aria-label="Toggle password visibility"
                      >
                        <i
                          :class="
                            isPasswordVisible
                              ? 'fa fa-eye'
                              : 'fa fa-eye-slash'
                          "
                        ></i>
                      </button>

                    </div>
                  </div>


                  <!-- Remember Me -->
                  <div
                    class="col-12 d-flex justify-content-between align-items-center"
                  >
                    <div class="form-check">

                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="rememberMe"
                        v-model="rememberMe"
                      />

                      <label
                        class="form-check-label small"
                        for="rememberMe"
                      >
                        Remember me
                      </label>

                    </div>
                  </div>


                  <!-- Login Button -->
                  <div class="col-12">

                    <button
                      class="btn btn-success rounded-pill w-100"
                      type="submit"
                      :disabled="loading"
                    >

                      <span
                        v-if="loading"
                        class="spinner-border spinner-border-sm me-2"
                      ></span>

                      <span>
                        {{
                          loading
                            ? "Signing in…"
                            : "Login"
                        }}
                      </span>

                    </button>

                  </div>


                  <!-- Resend Verification -->
                  <div
                    v-if="showVerificationOption"
                    class="col-12"
                  >

                    <div class="verification-box text-center">

                      <div class="verification-icon mb-2">
                        <i class="fa fa-envelope"></i>
                      </div>

                      <p class="small mb-2">
                        Your email address has not been
                        verified yet.
                      </p>

                      <button
                        type="button"
                        class="btn btn-link btn-sm p-0"
                        @click="resendVerification"
                        :disabled="resending"
                      >

                        <span
                          v-if="resending"
                          class="spinner-border spinner-border-sm me-1"
                        ></span>

                        {{
                          resending
                            ? "Sending…"
                            : "Resend Verification Link"
                        }}

                      </button>

                    </div>

                  </div>


                  <!-- Register -->
                  <div class="col-12 text-center">

                    <p class="small mb-0">

                      Don't have an account?

                      <router-link to="/register">
                        Create one
                      </router-link>

                    </p>

                  </div>

                </form>

              </div>
            </div>


            <!-- Footer -->
            <p class="text-center text-white small mt-2">
              © {{ new Date().getFullYear() }}
              IPMC • Secure Access
            </p>

          </div>
        </div>
      </div>
    </section>
  </main>
</template>


<script>
import axios from "axios";
import Swal from "sweetalert2";

export default {

  data() {
    return {

      loading: false,

      resending: false,

      isPasswordVisible: false,

      showVerificationOption: false,

      rememberMe: false,

      form: {
        email: "",
        password: "",
      },

    };
  },


  mounted() {

    /*
    |--------------------------------------------------------------------------
    | Handle successful email verification
    |--------------------------------------------------------------------------
    */

    if (this.$route.query.verified === "success") {

      Swal.fire({
        title: "Email Verified!",
        text:
          "Your email address has been verified successfully. " +
          "You can now log in to your IPMC account.",
        icon: "success",
        confirmButtonText: "Login",
      });

    }


    /*
    |--------------------------------------------------------------------------
    | Already verified
    |--------------------------------------------------------------------------
    */

    if (this.$route.query.verified === "already") {

      Swal.fire({
        title: "Already Verified",
        text:
          "Your email address has already been verified. " +
          "You can log in to your account.",
        icon: "info",
        confirmButtonText: "Login",
      });

    }

  },


  methods: {

    /*
    |--------------------------------------------------------------------------
    | Password visibility
    |--------------------------------------------------------------------------
    */

    togglePasswordVisibility() {

      this.isPasswordVisible =
        !this.isPasswordVisible;

    },


    /*
    |--------------------------------------------------------------------------
    | Login
    |--------------------------------------------------------------------------
    */

    login_user() {

      /*
      |--------------------------------------------------------------------------
      | Required fields
      |--------------------------------------------------------------------------
      */

      if (
        !this.form.email ||
        !this.form.password
      ) {

        Swal.fire(
          "Incomplete Form",
          "Please enter your email address and password.",
          "warning"
        );

        return;
      }


      /*
      |--------------------------------------------------------------------------
      | Email format
      |--------------------------------------------------------------------------
      */

      const emailPattern =
      /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (!emailPattern.test(this.form.email)) {

        Swal.fire(
          "Invalid Email",
          "Please enter a valid email address.",
          "warning"
        );

        return;
      }


      /*
      |--------------------------------------------------------------------------
      | Password length
      |--------------------------------------------------------------------------
      */

      if (this.form.password.length < 8) {

        Swal.fire(
          "Invalid Password",
          "Password must be at least 8 characters long.",
          "warning"
        );

        return;
      }


      this.loading = true;

      /*
      |--------------------------------------------------------------------------
      | Hide resend option during new login attempt
      |--------------------------------------------------------------------------
      */

      this.showVerificationOption = false;


      axios
        .post("/api/login", {

          email: this.form.email,

          password: this.form.password,

          remember: this.rememberMe,

        })


        .then((response) => {

          /*
          |--------------------------------------------------------------------------
          | Backend returned an error
          |--------------------------------------------------------------------------
          */

          if (response.data.status === "error") {

            /*
            |--------------------------------------------------------------------------
            | Email not verified
            |--------------------------------------------------------------------------
            */

            if (
              response.data.email_verified === false
            ) {

              this.showVerificationOption = true;

              Swal.fire({
                title: "Email Not Verified",
                text:
                  "Please verify your email address before logging in.",
                icon: "warning",
                confirmButtonText: "OK",
              });

              return;
            }


            /*
            |--------------------------------------------------------------------------
            | Other login errors
            |--------------------------------------------------------------------------
            */

            Swal.fire(
              "Oops!",
              response.data.data ||
                "Unable to login.",
              "warning"
            );

            return;
          }


          /*
          |--------------------------------------------------------------------------
          | Successful login
          |--------------------------------------------------------------------------
          */

          localStorage.setItem(
            "user",
            JSON.stringify(response.data.user)
          );


          /*
          |--------------------------------------------------------------------------
          | Store token if your API returns one
          |--------------------------------------------------------------------------
          */

          if (response.data.token) {

            localStorage.setItem(
              "token",
              response.data.token
            );

          }


          /*
          |--------------------------------------------------------------------------
          | Redirect
          |--------------------------------------------------------------------------
          */

          this.$router.push("/dashboard");

        })


        .catch((error) => {

          console.log(error);


          /*
          |--------------------------------------------------------------------------
          | Validation errors
          |--------------------------------------------------------------------------
          */

          if (
            error.response &&
            error.response.data &&
            error.response.data.errors
          ) {

            const errors =
              error.response.data.errors;

            const firstField =
              Object.keys(errors)[0];

            const firstError =
              errors[firstField][0];

            Swal.fire(
              "Validation Error",
              firstError,
              "warning"
            );

            return;
          }


          /*
          |--------------------------------------------------------------------------
          | Unverified account returned with HTTP 403
          |--------------------------------------------------------------------------
          */

          if (
            error.response &&
            error.response.status === 403 &&
            error.response.data &&
            error.response.data.email_verified === false
          ) {

            this.showVerificationOption = true;

            Swal.fire({
              title: "Email Not Verified",
              text:
                "Please verify your email address before logging in.",
              icon: "warning",
              confirmButtonText: "OK",
            });

            return;
          }


          /*
          |--------------------------------------------------------------------------
          | Other errors
          |--------------------------------------------------------------------------
          */

          Swal.fire(
            "Error",
            "Unable to login. Please check your credentials and try again.",
            "error"
          );

        })


        .finally(() => {

          this.loading = false;

        });

    },


    /*
    |--------------------------------------------------------------------------
    | Resend Verification Email
    |--------------------------------------------------------------------------
    */

    resendVerification() {

      if (!this.form.email) {

        Swal.fire(
          "Email Required",
          "Please enter the email address you used when registering.",
          "warning"
        );

        return;
      }


      this.resending = true;


      axios
        .post(
          "/api/email/verification-notification",
          {
            email: this.form.email,
          }
        )


        .then((response) => {

          Swal.fire({
            title: "Verification Email Sent",
            text:
              response.data.message ||
              "A new verification link has been sent to your email address.",
            icon: "success",
            confirmButtonText: "OK",
          });

        })


        .catch((error) => {

          console.log(error);


          /*
          |--------------------------------------------------------------------------
          | Throttled
          |--------------------------------------------------------------------------
          */

          if (
            error.response &&
            error.response.status === 429
          ) {

            Swal.fire(
              "Please Wait",
              "A verification email was recently sent. Please wait a moment before requesting another.",
              "info"
            );

            return;
          }


          /*
          |--------------------------------------------------------------------------
          | Validation
          |--------------------------------------------------------------------------
          */

          if (
            error.response &&
            error.response.data &&
            error.response.data.message
          ) {

            Swal.fire(
              "Unable to Resend",
              error.response.data.message,
              "warning"
            );

            return;
          }


          Swal.fire(
            "Error",
            "Unable to resend the verification email. Please try again.",
            "error"
          );

        })


        .finally(() => {

          this.resending = false;

        });

    },

  },

};
</script>


<style scoped>

/*
|--------------------------------------------------------------------------
| Background
|--------------------------------------------------------------------------
*/

.background-image {

  position: relative;

  min-height: 100vh;

  background-image:
    url("@/assets/img/ingo.png");

  background-size: cover;

  background-position: center;

  background-repeat: no-repeat;

}


.background-image::before {

  content: "";

  position: absolute;

  inset: 0;

  background: rgba(0, 0, 0, 0.55);

}


.section {

  position: relative;

  z-index: 2;

}


/*
|--------------------------------------------------------------------------
| Card
|--------------------------------------------------------------------------
*/

.login-card {

  border: none;

  border-radius: 18px;

  box-shadow:
    0 20px 45px rgba(0, 0, 0, 0.25);

  backdrop-filter: blur(6px);

}


/*
|--------------------------------------------------------------------------
| Inputs
|--------------------------------------------------------------------------
*/

.form-control {

  border-radius: 10px;

  padding: 10px 14px;

  font-size: 0.95rem;

}


.form-control:focus {

  border-color: #198754;

  box-shadow:
    0 0 0 0.15rem
    rgba(25, 135, 84, 0.25);

}


/*
|--------------------------------------------------------------------------
| Password
|--------------------------------------------------------------------------
*/

.password-wrapper {

  position: relative;

  width: 100%;

}


.password-wrapper .form-control {

  padding-right: 45px;

}


.password-toggle {

  position: absolute;

  top: 50%;

  right: 12px;

  transform: translateY(-50%);

  border: none;

  background: transparent;

  padding: 0;

  width: 25px;

  height: 25px;

  display: flex;

  align-items: center;

  justify-content: center;

  color: #6c757d;

  cursor: pointer;

  z-index: 3;

}


.password-toggle:hover {

  color: #198754;

}


.password-toggle:focus {

  outline: none;

  box-shadow: none;

}


/*
|--------------------------------------------------------------------------
| Login Button
|--------------------------------------------------------------------------
*/

.btn-success {

  height: 44px;

  font-weight: 600;

  transition: all 0.2s ease;

}


.btn-success:hover {

  transform: translateY(-1px);

  box-shadow:
    0 8px 18px
    rgba(25, 135, 84, 0.35);

}


/*
|--------------------------------------------------------------------------
| Verification Box
|--------------------------------------------------------------------------
*/

.verification-box {

  background: rgba(25, 135, 84, 0.07);

  border: 1px solid
    rgba(25, 135, 84, 0.15);

  border-radius: 10px;

  padding: 12px 15px;

}


.verification-icon {

  color: #198754;

  font-size: 1.2rem;

}


.verification-box p {

  color: #555;

}


.verification-box .btn-link {

  color: #198754;

  font-weight: 600;

  text-decoration: none;

}


.verification-box .btn-link:hover {

  text-decoration: underline;

}


/*
|--------------------------------------------------------------------------
| Logo
|--------------------------------------------------------------------------
*/

.logo {

  text-decoration: none;

  color: white;

}


.logo:hover {

  color: white;

}


.logo img {

  height: 40px;

}


/*
|--------------------------------------------------------------------------
| Mobile
|--------------------------------------------------------------------------
*/

@media (max-width: 767px) {

  .login-card {

    border-radius: 14px;

  }

}

</style>