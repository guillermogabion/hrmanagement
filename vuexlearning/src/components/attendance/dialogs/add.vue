<template>
    <v-dialog
        v-model="dialog"
      fullscreen
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn
          color="primary"
          dark
          v-bind="attrs"
          v-on="on"
        >
          Scan Your Code
        </v-btn>
      </template>
      <v-card>
        <v-toolbar
          dark
          color="primary"
        >
           <v-toolbar-title>Scan Your Code</v-toolbar-title>
          <v-spacer></v-spacer>
          <v-toolbar-items>
            <v-btn
              dark
              text
              @click="dialog = false"
            >
              Back
            </v-btn>
          </v-toolbar-items>
        </v-toolbar>
        <v-list
          three-line
          subheader
        >
          <v-text-field
            label="Search"
            filled
            rounded
            dense
            style="padding-top: 40px; padding-right: 10px;"
            v-model="payload.id"
            :items='employees'
          >
          </v-text-field>
        </v-list>
        <v-divider></v-divider>
        <v-list
          three-line
          subheader
        >
         <v-text-field
           v-model="employees.first_name"
          ></v-text-field>  
         <v-text-field
           v-model="employees.last_name"
          ></v-text-field>  
         <v-text-field
           v-model="employees.phone"
          ></v-text-field>  
        </v-list>
        
        <v-btn
        dark
        class="mb-5"
        @click="saveAttendance()"
       
        >
            Present
        </v-btn>
      </v-card>

        <v-snackbar
        v-model="snackbar"
        :bottom="y === 'bottom'"
        :left="x === 'left'"
        :multi-line="mode === 'multi-line'"
        :right="x === 'right'"
        :timeout="timeout"
        :top="y === 'top'"
        :vertical="mode === 'vertical'"
        >
        {{ text }}
        </v-snackbar>

      </v-dialog>   
</template>
<script>
import { scanEmployee } from '@/repositories/user.api';
import { addPresent } from '@/repositories/attendance.api';
// import axios  from '@/plugins/axios';
    export default {
        data (){
            return {
                mode: '',
                x: null,
                y: 'top',
                snackbar: false,
                text: 'Success',
                timeout: 1000,
                dialog: false,
                payload : {
                    id: ''
                },
                employees: {
                    first_name: '',
                    last_name: '',
                },
                search2: '',
            }
        },
      
     watch: {
     
      "payload.id": {
        handler(val) {
          this.getData(val)
        },
        deep: true,
      },
      
    },
    methods: {
        getData(){
            scanEmployee(this.payload).then((res) => {
                console.log(res.data)
                this.employees = res.data
            })
        },
        saveAttendance(){
             this.loading = true
            if (this.timer) {
            clearTimeout(this.timer);
            this.timer = null;
            }
            
            this.timer = setTimeout(() => {
                addPresent(this.payload).then((res) => {
                console.log(res.data)
                this.snackbar = true
                this.payload.id = ''
            }).catch((errors) => {
                console.log(errors)
            });

            },800);

           
        }
    },
    }
</script>


