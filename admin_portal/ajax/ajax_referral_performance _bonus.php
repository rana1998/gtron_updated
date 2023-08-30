<?php
require_once('../core/config.php');
session_start();
$pdo = getDB();   

try {
   
    // $query = "
    //     WITH RECURSIVE ReferralHierarchy AS (
    //         SELECT id, user_referral_id
    //         FROM pre_registration
    //         WHERE referrer_user_id IS NULL
    //         UNION ALL
    //         SELECT c.id, c.user_referral_id
    //         FROM pre_registration c
    //         JOIN ReferralHierarchy p ON c.referrer_user_id = p.user_referral_id
    //     )
    //     SELECT p.id AS level1_parent_id, COUNT(c.id) AS level3_child_count
    //     FROM ReferralHierarchy p
    //     LEFT JOIN pre_registration c ON p.id = c.referrer_user_id
    //     WHERE c.referrer_user_id IS NOT NULL AND p.user_referral_id = c.user_referral_id
    //     GROUP BY p.id;
    // ";

    // $stmt = $pdo->query($query);
    // $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // print_r($result);

    // foreach ($result as $row) {
    //     echo "Level 1 Parent ID: " . $row['level1_parent_id'] . ", Level 3 Child Count: " . $row['level3_child_count'] . "<br>";
    // }

    // Get distinct user_referral_id values
    // $distinctUserReferralIdsQuery = "SELECT DISTINCT user_referral_id FROM pre_registration";
    // $stmtDistinct = $pdo->query($distinctUserReferralIdsQuery);
    // $distinctUserReferralIds = $stmtDistinct->fetchAll(PDO::FETCH_COLUMN);

    // foreach ($distinctUserReferralIds as $userReferralId) {
    //     $query = "
    //         SELECT COUNT(id) AS level3_child_count
    //         FROM pre_registration
    //         WHERE user_referral_id = :userReferralId
    //     ";

    //     $stmt = $pdo->prepare($query);
    //     $stmt->bindParam(':userReferralId', $userReferralId, PDO::PARAM_STR);
    //     $stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     echo "User Referral ID: " . $userReferralId . ", Level 3 Child Count: " . $row['level3_child_count'] . "<br>";
    // }

    // $query = "SELECT DISTINCT user_referral_id FROM pre_registration";
    // $stmtDistinct = $pdo->query($query);
    // $distinctUserReferralIds = $stmtDistinct->fetchAll(PDO::FETCH_COLUMN);

    // $userCounts = array();

    // foreach ($distinctUserReferralIds as $userReferralId) {
    //     $countQuery = "
    //         SELECT COUNT(id) AS level3_child_count
    //         FROM pre_registration
    //         WHERE referrer_user_id = :userReferralId AND level = 3
    //     ";

    //     $countStmt = $pdo->prepare($countQuery);
    //     $countStmt->bindParam(':userReferralId', $userReferralId, PDO::PARAM_STR);
    //     $countStmt->execute();

    //     $row = $countStmt->fetch(PDO::FETCH_ASSOC);
    //     $userCounts[$userReferralId] = $row['level3_child_count'];
    // }

    // print_r($userCounts);

    // $query = "
    //     SELECT referrer_user_id, COUNT(id) AS referral_count
    //     FROM pre_registration
    //     GROUP BY referrer_user_id;
    // ";

    // $stmt = $pdo->query($query);
    // $referralCounts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // foreach ($referralCounts as $count) {
    //     echo "User with Referrer ID: " . $count['referrer_user_id'] . " has " . $count['referral_count'] . " referral(s)<br>";
    // }

    // Retrieve all users with their referral IDs
    $query = "SELECT id, referrer_user_id FROM pre_registration";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Create an array to store referral counts for each level
    $referralCounts = array();

    // Loop through users
    foreach ($users as $user) {
        $referrerUserId = $user['referrer_user_id'];
        $level = 1; // Initialize the level

        // Loop to traverse the hierarchy and calculate levels
        while ($referrerUserId !== null) {
            // Check if the user's level is not already set
            if (!isset($referralCounts[$level][$referrerUserId])) {
                $referralCounts[$level][$referrerUserId] = 0;
            }

            // Increment the referral count for this level and user
            $referralCounts[$level][$referrerUserId]++;

            // Get the referrer of the current user
            $query = "SELECT referrer_user_id FROM pre_registration WHERE id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $referrerUserId, PDO::PARAM_INT);
            $stmt->execute();
            $referrer = $stmt->fetch(PDO::FETCH_ASSOC);
            $referrerUserId = $referrer['referrer_user_id'];

            $level++;
        }
    }

    // Display the referral counts for each level and user
    foreach ($referralCounts as $level => $levelCounts) {
        echo "Level " . $level . " Referral Counts:<br>";
        foreach ($levelCounts as $referrerUserId => $count) {
            echo "Referrer User ID: " . $referrerUserId . ", Referral Count: " . $count . "<br>";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
