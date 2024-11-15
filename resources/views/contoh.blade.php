<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Penjualan</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css">
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard Penjualan</h2>
        <ul>
            <li><a href="{{ url(Auth::user()->role. '/contoh') }}">Home</a></li>
                <li><a href="{{ url(Auth::user()->role.'/produk') }}">Produk</a></li>
                <li><a href="{{ url(Auth::user()->role.'/laporan') }}">Laporan</a></li>
            <li>
                <form action="{{ url('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-decoration-none bg-transparent border-0 text-white" style="font-size: 18px;" aria-label="Logout">
                        Logout
                    </button>
                </form>
            </li>
        </ul>
    </div>

    <div class="main-content">
        <header>
            <h1>Selamat Datang di Dashboard Penjualan</h1>
        </header>

        <div class="cards">
            <div class="card">
                <h3>Total Produk</h3>
                <p id="total-products">{{ $totalProducts }}</p>
            </div>

            <div class="card">
                <h3>Penjualan Hari Ini</h3>
                <p id="sales-today">{{ $salesToday }}</p>
            </div>

            <div class="card">
                <h3>Total Pendapatan</h3>
                <p id="total-revenue">Rp 50,000,000</p>
            </div>

            <div class="card">
                <h3>Pengguna Terdaftar</h3>
                <p id="registered-users">350</p>
            </div>
        </div>

        <div class="alert alert-primary" role="alert">
            Ini adalah pemberitahuan sederhana - periksa lebih lanjut!
        </div>

        {{-- Sales chart --}}
        <div id="chart">
            <h2>Grafik Penjualan Bulanan</h2>
            {!! $chart->container() !!}
        </div>
    </div>

    {{-- Ini Script untuk memanggil larapex (wajib) --}}
    <script src="{{ $chart->cdn() }}"></script>
    {{ $chart->script() }}

</body>
</html>
