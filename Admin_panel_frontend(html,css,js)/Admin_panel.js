


// ---- Navigation ------------------------------------------------------
const navButtons = document.querySelectorAll(".nav-btn");
const sections = document.querySelectorAll(".section");

navButtons.forEach(btn => {
  btn.addEventListener("click", () => {
    navButtons.forEach(b => b.classList.remove("active"));
    btn.classList.add("active");

    const id = btn.getAttribute("data-section");
    sections.forEach(sec => sec.classList.remove("active"));
    const active = document.getElementById(id);
    if (active) active.classList.add("active");
  });
});

// ---- Demo data -------------------------------------------------------
let stats = {
  patients: 1245,
  doctors: 84,
  appointmentsToday: 56
};

let activity = [
  "New appointment scheduled with Dr. Hasan",
  "Inventory: Gauze Pads scanned out (x3)",
  "Billing: Invoice #B887 marked paid",
  "Staff: Nurse Rahman assigned Evening shift"
];

let inventory = [
  { name: "Sterile Gauze Pads (4x4)", sku: "GAUZE-4X4-100", category: "Dressings",
    supplier: "MedSupply Inc.", qty: 150, uom: "Box (100)", batch: "BATCH-2025-07",
    expiry: "2026-06-30", reorder: 50 },
  { name: "Disposable Nitrile Gloves (M)", sku: "GLOVES-NITRILE-M", category: "Gloves",
    supplier: "HealthLine Distributors", qty: 40, uom: "Box (50)", batch: "BATCH-2025-02",
    expiry: "2025-09-15", reorder: 60 },
  { name: "Insulin Syringe 1ml", sku: "SYR-INS-1ML", category: "Syringes & Needles",
    supplier: "CarePlus Pharma", qty: 12, uom: "Box (10)", batch: "B-INS-01",
    expiry: "2025-08-10", reorder: 20 }
];

let staff = [
  { id: "S001", name: "Ali Hossain", role: "Nurse", shift: "Morning" },
  { id: "S002", name: "Shreya Patel", role: "Receptionist", shift: "Evening" },
  { id: "S003", name: "Masud Karim", role: "Lab Technician", shift: "Night" }
];

let localDoctors = [
  { license: "BD-12345", name: "Dr. Priya Sen", spec: "Cardiology" },
  { license: "BD-67890", name: "Dr. Hasan", spec: "Pediatrics" }
];

// simulate “national DB” result set (for demo only)
let nationalDoctors = [
  { license: "BD-10101", name: "Dr. Rahman", spec: "Orthopedics" },
  { license: "BD-20202", name: "Dr. Niloy",  spec: "Dermatology" },
  { license: "BD-30303", name: "Dr. Soma",   spec: "Neurology" }
];

// roles
let usersForRoles = [
  { id: "U1001", name: "Admin User", role: "Super Admin" },
  { id: "U2002", name: "Front Desk", role: "Receptionist" },
  { id: "U3003", name: "Lab Lead", role: "Lab Technician" }
];

// ---- Dashboard rendering --------------------------------------------
const statPatients = document.getElementById("statPatients");
const statDoctors = document.getElementById("statDoctors");
const statAppointments = document.getElementById("statAppointments");
const statLowStock = document.getElementById("statLowStock");
const activityFeed = document.getElementById("activityFeed");

function renderDashboard() {
  statPatients.textContent = String(stats.patients);
  statDoctors.textContent = String(stats.doctors);
  statAppointments.textContent = String(stats.appointmentsToday);
  statLowStock.textContent = String(inventory.filter(i => i.qty <= i.reorder).length);

  activityFeed.innerHTML = "";
  activity.forEach(item => {
    const li = document.createElement("li");
    li.textContent = item;
    activityFeed.appendChild(li);
  });
}
renderDashboard();

// ---- Inventory -------------------------------------------------------
const invBody = document.getElementById("invBody");
const invSearch = document.getElementById("invSearch");
const btnInvNew = document.getElementById("btnInvNew");
const invForm = document.getElementById("invForm");
const invErrors = document.getElementById("invErrors");
const invFormTitle = document.getElementById("invFormTitle");
const btnInvCancel = document.getElementById("btnInvCancel");

// form fields
const fItemName = document.getElementById("fItemName");
const fSku = document.getElementById("fSku");
const fCategory = document.getElementById("fCategory");
const fSupplier = document.getElementById("fSupplier");
const fQty = document.getElementById("fQty");
const fUom = document.getElementById("fUom");
const fBatch = document.getElementById("fBatch");
const fExpiry = document.getElementById("fExpiry");
const fReorder = document.getElementById("fReorder");

let editingSku = ""; // empty means "adding"

function formatDate(iso) {
  if (!iso) return "";
  const d = new Date(iso + "T00:00:00");
  const mm = String(d.getMonth() + 1).padStart(2, "0");
  const dd = String(d.getDate()).padStart(2, "0");
  const yyyy = d.getFullYear();
  return `${mm}/${dd}/${yyyy}`;
}

function inventoryAlert(item) {
  const today = new Date(); today.setHours(0,0,0,0);
  const exp = new Date(item.expiry + "T00:00:00");
  const daysLeft = Math.ceil((exp - today) / (24*60*60*1000));
  const expired = exp < today;
  const near = daysLeft >= 0 && daysLeft <= 30;
  const low = Number(item.qty) <= Number(item.reorder);

  if (expired) return { text: "Expired", flag: "danger" };
  if (low)     return { text: "Low Stock", flag: "warn" };
  if (near)    return { text: "Near Expiry", flag: "near" };
  return { text: "OK", flag: "ok" };
}

function renderInventoryTable(list) {
  invBody.innerHTML = "";
  list.forEach(item => {
    const tr = document.createElement("tr");
    const alert = inventoryAlert(item);
    if (alert.flag === "warn") tr.classList.add("row-warn");
    if (alert.flag === "near") tr.classList.add("row-near");
    if (alert.flag === "danger") tr.classList.add("row-danger");

    tr.innerHTML = `
      <td>${item.name}</td>
      <td>${item.sku}</td>
      <td>${item.category}</td>
      <td>${item.supplier}</td>
      <td>${item.qty}</td>
      <td>${item.uom}</td>
      <td>${item.batch}</td>
      <td>${formatDate(item.expiry)}</td>
      <td>${item.reorder}</td>
      <td><span class="status ${alert.flag}">${alert.text}</span></td>
      <td>
        <div class="row">
          <button class="btn small" data-action="scanIn" data-sku="${item.sku}">Scan In</button>
          <button class="btn small ghost" data-action="scanOut" data-sku="${item.sku}">Scan Out</button>
          <button class="btn small" data-action="edit" data-sku="${item.sku}">Edit</button>
          <button class="btn small ghost" data-action="delete" data-sku="${item.sku}">Delete</button>
        </div>
      </td>
    `;
    invBody.appendChild(tr);
  });
}
renderInventoryTable(inventory);

// search
invSearch.addEventListener("input", () => {
  const q = invSearch.value.trim().toLowerCase();
  const filtered = inventory.filter(i =>
    i.name.toLowerCase().includes(q) || i.sku.toLowerCase().includes(q)
  );
  renderInventoryTable(filtered);
});

// new / cancel / edit helpers
function resetInvForm() {
  invForm.reset();
  invErrors.textContent = "";
  invErrors.classList.remove("show");
  editingSku = "";
  fSku.disabled = false;
  invFormTitle.textContent = "Add Inventory Item";
}
btnInvNew.addEventListener("click", resetInvForm);
btnInvCancel.addEventListener("click", resetInvForm);

function fillInvForm(item) {
  fItemName.value = item.name;
  fSku.value = item.sku;
  fCategory.value = item.category;
  fSupplier.value = item.supplier;
  fQty.value = item.qty;
  fUom.value = item.uom;
  fBatch.value = item.batch;
  fExpiry.value = item.expiry;
  fReorder.value = item.reorder;
}

function validateInventoryForm() {
  const errs = [];
  const name = fItemName.value.trim();
  const sku = fSku.value.trim();
  const qty = Number(fQty.value);
  const reorder = Number(fReorder.value);

  if (name.length === 0) errs.push("Item Name is required.");
  if (sku.length === 0) errs.push("SKU is required.");
  if (!editingSku) {
    const exists = inventory.some(i => i.sku.toLowerCase() === sku.toLowerCase());
    if (exists) errs.push("SKU must be unique.");
  }
  if (!fCategory.value) errs.push("Category is required.");
  if (!fSupplier.value) errs.push("Supplier is required.");
  if (!Number.isInteger(qty) || qty < 0) errs.push("Quantity must be a non-negative integer.");
  if (!fUom.value) errs.push("Unit of Measurement is required.");
  if (fBatch.value.trim().length === 0) errs.push("Batch Number is required.");
  if (!fExpiry.value) errs.push("Expiration Date is required.");
  if (!Number.isInteger(reorder) || reorder < 0) errs.push("Reorder Level must be a non-negative integer.");

  return errs;
}

invForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const errs = validateInventoryForm();
  if (errs.length > 0) {
    invErrors.innerHTML = "<ul><li>" + errs.join("</li><li>") + "</li></ul>";
    invErrors.classList.add("show");
    return;
  }
  invErrors.classList.remove("show");
  invErrors.textContent = "";

  const newItem = {
    name: fItemName.value.trim(),
    sku: fSku.value.trim(),
    category: fCategory.value,
    supplier: fSupplier.value,
    qty: Number(fQty.value),
    uom: fUom.value,
    batch: fBatch.value.trim(),
    expiry: fExpiry.value,
    reorder: Number(fReorder.value)
  };

  if (editingSku) {
    const idx = inventory.findIndex(i => i.sku === editingSku);
    if (idx >= 0) inventory[idx] = newItem;
    activity.unshift("Inventory updated: " + newItem.name);
  } else {
    inventory.push(newItem);
    activity.unshift("Inventory added: " + newItem.name);
  }

  renderInventoryTable(inventory);
  renderDashboard();
  resetInvForm();
});

// table actions
invBody.addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const action = el.getAttribute("data-action");
  const sku = el.getAttribute("data-sku");
  if (!action || !sku) return;

  const idx = inventory.findIndex(i => i.sku === sku);
  if (idx < 0) return;

  if (action === "scanIn") {
    inventory[idx].qty += 1;
    activity.unshift("Scanned in: " + inventory[idx].name);
  }
  if (action === "scanOut") {
    if (inventory[idx].qty > 0) {
      inventory[idx].qty -= 1;
      activity.unshift("Scanned out: " + inventory[idx].name);
    }
  }
  if (action === "edit") {
    editingSku = sku;
    invFormTitle.textContent = "Edit Inventory Item";
    fillInvForm(inventory[idx]);
    fSku.disabled = true;
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
  if (action === "delete") {
    activity.unshift("Deleted inventory: " + inventory[idx].name);
    inventory.splice(idx, 1);
  }

  renderInventoryTable(inventory);
  renderDashboard();
});

// ---- Staff -----------------------------------------------------------
const staffBody = document.getElementById("staffBody");
const staffSearch = document.getElementById("staffSearch");
const btnStaffNew = document.getElementById("btnStaffNew");
const staffForm = document.getElementById("staffForm");
const staffFormTitle = document.getElementById("staffFormTitle");
const staffErrors = document.getElementById("staffErrors");

const sName = document.getElementById("sName");
const sRole = document.getElementById("sRole");
const sShift = document.getElementById("sShift");
const btnStaffCancel = document.getElementById("btnStaffCancel");

let editingStaffId = "";

function renderStaffTable(list) {
  staffBody.innerHTML = "";
  list.forEach(member => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${member.id}</td>
      <td>${member.name}</td>
      <td>${member.role}</td>
      <td>${member.shift}</td>
      <td>
        <div class="row">
          <button class="btn small" data-action="edit" data-id="${member.id}">Edit</button>
          <button class="btn small ghost" data-action="remove" data-id="${member.id}">Remove</button>
        </div>
      </td>
    `;
    staffBody.appendChild(tr);
  });
}
renderStaffTable(staff);

staffSearch.addEventListener("input", () => {
  const q = staffSearch.value.trim().toLowerCase();
  const filtered = staff.filter(s =>
    s.name.toLowerCase().includes(q) || s.role.toLowerCase().includes(q)
  );
  renderStaffTable(filtered);
});

btnStaffNew.addEventListener("click", () => {
  staffForm.reset();
  staffErrors.textContent = "";
  staffErrors.classList.remove("show");
  editingStaffId = "";
  staffFormTitle.textContent = "Add Staff";
});

btnStaffCancel.addEventListener("click", () => {
  staffForm.reset();
  editingStaffId = "";
  staffFormTitle.textContent = "Add Staff";
});

function validateStaffForm() {
  const errs = [];
  if (sName.value.trim().length === 0) errs.push("Full Name is required.");
  if (!sRole.value) errs.push("Role is required.");
  if (!sShift.value) errs.push("Shift is required.");
  return errs;
}

staffForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const errs = validateStaffForm();
  if (errs.length > 0) {
    staffErrors.innerHTML = "<ul><li>" + errs.join("</li><li>") + "</li></ul>";
    staffErrors.classList.add("show");
    return;
  }
  staffErrors.classList.remove("show");
  staffErrors.textContent = "";

  if (editingStaffId) {
    const idx = staff.findIndex(s => s.id === editingStaffId);
    if (idx >= 0) {
      staff[idx].name = sName.value.trim();
      staff[idx].role = sRole.value;
      staff[idx].shift = sShift.value;
      activity.unshift("Staff updated: " + staff[idx].name);
    }
  } else {
    const newId = "S" + String(100 + staff.length + 1).padStart(3, "0");
    const newStaff = {
      id: newId,
      name: sName.value.trim(),
      role: sRole.value,
      shift: sShift.value
    };
    staff.push(newStaff);
    activity.unshift("Staff added: " + newStaff.name);
  }

  renderStaffTable(staff);
  renderDashboard();
  staffForm.reset();
  editingStaffId = "";
  staffFormTitle.textContent = "Add Staff";
});

staffBody.addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const action = el.getAttribute("data-action");
  const id = el.getAttribute("data-id");
  if (!action || !id) return;

  const idx = staff.findIndex(s => s.id === id);
  if (idx < 0) return;

  if (action === "edit") {
    editingStaffId = id;
    staffFormTitle.textContent = "Edit Staff";
    sName.value = staff[idx].name;
    sRole.value = staff[idx].role;
    sShift.value = staff[idx].shift;
    window.scrollTo({ top: 0, behavior: "smooth" });
  }

  if (action === "remove") {
    activity.unshift("Staff removed: " + staff[idx].name);
    staff.splice(idx, 1);
    renderStaffTable(staff);
    renderDashboard();
  }
});

// ---- Doctor Registry -------------------------------------------------
const docSearch = document.getElementById("docSearch");
const btnDocSearch = document.getElementById("btnDocSearch");
const docSearchBody = document.getElementById("docSearchBody");
const docLocalBody = document.getElementById("docLocalBody");

const docFormLocal = document.getElementById("docFormLocal");
const dLicense = document.getElementById("dLicense");
const dName = document.getElementById("dName");
const dSpec = document.getElementById("dSpec");
const docLocalErrors = document.getElementById("docLocalErrors");

const docFormNational = document.getElementById("docFormNational");
const nLicense = document.getElementById("nLicense");
const nName = document.getElementById("nName");
const nSpec = document.getElementById("nSpec");
const docNationalErrors = document.getElementById("docNationalErrors");

function renderLocalDoctors() {
  docLocalBody.innerHTML = "";
  localDoctors.forEach(d => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${d.license}</td>
      <td>${d.name}</td>
      <td>${d.spec}</td>
      <td>
        <div class="row">
          <button class="btn small" data-ld="remove" data-license="${d.license}">Remove</button>
        </div>
      </td>
    `;
    docLocalBody.appendChild(tr);
  });
}
renderLocalDoctors();

function renderNationalSearch(results) {
  docSearchBody.innerHTML = "";
  results.forEach(d => {
    const tr = document.createElement("tr");
    tr.innerHTML = `
      <td>${d.license}</td>
      <td>${d.name}</td>
      <td>${d.spec}</td>
      <td>
        <div class="row">
          <button class="btn small" data-add-license="${d.license}">Add Locally</button>
        </div>
      </td>
    `;
    docSearchBody.appendChild(tr);
  });
}

btnDocSearch.addEventListener("click", () => {
  const q = docSearch.value.trim().toLowerCase();
  const results = nationalDoctors.filter(d =>
    d.name.toLowerCase().includes(q) || d.spec.toLowerCase().includes(q)
  );
  renderNationalSearch(results);
});

docSearchBody.addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const license = el.getAttribute("data-add-license");
  if (!license) return;

  const doc = nationalDoctors.find(d => d.license === license);
  if (!doc) return;

  const exists = localDoctors.some(ld => ld.license === doc.license);
  if (!exists) {
    localDoctors.push({ license: doc.license, name: doc.name, spec: doc.spec });
    activity.unshift("Doctor added to local registry: " + doc.name);
    renderLocalDoctors();
    renderDashboard();
  }
});

docLocalBody.addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const license = el.getAttribute("data-license");
  const action = el.getAttribute("data-ld");
  if (action !== "remove" || !license) return;

  const idx = localDoctors.findIndex(d => d.license === license);
  if (idx >= 0) {
    activity.unshift("Doctor removed from local registry: " + localDoctors[idx].name);
    localDoctors.splice(idx, 1);
    renderLocalDoctors();
    renderDashboard();
  }
});

docFormLocal.addEventListener("submit", (e) => {
  e.preventDefault();
  docLocalErrors.textContent = "";
  docLocalErrors.classList.remove("show");

  const license = dLicense.value.trim();
  const name = dName.value.trim();
  const spec = dSpec.value.trim();

  const errs = [];
  if (license.length === 0) errs.push("License No. is required.");
  if (name.length === 0) errs.push("Doctor Name is required.");
  if (spec.length === 0) errs.push("Specialty is required.");

  const exists = localDoctors.some(d => d.license.toLowerCase() === license.toLowerCase());
  if (exists) errs.push("License already exists in local registry.");

  if (errs.length > 0) {
    docLocalErrors.innerHTML = "<ul><li>" + errs.join("</li><li>") + "</li></ul>";
    docLocalErrors.classList.add("show");
    return;
  }

  localDoctors.push({ license, name, spec });
  activity.unshift("Doctor added to local registry: " + name);
  renderLocalDoctors();
  renderDashboard();
  docFormLocal.reset();
});

docFormNational.addEventListener("submit", (e) => {
  e.preventDefault();
  docNationalErrors.textContent = "";
  docNationalErrors.classList.remove("show");

  const license = nLicense.value.trim();
  const name = nName.value.trim();
  const spec = nSpec.value.trim();

  const errs = [];
  if (license.length === 0) errs.push("License No. is required.");
  if (name.length === 0) errs.push("Doctor Name is required.");
  if (spec.length === 0) errs.push("Specialty is required.");

  if (errs.length > 0) {
    docNationalErrors.innerHTML = "<ul><li>" + errs.join("</li><li>") + "</li></ul>";
    docNationalErrors.classList.add("show");
    return;
  }

  // Simulated publish
  activity.unshift("Published doctor to national DB: " + name);
  renderDashboard();
  docFormNational.reset();
});

// ---- Roles & Access --------------------------------------------------
const rolesBody = document.getElementById("rolesBody");

function renderRolesTable() {
  rolesBody.innerHTML = "";
  usersForRoles.forEach(u => {
    const tr = document.createElement("tr");
    const selectId = "roleSel_" + u.id;
    tr.innerHTML = `
      <td>${u.id}</td>
      <td>${u.name}</td>
      <td>${u.role}</td>
      <td>
        <select id="${selectId}" class="input">
          <option${u.role==="Super Admin"?" selected":""}>Super Admin</option>
          <option${u.role==="Admin"?" selected":""}>Admin</option>
          <option${u.role==="Doctor"?" selected":""}>Doctor</option>
          <option${u.role==="Receptionist"?" selected":""}>Receptionist</option>
          <option${u.role==="Lab Technician"?" selected":""}>Lab Technician</option>
          <option${u.role==="Pharmacist"?" selected":""}>Pharmacist</option>
          <option${u.role==="Accountant"?" selected":""}>Accountant</option>
        </select>
        <button class="btn small" data-uid="${u.id}">Update</button>
      </td>
    `;
    rolesBody.appendChild(tr);
  });
}
renderRolesTable();

rolesBody.addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const uid = el.getAttribute("data-uid");
  if (!uid) return;

  const sel = document.getElementById("roleSel_" + uid);
  if (!sel) return;

  const idx = usersForRoles.findIndex(u => u.id === uid);
  if (idx >= 0) {
    usersForRoles[idx].role = sel.value;
    activity.unshift("Role updated: " + usersForRoles[idx].name + " → " + sel.value);
    renderDashboard();
    renderRolesTable();
  }
});

// ---- Profile ---------------------------------------------------------
const profileForm = document.getElementById("profileForm");
const pName = document.getElementById("pName");
const pEmail = document.getElementById("pEmail");
const pPhone = document.getElementById("pPhone");
const pDept = document.getElementById("pDept");
const profileErrors = document.getElementById("profileErrors");

profileForm.addEventListener("submit", (e) => {
  e.preventDefault();
  const errs = [];
  if (pName.value.trim().length === 0) errs.push("Full Name is required.");
  if (pEmail.value.trim().length === 0) errs.push("Email is required.");
  if (pDept.value.trim().length === 0) errs.push("Department is required.");

  // No regex: we only check presence, not format.
  if (errs.length > 0) {
    profileErrors.innerHTML = "<ul><li>" + errs.join("</li><li>") + "</li></ul>";
    profileErrors.classList.add("show");
    return;
  }
  profileErrors.classList.remove("show");
  profileErrors.textContent = "";
  activity.unshift("Profile updated: " + pName.value.trim());
  renderDashboard();
  profileForm.reset();
});

// ---- Error Pages (Preview) ------------------------------------------
const errorDialog = document.getElementById("errorDialog");
const errorDialogBody = document.getElementById("errorDialogBody");
const btnCloseDialog = document.getElementById("btnCloseDialog");

document.getElementById("errors").addEventListener("click", (e) => {
  const el = e.target;
  if (!(el instanceof HTMLElement)) return;
  const code = el.getAttribute("data-error");
  if (!code) return;

  let title = "";
  let message = "";
  if (code === "403") { title = "403 Forbidden"; message = "You don't have permission to access this resource."; }
  if (code === "404") { title = "404 Not Found"; message = "The page you are looking for doesn't exist."; }
  if (code === "500") { title = "500 Internal Server Error"; message = "An unexpected error occurred on the server."; }

  errorDialogBody.innerHTML = `
    <h3 style="margin:0 0 6px 0; color: var(--danger);">${title}</h3>
    <p class="muted">${message}</p>
  `;
  if (typeof errorDialog.showModal === "function") {
    errorDialog.showModal();
  }
});
btnCloseDialog.addEventListener("click", () => {
  if (typeof errorDialog.close === "function") errorDialog.close();
});

// ---- Topbar actions --------------------------------------------------
document.getElementById("btnProfile").addEventListener("click", () => {
  navButtons.forEach(b => b.classList.remove("active"));
  sections.forEach(sec => sec.classList.remove("active"));
  document.querySelector('.nav-btn[data-section="profile"]').classList.add("active");
  document.getElementById("profile").classList.add("active");
});

document.getElementById("btnLogout").addEventListener("click", () => {
  activity.unshift("User logged out.");
  renderDashboard();
  alert("Logged out (demo).");
});
