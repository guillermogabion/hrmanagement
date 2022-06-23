<template>
    <v-dialog
        v-model="dialog"
        persistent
        width="50%"
    >
        <v-card>
            <v-card-title class="text-h5 grey lighten-2">
                Send A Request {{this.getNumberOfDays(this.payload.dateEnd, this.payload.dateStart)}}
            </v-card-title>
            <v-list
            three-line
            subheader
            >
            <v-text-field
                label="Search"
                filled
                rounded
                dense
                style="padding-top: 40px;  padding-left: 2em; padding-right: 2em;"
                v-model="payload.user_id"
            >
            </v-text-field>
            </v-list>
            <v-form
                ref="form"
                lazy-validation
                v-model="valid"
                class="padding"
            >
            <v-row no-gutters>
                <v-col md="6.5" style="padding-left: 4em;">
                    
                    <v-flex xs10>
                            <v-text-field
                            v-model="payload.user_id"
                            label="First Name"
                            required
                            readonly
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                            v-model="payload.first_name"
                            label="Last Name"
                            required
                            readonly
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                            label="Designation ID"
                            v-model="payload.designation_id"
                            required
                            readonly
                            ></v-text-field>
                    </v-flex>
                     <v-flex xs10>
                            <v-text-field
                            label="Department"
                            v-model="payload.department"
                            required
                            readonly
                            ></v-text-field>
                    </v-flex>
                    
                </v-col>
                <v-col md="6">
                    <span>Request For</span>
                    <v-flex xs10>
                        <v-select dense v-model="payload.type" :items="type" item-text="request" item-value="number"
                            persistent-hint return-object prepend-icon="mdi-map">
                        </v-select>    
                    </v-flex>
                    <!-- <v-flex xs10>
                            <v-text-field
                            label="Leave/Absent Start From"
                            v-model="payload.from"
                            required
                            :rules="dateStartRules"
                            ></v-text-field>
                    </v-flex> -->
                    <v-menu
                        v-model="menu2"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="payload.dateStart"
                            label="Start Date"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                        </template>
                        <v-date-picker
                        v-model="payload.dateStart"
                        @input="menu2 = false"
                        ></v-date-picker>
                    </v-menu>
                    <v-menu
                        v-model="menu"
                        :close-on-content-click="false"
                        :nudge-right="40"
                        transition="scale-transition"
                        offset-y
                        min-width="auto"
                    >
                        <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="payload.dateEnd"
                            label="End Date"
                            prepend-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                        ></v-text-field>
                        </template>
                        <v-date-picker
                        v-model="payload.dateEnd"
                        @input="menu = false"
                        ></v-date-picker>
                    </v-menu>
                    <!-- <v-flex xs10>
                            <v-text-field
                             label="Leave/Absent Ends To"
                            required
                            v-model="payload.to"
                            :rules="dateEndRules"
                            ></v-text-field>
                    </v-flex> -->
                    <v-flex xs10>
                            <v-text-field
                                 label="No. of Days"
                                required
                                v-model="payload.purpose"
                            ></v-text-field>
                    </v-flex>
                    <v-flex xs10>
                            <v-text-field
                                 label="Purpose"
                                required
                                v-model="payload.purpose"
                            ></v-text-field>
                    </v-flex>
                   
                    
                </v-col>
            </v-row>    
            <v-card-actions>
                <v-spacer></v-spacer>
                <div style="padding-right: 2%;">
                    <v-btn
                        color="primary"
                        small
                        dark
                        width="70px"
                     
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
                        @click="reset()"
                    >
                        Close
                    </v-btn>
                </div>
                <v-spacer></v-spacer>
            </v-card-actions>

            
            </v-form>
        </v-card>
        
    </v-dialog>
</template>

<script>

export default {
    data() {
        return {
            date: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
            menu: false,
            modal: false,
            menu2: false,
            valid: true,
            type:[
                {request: 'Leave', number:'1', icon:'mdi-alert-circle'},
                {request: 'Absent', number:'2', icon:'mdi-alert-circle'},
            ],
            payload: {
                user_id: '',
                designation: '',
                from: '',
                to: '',
                purpose: '',
                type: {request:'Leave', number:'1', icon:'mdi-alert-circle'},
                dateStart: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),
                dateEnd: (new Date(Date.now() - (new Date()).getTimezoneOffset() * 60000)).toISOString().substr(0, 10),

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
        getNumberOfDays(end, start) {
            const dateStart = new Date(start);
            const dateEnd = new Date(end);
            const oneDay = 1000 * 60 * 60 * 24;
            const diffInTime = dateEnd.getTime() - dateStart.getTime();
            const diffInDays = Math.round(diffInTime / oneDay);
            return diffInDays;
        }

        
    },
}

// function getNumberOfDays(start, end) {
//     const dateStart = new Date(start);
//     const dateEnd = new Date(end);

//     // One day in milliseconds
//     const oneDay = 1000 * 60 * 60 * 24;

//     // Calculating the time difference between two dates
//     const diffInTime = dateEnd.getTime() - dateStart.getTime();

//     // Calculating the no. of days between two dates
//     const diffInDays = Math.round(diffInTime / oneDay);

//     return diffInDays;
// }

// console.log(getNumberOfDays("2/1/2021", "3/1/2021"));
</script>

<style>
.v-date-picker-title__date{
    display: none;
}
</style>