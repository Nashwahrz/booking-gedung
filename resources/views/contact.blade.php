<style>
        .contact-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }

        .contact-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(13, 110, 253, 0.05) 0%, transparent 70%);
            animation: pulse 4s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 0.3; }
            50% { transform: scale(1.1); opacity: 0.1; }
        }

        .contact-form {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            padding: 40px;
            position: relative;
            z-index: 2;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }

        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 16px;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: #1e2c3d;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
            transform: translateY(-1px);
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e2c3d 0%, #2d7a8d 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            background: linear-gradient(135deg,#2d7a8d, #1e2c3d);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 3rem;
            position: relative;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #1e2c3d,#2d7a8d);
            border-radius: 2px;
        }

        .form-floating {
            position: relative;
        }

        .form-floating input, .form-floating textarea {
            height: auto;
            padding: 1rem 0.75rem;
            border: 2px solid #e9ecef;
        }

        .form-floating label {
            padding: 1rem 0.75rem;
            color: #6c757d;
            font-weight: 500;
        }

        .form-floating input:focus ~ label,
        .form-floating textarea:focus ~ label {
            color:  #1e2c3d;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 3;
        }

        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
    </style>

   @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif



<section id="contact" class="contact-section py-5">
    <div class="container">
        <h2 class="section-title text-center">Kontak Kami</h2>
        <div class="contact-form mx-auto" style="max-width: 600px;">
            <form action="{{ route('kirim.kontak') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <div class="form-floating">
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" required>
                        <label for="nama"><i class="fas fa-user me-2"></i>Nama Pemesan</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                        <label for="email"><i class="fas fa-envelope me-2"></i>Email Pemesan</label>
                    </div>
                </div>

                <div class="mb-4">
                    <div class="form-floating">
                        <textarea name="pesan" id="pesan" class="form-control" placeholder="Pesan Anda" style="height: 120px;" required></textarea>
                        <label for="pesan"><i class="fas fa-message me-2"></i>Pesan</label>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fas fa-paper-plane me-2"></i>Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
