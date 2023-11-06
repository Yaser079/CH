function SelectWeeklyResource(value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        
        }
    };
    xmlhttp.open("GET","../script/setweeklyResource.php?value="+value,true);
    xmlhttp.send();
}

function WeeklyProjectList(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('weekly-projects').innerHTML= this.responseText;
            $(".weekly-table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
              });
        }
    };
    xmlhttp.open("GET","../script/weeklyprojectlist.php?id="+id,true);
    xmlhttp.send();
}
function WeeklyReport(id,name,week)
{
    document.getElementById('modal-title').innerHTML="Projects Working Details of "+name+" for "+week;
    WeeklyProjectList(id);
}