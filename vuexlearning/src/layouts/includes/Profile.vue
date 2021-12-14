<template>
  <div> 
    <v-avatar
  
    
      class="clicker"
    >
      <v-avatar size="43px">
        <img
          :alt="users.image"
          :src="users.pic? users.pic : user_logo"
        >
      </v-avatar>
    </v-avatar>

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