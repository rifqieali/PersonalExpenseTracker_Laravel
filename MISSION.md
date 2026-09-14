# Mission: PersonalExpenseTracker Laravel + Alpine.js

## Why
Lulus interview dengan membuktikan bisa membangun CRUD Laravel yang rapi dan menambahkan interaktivitas Alpine.js tanpa mengubah Blade menjadi SPA.

## Success looks like
- Menyelesaikan issue #12: klik Detail di list transaksi memunculkan modal dengan data yang benar, bisa ditutup via tombol/backdrop/Esc tanpa JS error
- Bisa menjelaskan saat interview: apa itu `x-data`/`x-show`, di mana state Alpine tinggal, kenapa data tetap dari Laravel
- Branch bernama `issue/12-detail-modal` dan lulus acceptance criteria manual browser

## Constraints
- Bahasa pengantar: Indonesia
- Pelajaran singkat, satu kemenangan kecil per lesson
- Tetap Blade render list; Alpine hanya enhancement (bukan SPA, tanpa `x-for` di issue ini)

## Out of scope
- SPA / API + frontend framework (Vue/React)
- Alpine `x-for`, `x-teleport`, fetch/AJAX untuk modal (cukup data dari Blade)
