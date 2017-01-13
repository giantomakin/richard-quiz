<?php
namespace App\Repositories\Quiz;

use App\Repositories\Interfaces\QuizInterface;
use Models\Home\Home as HomeModel;

class QuizRepository implements QuizInterface
{

	protected $home;

	public function __construct(HomeModel $home)
	{
		$this->home = $home;
	}

	public function create(array $data)
	{
		return $this->home->create($data);
	}

	public function find($id)
	{
		return $this->home->find($id);
	}

	public function findBy($att, $column)
	{
		return $this->home->where($att, $column);
	}

	public function all()
	{
		return $this->home->all();
	}

	public function delete($id)
	{
		return $this->home->destroy($id);
	}
}
?>
