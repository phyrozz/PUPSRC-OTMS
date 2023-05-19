<!DOCTYPE html>
<html>
<head>
  <title>Requisition Slip</title>
  <link rel="icon" href="/assets/icon/pup-logo.png" type="image/x-icon">
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <style>
    /* Custom CSS styles */

    * {
      font-family: "Fira Sans";
      src: url("/assets/fonts/FiraSans/FiraSans-Regular.ttf") format("truetype");
    }

    @page {
      margin: 0 50px 0 50px;
    }
    body {
      font-family: "Fira Sans";
    }

    .header {
      margin-top: 60px;
      text-align: center;
    }

    .requisition-slip {
      background-color: #98BCDE; /* Customize the background color */
      color: #333; /* Customize the text color */
      font-weight: bold;
      text-align: center;
      padding: 10px;
    }

    .logo {
      width: 150px;
      height: auto;
    }

    .address {
      text-align: center;
    }

    .table {
      margin-top: 60px;
      margin-bottom: 100px;
      border: 2px solid #000;
      width: 100%;
    }

    .table  thead  th,
    .table  tbody td {
      text-align: center;
      border: 2px solid grey;
      width: 33.33%; /* Set equal width for each cell */
    }

    .signature {
      margin-top: 20px;
      text-align: center;
    }

    .bold-text {
      font-weight: bold;
    }

    .line {
      border-top: 1px solid black;
      width: 40%;
      margin: 0 auto;
    }
  </style>
</head>
<body>
  <div class="header">
    <h5>Polytechnic University of the Philippines</h5>
    <p>Sta. Rosa Campus</p>
  </div>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th colspan="3" class="requisition-slip">REQUISITION SLIP</th>
      </tr>
      <tr>
        <th>EQUIPMENT</th>
        <th>QUANTITY</th>
        <th>DATE</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Chairs</td>
        <td>1</td>
        <td>19-05-2023</td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </tbody>
  </table>

  <div class="line signature">
    <p class="bold-text">Signature Over Printed Name</p>
  </div>
</body>
</html>
