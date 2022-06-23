<template>
  <div>
    

     <v-data-table
      :headers="headers"
      :items="employees"
      class="elevation-1"
      hide-default-footer
      :items-per-page="itemsPerPage"
      :loading="loading"
      :page.sync="page"
      @page-count="pageCount = $event"
      :server-items-length="total_employees"
      @pagination="fetchEmployeesData"
      >
        <template v-slot:top>
          <v-toolbar
          flat
          >
            <v-toolbar-title>Employees</v-toolbar-title>
            <v-divider
            class="mx-4"
            inset
            vertical
            ></v-divider>
            <v-spacer></v-spacer>
             <v-text-field
                label="Search"
                filled
                rounded
                readonly
                dense
                style="padding-top: 40px; padding-right: 10px;"
                v-model="search"
                :items='employees'
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
          </v-toolbar>
        </template>
          <template v-slot:item.actions="{ item }">
           <v-icon
            small
            @click="deleteItem(item)"
          >
            mdi-eye
          </v-icon>
          <v-icon
            small
            class="mr-2"
            @click="editItem(item)"
          >
            mdi-pencil
          </v-icon>
          <v-icon
            small
            @click="deleteItem(item)"
          >
            mdi-delete
          </v-icon>
        </template>

          
      </v-data-table>
      <div class="text-center pt-2">
          <v-pagination
          v-model="page"
          :total-visible="7"
          :length="pageCount"
          
        ></v-pagination>

        <!-- <pagination align="center" :data="employees" @pagination-change-page="list"></pagination> -->
      </div>
          <v-dialog v-model="dialogDelete" max-width="500px">
            <v-card>
              <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="dialogDelete = false">Cancel</v-btn>
                <v-btn color="blue darken-1" text @click="deleteEmployee()">OK</v-btn>
                <v-spacer></v-spacer>
              </v-card-actions>
            </v-card>
          </v-dialog>
          <v-dialog
          max-width="500px" 
          v-model="dialogView">
          <v-card>
            <v-card-title>
              <span class="text-h5">Company Name</span>
            </v-card-title>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col
                  cols="12"
                  sm="6"
                  md="4"
                  >
                  <div class="js--image-preview" style="margin: auto;">
                        <v-img
                            style="width: 200px; height: 150px"
                            :src="editedItem.profile_picture || '/images/profile.jpg'"
                        ></v-img>
                  </div>


                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>

          </v-dialog>

      <v-dialog
            v-model="dialogEdit"
            width="50%"
          >
            <v-card>
              <v-card-title>
                <span class="text-h5">Edit Employee Data</span>
              </v-card-title>
                <!-- {{editedItem.last_name + ',' + ' ' + editedItem.first_name + ' ' + editedItem.mid_name }}
                <br>
                {{editedItem.birth_date}}
                {{editedItem.employee_id}} -->
              <v-card-text>
                <v-container>
                  <v-row no-gutters>
                    <v-col
                     md="6.5"
                    >
                       <v-flex xs12>
                          <div class="js--image-preview" style="margin: auto;">
                                <v-img
                                    style="width: 200px; height: 178px"
                                    :src="editedItem.profile_picture || '/images/profile.jpg'"
                                ></v-img>
                            </div>
                            <div class="upload-options" required style="padding-top: 5px;">
                                <label>
                                    <input
                                        id="fileData"
                                        type="file"
                                        @change="onFileChange"
                                    />
                                </label>
                          </div>
                        </v-flex>
                      
                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.employee_id"
                          label="Last Name"
                          readonly
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.last_name"
                          label="Last Name"
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.first_name"
                          label="First name"
                        ></v-text-field>
                      </v-flex>

                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.mid_name"
                          label="Middle name"
                        ></v-text-field>
                      </v-flex>
                    </v-col>
                    <v-col md="6">

                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.birth_date"
                          label="Birth Date"
                        ></v-text-field>
                     </v-flex>
                   
                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.address"
                          label="Address"
                        ></v-text-field>
                      </v-flex>
                        <v-flex xs10>
                          <v-text-field
                            v-model="editedItem.phone"
                            label="Phone"
                          ></v-text-field>
                        </v-flex>
                        <v-flex xs10>
                          <v-text-field
                            v-model="editedItem.email"
                            label="Email"
                          ></v-text-field>
                        </v-flex>
                        <v-flex xs10>
                          <v-text-field
                            v-model="editedItem.person_to_contact"
                            label="In Case of Emergency, Contact"
                          ></v-text-field>
                        </v-flex>
                     
                      <v-flex xs10>
                        <v-text-field
                          v-model="editedItem.email"
                          label="Email"
                        ></v-text-field>
                      </v-flex>
                      <v-flex xs10>

                        <v-text-field
                          v-model="editedItem.password"
                          label="New Password"
                        ></v-text-field>
                    
                      </v-flex> 
                    </v-col>
                   
                    
                  </v-row>
                </v-container>
              </v-card-text>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="close"
                >
                  Cancel
                </v-btn>
                <v-btn
                  color="blue darken-1"
                  text
                  @click="save"
                >
                  Save
                </v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
     <addDialog
        :dialog="dialog"
        @close="closeAdd()"
        ></addDialog>
  </div>
</template>

<script>
// import axios from '@/plugins/axios';
import addDialog from './includes/dialog.vue'
import { EmployeePagination, editEmployee,editEmployeenoPic, deleteEmployee,searchEmployee } from '@/repositories/user.api';
  export default {
    components : {
      addDialog
    },
    data () {
      return {
        employees: [],
        headers: [
          { text: 'Employee Number', value: 'id', align: 'start' },
          { text: 'Last Name', value: 'last_name' },
          { text: 'First Name', value: 'first_name' },
          { text: 'Middle Name', value: 'mid_name' },
          { text: 'Birth Date', value: 'birth_date' },
          { text: 'Address', value: 'address' },
          { text: 'Email', value: 'email' },
          { text: 'Contact No.', value: 'phone' },
          { text: 'Action', value: 'actions' },
        ],
        headers2: [
            { text : 'Employeeee', value: 'first_name'}
        ],
        loading: false,
        dialog: false,
        dialogEdit: false,
        dialogView: false,
        dialogDelete: false,
        dialogPic: false,
        editedIndex: -1,
        editedItem: {
          id: '',
          employee_id: '',
          profile_picture: '',
          last_name: '',
          first_name: '',
          mid_name: '',
          birth_date: '',
          address: '',
          phone: '',
          person_to_contact: '',
          email: ''
        },
        defaultItem: {
          id: '',
          employee_id: '',
          profile_picture: '',
          last_name: '',
          first_name: '',
          mid_name: '',
          birth_date: '',
          address: '',
          phone: '',
          person_to_contact: '',
          email: ''
        },
        search : '',
        pageCount: 0,
        itemsPerPage:null,
        total_employees:0,
        page:1,
        current_page:0,
        
      }
    },
    // mounted() {
    //   // this.getdata();
    //   this.emp();
    // },
     watch: {
     
      "search": {
        handler(val) {
          this.indexEmployee(val)
        },
        deep: true,
      },
      
    },
    props:{
      'data' : {}
    },
    methods: {

      onPageChange() {
        this.getUsers();
      },

      onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            this.createImg(files[0]);
        },
        createImg(file){
            var reader = new FileReader;

            reader.onload = (e) => {
                this.editedItem.profile_picture = e.target.result;
                };
            reader.readAsDataURL(file)
        },
      //  getdata(){
      //    getEmployee().then((response)=> {
      //      console.log(response)
      //      this.employees = response.data
      //    }).catch((errors)=>{
      //      console.log(errors)
      //    })
      //  },
      editItem (item) {
        this.editedIndex = this.employees.indexOf(item)
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

      save () {
         const imageLabel = document.getElementById('fileData');

         let payload = this.editedItem
        if(imageLabel.value == ''){
            editEmployeenoPic(payload.id, payload).then((res)=> {
                console.log(res.data)
            }).catch((errors)=>{
                console.log(errors)
            })
            imageLabel.value = ''
            this.dialogEdit = false
        }else{
          
            editEmployee(payload.id, payload).then((res)=> {
                console.log(res.data)
            }).catch((errors)=>{
                console.log(errors)
            })
            imageLabel.value = ''
            this.dialogEdit = false
          
        }
          this.indexEmployee();

      },

      deleteItem(item){
        
        this.editedIndex = this.employees.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
    
      },

      ViewItem(item){
        
        this.editedIndex = this.employees.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogView = true
    
      },
      closeAdd(){
        this.indexEmployee();
        this.dialog = false
        
      },
      deleteEmployee(){
        deleteEmployee(this.editedItem.id).then((res)=> {
          console.log(res)
          this.indexEmployee();
          this.dialogDelete = false
        })
      },

       searchUser(key) {
        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }
        this.timer = setTimeout(() => {
          searchEmployee({searchkey:key}).then((response) => {
            this.employees = response.data 
          }).catch((errors) => {
            console.log(errors)
          });
        },800);
      },
      
       set_data_fromServer(data) {
            this.employees = data.data
            this.total_employees = data.total
            this.itemsPerPage = data.per_page
            this.pageCount = data.last_page
        },
         fetchEmployeesData(page){
            this.current_page = page.page
            this.indexEmployee()
        },
        indexEmployee() {
          this.url = 'users/pagination?page='+this.current_page+ '&keyword=' +this.search
          this.loading = true
          if (this.timer) {
            clearTimeout(this.timer);
            this.timer = null;
          }
          this.timer = setTimeout(() => { 
            EmployeePagination(this.url).then(({data}) => {
              console.log(this.url,"index")
              this.set_data_fromServer(data)
              this.loading = false
            })
          }, 800);
        },
    },
  }
</script>
<style>
  .theme--light.v-pagination .v-pagination__item--active {
    background-color: bisque !important;
    color: black !important;
  }
</style>