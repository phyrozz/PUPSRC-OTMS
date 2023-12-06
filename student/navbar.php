<?php
session_start();

if (!isset($_SESSION['user_id']) or $_SESSION['user_role'] != 1) {
    header('Location: /index.php');
    exit;
}

$isLoggedIn = true;

// Function to sanitize user input
function sanitizeInput($input) {
    return htmlspecialchars(strip_tags(trim($input)), ENT_QUOTES, 'UTF-8');
}
?>
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
                        <li><a class="dropdown-item" href="/student/registrar.php">Registrar</a></li>
                        <li><a class="dropdown-item" href="/student/guidance.php">Guidance</a></li>
                        <li><a class="dropdown-item" href="/student/academic.php">Academic</a></li>
                        <li><a class="dropdown-item" href="/student/accounting.php">Accounting</a></li>
                        <li><a class="dropdown-item" href="/student/administrative.php">Administrative Services</a></li>
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
                                <li><a class="dropdown-item" href="/student/transactions.php">Your Registrar Transactions</a></li>
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
                <li class="nav-item dropdown order-1 order-lg-3">
                    <a class="nav-link dropdown-toggle m-0 p-0" href="#" id="userProfileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="avatar-rounded-square">
                            <img id="avatar-icon" alt="User Avatar" class="nav-avatar">
                        </div>
                    </a>
                    <ul id="userProfileDropdownMenu" class="dropdown-menu dropdown-menu-end" aria-labelledby="userProfileDropdown">
                        <li>
                            <a class="dropdown-item" href="/student/my_account.php">
                                <h5 class="text-center p-3 m-0">
                                    <?php echo $_SESSION["first_name"] . " " . $_SESSION["last_name"] . " " . $_SESSION["extension_name"]; ?>
                                </h5>
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="/student/transactions.php">My Transactions</a></li>
                        <li><a class="dropdown-item" href="/student/my_account.php">Account Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/sign_out.php"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown order-1 order-lg-2">
                    <a class="nav-link dropdown-toggle notification-button" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-bell fa-xl"></i>
                        <span class="badge badge-danger" id="notificationCount">0</span>
                    </a>
                    <ul class="dropdown-menu w-100 notification-menu" aria-labelledby="notificationDropdown">
                        <h5 class="text-center m-3">Notifications</h5>
                        <div id="notificationList">
                            <!-- Notifications will be populated here -->
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<script>
    $(document).ready(function() {
        function getNotifCount() {
            $.ajax({
                type: 'GET',
                url: '/student/fetch_notifications.php',
                dataType: 'json',
                success: function(response) {
                    // Update notification count and badge
                    $('#notificationCount').text(response.unreadCount);
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        function loadAvatarPicture() {
            $.ajax({
                type: 'GET',
                url: '/fetch_profile_img.php',
                dataType: 'json',
                success: function(response) {
                    if (response.img === "/") {
                        $('#avatar-icon').attr("src", "/assets/avatar.png");
                    } else {
                        $('#avatar-icon').attr("src", response.img);
                    }
                },
                error: function(error) {
                    $('#avatar-icon').attr("src", "/assets/avatar.png");
                    console.log(error);
                }
            });
        }

        getNotifCount();
        loadAvatarPicture();

        // Fetch and update notifications when the notification icon is clicked
        $('#notificationDropdown').click(function() {
            $.ajax({
                type: 'GET',
                url: '/student/fetch_notifications.php',
                dataType: 'json',
                success: function(response) {
                    // Populate the dropdown with notifications
                    var notificationList = $('#notificationList');
                    notificationList.empty();

                    // Add the CSS style for the scrollbar
                    notificationList.css({
                        'max-height': '500px',
                        'overflow-y': 'auto'
                    });

                    if (response.unreadCount > 0) {
                        // Display up to 10 notifications (if available)
                        var notificationsToDisplay = response.notifications.slice(0, 10);

                        notificationsToDisplay.forEach(function(notification) {
                            var notificationItem = $('<li class="card m-2" data-notification-id="' + notification.notification_id + '">' + 
                                '<a href="#" class="dropdown-item notification-item">' + 
                                    '<p class="text-wrap m-0 text-end"><i><small>' + notification.office_name + '</small></i></p>' + 
                                    '<p class="text-wrap m-0"><b><small>' + notification.timestamp + '</small></b></p>' + 
                                    '<p class="text-wrap m-0"><b>' + notification.title + '</b></p>' + 
                                    '<p class="text-wrap">' + notification.description + '</p>' + 
                                '</a>' + 
                            '</li>');

                            // Add the click handler within the forEach loop
                            notificationItem.on('click', function(e) {
                                e.stopPropagation();
                                handleNotificationClick(notification.notification_id);
                            });

                            notificationList.append(notificationItem);
                        });
                    } else {
                        notificationList.html('<div class="mx-5 my-3 text-center">'+
                        '<i class="fa-regular fa-thumbs-up fa-2xl"></i>'+
                        '<p><b>You\'re all set!</b></p>'+
                        '<p><small>No new notifications</small></p>'+
                        '</div>');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });

        // Define the handleNotificationClick function
        function handleNotificationClick(notificationId) {
            $.ajax({
                type: 'POST',
                url: '/student/mark_notif.php',
                data: { notificationId: notificationId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        var notificationItem = $('[data-notification-id="' + notificationId + '"]');

                        // Apply fade-out transition and remove the item
                        notificationItem.fadeOut(400, function() {
                            notificationItem.removeClass('unread');
                            notificationItem.remove();

                            // Check if the list is empty after removing the item
                            if ($('#notificationList').children().length === 0) {
                                var notificationList = $('#notificationList');
                                notificationList.html('<div class="mx-5 my-3 text-center">'+
                                '<i class="fa-regular fa-thumbs-up fa-2xl"></i>'+
                                '<p><b>You\'re all set!</b></p>'+
                                '<p><small>No new notifications</small></p>'+
                                '</div>');
                            }
                        });

                        // Update notification count and badge
                        $('#notificationCount').text(response.unreadCount);
                    } else {
                        console.log('Failed to mark notification as read.');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        // Handle marking notifications as read
        $('#notificationList').on('click', '.dropdown-item', function(e) {
            var notificationItem = $(this);
            var notificationId = notificationItem.data('notification-id');

            e.stopPropagation();

            $.ajax({
                type: 'POST',
                url: 'mark_notif.php',
                data: { notificationId: notificationId },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // Apply fade-out transition and remove the item
                        notificationItem.fadeOut(400, function() {
                            notificationItem.removeClass('unread');
                            notificationItem.remove();
                        });

                        // Update notification count and badge
                        $('#notificationCount').text(response.unreadCount);
                    } else {
                        console.log('Failed to mark notification as read.');
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    });

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
        url: '/student/autocomplete.php',
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