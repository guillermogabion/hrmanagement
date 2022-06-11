import axios from '@/plugins/axios';

export const searchDepartment = (payload) => axios.post('searchDepartment', payload)
export const departmentPagination = (url,payload) => axios.get(`/${url}`, payload)

export const searchDesignation = (payload) => axios.post('searchDesignation', payload)
export const designationPagination = (url,payload) => axios.get(`/${url}`, payload)

