@extends('template')

@section('content')
    <div class="container py-5">
        <div class="row g-5">
            {{-- FOTO GEDUNG --}}
            <div class="col-md-6">
                <div class="card shadow-sm">
                    @if ($gedung->foto)
                        <img src="{{ asset('storage/' . $gedung->foto) }}" class="card-img-top rounded"
                            alt="{{ $gedung->nama }}">
                    @else
                        <img src="https://via.placeholder.com/600x400?text=No+Image" class="card-img-top rounded"
                            alt="No Image">
                    @endif
                </div>
            </div>

            {{-- INFO GEDUNG --}}
            <div class="col-md-6">
                <div class="card shadow-sm p-4">
                    <h2 class="text-primary">{{ $gedung->nama }}</h2>
                    <p class="text-muted mb-1"><i class="bi bi-geo-alt"></i> {{ $gedung->lokasi }}</p>
                    <p>{{ $gedung->deskripsi }}</p>

                    <div class="mb-2">
                        <strong>Kapasitas:</strong> {{ $gedung->kapasitas }} orang
                    </div>
                    <div class="mb-2">
                        <strong>Kategori:</strong> {{ $gedung->kategori->nama_kategori ?? '-' }}
                    </div>
                    <div class="mb-3">
                        <strong>Harga per Hari:</strong> <span
                            class="text-success">Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</span>
                    </div>

                    <hr>
                    @php
                        $f = $gedung->fasilitas ?? null;
                    @endphp

                    <h5 class="mt-3">Fasilitas</h5>
                    <ul class="list-group list-group-flush">
                        @if ($f->meja)
                            <li class="list-group-item">🪑 Meja: {{ $f->meja }} buah</li>
                        @endif
                        @if ($f->kursi)
                            <li class="list-group-item">💺 Kursi: {{ $f->kursi }} buah</li>
                        @endif
                        @if ($f->proyektor)
                            <li class="list-group-item">📽️ Proyektor</li>
                        @endif
                        @if ($f->wc)
                            <li class="list-group-item">🚻 WC</li>
                        @endif
                        @if ($f->tempat_ibadah)
                            <li class="list-group-item">🕌 Tempat Ibadah: {{ $f->tempat_ibadah }}</li>
                        @endif
                        @if ($f->wifi)
                            <li class="list-group-item">📶 WiFi: {{ $f->wifi }}</li>
                        @endif
                        @if ($f->ac)
                            <li class="list-group-item">❄️ AC: {{ $f->ac }}</li>
                        @endif
                        @if ($f->lainnya)
                            <li class="list-group-item">🔧 Lainnya: {{ $f->lainnya }}</li>
                        @endif
                    </ul>

                    <div class="mt-4 d-flex gap-2">
                        <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => now()->toDateString()]) }}"
                            class="btn btn-success">
                            Booking Sekarang
                        </a>
                        <a href="{{ url('/') }}" class="btn btn-outline-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- TANGGAL BOOKING --}}
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
                        <option value="{{ $i }}" {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>
                            {{ $i }}</option>
                    @endfor
                </select>
            </div>
        </form>

   @php
use Carbon\Carbon;

$bookedDates = [];

foreach ($semua_pemesanans as $p) {



    // Hanya coret kalau status disetujui dan pembayaran lunas
    if (
        $p->status === 'disetujui' &&
        $p->pembayaran &&
        $p->pembayaran->status_bayar === 'lunas'
    ) {
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

{{-- Untuk debug (bisa diaktifkan kalau perlu) --}}
{{-- <pre>@foreach($bookedDates as $tgl){{ $tgl }}<br> @endforeach</pre> --}}

<div class="row row-cols-2 row-cols-sm-4 row-cols-md-6 g-2 text-center">
    @for ($i = 1; $i <= $daysInMonth; $i++)
        @php
            $tanggal = Carbon::create($tahun, $bulan, $i);
            $tglString = $tanggal->toDateString();
            $booked = in_array($tglString, $bookedDates);
            $isToday = $tanggal->isToday();
        @endphp
        <div class="col">
            @if ($booked)
                <button class="btn btn-outline-secondary w-100" disabled>
                    <s>{{ $i }}</s>
                </button>
            @elseif ($isToday)
                <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => $tglString]) }}"
                    class="btn btn-info text-white w-100 fw-bold ">
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


@endsection
