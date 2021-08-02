<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.php
 */
namespace App\Models;

use App\Traits\UserSignatureTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel
{
	use UserSignatureTrait;
    use SoftDeletes;

    //Declare table name
    protected $table = 'products';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'code',
        'name',
        'image',
        'description',
        'stock_in',
        'stock_out',
        'inventory',
        'price',
        'discount',
        'status',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function colors(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Color::class, 'ref_product_color', 'product_id', 'color_id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
