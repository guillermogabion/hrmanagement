import Vue from 'vue'
import Vuex from 'vuex'
// import project_categories from './modules/project_categories'
// import projects from './modules/projects'
// import task_categories from './modules/task_categories'
// import tasks from './modules/tasks'
// import periods from './modules/periods'
// import task_types from './modules/task_types'
// import employees from './modules/employees'
// import holidays from './modules/holidays'
// import employee_tasks from './modules/employee_tasks'
// import roles from './modules/roles'
// import revisions from './modules/revisions'

Vue.use(Vuex)

export default new Vuex.Store({
    state: () => ({
        sidebar: true,
        logged_in: false,
        self_requested: false,
        right_drawer: null,
        component_requested: '',
        user: {
            is_admin: 1
        },
        token: '',
        email: '',
        permissions: [],
        deadlines_changed: false,
        revisions_flag: false,
        newRecords: false,
        closeNav: null,
        newRecord: false,
        newRecordProfile: false,
        newRecordBase: false,
        newRecordsSchedule: false,
        newUpdateRecords: false,
        newUpdate: false,
        requested_id: 0,
        drawer: null
    }),
    mutations: {
        toggleSideBar(state) {
            state.sidebar = !state.sidebar
        },
        toggleRightSidebar(state, component) {
            console.log("store")
            state.right_drawer = true
            state.component_requested = component
        },
        closeRightSidebar(state) {
            state.right_drawer = false
        },
        closeRight(state, value) {
            state.closeNav = value
        },
        UPDATE_NEW_RECORDS(state, value) {
            state.newRecords = value
        },
        UPDATE_NEW_RECORDS_RESERVE(state, value) {
            state.newUpdateRecords = value
        },
        UPDATE_NEW_PROFILE(state, value) {
            state.newRecordProfile = value
        },
        UPDATE_NEW(state, value) {
            state.newRecord = value
        },
        UPDATE_NEW_RECORDS_SCHEDULE(state, value) {
            state.newRecordsSchedule = value
        },
        UPDATE_NEW_ITEMS(state, value) {
            state.newUpdate = value
        },
        UPDATE_REQUESTED_ID(state, value) {
            state.requested_id = value
        },
        UPDATE_NEW_BASE(state, value) {
            state.newRecordBase = value
        },
        login(state, data) {
            state.user = data.user
            console.log(state.user.id, "active User")
        },
        // setSelfRequested(state, status, user) {
        //     state.user = user
        //     state.self_requested = status
        //     state.logged_in = true
        // },
        // logout(state) {
        //     state.user = null
        //     state.logged_in = false
        //     localStorage.setItem('token', '')
        // },
    },
    actions: {

    },
    getters: {
        activeUser: (state) => state.user,
        newDataRecordsSchedule: (state) => state.newRecordsSchedule,
        newDataIndex: (state) => state.newRecord,
        newProfile: (state) => state.newRecordProfile,
        newUpdateRecords: (state) => state.newUpdate,
        newRequestedId: (state) => state.requested_id,
        closeRightNavigation: (state) => state.closeNav,
        newUpdateBase: (state) => state.newRecordBase,
        newUpdateReserve: (state) => state.newUpdateRecords
    },
    modules: {
        // project_categories,
        // projects,
        // task_categories,
        // tasks,
        // periods,
        // task_types,
        // employees,
        // holidays,
        // employee_tasks,
        // roles,
        // revisions
    }
})