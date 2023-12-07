<div class="table-responsive">
    <table   class="table table-bordered text-center ">
        <thead>
        <tr>
            <th>ID</th>
            <th  > Office </th>
            <th  ><div class="rotated" >Total</div></th>
            <?php 
                include '../script/functions.php';
                $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        echo '<th  data-orderable="false"><div class="rotated" > '.$week.' </div></th>';
                    }
                ?>
        </tr>
        </thead>
        <tbody>
        <?php
            include '../Inc/DBcon.php';
            $sql2="select * from office;";
            $result=mysqli_query($conn,$sql2);
            if(mysqli_num_rows($result) > 0 )
            {
                $i=1;
                while($row = mysqli_fetch_array($result))
                {
                    $hours=getTotalOfficeHoliday($row['ID']);
                    echo '<tr>
                    <td>'.$i.'</td>
                    <td>'.$row['code'].'</td>
                    <td> '.$hours.'</td>';
                    $weeks=getWeeks(date('Y'));
                    foreach($weeks as $week)
                    {
                        $Holiday= getOfficeHoliday($row['ID'],$week);
                        if($Holiday)
                        {
                        echo '<td class="week font-weight-bold" id="'.$row['ID'].'_'.$week.'" onclick="HolidayForm(this.id)" data-toggle="modal" data-target="#holiday-model" data-tooltip="tooltip"  title="'.$Holiday['description'].'">'.$Holiday['hours'].'</td>';
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