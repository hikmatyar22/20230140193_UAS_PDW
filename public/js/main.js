// public/js/main.js

document.addEventListener('DOMContentLoaded', function() {
    // Contoh: Menampilkan pesan alert ketika sebuah tombol diklik
    const myButton = document.getElementById('myButton');
    if (myButton) {
        myButton.addEventListener('click', function() {
            alert('Tombol diklik!');
        });
    }

    // Contoh: Fungsi untuk toggle visibility sebuah elemen (misal: modal)
    window.toggleVisibility = function(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.classList.toggle('hidden'); // Membutuhkan kelas 'hidden' dari Tailwind CSS
        }
    };

    // Fungsi untuk mengkonfirmasi penghapusan (digunakan di form asisten)
    window.confirmDelete = function(formId, itemName) {
        if (confirm('Apakah Anda yakin ingin menghapus ' + itemName + '?')) {
            document.getElementById(formId).submit();
        }
    }
});