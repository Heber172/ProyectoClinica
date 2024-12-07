<template>
    <div class="flex-grow-1 container-p-y container-fluid pt-0">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
            <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                <h4 class="mb-2">Roles y Permisos</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-t"><b>Lista de Roles y Permisos</b>
                    </li>
                </ol>
            </div>
            <div class="d-flex align-content-center flex-wrap gap-2">
                <router-link class="btn btn-success btn-md waves-effect waves-light" to="/rol/registrar" v-if="usuarioPermisos.includes(6)">
                    <i class="feather icon-plus"></i> Nuevo Rol
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
                            <table class="table table-hover" v-show="!loader">
                                <thead style="background-color: #f8f8f8;">
                                    <!-- <tr>
                                        <template v-for="(column, index) in columns">
                                            <th class="pointer" 
                                                    v-if="column.sortable" 
                                                    @click="changeSort(column.field)" 
                                                    :class="[column.align]" 
                                                    :style="{ width: column.width + '%' }">
                                                {{ column.label }}
                                                <i v-if="sort_field === column.field" 
                                                :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                            </th>
                                            <th v-else 
                                                    :class="[column.align]" 
                                                    :style="{ width: column.width }">
                                                {{ column.label }}
                                            </th>
                                        </template>
                                    </tr> -->
                                    <tr>
                                        <th class="pointer" style="width: 5%;"
                                            @click="changeSort('cod_rol')">
                                            #
                                            <i v-if="sort_field === 'cod_rol'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer" style="width: 75%;"
                                            @click="changeSort('descripcion')">
                                            Descripción
                                            <i v-if="sort_field === 'descripcion'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="pointer text-center" style="width: 10%;"
                                            @click="changeSort('cod_estado')">
                                            Estado
                                            <i v-if="sort_field === 'cod_estado'" 
                                            :class="sort_direction === 'desc' ? 'fa-solid fa-arrow-down-short-wide' : 'fa-solid fa-arrow-up-wide-short'"></i>
                                        </th>
                                        <th class="text-center" style="width: 10%;" v-if="usuarioPermisos.some(e=> [7, 8].includes(e))">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Mostrar mensaje cuando no hay registros -->
                                    <tr v-if="roles && roles.data && roles.data.length === 0">
                                        <td colspan="4" class="text-center">
                                            <div class="alert alert-default" role="alert">
                                                <i class="fa-solid fa-exclamation-triangle"></i> No se encontraron registros ...
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- Lista de Registros -->
                                    <tr v-for="(rol, index) in roles.data" :key="index">
                                        <td>{{ rol.cod_rol }}</td>
                                        <td>{{ rol.descripcion }}</td>
                                        <td class="text-center">
                                            <span :class="['badge', 'bg-label-' + rol.estado.color]">{{ rol.estado.nombre }}</span>
                                        </td>
                                        <td class="text-center" style="padding-top: 0px;padding-bottom: 0px;">
                                            <!-- Estado -->
                                            <button type="button" class="btn btn-icon btn-sm btn-success" title="Activar"
                                                    v-if="rol.cod_estado !=1 && usuarioPermisos.includes(8)" 
                                                    @click="cambiarEstado(rol.cod_rol)">
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-icon btn-sm btn-danger" title="Desactivar"
                                                    v-if="rol.cod_estado === 1 && usuarioPermisos.includes(8)" 
                                                    @click="cambiarEstado(rol.cod_rol)">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                            <!-- Editar -->
                                            <router-link class="btn btn-icon btn-sm btn-twitter" title="Editar" 
                                                    :to="`/rol/editar/${rol.cod_rol}`"
                                                    v-if="usuarioPermisos.includes(7)">
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
                                <pagination :data="roles" @pagination-change-page="listarRegistros" :limit="2"></pagination>
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
                roles:{},
                loader: false,
                paginate: 10,
                search: "",
                doneTypingInterval: 500,
                // columns: [
                //     { label: '#', field: 'cod_usuario', align: '', sortable: true, width: '5' },
                //     { label: 'Descripción', field: 'descripcion', align: '', sortable: true, width: '75' },
                //     { label: 'Estado', field: 'cod_estado', align: 'text-center', sortable: true, width: '10' },
                //     { label: 'Acciones', field: '', align: 'text-center', sortable: false, width: '10' },
                // ],
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
             * @autor: Ronald Mollericona
             */
            listarRegistros(page = 1){
                let me = this;
                me.loader = true;
                axios({
                    method:'GET',
                    headers: {
                        'Authorization': `Bearer ${me.usuarioActual.token}`
                        },
                    url: `api/rol/lista?page=${page}`
                    + "&paginate=" + me.paginate
                    + "&q=" + me.search
                    + "&sort_direction=" + me.sort_direction
                    + "&sort_field=" + me.sort_field
                })
                .then((response) => {
                    me.roles  = response.data.roles;
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
             * @autor: Ronald Mollericona Miranda
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
                            url: `api/rol/estado/${id}`
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