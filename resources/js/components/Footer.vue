<template>
<!-- FOOTER -->
<!-- Footer  -->
<footer>
    <div class="wrapper__footer bg__footer ">
        <div class=" container">
            <div class="row">
                <div class="col-md-4">
                    <div class="widget__footer mb-3">
                        <!-- <h4 class="footer-title">company info</h4> -->
                        <figure>
                            <!-- <img src="images/logo-blue.png" alt="" class="logo-footer"> -->
                            <img src="/images/ingo-logo-footer.png" class="logo-footer" alt="">
                        </figure>
                        <p>
                            IPMC is a Property Marketing, Development, Management and Consultancy
                             Company incorporated in Kenya under the Companies Act, Chapter 486.
                             

                        </p>
                    </div>
                    <div class="border-line"></div>
                    <!-- <div class="widget__footer">
                        <h4 class="footer-title">follow us </h4>
                        <p>
                            Follow us and stay in touch to get the latest news
                        </p>
                        <p>
                            <button class="btn btn-social btn-social-o facebook mr-1">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="btn btn-social btn-social-o twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button class="btn btn-social btn-social-o linkedin mr-1">
                                <i class="fab fa-linkedin"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-instagram"></i>
                            </button>

                            <button class="btn btn-social btn-social-o youtube mr-1">
                                <i class="fab fa-youtube"></i>
                            </button>
                        </p>
                    </div> -->
                </div>

                <!-- QUICK LINKS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">find us</h4>

                        <div v-for="contact in contacts" :key="contact.id " class="widget__form-newsletter ">
                            <ul class="list-unstyled mb-0 mt-3">
                                <li> <b> <i class="fa fa-map-marker"></i></b><span>{{contact.address}}</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(254) {{contact.phone}}</span> </li>
                                <li> <b><i class="fa fa-phone-square"></i></b><span>(+254) {{contact.phone_2}}</span> </li>
                                <li> <b><i class="fa fa-headphones"></i></b><span>{{contact.email}}</span> </li>
                                <li> <b><i class="fa fa-clock"></i></b><span>Mon - Fri / 8:00AM - 5:00PM</span> </li>
                                <li> <b><i class="fa fa-clock"></i></b><span>Sat / 9:00AM - 4:00PM</span> </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- NEWSLETTERS -->
                <div class="col-md-4">
                    <div class="widget__footer">
                        <h4 class="footer-title">follow us </h4>
                        <p>
                            Follow us and stay in touch to get the latest news
                        </p>
                        <p>
                            <button class="btn btn-social btn-social-o facebook mr-1">
                                <i class="fab fa-facebook"></i>
                            </button>
                            <button class="btn btn-social btn-social-o twitter mr-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button class="btn btn-social btn-social-o linkedin mr-1">
                                <i class="fab fa-linkedin"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-instagram"></i>
                            </button>
                            <button class="btn btn-social btn-social-o instagram mr-1">
                                <i class="fab fa-tiktok"></i>
                            </button>
                            <button class="btn btn-social btn-social-o youtube mr-1">
                                <i class="fab fa-youtube"></i>
                            </button>
                        </p>
                    </div>
                </div>
                <!-- END NEWSLETTER -->
            </div>

        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="bg__footer-bottom ">
        <div class="container">
            <div class="row flex-column-reverse flex-md-row">
                <div class="col-md-6">
                    <span>
                        &copy; {{ new Date().getFullYear() }} Ingo Properties Marketing & Consultancy
                        <!-- <a href="#">retenvi.com</a> -->
                    </span>
                </div>
                <!-- <div class="col-md-6">
                    <ul class="list-inline ">
                        <li class="list-inline-item">
                            <a href="#">
                                privacy
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                contact
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                about
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#">
                                faq
                            </a>
                        </li>
                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</footer>
<!-- End Footer  -->
<!-- END FOOTER -->

</template>

<script>
export default {
  name: "Footer",
  data(){
    return {
        contacts: [],
        sociallinks: []
    }
  },
  methods: {
        loadLists() {
                axios.get('/api/lists').then((response) => {
                this.contacts = response.data.lists.contacts;
                this.sociallinks = response.data.lists.sociallinks;
                console.log("contacts", this.contacts)
                console.log("social", this.sociallinks)

                });
            },
    },
    mounted(){
        this.loadLists();
    }

};
</script>