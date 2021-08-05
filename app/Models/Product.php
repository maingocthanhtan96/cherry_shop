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

    const FOLDER_UPLOAD = '/uploads/products';

    //Declare table name
    protected $table = 'products';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = ['code', 'name', 'image', 'description', 'stock_in', 'stock_out', 'inventory', 'price', 'discount', 'status', 'category_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     **/
    public function category(): \Illuminate\Database\Eloquent\Relations\belongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productRejects(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductReject::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productPayments(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductPayment::class, 'product_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productDetails(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
