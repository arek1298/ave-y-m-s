<?php include "header.php"; ?>

<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Gestor de Archivos</h1>
   <div id="tablaGestordeArchivos"></div>
</div>

<?php include "footer.php"; ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaGestordeArchivos').load("gestor/tablaGestor.php");
    })
</script>