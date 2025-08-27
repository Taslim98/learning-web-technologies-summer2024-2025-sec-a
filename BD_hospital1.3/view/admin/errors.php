<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>
    <!-- Content -->
        <section id=errors class="section active">
            <!-- Error Pages -->
        <div id="errors" class="section active">
            <div class="section__header">
            <h2>Error Pages</h2>
            </div>
            <div class="grid-3">
            <div class="error-card">
                <h3>403</h3>
                <p>Forbidden — You don’t have permission.</p>
                <button class="btn ghost" data-error="403">Preview</button>
            </div>
            <div class="error-card">
                <h3>404</h3>
                <p>Page not found — This route doesn’t exist.</p>
                <button class="btn ghost" data-error="404">Preview</button>
            </div>
            <div class="error-card">
                <h3>500</h3>
                <p>Server error — Something went wrong.</p>
                <button class="btn ghost" data-error="500">Preview</button>
            </div>
            </div>

            <dialog id="errorDialog">
            <div id="errorDialogBody" class="error-dialog"></div>
            <div class="row">
                <button id="btnCloseDialog" class="btn">Close</button>
            </div>
            </dialog>
        </div>
        </section>

<?php include 'footer.php'?>