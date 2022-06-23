<template>
     <v-dialog
        v-model="dialog"
        persistent
        width="30%"
    >
    <v-card>
        <v-card-title class="text-h5 grey lighten-2">
                Add New Department
        </v-card-title>
         <v-form
                ref="form"
                lazy-validation
                v-model="valid"
                class="padding"
            >
            <v-col md="8">
                  <v-text-field
                    label="Department Name"
                    v-model="payload.department"
                    required
                    :rules="DepartmentRules"
                    ></v-text-field>

                    <v-text-field
                    label="Department Description"
                    v-model="payload.description"
                    required
                    :rules="DescriptionRules"
                    ></v-text-field>
            </v-col>
             <v-spacer></v-spacer>
             <v-btn
                
                color="primary"
                small
                dark
                width="70px"
                @click="AddNew()"
                @click.prevent = "$emit('close')"
                :disabled="!valid"> Save </v-btn>
                <v-btn
                
                color="primary"
                dark
                small
                width="70px"
                @click.prevent="$emit('close')"
                > Close </v-btn>
              <v-spacer></v-spacer>
        </v-form>   
    </v-card>
    </v-dialog>
</template>

<script>
import axios from '@/plugins/axios';
export default {
    data() {
        return {
            valid: true,
            DepartmentRules: [
            v => !!v || 'Department Name is required',
            // v => (v && v.length <= 20) || 'First Name must be less than 20 characters',
            ],
            DescriptionRules: [
            v => !!v || 'Department Description is required',
            // v => (v && v.length <= 20) || 'Last Name must be less than 10 characters',
            ],
            payload : {
                department: '',
                description: ''
            }
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
        AddNew(){
            axios.post('AddDepartment', this.payload).then((res) => {
                console.log(res)
                
            })
        }
},
}
</script>