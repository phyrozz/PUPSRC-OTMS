<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center"></th>
                <th class="text-center">
                    Status
                </th>
            </tr>
        </thead>
        <tbody id="table-body">
            <!-- Table rows will be generated dynamically using JavaScript -->
        </tbody>
    </table>
</div>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case 'Verified':
                return 'bg-success';
            case 'Missing':
                return 'bg-danger';
            case 'Under Verification':
                return 'bg-warning text-dark';
            case 'Pending':
                return 'bg-dark';
            default:
                return 'bg-dark';
        }
    }

    // This function gives each office names on the Office column of the table links that will redirect them to their respective offices
    function generateUrlToTransactionsColumn(transactionName) {
        switch (transactionName) {
            case 'Subject Overload':
                return 'http://localhost/student/academic/subject_overload.php';
            case 'Grade Accreditation':
                return 'http://localhost/student/academic/grade_accreditation.php';
            case 'Cross-Enrollment':
                return 'http://localhost/student/academic/cross_enrollment.php';
            case 'Shifting':
                return 'http://localhost/student/academic/shifting.php';
            case 'Manual Enrollment':
                return 'http://localhost/student/academic/manual_enrollment.php';
        }
    }

    function handlePagination() {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the academic transactions
        $.ajax({
            url: 'transaction_tables/fetch_academic_transactions.php',
            method: 'POST',
            data: {},
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

                academicTransactionNames = ["Subject Overload", "Grade Accreditation", "Cross-Enrollment", "Shifting", "Manual Enrollment"];
                academicTransactionStatuses = ["subject_overload_status", "grade_accreditation_status", "cross_enrollment_status", "shifting_status", "manual_enrollment_status"];

                for (var i = 0; i < academicTransactionNames.length; i++) {
                    var academic = data.academic_transactions[0]; // Use index 0 to access the single object in the array

                    var row = '<tr>' +
                        '<td><a href="' + generateUrlToTransactionsColumn(academicTransactionNames[i]) + '">' + academicTransactionNames[i] + '</a></td>' +
                        '<td class="text-center">' +
                        '<span class="badge rounded-pill ' + getStatusBadgeClass(academic[academicTransactionStatuses[i]]) + '">' + academic[academicTransactionStatuses[i]] + '</span>' +
                        '</td>' +
                        '</tr>';
                    tableBody.innerHTML += row;

                    console.log(academic[academicTransactionStatuses[i]]);
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

    handlePagination();
</script>
