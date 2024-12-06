/**
* Realiza la verificacion de acceso a rutas
* @author: Heber Mollericona
**/
export function inicializar(store, router){
	router.beforeEach((to, from, next) => {
		const requiresAuth  = to.matched.some(record => record.meta.requiresAuth);
		const usuarioActual = store.state.usuarioActual;
		// Ruta Inicial
		if (to.path === '/') {
			// Usuario no autenticado, redirigir a la página de inicio de sesión
			next({ path: '/login' });
		}
		/********************************
		 * Verificación de Autenticación
		 ********************************/
		if (requiresAuth && !usuarioActual) {
			// Usuario no autenticado, redirigir a la página de inicio de sesión
			next({ path: '/login' });
		} else {
			// Usuario autenticado, continuar la navegación
			if (to.path === '/login' && usuarioActual) {
				// Redirigir a la página de inicio si el usuario está autenticado
				next({ path: '/inicio' });
			} else {
				// Continuar la navegación normalmente
			 	next();
			}
		}
		/*******************************
		 * Rutas de Gestión del Sistema
		 *******************************/
		// Dashboard
		// if (to.path === '/inicio') {
		// 	next();
		// }
		// Usuario
		if (to.path === '/usuario') {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [1].includes(e))) {
			  	next();
			} else {
				next({ path: '/403' });
			}
		} else if (to.path === '/usuario/registrar') {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [2].includes(e))) {
			  	next();
			} else {
			  	next({ path: '/403' });
			}
		} else if (to.path.startsWith('/usuario/editar/')) {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [3].includes(e))) {
			  	next();
			} else {
			  	next({ path: '/403' });
			}
		}
		// Rol
		if (to.path === '/rol') {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [5].includes(e))) {
			  	next();
			} else {
				next({ path: '/403' });
			}
		} else if (to.path === '/rol/registrar') {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [6].includes(e))) {
			  	next();
			} else {
			  	next({ path: '/403' });
			}
		} else if (to.path.startsWith('/rol/editar/')) {
			if (JSON.parse(localStorage.getItem('permisos')).some(e => [7].includes(e))) {
			  	next();
			} else {
			  	next({ path: '/403' });
			}
		}
	});

	axios.interceptors.response.use(null, (error) => {
		if(error.response.status == 401){
			store.commit('cerrarSesion');
			// En caso de estar en el login no se efectua la acción
			if(router.currentRoute.path !== '/login'){
				router.push('/login');
			}
		}
		return Promise.reject(error);
	});
}