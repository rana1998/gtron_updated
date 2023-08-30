<?php
error_reporting(E_ALL ^ E_NOTICE);  

require_once('../core/config.php');
session_start();
$pdo = getDB();   

try {
   // Fetch all users from user_hierarchy
   $query = "SELECT user_id, parent_user_id, user_level FROM user_hierarchy";
   $stmt = $pdo->prepare($query);
   $stmt->execute();

   // Initialize an array to store descendant counts and levels for each user and each level
   $descendantCounts = [];

   // Loop through each user record
   while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
       $user_id = $row['user_id'];
       $parent_user_id = $row['parent_user_id'];
       $user_level = $row['user_level'];

       // Initialize the descendant count and levels for the user and level if not present
       if (!isset($descendantCounts[$user_id])) {
           $descendantCounts[$user_id] = [];
       }
       if (!isset($descendantCounts[$user_id][$user_level])) {
           $descendantCounts[$user_id][$user_level] = [
               'descendant_count' => 0,
               'current_user_level' => $user_level,
               'level_for_parent' => $user_level
           ];
       }

       // Increment the descendant count and levels for the user and level
       while ($parent_user_id !== null) {
           $descendantCounts[$parent_user_id][$user_level]['descendant_count']++;
           $descendantCounts[$parent_user_id][$user_level]['current_user_level'] = $user_level;
           $descendantCounts[$parent_user_id][$user_level]['level_for_parent'] = $descendantCounts[$parent_user_id][$user_level]['level_for_parent'];

           $query = "SELECT parent_user_id, user_level FROM user_hierarchy WHERE user_id = :parent_user_id";
           $stmtParent = $pdo->prepare($query);
           $stmtParent->bindParam(':parent_user_id', $parent_user_id, PDO::PARAM_INT);
           $stmtParent->execute();
           $parentRow = $stmtParent->fetch(PDO::FETCH_ASSOC);
           $parent_user_id = $parentRow['parent_user_id'];
       }
   }

   // Print or use the descendant counts and levels for each user and level
   foreach ($descendantCounts as $user_id => $levelData) {
       echo "User $user_id descendant counts and levels:\n";
       foreach ($levelData as $level => $data) {
           $descendant_count = $data['descendant_count'];
           $current_user_level = $data['current_user_level'];
           $level_for_parent = $data['level_for_parent'];
           echo "Level $level: $descendant_count descendants, Current User Level: $current_user_level, Level for Parent: $level_for_parent\n";
       }
       echo "\n";
   }
   
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
