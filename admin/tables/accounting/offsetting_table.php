<?php
// Generate a list of statuses for this table to be rendered on <select> in guidance.php
$statuses = array(
    'all' => 'All',
    '1' => 'Pending',
    '3' => 'For Evaluation',
    '6' => 'Rejected',
    '7' => 'Approved'
);
?>
<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <input type="checkbox" id="chk-btn" name="request-checkbox" class="hidden" onclick="selectAllCheckbox(this)"><label for="chk-btn" class="chk-btn">Select All</label></input>
                <style>
                    .hidden{
                        display: none;
                    }
                    .chk-btn{
                        padding: 10px;
                        background-color: #800000;
                        color: #fff;
                        margin-bottom: 5px;
                        border-radius: 5px;
                    }
                </style>
                <script>
                    function selectAllCheckbox(source) {
                        checkboxes = document.getElementsByName('request-checkbox');
                        for(var i=0, n=checkboxes.length;i<n;i++) {
                            checkboxes[i].checked = source.checked;
                        }
                        }
                        // Function to reset all checkboxes
                    function resetCheckboxes() {
                        var checkboxes = document.getElementsByName('request-checkbox');
                        checkboxes.forEach(function (checkbox) {
                            checkbox.checked = false;
                        });

                        // Disable the update button and status dropdown
                        $('#update-status-button').prop('disabled', true);
                        $('#update-status').prop('disabled', true);
                    }
                </script>
            <th class="text-center"></th>
                <th class="text-center sortable-header" data-column="offsetting_id" scope="col" data-order="desc">
                    Offsetting Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="timestamp" scope="col" data-order="desc">
                    Date Requested
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="last_name" scope="col" data-order="desc">
                    Requestor
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="amountToOffset" scope="col" data-order="desc">
                    Amount to Offset
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="offsetType" scope="col" data-order="desc">
                    Offset Type
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="status_name" scope="col" data-order="desc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0 d-flex justify-content-between w-100">
    <div class="d-flex gap-2">
        <div class="input-group">
            <div class="input-group-text">Update Status:</div>
            <select class="form-select" name="update-status" id="update-status" disabled>
                <option value="1">Pending</option>
                <option value="3">For Evaluation</option>
                <option value="7">Approved</option>
                <option value="6">Rejected</option>
            </select>
        </div>
        <div>
            <a href="#" id="status-info-btn">What do these statuses mean?</a>
        </div>
        <button id="update-status-button" class="btn btn-primary w-50" disabled><i class="fa-solid fa-pen-to-square"></i> Update</button>
    </div>    
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<!-- View user details modal -->
<div id="viewUserDetailsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewUserDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewUserDetailsModalLabel">User Details</h5>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view user details modal -->
<!-- View user status info modal -->
<div id="statusInfoModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="statusInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="statusInfoModalLabel">What do these statuses mean?</h5>
            </div>
            <div class="modal-body">
                <div id="reminder-container" class="alert alert-info mt-3" role="alert">
                    <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The requester should settle
                        the deficiency/ies to necessary office.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill bg-secondary">Cancelled</span> - The user has cancelled the request. No further actions must be taken.</small></p> 
                    <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The request is rejected
                        by the admin.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: orange;">For
                            receiving</span> - The request is currently in Receiving window and waiting for submission of
                        requirements.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: blue;">For
                            evaluation</span> - Evaluation and Processing of records and required documents for releasing.</small>
                    </p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: DodgerBlue;">Ready for
                            pickup</span> - The requested document/s is/are already available for pickup at the releasing section
                        of student records.</small></p>
                    <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Released</span> -
                        The requested document/s was/were claimed.</small></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view status info modal -->
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Rejected':
                return 'bg-danger';
            case 'For Evaluation':
                return 'bg-primary';
            default:
                return 'bg-dark';
        }
    }
// Function to populate the edit modal with the request details
function populateUserInfoModal(userId) {
        $.ajax({
            url: 'tables/accounting/get_user_details.php',
            method: 'POST',
            data: { user_id: userId },
            success: function(response) {
                var userDetails = JSON.parse(response);
                var modalTitle = document.getElementById('viewUserDetailsModalLabel');
                var modalBody = document.querySelector('#viewUserDetailsModal .modal-body');

                modalTitle.innerText = 'User details';

                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-6">
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Name</strong></p>
                                <p class="mx-2">${userDetails.last_name + ", " + userDetails.first_name + " " + userDetails.middle_name + " " + userDetails.extension_name}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Student/Guest</strong></p>
                                <p class="mx-2">${userDetails.user_role_id == 1 ? "Student" : "Guest"}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Student Number</strong></p>
                                <p class="mx-2">${userDetails.student_no}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Course</strong></p>
                                <p class="mx-2">${userDetails.course}</p>
                            </div>
                            <div class="m-0" style="display: ${userDetails.course == 'N/A' ? "none" : "block"};">
                                <p class="fs-5 m-0"><strong>Year and Section</strong></p>
                                <p class="mx-2">${userDetails.year_and_section == "" || null ? 'N/A' : userDetails.year_and_section}</p>
                            </div>
                            </div>
                        <div class="col-6">
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Sex</strong></p>
                                <p class="mx-2">${userDetails.sex == 1 ? "Male" : "Female"}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Email</strong></p>
                                <p class="mx-2">${userDetails.email}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Contact Number</strong></p>
                                <p class="mx-2">${userDetails.contact_no}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Birth Date</strong></p>
                                <p class="mx-2">${userDetails.formatted_birth_date}</p>
                            </div>
                            <div class="m-0">
                                <p class="fs-5 m-0"><strong>Address</strong></p>
                                <p class="mx-2 py-0 my-0">${userDetails.home_address}</p>
                                <p class="mx-2 py-0 my-0">${userDetails.barangay + ", " + userDetails.city}</p>
                                <p class="mx-2 py-0 my-0">${userDetails.province + (userDetails.zip_code ? ", " + userDetails.zip_code : "")}</p>
                            </div>
                        </div>
                    </div>
                `;

                $("#viewUserDetailsModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching request details.');
            }
        });
    }
    function handlePagination(page, searchTerm = '', column = 'offsetting_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'tables/accounting/fetch_offsettings.php',
            method: 'POST',
            data: { page: page, searchTerm: searchTerm, column: column, order: order },
            success: function(response) {
                // Hide the loading indicator
                loadingIndicator.style.display = 'none';

                // Show the table
                table.classList.remove('hidden');

                // Parse the JSON response
                var data = JSON.parse(response);

                // Update the table body with the received data
                var tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                if (data.total_records > 0) {
                    for (var i = 0; i < data.offsettings.length; i++) {
                        var offsettings = data.offsettings[i];

                        var row = '<tr>' +
                        '<td><input type="checkbox" name="request-checkbox" value="' + offsettings.offsetting_id + '"></td>' +
                            '<td>'+ offsettings.offsetting_id + '</td>' +
                            '<td>' + (new Date(offsettings.formatted_timestamp).toLocaleString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                            }))
                            + '</td>' +
                            '<td>' + offsettings.last_name + ", " + offsettings.first_name + " " + offsettings.middle_name + " " + offsettings.extension_name + '</td>' +
                            '<td>' + '₱' + offsettings.amountToOffset + '</td>' +
                            '<td>' + offsettings.offsetType + '</td>' +
                            '<td>' + '<span class="badge rounded-pill ' + getStatusBadgeClass(offsettings.status_name) + '">' + offsettings.status_name + '</span>' + '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }
                else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="8">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                        '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm + '\', \'offsetting_id\', \'desc\')">' + i + '</a>' +
                        '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }
            },
            error: function() {
                // Hide the loading indicator in case of an error
                loadingIndicator.style.display = 'none';

                // Handle the error appropriately
                console.log('Error occurred while fetching data.');
            }
        });
    }

    // Function to toggle the sort icons
    function toggleSortIcons(header) {
        var sortIcon = header.querySelector('.sort-icon');
        sortIcon.classList.toggle('fa-caret-down');
        sortIcon.classList.toggle('fa-caret-up');
    }

    // Add event listeners to sortable headers
    var sortableHeaders = document.querySelectorAll('.sortable-header');
    sortableHeaders.forEach(function (sortableHeader) {
        sortableHeader.addEventListener('click', function () {
            var column = sortableHeader.getAttribute('data-column');
            var order = sortableHeader.getAttribute('data-order');

            // Toggle the sort icons
            toggleSortIcons(sortableHeader);

            // Update the data-order attribute
            sortableHeader.setAttribute('data-order', order === 'asc' ? 'desc' : 'asc');

            // Call the pagination function with the updated sorting parameters
            handlePagination(1, '', column, order);
        });
    });

    // Initial pagination request (page 1)
    handlePagination(1, '', 'offsetting_id', 'desc');

    $(document).ready(function() {
        
        $('#search-input').on('input', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType() + filterStatus(), 'offsetting_id', 'desc');
        });

        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType() + filterStatus(), 'offsetting_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm +  filterDocType() + filterStatus(), 'offsetting_id', 'desc');
        });

        // Update status button listener
        $('#update-status-button').on('click', function() {
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var requestIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();
            var statusId = $('#update-status').val(); // Get the selected status ID

            $.ajax({
                url: 'tables/accounting/update_offsettings.php',
                method: 'POST',
                data: { requestIds: requestIds, statusId: statusId }, // Include the selected status ID in the data
                success: function(response) {
                    // Handle the success response
                    console.log('Status updated successfully');

                    resetCheckboxes();
                    // Refresh the table after status update
                    handlePagination(1, '', 'offsetting_id', 'desc');
                },
                error: function() {
                    // Handle the error response
                    console.log('Error occurred while updating status');

                    resetCheckboxes();
                }
            });
        });

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="request-checkbox"]', handleCheckboxChange);

        $('#status-info-btn').on('click', function() {
            $('#statusInfoModal').modal('show');
        });
    });

    function handleCheckboxChange() {
        var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
        var updateButton = $('#update-status-button');
        var statusDropdown = $('#update-status');

        if (checkedCheckboxes.length > 0) {
            updateButton.prop('disabled', false);
            statusDropdown.prop('disabled', false);
        } else {
            updateButton.prop('disabled', true);
            statusDropdown.prop('disabled', true);
        }
    }

    // Perform search functionality when either the Filter or Search button is pressed
    function filterDocType() {
        var filterByDocTypeVal = $('#filterByDocType').val();
        
        switch (filterByDocTypeVal) {
            case 'Miscellaneous Fee':
                return 'Miscellaneous Fee';
                break;
            case 'Tuition Fee':
                return 'Tuition Fee';
                break;
            default:
                return '';
        }
    }
    function filterStatus() {
        var filterByStatusVal = $('#filterByStatus').val();
        
        switch (filterByStatusVal) {
            case '1':
                return 'Pending';
                break;
            case '3':
                return 'For Evaluation';
                break;
            case '6':
                return 'Rejected';
                break;
            case '7':
                return 'Approved';
                break;
            default:
                return '';
        }
    }
</script>
