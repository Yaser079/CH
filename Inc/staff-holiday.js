function HolidayList()
{

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         document.getElementById('staff-holiday-list').innerHTML=this.responseText;
         $(".staff-holiday").DataTable({
            "responsive": false, "lengthChange": true, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/staffholidaylist.php",true);
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
    xmlhttp.open("GET","../script/staffholidayform.php?id="+pro[0]+"&week="+pro[1],true);
    xmlhttp.send();
}
function UpdateHoliday()
{
    var des=document.getElementById("des").value;
    var hours=document.getElementById("hours").value;
    var staff=document.getElementById("staff").value;
    var week=document.getElementById("week").value;
    var type=document.getElementById("type").value;
     if(hours=="")
    {
        $("#hours").focus();
        toastr["error"]("Please enter Holiday hours.");
          $("#hours").addClass("is-invalid");
    }
    else
    {
        var data = {Type:type,Des:des,Week:week,Staff:staff,Hours:hours};
     
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
 
            xmlhttp.open("POST","../script/savestaffholiday.php",true);
            xmlhttp.setRequestHeader("Content-Type", "application/json");
			xmlhttp.send(JSON.stringify(data));
    }
}