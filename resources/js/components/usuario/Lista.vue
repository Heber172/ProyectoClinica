<template>
    <div class="flex-grow-1 container-p-y container-fluid pt-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
            <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                <h4 class="mb-2">Usuarios</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-t"><b>Lista de Usuarios</b>
                    </li>
                </ol>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <router-link class="btn btn-success btn-md waves-effect waves-light" to="/usuario/registrar" v-if="usuarioPermisos.includes(2)">
                    <i class="feather icon-plus"></i> Nuevo Usuario
                </router-link>
            </div>
        </div>
        <!-- Role cards -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-datatable table-responsive p-3">
                        <!-- Inicio Filtro -->
                        <div class="row g-3 pb-3 pt-2">
                            <div class="col-md-2">
                                <div class="input-group">
                                    <label class="input-group-text">Mostrar:</label>
                                    <select class="form-select form-control-sm" v-model="paginate" title="Selecciona la cantidad de filas a mostrar">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                                    <label class="col-md-7 col-form-label text-sm-end">Buscar:</label>
                                    <div class="col-md-5">
                                        <input type="text" class="form-control" placeholder="Escribe aquí para buscar..." v-model="search"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Loader -->
                        <loader-two v-show="loader" :height="350" class="pt-5"></loader-two>
                        <!-- Lista -->
                        <transition name="fade">
                            <table class="table table-hover table-responsive" v-show="!loader">
                                <thead style="background-color: #f8f8f8;">
                                    <tr>
                                        <th class="pointer" style="width: 5%;"
                                            @click="changeSort('cod_usuario')">
                                            #
                                            <i v-if="sort_field === 'cod_usuario'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer" style="width: 30%;"
                                            @click="changeSort('nombre')">
                                            Nombre Completo
                                            <i v-if="sort_field === 'nombre'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer" style="width: 5%;"
                                            @click="changeSort('ci')">
                                            CI
                                            <i v-if="sort_field === 'ci'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer" style="width: 15%;"
                                            @click="changeSort('email')">
                                            Email
                                            <i v-if="sort_field === 'email'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer" style="width: 20%;"
                                            @click="changeSort('cod_rol')">
                                            Rol
                                            <i v-if="sort_field === 'cod_rol'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer text-center" style="width: 5%;"
                                            @click="changeSort('cod_estado')">
                                            Estado
                                            <i v-if="sort_field === 'cod_estado'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="text-center" style="width: 10%;" v-if="usuarioPermisos.some(e=> [3, 4].includes(e))">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mostrar mensaje cuando no hay registros -->
                                    <tr v-if="usuarios && usuarios.data && usuarios.data.length === 0">
                                        <td colspan="8" class="text-center">
                                            <div class="alert alert-default" role="alert">
                                                <i class="fa-solid fa-exclamation-triangle"></i> No se encontraron registros ...
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Lista de Registros -->
                                    <tr v-for="(usuario, index) in usuarios.data" :key="index">
                                        <td>{{ usuario.cod_usuario }}</td>
                                        <td>
                                            <div class="d-flex justify-content-start align-items-center">
                                                <div class="avatar me-3 avatar-sm">
                                                    <img 
                                                        v-lazy="`/imagenes/usuarios/${usuario.foto}`" 
                                                        :alt="usuario.nombre" 
                                                        class="rounded-circle" 
                                                        style="height: 25px; width: 25px;">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0">{{ usuario.nombre + " " + usuario.paterno + " " + usuario.materno }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ usuario.ci }}</td>
                                        <td>{{ usuario.email }}</td>
                                        <td>{{ usuario.rol.descripcion }}</td>
                                        <td class="text-center">
                                            <span :class="['badge', 'bg-label-' + usuario.estado.color]">{{ usuario.estado.nombre }}</span>
                                        </td>
                                        <td class="text-center" style="padding-top: 0px;padding-bottom: 0px;">
                                            <!-- Estado -->
                                            <button type="button" class="btn btn-icon btn-sm btn-success" title="Activar"
                                                    v-if="usuario.cod_estado != 1 && usuarioPermisos.includes(4)" 
                                                    @click="cambiarEstado(usuario.cod_usuario)">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-sm btn-danger" title="Desactivar"
                                                    v-if="usuario.cod_estado == 1 && usuarioPermisos.includes(4)" 
                                                    @click="cambiarEstado(usuario.cod_usuario)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <!-- Editar -->
                                            <router-link class="btn btn-icon btn-sm btn-twitter" title="Editar" 
                                                    :to="`/usuario/editar/${usuario.cod_usuario}`"
                                                    v-if="usuarioPermisos.includes(3)">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </router-link>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </transition>
                        <!-- Paginación -->
                        <div class="demo-inline-spacing" style="display:flex; justify-content: center;">
                            <nav aria-label="Page navigation">
                                <pagination :data="usuarios" @pagination-change-page="listarRegistros" :limit="2"></pagination>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        
        data(){
            return {
                usuarios:{},
                loader: false,
                paginate: 10,
                search: "",
                doneTypingInterval: 500,
                sort_direction: 'desc',
                sort_field: 'created_at'
            }
        },
        mounted(){
            // Llama función y obtiene los registros
            this.listarRegistros();
        },
        computed: {
            /**
             * Obtiene los permisos del usuario logueado
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
                return this.$store.getters.usuarioActual
            }
        },
        watch:{
            // Paginación de Lista de Registro
            paginate: function(value){
                this.listarRegistros();
            },
            search: function() {
                clearTimeout(this.typingTimer); // Reinicia el temporizador en cada cambio, cuando deje de escribir se hace la busqueda
                this.typingTimer = setTimeout(() => {
                    this.listarRegistros();
                }, this.doneTypingInterval);
            }
        },
        methods:{
            /**
             * Metodo para listar todo los datos.
             * Tipos GET
             * @autor: Heber Mollericona
             */
            listarRegistros(page = 1){
                let me = this;
                me.loader = true;
                axios({
                    method:'GET',
                    headers: {
                        'Authorization': `Bearer ${me.usuarioActual.token}`
                        },
                    url: `api/usuario/lista?page=${page}`
                    + "&paginate=" + me.paginate
                    + "&q=" + me.search
                    + "&sort_direction=" + me.sort_direction
                    + "&sort_field=" + me.sort_field
                })
                .then((response) => {
                    me.usuarios = response.data.usuarios;
                    me.loader = false;
                })
                .catch((error) => {
                    me.loader = false;
                    // console.log(error);
                    Swal.fire({
                        title: 'Error',
                        text: 'Ocurrió un error inesperado, por favor inténtelo nuevamente.',
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        customClass: {
                            confirmButton: 'btn btn-success'
                        }
                    });
                });
            },
            /**
             * Ordena la lista de registros
             */
            changeSort(field){
                let me = this;
                if(me.sort_field == field){
                    me.sort_direction = me.sort_direction == 'asc' ? 'desc' : 'asc';
                }else{
                    me.sort_direction = 'desc';
                    me.sort_field     = field;
                }
                me.listarRegistros();
            },
            /**
             * Metodo para cambiar el estado del datos tanto para activarlo y desactivarlo.
             * Tipos PUT
             * @autor: Heber Mollericona Miranda
             */
            cambiarEstado(id){
                let me = this;
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "Esta acción modificará el estado del registro.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    customClass: {
                        confirmButton: 'btn btn-primary me-3',
                        cancelButton: 'btn btn-label-secondary'
                    },
                    buttonsStyling: false
                }).then(function (result) {
                    if (result.value) {
                        axios({
                            method:'PUT',
                            headers: {
                                'Authorization': `Bearer ${me.usuarioActual.token}`
                            },
                            url: `api/usuario/estado/${id}`
                        })
                        .then((response) => {
                            me.listarRegistros();
                            Swal.fire({
                                title: 'Mensaje!',
                                text: response.data.message,
                                icon: 'success',
                                showConfirmButton: false,
                                timer: 1500
                            });
                        })
                        .catch((error) => {
                            Swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error inesperado, por favor inténtelo nuevamente.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar',
                                customClass: {
                                    confirmButton: 'btn btn-success'
                                }
                            });
                        });
                    }
                });
            },
        }
    }
</script>