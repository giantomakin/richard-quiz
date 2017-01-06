<?php namespace Models\Home;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'quiz';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['title','unique_id','data', 'answer','ad', 'data_img', 'data_counter', 'type'];
}
