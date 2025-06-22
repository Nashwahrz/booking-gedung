@extends('template')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-md-6">
            @if ($gedung->foto)
                <img src="{{ asset('storage/' . $gedung->foto) }}" class="img-fluid rounded" alt="{{ $gedung->nama }}">
            @else
                <img src="https://via.placeholder.com/600x400?text=No+Image" class="img-fluid rounded" alt="No Image">
            @endif
        </div>
        <div class="col-md-6">
            <h2>{{ $gedung->nama }}</h2>
            <p class="text-muted">{{ $gedung->lokasi }}</p>
            <p>{{ $gedung->deskripsi }}</p>
            <p><strong>Kapasitas:</strong> {{ $gedung->kapasitas }} orang</p>
            <p><strong>Kategori:</strong> {{ $gedung->kategori->nama_kategori ?? '-' }}</p>
            <p><strong>Harga per Hari:</strong> Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}</p>

            <hr>
            <h5>Fasilitas</h5>
            <ul>
                @php $f = $gedung->fasilitas; @endphp
                @if ($f->meja) <li>Meja: {{ $f->meja }} buah</li> @endif
                @if ($f->kursi) <li>Kursi: {{ $f->kursi }} buah</li> @endif
                @if ($f->proyektor) <li>Proyektor</li> @endif
                @if ($f->wc) <li>WC</li> @endif
                @if ($f->tempat_ibadah) <li>Tempat Ibadah: {{ $f->tempat_ibadah }}</li> @endif
                @if ($f->wifi) <li>WiFi: {{ $f->wifi }}</li> @endif
                @if ($f->ac) <li>AC: {{ $f->ac }}</li> @endif
                @if ($f->lainnya) <li>Lainnya: {{ $f->lainnya }}</li> @endif
            </ul>

           <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => now()->toDateString()]) }}" class="btn btn-success">
    Booking Sekarang
</a>

            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Kembali</a>
        </div>
    </div>

    <hr>
    <h4 class="text-center my-4">Pilih Tanggal Booking</h4>

    <div class="d-flex justify-content-center mb-3">
        <form method="GET" class="d-flex align-items-center">
            <label for="bulan" class="me-2">Pilih Bulan:</label>
            <select name="bulan" id="bulan" class="form-select w-auto me-2" onchange="this.form.submit()">
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ request('bulan', now()->month) == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}</option>
                @endfor
            </select>

            <select name="tahun" id="tahun" class="form-select w-auto" onchange="this.form.submit()">
                @for ($i = now()->year; $i <= now()->year + 1; $i++)
                    <option value="{{ $i }}" {{ request('tahun', now()->year) == $i ? 'selected' : '' }}>{{ $i }}</option>
                @endfor
            </select>
        </form>
    </div>

    @php
        $bookedDates = [];
        foreach ($semua_pemesanans as $p) {
            $mulai = \Carbon\Carbon::parse($p->tanggal_mulai);
            $selesai = \Carbon\Carbon::parse($p->tanggal_selesai);
            while ($mulai <= $selesai) {
                $bookedDates[] = $mulai->toDateString();
                $mulai->addDay();
            }
        }

        $bulan = request('bulan', now()->month);
        $tahun = request('tahun', now()->year);
        $daysInMonth = \Carbon\Carbon::create($tahun, $bulan)->daysInMonth;
    @endphp

    <div class="row row-cols-2 row-cols-md-4 g-3 justify-content-center">
       @for ($i = 1; $i <= $daysInMonth; $i++)
    @php
        $tanggal = \Carbon\Carbon::create($tahun, $bulan, $i)->toDateString();
        $booked = in_array($tanggal, $bookedDates);
    @endphp
    <div class="col">
        @if (!$booked)
            <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => $tanggal]) }}" class="btn btn-success w-100">
                {{ $i }}
            </a>
        @else
            <button class="btn btn-secondary w-100" disabled>{{ $i }}</button>
        @endif
    </div>
@endfor

    </div>
</div>
@endsection
