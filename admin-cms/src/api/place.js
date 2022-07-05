import request from '@/utils/request'

export function getListPlace(params) {
  return request({
    url: '/place/listing',
    method: 'get',
    params
  })
}

export function updatePlace(params) {
  return request({
    url: '/place/update',
    method: 'post',
    data: params
  })
}

export function deletePlace(params) {
  return request({
    url: '/place/delete',
    method: 'post',
    data: params
  })
}

export function getDetailPlace(id) {
  return request({
    url: '/tour/place/' + id,
    method: 'get'
  })
}
