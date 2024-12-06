<template>
    <div>
        <template v-if="usuarioActual">
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">
                    <!-- Menu -->
                    <sidebar></sidebar>
                    <!-- / Menu -->

                    <!-- Layout container -->
                    <div class="layout-page">
                        <!-- Navbar -->
                        <navbar></navbar>
                        <!-- / Navbar -->
                        <!-- Content wrapper -->
                        <div class="content-wrapper">
                            <!-- Content -->
                            <transition name="fade">
                                <router-view/>
                            </transition>
                            <!-- / Content -->

                            <!-- footer -->
                            <bottom></bottom>
                            <!-- / footer -->

                            <div class="content-backdrop fade"></div>
                        </div>
                        <!-- Content wrapper -->
                    </div>
                    <!-- / Layout page -->
                </div>

                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>

                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>
            </div>
        </template>
        <template v-if="!usuarioActual">
            <login></login>
        </template>
    </div>
</template>
<script>
    import Login from './auth/Login.vue';
    import Sidebar from './shared/Sidebar.vue';
    import Navbar from './shared/Navbar.vue';
    import Bottom from './shared/Bottom.vue';
    export default{
        components:{
            Login,
            Sidebar,
            Navbar,
            Bottom,
        },
        computed:{
            usuarioActual(){
                return this.$store.getters.usuarioActual;
            }
        }
    }
</script>

<style>
.fade-enter {
    opacity: 0;
}
.fade-enter-active {
    transition: opacity .6s ease-out;
}
</style>