<?php

function mahasiswaValidator($data)
{
	if (!isset($data['nim'])) {
		throw new Exception('NIM harus diisi', 400);
	} else {
		if (!is_numeric($data['nim'])) {
			throw new Exception('NIM harus berupa angka', 400);
		}
	}
	if (!isset($data['nama'])) {
		throw new Exception('Nama harus diisi', 400);
	}
	if (!isset($data['jenis_kelamin'])) {
		throw new Exception('Jenis Kelamin harus diisi', 400);
	}
	if (!isset($data['jurusan'])) {
		throw new Exception('Jurusan harus diisi', 400);
	}
	if (!isset($data['alamat'])) {
		throw new Exception('Alamat harus diisi', 400);
	}
	if (!isset($data['email'])) {
		throw new Exception('Email harus diisi', 400);
	}
	if (!isset($data['no_hp'])) {
		throw new Exception('No HP harus diisi', 400);
	}
}
