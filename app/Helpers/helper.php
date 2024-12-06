<?php

use App\Models\Especialidad;
use App\Models\Configuracion;
use App\Models\Planificacion;
use App\Models\PlanificacionServicio;
use App\Models\LogPlanificacion;
use App\Models\LogPlanificacionServicio;
use App\Models\Evaluacion;
use App\Models\Evolucion;
use App\Models\SucursalHorario;
use App\Models\Agenda;
use App\Models\Evento;
use App\Models\PagoServicio;
use App\Models\Transaccion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * Generamos codigo para la tabla de especialidades
 */
function codigoEspecialidad($especialidad){
    $codigo = "";
    $exp = explode(' ', $especialidad);
    if(count($exp)<2){
        $codigo = strtoupper(substr($exp[0],0,3));
    }else{
        foreach ($exp as $val) {
            if(strlen($val) > 3 && strlen($codigo) < 4){
                $codigo .= strtoupper(substr($val, 0, 2));
            }
        }
    }
	return $codigo;
}
/**
 * Obtenemos los valores de configuración de la CLÍNICA
 */
function obtieneConfiguracionClinica(){
    $clinicaConfig = Configuracion::where('cod_estado', 1)->get();
    $clinicaData = [];
    foreach ($clinicaConfig as $config) {
        $clinicaData[$config->nombre_variable] = $config->valor;
    }
    $clinicaObject = (object)$clinicaData;
    $clinicaObject->foto = '/imagenes/config/' . $clinicaObject->foto;
    $clinicaObject->logo = '/imagenes/config/' . $clinicaObject->logo;
    return $clinicaObject;
}
/**
 * Ultima Numero de Planificación
 */
function numeroPlan($cod_sucursal){
    $numeroPlan = Planificacion::where('cod_sucursal', $cod_sucursal)
                                ->orderBy('cod_planificacion', 'DESC')
                                ->first();
    return $numeroPlan ? ($numeroPlan->plan_numero + 1) : 1;
}
/**
 * Ultima Numero de Pago
 */
function numeroPago($cod_sucursal){
    $numeroPago = PagoServicio::where('cod_sucursal', $cod_sucursal)
                                ->orderBy('cod_pago_servicio', 'DESC')
                                ->first();
    return $numeroPago ? ($numeroPago->numero_correlativo + 1) : 1;
}
/*###########################################
                VALOR LETRA COSTO
###########################################*/
function montoLetras($x){
    if ($x<0) { $signo = "menos ";}
    else      { $signo = "";}
    $x = abs ($x);
    $C1 = $x;
    
    $I7 = "";
    $I9 = "";
    $G6 = floor($x/(1000000));  // 7 Y mas

    $E7 = floor($x/(100000));
    $G7 = $E7-$G6*10;   // 6

    $E8 = floor($x/1000);
    $G8 = $E8-$E7*100;   // 5 Y 4

    $E9 = floor($x/100);
    $G9 = $E9-$E8*10;  //  3

    $E10 = floor($x);
    $G10 = $E10-$E9*100;  // 2 Y 1


    $G11 = roUNd(($x-$E10)*100,0);  // Decimales
    //////////////////////

    $H6 = unidades($G6);

    if($G7==1 AND $G8==0) { $H7 = "CIEN "; }
    else {    $H7 = decenas($G7); }

    $H8 = unidades($G8);

    if($G9==1 AND $G10==0) { $H9 = "CIEN "; }
    else {    $H9 = decenas($G9); }

    $H10 = unidades($G10);

    if($G11 < 10) { $H11 = "0".$G11; }
    else { $H11 = $G11; }

    /////////////////////////////
        if($G6==0) { $I6=" "; }
    elseif($G6==1) { $I6="MILLON "; }
                else { $I6="MILLONES "; }
                
    if ($G8==0 AND $G7==0) { $I8=" "; }
                else { $I8="MIL "; }
                
    $I10 = "";
    $I11 = "/100 Bolivianos ";

    $C3 = $signo.$H6.$I6.$H7.$I7.$H8.$I8.$H9.$I9.$H10.$I10.$H11.$I11;

    return $C3; //Retornar el resultado

}
/**
 * Funcion para obtener la unidad en Texto
 */
function unidades($u){
    if ($u==0)  {$ru = " ";}
    elseif ($u==1)  {$ru = "UN ";}
    elseif ($u==2)  {$ru = "DOS ";}
    elseif ($u==3)  {$ru = "TRES ";}
    elseif ($u==4)  {$ru = "CUATRO ";}
    elseif ($u==5)  {$ru = "CINCO ";}
    elseif ($u==6)  {$ru = "SEIS ";}
    elseif ($u==7)  {$ru = "SIETE ";}
    elseif ($u==8)  {$ru = "OCHO ";}
    elseif ($u==9)  {$ru = "NUEVE ";}
    elseif ($u==10) {$ru = "DIEZ ";}

    elseif ($u==11) {$ru = "ONCE ";}
    elseif ($u==12) {$ru = "DOCE ";}
    elseif ($u==13) {$ru = "TRECE ";}
    elseif ($u==14) {$ru = "CATORCE ";}
    elseif ($u==15) {$ru = "QUINCE ";}
    elseif ($u==16) {$ru = "DIECISEIS ";}
    elseif ($u==17) {$ru = "DIECISIETE ";}
    elseif ($u==18) {$ru = "DIECIOCHO ";}
    elseif ($u==19) {$ru = "DIECINUEVE ";}
    elseif ($u==20) {$ru = "VEINTE ";}

    elseif ($u==21) {$ru = "VEINTIUNO ";}
    elseif ($u==22) {$ru = "VEINTIDOS ";}
    elseif ($u==23) {$ru = "VEINTITRES ";}
    elseif ($u==24) {$ru = "VEINTICUATRO ";}
    elseif ($u==25) {$ru = "VEINTICINCO ";}
    elseif ($u==26) {$ru = "VEINTISEIS ";}
    elseif ($u==27) {$ru = "VEINTIsiente ";}
    elseif ($u==28) {$ru = "VEINTIOCHO ";}
    elseif ($u==29) {$ru = "VEINTINUEVE ";}
    elseif ($u==30) {$ru = "TREINTA ";}

    elseif ($u==31) {$ru = "TREINTA Y UNO ";}
    elseif ($u==32) {$ru = "TREINTA Y DOS ";}
    elseif ($u==33) {$ru = "TREINTA Y TRES ";}
    elseif ($u==34) {$ru = "TREINTA Y CUATRO ";}
    elseif ($u==35) {$ru = "TREINTA Y CINCO ";}
    elseif ($u==36) {$ru = "TREINTA Y SEIS ";}
    elseif ($u==37) {$ru = "TREINTA Y SIETE ";}
    elseif ($u==38) {$ru = "TREINTA Y OCHO ";}
    elseif ($u==39) {$ru = "TREINTA Y NUEVE ";}
    elseif ($u==40) {$ru = "CUARENTA ";}

    elseif ($u==41) {$ru = "CUARENTA Y UNO ";}
    elseif ($u==42) {$ru = "CUARENTA Y DOS ";}
    elseif ($u==43) {$ru = "CUARENTA Y TRES ";}
    elseif ($u==44) {$ru = "CUARENTA Y CUATRO ";}
    elseif ($u==45) {$ru = "CUARENTA Y CINCO ";}
    elseif ($u==46) {$ru = "CUARENTA Y SEIS ";}
    elseif ($u==47) {$ru = "CUARENTA Y SIETE ";}
    elseif ($u==48) {$ru = "CUARENTA Y OCHO ";}
    elseif ($u==49) {$ru = "CUARENTA Y NUEVE ";}
    elseif ($u==50) {$ru = "CINCUENTA ";}

    elseif ($u==51) {$ru = "CINCUENTA Y UNO ";}
    elseif ($u==52) {$ru = "CINCUENTA Y DOS ";}
    elseif ($u==53) {$ru = "CINCUENTA Y TRES ";}
    elseif ($u==54) {$ru = "CINCUENTA Y CUATRO ";}
    elseif ($u==55) {$ru = "CINCUENTA Y CINCO ";}
    elseif ($u==56) {$ru = "CINCUENTA Y SEIS ";}
    elseif ($u==57) {$ru = "CINCUENTA Y SIETE ";}
    elseif ($u==58) {$ru = "CINCUENTA Y OCHO ";}
    elseif ($u==59) {$ru = "CINCUENTA Y NUEVE ";}
    elseif ($u==60) {$ru = "SESENTA ";}

    elseif ($u==61) {$ru = "SESENTA Y UNO ";}
    elseif ($u==62) {$ru = "SESENTA Y DOS ";}
    elseif ($u==63) {$ru = "SESENTA Y TRES ";}
    elseif ($u==64) {$ru = "SESENTA Y CUATRO ";}
    elseif ($u==65) {$ru = "SESENTA Y CINCO ";}
    elseif ($u==66) {$ru = "SESENTA Y SEIS ";}
    elseif ($u==67) {$ru = "SESENTA Y SIETE ";}
    elseif ($u==68) {$ru = "SESENTA Y OCHO ";}
    elseif ($u==69) {$ru = "SESENTA Y NUEVE ";}
    elseif ($u==70) {$ru = "SETENTA ";}

    elseif ($u==71) {$ru = "SETENTA Y UNO ";}
    elseif ($u==72) {$ru = "SETENTA Y DOS ";}
    elseif ($u==73) {$ru = "SETENTA Y TRES ";}
    elseif ($u==74) {$ru = "SETENTA Y CUATRO ";}
    elseif ($u==75) {$ru = "SETENTA Y CINCO ";}
    elseif ($u==76) {$ru = "SETENTA Y SEIS ";}
    elseif ($u==77) {$ru = "SETENTA Y SIETE ";}
    elseif ($u==78) {$ru = "SETENTA Y OCHO ";}
    elseif ($u==79) {$ru = "SETENTA Y NUEVE ";}
    elseif ($u==80) {$ru = "OCHENTA ";}

    elseif ($u==81) {$ru = "OCHENTA Y UNO ";}
    elseif ($u==82) {$ru = "OCHENTA Y DOS ";}
    elseif ($u==83) {$ru = "OCHENTA Y TRES ";}
    elseif ($u==84) {$ru = "OCHENTA Y CUATRO ";}
    elseif ($u==85) {$ru = "OCHENTA Y CINCO ";}
    elseif ($u==86) {$ru = "OCHENTA Y SEIS ";}
    elseif ($u==87) {$ru = "OCHENTA Y SIETE ";}
    elseif ($u==88) {$ru = "OCHENTA Y OCHO ";}
    elseif ($u==89) {$ru = "OCHENTA Y NUEVE ";}
    elseif ($u==90) {$ru = "NOVENTA ";}

    elseif ($u==91) {$ru = "NOVENTA Y UNO ";}
    elseif ($u==92) {$ru = "NOVENTA Y DOS ";}
    elseif ($u==93) {$ru = "NOVENTA Y TRES ";}
    elseif ($u==94) {$ru = "NOVENTA Y CUATRO ";}
    elseif ($u==95) {$ru = "NOVENTA Y CINCO ";}
    elseif ($u==96) {$ru = "NOVENTA Y SEIS ";}
    elseif ($u==97) {$ru = "NOVENTA Y SIETE ";}
    elseif ($u==98) {$ru = "NOVENTA Y OCHO ";}
    else            {$ru = "NOVENTA Y NUEVE ";}
    return $ru; //Retornar el resultado
}
/**
 * Funcion para obtener las decenas en Texto
 */
function decenas($d){
    if ($d==0)  {$rd = "";}
    elseif ($d==1)  {$rd = "CIENTO ";}
    elseif ($d==2)  {$rd = "DOSCIENTOS ";}
    elseif ($d==3)  {$rd = "TRESCIENTOS ";}
    elseif ($d==4)  {$rd = "CUATROCIENTOS ";}
    elseif ($d==5)  {$rd = "QUINIENTOS ";}
    elseif ($d==6)  {$rd = "SEISCIENTOS ";}
    elseif ($d==7)  {$rd = "SETECIENTOS ";}
    elseif ($d==8)  {$rd = "OCHOCIENTOS ";}
    else            {$rd = "NOVECIENTOS ";}
    return $rd; //Retornar el resultado
}
/**
 * LOG PLANIFICACIÓN
 */
function logPlanificacion($planificacion, $n_planificacion){
    $log_planificacion = new LogPlanificacion;

    // Comparar y registrar cambios en cod_plan_estado
    if (!empty($n_planificacion->cod_plan_estado) && !empty($planificacion->cod_plan_estado) 
        && ($planificacion->cod_plan_estado != $n_planificacion->cod_plan_estado)) {
        $log_planificacion->cod_plan_estado   = $planificacion->cod_plan_estado;
        $log_planificacion->n_cod_plan_estado = $n_planificacion->cod_plan_estado;
    }

    // Comparar y registrar cambios en descripcion
    if (!empty($n_planificacion->descripcion) && !empty($planificacion->descripcion) 
        && ($planificacion->descripcion != $n_planificacion->descripcion)) {
        $log_planificacion->descripcion   = $planificacion->descripcion;
        $log_planificacion->n_descripcion = $n_planificacion->descripcion;
    }

    // Comparar y registrar cambios en observacion
    if (!empty($n_planificacion->observacion) && !empty($planificacion->observacion) 
        && ($planificacion->observacion != $n_planificacion->observacion)) {
        $log_planificacion->observacion   = $planificacion->observacion;
        $log_planificacion->n_observacion = $n_planificacion->observacion;
    }

    // Comparar y registrar cambios en fecha_vencimiento
    if (!empty($n_planificacion->fecha_vencimiento) && !empty($planificacion->fecha_vencimiento) 
        && ($planificacion->fecha_vencimiento != $n_planificacion->fecha_vencimiento)) {
        $log_planificacion->fecha_vencimiento   = $planificacion->fecha_vencimiento;
        $log_planificacion->n_fecha_vencimiento = $n_planificacion->fecha_vencimiento;
    }

    // Comparar y registrar cambios en fecha_limite_pago
    if (!empty($n_planificacion->fecha_limite_pago) && !empty($planificacion->fecha_limite_pago) 
        && ($planificacion->fecha_limite_pago != $n_planificacion->fecha_limite_pago)) {
        $log_planificacion->fecha_limite_pago   = $planificacion->fecha_limite_pago;
        $log_planificacion->n_fecha_limite_pago = $n_planificacion->fecha_limite_pago;
    }

    // Comparar y registrar cambios en fecha_finalizada
    if (!empty($n_planificacion->fecha_finalizada) && !empty($planificacion->fecha_finalizada) 
        && ($planificacion->fecha_finalizada != $n_planificacion->fecha_finalizada)) {
        $log_planificacion->fecha_finalizada   = $planificacion->fecha_finalizada;
        $log_planificacion->n_fecha_finalizada = $n_planificacion->fecha_finalizada;
    }

    // Comparar y registrar cambios en cod_estado
    if (!empty($n_planificacion->cod_estado) && !empty($planificacion->cod_estado) 
        && ($planificacion->cod_estado != $n_planificacion->cod_estado)) {
        $log_planificacion->cod_estado   = $planificacion->cod_estado;
        $log_planificacion->n_cod_estado = $n_planificacion->cod_estado;
    }

    // Comparar y registrar cambios en motivo_cancelacion
    if (!empty($n_planificacion->motivo_cancelacion) && !empty($planificacion->motivo_cancelacion) 
        && ($planificacion->motivo_cancelacion != $n_planificacion->motivo_cancelacion)) {
        $log_planificacion->motivo_cancelacion   = $planificacion->motivo_cancelacion;
        $log_planificacion->n_motivo_cancelacion = $n_planificacion->motivo_cancelacion;
    }
    // Guardar el log_planificacion
    if ($log_planificacion->isDirty()) {
        $log_planificacion->cod_planificacion = $planificacion->cod_planificacion;
        $log_planificacion->cod_usuario_log   = auth()->user()->cod_usuario;
        $log_planificacion->cod_sucursal      = auth()->user()->log_sucursal;
        // Guardar el log_planificacion solo si hay cambios
        $log_planificacion->save();
    }
    return true;
}
/**
 * LOG PLANIFICACIÓN SERVICIO
 */
function logPlanificacionServicio($planificacion, $n_planificacion){
    $log_planificacion_serv = new LogPlanificacionServicio;
    
    // Comparar y registrar cambios en cod_servicio        
    if (!empty($n_planificacion->cod_servicio) && !empty($planificacion->cod_servicio) 
        && ($planificacion->cod_servicio != $n_planificacion->cod_servicio)) {
        $log_planificacion_serv->cod_servicio   = $planificacion->cod_servicio;
        $log_planificacion_serv->n_cod_servicio = $n_planificacion->cod_servicio;
    }
    
    // Comparar y registrar cambios en cod_usuario        
    if (!empty($n_planificacion->cod_usuario) && !empty($planificacion->cod_usuario) 
        && ($planificacion->cod_usuario != $n_planificacion->cod_usuario)) {
        $log_planificacion_serv->cod_usuario   = $planificacion->cod_usuario;
        $log_planificacion_serv->n_cod_usuario = $n_planificacion->cod_usuario;
    }
    
    // Comparar y registrar cambios en cod_plan_servicio_estado        
    if (!empty($n_planificacion->cod_plan_servicio_estado) && !empty($planificacion->cod_plan_servicio_estado) 
        && ($planificacion->cod_plan_servicio_estado != $n_planificacion->cod_plan_servicio_estado)) {
        $log_planificacion_serv->cod_plan_servicio_estado   = $planificacion->cod_plan_servicio_estado;
        $log_planificacion_serv->n_cod_plan_servicio_estado = $n_planificacion->cod_plan_servicio_estado;
    }

    // Comparar y registrar cambios en cod_unidad
    if (!empty($n_planificacion->cod_unidad) && !empty($planificacion->cod_unidad) 
        && ($planificacion->cod_unidad != $n_planificacion->cod_unidad)) {
        $log_planificacion_serv->cod_unidad   = $planificacion->cod_unidad;
        $log_planificacion_serv->n_cod_unidad = $n_planificacion->cod_unidad;
    }

    // Comparar y registrar cambios en costo_unidad
    if (!empty($n_planificacion->costo_unidad) && !empty($planificacion->costo_unidad) 
        && (floatval($planificacion->costo_unidad) != floatval($n_planificacion->costo_unidad))) {
        $log_planificacion_serv->costo_unidad   = $planificacion->costo_unidad;
        $log_planificacion_serv->n_costo_unidad = $n_planificacion->costo_unidad;
    }

    // Comparar y registrar cambios en cantidad
    if (!empty($n_planificacion->cantidad) && !empty($planificacion->cantidad) 
        && ($planificacion->cantidad != $n_planificacion->cantidad)) {
        $log_planificacion_serv->cantidad   = $planificacion->cantidad;
        $log_planificacion_serv->n_cantidad = $n_planificacion->cantidad;
    }

    // Comparar y registrar cambios en descuento_total
    if (!empty($n_planificacion->descuento_total) && !empty($planificacion->descuento_total) 
        && (floatval($planificacion->descuento_total) != floatval($n_planificacion->descuento_total))) {
        $log_planificacion_serv->descuento_total   = $planificacion->descuento_total;
        $log_planificacion_serv->n_descuento_total = $n_planificacion->descuento_total;
    }

    // Comparar y registrar cambios en diagnostico
    if (!empty($n_planificacion->diagnostico) && !empty($planificacion->diagnostico) 
        && ($planificacion->diagnostico != $n_planificacion->diagnostico)) {
        $log_planificacion_serv->diagnostico   = $planificacion->diagnostico;
        $log_planificacion_serv->n_diagnostico = $n_planificacion->diagnostico;
    }

    // Comparar y registrar cambios en descripcion_servicio
    if (!empty($n_planificacion->descripcion_servicio) && !empty($planificacion->descripcion_servicio) 
        && ($planificacion->descripcion_servicio != $n_planificacion->descripcion_servicio)) {
        $log_planificacion_serv->descripcion_servicio   = $planificacion->descripcion_servicio;
        $log_planificacion_serv->n_descripcion_servicio = $n_planificacion->descripcion_servicio;
    }

    // Comparar y registrar cambios en descripcion_especialidad
    if (!empty($n_planificacion->descripcion_especialidad) && !empty($planificacion->descripcion_especialidad) 
        && ($planificacion->descripcion_especialidad != $n_planificacion->descripcion_especialidad)) {
        $log_planificacion_serv->descripcion_especialidad   = $planificacion->descripcion_especialidad;
        $log_planificacion_serv->n_descripcion_especialidad = $n_planificacion->descripcion_especialidad;
    }

    // Comparar y registrar cambios en cod_estado
    if (!empty($n_planificacion->cod_estado) && !empty($planificacion->cod_estado) 
        && ($planificacion->cod_estado != $n_planificacion->cod_estado)) {
        $log_planificacion_serv->cod_estado   = $planificacion->cod_estado;
        $log_planificacion_serv->n_cod_estado = $n_planificacion->cod_estado;
    }

    // Guardar el log_planificacion
    if ($log_planificacion_serv->isDirty()) {
        $log_planificacion_serv->cod_planificacion_servicio = $planificacion->cod_planificacion_servicio;
        $log_planificacion_serv->cod_usuario_log            = auth()->user()->cod_usuario;
        $log_planificacion_serv->cod_sucursal               = auth()->user()->log_sucursal;
        // Guardar el log_planificacion_servicio solo si hay cambios
        $log_planificacion_serv->save();
    }
    return true;
}

/**
 * Actualiza totales Planificación Servicio
 */
function ajustaTotalPlanificacionServicio($cod_planificacion_servicio){
    $plan_servicio_total = DB::select('SELECT SUM(psd.monto) as monto_total
                            FROM sigi_pagos_servicios ps
                            LEFT JOIN sigi_pagos_servicios_detalle psd ON psd.cod_pago_servicio = ps.cod_pago_servicio
                            WHERE ps.cod_estado = 1
                            AND psd.cod_planificacion_servicio = :cod_planificacion_servicio', 
                            ['cod_planificacion_servicio' => $cod_planificacion_servicio]);
    $planificacion_servicio = PlanificacionServicio::where('cod_planificacion_servicio', $cod_planificacion_servicio)->first();
    $planificacion_servicio->monto_cancelado = $plan_servicio_total ? $plan_servicio_total[0]->monto_total : 0;
    $planificacion_servicio->update();
}
/**
 * Actualiza Estado de Pago de Planificación
 */
function ajustaEstadoPlanificacion($cod_planificacion){
    $plan_totales = Planificacion::with(['planificacionServicio'])
                                    ->withSum('planificacionServicio', 'monto_final')
                                    ->withSum('planificacionServicio', 'monto_cancelado')
                                    ->where('cod_planificacion', $cod_planificacion)
                                    ->first();
    // Verifica Estado Por Planificación
    $planificacion = Planificacion::where('cod_planificacion', $cod_planificacion)->first();
    if($plan_totales->planificacion_servicio_sum_monto_cancelado < $plan_totales->planificacion_servicio_sum_monto_final){
        $planificacion->cod_plan_pago_estado = 2;
    }else{
        $planificacion->cod_plan_pago_estado = 3;
    }
    $planificacion->update();
}
/**
 * Actualiza "estado" de Planificación Servicio
 */
function ajustaEstadoPlanificacionServicio($cod_planificacion_servicio){
    $total_pendiente = DB::table('sigi_planificaciones_servicios_odo')
                        ->where('cod_planificacion_servicio', $cod_planificacion_servicio)
                        ->where('cod_plan_servicio_estado', '<', 3)
                        ->count();

    if ($total_pendiente !== null) {
        $estado = ($total_pendiente > 0) ? 2 : 3;
        // Actualiza Estados Planificación
        $planificacion_servicio = PlanificacionServicio::where('cod_planificacion_servicio', $cod_planificacion_servicio)->first();
        $planificacion_servicio->cod_plan_servicio_estado = ($total_pendiente > 0) ? 2 : 3;
        $planificacion_servicio->fecha_finalizada         = date('Y-m-d H:i:s');
        $planificacion_servicio->update();
    }
}
/**
 * Obtener la "fecha de FINALIZACIÓN" de PLANIFICACIÓN
 */
function ajustaFechaFinalizacionPlan($cod_planificacion){
    $total_pendiente = DB::table('sigi_planificaciones_servicios')
                        ->where('cod_planificacion', $cod_planificacion)
                        ->where('cod_plan_servicio_estado', '<', 3)
                        ->count();

    if ($total_pendiente !== null) {
        // Actualiza FECHA FINALIZACIÓN
        $planificacion = Planificacion::where('cod_planificacion', $cod_planificacion)->first();
        $planificacion->fecha_finalizada = date('Y-m-d H:s:i');
        $planificacion->update();
    }
}
/**
 * Obtiene Nombre Paciente - Evaluacion
 */
function obtienePacienteEvaluacion($cod_evaluacion){
    $evaluacion = Evaluacion::with(['paciente'])->findOrFail($cod_evaluacion);
    // Suponiendo que hay una relación en el modelo Evaluacion que se llama "paciente"
    return "pac_" . $evaluacion->paciente->cod_paciente."_evaluacion_";
}
/**
 * Obtiene Nombre Paciente - Evolución
 */
function obtienePacienteEvolucion($cod_evolucion){
    $evolucion = Evolucion::with(['paciente'])->findOrFail($cod_evolucion);
    // Suponiendo que hay una relación en el modelo Evolución que se llama "paciente"
    return "pac_" . $evolucion->paciente->cod_paciente."_evolucion_";
}
/**
 * GENERAR ARRAY DE ANTECEDENTE PARA PDF
 */
function generarArrayAntecedente($registros){
    $grupo_antecedente = [];
    foreach ($registros as $registro) {
        $fecha = $registro['fecha'];
        // Verificar si ya existe un grupo para esta fecha
        if (!isset($grupo_antecedente[$fecha])) {
            // Si no existe, crear un nuevo grupo con la estructura deseada
            $grupo_antecedente[$fecha] = [
                'fecha' => $fecha,
                'array' => [],
            ];
        }
        // Agregar el registro al grupo correspondiente
        $grupo_antecedente[$fecha]['array'][] = [
            'nombre'              => $registro['nombre'],
            'motivo_baja'         => $registro['motivo_baja'],
            'fecha_actualizacion' => $registro['fecha_actualizacion']
        ];
    }
    // Convertir el resultado a un array indexado para que coincida con la estructura deseada
    return array_values($grupo_antecedente);
}

/**
 * Crea horario por sucursal
 */
function generaHorario($cod_sucursal){
    // Array con los nombres de los días de la semana
    $diasSemana = [
        ['nro_dia' => 0, 'nombre_dia' => 'Domingo', 'habilitado' => 0],
        ['nro_dia' => 1, 'nombre_dia' => 'Lunes', 'habilitado' => 1],
        ['nro_dia' => 2, 'nombre_dia' => 'Martes', 'habilitado' => 1],
        ['nro_dia' => 3, 'nombre_dia' => 'Miércoles', 'habilitado' => 1],
        ['nro_dia' => 4, 'nombre_dia' => 'Jueves', 'habilitado' => 1],
        ['nro_dia' => 5, 'nombre_dia' => 'Viernes', 'habilitado' => 1],
        ['nro_dia' => 6, 'nombre_dia' => 'Sábado', 'habilitado' => 1],
    ];

    foreach ($diasSemana as $dia) {
        // Crear una nueva instancia del modelo SucursalHorario
        $horario = new SucursalHorario;

        // Asignar los valores para cada campo
        $horario->cod_sucursal   = $cod_sucursal;
        $horario->nro_dia        = $dia['nro_dia'];
        $horario->nombre_dia     = $dia['nombre_dia'];
        $horario->horario_inicio = '08:00'; // Horario de inicio predeterminado
        $horario->horario_fin    = '17:00'; // Horario de fin predeterminado
        $horario->habilitado     = $dia['habilitado'];
        // Guardar el registro en la base de datos
        $horario->save();
    }
    return true;
}

/**
 * Validación de Horario por Sucursal
 */
function validacionHorario($horario_inicio, $horario_fin){
    $nro_dia = date('w', strtotime($horario_inicio));
    $hora_inicio = date('H:i:s', strtotime($horario_inicio));
    $hora_fin    = date('H:i:s', strtotime($horario_fin));
    
    $verificaHorario = SucursalHorario::where('cod_sucursal', auth()->user()->log_sucursal)
                            ->where('nro_dia', $nro_dia)
                            ->where(function($query) use ($hora_inicio, $hora_fin) {
                                $query->where('horario_inicio', '<=', $hora_inicio)
                                    ->where('horario_fin', '>=', $hora_inicio)
                                    ->where('horario_inicio', '<=', $hora_fin)
                                    ->where('horario_fin', '>=', $hora_fin);
                            })
                            ->first();
    if (empty($verificaHorario)) {
        return [
            'message' => 'El horario seleccionado está fuera del horario de atención establecido por la clínica.',
            'status'  => false
        ];
    } else {
        // Si el horario está dentro del rango de atención
        if ($verificaHorario->habilitado == 0) {
            return [
                'message' => 'El día '.$verificaHorario->nombre_dia.' no está disponible para reservas. "CERRADO"',
                'status'  => false
            ];
        } else {
            return [
                'message' => 'El día '.$verificaHorario->nombre_dia.' está habilitado para reservas.',
                'status'  => true
            ];
        }
    }
}

/**
 * SILLON
 * Verificar si hay alguna cita que se superponga con el horario solicitado
 */
function validacionCitaSuperpuesta($cod_sillon, $horario_inicio, $horario_fin, $cod_sucursal){        
    $citasSuperpuestas = Agenda::where('cod_sucursal', $cod_sucursal)
                                ->where('cod_sillon', $cod_sillon)
                                ->whereIn('cod_agenda_estado', [1,2])
                                ->where(function($query) use ($horario_inicio, $horario_fin) {
                                    $query->where(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '>=', $horario_inicio)
                                                ->where('horario_inicio', '<', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_fin', '>', $horario_inicio)
                                                ->where('horario_fin', '<=', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '<', $horario_inicio)
                                                ->where('horario_fin', '>', $horario_fin);
                                        });
                                })
                                ->exists();

    // Si no hay citas superpuestas, actualiza la nueva cita
    if (!$citasSuperpuestas) {
        return [
            'message' => 'El horario seleccionado habilitado.',
            'status'  => true
        ];
    } else {
        return [
            'message' => 'Ya existe una cita programada en el horario solicitado.',
            'status' => false
        ];
    }
}

/**
 * ! PACIENTE
 * Verificar si hay alguna cita que se superponga con el horario solicitado
 * y si el paciente se encuentra registrado en otra sucursal o sillon
 */
function validacionCitaSuperpuestaPaciente($cod_paciente, $horario_inicio, $horario_fin){        
    $citasSuperpuestas = Agenda::where('cod_paciente', $cod_paciente)
                                ->whereIn('cod_agenda_estado', [1,2])
                                ->where(function($query) use ($horario_inicio, $horario_fin) {
                                    $query->where(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '>=', $horario_inicio)
                                                ->where('horario_inicio', '<', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_fin', '>', $horario_inicio)
                                                ->where('horario_fin', '<=', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '<', $horario_inicio)
                                                ->where('horario_fin', '>', $horario_fin);
                                        });
                                })
                                ->exists();

    // Si no hay citas superpuestas, actualiza la nueva cita
    if (!$citasSuperpuestas) {
        return [
            'message' => 'El horario seleccionado habilitado.',
            'status'  => true
        ];
    } else {
        return [
            'message' => 'El paciente ya tiene una cita médica programada para el horario seleccionado.',
            'status' => false
        ];
    }
}
/**
 * EVENTO
 * Verificar si hay algun evento en el rango solicitado
 */
function validacionCitaEvento($horario_inicio, $horario_fin){        
    $eventos = Evento::where('cod_estado', 1)
                                ->where(function($query) {
                                    $query->whereNull('cod_sucursal')
                                          ->orWhere('cod_sucursal', auth()->user()->log_sucursal);
                                })
                                ->where(function($query) use ($horario_inicio, $horario_fin) {
                                    $query->where(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '>=', $horario_inicio)
                                                ->where('horario_inicio', '<', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_fin', '>', $horario_inicio)
                                                ->where('horario_fin', '<=', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '<', $horario_inicio)
                                                ->where('horario_fin', '>', $horario_fin);
                                        });
                                })
                                ->exists();

    // Si no hay eventos, actualiza la nueva cita
    if (!$eventos) {
        return [
            'message' => 'El horario seleccionado habilitado.',
            'status'  => true
        ];
    } else {
        return [
            'message' => 'Hay un evento programado en el horario seleccionado. No se podrá agendar citas.',
            'status'  => false
        ];
    }
}
/**
 * ! MÉDICO
 * Verificar si hay alguna cita que tenga el médico en el horario solicitado
 * considerando la revisión en otros sillones y sucursales
 */
function validacionCitaSuperpuestaMedico($cod_medico, $horario_inicio, $horario_fin){        
    $citaMedico = Agenda::whereHas('planificacionServicio', function($query) use ($cod_medico) {
                                    $query->where('cod_usuario', $cod_medico);
                                })
                                ->whereIn('cod_agenda_estado', [1,2])
                                ->where(function($query) use ($horario_inicio, $horario_fin) {
                                    $query->where(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '>=', $horario_inicio)
                                                ->where('horario_inicio', '<', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_fin', '>', $horario_inicio)
                                                ->where('horario_fin', '<=', $horario_fin);
                                        })
                                        ->orWhere(function($q) use ($horario_inicio, $horario_fin) {
                                            $q->where('horario_inicio', '<', $horario_inicio)
                                                ->where('horario_fin', '>', $horario_fin);
                                        });
                                })
                                ->exists();

    // Si no hay citas superpuestas, actualiza la nueva cita
    if (!$citaMedico) {
        return [
            'message' => 'El horario seleccionado habilitado.',
            'status'  => true
        ];
    } else {
        return [
            'message' => 'El médico ya tiene una cita programada para este horario..',
            'status' => false
        ];
    }
}
/**
 * Obtiene fecha en Español con el siguiente formato
 * 
 */
function formatoFecha($fecha){
    // Crea una instancia de Carbon con la fecha proporcionada
    $carbonFecha = Carbon::parse($fecha);

    // Establece el idioma a español
    $carbonFecha->locale('es');

    // Formatea la fecha según tus requisitos
    $fechaFormateada = $carbonFecha->isoFormat('dddd D \d\e MMMM');

    return $fechaFormateada;
}

/**
 * Servicio de envio de Mensaje de WhatsApp
 */
function enviarWhatsApp($celular, $mensaje){
    $config    = obtieneConfiguracionClinica(); 
    $url       = $config->wa_url;
    $client_id = $config->wa_client_id;
    $token     = $config->wa_token;
    $body = [
        'client_id' => $client_id,
        'mobile'    => $celular,
        'text'      => $mensaje,
    ];
    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $token,
    ];
    try {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($body));
        $response = curl_exec($curl);
        if ($response == false) {
            throw new Exception(curl_error($curl));
        }
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($httpCode >= 400) {
            throw new Exception('Request failed');
        }
        $data = json_decode($response, true);
        return $data;
    } catch (Exception $error) {
        return [
            'message' => $error->getMessage(),
            'success' => false
        ];
    }
}

/**
 * Verificación de Conexión a Correo Electrónico
 **/
function comunicacionEmail($usuario, $pass){
    // Crear instancia del objeto Swift_SmtpTransport con la configuración de envío de correo
    $transport = new Swift_SmtpTransport('smtp.gmail.com', 587, 'tls');
    $transport->setUsername($usuario);
    $transport->setPassword($pass);
    // Verificar la conexión con el servidor SMTP
    try {
        $transport->start();

        return [
            'message' => 'Comunicación exitosa.',
            'status'  => true
        ];
    } catch (Swift_TransportException $e) {
        // Ocurrió un error en la verificación de la configuración
        // echo 'Error en la configuración de envío de correo: ' . $e->getMessage();
        return [
            'message' => 'Fallo envio de correo, verifique sus credenciales de acceso.',
            'status'  => false
        ];
    }
}
/**
 * Ultima Numero de Correlativo Transacción por Sucursal y tipo de movimiento (Ingreso, Egreso, Traspaso)
 */
function numeroTransaccion($cod_sucursal, $cod_tipo_movimiento){
    $numeroTransaccion = Transaccion::where('cod_sucursal', $cod_sucursal)
                                ->where('cod_tipo_movimiento', $cod_tipo_movimiento)
                                ->orderBy('cod_transaccion', 'DESC')
                                ->first();
    return $numeroTransaccion ? ($numeroTransaccion->numero + 1) : 1;
}