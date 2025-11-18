document.addEventListener('DOMContentLoaded', () => {
    // 1. Ambil Elemen DOM
    const tableBody = document.querySelector('#ipkTable tbody');
    const addCourseBtn = document.getElementById('addCourseBtn');
    const resultIPK = document.getElementById('resultIPK');

    // 2. Data Konversi Nilai
    const nilaiKonversi = {
        'A': 4.0, 'B+': 3.5, 'B': 3.0, 'C+': 2.5, 'C': 2.0, 'D': 1.0, 'E': 0.0, '-': 0.0
    };

    /**
     * Fungsi utama untuk menghitung dan menampilkan IPK.
     * Dipanggil setiap kali ada perubahan input (SKS atau Nilai).
     */
    const calculateIPK = () => {
        let totalBobot = 0; // Total (SKS * Nilai Angka)
        let totalSKS = 0;   // Total SKS

        tableBody.querySelectorAll('tr').forEach(row => {
            // Ambil SKS
            const sksInput = row.querySelector('.sks-input');
            const sks = parseFloat(sksInput ? sksInput.value : 0);

            // Ambil Nilai Huruf dan konversi ke Angka
            const nilaiSelect = row.querySelector('.nilai-select');
            const nilaiHuruf = nilaiSelect ? nilaiSelect.value : '-';
            const nilaiAngka = nilaiKonversi[nilaiHuruf] || 0;

            if (sks > 0) {
                totalBobot += sks * nilaiAngka;
                totalSKS += sks;
            }
        });

        // Hitung dan format IPK
        const ipk = totalSKS > 0 ? (totalBobot / totalSKS).toFixed(2) : '0.00';
        resultIPK.textContent = ipk;
    };

    /**
     * Fungsi untuk membuat dan menambahkan baris input Mata Kuliah baru.
     */
    const addCourseRow = () => {
        const newRow = tableBody.insertRow();
        newRow.className = "hover:bg-blue-50/50 transition";

        // 1. Kolom Nama MK
        newRow.insertCell(0).innerHTML = `<input type="text" placeholder="Nama Mata Kuliah" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 border-none w-full bg-transparent focus:ring-0">`;

        // 2. Kolom SKS
        // Event oninput di sini memanggil calculateIPK secara global
        newRow.insertCell(1).innerHTML = `<input type="number" min="1" max="6" value="3" class="sks-input text-sm text-gray-900 border-none w-16 bg-transparent focus:ring-0" oninput="window.calculateIPK()">`;

        // 3. Kolom Nilai Huruf
        const nilaiOptions = Object.keys(nilaiKonversi).map(key => `<option value="${key}">${key}</option>`).join('');
        // Event onchange di sini memanggil calculateIPK secara global
        newRow.insertCell(2).innerHTML = `
            <select class="nilai-select text-sm text-gray-900 border-none bg-transparent focus:ring-0" onchange="window.calculateIPK()">
                ${nilaiOptions}
            </select>`;

        // 4. Kolom Aksi (Hapus)
        const deleteCell = newRow.insertCell(3);
        deleteCell.className = "px-6 py-4 whitespace-nowrap text-right text-sm font-medium";
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Hapus';
        deleteBtn.className = 'text-red-600 hover:text-red-900 transition';
        deleteBtn.onclick = () => {
            newRow.remove();
            calculateIPK();
        };
        deleteCell.appendChild(deleteBtn);
    };

    // --- INISIALISASI ---

    // Tambahkan 3 baris default saat halaman dimuat
    addCourseRow();
    addCourseRow();
    addCourseRow();

    // Event Listener untuk tombol tambah (Sudah diubah ke fungsi anonim)
    addCourseBtn.addEventListener('click', () => {
        addCourseRow();
    });

    // Ekspos fungsi calculateIPK ke global window agar bisa dipanggil dari HTML (oninput/onchange)
    window.calculateIPK = calculateIPK;

    // Hitungan awal
    calculateIPK();
});