<?php
    session_start();
    if(!isset($_SESSION["email"])){
        header("Location: ../controllers/logout_controller.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/getAllUsers_model.php");
    $users = getAllUsers($pdo);
    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>xitTask | User List</title>
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
                <h4>User List</h4>
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
                            <th> Delete </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td class="withImage"> <img src="../uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>"> <?= htmlspecialchars($user['name']) ?> </td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['mobile']) ?></td>
                            <td><?= htmlspecialchars(date("j F, Y", strtotime($user['registerDate']))) ?></td>  
                            <td><?= htmlspecialchars($user['address']) ?></td>
                            <td>
                                 <form method="POST" action="../controllers/userDelete_controller.php">
                                    <input type="hidden" name="email" value="<?= htmlspecialchars($user['email']) ?>">
                                    
                                    <button class="btn reject-btn" type="submit"  ><strong>Delete</strong> </button>
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