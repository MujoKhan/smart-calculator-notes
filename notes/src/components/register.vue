<template>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <!-- <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div> -->
        <!-- Spinner End -->


        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <form action="" @submit.prevent="register">
                        <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <a href="#" class="">
                                    <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Memo</h3>
                                </a>
                                <h3>Register</h3>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" placeholder="jhondoe"
                                    v-model="form.name">
                                <label for="floatingText">Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput"
                                    placeholder="name@example.com" v-model="form.email">
                                <label for="floatingInput">Email address</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                    v-model="form.password">
                                <label for="floatingPassword">Password</label>
                            </div>

                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Register</button>
                            <p class="text-center mb-0">Already have an Account? <a href="">
                                    <router-link class="" :to="{name : 'Login' }">Login</router-link>
                                </a></p>
                            <router-view></router-view>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
    </div>
</template>

<script>
import axios from 'axios';
import { reactive, ref } from 'vue';
import { useRouter } from "vue-router";
import apiUrl from "../apiUrl.js";
// import { useStore } from 'vuex'
import Swal from 'sweetalert2';

export default
    {
        name: 'login-com',

        setup() {
            const router = useRouter()
            // const store = useStore()
            let form = reactive({
                name: '',
                email: '',
                password: ''
            });

            let errors = ref([]);

            const register = async () => {
                // e.preventDefault();
                let userRegister = {
                    name: form.name,
                    email: form.email,
                    password: form.password
                }
                await axios.post(apiUrl.url + 'register', userRegister).then(res => {
                    if (res.data.success) {
                        // store.dispatch('setToken',res.data.data.token)
                        // Swal.fire({
                        //     title: "User Registeration Successfully Done!!!",
                        //     text: "You will jump to login screen! Please Login",
                        //     type: "danger",
                        //     showCancelButton: true,
                        //     confirmButtonClass: "btn-danger",
                        //     confirmButtonText: "Yes, delete it!",
                        //     closeOnConfirm: false,
                        //     position: 'top-right',

                        // });
                        Swal.fire(
                            'User registeration successfully done!!!',
                            'You will jump to login screen! Please Login',
                            'success'
                        );
                        router.push({ name: 'Login' });
                        console.log('success');
                        console.log(res.data);
                    }
                }).catch(e => {
                    // console.log(e.response.data.message);
                    // console.log(e.response.status);
                    // console.log(e.response.headers);
                    if (e.response.data.errors.name) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e.response.data.errors.name,
                        });
                    }
                    else if (e.response.data.errors.email) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e.response.data.errors.email,
                        });
                    }
                    else if (e.response.data.errors.password) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e.response.data.errors.password,
                        });
                    }
                    else {
                        console.log(e.response.data);
                    }
                });
            }
            return {
                form,
                register,
                errors
            }
        }

    }
</script>
