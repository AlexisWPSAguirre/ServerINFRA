$(document).ready(function(){
   /*  $('#btn_search').click(function(e){
        e.preventDefault(); 
        var sistema = getSearch();
        alert(sistema);
        location.href = sistema+'views/buscar.php?search='+$(this).val();
    }); */
    $('#search_anio_proyecto').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_proyectos.php&anio='+$(this).val(); 
    });
    $('#search_anio_contratista').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=crear_list_contratistas.php&anio='+$(this).val(); 
    });
    $('#search_anio_contrato').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos.php&anio='+$(this).val(); 
    });
    $('#h_contrato_select').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&select=hito&anio='+$(this).val(); 
    });
    $('#c_contrato_select').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&select=coordenada&anio='+$(this).val(); 
    });
    $('#s_contrato_select').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&select=seguimiento&anio='+$(this).val(); 
    });
    $('#h_contrato_gr_sel').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&gr_sel=hito&anio='+$(this).val(); 
    });
    $('#c_contrato_gr_sel').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&gr_sel=coordenada&anio='+$(this).val(); 
    });
    $('#s_contrato_gr_sel').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_contratos_anio.php&gr_sel=seguimiento&anio='+$(this).val(); 
    });
});

function getUrl(){
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/')+1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}

function getSearch()
{
    var loc = window.location;
    var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
    return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
}