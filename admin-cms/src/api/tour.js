import request from '@/utils/request'

export function getListTour(page, keyWord) {
  if (keyWord !== '') page += '&keyword=' + keyWord
  return request({
    url: '/tour/seller/listing?page=' + page,
    method: 'get',
  })
}

export function getAllTours(params) {
  return request({
    url: '/tour/seller/listing/all',
    method: 'get',
    params
  })
}

export function getAllCategories(params) {
  return request({
    url: 'totalcategory/',
    method: 'get',
    params
  })
}

export function getDetailTurnover(year, month) {

  return request({
    url: `turnoverintime/${year}/${month}/`,
    method: 'get',
  })
}

export function getTurnover(params) {
  return request({
    url: '/totalYear',
    method: 'get',
    params
  })
}
export function createTour(params) {
  return request({
    url: '/tour/store',
    method: 'post',
    data: params
  })
}

export function updateTour(params) {
  return request({
    url: '/tour/update',
    method: 'post',
    data: params
  })
}

export function deleteTour(params) {
  return request({
    url: '/tour/delete',
    method: 'post',
    data: params
  })
}

export function getDetailTour(id) {
  return request({
    url: '/tour/detail/' + id,
    method: 'get'
  })
}
