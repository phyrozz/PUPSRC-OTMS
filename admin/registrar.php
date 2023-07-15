<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Registrar Office</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
  <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="./tables/registrar/style.css">
  <!-- Loading page -->
  <!-- The container is placed here in order to display the loading indicator first while the page is loading. -->
  <div id="loader" class="center">
    <div class="loading-spinner"></div>
    <p class="loading-text display-3 pt-3">Getting things ready...</p>
  </div>
  <script src="https://kit.fontawesome.com/fe96d845ef.js" crossorigin="anonymous"></script>
  <script src="../node_modules/jquery/dist/jquery.min.js"></script>
  <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link href="./tables/registrar/datatables.min.css" rel="stylesheet" />
  <script type='text/javascript' src="./tables/registrar/datatables.min.js"></script>
  <script type='text/javascript' src="./tables/registrar/moment.min.js"></script>
  <script type='text/javascript' src="./tables/registrar/datetime-moment.js"></script>
  <script type='text/javascript' src="./tables/registrar/natural.js"></script>
</head>

<body>
  <div class="wrapper">
    <?php
            include "navbar.php";

            // Avoid admin user from accessing other office pages
            if ($_SESSION['office_name'] != "Registrar Office") {
                header("Location: http://localhost/admin/redirect.php");
            }
        ?>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-xs-12">
          <div class="d-flex w-100 justify-content-between p-0">
            <div class="d-flex p-2">
              <select class="form-select" id="transaction-type">
                <option value="requests">Registrar's Document Requests</option>
                <!--    <option value="completed">Completed Document Requests</option> for history transaction option-->
                <option value="records">Student Records</option>
              </select>
            </div>
          </div>
          <table id="transactions-table" class="table table-hover table-bordered"></table>
        </div>
      </div>
      <!-- <div class="d-flex w-100 justify-content-between p-2">
        <button class="btn btn-primary px-4" onclick="window.history.go(-1); return false;">
          <i class="fa-solid fa-arrow-left"></i> Back</button>
      </div> -->

    </div>
    <div class="push"></div>
  </div>
  <?php include '../footer.php'; ?>
  <script>
  async function getData(url) {
    try {
      const response = await fetch(url);
      return response.json();
    } catch (err) {
      console.log(err);
    }
  }

  async function postData(url, data) {
    try {
      const response = await fetch(url, {
        method: "PATCH", // *GET, POST, PUT, DELETE, etc.
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data), // body data type must match "Content-Type" header
      });
      return response.json(); // parses JSON response into native JavaScript objects
    } catch (err) {
      console.log(err);
    }
  }

  // function for transaction table data
  async function showTransactionTableData() {
    try {
      const transactionData = await getData('http://localhost/admin/tables/registrar/transaction_data.php');
      let string = `<thead>
                      <tr>
                        <th class="text-center" scope="col">Request Code</th>
                        <th class="text-center" scope="col">Name</th>
                        <th class="text-center" scope="col">Scholar Status</th>
                        <th class="text-center" scope="col">Request Document</th>
                        <th class="text-center" scope="col">Schedule</th>
                        <th class="text-center" scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>`;
      for await (const data of transactionData) {
        string +=
          `<tr>
          <td>REG-${data["reg_id"]}</td>
          <td>${data["name"]}</td>
          <td>${data["scholar_status"]}</td>
          <td>${data["services"]}</td>
          <td>${data["schedule"]}</td>
          <td class="text-center">
            <select data-user-id="${data["user_id"]}" data-id="${data["reg_id"]}" class="form-select" id="status">
                <option data-status="${data["status_id"]}" selected disabled hidden>${data["status_name"]}</option>
                <option value="1" style="background-color: lime; color: rgb(0, 0, 0);">Pending</option>
                <option value="2" style="background-color: greenyellow; color: rgb(0, 0, 0)">For Receiving</option>
                <option value="3" style="background-color: orange; color: rgb(0, 0, 0);">For Evaluation</option>
                <option value="4" style="background-color: teal; color: rgb(255, 255, 255)">Ready for Pickup</option>
                <option value="5" style="background-color: green; color: rgb(255, 255, 255);">Released</option>
                <option value="6" style="background-color: red; color: rgb(255, 255, 255);">Rejected</option>
            </select>
          </td>
        </tr>`;
      }
      string += `</tbody>`
      return string;
    } catch (err) {
      return err;
    }
  }

  let hasEventListener = false;

  async function initializeRequests() {
    const dropdown = document.getElementById('transaction-type');
    const table = document.getElementById('transactions-table');
    const statusSelect = document.querySelectorAll('.form-select');

    function initiateStatusColor(element, text) {
      let bgColor = '';
      let color = '';
      switch (parseInt(text)) {
        case 1:
          bgColor = 'lime';
          color = 'rgb(0, 0, 0)';
          break;
        case 2:
          bgColor = 'greenyellow';
          color = 'rgb(0, 0, 0)';
          break;
        case 3:
          bgColor = 'orange';
          color = 'rgb(0, 0, 0)';
          break;
        case 4:
          bgColor = 'teal';
          color = 'rgb(255, 255, 255)';
          break;
        case 5:
          bgColor = 'green';
          color = 'rgb(255, 255, 255)';
          break;
        case 6:
          bgColor = 'red';;
          color = 'rgb(255, 255, 255)';
          break;
      }
      element.style.backgroundColor = bgColor;
      element.style.color = color;
    }

    function changeStatusColor(selectedElement) {
      text = selectedElement.value;
      initiateStatusColor(selectedElement, text);
      // const selectedOption = selectedElement.options[selectedElement.selectedIndex];
      // const backgroundColor = selectedOption.style.backgroundColor;
      // const color = selectedOption.style.color;
      // selectedElement.style.backgroundColor = backgroundColor;
      // selectedElement.style.color = color;
    }

    async function updateStatus(selectedElement) {
      const regId = parseInt(selectedElement.getAttribute('data-id'));
      const statusId = parseInt(selectedElement.options[selectedElement.selectedIndex].value);
      await postData('http://localhost/admin/tables/registrar/change_status.php', {
        regId,
        statusId
      });
    }

    async function handleStatusChange() {
      changeStatusColor(this); // Pass the element triggering the event to the function
      await updateStatus(this); // Change status of current request
      hasEventListener = true;
    }

    for (const status of statusSelect) {
      hasEventListener && status.removeEventListener('change', handleStatusChange);
      text = status.options[status.selectedIndex].getAttribute('data-status')
      initiateStatusColor(status, text);
      status.addEventListener('change', handleStatusChange);
    }

  }

  function createDataTable() {
    let dataTable = new DataTable('#transactions-table', {
      columnDefs: [{
          target: 0,
          type: 'natural',
        },
        {
          target: 4,
          type: 'datetime-moment',
        },
      ]
    });
  }


  window.addEventListener('DOMContentLoaded', async function() {
    const dropdown = document.getElementById('transaction-type');
    const table = document.getElementById('transactions-table');
    const defaultTable = await showTransactionTableData();

    table.innerHTML = defaultTable;

    await initializeRequests();
    createDataTable();

    dropdown.addEventListener('change', async function() {
      // Get the selected value
      const selectedValue = this.value;

      // Change the table based on the selected value
      if (selectedValue === 'requests') {
        // Show the document requests and schedules table
        await initializeRequests();
      } else if (selectedValue === 'records') {
        //   table.innerHTML = `
        //               <thead>
        //                   <tr>
        //                       <th class="text-center" scope="col">Student Number</th>
        //                       <th class="text-center" scope="col">Name</th>
        //                       <th class="text-center" scope="col">Program</th>
        //                       <th class="text-center" scope="col">Shelf Location</th>
        //                       <th class="text-center" scope="col">Scholar Status</th>
        //                       <th class="text-center" scope="col">Requirements Status</th>
        //                   </tr>
        //               </thead>
        //               <tbody>
        //                   <tr>

        //                   </tr>
        //               </tbody>
        //           `;
      }
    })
  })
  </script>
  <script src="../loading.js"></script>
</body>

</html>