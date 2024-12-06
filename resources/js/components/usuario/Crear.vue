<template>
    <div class="flex-grow-1 container-p-y container-fluid pt-0">
        <h4 class="mb-2">Usuarios</h4>
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-2">
            <div class="d-flex flex-column justify-content-center gap-2 gap-sm-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item text-t">
                        <router-link to="/usuario" style="color: black;">Lista de Usuarios</router-link>
                    </li>
                    <li class="breadcrumb-item text-t"><b>Nuevo Usuario</b>
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
                                        <!-- DATOS GENERALES -->
                                        <div class="form-group col-lg-12 mb-2" style="background-color: #f2f2f2; padding: 10px; border-radius: 5px; display: flex; align-items: center;">
                                            <div style="flex-grow: 1;">
                                                <h5 class="card-title mb-1 font-medium-2" style="margin-bottom: 0;">
                                                    <i class="fas fa-user text-success"></i> Datos Personales
                                                </h5>
                                            </div>
                                            <div style="display: flex; align-items: center;">
                                                <label for="color" style="display: flex; align-items: center; margin-right: 5px; font-weight: bold;">
                                                    <i class="fas fa-palette text-primary" style="margin-right: 5px;"></i> Agenda:
                                                </label>
                                                <input type="color" id="color" v-model="usuario.color" class="form-control" style="width: 50px;">
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="d-flex justify-content-center align-items-center">
                                                <div class="form-group col-lg-12 mb-3 text-center">
                                                    <img v-bind:src="usuario.foto" alt="Logo"
                                                        style="height: 150px; width: 150px; object-fit: cover;"><br>
                                                    <button type="button" class="btn btn-primary btn-sm mr-1 mb-1 mt-2 waves-effect waves-light" @click="openFileInputPerfil">
                                                        Cambiar
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-sm mb-1 mt-2 waves-effect waves-light" @click="quitarImagen">
                                                        Quitar
                                                    </button>
                                                    <input type="file" accept="image/*" ref="fileInputLogo" id="foto" @change="handleFileChangeLogo" class="form-control" style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10 row">
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Nombre:</label>
                                                <input type="text" autocomplete="off" id="nombre" name="nombre" class="form-control" placeholder="Introduzca nombre"
                                                v-model="usuario.nombre" 
                                                :class="{
                                                    'is-invalid': $v.usuario.nombre.$invalid && $v.usuario.nombre.$dirty
                                                }"
                                                @keyup="$v.usuario.nombre.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.nombre.required && $v.usuario.nombre.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.nombre.minLength && $v.usuario.nombre.$dirty">Ingrese mínimo {{ $v.usuario.nombre.$params.minLength.min }} caracteres</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Apellido Paterno:</label>
                                                <input type="text" autocomplete="off" id="paterno" name="paterno" class="form-control" placeholder="Introduzca apellido paterno"
                                                v-model="usuario.paterno" 
                                                :class="{
                                                    'is-invalid': $v.usuario.paterno.$invalid && $v.usuario.paterno.$dirty
                                                }"
                                                @keyup="$v.usuario.paterno.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.paterno.required && $v.usuario.paterno.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.paterno.minLength && $v.usuario.paterno.$dirty">Ingrese mínimo {{ $v.usuario.paterno.$params.minLength.min }} caracteres</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Apellido Materno:</label>
                                                <input type="text" autocomplete="off" id="materno" name="materno" class="form-control" placeholder="Introduzca apellido materno"
                                                v-model="usuario.materno" 
                                                :class="{
                                                    'is-invalid': $v.usuario.materno.$invalid && $v.usuario.materno.$dirty
                                                }"
                                                @keyup="$v.usuario.materno.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.materno.required && $v.usuario.materno.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.materno.minLength && $v.usuario.materno.$dirty">Ingrese mínimo {{ $v.usuario.materno.$params.minLength.min }} caracteres</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">CI:</label>
                                                <input type="number" autocomplete="off" id="ci" name="ci" class="form-control" placeholder="Introduzca cédula de identidad"
                                                v-model="usuario.ci" 
                                                :class="{
                                                    'is-invalid': $v.usuario.ci.$invalid && $v.usuario.ci.$dirty
                                                }"
                                                @keyup="$v.usuario.ci.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.ci.required && $v.usuario.ci.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.ci.minLength && $v.usuario.ci.$dirty">Ingrese mínimo {{ $v.usuario.ci.$params.minLength.min }} caracteres</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Rol:</label>
                                                <v-select
                                                    v-model="usuario.cod_rol"
                                                    :options="roles"
                                                    placeholder="Seleccione Rol"
                                                    @input="$v.usuario.cod_rol.$touch()">
                                                </v-select>
                                                <div class="text-danger" v-if="!$v.usuario.cod_rol.required && $v.usuario.cod_rol.$dirty">El campo es obligatorio</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Correo Eletrónico:</label>
                                                <input type="text" autocomplete="off" id="email" name="email" class="form-control" placeholder="Introduzca email"
                                                v-model="usuario.email" 
                                                :class="{
                                                    'is-invalid': $v.usuario.email.$invalid && $v.usuario.email.$dirty
                                                }"
                                                @keyup="$v.usuario.email.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.email.required && $v.usuario.email.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.email.email && $v.usuario.email.$dirty">Por favor, ingrese un email valido</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Celular/Teléfono:</label>
                                                <input type="tel" autocomplete="off" id="telefono" name="telefono" class="form-control" placeholder="Introduzca número de celular"
                                                v-model="usuario.telefono" 
                                                :class="{
                                                    'is-invalid': $v.usuario.telefono.$invalid && $v.usuario.telefono.$dirty
                                                }"
                                                @keyup="$v.usuario.telefono.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.telefono.required && $v.usuario.telefono.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.telefono.minLength && $v.usuario.telefono.$dirty">Ingrese mínimo {{ $v.usuario.telefono.$params.minLength.min }} caracteres</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Fecha de Nacimiento:</label>
                                                <input type="date" autocomplete="off" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" placeholder="Introduzca fecha de nacimiento"
                                                v-model="usuario.fecha_nacimiento" 
                                                :class="{
                                                    'is-invalid': $v.usuario.fecha_nacimiento.$invalid && $v.usuario.fecha_nacimiento.$dirty
                                                }"
                                                @change="$v.usuario.fecha_nacimiento.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.fecha_nacimiento.required && $v.usuario.fecha_nacimiento.$dirty">El campo es obligatorio</div>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Género:</label>
                                                <ul class="list-unstyled mb-0">
                                                    <li class="d-inline-block mr-2">
                                                        <div class="form-check">
                                                            <input name="genero" class="form-check-input" type="radio" value="1" id="defaultRadio1" v-model="usuario.genero">
                                                            <label class="form-check-label" for="defaultRadio1"> Masculino </label>
                                                        </div>
                                                    </li>
                                                    <li class="d-inline-block mr-2">
                                                        <div class="form-check">
                                                            <input name="genero" class="form-check-input" type="radio" value="2" id="defaultRadio2" v-model="usuario.genero">
                                                            <label class="form-check-label" for="defaultRadio2"> Femenino </label>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="form-group col-lg-4 mb-3">
                                                <span class="text-danger">*</span>
                                                <label class="text-show">Dirección:</label>
                                                <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Introduzca ubicación / Zona, Calle y Nro"
                                                v-model="usuario.direccion" 
                                                :class="{
                                                    'is-invalid': $v.usuario.direccion.$invalid && $v.usuario.direccion.$dirty
                                                }"
                                                @keyup="$v.usuario.direccion.$touch()">
                                                <div class="text-danger" v-if="!$v.usuario.direccion.required && $v.usuario.direccion.$dirty">El campo es obligatorio</div>
                                                <div class="text-danger" v-if="!$v.usuario.direccion.minLength && $v.usuario.direccion.$dirty">Ingrese mínimo {{ $v.usuario.direccion.$params.minLength.min }} caracteres</div>
                                            </div>
                                        </div>


                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start text-right mt-3">
                                            <div class="d-flex align-content-center flex-wrap gap-2">
                                                <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" 
                                                    @click="guardarRegistro()" 
                                                    :disabled="$v.$invalid || cargando">
                                                    <span class="spinner-border me-1" role="status" aria-hidden="true" v-show="cargando"></span> 
                                                    {{ textoBoton }}
                                                </button>
                                                <router-link to="/usuario" class="btn btn-default mr-1 mb-1 waves-effect waves-light">Cancelar</router-link>
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
    import { required, email,between, minLength} from 'vuelidate/lib/validators';

    export default{
        name: 'nuevo-registro',
        data(){
            return {
                usuario: {
                    nombre: '',
                    paterno: '',
                    materno: '',
                    ci: '',
                    cod_rol: null,
                    email: '',
                    telefono: '',
                    fecha_nacimiento: '',
                    genero: 1,
                    codigo: '',
                    direccion: '',
                    foto: '/imagenes/usuarios/default.png',
                    sucursales:[],
                    especialidades:[],
                    color: '#7367f0'
                },
                roles:[],
                tipos:[],
                sucursales:[],
                especialidades:[],
                loader: false,
                cargando: false,
                alertaCodigo:false
            };
        },
        validations: {
            usuario: {
                nombre: {
                    required,
                    minLength: minLength(3)
                },
                paterno: {
                    required,
                    minLength: minLength(3)
                },
                materno: {
                    required,
                    minLength: minLength(3)
                },
                ci: {
                    required,
                    minLength: minLength(6)
                },
                cod_rol: {
                    required,
                },
                email: {
                    required,
                    email
                },
                telefono: {
                    required,
                    minLength: minLength(6)
                },
                fecha_nacimiento: {
                    required
                },
                genero: {
                    between: between(1, 100)
                },
                direccion: {
                    required,
                    minLength: minLength(6)
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
            }
        },
        watch:{
            // Captura Valor cmabiado en el select
            'usuario.cod_rol': function(newValue, oldValue) {
                // console.log('Nuevo valor de cod_rol:', newValue);
            },
        },
        mounted(){
            /**
             * Carga lo necesario para el formulario
             */
            this.preparaFormulario();
        },
        methods:{
            /**
             * (Foto) Quita imagen
             */
            quitarImagen() {
                this.usuario.foto = '/imagenes/usuarios/default.png';
            },
            /**
             * (Foto) Esta función se llama cuando se hace clic en el botón "Cambiar Logo"
             */
            openFileInputPerfil() {
                this.$refs.fileInputLogo.click();
            },
            /**
             * (Foto) Esta función se llama cuando se selecciona un archivo
             */
            handleFileChangeLogo(event) {
                const file = event.target.files[0];
                
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.usuario.foto = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            },
            /**
             * Limpiar input Alerts
             */
            limpiarAlertaCodigo(){
                this.alertaCodigo = false;
            },
            /**
             * Preparación de Formulario.
             * Tipos GET
             * URL: api/usuario/crear
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
                    url: `/api/usuario/crear`
                }).then((response) => {
                    me.loader = false;
                    me.tipos          = response.data.tipos;
                    me.sucursales     = response.data.sucursales;
                    me.especialidades = response.data.especialidades;
                    // me.roles = response.data.roles;
                    me.roles  = response.data.roles.map((rol) => {
                                    return {
                                        value: rol.cod_rol,
                                        label: rol.descripcion,
                                    };
                                });
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
             * URL: api/usuario/guardar/{id}
             * @autor: Ronald Mollericona Miranda
             */
            guardarRegistro(){
                let me = this;
                                
                me.cargando = true;
                // Prepara datos de envio (Preferencia FORMDATA: envio archivos)
                let formData = new FormData();
                formData.append('nombre', me.usuario.nombre || '');
                formData.append('paterno', me.usuario.paterno || '');
                formData.append('materno', me.usuario.materno || '');
                formData.append('ci', me.usuario.ci || '');
                formData.append('cod_rol', me.usuario.cod_rol.value || '');
                formData.append('email', me.usuario.email || '');
                formData.append('telefono', me.usuario.telefono || '');
                formData.append('fecha_nacimiento', me.usuario.fecha_nacimiento || '');
                formData.append('genero', me.usuario.genero || '');
                formData.append('codigo', me.usuario.codigo || '');
                formData.append('direccion', me.usuario.direccion || '');
                formData.append('foto', $('#foto')[0].files[0]);
                formData.append('color', me.usuario.color || '');

                axios({
                    method:'POST',
                    headers: {
                        'Authorization': `Bearer ${me.usuarioActual.token}`
                    },
                    url: `/api/usuario/guardar`,
                    data : formData
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
                        me.$router.push('/usuario');
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