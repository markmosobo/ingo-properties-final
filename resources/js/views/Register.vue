<template>
  <main class="background-image">
    <section
      class="section min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
    >
      <div class="container">
        <div class="row justify-content-center">
          <div
            class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center"
          >

            <!-- Brand -->
            <div class="brand-header text-center">
              <router-link to="/" class="brand-link">
                <img
                  src="/images/ingo-colored-logo.png"
                  alt="IPMC Logo"
                  class="brand-logo"
                />

                <span class="brand-name">IPMC</span>
              </router-link>
            </div>


            <!-- Register Card -->
            <div class="card register-card mb-3 w-100">
              <div class="card-body">

                <!-- Heading -->
                <div class="mb-4 text-center">
                  <h4 class="fw-bold mb-1">
                    Create an Account
                  </h4>

                  <p class="text-muted small mb-0">
                    Enter your personal details to create your account
                  </p>
                </div>


                <!-- Registration Form -->
                <form
                  @submit.prevent="create_user"
                  class="row g-3"
                >

                  <!-- First Name -->
                  <div class="col-md-6">
                    <label class="form-label">
                      First Name
                    </label>

                    <input
                      type="text"
                      class="form-control"
                      placeholder="First name"
                      v-model.trim="form.first_name"
                      required
                    />
                  </div>


                  <!-- Last Name -->
                  <div class="col-md-6">
                    <label class="form-label">
                      Last Name
                    </label>

                    <input
                      type="text"
                      class="form-control"
                      placeholder="Last name"
                      v-model.trim="form.last_name"
                      required
                    />
                  </div>


                  <!-- Email -->
                  <div class="col-md-6">
                    <label class="form-label">
                      Email
                    </label>

                    <input
                      type="email"
                      class="form-control"
                      placeholder="you@example.com"
                      v-model.trim="form.email"
                      required
                    />
                  </div>


                  <!-- Phone -->
                  <div class="col-md-6">
                    <label class="form-label">
                      Phone Number
                    </label>

                    <input
                      type="tel"
                      class="form-control"
                      placeholder="07XXXXXXXX"
                      v-model.trim="form.phone"
                      required
                    />
                  </div>


                  <!-- Password -->
                  <div class="col-md-6">
                    <label class="form-label">
                      Password
                    </label>

                    <div class="password-wrapper">

                      <input
                        :type="isPasswordVisible ? 'text' : 'password'"
                        class="form-control"
                        placeholder="Enter password"
                        v-model="form.password"
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


                  <!-- Confirm Password -->
                  <div class="col-md-6">
                    <label class="form-label">
                      Confirm Password
                    </label>

                    <div class="password-wrapper">

                      <input
                        :type="
                          isConfirmPasswordVisible
                            ? 'text'
                            : 'password'
                        "
                        class="form-control"
                        placeholder="Confirm password"
                        v-model="form.password_confirmation"
                        minlength="8"
                        required
                      />

                      <button
                        type="button"
                        class="password-toggle"
                        @click="toggleConfirmPasswordVisibility"
                        tabindex="-1"
                        aria-label="Toggle confirm password visibility"
                      >
                        <i
                          :class="
                            isConfirmPasswordVisible
                              ? 'fa fa-eye'
                              : 'fa fa-eye-slash'
                          "
                        ></i>
                      </button>

                    </div>
                  </div>


                  <!-- Terms -->
                  <div class="col-12 mt-2">
                    <div class="form-check">

                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="acceptTerms"
                        v-model="form.terms"
                        required
                      />

                      <label
                        class="form-check-label small"
                        for="acceptTerms"
                      >
                        I agree and accept the
                        <a href="#">
                          terms and conditions
                        </a>
                      </label>

                    </div>
                  </div>


                  <!-- Register Button -->
                  <div class="col-12 mt-3">

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
                            ? "Creating Account…"
                            : "Create Account"
                        }}
                      </span>

                    </button>

                  </div>


                  <!-- Login -->
                  <div class="col-12 text-center">

                    <p class="small mb-0">
                      Already have an account?

                      <router-link to="/login">
                        Log in
                      </router-link>
                    </p>

                  </div>

                </form>

              </div>
            </div>


            <!-- Footer -->
            <p class="text-center text-white small mt-2">
              © {{ new Date().getFullYear() }} IPMC • Secure Access
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

      isPasswordVisible: false,

      isConfirmPasswordVisible: false,

      form: {
        first_name: "",
        last_name: "",
        email: "",
        phone: "",
        password: "",
        password_confirmation: "",
        terms: false,
      },

    };
  },


  methods: {

    togglePasswordVisibility() {
      this.isPasswordVisible =
        !this.isPasswordVisible;
    },


    toggleConfirmPasswordVisibility() {
      this.isConfirmPasswordVisible =
        !this.isConfirmPasswordVisible;
    },


    create_user() {

      // Check required fields
      if (
        !this.form.first_name ||
        !this.form.last_name ||
        !this.form.email ||
        !this.form.phone ||
        !this.form.password ||
        !this.form.password_confirmation
      ) {

        Swal.fire(
          "Incomplete Form",
          "Please fill in all required fields.",
          "warning"
        );

        return;
      }


      // Check terms
      if (!this.form.terms) {

        Swal.fire(
          "Terms Required",
          "Please agree to the terms and conditions.",
          "warning"
        );

        return;
      }


      // Password length
      if (this.form.password.length < 8) {

        Swal.fire(
          "Password Too Short",
          "Password must be at least 8 characters long.",
          "warning"
        );

        return;
      }


      // Password match
      if (
        this.form.password !==
        this.form.password_confirmation
      ) {

        Swal.fire(
          "Password Mismatch",
          "Passwords do not match.",
          "warning"
        );

        return;
      }


      this.loading = true;


      axios
        .post("/api/register", this.form)

        .then((response) => {

          console.log(response);


          if (response.data.status === "error") {

            let message =
              response.data.data ||
              "Unable to create account.";


            if (response.data.errors) {

              const errors =
                response.data.errors;

              const firstField =
                Object.keys(errors)[0];

              message =
                errors[firstField][0];
            }


            Swal.fire(
              "Oops!",
              message,
              "warning"
            );

            return;
          }


          // Registration successful
          Swal.fire({
            title: "Account Created!",
            text:
              "Your account has been created. " +
              "Please check your email and click the " +
              "verification link before logging in.",
            icon: "success",
            confirmButtonText: "Continue",
          }).then(() => {

            this.$router.push("/login");

          });


          // Reset form
          this.form = {
            first_name: "",
            last_name: "",
            email: "",
            phone: "",
            password: "",
            password_confirmation: "",
            terms: false,
          };

        })


        .catch((error) => {

          console.log(error);


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

          } else {

            Swal.fire(
              "Error",
              "Unable to create account. Please try again.",
              "error"
            );

          }

        })


        .finally(() => {

          this.loading = false;

        });

    },

  },

};
</script>


<style scoped>

/* ========================================
   BACKGROUND
======================================== */

.background-image {
  position: relative;

  min-height: 100vh;

  background-image: url("@/assets/img/ingo.png");

  background-size: cover;

  background-position: center;

  background-repeat: no-repeat;
}


/* Dark overlay */

.background-image::before {
  content: "";

  position: absolute;

  inset: 0;

  background: rgba(0, 0, 0, 0.55);
}


/* Content above overlay */

.section {
  position: relative;

  z-index: 2;
}


/* ========================================
   BRAND
======================================== */

.brand-header {
  margin-bottom: 14px;
}


.brand-link {
  display: inline-flex;

  align-items: center;

  gap: 10px;

  text-decoration: none;

  color: #fff;

  transition: all 0.2s ease;
}


.brand-link:hover {
  color: #fff;

  opacity: 0.9;
}


.brand-logo {
  height: 48px;

  width: auto;

  object-fit: contain;
}


.brand-name {
  font-size: 1.45rem;

  font-weight: 700;

  letter-spacing: 0.5px;
}


/* ========================================
   REGISTER CARD
======================================== */

.register-card {
  border: none;

  border-radius: 18px;

  box-shadow:
    0 20px 45px rgba(0, 0, 0, 0.25);

  backdrop-filter: blur(6px);
}


/* ========================================
   FORM
======================================== */

.form-label {
  font-weight: 500;

  margin-bottom: 6px;
}


.form-control {
  border-radius: 10px;

  padding: 10px 14px;

  font-size: 0.95rem;
}


.form-control:focus {
  border-color: #198754;

  box-shadow:
    0 0 0 0.15rem rgba(25, 135, 84, 0.25);
}


/* ========================================
   PASSWORD INPUT
======================================== */

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


/* ========================================
   TERMS
======================================== */

.form-check-input {
  cursor: pointer;
}


.form-check-label {
  cursor: pointer;
}


.form-check-label a {
  color: #198754;

  text-decoration: none;
}


.form-check-label a:hover {
  text-decoration: underline;
}


/* ========================================
   BUTTON
======================================== */

.btn-success {
  height: 44px;

  font-weight: 600;

  transition: all 0.2s ease;
}


.btn-success:hover {
  transform: translateY(-1px);

  box-shadow:
    0 8px 18px rgba(25, 135, 84, 0.35);
}


.btn-success:disabled {
  cursor: not-allowed;

  transform: none;
}


/* ========================================
   MOBILE
======================================== */

@media (max-width: 767px) {

  .register-card {
    border-radius: 14px;
  }


  .brand-logo {
    height: 44px;
  }


  .brand-name {
    font-size: 1.3rem;
  }

}

</style>