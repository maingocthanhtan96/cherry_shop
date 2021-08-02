/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:43
 * File: Size.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class SizeResource extends Resource {
  constructor() {
    super('/v1/sizes');
  }

  getSize() {
    return request({
      url: '/v1/sizes/get-sizes',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
