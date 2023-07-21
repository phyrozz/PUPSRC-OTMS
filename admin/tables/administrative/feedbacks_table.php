<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center doc-request-id-header sortable-header" data-column="last_name" scope="col" data-order="desc">
                    Submitted by
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-id-header sortable-header" data-column="submitted_on" scope="col" data-order="desc">
                    Submitted on
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center doc-request-id-header sortable-header" data-column="email" scope="col" data-order="desc">
                    Email Address
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center">
                    Feedback
                </th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<div id="pagination" class="container-fluid p-0 d-flex justify-content-end w-100"> 
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<!-- View feedback text modal -->
<div id="viewFeedbackTextModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="viewFeedbackTextModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewFeedbackTextModalLabel">User Feedback</h5>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- End of view feedback text modal -->
<!-- View user details text modal -->
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
<script>
    // Function to populate the user details modal
    function populateUserInfoModal(userId) {
        $.ajax({
            url: 'tables/administrative/get_user_details.php',
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

    function populateFeedbackTextModal(feedbackText) {
        var modalTitle = document.getElementById('viewFeedbackTextModalLabel');
        var modalBody = document.querySelector('#viewFeedbackTextModal .modal-body');

        modalTitle.innerText = 'Feedback Text';

        modalBody.innerHTML = feedbackText;

        $("#viewFeedbackTextModal").modal("show");
    }

    function handlePagination(page, searchTerm = '', column = 'feedback_id', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'tables/administrative/fetch_feedbacks.php',
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
                    for (var i = 0; i < data.administrative_feedbacks.length; i++) {
                        var feedback = data.administrative_feedbacks[i];

                        var row = '<tr>' +
                            '<td><a href="#" class="user-details-link" data-user-id="' + feedback.user_id + '">' + feedback.last_name + ", " + feedback.first_name + " " + feedback.middle_name + " " + feedback.extension_name + '</a></td>' +
                            '<td>' + feedback.formatted_datetime + '</td>' +
                            '<td>' + feedback.email + '</td>' +
                            '<td class="text-truncate" style="word-wrap: break-word;min-width: 160px;max-width: 160px;"><a href="#" class="user-feedback-link">' + feedback.feedback_text + '</a></td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }
                else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="10">No Transactions</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                        '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm + '\', \'feedback_id\', \'desc\')">' + i + '</a>' +
                        '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }

                $('.user-details-link').on('click', function(event) {
                    var userId = event.target.getAttribute('data-user-id');
                    populateUserInfoModal(userId);
                });

                $('.user-feedback-link').on('click', function(event) {
                    var feedbackText = event.target.textContent;
                    populateFeedbackTextModal(feedbackText);
                });
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
    handlePagination(1, '', 'feedback_id', 'desc');

    $(document).ready(function() {
        $('#filterByStatusSection').hide();
        $('#filterByDocTypeSection').hide();
        $('#filterButton').hide();

        $('#search-input').on('input', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'feedback_id', 'desc');
        });

        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'feedback_id', 'desc');
        });

        $('#filterButton').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'feedback_id', 'desc');
        });
    });
</script>
