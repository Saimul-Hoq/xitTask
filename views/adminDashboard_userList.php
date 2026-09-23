<?php
    session_start();
    if(!isset($_SESSION["id"])){
        header("Location: ../views/login.php");
        // header("Location: ".__DIR__."/login.php");
        // header("Location: unga/bunga/hello");

        exit();
    }

    require_once(__DIR__."/../config/database.php");
    require_once(__DIR__."/../models/admin_model.php");
    $users = getAllUsers($conn);
    
    
?>
<div class="table">
    <section class="table-header">
        <h4>User List</h4>
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
                    <th> Delete </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td class="withImage"> <img src="/projects/xitTask/uploads/<?= htmlspecialchars($user['avatar'] ?? 'default.png') ?>"> <?= htmlspecialchars($user['name']) ?> </td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['mobile']) ?></td>
                    <td><?= htmlspecialchars(date("j F, Y", strtotime($user['registerDate']))) ?></td>  
                    <td><?= htmlspecialchars($user['address']) ?></td>
                    <td>

                            <form class="hidden rejectPopup" method="POST" action="/projects/xitTask/">
                            <p>Do you want to Delete <?php echo htmlspecialchars($user["name"]??"this user") ?>?</p>

                            <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">

                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="controller" value="admin">


                            <div class="btn-area">
                                <button type="button" class="btn accept-btn" onclick="openRejectPopup(this)">No</button>
                                <button class="btn reject-btn" type="submit">Yes</button>
                            </div>

                        </form>

                        <button onclick="openRejectPopup(this)" class="btn reject-btn" type="button"  ><strong>Delete</strong></button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</div>

<script src="/projects/xitTask/js/navbar.js"></script>
<script src="/projects/xitTask/js/request.js"></script>