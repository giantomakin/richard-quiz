<?php
namespace App\Repositories\Interfaces;

interface QuizInterface
{

	public function create(array $data);

	public function delete($id);

	public function find($id);

	public function findBy($field, $value);

	public function all();

	// public function paginate($perPage = 10, $columns = array('*'));
	//
	// public function update(array $data, $id);

}

?>
