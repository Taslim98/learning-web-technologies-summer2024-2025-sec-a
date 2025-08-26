<section id="inventory" class="section">
    <h2>Inventory Tracking</h2>
    <form id="inventoryForm" class="form-box">
        <label>Item Name <input type="text" id="itemName" placeholder="Enter item name"></label>
        <label>Quantity <input type="number" id="itemQty" placeholder="Enter quantity"></label>
        <label>Reorder Level <input type="number" id="reorderLevel" placeholder="Enter reorder level"></label>
        <button type="submit" class="btn">Add Item</button>
    </form>
    <table class="table">
        <thead>
            <tr><th>Item</th><th>Quantity</th><th>Reorder Level</th></tr>
        </thead>
        <tbody id="inventoryList"></tbody>
    </table>
</section>
