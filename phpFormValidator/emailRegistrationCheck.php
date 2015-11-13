<?php

include 'databaseForvalidator.php';



if(isSet($_POST['email'])){
$email = $_POST['email'];
    try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $DBusername, $DBpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT email FROM usersAccount WHERE email ='$email'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    $rowcount=$stmt->rowCount();
    if($rowcount == 1)
    {
        //echo "record found <br>";
       echo '<font color="red">This email is already registered.</font>';              
    }
    else{
        //$_SESSION['username_OK']=$username;
        echo 'OK';
       //echo "record does not found <br>";
    }
    }
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;

}
?>
