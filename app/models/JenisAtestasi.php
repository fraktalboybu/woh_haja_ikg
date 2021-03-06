<?php

class JenisAtestasi extends Eloquent
{
	public $timestamps = true;
	protected $table = 'jenis_atestasi';
	
	public static $rules = 
				['nama_atestasi' => 'required',
				'tipe' => 'required',
				'keterangan' => 'required'];
	
	public $fillable = 
				['nama_atestasi',
				'tipe',
				'keterangan',				
				'deleted'];	
	
}