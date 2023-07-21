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
