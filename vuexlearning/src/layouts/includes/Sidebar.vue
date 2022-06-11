<template>

  <v-card
    class="pa-12"
    color="indigo darken-2"
    flat
  >
    <v-card
      elevation="12"
      width="256"
    >
        <div id="nav">
          <v-navigation-drawer
            :value="drawer"
            :clipped="$vuetify.breakpoint.lgAndUp"
            app
            floating
            permanent
            style="top:8px !important; min-height:100vh !important;"
          >
          <v-img contain
            :src="logo"
            size="2"
            max-height="90"
            max-width="300"
            class="mx-auto"
            />
            <v-list
              dense
             
            >
            
            
              <v-list-item
                v-for="item in items"
                :key="item.title"
                link :to="item.url"
              >
              
                <v-list-item-icon>
                  <v-icon>{{ item.icon }}</v-icon>
                </v-list-item-icon>

                <v-list-item-content>
                  <v-list-item-title>{{ item.title }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list>
              <template v-slot:append>
                <div class="pa-2">
                    
                    <v-btn block @click.stop="logout">
                          Logout
                    </v-btn>
                </div>
            </template>
          </v-navigation-drawer>
        </div>
    </v-card>
  
  </v-card>
  

</template>


<script>
import logo from '@/assets/images/logo.png'
  export default {
      props: {
      source: String,
    },
    computed : {
        drawer() {
            return this.$store.state.sidebar
        }   
    },
    data () {
      return {
          logo,
        items: [
          { title: 'Dashboard', icon: 'mdi-view-dashboard', url:"/dashboard" },
          { title: 'Employees', icon: 'mdi-forum', url:'/employee' },
          { title: 'Department', icon: 'mdi-view-dashboard', url:'/department' },
          { title: 'Attendance', icon: 'mdi-forum', url:'/attendance' },
          { title: 'Leave Requests', icon: 'mdi-view-dashboard', url:'/leave' },
          { title: 'Announcements', icon: 'mdi-view-dashboard', url:'/announcements' },
         
        ],
      }
    },

    methods: {
       logout() {
        localStorage.setItem('token', '')
        location.reload();
      },
    }
  }
</script>

<style>
* {
  margin-left : 0;
  padding-top : 4em;
}

.v-list-item--dense .v-list-item__content, .v-list--dense .v-list-item .v-list-item__content {
  padding: 20px 0 !important;
  padding-left: 10px !important;
  font-size: 50px !important;
}
</style>