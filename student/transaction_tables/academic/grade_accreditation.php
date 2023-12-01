<div class="table-responsive">
    <table id="transactions-table" class="table table-hover hidden">
        <thead>
            <tr class="table-active">
                <th class="text-center">
                    Requirement
                </th>
                <th class="text-center">
                    Last Transaction Date
                </th>
                <th class="text-center">
                    Status
                </th>
                <th class="text-center">
                    Attachment
                </th>
            </tr>
        </thead>
        <tbody id="table-body"></tbody>
    </table>
</div>
<script>
    function getStatusBadgeClass(status) {
        switch (status) {
            case "1":
                return 'bg-light text-dark';
            case "2":
                return 'bg-secondary';
            case "3":
                return 'bg-dark text-ight';
            case "4":
                return 'bg-success';
            case "5":
                return 'bg-danger';
            case "6":
                return 'bg-info text-dark';
            case "7":
                return 'bg-warning text-dark';
            case "8":
                return 'bg-success';
        }
    }

    function getStatusValue(status) {
        switch (status) {
            case "1":
                return "Missing";
            case "2":
                return "Pending";
            case "3":
                return "Under Verification";
            case "4":
                return "Verified";
            case "5":  
                return "Rejected";
            case "6":
                return 'To Be Evaluated';
            case "7":
                return 'Need F to F Evaluation';
            case "8":
                return "Approved";
        }
    }

    function loadTable() {
        // Show the loading indicator
        var loadingIndicator = document.getElementById('loading-indicator');
        loadingIndicator.style.display = 'block';

        // Hide the table
        var table = document.getElementById('transactions-table');
        table.classList.add('hidden');
        
        // Make an AJAX request to fetch the document requests
        $.ajax({
            url: 'transaction_tables/academic/fetch_acad_services.php',
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

                for (var i = 0; i < data.ga_requirements.length; i++) {
                    var requirement = data.ga_requirements[i];

                    var timestamp = requirement.transaction_id;
                    parsedTimestamp = parseInt(timestamp.substring(6));
                    var date = new Date(parsedTimestamp * 1000);
                    var formattedDate = date.toLocaleString();

                    var row = 
                    '<tr>' +
                        '<td>Completion Form</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td class="text-center"><span class="badge rounded-pill ' + getStatusBadgeClass(requirement.completion_form_status) + '">' + getStatusValue(requirement.completion_form_status) + '</span></td>' +
                        '<td class="text-center"><a href="' + (requirement.completion_form ? "../../../assets/uploads/generated_pdf/" + requirement.completion_form : "") + '" target="_blank">' + (requirement.completion_form ? "View Attachment" : "") + '</a></td>' + '</tr>' +
                    '<tr>' +
                        '<td>Assessed Fee</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td class="text-center"><span class="badge rounded-pill ' + getStatusBadgeClass(requirement.assessed_fee_status) + '">' + getStatusValue(requirement.assessed_fee_status) + '</span></td>' +
                        '<td class="text-center"><a href="' + (requirement.assessed_fee ? "../../../assets/uploads/user_uploads/" + requirement.assessed_fee : "") + '" target="_blank">' + (requirement.assessed_fee ? "View Attachment" : "") + '</a></td>' + 
                    '</tr>';
                    tableBody.innerHTML += row;
                }
            },
            error: function() {
                // Hide the loading indicator in case of an error
                loadingIndicator.style.display = 'none';

                console.log('Error occurred while fetching data.');
            }
        });
    }

    loadTable();
</script>
<script src="../../../saved_settings.js"></script>
