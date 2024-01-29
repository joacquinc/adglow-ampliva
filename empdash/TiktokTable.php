<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    input {
      padding: 5px;
    }

    button {
      padding: 5px 10px;
    }
  </style>
</head>
<body>

  <label for="status">Status:</label>
  <select id="status">
    <option value="">Status</option>
    <option value="Pending">Pending</option>
    <option value="Completed">Completed</option>
    <option value="Cancelled">Cancelled</option>
  </select>

  <label for="startDate">Start Date:</label>
  <input type="date" id="startDate">

  <label for="endDate">End Date:</label>
  <input type="date" id="endDate">

  <button onclick="filterTable()">Filter</button>

  <table id="myTable">
    <thead>
      <tr>
        <th>Campaign ID</th>
        <th>Campaign Name</th>
        <th>Objective</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Status</th>
        <!-- Add more columns as needed -->
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>143</td>
        <td>Tiktok</td>
        <td>Market</td>        
        <td>2024-01-01</td>
        <td>2024-01-10</td>
        <td>Pending</td>
      </tr>
      <tr>
      <td>143</td>
        <td>Tiktok</td>
        <td>Market</td>        
        <td>2024-01-01</td>
        <td>2024-01-10</td>
        <td>Completed</td>
      </tr>
      <tr>
        <td>143</td>
        <td>Tiktok</td>
        <td>Market</td>        
        <td>2024-01-01</td>
        <td>2024-01-10</td>
        <td>Active</td>
      </tr>
      <!-- Add more rows as needed -->
    </tbody>
  </table>

  <script>
    function filterTable() {
      var statusFilter = document.getElementById("status").value;
      var startDateFilter = document.getElementById("startDate").value;
      var endDateFilter = document.getElementById("endDate").value;

      var table = document.getElementById("myTable");
      var rows = table.getElementsByTagName("tr");

      for (var i = 1; i < rows.length; i++) {
        var row = rows[i];
        var status = row.cells[0].innerHTML;
        var startDate = row.cells[1].innerHTML;
        var endDate = row.cells[2].innerHTML;

        if ((status.includes(statusFilter) || statusFilter === "")
          && (startDate >= startDateFilter || startDateFilter === "")
          && (endDate <= endDateFilter || endDateFilter === "")) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      }
    }
  </script>

</body>
</html>