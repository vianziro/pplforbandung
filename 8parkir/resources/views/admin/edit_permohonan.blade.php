@extends('app')

@section('admin')
<ul class="nav navbar-nav">
    <li><a href="{{URL::route('admin/home')}}">Beranda</a></li>
    <li class="active"><a href="{{URL::route('admin/daftar_permohonan')}}">Daftar Permohonan</a></li>
    <li><a href="{{URL::route('admin/daftar_izin')}}">Daftar Perizinan</a></li>
    <li><a href="laporan">Laporan</a></li>
</ul>
<ul class="nav navbar-nav navbar-right">
    <li><a href="#">welcome {{$admin->name}}</a></li>
    <li><a href="logout">Logout</a></li>
</ul>
@stop

@section('content')
<br> <br> <br>
<div class="container">
    <div class="row">
        {!! Form::open(['route' => 'admin/updatePermohonan', 'role' => 'form', 'files' => 'true']) !!}
            <div class="col-lg-6">
                <div class="well well-sm"><strong>Permohonan Izin</strong></div>    
                <div class="form-group">
                    {!! Form::label('email_pemohon', 'Alamat Email:')!!}
                    <div class="input-group">
                        {!! Form::text('email_pemohon', $permohonan->email_pemohon,  ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('id_pemohon', 'No ID Pemohon:') !!}
                    <div class="input-group">
                        {!! Form::text('id_pemohon', $permohonan->id_pemohon, ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('id_surat_tanah', 'No Surat Tanah:') !!}
                    <div class="input-group">
                        {!! Form::text('id_surat_tanah', $permohonan->id_surat_tanah, ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('jenis_pemohon', 'Organisasi Pemohon:') !!}
                    <div class="input-group">
                        {!! Form::select('jenis_pemohon', ['Organisasi' => 'Organisasi', 'Perorangan' => 'Perorangan'] , $permohonan->jenis_pemohon ,['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('jenis_permohonan', 'Jenis Permohonan:') !!}
                    <div class="input-group">
                        {!! Form::select('jenis_permohonan', ['Parkir' => 'Parkir', 'Terminal' => 'Terminal'] , $permohonan->jenis_permohonan ,['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('lokasi_tanah', 'Lokasi Tanah:') !!}
                    <div class="input-group">
                        {!! Form::text('lokasi_tanah', $permohonan->lokasi_tanah, ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tanggal_dibuat', 'Tanggal Mulai Kontrak:') !!}
                    <div class="input-group">
                        {!! Form::input('date', 'tanggal_dibuat', $permohonan->tanggal_dibuat, ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('tanggal_expired', 'Tanggal Selesai Kontrak:') !!}
                    <div class="input-group">
                        {!! Form::input('date', 'tanggal_expired', $permohonan->tanggal_expired, ['class' => 'form-control', 'required', 'readonly']) !!}
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('lampiran', 'Lampiran Surat Izin Mendirikan Bangunan:') !!}
                    <div class="input-group">
                        <a href="{{URL::route('downloadLampiran',[$permohonan->lampiran])}}" class="btn btn-info"}>Unduh Lampiran</a>
                    </div>
                </div>
                {!! Form::hidden('id', $permohonan->id) !!}
                <div class="well well-sm"><strong><span class="glyphicon glyphicon-asterisk"></span>Wajib Diisi</strong></div>
                {!! Form::submit('Entri Pengaduan', ['class' => 'btn btn-info pull-right']) !!}
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    {!! Form::label('biaya_retribusi', 'Biaya Retribusi:')!!}
                    <div class="input-group">
                        @if($permohonan->bukti_pembayaran == "")
                            {!! Form::text('biaya_retribusi', $permohonan->biaya_retribusi,  ['class' => 'form-control', 'required']) !!}
                        @else
                            {!! Form::text('biaya_retribusi', $permohonan->biaya_retribusi,  ['class' => 'form-control', 'required', 'readonly']) !!}
                        @endif
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
                @if($permohonan->bukti_pembayaran != "")
                <div class="form-group">
                    {!! Form::label('bukti_pembayaran', 'Bukti Pembayaran:') !!}
                    <div class="input-group">
                        <a href="{{URL::route('downloadBuktiPembayaran',[$permohonan->bukti_pembayaran])}}" class="btn btn-info"}>Unduh Bukti Pembayaran</a>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    {!! Form::label('status_permohonan', 'Status Permohonan')!!}
                    <div class="input-group">
                        @if($permohonan->bukti_pembayaran == "")
                            {!! Form::select('status_permohonan', array('Menunggu Validasi' => 'Menunggu Validasi','Menunggu Pembayaran Retribusi' => 'Menunggu Pembayaran Retribusi' , 'Selesai' => 'Selesai'), 
                            $permohonan->status_permohonan,  ['class' => 'form-control', 'required']) !!}
                        @else
                            {!! Form::select('status_permohonan', array('Menunggu Pembayaran Retribusi' => 'Menunggu Pembayaran Retribusi' , 'Selesai' => 'Selesai'), 
                            $permohonan->status_permohonan,  ['class' => 'form-control', 'required']) !!}
                        @endif
                        <span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection