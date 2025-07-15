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
    .card-custom {
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    .text-toska {
        color: #2a8c94;
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


        {{-- DETAIL GEDUNG --}}
        <div class="col-md-6">
            <div class="card card-custom p-4">
                <h2 class="fw-bold text-toska">{{ $gedung->nama }}</h2>
                <p class="text-muted mb-2"><i class="bi bi-geo-alt-fill me-1"></i>{{ $gedung->lokasi }}</p>
                <p class="mb-3">{{ $gedung->deskripsi }}</p>
  <div class="row g-3 mb-3">
                    <div class="col-6">
                        <div class="bg-white border-start border-4 border-primary rounded-3 px-3 py-2 shadow-sm">
                            <div class="text-muted small">Kapasitas</div>
                            <div class="fw-bold">{{ $gedung->kapasitas }} orang</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="bg-white border-start border-4 border-primary rounded-3 px-3 py-2 shadow-sm">
                            <div class="text-muted small">Kategori</div>
                            <div class="fw-bold">{{ $gedung->kategori->nama_kategori ?? '-' }}</div>
                        </div>
                    </div>
                </div>
               <div class="mb-4">
    <div class="bg-light border-start border-5 border-success rounded-3 px-4 py-3 mb-3">
        <h6 class="text-muted mb-1">Harga per Hari</h6>
        <h2 class="text-success fw-bold mb-0">
            Rp{{ number_format($gedung->harga_per_hari, 0, ',', '.') }}
        </h2>
    </div>
    <div class="bg-light border-start border-5 border-info rounded-3 px-4 py-3">
        <h6 class="text-muted mb-1">Harga per Jam</h6>
        <h3 class="text-info fw-bold mb-0">
            Rp{{ number_format($gedung->harga_per_jam, 0, ',', '.') }}
        </h3>
    </div>
</div>


                <h5 class="mt-4 fw-bold text-toska">Fasilitas</h5>
                @php $f = $gedung->fasilitas ?? null; @endphp
                <div class="row g-2 mb-3">
                    @if ($f->meja)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">🏋</span>
                                <small>Meja: {{ $f->meja }} buah</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->kursi)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">💺</span>
                                <small>Kursi: {{ $f->kursi }} buah</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->proyektor)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">📟</span>
                                <small>Proyektor</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->wc)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">🛫</span>
                                <small>WC</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->tempat_ibadah)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">🌎</span>
                                <small>Tempat Ibadah: {{ $f->tempat_ibadah }}</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->wifi)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">📶</span>
                                <small>WiFi: {{ $f->wifi }}</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->ac)
                        <div class="col-6">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">❄</span>
                                <small>AC: {{ $f->ac }}</small>
                            </div>
                        </div>
                    @endif
                    @if ($f->lainnya)
                        <div class="col-12">
                            <div class="bg-white border rounded p-2 shadow-sm d-flex align-items-center gap-2">
                                <span class="fs-4">🔧</span>
                                <small>Lainnya: {{ $f->lainnya }}</small>
                            </div>
                        </div>
                    @endif
                </div>




                <div class="d-flex gap-3">
                    <a href="#tgl_booking" class="btn btn-toska px-4 fw-semibold">
                        Booking Sekarang
                    </a>
                    <a href="{{ url('/') }}" class="btn btn-outline-donker px-4">Kembali</a>
                </div>
            </div>
        </div>
    </div>
{{-- @endsection --}}


    <hr class="my-5">
   <h4 class="text-center mb-4" id="tgl_booking">
  <span class="px-4 py-2 shadow-sm rounded-pill" style="background-color: #e0f7f7; color: #0f5f5f;">
    <i class="bi bi-calendar-event-fill me-2"></i>
    Pilih Tanggal Booking
  </span>
</h4>




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
    $tanggalBertanda = [];

    foreach ($semua_pemesanans as $p) {
        if ($p->status === 'disetujui' && $p->pembayaran && $p->pembayaran->status_bayar === 'lunas') {
            $mulai = Carbon::parse($p->tanggal_mulai);
            $selesai = Carbon::parse($p->tanggal_selesai);
            $status = ($p->durasi >= 24) ? 'seharian' : 'sebagian';

            while ($mulai <= $selesai) {
                $tglStr = $mulai->toDateString();
                // Kalau sudah ada tanda 'seharian', jangan timpa dengan 'sebagian'
                if (!isset($tanggalBertanda[$tglStr]) || $status === 'seharian') {
                    $tanggalBertanda[$tglStr] = $status;
                }
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
        $status = $tanggalBertanda[$tglString] ?? null;
        $isToday = $tanggal->isToday();
    @endphp
    <div class="col">
        @if ($status === 'seharian')
            <button class="btn btn-outline-secondary w-100" disabled><s>{{ $i }}</s></button>
       @elseif ($status === 'sebagian')
    <a href="{{ route('booking.form', ['gedung' => $gedung->id, 'tanggal' => $tglString]) }}"
       class="btn btn-warning text-dark w-100 fw-bold">
        {{ $i }}
    </a>

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
    <div class="mt-4">
    <strong>Keterangan:</strong>
    <ul class="small">
        <li><s>Tanggal dicoret</s> = Booking seharian (24 jam)</li>
        <li><span class="badge bg-warning text-dark">Kuning</span> = Booking sebagian hari</li>
        <li><span class="badge bg-info text-dark">Biru</span> = Hari ini</li>
    </ul>
</div>

</div>
@endsection
