<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 * File: Color.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends BaseModel
{
	use SoftDeletes;

    //Declare table name
    protected $table = 'colors';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'name',
    ];

    

	/**
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     **/
    public function products(): \Illuminate\Database\Eloquent\Relations\belongsToMany
    {
        return $this->belongsToMany(Product::class, 'ref_product_color', 'color_id', 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productPayments(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductPayment::class, 'color_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productDetails(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductDetail::class, 'color_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
