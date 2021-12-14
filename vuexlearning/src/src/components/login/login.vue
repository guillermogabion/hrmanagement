<template>
  <div class="login-page">
        <v-card
          class="mx-auto"
          max-width="344"
          outlined
        >
          <v-list-item three-line>
            <v-list-item-content>
              <div class="text-overline mb-4 login-page-title">
               Login Page
              </div>
            </v-list-item-content>
          </v-list-item>
            <v-text-field
              v-model="email"                   
              color="purple darken-2"
              label="First name"
              required
              class="login-page-text-field"
            ></v-text-field>
            <v-text-field
              v-model="password"          
              color="blue darken-2"
              label="Password"
              required
               class="login-page-text-field"
            ></v-text-field>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              outlined  
              @click="Login()"
              color="primary"
            >
              Login
            </v-btn>
            <v-spacer></v-spacer>
          </v-card-actions>
        </v-card>
  </div>
</template>





<script>

   import { login } from "@/repositories/user.api";
export default {
    data(){
        return {
       
            email: '',
            password: ''
     
        }
    },
    methods: {
      Login() {
          
                const login_data = {
                    email: this.email,
                    password: this.password
                }
              
                  login(login_data).then(({data}) => {
                      // this.$store.commit('login', data)
                      localStorage.setItem('token', data.access_token)
                      this.$router.push({ name: "dashboard"});
                  }).catch((errors)=> {
                      console.log(errors)
                     
                  })
                        
                    

                // if(this.email == '123@12.com' && this.password == '123'){
                //   this.$router.push({ name: "dashboard" });
                // }
              
            },
       
    }
}



</script>

<style>
.login-page {

  padding-top : 10em;
}
.login-page-text-field{
  padding: 0.5em;
}
.login-page-text-button {
  padding-left: 3em;
  padding-right: 3em;
}
.login-page-title{
  padding-left: 6.5em;
}

</style>

