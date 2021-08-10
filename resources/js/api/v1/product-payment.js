/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class ProductPaymentResource extends Resource {
  constructor() {
    super('/v1/product-payments');
  }

  rollback(product) {
    return request({
      method: 'delete',
      url: `${this.uri}/${product.id}/rollback`,
      data: product,
    });
  }

  exportExcel(query) {
    return request({
      method: 'get',
      url: `${this.uri}/export-excel`,
      params: query,
      timeout: 0,
    });
  }

  // {{$API_NOT_DELETE_THIS_LINE$}}
}
