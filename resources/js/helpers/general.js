/**
* Realiza la verificacion de acceso a rutas
* @author: Heber Mollericona
**/
export function inicializar(store, router){
    const permisosRequeridos = {
		// * DASHBOARD
        '/dashboard': [61],
		// * USUARIO
        '/usuario': [1],
        '/usuario/registrar': [2],
        '/usuario/editar/': [3],
		// * ROL
        '/rol': [5],
        '/rol/registrar': [6],
        '/rol/editar/': [7],
		// * PACIENTE
        '/paciente': [21],
        '/paciente/registrar': [22],
        '/paciente/editar/': [23],
		// * CLINICA
        '/clinica': [26],
		// * ESPECIALIDAD
        '/especialidad': [13],
		// * SERVICIO
        '/servicio': [17],
		// * SUCURSAL
        '/sucursal': [9],
        '/sucursal/registrar': [10],
        '/sucursal/editar/': [11],
        '/sucursal/asignar-usuario/': [32],
		// * SILLÓN
        '/sillon': [27],
		// * PLANIFICACIÓN
        '/planificacion-lista': [34],
		// * PAGOS
        '/pago': [57],
		// * AGENDA (CALENDARIO)
        '/agenda': [45],
		// * CITA MÉDICA
        '/cita-medica': [46],
		// * EVENTO
        '/evento': [53],
		// * REPORTE
        '/reporte': [66],
		// * CAJA
        '/reporte': [75],
		// * CUENTA
        '/reporte': [67],
		// * TIPO TRANSACCIÓN
        '/reporte': [71],
    };

	const verificarPermisos = (ruta, permisos) => {
        for (let path in permisosRequeridos) {
            if (ruta === path || (path.endsWith('/') && ruta.startsWith(path))) {
                return permisos.some(e => permisosRequeridos[path].includes(e));
            }
        }
        return true; // Permitir rutas que no requieren permisos especiales
    };

    router.beforeEach((to, from, next) => {
        const requiresAuth = to.matched.some(record => record.meta.requiresAuth);
        const usuarioActual = store.state.usuarioActual;

        // Ruta Inicial
        if (to.path === '/') {
            next({ path: '/login' });
            return;
        }

        /********************************
         * Verificación de Autenticación
         ********************************/
        if (requiresAuth && !usuarioActual) {
            next({ path: '/login' });
            return;
        }

        if (to.path === '/login' && usuarioActual) {
            next({ path: '/inicio' });
            return;
        }

        const permisos = JSON.parse(localStorage.getItem('permisos')) || [];
        if (verificarPermisos(to.path, permisos)) {
            next();
        } else {
            next({ path: '/403' });
            return;
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