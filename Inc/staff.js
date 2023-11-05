function LoadStaffCount()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('staff-count').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/staffcount.php",true);
    xmlhttp.send();
}
function LoadStaff()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('staff-list').innerHTML=this.responseText;
            $("table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
              
        }
    };
    xmlhttp.open("GET","../script/stafflist.php",true);
    xmlhttp.send();
}
function LoadStaffForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('staff-form').innerHTML=this.responseText;
            $('.select2').select2();
        }
    };
    xmlhttp.open("GET","../script/staffform.php?id="+id,true);
    xmlhttp.send();
}
function SaveStaff()
{
    var name=document.getElementById("fname").value;
    var nick=document.getElementById("nname").value;
    var office=document.getElementById("foffice").value;
    var role=document.getElementById("frole").value;
    var type=document.getElementById("ftype").value;
    if(name=="")
    {
        $("#fname").focus();
        toastr["error"]("Please enter full name.");
          $("#fname").addClass("is-invalid");
    }
    else if(nick=="")
    {
        $("#nname").focus();
        toastr["error"]("Please enter nick name.");
          $("#nname").addClass("is-invalid");
    }
    else if(office=="")
    {
        toastr["error"]("Please select staff office.");
    }
    else if(role=="")
    {
        toastr["error"]("Please select staff role.");
    }
    else
    {
        var data = {Type:type,Name:name,Nick:nick,Office:office,Role:role};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" Staff saved.");
                            $("#fname").removeClass("is-invalid");
                            $("#fname").val("");
                            $("#nname").removeClass("is-invalid");
                            $("#nname").val("");    
                              activty();
                              $("#close-staff").click()
                              LoadStaff();
                              LoadStaffCount();
                         }
                         else
                         {
                            toastr["error"]("Failed to update skill.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/savestaff.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteStaff(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Staff?",
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
                    toastr["success"]("Staff Removed.");
                    
                   activty();
                   LoadStaff();
                   LoadStaffCount();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Staff.");
                }
                }
            };
            xmlhttp.open("GET","../script/removestaff.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function StaffStatus(str,id)
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
          toastr["success"]("Staff status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update Staff status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/staffstatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}
function DeleteSkill(id)
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
                document.getElementById('skills-list').innerHTML=this.responseText;
                toastr["success"]("Skill Removed.");
                LoadStaff();
                LoadStaffCount();
            }
        };
        xmlhttp.open("GET","../script/delstaffskill.php?id="+id,true);
        xmlhttp.send();
}
function AddSkill(sid)
{
    var skill=document.getElementById("skill").value;
    if(skill=="")
    {
        toastr["error"]("Please select Skill.");
    }
    else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
                document.getElementById('skills-list').innerHTML=this.responseText;
                toastr["success"]("Skill Added.");
                LoadStaff(); 
                LoadStaffCount();
            }
        };
        xmlhttp.open("GET","../script/newstaffskill.php?id="+sid+"&skill="+skill,true);
        xmlhttp.send();
    }
}
function AddJob(sid)
{
    var job=document.getElementById("job").value;
    if(job=="")
    {
        toastr["error"]("Please select job.");
    }
    else
    {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
                document.getElementById('jobs-list').innerHTML=this.responseText;
                toastr["success"]("Job Title Added.");
                LoadStaff(); 
            }
        };
        xmlhttp.open("GET","../script/newstaffjob.php?id="+sid+"&job="+job,true);
        xmlhttp.send();
    }
}
function DeleteJobs(id)
{
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
                document.getElementById('jobs-list').innerHTML=this.responseText;
                toastr["success"]("Job Removed.");
                LoadStaff();
            }
        };
        xmlhttp.open("GET","../script/delstaffjob.php?id="+id,true);
        xmlhttp.send();
}