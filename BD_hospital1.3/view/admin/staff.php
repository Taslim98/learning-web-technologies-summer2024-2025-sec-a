<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>
    <!-- Content -->
        <section id=staff class="section active">
            <!-- Staff -->
        <div id="staff" class="section active">
            <div class="section__header">
            <h2>Staff Management</h2>
            <div class="row">
                <input id="staffSearch" class="input" type="text" placeholder="Search staff by name or role">
                <button id="btnStaffNew" class="btn">Add Staff</button>
            </div>
            </div>

            <div class="grid">
            <div class="panel">
                <div class="panel__header"><h3>Staff List</h3></div>
                <div class="table-wrap">
                <table>
                    <thead>
                    <tr><th>ID</th><th>Name</th><th>Role</th><th>Shift</th><th>Actions</th></tr>
                    </thead>
                    <tbody id="staffBody"><!-- rows --></tbody>
                </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel__header"><h3 id="staffFormTitle">Add Staff</h3></div>
                <form id="staffForm" class="form" novalidate>
                <label>Full Name
                    <input id="sName" class="input" type="text" placeholder="Ayesha Khan">
                </label>
                <label>Role
                    <select id="sRole" class="input">
                    <option value="">Select</option>
                    <option>Nurse</option>
                    <option>Receptionist</option>
                    <option>Lab Technician</option>
                    <option>Pharmacist</option>
                    <option>Accountant</option>
                    <option>Cleaner</option>
                    </select>
                </label>
                <label>Shift
                    <select id="sShift" class="input">
                    <option value="">Select</option>
                    <option>Morning</option>
                    <option>Evening</option>
                    <option>Night</option>
                    </select>
                </label>

                <div id="staffErrors" class="errors"></div>

                <div class="row">
                    <button class="btn" type="submit">Save</button>
                    <button id="btnStaffCancel" class="btn ghost" type="button">Cancel</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </section>
<?php include 'footer.php'?>