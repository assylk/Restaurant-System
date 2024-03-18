<?php
require_once 'config.php';

// Start the session
session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400&family=Montserrat:wght@300;400;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    @keyframes backgroundFade {
        0% {
            background-color: #6d4c41;
        }

        /* Brown */
        25% {
            background-color: #d7ccc8;
        }

        /* Light Brown */
        50% {
            background-color: #a1887f;
        }

        /* Darker Brown */
        75% {
            background-color: #d7ccc8;
        }

        /* Light Brown */
        100% {
            background-color: #6d4c41;
        }

        /* Brown */
    }

    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        animation: backgroundFade 20s infinite;
        color: whitesmoke;
    }

    .reservation-box {
        background-color: rgba(255, 255, 255, 0.9);
        padding: 20px 40px;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.6);
        max-width: 800px;
        width: 90%;
        animation: fadeIn 1s ease-in-out;
        position: relative;
        overflow: hidden;
    }

    @keyframes fadeIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }

        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .row {
        display: flex;
        justify-content: space-between;
        margin: 0 -15px;
    }

    .column {
        flex: 1;
        padding: 20px;
        margin-top: 10px;
        transition: background-color 0.3s, transform 0.3s;
        background-color: #fff;
        border-radius: 10px;
        cursor: pointer;
    }

    .column.right-column {
        margin-left: 20px;
    }

    .column h3 {
        font-weight: bold;
        margin-bottom: 15px;
        color: #003d5b;
    }

    .btn {
        background-color: #003d5b;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #002855;
    }

    /* Hover effects */
    .column:hover {
        background-color: #f2f2f2;
        transform: scale(1.05);
    }

    .btn:hover {
        background-color: #002855;
    }

    .column {
        /* [Existing styles] */
        /* Guarding the .column class */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .column:hover {
        transform: translateY(-10px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
    }

    h2 {
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: color 0.3s ease;
    }

    .column:hover h2 {
        color: #d35400;
        /* Change color on hover */
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        transition: color 0.3s;
    }

    .column:hover .form-group label {
        color: #003d5b;
    }

    .btn {
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #d35400;
        transform: translateY(-2px);
    }

    .form-control {
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #d35400;
        box-shadow: 0 0 0 0.2rem rgba(211, 84, 0, 0.25);
    }

    /* ... [Any other styles you may want to add] ... */
    </style>
    <title>Customer Reservation </title>

</head>
<body>
    <div class="reservation-box">
        <?php
        $reservationStatus = $_GET['reservation'] ?? null;
        $message = '';
        if ($reservationStatus === 'success') {
            $message = "Reservation successful";
            $reservation_id = $_GET['reservation_id'] ?? null;
            echo '<a class="nav-link" href="../home/home.php#hero">' .
            '<h1 class="text-center" style="font-family: Copperplate; color: BLACK;">JOHNNY\'S</h1>' .
            '<span class="sr-only"></span></a>';
            echo '<script>alert("Table Successfully Reserved. Click OK to view your reservation receipt."); window.location.href = "reservationReceipt.php?reservation_id=' . $reservation_id . '";</script>';

        }
        $head_count = $_GET['head_count'] ?? 1;
    ?>
        <a class="nav-link" href="../home/home.php#hero">
            <h1 class="text-center" style="font-family: Copperplate; color: BLACK;">JOHNNY'S RESERVATION</h1>
        </a>
        <div class="row">
            <div class="column">
                <div id="Search Table">
                    <h2 style=" color:black;">Search for Time</h2>

                    <form id="reservation-form" method="GET" action="availability.php"><br>
                        <div class="form-group">
                            <label for="reservation_date" style="color:black">Select Date</label><br>
                            <input class="form-control" type="date" id="reservation_date" name="reservation_date"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="reservation_time" style="color:black">Available Reservation Times</label>
                            <div id="availability-table">
                                <?php
                            $availableTimes = array();
                            for ($hour = 10; $hour <= 20; $hour++) {
                                for ($minute = 0; $minute < 60; $minute += 60) {
                                    $time = sprintf('%02d:%02d:00', $hour, $minute);
                                    $availableTimes[] = $time;
                                }
                            }
                            echo '<select name="reservation_time" id="reservation_time" style="width:10em;" class="form-control" >';
                            echo '<option value="" selected disabled>Select a Time</option>';
                            foreach ($availableTimes as $time) {
                                echo "<option  value='$time'>$time</option>";
                            }
                            echo '</select>';
                            if (isset($_GET['message'])) {
                                $message = $_GET['message'];
                                echo "<p>$message</p>";
                            }
                            ?>
                            </div>
                        </div>

                        <input type="number" id="head_count" name="head_count" value=1 hidden required>
                        <button type="submit" style="background-color: black; color: rgb(234, 234, 234); " class="btn"
                            name="submit">Search</button>
                    </form>
                </div>
            </div>
            <div class="column right-column">
                <div id="insert-reservation-into-table">
                    <h2 style=" color:black;">Make Reservation</h2>
                    <form id="reservation-form" method="POST" action="insertReservation.php">
                        <br>
                        <div class="form-group">
                            <label for="customer_name" style=" color:black;">Customer Name</label><br>
                            <input class="form-control" type="text" id="customer_name" name="customer_name" required>
                        </div>
                        <?php
                        $defaultReservationDate = $_GET['reservation_date'] ?? date("Y-m-d");
                        $defaultReservationTime = $_GET['reservation_time'] ?? "13:00:00";
                        ?>

                        <div class="form-group ">
                            <label for="reservation_date" style=" color:black;">Reservation Date</label><br>
                            <input type="date" id="reservation_date" name="reservation_date"
                                value="<?= $defaultReservationDate ?>" readonly required>
                            <input type="time" id="reservation_time" name="reservation_time"
                                value="<?= $defaultReservationTime ?>" readonly required>
                        </div>

                        <div class="form-group">
                            <label for="table_id_reserve" style=" color:black;">Available Tables</label>
                            <select class="form-control" name="table_id" id="table_id_reserve" style="width:10em;"
                                required>
                                <option value="" selected disabled>Select a Table</option>
                                <?php
                                $table_id_list = $_GET['reserved_table_id'];
                                $head_count = $_GET['head_count'] ?? 1;
                                $reserved_table_ids = explode(',', $table_id_list);
                                $select_query_tables = "SELECT * FROM restaurant_tables WHERE capacity >= '$head_count'";
                                if (!empty($reserved_table_ids)) {
                                    $reserved_table_ids_string = implode(',', $reserved_table_ids);
                                    $select_query_tables .= " AND table_id NOT IN ($reserved_table_ids_string)";
                                }
                                $result_tables = mysqli_query($link, $select_query_tables);
                                $resultCheckTables = mysqli_num_rows($result_tables);
                                if ($resultCheckTables > 0) {
                                    while ($row = mysqli_fetch_assoc($result_tables)) {
                                        echo '<option value="' . $row['table_id'] . '">For ' . $row['capacity'] . ' people. (Table Id: ' . $row['table_id'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>No tables available, please choose another time.</option>';
                                    echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
                                }
                                ?>
                            </select>
                            <input type="number" id="head_count" name="head_count" value="<?= $head_count ?>" required
                                hidden>
                        </div>

                        <div class="form-group mb-3">
                            <label for="special_request" style=" color:black;">Special request</label><br>
                            <textarea class="form-control" id="special_request" name="special_request"> </textarea><br>
                            <button type="submit" style="background-color: black; color: rgb(234, 234, 234); "
                                class="btn" type="submit" name="submit">Make Reservation</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    const viewDateInput = document.getElementById("reservation_date");
    const makeDateInput = document.getElementById("reservation_date");

    viewDateInput.addEventListener("change", function() {
        makeDateInput.value = this.value;
    });
    </script>
</body>

</html>