<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../views/login.php");
        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/admin_model.php");
    $requests = getAllRequests($conn);
    
    
?>

<div class="table">
    <section class="table-header">
        <h4>Request List</h4>
    </section>
    <section class="table-body">
        <table id="table">
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
                    <td class="withImage"> <img src="/projects/xitTask/uploads/<?= htmlspecialchars($req['avatar'] ?? 'default.png') ?>"> <?= htmlspecialchars($req['name']) ?> </td>
                    <td><?= htmlspecialchars($req['email']) ?></td>
                    <td><?= htmlspecialchars($req['mobile']) ?></td>
                    <td><?= htmlspecialchars(date("j F, Y", strtotime($req['registerDate']))) ?></td>  
                    <td><?= htmlspecialchars($req['address']) ?></td>
                    <td>
                            <form class="acceptForm" method="POST" action="/projects/xitTask/">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($req['id']) ?>">

                            <input type="hidden" name="action" value="accept">
                            <input type="hidden" name="controller" value="admin">


                            <button class="btn accept-btn" type="submit"><strong>Accept</strong> </button>
                        </form>
                    </td>
                    <td>

                        <form class="hidden rejectPopup" method="POST" action="/projects/xitTask/">
                            <p>Do you want to reject <?php echo htmlspecialchars($req["name"]??"this user") ?>?</p>

                            <input type="hidden" name="id" value="<?= htmlspecialchars($req['id']) ?>">

                            <input type="hidden" name="action" value="reject">
                            <input type="hidden" name="controller" value="admin">


                            <div class="btn-area">
                                <button type="button" class="btn accept-btn" onclick="openRejectPopup(this)">No</button>
                                <button class="btn reject-btn" type="submit">Yes</button>
                            </div>

                        </form>

                        
                            
                        <button onclick="openRejectPopup(this)" class="btn reject-btn" type="button"  ><strong>Reject</strong></button>
                        
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>
<script src="/projects/xitTask/js/navbar.js"></script>
<script src="/projects/xitTask/js/request.js"></script>