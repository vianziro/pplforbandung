@extends('app')

@if(Session::has('user'))
    @section('guest')
    <ul class="nav navbar-nav">
        <li><a href="{{URL::route('home')}}">Beranda</a></li>
        <li><a href="{{URL::route('form_permohonan')}}">Ajukan Permohonan</a></li>
        <li class="active"><a href="{{URL::route('daftar_permohonan')}}">Daftar Permohonan</a></li>
        <li><a href="{{URL::route('daftar_izin')}}">Daftar Izin</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Selamat Datang {{Session::get('user')->nama_penduduk}}</a></li>
        <li><a href="{{URL::route('logoutsso')}}">Logout</a></li>
    </ul>
    @stop

    @section('content')
    <br> <br> <br>
    <div class="container">
        <table class="table">
            <thead>
              <tr>
                <th>ID Pemohon</th>
                <th>Lokasi Tanah</th>
                <th>Biaya Retribusi</th>
                <th>Kontrak</th>
                <th>Status Permohonan</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
            	@foreach($permohonans as $permohonan)
            	<tr>
            		<td>{{ $permohonan->id_pemohon  }}</td>
            		<td>{{ $permohonan->lokasi_tanah  }}</td>
            		<td>{{ $permohonan->biaya_retribusi  }}</td>
            		<td>{{ $permohonan->tanggal_dibuat  }} hingga {{ $permohonan->tanggal_expired  }}</td>
            		<td>{{ $permohonan->status_permohonan  }}</td>
            		<td>
                        @if($permohonan->status_permohonan == "Menunggu Validasi")
                            <div class="col-sm-3">
                            {!! Form::open(['route' => 'editPermohonan']) !!}
                                {!! Form::hidden('id', $permohonan->id) !!}
                                <button class="btn btn-sm btn-info">Edit</button>
                            {!! Form::close() !!}
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-sm btn-info" href="#" onclick="deleteFunction({{ $permohonan->id }}); return false();">Hapus</button>
                            </div>
                        @elseif($permohonan->status_permohonan == "Menunggu Pembayaran Retribusi")
                            {!! Form::open(['route' => 'bayarRetribusi']) !!}
                                {!! Form::hidden('id', $permohonan->id) !!}
                                <button class="btn btn-sm btn-info">Bayar Retribusi</button>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @stop

    @section('script')
    <script type="text/javascript">
        function deleteFunction(ID){ 
            if (confirm("Delete Post?")){
                location.href='delete_permohonan/' + ID ;
            }
        }
    </script>
    @stop
@else
    {{Redirect::route('home')}}
@endif

@endsection