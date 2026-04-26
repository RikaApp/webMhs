let mkList = [];

document.addEventListener("DOMContentLoaded", () => {
    initEvent();
    showDashboard();
});

function initEvent() {
    document.getElementById("btn-tambah-mk").onclick = tambahMK;
    document.getElementById("btn-simpan-mk").onclick = simpanMK;
    document.getElementById("btn-simpan-mhs").onclick = simpanMahasiswa;

    const menu = document.querySelectorAll(".sidebar ul li");

    menu[0].onclick = () => showDashboard();
    menu[1].onclick = () => showMK();
    menu[2].onclick = () => showMahasiswa();
}

function hideAllSection() {
    document.getElementById("dashboard-section").style.display = "none";
    document.getElementById("mk-section").style.display = "none";
    document.getElementById("mhs-section").style.display = "none";
}

function showDashboard() {
    hideAllSection();
    document.getElementById("dashboard-section").style.display = "block";
    tampilkanDashboard();
}

function showMK() {
    hideAllSection();
    document.getElementById("mk-section").style.display = "block";
    tampilkanMK();
}

function showMahasiswa() {
    hideAllSection();
    document.getElementById("mhs-section").style.display = "block";
    loadMKtoMahasiswa();
    tampilkanMahasiswa();
}

function tambahMK() {
    const kode = document.getElementById("kode").value.trim();
    const nama = document.getElementById("nama_mk").value.trim();

    if (!kode || !nama) return alert("Kode dan Nama MK wajib diisi");

    mkList.push({ kode, nama });
    renderMK();

    document.getElementById("kode").value = "";
    document.getElementById("nama_mk").value = "";
}

function renderMK() {
    const list = document.getElementById("listMK");
    list.innerHTML = "";

    mkList.forEach(mk => {
        const li = document.createElement("li");
        li.textContent = `${mk.kode} - ${mk.nama}`;
        list.appendChild(li);
    });
}

function simpanMK() {
    if (mkList.length === 0) return alert("Tambahkan minimal 1 mata kuliah");

    fetch("index.php?action=save_mk", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(mkList)
    })
        .then(res => res.json())
        .then(res => {
            alert(res.message);
            if (res.success) {
                mkList = [];
                renderMK();
                tampilkanMK();
            }
        });
}

function tampilkanMK() {
    fetch("index.php?action=get_mk")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("mk-tbody");
            tbody.innerHTML = "";

            data.forEach(mk => {
                const tr = document.createElement("tr");

                const tdKode = document.createElement("td");
                tdKode.textContent = mk.kode;

                const tdNama = document.createElement("td");
                tdNama.textContent = mk.nama;

                tr.append(tdKode, tdNama);
                tbody.appendChild(tr);
            });
        });
}

function loadMKtoMahasiswa() {
    fetch("index.php?action=get_mk")
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("mk-container");
            container.innerHTML = "";

            data.forEach((mk, i) => {
                const div = document.createElement("div");
                div.className = "mk-item";

                const label = document.createElement("label");
                label.textContent = mk.nama;

                const input = document.createElement("input");
                input.type = "number";
                input.id = `nilai_${i}`;
                input.placeholder = "Nilai";

                div.append(label, input);
                container.appendChild(div);
            });
        });
}

function simpanMahasiswa() {
    const npm = document.getElementById("npm").value.trim();
    const nama = document.getElementById("nama").value.trim();

    if (!npm || !nama) return alert("NPM dan Nama wajib diisi");

    fetch("index.php?action=get_mk")
        .then(res => res.json())
        .then(mkData => {
            const list = [];

            mkData.forEach((mk, i) => {
                let nilai = document.getElementById(`nilai_${i}`).value;
                if (!nilai) return;

                nilai = parseInt(nilai);

                list.push({
                    kode: mk.kode,
                    nama: mk.nama,
                    nilai,
                    grade: getGrade(nilai)
                });
            });

            if (list.length === 0) return alert("Minimal isi 1 nilai");

            fetch("index.php?action=save_mahasiswa", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ npm, nama, matakuliah: list })
            })
                .then(res => res.json())
                .then(res => {
                    alert(res.message);
                    tampilkanMahasiswa();
                });
        });
}

function getGrade(nilai) {
    if (nilai >= 80) return "A";
    if (nilai >= 70) return "B";
    if (nilai >= 55) return "C";
    if (nilai >= 40) return "D";
    return "E";
}

function tampilkanMahasiswa() {
    fetch("data.json")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("mhs-tbody");
            tbody.innerHTML = "";

            data.mahasiswa.forEach(mhs => {
                const mkList = mhs.matakuliah || [];

                mkList.forEach((mk, index) => {
                    const tr = document.createElement("tr");

                    if (index === 0) {
                        const tdNpm = createCell(mhs.npm, mkList.length);
                        const tdNama = createCell(mhs.nama, mkList.length);
                        tr.append(tdNpm, tdNama);
                    }

                    tr.append(
                        createCell(mk.nama),
                        createCell(mk.nilai),
                        createCell(mk.grade)
                    );

                    tbody.appendChild(tr);
                });
            });
        });
}

function tampilkanDashboard() {
    fetch("data.json")
        .then(res => res.json())
        .then(data => {
            const tbody = document.getElementById("dashboard-tbody");
            tbody.innerHTML = "";

            if (data.mahasiswa.length === 0) {
                const td = createCell("Belum ada data");
                td.colSpan = 5;
                td.style.textAlign = "center";

                const tr = document.createElement("tr");
                tr.appendChild(td);
                tbody.appendChild(tr);
                return;
            }

            data.mahasiswa.forEach(mhs => {
                const mkList = mhs.matakuliah || [];

                mkList.forEach((mk, index) => {
                    const tr = document.createElement("tr");

                    if (index === 0) {
                        tr.append(
                            createCell(mhs.npm, mkList.length),
                            createCell(mhs.nama, mkList.length)
                        );
                    }

                    tr.append(
                        createCell(mk.nama),
                        createCell(mk.nilai),
                        createCell(mk.grade)
                    );

                    tbody.appendChild(tr);
                });
            });
        });
}
function createCell(text, rowspan = null) {
    const td = document.createElement("td");
    td.textContent = text;
    if (rowspan) td.rowSpan = rowspan;
    return td;
}