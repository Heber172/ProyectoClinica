<template>
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <span class="app-brand-logo">
                <img src="/assets/img/favicon/icono.png" alt="Logo Sistema" width="30" height="30">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">SARP</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
        </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Cabecera -->
            <li class="menu-item">
                <div class="user-info text-center">
                    <img alt="Perfil"
                        class="user-img img-fluid rounded-circle" 
                        style="height: 65px; object-fit: cover; width: 65px;"
                        v-lazy="`/imagenes/usuarios/${usuarioActual.foto}`">
                    <div class="name-wrapper d-block dropdown mt-2 mb-2">
                        <span class="user-name">
                            Bienvenido,  {{ usuarioActual.nombre }}
                        </span>
                        <div class="text-light text-primary">
                            <b>{{ usuarioActual.rol }}</b>
                        </div>
                    </div>
                </div>
            </li>
            <li class="menu-header small text-uppercase pt-1">
                <span class="menu-header-text">PRINCIPAL</span>
            </li>
            <li class="menu-item"
                :class="{ 'active' : isActiveInicio }">
                <router-link class="menu-link" to="/inicio">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Email">Inicio</div>
                </router-link>
            </li>
            <!-- Gestión de Usuarios -->
            <li class="menu-item"
                :class="{ 'open' : isActiveUsuario || isActiveRol }">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="Layouts">Gestion de Usuarios</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item"
                        :class="{ 'active' : isActiveUsuario }">
                        <router-link class="menu-link" to="/usuario">
                            <div data-i18n="Collapsed menu">Usuarios</div>
                        </router-link>
                    </li>
                    <li class="menu-item"
                        :class="{ 'active' : isActiveRol }">
                        <router-link class="menu-link" to="/rol">
                            <div data-i18n="Content navbar">Roles y Permisos</div>
                        </router-link>
                    </li>
                </ul>
            </li>
        </ul>
    </aside>
</template>
<script>
    export default {
        name: 'sidebar',
        computed:{
            /**
             * Obtiene los permisos del usuario logueado
             * @return {Array}
             */
            usuarioPermisos(){
                return this.$store.getters.usuarioPermisos;
            },
            /**
             * Obtiene los datos del usuario logueado
             * @return {Object}
             */
            usuarioActual(){
                return this.$store.getters.usuarioActual;
            },
            isActiveInicio(){
                return this.buscarRuta(['inicio']);
            },
            isActiveUsuario(){
                return this.buscarRuta(['usuarioLista','usuarioCrear','usuarioEditar']);
            },
            isActiveRol(){
                return this.buscarRuta(['rolLista','rolCrear','rolEditar']);
            },
        },
        methods:{
            /**
             * Verifica Ruta Actual para activar menú
             * @autor Heber Mollericona
             */
            buscarRuta(routerNames){
                return routerNames.includes(this.$route.name);
            }
        }
    }
</script>