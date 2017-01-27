<?php
namespace App\Repositories\Interfaces;

interface AdsInterface
{

	public function create(array $data);

	public function getAll();

	public function delete($id);

}

?>
