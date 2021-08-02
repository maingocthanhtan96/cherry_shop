<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.php
 */

namespace App\Repositories\Product;

use App\Models\Product;
use App\Repositories\EloquentRepository;

class ProductRepository extends EloquentRepository implements ProductInterface
{
	public function getModel(): string
	{
		return Product::class;
	}
}