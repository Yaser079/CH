 
function userslist()
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('list').innerHTML=this.responseText;
            $("#example1").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/userslist.php",true);
    xmlhttp.send();
}
function status(str,id) {
    
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
          toastr["success"]("User status updated.");
          if ($('#'+str).is(":checked")) {
            $('#'+str+'l').html("On");
          } else {
            $('#'+str+'l').html("Off");
          }
          activty();
       }
       else
       {
        toastr["error"]("Failed to update user status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/userstatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}

function superAdmin(str,id) {
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
            toastr["success"](" Super Admin status updated.");
             if ($('#'+str).is(":checked")) {
               $('#'+str+'l').html("Yes");
             } else {
               $('#'+str+'l').html("No");
             }
             activty();
          }
          else
          {
            toastr["error"](" Failed to update Super Admin status.");
          }
         }
       };
       xmlhttp.open("GET","../script/superadmin.php?q="+value+"&id="+id,true);
       xmlhttp.send();
   }
   function AddNewUser()
{
    clearform();
    var name=document.getElementById("exampleInputName1").value;
    var email=document.getElementById("exampleInputEmail1").value;
    var pass=document.getElementById("exampleInputPassword1").value;
    var phone=document.getElementById("exampleInputPhone1").value;
    var country=document.getElementById("country").value;
    var admin=0;
    if ($('#customSwitch0').is(":checked")) {
        admin=1;
      } else {
        admin=0;
      }
	 if(name=="" )
     {
        $('#exampleInputName1').focus();
        toastr["error"]("Please enter full name.");
        
          $("#exampleInputName1").addClass("is-invalid");

     }
     else if(email==""){
        $('#exampleInputEmail1').focus();
        toastr["error"]("Please enter email.");
        
          $("#exampleInputEmail1").addClass("is-invalid");
     }
     else if(pass==""){
        $('#exampleInputPassword1').focus();
        toastr["error"]("Please enter password.");
          $("#exampleInputPassword1").addClass("is-invalid");
     }
     else if(phone==""){
        $('#exampleInputPhone1').focus();
        toastr["error"]("Please enter phone.");
          $("#exampleInputPhone1").addClass("is-invalid");
     }
     else
     
    {
        var data = {  Name:name,Email:email,Phone:phone,Password:pass,Country:country,Admin:admin };
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("New user created.");
                              userslist();   
                              activty();
                              $("#exampleInputName1").val("");
                             $("#exampleInputEmail1").val("");
                             $("#exampleInputPassword1").val("");
                             $("#exampleInputPhone1").val("");
                         }
                         else
                         {
                            toastr["error"]("Failed to create new user.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/newuser.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function clearform()
{
    $("#exampleInputName1").removeClass("is-invalid");
    $("#exampleInputEmail1").removeClass("is-invalid");
    $("#exampleInputPassword1").removeClass("is-invalid");
    $("#exampleInputPhone1").removeClass("is-invalid");
}
function deleteUser(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this user?",
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
                    toastr["success"]("User deleted.");
                   userslist(); 
                   activty();
                }
                else
                {
                  
                   toastr["error"]("Failed to delete user.");
                }
                }
            };
            xmlhttp.open("GET","../script/deleteuser.php?id="+id,true);
            xmlhttp.send();
        }
      });
    
}
function getUser(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('update-form').innerHTML=this.responseText;
         
        }
    };
    xmlhttp.open("GET","../script/getuser.php?id="+id,true);
    xmlhttp.send();
}
function updateUser()
{   var id=document.getElementById("id").value;
    var name=document.getElementById("exampleInputName2").value;
    var email=document.getElementById("exampleInputEmail2").value;
    var pass=document.getElementById("exampleInputPassword2").value;
    var phone=document.getElementById("exampleInputPhone2").value;
    var country=document.getElementById("country2").value;
   
	 if(name=="" )
     {
        $('#exampleInputName2').focus();
        toastr["error"]("Please enter full name.");
        
          $("#exampleInputName2").addClass("is-invalid");

     }
     else if(email==""){
        $('#exampleInputEmail2').focus();
        toastr["error"]("Please enter email.");
        
          $("#exampleInputEmail2").addClass("is-invalid");
     }
     else if(pass==""){
        $('#exampleInputPassword2').focus();
        toastr["error"]("Please enter password.");
          $("#exampleInputPassword2").addClass("is-invalid");
     }
     else if(phone==""){
        $('#exampleInputPhone2').focus();
        toastr["error"]("Please enter phone.");
          $("#exampleInputPhone2").addClass("is-invalid");
     }
     else
     
    {
        var data = {ID:id, Name:name,Email:email,Phone:phone,Password:pass,Country:country};
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("User updated.");
                              userslist();   
                              activty();
                              $("#update-close").click();
                              $("#exampleInputName2").removeClass("is-invalid");
                             $("#exampleInputEmail2").removeClass("is-invalid");
                             $("#exampleInputPassword2").removeClass("is-invalid");
                             $("#exampleInputPhone2").removeClass("is-invalid");
                         }
                         else
                         {
                            toastr["error"]("Failed to update user.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/updateuser.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}