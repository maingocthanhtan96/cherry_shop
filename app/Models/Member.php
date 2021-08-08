<?php
/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 22:02:10
 * File: Member.php
 */
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends BaseModel
{
	use SoftDeletes;

	const PREFIX_CODE = 'Member_'; // Member_01

    //Declare table name
    protected $table = 'members';
    //{{TIMESTAMPS_NOT_DELETE_THIS_LINE}}
    protected $fillable = [
        'code',
        'name',
        'sns_link',
        'is_block',
        'phone',
    ];



	/**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     **/
    public function productPayments(): \Illuminate\Database\Eloquent\Relations\hasMany
    {
        return $this->hasMany(ProductPayment::class, 'member_id', 'id');
    }

    //{{RELATIONS_NOT_DELETE_THIS_LINE}}
}
