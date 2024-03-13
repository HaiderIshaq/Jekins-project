<style lang="scss" scoped>
body {
    font-size: 14px;
}
.nav-tabs .nav-link {
    border-radius: 0px;
    font-size: 13px;
}
.nav-tabs {
    border-bottom: 3px solid #275129;
}

.table th,
.table td {
    padding: 0.35rem;
}

.td {
    // width: 200px !important;
}
.table .thead-dark th {
    background-color: #275129;
    border-color: #275129;
    font-size: 12px;
}
input[type="text"],
input[type="date"],
input[type="number"] {
    height: 26px !important;
    font-size: 11px !important;
}

.result-amount{
padding-top:5px;
padding-bottom:5px;
color:red;
font-weight:500;
}
</style>

<template>
    <div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
        <!-- <a href="/home" class="btn btn-primary">Back</a>
<br><br> -->
        <div class="row">
         
            <div class="col-md-12" style="padding:6px 55px">
                <div class="row">
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Legal Service"
                        />
                        <label for="">Legal Service</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Supervision"
                        />
                        <label for="">Supervision</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Clearance"
                        />
                        <label for="">Clearance</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"
                            v-model="service"

                            value="Inspection"
                        />
                        <label for="">Inspection</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"
                            v-model="service"

                            value="Livestock"
                        />
                        <label for="">Livestock</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"
                            v-model="service"

                            value="Prism"
                        />
                        <label for="">Prism</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="IBR"
                        />
                        <label for="">IBR</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Muccadam"
                        />
                        <label for="">Muccadam</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Valuation"
                        />
                        <label for="">Valuation</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Income Estimation"
                        />
                        <label for="">I/E</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="Verification"
                            v-model="service"
                        />
                        <label for="">A/V</label>
                    </div> -->
                    <!-- <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="Valuation"
                        />
                        <label for="">Valuation</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="BIR"
                        />
                        <label for="">BIR</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="service"
                            value="IBR"
                        />
                        <label for="">IBR</label>
                    </div>
 
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="LCR"
                            v-model="service"
                        />
                        <label for="">LCR</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="MCR"
                            v-model="service"
                        />
                        <label for="">MCR</label>
                    </div>
                    <div class="form-check col">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="MVR"
                            v-model="service"
                        />
                        <label for="">MVR</label>
                    </div> -->

                </div>
            </div>
            <div class="col-md-12" style="padding:0px 34px 3px 55px">
                <div class="row">
                    <div class="form-check pr-3">
                        <input
                            class="form-check-input"
                            type="radio"
                            value="Activity"
                            v-model="statsType"
                        />
                        <label for="">Activity</label>
                    </div>
                    <div class="form-check ">
                        <input
                            class="form-check-input"
                            type="radio"
                            value="Site"
                            v-model="statsType"

                        />
                        <label for="">Site</label>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div
                                class="col-3"
                                style="font-size: 13px;  padding: 4px 8px 8px 18px;"
                            >
                                <b>
                                    From:
                                </b>
                            </div>
                            <div class="col-9">
                               <datepicker  :input-class="['form-control']"  :disabledDates="disabledDates"  valueType="format"  v-model="fromDate" ></datepicker>

                                <!-- <input
                                    type="date"
                                    class="form-control"
                                    name=""
                                    id=""
                                    v-model="fromDate"
                                /> -->
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div
                                class="col-3"
                                style="font-size: 13px;  padding: 4px 8px 8px 18px;"
                            >
                                <b>
                                    To:
                                </b>
                            </div>
                            <div class="col-9">
                               <datepicker  :input-class="['form-control']" :disabledDates="disabledDates"  valueType="format"   v-model="toDate" ></datepicker>

                                <!-- <input
                                    type="date"
                                    class="form-control"
                                    name=""
                                    id=""
                                    v-model="toDate"

                                /> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <button class="btn btn-primary" @click="getData()" style="font-size:12px">
                            Go
                        </button>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div
                                class="col-3"
                                style="font-size: 13px;padding: 4px 8px 8px 18px;"
                            >
                                <b>Region:</b>
                            </div>
                            <div class="col-9 mt-1">
                            <Select  label="text" style="font-size:13px"  v-model="region"  :options="regions" ></Select>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12" style="padding:0px 55px 0px 55px">
                <div class="row">
                    <div class="form-check col-md-1">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="statsBy"
                            value="Region"
                        />
                        <label for="">Region</label>
                    </div>
                 
                    <div class="form-check col-md-1" >
                        <input
                            class="form-check-input"
                            type="radio"

                            value="Insurer"
                            v-model="statsBy"
                        />
                        <label for="">Insurer</label>
                    </div>
                    <div class="form-check col-md-2">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="statsBy"
                            value="Category"
                        />
                        <label for="">Category</label>
                    </div>
                    <!-- <div class="form-check col" >
                        <input
                            class="form-check-input"
                            type="radio"

                            value="Bank"
                            v-model="statsBy"
                        />
                        <label for="">Bank</label>
                    </div>
                    <div class="form-check col" v-if="this.service!='Verification'">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="statsBy"
                            value="Customer"
                        />
                        <label for="">Customer</label>
                    </div>
                    <div class="form-check col" v-if="this.service!=='Livestock'">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="City"
                            v-model="statsBy"

                        />
                        <label for="">City</label>
                    </div> -->
                </div>
                <div class="row">
                    <div class="form-check col-md-1">
                        <input
                            class="form-check-input"
                            type="radio"

                            v-model="statsCat"
                            value="Motor"
                        />
                        <label for="">Motor</label>
                    </div>
                    <div class="form-check col-md-2">
                        <input
                            class="form-check-input"
                            type="radio"

                            value="Non-Motor"
                            v-model="statsCat"
                        />
                        <label for="">Non-Motor</label>
                    </div>
                    
                </div>
            </div>
        </div>

 
        <activity 
        v-if="statsType=='Activity'"
        :stats="stats"
        :agings="agings"
        :statsIs="statsIs"
        :loading="loading"
        :columnis="columnis"
        :statsBy="statsBy"
        :statsCat="statsCat"
        ></activity>

        <site 
        v-else-if="statsType=='Site'"
        :sites="sites"
        :statsIs="statsIs"
        :loading="loading"
        :columnis="columnis"
        :statsBy="statsBy"
        :statsCat="statsCat"
        ></site>
        
    </div>
</template>
<style classd></style>

<script>


import vSelect from "vue-select";
import axios from "axios";
import Listing from "./Listing.vue";
import Activity from "./Activity.vue";
import Site from "./Site.vue";
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import moment from 'moment';
export default {
    data() {
        return {
            stats: [],
            sites: [],
             companies:[],
             agings:[],
             regions:[{
                 text:'All',value:0
             }],
             region:"",
             company:"",
             statsCat:"Motor",
             service:"Prism",
             columnis:"",
             statsType:"Activity",
             fromDate:new Date(Date.now()),
             toDate:new Date(Date.now()),
              en: en,
            es: es,
            statsBy:"Region",
            disabledDates: {
            from:  new Date(Date.now())
            },
            statsIs:true,
            agingIs:true,
            loading:false

        };
    },
    computed:{
       
    },
    components: {
        Select: vSelect,
    'datepicker':Datepicker,
    'listing':Listing,
    'activity':Activity,
    'site':Site,

    },
    mounted() {
        this.getCompany();
        this.getStats();
        this.getAging();
        this.getRegion();
            this.getSites();

        this.region={text:'All',value:0};
        this.company={text:'K.G. TRADERS (PVT) LTD.',value:1};


    },
    methods: {
        getData(){
            this.getStats();
            this.getAging();
            this.getSites();
        },
          getRegion(){
         axios.get('/getRegion')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            let prefix="";
                            this.regions.push({ text: obj.city_name,value:obj.reg_id,prefix:obj.reg_prefix})

                        })
                    })
   },

       getCompany(){

         axios.get('/getCompany')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            let prefix="";
                            this.companies.push({ text: obj.company_name,value:obj.company_id,prefix:obj.company_prefix})

                        });
                        console.log(res.data);

                    });


        },
      getStats() {
        let type=this.statsType;


              this.loading=true;
                this.statsIs=true;
                this.stats=[];
                const params ={
                    service:this.service,
                    region:this.region.value,
                    from:this.fromDate,
                    to:this.toDate,
                    statsby:this.statsBy,
                    statsCat:this.statsCat
                };
                axios.get("/getstats",{params})
                    .then(res => {
                        res.data.forEach(obj => {

                            this.stats.push({
                                region: obj.By,
                                // opening:Math.abs(Math.round(obj.Opening)),
                                opening:obj.Opening,
                                billed: obj.Billed,
                                received: obj.Received,
                                deduction: obj.Deduction,
                                discount: obj.Discount,
                                writtenoff: obj.WrittenOff,
                                excess: obj.Excess,
                                olddebt: obj.OldDebt,
                                // balance: Math.abs(Math.round(obj.Balance)),
                                balance: obj.Balance,
                                incometax: obj.IncomeTax,
                                withhold: obj.WithHold,
                                payable: obj.Payable,
                                bankcharges: obj.BankCharges,
                                

                            });
                        });
                        console.log(this.stats);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
          
          
        },
         getSites() {
        let type=this.statsType;

        
              this.loading=true;
                this.statsIs=true;
                this.sites=[];
                const params ={
                    service:this.service,
                    region:this.region.value,
                    from:this.fromDate,
                    to:this.toDate,
                    statsby:this.statsBy,
                    statsCat:this.statsCat
                };
                axios.get("/getsites",{params})
                    .then(res => {
                        res.data.forEach(obj => {

                            this.sites.push({
                                region: obj.Region,
                                opening:obj.Opening,
                                added: obj.Added,
                                closed: obj.Closed,
                                cancelled: obj.Cancelled,
                                hold: obj.Hold,
                                balance: obj.Balance,
                                no: obj.No,


                            });
                        });
                        console.log(this.sites);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
         

        },
      getAging() {
        let type=this.statsType;

          if(type=="Activity")
          {
              this.loading=true;
                this.agingIs=true;
                this.agings=[];
                const params ={
                    service:this.service,
                    statsby:this.statsBy,
                    region:this.region.value,
                };
                axios.get("/getaging",{params})
                    .then(res => {
                        res.data.forEach(obj => {

                            this.agings.push({
                                region: obj.By,
                                in30day:obj.in30day,
                                in30to60day: obj.in30to60day,
                                in60to90day: obj.in60to90day,
                                in90to120day: obj.in90to120day,
                                above120: obj.above120,
                                Balance: obj.Balance
                            });
                        });
                        console.log(this.agings);
                        this.loading=false;
                    })
                    .catch(error => {
                        alert(error);
                        this.loading=false;

                });
          }

          else{
              this.agingIs=false;
              this.loading=true;

          }

        }
    }
};
</script>
