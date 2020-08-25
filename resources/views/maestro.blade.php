
<!DOCTYPE html>
<html lang="es">
<head>
  @include('estructura.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
   <div class="wrapper">
      @include('estructura.nav')
    @include('estructura.aside')
 <div class="content-wrapper">
     <div class="container-fluid" >@yield('contenido')
        


      </div>
  </div>
  <!-- /.content-wrapper -->
</body>
@include('estructura.footer')

</html>





 <!-- Content Wrapper. Contains page content -->

  