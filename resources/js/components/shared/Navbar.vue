<template>
<nav
    class="layout-navbar navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme container-fluid"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
        <i class="ti ti-menu-2 ti-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Sucursales  -->
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0" title="Cambiar de Sucursal">
                <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false">
                    <i class="ti ti-layout-grid-add ti-md"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-end py-0">
                    <div class="dropdown-menu-header border-bottom">
                        <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Sucursales</h5>
                        <i class="fas fa-info-circle fs-4"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Cambiar de Sucursal"></i>
                        </div>
                    </div>
                    <div class="dropdown-shortcuts-list scrollable-container">
                        <li class="dropdown-notifications-list scrollable-container">
                            <ul class="list-group list-group-flush">
                                <!-- Si existe sucursal asignadas -->
                                <li class="list-group-item list-group-item-action dropdown-notifications-item pointer"
                                    v-for="(sucursal, index) in usuarioActual.sucursales" :key="index"
                                    @click="cambiarSucursal(sucursal.cod_sucursal)">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0 me-3"
                                            :title="usuarioActual.log_sucursal == sucursal.cod_sucursal ? 'Sucursal Actual' : 'Cambiar sucursal'">
                                            <div class="avatar">
                                                <span class="avatar-initial rounded-circle" 
                                                    :class="[
                                                        usuarioActual.log_sucursal == sucursal.cod_sucursal 
                                                            ? 'bg-label-success' 
                                                            : 'bg-label-primary'
                                                ]"><i class="ti ti-home"></i></span>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">{{sucursal.nombre}}</h6>
                                            <small class="text-muted">{{sucursal.email}}</small>
                                        </div>
                                    </div>
                                </li>
                                <!-- Si no hay sucursales -->
                                <li class="list-group-item list-group-item-action dropdown-notifications-item" 
                                    v-if="!usuarioActual.sucursales || usuarioActual.sucursales.length === 0">
                                    <p>No tienes sucursales asignadas. Por favor, solicita a administración la asignación de sucursales.</p>
                                </li>
                            </ul>
                        </li>
                    </div>
                </div>
            </li>
            <!-- Calendario -->
            <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0"
                v-if="usuarioPermisos.some(e=> [45].includes(e))">
                <router-link class="nav-link" to="/agenda" title="Agenda">
                    <i class="ti ti-md ti-calendar"></i>
                </router-link>
            </li>

            <!-- Usuario -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <img v-lazy="`/imagenes/usuarios/${usuarioActual.foto}`"
                        style="object-fit: cover; height: 100% !important; width: 100% !important;" 
                        alt="Perfil"
                        class="h-auto rounded-circle" />
                </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="#">
                    <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                        <div class="avatar avatar-online">
                            <img v-lazy="`/imagenes/usuarios/${usuarioActual.foto}`"
                                style="object-fit: cover; height: 100% !important; width: 100% !important;" 
                                alt="Perfil" 
                                class="h-auto rounded-circle" />
                        </div>
                        </div>
                        <div class="flex-grow-1">
                        <span class="fw-medium d-block">Hola, {{ usuarioActual.nombre + ' ' + usuarioActual.paterno }} </span>
                        <small class="text-muted">{{ usuarioActual.rol.descripcion }}</small>
                        </div>
                    </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <router-link class="dropdown-item" to="/perfil">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">Mi perfil</span>
                    </router-link>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="javascript:void(0);" @click="logout()">
                    <i class="ti ti-logout me-2 ti-sm"></i>
                    <span class="align-middle">Cerrar Sesión</span>
                    </a>
                </li>
                </ul>
            </li>
            <!--/ Usuario -->
        </ul>
    </div>

    <!-- Search Small Screens -->
    <div class="navbar-search-wrapper search-input-wrapper d-none">
        <input
        type="text"
        class="form-control search-input container-xxl border-0"
        placeholder="Search..."
        aria-label="Search..." />
        <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
    </div>
</nav>
</template>
<script>
    export default{
        name: 'navbar',
        computed: {
            /**
             * Obtiene los permisos del sillon logueado
             * @return {Array}
             */
            usuarioPermisos(){
                return this.$store.getters.usuarioPermisos
            },
            /**
             * Obtiene los datos del usuario logueado
             * @return {Object}
             */
            usuarioActual(){
                return this.$store.getters.usuarioActual;
            },
        },
        methods: {
            /**
             * Metodo para Cerrar Sesión
            **/
            logout(){
                let me = this;
                axios({
                    method:'post',
                    headers: {
                        'Authorization': `Bearer ${me.usuarioActual.token}`
                    },
                    url:'/api/logout'
                }).then(function (response) {
                    me.$noty.success("¡La sesión se cerró correctamente!", {
                        theme: 'metroui',
                        killer: true,
                        timeout: 5000,
                        layout: 'bottomRight'
                    });
                    me.$store.commit('cerrarSesion');
                    me.$router.push('/login');
                    // console.log(response); 
                }).catch(function (error) {
                    // console.log(error);
                    me.$noty.error("Error al cerrar sesion", {
                        theme: 'metroui',
                        killer: true,
                        timeout: 5000,
                        layout: 'bottomRight'
                    });
                });
            },
            /**
             * Cambiar sucursal
             */
            cambiarSucursal(cod_sucursal){
                let me = this;
                if(cod_sucursal != me.usuarioActual.log_sucursal){
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: '¿Realmente deseas cambiar de sucursal?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, cambiar',
                        cancelButtonText: 'Cancelar',
                        customClass: {
                            confirmButton: 'btn btn-primary me-3',
                            cancelButton: 'btn btn-label-secondary'
                        },
                        buttonsStyling: false
                    }).then((result) => {
                        if (result.value) {
                            me.loadingAlert();
                            
                            // Modifica el log_sucursal del BACKEND
                            axios({
                                method:'PUT',
                                url: `/api/usuario/cambia-sucursal/${me.usuarioActual.cod_usuario}`,
                                headers: {
                                    'Authorization': `Bearer ${me.usuarioActual.token}`,
                                },
                                data : {
                                    cod_sucursal: cod_sucursal
                                }
                            }).then(function (response) {
                                me.cargando = false;
                                Swal.fire({
                                    title: 'Mensaje!',
                                    text: response.data.message,
                                    icon: 'success',
                                    showConfirmButton: false,
                                    timer: 2000
                                }).then(() => {
                                    me.$store.dispatch('cambiarLogsucursal', cod_sucursal);
                                    if (me.$route.path != '/inicio') {
                                        me.$router.push('/inicio');
                                    }
                                    location.reload();
                                });
                            }).catch(function (error) {
                                me.cargando = false;
                                Swal.fire({
                                    title: 'Error',
                                    text: '¡Ups! Parece que ha ocurrido un error inesperado. Por favor, inténtalo nuevamente. Si el problema persiste, no dudes en ponerte en contacto con el administrador para obtener ayuda.',
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar',
                                    customClass: {
                                        confirmButton: 'btn btn-success'
                                    }
                                });
                            });


                        }
                    });
                }
            },
            /**
             * Loading de Sweet alert
             */
            loadingAlert(){
                Swal.fire({
                    title: 'Cambiando Sucursal...',
                    allowOutsideClick: false,
                    showCancelButton: false,
                    showConfirmButton: false,
                    html: `<div class="col-lg-12 d-flex justify-content-center align-items-center">
                                <div class="sk-wave sk-primary">
                                    <div class="sk-wave-rect"></div>
                                    <div class="sk-wave-rect"></div>
                                    <div class="sk-wave-rect"></div>
                                    <div class="sk-wave-rect"></div>
                                    <div class="sk-wave-rect"></div>
                                </div>
                            </div>`,
                });
            },
        }
    };
</script>