{{--
    Tombol "Keluar" guru: dipasang sekali per halaman, tanpa mengubah tombol yang sudah ada.
    Setiap tombol/link bertuliskan "Keluar" otomatis memanggil POST /logout
    (GuruAuthController@logout), lalu guru kembali ke halaman portal.
--}}
<form id="form-logout" method="POST" action="{{ route('logout') }}" hidden>
    @csrf
</form>

<script>
    (function () {
        document.addEventListener('click', function (e) {
            var el = e.target.closest('a, button');
            if (!el || el.textContent.trim() !== 'Keluar') return;

            e.preventDefault();
            e.stopImmediatePropagation();
            document.getElementById('form-logout').submit();
        }, true);
    })();
</script>