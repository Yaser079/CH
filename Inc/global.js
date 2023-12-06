function activty()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('logs').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/activity.php",true);
    xmlhttp.send();
}
