<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.php
 */
namespace App\Models;

use App\Traits\UserSignatureTrait;

class ProductPayment extends BaseModel
{
    use UserSignatureTrait;

    //Declare table name
    protected $table = 'product_payments';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
        'total',
        'price',
        'note',
        'product_id',
        'size_id',
        'color_id',
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
    public function size(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Size::class, 'size_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function color(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Color::class, 'color_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
