 <div class="navbar">
    <div class="navbar-start">
        
        <h4>Admin Dashboard</h4>

            
    </div>
    <div class="navbar-center">
        <a href="/projects/xitTask/admin/userList">User List</a>
        <a href="/projects/xitTask/admin/requests">Requests</a>
        <a href="/projects/xitTask/admin/profile">Password</a>
    </div>
    <div class="navbar-end">
        <a class="btn-ghost text-2xl text-bold" href="/projects/xitTask/logout">Logout   <i class="fa-solid fa-right-from-bracket"></i></a>

        <button onclick="openDropdown(this)" id="option-btn" class="btn-icon hidden"><i class="fa-solid fa-bars"></i></button>

        <div id="dropdown-menu" class="dropdown-menu">
                    <!-- <div class="img-name">
                        <i class="fa-solid fa-circle-user"></i>
                        <h6>Saimul Hoque</h6>
                    </div>
                    <hr> -->
                    <div class="options">
                        <ul>

                            <a href="../views/adminDashboard_userList.php">
                                <div class="li-content">
                                    <i class="fa-solid fa-gear text-gray"></i>
                                    <p class="text-semibold">User List</p>
                                </div>
                                <span>></span>
                            </a>

                            <a href="../views/adminDashboard_requests.php">
                                <div class="li-content">
                                    <i class="fa-solid fa-gear text-gray"></i>
                                    <p class="text-semibold">Requests</p>
                                </div>
                                <span>></span>
                            </a>

                            <a href="../views/adminDashboard_profile.php">
                                <div class="li-content">
                                    <i class="fa-regular fa-circle-user text-gray"></i>
                                    <p class="text-semibold">Password</p>
                                </div>
                                <span>></span>
                            </a>

                            <a href="../controllers/auth_controller.php?action=logout">
                                <div class="li-content">
                                    <i class="fa-solid fa-right-from-bracket text-gray"></i>
                                    <p class="text-semibold">Logout</p>
                                </div>
                                <span>></span>
                            </a>

                            
                        </ul>
                    </div>
                </div>


    </div>
</div>