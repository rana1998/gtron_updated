<?php
error_reporting(E_ALL ^ E_NOTICE);  

require_once('../core/config.php');
session_start();
$pdo = getDB();   

try {
    
    $root_user_id = 1;
    // Initialize an array to store descendants
    $descendants = [];

    // Start with the root user's ID
    $user_ids_to_check = [$root_user_id];

    $count = 0;
    while (!empty($user_ids_to_check)) {
        // print_r($user_ids_to_check);
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

    // Print the descendants
    echo "Descendants of user $root_user_id: ";
    print_r(count($descendants));
    echo "<br>";

    foreach ($descendants as $descendant) {
        echo "$descendant ";
    }
   
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>



