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
<title>Admin - Homepage</title>
<link rel="website icon" type="png" href="image/Logo School.png">
<link rel="stylesheet" href="./css/home.css">
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
            <li><a href="notification.php"> Pending Notification </a></li>
            <li><a href="history.php"> History </a></li>
            <li><a href="event.php"> Venue </a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<div class="content">
  <div class="mainBanner">
      <!-- LEFTSIDE PROFILE INFO AND BANNER -->
      <div class="leftSide">
        <div class="user-info">
          <div>
            <span class="welcome-message" id="welcomeMessage"></span><br>
            <span class="current-date" id="currentDate"></span><br>
          </div>
        </div>
        <div class="gallery">
          <div class="scroll-gallery" id="scrollGallery">
            <!-- Images will be dynamically added here -->
          </div>
        </div>
        <div class="notification">
          <h2>Notification</h2>
          <div id="notify">
            <!-- Notifications will be dynamically added here -->
          </div>
        </div>
      </div>
      <!-- RIGHT SIDE HIGHLIGHTS -->
      <div class="rightSide">
        <div class="titleRightSide">
          <h1>Highlights</h1>
        </div>
        
        <!-- MIDTERM BUTTON -->
        <div class="midterm">
          <h4 onclick="openModal('midtermModal')">Semester Examination</h4>
        </div>

        <!-- HOLIDAYS BUTTON -->
        <div class="holidays">
          <h4 onclick="openModal('holidaysModal')">Holidays List</h4>
        </div>
        <!-- Modal for Semester Examination -->
        <div id="midtermModal" class="modal">
          <div class="modal-content">
            <span class="close" onclick="closeModal('midtermModal')">&times;</span>
            <h2>Semester Examination</h2>
            <table>
              <tr>
                <th>First Semester</th>
                <th>Second Semester</th>
              </tr>
              <tr>
                <td>Preliminary Examination (Sept 25-30 2023)</td>
                <td>Preliminary Examination (Feb 26 - March 2 2024)</td>
              </tr>
              <tr>
                <td>Midterm Examination (November 6-11 2023) </td>
                <td>Midterm Examination (April 5-8 & 11-13 2024)</td>
              </tr>
              <tr>
                <td>Finals Examination (Dec 11-16 2023)</td>
                <td>Finals Examination (May 13-18 2024) For 4th Year</td>
              </tr>
              <tr>
                <td></td>
                <td>Finals Examination (May 20-25 2024) For 1st-3rd Year</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- Modal for Holidays List -->
        <div id="holidaysModal" class="modal">
          <div class="modal-content">
            <span class="close" onclick="closeModal('holidaysModal')">&times;</span>
            <h2>Holidays List</h2>
            <table>
              <tr>
                <td>Ninoy Aquino Day (August 21 2023)</td>
                <td>National Heroes Day (August 28 2023)</td>
                <td>Worlds teacher Day (October 5 2023)</td>
              </tr>
              <tr>
                <td>All Saint's Day (November 1 2023)</td>
                <td>All Soul's Day (November 2 2023)</td>
                <td>Bonifacio Day (November 27 2023)</td>
              </tr>
              <tr>
                <td>Institutional Christmas Party (December 18-19 2023)</td>
                <td>Christmas Eve (December 25 2023)</td>
                <td>People's Power Anniversary (February 25 2024)</td>
              </tr>
              <tr>
                <td>Foundation Week (March 18-23 2024)</td>
                <td>Holy Week (March 28-30)</td>
                <td>Araw ng Kagitingan (April 9 2024)</td>
              </tr>
              <tr>
                <td>Eid'l Fitr (April 10 2024)</td>
                <td>Labor Day (May 1 2024)</td>
                <td>Independence Day (June 12 2024)</td>
              </tr>
            </table>
          </div>
        </div>
        <script>
          function openModal(modalId) {
            document.getElementById(modalId).style.display = "block";
          }

          function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
          }
        </script>
      </div>
 </div>
</div>
<script>
    const date = new Date();
    const month = date.getMonth();
    const day = date.getDate();
    const year = date.getFullYear();
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

  document.addEventListener("DOMContentLoaded", async function () {
      const today = `${months[month]} ${day}, ${year}`;
      
      const galleryImages = [
        "image/comlab2.png",
        "image/comlab3.png",
        "image/avr.png",
        "image/cra.png",
        "image/fgs.png",
        "image/gymnasium.png"
      ];

      const userData = {
        name: '<?php echo $_SESSION['username']; ?>',
        email: 'user@example.com' // Replace with dynamic email if available
      };

      document.getElementById("welcomeMessage").textContent = "Welcome, " + userData.name;
      document.getElementById("currentDate").textContent = today;

      function displayGallery() {
        const scrollGallery = document.getElementById("scrollGallery");
        scrollGallery.innerHTML = '';
        galleryImages.forEach(image => {
          const imgElement = document.createElement("img");
          imgElement.src = image;
          scrollGallery.appendChild(imgElement);
        });
      }

      displayGallery();

      let currentImageIndex = 0;
      setInterval(() => {
        currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
        const images = document.querySelectorAll('.scroll-gallery img');
        images.forEach((img, index) => {
          if (index === currentImageIndex) {
            img.style.display = 'block';
          } else {
            img.style.display = 'none';
          }
        });
      }, 3000);

      async function fetchNotifications() {
        try {
            const response = await fetch('fetch_notifications.php');
            const notifications = await response.json();

            const notifyElement = document.getElementById('notify');
            notifyElement.innerHTML = '';

            if (notifications.length > 0) {
                notifications.forEach(notification => {
                    const notificationDiv = document.createElement('div');
                    notificationDiv.classList.add('notification-item');
                    
                    if (notification.title) {
                        notificationDiv.textContent = `${notification.title} is pending.`;
                    } else if (notification.id) {
                        notificationDiv.textContent = `Cancellation request (ID: ${notification.id}) on ${notification.request_date}: ${notification.reason}`;
                    }
                    
                    notifyElement.appendChild(notificationDiv);
                });
            } else {
                notifyElement.textContent = 'No new notifications.';
            }
        } catch (error) {
            console.error('Error fetching notifications:', error);
            document.getElementById('notify').textContent = 'Error loading notifications.';
        }
    }

    fetchNotifications();
  });
</script>
</body>
</html>
