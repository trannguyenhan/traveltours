import request from '@/utils/request'

export function getListCoupon(params) {
  return request({
    url: '/coupon/listing',
    method: 'get',
    params
  })
}

export function getDetailCoupon(id) {
  return request({
    url: '/coupon/detail/' + id,
    method: 'get'
  })
}

export function updateCoupon(params) {
  return request({
    url: '/coupon/update',
    method: 'post',
    data: params
  })
}

export function acceptCoupon(params) {
  return request({
    url: '/coupon/accept',
    method: 'post',
    data: params
  })
}

export function deleteCoupon(params) {
  return request({
    url: '/coupon/delete',
    method: 'post',
    data: params
  })
}

export function createCoupon(params) {
  return request({
    url: '/coupon/store',
    method: 'post',
    data: params
  })
}

