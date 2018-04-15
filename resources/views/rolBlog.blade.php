<li>
	<a href="#">
		<i class="fa fa-menu-arrow pull-right"></i>
		<i class="main-icon fa fa-rss"></i> <span>Reservaciones</span>
	</a>
	<ul><!-- submenus -->


	@if (Auth::user()->str_rol == "Administrador")

		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				Autores
			</a>
			<ul>
				<li><a href="{{ route('registrarAu')}}">Nuevo</a></li>
				<li><a href="{{ route('buscarCuentaAu')}}">Buscar</a></li>
			</ul>
		</li>
		
	@endif




		<li>
			<a href="#">
				<i class="fa fa-menu-arrow pull-right"></i>
				Post
			</a>
			<ul>
				<li><a href="{{ route('registrarPost')}}">Nuevo</a></li>
				<li><a href="{{ route('buscarPost')}}">Buscar</a></li>
			</ul>
		</li>
	</ul>
</li>