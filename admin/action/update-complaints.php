<?php
session_start();
require '../../database.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        $dataId = $_POST['dataId'];
        
        // Sanitize input
        $action = htmlspecialchars($action);
        $dataId = intval($dataId);

        // Prepare the statement
        $stmt = $conn->prepare("UPDATE epcr_user_complaints SET status = ? WHERE complaint_id = ?");
        $stmt->bind_param("si", $status, $dataId);

        switch ($action) {
            case "on-going":
                $status = 'On-going';
                break;
            case "resolved":
                $status = 'resolved';
                break;
            case "declined":
                $status = 'declined';
                break;
            default:
                $response = [
                    'status' => 400,
                    'message' => 'Invalid action specified'
                ];
                header('Content-Type: application/json');
                echo json_encode($response);
                exit();
        }

        // Execute the statement
        $stmt->execute();

        if ($stmt->error) {
            $response = [
                'status' => 400,
                'message' => 'Database error: ' . $stmt->error
            ];
        } elseif ($stmt->affected_rows > 0) {
            $selector = "SELECT fullname FROM epcr_adminusers WHERE email = ?";
            $stmt_sel = $conn->prepare($selector);
            $stmt_sel->bind_param("s", $_SESSION['email']);
            $stmt_sel->execute();
            $resel = $stmt_sel->get_result();

            if ($resel->num_rows > 0) {
                $row = $resel->fetch_assoc();
                $fullname = $row['fullname'];

                $sel = "SELECT * FROM epcr_user_complaints WHERE complaint_id = ?";
                $stmt_sel2 = $conn->prepare($sel);
                $stmt_sel2->bind_param("i", $dataId);
                $stmt_sel2->execute();
                $res = $stmt_sel2->get_result();

                if ($res->num_rows > 0) {
                    $selrow = $res->fetch_assoc();
                    $compliant = $selrow['name'];
                    $complaint = $selrow['complaints'];
                    $category_id = $selrow['category_id'];
                    $date = $selrow['date_submitted'];
                    $formatted_date = date("F d, Y", strtotime($date));

                    switch ($category_id) {
                        case 1:
                            $category = "Sanitation";
                            break;
                        case 2:
                            $category = "Security";
                            break;
                        case 3:
                            $category = "Infrastructure";
                            break;
                        case 4:
                            $category = "Neighbor Concern";
                            break;
                        default:
                            $category = "Other Concern";
                            break;
                    }

                    switch ($action) {
                        case "on-going":
                            $acres = "Changed the complaint status to 'On-going' for the complaint submitted by $compliant about $category, which was submitted on $formatted_date.";
                            break;
                        case "resolved":
                            $acres = "Changed the complaint status to 'Resolved' for the complaint submitted by $compliant about $category, which was submitted on $formatted_date.";
                            break;
                        case "declined":
                            $acres = "Declined the complaint submitted by $compliant about $category, which was submitted on $formatted_date.";
                            break;
                        default:
                            $response = [
                                'status' => 400,
                                'message' => 'Invalid action specified'
                            ];
                            header('Content-Type: application/json');
                            echo json_encode($response);
                            exit();
                    }

                    $sql = "INSERT INTO epcr_logs SET fullname = ?, position = ?, compliant = ?, complaint = ?, complaint_id = ?, action = ?";
                    $stmt_ins = $conn->prepare($sql);
                    $stmt_ins->bind_param("ssssds", $fullname, $_SESSION['user_type'], $compliant, $complaint, $dataId, $acres);
                    $stmt_ins->execute();

                    if ($stmt_ins->error) {
                        $response = [
                            'status' => 400,
                            'message' => 'Database error: ' . $stmt_ins->error
                        ];
                    } else {
                        $response = [
                            'status' => 200,
                            'message' => 'Complaint Status Updated to ' . $status
                        ];
                    }
                } else {
                    $response = [
                        'status' => 400,
                        'message' => 'Failed to fetch complaint data'
                    ];
                }
            } else {
                $response = [
                    'status' => 400,
                    'message' => 'Failed to fetch admin user data'
                ];
            }
        } else {
            $response = [
                'status' => 400,
                'message' => 'Failed to update complaint'
            ];
        }

        // Send response as JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        $response = [
            'status' => 400,
            'message' => 'Invalid request'
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
?>
