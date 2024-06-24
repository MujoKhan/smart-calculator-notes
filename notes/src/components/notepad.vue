<template>

    <sidebar />
    <div class="container-fluid position-relative d-flex p-0">


        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6 offset-xl-3 offset-md-3">
                        <div class="bg-secondary rounded  p-4">
                            <form action="" class="d-flex align-items-center justify-content-between">
                                <div class="form-group w-100">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" v-model="titleInput">
                                </div>
                                <div class="form-group ms-3 mt-4">
                                    <button type="button" class="btn btn-square btn-outline-success"
                                        @click="titleStore"><i class="fas fa-save"></i></button>
                                    <!-- <button type="button" class="btn btn-square btn-outline-warning" @click="showAlert"><i class="fas fa-save"></i></button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-3" v-for="(val,key) in allTitle" :key="key">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <h5 class="text-primary">{{key+1}}.{{val.title}}</h5>
                            <div>
                                <router-link :to="{name : 'showTitle' }" :id="val.id" @click="titleShow"><button
                                        type="button" class="btn btn-square btn-outline-success"><i
                                            class="fas fa-eye"></i></button></router-link>
                                <button type="button" class="btn btn-square btn-outline-primary ms-2" :id="val.id"
                                    @click="titleDelete"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content End -->
        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> -->
    </div>
</template>

<script>
import axios from 'axios';
// import { reactive, inject,ref, onMounted,onUpdated } from 'vue';
// import { useRouter } from "vue-router";
// import setAuthHeder from "../setAuthHeader.js";
import sidebar from './sidebar.vue';
import header from './header.vue';
import apiUrl from "../apiUrl.js";
import Swal from 'sweetalert2';

export default {
    name: 'notepad-com',
    components: {
        sidebar,
        'app-header': header,
    },
    data() {
        return {
            titleInput: "",
            userMain: [],
            mainUserId: "",
            allTitle: [],
        }
    },
    created() {
        this.userMain = JSON.parse(localStorage.getItem("mainUser"));
        this.mainUserId = this.userMain['id'];
        this.fetchTitle();
    },
    methods: {
        
        async titleDelete(e) {
            let userDeleteTitle = {
                userId: this.mainUserId,
                titleId: e.currentTarget.id
            };
            await axios.post(apiUrl.url + 'deleteTitle', userDeleteTitle)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'Note has been deleted!',
                            'Click ok!',
                            'success'
                        );
                        this.fetchTitle();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async fetchTitle() {
            let user = {
                userId: this.mainUserId,
            };

            await axios.post(apiUrl.url + 'fetchTitle', user)
                .then(res => {
                    if (res.data.success) {
                        this.allTitle = res.data.title;
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async titleStore() {
            let user = {
                userId: this.mainUserId,
                title: this.titleInput
            };
            this.titleInput = "";
            await axios.post(apiUrl.url + 'title', user)
                .then(res => {
                    Swal.fire(
                            'Note has been stored!',
                            'Click ok!',
                            'success'
                        );
                    if (res.data.success) {
                        this.fetchTitle();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        titleShow(e) {
            localStorage.setItem('noteTitleId', e.currentTarget.id);
        }
    }
}
</script>