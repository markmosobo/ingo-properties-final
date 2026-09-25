<template>
    <TheMaster>
        <section class="section dashboard">
          <div class="row">
    
                <!-- Top Selling -->
                <div class="col-12">
                  <div class="card top-selling overflow-auto">
    
                    <div class="filter">
                      <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                          <h6>Filter</h6>
                        </li>
    
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                      </ul>
                    </div>
    
                    <div class="card-body pb-0">
                      <h5 class="card-title">All Blogs <span>| Today</span></h5>
                      <p class="card-text">
                   
                      <router-link to="/add-blog" custom v-slot="{ href, navigate, isActive }">
                          <a
                            :href="href"
                            :class="{ active: isActive }"
                            class="btn btn-sm btn-primary rounded-pill"
                            @click="navigate"
                          >
                            Add Blog
                          </a>
                      </router-link>
            
                      </p>
    
                      <table id="AllBlogsTable" class="table table-borderless">
                        <thead>
                          <tr>
                            <th scope="col">Preview</th>
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
                            <td colspan="6" class="text-center py-5">
                              <div class="spinner-border text-success" role="status"></div>
                              <div class="mt-2 text-muted">Loading blogs...</div>
                            </td>
                          </tr>

                          <!-- EMPTY STATE -->
                          <tr v-else-if="!blogs.length">
                            <td colspan="6" class="text-center text-muted py-4">
                              No blogs found.
                            </td>
                          </tr>

                          <!-- DATA ROWS -->
                          <tr v-else v-for="blog in blogs" :key="blog.id">

                            <!-- IMAGE -->
                            <th scope="row">
                              <img
                                v-if="blog.image_path"
                                :src="getPhoto() + blog.image_path"
                                style="width:60px;height:45px;object-fit:cover;border-radius:6px;"
                              />
                              <span v-else class="text-muted small">No image</span>
                            </th>

                            <td>
                              {{ blog.title ? blog.title.substring(0, 10) + '...' : '---' }}
                            </td>

                            <td>
                              {{ blog.category?.name ?? 'Uncategorized' }}
                            </td>

                            <td>
                              {{ blog.content ? blog.content.substring(0, 10) + '...' : '---' }}
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
                                    v-if="blog.created_by == user.id"
                                    @click="navigateTo('/edit-blog/' + blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-pencil-line me-2 text-primary"></i>
                                    Edit
                                  </a>

                                  <a
                                    v-if="blog.status == 0"
                                    @click="approveBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-check-line me-2 text-success"></i>
                                    Approve
                                  </a>

                                  <a
                                    v-if="blog.featured == 0 && blog.status == 1"
                                    @click="featureBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-star-line me-2 text-warning"></i>
                                    Feature
                                  </a>

                                  <a
                                    v-if="blog.featured == 1 && blog.status == 1"
                                    @click="unfeatureBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-star-fill me-2 text-warning"></i>
                                    Unfeature
                                  </a>

                                  <a
                                    v-if="blog.status == 1"
                                    @click="archiveBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-archive-line me-2 text-secondary"></i>
                                    Archive
                                  </a>

                                  <a
                                    v-if="blog.status == 2"
                                    @click="unarchiveBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-refresh-line me-2 text-info"></i>
                                    Unarchive
                                  </a>

                                  <a
                                    v-if="user.role_id == 1"
                                    @click="deleteBlog(blog.id)"
                                    class="dropdown-item d-flex align-items-center"
                                  >
                                    <i class="ri-delete-bin-line me-2 text-danger"></i>
                                    Delete
                                  </a>

                                </div>

                              </div>
                            </td>

                          </tr>

                        </tbody>
                      </table>
    
                    </div>
    
                  </div>
                </div><!-- End Top Selling -->
    
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
          users: [],
          user: [],
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
        deleteBlog(id){
          Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) { 
                  //send request to the server
                  axios.delete('/api/blog/'+id).then(() => {
                  toast.fire(
                    'Deleted!',
                    'Blog has been deleted.',
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
        loadLists() {
          this.loading = true;

          axios.get('api/lists/blogs')
            .then((response) => {
              this.blogcategories = response.data.blogcategories;
              this.blogs = response.data.blogs;
              this.users = response.data.users;

              setTimeout(() => {
                  $("#AllBlogsTable").DataTable();
              }, 10);

            })
            .finally(() => {
              this.loading = false;
            });
        }        

      },
      components : {
          TheMaster,
      },
      mounted(){
        this.loadLists();
        this.user = JSON.parse(localStorage.getItem('user'));

      }
    }
    </script>
    
    
    