<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>
<!-- Content -->
        <section id=profile class="section active">
            <!-- Profile -->
        <div id="profile" class="section active">
            <div class="section__header">
            <h2>My Profile</h2>
            </div>
            <div class="panel">
            <div class="panel__content">
                <form id="profileForm" class="form" novalidate>
                <label>Full Name
                    <input id="pName" class="input" type="text" placeholder="Admin User">
                </label>
                <label>Email
                    <input id="pEmail" class="input" type="email" placeholder="admin@hospital.org">
                </label>
                <label>Phone
                    <input id="pPhone" class="input" type="tel" placeholder="+8801XXXXXXXXX">
                </label>
                <label>Department
                    <input id="pDept" class="input" type="text" placeholder="Administration">
                </label>
                <div class="row">
                    <button class="btn" type="submit">Save Profile</button>
                </div>
                <div id="profileErrors" class="errors"></div>
                </form>
            </div>
            </div>
        </div>
    </section>

<?php include 'footer.php'?>