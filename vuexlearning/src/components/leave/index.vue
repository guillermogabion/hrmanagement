<template>
    <div>
         <v-data-table
            :headers="headers"
            :items="leave"
            class="elevation-1"
            hide-default-footer 
        >

         <template v-slot:top>
            <v-toolbar
                flat
            >
                <v-toolbar-title>Leave Requests</v-toolbar-title>
                
                <v-spacer></v-spacer>
                <v-text-field
                    label="Search Request"
                    filled
                    rounded
                    dense
                    style="padding-top: 40px; padding-right: 10px;"
                    v-model="search"
                    :items='leave'
                ></v-text-field>
                <v-btn
                dark
                class="mb-5"
                @click="dialog = true"
                >
                <v-icon dark >
                    mdi-plus
                </v-icon>
                </v-btn>
                    <v-divider
                    class="mx-4"
                    inset
                    vertical
                    >
                </v-divider>
            </v-toolbar>
        </template>
        </v-data-table>
        <addDialog
            :dialog="dialog"
            @close="closeAdd()"
        >
        </addDialog>
    </div>
</template>
<script>
import addDialog from './includes/dialog.vue'
import axios from '@/plugins/axios'
export default {
    components:{
        addDialog
    },
    data () {
        return {
            dialog: false,
            leave: [],
            headers : [
                {text : 'Requestor' , value: 'user.last_name'},
                {text : '' , value: 'user.first_name'},
                {text : 'Position' , value: 'user.user_type'},
                {text : '' , value: 'request_date_from'},
                {text : '' , value: 'request_date_leave_to'},
                {text : 'Department' , value: 'user.first_name'},
                // {text : 'From' , value: 'from'},
                // {text : 'To' , value: 'to'},
                // {text : 'Type' , value: 'type'},
                // {text : 'Status' , value: 'status'}
            ],
            payload: {
                id: '',
                from: '',
                to: '',
                type: '',
                status: '',
                department: ''
            },
            search : '',

        }

    },
    methods: {
    //    getRequests

    getAllLeave(){
        axios.get('getRequestLeave').then((response) => {
            console.log(response.data.data)
            this.leave = response.data.data
        })
    }
    },
    mounted() {
        this.getAllLeave()
    },
}

</script>