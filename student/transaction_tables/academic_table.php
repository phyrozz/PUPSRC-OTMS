<?php
    $academicTable = 'subject_overload';

    if (isset($_POST['filter-academic-button'])) {
        $academicTable = $_POST['academic-table-select'];
    }
?>
<div class="d-md-flex w-100 justify-content-start pb-2 mx-2">
    <div class="d-flex">
        <div class="input-group">
            <label class="input-group-text" for="table-select">Service:</label>
            <select id="academicTableSelect" class="form-select" name="academic-table-select">
                <option value="subject_overload" <?php if ($academicTable === 'subject_overload') echo 'selected'; ?>>Subject Overload</option>
                <option value="grade_accreditation" <?php if ($academicTable === 'grade_accreditation') echo 'selected'; ?>>Grade Accreditation</option>
                <option value="cross_enrollment" <?php if ($academicTable === 'cross_enrollment') echo 'selected'; ?>>Cross-Enrollment</option>
                <option value="shifting" <?php if ($academicTable === 'shifting') echo 'selected'; ?>>Shifting</option>
                <option value="manual_enrollment" <?php if ($academicTable === 'manual_enrollment') echo 'selected'; ?>>Manual Enrollment</option>
            </select>
            <button type="button" id="filter-academic-button" class="btn btn-primary"><i class="fa-solid fa-filter"></i> Select Service</button>
        </div>
    </div>
</div>
<div id="academic-table-container">

</div>
<div class="d-flex">
    <div id="reminder-container" class="alert alert-info mt-3" role="alert">
        <h4 class="alert-heading">
            <i class="fa-solid fa-circle-info"></i> Reminder
        </h4>
        <p class="mb-0">Always check your transaction status to follow instructions.</p>
        <p class="mb-0">You can delete or edit transactions during <span
            class="badge rounded-pill bg-light text-dark">Missing</span>, <span
            class="badge rounded-pill bg-secondary">Pending</span> and <span
            class="badge rounded-pill bg-danger">Rejected</span> status.</p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-light text-dark">Missing</span> - The requirement has not yet been submitted or attached.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-secondary">Pending</span> - The requirement is pending for review by the office.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-dark text-light">Under Verification</span> - The requirement has been checked by the office and is under review.</small>
            </p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-success">Approved</span> -
                The requirement has been approved.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-success">Verified</span> -
                The requirement has been verified by the office.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-danger">Rejected</span> - The request is rejected
            by the office.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-info text-dark">To Be Evaluated</span> - The requirement is pending evaluation from the office.</small></p>
            <p class="mb-0"><small><span class="badge rounded-pill bg-warning text-dark">Need F to F Evaluation</span> - The student must evaluate the requirement to the office.</small></p>
    </div>
</div>
<script>
    $(document).ready(function() {
        function loadTransactionTable() {
            var selectedTable = $('#academicTableSelect').val();
            // Send an AJAX request to load the corresponding academic table
            $.ajax({
                url: 'transaction_tables/academic/' + selectedTable + '.php',
                type: 'GET',
                dataType: 'html',
                success: function(data) {
                    $('#academic-table-container').html(data);
                },
                error: function(xhr, status, error) {
                    console.log('Error: ' + error);
                }
            });
        }

        // Load the transaction table when the page loads
        loadTransactionTable();

        $('#filter-academic-button').on('click', function(event) {
            loadTransactionTable();
        });

        $('#search-input').hide();
        $('#search-button').hide();
    });
</script>
