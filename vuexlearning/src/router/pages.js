import Grades from '@/components/grades/index.vue'
import Instructors from '@/components/instructors/index.vue'
import Students from '@/components/students/index.vue'
import Subject from '@/components/subjects/index.vue'
import Announcements from '@/components/announcements/index.vue'
import Dashboard from '@/components/dashboard/index.vue'

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
        path: '/grades',
        name: 'grades',
        component: Grades,
        meta: { authOnly: true }
    },
    {
        path: '/instructors',
        name: 'instructors',
        component: Instructors,
        meta: { authOnly: true }
    },
    {
        path: '/students',
        name: 'students',
        component: Students,
        meta: { authOnly: true }

    },
    {
        path: '/subjects',
        name: 'subject',
        component: Subject,
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