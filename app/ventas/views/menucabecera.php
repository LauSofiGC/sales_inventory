<nav class="navbar navbar-expand-lg navbar-light" style="background-color:#AFEEEE">
    <a class="navbar-brand" href="#">
        Sales
    </a>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Productos
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/tipolistar.php">Listar Tipos de producto</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/tipocrear.php">Crear Tipo de producto</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/tipoadm.php">Administrar Tipos de producto</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/productolistar.php">Listar Productos</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/productocrear.php">Crear Producto</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/productoadm.php">Administrar Producto</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Tickets
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/tickettaxproductlistar.php">Listar facturas</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/taxlistar.php">Listar impuestos</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/taxcrear.php">Crear impuesto</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/taxadmin.php">Administrar impuestos</a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Personas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/proveedorlistar.php">Listar proveedores</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/proveedorcrear.php">Crear proveedor</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="/sales/app/ventas/views/personalistar.php">Listar Personas</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/personacrear.php">Crear Persona</a>
                </div>
            </li>
             <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Devoluciones
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/devolucionpendiente.php">Devoluciones pendientes</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/devolucionaprobada.php">Devoluciones aprobadas</a>
                    <a class="dropdown-item" href="/sales/app/ventas/views/admin/devolucionrechazada.php">Devoluciones rechazadas</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/sales/app/ventas/views/admin/reportes.php">Reportes</a>
            </li>
        </ul>
        <span class="navbar-text">
            <a href="/sales/public/login.php?msg=999"> <i class="fas fa-sign-out-alt"></i>Salir</a>
        </span>
    </div>
</nav>