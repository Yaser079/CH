<?php
///Staff Functions
function getManager($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from staff where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}


/// Country Functions
function getCountry($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from country where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

/// phase details

function gethours($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select SUM(hours) AS hours FROM phase_details where project_id='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2['hours'];
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}
function getPhase($pid,$phase_id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from phase_details where project_id='".$pid."' AND phase_id='".$phase_id."'";
    $result2=mysqli_query($conn,$sql2);
    if(mysqli_num_rows($result2) > 0 )
    {
        $row2 = mysqli_fetch_array($result2);
        return $row2;
    }
    else
    {
        return 0;
    }
    mysqli_close($conn);
}

/// project details
function getProject($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from projects where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}
/// project Status
function getStatus($id)
{ 
    include '../Inc/DBcon.php';
    $sql2="select * from project_status where ID='".$id."'";
    $result2=mysqli_query($conn,$sql2);
    $row2 = mysqli_fetch_array($result2);
    return $row2;
    mysqli_close($conn);
}

?>