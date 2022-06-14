
function eliminarPermisos(){

    let id_empleado = document.getElementById('id_empleado').value;
    let documento = document.getElementById('documento').value;
    alert(documento)

    $.ajax({
    method: "POST",
    url:"/ProyectoBD/app/api/api_permisos.php?action=eliminar-permisos",
    data:{
    id_empleado,
    documento
    }
    }).done(function( msg ){
        if(msg=='false'){
            alert('Error eliminando permisos');
        }
        alert('Permisos eliminados');
    })
    

}