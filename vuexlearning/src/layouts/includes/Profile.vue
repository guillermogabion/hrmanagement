<template>
  <div>
    <v-menu
      button
      offset-y
      content-class="bubble-menu"
      style="z-index:999"
    >  
   
      <template v-slot:activator="{ on }">
        <v-avatar
          color="orange"
          v-on="on"
          class="clicker"
        >
          <v-avatar size="49px">
            <img
              :alt="users.image"
              :src="users.pic? users.pic : user_logo"
            >
          </v-avatar>
        </v-avatar>
      </template>
      <v-list
        dense
        class="clicker"
      >
        <v-list-item
          dense
          class="text-capitalize"
          
        >edit profile</v-list-item>
        <v-list-item
          dense
          class="text-capitalize"
         
        >logout</v-list-item>
      </v-list>    
    </v-menu>
   
  </div>
</template>
<script>
  import user_logo from '../../assets/images/man.png'
//   import axios from '@/plugins/axios'
  import logo from '../../assets/images/man.png'
  export default {
    data() {
      return {
     
        logo,
        user_logo,
        users: {
          id: '',
          first_name: '',
          username: '',
          image: '',
        },
        dialogNotif:false,
        dialogNotifAdmin:false,
       
        dialog:false,
          formData: {
          password: '',
          confirm:'',
        },
      }
    },
    
  }
</script>
<style scoped>
  .cs{
    border-radius: 100%;
  }
  .xx{
    padding-left: 1em;
    padding-right: 1em;
  }
</style>