<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Produk dan Kategori</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 2.5em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            background: #f8f9fa;
            border-radius: 15px;
            padding: 5px;
        }

        .tab {
            padding: 15px 30px;
            background: transparent;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .tab.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .tab-content {
            display: none;
            animation: fadeIn 0.5s ease;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-section {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-bottom: 30px;
            border: 2px solid transparent;
            background-clip: padding-box;
        }

        .form-section::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: linear-gradient(45deg, #667eea, #764ba2);
            border-radius: 15px;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            z-index: -1;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background: white;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            transform: translateY(-1px);
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-right: 10px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-edit {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
        }

        .btn-edit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .btn-delete {
            background: linear-gradient(45deg, #dc3545, #e83e8c);
            color: white;
        }

        .btn-delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #e0e0e0;
        }

        th {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:nth-child(even) {
            background: #f8f9fa;
        }

        tr:hover {
            background: #e3f2fd;
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 10px;
            font-weight: 600;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            .tabs {
                flex-direction: column;
            }
            
            .tab {
                margin: 5px 0;
            }
            
            .form-buttons {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🛍️ Sistem Manajemen Produk & Kategori</h1>
        
        <div class="tabs">
            <button class="tab active" onclick="showTab('kategori')">📂 Kategori</button>
            <button class="tab" onclick="showTab('produk')">🛒 Produk</button>
        </div>

        <!-- Alert Container -->
        <div id="alertContainer"></div>

        <!-- Tab Kategori -->
        <div id="kategori" class="tab-content active">
            <div class="form-section">
                <h2>🆕 Tambah/Edit Kategori</h2>
                <form id="kategoriForm">
                    <input type="hidden" id="kategoriId" value="">
                    <div class="form-group">
                        <label for="namaKategori">Nama Kategori:</label>
                        <input type="text" id="namaKategori" required placeholder="Masukkan nama kategori">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiKategori">Deskripsi:</label>
                        <textarea id="deskripsiKategori" rows="3" placeholder="Masukkan deskripsi kategori"></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <button type="button" class="btn btn-cancel" onclick="cancelKategoriEdit()">❌ Batal</button>
                    </div>
                </form>
            </div>

            <div class="form-section">
                <h2>📋 Daftar Kategori</h2>
                <div class="table-container">
                    <table id="kategoriTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Deskripsi</th>
                                <th>Jumlah Produk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="kategoriTableBody">
                            <tr>
                                <td colspan="5" class="empty-state">Belum ada kategori yang ditambahkan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab Produk -->
        <div id="produk" class="tab-content">
            <div class="form-section">
                <h2>🆕 Tambah/Edit Produk</h2>
                <form id="produkForm">
                    <input type="hidden" id="produkId" value="">
                    <div class="form-group">
                        <label for="namaProduk">Nama Produk:</label>
                        <input type="text" id="namaProduk" required placeholder="Masukkan nama produk">
                    </div>
                    <div class="form-group">
                        <label for="kategoriProduk">Kategori:</label>
                        <select id="kategoriProduk" required>
                            <option value="">Pilih kategori</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hargaProduk">Harga:</label>
                        <input type="number" id="hargaProduk" required placeholder="Masukkan harga produk" min="0">
                    </div>
                    <div class="form-group">
                        <label for="deskripsiProduk">Deskripsi:</label>
                        <textarea id="deskripsiProduk" rows="3" placeholder="Masukkan deskripsi produk"></textarea>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="btn btn-primary">💾 Simpan</button>
                        <button type="button" class="btn btn-cancel" onclick="cancelProdukEdit()">❌ Batal</button>
                    </div>
                </form>
            </div>

            <div class="form-section">
                <h2>📋 Daftar Produk</h2>
                <div class="table-container">
                    <table id="produkTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="produkTableBody">
                            <tr>
                                <td colspan="6" class="empty-state">Belum ada produk yang ditambahkan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Data storage
        let kategoris = [];
        let produks = [];
        let nextKategoriId = 1;
        let nextProdukId = 1;

        // Initialize with sample data
        function initializeData() {
            kategoris = [
                { id: 1, nama: 'Minuman', deskripsi: 'Berbagai jenis minuman segar' },
                { id: 2, nama: 'Makanan', deskripsi: 'Makanan ringan dan berat' },
                { id: 3, nama: 'Elektronik', deskripsi: 'Perangkat elektronik dan gadget' }
            ];
            nextKategoriId = 4;
            
            produks = [
                { id: 1, nama: 'Coca Cola', kategoriId: 1, harga: 5000, deskripsi: 'Minuman soda segar' },
                { id: 2, nama: 'Nasi Goreng', kategoriId: 2, harga: 15000, deskripsi: 'Nasi goreng spesial' },
                { id: 3, nama: 'Smartphone', kategoriId: 3, harga: 2000000, deskripsi: 'Smartphone android terbaru' }
            ];
            nextProdukId = 4;
        }

        // Tab functionality
        function showTab(tabName) {
            const tabs = document.querySelectorAll('.tab');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabs.forEach(tab => tab.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));
            
            document.querySelector(`[onclick="showTab('${tabName}')"]`).classList.add('active');
            document.getElementById(tabName).classList.add('active');
            
            if (tabName === 'produk') {
                updateKategoriSelect();
            }
        }

        // Alert functionality
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type}`;
            alertDiv.textContent = message;
            
            alertContainer.innerHTML = '';
            alertContainer.appendChild(alertDiv);
            
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }

        // Kategori CRUD
        function addKategori(nama, deskripsi) {
            const kategori = {
                id: nextKategoriId++,
                nama: nama,
                deskripsi: deskripsi
            };
            kategoris.push(kategori);
            return kategori;
        }

        function updateKategori(id, nama, deskripsi) {
            const index = kategoris.findIndex(k => k.id === id);
            if (index !== -1) {
                kategoris[index] = { id, nama, deskripsi };
                return true;
            }
            return false;
        }

        function deleteKategori(id) {
            // Check if category has products
            const hasProducts = produks.some(p => p.kategoriId === id);
            if (hasProducts) {
                showAlert('Tidak dapat menghapus kategori yang masih memiliki produk!', 'error');
                return false;
            }
            
            const index = kategoris.findIndex(k => k.id === id);
            if (index !== -1) {
                kategoris.splice(index, 1);
                return true;
            }
            return false;
        }

        function getKategoriById(id) {
            return kategoris.find(k => k.id === id);
        }

        function countProdukByKategori(kategoriId) {
            return produks.filter(p => p.kategoriId === kategoriId).length;
        }

        // Produk CRUD
        function addProduk(nama, kategoriId, harga, deskripsi) {
            const produk = {
                id: nextProdukId++,
                nama: nama,
                kategoriId: parseInt(kategoriId),
                harga: parseFloat(harga),
                deskripsi: deskripsi
            };
            produks.push(produk);
            return produk;
        }

        function updateProduk(id, nama, kategoriId, harga, deskripsi) {
            const index = produks.findIndex(p => p.id === id);
            if (index !== -1) {
                produks[index] = {
                    id,
                    nama,
                    kategoriId: parseInt(kategoriId),
                    harga: parseFloat(harga),
                    deskripsi
                };
                return true;
            }
            return false;
        }

        function deleteProduk(id) {
            const index = produks.findIndex(p => p.id === id);
            if (index !== -1) {
                produks.splice(index, 1);
                return true;
            }
            return false;
        }

        function getProdukById(id) {
            return produks.find(p => p.id === id);
        }

        // Display functions
        function displayKategoris() {
            const tbody = document.getElementById('kategoriTableBody');
            
            if (kategoris.length === 0) {
                tbody.innerHTML = '<tr><td colspan="5" class="empty-state">Belum ada kategori yang ditambahkan</td></tr>';
                return;
            }
            
            tbody.innerHTML = '';
            kategoris.forEach((kategori, index) => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${kategori.nama}</td>
                    <td>${kategori.deskripsi}</td>
                    <td>${countProdukByKategori(kategori.id)}</td>
                    <td>
                        <button class="btn btn-edit" onclick="editKategori(${kategori.id})">✏️ Edit</button>
                        <button class="btn btn-delete" onclick="hapusKategori(${kategori.id})">🗑️ Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function displayProduks() {
            const tbody = document.getElementById('produkTableBody');
            
            if (produks.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="empty-state">Belum ada produk yang ditambahkan</td></tr>';
                return;
            }
            
            tbody.innerHTML = '';
            produks.forEach((produk, index) => {
                const kategori = getKategoriById(produk.kategoriId);
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${index + 1}</td>
                    <td>${produk.nama}</td>
                    <td>${kategori ? kategori.nama : 'Kategori tidak ditemukan'}</td>
                    <td>Rp ${produk.harga.toLocaleString('id-ID')}</td>
                    <td>${produk.deskripsi}</td>
                    <td>
                        <button class="btn btn-edit" onclick="editProduk(${produk.id})">✏️ Edit</button>
                        <button class="btn btn-delete" onclick="hapusProduk(${produk.id})">🗑️ Hapus</button>
                    </td>
                `;
                tbody.appendChild(row);
            });
        }

        function updateKategoriSelect() {
            const select = document.getElementById('kategoriProduk');
            select.innerHTML = '<option value="">Pilih kategori</option>';
            
            kategoris.forEach(kategori => {
                const option = document.createElement('option');
                option.value = kategori.id;
                option.textContent = kategori.nama;
                select.appendChild(option);
            });
        }

        // Form handlers
        document.getElementById('kategoriForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('kategoriId').value;
            const nama = document.getElementById('namaKategori').value;
            const deskripsi = document.getElementById('deskripsiKategori').value;
            
            if (id) {
                // Edit mode
                if (updateKategori(parseInt(id), nama, deskripsi)) {
                    showAlert('Kategori berhasil diperbarui!');
                    cancelKategoriEdit();
                } else {
                    showAlert('Gagal memperbarui kategori!', 'error');
                }
            } else {
                // Add mode
                addKategori(nama, deskripsi);
                showAlert('Kategori berhasil ditambahkan!');
                this.reset();
            }
            
            displayKategoris();
        });

        document.getElementById('produkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const id = document.getElementById('produkId').value;
            const nama = document.getElementById('namaProduk').value;
            const kategoriId = document.getElementById('kategoriProduk').value;
            const harga = document.getElementById('hargaProduk').value;
            const deskripsi = document.getElementById('deskripsiProduk').value;
            
            if (id) {
                // Edit mode
                if (updateProduk(parseInt(id), nama, kategoriId, harga, deskripsi)) {
                    showAlert('Produk berhasil diperbarui!');
                    cancelProdukEdit();
                } else {
                    showAlert('Gagal memperbarui produk!', 'error');
                }
            } else {
                // Add mode
                addProduk(nama, kategoriId, harga, deskripsi);
                showAlert('Produk berhasil ditambahkan!');
                this.reset();
            }
            
            displayProduks();
            displayKategoris(); // Update product count
        });

        // Edit functions
        function editKategori(id) {
            const kategori = getKategoriById(id);
            if (kategori) {
                document.getElementById('kategoriId').value = kategori.id;
                document.getElementById('namaKategori').value = kategori.nama;
                document.getElementById('deskripsiKategori').value = kategori.deskripsi;
            }
        }

        function editProduk(id) {
            const produk = getProdukById(id);
            if (produk) {
                document.getElementById('produkId').value = produk.id;
                document.getElementById('namaProduk').value = produk.nama;
                document.getElementById('kategoriProduk').value = produk.kategoriId;
                document.getElementById('hargaProduk').value = produk.harga;
                document.getElementById('deskripsiProduk').value = produk.deskripsi;
            }
        }

        // Cancel edit functions
        function cancelKategoriEdit() {
            document.getElementById('kategoriForm').reset();
            document.getElementById('kategoriId').value = '';
        }

        function cancelProdukEdit() {
            document.getElementById('produkForm').reset();
            document.getElementById('produkId').value = '';
        }

        // Delete functions
        function hapusKategori(id) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini?')) {
                if (deleteKategori(id)) {
                    showAlert('Kategori berhasil dihapus!');
                    displayKategoris();
                    updateKategoriSelect();
                }
            }
        }

        function hapusProduk(id) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                if (deleteProduk(id)) {
                    showAlert('Produk berhasil dihapus!');
                    displayProduks();
                    displayKategoris(); // Update product count
                }
            }
        }

        // Initialize
        initializeData();
        displayKategoris();
        displayProduks();
        updateKategoriSelect();
    </script>
</body>
</html>