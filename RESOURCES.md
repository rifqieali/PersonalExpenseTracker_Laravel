# PET + Alpine.js Resources

## Knowledge

- [Alpine.js Docs — Start Here (x-data, x-show, events)](https://alpinejs.dev/start-here)
  Fondasi resmi Alpine: state reaktif dan toggling. Gunakan untuk: semua pertanyaan x-data/x-show/@click di issue #12.
- [Alpine.js — Component: Dropdown (open/close + Escape + click.outside)](https://alpinejs.dev/component/dropdown)
  Pola resmi open/close: `@keydown.escape`, `@click.outside`. Gunakan untuk: modal/backdrop/Escape di issue #12.
- [Alpine.js — x-teleport / nesting notes](https://alpinejs.dev/directives/teleport)
  Penjelasan kenapa modal jangan disarangkan di struktur sempit. Gunakan untuk: posisi modal di luar `<table>`.
- [Laravel Blade Docs — Displaying Data / @json](https://laravel.com/docs/blade)
  Cara aman mengirim data server ke JS (`@json`, `data-*`). Gunakan untuk: jembatan Blade → Alpine.
- [Alpine.js — Essentials: Templating (x-bind / colon shorthand)](https://alpinejs.dev/essentials/templating)
  Makna `:` sebagai attribute binding dinamis. Gunakan untuk: issue #13 (`:action`), semua kasus satu-elemen-banyak-nilai.
- [Laravel Docs — CSRF Protection](https://laravel.com/docs/csrf)
  Segel `@csrf` + method spoofing `@method`. Gunakan untuk: semua form destruktif (hapus, logout), jawaban interview GET-vs-POST.
- [MDN — HTTP: Safe methods (GET/HEAD)](https://developer.mozilla.org/en-US/docs/Glossary/Safe/HTTP)
  Definisi metode aman dan idempoten. Gunakan untuk: alasan hapus/logout tidak boleh via GET.

## Wisdom (Communities)

- [Laracasts — Alpine.js discussions](https://laracasts.com/discuss)
  Komunitas Laravel yang ramah pemula. Gunakan untuk: review pola Blade + Alpine.
- [Alpine.js GitHub Discussions](https://github.com/alpinejs/alpine/discussions)
  Tempat tanya perilaku direktif resmi. Gunakan untuk: kasus x-show/x-data yang membingungkan.

## Gaps

- Belum ada video spesifik modal Blade + Alpine tanpa `x-for` yang cocok dengan repo ini.
