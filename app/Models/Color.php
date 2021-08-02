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

    

	//{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
