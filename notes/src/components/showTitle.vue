<template>

    <sidebar />
    <div class="container-fluid position-relative d-flex p-0">


        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 mb-2">
                    <div class="col-sm-6 col-md-7 col-xl-8 offset-xl-2 offset-md-3 offset-sm-3">
                        <div class="bg-secondary rounded  p-4" v-if="addBox">
                            <h3 class="text-center text-primary" v-for="(val,key) in title" :key="key">{{val.title}}
                            </h3>
                            <form action="">
                                <div class="form-group w-100">
                                    <label for="">Sub Title</label>
                                    <input type="text" class="form-control" v-model="storeSubTitle">
                                </div>
                                <div class="form-group w-100 ">
                                    <label for="">userid/email</label>
                                    <input type="text" class="form-control" v-model="storeUidEmail">
                                </div>
                                <div class="form-group w-100 ">
                                    <label for="">password</label>
                                    <input type="text" class="form-control" v-model="storePassword">
                                </div>
                                <div class="form-group ms-3 mt-4">
                                    <button type="button" class="btn btn-square btn-outline-success"
                                        v-for="(val,key) in title" :key="key" :id="val.id" @click="noteSave"><i
                                            class="fas fa-save"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="bg-secondary rounded p-4" v-if="updateBox">
                            <div>
                                <h3 class="text-center text-primary" v-for="(val,key) in title" :key="key">{{val.title}}
                                </h3>
                            </div>
                            <form action="">
                                <div class="form-group w-100">
                                    <label for="">Sub Title</label>
                                    <input type="text" class="form-control" v-model="storeSubTitle">
                                </div>
                                <div class="form-group w-100 ">
                                    <label for="">userid/email</label>
                                    <input type="text" class="form-control" v-model="storeUidEmail">
                                </div>
                                <div class="form-group w-100 ">
                                    <label for="">password</label>
                                    <input type="text" class="form-control" v-model="storePassword">
                                </div>
                                <div class="form-group ms-3 mt-4">
                                    <button type="button" class="btn btn-square btn-outline-warning" :id="noteId"
                                        @click="noteUpdate"><i class="fas fa-edit"></i></button>
                                    <button type="button" class="btn btn-square btn-sm btn-outline-success ms-5"
                                        @click="addNoteBox"><i class="fas fa-plus-circle"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                   
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 mb-2">
                    <div class="col-sm-6 col-xl-3" v-for="(val,key) in subTitle" :key="key">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div>
                                <div class="">
                                    <h6 class="text-primary">{{key+1}}. {{val.subTitle}}<span class=" float-end"><button type="button"
                                                class="btn btn-square btn-sm btn-outline-success ms-2" :id="val.id"
                                                @click="noteEdit"><i class="fas fa-edit"></i></button><button
                                                type="button" class="btn btn-square btn-sm btn-outline-primary ms-2"
                                                :id="val.id" @click="noteDelete"><i
                                                    class="fas fa-trash"></i></button></span></h6>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="">userid/email</label>
                                    <input type="text" class="form-control bg-dark text-primary" :value="val.text" readonly>
                                </div>
                                <div class="form-group" style="position:relative">
                                    <label for="">password</label>
                                    <input :type="typePassword" class="form-control bg-dark text-primary" :value="val.password"
                                        readonly>
                                    <i class="fas fa-eye text-success"
                                        style="position:absolute; left:88%; bottom:18%; cursor: pointer;"
                                        @click="showPassword" v-if="show"></i>
                                    <i class="fas fa-eye-slash text-danger"
                                        style="position:absolute; left:88%; bottom:18%; cursor: pointer;"
                                        @click="hidePassword" v-if="hide"></i>
                                </div>
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
//   import { reactive, inject,ref, onMounted,onUpdated } from 'vue';
//   import { useRouter } from "vue-router";
//   import setAuthHeder from "../setAuthHeader.js";
import sidebar from './sidebar.vue';
import header from './header.vue';
import apiUrl from "../apiUrl.js";
import Swal from 'sweetalert2';

export default {
    name: 'showTitle',
    components: {
        sidebar,
        'app-header': header,
    },
    data() {
        return {
            titleId: "",
            userMain: [],
            mainUserId: "",
            title: [],
            subTitle: [],
            storeSubTitle: "",
            storeUidEmail: "",
            storePassword: "",
            addBox: true,
            updateBox: false,
            updateNoteId: "",
            noteId: "",
            typePassword: "password",
            show: true,
            hide: false,
        }
    },
    created() {
        this.titleId = JSON.parse(localStorage.getItem("noteTitleId"));
        this.userMain = JSON.parse(localStorage.getItem("mainUser"));
        this.mainUserId = this.userMain['id'];
        this.fetchNotes();
    },
    methods: {
        showPassword() {
            this.typePassword = "text";
            this.show = false;
            this.hide = true;
        },

        hidePassword() {
            this.typePassword = "password";
            this.show = true;
            this.hide = false;
        },
        async fetchNotes() {
            let user = {
                userId: this.mainUserId,
                titleId: this.titleId
            };

            await axios.post(apiUrl.url + 'fetchNotes', user)
                .then(res => {
                    console.table(res.data.subTitle);
                    console.table(res.data.title);
                    this.title = res.data.title;
                    this.subTitle = res.data.subTitle;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async noteSave(e) {
            let user = {
                userId: this.mainUserId,
                subTitle: this.storeSubTitle,
                uidEmail: this.storeUidEmail,
                password: this.storePassword,
                titleId: e.currentTarget.id
            };
            this.storeSubTitle = "";
            this.storeUidEmail = "";
            this.storePassword = "";

            await axios.post(apiUrl.url + 'noteSave', user)
                .then(res => {
                    if (res.data.success) {
                        Swal.fire(
                            'Note has been saved!',
                            'Click Ok!',
                            'success'
                        );
                        this.fetchNotes();
                    }
                    console.log(res.data);
                })
                .catch(e => {
                    console.log(e);
                });
        },

        noteEdit(e) {
            this.updateBox = true;
            this.addBox = false;
            this.subTitle.forEach((val) => {
                if (val.id == e.currentTarget.id) {
                    this.storeSubTitle = val.subTitle;
                    this.storeUidEmail = val.text;
                    this.storePassword = val.password;
                    this.noteId = val.id;
                }
            });
        },

        async noteUpdate(e) {
            let user = {
                userId: this.mainUserId,
                subTitle: this.storeSubTitle,
                uidEmail: this.storeUidEmail,
                password: this.storePassword,
                noteId: e.currentTarget.id
            };
            this.storeSubTitle = "";
            this.storeUidEmail = "";
            this.storePassword = "";
            await axios.post(apiUrl.url + 'noteUpdate', user)
                .then(res => {
                    if (res.data.update) {
                        Swal.fire(
                            'Note has been updated!',
                            'Click ok!',
                            'success'
                        );
                        this.fetchNotes();
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        addNoteBox() {
            this.updateBox = false;
            this.addBox = true;
            this.storeSubTitle = "";
            this.storeUidEmail = "";
            this.storePassword = "";
        },

        async noteDelete(e) {
            let user = {
                userId: this.mainUserId,
                noteId: e.currentTarget.id
            };
            await axios.post(apiUrl.url + 'noteDelete', user)
                .then(res => {
                    if (res.data.delete) {
                        Swal.fire(
                            'Note has been delete!',
                            'Click ok!',
                            'success'
                            );
                        this.fetchNotes();
                    }
                    console.table(res.data);
                })
                .catch(e => {
                    console.log(e);
                });
        }
    }
}
</script>