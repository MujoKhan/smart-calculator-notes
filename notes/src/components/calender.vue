<template>
    <sidebar />
    <div class="container-fluid position-relative d-flex p-0">



        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="col-sm-12 col-md-6 col-xl-4">
                                Not working
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
       s <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
    </div>
</template>

<script>
// import axios from 'axios';
// import { reactive, inject,ref, onMounted,onUpdated } from 'vue';
// import { useRouter } from "vue-router";
// import setAuthHeder from "../setAuthHeader.js";
import sidebar from './sidebar.vue';
import header from './header.vue';

export default {
    name: 'calender-com',
    components: {
        sidebar,
        'app-header': header,

    },
    data() {
        return {

        }
    },
}
</script>
