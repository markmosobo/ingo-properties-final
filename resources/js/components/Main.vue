<template>
    <!-- <MainHeader /> -->


    <slot></slot>


    <Footer />
</template>

<script>
// import MainHeader from "./MainHeader.vue";
import Footer from "./Footer.vue";
import axios from 'axios';

export default {
  name: "Main",
  components: {
    // MainHeader,
    Footer,
  },
  data(){
    return {
        propertytypes: [],
        properties: [],
        locations: [],
        form: {
            propertytype_id: '',
            bathrooms: '',
            bathrooms: '',
            area: '',
            location_id: ''
        }
    }
  },
  methods: {
    getPhoto()
        {
            return "images/";
        },
    searchProperty(){
        axios.post('api/search', this.form).then((response) => {
            console.log(response)
        }).catch((error) => {
            console.log(error)
        })
        console.log(this.form)
    },
    loadLists() {
             axios.get('api/lists').then((response) => {
             this.categories = response.data.lists.categories;
             this.locations = response.data.lists.locations;
             this.propertytypes = response.data.lists.propertytypes;
             console.log("propertytypes", response)
             this.properties = response.data.lists.properties;
    
             });
        }
  },
  mounted(){
    this.loadLists();
  }


};

</script>