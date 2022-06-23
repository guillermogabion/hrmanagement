import axios from '@/plugins/axios';

export const attendancePagination = (url,payload) => axios.post(`/${url}`, payload)
export const searchAttendance = (payload) => axios.post('searchAttendance', payload)

export const addPresent = (payload) => axios.post('present', payload)

// export const searchDate = (payload) => axios.post('test', payload)
