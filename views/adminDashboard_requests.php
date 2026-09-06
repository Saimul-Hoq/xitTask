<?php
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: ../controllers/logout_controller.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/getAllRequest_model.php");
    $requests = getAllRequests($pdo);
    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xitTask | Requests</title>
    <link rel="shortcut icon" href="../assets/xit_logo.png" type="image/x-icon">
    
    <!-- font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">

    <!-- icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css" integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- CSS -->
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/adminDashboard_requests.css">
</head>
<body>
    <?php include '../includes/navbar.php' ?>
    <div class="body-content">
        <div class="table">
            <section class="table-header">
                <h4>Request List</h4>
            </section>
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th> User </th>
                            <th> Email </th>
                            <th> Mobile </th>
                            <th> Date </th>
                            <th>Address</th>
                            <th> Accept </th>
                            <th> Reject </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $req): ?>
                        <tr>
                            <td class="withImage"> <img src="../uploads/<?= htmlspecialchars($req['avatar'] ?? 'default.png') ?>"> <?= htmlspecialchars($req['name']) ?> </td>
                            <td><?= htmlspecialchars($req['email']) ?></td>
                            <td><?= htmlspecialchars($req['mobile']) ?></td>
                            <td><?= htmlspecialchars(date("j F, Y", strtotime($req['registerDate']))) ?></td>  
                            <td><?= htmlspecialchars($req['address']) ?></td>
                            <td>
                                 <form method="POST" action="requestAccept_controller.php">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($req['email']) ?>">
                                    <button class="btn accept-btn" type="submit"><strong>Accept</strong> </button>
                                </form>
                            </td>
                            <td>
                                 <form method="POST" action="requestReject_controller.php">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($req['email']) ?>">
                                    <button class="btn reject-btn" type="submit"  ><strong>Reject</strong> </button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
</body>
</html>