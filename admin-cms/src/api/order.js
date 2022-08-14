import request from '@/utils/request'

export function getListOrder(page, keyWord) {
  if (keyWord !== '') page += '&keyword=' + keyWord
  return request({
    url: '/order/seller/listing?page=' + page,
    method: 'get',

  })
}

export function updateOrder(params) {
  return request({
    url: '/order/update',
    method: 'post',
    data: params
  })
}

export function acceptOrder(params) {
  return request({
    url: '/order/accept',
    method: 'post',
    data: params
  })
}

export function deleteOrder(params) {
  return request({
    url: '/order/delete',
    method: 'post',
    data: params
  })
}

