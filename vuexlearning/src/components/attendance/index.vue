<template>
    <div>
       <v-container class="grey lighten-5">
            <v-card
                class="pa-2"
                tile
                elevation="6"
            >
            <div>
            <v-data-table
                :headers="headers"
                :items="attendance"
                class="elevation-1"
                hide-default-footer
            >

            <!-- <v-data-table
            :headers="headers"
            :items="attendance"
            class="elevation-1"
            > -->
                <template v-slot:top>
                    <v-toolbar
                        flat
                    >
                        <v-toolbar-title>Attendance</v-toolbar-title>
                        
                        <v-spacer></v-spacer>
                       

                        <v-menu
                            v-model="menu2"
                            :close-on-content-click="false"
                            :nudge-right="40"
                            transition="scale-transition"
                            offset-y
                            min-width="auto"
                        >
                            <template v-slot:activator="{ on, attrs }">
                            <v-text-field
                                v-model="date"
                                label="Picker without buttons"
                                prepend-icon="mdi-calendar"
                                readonly
                                v-bind="attrs"
                                v-on="on"
                                :items="attendance"
                            ></v-text-field>
                            </template>
                            <v-date-picker
                            v-model="date"
                            @input="menu2 = false"
                            ></v-date-picker>
                        </v-menu>
                            <v-divider
                            class="mx-4"
                            inset
                            vertical
                            >
                        </v-divider>
                    </v-toolbar>
                </template>
                    
            
            </v-data-table>
            <v-pagination
            v-model="page"
            :total-visible="7"
            :length="pageCount"
            ></v-pagination>
            
            </div>
            </v-card>
        </v-container>
    </div>
</template>
<script>
import axios from '@/plugins/axios'
// import { attendancePagination } from '@/repositories/attendance.api'
export default {
    data () {
        return {
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            search: '',
            dialog: '',
            attendance: [],
            pageCount: 0,
            itemsPerPage:null,
            total_attendance: 0,
            page: 1,
            current_page: 0,
             headers : [
                { text: 'Employee ID', value: 'attendances.user_id', align: 'start'},
                { text: 'Employee Last Name', value: 'users.last_name'},
                { text: 'Date', value: 'created_at'},
                // { text: 'Type', value:'type'},
                // { text: 'Attendace Status', value:'status'}
            ],

        }
    }, 
    watch: {
        "date" : {
            handler(val) {
                this.searchAttendance(val)
            },
            deep: true,
        }
    },
   
    methods: {
     
        
        set_data_fromServer(data) {
            this.attendance = data.data
            this.total_attendance = data.total
            this.itemsPerPage = data.per_page
            this.pageCount = data.last_page
        },
        fetchData(page) {
            this.current_page = page.page
            this.attendanceFunction()
        },
        test(){
            axios.post('test').then((res)=> {
                this.attendance = res.data
                console.log()
            })
        },

        searchAttendance(key) {
        this.loading = true
        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }
        this.timer = setTimeout(() => {
          axios.post('todayPresent', {searchkey:key}).then((response) => {
            this.attendance = response.data.data 
            this.loading = false
          }).catch((errors) => {
            console.log(errors)
          });
        },800);
      },
      getToday(){
          axios.get('getToday').then((response) => {
              this.attendance = response.data
              console.log(response)
          })
      }
    },
    mounted() {
        this.searchAttendance();
    },
}
</script>