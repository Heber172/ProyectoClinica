<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>PDF - PLAN DE SERVICIO</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    </head>
    <style type="text/css">   
		body{font-family:Arial, sans-serif; font-size: 11px;}
		@page { margin-top: 15px; margin-left: 40px; margin-right: 40px; margin-bottom: 15px;}


		header { position: fixed; top: -125px; left: 0px; right: 0px; height: 70px;}
		footer { position: fixed; bottom: -40px; left: 0px; right: 0px; height: 50px; }

		/* Estilo Tabla Principal */
		.prin-table-header {
			font-size: 10px;
			background-color: #f0f0f0;
			color: #013565;
			border: 1px solid #ddd;
			padding: 5px;
			text-align: left;
		}

		.prin-table-data {
			font-size: 11px;
			background-color: white;
			border: 1px solid #ddd;
			padding: 5px;
		}
		/* Marca de Agua, en la parte Inferior Izquierda */
		.watermark {
			position: fixed;
			bottom: 40px; /* Ajusta la posición vertical según sea necesario */
			left: 10px; /* Ajusta la posición horizontal según sea necesario */
			font-size: 10px;
			color: #666;
		}
		/* Footer en cada Hoja */
		.footer {
			position: fixed;
			bottom: 0;
			left: 0;
			width: 100%;
			background-color: #f9f9f9;
			border-top: 1px solid #ddd;
			font-size: 10px;
			color: #666;
			text-align: center;
		}
		/* FORMA DE DIENTE */
		.tooth-shape {
			display: inline-block;
			padding: 3px 8px; /* Ajustar el relleno según sea necesario */
			background-color: #dee2e6; /* Color de fondo plomo suave */
			color: #000000; /* Color del texto más oscuro para mejorar la legibilidad */
			border-top-left-radius: 8px; /* Bordes redondeados superior izquierdo */
			border-top-right-radius: 8px; /* Bordes redondeados superior derecho */
			border-bottom-left-radius: 16px; /* Bordes redondeados inferior izquierdo */
			border-bottom-right-radius: 16px; /* Bordes redondeados inferior derecho */
		}
	</style>
<body>
	<div class="container">   
        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
					<td rowspan="7" style="width: 10%; vertical-align: middle;">
						<img src="{{ asset('imagenes/sucursales/'.$planificacion->sucursal->foto) }}" style="margin: 0; padding: 0; height: 100px;">
					</td>
					<td rowspan="7" style="width: 65%; text-align: left; padding-left: 20px; font-size: 13px">
						<strong style="color: #013565;">{{ mb_strtoupper($clinica->nombre_clinica) }}</strong><br>
						<strong>{{ $planificacion->sucursal->numero === 0 ? 'Casa Matriz' : 'Sucursal ' . $planificacion->sucursal->numero }}</strong><br>
						{{ $planificacion->sucursal->direccion }}<br>
						{{ $planificacion->sucursal->email }}<br>
						<strong style="color: #013565;">La Paz - Bolivia</strong>
					</td>
					<td rowspan="7" style="width: 25%; vertical-align: middle; font-size: 10px; background-color: #f9f9f9; border: 1px solid #ddd; padding: 2px; text-align: center; border-radius: 10px;">
						<h4 style="margin: 0; font-size: 16px; font-weight: bold; color: #013565;">
							{{ $planificacion->nombre }}
						</h4>
						<p style="margin: 0; font-size: 12px; color: #013565;">
							<strong>Pac: </strong>{{ $planificacion->paciente->codigo }}
						</p>
					</td>
					
				</tr>
				
            </tbody>
        </table>
        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
                    <td rowspan="2" style="font-size: 20px; color: #013565;">
						@if($planificacion->cod_plan_estado == 1)
							<b>PROFORMA</b>
						@else
							<b>PLANIFICACIÓN</b>
						@endif
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
			DATOS GENERALES
		</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<tr>
				<th class="prin-table-header" width="10%">Creado por:</th>
				<td class="prin-table-data" width="30%">
					{{ mb_strtoupper($planificacion->usuario->nombre . ' ' . $planificacion->usuario->paterno . ' ' . $planificacion->usuario->materno, 'UTF-8') }}
				</td>				
				<th class="prin-table-header" width="15%">Fecha de creación:</th>
				<td class="prin-table-data" width="15%">{{ date('d-m-Y', strtotime($planificacion->created_at)) }}</td>
				<th class="prin-table-header" width="15%">Fecha de vencimiento:</th>
				<td class="prin-table-data" width="15%">
					@if($planificacion->cod_plan_estado == 1)
						{{ date('d-m-Y', strtotime($planificacion->fecha_vencimiento)) }}
					@else
						-
					@endif
				</td>
			</tr>
			<tr>
				<th class="prin-table-header">Paciente:</th>
				<td class="prin-table-data">
					{{ mb_strtoupper($planificacion->paciente->nombre . ' ' . $planificacion->paciente->paterno . ' ' . $planificacion->paciente->materno, 'UTF-8') }}
				</td>
				<th class="prin-table-header">CI:</th>
				<td class="prin-table-data">{{ $planificacion->paciente->ci }}</td>
				<th class="prin-table-header">Estado Proforma:</th>
				<td class="prin-table-data">
					@if(strtotime($planificacion->fecha_vencimiento) < strtotime(now()) && $planificacion->cod_plan_estado == 1)
						<span style="color: red;">Proforma Vencida</span>
					@else
						{{ $planificacion->planificacionEstado->nombre }}
					@endif
				</td>
			</tr>
		</table>

        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
			DETALLE DE SERVICIO(S)
		</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th class="prin-table-header" width="25%">Servicio</th>
					<th class="prin-table-header" width="10%">ODG.</th>
					<th class="prin-table-header" width="20%">Médico</th>
					<th class="prin-table-header" width="5%" style="text-align: center;">Cantidad</th>
					<th class="prin-table-header" width="10%" style="text-align: center;">U/M</th>
					<th class="prin-table-header" width="10%" style="text-align: center;">Costo Unitario</th>
					<th class="prin-table-header" width="10%" style="text-align: center;">Descuento</th>
					<th class="prin-table-header" width="10%" style="text-align: center;">Subtotal</th>
				</tr>
			</thead>
			<tbody>
				@php
					$subtotal 		= 0;
					$descuentoTotal = 0;
				@endphp
				@foreach($planificacion->planificacionServicio as $servicio)
					<tr>
						<td class="prin-table-data">
							<strong>{{ $servicio->descripcion_servicio }}</strong><br>
							Esp. {{ $servicio->descripcion_especialidad }}
						</td>
						<td class="prin-table-data">
							@foreach($servicio->servicioOdo as $reg)
								<span class="tooth-shape">{{ $reg['pieza'] }}</span>
							@endforeach
						</td>
						<td class="prin-table-data">
							{{ mb_strtoupper($servicio->medico->nombre.' '.$servicio->medico->paterno.' '.$servicio->medico->materno, 'UTF-8') }}
						</td>
						<td class="prin-table-data" style="text-align: center;">{{ $servicio->cantidad }}</td>
						<td class="prin-table-data" style="text-align: center;">{{ $servicio->unidad->nombre }}</td>
						<td class="prin-table-data" style="text-align: right;">{{ $servicio->costo_unidad }}</td>
						<td class="prin-table-data" style="text-align: right;">{{ $servicio->descuento_total }}</td>
						<td class="prin-table-data" style="text-align: right;">{{ $servicio->monto_final }}</td>
					</tr>
					@php
						$subtotal 		+= $servicio->monto_final;
						$descuentoTotal += $servicio->descuento_total;
					@endphp
				@endforeach
				@php
					$total = $subtotal - $descuentoTotal;
				@endphp
				<tr>
					<td colspan="6" rowspan="3"><strong>Son: {{ montoLetras($total) }}</strong></td>
					<td class="prin-table-header" style="text-align: right;"><strong>Subtotal:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $subtotal }}</strong></td>
				</tr>
				<tr>
					<td class="prin-table-header" style="text-align: right;"><strong>Descuento:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $descuentoTotal }}</strong></td>
				</tr>
				<tr>
					<td class="prin-table-header" colspan="1" style="text-align: right;"><strong>Monto Total:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $total }}</strong></td>
				</tr>
			</tbody>
		</table>
        
    </div>
	{{-- Marca de Agua Ultima hoja --}}
	<div class="watermark">
		<p>MONTOS EXPRESADOS EN BOLIVIANOS</p>
		<p><strong>{{ mb_strtoupper($planificacion->sucursal->nombre, 'UTF-8') }}</strong></p>
		<p>AGRADECEMOS SU CONFIANZA</p>
	</div>
	{{-- Pie de Pagina --}}
	<div class="footer">
		<p><strong style="color: #013565;">Nota aclaratoria: </strong>Este presupuesto puede estar sujeto a cambios que surgen durante el tratamiento</p>
	</div>
</body>
</html>