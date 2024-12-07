<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>PDF - HISTORIAL CLÍNICO</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />
    </head>
    <style type="text/css">   
		body{font-family:Arial, sans-serif; font-size: 10px;}
		@page { margin-top: 30px; margin-left: 40px; margin-right: 40px; margin-bottom: 15px;}


		header { position: fixed; top: -125px; left: 0px; right: 0px; height: 70px;}
		footer { position: fixed; bottom: -40px; left: 0px; right: 0px; height: 50px; }

		.td-border-none{
		border: none !important;
		}

		.td-border-none{
		border: none !important;
		}

		.bold{
		font-weight: bold;
		}

		.text-muted{
		text-align: left;
		font-weight: bold;
		color: #1a5276 ;
		}

		.fila-secondary{
		background-color: #16a085;
		color: white;
		}

		.hr {
			border-bottom: 1px solid #000;
		}

		#container {
		   position: relative;
		}

		.watermark {
			position: absolute;
			top: 30%;
			left: 50%;
			transform: translate(-50%, -50%) rotate(-45deg);
			color: rgba(0, 0, 0, 0.3);
			font-size: 5rem;
			font-weight: bold;
			pointer-events: none;
			color: #e83e36;
		}
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
		/* Colores de Estado Servicio */
		/* Success Color */
		.text-success {
		color: #28a745;
		}

		/* Warning Color */
		.text-warning {
		color: #e78e00;
		}

		/* Danger Color */
		.text-danger {
		color: #dc3545;
		}

	</style>
<body>
	<div class="container">        
        <table style="width: 100%; text-align: center;">
            <tbody>
                <tr>
                    <td rowspan="7" style="width: 120px; vertical-align: middle;">
                        <img src="{{ asset($clinica->logo) }}" style="margin: 0; padding: 0; height: 100px;">
                    </td>
                    <td rowspan="7" colspan="2" style="font-size: 20px; color: #013565;">
                        <b>HISTORIAL CLÍNICO ODONTOLÓGICO</b>
                    </td>
                    <td rowspan="7" style="vertical-align: middle; font-size: 10px; background-color: #f9f9f9; border: 1px solid #ddd; padding: 2px; text-align: center; border-radius: 10px;">
                        <h3 style="margin: 0; font-size: 20px; font-weight: bold; color: #013565;">
                            {{ $paciente->codigo }} <br>
                            <small style="color:black; font-size: 10px;">CÓDIGO</small>
                        </h3>
                    </td>
                    
                </tr>
            </tbody>
        </table>

        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">DATOS DEL PACIENTE</h3>
        <p>La sección de Datos del Paciente ha sido completada con éxito. A continuación, se tiene la información recopilada para brindarle una atención dental personalizada y eficiente.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
            <tr>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">APELLIDO PATERNO</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">APELLIDO MATERNO</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">NOMBRE</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">CI</th>
            </tr>
            <tr>
                <td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->paterno, 'UTF-8') }}</td>
                <td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->materno, 'UTF-8') }}</td>
                <td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->nombre, 'UTF-8') }}</td>
                <td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->ci, 'UTF-8') }}</td>
            </tr>
            <tr>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">FECHA DE NACIMIENTO</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">ESTADO CIVIL</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">GÉNERO</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">EMAIL</th>
            </tr>
            <tr>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ date('d-m-Y', strtotime($paciente->fecha_nacimiento)) }}</td>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->estadoCivil->nombre, 'UTF-8') }}</td>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->genero->nombre, 'UTF-8') }}</td>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ $paciente->email }}</td>
            </tr>
            <tr>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">OCUPACIÓN</th>
                <th style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">CELULAR</th>
                <th colspan="2" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">DIRECCIÓN</th>
            </tr>
            <tr>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ mb_strtoupper($paciente->ocupacion, 'UTF-8') }}</td>
                <td style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ $paciente->celular }}</td>
                <td colspan="2" style="font-size: 10px; background-color: white; border: 1px solid #ddd; padding: 5px; text-align: center;">{{ $paciente->direccion }}</td>
            </tr>
        </table>
        
        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">ANTECEDENTES ALÉRGICOS</h3>
        <p>La sección de Antecedentes Alérgicos ha sido registrada minuciosamente. A continuación, se presenta la información recopilada para personalizar su tratamiento dental, teniendo en cuenta posibles reacciones alérgicas y efectos secundarios.<p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_alergias as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
        
        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">ANTECEDENTES DE MEDICAMENTOS</h3>
        <p>La sección de Antecedentes de Medicamentos ha sido registrada minuciosamente. A continuación, se tiene la información recopilada para personalizar su tratamiento dental teniendo en cuenta posibles interacciones y efectos secundarios.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_medicamentos as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		        
        <h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">ANTECEDENTES DE ENFERMEDADES</h3>
        <p>En la sección de Antecedentes de Enfermedades, hemos registrado detalles sobre enfermedades previas o actuales relevantes para su salud bucal. A continuación, se tiene la información recopilada para adaptar estrategias de tratamiento específicas para usted.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_enfermedades as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
        
		<h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">ANTECEDENTES FAMILIARES</h3>
        <p>Los Antecedentes Familiares han sido documentados para evaluar posibles influencias en su salud dental. A continuación, se tiene la información recopilada para personalizar enfoques preventivos y de tratamiento.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_familiares as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
        
		<h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">ANTECEDENTES DE CIRUGIAS</h3>
        <p>La sección de Antecedentes de Cirugías ha sido completada. A continuación, se tiene la información recopilada para planificar tratamientos dentales seguros y efectivos, considerando cualquier intervención quirúrgica previa.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_cirugias as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>
		
		<h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">OTROS ANTECEDENTES</h3>
		<p>Aquí se encuentrá la información adicional relevante que no se haya incluido en las secciones anteriores. Esto podría incluir antecedentes médicos o condiciones que no estén específicamente relacionadas con cirugías o medicamentos, pero que aún son importantes para la atención dental.</p>
        <table style="width: 100%; border-collapse: collapse; margin-top: 5px; border: 1px solid #ddd; border-radius: 8px;">
			<thead>
				<tr>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Fecha Registro</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Descripción</th>
					<th width="10%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Última Modificación</th>
					<th width="40%" style="font-size: 10px; background-color: #f9f9f9; color: #013565; border: 1px solid #ddd; padding: 5px; text-align: center;">Observación</th>
				</tr>
			</thead>
			<tbody>
				@forelse($grupo_ant_otros as $registro)
					@php $numDetalles = count($registro['array']); @endphp <!-- Obtener el número de detalles en el grupo -->
					@foreach($registro['array'] as $index => $detalle)
						<tr>
							<!-- Mostrar la fecha solo en la primera fila del grupo -->
							@if($index === 0)
								<td rowspan="{{ $numDetalles }}" style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
									<small class="text-muted">{{ $registro['fecha'] }}</small>
								</td>
							@endif
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								{{ $detalle['nombre'] }}
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['fecha_actualizacion'])
									<small class="text-muted">{{ $detalle['fecha_actualizacion'] }}</small>
								@else
									-
								@endif
							</td>
							<td style="font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">
								@if($detalle['motivo_baja'])
									{{ $detalle['motivo_baja'] }}
								@else
									-
								@endif
							</td>
						</tr>
					@endforeach
				@empty
					<tr>
						<td colspan="4" style="text-align: center; font-size: 11px; background-color: white; border: 1px solid #ddd; padding: 5px;">No hay registros.</td>
					</tr>
				@endforelse
			</tbody>
		</table>

		{{-- ! PLANIFICACIONES --}}
		<h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">PLANIFICACIONES ODONTOLÓGICAS</h3>
		<p>A continuación, se muestra un resumen detallado de las planificaciones odontológicas solicitadas y programadas para el paciente, incluyendo servicios, costos y profesionales responsables.</p>
		@foreach($planificaciones as $index => $planificacion)
		<h3 style="background-color: #f0eeee; color: #013565; padding: 8px; margin: 10px 0 0; border: 1px solid #ddd; border-radius: 8px;">
			{{ $index + 1 }}. Planificación COD: <span style="color: #ff0000;">{{ $planificacion->nombre }}</span>
		</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1px; border: 1px solid #ddd; border-radius: 8px;">
			<tr>
				<th class="prin-table-header" width="10%">Creado por:</th>
				<td class="prin-table-data" width="30%">
					{{ mb_strtoupper($planificacion->usuario->nombre . ' ' . $planificacion->usuario->paterno . ' ' . $planificacion->usuario->materno, 'UTF-8') }}
				</td>				
				<th class="prin-table-header" width="15%">Fecha de creación:</th>
				<td class="prin-table-data" width="15%">{{ date('d-m-Y', strtotime($planificacion->created_at)) }}</td>
				<th class="prin-table-header" width="15%">Estado Proforma:</th>
				<td class="prin-table-data" width="15%">
					@if(strtotime($planificacion->fecha_vencimiento) < strtotime(now()) && $planificacion->cod_plan_estado == 1)
						<span style="color: red;">Proforma Vencida</span>
					@else
						{{ $planificacion->planificacionEstado->nombre }}
					@endif
				</td>
			</tr>
		</table>
        <table style="width: 100%; border-collapse: collapse; margin-top: 1px; border: 1px solid #ddd; border-radius: 8px;">
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
							<b class="text-{{ $servicio->planificacionServicioEstado->color }}">{{ $servicio->planificacionServicioEstado->nombre }}</b><br>
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
		@endforeach
    </div>    

</body>
</html>