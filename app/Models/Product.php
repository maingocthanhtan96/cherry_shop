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
        'category_id',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function colors(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Color::class, 'ref_product_color', 'product_id', 'color_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function sizes(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Size::class, 'ref_product_size', 'product_id', 'size_id');
    }

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

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
