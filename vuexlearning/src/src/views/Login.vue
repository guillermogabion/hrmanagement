<template>
    <div class="login-page">

        <v-card
          :loading="loading"
          class="mx-auto my-12"
          max-width="374"
        >
          <template slot="progress">
            <v-progress-linear
              color="deep-purple"
              height="10"
              indeterminate
            ></v-progress-linear>
          </template>

        

          <v-card-title>Login Page</v-card-title>

            <v-form>
              <v-container>
                <v-row class="fields">
                
                    <v-text-field
                      v-model="email"
                     placeholder="Email"
                      type="email"
                      outlined
                    ></v-text-field>
                </v-row>
                <v-row class="fields">

              
                    <v-text-field
                      v-model="last"
                      type="password"
                      placeholder="Password"
                      outlined
                    ></v-text-field>
                  
                </v-row>
              </v-container>
            </v-form>

          <v-card-actions>
            <v-btn
              color="deep-purple lighten-2"
              
              @click="reserve"
              to="/interface"
            >
            Login
            </v-btn>
          </v-card-actions>

          
        </v-card>
    
    </div>
</template>
<script>
    // import axios from '@/plugins/axios'
    // // import RegisterUser from '../login/register.vue'
    // import logo from '@/assets/images/logo.png'
    import { login } from "@/repositories/user.api";
    export default {
        data() {
            return {
                email : '',
                password: '',
               
            }
        },
    //     components:{
    //         // RegisterUser,
    //     },
        methods: {
            Login() {
                this.loading = true
                const login_data = {
                    email: this.email,
                    password: this.password
                }
                this.$validator.validateAll().then(result => {
                    if(result) {
                        login(login_data).then(({data}) => {
                            this.$store.commit('login', data)
                            localStorage.setItem('token', data.access_token)
                            this.$router.push({ name: "dashboard"})
                        }).catch((errors)=> {
                            console.log(errors)
                            this.dialog = true
                        })
                        .finally(() => {
                            this.loading = false
                        })
                    }
                })
            },
    //         create() {
    //             this.$validator.validateAll().then(result => {
    //                 if(result) {
    //                     axios.post('UserRegistration', this.formData).then(({data}) => {
    //                         console.log(data)
    //                         this.registerDialog = false
    //                         this. clearInput();
    //                     }).catch((error)=> {
    //                         console.log(error)
    //                         this.dialog_alert = true
    //                     });
    //                 }
    //             });
    //         },
    //         registerUser(){
    //             this.registerDialog = true
    //         },
    //         createUser() {
    //             this.drawer=true;
    //         },
    //         closeUserRegister() {
    //             this.drawer=false;
    //         },
    //         clearInput() {
    //             this.formData = {
    //             pic: '',
    //             first_name: '',
    //             last_name: '',
    //             email: '',
    //             mobile: '',
    //             username: '',
    //             password: '',
    //             confirm:''
    //             }
    //         }
        }
    }
</script>
<style scoped>
    .text{
        padding-top: 0.5em;
        padding-left: 20em;
    }

    .formWrapper {
        padding: 2em;
    }

    .ss{
        color: red;
    }
    .login-page {
      padding-left: 33em;
       padding-right: 33em;
    }
    .fields{ 
      padding-left: 1em;
      padding-right: 1em;
    }
</style>