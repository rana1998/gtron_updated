<?php
error_reporting(E_ALL ^ E_NOTICE);  

require_once('../core/config.php');
session_start();
$pdo = getDB();   

try {
   
// code 4
// Fetch all users from user_hierarchy
$query = "SELECT user_id, parent_user_id, user_level FROM user_hierarchy";
$stmt = $pdo->prepare($query);
$stmt->execute();

// Initialize an array to store descendant counts for each user and each level
$descendantCounts = [];

// Loop through each user record
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user_id = $row['user_id'];
    $parent_user_id = $row['parent_user_id'];
    $user_level = $row['user_level'];

    // Initialize the descendant count for the user and level if not present
    if (!isset($descendantCounts[$user_id])) {
        $descendantCounts[$user_id] = [];
    }
    if (!isset($descendantCounts[$user_id][$user_level])) {
        $descendantCounts[$user_id][$user_level] = 0;
    }

    // Increment the descendant count for the user and level
    while ($parent_user_id !== null) {
        $descendantCounts[$parent_user_id][$user_level]++;
        $query = "SELECT parent_user_id, user_level FROM user_hierarchy WHERE user_id = :parent_user_id";
        $stmtParent = $pdo->prepare($query);
        $stmtParent->bindParam(':parent_user_id', $parent_user_id, PDO::PARAM_INT);
        $stmtParent->execute();
        $parentRow = $stmtParent->fetch(PDO::FETCH_ASSOC);
        $parent_user_id = $parentRow['parent_user_id'];
    }
}

// Print or use the descendant counts for each user and level
foreach ($descendantCounts as $user_id => $levelCounts) {
    echo "User $user_id descendant counts:\n";
    foreach ($levelCounts as $level => $count) {
        echo "Level $level: $count descendants\n";
    }
    echo "\n";
}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
