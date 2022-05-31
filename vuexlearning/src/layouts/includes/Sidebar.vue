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
            size="1"
            max-height="75"
            max-width="150"
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
                    <template v-if="drawer">
                        <v-btn icon @click.stop="logout()">
                            <v-icon>mdi-logout-variant</v-icon>
                        </v-btn>
                    </template>
                    <template v-else>
                        <v-btn block @click.stop="logout">
                          Logout
                        </v-btn>
                    </template>
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
          { title: 'Employees', icon: 'mdi-forum', url:'/students' },
          { title: 'Instructors', icon: 'mdi-view-dashboard', url:'/instructors' },
          { title: 'Subjects', icon: 'mdi-forum', url:'/subjects' },
          { title: 'Grades', icon: 'mdi-view-dashboard', url:'/grades' },
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