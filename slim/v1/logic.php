<?php

//global - connect

function setGlobalVariable() {
    global $connect;
    $connect = new mysqli('sql213.infinityfree.com','if0_34815254','ZslqyYmfBxMI82','if0_34815254_api_data'); //database connection
}

setGlobalVariable();

//-----------------------------------------------------------------------------------------


//show all

function Students_List(){
    global $connect;
    $students = array();
    $qry =  "select * from data";
    $result = $connect->query($qry);
    while($row = $result->fetch_assoc()){
        array_push($students,$row);
    }
    return $students;
}

//-------------------------------------------------------------------------------------------

//show single id
function Students_Single($stu_id) {
    
    global $connect;
    $row_array = array();
    $qry = "SELECT * FROM data WHERE Id = $stu_id";
    $result = $connect->query($qry);
    $row = $result->fetch_assoc();

    if ($row) {
        $row['status'] = 1;
        $row_array = array_merge($row_array, $row);
    } else {
        $row_array['status'] = 0;
    }

    return $row_array;
}

//------------------------------------------------------------------------------------------------

//insert new

function Students_New($Name, $Age, $Email){

    global $connect;   
    $out = array();
    $insertData="INSERT INTO `data`( `Name`, `Age`, `Email`) VALUES ('$Name','$Age','$Email')";
    if(mysqli_query($connect,$insertData)){
        $out['Status'] = 1;
    }else {
        $out['Status'] = 0;
    }
    return $out;
}

//--------------------------------------------------------------------------------------------------

//delete record

function Students_Delete($stu_id){

    global $connect;
    $students = array();
    $qry = "delete from data where Id = $stu_id";
    $deldata = $connect->query($qry);
    if(mysqli_query($connect,$deldata)){
        $result['Status'] = 1;
    }else {
        $result['Status'] = 0;
    }
    return $result;

}

//----------------------------------------------------------------------------------------------------

//update record

function Student_Update($stu_id, $updatedName, $updatedAge, $updatedEmail) {
    
    global $connect;
    $result = array();

    $updateData = "UPDATE `data` SET `Name`='$updatedName', `Age`='$updatedAge', `Email`='$updatedEmail' WHERE `Id`='$stu_id'";
    
    if (mysqli_query($connect, $updateData)) {
        $result['Status'] = 1;
    } else {
        $result['Status'] = 0;
    }

    return $result;
}

//----------------------------------------------------------------------------------------------------------
