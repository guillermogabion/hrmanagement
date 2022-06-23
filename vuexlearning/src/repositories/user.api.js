import axios from '@/plugins/axios';

export const Self = () => axios.get('self')
export const login = (payload) => axios.post('login', payload)

export const getEmployee=() => axios.get('employee')
export const addEmployee=(payload)=>axios.post('addEmployee', payload)
export const editEmployee = (id, payload)=>axios.put(`editEmployee/${id}`, payload)
export const editEmployeenoPic = (id, payload)=>axios.put(`editEmployeenoPic/${id}`, payload)
export const deleteEmployee = (id)=>axios.delete(`deleteEmployee/${id}`)
export const searchEmployee = (payload) => axios.post('searchEmployee', payload)
export const scanEmployee = (payload) => axios.post('presented', payload)

export const  EmployeePagination = (url,payload) => axios.get(`/${url}`, payload)
// export const  AllEmployee = (url, purchase) => axios.get(`/${url}`,purchase)
// export const  GetAllUsers= () => axios.get(`/getCountUsers`)
    // export const getUserMonthlyPurchase = (payload) =>axios.post(`/getUserBill`,payload)
    // export const login = (payload) => axios.post('login', payload)
    // export const getReserve = (payload) => axios.post('/reserve',payload)
    // export const getUserTodaysOrder = (payload) => axios.post(`getUserTodaysOrder`,payload)