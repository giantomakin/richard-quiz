<?php
namespace App\Repositories\Quiz;

use App\Repositories\Interfaces\AdsInterface;
use Models\Home\Ads as AdsModel;

class AdsRepository implements AdsInterface
{
	protected $ads;

	public function __construct(AdsModel $ads)
	{
		$this->ads = $ads;
	}

	public function create(array $data)
	{
		return $this->ads->create($data);;
	}

	public function getAll()
	{
		return $this->ads->paginate(10);
	}

	public function delete($id)
	{
		return $this->ads->destroy($id);
	}


}
?>
