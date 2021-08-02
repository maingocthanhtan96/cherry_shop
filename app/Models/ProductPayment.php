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
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
