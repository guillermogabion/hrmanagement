<template>

    <div>
        
        <Sidebar/>
  
        <!-- <v-app-bar app>
        
            <v-icon>mid-heart</v-icon>
            <v-toolbar-title>Vue Practice</v-toolbar-title>
            <v-spacer></v-spacer>
        </v-app-bar> -->
        <v-main >
            <router-view></router-view>
        </v-main>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue'

export default {
    components: {
        Sidebar,
 
    }
}
</script>