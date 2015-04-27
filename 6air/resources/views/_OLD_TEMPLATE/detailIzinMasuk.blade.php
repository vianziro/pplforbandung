@extends('detailMasuk')

@section('content')
<div class="container documents">
		<div class="col-md-6">
		<table class="table striped responsive">
			<tbody>
			<tr>
				<td>Nama Pemohon</td>
				<td>Menori</td>
			</tr>
			<tr>
				<td>Lokasi</td>
				<td>Cimahi</td>
			</tr>
			<tr>
				<td>Jenis Izin</td>
				<td>Izin Pengelolaan Air Bawah Tanah</td>
			</tr>
			<tr>
				<td>Instansi</td>
				<td>HMIF</td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><?php
						echo $izinair->deskripsi
					?>
				</td>
			</tr>
			<tr>
				<td>Berlaku Hingga</td>
				<td>17 April 2017</td>
			</tr>
			</tbody>
		</table>
		</div>
		<div class="col-md-2"></div>
			
		<div class="col-md-2">
		
			<select name="selecter_basic" class="selecter_1">
					<option value="1">Diterima</option>
					<option value="2">Ditolak</option>
				</select><br>
		<br>
		<button type="submit" class="btn btn-primary">Ubah Status</button> </div>
	</div>
@endsection