<?php
namespace App\Mail;

use App\Models\Pemesanan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PemesananDisetujui extends Mailable
{
    use Queueable, SerializesModels;

    public $pemesanan;

    public function __construct(Pemesanan $pemesanan)
    {
        $this->pemesanan = $pemesanan;
    }

    public function build()
    {
        return $this->subject('Pemesanan Gedung Anda Disetujui')
                    ->view('emails.pemesanan_disetujui');
    }
}
