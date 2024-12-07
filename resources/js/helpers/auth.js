/**
 * Obtiene al usuario guardado en el local storage del navegador
 * @author: Heber Mollericona
 **/
export function obtenerUsuarioLocal() {
    const usuarioStr = localStorage.getItem('usuario');
    return usuarioStr ? JSON.parse(usuarioStr) : null;
}

/**
 * Obtiene los permisos almacenados en el localStorage del navegador.
 * @author: Heber Mollericona
 */
export function obtenerPermisosLocal() {
    const permisosStr = localStorage.getItem('permisos');
    return permisosStr ? JSON.parse(permisosStr) : null;
}