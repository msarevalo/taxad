<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

    <title>TAXAD</title>
    <link rel="shortcut icon" href="../../img/logo.ico" />
</head>
<body>
	<div class="container-fluid p-0">
  
<!-- Bootstrap row -->
<style type="text/css">
	@import url('https://fonts.googleapis.com/css?family=Montserrat');

/*-------------------------------- END ----*/
    #body-row {
        margin-left: 0;
        margin-right: 0;
    }

    #sidebar-container {
        min-height: 100vh;
        background-color: #132644;
        padding: 0;
        /* flex: unset; */
    }
    
    .sidebar-expanded {
        width: 230px;
    }
    
    .sidebar-collapsed {
        /*width: 60px;*/
        width: 100px;
    }

    /* ----------| Menu item*/    
    #sidebar-container .list-group a {
        height: 50px;
        color: white;
    }

    /* ----------| Submenu item*/    
    #sidebar-container .list-group li.list-group-item {
        background-color: #132644;
    }
    
    #sidebar-container .list-group .sidebar-submenu a {
        height: 45px;
        padding-left: 30px;
    }
    
    .sidebar-submenu {
        font-size: 0.9rem;
    }

    /* ----------| Separators */    
    .sidebar-separator-title {
        background-color: #132644;
        height: 35px;
    }
    
    .sidebar-separator {
        background-color: #132644;
        height: 25px;
    }
    
    .logo-separator {
        background-color: #132644;
        height: 60px;
    }
    
    a.bg-dark {
        background-color: #132644 !important;
    }

</style>
<script type="text/javascript">
	// Hide submenus
$('#body-row .collapse').collapse('hide'); 

// Collapse/Expand icon
$('#collapse-icon').addClass('fa-angle-double-left'); 

// Collapse click
$('[data-toggle=sidebar-colapse]').click(function() {
    SidebarCollapse();
});

function SidebarCollapse () {
    $('.menu-collapsed').toggleClass('d-none');
    $('.sidebar-submenu').toggleClass('d-none');
    $('.submenu-icon').toggleClass('d-none');
    $('#sidebar-container').toggleClass('sidebar-expanded sidebar-collapsed');
    
    // Treating d-flex/d-none on separators with title
    var SeparatorTitle = $('.sidebar-separator-title');
    if ( SeparatorTitle.hasClass('d-flex') ) {
        SeparatorTitle.removeClass('d-flex');
    } else {
        SeparatorTitle.addClass('d-flex');
    }
    
    // Collapse/Expand icon
    $('#collapse-icon').toggleClass('fa-angle-double-left fa-angle-double-right');
}
</script>
<div class="row" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block"><!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
        <!-- Bootstrap List Group -->
        <ul class="list-group">
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>TAXAD | Taxi Administrator</small>
            </li>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/account.png" style="width: 20px"></span>
                    <span class="menu-collapsed">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
                </div>
            </a>
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>ADMINISTRACION</small>
            </li>
            <!-- /END Separator -->
            <!-- Menu with submenu -->
            @if(Auth::user()->perfil!==3)
            <a href="{{ route('home') }}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/dashboard.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Dashboard</span>
                </div>
            </a>
            <!-- Submenu content -->
            <!--
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Charts</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Reports</span>
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Tables</span>
                </a>
            </div>-->
            @if(Auth::user()->perfil===1)
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/user.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Usuarios</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="{{ route('admin') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Administradores</span>
                </a>
                <a href="{{ route('conductor') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Conductores</span>
                </a>
                <a href="{{ route('socios') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Socios</span>
                </a>
            </div>  
            @else
            <a href="{{ route('conductor') }}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/user.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Conductores</span>
                </div>
            </a>
            @endif
            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/vehicle.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Taxis</span> 
                    <span class="submenu-icon ml-auto"></span>   
                </div>
            </a>
            <div id='submenu3' class="collapse sidebar-submenu">
                <a href="{{ route('marcas') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Marcas</span>
                </a>
                <a href="{{ route('taxis') }}" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Vehiculos</span>
                </a>
            </div>
            @endif
            <!-- Separator with title -->
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed">
                <small>OPCIONES</small>
            </li>
            <!-- /END Separator -->
            <a href="{{ route('calendario') }}" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/calendar.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Calendario</span>
                </div>
            </a>
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-envelope-o fa-fw mr-3"><img src="../../img/notification.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Notificaciones<span class="badge badge-pill badge-primary ml-2">5</span></span>
                </div>
            </a>
            <!-- Separator without title -->
            
            <!-- /END Separator -->
            <a href="#" class="bg-dark list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-fw mr-3"><img src="../../img/help.png" style="width: 20px"></span>
                    <span class="menu-collapsed">Ayuda</span>
                </div>
            </a>
            <a href="{{ route('logout') }}" data-toggle="sidebar-colapse" class="bg-dark list-group-item list-group-item-action d-flex align-items-center" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span id="collapse-icon" class="fa fa-2x mr-3"><img src="../../img/logout.png" style="width: 20px"></span>
                    <span id="collapse-text" class="menu-collapsed">Cerrar Sesión</span>
                </div>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <!-- Logo -->
            <li class="list-group-item logo-separator d-flex justify-content-center">
                <img src='../../img/logo100x100.png' width="30" height="30" />    
            </li>   
        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col">
        
        <div class="container">
    @yield('formulario')
</div>
       


    </div><!-- Main Col END -->
    
</div><!-- body-row END -->
  
  
</div><!-- container -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
@yield('scripts')