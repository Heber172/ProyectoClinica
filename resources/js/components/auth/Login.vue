<template>
    <!-- Layout wrapper -->
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Login -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4 mt-2">
                        <a href="#" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <img v-lazy="'assets/img/branding/logoSistema.png'" alt="Logo Sistema" width="25" height="25">
                            </span>
                            <span class="app-brand-text demo text-body fw-bold">SARP-DentAI</span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-1 pt-2">Bienvenido! 👋</h4>

                    <form id="formAuthentication" class="mb-3" @submit.prevent="autenticar()">
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="text" 
                                    class="form-control" 
                                    :class="($v.usuario.email.$invalid && $v.usuario.email.$dirty)?'is-invalid':''"
                                    v-model="usuario.email"
                                    @keyup="$v.usuario.email.$touch()"
                                    id="email" 
                                    name="email" 
                                    placeholder="Ingrese correo electrónico" 
                                    autofocus />
                            <div class="text-danger" v-if="!$v.usuario.email.required && $v.usuario.email.$dirty">El campo es obligatorio</div>
                            <div class="text-danger" v-if="!$v.usuario.email.email && $v.usuario.email.$dirty">Por favor, ingrese un email válido</div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Contraseña</label>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" 
                                    class="form-control"
                                    :class="($v.usuario.password.$invalid && $v.usuario.password.$dirty)?'is-invalid':''"
                                    v-model="usuario.password"
                                    @keyup="$v.usuario.password.$touch()"
                                    id="password" 
                                    name="password" 
                                    placeholder="Ingrese contraseña" 
                                    aria-describedby="password"/>
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                            <div class="text-danger" v-if="!$v.usuario.password.required && $v.usuario.password.$dirty">El campo es obligatorio</div>
                            <div class="text-danger" v-if="!$v.usuario.password.minLength && $v.usuario.password.$dirty">La contraseña debe tener por lo menos {{ $v.usuario.password.$params.minLength.min }} caracteres</div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary w-100" type="submit" :disabled="$v.$invalid || cargando">
                                <span class="spinner-border me-1" role="status" aria-hidden="true" v-show="cargando"></span>
                                {{ textoBoton }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    <!-- / Layout wrapper -->
</template>
<script>
    import { required, email, minLength } from 'vuelidate/lib/validators';
    export default{
        name:'login',
        data(){
            return {
                usuario: {
                    email: '',
                    password: ''
                },
                cargando: false,
            };
        },
        computed: {
            /**
             * Realiza cambio de nombre de boton
             */
            textoBoton() {
                return this.cargando ? 'VERIFICANDO' : 'INGRESAR';
            },
        },
        validations: {
            usuario: {
                email: {
                    required, 
                    email
                },
                password: {
                    required,
                    minLength: minLength(6) 
                }
            }
        },
        methods:{
            /**
             * Función que realiza la autenticación
             */
            autenticar() {
                let me      = this;
                me.cargando = true;
                axios({
                    method: 'POST',
                    url: 'api/auth/login',
                    data: {
                        email: me.usuario.email,
                        password: me.usuario.password
                    }
                })
                .then((respuesta) => {
                    me.cargando = false;
                    me.$store.commit('loginExitoso', respuesta.data);
                    me.$router.push('/inicio'); // Redirecciona a INICIO
                    // Recargar la página actual
                    location.reload();
                }).catch((error) => {
                    me.cargando = false;
                    if (error.response && error.response.status === 401) {
                        toastr.error(
                            error.response.data.message, 
                            'Error!',
                            {
                                "progressBar": true,
                                "showMethod": "slideDown", 
                                "hideMethod": "slideUp",
                                positionClass: 'toast-top-right', 
                                containerId: 'toast-top-right' 
                            }
                        );
                    } else {
                        toastr.error(
                            'Ocurrió un error inesperado, inténtelo de nuevo.', 
                            'Error!',
                            {
                                "progressBar": true,
                                "showMethod": "slideDown", 
                                "hideMethod": "slideUp",
                                positionClass: 'toast-top-right', 
                                containerId: 'toast-top-right' 
                            }
                        );
                    }
                });
            },

        }
    }
</script>