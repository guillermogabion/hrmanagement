<template>
    <v-dialog
        v-model="dialog"
        persistent
        width="30%"
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

             <v-flex xs12>
                    <div class="js--image-preview" style="margin: auto; padding-left: 27%; ">
                        <v-img
                            
                            style="width: 200px; height: 150px;"
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
            <v-flex xs12>
                    <v-subheader class="px-0">Name</v-subheader>
                    <v-text-field
                    v-model = "payload.name"
                    required
                    :counter="10"
                    :rules="nameRules"
                    ></v-text-field>
            </v-flex>
            <v-flex xs12>
                <v-subheader class="px-0">Email</v-subheader>
                    <v-text-field
                        :rules="emailRules"
                        v-model = "payload.email"
                        required
                    ></v-text-field>
            </v-flex>
             <v-flex xs12>
                <v-subheader class="px-0">Password</v-subheader>
                    <v-text-field
                        :rules="passwordRules"
                        v-model = "payload.password"
                        required
                    ></v-text-field>
            </v-flex>
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
                    >
                        Close
                    </v-btn>
                </div>
            </v-card-actions>

            
            </v-form>
        </v-card>
    </v-dialog>



</template>
<script>
// import { ShowSmtp, UpdateSmtp, CreateSmtp } from "@api/smtp.api";

// import axios from '@/plugins/axios';
import { addEmployee } from '@/repositories/user.api';
export default {
    data(){
        return {
            valid: true,
             nameRules: [
            v => !!v || 'Name is required',
            v => (v && v.length <= 10) || 'Name must be less than 10 characters',
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
                profile_picture: '',
                name:'',
                email:'',
                password:'',
            },
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
    padding-right: 1em;
}
</style>
