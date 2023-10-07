<template>
 
    <div class="card px-2">
       <div class="card-body">
          <!-- General Form Elements -->
          <form @submit.prevent="">
          <fieldset v-if="step == 1">
             <h5 class="card-title text-center">Post ad</h5>
 
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
                         <select name="category" v-model="form.category_id" class="form-select" id="">
                            <option value="0" selected disabled>Select Category</option>
                            <option v-for="category in categories" :value="category.id"
                            :selected="category.id == form.category_id" :key="category.id">{{ category.name}}</option>
 
                         </select>
 
                      <div class="invalid-feedback">Please enter category!</div>
                      </div>
                   </div>
                   <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Location</label>
                      <div class="col-sm-10">
                         <select name="location" v-model="form.location_id" class="form-select" id="">
                            <option value="0" selected disabled>Select Location</option>
                            <option v-for="location in locations" :value="location.id"
                            :selected="location.id == form.location_id" :key="location.id">{{ location.name}}</option>
 
                         </select>
                         <div class="invalid-feedback">Please enter location!</div>
                      </div>
                   </div>
 
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
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
                   <div v-if="form.category_id == '1' || form.category_id == '3' || form.category_id == '5'" class="col-sm-6">
                      <label for="validationCustom04" class="form-label">Property Status</label>
                      <div class="col-sm-10">
                        <select name="property_status" class="form-select" v-model="form.property_status" id="property_status">
                        <option value="rent">For Rent</option>
                        </select>
                      </div>
 
                   </div>
                   <div v-else-if="form.category_id == '2' || form.category_id == '4' || form.category_id == '6'" class="col-sm-6">
                      <label for="validationCustom04" class="form-label">Property Status</label>
                      <div class="col-sm-10">
                        <select name="property_status" class="form-select" v-model="form.property_status" id="property_status">
                        <option value="sale">For Sale</option>
                        </select>
                      </div>
 
                   </div> 
                   <div v-else class="col-sm-6">
                      <label for="validationCustom04" class="form-label">Property Status</label>
                      <div class="col-sm-10">
                        <select name="property_status" class="form-select" v-model="form.property_status" id="property_status">
                        <option value="rent">For Rent</option>
                        <option value="sale">For Sale</option>
                        </select>
                      </div>
 
                   </div>                   
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                    <div class="col-sm-6">
                      <label for="inputPassword" class="form-label">Media</label>
                      <div class="col-sm-10">
                      <Uploader 
                        server="/api/posts/media/upload"
                        @change="changeMedia"
                       />
                       </div>
                   </div>
                </div>
               
             </div>
             <!--  button -->
             <div class="col-lg-12 felx mt-4 row">
                <div class="col-sm-6 col-lg-6">
                    <!-- <button @click.prevent="prev()" class="btn btn-dark">Previous</button> -->
                </div>
                <div class="col-sm-6 col-lg-6 text-end">
                    <button type="submit" @click.prevent="next()" class="btn btn-success rounded-pill">Next</button>
                </div>
            </div>
          </fieldset>
 
          <fieldset v-if="step == 2">
             <h5 class="card-title text-center">Property's Detailed Information</h5>
             
             <!--land-->
             <div v-if="form.category_id == '5' || form.category_id == '6'" class="row flex flex-row justify-content-around g-3 needs-validation" novalidate="" autocomplete="off">
                <div class="row mb-3"></div>
                <div v-if="message" class="alert alert-danger">{{ message }}</div>
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Title</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Title*" id="title" v-model="form.title" name="title" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter title</div>
                   </div>
                </div>
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Location</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Location*" v-model="form.location" id="location" name="location" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter location!</div>
                   </div>
                </div>
                </div>
                <div class="row mb-3"></div>
 
                <div class="form-group row">
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
 
                <div class="form-group row">
                   <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Land Area</label>
                   <div class="col-sm-10">
                      <input type="number" placeholder="Acres(ac)" id="size" v-model="form.land_area" name="size" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter area</div>
                   </div>
                </div>
                <!-- <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Estate Name</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Estate Name" v-model="form.estate_name" id="estate_name" name="estate_name" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter estate name!</div>
                   </div>
                </div> -->
                </div>
 
                <div class="col-lg-12 felx mt-4 row">
                   <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="prev()" class="btn btn-dark">Previous</button>
                   </div>
                   <div class="col-sm-6 col-lg-6 text-end">
                      <button type="submit" @click.prevent="next()" class="btn btn-primary">Next</button>
                   </div>
                </div>
             </div>
             <!--property-->
             <div v-else class="row flex flex-row justify-content-around g-3 needs-validation" novalidate="" autocomplete="off">
                <div class="row mb-3"></div>
                <div v-if="message" class="alert alert-danger">{{ message }}</div>
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Title</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Title*" id="title" v-model="form.title" name="title" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter title</div>
                   </div>
                </div>
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Location</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Location*" v-model="form.location" id="location" name="location" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter location!</div>
                   </div>
                </div>
                </div>
                <div class="row mb-3"></div>
 
                <div class="form-group row">
                   <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Address</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Address*" id="address" v-model="form.address" name="address" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter address</div>
                   </div>
                </div>
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
                </div>
                <div class="row mb-3"></div>
 
                <div class="form-group row">
                   <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Size</label>
                   <div class="col-sm-10">
                      <input type="number" placeholder="Square Feet(sq ft)" id="size" v-model="form.size" name="size" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter size</div>
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
 
                <div class="col-lg-12 felx mt-4 row">
                   <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="prev()" class="btn btn-dark rounded-pill">Previous</button>
                   </div>
                   <div class="col-sm-6 col-lg-6 text-end">
                      <button type="submit" @click.prevent="next()" class="btn btn-success rounded-pill">Next</button>
                   </div>
                </div>
             </div>
          </fieldset>
 
 
          <fieldset v-if="step == 3">
          
             <h5 class="card-title text-center">Additional Details</h5>
             <div v-if="form.category_id == '5' || form.category_id == '6'" class="row flex flex-row justify-content-around g-3 needs-validation" novalidate="" autocomplete="off">
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
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
                <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Price</label>
                      <div class="input-group has-validation col-sm-10">
                         <span class="input-group-text" id="inputGroupPrepend"
                           >Kes</span
                         >
                         <input
                           type="number"
                           name="username"
                           class="form-control"
                           v-model="form.price"
                           id="yourUsername"
                           required
                         />
                      <div class="invalid-feedback">Please enter  price!</div>
                   </div>
                </div> 
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Phone Number</label>
                   <div class="col-sm-10">
                      <input type="number" placeholder="Phone Number" v-model="form.phone_number" id="phone_number" name="phone_number" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter phone number!</div>
                   </div>
                </div> 
               </div>
               <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <input type="checkbox" v-model="form.negotiable" class="form-check-input">
                   <label for="validationCustom04" class="form-label">Negotiable</label>
                </div> 
                <!-- <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Name</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Name" v-model="form.name" id="name" name="name" class="form-control"
                         required="" />
                   </div>
                </div>  -->
                </div>

                <div class="col-lg-12 felx mt-4 row">
                   <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="prev()" class="btn btn-dark rounded-pill">Previous</button>
                   </div>
                   <div class="col-sm-6 col-lg-6 text-end">
                      <button type="submit" @click.prevent="submit()" class="btn btn-success rounded-pill">Submit</button>
                   </div>
                </div>
             </div>
             <!--rent property-->
             <div v-else-if="form.category_id == '1' || form.category_id == '2'" class="row flex flex-row justify-content-around g-3 needs-validation" novalidate="" autocomplete="off">
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <div class="row mb-3"></div>
                <div class="form-group row">
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
                <div class="col-sm-6">
                   <label for="inputPassword" class="form-label">Parking Space</label>
                   <div class="col-sm-10">
                            <div class="form-check">
                               <input class="form-check-input hideable" type="radio" v-model="form.parking_space" name="yes" id="yes" value="1">
                               <label class="form-check-label" for="gridRadios1">
                                  Yes
                               </label>
                            </div>
                            <div class="form-check">
                               <input class="form-check-input hideable" type="radio" v-model="form.parking_space" name="no" id="no" value="2">
                               <label class="form-check-label" for="gridRadios2">
                                  No
                               </label>
                            </div>
                      <div class="invalid-feedback">Please check one!</div>
                   </div>
                </div>
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Price</label>
                      <div class="input-group has-validation col-sm-10">
                         <span class="input-group-text" id="inputGroupPrepend"
                           >Kes</span
                         >
                         <input
                           type="number"
                           name="username"
                           class="form-control"
                           v-model="form.price"
                           id="yourUsername"
                           required
                         />
                      <div class="invalid-feedback">Please enter  price!</div>
                   </div>
                </div> 
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Phone Number</label>
                   <div class="col-sm-10">
                      <input type="number" placeholder="Phone Number" v-model="form.phone_number" id="phone_number" name="phone_number" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter phone number!</div>
                   </div>
                </div> 
               </div>
               <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <input type="checkbox" v-model="form.negotiable" class="form-check-input">
                   <label for="validationCustom04" class="form-label">Negotiable</label>
                </div> 
                <!-- <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Name</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Name" v-model="form.name" id="name" name="name" class="form-control"
                         required="" />
                   </div>
                </div>  -->
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-12">
                  <label for="validationCustom04" class="form-label">Description</label>
                   <div class="col-sm-11">
                     <textarea rows="3" placeholder="Description*" v-model="form.description" id="description" name="description" class="form-control"
                         required="">
                     </textarea>
                      <div class="invalid-feedback">Please enter description!</div>
                   </div>
               </div> 
                </div>
                <div class="col-lg-12 felx mt-4 row">
                   <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="prev()" class="btn rounded-pill btn-dark">Previous</button>
                   </div>
                   <div class="col-sm-6 col-lg-6 text-end">
                      <button type="submit" @click.prevent="submit()" class="btn rounded-pill btn-success">Submit</button>
                   </div>
                </div>
             </div>
             <div v-else class="row flex flex-row justify-content-around g-3 needs-validation" novalidate="" autocomplete="off">
                <div v-if="successMessage" class="alert alert-success">{{ successMessage }}</div>
                <div class="row mb-3"></div>
                <div class="form-group row">
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
                      <div class="invalid-feedback">Please enter bedrooms!</div>
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
                <div class="form-group row">
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
                <div class="col-sm-6">
                   <label for="inputPassword" class="form-label">Parking Space</label>
                   <div class="col-sm-10">
                            <div class="form-check">
                               <input class="form-check-input hideable" type="radio" v-model="form.parking_space" name="yes" id="yes" value="1">
                               <label class="form-check-label" for="gridRadios1">
                                  Yes
                               </label>
                            </div>
                            <div class="form-check">
                               <input class="form-check-input hideable" type="radio" v-model="form.parking_space" name="no" id="no" value="2">
                               <label class="form-check-label" for="gridRadios2">
                                  No
                               </label>
                            </div>
                      <div class="invalid-feedback">Please check one!</div>
                   </div>
                </div>
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Price</label>
                      <div class="input-group has-validation col-sm-10">
                         <span class="input-group-text" id="inputGroupPrepend"
                           >Kes</span
                         >
                         <input
                           type="number"
                           name="username"
                           class="form-control"
                           v-model="form.price"
                           id="yourUsername"
                           required
                         />
                      <div class="invalid-feedback">Please enter  price!</div>
                   </div>
                </div> 
                <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Phone Number</label>
                   <div class="col-sm-10">
                      <input type="number" placeholder="Phone Number" v-model="form.phone_number" id="phone_number" name="phone_number" class="form-control"
                         required="" />
                      <div class="invalid-feedback">Please enter phone number!</div>
                   </div>
                </div> 
               </div>
               <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-6">
                   <input type="checkbox" v-model="form.negotiable" class="form-check-input">
                   <label for="validationCustom04" class="form-label">Negotiable</label>
                </div> 
                <!-- <div class="col-sm-6">
                   <label for="validationCustom04" class="form-label">Name</label>
                   <div class="col-sm-10">
                      <input type="text" placeholder="Name" v-model="form.name" id="name" name="name" class="form-control"
                         required="" />
                   </div>
                </div>  -->
                </div>
                <div class="row mb-3"></div>
                <div class="form-group row">
                <div class="col-sm-12">
                  <label for="validationCustom04" class="form-label">Description</label>
                   <div class="col-sm-11">
                     <textarea rows="3" placeholder="Description*" v-model="form.description" id="description" name="description" class="form-control"
                         required="">
                     </textarea>
                      <div class="invalid-feedback">Please enter description!</div>
                   </div>
               </div> 
                </div>
                <div class="col-lg-12 felx mt-4 row">
                   <div class="col-sm-6 col-lg-6">
                      <button @click.prevent="prev()" class="btn rounded-pill btn-dark">Previous</button>
                   </div>
                   <div class="col-sm-6 col-lg-6 text-end">
                      <button type="submit" @click.prevent="submit()" class="btn rounded-pill btn-success">Submit</button>
                   </div>
                </div>
             </div>
          </fieldset>
 
 
          </form>
 
 
          <!-- End General Form Elements -->
       </div>
    </div>
 
 
    <!--  actual form -->
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
 
 const chBoxes =
         document.querySelectorAll('.dropdown-menu input[type="checkbox"]');
      const dpBtn = 
         document.getElementById('multiSelectDropdown');
      let mySelectedListItems = [];

      function handleCB() {
         mySelectedListItems = [];
         let mySelectedListItemsText = '';

         chBoxes.forEach((checkbox) => {
               if (checkbox.checked) {
                  mySelectedListItems.push(checkbox.value);
                  mySelectedListItemsText += checkbox.value + ', ';
               }
         });

         dpBtn.innerText =
               mySelectedListItems.length > 0
                  ? mySelectedListItemsText.slice(0, -2) : 'Select';
      }

      chBoxes.forEach((checkbox) => {
         checkbox.addEventListener('change', handleCB);
      });

 export default {
   components:{
      Uploader
   },
    data () {
       return {
          user: [],
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
          phone_number: '',
          negotiable: '',
          created_by: '',
          media: [],
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
          wifi: ''
          
          },
          message: "",
          successMessage: "",
          loading: false,
          step: 1, 
          categories: [],
          propertytypes: [],
          locations: []
       }   
    },
    methods: {
       prev() {
          this.step--;
       },
       next() {
          this.step++;
       },
       changeMedia(media){
        this.form.media = media
       },
       loadLists() {
          axios.get('api/lists').then((response) => {
          this.categories = response.data.lists.categories;
          this.propertytypes = response.data.lists.propertytypes;
          this.locations = response.data.lists.locations;
          console.log(this.categories);
 
          });
       },
       submit(){
          axios.post("api/properties", this.form)
          .then(function (response) {
             console.log(response);
             // this.step = 1;
             toast.fire(
                'Success!',
                'Property added!',
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
          this.$router.push('/all-properties');
 
       }
 
    },
    mounted() {
       this.loadLists();
       this.user = localStorage.getItem('user');
       this.user = JSON.parse(this.user);
       this.form.created_by = this.user.id;
       this.form.phone_number = this.user.phone
       console.log("user",this.user)

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