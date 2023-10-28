function projectResourcingList()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('resourcing-list').innerHTML=this.responseText;
            $("#example1").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
        }
    };
    xmlhttp.open("GET","../script/resourcinglist.php",true);
    xmlhttp.send();
}
function ShowM(id,staff,pid)
{
     document.getElementById('week').value=id;
     document.getElementById('staff').value=staff;
     document.getElementById('project').value=pid;

}
function StageSelect(str)
{
    
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
                              projectResourcingList();
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
function UpdateHourse()
{
    var hours=document.getElementById("hours").value
    var pid=document.getElementById("project").value
    var sid=document.getElementById("staff").value
    var week=document.getElementById("week").value
    var week2=week.split("_");
    if(hours=="")
    {
        $("#hours").focus();
        toastr["error"]("Please enter Hours.");
          $("#hours").addClass("is-invalid");
    }
     else
     {
        var data = {Pid:pid,Sid:sid,Week:week2[2],Hours:hours};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](week2[2]+" Hours updated.");
                            $("#hours").removeClass("is-invalid");
                            $("#hours").val("");  
                              activty();
                              document.getElementById(week).innerHTML=hours;
                              $("#close-hours").click()
                              projectResourcingList();
                         }
                         else
                         {
                            toastr["error"]("Failed to update hours.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatehours.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
}
function ResourceForm(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('resource-form').innerHTML=this.responseText;
         
        }
    };
    xmlhttp.open("GET","../script/resourcemanage.php?id="+id,true);
    xmlhttp.send();
}
function AddResource()
{
    var res=document.getElementById("resource").value;
    var pid=document.getElementById("project_id").value;

    if(res=="")
    {
        toastr["error"]("Please select resource for project");
    }
     else
     {
        var data = {Pid:pid,  Res:res};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](" Resource added to project.");
                            ResourceForm(pid);
                              activty();
                              projectResourcingList();
                            
                         }
                         else
                         {
                            toastr["error"]("Failed to add resource.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/addresource.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
    
}
function deleteResource(id,name,pid,sid)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove resource ("+name+") from this project?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Remove it!',
        
      }).then((isConfirmed) => {
        if (isConfirmed.value) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Resource Removed.");
                    ResourceForm(pid);
                   activty();
                   projectResourcingList();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove resource.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeresource.php?id="+id+"&pid="+pid+"&name="+name+"&sid="+sid,true);
            xmlhttp.send();
        }
      });
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
                   projectResourcingList();
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