<?php
        $stmt = $conn->prepare("SELECT COUNT(c.category_name) as totalSanitationCount 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE c.category_name = 'Sanitation' ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalSanitationCount = $row['totalSanitationCount'];
        }
        $stmt = $conn->prepare("SELECT COUNT(c.category_name) as totalInfrastracture 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE c.category_name = 'Infrastructure' ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalInfrastracture = $row['totalInfrastracture'];
        }

        $stmt = $conn->prepare("SELECT COUNT(c.category_name) as neigboir_concern 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE c.category_name = 'Neighbor Concerns' ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $neigboir_concern = $row['neigboir_concern'];
        }


        $stmt = $conn->prepare("SELECT COUNT(c.category_name) as security 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE c.category_name = 'Security' ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $security = $row['security'];
        }

     
        $stmt = $conn->prepare("SELECT COUNT(c.category_name) as otherconcerns 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id WHERE c.category_name = 'Other Concerns' ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $otherconcerns = $row['otherconcerns'];
        }



        $stmt = $conn->prepare("SELECT COUNT(*) as total 
        FROM epcr_user_complaints u 
        LEFT JOIN epcr_category c ON c.category_id = u.category_id ");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total = $row['total'];
        }

        $stmt = $conn->prepare("SELECT COUNT(*) as totaluser 
        FROM epcr_users");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totaluser = $row['totaluser'];
        }

        // Fetch total count of complaints with "RESOLVED" status
$stmt = $conn->prepare("SELECT COUNT(*) as resolvedCount 
FROM epcr_user_complaints 
WHERE status = 'resolved'");
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
$row = $result->fetch_assoc();
$resolvedCount = $row['resolvedCount'];
} else {
$resolvedCount = 0;
}



        $stmt->close();
        $conn->close();