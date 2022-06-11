<template>
    <v-dialog
        v-model="dialog"
        persistent
        width="50%"
    >
           
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Add New Employee
            </v-card-title>
            <v-form
                ref="form"
                lazy-validation
                v-model="valid"
                class="padding"
            >
            <v-row no-gutters>
                <v-col md="6.5">

                    <v-flex xs12>
                            <div class="js--image-preview" style="margin: auto; padding-left: 27%; ">
                                <v-img
                                    
                                    style="width: 200px; height: 134px;"
                                    :src="payload.profile_picture || '/images/profile.jpg'"
                                ></v-img>
                            </div>
                            <div class="upload-options" required style="padding-top: 5px;">
                                <label>
                                    <input
                                        id="fileData"
                                        type="file"
                                        @change="onFileChange"
                                        style="padding-left: 20%;"
                                    />
                                </label>
                            </div>
                    </v-flex>
                    <v-flex xs10>
                            <v-subheader class="px-0 ma-0">Employee Number</v-subheader>
                            <v-text-field
                            v-model = "payload.employee_id"
                            required
                            :rules="lastnameRules"
                            readonly
                            ></v-text-field>
                    </v-flex>
                
                    <v-flex xs10>
                            <v-text-field
                            v-model = "payload.last_name"
                            label="Last Name"
                            required
                            :counter="20"
                            :rules="lastnameRules"
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                            label="First Name"
                            v-model = "payload.first_name"
                            required
                            :counter="20"
                            :rules="firstnameRules"
                            ></v-text-field>
                    </v-flex>
                    
                    <v-flex xs10>
                            <v-text-field
                            label="Middle Name"
                            v-model = "payload.mid_name"
                            required
                            :counter="20"
                            :rules="midnameRules"
                            ></v-text-field>
                    </v-flex>
                </v-col>
                <v-col md="6">
                    <v-flex xs10>
                            <v-text-field
                             label="Birth Date"
                            v-model = "payload.birth_date"
                            required
                            :counter="10"
                            :rules="dateRules"
                            ></v-text-field>
                    </v-flex>
                
                    <v-flex xs10>
                            <v-text-field
                                 label="Address"
                                :rules="addressRules"
                                v-model = "payload.address"
                                required
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                             label="Contact Number"
                                :rules="phoneRules"
                                v-model = "payload.phone"
                                :counter = "9"
                                required
                                type="number"
                            ></v-text-field>
                    </v-flex>
                    
                    <v-flex xs10>
                            <v-text-field
                                :rules="emailRules"
                                label="Email"
                                v-model = "payload.email"
                                required
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                                label="In Case of Emergency, Contact Person"
                                v-model = "payload.person_to_contact"
                                required
                            ></v-text-field>
                    </v-flex>
                     <v-flex xs10>
                            <v-text-field
                                label="Contact Person Number"
                                v-model = "payload.to_contact_number"
                                required
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                       
                            <v-text-field
                                label="Password"
                                :rules="passwordRules"
                                v-model = "payload.password"
                                required
                                type="password"
                            ></v-text-field>
                    </v-flex>
                </v-col>
            </v-row>    
            <v-card-actions>
                <v-spacer></v-spacer>
                <div style="padding-right: 2%;">
                    <v-btn
                        color="primary"
                        small
                        dark
                        width="70px"
                        @click = "addEmployee"
                        :disabled="!valid"
                    >
                        Save
                    </v-btn>
                </div>
                <div>
                    <v-btn
                        color="primary"
                        dark
                        small
                        width="70px"
                        @click.prevent="$emit('close')"
                        @click="reset()"
                    >
                        Close
                    </v-btn>
                </div>
                <v-spacer></v-spacer>
            </v-card-actions>

            
            </v-form>
        </v-card>
    </v-dialog>



</template>
<script>
// import { ShowSmtp, UpdateSmtp, CreateSmtp } from "@api/smtp.api";

import { addEmployee } from '@/repositories/user.api';
export default {
    data(){
        return {
            valid: true,
             firstnameRules: [
            v => !!v || 'First Name is required',
            v => (v && v.length <= 20) || 'First Name must be less than 20 characters',
            ],
            lastnameRules: [
            v => !!v || 'Last Name is required',
            v => (v && v.length <= 20) || 'Last Name must be less than 10 characters',
            ],

            midnameRules: [
            v => !!v || 'Middle Name is required',
            v => (v && v.length <= 20) || 'Middle Name must be less than 20 characters',
            ],

            dateRules: [
            v => !!v || 'Birth Date is required',
            // v => (v && v.length <= 20) || 'Birth Date must be less than 20 characters',
            ],

             addressRules: [
            v => !!v || 'Address is required',
            // v => (v && v.length <= 20) || 'Birth Date must be less than 20 characters',
            ],

            phoneRules: [
            v => !!v || 'Phone is required',
            v => (v && v.length <= 9) || 'Phone Number must be less than 9 characters',
            ],
            email: '',
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+\..+/.test(v) || 'E-mail must be valid',
            ],
            passwordRules: [
                v => !!v || 'Password is required',
                v => (v && v.length >= 8) || 'Password must be less than 10 characters',
            ],
            payload:{
                profile_picture:'',
                employee_id: this.currentDate(),
                first_name:'',
                last_name:'',
                mid_name:'',
                birth_date:'',
                address:'',
                email:'',
                person_to_contact:'',
                phone:'',
                password:'password',
            },
            // total: '',
        }
    },
   
    props: {
        dialog:{
            required: true,
            type: Boolean,
            default: false
        },
        id:{
            type:Number,
        }
    },

    methods: {
        onFileChange(e) {
            var files = e.target.files || e.dataTransfer.files;
            this.createImg(files[0]);
        },
        createImg(file){
            // var image = new Image;
            var reader = new FileReader; 

            reader.onload = (e) => {
                this.payload.profile_picture = e.target.result;
                };
            reader.readAsDataURL(file)
        },

        addEmployee(){
            // this.payload.employee_id = this.count() && this.currentDate()
            let payload = this.payload

            if( this.$refs.form.validate()){
                 addEmployee(payload).then((res)=> {
                    console.log(res)
                    this.clean()
                     this.$emit('close')

                    
                }).catch((errors)=>{
                    console.log(errors)
                })
            }
           
        },
        clean(){
            const imageInput = document.getElementById('fileData');
            imageInput.value = ''
            this.payload.profile_picture = ''
            this.payload.name = '' 
            this.payload.email = ''
            this.payload.password = ''
        },
      
        currentDate() {
            const current = new Date();
            const date = `${current.getDate()}${current.getMonth()+1}${current.getHours()}${current.getMinutes()}`;
            return date;
        },
        reset(){
             this.$refs.form.resetValidation()
        }

        // res(){
        //   this.total;
        // }

        
       
    },
  

       

        
    
}
</script>
<style scoped>
.v-subheader{
    height: 30px !important;
    margin-bottom: 1px;
    margin-top: 14px;
    font-weight: bold;
    letter-spacing: 2px;
}
.padding {
    padding-left: 1em;
}
</style>
