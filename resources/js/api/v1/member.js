/**
 * Created by: Tanmnt
 * Email: maingocthanhan96@gmail.com
 * Date Time: 2021-08-02 22:02:10
 * File: Member.js
 */

import Resource from '@/api/resource';
import request from '@/utils/request';

export default class MemberResource extends Resource {
  constructor() {
    super('/v1/members');
  }

  getMember() {
    return request({
      url: '/v1/members/get-members',
      method: 'get',
    });
  }

  search(search) {
    return request({
      url: '/v1/members/search',
      method: 'get',
      params: {
        search,
      },
    });
  }
  // {{$API_NOT_DELETE_THIS_LINE$}}
}
