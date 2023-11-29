const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 3000
  });
function login()
{
    var email=document.getElementById("email").value;
    var pass=document.getElementById("pass").value;
 
		var data = {  username:email,  password:pass };
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
                  
                    if(this.responseText==1)
                      {
                        Toast.fire({
                            icon: 'success',
                            title: '&nbsp; Login Successful.'
                          }) ;
                            window.location.href = "Admin/index.php"; 
                      }
                      else if(this.responseText==0)
                      {
                        Toast.fire({
                            icon: 'error',
                            title: '&nbsp; Login Failed. Invalid Credentials.'
                          }) ;
                      }
                      else{
                        Toast.fire({
                          icon: 'success',
                          title: '&nbsp; Login Successful.'
                        }); 
                          window.location.href = "Admin/weekly-resource.php";
                      }
                }
            };
 
            xmlhttp.open("POST","script/login.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
 
}
 function ForgotBox()
 {
    $("#forgot-box").slideToggle();
 }
 function SendMail()
 {
  var email=document.getElementById("femail").value;
  if(email=="")
  {
    Toast.fire({
      icon: 'error',
      title: '&nbsp; Please Enter Email.'
    }); 
    $("#femail").focus();
  }
  else
  {
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Password Reset email has been sent to you. Go and check your email.");
                    $("#forgot-box").slideToggle();
                }
                else if(this.responseText==2)
                {
                    toastr["error"]("Email sending failed try again.");
                }
                else
                {
                   toastr["error"]("email not found.");
                }
                }
            };
            xmlhttp.open("GET","script/sendMail.php?email="+email,true);
            xmlhttp.send();
  }
 }
 function SavePassword()
 {
  var pass=document.getElementById("pass").value;
  var pass2=document.getElementById("cpass").value;
  if(pass==pass2)
  {
    return true;
  }
  else{
    toastr["error"]("Password not matched.");
    return false;
  }
 }