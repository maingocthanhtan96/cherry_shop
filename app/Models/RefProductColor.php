<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 22:04:24
 * File: RefProductColor.php
 */
namespace App\Models;

//{{USE_CLASS_NOT_DELETE_THIS_LINE}}

class RefProductColor extends BaseModel
{
	//{{USE_NOT_DELETE_THIS_LINE}}

    //Declare table name
    protected $table = 'ref_product_color';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'color_id',
        'product_id',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
