import request from '@/utils/request'

export function getListTour(params) {
    return request({
        url: '/tour/listing',
        method: 'get',
        params
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