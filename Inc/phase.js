function LoadPhase()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('phase-list').innerHTML=this.responseText;
            $(".phase-list").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/phaselist.php",true);
    xmlhttp.send();
}
function LoadPhaseForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('phase-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/phaseform.php?id="+id,true);
    xmlhttp.send();
}
function SavePhase()
{
    var name=document.getElementById("pname").value;
    var color=document.getElementById("pcolor").value;
    var type=document.getElementById("ptype").value;
    if(name=="")
    {
        $("#pname").focus();
        toastr["error"]("Please enter phase name.");
          $("#pname").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name,Color:color};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" phase saved.");
                            $("#pname").removeClass("is-invalid");
                            $("#pname").val("");  
                              activty();
                              $("#close-phase").click()
                              LoadPhase();
                         }
                         else
                         {
                            toastr["error"]("Failed to update phase.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/savephase.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deletePhase(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Project Phase?",
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
                    toastr["success"]("Project Phase Removed.");
                    
                   activty();
                   LoadPhase();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Project Phase.");
                }
                }
            };
            xmlhttp.open("GET","../script/removephase.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function PhaseStatus(str,id)
{
    var value=0;
    if ($('#'+str).is(":checked")) {
        value=1;
      } else {
        value=0;
      }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       if(this.responseText==1)
       {
          toastr["success"]("Phase status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update phase status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/phasestatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}

function LoadStatus()
{ 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('status-list').innerHTML=this.responseText;
            $(".status-list").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                
              });
        }
    };
    xmlhttp.open("GET","../script/statuslist.php",true);
    xmlhttp.send();
}
function LoadStatusForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('status-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/statusform.php?id="+id,true);
    xmlhttp.send();
}
function SaveStatus()
{
    var name=document.getElementById("sname").value;
    var color=document.getElementById("scolor").value;
    var type=document.getElementById("stype").value;
    if(name=="")
    {
        $("#oname").focus();
        toastr["error"]("Please enter Office name.");
          $("#oname").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name,Color:color};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" project status saved.");
                            $("#sname").removeClass("is-invalid");
                            $("#sname").val("");  
                            
                              activty();
                              $("#close-status").click()
                              LoadStatus();
                         }
                         else
                         {
                            toastr["error"]("Failed to update project status.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/savestatus.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteStatus(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this project status?",
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
                    toastr["success"]("Project status Removed.");
                    
                   activty();
                   LoadStatus();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Project Status .");
                }
                }
            };
            xmlhttp.open("GET","../script/removestatus.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function ProjectStatus(str,id)
{
    var value=0;
    if ($('#'+str).is(":checked")) {
        value=1;
      } else {
        value=0;
      }
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       if(this.responseText==1)
       {
          toastr["success"]("Project status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update Project status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/projectstatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}