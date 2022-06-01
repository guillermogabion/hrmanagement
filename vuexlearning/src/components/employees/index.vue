<template>
  <div>
     <v-data-table
      :headers="headers"
      :items="employees"
      class="elevation-1"
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
                placeholder="Name or Contact Number"
                filled
                rounded
                dense
                style="padding-top: 40px; padding-right: 10px;"
                v-model="form.search"
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
            v-model="dialogEdit"
            max-width="500px"
          >
            <v-card>
              <v-card-title>
                <span class="text-h5">Edit Employee Data</span>
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
                    <div class="upload-options" required style="padding-top: 5px;">
                        <label>
                            <input
                                id="fileData"
                                type="file"
                                @change="onFileChange"
                            />
                        </label>
                    </div>
             
                      <v-text-field
                        v-model="editedItem.name"
                        label="Employee name"
                      ></v-text-field>
                    </v-col>
                    <v-col
                      cols="12"
                      sm="6"
                      md="4"
                    >
                      <v-text-field
                        v-model="editedItem.email"
                        label="Email"
                      ></v-text-field>

                      <v-text-field
                        v-model="editedItem.password"
                        label="Password"
                      ></v-text-field>
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
import { getEmployee, editEmployee,editEmployeenoPic, deleteEmployee,searchEmployee } from '@/repositories/user.api';
  export default {
    components : {
      addDialog
    },
    data () {
      return {
        employees: [],
        headers: [
          { text: 'id', value: 'id', align: 'start' },
          { text: 'Name', value: 'name', align: 'start' },
          { text: 'Email', value: 'email' },
          { text: 'Action', value: 'actions' },

        ],
        dialog: false,
        dialogEdit: false,
        dialogDelete: false,
        dialogPic: false,
        editedIndex: -1,
        editedItem: {
          id: '',
          profile_picture: '',
          name: '',
          email: ''
        },
        defaultItem: {
          id: '',
          profile_picture: '',
          name: '',
          email: ''
        },
        form: {
        search: '',
      },
      }
    },
    mounted() {
      // this.getdata();
      this.searchUser();
    },
     watch: {
     
      "form.search": {
        handler(val) {
          this.searchUser(val)
        },
        deep: true,
      },
      
    },
    methods: {

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
       getdata(){
         getEmployee().then((response)=> {
           console.log(response)
           this.employees = response.data
         }).catch((errors)=>{
           console.log(errors)
         })
       },
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
          this.getdata();

      },

      deleteItem(item){
        
        this.editedIndex = this.employees.indexOf(item)
        this.editedItem = Object.assign({}, item)
        this.dialogDelete = true
    
      },
      closeAdd(){
        this.getdata();
        this.dialog = false
        
      },
      deleteEmployee(){
        deleteEmployee(this.editedItem.id).then((res)=> {
          console.log(res)
          this.getdata();
          this.dialogDelete = false
        })
      },

       searchUser(key) {
        this.loading = true
        if (this.timer) {
          clearTimeout(this.timer);
          this.timer = null;
        }
        this.timer = setTimeout(() => {
          searchEmployee({searchkey:key}).then((response) => {
            this.employees = response.data 
            this.loading = false
          }).catch((errors) => {
            console.log(errors)
          });
        },800);
      },
       

    },
  }
</script>