import { obtenerUsuarioLocal } from './helpers/auth.js';
import { obtenerPermisosLocal } from './helpers/auth.js';

const usuario  = obtenerUsuarioLocal();
const permisos =  obtenerPermisosLocal();

export default {
	state: {
		usuarioActual: usuario,
		permisos: permisos,
		sesionActivaUsuario: false
	},
	getters: {
		/**
	       * Retorna si el usuario esta logueado
	       * Tipo: Boolean
	       * @autor: Heber Mollericona
	      **/
		sesionActivaUsuario(state){
			return state.sesionActivaUsuario; 
		},
		/**
	       * Retorna al usuario actual en el sistema
	       * Tipo: Object
	       * @autor: Heber Mollericona
	      **/
		usuarioActual(state){
			return state.usuarioActual;
		},
		/**
	       * Retorna permisos del usuario actual en el sistema
	       * Tipo: Array
	       * @autor: Heber Mollericona
	      **/
		usuarioPermisos(state){
			return state.permisos;
		}
	},
	mutations: {
		/**
	       * Realiza el guardado de los datos en el local STORAGE del usuario
	       * @autor: Heber Mollericona
	      **/
		loginExitoso(state, cuenta){
			state.sesionActivaUsuario = true;
			state.usuarioActual = Object.assign({}, cuenta.usuario, {token: cuenta.access_token});
			state.permisos 		= cuenta.permisos.map(e => e.cod_permiso);

			localStorage.setItem("usuario", JSON.stringify(state.usuarioActual));
			localStorage.setItem("permisos", JSON.stringify(state.permisos));
		},
		/**
	       * Realiza la eliminacion del usuario del local storage
	       * @autor: Heber Mollericona
	      **/
		cerrarSesion(state){
			localStorage.removeItem("usuario");
			localStorage.removeItem("permisos");
			state.sesionActivaUsuario = false;
			state.usuarioActual 	  = null;
		}
	},
	actions: {
		// Acción Vuex para actualizar el valor de log_sucursal en el estado de Vuex y en el almacenamiento local.
		// Parámetros:
		//   - context: Objeto de contexto de Vuex que proporciona acceso a state, getters, commit y dispatch.
		//   - nuevoValor: Nuevo valor que se asignará a log_sucursal.
		// Efecto:
		//   - Modifica el valor de log_sucursal en el estado de Vuex.
		//   - Actualiza el valor de log_sucursal en el almacenamiento local para persistir los cambios.
		// Autor: Heber Mollericona Miranda
		cambiarLogsucursal(context, nuevoValor) {
			// Modificar el valor en el estado de Vuex
			context.state.usuarioActual.log_sucursal = nuevoValor;

			// Actualizar el almacenamiento local
			const usuarioActualizado = Object.assign({}, context.state.usuarioActual);
			localStorage.setItem("usuario", JSON.stringify(usuarioActualizado));
		},


		iniciarSesion(context){
			context.commit('iniciarSesion');
		}
	}
}