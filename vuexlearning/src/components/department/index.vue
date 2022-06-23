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
                        :items="department"
                        class="elevation-1"
                        hide-default-footer
                        :items-per-page="itemsPerPage"
                        :page.sync="page"
                        @page-count="pageCount = $event"
                        :server-items-length="total_department"
                        @pagination="fetchDepartmentData"
                    >
                        <template v-slot:top>
                            <v-toolbar
                                flat
                            >
                                <v-toolbar-title>List of Department</v-toolbar-title>
                              
                                <v-spacer></v-spacer>
                                <v-text-field
                                    label="Search Department"
                                    filled
                                    rounded
                                    dense
                                    style="padding-top: 40px; padding-right: 10px;"
                                    v-model="search"
                                    :items='department'
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
                         <template v-slot:item.actions="{ item }">
                            <v-icon
                                small
                                class="mr-2"
                                @click="editItem(item)"
                            >
                                mdi-pencil
                            </v-icon>
                        </template>
                    
                    </v-data-table>
                    <v-pagination
                    v-model="page"
                    :total-visible="7"
                    :length="pageCount"
                    
                    ></v-pagination>
                    <v-dialog
                    v-model="dialogEdit"
                    width="30%"
                    persistent
                    >
                        <v-card>
                            <v-card-title> Edit Department Info </v-card-title>
                            <v-card-text>
                                <v-row no-gutters>
                                    <v-flex xs10>
                                        <v-text-field
                                        v-model="editedItem.department"
                                        label="Department"
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs10>
                                        <v-text-field
                                        v-model="editedItem.description"
                                        label="Description"
                                        ></v-text-field>
                                    </v-flex>
                                </v-row>
                            </v-card-text>
                            <v-card-actions>
                                 <v-spacer></v-spacer>
                                <v-btn
                                color="blue darken-1"
                                text
                                >
                                    Save
                                </v-btn>
                                 <v-btn
                                color="blue darken-1"
                                text
                                @click="close"
                                >
                                    Close
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                    <addDialog
                    :dialog = "dialog"
                    @close = "closeAdd()"
                    >
                    </addDialog>
                    </div>
                    </v-card>
        </v-container>
    </div>
</template>

<script>
// import axios from '@/plugins/axios'
import addDialog from './includes/add.vue'
import { searchDepartment, departmentPagination } from '@/repositories/department.api'
export default {
    components : {
        addDialog
    },
    data (){
        return {
            dialog: false,
            search: '',
            searchDesignation: '',
            dialogEdit: false,
            department: [],
            editedIndex: -1,
            headers : [
                { text: 'Department', value: 'department', align: 'start'},
                { text: 'Description', value: 'description'},
                { text: 'Total Assigned', value: 'sum'},
            ],

         
             editedItem: {
                 department: '',
                 description: '',
                },
            defaultItem: {
                 department: '',
                 description: '',
            },
            pageCount: 0,
            itemsPerPage:null,
            total_department:0,
            page:1,
            current_page:0,
        }
    },
     watch: {
     
      "search": {
        handler(val) {
          this.indexDepartment(val)
        },
        deep: true,
      },
    },
    methods: {
       
        editItem(item){
            this.editedIndex = this.department.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogEdit = true
        },
        close () {
        this.dialogEdit = false
        this.$nextTick(() => {
          this.editedItem = Object.assign({}, this.defaultItem)
          this.editedIndex = -1
        })
        },
         searchUser(key) {
            if (this.timer) {
            clearTimeout(this.timer);
            this.timer = null;
            }
            this.timer = setTimeout(() => {
            searchDepartment({searchkey:key}).then((response) => {
                this.department = response.data 
            }).catch((errors) => {
                console.log(errors)
            });
            },800);
        },
        
    set_data_fromServer(data) {
        this.department = data.data
        this.total_department = data.total
        this.itemsPerPage = data.per_page
        this.pageCount = data.last_page
    },

   
        fetchDepartmentData(page){
        this.current_page = page.page
        this.indexDepartment()
    },

    indexDepartment() {
        this.url = 'departmentPagination?page='+this.current_page+ '&keyword=' +this.search
        if (this.timer) {
        clearTimeout(this.timer);
        this.timer = null;
        }
        this.timer = setTimeout(() => { 
        departmentPagination(this.url).then(({data}) => {
            console.log(this.url,"index")
            this.set_data_fromServer(data)
        })
        }, 800);
    },
    closeAdd(){
        this.indexDepartment()
        this.dialog = false
    },

    
},
   
}
</script>

<style>
.col-md-6 {
    max-width: 49% !important;
    margin: 5px !important;
}
</style>