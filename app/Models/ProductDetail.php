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
    const OUT_STOCK = 0;
    //Declare table name
    protected $table = 'product_details';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
        'price',
        'amount',
        'product_id',
        'size_id',
        'color_id',
    ];

    public static function productDetail($request)
    {
        return ProductDetail::where('product_id', $request->get('product_id'))
            ->where('color_id', $request->get('color_id'))
            ->where('size_id', $request->get('size_id'))
            ->where('amount', '>', self::OUT_STOCK)
            ->first();
    }

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productPayments(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductPayment::class, 'product_detail_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productRejects(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductReject::class, 'product_detail_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
