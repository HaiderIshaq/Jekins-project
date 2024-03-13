<template>
    <div>
        <button class="btn btn-primary job-button job-button2 pt-2 pb-2" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus-circle fa-2x text-white"  style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Insurance survey (Via Intimating Person)</span>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Select Intimating Person</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style=" overflow-y:inherit !important;">
                     <div class="form-group row">
                        <label class="col-md-2" for="company">Intimating Person: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <Select id="task" label="text"
                            :class="[{ invalid: $v.intimatingperson.$error }, 'mySelect']" v-model="intimatingperson"  :options="intimatingpersons"></Select>
                            <div v-if="$v.intimatingperson.$error">
                                <p class="text-danger" v-if="!$v.intimatingperson.required">
                                    Required
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Vehicle: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <Select id="task" label="text"
                            :class="[{ invalid: $v.vehicle.$error }, 'mySelect']" @input="getMake()" v-model="vehicle" :options="vehicles"></Select>
                            <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row pb-3" v-show="vehicle.text=='Other'">
                        <label class="col-md-2" for="company"> </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="vehicleOther">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>    
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Manufacture: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="manufacture">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                
 
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Client Name: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="insuredName">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Client Number: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="insuredConNum">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Contact Person: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="contactPerson">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Location: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <textarea class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="location"></textarea>    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Reg No: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="regNo">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Engine no: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" style="height: 28px;font-size: 12px;" v-model="engineNo">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Chassis No: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input class="form-control form-control-sm" v-model="chassisNo" style="height: 28px;font-size: 12px;">    
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>
                    <div class="form-group row pb-3">
                        <label class="col-md-2" for="company">Surveyor: </label>
                        <div class="col-md-4 pl-0 pr-0">
                            <Select id="task" label="text"
                            :class="['mySelect']" v-model="surveyor" :options="surveyors"></Select>
                            <!-- {{surveyor.value}} -->
                            <!-- <div v-if="$v.vehicle.$error">
                                <p class="text-danger" v-if="!$v.vehicle.required">
                                    Required
                                </p>
                            </div> -->
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" v-if="!saveButton" class="btn btn-primary" @click="onComplete()">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
 import {
       required,
       minLength,
       between,
       email
   } from "vuelidate/lib/validators";
   import axios from "axios";
   import vSelect from "vue-select";
   import vMultiselect from "vue-multiselect";
   import "vue-select/dist/vue-select.css";
   import Autocomplete from "@trevoreyre/autocomplete-vue";
   import "@trevoreyre/autocomplete-vue/dist/style.css";
export default {
    props:{
        usercompany: String,
        usertoken: String,
        usercompanyname: String,
        usercompanyprefix: String
    },
    data(){
        return{
            intimatingperson: "",
            intimatingpersons: [],
            vehicle: "",
            vehicleOther: "",
            contactPerson: "",
            vehicles: [],
            surveyors: [],
            surveyor: "",
            manufacture: "",
            insuredName: "",
            insuredConNum: "",
            location: "",
            engineNo: "",
            regNo: "",
            chassisNo: "",
            saveButton: false,

        }
    },
     components: {
           Select: vSelect,
           MultiSelect: vMultiselect,
           Autocomplete,
       },
    mounted(){
       this.getPersons();
       this.getVehicles();
        this.getSurveyors();
    
    },
    methods:{
        onComplete(){
                if (this.$v.form.$invalid) {
                   this.$v.form.$touch();
                   var isValid = !this.$v.form.$invalid;
                   this.$emit("on-validate", this.$data, isValid);
                   return isValid;
               } else {
                    this.addJob();
               }
        },
        getSurveyors() {
               this.surveyors = [];
                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
               axios.get("/api/getPrismSurveyors", {
                       headers: headers,
                   }).then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.surveyors.push({
                           text:obj.name+' ('+obj.city_name+')',
                           value: obj.id
                       });
                   });
               });
           },
        getMake() {
               this.manufacture = '';
                if(this.vehicle.value!=0)
                {
                    const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
                    };
                    axios.get("/api/getMake/"+this.vehicle.value, {
                            headers: headers,
                        }).then((res) => {
                            this.manufacture=res.data;
                    });
                }
                
           },
        addJob(){

            this.saveButton=true;
            const jobData={
                person:this.intimatingperson.value,
                vehicle:this.vehicle.value,
                vehicle_other:this.vehicleOther,
                manufacture:this.manufacture,
                name_of_insured:this.insuredName,
                c_no_of_insured:this.insuredConNum,
                contact_person:this.contactPerson,
                location:this.location,
                reg_no:this.regNo,
                engine_no:this.engineNo,
                chassis_no:this.chassisNo,
                surveyor:this.surveyor.value
            };
            // console.log(jobData);
                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
            axios.post("/api/addJobByPerson",jobData,{
                headers:headers
            })
            .then((res)=>{
                alert('Job Created Successfully');
                window.location='edit/'+res.data;
            this.saveButton=false;

            }).catch((error)=>{
                alert('Something went wrong please do not try again inform admin first');
            this.saveButton=false;

            });
        },
        getPersons() 
        {
               this.intimatingpersons = [];
               axios.get("/getIntimatingPerson").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.intimatingpersons.push({
                           text: obj.name,
                           value: obj.id
                       });
                   });
               });
        },
        getVehicles() 
        {
               this.vehicles = [];
               axios.get("/getVehicles").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.vehicles.push({
                           text: obj.make,
                           value: obj.id
                       });
                   });
                    this.vehicles.push({
                           text: 'Other',
                           value: 0
                       });
               });
        },

    },
    validations:{
        intimatingperson: {
               required
           },
            vehicle: {
               required
           },
           form:[
             "intimatingperson",
             "vehicle"
           ]
    }
}
</script>

<style>
.mySelect {
   height: 30px !important;
   font-size: 12px !important;
   }
</style>