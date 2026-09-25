<template>


    <slot></slot>
    <a href=" https://wa.me/254759509462?text=Hello!%20Ingo%20Properties," data-action="share/whatsapp/share"  class="floating" >
    <i class="fab fa-whatsapp fab-icon"></i>
    </a>

    <Footer />
</template>

<script>
import Footer from "./Footer.vue";

export default {
  name: "Branch",
  components: {
    Footer,
  },


};

</script>
<style>
/* Add WA floating button CSS */
.floating {
 position: fixed;
 width: 60px;
 height: 60px;
 bottom: 40px;
 right: 40px;
 background-color: #25d366;
 color: #fff;
 border-radius: 50px;
 text-align: center;
 font-size: 30px;
 box-shadow: 2px 2px 3px #999;
 z-index: 100;
}

.fab-icon {
 margin-top: 16px;
}    
</style>