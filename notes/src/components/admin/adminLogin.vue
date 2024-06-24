<template>
    <!-- Sign In Start -->
    <div class="container-fluid">
        <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
            <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                <form action="" @submit.prevent="login">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="#" class="">
                                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Memo</h3>
                            </a>
                            <h3>Admin Login</h3>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                                v-model="form.email">
                            <label for="floatingInput">Email address</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                v-model="form.password">
                            <label for="floatingPassword">Password</label>
                        </div>

                        <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Login</button>
                        <p class="text-center mb-0">Back to normal user? <a href="">
                                <router-link class="text-decoration-none" :to="{name : 'Login' }">Click</router-link>
                                <router-view></router-view>
                            </a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Sign In End -->
</template>

<script>
import axios from 'axios';
import { reactive } from 'vue';
import { useRouter } from "vue-router";
import setAuthHeder from "../../setAuthHeader.js";
import apiUrl from "../../apiUrl.js";
import Swal from 'sweetalert2';


export default {
    name: 'adminLogin',
    setup() {
        const router = useRouter();
        let form = reactive({
            email: '',
            password: ''
        });

        const login = async () => {
            let userlogin = {
                email: form.email,
                password: form.password
            }
            await axios.post(apiUrl.url + 'admin/login', userlogin).then(res => {
                if (res.data.success) {
                    Swal.fire(
                        'Admin login successful  !!!',
                        'You will jump to home screen',
                        'success'
                    );
                    localStorage.setItem('token', res.data.token);
                    localStorage.setItem("mainUser", JSON.stringify(res.data.user));
                    setAuthHeder(res.data.token);
                    router.push({ name: 'adminHome' });
                }


            }).catch(e => {
                if (e.response.data.errors.email) {
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
            login,
            // errors,
            // condition
        }
    }

}
</script>
