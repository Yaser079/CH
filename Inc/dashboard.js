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
function FilterDays(value,id)
{
  $('.ub').removeClass("btn-secondary");
  $('.ub').removeClass("text-white")
  $('.ub').addClass("btn-outline-secondary");
  $("#"+id).addClass("btn-secondary");  
  $("#"+id).addClass("text-white");
  var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        demoKnob(this.responseText);
        }
    };
    xmlhttp.open("GET","../script/utilization.php?days="+value,true);
    xmlhttp.send();
}
 $("#u7day").click();