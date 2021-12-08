import axios from '@/plugins/axios';

export const Self = () => axios.get('self')
export const login = (payload) => axios.post('login', payload)
    // export const  GetAllUsers= () => axios.get(`/getCountUsers`)
    // export const getUserMonthlyPurchase = (payload) =>axios.post(`/getUserBill`,payload)
    // export const login = (payload) => axios.post('login', payload)
    // export const getReserve = (payload) => axios.post('/reserve',payload)
    // export const getUserTodaysOrder = (payload) => axios.post(`getUserTodaysOrder`,payload)