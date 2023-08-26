<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header('Location: /index.php');
    exit;
}

$isLoggedIn = true;
?>
<nav class="navbar navbar-expand-md navbar-dark bg-maroon p-3">
    <div class="container-fluid">
        <img class="p-2" src="/assets/pup-logo.png" alt="PUP Logo" width="40">
        <a class="navbar-brand" href="#"><strong>PUPSRC-OTMS</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav gap-3 w-100">
                <li class="nav-item">
                    <a href="#" class="nav-link"><?php echo $_SESSION['office_name']; ?></a>
                </li>
            </ul>
            <ul class="navbar-nav gap-3 w-100 justify-content-end">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle me-1"></i>
                        <?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                        <li><a class="dropdown-item" href="../sign_out.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>