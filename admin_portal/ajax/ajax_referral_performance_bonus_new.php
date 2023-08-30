<?php
error_reporting(E_ALL ^ E_NOTICE);  

require_once('../core/config.php');
session_start();
$pdo = getDB();   

try {
    
    $root_user_id = 1;
    $direct5 = true; //direct 5 or 10 refferal flag
    // Initialize an array to store descendants
    $descendants = [];

    // Start with the root user's ID
    $user_ids_to_check = [$root_user_id];

    $count = 0;
    while (!empty($user_ids_to_check)) {
        $current_user_id = array_shift($user_ids_to_check);

        // Fetch descendants for the current user
        $query = "SELECT user_id FROM user_hierarchy WHERE parent_user_id = :user_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':user_id', $current_user_id, PDO::PARAM_INT);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $descendants[] = $row['user_id'];
            $user_ids_to_check[] = $row['user_id'];
        }
    }

    $totalcount = count($descendants);

    $selectQuery = "SELECT is_direct_five_ref FROM user_direct_ref_count WHERE user_id = ?";

    $stmtSelect = $pdo->prepare($selectQuery);
    $stmtSelect->execute([$root_user_id]);

    $queryRes = $stmtSelect->fetch();

    $is_direct_five_ref = (int)$queryRes['is_direct_five_ref'];

    $usdt_bonus = 0;
    $gtc_bonus = 0;
    if($is_direct_five_ref == 1) {
        if($totalcount >= 30 && $totalcount <= 155) {
            $usdt_bonus = 100;
            $gtc_bonus = 10000;
        }elseif($totalcount >= 155) {
            $usdt_bonus = 200;
            $gtc_bonus = 20000;
        }
    } 
    else {
        if($totalcount >= 110 && $totalcount <= 1110) {
            $usdt_bonus = 200;
            $gtc_bonus = 20000;
        }elseif($totalcount >= 1110) {
            $usdt_bonus = 2250;
            $gtc_bonus = 225000;
        }
    }

    

    $sql1 = "SELECT user_id, user_name FROM user_hierarchy WHERE user_id = :user_id";
    $stmt1 = $pdo->prepare($sql1);
    $stmt1->bindParam(':user_id', $root_user_id, PDO::PARAM_INT);
    $stmt1->execute();

    $row1 = $stmt1->fetch();
    $user_id = $row1['user_id'];
    $user_name = $row1['user_name'];

// Prepare the SQL query
$queryInsert = "INSERT INTO referral_performance_bonus (user_id, user_name, usdt_bonus, gtc_bonus) VALUES (:user_id, :user_name, :usdt_bonus, :gtc_bonus)";

// Prepare the statement
$stmtInsert = $pdo->prepare($queryInsert);

// Bind parameters
$stmtInsert->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmtInsert->bindParam(':user_name', $user_name, PDO::PARAM_STR);
$stmtInsert->bindParam(':usdt_bonus', $usdt_bonus, PDO::PARAM_STR);
$stmtInsert->bindParam(':gtc_bonus', $gtc_bonus, PDO::PARAM_INT);

// Execute the query
if ($stmtInsert->execute()) {
    echo "Record inserted successfully.";
} else {
    echo "Error inserting record: " . $stmtInsert->errorInfo()[2];
}
    
   
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>



