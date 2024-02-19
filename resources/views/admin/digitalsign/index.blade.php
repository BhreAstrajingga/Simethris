@extends('layouts.admin')
@section('styles')
@endsection
@section('content')
	@include('partials.subheader')
	@include('partials.sysalert')
	<form action="{{route('digisign.saveQrImage')}}" method="post">
		@csrf
		<div class="row">
				<div class="col-md-7">
					<div class="panel" id="panel-1">
						<div class="panel-hdr">
							<h2>
								Data <span class="fw-300">
									<i>Isian</i>
								</span>
							</h2>
							<div class="panel-toolbar">
								{{-- @include('partials.globaltoolbar') --}}
							</div>
						</div>
						<div class="panel-container">
							<div class="panel-content">
								<div class="form-group">
									<label for="">Nama Pejabat</label>
									<input type="text" name="nama_pejabat" id="nama_pejabat" class="form-control" placeholder="Nama Pejabat" aria-describedby="helpId">
									<small id="helpId" class="text-muted">Isi dengan nama pejabat penandatangan</small>
								</div>
								<div class="form-group">
									<label for="">Nomor Induk Pegawai</label>
									<input type="text" name="nip" id="nip" class="form-control" placeholder="nomor induk pegawai" aria-describedby="helpId">
									<small id="helpId" class="text-muted">Isi dengan NIP (Nomor Induk Pegawai) penandatangan</small>
								</div>
								<div class="form-group">
									<label for="">Security Code Generator</label>
									<input type="text" name="secCode" id="secCode" class="form-control" placeholder="Secure Code Generator" aria-describedby="helpId" readonly required>
									<small id="helpId" class="text-muted">Isi dengan NIP (Nomor Induk Pegawai) penandatangan</small>
								</div>
								<button id="generateQr">Generate</button>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-5">
					<div class="panel" id="panel-1">
						<div class="panel-hdr">
							<h2>
								QRCode
								<span class="fw-300">
									<i>Image</i>
								</span>
							</h2>
							<div class="panel-toolbar">
								{{-- @include('partials.globaltoolbar') --}}
							</div>
						</div>
						<div class="panel-container">
							<div class="panel-content text-center">
								<canvas id="generatedQr"></canvas> <br>
								<input class="help-block" id="pathToImg" name="imgpath">
							</div>
							<div class="panel-content">
								<button type="submit">Simpan</button>
							</div>
						</div>
					</div>
				</div>
		</div>
	</form>
@endsection

<!-- start script for this page -->
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrious@4.0.2/dist/qrious.min.js"></script>
	@parent
	<script>
		// Fungsi untuk menghasilkan QR Code
		function generateQRCode() {
			// Ambil nilai dari input nama_pejabat dan nip
			var namaPejabat = document.getElementById('nama_pejabat').value;
			var nip = document.getElementById('nip').value;

			// Buat teks yang akan dijadikan sebagai data QR Code
			var qrData = "Nama Pejabat: " + namaPejabat + "\nNIP: " + nip;

			// Buat instance QR Code
			var qr = new QRious({
				element: document.getElementById('generatedQr'),
				value: qrData,
				size: 200 // Ubah ukuran sesuai kebutuhan Anda
			});
		}

		// Fungsi untuk menghasilkan nama berkas acak
		function generateFileName() {
			var randomNumber = Math.floor(10000000 + Math.random() * 90000000); // Menghasilkan angka acak 8 digit
			return "Qr_" + randomNumber + ".png";
		}

		// Fungsi untuk menyimpan QR Code sebagai berkas PNG
		function saveQRCode() {
			var canvas = document.getElementById('generatedQr');
			var fileName = generateFileName();

			// Konversi elemen canvas ke gambar PNG
			var dataURL = canvas.toDataURL('image/png');

			// Buat elemen <a> untuk mengunduh berkas
			var a = document.createElement('a');
			a.href = dataURL;
			// a.download = fileName;

			// Klik elemen <a> untuk mengunduh berkas
			a.click();
			// Tampilkan alamat penyimpanan dalam elemen <span>
			var pathToImg = "img/qrcode/" + fileName;
			document.getElementById('pathToImg').value = pathToImg;
		}

		// Tambahkan event listener pada tombol Generate QR Code
		document.getElementById('generateQr').addEventListener('click', function () {
			generateQRCode();
			saveQRCode();
		});

		// Tambahkan event listener pada tombol Simpan QR Code
		document.getElementById('saveQr').addEventListener('click', saveQRCode);
	</script>

	<script>
		function saveCanvasAsImage() {
			var canvas = document.getElementById('generatedQr');
			var imageData = canvas.toDataURL('image/png');

			fetch('/digisign/saveQrImage', {
				method: 'POST',
				body: JSON.stringify({ imageData: imageData }),
				headers: {
					'Content-Type': 'application/json'
				}
			})
			.then(response => response.json())
			.then(data => {
				// Handle response from the server, which may include the file path
				if (data.filePath) {
					// Do something with the file path, for example, display it to the user
					console.log('File saved at: ' + data.filePath);
				}
			})
			.catch(error => {
				console.error('Error saving the QR code: ' + error);
			});
		}
	</script>

@endsection
