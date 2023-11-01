function LoadCountry()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('country-list').innerHTML=this.responseText;
            $("#example1").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/countrylist.php",true);
    xmlhttp.send();
}
function LoadCountryForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('country-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/countryform.php?id="+id,true);
    xmlhttp.send();
}
function SaveCountry()
{
    var name=document.getElementById("cname").value;
    var tag=document.getElementById("ctag").value;
    var color=document.getElementById("ccolor").value;
    var type=document.getElementById("ctype").value;
    if(name=="")
    {
        $("#cname").focus();
        toastr["error"]("Please enter country name.");
          $("#cname").addClass("is-invalid");
    }
    else if(tag=="")
    {
        $("#ctag").focus();
        toastr["error"]("Please enter country tag.");
          $("#ctag").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name,Color:color,Tag:tag};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" country saved.");
                            $("#cname").removeClass("is-invalid");
                            $("#cname").val("");  
                            $("#ctag").removeClass("is-invalid");
                            $("#ctag").val("");  
                              activty();
                              $("#close-country").click()
                              LoadCountry();
                         }
                         else
                         {
                            toastr["error"]("Failed to update save country.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/savecountry.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteCountry(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Country?",
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
                    toastr["success"]("Country Removed.");
                    
                   activty();
                   LoadCountry();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Country.");
                }
                }
            };
            xmlhttp.open("GET","../script/removecountry.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function CountryStatus(str,id)
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
          toastr["success"]("Country status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update country status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/countrystatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}
function LoadOffice()
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('office-list').innerHTML=this.responseText;
            $("table").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,
              });
        }
    };
    xmlhttp.open("GET","../script/officelist.php",true);
    xmlhttp.send();
}
function LoadOfficeForm(id)
{
     
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
            document.getElementById('office-form').innerHTML=this.responseText;
        }
    };
    xmlhttp.open("GET","../script/officeform.php?id="+id,true);
    xmlhttp.send();
}
function SaveOffice()
{
    var name=document.getElementById("oname").value;
    var code=document.getElementById("ocode").value;
    var rate=document.getElementById("orate").value;
    var type=document.getElementById("otype").value;
    if(name=="")
    {
        $("#oname").focus();
        toastr["error"]("Please enter Office name.");
          $("#oname").addClass("is-invalid");
    }
    else if(code=="")
    {
        $("#ctag").focus();
        toastr["error"]("Please enter office code.");
          $("#ctag").addClass("is-invalid");
    }
    else if(rate=="")
    {
        $("#orate").focus();
        toastr["error"]("Please enter office rte.");
          $("#orate").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Name:name,Code:code,Rate:rate};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](name+" country saved.");
                            $("#oname").removeClass("is-invalid");
                            $("#oname").val("");  
                            $("#ocode").removeClass("is-invalid");
                            $("#ocode").val("");  
                            $("#orate").removeClass("is-invalid");
                            $("#orate").val("");  
                              activty();
                              $("#close-office").click()
                              LoadOffice();
                         }
                         else
                         {
                            toastr["error"]("Failed to update save country.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/saveoffice.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function deleteOffice(id)
{
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to remove this Office?",
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
                    toastr["success"]("Office Removed.");
                    
                   activty();
                   LoadOffice();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Office.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeoffice.php?id="+id,true);
            xmlhttp.send();
        }
      });
}
function OfficeStatus(str,id)
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
          toastr["success"]("Office status updated.");
          activty();
       }
       else
       {
        toastr["error"]("Failed to update office status.");
         
       }
      }
    };
    xmlhttp.open("GET","../script/officestatus.php?q="+value+"&id="+id,true);
    xmlhttp.send();
}