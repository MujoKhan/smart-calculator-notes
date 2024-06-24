<template>
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-secondary navbar-dark">
            <router-link class="text-decoration-none navbar-brand mx-4 mb-3" :to="{name : 'Home' }">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>MEMO</h3>
            </router-link>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <i class="fas fa-user"></i>
                    <div
                        class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                    </div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0 text-primary">{{email}}</h6>
                    <span class="text-warning"><b>user</b></span>
                </div>
            </div>
            <div class="navbar-nav w-100">

                <router-link to="/calculator"><a href="#" class="nav-item nav-link"><i
                            class="fas fa-calculator me-2"></i>Calculator</a></router-link>
                <!-- <router-link to="/calender"><a href="#" class="nav-item nav-link"><i
                            class="far fa-calendar-alt me-2"></i>Calender</a></router-link> -->
                <router-link to="/notepad"><a href="#" class="nav-item nav-link"><i
                            class="fas fa-book-open me-2"></i>Note Pad</a></router-link>
                <router-link to="/notepad"><a href="#" class="nav-item nav-link" v-if="readPermission"><i
                            class="fas fa-ring me-2"></i>Upcoming</a></router-link>
                <router-link to="/notepad"><a href="#" class="nav-item nav-link" v-if="readPermission"><i
                            class="fas fa-ring me-2"></i>Upcoming</a></router-link>
                <router-link to="/notepad"><a href="#" class="nav-item nav-link" v-if="readPermission"><i
                            class="far fa-money-bill-alt me-2"></i>Upcoming</a></router-link>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
</template>

<script>
import axios from 'axios';
import { useRouter } from "vue-router";
import apiUrl from "../apiUrl.js";

export default {
    name: 'sidebar-com',
    data() {
        return {
            name: "",
            email: "",
            userMain: [],
            userToken: "",
            router: useRouter(),
            permission: [],
            readPermission: false,
            writePermission: false,
            editPermission: false,
            deletePermission: false,
            timer: "",
        }
    },
    // auto load
    created() {
        this.userDetails();
        this.userPermission();
    },

    methods:
    {
        userDetails() {
            this.userMain = JSON.parse(localStorage.getItem("mainUser"));
            this.name = this.userMain['name'];
            this.email = this.userMain['email'];
            this.mainUserId = this.userMain['id'];

        },
        async userPermission() {
            let user = {
                userId: this.mainUserId,
            };
            await axios.post(apiUrl.url + 'permission', user)
                .then(res => {
                    this.permission = res.data.permission;
                    this.permission.forEach((val) => {
                        if (val.read == "Yes") {
                            this.readPermission = true;
                        }
                        else if (val.read == "No") {
                            this.readPermission = false;
                        }
                    });
                })
                .catch(e => {
                    console.log(e);
                });
        }
    },

}
</script>