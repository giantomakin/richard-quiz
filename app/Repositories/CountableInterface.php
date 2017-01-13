<?php
namespace App\Repositories\Interfaces;

interface CountableInterface
{

	public function count();

	public function updateCounter($id, array $count);

}

?>
