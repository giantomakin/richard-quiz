<?php
namespace App\Repositories\Quiz;

use App\Repositories\Interfaces\CountableInterface;
use Models\Home\Home as HomeModel;

class CountableRepository implements CountableInterface
{
	protected $home;

	public function __construct(HomeModel $home)
	{
		$this->home = $home;
	}

	public function updateCounter($id, array $count)
	{
		$quizz = $this->home->find($id);
		$quizz->data_counter = json_encode($count);
    	$quizz->save();
	}

	public function count()
	{
		return $this->home->all()->count();
	}

}
?>
