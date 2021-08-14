<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 * File: ProductReject.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ProductReject extends BaseModel
{
	use SoftDeletes;

    //Declare table name
    protected $table = 'product_rejects';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
        'total',
        'price',
        'note',
        'product_id',
        'product_detail_id',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function product(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function productDetail(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(ProductDetail::class, 'product_detail_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
