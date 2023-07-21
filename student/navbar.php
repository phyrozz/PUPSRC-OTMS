<?php
session_start();

if (!isset($_SESSION['user_id']) or $_SESSION['user_role'] != 1) {
    header('Location: http://192.168.100.4/index.php');
    exit;
}

$isLoggedIn = true;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-maroon p-3">
    <div class="container-fluid">
        <img class="p-2" src="http://192.168.100.4/assets/pup-logo.png" alt="PUP Logo" width="40">
        <a class="navbar-brand" href="http://192.168.100.4/student/home.php"><strong>PUPSRC-OTMS</strong></a>
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
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/registrar.php">Registrar</a></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/guidance.php">Guidance</a></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/academic.php">Academic</a></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/accounting.php">Accounting</a></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/administrative.php">Administrative Services</a></li>
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
                                <li><a class="dropdown-item" href="/student/guidance/counseling.php">Schedule Counseling</a></li>
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
                                break;
                            case 'Administrative Office':
                                echo '
                                <li><a class="dropdown-item" href="/student/administrative/view-equipment.php">View Available Equipment</a></li>
                                <li><a class="dropdown-item" href="/student/administrative/view-facility.php">View Available Facilities</a></li>
                                ';
                                break;
                            case 'Registrar Office':
                                echo '
                                <li><a class="dropdown-item" href="/student/registrar/create_request.php">Create Request</a></li>
                                <li><a class="dropdown-item" href="/student/registrar/your_transaction.php">Your Registrar Transactions</a></li>
                                ';
                                break;
                            case 'Accounting Office':
                                echo '
                                <li><a class="dropdown-item" href="/student/accounting/payment1.php">Payment</a></li>
                                <li><a class="dropdown-item" href="/student/accounting/offsetting1.php">Offsetting</a></li>
                                <li><a class="dropdown-item" href="/student/transactions.php">Registrar Transaction History</a></li>
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
                    <div class="d-flex w-100">
                        <input class="form-control me-2" type="search" id="services-search" name="query" placeholder="Search for services..." aria-label="Search" minlength="3" maxlength="50" oninput="validateSearchInput(this); handleSearchAutocomplete(this)" autocomplete="off">
                        <button class="btn search-btn" onclick="submitSearch()"><strong>Search</strong></button>
                    </div>
                    <div id="autocomplete-list" class="autocomplete-list"></div>
                </div>
                <li class="nav-item dropdown order-1 order-lg-2">
                    <a class="nav-link dropdown-toggle" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user-circle me-1"></i>
                        <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"] . " " . $_SESSION["extension_name"]; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/transactions.php">My Transactions</a></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/student/my_account.php">Account Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="http://192.168.100.4/sign_out.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    function handleSearchAutocomplete(input) {
        var query = input.value.trim();
        var autocompleteList = document.getElementById('autocomplete-list');

        if (query === '') {
        // Clear autocomplete list if query is empty
        autocompleteList.style.display = 'none';
        return;
        }

        // Make an AJAX request to fetch autocomplete results
        $.ajax({
        url: 'http://192.168.100.4/autocomplete.php',
        method: 'POST',
        data: { query: query },
        success: function(response) {
            // Update the autocomplete list with the received results
            autocompleteList.innerHTML = response;
            autocompleteList.style.display = 'block';
        }
        });
    }

    function validateSearchInput(input) {
        var regex = /^[a-zA-Z\s]+$/; // Regular expression to allow only letters
        var value = input.value;
        var newValue = '';

        // Remove non-letter characters
        for (var i = 0; i < value.length; i++) {
        if (regex.test(value[i])) {
            newValue += value[i];
        }
        }

        input.value = newValue;
    }

    window.addEventListener('DOMContentLoaded', function() {
        var autocompleteList = document.getElementById('autocomplete-list');
        autocompleteList.style.display = 'none';

        var searchInput = document.getElementById('services-search');
        searchInput.addEventListener('input', function() {
        if (searchInput.value === '') {
            autocompleteList.style.display = 'none';
        }
        });
    });

    function submitSearch() {
        var queryInput = document.getElementById('services-search');
        var query = queryInput.value.trim();

        if (query === '' || query.length <= 2) {
        // If query is empty or too short, prevent search
        return;
        }

        // Redirect to search.php with the query parameter
        window.location.href = '/student/search.php?query=' + encodeURIComponent(query);
    }
</script>