<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Pending Events</title>
<link rel="website icon" type="png" href="image/Logo School.png">
<link rel="stylesheet" href="./css/notification.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
</head>
<body>
<div class="wrapper">
    <div id="sidebar">
        <div class="title"><a href="#"><img src="./image/Logo new 2.png" alt="Logo"></a></div>
        <ul class="list-items">
            <li><a href="homepage.php"> Home </a></li>
            <li><a href="dashboard.php"> Events </a></li>
            <li><a href="notification.php"> Pending Events </a></li>
            <li><a href="history.php"> History </a></li>
            <li><a href="event.php"> Report </a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="text-header">
            <h1>Pending Form</h1>
        </div>
        <div class="table">
            <table border="1">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Contact Person</th>
                        <th>Company Name</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Venue</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once('./connect/conn.php');

                    $sql = "SELECT * FROM `schedule_list` WHERE `status` = 'Pending'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $venue_labels = [
                            'Open Court' => 'Open Court',
                            'Avr' => 'AVR',
                            'Gym' => 'Gym',
                            'Convention' => 'Convention',
                            'Ampi-Theater' => 'Ampi-Theater'
                        ];
                        while ($row = $result->fetch_assoc()) {
                            $venue = isset($venue_labels[$row['venue']]) ? $venue_labels[$row['venue']] : $row['venue'];
                    ?>
                        <tr>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['fullname']; ?></td>
                            <td><?php echo $row['company_name']; ?></td>
                            <td><?php echo $row['start_datetime']; ?></td>
                            <td><?php echo $row['end_datetime']; ?></td>
                            <td><?php echo $venue; ?></td>
                            <td><?php echo $row['description']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <form action="process_booking.php" method='post'>
                                    <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                                    <input type='submit' name='accept' value='Accept' class='accept-button'>
                                </form>
                                <form action="delete.php" method='post'>
                                    <input type='hidden' name='id' value='<?php echo $row['id']; ?>'>
                                    <input type='submit' name='deny' value='Deny' class='deny-button'>
                                </form>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='9'>No pending forms</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- Cancellation Forms Table -->
        <div class="table-container2">
            <div class="table">
                <h2>Cancellation Forms</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Contact Person</th>
                            <th>Company Name</th>
                            <th>Start</th>
                            <th>End</th>
                            <th>Venue</th>
                            <th>Cancellation Reason</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_cancellation = "SELECT * FROM `cancellation_requests` WHERE `status` = 'Request'";
                        $result_cancellation = $conn->query($sql_cancellation);

                        if ($result_cancellation->num_rows > 0) {
                            while ($row_cancel = $result_cancellation->fetch_assoc()) {
                                $venue_cancel = isset($venue_labels[$row_cancel['venue']]) ? $venue_labels[$row_cancel['venue']] : $row_cancel['venue'];
                        ?>
                                <tr>
                                    <td><?php echo $row_cancel['title']; ?></td>
                                    <td><?php echo $row_cancel['fullname']; ?></td>
                                    <td><?php echo $row_cancel['company_name']; ?></td>
                                    <td><?php echo $row_cancel['start_datetime']; ?></td>
                                    <td><?php echo $row_cancel['end_datetime']; ?></td>
                                    <td><?php echo $venue_cancel; ?></td>
                                    <td><?php echo $row_cancel['reason']; ?></td>
                                    <td><?php echo $row_cancel['status'];?></td>
                                    <td>
                                        <form action="process_cancel.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row_cancel['id']; ?>">
                                            <input type="submit" name="accept" value="Accept" class="accept-button">
                                        </form>
                                        <form action="denied_cancel.php" method="post">
                                            <input type="hidden" name="id" value="<?php echo $row_cancel['id']; ?>">
                                            <input type="submit" name="deny" value="Deny" class="deny-button">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                        } else {
                            echo "<tr><td colspan='8'>No cancellation pending forms</td></tr>";
                        }

                        // Close connection
                        $conn->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
