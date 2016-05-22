<?php

    include "connect.php";
    
    //header('Content-Type: application/json');
    
    if(isset($_GET["date"])) {
        
        $query = sprintf("SELECT NOMORNOTA, WAKTU, NAMASUPPLIER, NAMA FROM SILUTEL.PEMBELIAN, SILUTEL.USER WHERE EMAILSTAF = EMAIL AND waktu::date = '%s';", $_GET["date"]);
        
        $result = queryDB($query);
        
        $results = array();
        
        while ($row = pg_fetch_assoc($result)) {
            $results[] = $row;
        }
        
        echo json_encode($results);
        
        //if($result) echo json_encode($result);
        //else echo "{}";
    }
    
    
?>
