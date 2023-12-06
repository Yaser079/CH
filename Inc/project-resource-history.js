
function projectResourcingList()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('resourcing-list').innerHTML=this.responseText;
             
        }
    };
    xmlhttp.open("GET","../script/hisotryresource.php",true);
    xmlhttp.send();
}
projectResourcingList();
 
function SetRFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        projectResourcingList();
        }
    };
    xmlhttp.open("GET","../script/setRfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}
function ClearRFilter()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $('#roffice').val("all").trigger('change.select2');
        $('#rregion').val("all").trigger('change.select2');
        $('#rmanager').val("all").trigger('change.select2');
  
      
        projectResourcingList();
        }
    };
    xmlhttp.open("GET","../script/clearRfilter.php",true);
    xmlhttp.send();
}
 