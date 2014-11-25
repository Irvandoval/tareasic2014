
<?php

function menu()
{
echo
"

<nav id='menu-wrap'>    
	<ul id='menu'>
	    
		<li><a href='#'>Inicio</a></li>
		<li>
			<a href=''>Usuarios</a>
			<ul>
				<li>
					<a href=''>Empleados</a>
					<ul>
						
						<li><a href='empleados/empleadosAgregar.php'>Agregar Empleado</a></li>
						<li><a href='empleados/empleadosActualizar.php'>Actualizar Empleado</a></li>
						<li><a href='empleados/empleadosEliminar.php'>Eliminar Empleado</a></li>
						<li><a href='empleados/empleadosPlanilla.php'>Planilla Empleado</a></li>
					</ul>				
				</li>
				<li>
					<a href=''>Administrador</a>

					<ul>
						<li><a href='usuarios/usuarioAgregar.php'>Agregar Usuario</a></li>
						<li><a href='usuarios/usuarioActualizar.php'>Actualizar Usuario</a></li>	
						<li><a href='usuarios/usuarioEliminar.php'>Eliminar Usuario</a></li>					
						<li><a href='usuarios/Contabilidad.php'>Contabilidad</a></li>
						<li><a href='usuarios/cerrarPeriodo.php'>Cerrar Periodo</a></li> 
					</ul>				
				</li>
			</ul>
		</li>
		

		
		<li>
			<a href=''>Contabilidad</a>
			<ul>

				<li>
					<a href=''>Inventario</a>
					<ul>
						<li> <a href='Inventario/InventarioMercaderia.php'>Mercaderia Disponible</a></li>
						<li><a href='Inventario/Inventario.php'>Costo Promedio</a></li>
					</ul>					
				</li>
				<li>
					<a href=''>Contabilidad General</a>
					<ul>
						<li><a href=''>Catalogo de Cuentas</a></li>

						<li>
							<a href=''>Estados Financieros</a>
							<ul>
								<li><a href='libroDiario/librodiario.php'>Libro Diario</a></li>
								<li><a href='balanceComprobacion/balanceComprobacionAnual.php'>Balance de Comprobacion</a></li>
								<li><a href='estadoResultados/EstadoResultado.php'>Estado de Resultados</a></li>
								<li><a href='estadoCapital/EstadoCapital.php'>Estado de Capital</a></li>
								<li><a href='balanceGeneral/BalanceGeneral.php'>Balance General</a></li>
							</ul>							
						</li>

						<li>
							<a href=''>Contabilidad de Costos</a>
							<ul>
								<li><a href='contabilidadCostos/ordenfabricacion.php'>Ordenes de Fabricacion</a></li>
							</ul>							
						</li>
					</ul>					
				</li>
			</ul>		
		</li>		
		<li><a href='Ajustes/index.php'>Ajustes Contables</a></li>
		<li><a href='Conexion/Finalizar.php'>Finalizar</a></li>
	</ul>
</nav>


";

}


function menu2()
{
echo
"

<nav id='menu-wrap'>    
	<ul id='menu'>
	    
		<li><a href='../inicio.php'>Inicio</a></li>

		<li>
			<a href=''>Usuarios</a>
			<ul>
				<li>
					<a href=''>Empleados</a>
					<ul>
						<li><a href='../empleados/empleadosAgregar.php'>Agregar Empleado</a></li>
						<li><a href='../empleados/empleadosActualizar.php'>Actualizar Empleado</a></li>
						<li><a href='../empleados/empleadosEliminar.php'>Eliminar Empleado</a></li>
						<li><a href='../empleados/empleadosPlanilla.php'>Planilla Empleado</a></li>
					</ul>				
				</li>
		        <li>
					<a href=''>Administrador</a>

					<ul>
						<li><a href='../usuarios/usuarioAgregar.php'>Agregar Usuario</a></li>
						<li><a href='../usuarios/usuarioActualizar.php'>Actualizar Usuario</a></li>	
						<li><a href='../usuarios/usuarioEliminar.php'>Eliminar Usuario</a></li>					
						<li><a href='../usuarios/Contabilidad.php'>Contabilidad</a></li>
						<li><a href='../usuarios/cerrarPeriodo.php'>Cerrar Periodo</a></li>
					</ul>				
				</li>

			</ul>
		</li>
		<li>
			<a href=''>Contabilidad</a>
			<ul>

				<li>
					<a href=''>Inventario</a>
					<ul>
						<li> <a href='../Inventario/InventarioMercaderia.php'>Mercaderia Disponible</a></li>
						<li><a href='../Inventario/Inventario.php'>Costo Promedio</a></li>
					</ul>					
				</li>
				<li>
					<a href=''>Contabilidad General</a>
					<ul>
						<li><a href='../catalogoCuentas/catalogo.php'>Catalogo de Cuentas</a></li>

						<li>
							<a href=''>Estados Financieros</a>
							<ul>
								<li><a href='../librodiario/librodiario.php'>Libro Diario</a></li>
								<li><a href='../balanceComprobacion/balanceComprobacionAnual.php'>Balance de Comprobacion</a></li>
								<li><a href='../estadoResultados/EstadoResultado.php'>Estado de Resultados</a></li>
								<li><a href='../estadoCapital/EstadoCapital.php'>Estado de Capital</a></li>
								<li><a href='../balanceGeneral/BalanceGeneral.php'>Balance General</a></li>
							</ul>							
						</li>

						<li>
							<a href=''>Contabilidad de Costos</a>
							<ul>
								<li><a href='../contabilidadCostos/ordenfabricacion.php'>Ordenes de Fabricacion</a></li>
							</ul>							
						</li>
					</ul>					
				</li>
			</ul>		
		</li>		
        <li><a href='../Ajustes/index.php'>Ajustes Contables</a></li>
		<li><a href='../Conexion/Finalizar.php'>Finalizar</a></li>
	</ul>
</nav>


";

}


?>

