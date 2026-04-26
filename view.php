<!DOCTYPE html>
<html>

<head>
    <title>Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="sidebar">
        <h2 class="logo-title">
            <img src="https://blogger.googleusercontent.com/img/b/R29vZ2xl/AVvXsEgMFuvzHonlaTxPBIcHgK4kpyDhEX58X-Mhr_idFTVNEDJQtCrbR4fyzyoewD9WgO8AsiwN6Y4tFsYeiT8VbHIjpNKETz0JisSB2qDDJspJW4XRjuCniPjUj2zpG8IB8x7PNOL2k-Dlq_HFjfBJueZui-x7FKyJFohjPXlpdfd0VLlpF5nCSnqQuSsu/s320/UKRI-%2528Universitas-Kebangsaan-Republik-Indonesia%2529-koleksilogo.com_GKL16.jpg" class="logo">
            Informatika UKRI
        </h2>

        <ul>
            <li>Dashboard</li>
            <li>Mata Kuliah</li>
            <li>Mahasiswa</li>
        </ul>
    </div>

    <div class="main">

        <div class="header">
            <h1>Sistem Data Mahasiswa</h1>
        </div>

        <!-- DASHBOARD -->
        <div class="card" id="dashboard-section">
            <h2>Dashboard</h2>
            <div id="dashboard-content">
                <h3>Data Mahasiswa & Mata Kuliah</h3>
                <table>
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Mata Kuliah</th>
                            <th>Nilai</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody id="dashboard-tbody"></tbody>
                </table>
            </div>
        </div>

        <!-- MATA KULIAH -->
        <div class="card" id="mk-section" style="display:none;">
            <h2>Input Mata Kuliah</h2>

            <form id="form-mk">
                <input id="kode" placeholder="Kode Mata Kuliah" required>
                <input id="nama_mk" placeholder="Nama Mata Kuliah" required>

                <button type="button" id="btn-tambah-mk">Tambah</button>
                <button type="button" id="btn-simpan-mk">Simpan</button>
            </form>

            <ul id="listMK"></ul>

            <div id="mk-table">
                <h3>Data Mata Kuliah</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Kode Mata Kuliah</th>
                            <th>Nama Mata Kuliah</th>
                        </tr>
                    </thead>
                    <tbody id="mk-tbody"></tbody>
                </table>
            </div>
        </div>

        <!-- MAHASISWA -->
        <div class="card" id="mhs-section" style="display:none;">
            <h2>Input Mahasiswa</h2>

            <form id="form-mhs">
                <input id="npm" placeholder="NPM" required>
                <input id="nama" placeholder="Nama Mahasiswa" required>

                <div id="mk-container"></div>

                <button type="button" id="btn-simpan-mhs">Simpan Mahasiswa</button>
            </form>

            <div id="mhs-table">
                <h3>Data Mahasiswa</h3>
                <table>
                    <thead>
                        <tr>
                            <th>NPM</th>
                            <th>Nama</th>
                            <th>Mata Kuliah</th>
                            <th>Nilai</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody id="mhs-tbody"></tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="script.js"></script>
</body>

</html>