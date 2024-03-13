<template>
    <div class="row">
        <div class="col-md-10 mb-3">
            <h4>
                <b>
                Prism Survey Statistics

                </b>
            </h4>
        </div>  
        <!-- <div class="col-md-2 text-right" >
            <button class="btn btn-primary" >Refresh</button>
        </div> -->
        <div class="col-md-10">
            <div class="form-group row">
                <Select :options="regions" style="font-size:13px" :value="{text:'All',value:0}" v-model="region" label="text" class="col-md-3"></Select>
                <button class="btn btn-primary" @click="getStatsByRegion()">Search</button>
            </div>
        </div>      
        <div class="col-md-12 mt-3">
            <table class="table table-striped table-hover display">
                <thead class="thead-dark">
                    <tr>
                        <th>Surveyor Name</th>
                        <th>Total</th>
                        <th>Attended / Completed</th>
                        <th>Un-Attended / Active</th>
                    </tr>
                
                </thead>
                <tbody>
                    <div style="text-align:center" class="col-md-12 col-sm-12" v-show="loading">
                        <img src="images/loader.gif" alt="" height="150" width="150">

                    </div>
                    
                        <tr v-show="!loading" v-for="rec in recs" :key="rec.id" style="font-weight:400" @click="getModal(rec.id)">
                            <td> {{rec.name}}</td>
                            <td> {{rec.total}}</td>
                            <td style="color:green;font-weight:bold"> {{rec.attended}}</td>
                            <td style="color:red;font-weight:bold"> {{rec.unattended}}</td>
                        </tr>
                    
                </tbody>    
                
            </table>
            <div class="modal fade bd-example-modal-lg" id="jobsModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Surveys</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table table-striped table-hover display">
                                        <thead class="thead-dark">
                                            <th>ID</th>
                                            <th>Job ID</th>
                                            <!-- <th>Assignation</th> -->
                                            <th>Conducted On</th>
                                            <th>Insured</th>
                                            <th>Contact Person</th>
                                            <th>Remakrs</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                             <div style="text-align:center" class="col-md-12 col-sm-12" v-show="loading">
                                                    <img src="images/loader.gif" alt="" height="150" width="150">

                                            </div>
                                            
                                            <tr v-for="job in jobs" :class="{ 'red': job.status==0, 'green': job.status==1 }" :key="job.id" v-show="!loading">
                                                

                                                <td>{{job.id}}</td>
                                                <td>{{job.job_id}}</td>
                                                <td>{{job.conducted_on}}</td>
                                                <td>{{job.name_of_insured}}</td>
                                                <td>{{job.contact_person}}</td>
                                                <td>{{job.remarks}}</td>
                                                <td>
                                                    <span v-if="job.status==0">
                                                        Un-Attended
                                                    </span >
                                                        <span v-else>
                                                            Attended

                                                        </span>
                                                    <!-- {{job.status}} -->
                                                    
                                                </td>
                                                <td>
                                                    <a :href="'edit/'+job.common_id" target="_blank" class="btn btn-primary" style="font-size:12px">Edit</a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>  
    </div>

</template>
<style>
.red{
    color:red;
    font-weight:bold
}
.green{
    color:green;
    font-weight:bold
}
</style>

<script>
import vSelect from "vue-select";
import axios from "axios";
export default{
           props: {
          usertoken:String
       },
    data(){
        return{
            recs:[],
            regions:[],
            jobs:[],
            region:'',
            loading:false
        }
    },
    components:{
        'Select':vSelect
    },
    mounted(){
        this.getRegions();
        this.getStats();
    },
    methods: {
        getRegions(){
                    axios.get("/getsurveyorsregions")
                    .then(res => {
                            this.regions.push({
                                value: 0,
                                text: 'All'

                            });
                        res.data.forEach(obj => {

                            this.regions.push({
                                value: obj.region,
                                text: obj.city_name

                            });
                        });
                    })
                    .catch(error => {
                        alert(error);

                });
        },
        getModal(id){
            $('#jobsModal').modal('show');
                          this.loading=true;
                this.jobs=[];
                const params ={
                    region:this.region.value
                    // region:this.region.value,
                    // from:this.fromDate,
                    // to:this.toDate,
                    // statsby:this.statsBy
                };
                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.get("/api/getsurveysBySurveyor/"+id,{
                    headers:headers
                    // params
                    })
                    .then(res => {
                        res.data.forEach(obj => {

                            this.jobs.push({
                                id: obj.id,
                                job_id: obj.job_id,
                                status: obj.status,
                                total: obj.total,
                                common_id: obj.common_id,
                                remarks: obj.remarks,
                                conducted_on: obj.conducted_on,
                                name_of_insured: obj.name_of_insured,
                            });
                        });
                        console.log(this.jobs);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
        },      
        getStats() {


              this.loading=true;
                this.recs=[];
                // const params ={
                //     service:this.service,
                //     region:this.region.value,
                //     from:this.fromDate,
                //     to:this.toDate,
                //     statsby:this.statsBy
                // };
                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.get("/api/getsurveystats",{
                    headers:headers
                    // params
                    })
                    .then(res => {
                        res.data.forEach(obj => {

                            this.recs.push({
                                id: obj.id,
                                name: obj.name,
                                total: obj.total,
                                unattended: obj.unattended,
                                attended: obj.attended

                            });
                        });
                        console.log(this.recs);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
          
          
        },
        getStatsByRegion() {


              this.loading=true;
                this.recs=[];

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.get("/api/getsurveystatsbyregion/"+this.region.value,{
                    headers:headers
                    // params
                    })
                    .then(res => {
                        res.data.forEach(obj => {

                            this.recs.push({
                                id: obj.id,
                                name: obj.name,
                                total: obj.total,
                                unattended: obj.unattended,
                                attended: obj.attended

                            });
                        });
                        console.log(this.recs);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
          
          
        }
    },
}

</script>
