<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 22:05:47
 * File: RefProductSize.php
 */
namespace App\Models;

//{{USE_CLASS_NOT_DELETE_THIS_LINE}}

class RefProductSize extends BaseModel
{
	//{{USE_NOT_DELETE_THIS_LINE}}

    //Declare table name
    protected $table = 'ref_product_size';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
    	'size_id',
        'product_id',
    ];

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
