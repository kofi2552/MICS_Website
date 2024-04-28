<?php

    // try {
    //host
    // $host = "localhost:3306";

    // //dbname
    // $dbname = "micsedug_db";

    // //user
    // $user = "micsedug_user";

    // //pass
    // $pass = "B?34MfAIDblw";


//     $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// } catch(PDOException $e) {
//     echo $e->getMessage();
// }

//  if($conn == true) {
//     echo "connection is working hurayy!";
// } else {
//     echo "conn err";
// }

 ?>






<?php

// LOCAL CONNECTION


    try {
        //host
        $host = "localhost:3306";

        //dbname
        $dbname = "mics_db";

        //user
        $user = "root";

        //pass
        $pass = "";


        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    //  if($conn == true) {
    //     echo "connection is working hurayy!";
    // } else {
    //     echo "conn err";
    // }

    
 ?>