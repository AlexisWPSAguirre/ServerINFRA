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
<title>Nekmit | Pages | Full Width</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
<div class="bgded overlay padtop" style="background-image:url('../images/demo/backgrounds/01.png');"> 
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <header id="header" class="hoc clear">
    <div id="logo" class="fl_left"> 
      <!-- ################################################################################################ -->
      <h1><a href="../index.php">I N F R A</a></h1>
      <!-- ################################################################################################ -->
    </div>
    <nav id="mainav" class="fl_right"> 
      <!-- ################################################################################################ -->
      <ul class="clear">
        <li class="active"><a href="../index.php">Home</a></li>
        <li><a class="drop" href="#">Relación de Contratos</a>
          <ul>
            <li><a href="../views/full-width.php?frame=list_proyectos.php">Proyectos</a></li>
            <li><a href="../views/full-width.php?frame=list_contratos.php">Contratos</a></li>
            <li><a href="../views/full-width.php?frame=crear_list_contratistas.php">Contratistas</a></li>
            <li><a href="../views/full-width.php?frame=list_certificado.php">Rubros</a></li>
          </ul>
        </li>
        <li><a class="drop" href="#">Matriz Exportable</a>
          <ul>
            <li><a href="../views/full-width.php?frame=groups_hitos.php">Hitos Obra</a></li>
            <li><a href="../views/full-width.php?frame=groups_coordenadas.php">Coordenadas Obras</a></li>
            <li><a href="../views/full-width.php?frame=groups_seguimiento.php">Seguimiento Obras</a></li>
          </ul>
        </li>
        <li><a href="#">Salir</a></li>
      </ul>
      <!-- ################################################################################################ -->
    </nav>
  </header>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="breadcrumb" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
    <!-- main body -->
    <!-- ################################################################################################ -->

      <!-- ################################################################################################ -->
      <?php
        if(isset($_GET['frame'])){          
          require_once $_GET['frame'];
        }
      ?>
      <!-- ################################################################################################ -->
    
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
