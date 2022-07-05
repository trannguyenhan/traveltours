import request from '@/utils/request'

export function login(data) {
  return request({
    url: '/auth/login',
    method: 'post',
    data
  })
}

export function getInfo(token) {
  return request({
    url: '/user/profile',
    method: 'get',
    headers: {
      Authorization: `Bearer ${token}`
    }
  })
}

export function logout() {
  return request({
    url: '/auth/logout',
    method: 'post'
  })
}

export function getListUser(params) {
  return request({
    url: '/user/listing',
    method: 'get',
    params
  })
}

export function updateUser(params) {
  return request({
    url: '/user/update',
    method: 'post',
    data: params
  })
}

export function assignUser(params) {
  return request({
    url: '/user/assign',
    method: 'post',
    data: params
  })
}

export function deleteUser(params) {
  return request({
    url: '/user/delete',
    method: 'post',
    data: params
  })
}
