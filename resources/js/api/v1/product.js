/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class ProductResource extends Resource {
  constructor() {
    super('/v1/products');
  }

  update(id, resource) {
    return request({
      url: this.uri + '/' + id,
      method: 'post',
      data: resource,
    });
  }

  detail(id) {
    return request({
      url: this.uri + `/${id}/detail`,
      method: 'get',
    });
  }

  getProduct() {
    return request({
      url: '/v1/products/get-products',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
