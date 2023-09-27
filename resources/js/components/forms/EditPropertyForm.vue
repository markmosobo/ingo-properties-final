<template>
    <div class="card px-2">
        <div class="card-body">
    
        <form @submit.prevent="">
          <fieldset>
             <h5 class="card-title text-center">Edit ad</h5>
 
             <div class="row m-auto p-auto justify-content- g-3 needs-validation" novalidate="" autocomplete="off">
                <div class="row  mb-3"></div>
 
                <div class="row mb-3"></div>
                <div class="form-group row">
                   <input
                      type="hidden"
                      id="user_id"
                      name="user_id"
                      value="1"
                      class="form-control"
                   />
                   <div class="col-sm-6">
                      <label for="validationCustom04" class="form-label"
                      >Category</label
                      >
                      <div class="col-sm-10">
                         <select name="category" v-model="form.category_id" class="form-select">
                            <option value="0" selected disabled>Select Category</option>
                            <option v-for="category in categories" :value="category.id"
                            :selected="category.id == form.category_id" :key="category.id">{{ category.name}}</option>
 
                         </select>
 
                      <div class="invalid-feedback">Please enter category!</div>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Title</label>
                      <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="Title*"
                            id="title"
                            name="title"
                            v-model="form.title"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback">Please enter title!</div>
                      </div>
                   </div>
 
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="validationCustom04" class="form-label"
                      >Location</label
                      >
                      <div class="col-sm-10">
                         <select name="location" v-model="form.location_id" class="form-select" id="">
                            <option value="0" selected>Select Location</option>
                            <option v-for="location in locations" :value="location.id"
                            :selected="location.id == form.location_id" :key="location.id">{{ location.name}}</option>
 
                         </select>
 
                      <div class="invalid-feedback">Please enter location!</div>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <label for="validationCustom04" class="form-label"
                      >Property Status</label
                      >
                      <div class="col-sm-10">
                         <select name="category" v-model="form.property_status" class="form-select" id="">
                            <option value="0" disabled selected>Select Status</option>
                            <option value="sale" selected>For Sale</option>
                            <option value="rent" selected>For Rent</option>
 
                         </select>
 
                      <div class="invalid-feedback">Please enter status!</div>
                      </div>
                </div>
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Media</label>
                        <Uploader
                            v-if="hasResponse"
                            server='/api/posts/media/upload'
                            :media="form.media.saved"
                            location="/storage/properties"
                            @init="initMedia"
                            @change="changeMedia"
                            @add="addMedia"
                            @remove="removeMedia"
                        />
                   </div>
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Location</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Specify location*" v-model="form.location" id="location" name="location" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter location!</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Price</label>
                        <div class="input-group has-validation col-sm-10">
                            <span class="input-group-text" id="inputGroupPrepend"
                            >Kes</span
                            >
                            <input
                            type="text"
                            name="username"
                            class="form-control"
                            v-model="form.price"
                            id="yourUsername"
                            required
                            />
                        <div class="invalid-feedback">Please enter  price!</div>
                    </div>
                    </div> 
             
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div v-if="form.category_id == '5' || form.category_id == '6'" class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Land Area</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Square Metres(ac)" id="size" v-model="form.land_area" name="size" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter area</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="inputPassword" class="form-label">Link to Social Media</label>
                    <div class="col-sm-10">
                        <input
                            type="text"
                            placeholder="Link to Social"
                            id="social_link"
                            name="social_link"
                            v-model="form.social_link"
                            class="form-control"
                            required=""
                        />
                        <div class="invalid-feedback">Please enter social link!</div>
                    </div>
                    </div>
                </div>
                <div class="row mb-3"></div>
                <div v-if="form.category_id == '5' || form.category_id == '6'" class="form-group row">
                    <div class="col-sm-6">
                        <label for="validationCustom04" class="form-label">Type</label>
                        <div class="col-sm-10">
                        <select name="type" v-model="form.land_type" class="form-select" id="">
                            <option value="0" selected>Select Type</option>
                            <option>Commercial Land</option>
                            <option>Farmland</option>
                            <option>Industrial Land</option>
                            <option>Mixed-Use Land</option>
                            <option>Quarry</option>
                            <option>Residential Land</option>

                        </select>
                        <div class="invalid-feedback">Please enter property type!</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Property Use</label>
                    <div class="col-sm-10">
                        <select name="type" v-model="form.property_use" class="form-select" id="">
                            <option value="0" selected>Property Use</option>
                            <option>Commercial</option>
                            <option>Mixed</option>
                            <option>Residential</option>
    
                        </select>
                        <div class="invalid-feedback">Please enter property type!</div>
                    </div>
                    </div>
                </div>
                <div class="row mb-3"></div>
                <div v-if="form.category_id !== '5' || form.category_id !== '6'" class="form-group row">
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Address</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Address*" id="address" v-model="form.address" name="address" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter address</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Estate Name</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Estate Name" v-model="form.estate_name" id="estate_name" name="estate_name" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter estate name!</div>
                    </div>
                    </div>
                </div>    
                <div class="row mb-3"></div>
                <div v-if="form.category_id !== '5' || form.category_id !== '6'" class="form-group row">
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Property Type</label>
                    <div class="col-sm-10">
                        <select name="type" v-model="form.property_type_id" class="form-select" id="">
                            <option value="0" selected>Select Type</option>
                            <option v-for="type in propertytypes" :value="type.id"
                            :selected="type.id == form.property_type_id" :key="type.id">{{ type.name}}</option>
    
                        </select>
                        <div class="invalid-feedback">Please enter property type!</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Size</label>
                    <div class="col-sm-10">
                        <input type="text" placeholder="Square Metres(sqm)" id="size" v-model="form.size" name="size" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter size</div>
                    </div>
                    </div>
                </div>
                <div class="row mb-3"></div>
                <div v-if="form.category_id !== '5' || form.category_id !== '6'" class="form-group row">
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Bedrooms</label>
                    <div class="col-sm-10">
                        <select class="form-select" v-model="form.bedrooms" aria-label="Default select example">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10+">10+</option>
                        </select>
                        <div class="invalid-feedback">Please enter shipper bedrooms!</div>
                    </div>
                    </div>
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Bathrooms</label>
                    <div class="col-sm-10">
                        <select class="form-select" v-model="form.bathrooms" aria-label="Default select example">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10+">10+</option>
                        </select>
                        <div class="invalid-feedback">Please enter bathrooms!</div>
                    </div>
                    </div>
                </div>
                <div class="row mb-3"></div>
                <div v-if="form.category_id !== '5' || form.category_id !== '6'" class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Facilities</label>
                   <div class="col-sm-10">
                     <div class="dropdown col-sm-10">
                           <button class="btn dropdown-toggle"
                                 type="button" 
                                 id="multiSelectDropdown"
                                 data-bs-toggle="dropdown" 
                                 aria-expanded="false">
                              Select
                           </button>
                           <ul class="dropdown-menu" 
                              aria-labelledby="multiSelectDropdown">
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.electricity" 
                                          value="1">
                                       24 Hour Electricity
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.air_conditioning" 
                                          value="1">
                                        Air Conditioning
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.alarm" 
                                          value="1">
                                        Alarm
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.balcony"
                                          value="1">
                                        Balcony
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.chandelier" 
                                          value="1">
                                        Chandelier
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.car_parking"
                                          value="1">
                                        Car Parking
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.dining_area"
                                          value="1">
                                        Dining Area
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.dishwasher" 
                                          value="1">
                                        Dishwasher 
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.gym" 
                                          value="1">
                                        Gym
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.hot_water" 
                                          value="1">
                                        Hot Water
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.kitchen_cabinets" 
                                          value="1">
                                        Kitchen Cabinets
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.kitchen_shelf" 
                                          value="1">
                                        Kitchen Shelf
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.microwave" 
                                          value="1">
                                        Microwave
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.pets_allow" 
                                          value="1">
                                        Pets Allow
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.pop_ceiling" 
                                          value="1">
                                        Pop Ceiling
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.prepaid_meter"
                                          value="1">
                                        Pre-Paid Meter
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.refrigerator"
                                          value="1">
                                        Refrigerator
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.swimming_pool"
                                          value="1">
                                        Swimming Pool
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.tv" 
                                          value="1">
                                        TV
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.wardrobe" 
                                          value="1">
                                        Wardrobe
                                 </label>
                              </li>
                              <li>
                                 <label>
                                 <input type="checkbox" v-model="form.wifi"
                                          value="1">
                                        Wifi
                                 </label>
                              </li>
                           </ul>
                     </div>
                      <div class="invalid-feedback">Please enter facilities!</div>
                   </div>
                </div> 
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <label for="validationCustom04" class="form-label">Description</label>
                        <div class="col-sm-11">
                            <textarea rows="3" placeholder="Description*" v-model="form.description" id="description" name="description" class="form-control"
                                required=""></textarea>
                            <div class="invalid-feedback">Please enter description!</div>
                        </div>
                    </div> 
                </div>
                <!-- <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-6">
                    <label for="validationCustom04" class="form-label">Phone Number</label>
                    <div class="col-sm-10">
                        <input type="number" placeholder="Phone Number" v-model="form.phone_number" id="phone_number" name="phone_number" class="form-control"
                            required="" />
                        <div class="invalid-feedback">Please enter phone number!</div>
                    </div>
                    </div> 
                    <div class="col-sm-6">
                    <input type="checkbox" v-model="form.negotiable" class="form-check-input">
                    <label for="validationCustom04" class="form-label">Negotiable</label>
                    </div> 
                </div> -->
             </div>
             <!--  button -->
             <div class="col-lg-12 felx mt-4 row">
                <div class="col-sm-6 col-lg-6">
                    <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                </div>
                <div class="col-sm-6 col-lg-6 text-end">
                    <button type="submit" @click.prevent="submit()" class="btn btn-sm btn-primary rounded-pill">Update</button>
                </div>
            </div>
          </fieldset>
 
          </form>
        </div>
    </div>
    </template>
    
    <script>
    import axios from "axios";
    import Swal from 'sweetalert2';
    import Uploader from 'vue-media-upload'
    
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    
    window.toast = toast;
    
    export default {
        props:{
            id: {
                type: String,
                required: true
            },
            indexRoute:{
                type: String,
                required: true
            },
            storedMedia:{
                type: Array,
                default: [],
            }
        },
       data () {
          return {
             categories: [],
             locations: [],
             form: {
                category_id: '',
                location_id: '',
                social_link: '',
                title: '',
                id_image: '',
                location: '',
                address: '',
                property_type_id: '',
                size: '',
                estate_name: '',
                bedrooms: '',
                bathrooms: '',
                parking_space: '',
                price: '',
                phone_number: this.user,
                negotiable: '',
                created_by: '',
                property_status: '',
                description: '',
                land_area: '',
                land_type: '',
                property_use: '',
                electricity: '',
                air_conditioning: '',
                alarm: '',
                balcony: '',
                chandelier: '',
                car_parking: '',
                dining_area: '',
                dishwasher: '',
                gym: '',
                hot_water: '',
                kitchen_cabinets: '',
                kitchen_shelf: '',
                microwave: '',
                pets_allow: '',
                pop_ceiling: '',
                prepaid_meter: '',
                refrigerator: '',
                swimming_pool: '',
                tv: '',
                wardrobe: '',
                wifi: '',
                media: {
                    list: [], //all media (savedMedia + addedAdded)
                    saved: [],
                    added: [],
                    removed: []
                },
             
             },
             message: "",
             successMessage: "",
             hasResponse: true,
             loading: false,
          }   
       },
       methods: {
        getData(){
        axios.get('/api/property/'+this.$route.params.id, {
        }).then((response) => {
            this.form = response.data.property[0];
            this.form.media = {list: [], saved: [], added:[], removed:[]}
            this.form.media.saved = this.form.images;
            // console.log(response)
            console.log("data", this.form.images)
        })
        },
        initMedia(media){
            this.form.media.list = media
        },
        changeMedia(media){
            this.form.media.list = media
        },
        addMedia(addedImage, addedMedia){
            this.form.media.added = addedMedia
        },
        removeMedia(removedImage, removedMedia){
            this.form.media.removed = removedMedia
        },
        loadLists() {
             axios.get('/api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.propertytypes = response.data.lists.propertytypes;
             this.locations = response.data.lists.locations;

    
             });
          },
        submit(){
            axios.put('/api/property/'+this.$route.params.id, this.form)
            .then((response) => {

                    toast.fire({
                    title: 'Property Updated',
                    text: "property updated ",
                    icon: 'success',
                })
                this.getData();
            })
            this.$router.push('/all-properties');
        },
    },
    mounted(){
        this.user = JSON.parse(localStorage.getItem('user'));
        this.getData();
        this.loadLists();
    },
    components:{
        Uploader
    },

    
    }

    </script>