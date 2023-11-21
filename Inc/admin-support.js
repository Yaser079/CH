 
function SelectMFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        window.location.href="support-admin.php";
        }
    };
    xmlhttp.open("GET","../script/setadminfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
   

}