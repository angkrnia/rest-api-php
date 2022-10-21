<?php
class MahasiswaService
{
	private $conn;
	private $table = 'mahasiswa';

	public function __construct($db)
	{
		$this->conn = $db;
	}
	public function getAll()
	{
		$query = "SELECT * FROM $this->table";
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}
	public function getOne($id)
	{
		$query = "SELECT * FROM $this->table WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new Exception("data not found", 404);
		}

		return $stmt;
	}
	public function create($data)
	{
		$this->verifyNim($data['nim']);
		$query = "INSERT INTO $this->table VALUES (null, :nim, :nama, :jenis_kelamin, :jurusan, :alamat, :email, :no_hp)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nim', $data['nim']);
		$stmt->bindParam(':nama', $data['nama']);
		$stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
		$stmt->bindParam(':jurusan', $data['jurusan']);
		$stmt->bindParam(':alamat', $data['alamat']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->bindParam(':no_hp', $data['no_hp']);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new Exception("Data gagal ditambahkan", 500);
		}

		return $this->conn->lastInsertId();
	}
	public function update($data, $id)
	{
		$query = "UPDATE $this->table SET nim = :nim, nama = :nama, jenis_kelamin = :jenis_kelamin, jurusan = :jurusan, alamat = :alamat, email = :email, no_hp = :no_hp WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nim', $data['nim']);
		$stmt->bindParam(':nama', $data['nama']);
		$stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
		$stmt->bindParam(':jurusan', $data['jurusan']);
		$stmt->bindParam(':alamat', $data['alamat']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->bindParam(':no_hp', $data['no_hp']);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new Exception("Data gagal diubah. Id tidak ditemukan", 404);
		}

		return $stmt;
	}
	public function delete($id)
	{
		$query = "DELETE FROM $this->table WHERE id = :id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new Exception("Data gagal dihapus. Id tidak ditemukan", 404);
		}

		return $stmt;
	}
	public function verifyNim($nim)
	{
		$query = "SELECT * FROM $this->table WHERE nim = :nim";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':nim', $nim);
		$stmt->execute();

		if ($stmt->rowCount()) {
			throw new Exception("NIM sudah terdaftar", 400);
		}
	}
}
