<?php

if(isSet($_POST['username']))
{

include 'databaseForvalidator.php';
$username = $_POST['username'];
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $DBusername, $DBpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT username FROM usersAccount WHERE username ='$username'"); 
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 
    /*
    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
        echo $v;
    }*/
    $rowcount=$stmt->rowCount();
    if($rowcount == 1)
    {
        //echo "record found <br>";
       echo '<font color="red">The nickname <STRONG>'.$username.'</STRONG> is already in use.</font>';              
    }
    else{
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
