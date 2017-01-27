<?php namespace Models\Home;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ads';
    protected $primaryKey = 'ad_id';
    public $timestamps = false;
    protected $fillable = ['ad_content','ad_position'];
}
