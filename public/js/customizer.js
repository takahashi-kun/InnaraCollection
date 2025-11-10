/**
 * Logika Kustomisasi Kaos 2D
 * Fitur:
 * 1. Mengambil data kustomisasi (Warna, Bahan, Ukuran) dari simulasi Database.
 * 2. Mengubah gambar kaos (Tshirt Base) berdasarkan pilihan warna.
 * 3. Drag-and-drop dan resize gambar sablon (Decal).
 * 4. Menyimpan konfigurasi.
 */

// Konstanta & Elemen DOM
const tshirtBase = document.getElementById('tshirt-base');
const colorListContainer = document.getElementById('colorList');
const colorSearchInput = document.getElementById('colorSearch');
const decalArea = document.getElementById('decal-area');
const fileInput = document.getElementById('fileInput');

const BASE_IMG_PATH = tshirtBase ? tshirtBase.dataset.basePath : '/images/kaos/';

// --- SIMULASI DATA DARI DATABASE (untuk Warna, Bahan, Ukuran) ---
const customOptions = {
    colors: [
        { name: 'Putih', hex: '#FFFFFF', file: 'base_putih.png' },
        { name: 'Hitam', hex: '#212121', file: 'base_hitam.png' },
        { name: 'Merah Cabe', hex: '#CC333D', file: 'base_merah.png' },
        { name: 'Biru Navy', hex: '#1D2A4B', file: 'base_navy.png' },
        { name: 'Hijau Army', hex: '#4B5320', file: 'base_army.png' },
        { name: 'Abu Misty', hex: '#BDBDBD', file: 'base_abu.png' },
        { name: 'Pink Muda', hex: '#EEA5C5', file: 'base_pink.png' },
    ],
    materials: ['Cotton Combed', 'Polyester', 'Nylon', 'Cotton Carded', 'Spandex'],
    sizes: ['XS', 'S', 'M', 'L', 'XL', 'XXL'],
};

// --- FUNGSI UTAMA ---

/**
 * 1. Mengganti gambar kaos berdasarkan pilihan warna.
 * @param {string} colorFile Nama file gambar kaos (misal: 'base_merah.png').
 * @param {string} colorName Nama warna.
 */
function applyTshirtColor(colorFile, colorName) {
    if (tshirtBase) {
        tshirtBase.src = `${BASE_IMG_PATH}/${colorFile}`;
        // Hapus class 'active' dari semua tombol warna
        document.querySelectorAll('.swatch-color').forEach(el => el.classList.remove('active'));
        // Cari dan tambahkan class 'active' pada tombol yang dipilih (dijalankan di handleColorClick)
    }
    console.log(`Warna kaos diubah menjadi: ${colorName}`);
}

/**
 * 2. Mengisi opsi warna dari data simulasi/database.
 */
function renderColorOptions(colors) {
    if (!colorListContainer) return;

    colorListContainer.innerHTML = '';
    colors.forEach(color => {
        const link = document.createElement('a');
        link.href = '#';
        link.className = 'swatch-color';
        link.style.backgroundColor = color.hex;
        link.dataset.file = color.file;
        link.dataset.name = color.name;
        link.title = color.name;

        // Terapkan warna Putih sebagai default 'active'
        if (color.name === 'Putih') {
            link.classList.add('active');
        }

        link.addEventListener('click', (e) => {
            e.preventDefault();
            // Ganti gambar kaos
            applyTshirtColor(color.file, color.name);

            // Update status active
            document.querySelectorAll('.swatch-color').forEach(el => el.classList.remove('active'));
            link.classList.add('active');
        });
        colorListContainer.appendChild(link);
    });
}

/**
 * 3. Menangani filter pencarian warna.
 */
function handleColorSearch() {
    const query = colorSearchInput.value.toLowerCase();
    const filteredColors = customOptions.colors.filter(color =>
        color.name.toLowerCase().includes(query)
    );
    renderColorOptions(filteredColors);
}

// --- LOGIKA SABLON (DECAL) DRAG AND DROP ---

let currentDecal = null;

/**
 * Membuat elemen sablon baru (Decal)
 */
function createDecalElement(src) {
    if (currentDecal) {
        currentDecal.remove(); // Hapus sablon lama jika ada
    }

    const decal = document.createElement('img');
    decal.id = 'currentDecal';
    decal.src = src;
    decal.style.position = 'absolute';
    decal.style.top = '50%';
    decal.style.left = '50%';
    decal.style.transform = 'translate(-50%, -50%)'; // Untuk centering awal
    decal.style.width = '25%'; // Ukuran awal relatif
    decal.style.height = 'auto';
    decal.style.cursor = 'move';
    decal.style.zIndex = 10;
    decal.setAttribute('data-x', 0);
    decal.setAttribute('data-y', 0);

    decalArea.appendChild(decal);
    currentDecal = decal;

    // Aktifkan interaksi drag & resize
    makeDraggableAndResizable(decal);
}

/**
 * Menangani unggahan file sablon.
 */
function handleFileUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            createDecalElement(e.target.result);
            // Hapus placeholder teks
            const placeholder = decalArea.querySelector('p');
            if (placeholder) placeholder.style.display = 'none';
        };
        reader.readAsDataURL(file);
    }
}


/**
 * Mengaktifkan fungsionalitas drag dan resize menggunakan interact.js.
 * @param {HTMLElement} element Elemen sablon (decal) yang akan diinteraksikan.
 */
function makeDraggableAndResizable(element) {
    interact(element)
        .draggable({
            // keep the element within the bounds of the decal-area
            modifiers: [
                interact.modifiers.restrictRect({
                    restriction: 'parent'
                })
            ],
            inertia: true,
            onmove: dragMoveListener
        })
        .resizable({
            // resize from all edges and corners
            edges: { left: true, right: true, bottom: true, top: true },

            // keep the edges inside the parent
            modifiers: [
                interact.modifiers.restrictEdges({
                    outer: 'parent',
                    endOnly: true
                }),

                // minimum size
                interact.modifiers.restrictSize({
                    min: { width: 50, height: 50 }
                })
            ],

            inertia: true
        })
        .on('resizemove', function(event) {
            let target = event.target;
            let x = (parseFloat(target.getAttribute('data-x')) || 0);
            let y = (parseFloat(target.getAttribute('data-y')) || 0);

            // update the element's style
            target.style.width = event.rect.width + 'px';
            target.style.height = event.rect.height + 'px';

            // translate when resizing from top or left edges
            x += event.deltaRect.left;
            y += event.deltaRect.top;

            target.style.transform = 'translate(' + x + 'px, ' + y + 'px)';

            target.setAttribute('data-x', x);
            target.setAttribute('data-y', y);
        });

    /**
     * Listener untuk pergerakan (drag)
     */
    function dragMoveListener(event) {
        const target = event.target;
        // keep the dragged position in the data-x/data-y attributes
        const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
        const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

        // translate the element
        target.style.transform = `translate(${x}px, ${y}px)`;

        // update the position attributes
        target.setAttribute('data-x', x);
        target.setAttribute('data-y', y);
    }

    // Initial centering fix for drag
    element.style.top = '';
    element.style.left = '';
    element.style.transform = '';
}


// --- FUNGSI SAVE/SIMPAN ---

function saveConfig() {
    // 1. Ambil Data Kaos
    const selectedColorEl = document.querySelector('#colorList .swatch-color.active');
    const selectedBahanEl = document.querySelector('#bahanOptions .swatch-size.active');
    const selectedSizeEl = document.querySelector('#sizeOptions .swatch-size.active');

    const configData = {
        color: selectedColorEl ? selectedColorEl.dataset.name : 'Unknown',
        bahan: selectedBahanEl ? selectedBahanEl.dataset.value : 'Cotton Combed',
        size: selectedSizeEl ? selectedSizeEl.dataset.value : 'L',

        decal: {
            // Cek apakah ada decal yang terpasang
            isApplied: !!currentDecal,
            position: currentDecal ? {
                x: parseFloat(currentDecal.getAttribute('data-x')),
                y: parseFloat(currentDecal.getAttribute('data-y')),
                width: currentDecal.style.width,
                height: currentDecal.style.height,
                src: currentDecal.src // Dalam proyek nyata, ini akan menjadi URL server
            } : null
        }
    };

    console.log('Konfigurasi Disimpan:', configData);

    // TODO: Di sini Anda akan melakukan AJAX/Fetch Request ke endpoint Laravel Anda
    // Contoh:
    /*
    fetch('/api/save-config', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content // Pastikan ada meta tag CSRF
        },
        body: JSON.stringify(configData)
    })
    .then(response => response.json())
    .then(data => {
        alert('Konfigurasi berhasil disimpan!');
        // Redirect atau update UI
    })
    .catch(error => {
        console.error('Error saving config:', error);
        alert('Gagal menyimpan konfigurasi.');
    });
    */

    // Menggunakan alertBox kustom (sesuai instruksi)
    alertBox('Konfigurasi berhasil disimpan! Lihat di console untuk detail data.');
}

/**
 * Fungsi Pengganti Alert()
 */
function alertBox(message) {
    const box = document.createElement('div');
    box.style.cssText = `
        position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
        background: #28a745; color: white; padding: 20px 30px; border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.2); z-index: 9999; text-align: center;
        opacity: 0; transition: opacity 0.3s ease-in-out;
    `;
    box.textContent = message;
    document.body.appendChild(box);

    setTimeout(() => { box.style.opacity = 1; }, 10);
    setTimeout(() => { box.style.opacity = 0; }, 2000);
    setTimeout(() => { box.remove(); }, 2300);
}


// --- INICIALISASI ---
document.addEventListener('DOMContentLoaded', () => {
    // 1. Render opsi warna
    renderColorOptions(customOptions.colors);

    // 2. Event Listener untuk Warna
    colorSearchInput.addEventListener('input', handleColorSearch);

    // 3. Event Listener untuk Upload Sablon
    fileInput.addEventListener('change', handleFileUpload);

    // 4. Event Listener untuk tombol Simpan
    document.getElementById('saveConfigBtn').addEventListener('click', saveConfig);

    // 5. Event Listener untuk Material, Size, Ketebalan (hanya untuk visual active state)
    document.querySelectorAll('.js-filter').forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();
            const type = el.dataset.type;
            // Hapus active dari semua yang sejenis
            document.querySelectorAll(`[data-type="${type}"]`).forEach(btn => btn.classList.remove('active'));
            // Tambahkan active pada yang diklik
            el.classList.add('active');
        });
    });

    // 6. Terapkan warna default (Putih)
    applyTshirtColor('base_putih.png', 'Putih');
});