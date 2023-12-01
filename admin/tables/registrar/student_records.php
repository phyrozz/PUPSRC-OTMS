<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center sortable-header" data-column="name" scope="col" data-order="desc">
                    Name
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="course_name" scope="col" data-order="desc">
                    Course
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="year" scope="col" data-order="desc">
                    Year
                    <i class="sort-icon fa-solid fa-caret-down"></i>
                </th>
                <th class="text-center sortable-header" data-column="shelf_location" scope="col" data-order="desc">
                    Shelf Location
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
        <button id="add-button" class="btn btn-primary w-50"><i class="fa-solid fa-user-plus"></i> Add Student</button>
        <button id="delete-button" class="btn btn-primary w-50" disabled><i class="fa-solid fa-trash-can"></i> Delete</button>
    </div>    
    <nav aria-label="Page navigation">
        <div class="d-flex justify-content-between align-items-start gap-3">
            <ul class="pagination" id="pagination-links">
                <!-- Pagination links will be generated dynamically using JavaScript -->
            </ul>
        </div>
    </nav>
</div>
<!-- View add student modal -->
<div id="addStudentModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <form id="addStudentForm" action="tables/registrar/add_student_record.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStudentModalLabel">Add Student</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group col-12">
                        <label class="mb-0 pb-1">Student Name</label>
                        <div class="input-group mb-0 mt-0">
                            <input type="text" class="form-control" name="add-name" id="add-name" minlength="8" maxlength="1024" required>
                        </div>
                        <div id="nameValidationMessage" class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label class="mb-0 pb-1">Course</label>
                        <div class="input-group mb-0">
                            <select name="add-course" id="add-course" class="form-control form-select" required>
                                <option value="" disabled selected hidden>Select Course</option>
                                <option value="1">Bachelor of Science in Electronics Engineering</option>
                                <option value="2">Bachelor of Science in Business Administration Major in Human Resource Management</option>
                                <option value="3">Bachelor of Science in Business Administration Major in Marketing Management</option>
                                <option value="4">Bachelor in Secondary Education Major in English</option>
                                <option value="5">Bachelor in Secondary Education Major in Filipino</option>
                                <option value="6">Bachelor in Secondary Education Major in Mathematics</option>
                                <option value="7">Bachelor of Science in Industrial Engineering</option>
                                <option value="8">Bachelor of Science in Information Technology</option>
                                <option value="9">Bachelor of Science in Psychology</option>
                                <option value="10">Bachelor in Technology And Livelihood Education Major in Home Economics</option>
                                <option value="11">Bachelor of Science in Management Accounting</option>
                            </select>                                    
                        </div>
                    </div>
                    <div class="form-group col-12">
                        <label class="mb-0 pb-1">Year</label>
                        <div class="input-group mb-0 mt-0">
                            <input type="number" class="form-control" name="add-year" id="add-year" min="1901" max="9999" minlength="4" maxlength="4" required>
                        </div>
                        <div id="yearValidationMessage" class="text-danger"></div>
                    </div>
                    <div class="form-group col-12">
                        <label class="mb-0 pb-1">Shelf Location</label>
                        <div class="input-group mb-0 mt-0">
                            <input type="text" class="form-control" name="add-shelf-location" id="add-shelf-location" minlength="8" maxlength="255" required>
                        </div>
                        <div id="shelfValidationMessage" class="text-danger"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" id="add-student-btn" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of add student modal -->
<script>
    function handlePagination(page, searchTerm = '', column = 'name', order = 'desc') {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'tables/registrar/fetch_student_records.php',
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
                    for (var i = 0; i < data.students.length; i++) {
                        var student = data.students[i];

                        var row = '<tr>' +
                            '<td><input type="checkbox" name="delete-checkbox" value="' + student.student_record_id + '"></td>' +
                            '<td>' + student.name + '</td>' +
                            '<td>' + student.course_name + '</td>' +
                            '<td>' + student.year + '</td>' +
                            '<td>' + student.shelf_location + '</td>' +
                            '</tr>';
                        tableBody.innerHTML += row;
                    }
                }
                else {
                    var noRecordsRow = '<tr><td class="text-center table-light p-4" colspan="10">Student Record is empty.</td></tr>';
                    tableBody.innerHTML = noRecordsRow;
                }

                // Update the pagination links
                var paginationLinks = document.getElementById('pagination-links');
                paginationLinks.innerHTML = '';

                if (data.total_pages > 1) {
                    for (var i = 1; i <= data.total_pages; i++) {
                        var pageLink = '<li class="page-item">' +
                        '<a class="page-link ' + (i == data.current_page ? 'btn-primary text-light' : 'btn-outline-primary') + '" href="#" onclick="handlePagination(' + i + ', \'' + searchTerm + '\', \'name\', \'desc\')">' + i + '</a>' +
                        '</li>';
                        paginationLinks.innerHTML += pageLink;
                    }
                }

                $('.user-details-link').on('click', function(event) {
                    var userId = event.target.getAttribute('data-user-id');
                    populateUserInfoModal(userId);
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
    handlePagination(1, '', 'name', 'desc');

    $(document).ready(function() {
        $('#filterByStatusSection').hide();
        $('#filterByDocTypeSection').hide();
        $('#filterButton').hide();

        $('#search-input').on('input', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'name', 'desc');
        });

        $('#search-button').on('click', function() {
            var searchTerm = $('#search-input').val();
            handlePagination(1, searchTerm, 'name', 'desc');
        });

        $('#add-button').on('click', function() {
            $('#addStudentModal').modal('show');
        });

        // Add student AJAX
        $("#addStudentForm").submit(function(event) {
        event.preventDefault();

        // Serialize the form data
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "tables/registrar/add_student_record.php",
            data: formData,
            success: function(response) {
                console.log(response);
                location.reload();
            }
        });
    });

        // Update status button listener
        $('#delete-button').on('click', function() {
            var checkedCheckboxes = $('input[name="delete-checkbox"]:checked');
            var studentIds = checkedCheckboxes.map(function() {
                return $(this).val();
            }).get();

            $.ajax({
                url: 'tables/registrar/delete_student.php',
                method: 'POST',
                data: { student_record_ids: studentIds }, // Include the selected status ID in the data
                success: function(response) {
                    // Handle the success response

                    // Refresh the table after status update
                    handlePagination(1, '', 'name', 'desc');
                },
                error: function() {
                    // Handle the error response
                    console.log('Error occurred while deleting student(s).');
                }
            });
        });

        // Checkbox change listener using event delegation
        $(document).on('change', 'input[name="delete-checkbox"]', handleCheckboxChange);

        $('#status-info-btn').on('click', function() {
            $('#statusInfoModal').modal('show');
        });
    });

    function handleCheckboxChange() {
        var checkedCheckboxes = $('input[name="delete-checkbox"]:checked');
        var deleteButton = $('#delete-button');

        if (checkedCheckboxes.length > 0) {
            deleteButton.prop('disabled', false);
        } else {
            deleteButton.prop('disabled', true);
        }
    }
</script>
