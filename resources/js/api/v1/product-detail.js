/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-05 21:05:22
 * File: ProductDetail.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class ProductDetailResource extends Resource {
  constructor() {
    super('/v1/product-details');
  }

  getProductDetail() {
    return request({
      url: '/v1/product-details/get-product-details',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
