const icon = document.querySelector('.icon-list');
const sidebar = document.querySelector('.sidebar');

// Menambahkan event listener untuk klik pada gambar
icon.addEventListener('click', function() {
  // Toggle kelas 'hidden' pada elemen sidebar
  sidebar.classList.toggle('hidden');
});