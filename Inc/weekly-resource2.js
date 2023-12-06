function SelectWeeklyResource(value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        WeeklyResourcingList();
        }
    };
    xmlhttp.open("GET","../script/setweeklyResource.php?value="+value,true);
    xmlhttp.send();
}
function WeeklyResourcingList()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('weekly-Rlist').innerHTML= this.responseText;
            // $(".table").DataTable({
            //     "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
            //     // scrollX:true,
            //     // fixedColumns: {
            //     //     leftColumns: 7
            //     // },
                
            //     // paging: false,
            //     // scrollCollapse: true,
            //     // fixedHeader: true,
            //   });
             
        }
    };
    xmlhttp.open("GET","../script/weeklyresource2.php",true);
    xmlhttp.send();
}
function WeeklyProjectList(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('weekly-projects').innerHTML= this.responseText;
            $(".weekly-table2").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
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
function NewLeves(sid,week)
{
    var name=week.split("_");
    document.getElementById("staff").value=sid;
    document.getElementById("week").value=name[1];
    document.getElementById("column").value=name[0];
}
function NewRemakrs(sid,week)
{
    var name=week.split("_");
    document.getElementById("rstaff").value=sid;
    document.getElementById("rweek").value=name[1];
    document.getElementById("rcolumn").value=name[0];
}
function updateLeves()
{
    var hours=document.getElementById("hours").value;
    var staff=document.getElementById("staff").value;
    var week=document.getElementById("week").value;
    var name=document.getElementById("column").value;

    if(hours=="")
    {
        toastr["error"]("Please enter hours.");
    }
     else
     {
        var data = {Staff:staff,  Hours:hours,Week:week,Name:name};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Hours added to Other Leaves.");
                            WeeklyResourcingList();
                              activty();
                              $("#add-hours-close").click();
                         }
                         else
                         {
                            toastr["error"]("Failed to add hours.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/addotherhours.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
}
function updateRemarks()
{
    var cmnts=document.getElementById("remarks").value;
    var staff=document.getElementById("rstaff").value;
    var week=document.getElementById("rweek").value;
    var name=document.getElementById("rcolumn").value;

    if(cmnts=="")
    {
        toastr["error"]("Please enter Remarks.");
    }
     else
     {
        var data = {Staff:staff, Hours:cmnts,Week:week,Name:name};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Remarks added to Other Leaves.");
                            WeeklyResourcingList();
                              activty();
                              $("#add-remark-close").click();
                         }
                         else
                         {
                            toastr["error"]("Failed to add Remarks.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/addotherhours.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
}
function SetWFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        WeeklyResourcingList();
        }
    };
    xmlhttp.open("GET","../script/setwfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}
function ClearWFilter()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $('#woffice').val("all").trigger('change.select2');
 
        WeeklyResourcingList();
        }
    };
    xmlhttp.open("GET","../script/clearWfilter.php",true);
    xmlhttp.send();
}
function StageForm(str)
{
    var pro=str.split("_");
    //document.getElementById('sweek').value=pro[1];
    //document.getElementById('sproject').value=pro[0];
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('stage-form').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/stageform.php?id="+pro[0]+"&week="+pro[1],true);
    xmlhttp.send();
}
function UpdateStage()
{
    var stage=document.getElementById("prstage").value
    var pid=document.getElementById("sproject").value
    var week=document.getElementById("sweek").value
    if(stage=="")
    {

        toastr["error"]("Please enter Select Stage.");
    }
     else
     {
        var data = {Pid:pid,Stage:stage,Week:week};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](week+" Stage updated.");
                            $("#hours").val("");  
                            $('#prstage').val("").trigger('change.select2');
                              activty();

                              $("#close-stage").click()
                              WeeklyResourcingList();
                         }
                         else
                         {
                            toastr["error"]("Failed to update project stage.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatestage.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
}
function ClearStage(id)
{
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Stage Removed.");
                   activty();
                   WeeklyResourcingList();
                   $("#close-stage").click();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove stage.");
                }
                }
            };
            xmlhttp.open("GET","../script/removestage.php?id="+id,true);
            xmlhttp.send();
}
function FetchDeadline(id)
{
    var pro=id.split("-");
    document.getElementById("pid").value=pro[0];
}
function UpdateDeadline()
{
    var pid=document.getElementById("pid").value;
    var deadline=document.getElementById("deadline").value;
    var data = {Pid:pid,Deadline:deadline};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("Deadline Updated.");
                            $("#pid").val("");  
                            $('#deadline').val("").trigger('change.select2');
                              activty();

                              $("#close-deadline").click()
                              WeeklyResourcingList();
                         }
                         else
                         {
                            toastr["error"]("Failed to update project deadline.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatedeadline.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
}