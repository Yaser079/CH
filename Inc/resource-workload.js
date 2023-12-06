function AllProjects(id,name)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('modal-title').innerHTML="Projects Working Details of "+name;
            document.getElementById('weekly-projects').innerHTML=this.responseText;
            
              $(".workload-projects").DataTable({
                "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
              }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/projectworkload.php?id="+id,true);
    xmlhttp.send();
}
function SelectLoadOffice(id)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById('staff-list').innerHTML=this.responseText;
        // $(".staff-list").DataTable({
        //     "responsive": false, "lengthChange": true, "autoWidth": false,"pageLength": 100,
        //     "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"],
        //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    };
    xmlhttp.open("GET","../script/staffworkload.php?id="+id,true);
    xmlhttp.send();
}