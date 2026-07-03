const table = document.querySelector("table");
const tbody = table.querySelector("tbody");

const searchInput = document.getElementById("searchInput");
const rowsPerPage = document.getElementById("rowsPerPage");
const pagination = document.getElementById("pagination");

// 👉 DATA SIN ID (col 0 = unit_id ignorado)
let data = Array.from(tbody.querySelectorAll("tr")).map(tr => {
    let cols = Array.from(tr.children)
        .slice(1) // ❌ elimina la columna ID
        .map(td => td.innerHTML);

    return { cols };
});

let currentPage = 1;
let rowsPage = parseInt(rowsPerPage.value);
let sortDirection = {};
let currentData = [...data];

function renderTable() {

    let search = searchInput.value.toLowerCase();

    let filtered = currentData.filter(row => {
        return row.cols.join(" ").toLowerCase().includes(search);
    });

    let totalPages = Math.ceil(filtered.length / rowsPage);
    if (totalPages === 0) totalPages = 1;

    if (currentPage > totalPages) currentPage = 1;

    let start = (currentPage - 1) * rowsPage;
    let end = start + rowsPage;

    tbody.innerHTML = "";

    filtered.slice(start, end).forEach((row, index) => {

        let tr = document.createElement("tr");

        // 🔢 NUMERACIÓN (#)
        let tdNumber = document.createElement("td");
        tdNumber.innerHTML = start + index + 1;
        tr.appendChild(tdNumber);

        // 👉 resto de columnas (sin ID)
        row.cols.forEach(col => {
            let td = document.createElement("td");
            td.innerHTML = col || "";
            tr.appendChild(td);
        });

        tbody.appendChild(tr);
    });

    renderPagination(totalPages);
}

function renderPagination(totalPages) {

    pagination.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {

        let btn = document.createElement("button");
        btn.innerText = i;

        if (i === currentPage) btn.classList.add("active");

        btn.onclick = () => {
            currentPage = i;
            renderTable();
        };

        pagination.appendChild(btn);
    }
}

// SEARCH
searchInput.addEventListener("input", () => {
    currentPage = 1;
    renderTable();
});

// ROWS PER PAGE
rowsPerPage.addEventListener("change", () => {
    rowsPage = parseInt(rowsPerPage.value);
    currentPage = 1;
    renderTable();
});

// SORT
document.querySelectorAll(".sortable").forEach((th, index) => {

    sortDirection[index] = true;

    th.addEventListener("click", () => {

        let asc = sortDirection[index];

        currentData.sort((a, b) => {

            let x = a.cols[index].toLowerCase();
            let y = b.cols[index].toLowerCase();

            return asc
                ? x.localeCompare(y, 'es', { numeric: true })
                : y.localeCompare(x, 'es', { numeric: true });
        });

        document.querySelectorAll(".sortable span").forEach(s => s.innerText = "↕");

        th.querySelector("span").innerText = asc ? "▲" : "▼";

        sortDirection[index] = !asc;

        renderTable();
    });
});

// INIT
renderTable();