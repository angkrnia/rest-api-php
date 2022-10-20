<?php
class UsersService
{
	private $db;
	private $table = 'users';
	public function __construct($db)
	{
		$this->db = $db;
	}
	public function getOne($id)
	{
		$query = "SELECT id, nim, full_name FROM $this->table WHERE id = :id";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new NotFoundError("user not found");
		}

		return $stmt;
	}
	public function create($data)
	{
		$this->verifyNewUser($data);
		$query = "INSERT INTO $this->table VALUES (null, :nim, :password, :full_name)";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':nim', $data['nim']);
		$stmt->bindParam(':password', $data['password']);
		$stmt->bindParam(':full_name', $data['full_name']);
		$stmt->execute();

		if (!$stmt->rowCount()) {
			throw new ClientError("user gagal ditambahkan");
		}

		return $this->db->lastInsertId();
	}
	public function verifyNewUser($user)
	{
		$query = "SELECT * FROM $this->table WHERE nim = :nim";
		$stmt = $this->db->prepare($query);
		$stmt->bindParam(':nim', $user['nim']);
		$stmt->execute();

		if ($stmt->rowCount()) {
			throw new ClientError("username sudah digunakan");
		}
	}
}
