<template>
    <div>
          <div class="row">
            <div class="col-md-12" style="padding:8px 0px 0px 0px">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            id="home-tab"
                            data-toggle="tab"
                            href="#home"
                            role="tab"
                            aria-controls="home"
                            aria-selected="true"
                            >Summary</a
                        >
                    </li>
                    <!-- <li class="nav-item">
                        <a
                            class="nav-link"
                            id="location-tab"
                            data-toggle="tab"
                            href="#location"
                            role="tab"
                            aria-controls="location"
                            aria-selected="false"
                            >Aging</a
                        >
                    </li> -->
                    <!-- <li class="nav-item">
                        <a
                            class="nav-link"
                            id="comment-tab"
                            data-toggle="tab"
                            href="#comment"
                            role="tab"
                            aria-controls="comment"
                            aria-selected="false"
                            >Target</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="comment-tab"
                            data-toggle="tab"
                            href="#comment"
                            role="tab"
                            aria-controls="comment"
                            aria-selected="false"
                            >Business</a
                        >
                    </li> -->
                    <!-- <li class="nav-item">
                        <a
                            class="nav-link"
                            id="comment-tab"
                            data-toggle="tab"
                            href="#comment"
                            role="tab"
                            aria-controls="comment"
                            aria-selected="false"
                            >Billing</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="comment-tab"
                            data-toggle="tab"
                            href="#comment"
                            role="tab"
                            aria-controls="comment"
                            aria-selected="false"
                            >Received</a
                        >
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            id="comment-tab"
                            data-toggle="tab"
                            href="#comment"
                            role="tab"
                            aria-controls="comment"
                            aria-selected="false"
                            >Receivable</a
                        >
                    </li> -->
                    <li class="nav-item ml-auto">
                        <button
                            class="btn btn-primary "
                            style="margin-right:10px;font-size:12px"
                        >
                            Download
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="home"
                role="tabpanel"
                aria-labelledby="comment-tab"
            >
                <div class="row">
                    <div class="table-responsive">


                        <div style="text-align:center" class="col-md-12 col-sm-12" v-show="loading">
                                <img src="images/loader.gif" alt="" height="150" width="150">

                        </div>
                        <div v-show="!loading">
                             <component

                            :is="'listing'"

                            :columnis="columnis"
                        ></component>
                            <table class="table table-striped table-hover display" v-if="statsIs" id="myTable">

                                <thead class="thead-dark">
                                    <tr scope="row">
                                        <th class="td">S#</th>
                                        <th class="td">{{statTypeis}}</th>
                                        <th class="td">Opening</th>
                                        <th class="td">Added</th>
                                        <th class="td">Closed</th>
                                        <th class="td">Cancelled</th>
                                        <th class="td">Hold</th>
                                        <th class="td">Balance</th>
                                        <th class="td">Share %</th>
                                        <th class="td">No Activity</th>
                                    </tr>
                                </thead>
                                <tbody
                                    style="text-align:right;height: 100px; overflow: scroll"
                                >

                                    <tr
                                        scope="row"
                                        v-for="(site, k) in sites"
                                        :key="k"
                                    >
                                        <td class="td">{{ 1 + k }}</td>
                                        <td class="td">{{ site.region }}</td>
                                        <td class="td">{{ Number(site.opening).toLocaleString() }}</td>
                                        <td class="td">{{ Number(site.added).toLocaleString() }}</td>
                                        <td class="td">{{ Number(site.closed).toLocaleString() }}</td>
                                        <td class="td">{{ Number(site.cancelled).toLocaleString() }}</td>
                                        <td class="td">{{ Number(site.hold).toLocaleString() }}</td>
                                        <td class="td">{{ Number(site.balance).toLocaleString() }}</td>

                                        <td class="td">
                                            {{
                                                Number(
                                                    (
                                                        (site.balance / totalBalance) *
                                                        100
                                                    ).toFixed(2)
                                                )
                                            }}
                                        </td>

                                        <td class="td">{{ Number(site.no).toLocaleString() }}</td>

 
                                    </tr>
                                </tbody>
                                <tfoot  style="text-align:right">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="result-amount" style="">{{ totalOpening }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalAdded).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalClosed).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(Math.round(totalCancelled)).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalHold).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalBalance).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalNo).toLocaleString() }}</span>

                                        </td>



                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button @click='getModal("Opening")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Added")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Closed")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Cancelled")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Balance")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
 
                                        </td>
                                        <td>
                                            <button  @click='getModal("No Activity")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                        </td>


                                    </tr>
                                </tfoot>
                            </table>

                            <table v-else>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div
                class="tab-pane fade"
                id="location"
                role="tabpanel"
                aria-labelledby="comment-tab"
            >
                <div class="row">
                    <div class="table-responsive">

                        <div style="text-align:center" class="col-md-12 col-sm-12" v-show="loading">
                                <img src="images/loader.gif" alt="" height="150" width="150">

                        </div>
                        <table class="table table-hover display" id="myTable">
                            <thead class="thead-dark">
                                <tr scope="row">
                                    <th class="td">S#</th>
                                    <th class="td">Region</th>
                                    <th class="td">Within 30 Days</th>
                                    <th class="td">30-60 Days</th>
                                    <th class="td">60-90 Days</th>
                                    <th class="td">90-120 Days</th>
                                    <th class="td">Above 120 Days</th>
                                    <th class="td">Total</th>
                                </tr>
                            </thead>
                            <tbody style=";height: 100px; overflow: scroll">

                                </tbody>
                                
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Listing from "./Listing.vue";

export default {
    props:{
        sites:Array,
        statsIs:Boolean,
        loading:Boolean,
        columnis:String,
        statsBy:String,
        statsCat:String
    },
    computed:{
        totalOpening () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.opening), 0);
         },
        totalAdded () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.added), 0);
         },
        totalClosed () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.closed), 0);
         },
        totalCancelled () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.cancelled), 0);
         },
        totalHold () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.hold), 0);
         },
          totalBalance () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.balance), 0);
         },
          totalNo () {
             return this.sites.reduce((acc, cur) => acc + Number(cur.no), 0);
         },
        statTypeis(){
             let type=this.statsBy;
             if(type=="Region")
             {
                 return "Region";
             }
            if(type=="Bank")
             {
                 return "Bank";

             }
            if(type=="Customer")
             {
                 return "Customer";

             }
            if(type=="City")
             {
                 return "City";

             }
         }
    },
    components: {
    'listing':Listing,
    
    },
    methods:{
        getModal(type){
    //    alert(type);
        this.columnis=type;
        $('#listingModal').modal('show');

        },
    }
}
</script>

<style  scoped>
.table th,
.table td {
    padding: 0.35rem;
    font-weight: bold;
    font-size: 14px;
}

.table .thead-dark th {
    background-color: #275129;
    border-color: #275129;
    font-size: 14px;
}

.result-amount{
padding-top:5px;
padding-bottom:5px;
color:red;
font-weight:bold;
}
</style>