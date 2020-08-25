
  <aside class="main-sidebar elevation-4 sidebar-light-warning sidebar-no-expand" >
        <a href="{{url('/store')}}" class="brand-link">
           <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
           <span class="brand-text font-weight-light">SoftMaia</span>
        </a>

    <!-- Sidebar -->
       <div class="sidebar">
         <!-- Sidebar user (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
             <div class="image">
               <img src="{{asset('assets/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
             </div>
             <div class="info">
               <a href="#" class="d-block">{{ Auth::user()->name }} </a>
             </div>
           </div>

         <!-- Sidebar Menu -->
            <nav class="mt-2">
           <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
             <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->

                  @if( Auth::user()->id_role==1)

                  
             <li class="nav-item">
               <a href="{{url('/store')}}" class="nav-link">
                 <i class="nav-icon fa  fa-shopping-cart"></i><p>Pedidos</p>
               </a>
                <a href="{{url('/factura')}}" class="nav-link">
                 <i class="nav-icon fa   fa-sticky-note"></i><p>Facturacion</p>
               </a>
                <a href="{{url('/reparto')}}" class="nav-link">
                 <i class="nav-icon fa   fa-truck"></i><p>Repartidor</p>
               </a>

                <a href="{{url('/billetera')}}" class="nav-link">
                 <i class="nav-icon fa fa-calculator"></i><p>Billetera</p>
               </a>
            <a href="{{url('/tienda')}}" class="nav-link">
                 <i class="nav-icon fa fa-archive"></i><p>Tienda</p>
               </a>
             </li>
             
@else

<li class="nav-item">
                             
                <a href="{{url('/reparto')}}" class="nav-link">
                 <i class="nav-icon fa   fa-truck"></i><p>Repartidor</p>
               </a>

                <a href="{{url('/billetera')}}" class="nav-link">
                 <i class="nav-icon fa fa-calculator"></i><p>Billetera</p>
               </a>
   
             </li>

@endif
           </ul>
         </nav>
         <!-- /.sidebar-menu -->
       </div>
    <!-- /.sidebar -->
  </aside>
