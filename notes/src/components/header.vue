<template>

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <!-- <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
        </a> -->
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <router-link to="/calculator"><a href="#" class="nav-item nav-link"><i
                            class="fas fa-calculator me-2"></i></a></router-link>
            </div>
            <div class="nav-item dropdown">
                <router-link to="/notepad"><a href="#" class="nav-item nav-link"><i
                            class="fas fa-book-open me-2"></i></a></router-link>
            </div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" @click="logout">
                    <!-- <i class="fas fa-user"></i> -->

                    <i class="fas fa-sign-out-alt"></i>
                    <span class="d-none d-lg-inline-flex ms-2">{{name}}</span>
                </a>
            </div>
        </div>
    </nav>
</template>
  
<script>
import axios from 'axios';
// import { reactive, inject, ref, onMounted, onUpdated } from 'vue';
import { useRouter } from "vue-router";
import setAuthHeder from "../setAuthHeader.js";
import apiUrl from "../apiUrl.js";
import Swal from 'sweetalert2';

export default {
    name: 'header-com',
    data() {
        return {
            name: "",
            email: "",
            userMain: [],
            userToken: "",
            router: useRouter(),
        }
    },
    // auto load
    created() {
        this.userDetails();
    },

    methods: {
        userDetails() {
            this.userMain = JSON.parse(localStorage.getItem("mainUser"));
            this.name = this.userMain['name'];
            this.email = this.userMain['email'];
            this.mainUserId = this.userMain['id'];
        },
        async logout(e) {
            e.preventDefault();
            this.userToken = localStorage.getItem('token');
            await axios.post(apiUrl.url + 'logout', this.userToken)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'You are logout!',
                            'You will jump on login screen!',
                            'success'
                        );
                        localStorage.removeItem("token");
                        localStorage.removeItem("mainUser");
                        localStorage.removeItem("mainUser");
                        localStorage.removeItem("permission");
                        setAuthHeder(false);
                        this.router.push({ name: 'Login' });
                    }
                    console.log(res);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }

}
</script>
  