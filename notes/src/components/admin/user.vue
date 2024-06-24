<template>
    <div class="container-fluid position-relative d-flex p-0">
        <sidebar />
        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-8 offset-xl-2">
                        <div v-if="newUserBox"
                            class="bg-secondary rounded d-flex flex-column align-items-center justify-content-between p-4">
                            <div class="text-primary">Add New User</div>
                            <form action="" class="w-100">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" v-model="formNew.name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control" v-model="formNew.email">
                                </div>
                                <div class="form-group">
                                    <label for="">Passsword</label>
                                    <input type="text" class="form-control" v-model="formNew.password">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-square btn-outline-success m-2"
                                        @click="addNewUser"><i class="fas fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                        <div v-if="editUserBox"
                            class="bg-secondary rounded d-flex flex-column align-items-center justify-content-between p-4">
                            <div class="text-primary">Edit User</div>
                            <form action="" class="w-100">
                                <div class="form-group">
                                    <label for="">Name</label>
                                    <input type="text" class="form-control" v-model="formUpdate.name">
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="email" class="form-control bg-dark" v-model="formUpdate.email"
                                        readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Passsword</label>
                                    <input type="text" class="form-control" v-model="formUpdate.password"
                                        placeholder="if you want to change">
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-square btn-outline-success m-2"
                                        :id="formUpdate.userId" @click="editUserStore"><i
                                            class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-square btn-outline-warning m-2"
                                        @click="newUserShow"><i class="fas fa-plus"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-3">
                    <div class="col-sm-12 col-xl-8 offset-xl-2">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white text-center">
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Read</th>
                                            <th scope="col">Write</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(val, key) in usersWithAll" :key="key">
                                            <td>{{key+1}}</td>
                                            <td>{{ val.name }}</td>
                                            <td>{{ val.email }}</td>
                                            <td v-if="val.read =='Yes'">
                                                <input class="form-check-input" type="checkbox" checked value="No"
                                                    :id="val.id" v-on:click.left="ckeckRead">
                                            </td>
                                            <td v-else>
                                                <input class="form-check-input" type="checkbox" value="Yes" :id="val.id"
                                                    v-on:click.left="ckeckRead">
                                            </td>
                                            <td v-if="val.write =='Yes'">
                                                <input class="form-check-input" type="checkbox" checked value="No"
                                                    :id="val.id" v-on:click.left="checkWrite">
                                            </td>
                                            <td v-else>
                                                <input class="form-check-input" type="checkbox" value="Yes" :id="val.id"
                                                    v-on:click.left="checkWrite">
                                            </td>
                                            <td v-if="val.edit =='Yes'">
                                                <input class="form-check-input" type="checkbox" checked value="No"
                                                    :id="val.id" v-on:click.left="ckeckEdit">
                                            </td>
                                            <td v-else>
                                                <input class="form-check-input" type="checkbox" value="Yes" :id="val.id"
                                                    v-on:click.left="ckeckEdit">
                                            </td>
                                            <td v-if="val.delete =='Yes'">
                                                <input class="form-check-input" type="checkbox" value="No" checked
                                                    :id="val.id" v-on:click.left="ckeckDelete">
                                            </td>
                                            <td v-else>
                                                <input class="form-check-input" type="checkbox" value="Yes" :id="val.id"
                                                    v-on:click.left="ckeckDelete">
                                            </td>
                                            <td><button type="button" class="btn btn-square btn-outline-warning m-2"
                                                    :id="val.id" @click="userEdit"><i class="fas fa-edit"></i></button>
                                                <button type="button" class="btn btn-square btn-outline-primary m-2"
                                                    :id="val.id" @click="userDelete"><i
                                                        class="fas fa-trash-alt"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
import { reactive } from 'vue';
import { useRouter } from "vue-router";
//   import setAuthHeder from "../../setAuthHeader.js";
import sidebar from './sidebar.vue';
import header from './header.vue';
import apiUrl from '../../apiUrl.js';
import Swal from 'sweetalert2';

export default {
    name: 'user-com',
    components: {
        sidebar,
        'app-header': header,

    },
    data() {
        return {
            name: "",
            email: "",
            userMain: [],
            userToken: "",
            router: useRouter(),
            allUser: [],
            permission: [],
            role: [],
            usersWithAll: [],
            formNew: reactive({
                name: '',
                email: '',
                password: ''
            }),
            newUserBox: true,
            editUserBox: false,
            formUpdate: reactive({
                userId: '',
                name: '',
                email: '',
                password: '',
            }),
        }

    },
    created() {
        this.userDetails();
        this.normalUsersFetch();
    },

    methods:
    {
        userDetails() {
            this.userMain = JSON.parse(localStorage.getItem("mainUser"));
            this.name = this.userMain['name'];
            this.email = this.userMain['email'];
            this.mainUserId = this.userMain['id'];
        },

        async normalUsersFetch() {
            this.usersWithAll = [];
            let admin = {
                adminId: this.mainUserId,
            }
            await axios.post(apiUrl.url + 'admin/allUser', admin)
                .then(res => {
                    if (res.data.success) {
                        this.allUser = res.data.allUser;
                        this.permission = res.data.permission;
                        this.role = res.data.role;
                        this.allUser.forEach((val) => {
                            this.permission.forEach((val1) => {
                                if (val.id == val1.userID) {
                                    // console.log(val1.userID);

                                    this.usersWithAll.push({
                                        id: val.id,
                                        name: val.name,
                                        email: val.email,
                                        read: val1.read,
                                        write: val1.write,
                                        edit: val1.edit,
                                        delete: val1.delete
                                    });
                                }
                            });
                        });
                    }
                    // console.log(res.data);
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async ckeckRead(e) {
            let user = {
                userId: e.currentTarget.id,
                read: e.currentTarget.value
            };

            await axios.post(apiUrl.url + 'admin/readPermission', user)
                .then(res => {
                    if (res.data.permissionUpdated) {
                        this.normalUsersFetch();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async checkWrite(e) {
            let user = {
                userId: e.currentTarget.id,
                write: e.currentTarget.value
            };

            await axios.post(apiUrl.url + 'admin/writePermission', user)
                .then(res => {
                    if (res.data.permissionUpdated) {
                        this.normalUsersFetch();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async ckeckEdit(e) {
            let user = {
                userId: e.currentTarget.id,
                edit: e.currentTarget.value
            };

            await axios.post(apiUrl.url + 'admin/editPermission', user)
                .then(res => {
                    if (res.data.permissionUpdated) {
                        this.normalUsersFetch();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async ckeckDelete(e) {
            let user = {
                userId: e.currentTarget.id,
                delete: e.currentTarget.value
            };

            await axios.post(apiUrl.url + 'admin/deletePermission', user)
                .then(res => {
                    if (res.data.permissionUpdated) {
                        this.normalUsersFetch();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async addNewUser() {
            let user = {
                name: this.formNew.name,
                email: this.formNew.email,
                password: this.formNew.password,
            };
            this.formNew.name = "";
            this.formNew.email = "";
            this.formNew.password = "";

            await axios.post(apiUrl.url + 'admin/addNewUser', user)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'New user has been added!',
                            'Click ok!',
                            'success'
                        );
                        this.normalUsersFetch();
                    }
                    // console.log(res.data);
                })
                .catch(e => {
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
        },

        async userDelete(e) {
            let user = {
                userId: e.currentTarget.id
            };

            await axios.post(apiUrl.url + 'admin/userdelete', user)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'User has been deleted!',
                            'Click ok!',
                            'success'
                        );
                        this.normalUsersFetch();
                        // console.log(res.data);
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        userEdit(e) {
            this.newUserBox = false;
            this.editUserBox = true;
            this.formUpdate.userId = e.currentTarget.id;
            this.usersWithAll.forEach((val) => {
                if (val.id == e.currentTarget.id) {
                    this.formUpdate.name = val.name;
                    this.formUpdate.email = val.email;
                }
            });
        },
        newUserShow() {
            this.newUserBox = true;
            this.editUserBox = false;
        },

        async editUserStore() {
            let user = {
                id: this.formUpdate.userId,
                name: this.formUpdate.name,
                email: this.formUpdate.email,
                password: this.formUpdate.password,
            };

            this.formUpdate.userId = "";
            this.formUpdate.name = "";
            this.formUpdate.email = "";
            this.formUpdate.password = "";
            await axios.post(apiUrl.url + 'admin/userUpdate', user)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'User has been updated!',
                            'Click ok!',
                            'success'
                        );
                        this.normalUsersFetch();
                    }
                })
                .catch(e => {
                    if (e.response.data.errors.name) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e.response.data.errors.name,
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
    },
}
</script>
  