<?php
namespace App\Repositories\Front;

interface FrontRepositoryInterface
{

	public function find($id);

	public function findBy($field, $value);

}

?>
