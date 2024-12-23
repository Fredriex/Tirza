<nav class="navbar navbar-expand-lg navbar-light bg-warning">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Tirza Salon</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link {{ $active === 'home' ? 'active' : '' }}" href="/">Home</a></li>
                <li class="nav-item"><a class="nav-link {{ $active === 'treatment' ? 'active' : '' }}" href="/treatment">Data Treatment</a></li>
                <li class="nav-item"><a class="nav-link {{ $active === 'karyawan' ? 'active' : '' }}" href="/karyawan">Data Karyawan</a></li>
                <li class="nav-item"><a class="nav-link {{ $active === 'komisi' ? 'active' : '' }}" href="/komisi">Komisi</a></li>
                <li class="nav-item"><a class="nav-link {{ $active === 'transaksi' ? 'active' : '' }}" href="/transaksi">Buat Transaksi</a></li>
                <li class="nav-item"><a class="nav-link {{ $active === 'dataTransaksi' ? 'active' : '' }}" href="/dataTransaksi">Data Transaksi</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle  id="keuanganDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Keuangan</a>
                    <ul class="dropdown-menu" aria-labelledby="keuanganDropdown">
                        <li><a class="dropdown-item nav-link {{ $active === 'pemasukan' ? 'active' : '' }}" href="/pemasukan">Pemasukan</a></li>
                        <li><a class="dropdown-item nav-link {{ $active === 'pengeluaran' ? 'active' : '' }}" href="/pengeluaran">Pengeluaran</a></li>
                    </ul>
                </li>
            </ul>
            @if(isset($user))
                <div class="user-info d-flex align-items-center">
                    <p class="mb-0"><strong>{{ $user->name }}</strong> ({{ $user->role }})</p>
                </div>
                @endif
                <form action="/logout" method="POST" class="d-inline ms-3">
                    @csrf
                    <button type="submit" class="btn btn-logout btn-sm nav-link text-danger border-0 d-flex align-items-center">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
        </div>
    </div>
</nav>
