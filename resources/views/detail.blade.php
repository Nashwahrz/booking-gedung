@extends('template')

@section('content')
<style>
    .btn-toska {
        background-color: #2a8c94;
        color: white;
        border: none;
        transition: all 0.3s ease;
    }
    .btn-toska:hover {
        background-color: #45b6b1;
        color: white;
    }
    .btn-outline-donker {
        border-color: #1e2a3a;
        color: #1e2a3a;
        transition: all 0.3s ease;
    }
    .btn-outline-donker:hover {
        background-color: #1e2a3a;
        color: white;
    }
    .list-group-item {
        background-color: #f9f9f9;
        border: none;
        padding: 0.7rem 1.2rem;
        font-size: 0.95rem;
    }
    .card-custom {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="container py-5">
    <div class="row g-5 align-items-start">
        <div class="col-md-6">
            <div class="card card-custom">
                @if ($gedung->foto)
                    <img src="{{ asset('storage/' . $gedung->foto) }}" class="img-fluid" alt="{{ $gedung->nama }}">
                @else
                    <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid" alt="No Image">
                @endif
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h2 class="fw-bold text-toska">{{ $gedung->nama }}</h2>
                <p class="text-muted mb-2"><i class="bi bi-geo-alt-fill me-1"></i>{{ $gedung->lokasi }}</p>
                <p class="mb-3">{{ $gedung->deskripsi }}</p>

                <div class="mb-2"><strong>Kapasitas:</strong> {{ $gedung->kapasitas }} orang</div>
                <div class="mb-2"><strong>Kategori:</strong> {{ $gedung->kategori->nama_kategori ?? '-' }}</div>
                <div class="mb-3">
                    <strong>Harga per Hari:</strong>
                    <span class="text-success fw-semibold">Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</span>
                </div>

                <h5 class="mt-4 fw-bold text-toska">Fasilitas</h5>
                @php $f = $gedung->fasilitas ?? null; @endphp
                <ul class="list-group list-group-flush mb-3">
                    @if ($f->meja)<li class="list-group-item">🪑 Meja: {{ $f->meja }} buah</li>@endif
                    @if ($f->kursi)<li class="list-group-item">💺 Kursi: {{ $f->kursi }} buah</li>@endif
                    @if ($f->proyektor)<li class="list-group-item">📽️ Proyektor</li>@endif
                    @if ($f->wc)<li class="list-group-item">🚻 WC</li>@endif
                    @if ($f->tempat_ibadah)<li class="list-group-item">🕌 Tempat Ibadah: {{ $f->tempat_ibadah }}</li>@endif
                    @if ($f->wifi)<li class="list-group-item">📶 WiFi: {{ $f->wifi }}</li>@endif
                    @if ($f->ac)<li class="list-group-item">❄️ AC: {{ $f->ac }}</li>@endif
                    @if ($f->lainnya)<li class="list-group-item">🔧 Lainnya: {{ $f->lainnya }}</li>@endif
                </ul>

                <div class="d-flex gap-3">
                    <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => now()->toDateString()]) }}"
                       class="btn btn-toska px-4 fw-semibold">
                        Booking Sekarang
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-outline-donker px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">
    <h4 class="text-center mb-4">📅 Pilih Tanggal Booking</h4>

    <form method="GET" class="row justify-content-center mb-4">
        <div class="col-auto">
            <select name="bulan" class="form-select" onchange="this.form.submit()">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="col-auto">
            <select name="tahun" class="form-select" onchange="this.form.submit()">
                @for ($i = now()->year; $i <= now()->year + 1; $i++)
                    <option value="{{ $i }}" {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </div>
    </form>

    <div class="row row-cols-2 row-cols-sm-4 row-cols-md-6 g-2 text-center">
        @php
            use Carbon\Carbon;
            $bookedDates = [];
            foreach ($semua_pemesanans as $p) {
                if ($p->status === 'disetujui' && $p->pembayaran && $p->pembayaran->status_bayar === 'lunas') {
                    $mulai = Carbon::parse($p->tanggal_mulai);
                    $selesai = Carbon::parse($p->tanggal_selesai);
                    while ($mulai <= $selesai) {
                        $bookedDates[] = $mulai->toDateString();
                        $mulai->addDay();
                    }
                }
            }
            $bulan = request('bulan', now()->month);
            $tahun = request('tahun', now()->year);
            $daysInMonth = Carbon::create($tahun, $bulan)->daysInMonth;
        @endphp

        @for ($i = 1; $i <= $daysInMonth; $i++)
            @php
                $tanggal = Carbon::create($tahun, $bulan, $i);
                $tglString = $tanggal->toDateString();
                $booked = in_array($tglString, $bookedDates);
                $isToday = $tanggal->isToday();
            @endphp
            <div class="col">
                @if ($booked)
                    <button class="btn btn-outline-secondary w-100" disabled><s>{{ $i }}</s></button>
                @elseif ($isToday)
                    <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => $tglString]) }}"
                       class="btn btn-info text-white w-100 fw-bold">
                        {{ $i }}
                    </a>
                @else
                    <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => $tglString]) }}"
                       class="btn btn-outline-success w-100">
                        {{ $i }}
                    </a>
                @endif
            </div>
        @endfor
    </div>
</div>
@endsection
