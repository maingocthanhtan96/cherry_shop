/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:49:15
 * File: Category.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class CategoryResource extends Resource {
  constructor() {
    super('/v1/categories');
  }

  getCategory() {
    return request({
      url: '/v1/categories/get-categories',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
