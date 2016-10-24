<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <title>PokémonDex</title>
    <link href="{{asset ("css/bootstrap.min.css")}}" rel="stylesheet">
    <link href="{{asset ("css/simple-sidebar.css")}}" rel="stylesheet">
    <link href="{{asset ("css/shop-homepage.css")}}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{asset ("/images/xy.png")}}">

</head>

<body>

     <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="{{url('/home')}}">Inicio</a>
                <a class="navbar-brand" href="{{url('/duelo')}}">Batalla</a>
                <a class="navbar-brand" href="#menu-toggle" id="menu-toggle">Pokémons</a>
                <img class="img" src="{{asset ("images/pokeball.png")}}" width="20" height="20">
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>



    <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">

                <li class="sidebar-brand">
                    <a>Pokémons tipo:</a>
                </li>

                @foreach($tipos as $t)
                <li>
                    <a href="{{url('/mostrarPokemons')}}/{{$t->id}}">{{$t->tipo}}</a>
                </li>
                @endforeach

            </ul>
        </div>
        <!-- /#sidebar-wrapper -->

            <!--Seccion donde se mostraran los pokemons-->
        <section>

                 @foreach($tCaramelos as $tc)
                    <h4 class="text-right">Caramelos x {{$tc->total_caramelos}}<img src="{{asset ("images/caramelo.png")}}" height="20"></h4>
                @endforeach

                    @yield('encabezado')
                    <hr>
                    @yield('contenido')

        </section>


        <div class="container">
             <hr>
             <!-- Footer -->
                <center>
                    <footer>
                        <p>&copy; Ing.Web 2016 Pokémon  <img src="{{asset ("images/Pika.gif")}}" width="40" height="40"> </p>
                    </footer>
                </center>
         </div>


    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="{{asset ("js/jquery.js")}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset ("js/bootstrap.min.js")}}"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
	@yield('script')

</body>

</html>
