<?php
// app/Repositories/PostRepository.php
namespace App\Repositories\Front;

use App\Repositories\Front\HomeRepositoryInterface;
use Models\Home\Home as HomeModel;

class FrontRepository implements FrontRepositoryInterface
{
	protected $home;

	public function __construct(HomeModel $home)
	{
		$this->home = $home;
	}


	public function findBy($att, $column)
	{
		return $this->home->where($att, $column);
	}

	public function find($id)
	{
		return $this->home->find($id);
	}

}
?>
