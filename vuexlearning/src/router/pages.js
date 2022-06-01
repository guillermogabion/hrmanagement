// import Grades from '@/components/grades/index.vue'
// import Instructors from '@/components/instructors/index.vue'
// import Students from '@/components/students/index.vue'
// import Subject from '@/components/subjects/index.vue'


import Dashboard from '@/components/dashboard/index.vue'
import Employee from '@/components/employees/index.vue'
import Department from '@/components/department/index.vue'
import Attendance from '@/components/attendance/index.vue'
import Leave from '@/components/leave/index.vue'
import Announcements from '@/components/announcements/index.vue'



export default [{

        path: '/',
        name: 'dashboard',
        component: Dashboard,
        meta: {
            authOnly: true,
            title: 'Skills - MyApp'
        }

    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
        meta: { authOnly: true }
    },

    {
        path: '/employee',
        name: 'employee',
        component: Employee,
        meta: { authOnly: true }
    },
    
    {
        path: '/department',
        name: 'department',
        component: Department,
        meta: { authOnly: true }
    },
    // {
    //     path: '/instructors',
    //     name: 'instructors',
    //     component: Instructors,
    //     meta: { authOnly: true }
    // },
    {
        path: '/attendance',
        name: 'attendance',
        component: Attendance,
        meta: { authOnly: true }

    },
    {
        path: '/leave',
        name: 'leave',
        component: Leave,
        meta: { authOnly: true }
    },
    {
        path: '/announcements',
        name: 'announcements',
        component: Announcements,
        meta: { authOnly: true }

    }
]

// export default [{
//         path: '/home',
//         name: 'Home',
//         component: Home,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/about',
//         name: 'about',
//         component: About,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/',
//         name: 'login',
//         component: Login,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/interface',
//         name: 'interface',
//         component: Interface,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/dashboard',
//         name: 'dashboard',
//         component: Dashboard,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/grades',
//         name: 'grades',
//         component: Grades,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/instructors',
//         name: 'instructors',
//         component: Instructors,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/students',
//         name: 'students',
//         component: Students,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/subjects',
//         name: 'subject',
//         component: Subject,
//         meta: { authOnly: true }

//     },
//     {
//         path: '/announcements',
//         name: 'announcements',
//         component: Subject,
//         meta: { authOnly: true }

//     },


// ]