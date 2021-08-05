<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 * File: ProductDetail.php
 */

namespace App\Repositories\ProductDetail;

use App\Models\ProductDetail;
use App\Repositories\EloquentRepository;

class ProductDetailRepository extends EloquentRepository implements ProductDetailInterface
{
	public function getModel(): string
	{
		return ProductDetail::class;
	}
}