function LoadRole()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('role-list').innerHTML=this.responseText;
            $("table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/rolelist.php",true);
    xmlhttp.send();
}
function LoadRoleForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('role-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/roleform.php?id="+id,true);
    xmlhttp.send();
}
function SaveRole()
{
    var name=document.getElementById("role").value;
    var type=document.getElementById("rtype").value;
    if(name=="")
    {
        $("#role").focus();
        toastr["error"]("Please enter role name.");
          $("#role").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" role saved.");
                            $("#role").removeClass("is-invalid");
                            $("#role").val("");  
                              activty();
                              $("#close-role").click()
                              LoadRole();
                         }
                         else
                         {
                            toastr["error"]("Failed to update role.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/saverole.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteRole(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Role?",
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
                    toastr["success"]("Role Phase Removed.");
                    
                   activty();
                   LoadRole();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Role.");
                }
                }
            };
            xmlhttp.open("GET","../script/removerole.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function RoleStatus(str,id)
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
          toastr["success"]("Role status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update role status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/rolestatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}

function LoadJob()
{ 
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('job-list').innerHTML=this.responseText;
            $(".table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                
              });
        }
    };
    xmlhttp.open("GET","../script/joblist.php",true);
    xmlhttp.send();
}
function LoadJobForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('job-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/jobform.php?id="+id,true);
    xmlhttp.send();
}
function SaveJob()
{
    var name=document.getElementById("job").value;
    var type=document.getElementById("jtype").value;
    if(name=="")
    {
        $("#job").focus();
        toastr["error"]("Please enter job title.");
          $("#job").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" job title saved.");
                            $("#job").removeClass("is-invalid");
                            $("#job").val("");  
                            
                              activty();
                              $("#close-job").click()
                              LoadJob();
                         }
                         else
                         {
                            toastr["error"]("Failed to update job title.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/savejob.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteJob(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Job Title?",
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
                    toastr["success"]("Job Title Removed.");
                    
                   activty();
                   LoadJob();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Job Title.");
                }
                }
            };
            xmlhttp.open("GET","../script/removejob.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function JobStatus(str,id)
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
          toastr["success"]("Job title status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update Job title status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/jobstatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}