<?php
namespace App\Http\Controllers;

use Response;
use Auth;
use Mail;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controller;

use App\IzinAir;


class PerizinanAirController extends Controller {


	public function validasiInput(){
	
	}

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function getNewperizinan()
	{
		return view('user/newizin')->with('nav_pengajuan','');
	}
	
	
	public function postNewperizinan()
	{
		$izinair = new IzinAir;
		$izinair->id_penduduk = Auth::user()->id;
		$izinair->id_lahan	= Request::input('lahan');
		$izinair->kategori = Request::input('kategori');
		$izinair->deskripsi = Request::input('deskripsi');
		$izinair->status = "NEW";
		$izinair->ischange = 0;
		$izinair->save();
		
		return view('message')->with(array(
												'message_title' => "Sukses",
												'message_body' => "Perizinan anda berhasil dikirim",
												'message_color' => "green",
												'message_redirect' => action('PerizinanAirController@getListperizinan')
											));
	}
	
	public function getNotifikasiuser()
	{
		
		return view('home');
	}
	
	public function approveizin($id, $status)
	{
		$izinair = IzinAir::find($id);
		if ($izinair){
			if ($status == 1)
				$izinair->status = "APP";
			else
				$izinair->status = "REJ";
			
			$izinair->save();
			
			return view('message')->with(array(
					'message_title' => "Sukses",
					'message_body' => "Status perizinan sukses diubah",
					'message_color' => "green",
					'message_redirect' => action('PerizinanAirController@getHomedinas')
				));
		}else{
			return view('message')->with(array(
					'message_title' => "Error",
					'message_body' => "Perizinan gagal disetujui",
					'message_color' => "red",
					'message_redirect' => action('PerizinanAirController@getHomedinas')
				));
		}
	}
	
	public function perpanjangperizinan($id)
	{
		return view('home');
	}
	
	public function postPerpanjangperizinan()
	{
		return view('home');
	}
	
	public function ubahperizinan($id)
	{
		$izinair = IzinAir::where('id', '=', $id)->first();
		$data = $izinair->toArray();
		
		return view('user/ubahizin', $data);
	}
	
	public function postUbahperizinan()
	{
		$id = Request::input('id');
		$izinair = IzinAir::find($id);
		$izinair->deskripsi = Request::input('deskripsi');
		$izinair->save();
		return view('homeuser');
	}
	
	public function getIndex()
	{
		return view('home');
	}

	public function detailperizinanUser($id){
		$izinair = IzinAir::find($id);
		return view('user/detilizin')->with(array(
												'izinair' => $izinair,
												'nav_list' => ""));
	}
	
	public function detilperizinanDinas($id){
		$izinair = IzinAir::find($id);
		
		return view('detailIzinMasuk')->with('izinair', $izinair);
	}
	
	public function ubahstatus($id, $status){
		return $id . ' ' . $status;
	}
	
	public function getHomedinas()
	{
		$izinair = IzinAir::where('status', '=', 'NEW')->get();
		return view('dinas/home')->with(array(
												'izinair' => $izinair,
												'dinas' => "",
												'nav_masuk'=> ""));
	}
	
	public function getListperizinan()
	{
		$izinair = IzinAir::all();
		
		return view('user/listizin')->with(array(
												'izinair' => $izinair,
												'nav_list' => "")
											);
	}
	
	public function getHomeuser()
	{
		return view('public/welcome')->with('nav_home','AS');
	}
	
	public function getShowPerizinanMasuk()
	{
		$izinair = IzinAir::where('status', '=', 'NEW')->get();
		
		return view('IzinMasuk')->with('izinair', $izinair);
		
		/*$izinair = IzinAir::find(2);
		$izinair->deskripsi = 'henry';
		$izinair->save();*/
	}
	
	public function getShowPerizinanDiterima()
	{
		$izinair = IzinAir::where('status', '=', 'ACCEPT')->get();
		
		return view('IzinDiterima')->with('izinair', $izinair);
	}
}
