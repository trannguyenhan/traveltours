import request from '@/utils/request'

export function getListOrder(params) {
  return request({
    url: '/order/listing',
    method: 'get',
    params
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

