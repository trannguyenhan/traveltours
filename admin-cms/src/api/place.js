import request from '@/utils/request'

export function createPlace(params) {
  return request({
    url: '/place/store',
    method: 'post',
    data: params
  })
}
export function getListPlace(page, keyWord) {
  if (keyWord !== '') page += '&keyword=' + keyWord
  return request({
    url: '/place/sellerListing?page=' + page,
    method: 'get',
  })
}

export function getAllPlace(page, keyWord) {
  return request({
    url: '/place/allSellerListing',
    method: 'get',
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
    url: '/place/detail/' + id,
    method: 'get'
  })
}
