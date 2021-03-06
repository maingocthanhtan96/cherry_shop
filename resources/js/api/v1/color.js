/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 21:55:13
 * File: Color.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class ColorResource extends Resource {
  constructor() {
    super('/v1/colors');
  }

  getColor() {
    return request({
      url: '/v1/colors/get-colors',
      method: 'get',
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
