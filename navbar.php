<nav class="navbar navbar-expand-lg navbar-dark bg-maroon p-3">
    <div class="container-fluid">
        <img class="p-2" src="/assets/pup-logo.png" alt="PUP Logo" width="40">
        <a class="navbar-brand" href="/student/home.php"><strong>PUPSRC-OTMS</strong></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto order-2 order-lg-1">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        echo $office_name;
                        ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
                        <li><a class="dropdown-item" href="#">Registration</a></li>
                        <li><a class="dropdown-item" href="/student/guidance.php">Guidance</a></li>
                        <li><a class="dropdown-item" href="/student/academic.php">Academic</a></li>
                        <li><a class="dropdown-item" href="#">Accounting</a></li>
                        <li><a class="dropdown-item" href="#">Administration</a></li>
                    </ul>
                </li>
                <?php if ($office_name != "Select an Office") { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services List
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
                        <?php switch ($office_name) { 
                            case 'Guidance Office':
                                echo '
                                <li><a class="dropdown-item" href="/student/guidance/counceling.php">Schedule Counceling</a></li>
                                <li><a class="dropdown-item" href="/student/guidance/good_morals.php">Request Good Moral Document</a></li>
                                <li><a class="dropdown-item" href="/student/guidance/clearance.php">Request Clearance</a></li>
                                ';
                                break;
                            case 'Academic Office':
                                echo '
                                <li><a class="dropdown-item" href="/student/academic/subject_overload.php">Subject Overload</a></li>
                                <li><a class="dropdown-item" href="/student/academic/grade_accreditation.php">Grade Accreditation</a></li>
                                <li><a class="dropdown-item" href="/student/academic/cross_enrollment.php">Cross-Enrollment</a></li>
                                <li><a class="dropdown-item" href="/student/academic/shifting.php">Shifting</a></li>
                                <li><a class="dropdown-item" href="/student/academic/manual_enrollment.php">Manual Enrollment</a></li>
                                <li><a class="dropdown-item" href="/student/academic/servicesinsistools.php">Services in SIS Tools</a></li>
                                ';
                            // Add more cases for other office services
                            }
                        ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            <ul class="navbar-nav order-3 order-lg-3 w-50 gap-3">
                <div class="d-flex navbar-nav justify-content-center me-auto order-2 order-lg-1 w-100">
                    <form class="d-flex w-100">
                        <input class="form-control me-2" type="search" placeholder="Search for services..." aria-label="Search">
                        <button class="btn search-btn" type="submit"><strong>Search</strong></button>
                    </form>
                </div>
                <li class="nav-item dropdown order-1 order-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle me-1"></i>
                        Juan Dela Cruz
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                        <li><a class="dropdown-item" href="/student/transactions.php">My Transactions</a></li>
                        <li><a class="dropdown-item" href="#">Account Settings</a></li>
                        <li><a class="dropdown-item" href="../index.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>