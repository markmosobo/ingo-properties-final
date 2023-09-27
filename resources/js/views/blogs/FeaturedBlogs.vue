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
                          <tr v-for="blog in featuredblogs" :key="blog.id">
                            <td>{{blog.title.substring(0,20)+".."}}</td>
                            <td>{{blog.category_id}}</td>
                            <td>{{blog.content.substring(0,20)+".."}}</td>
                            <td>
                              <span v-if="blog.status == 0" class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle me-1"></i> Pending</span>   
                              <span v-else-if="blog.status == 1" class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Approved</span>
                              <span v-else class="badge bg-light text-dark"><i class="bi bi-star me-1"></i> Archived</span>

                            </td>
                            <td>
                              <div class="btn-group" role="group">
                                  <button id="btnGroupDrop1" type="button" class="btn btn-sm btn-primary rounded-pill dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Action
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" style="">
                                  <a @click="navigateTo('/viewblog/'+blog.id )" class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>                                            
                                  <!-- <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                  <a v-if="blog.status == 0" @click="approveBlog(blog.id)" class="dropdown-item" href="#"><i class="ri-check-fill mr-2"></i>Approve</a>
                                  <a v-if="blog.featured == 0 && blog.status == 1" @click="featureBlog(blog.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Feature</a> -->
                                  <a v-if="blog.featured == 1 && blog.status == 1" @click="unfeatureBlog(blog.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Unfeature</a>
                                  <!-- <a v-if="blog.status == 1" @click="archiveBlog(blog.id)" class="dropdown-item" href="#"><i class="ri-eye-close-fill mr-2"></i>Archive</a>
                                  <a v-if="blog.status == 2" @click="unarchiveBlog(blog.id)" class="dropdown-item" href="#"><i class="ri-refresh-fill mr-2"></i>Unarchive</a> -->
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
          users: []
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
             axios.get('api/lists').then((response) => {
             this.blogcategories = response.data.lists.blogcategories;
             this.blogs = response.data.lists.blogs;
             this.users = response.data.lists.users;
             this.featuredblogs = response.data.lists.featuredblogs;
             setTimeout(() => {
                  $("#BlogsTable").DataTable();
              }, 10);
    
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
    
    
    