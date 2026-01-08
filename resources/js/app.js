// ================================================
// FILE: resources/js/app.js
// FUNGSI: Entry point untuk semua JavaScript
// ================================================

// Import Bootstrap JS (untuk dropdown, modal, dll)
import * as bootstrap from "bootstrap";

// Simpan ke window agar bisa diakses global
window.bootstrap = bootstrap;

// ================================================
// CUSTOM JAVASCRIPT
// ================================================

// Flash Message Auto-dismiss
document.addEventListener("DOMContentLoaded", function () {
  // Auto close alert setelah 5 detik
  const alerts = document.querySelectorAll(".alert-dismissible");
  alerts.forEach(function (alert) {
    setTimeout(function () {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }, 5000);
  });
});

let harga = "Rp 1.259.050";
let jumlah = 1;
let subtotal = harga * jumlah; // Hasilnya akan NaN atau 0

function hitungSubtotal(row) {
    // Ambil harga dan hilangkan titik serta tulisan "Rp"
    let hargaTeks = row.querySelector('.harga').innerText;
    let hargaAngka = parseInt(hargaTeks.replace(/[^0-9]/g, ''));

    let jumlah = parseInt(row.querySelector('.jumlah-input').value);

    let subtotal = hargaAngka * jumlah;

    // Tampilkan kembali dengan format Rupiah
    row.querySelector('.subtotal').innerText = "Rp " + subtotal.toLocaleString('id-ID');
}

function updateGrandTotal() {
    let total = 0;
    document.querySelectorAll('.subtotal-elemen').forEach(el => {
        let nilai = parseInt(el.innerText.replace(/[^0-9]/g, ''));
        total += nilai;
    });
    document.getElementById('grand-total').innerText = "Rp " + total.toLocaleString('id-ID');
}
