<?php
namespace App\Repositories\Home;

interface HomeRepositoryInterface
{

    // public function paginate($perPage = 10, $columns = array('*'));

	public function create(array $data);

    // public function update(array $data, $id);

	public function delete($id);

	public function find($id);

	public function findBy($field, $value);

	public function all();

	public function count();
}

?>
