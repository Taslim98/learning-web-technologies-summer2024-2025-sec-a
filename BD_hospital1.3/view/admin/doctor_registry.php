<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>

    <!-- Content -->
        <section id=doctor_registry class="section active">
            <!-- Doctor Registry (Local & National DB) -->
        <div id="doctor-registry" class="section active">
            <div class="section__header">
            <h2>Doctor Registry</h2>
            </div>

            <div class="grid">
            <div class="panel">
                <div class="panel__header">
                <h3>Search National DB (Simulated)</h3>
                <div class="row">
                    <input id="docSearch" class="input" type="text" placeholder="Search by name or specialty">
                    <button id="btnDocSearch" class="btn">Search</button>
                </div>
                </div>
                <div class="table-wrap">
                <table>
                    <thead>
                    <tr><th>License</th><th>Name</th><th>Specialty</th><th>Actions</th></tr>
                    </thead>
                    <tbody id="docSearchBody"><!-- rows --></tbody>
                </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel__header"><h3>Add to Local Registry</h3></div>
                <form id="docFormLocal" class="form" novalidate>
                <label>License No.
                    <input id="dLicense" class="input" type="text" placeholder="BD-12345">
                </label>
                <label>Doctor Name
                    <input id="dName" class="input" type="text" placeholder="Dr. Priya Sen">
                </label>
                <label>Specialty
                    <input id="dSpec" class="input" type="text" placeholder="Cardiology">
                </label>
                <div class="row">
                    <button class="btn" type="submit">Add Doctor</button>
                </div>
                <div id="docLocalErrors" class="errors"></div>
                </form>

                <div class="panel__header"><h3>Publish to National DB (Simulated)</h3></div>
                <form id="docFormNational" class="form" novalidate>
                <label>License No.
                    <input id="nLicense" class="input" type="text" placeholder="BD-67890">
                </label>
                <label>Doctor Name
                    <input id="nName" class="input" type="text" placeholder="Dr. Hasan">
                </label>
                <label>Specialty
                    <input id="nSpec" class="input" type="text" placeholder="Pediatrics">
                </label>
                <div class="row">
                    <button class="btn" type="submit">Publish</button>
                </div>
                <div id="docNationalErrors" class="errors"></div>
                </form>
            </div>
            </div>

            <div class="panel">
            <div class="panel__header"><h3>Local Doctors</h3></div>
            <div class="table-wrap">
                <table>
                <thead>
                    <tr><th>License</th><th>Name</th><th>Specialty</th><th>Actions</th></tr>
                </thead>
                <tbody id="docLocalBody"><!-- rows --></tbody>
                </table>
            </div>
            </div>
        </div>

        
            </section>

            
<?php include 'footer.php'?>