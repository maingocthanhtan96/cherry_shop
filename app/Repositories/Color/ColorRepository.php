<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 * File: Color.php
 */

namespace App\Repositories\Color;

use App\Models\Color;
use App\Repositories\EloquentRepository;

class ColorRepository extends EloquentRepository implements ColorInterface
{
	public function getModel(): string
	{
		return Color::class;
	}
}