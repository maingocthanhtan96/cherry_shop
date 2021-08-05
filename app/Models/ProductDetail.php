<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 * File: ProductDetail.php
 */
namespace App\Models;



class ProductDetail extends BaseModel
{
	

    //Declare table name
    protected $table = 'product_details';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
        'price',
        'amount',
        'product_id',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function product(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
