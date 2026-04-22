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
              <router-link to="/" class="logo d-flex align-items-center w-auto">
                <img src="/images/ingo-colored-logo.png" alt="IPMC Logo" />
                <span class="d-none d-lg-block ms-2">IPMC</span>
              </router-link>
            </div>

            <!-- Login Card -->
            <div class="card login-card mb-3">
              <div class="card-body">
                <div class="mb-4 text-center">
                  <h4 class="fw-bold mb-1">Welcome Back</h4>
                  <p class="text-muted small">
                    Sign in to continue to IPMC
                  </p>
                </div>

                <form @submit.prevent="login_user" class="row g-3">
                  <div class="col-12">
                    <label class="form-label">Email</label>
                    <input
                      type="email"
                      class="form-control"
                      placeholder="you@example.com"
                      v-model="form.email"
                      required
                    />
                  </div>

                  <div class="col-12">
                    <label class="form-label">Password</label>
                    <input
                      type="password"
                      class="form-control"
                      placeholder="••••••••"
                      v-model="form.password"
                      required
                    />
                  </div>

                  <div class="col-12 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="rememberMe"
                      />
                      <label class="form-check-label small" for="rememberMe">
                        Remember me
                      </label>
                    </div>
                  </div>

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
                      <span>{{ loading ? 'Signing in…' : 'Login' }}</span>
                    </button>
                  </div>

                  <div class="col-12 text-center">
                    <p class="small mb-0">
                      Don’t have an account?
                      <router-link to="/register">Create one</router-link>
                    </p>
                  </div>
                </form>
              </div>
            </div>

            <!-- Footer -->
            <p class="text-center text-muted small mt-3">
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
      form: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    login_user() {
      this.loading = true;

      axios
        .post("/api/login", this.form)
        .then((response) => {
          if (response.data.status === "error") {
            Swal.fire("Oops!", response.data.data, "warning");
          } else {
            localStorage.setItem(
              "user",
              JSON.stringify(response.data.user)
            );
            this.$router.push("/dashboard");
          }
        })
        .catch(() => {
          Swal.fire(
            "Error",
            "Unable to login. Please try again.",
            "error"
          );
        })
        .finally(() => {
          this.loading = false;
        });
    },
  },
};
</script>

<style scoped>
/* Background + overlay */
.background-image {
  position: relative;
  min-height: 100vh;
  background-image: url("@/assets/img/ingo.png");
  background-size: cover;
  background-position: center;
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

/* Card */
.login-card {
  border: none;
  border-radius: 18px;
  box-shadow: 0 20px 45px rgba(0, 0, 0, 0.25);
  backdrop-filter: blur(6px);
}

/* Inputs */
.form-control {
  border-radius: 10px;
  padding: 10px 14px;
  font-size: 0.95rem;
}

.form-control:focus {
  border-color: #198754;
  box-shadow: 0 0 0 0.15rem rgba(25, 135, 84, 0.25);
}

/* Button */
.btn-success {
  height: 44px;
  font-weight: 600;
  transition: all 0.2s ease;
}

.btn-success:hover {
  transform: translateY(-1px);
  box-shadow: 0 8px 18px rgba(25, 135, 84, 0.35);
}

/* Logo */
.logo img {
  height: 40px;
}
</style>