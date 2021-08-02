<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.php
 */

namespace App\Repositories\ProductPayment;

use App\Models\ProductPayment;
use App\Repositories\EloquentRepository;

class ProductPaymentRepository extends EloquentRepository implements ProductPaymentInterface
{
	public function getModel(): string
	{
		return ProductPayment::class;
	}
}