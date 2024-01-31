<?php
require_once('config.php');
session_start();

// Table Tasks
$queryOps = "SELECT * FROM opstable24 ORDER BY id";
$resultOps = mysqli_query($mysqli, $queryOps);
if ($resultOps) {
    while ($row = mysqli_fetch_assoc($resultOps)) {
        $recentOps[] = $row;
    }
}
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
        }

        .options {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .reset-filter {
            color: #3498db;
            cursor: pointer;
        }

        .reset-filter:hover {
            text-decoration: underline;
        }

        .daterangepicker {
            z-index: 9999 !important;
            position: absolute;
        }

        .daterangepicker:not(.opensleft) {
            left: 0 !important;
        }

        #table-container {
            overflow: auto;
            max-height: 500px;
            max-width: 90%;
            margin: 0 auto;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            white-space: nowrap;
            border-radius: 5px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            cursor: pointer;
            position: relative;
            user-select: none;
        }

        .resizer {
            width: 10px;
            height: 100%;
            position: absolute;
            top: 0;
            right: 0;
            background-color: transparent;
            cursor: col-resize;
        }

        .dropdown-container {
            position: relative;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 8px;
        }

        .dropdown-content label {
            display: block;
        }

        .dropdown-content input {
            margin-right: 5px;
        }

        .dropdown-container:hover .dropdown-content {
            display: block;
        }

        #search {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
    </style>
    <!-- Add the following link for vanilla-datetime-range-picker.js -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/vanilla-datetime-range-picker@1.0.0/build/css/datetime-range-picker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vanilla-datetime-range-picker@1.0.0/build/js/datetime-range-picker.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('table');
            const resizers = document.querySelectorAll('.resizer');

            let isResizing = false;
            let currentResizer;

            resizers.forEach(resizer => {
                resizer.addEventListener('mousedown', function (e) {
                    isResizing = true;
                    currentResizer = e.target;
                    document.addEventListener('mousemove', handleMouseMove);
                    document.addEventListener('mouseup', () => {
                        isResizing = false;
                        currentResizer = null;
                        document.removeEventListener('mousemove', handleMouseMove);
                    });
                });
            });

            function handleMouseMove(e) {
                if (isResizing) {
                    const col = currentResizer.parentElement;
                    const colIndex = Array.from(col.parentElement.children).indexOf(col);
                    const newWidth = e.pageX - col.getBoundingClientRect().left;
                    col.style.width = newWidth + 'px';

                    const cells = Array.from(table.querySelectorAll(`tr > *:nth-child(${colIndex + 1})`));
                    cells.forEach(cell => cell.style.width = newWidth + 'px');
                }
            }

            // JavaScript for filter dropdown functionality
            const filterDropdown = document.getElementById('filterDropdown');
            const tbody = document.querySelector('table tbody');
            const rows = Array.from(tbody.children);

            filterDropdown.addEventListener('change', function () {
                const colIndex = parseInt(this.value, 10);

                if (colIndex === -1) {
                    // Reset filter, show all rows
                    rows.forEach(row => row.style.display = '');
                } else {
                    const selectedColumn = document.querySelectorAll('thead th')[colIndex];

                    // Get unique values in the selected column
                    const uniqueValues = [...new Set(rows.map(row => row.children[colIndex].textContent.trim()))];

                    // Prompt user to select a value for filtering
                    const selectedValue = prompt(`Filter by ${selectedColumn.textContent}`, '');

                    // Filter rows based on the selected value
                    rows.forEach(row => {
                        const cellValue = row.children[colIndex].textContent.trim();
                        row.style.display = selectedValue === '' || cellValue.includes(selectedValue) ? '' : 'none';
                    });
                }
            });

            // JavaScript for "Show" dropdown functionality
            const showDropdown = document.querySelector('#showDropdown select');

            showDropdown.addEventListener('change', function () {
                const selectedValue = parseInt(this.value, 10);
                const tbody = document.querySelector('table tbody');
                const rows = Array.from(tbody.children);

                rows.forEach((row, index) => {
                    row.style.display = index < selectedValue ? '' : 'none';
                });
            });

            // JavaScript for search functionality
            const searchInput = document.getElementById('search');

            searchInput.addEventListener('input', function () {
                const searchTerm = this.value.toLowerCase();

                rows.forEach(row => {
                    const rowText = Array.from(row.children).map(cell => cell.textContent.trim().toLowerCase()).join(' ');
                    row.style.display = rowText.includes(searchTerm) ? '' : 'none';
                });
            });

            // JavaScript for resetting filters
            const resetFilter = document.querySelector('.reset-filter');

            resetFilter.addEventListener('click', function () {
                filterDropdown.value = -1;
                rows.forEach(row => row.style.display = '');
            });

            // Initialize date range picker
            const startDatePicker = new DateRangePicker(document.getElementById('startDate'), {
                format: 'YYYY-MM-DD',
                showTopbar: false,
            });
        });
    </script>
    <title>Resizable, Filterable, and Searchable Table</title>
</head>
<body>
    <div class="options">
        <input type="text" id="search" placeholder="Search...">
        <select id="filterDropdown">
            <option value="-1" selected disabled>Filter by Column</option>
            <?php foreach (array_keys($recentOps[0]) as $colIndex => $columnName) { ?>
                <option value="<?php echo $colIndex; ?>"><?php echo $columnName; ?></option>
            <?php } ?>
        </select>
        <label for="startDate">Start Date:</label>
        <input type="text" id="startDate" readonly>
        <select id="showDropdown">
            <option value="200">1-200 Results</option>
            <option value="500">1-500 Results</option>
            <option value="1000">1-1000 Results</option>
            <option value="all">All Results</option>
        </select>
        <div class="reset-filter">Reset Filters</div>
    </div>
    <div id="table-container">
        <table>
            <thead>
                <tr>
                                        <th sortable>id<div class="resizer"></div></th>
                    <th sortable>IO#<div class="resizer"></div></th>
                    <th sortable>Status<div class="resizer"></div></th>
                    <th sortable>CM<div class="resizer"></div></th>
                    <th sortable>BO / CE Ref<div class="resizer"></div></th>
                    <th sortable>Brand New<div class="resizer"></div></th>
                    <th sortable>Sub-Brand<div class="resizer"></div></th>
                    <th sortable>Brand + Sub Brand<div class="resizer"></div></th>
                    <th sortable>Business Model<div class="resizer"></div></th>
                    <th sortable>BM Code<div class="resizer"></div></th>
                    <th sortable>Industry<div class="resizer"></div></th>
                    <th sortable>Campaign Name<div class="resizer"></div></th>
                    <th sortable>Complete Campaign Name<div class="resizer"></div></th>
                    <th sortable>Platform<div class="resizer"></div></th>
                    <th sortable>Buy Type<div class="resizer"></div></th>
                    <th sortable>Objective<div class="resizer"></div></th>
                    <th sortable>Conversion Location<div class="resizer"></div></th>
                    <th sortable>Performance Goal<div class="resizer"></div></th>
                    <th sortable>When you get charged<div class="resizer"></div></th>
                    <th sortable>Budget Allocation<div class="resizer"></div></th>
                    <th sortable>Start Date<div class="resizer"></div></th>
                    <th sortable>End Date<div class="resizer"></div></th>
                    <th sortable>Budget<div class="resizer"></div></th>
                    <th sortable>FOREX<div class="resizer"></div></th>
                    <th sortable>Budget $<div class="resizer"></div></th>
                    <th sortable>Unit Cost<div class="resizer"></div></th>
                    <th sortable>KPI<div class="resizer"></div></th>
                    <th sortable>Margin/Fee<div class="resizer"></div></th>
                    <th sortable>BM Currency<div class="resizer"></div></th>
                    <th sortable>Media Budget<div class="resizer"></div></th>
                    <th sortable>Result<div class="resizer"></div></th>
                    <th sortable>Campaign ID<div class="resizer"></div></th>
                    <th sortable>Remarks<div class="resizer"></div></th>
                    <th sortable>IO #<div class="resizer"></div></th>
                    <?php foreach (array_keys($recentOps[0]) as $colIndex => $columnName) { ?>
                        <th class="dropdown-container">
                            <?php echo $columnName; ?>
                            <div class="resizer"></div>
                            <div class="dropdown-content">
                                <?php foreach (array_unique(array_column($recentOps, $columnName)) as $value) { ?>
                                    <label>
                                        <input type="checkbox" value="<?php echo $colIndex; ?>">
                                        <?php echo $value; ?>
                                    </label>
                                <?php } ?>
                            </div>
                        </th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentOps as $Ops) { ?>
                    <tr>
                        <td><?php echo $Ops['id']; ?></td>
                        <td><?php echo $Ops['IO']; ?></td>
                        <td><?php echo $Ops['Status']; ?></td>
                        <td><?php echo $Ops['CM']; ?></td>
                        <td><?php echo $Ops['BO / CE Ref']; ?></td>
                        <td><?php echo $Ops['Brand New']; ?></td>
                        <td><?php echo $Ops['Sub-Brand']; ?></td>
                        <td><?php echo $Ops['Brand + Sub Brand']; ?></td>
                        <td><?php echo $Ops['BM Code']; ?></td>
                        <td><?php echo $Ops['Industry']; ?></td>
                        <td><?php echo $Ops['Campaign Name']; ?></td>
                        <td><?php echo $Ops['Complete Campaign Name']; ?></td>
                        <td><?php echo $Ops['Platform']; ?></td>
                        <td><?php echo $Ops['Buy Type']; ?></td>
                        <td><?php echo $Ops['Objective']; ?></td>
                        <td><?php echo $Ops['Conversion Location']; ?></td>
                        <td><?php echo $Ops['Performance Goal']; ?></td>
                        <td><?php echo $Ops['When you get charged']; ?></td>
                        <td><?php echo $Ops['Budget Allocation']; ?></td>
                        <td><?php echo $Ops['Start Date']; ?></td>
                        <td><?php echo $Ops['End Date']; ?></td>
                        <td><?php echo $Ops['Budget']; ?></td>
                        <td><?php echo $Ops['FOREX']; ?></td>
                        <td><?php echo $Ops['Budget $']; ?></td>
                        <td><?php echo $Ops['Unit Cost']; ?></td>
                        <td><?php echo $Ops['KPI']; ?></td>
                        <td><?php echo $Ops['Margin/Fee']; ?></td>
                        <td><?php echo $Ops['BM Currency']; ?></td>
                        <td><?php echo $Ops['Media Budget']; ?></td>
                        <td><?php echo $Ops['Result']; ?></td>
                        <td><?php echo $Ops['Campaign ID']; ?></td>
                        <td><?php echo $Ops['Remarks']; ?></td>
                        <td><?php echo $Ops['IO #']; ?></td>
                        <?php foreach ($recentOps[0] as $columnName => $value) { ?>
                            <td><?php echo $Ops[$columnName]; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>

