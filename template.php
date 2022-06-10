<?php
  include_once 'config/user_session.php';
  $userSession = new UserSession();
  if( !isset($_SESSION['user'])){
    header("Location: views/login.php");
  } 
  ?>
<!DOCTYPE html>
<!--
Template Name: Nekmit
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Copyright: OS-Templates.com
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>INFRA</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay padtop" style="background-image:url('images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      <!-- ################################################################################################ -->
      <h1><a href="template.php">I N F R A</a></h1>
      <!-- ################################################################################################ -->
    </div>
    <nav id="mainav" class="fl_right"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li class="active"><a href="template.php">Home</a></li>
        <li><a class="drop" href="#">Relación de Contratos</a>
          <ul>
            <li><a href="views/full-width.php?frame=list_proyectos.php">Proyectos</a></li>
            <li><a href="views/full-width.php?frame=list_contratos.php">Contratos</a></li>
            <li><a href="views/full-width.php?frame=crear_list_contratista.php">Contratistas</a></li>
            <li><a href="views/full-width.php?frame=list_certificado.php">Rubros</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Matriz Exportable</a>
          <ul>
            <li><a href="views/full-width.php?frame=groups_hitos.php">Hitos Obra</a></li>
            <li><a href="views/full-width.php?frame=groups_coordenadas.php">Coordenadas Obras</a></li>
            <li><a href="views/full-width.php?frame=groups_seguimiento.php">Seguimiento Obras</a></li>
          </ul>
        </li>
        <li><a href="views/cerrar_session.php">Salir</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </nav>
  </header>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="pageintro" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <article>
      <h3 class="heading">Herramienta TIC</h3>
      <p>Permiten la automatización de tareas rutinarias mediante sistemas informáticos, dedicar más tiempo a tareas más productivas, bien utilizadas  permiten a las empresas producir más cantidad,  en menor tiempo y mejor calidad.</p>
    </article>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <section id="ctdetails" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul class="nospace clear">
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-envelope"></i></a> <span><strong>Envianos un correo:</strong> propuestowps@gmail.com</span></div>
      </li>
      <li class="one_quarter">
        <div class="block clear"><a href="#"><i class="fas fa-clock" ></i></a> <span><strong> Lun. - Vier.:</strong> 08.00am - 18.00pm</span></div>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <section id="services">
      <div class="sectiontitle">
        <h6 class="heading">Funcionalidades de herramienta</h6>
      </div>
      <ul class="nospace group grid-3">
        <li class="one_third">
          <article><a href="#"><i class="fas fa-database"></i></a>
            <h6 class="heading">Almacenamiento</h6>
            <p>Rapidez en el acceso para recuperarlos tras su pérdida, por causas ajenas a la empresa u otros incidentes, cuándo y cómo quieras. El objetivo siempre será minimizar el tiempo de inoperancia y restauración de la información perdida.</p>
          </article>
        </li>
        <li class="one_third">
          <article><a href="#"><i class="fas fa-file-excel"></i></a>
            <h6 class="heading">Exportaciones Automatizadas</h6>
            <p>Permite la creación automatica de formatos de archivo de hoja de cálculo, en forma de CSV usado por la oficina.</p>
          </article>
        </li>
        <li class="one_third">
          <article><a href="#"><i class="fas fa-search"></i></a>
            <h6 class="heading">Buscador y Formularios</h6>
            <p>La ventaja más clara de cualquier buscador es el ahorro de tiempo, solo con teclear el nombre del archivo que necesitas. Ademas los formularios le dan dinamismo en el momento de ingresar nuevos registros.</p>
          </article>
        </li>
      </ul>
    </section>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fas fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>
</body>
</html>
<?php include('views/footer.php');?>