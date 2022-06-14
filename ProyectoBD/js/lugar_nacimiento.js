window.onload=function(){
    fetch('./paises.php',
    {
        method:'POST',
        
    }).then(res=>res.text()).then(res=>{
        document.getElementById("pais").insertAdjacentHTML('beforeend',res);
        console.log (res)
    })
}

function departamento(){
    let id=document.getElementById("pais").value;
    let data = new FormData();
    data.append("pais_id",id);
    fetch('./dept.php',
    {
        method:'POST',
        body: data
        
    }).then(res=>res.text()).then(res=>{
        res=`<option value="" selected disabled></option>`+res;
        document.getElementById("dept").innerHTML=res;
        document.getElementById("dept").disabled=false;
    })
}

function ciudad()
{
    let id=document.getElementById("dept").value;
    let data = new FormData();
    data.append("dept_id",id);
    fetch('./ciudad.php',
    {
        method:'POST',
        body: data
        
    }).then(res=>res.text()).then(res=>{
        res=`<option value="" selected disabled></option>`+res;
        document.getElementById("city").innerHTML=res;
        document.getElementById("city").disabled=false;
    })

}