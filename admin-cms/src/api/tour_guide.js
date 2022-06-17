import request from '@/utils/request'

export function getListTourGuide(params) {
  return request({
    url: '/tour-guide/listing',
    method: 'get',
    params
  })
}

export function createTourGuide(params) {
  return request({
    url: '/tour-guide/store',
    method: 'post',
    data: params
  })
}

export function updateTourGuide(params) {
  return request({
    url: '/tour-guide/update',
    method: 'post',
    data: params
  })
}

export function deleteTourGuides(params) {
  return request({
    url: '/tour-guide/delete',
    method: 'post',
    data: params
  })
}
