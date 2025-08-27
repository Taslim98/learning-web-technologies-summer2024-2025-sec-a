<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>
    <!-- Content -->
        <section  id=roles class="section active">
            <!-- Roles & Access (Super Admin) -->
        <div id="roles" class="section active">
            <div class="section__header">
            <h2>Roles & Access</h2>
            </div>

            <div class="panel">
            <div class="panel__header"><h3>Assign Roles</h3></div>
            <div class="table-wrap">
                <table>
                <thead>
                    <tr><th>User ID</th><th>Name</th><th>Current Role</th><th>Set Role</th></tr>
                </thead>
                <tbody id="rolesBody"><!-- rows --></tbody>
                </table>
            </div>
            </div>
        </div>

    </section>
  
<?php include 'footer.php'?>