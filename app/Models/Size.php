<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:55:43
 * File: Size.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Size extends BaseModel
{
	use SoftDeletes;

    //Declare table name
    protected $table = 'sizes';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function products(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Product::class, 'ref_product_size', 'size_id', 'product_id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
