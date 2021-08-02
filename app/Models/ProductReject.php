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
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
