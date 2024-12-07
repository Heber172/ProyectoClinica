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
		/* Marca de Agua Anulado */
		.watermark_anulado {
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translate(-50%, -50%) rotate(-45deg);
			color: rgba(0, 0, 0, 0.3);
			font-size: 5rem;
			font-weight: bold;
			pointer-events: none;
			color: #f64d44;
		}
	</style>
<body>
	<div class="container">
		@if($pago_servicio->cod_estado==0)
			<div class="watermark_anulado">ANULADO</div>
		@endif
        <table style="width: 100%; text-align: center; background-color: #ffffff; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
            <tbody>
                <tr>
					<td rowspan="7" style="width: 20%; vertical-align: middle; padding-right: 10px;">
						<img src="{{ asset('imagenes/sucursales/'.$pago_servicio->sucursal->foto) }}" style="margin: 0; height: 100px;">
					</td>
					<td rowspan="7" style="width: 60%; text-align: left; padding-left: 20px; font-size: 13px; border-left:1px solid #ddd;">
						<strong style="color: #013565;">{{ mb_strtoupper($clinica->nombre_clinica) }}</strong><br>
						<strong>{{ $pago_servicio->sucursal->numero === 0 ? 'Casa Matriz' : 'Sucursal ' . $pago_servicio->sucursal->numero }}</strong><br>
						{{ $pago_servicio->sucursal->direccion }}<br>
						{{ $pago_servicio->sucursal->email }}<br>
						<strong style="color: #013565;">La Paz - Bolivia</strong>
					</td>
					<td rowspan="7" style="width: 20%; vertical-align: middle; font-size: 10px; background-color: #f9f9f9; border: 1px solid #ddd; padding: 2px; text-align: center; border-radius: 10px;">
						<h5 style="margin: 0; font-size: 16px; font-weight: bold; color: #013565;">
							<strong>PAG: </strong>{{ str_pad($pago_servicio->numero_correlativo, 6, '0', STR_PAD_LEFT)}}
						</h5>
						<p style="margin: 0; font-size: 12px; color: #013565;">
							<strong>Pac: </strong>{{ $pago_servicio->paciente->codigo }}
						</p>
					</td>
					
				</tr>
				
            </tbody>
        </table>
        <table style="width: 100%; text-align: center;background-color: #ffffff; color: #013565; padding: 5px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
            <tbody>
                <tr>
                    <td rowspan="2" style="font-size: 18px; color: #013565;">
                        <b>COMPROBANTE DE PAGO</b>
                    </td>
                </tr>
            </tbody>
        </table>

        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
			DATOS GENERALES
		</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<tr>
				<th class="prin-table-header" width="10%">Emitido por:</th>
				<td class="prin-table-data" width="30%">
					{{ mb_strtoupper(ucwords(auth()->user()->nombre) . ' ' . ucwords(auth()->user()->paterno) . ' ' . ucwords(auth()->user()->materno), 'UTF-8') }}
				</td>						
				<th class="prin-table-header" width="10%">Descripción:</th>
				<td colspan="3" class="prin-table-data" width="50%">{{ $pago_servicio->descripcion }}</td>
			</tr>
			<tr>
				<th class="prin-table-header">Paciente:</th>
				<td class="prin-table-data">
					{{ mb_strtoupper($pago_servicio->paciente->nombre . ' ' . $pago_servicio->paciente->paterno . ' ' . $pago_servicio->paciente->materno, 'UTF-8') }}
				</td>
				<th class="prin-table-header">CI:</th>
				<td class="prin-table-data">{{ $pago_servicio->paciente->ci }}</td>
				<th class="prin-table-header">Fecha Emisión:</th>
				<td class="prin-table-data">
					{{ date('d-m-Y H:i:s', strtotime($pago_servicio->fecha_registro)) }}
				</td>
			</tr>
		</table>

        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
			DETALLE DE PAGO
		</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th class="prin-table-header" style="text-align: center;" width="5%">#</th>
					<th class="prin-table-header" width="15%">COD - Planificación</th>
					<th class="prin-table-header" width="30%">Servicio</th>
					<th class="prin-table-header" width="35%" colspan="2">Detalle</th>
					<th class="prin-table-header" width="15%" style="text-align: center;">Monto</th>
				</tr>
			</thead>
			<tbody>
				@php
					$total 		 = 0;
					$numero_fila = 1;
				@endphp
				@foreach($pago_servicio->pagoDetalle as $detalle)
					<tr>
						<td class="prin-table-data" style="text-align: center;">{{ $numero_fila++ }}</td>
						<td class="prin-table-data">{{ $detalle->planificacion->nombre }}</td>
						<td class="prin-table-data">
							<strong>{{ $detalle->servicio->descripcion_servicio }}</strong><br>
							Esp. {{ $detalle->servicio->descripcion_especialidad }}
						</td>
						<td colspan="2" class="prin-table-data">{{ $detalle->descripcion }}</td>
						<td class="prin-table-data" style="text-align: right;">{{ $detalle->monto }}</td>
					</tr>
					@php
						$total += $detalle->monto;
					@endphp
				@endforeach
				<tr>
					<td colspan="4" rowspan="3"><strong>Son: {{ montoLetras($total) }}</strong></td>
					<td class="prin-table-header" style="text-align: right;"><strong>Monto Total:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $total }}</strong></td>
				</tr>
				<tr>
					<td class="prin-table-header" style="text-align: right;"><strong>Monto Cancelado:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $pago_servicio->monto_pago }}</strong></td>
				</tr>
				<tr>
					<td class="prin-table-header" colspan="1" style="text-align: right;"><strong>Cambio:</strong></td>
					<td class="prin-table-data" style="text-align: right;"><strong>{{ $pago_servicio->monto_cambio }}</strong></td>
				</tr>
			</tbody>
		</table>
        
    </div>
	{{-- Marca de Agua Ultima hoja --}}
	<div class="watermark">
		<p>MONTOS EXPRESADOS EN BOLIVIANOS</p>
		<p><strong>{{ mb_strtoupper($pago_servicio->sucursal->nombre, 'UTF-8') }}</strong></p>
		<p>AGRADECEMOS SU CONFIANZA</p>
	</div>
	{{-- Pie de Pagina --}}
	{{-- <div class="footer">
		<p><strong style="color: #013565;">Nota aclaratoria: </strong>Este presupuesto puede estar sujeto a cambios que surgen durante el tratamiento</p>
	</div> --}}
</body>
</html>