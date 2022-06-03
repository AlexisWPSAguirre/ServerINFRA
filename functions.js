$(document).ready(function(){
   /*  $('#btn_search').click(function(e){
        e.preventDefault(); 
        var sistema = getSearch();
        alert(sistema);
        location.href = sistema+'views/buscar.php?search='+$(this).val();
    }); */
    $('#search_anio').change(function(e)
    {
        e.preventDefault();
        var sistema = getUrl();
        location.href = sistema+'full-width.php?frame=list_proyectos.php&anio='+$(this).val(); 
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