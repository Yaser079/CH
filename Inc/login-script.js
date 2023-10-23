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
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(!(email.match(mailformat)))
	{
		 
        Toast.fire({
            icon: 'warning',
            title: '&nbsp; Please enter a valid emil.'
          }) 
          $('#email').focus();

	}
	else
	{
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
                              }) 
                                window.location.href = "Admin/index.php";
                         }
                         else
                         {
                            Toast.fire({
                                icon: 'error',
                                title: '&nbsp; Login Failed. Invalid Credentials.'
                              }) 
                         }
                }
            };
 
            xmlhttp.open("POST","script/login.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
	}
    return false
}
 