<table id="transactions-table" class="table table-hover table-bordered">
    <thead>
        <tr>
            <th class="text-center doc-request-id-header" scope="col">Request Code</th>
            <th class="text-center doc-request-office-header sortable-header" data-column="1" scope="col">Office</th>
            <th class="text-center doc-request-description-header sortable-header" data-column="2" scope="col">Request</th>
            <th class="text-center doc-request-schedule-header sortable-header" data-column="3" scope="col">Schedule</th>
            <th class="text-center doc-request-amount-header" scope="col">Amount to pay</th>
            <th class="text-center doc-request-status-header sortable-header" data-column="5" scope="col">Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="table-body">
        <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
</table>

<div id="pagination" class="d-flex justify-content-center mt-4">
    <nav aria-label="Page navigation">
        <ul class="pagination" id="pagination-links">
            <!-- Pagination links will be generated dynamically using JavaScript -->
        </ul>
    </nav>
</div>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Approved':
                return 'bg-success';
            case 'Disapproved':
                return 'bg-danger';
            default:
                return 'bg-warning text-dark';
        }
    }
    
    // Add more cases here for other office document requests
    function getSchedulePageRedirect(request) {
        switch (request) {
            case "Request Good Moral Document":
                return "/student/guidance/doc_appointments/good_morals.php";
            case "Request Clearance":
                return "/student/guidance/doc_appointments/clearance.php";
            default:
                return "#";
        }
    }

    // Function to handle pagination using AJAX
    function handleDeleteRequest(requestId) {
        // Make an AJAX request to delete the document request
        $.ajax({
            url: 'transaction_tables/delete_document_request.php',
            method: 'POST',
            data: { request_id: requestId },
            success: function(response) {
                // Handle the response after deleting the request
                // For example, you can display a success message
                console.log('Request deleted successfully');

                // Refresh the table after deletion
                handlePagination(1);
            }
        });
    }

    function handlePagination(page, searchTerm = '') {
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/fetch_document_requests.php',
            method: 'POST',
            data: { page: page, searchTerm: searchTerm },
            success: function(response) {
                // Parse the JSON response
                var data = JSON.parse(response);

                // Update the table body with the received data
                var tableBody = document.getElementById('table-body');
                tableBody.innerHTML = '';

                if (data.total_records > 0) {
                    for (var i = 0; i < data.document_requests.length; i++) {
                        var request = data.document_requests[i];
                        var row = '<tr>' +
                            '<td>' + 'DR-' + request.request_id + '</td>' +
                            '<td>' + request.office_name + '</td>' +
                            '<td>' + request.request_description + '</td>' +
                            '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
                            '<td>' + '₱' + request.amount_to_pay + '</td>' +
                            '<td class="text-center">' +
                                '<span class="badge rounded-pill ' + getStatusBadgeClass(request.status_name) + '">' + request.status_name + '</span>' +
                            '</td>' +
                            '<td>' +
                                '<form method="POST" >' +
                                    '<a href="' + getSchedulePageRedirect(request.request_description) + '" class="btn btn-primary btn-sm"><i class="fa-brands fa-wpforms"></i></a>' +
                                    '<input type="hidden" name="request_id" value="' + request.request_id + '">' +
                                    (request.status_name === 'Pending' || request.status_name === 'Disapproved' ?
                                        '<button type="submit" name="delete_request" class="btn btn-primary btn-sm"><i class="fa-solid fa-trash-can"></i></button>' :
                                        '<button type="button" class="btn btn-sm" disabled><i class="fa-solid fa-trash-can"></i></button>') +
                                '</form>' +
                            '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                } else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="7">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                            '<a class="page-link' + (i === data.current_page ? ' btn-primary text-light' : ' text-dark btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ')">' + i + '</a>' +
                            '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }

                // Add event listeners for delete buttons
                var deleteButtons = document.getElementsByName('delete_request');
                deleteButtons.forEach(function(button) {
                    button.addEventListener('click', function(event) {
                        event.preventDefault();
                        if (confirm('Are you sure you want to delete this appointment?')) {
                            var requestId = this.previousSibling.value;
                            handleDeleteRequest(requestId);
                        }
                    });
                });
            }
        });
    }

    // Initial pagination request (page 1)
    handlePagination(1);

    $(document).ready(function() {
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm);
        });
    });
</script>
