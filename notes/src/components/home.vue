<template>

    <div class="container-fluid position-relative d-flex p-0">
        <sidebar />


        <!-- Content Start -->
        <div class="content">
            <app-header></app-header>
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-sm-12 col-md-12 col-xl-12">
                        <div class="bg-secondary rounded  p-4">
                            <div class="text-center"><h3><b class="text-primary">Welcome in smart calculator and note pad</b></h3></div>
                            <h5 class="text-primary">Calculator</h5>
                            <ul>
                                <li>In calculator just enter digits and get multiples result.</li>
                                <li>You can save your calculation by clicking there icon button.</li>
                                <li>There is also a button to remove/empty the input fields.</li>
                                <li>All save/stored calculation will show in bottom.</li>
                                <li>You can combine/merge calculation which is stored and all result will show above.</li>
                            </ul>
                            <h5 class="text-primary">Note pad</h5>
                            <ul>
                                <li>Add your title which is related and save.</li>
                                <li>You can view or delete your title.</li>
                                <li>If you will click on view icon that will jump on other page, there you can add multiples notes.</li>
                                <li>You can edit and delete particular note.</li>
                                <li>There is an eye to show/hide password or anything which will store on that field.</li>
                            </ul>
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
import sidebar from './sidebar.vue';
import header from './header.vue';
export default {
    name: 'home-com',
    components: {
        sidebar,
        'app-header': header,
    },
}
</script>
