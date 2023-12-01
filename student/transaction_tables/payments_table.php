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
            <th class="text-center doc-request-office-header sortable-header" data-column="course" scope="col" data-order="desc">
                Course
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-description-header sortable-header" data-column="documentType" scope="col" data-order="desc">
                Document Type
                <i class="sort-icon fa-solid fa-caret-down"></i>
            </th>
            <th class="text-center doc-request-status-header" data-column="status" scope="col" data-order="desc">
                Status
            </th>
    
        </tr>
    </thead>
    <tbody id="table-body">
        <!-- Table rows will be generated dynamically using JavaScript -->
    </tbody>
</table>
<div id="pagination" class="container-fluid p-0">
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
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
        <p class="mb-0"><small><span class="badge rounded-pill bg-dark">Pending</span> - The payment is being processed by the office.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The request is rejected
            by the office.</small></p>
        <p class="mb-0"><small><span class="badge rounded-pill" style="background-color: green;">Processed</span> -
            The Accounting Office has processed your payment.</small></p>
        <!-- <p class="mb-0">You will find answers to the questions we get asked the most about requesting for academic documents through <a href="FAQ.php">FAQs</a>.</p> -->
    </div>
</div>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Processed':
                return 'bg-success';
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
            url: 'transaction_tables/fetch_payments.php',
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

                        var row = '<tr>' +
                            '<td>' + 'AP-' + payments.payment_id + '</td>' +
                            '<td>' + (new Date(payments.transaction_date).toLocaleString('en-US', {
                            month: 'long',
                            day: 'numeric',
                            year: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            hour12: true
                            }))
                            + '</td>' +
                            '<td>' + payments.course + '</td>' +
                            '<td>' + payments.documentType + '</td>' +
                            // '<td>' + (request.scheduled_datetime !== null ? (new Date(request.scheduled_datetime)).toLocaleString() : 'Not yet scheduled') + '</td>' +
                            //'<td>' + payments.referenceNumber + '</td>' +
                            // '<td class="text-center">' +
                            // scheduleButton +
                            // '</td>' +
                            //'<td>₱' + payments.amount + '</td>' +
                            '<td class="text-center">' +
                            '<span class="badge rounded-pill doc-request-status-cell ' + getStatusBadgeClass(payments.status) + '">' + payments.status + '</span>' +
                            '</td>' +
                            '</tr>';
                            //'<td class="text-center"><a href="accounting/' + payments.image_url + '" target="_blank" class="btn btn-sm btn-primary">See Image</a></td></tr>';
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
        $('#button-addon2').click(function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'payment_id', 'desc');
        });
    });
</script>
