import Login from './components/auth/Login.vue';
import Inicio from './components/principal/Inicio.vue';
// Errores de Autorización y Paginas no encontradas
import Error from './components/error/404.vue';
import Error2 from './components/error/403.vue';

// Usuarios
import UsuarioMain from './components/usuario/Main.vue';
import UsuarioLista from './components/usuario/Lista.vue';
import UsuarioCrear from './components/usuario/Crear.vue';
import UsuarioEditar from './components/usuario/Editar.vue';

export const routes = [
	{
		path: '/login',
		component: Login
    },
    {
		path: '*',
		redirect: '/login'
	},
    {
    	path: '/inicio',
        component: Inicio,
        name: 'inicio',
    	meta: {
			requiresAuth: true
		}

    },
	// Usuario
    {
		path: '/usuario',
		component: UsuarioMain,
		meta: {
			requiresAuth: true
		},
		children: [
			{
                path: '/',
				component: UsuarioLista,
                name: 'usuarioLista',
			},
			{
                path: 'registrar',
				component: UsuarioCrear,
                name: 'usuarioCrear'
			},
			{
                path: 'editar/:id',
				component: UsuarioEditar,
                name: 'usuarioEditar',
			}
		]
	},
	// Pagina no encontrada
    {
    	path: '/404',
        component: Error,
        name: 'errorpage404',
    },
	// Sin Autorización
    {
    	path: '/403',
        component: Error2,
        name: 'errorpage403',
    	meta: {
			requiresAuth: true
		}
    },
];