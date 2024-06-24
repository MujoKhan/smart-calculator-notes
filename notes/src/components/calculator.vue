<template>
    <sidebar />
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <label for="">First Digit</label>
                                    <input type="number" class="form-control" v-model="firstDigit" v-on:keyup="fd">
                                </div>
                                <div class="form-group ms-2">
                                    <label for="">Second Digit</label>
                                    <input type="number" class="form-control" v-model="secondDigit" v-on:keyup="sd">
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center p-4">
                            <button type="button" class="btn btn-square btn-outline-success m-2" @click="storeFun"><i
                                    class="fas fa-box-open"></i></button>
                            <button type="button" class="btn btn-square btn-outline-warning m-2" @click="cleanFun"><i
                                    class="fas fa-trash-alt"></i></button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} + {{ secondDigit }} = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ add }}</strong>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} - {{ secondDigit }} = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ sub }}</strong>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} * {{ secondDigit }} = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ mul }}</strong>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} / {{ secondDigit }} = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ div }} </strong>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} "" {{ secondDigit }} = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ percenatge }} %</strong>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-6">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <form action="" class="d-flex">
                                <div class="form-group">
                                    <strong class="text-danger">{{ firstDigit }} "" {{ secondDigit }} % = </strong>
                                </div>
                                <div class="form-group ms-2">

                                    <strong class="text-danger">{{ percenatgeIntoDigit }}</strong>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-6 col-xl-12">
                        <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                            <div class="table-responsive">
                                <table class="table text-start align-middle table-bordered table-hover mb-0">
                                    <thead>
                                        <tr class="text-white">
                                            <th scope="col">Check</th>
                                            <th scope="col">#</th>
                                            <th scope="col">First</th>
                                            <th scope="col">Second</th>
                                            <th scope="col">+</th>
                                            <th scope="col">-</th>
                                            <th scope="col">*</th>
                                            <th scope="col">/</th>
                                            <th scope="col">%</th>
                                            <th scope="col">%(Digit)</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(val, key) in allCal" :key="key">
                                            <td><input class="form-check-input" type="checkbox" :value="val.id"
                                                    v-model="selectedRows" @click="check"></td>
                                            <td>{{key+1}}</td>
                                            <td>{{ val.first }}</td>
                                            <td>{{ val.second }}</td>
                                            <td>{{ val.add }}</td>
                                            <td>{{ val.sub }}</td>
                                            <td>{{ val.multi }}</td>
                                            <td>{{ val.div }}</td>
                                            <td>{{ val.percenatge }}</td>
                                            <td>{{ val.percenatgeIntoDigit }}</td>
                                            <td><button type="button" :id="val.id" @click="deleteCalcu"
                                                    class="btn btn-square btn-outline-primary m-2"><i
                                                        class="fas fa-trash-alt"></i></button></td>
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
// import { reactive, inject,ref, onMounted,onUpdated } from 'vue';
// import { useRouter } from "vue-router";
// import setAuthHeder from "../setAuthHeader.js";
import sidebar from './sidebar.vue';
import header from './header.vue';
import apiUrl from "../apiUrl.js";
import Swal from 'sweetalert2';



export default {
    name: 'calculator-com',
    components: {
        sidebar,
        'app-header': header,

    },
    data() {
        return {
            firstDigit: "",
            secondDigit: "",
            add: "",
            sub: "",
            mul: "",
            div: "",
            percenatge: "",
            percenatgeIntoDigit: "",
            first: 0,
            second: 0,
            addTemp: 0,
            subTemp: 0,
            mulTemp: 0,
            divTemp: 0,
            percenatgeTemp: 0,
            percenatgeIntoDigitTemp: 0,
            tempDiv: "",
            tempPerc: "",
            digit: [],
            allCal: [],
            mainUserId: "",
            userMain: [],
            selectedRows: [],


        }
    },
    watch:
    {

        selectedRows: function (val) 
        {
            this.firstDigit = "";
            this.secondDigit = "";
            this.first = 0;
            this.second = 0;
            this.addTemp = 0;
            this.subTemp = 0;
            this.mulTemp = 0;
            this.divTemp = 0;
            this.add = "";
            this.sub = "";
            this.mul = "";
            this.div = "";
            this.percenatge = "",
            this.percenatgeIntoDigit = "",
                val.forEach((val) => {
                    this.allCal.forEach((val1) => {

                        if (val == val1.id) {
                            this.first = parseInt(this.first) + parseInt(val1.first);
                            this.second = parseInt(this.second) + parseInt(val1.second);
                            this.addTemp = parseInt(this.first) + parseInt(this.second);
                            this.subTemp = parseInt(this.first) - parseInt(this.second);
                            this.mulTemp = parseInt(this.first) * parseInt(this.second);
                            this.divTemp = parseInt(this.first) / parseInt(this.second);
                            this.percenatgeTemp = parseInt(this.first) * 100 / parseInt(this.second);
                            this.percenatgeIntoDigitTemp = parseInt(this.first) * parseInt(this.second) / 100;
                        }
                    });
                    this.firstDigit = this.first;
                    this.secondDigit = this.second;
                    this.add = this.addTemp;
                    this.sub = this.subTemp;
                    this.mul = this.mulTemp;
                    this.div = this.divTemp;
                    this.percenatge = this.percenatgeTemp;
                    this.percenatgeIntoDigit = this.percenatgeIntoDigitTemp;
                });
        }

    },
    computed:
    {

    },
    created() {
        this.userMain = JSON.parse(localStorage.getItem("mainUser"));
        this.mainUserId = this.userMain['id'];
        this.fetchData();
    },
    methods:
    {
        fd() {
            this.add = parseInt(this.firstDigit) + parseInt(this.secondDigit);
            this.sub = parseInt(this.firstDigit) - parseInt(this.secondDigit);
            this.mul = parseInt(this.firstDigit) * parseInt(this.secondDigit);
            if (parseInt(this.secondDigit) == 0) {
                this.div = "Infinity";
                this.percenatge = "Infinity";
            }
            else {
                this.div = parseInt(this.firstDigit) / parseInt(this.secondDigit);
                this.percenatge = parseInt(this.firstDigit) * 100 / parseInt(this.secondDigit);
            }

            this.percenatgeIntoDigit = parseInt(this.firstDigit) * parseInt(this.secondDigit) / 100;

        },

        sd() {
            this.add = parseInt(this.firstDigit) + parseInt(this.secondDigit);
            this.sub = parseInt(this.firstDigit) - parseInt(this.secondDigit);
            this.mul = parseInt(this.firstDigit) * parseInt(this.secondDigit);
            if (parseInt(this.secondDigit) == 0) {
                this.div = "Infinity";
                this.percenatge = "Infinity";
            }
            else {
                this.div = parseInt(this.firstDigit) / parseInt(this.secondDigit);
                this.percenatge = parseInt(this.firstDigit) * 100 / parseInt(this.secondDigit);
            }

            this.percenatgeIntoDigit = parseInt(this.firstDigit) * parseInt(this.secondDigit) / 100;
        },

        async fetchData() {
            let mainUser = {
                userId: this.mainUserId,
            }
            await axios.post(apiUrl.url + 'fetch', mainUser)
                .then(res => {
                    if (res.data.success) {
                        // this.allCal = JSON.stringify(res.data.calculation);
                        this.allCal = res.data.calculation;
                        // console.table(this.allCal);
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        async storeFun() {

            if (parseInt(this.secondDigit) == 0) {
                this.tempDiv = "Infinity";
                this.tempPerc = "Infinity";
            }
            else {
                this.tempDiv = parseInt(this.firstDigit) / parseInt(this.secondDigit);
                this.tempPerc = parseInt(this.firstDigit) * 100 / parseInt(this.secondDigit);
            }

            let storeValues = {
                userId: this.mainUserId,
                first: this.firstDigit,
                second: this.secondDigit,
                add: parseInt(this.firstDigit) + parseInt(this.secondDigit),
                sub: parseInt(this.firstDigit) - parseInt(this.secondDigit),
                multi: parseInt(this.firstDigit) * parseInt(this.secondDigit),
                div: this.tempDiv,
                percenatge: this.tempPerc,
                percenatgeIntoDigit: parseInt(this.firstDigit) * parseInt(this.secondDigit) / 100,
            };


            await axios.post(apiUrl.url + 'store', storeValues)
                .then(res => {
                    // console.log(res.data);
                    if (res.data.success) {
                        Swal.fire(
                            'Calculation has been stored!',
                            'Click ok!',
                            'success'
                        );
                        this.selectedRows = [];
                        this.fetchData();
                    }
                })
                .catch(e => {
                    console.log(e);
                });


            this.firstDigit = "";
            this.secondDigit = "";
            this.add = "";
            this.sub = "";
            this.mul = "";
            this.div = "";
            this.percenatge = "";
            this.percenatgeIntoDigit = "";

        },

        async deleteCalcu(e) {
            let deleteCal = {
                calId: e.currentTarget.id,
                userId: this.mainUserId,
            };
            await axios.post(apiUrl.url + 'delete', deleteCal)
                .then(res => {
                    if (res.data.delete == 1) {
                        Swal.fire(
                            'Calculation has been deleted!',
                            'Click ok!',
                            'success'
                        );
                        this.fetchData();
                        console.log(res);
                    }
                    else {
                        console.log(res.data.delete);
                    }
                })
                .catch(e => {
                    console.log(e);
                });
        },

        cleanFun() {
            this.firstDigit = "";
            this.secondDigit = "";
            this.add = "";
            this.sub = "";
            this.mul = "";
            this.div = "";
            this.percenatge = "";
            this.percenatgeIntoDigit = "";
            this.selectedRows = [];
        }
    },
}
</script>
