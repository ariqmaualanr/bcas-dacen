@extends('templates.default')
@section('content')

@push('scripts')

<!-- Load jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<!-- Script untuk library Signature Pad -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>

 <!-- Gaya tambahan untuk kolom tanda tangan -->
 <style>
    #signature-pad-1 canvas,
    #signature-pad-2 canvas,
    #signature-pad-3 canvas {
        box-sizing: border-box;
       
    }

  
</style>


<div class="container">
    <div class="row">
    
        <!-- Kolom Tanggal -->
        <div class="col-md-12">
            <div class="mb-3 row">
                <label class="col-2 col-form-label required">Tanggal</label>
                <div class="col-10">
                    <input type="date" class="form-control" id="tanggal_shift" name="tanggal_shift">
                </div>
            </div>
        </div>

        @for ($i = 1; $i <= 3; $i++)
            <div class="col-md-4">
                <form class="card" id="form-shift-{{ $i }}">
                @csrf
                    <div class="card-header">
                        <h3 class="card-title">Shift {{ getShiftName($i) }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Petugas 1</label>
                            <div class="col">
                                <select class="form-select" name="petugas1-{{ $i }}">
                                    <option>Petugas yang berjaga</option>
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Petugas 2</label>
                            <div class="col">
                                <select class="form-select" name="petugas2-{{ $i }}">
                                    <option>Petugas yang berjaga</option>
                                    <option>Tidak ada petugas lain</option>
                                    @foreach($karyawans as $karyawan)
                                        <option value="{{ $karyawan->id }}">{{ $karyawan->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label required">Pekerjaan</label>
                            <div class="col">
                                <div class="mb-3">
                                    <span class="form-label-description" id="char-count-{{ $i }}">0/200</span>
                                    <textarea class="form-control" name="pekerjaan-{{ $i }}" rows="6" placeholder="Isikan pekerjaan yang sudah dilakukan.." style="height: 122px;" oninput="updateCharCount(this, {{ $i }})" maxlength="200"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-3 col-form-label">Status pekerjaan</label>
                            <div class="col">
                                <select class="form-select" name="status-{{ $i }}">
                                    <option>Pilih status pekerjaan</option>
                                    <option>Sudah Selesai</option>
                                    <option>Belum Selesai</option>
                                </select>
                            </div>
                        </div>

                        <!-- Tambahkan form tanda tangan -->
                    <div class="mb-3 row">
                        <label class="col-3 col-form-label">Tanda Tangan</label>
                        <div class="col">
                            <div id="signature-pad-{{ $i }}">
                            <canvas width="400" height="200"></canvas>
                                <button type="button" class="btn btn-warning" onclick="clearSignature({{ $i }})">Hapus Tanda Tangan</button>
                                <input type="hidden" name="signature-{{ $i }}" id="signature-input-{{ $i }}">
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="button" class="btn btn-primary" onclick="saveFormData({{ $i }})">Simpan</button>
                    </div>
                </form>

                
            </div>
        @endfor
        
        <div class="col-md-12 text-center"> <!-- tambahkan class text-center untuk memusatkan elemen -->
    <button type="button" class="btn btn-success btn-block mx-auto mt-3" onclick="submitForm()">Submit Keseluruhan</button>
</div>
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Signature Pad untuk setiap formulir setelah dokumen dimuat
    for (var i = 1; i <= 3; i++) {
        initSignaturePad(i);
    }
});

var formData = {};

function updateCharCount(textarea, index) {
    var charCount = textarea.value.length;
    var charCountElement = document.getElementById('char-count-' + index);

    if (charCountElement) {
        charCountElement.textContent = charCount + '/200';

        if (charCount > 200) {
            textarea.value = textarea.value.substring(0, 200);
        }
    }
}

// Fungsi untuk menghapus tanda tangan
function clearSignature(index) {
    var signaturePad = new SignaturePad(document.querySelector(`#signature-pad-${index} canvas`));
    signaturePad.clear();
}

// Fungsi untuk menginisialisasi Signature Pad
function initSignaturePad(index) {
    var canvas = document.querySelector(`#signature-pad-${index} canvas`);
    var signaturePad = new SignaturePad(canvas, {
        minWidth: 1,
        maxWidth: 1,
        dotSize: 0.5,
        penColor: "black"
    });

    // Set margin dan padding canvas ke 0
    canvas.style.margin = '0';
    canvas.style.padding = '0';

    // Memastikan tanda tangan bersih ketika formulir dibuka
    clearSignature(index);

    // Simpan tanda tangan sebagai gambar base64 ke input tersembunyi
    signaturePad.onEnd = function () {
        var signatureInput = document.querySelector(`#signature-input-${index}`);
        signatureInput.value = signaturePad.toDataURL();
    };
}



function saveFormData(index) {
    var petugas1 = document.querySelector(`select[name="petugas1-${index}"]`).value;
    var petugas2 = document.querySelector(`select[name="petugas2-${index}"]`).value;
    var pekerjaan = document.querySelector(`textarea[name="pekerjaan-${index}"]`).value;
    var status = document.querySelector(`select[name="status-${index}"]`).value;

    formData[index] = { petugas1, petugas2, pekerjaan, status };
}

function submitForm() {
    for (var index = 1; index <= 3; index++) {
        if (!formData[index]) {
            alert(`Simpan formulir Shift ${index} terlebih dahulu.`);
            return;
        }
    }

    var tanggalShift = document.getElementById('tanggal_shift').value;

    // Kirim data ke server menggunakan AJAX
    $.ajax({
        type: 'POST',
        url: '{{ route("handover.save") }}',
        data: {
            _token: '{{ csrf_token() }}',
            tanggal_shift: tanggalShift,
            formDataArray: formData  // Mengirim seluruh data formulir
        },
        success: function(response) {
            alert(response.message); // Tampilkan pesan sukses dari server
            // ... (tambahkan logika sesuai kebutuhan)
        },
        error: function(error) {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data.');
        },
        complete: function() {
            // Setelah submit berhasil, hapus data dari penyimpanan sementara
            formData = {};
        }
    });
}

</script>
        <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Ambil elemen dropdown dan tombol yang membukanya
                    var dropdown = document.querySelector('.nav-item.active .dropdown-menu');
                    var dropdownToggle = document.querySelector('.nav-item.active .dropdown-toggle');

                    // Tambahkan kelas 'show' ke dropdown dan tombol ketika dokumen dimuat
                    if (dropdown && dropdownToggle) {
                        dropdown.classList.add('show');
                        dropdownToggle.setAttribute('aria-expanded', 'true');
                    }
                });
        </script>

@endsection

@php
function getShiftName($index) {
    $shifts = ['Pagi', 'Siang', 'Malam'];
    return $shifts[$index - 1];
}
@endphp