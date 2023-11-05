function projectslist()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('project-list').innerHTML=this.responseText;
            $("#example1").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            
        }
    };
    xmlhttp.open("GET","../script/projectlist.php",true);
    xmlhttp.send();
}
function clearform()
{
    $("#code").removeClass("is-invalid");
    $("#name").removeClass("is-invalid");
    $("#profit").removeClass("is-invalid");
    $("#rate").removeClass("is-invalid");
}
function NewProject()
{
    clearform();
    var code=document.getElementById("code").value;
    var name=document.getElementById("name").value;
    var manager=document.getElementById("manager").value;
    var country=document.getElementById("country").value;
    var profit=document.getElementById("profit").value;
    var rate=document.getElementById("rate").value;
    var stage=document.getElementById("stage").value;
    var status=document.getElementById("status").value;
    var office=document.getElementById("office").value;
	 if(code=="" )
     {
        $('#code').focus();
        toastr["error"]("Please enter project code.");
        
          $("#code").addClass("is-invalid");

     }
     else if(name==""){
        $('#name').focus();
        toastr["error"]("Please enter project name.");
        
          $("#name").addClass("is-invalid");
     }
     else if(manager==""){
      
        toastr["error"]("Please select project manager.");
          
     }
     else if(country==""){
        
        toastr["error"]("Please select project country.");
      
     }
     else if(profit==""){
        $('#profit').focus();
        toastr["error"]("Please enter project profit.");
          $("#profit").addClass("is-invalid");
     }
     else if(rate==""){
        $('#rate').focus();
        toastr["error"]("Please enter project AVG Rate.");
          $("#rate").addClass("is-invalid");
     }
     else if(stage==""){
        
        toastr["error"]("Please select project stage");
       
     }
     else if(status==""){
         
        toastr["error"]("Please select project status");
        
     }
     else if(office==""){
       
        toastr["error"]("Please select project office");
           
     }
     else
     
    {
        var data = {  Code:code,Name:name,Pm:manager,Country:country,Profit:profit,Rate:rate,Stage:stage,Status:status,Office:office };
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("New project created.");
                              projectslist();   
                              activty();
                              $("#code").val("");
                             $("#name").val("");
                             $("#rate").val("");
                             $("#profit").val("");
                             $('#add-project-close').click();
                         }
                         else
                         {
                            toastr["error"]("Failed to create new project.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/newproject.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteProject(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this Project?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        
      }).then((isConfirmed) => {
        if (isConfirmed.value) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Project deleted.");
                    projectslist(); 
                   activty();
                }
                else
                {
                  
                   toastr["error"]("Failed to delete project.");
                }
                }
            };
            xmlhttp.open("GET","../script/deleteproject.php?id="+id,true);
            xmlhttp.send();
        }
      });
}

function getproject(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('project-update-form').innerHTML=this.responseText;
         
        }
    };
    xmlhttp.open("GET","../script/projectedit.php?id="+id,true);
    xmlhttp.send();
}
function UpdateProject()
{
    clearform();
    var code=document.getElementById("code1").value;
    var name=document.getElementById("name1").value;
    var manager=document.getElementById("manager1").value;
    var country=document.getElementById("country1").value;
    var profit=document.getElementById("profit1").value;
    var rate=document.getElementById("rate1").value;
    var stage=document.getElementById("stage1").value;
    var status=document.getElementById("status1").value;
    var office=document.getElementById("office1").value;
    var id=document.getElementById("id").value;
	 if(code=="" )
     {
        $('#code').focus();
        toastr["error"]("Please enter project code.");
        
          $("#code").addClass("is-invalid");

     }
     else if(name==""){
        $('#name').focus();
        toastr["error"]("Please enter project name.");
        
          $("#name").addClass("is-invalid");
     }
     else if(manager==""){
      
        toastr["error"]("Please select project manager.");
          
     }
     else if(country==""){
        
        toastr["error"]("Please select project country.");
      
     }
     else if(profit==""){
        $('#profit').focus();
        toastr["error"]("Please enter project profit.");
          $("#profit").addClass("is-invalid");
     }
     else if(rate==""){
        $('#rate').focus();
        toastr["error"]("Please enter project AVG Rate.");
          $("#rate").addClass("is-invalid");
     }
     else if(stage==""){
        
        toastr["error"]("Please select project stage");
       
     }
     else if(status==""){
         
        toastr["error"]("Please select project status");
        
     }
     else if(office==""){
       
        toastr["error"]("Please select project office");
           
     }
     else
     
    {
        var data = {ID:id,  Code:code,Name:name,Pm:manager,Country:country,Profit:profit,Rate:rate,Stage:stage,Status:status,Office:office };
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("project updated.");
                              projectslist();   
                              activty();
                            
                         }
                         else
                         {
                            toastr["error"]("Failed to update project.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updateproject.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function calcHours(stage)
{
    var profit=document.getElementById("profit1").value;
    var rate=document.getElementById("rate1").value;
    var budget=document.getElementById(stage+"budget").value;
    var hours=budget/rate*(100-profit);
     document.getElementById(stage+"hours").value=Math.round(hours/100);
}
function UpdateStage(stid,pid)
{
    var title=document.getElementById(stid+"title").innerHTML;
    var budget=document.getElementById(stid+"budget").value;
    var hours=document.getElementById(stid+"hours").value
    if(budget=="")
    {
        $('#'+stid+"budget").focus();
        toastr["error"]("Please enter project "+title+" Budget.");
          $("#"+stid+"budget").addClass("is-invalid");
    }
     else
     {
        var data = {Pid:pid,  Sid:stid,Budget:budget,Hours:hours,Phase:title};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](title+" Budget and Hours updated.");
                              projectslist();   
                              activty();
                            
                         }
                         else
                         {
                            toastr["error"]("Failed to update phase.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updatephase.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
     }
    
}
function SetFilter(id,value)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
             projectslist();
        }
    };
    xmlhttp.open("GET","../script/setfilter.php?value="+value+"&id="+id,true);
    xmlhttp.send();
}
function ClearFilter()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        $('#foffice').val("all").trigger('change.select2');
        $('#fregion').val("all").trigger('change.select2');
        $('#fmanager').val("all").trigger('change.select2');
        $('#fstatus').val("all").trigger('change.select2');
        $('#fstage').val("all").trigger('change.select2');
      
             projectslist();
        }
    };
    xmlhttp.open("GET","../script/clearfilter.php",true);
    xmlhttp.send();
}
function CalculateAVG()
{
  var value=0;
  var staff=0;
  $("#avg-calculator input").each(function(){
    var input = $(this);
    if(input.val()!="")
    {
      staff=staff+Number(input.val());
      value+=input.attr('rate')*input.val();
    }
    });
     var avg=value/staff;
     $('#avgrate').val(avg.toFixed(2));
}
function ClearAVG()
{
  $("#avg-calculator input").each(function(){
    var input = $(this);
    input.val('');

    });
    $('#avgrate').val('');
}