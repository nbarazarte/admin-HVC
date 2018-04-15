@extends('app')

@section('content')

            <!-- -->
            <section id="slider" class="fullheight dark">

                <div class="display-table">
                    <div class="display-table-cell vertical-align-middle">
                        <div class="container">

                            <div class="row err-404-row">
                                <div class="text-center col-md-8 col-xs-12 col-md-offset-2">
                        
                                    <h1 class="fa fa-frown-o size-100 theme-color hidden-xs"></h1>
                                    <h2><strong>Acceso Restringido</strong></h2>

                                    <p>Usted no tiene permiso para entrar en esta sección.</p>

                                    <a href="{{ route('home')}}">Volver al inicio</a>

                                </div>

                            </div>
                
                        </div>
                    </div>
                </div>

            </section>
            <!-- / -->
@endsection            