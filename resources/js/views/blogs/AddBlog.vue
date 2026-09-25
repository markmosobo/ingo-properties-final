<template>
    <TheMaster>
        <div class="card px-2">
       <div class="card-body">
          <!-- General Form Elements -->
          <form @submit.prevent="">
<fieldset v-if="step === 1">
  <h5 class="card-title text-center mb-4">Post Blog</h5>

  <div class="row g-3 needs-validation" novalidate autocomplete="off">
    <!-- hidden user -->
    <input
      type="hidden"
      id="user_id"
      name="user_id"
      value="1"
    />

    <!-- Category -->
    <div class="col-md-6">
      <label class="form-label">Category</label>
      <select
        class="form-select"
        v-model="form.category_id"
        required
      >
        <option value="0">Select Category</option>
        <option
          v-for="category in blogcategories"
          :key="category.id"
          :value="category.id"
        >
          {{ category.name }}
        </option>
      </select>
      <div class="invalid-feedback">Please enter category!</div>
    </div>

    <!-- Title -->
    <div class="col-md-6">
      <label class="form-label">Title</label>
      <input
        type="text"
        class="form-control"
        placeholder="Title*"
        v-model="form.title"
        required
      />
      <div class="invalid-feedback">Please enter title!</div>
    </div>

    <!-- Content -->
    <div class="col-12">
      <label class="form-label">Content</label>
      <QuillEditor
        v-model:content="form.content"
        contentType="html"
        theme="snow"
        style="height: 300px"
      />
    </div>

    <!-- Image -->
    <div class="col-md-6">
      <label class="form-label">Add Photo</label>
      <input
        type="file"
        class="form-control"
        @change="onChangePhoto"
        required
      />
      <div class="invalid-feedback">Please enter photo!</div>
    </div>
  </div>

  <!-- Buttons -->
  <div class="row mt-4">
    <div class="col-6"></div>
    <div class="col-6 text-end">
      <button
        type="submit"
        class="btn btn-sm btn-primary rounded-pill"
        @click.prevent="submit"
      >
        Submit
      </button>
    </div>
  </div>
</fieldset>

 
          </form>
 
 
          <!-- End General Form Elements -->
       </div>
    </div>
    </TheMaster>
    
 
 
    <!--  actual form -->
 </template>
    
 <script>
 import TheMaster from "@/components/dashboard/TheMaster.vue";
 import { QuillEditor } from '@vueup/vue-quill'
 import '@vueup/vue-quill/dist/vue-quill.snow.css'
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
       QuillEditor
    },
    data () {
       return {
          form: {
          category_id: '',
          title: '',
          content: ''
          
          },
          message: "",
          successMessage: "",
          loading: false,
          step: 1, 
          blogcategories: [],
       }   
    },
    methods: {
       //ID upload
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
       loadLists() {
          axios.get('api/lists').then((response) => {
          this.blogcategories = response.data.lists.blogcategories;
 
          });
       },
       submit(){
          axios.post("api/blogs", this.form)
          .then(function (response) {
             console.log(response);
             // this.step = 1;
             toast.fire(
                'Success!',
                'Blog added!',
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
          this.$router.push('/all-blogs')
       }
 
    },
    mounted() {
       this.loadLists();
    }
 
 }
 </script>
    
 
 
 <style lang="css" scoped>
 /*Profile Pic Start*/
 .picture-container {
    position: relative;
    cursor: pointer;
    text-align: center;
 }
 
 .picture {
    width: 106px;
    height: 106px;
    background-color: #99999;
    border: 4px solid #CCCCCC;
    color: #FFFFFF;
    border-radius: 50%;
    margin: 0px auto;
    overflow: hidden;
    transition: all 0.2s;
    -webkit-transition: all 0.2s;
 }
 
 .picture:hover {
    border-color: #2ca8ff;
 }
 
 .content.ct-wizard-green .picture:hover {
    border-color: #05ae0e;
 }
 
 .content.ct-wizard-blue .picture:hover {
    border-color: #3472f7;
 }
 
 .content.ct-wizard-orange .picture:hover {
    border-color: #ff9500;
 }
 
 .content.ct-wizard-red .picture:hover {
    border-color: #ff3b30;
 }
 
 .picture input[type="file"] {
    cursor: pointer;
    display: block;
    height: 100%;
    left: 0;
    opacity: 0 !important;
    position: absolute;
    top: 0;
    width: 100%;
 }
 
 .picture-src {
    width: 100%;
 
 }</style>