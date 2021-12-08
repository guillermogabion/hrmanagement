<template>
    <div>
        this is dashboard
        {{ this.users }}
    </div>
</template>

<script>
import axios from '../../plugins/axios'
export default {

     data: () => ({
         users: []
    }),
    methods : {
        getdate() {
            axios.get('index').then(res => {
                this.users = res.data
                console.log(res)
            })
        }
    },
    mounted(){
        this.getdate()
    }
    
}
</script>