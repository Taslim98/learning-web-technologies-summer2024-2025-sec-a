<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>

    <!-- Content -->
        <section id=dashboard class="section active">
            <!-- Dashboard -->
        <div id="dashboard" class="section active">
            <h2>Overview</h2>
            <div class="cards">
            <div class="card">
                <div class="card__title">Patients</div>
                <div class="card__value" id="statPatients">—</div>
            </div>
            <div class="card">
                <div class="card__title">Doctors</div>
                <div class="card__value" id="statDoctors">—</div>
            </div>
            <div class="card">
                <div class="card__title">Appointments Today</div>
                <div class="card__value" id="statAppointments">—</div>
            </div>
            <div class="card">
                <div class="card__title">Low Stock Items</div>
                <div class="card__value" id="statLowStock">—</div>
            </div>
            </div>

            <div class="panel">
            <div class="panel__header">
                <h3>Recent Activity</h3>
            </div>
            <ul id="activityFeed" class="list">
                <!-- injected by JS -->
            </ul>
            </div>
        </div>
            </section>

<?php include 'footer.php'?>
 