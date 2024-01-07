<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center request-equipment-id-header sortable-header" data-column="request_id" scope="col" data-order="asc">
                    Request Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center request-equipment-name-header sortable-header" data-column="equipment_name" scope="col" data-order="asc">
                    Equipment Name
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center request-equipment-quantity-header sortable-header" data-column="quantity_equip" scope="col" data-order="asc">
                    Quantity
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <!-- <th class="text-center doc-request-schedule-header sortable-header" data-column="4" scope="col" data-order="asc">
                    Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th> -->
                <th class="text-center request-equipment-schedule-header sortable-header" data-column="datetime_schedule" scope="col" data-order="asc">
                    Schedule
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center request-equipment-status-header sortable-header" data-column="5" scope="status_name" data-order="asc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>,
                <th class="text-center request-equipment-attachment-header sortable-header" data-column="6" scope="slip_content" data-order="asc">
                    Attachment
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center" class="pe-none"></th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0">
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <button id="delete-button" class="btn btn-primary" disabled="disabled">Delete Transaction(s)</button>
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<div class="d-flex">
    <div id="reminder-container" class="alert alert-info mt-3" role="alert">
        <h4 class="alert-heading">
            <i class="fa-solid fa-circle-info"></i> Reminder
        </h4>
        <p class="mb-0">Always check your transaction status to follow instructions.</p>
        <p class="mb-0">You can delete or edit transactions during <span
            class="badge rounded-pill bg-dark">Pending</span> status.</p>
        <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The requester should settle
            the deficiency/ies to necessary office.</small></p>
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
        <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
    </div>
</div>
<!-- View edit modal -->
<div id="viewEditModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewEditModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewEditModalLabel">Edit request</h5>
            </div>
            <div class="modal-body">
                <!-- Please add edit fields here for the Request description (either Request Clearance or Request Good Moral Document) and Scheduled Date using Flatpickr. -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view edit modal -->
<!-- Reason Modal -->
<div id="reasonModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="reasonModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reasonModalLabel">Reason for Rejection</h5>
            </div>
            <div class="modal-body">
                <!-- Reason content will be populated here dynamically -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of Reason Modal -->

<!-- Modal for cancellation confirmation -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Cancel Request</h5>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to cancel this request?</p>
                <form id="createReasonForm">
                    <div class="mb-3">
                        <label for="cancellationReason" class="form-label">Reason for cancellation:</label>
                        <textarea class="form-control" id="cancellationReason" name="cancellationReason" rows="3" maxlength="255"></textarea>
                        <small id="cancellationReasonHelp" class="form-text text-muted">Maximum length: 255 characters.</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmCancelBtn">Confirm Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--End of Cancel Modal -->
<script src="../../node_modules/flatpickr/dist/flatpickr.min.js"></script>


<script>
   function getStatusBadgeClass(status) {
        switch (status) {
            case 'Released':
                return 'bg-success';
            case 'Rejected':
                return 'bg-danger';
            case 'For Receiving':
                return 'bg-warning text-dark';
            case 'For Evaluation':
                return 'bg-primary';
            case 'Ready for Pickup':
                return 'bg-info';
            case 'Cancelled':
                return 'bg-secondary';
            default:
                return 'bg-dark';
        }
    }

    function handleDeleteRequest(requestIds) {
        // Make an AJAX request to delete the document requests
        $.ajax({
            url: 'transaction_tables/delete_equipment.php',
            method: 'POST',
            data: { request_id: requestIds },
            success: function(response) {
                console.log(requestIds);
                console.log('Requests deleted successfully');
                
                // Refresh the table after deletion
                handlePagination(1, '');
            }
        });
    }

    function addDeleteButtonListeners() {
        var deleteButton = document.getElementById('delete-button');

        // Get all the checkboxes
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');

        // Function to update the delete button state based on checkbox selection and status_id value
        function updateDeleteButtonState() {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Check the status_id value of the selected rows
            var canDelete = Array.from(checkedCheckboxes).every(function (checkbox) {
                var row = checkbox.closest('tr');
                var statusCell = row.querySelector('.request-equipment-status-cell');
                var status = statusCell.textContent.trim();
                
                return status === 'Pending' || status === 'Rejected';
            });

            deleteButton.disabled = !canDelete || checkedCheckboxes.length === 0;
        }

        // Add event listeners to checkboxes
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        // Add event listener to delete button
        deleteButton.addEventListener('click', function () {
            var checkedCheckboxes = document.querySelectorAll('input[type="checkbox"]:checked');

            // Get the request ids of the checked rows
            var requestIds = Array.from(checkedCheckboxes).map(function (checkbox) {
                return checkbox.value;
            });

            if (confirm('Are you sure you want to delete the selected request(s)?')) {
                handleDeleteRequest(requestIds);
            }
        });

        // Update delete button state initially
        updateDeleteButtonState();
    }

    // Event listener for edit buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('edit-request')) {
            var editId = event.target.getAttribute('data-request-id');
            populateEditModal(editId);
        }
    });


   // Function to populate the edit modal with the request details
   function populateEditModal(editId) {
    $.ajax({
        url: 'transaction_tables/get_request_equipment.php',
        method: 'POST',
        data: { edit_id: editId },
        success: function(response) {
            var request = JSON.parse(response);
            var modalTitle = document.getElementById('viewEditModalLabel');
            var modalBody = document.querySelector('#viewEditModal .modal-body');

            modalTitle.innerText = 'Edit Request';

            modalBody.innerHTML = `
                <form id="editForm" action="" method="POST">
                    <div class="mb-3">
                        <label for="datetimeSched" class="form-label">Scheduled Date</label>
                        <input type="text" class="form-control" id="datetimeSched" name="datetimeSched" placeholder="--Select Date--" required>
                    </div>
                    <div class="mb-3">
                        <label for="timeSched" class="form-label">Scheduled Time</label>
                        <select class="form-select" id="timeSched" name="timeSched"  required>
                            <option value="">--Select--</option>
                            <option value="08:00:00" ${request.time === '08:00:00' ? 'selected' : ''}>8:00 AM</option>
                            <option value="08:30:00" ${request.time === '08:30:00' ? 'selected' : ''}>8:30 AM</option>
                            <option value="09:00:00" ${request.time === '09:00:00' ? 'selected' : ''}>9:00 AM</option>
                            <option value="09:30:00" ${request.time === '09:30:00' ? 'selected' : ''}>9:30 AM</option>
                            <option value="10:00:00" ${request.time === '10:00:00' ? 'selected' : ''}>10:00 AM</option>
                            <option value="10:30:00" ${request.time === '10:30:00' ? 'selected' : ''}>10:30 AM</option>
                            <option value="11:00:00" ${request.time === '11:00:00' ? 'selected' : ''}>11:00 AM</option>
                            <option value="11:30:00" ${request.time === '11:30:00' ? 'selected' : ''}>11:30 AM</option>
                            <option value="12:00:00" ${request.time === '12:00:00' ? 'selected' : ''}>12:00 PM</option>
                            <option value="12:30:00" ${request.time === '12:30:00' ? 'selected' : ''}>12:30 PM</option>
                            <option value="13:00:00" ${request.time === '13:00:00' ? 'selected' : ''}>1:00 PM</option>
                            <option value="13:30:00" ${request.time === '13:30:00' ? 'selected' : ''}>1:30 PM</option>
                            <option value="14:00:00" ${request.time === '14:00:00' ? 'selected' : ''}>2:00 PM</option>
                            <option value="14:30:00" ${request.time === '14:30:00' ? 'selected' : ''}>2:30 PM</option>
                            <option value="15:00:00" ${request.time === '15:00:00' ? 'selected' : ''}>3:00 PM</option>
                            <option value="15:30:00" ${request.time === '15:30:00' ? 'selected' : ''}>3:30 PM</option>
                            <option value="16:00:00" ${request.time === '16:00:00' ? 'selected' : ''}>4:00 PM</option>
                            <option value="16:30:00" ${request.time === '16:30:00' ? 'selected' : ''}>4:30 PM</option>
                            <option value="17:00:00" ${request.time === '17:00:00' ? 'selected' : ''}>5:00 PM</option>
                            <option value="17:30:00" ${request.time === '17:30:00' ? 'selected' : ''}>5:30 PM</option>
                            <option value="18:00:00" ${request.time === '18:00:00' ? 'selected' : ''}>6:00 PM</option>
                            <option value="18:30:00" ${request.time === '18:30:00' ? 'selected' : ''}>6:30 PM</option>
                            <option value="19:00:00" ${request.time === '19:00:00' ? 'selected' : ''}>7:00 PM</option>
                            <option value="19:30:00" ${request.time === '19:30:00' ? 'selected' : ''}>7:30 PM</option>
                            <option value="20:00:00" ${request.time === '20:00:00' ? 'selected' : ''}>8:00 PM</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            `;

            flatpickr('#datetimeSched', {
                readonly: false,
                allowInput: true,
                dateFormat: "Y-m-d",
                theme: "custom-datepicker",
                minDate: "today",
                maxDate: "31.12.2033",
                disable: [
                    function(date) {
                        // Disable date on Sundays
                        return (date.getDay() === 0);
                    }
                ],
                locale: {
                    "firstDayOfWeek": 1 // start week on Monday
                },
                onChange: function(selectedDates, dateStr, instance) {
                    var currentDate = new Date();
                    var selectedDate = selectedDates[0];
                    var timeSelect = document.getElementById("timeSched");
                    
                    if (selectedDate.toDateString() === currentDate.toDateString()) {
                        // Reset the selected time value when the date is changed to today
                        timeSelect.value = '';
                        
                        // Enable all options in the time select for today's date
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }
                        
                        // Disable past times in the time select based on the current time
                        var currentHour = currentDate.getHours();
                        var currentMinute = currentDate.getMinutes();
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            var timeValue = timeSelect.options[i].value.split(":");
                            var optionHour = parseInt(timeValue[0]);
                            var optionMinute = parseInt(timeValue[1]);
                            if (optionHour < currentHour || (optionHour === currentHour && optionMinute <= currentMinute)) {
                                timeSelect.options[i].disabled = true;
                            }
                        }
                    } else {
                        // Enable all options in the time select for other dates
                        for (var i = 0; i < timeSelect.options.length; i++) {
                            timeSelect.options[i].disabled = false;
                        }
                    }
                }
            });

            var editForm = document.getElementById('editForm');
            editForm.addEventListener('submit', function(event) {
                event.preventDefault();
                updateRequest(editId);
            });

            $("#viewEditModal").modal("show");
        },
        error: function() {
            console.log('Error occurred while fetching request details.');
        }
    });
}





    // Function to update the request using AJAX
    function updateRequest(editId) {
        var form = document.getElementById('editForm');
        var formData = new FormData(form);

        formData.append('edit_id', editId);

        $.ajax({
            url: 'transaction_tables/update_request_equipment.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                $("#viewEditModal").modal("hide");
                handlePagination(1, '');
                form.reset();
            },
            error: function() {
                console.log('Error occurred while updating request.');
            }
        });
    }

    // Event listener for view reason buttons
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('view-reason')) {
            var requestId = event.target.getAttribute('data-request-id');
            populateReasonModal(requestId);
        }
    });


    // Function to populate the reason modal with the reason data
    function populateReasonModal(requestId) {
        $.ajax({
            url: 'transaction_tables/get_administrative_reason_equip.php', // Replace with the actual URL to fetch reason from the database
            method: 'POST',
            data: { request_id: requestId },
            success: function(response) {
                var reasonData = JSON.parse(response); // Parse the JSON response
                var reason = reasonData.admin_reason; // Extract the reason text
                console.log(reason);
                console.log('Reason Shows successfully');
                
                var modalTitle = document.getElementById('reasonModalLabel');
                var modalBody = document.querySelector('#reasonModal .modal-body');

                modalTitle.innerText = 'Reason for Rejection';

                if (reason !== null) {
                    modalBody.innerHTML = '<p style= "overflow-wrap: break-word;">' + reason + '</p>';
                } else {
                    modalBody.innerHTML = '<p>No reason provided yet.</p>';
                }

                $("#reasonModal").modal("show");
            },
            error: function() {
                console.log('Error occurred while fetching reason.');
            }
        });
    }



    function handlePagination(page, searchTerm = '', column = 'request_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the equipment requests
        $.ajax({
            url: 'transaction_tables/fetch_equipment_table.php',
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
                    for (var i = 0; i < data.request_equip.length; i++) {
                        var requestEquipment = data.request_equip[i];


                        var row = '<tr>' +
                            '<td><input type="checkbox" id="' + requestEquipment.request_id + '" name="' + requestEquipment.request_id + '" value="' + requestEquipment.request_id + '"></td>' +
                            '<td class="text-center">' + requestEquipment.request_id + '</td>' +
                            '<td class="text-center">' +  requestEquipment.equipment_name + '</td>' +
                            '<td class="text-center">' +  requestEquipment.quantity_equip + '</td>' +
                            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
                            '<td class="text-center">' + new Date(requestEquipment.datetime_schedule).toLocaleString('en-US', { 
                                month: 'long',
                                day: 'numeric',
                                year: 'numeric',
                                hour: 'numeric',
                                minute: 'numeric',
                                hour12: true
                                }) + '</td>' +
                            // '<td class="text-center">' +
                            // scheduleButton +
                            // '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill request-equipment-status-cell ' + getStatusBadgeClass(requestEquipment.status_name) + '">' + requestEquipment.status_name + '</span>' +
                            '</td>' +
                            '<td class="text-center"><a href="' + (requestEquipment.slip_content ? "../../../student/administrative/requisition-slip/" + requestEquipment.slip_content : "") + '" target="_blank">' + (requestEquipment.slip_content ? "View Slip" : "") + '</a></td>' + 
                            '<td class="text-center">';

                            if (requestEquipment.status_name === "Pending") {
                                row += '<div class="btn-container" style="display: flex;">';
                                
                                // Edit Button
                                row += '<div style="flex: 1;">';
                                row += '<button href="#" class="btn btn-primary btn-sm edit-request" data-request-id="' + requestEquipment.request_id + '"><i class="fa-solid fa-pen-to-square"></i> Edit </button>';
                                row += '</div>';
                                
                                // Cancel Button
                                row += '<div style="flex: 1; margin-left: 5px;">';
                                row += '<button class="btn btn-primary btn-sm cancel-request" data-request-id="' + requestEquipment.request_id + '"><i class="fa-solid fa-times"></i> Cancel </button>';
                                row += '</div>';
                                
                                row += '</div>';
                            } else if(requestEquipment.status_name === "Rejected") {
                                row += '<a href="#" class="btn btn-primary btn-sm view-reason pe-auto" data-status="' + requestEquipment.status_name + '" data-request-id="' +  requestEquipment.request_id + '"><i class="fa-solid fa-eye"></i> Reason </a>';
                            }
                            


                            
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }  else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="7">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }
                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                            '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ')">' + i + '</a>' +
                            '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }
                // Add event listeners for delete buttons
                addDeleteButtonListeners();
                // Add event listeners for edit buttons
                updateEditButtonStatus();

                //Checks for request status and hides cancelled button
                updateCancelButtonStatus();


            }
        });
    }

    function updateEditButtonStatus() {
        var editButtons = document.querySelectorAll('.edit-request');

        editButtons.forEach(function (button) {
            var row = button.closest('tr');
            var statusCell = row.querySelector('.request-equipment-status-cell');
            var status = statusCell.textContent.trim();

            // Disable the Edit button if the status is "Rejected"
            if (
            status === 'For Receiving' ||
            status === 'For Evaluation' ||
            status === 'Ready for Pickup' ||
            status === 'Released' ||
            status === 'Rejected' ||
            status === 'Approved' ||
            status === 'Cancelled'
        ) {
            button.disabled = true;
        } else {
            button.disabled = false;
        }
        });
    }

    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('edit-request') && !event.target.disabled) {
            var editId = event.target.getAttribute('data-request-id');
            populateEditModal(editId);
        }
    });

    

    

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

    //Event Listener for Cancel Button
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('cancel-request')) {
            var requestId = event.target.getAttribute('data-request-id');
            openCancelModal(requestId);
        }
    });

    function openCancelModal(requestId) {
        // Set the request ID in the modal data attribute
        $('#cancelModal').data('request-id', requestId);
        // Open the modal
        $('#cancelModal').modal('show');
    }
    
    // Event Listener for Confirm Cancel Button
    document.getElementById('confirmCancelBtn').addEventListener('click', cancelRequest);


    //Function for Cancel button
    function cancelRequest() {
        console.log('cancelRequest function called');
    var requestId = $('#cancelModal').data('request-id');
    var cancellationReason = $('#cancellationReason').val();

    // Make an AJAX request to cancel the equipment request
    $.ajax({
        url: 'transaction_tables/cancel_equipment.php',
        method: 'POST',
        data: { request_id: requestId, reason: cancellationReason },
        success: function(response) {
            console.log('Request canceled successfully');
            // Close the modal
            $('#cancelModal').modal('hide');
            handlePagination(1, '');
        },
        error: function(error) {
            console.error('Error canceling request:', error.responseText);
        }
    });
}

    // //Disables Cancel Button for certain statuses
    // function updateCancelButtonStatus() {
    // var cancelButtons = document.querySelectorAll('.cancel-request');

    // cancelButtons.forEach(function (button) {
    //     var row = button.closest('tr');
    //     var statusCell = row.querySelector('.request-equipment-status-cell');
    //     var status = statusCell.textContent.trim();

    //     // Disable the Cancel button based on specific statuses
    //     if (
    //         status === 'For Receiving' ||
    //         status === 'For Evaluation' ||
    //         status === 'Ready for Pickup' ||
    //         status === 'Released' ||
    //         status === 'Rejected' ||
    //         status === 'Approved' ||
    //         status === 'Cancelled'
    //     ) {
    //         button.disabled = true;
    //     } else {
    //         button.disabled = false;
    //     }
    // });
    // }




    // Initial pagination request (page 1)
    handlePagination(1, '', 'request_id', 'desc');

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'request_id', 'desc');
        });
    });
    
</script>
