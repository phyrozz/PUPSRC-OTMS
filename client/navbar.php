<?php
    session_start();
    
    if (!isset($_SESSION['user_id']) or $_SESSION['user_role'] != 2) {
        header('Location: http://localhost/index.php');
        exit;
    }

    $isLoggedIn = true;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-maroon p-3">
  <div class="container-fluid">
    <a href="http://localhost/client/home.php"><img class="p-2" src="http://localhost/assets/pup-logo.png"
        alt="PUP Logo" width="40"></a>
    <a class="navbar-brand" href="http://localhost/client/home.php"><strong>PUPSRC-OTMS</strong></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto order-2 order-lg-1">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <?php
                            echo $office_name;
                        ?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
            <li><a class="dropdown-item" href="http://localhost/client/registrar.php">Registrar</a></li>
            <li><a class="dropdown-item" href="http://localhost/client/guidance.php">Guidance</a></li>
            <li><a class="dropdown-item" href="http://localhost/client/accounting.php">Accounting</a></li>
            <li><a class="dropdown-item" href="http://localhost/client/administrative.php">Administrative Services</a>
            </li>
          </ul>
        </li>
        <?php if ($office_name != "Select an Office") { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="officeServicesDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            Services List
          </a>
          <ul class="dropdown-menu" aria-labelledby="officeServicesDropdown">
            <?php switch ($office_name) { 
                            case 'Guidance Office':
                                echo '';
                                break;
                            case 'Administrative Office':
                                echo '
								<li><a class="dropdown-item" href="/student/administrative/view-equipment.php">View Available Equipment</a></li>
                                <li><a class="dropdown-item" href="/student/administrative/view-facility.php">View Available Facilities</a></li>
								';
                                break;
							case 'Registrar Office':
								echo '
								<li><a class="dropdown-item" href="/client/registrar/create_request.php">Create Request</a></li>
								<li><a class="dropdown-item" href="/client/transactions.php">Your Registrar Transactions</a></li>
								';
								break;
                            case 'Accounting Office':
                                echo '
								<li><a class="dropdown-item"href="/client/accounting/payment1.php">Payment</a></li>
								<li><a class="dropdown-item"href="/client/accounting/offsetting1.php">Offsetting</a></li>
								<li><a class="dropdown-item"href="http://localhost/client/transactions.php">Registrar Transaction History</a></li>
								';
                                break;
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
          <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            <i class="fa fa-user-circle me-1"></i>
            <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"]; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
            <li><a class="dropdown-item" href="http://localhost/client/transactions.php">My Transactions</a></li>
            <li><a class="dropdown-item" href="http://localhost/client/my_account.php">Account Settings</a></li>
            <li><a class="dropdown-item" href="http://localhost/sign_out.php"><i
                  class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>