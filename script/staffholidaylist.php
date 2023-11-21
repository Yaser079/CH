<div class="table-responsive">
    <table id="example1"  class="table table-bordered text-center staff-holiday">
        <thead>
        <tr>
            <th>ID</th>
            <th class="rotated">Name</th>
            <th class="rotated">Office</th>
            <th class="rotated">Total</th>
            <?php 
                include 'functions.php';
                $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        echo '<th class="rotated" data-orderable="false"> '.$week.' </th>';
                    }
                ?>
        </tr>
        </thead>
        <tbody>
        <?php
            include '../Inc/DBcon.php';
            
            $sql2="select * from staff;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                $i=1;
                while($row = mysqli_fetch_array($result))
                {
                    $hours=getTotalStaffHoliday($row['ID']);
                    $office=getOffice($row['office']);
                    echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['nick_name'].'</td>
                    <td>'.$office['code'].'</td>
                    <td class="font-weight-bold"> '.$hours.'</td>';
                    $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        $Holiday= getStaffHoliday($row['ID'],$week);
                        if($Holiday)
                        {
                        echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model">'.$Holiday['hours'].'</td>';
                        }
                        else
                        {
                        echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model">  </td>';

                        }
                    }
                    echo '</tr>';
                $i++;
                    
                }
            }
            mysqli_close($conn);
        ?>
        
        
    
        </tbody>
        
    </table>
</div>