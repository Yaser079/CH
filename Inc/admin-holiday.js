function HolidayList()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('holiday-list').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/holidaylist.php",true);
    xmlhttp.send();
}
function HolidayForm(str)
{
    var pro=str.split("_");

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('holiday-form').innerHTML=this.responseText;
            
        }
    };
    xmlhttp.open("GET","../script/holidayform.php?id="+pro[0]+"&week="+pro[1],true);
    xmlhttp.send();
}
function UpdateHoliday()
{
    var des=document.getElementById("des").value;
    var hours=document.getElementById("hours").value;
    var office=document.getElementById("office").value;
    var week=document.getElementById("week").value;
    var type=document.getElementById("type").value;
    if(des=="")
    {
        $("#des").focus();
        toastr["error"]("Please enter Holiday Description.");
          $("#des").addClass("is-invalid");
    }
    else if(hours=="")
    {
        $("#hours").focus();
        toastr["error"]("Please enter Holiday hours.");
          $("#hours").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Des:des,Week:week,Office:office,Hours:hours};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"](week+" Holidays Added.");
                            $("#des").removeClass("is-invalid");
                            $("#des").val("");
                            $("#hours").removeClass("is-invalid");
                            $("#hours").val("");    
                              activty();
                              $("#close-holiday").click()
                              HolidayList();
                         }
                         else
                         {
                            toastr["error"]("Failed to update Holidays.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/saveholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}
function ClearHoliday(id)
{
    var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
              if (this.readyState == 4 && this.status == 200) {
                if(this.responseText==1)
                {
                    toastr["success"]("Holiday Removed.");
                    $("#close-holiday").click()
                   activty();
                   HolidayList();
                }
                else
                {
                  
                   toastr["error"]("Failed to remove Holiday.");
                }
                }
            };
            xmlhttp.open("GET","../script/removeholiday.php?id="+id,true);
            xmlhttp.send();
}
function AddHoliday()
{
    var date=document.getElementById("reservation").value;
    var desc=document.getElementById("adesc").value;
    var olist="";
    var checkboxes = document.getElementsByClassName("stcheck");
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked == true) {
               
                olist+=checkboxes[i].value+" ";
            }
        }
        
    if(desc=="")
    {
        $("#adesc").focus();
        toastr["error"]("Please enter Holiday Description.");
          $("#adesc").addClass("is-invalid");
    }
 
    else if(date=="")
    {
        $("#reservation").focus();
        toastr["error"]("Please select date.");
          $("#reservation").addClass("is-invalid");
    }
    else if(olist=="")
    {
        
        toastr["error"]("Please select office.");
    }
    else
    {
        var data = {Date:date,Des:desc,Office:olist};
     
		var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() 
            {
                if (this.readyState == 4 && this.status == 200) 
                {     
					     if(this.responseText==1)
                         {
                            toastr["success"]("New Holidays Added.");
                            $("#adesc").removeClass("is-invalid");
                            $("#adesc").val("");  
                              activty();
                              $("#close-holiday").click()
                              window.location.href="admin-holiday.php";
                         }
                         else
                         {
                            toastr["error"]("Failed to add Holidays.");
                         }
                }
            };
 
            xmlhttp.open("POST","../script/Newholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}