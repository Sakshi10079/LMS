<?php

include("data_class.php");

 echo $email=$_POST['email'];
 echo $pass=$_POST['pass'];

if($email==null||$pass==null){
    $emailmsg="";
    $passmsg="";
    
    if($email==null){
        $emailmsg="Email Empty";
    }
    if($pass==null){
        $passdmsg="Pasword Empty";
    }

    if (isset($_POST['email']) && isset($_POST['pass'])) {
        // Access the values only if the keys are present
        $email = $_POST['email'];
        $pass = $_POST['pass'];
    
        // Reset of your code
    } else {
        // Handle the case when the keys are not present
        echo "Email and/or password not provided.";
    }
    

    header("Location: index.php?ademailmsg=$emailmsg&adpasdmsg=$pasdmsg");
}

elseif($email!=null&&$pass!=null){
    $obj=new data();
    $obj->setconnection();
    $obj->adminLogin($email,$pass);

}




