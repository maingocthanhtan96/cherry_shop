/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.js
 */

import Resource from '@/api/resource';

export default class ProductResource extends Resource {
  constructor() {
    super('/v1/products');
  }

  // {{$API_NOT_DELETE_THIS_LINE$}}
}
