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
                return 'bg-dark text-light';
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

                for (var i = 0; i < data.s_requirements.length; i++) {
                    var requirement = data.s_requirements[i];

                    var timestamp = requirement.transaction_id;
                    parsedTimestamp = parseInt(timestamp.substring(5));
                    var date = new Date(parsedTimestamp * 1000);
                    var formattedDate = date.toLocaleString();

                    var row = 
                    '<tr>' +
                        '<td>Request Letter</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td class="text-center"><span class="badge rounded-pill ' + getStatusBadgeClass(requirement.request_letter_status) + '">' + getStatusValue(requirement.request_letter_status) + '</span></td>' +
                        '<td class="text-center"><a href="' + (requirement.request_letter ? "../../../assets/uploads/user_uploads/" + requirement.request_letter : "") + '" target="_blank">' + (requirement.request_letter ? "View Attachment" : "") + '</a></td>' + '</tr>' +
                    '<tr>' +
                        '<td>Certified Copy of Grades (Soft Copy) - Picture of issued copy</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td class="text-center"><span class="badge rounded-pill ' + getStatusBadgeClass(requirement.first_ctc_status) + '">' + getStatusValue(requirement.first_ctc_status) + '</span></td>' +
                        '<td class="text-center"><a href="' + (requirement.first_ctc ? "../../../assets/uploads/user_uploads/" + requirement.first_ctc : "") + '" target="_blank">' + (requirement.first_ctc ? "View Attachment" : "") + '</a></td>' + '</tr>' +
                    '<tr>' +
                        '<td>Certified Copy of Grades (Soft Copy) - To be submitted at the Academic Office</td>' +
                        '<td>' + formattedDate + '</td>' +
                        '<td class="text-center"><span class="badge rounded-pill ' + getStatusBadgeClass(requirement.second_ctc_status) + '">' + getStatusValue(requirement.second_ctc_status) + '</span></td>' +
                        '<td class="text-center"><a href="' + (requirement.second_ctc ? "../../../assets/uploads/user_uploads/" + requirement.second_ctc : "") + '" target="_blank">' + (requirement.second_ctc ? "View Attachment" : "") + '</a></td>' +
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
