import request from '@/utils/request'

export function getListTour(params) {
    return request({
        url: '/tour/listing',
        method: 'get',
        params
    })
}