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
                    <li class="nav-item">
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
                    </li>
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
                                        <th class="td">Billed</th>
                                        <th class="td">Received</th>
                                        <th class="td">Deduction</th>
                                        <th class="td">Discount</th>
                                        <th class="td">Written Off</th>
                                        <th class="td">Excess</th>
                                        <th class="td">Balance</th>
                                        <th class="td">Old Debts</th>
                                        <th class="td">Share %</th>
                                        <th class="td">Income Tax</th>
                                        <th class="td">S/Tax (W/Held)</th>
                                        <th class="td">S/Tax (Payable)</th>
                                        <th class="td">Bank Charges</th>
                                    </tr>
                                </thead>
                                <tbody
                                    style="text-align:right;height: 100px; overflow: scroll"
                                >

                                    <tr
                                        scope="row"
                                        v-for="(stat, k) in stats"
                                        :key="k"
                                    >
                                        <td class="td">{{ 1 + k }}</td>
                                        <td class="td">{{ stat.region }}</td>
                                        <td class="td">{{ Number(stat.opening).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.billed).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.received).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.deduction).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.discount).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.writtenoff).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.excess).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.balance).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.olddebt).toLocaleString() }}</td>

                                        <td class="td">
                                            {{
                                                Number(
                                                    (
                                                        (stat.balance / totalBalance) *
                                                        100
                                                    ).toFixed(2)
                                                )
                                            }}
                                        </td>

                                        <td class="td">{{ Number(stat.incometax).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.withhold).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.payable).toLocaleString() }}</td>
                                        <td class="td">{{ Number(stat.bankcharges).toLocaleString() }}</td>
                                    </tr>
                                </tbody>
                                <tfoot  style="text-align:right">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="result-amount" style="">{{Number(totalOpening).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalBilled).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalReceived).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(Math.round(totalDeduction)).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalDiscount).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalWrittenoff).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalExcess).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalBalance).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalOlddebt).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount"></span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalIncomeTax).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalWithhold).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalPayable).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalBankCharges).toLocaleString() }}</span>

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
                                            <button  @click='getModal("Billed")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Received")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Deduction")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Discount")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Written Off")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Written Off")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Balance")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Old Debts")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>

                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
                            <tbody
                                    style=";height: 100px; overflow: scroll"
                                >

                                    <tr
                                        scope="row"
                                        v-for="(aging, k) in agings"
                                        :key="k"
                                    >
                                        <td class="td">{{ 1 + k }}</td>
                                        <td class="td">{{ aging.region }}</td>
                                        <td class="td">{{ Number(aging.in30day).toLocaleString() }}</td>
                                        <td class="td">{{ Number(aging.in30to60day).toLocaleString() }}</td>
                                        <td class="td">{{ Number(aging.in60to90day).toLocaleString() }}</td>
                                        <td class="td">{{ Number(aging.in90to120day).toLocaleString() }}</td>
                                        <td class="td">{{ Number(aging.above120).toLocaleString() }}</td>
                                        <td class="td">{{ Number(aging.Balance).toLocaleString() }}</td>


                                    </tr>
                                </tbody>
                                <tfoot  >
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalin30day).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalin30to60day).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalin60to90day).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalin90to120day).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalabove120).toLocaleString() }}</span>

                                        </td>
                                        <td>
                                            <span class="result-amount">{{ Number(totalagingbalance).toLocaleString() }}</span>

                                        </td>



                                    </tr>
                                    <tr >
                                        <td></td>
                                        <td>

                                        </td>
                                        <td>
                                            <button  @click='getModal("Billed")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Received")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Deduction")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Discount")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Written Off")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>
                                        <td>
                                            <button  @click='getModal("Balance")' class="btn btn-primary">
                                                List
                                            </button>
                                        </td>

                                    </tr>
                                </tfoot>
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
        stats:Array,
        agings:Array,
        statsIs:Boolean,
        loading:Boolean,
        columnis:String,
        statsBy:String,
        statsCat:String
    },
    computed:{
        totalOpening () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.opening), 0);
         },
        totalBilled () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.billed), 0);
         },
        totalReceived () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.received), 0);
         },
        totalDeduction () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.deduction), 0);
         },
        totalDiscount () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.discount), 0);
         },
        totalWrittenoff () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.writtenoff), 0);
         },
        totalExcess () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.excess), 0);
         },

          totalBalance () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.balance), 0);
         },
          totalOlddebt () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.olddebt), 0);
         },
         totalIncomeTax () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.incometax), 0);
         },
         totalWithhold () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.withhold), 0);
         },
         totalPayable () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.payable), 0);
         },
         totalBankCharges () {
             return this.stats.reduce((acc, cur) => acc + Number(cur.bankcharges), 0);
         },
           totalin30day () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.in30day), 0);
         },
           totalin30to60day () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.in30to60day), 0);
         },
           totalin60to90day () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.in60to90day), 0);
         },
           totalin90to120day () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.in90to120day), 0);
         },
           totalabove120 () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.above120), 0);
         },
           totalagingbalance () {
             return this.agings.reduce((acc, cur) => acc + Number(cur.Balance), 0);
         },
        statTypeis(){
             let type=this.statsBy;
             if(type=="Region")
             {
                 return "Region";
             }

             if(type=="Insurer")
             {
                 return "Insurer";
             }
             if(type=="Category")
             {
                 return "Category";
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
    font-size: 12px;
}

.table .thead-dark th {
    background-color: #275129;
    border-color: #275129;
    font-size: 12px;
}

.result-amount{
padding-top:5px;
padding-bottom:5px;
color:red;
font-weight:bold;
}
</style>