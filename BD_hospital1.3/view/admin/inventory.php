<?php include 'header.php'?>
    <!-- Sidebar -->
<?php include 'sidebar.php'?>
    <!-- Content -->
        <section id=inventory class="section active">
            <!-- Inventory -->
        <div id="inventory" class="section active">
            <div class="section__header">
            <h2>Inventory Tracking</h2>
            <div class="legend">
                <span class="pill ok">OK</span>
                <span class="pill warn">Low Stock</span>
                <span class="pill near">Near Expiry</span>
                <span class="pill danger">Expired</span>
            </div>
            </div>

            <div class="grid">
            <div class="panel">
                <div class="panel__header">
                <h3>Stock Dashboard</h3>
                <div class="row">
                    <input id="invSearch" class="input" type="text" placeholder="Search by name or SKU">
                    <button id="btnInvNew" class="btn">Add New Item</button>
                </div>
                </div>
                <div class="table-wrap">
                <table>
                    <thead>
                    <tr>
                        <th>Name</th><th>SKU</th><th>Category</th><th>Supplier</th>
                        <th>Qty</th><th>UoM</th><th>Batch</th><th>Expiry</th>
                        <th>Reorder</th><th>Alert</th><th>Actions</th>
                    </tr>
                    </thead>
                    <tbody id="invBody"><!-- rows --></tbody>
                </table>
                </div>
            </div>

            <div class="panel">
                <div class="panel__header">
                <h3 id="invFormTitle">Add Inventory Item</h3>
                </div>
                <form id="invForm" class="form" novalidate>
                <fieldset class="fieldset">
                    <legend>Item Details</legend>
                    <label>Item Name
                    <input id="fItemName" class="input" type="text" placeholder="Sterile Gauze Pads (4x4)">
                    </label>
                    <label>SKU / Code
                    <input id="fSku" class="input" type="text" placeholder="GAUZE-4X4-100">
                    </label>
                    <label>Category
                    <select id="fCategory" class="input">
                        <option value="">Select</option>
                        <option>Gloves</option>
                        <option>Medication</option>
                        <option>Syringes & Needles</option>
                        <option>Dressings</option>
                        <option>Disposables</option>
                        <option>Equipment</option>
                    </select>
                    </label>
                    <label>Supplier
                    <select id="fSupplier" class="input">
                        <option value="">Select</option>
                        <option>MedSupply Inc.</option>
                        <option>CarePlus Pharma</option>
                        <option>HealthLine Distributors</option>
                    </select>
                    </label>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Stock & Tracking</legend>
                    <div class="grid-2">
                    <label>Quantity on Hand
                        <input id="fQty" class="input" type="number" min="0" step="1" placeholder="150">
                    </label>
                    <label>Unit of Measurement
                        <select id="fUom" class="input">
                        <option value="">Select</option>
                        <option>Single Unit</option>
                        <option>Box (10)</option>
                        <option>Box (50)</option>
                        <option>Box (100)</option>
                        <option>Bottle</option>
                        <option>Vial</option>
                        </select>
                    </label>
                    </div>
                    <label>Batch Number
                    <input id="fBatch" class="input" type="text" placeholder="BATCH-2025-07">
                    </label>
                    <label>Expiration Date
                    <input id="fExpiry" class="input" type="date">
                    </label>
                </fieldset>

                <fieldset class="fieldset">
                    <legend>Alerts Configuration</legend>
                    <label>Reorder Level
                    <input id="fReorder" class="input" type="number" min="0" step="1" placeholder="50">
                    </label>
                    <small class="hint">
                    The system triggers a reorder alert when quantity falls to this number.
                    </small>
                </fieldset>

                <div id="invErrors" class="errors" aria-live="polite"></div>

                <div class="row">
                    <button class="btn" type="submit">Save</button>
                    <button id="btnInvCancel" class="btn ghost" type="button">Cancel</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </section>
<?php include 'footer.php'?>