<?php

function mahasiswaValidator($data)
{
	if (!isset($data['nim'])) {
		throw new ClientError('NIM harus diisi');
	} else {
		if (!is_numeric($data['nim'])) {
			throw new ClientError('NIM harus berupa angka');
		}
	}
	if (!isset($data['nama'])) {
		throw new ClientError('Nama harus diisi');
	}
	if (!isset($data['jenis_kelamin'])) {
		throw new ClientError('Jenis Kelamin harus diisi');
	}
	if (!isset($data['jurusan'])) {
		throw new ClientError('Jurusan harus diisi');
	}
	if (!isset($data['alamat'])) {
		throw new ClientError('Alamat harus diisi');
	}
	if (!isset($data['email'])) {
		throw new ClientError('Email harus diisi');
	}
	if (!isset($data['no_hp'])) {
		throw new ClientError('No HP harus diisi');
	}
}
