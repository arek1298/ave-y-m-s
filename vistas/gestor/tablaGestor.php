<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-hover" id=""tablaGestorDataTable>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Tipo de archivo</td>
                        <td>Descarga</td>
                        <td>Visualizar</td>
                        <td>Eliminar</td>

                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <span class="btn btn-danger btn-sm">
                            <span class="fa-solid fa-trash-can"></span>
</span>
</td>

                       
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#tablaGestorDataTable').DataTable()
    });
    </script>