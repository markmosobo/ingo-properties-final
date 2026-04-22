<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Featured blogs -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="card-body pb-0">
                    <h5 class="card-title">Featured Blogs</h5>
                    <table id="BlogsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Content</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

                          <!-- LOADING -->
                          <tr v-if="loading">
                            <td colspan="5" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading featured blogs...</div>
                            </td>
                          </tr>

                          <!-- EMPTY STATE -->
                          <tr v-else-if="!featuredblogs.length">
                            <td colspan="5" class="text-center text-muted py-4">
                              No featured blogs available.
                            </td>
                          </tr>

                          <!-- DATA ROWS -->
                          <tr v-else v-for="blog in featuredblogs" :key="blog.id">

                            <td>
                              {{ blog.title ? blog.title.substring(0, 20) + '...' : '---' }}
                            </td>

                            <td>
                              {{ blog.category_id }}
                            </td>

                            <td>
                              {{ blog.content ? blog.content.substring(0, 20) + '...' : '---' }}
                            </td>

                            <td>
                              <span v-if="blog.status == 0" class="badge bg-warning text-dark">
                                Pending
                              </span>

                              <span v-else-if="blog.status == 1" class="badge bg-success">
                                Approved
                              </span>

                              <span v-else class="badge bg-dark">
                                Archived
                              </span>
                            </td>

                            <!-- ACTION -->
                            <td>
                              <div class="btn-group">

                                <button
                                  type="button"
                                  class="btn btn-sm btn-primary rounded-pill dropdown-toggle"
                                  data-bs-toggle="dropdown"
                                >
                                  Action
                                </button>

                                <div class="dropdown-menu">

                                  <a
                                    @click="navigateTo('/viewblog/' + blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-eye-line me-2 text-primary"></i>
                                    View
                                  </a>

                                  <a
                                    v-if="blog.featured == 1 && blog.status == 1"
                                    @click="unfeatureBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-star-fill me-2 text-warning"></i>
                                    Unfeature
                                  </a>

                                </div>

                              </div>
                            </td>

                          </tr>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <!--End Featured blogs -->
    
            </div>
        </section>
    </TheMaster>
    </template>
    
    <script>
     import TheMaster from "@/components/dashboard/TheMaster.vue";
     import axios from "axios";
    import Swal from 'sweetalert2';
    import "jquery/dist/jquery.min.js";
    import "datatables.net-dt/js/dataTables.dataTables";
    import "datatables.net-dt/css/jquery.dataTables.min.css";
    import $ from "jquery";
    
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    
    window.toast = toast;
    
    export default {
      data(){
        return {
          blogs: [],
          blogcategories: [],
          featuredblogs: [],
          users: [],
          loading: false,
        }
      },
      methods: {
        getPhoto()
        {
            return "/storage/blogs/";
        },
        navigateTo(location){
            this.$router.push(location)
        },
        approveBlog(id){
          axios.put('api/approveblog/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Blog has been approved',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        featureBlog(id){
          axios.put('api/featureblog/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Blog has been featured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        unfeatureBlog(id){
          axios.put('api/unfeatureblog/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Blog has been unfeatured',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        archiveBlog(id){
          axios.put('api/archiveblog/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Blog has been archived',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        unarchiveBlog(id){
          axios.put('api/unarchiveblog/'+ id).then(() => {
            toast.fire(
              'Successful',
              'Blog has been unarchived',
              'success'
            ); 
            this.loadLists();                    
          }).catch(() => {
              console.log('error')
          })
        },
        loadLists() {
          this.loading = true;

          axios.get('api/lists/featured-blogs')
            .then((response) => { 
              this.blogcategories = response.data.blogcategories;
              this.blogs = response.data.blogs;
              this.users = response.data.users;
              this.featuredblogs = response.data.featuredblogs;

              setTimeout(() => {
                  $("#BlogsTable").DataTable();
              }, 10);

            })
            .finally(() => {
              this.loading = false;
            });
        },        

      },
      components : {
          TheMaster,
      },
      mounted(){
        this.loadLists();

      }
    }
    </script>
    
    
    