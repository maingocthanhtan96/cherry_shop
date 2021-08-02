<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:55:43
 * File: Size.php
 */

namespace App\Repositories\Size;

use App\Models\Size;
use App\Repositories\EloquentRepository;

class SizeRepository extends EloquentRepository implements SizeInterface
{
	public function getModel(): string
	{
		return Size::class;
	}
}