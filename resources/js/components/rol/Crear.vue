<template>
    <div class="flex-grow-1 container-p-y container-fluid pt-0">
        <h4 class="mb-2">Roles y Permisos</h4>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
            <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-t">
                        <router-link to="/rol" style="color: black;">Lista de Roles y Permisos</router-link>
                    </li>
                    <li class="breadcrumb-item text-t"><b>Nuevo Rol</b>
                    </li>
                </ol>
            </div>
        </div>

        <div class="app-ecommerce">
            <div class="row">
                <div class="col-12 col-lg-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <loader-two v-show="loader" :height="300" class="pt-5"></loader-two>
                            <transition name="fade">
                                <div class="form-body" v-show="!loader">
                                    <div class="row">
                                        <div class="form-group col-md-12 mb-3">
                                            <span class="text-danger">*</span>
                                            <label class="text-show">Descripción:</label>
                                            <input type="text" autocomplete="off" id="descripcion" name="descripcion" class="form-control" placeholder="Introduzca descripción del Rol"
                                            v-model="rol.descripcion" 
                                            :class="{
                                                'is-invalid': $v.rol.descripcion.$invalid && $v.rol.descripcion.$dirty
                                            }"
                                            @keyup="$v.rol.descripcion.$touch()">
                                            <div class="text-danger" v-if="!$v.rol.descripcion.required && $v.rol.descripcion.$dirty">El campo es obligatorio</div>
                                            <div class="text-danger" v-if="!$v.rol.descripcion.minLength && $v.rol.descripcion.$dirty">Ingrese mínimo {{ $v.rol.descripcion.$params.minLength.min }} caracteres</div>
                                        </div>
                                        
                                        <div class="form-group col-md-12">
                                            <span class="text-danger">*</span>
                                            <label class="text-show">Seleccione permisos:</label>
                                            <div class="text-danger" v-if="!$v.rol.permisos.required && $v.rol.permisos.$dirty">Elija por lo menos un permiso</div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="custom-control custom-switch my-2" v-for="permiso in primeraPermisos" :key="permiso.cod_permiso">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <div class="form-check form-switch mb-2">
                                                                <input class="form-check-input" type="checkbox" 
                                                                :id="'customSwitch'+permiso.cod_permiso" 
                                                                :value="permiso.cod_permiso"
                                                                v-model="rol.permisos" 
                                                                @change="$v.rol.permisos.$touch()"/>
                                                                <label class="form-check-label" :for="'customSwitch'+permiso.cod_permiso">
                                                                    {{ permiso.descripcion }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            {{ permiso.modulo }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="custom-control custom-switch my-2" v-for="permiso in segundaPermisos" :key="permiso.cod_permiso">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <div class="form-check form-switch mb-2">
                                                                <input class="form-check-input" type="checkbox"
                                                                :id="'customSwitch'+permiso.cod_permiso" 
                                                                :value="permiso.cod_permiso"
                                                                v-model="rol.permisos" 
                                                                @change="$v.rol.permisos.$touch()"/>
                                                                <label class="form-check-label" :for="'customSwitch'+permiso.cod_permiso">
                                                                    {{ permiso.descripcion }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            {{ permiso.modulo }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-right">
                                            <div class="d-flex align-content-center flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" 
                                                    @click="guardarRegistro()" 
                                                    :disabled="$v.$invalid || cargando">
                                                    <span class="spinner-border me-1" role="status" aria-hidden="true" v-show="cargando"></span> 
                                                    {{ textoBoton }}
                                                </button>
                                                <router-link to="/rol" class="btn btn-default mr-1 mb-1 waves-effect waves-light">Cancelar</router-link>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { required, minLength} from 'vuelidate/lib/validators';

    export default{
        name: 'nuevo-registro',
        data(){
            return {
                rol: {
                    descripcion: '',
                    permisos: []
                },
                permisos: [],
                loader: false,
                cargando: false,
            };
        },
        validations: {
            rol: {
                descripcion: {
                    required,
                    minLength: minLength(3)
                },
                permisos: {
                    required
                },
            }
        },
        computed: {
            /**
             * Realiza cambio de nombre de boton
             */
            textoBoton() {
                return this.cargando ? 'Guardando' : 'Guardar';
            },
            /**
             * Obtiene los datos del usuario logueado
             * @return {Array Object}
             */
            usuarioActual(){
                return this.$store.getters.usuarioActual
            },
            /**
             * Primera mitad de los permisos
             */
            primeraPermisos() {
                return this.permisos.slice(0, Math.ceil(this.permisos.length / 2));
            },
            /**
             * Segunda mitad de los permisos
             */
            segundaPermisos() {
                return this.permisos.slice(Math.ceil(this.permisos.length / 2));
            }
        },
        mounted(){
            /**
             * Carga lo necesario para el formulario
             */
            this.preparaFormulario();
        },
        methods:{
            /**
             * Preparación de Formulario.
             * Tipos GET
             * URL: api/rol/crear
             * @autor: Ronald Mollericona
             */
            preparaFormulario() {
                let me = this;
                me.loader = true;
                axios({
                    method:'get',
                    headers: {
                        'Authorization': `Bearer ${this.usuarioActual.token}`
                    },
                    url: `/api/rol/crear`
                }).then((response) => {
                    me.loader   = false;
                    me.permisos = response.data.permisos;
                }).catch(function (error) {
                    // console.log(error);
                    me.loader = false;
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
             * Metodo para guardar los datos del registro
             * Tipo: POST
             * URL: api/rol/guardar/{id}
             * @autor: Ronald Mollericona Miranda
             */
            guardarRegistro(){
                let me = this;
                me.cargando = true;
                axios({
                    method:'POST',
                    headers: {
                        'Authorization': `Bearer ${me.usuarioActual.token}`
                    },
                    url: `/api/rol/guardar`,
                    data : me.rol
                })
                .then(function (response) {
                    me.cargando = false;
                    Swal.fire({
                        title: 'Mensaje!',
                        text: response.data.message,
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 2000
                    }).then(() => {
                        me.$router.push('/rol');
                    });
                }).catch(function (error) {
                    me.cargando = false;
                    if(error.response.status == 422){
                        me.errors = error.response.data.errors;
                        Swal.fire({
                            title: 'Error',
                            text: 'Algunos datos ya existen en nuestra base de datos.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }else{
                        Swal.fire({
                            title: 'Error',
                            text: 'Ocurrió un error inesperado, por favor inténtelo nuevamente.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                            customClass: {
                                confirmButton: 'btn btn-success'
                            }
                        });
                    }
                });
            }
        }
    }
</script>