<ul class="sidebar-menu">
    <li class="header">Navegación</li>
    <!-- Optionally, you can add icons to the links -->
    <li {{request()->is('admin') ? 'class=active' : ''}}><a href="{{route('dashboard')}}"><i class="fa fa-tachometer"></i> <span>Inicio</span></a></li>

    <li class="treeview {{request()->is('admin/complejos*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-home"></i> <span>Complejos</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/complejos') ? 'class=active' : ''}}><a href="{{route('admin.complejo.index')}}"><i class="fa fa-eye"></i>Mis Complejos</a></li>
        <li >
          
          <a href="{{route('admin.complejo.create')}}"><i class="fa fa-pencil"></i>Crear Complejo</a>
        
        </li>
      </ul>
    </li>

@can('View Cancha') 
<li class="treeview {{request()->is('admin/canchas*') ? 'active' : ''}}"> 

      <a href="#"><i class="fa fa-futbol-o"></i> <span>Canchas</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
    
        <li {{request()->is('admin/canchas') ? 'class=active' : ''}}><a href="{{route('admin.cancha.index')}}"><i class="fa fa-eye"></i>Ver Mis Canchas</a></li>

        @can('Create Cancha')
        <li >
          @if (request()->is('admin/canchas/*'))
          <a href="{{route('admin.cancha.index', '#create')}}"><i class="fa fa-pencil"></i>Crear Cancha</a>
          @else
          <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>Crear Cancha</a>
          @endif
        </li>
        @endcan
      </ul>
    </li>
    @endcan


    <li class="treeview {{request()->is('admin/horarios*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-clock-o"></i> <span>Horarios</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/horarios') ? 'class=active' : ''}}><a href="{{route('admin.horarios.index')}}"><i class="fa fa-eye"></i>Ver lista de horarios</a></li>
        <li >
          
          <a href="{{route('admin.horarios.create')}}"><i class="fa fa-pencil"></i>Crear Horario</a>
         
        </li>
      </ul>
    </li>



    
    @can('View Users')
    <li class="treeview {{request()->is('admin/users*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/users') ? 'class=active' : ''}}><a href="{{route('admin.users.index')}}"><i class="fa fa-eye"></i>Ver todos los Usuarios</a></li>
        <li >
          <a href="{{route('admin.users.create')}}"><i class="fa fa-pencil"></i>Crear usuario</a>
        </li>
      </ul>
    </li>
    @endcan
    @can('View Roles')
    <li class="treeview {{request()->is('admin/roles*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-lock"></i> <span>Roles</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/roles') ? 'class=active' : ''}}><a href="{{route('admin.roles.index')}}"><i class="fa fa-eye"></i>Ver todos los Roles</a></li>
        <li >
          <a href="{{route('admin.roles.create')}}"><i class="fa fa-pencil"></i>Crear Roles</a>
        </li>
      </ul>
    </li>
    @endcan
    @can('View Permissions', new Spatie\Permission\Models\Permission)
    <li class="treeview {{request()->is('admin/permissions*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-ban"></i> <span>Permisos</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/permissions') ? 'class=active' : ''}}><a href="{{route('admin.permissions.index')}}"><i class="fa fa-eye"></i>Lista de Permisos</a></li>
      </ul>
    </li>
    @endcan
    
    <li class="treeview {{request()->is('admin/ganancias*') ? 'active' : ''}}"> 
      <a href="#"><i class="fa fa-line-chart"></i> <span>Ganancias</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu" >
        <li {{request()->is('admin/ganancias') ? 'class=active' : ''}}><a href="{{route('admin.ganancias.index')}}"><i class="fa fa-bar-chart-o"></i>Lista</a></li>
      </ul>
    </li>
</ul>