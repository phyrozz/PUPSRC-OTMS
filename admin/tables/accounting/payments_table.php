<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center doc-request-id-header sortable-header" data-column="payment_id" scope="col" data-order="desc">
                    Payment Code
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-id-header sortable-header" data-column="transaction_date" scope="col" data-order="desc">
                    Date
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-requestor-header sortable-header" data-column="lastName" scope="col" data-order="desc">
                    Name
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-office-header sortable-header" data-column="course" scope="col" data-order="desc">
                Course/Role
                <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-student-or-client-header sortable-header" data-column="documentType" scope="col" data-order="desc">
                    Document Type
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <!--<th class="text-center doc-request-description-header sortable-header" data-column="referenceNumber" scope="col" data-order="desc">
                    Reference Number
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>-->
                <!--<th class="text-center doc-request-amount-header sortable-header" data-column="amount" scope="col" data-order="desc">
                    Amount
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>-->
                <th class="text-center doc-request-status-header sortable-header" data-column="status" scope="col" data-order="desc">
                    Status
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <!--<th class="text-center doc-request-status-header sortable-header" data-column="image_url" scope="col" data-order="desc">
                    Receipt
                </th>-->
                <th class="text-center"></th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0 d-flex justify-content-between w-100">
      
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
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
            default:
                return 'bg-dark';
        }
    }

    function handlePagination(page, searchTerm = '', column = 'payment_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'tables/accounting/fetch_payments.php',
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
                    for (var i = 0; i < data.payments.length; i++) {
                        var payments = data.payments[i];
                        var imageUrl = '';

                        // Check if the studentNumber is present
                        if (payments.studentNumber) {
                            // It is a student
                            imageUrl = '../../../student/accounting/' + payments.image_url;
                        } else {
                            // It is a client
                            imageUrl = '../../../client/accounting/' + payments.image_url;
                        }

                        // Define the options for the status dropdown
                        var statusOptions = '<option value="Pending" ' + (payments.status === 'Pending' ? 'selected' : '') + '>Pending</option>' +
                       '<option value="Processed" ' + (payments.status === 'Processed' ? 'selected' : '') + '>Processed</option>'+
                       '<option value="Rejected" ' + (payments.status === 'Rejected' ? 'selected' : '') + '>Rejected</option>';

                        var row = '<tr>' +
                            '<td>' + 'A0-' + payments.payment_id + '</td>' +
                            '<td>' + (new Date(payments.transaction_date).toLocaleString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                            }))
                            + '</td>' +
                            '<td>' + payments.lastName + ", " + payments.firstName + " " + payments.middleName + '</td>' +
                            '<td>' + payments.course + '</td>' +
                            '<td>' + payments.documentType + '</td>' +
                            //'<td>' + payments.referenceNumber + '</td>' +
                            //'<td>' + '₱' + payments.amount + '</td>' +
                            '<td>' +
                                    '<select class="form-select status-dropdown" onchange="updateStatus(this, ' + payments.payment_id + ')">' +
                                     statusOptions +
                                    '</select>' +
                            '</td>' +
                            '</tr>';
                            //'<td class="text-center"><a href="' + imageUrl + '" target="_blank" class="btn btn-sm btn-primary">See Image</a></td></tr>';
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
                        '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm + '\', \'payment_id\', \'desc\')">' + i + '</a>' +
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
    handlePagination(1, '', 'payment_id', 'desc');

    $(document).ready(function() {
        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'payment_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm + filterDocType(), 'payment_id', 'desc');
        });

        // Update status button listener
        $('#update-status-button').on('click', function() {
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var requestIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();
            var statusId = $('#update-status').val(); // Get the selected status ID

            $.ajax({
                url: 'tables/guidance/update_doc_requests.php',
                method: 'POST',
                data: { requestIds: requestIds, statusId: statusId }, // Include the selected status ID in the data
                success: function(response) {
                    // Handle the success response
                    console.log('Status updated successfully');

                    // Refresh the table after status update
                    handlePagination(1, '', 'request_id', 'desc');
                },
                error: function() {
                    // Handle the error response
                    console.log('Error occurred while updating status');
                }
            });
        });

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="request-checkbox"]', function() {
            var checkedCheckboxes = $('input[name="request-checkbox"]:checked');
            var updateButton = $('#update-status-button');
            var statusDropdown = $('#update-status');

            if (checkedCheckboxes.length > 0) {
                updateButton.prop('disabled', false);
                statusDropdown.prop('disabled', false);
            }
            else {
                updateButton.prop('disabled', true);
                statusDropdown.prop('disabled', true);
            }
        });
    });

    // Perform search functionality when either the Filter or Search button is pressed
    function filterDocType() {
        var filterByDocTypeVal = $('#filterByDocType').val();
        
        if (filterByDocTypeVal == 'all') {
            return '';
        }
        else {
            return " " + filterByDocTypeVal;
        }
    }

    function updateStatus(selectElement, paymentId) {
    var newStatus = selectElement.value;

    // Make an AJAX request to update the status in the database
    $.ajax({
        url: 'tables/accounting/update_status.php', // Replace with the actual URL to update the status in the database
        method: 'POST',
        data: { paymentId: paymentId, status: newStatus },
        success: function(response) {
            // Handle the success response
            console.log('Status updated successfully');
        },
        error: function() {
            // Handle the error response
            console.log('Error occurred while updating status');
        }
    });
}


</script>
