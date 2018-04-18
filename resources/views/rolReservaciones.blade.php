<li>
	<a href="#">
		<i class="fa fa-menu-arrow pull-right"></i>
		<i class="fa fa-bed" aria-hidden="true"></i> <span>Reservaciones</span>
	</a>
	<ul><!-- submenus -->


	@if (Auth::user()->str_rol == "Administrador")

		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				Clientes
			</a>
			<ul>
				<li><a href="{{ route('registrarCli')}}">Crear Cliente</a></li>
				<li><a href="{{ route('buscarCuentaCli')}}">Buscar Cliente</a></li>
			</ul>
		</li>
		
	@endif

		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				Reservación
			</a>
			<ul>
				<li><a href="{{ route('buscarReservacion')}}">Buscar Reservación</a></li>
			</ul>
		</li>
	</ul>
</li>