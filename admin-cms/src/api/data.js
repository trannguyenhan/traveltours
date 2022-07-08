
import axios from 'axios'

export function getAddressDetail() {
    return axios({
        url: 'http://127.0.0.1:8000/api/vietnam-address',
        method: 'get',
    })
}

