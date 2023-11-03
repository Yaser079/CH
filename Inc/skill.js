function LoadSkill()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('skill-list').innerHTML=this.responseText;
            $("table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/skilllist.php",true);
    xmlhttp.send();
}
function LoadSkillForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('skill-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/skillform.php?id="+id,true);
    xmlhttp.send();
}
function SaveSkill()
{
    var name=document.getElementById("skill").value;
    var type=document.getElementById("stype").value;
    if(name=="")
    {
        $("#skill").focus();
        toastr["error"]("Please enter skill name.");
          $("#skill").addClass("is-invalid");
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
                            toastr["success"](name+" Skill saved.");
                            $("#skill").removeClass("is-invalid");
                            $("#skill").val("");  
                              activty();
                              $("#close-skill").click()
                              LoadSkill();
                         }
                         else
                         {
                            toastr["error"]("Failed to update skill.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/saveskill.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteSkill(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Skill?",
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
                    toastr["success"]("Skill Phase Removed.");
                    
                   activty();
                   LoadSkill();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Skill.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeskill.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function SkillStatus(str,id)
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
          toastr["success"]("Skill status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update skill status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/skillstatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}
