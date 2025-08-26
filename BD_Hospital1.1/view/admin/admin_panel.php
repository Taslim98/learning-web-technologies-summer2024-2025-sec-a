<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - bd hospital</title>
    <link rel="stylesheet" href="../../asset/css/admin.css">
    <script defer src="../../asset/js/admin.js"></script>
</head>
<body>
    <!-- Top Bar -->
    <header class="topbar">
        <div class="logo">bd hospital</div>
        <div class="user-info">
            <span id="welcomeText">Welcome, Admin</span>
            <button id="btnLogout" class="logout-btn">Logout</button>
        </div>
    </header>

    <!-- Sidebar -->
    <nav class="sidebar">
        <ul>
            <li><a href="#" data-section="dashboard" class="nav-link active">Dashboard</a></li>
            <li><a href="#" data-section="inventory" class="nav-link">Inventory Tracking</a></li>
            <li><a href="#" data-section="staff" class="nav-link">Staff Management</a></li>
            <li><a href="#" data-section="doctor" class="nav-link">Add Doctor</a></li>
            <li><a href="#" data-section="profile" class="nav-link">Profile Management</a></li>
            <li><a href="#" data-section="superadmin" class="nav-link">Super Admin</a></li>
            <li><a href="#" data-section="notifications" class="nav-link">Notifications</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main id="mainContent">
        <section id="dashboard" class="section active">
            <h2>Dashboard</h2>
            <p>Welcome to the bd hospital Admin Dashboard. Use the menu to manage different sections.</p>
        </section>

        <?php include 'inventory.php'; ?>
        <?php include 'staff.php'; ?>
        <?php include 'doctor.php'; ?>
        <?php include 'profile.php'; ?>
        <?php include 'super_admin.php'; ?>
        <?php include 'notifications.php'; ?>
    </main>
</body>
</html>
