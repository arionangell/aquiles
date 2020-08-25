
<!DOCTYPE html>
<html lang="es">
<head>
  @include('estructura.header')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    
      @include('estructura.nav')
      @include('estructura.aside')


        <div class="content-wrapper">
  
          <section class="content">
            <div class="container-fluid"@yield('contenido')>
        


            </div>
          </section>
        </div>

  <!-- /.content-wrapper -->
</body>
@include('estructura.footer')

</html>





 <!-- Content Wrapper. Contains page content -->

  