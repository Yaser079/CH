function SelectDFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        window.location.href="index.php";
        }
    };
    xmlhttp.open("GET","../script/setdashboardfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}