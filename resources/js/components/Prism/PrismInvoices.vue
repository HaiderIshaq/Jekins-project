<template>
    <div class="container-fluid" >
        <div  class="bg-white border-radius-4 box-shadow mb-30" style="padding:25px 25px 26px 25px">
            <h3><b>Pre-Inspection Invoice (Prism)</b></h3>
            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="">Insurers</label>
                </div>
                <div class="col-md-5">
                    <Select @input="getBranches()" label="text" style="font-size:14px" :options="insurers" v-model="selectInsurer"></Select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="">Date</label>
                </div>
                <div class="col-md-5">
                    <input type="date" v-model="date" class="form-control" >
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary" @click="searchInvoices()">Search</button>
                </div>
                
            </div>

            <div class="">
                <table class="table display" id="myTable1" style="width:100%;margin-top:30px" >
                    <thead class="thead-dark" >
                        <tr style="font-size: 13px">
                        
                        <th scope="col">Sr.no</th>
                        <th scope="col">Branch</th>
                        <th scope="col">Invoice No.</th>
                        <th scope="col">S/Tax ?</th>
                        <th scope="col">LTHD ?</th>
                        <th scope="col">STMP ?</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action </th>
                        <th scope="col">Action </th>

                        </tr>
                    </thead>
                <tbody>
                    <tr v-for="(invoice, index) in invoices" :key="index">
   

                        <td>{{index+1}}</td>
                        <td @click="getBills(invoice.invoice_id)">{{invoice.insurer_branch}}</td>
                        <td @click="getBills(invoice.invoice_id)">{{invoice.invoice_id}}</td>
                        <td>
                            <!-- <a target="_blank" :href="'/printInvoice/'+invoice.invoice_id">
                            <button class="btn btn-primary btn-sm" > Print Invoice</button>

                            </a> -->
                            
                                <input type="checkbox"  :ref="'check'+index" checked="checked"  :id="'check'+index">
                                <!-- <input type="text"  :id="'valis'+index" value="0" > -->
                            
                            
                            <!-- <button class="btn btn-primary btn-sm"  @click="printInvoice(invoice.invoice_id)"> Print Invoice</button> -->
                        </td>
                        <td>
                            <input type="checkbox"  :ref="'letter'+index" checked="checked"  :id="'letter'+index">
                        </td>
                        <td>
                            <input type="checkbox"  :ref="'stamp'+index" checked="checked"  :id="'stamp'+index">
                        </td>
                        <td >
                            <!-- <a  :href="'/printPrismReportsByInvoice/'+invoice.invoice_id" target="_blank"> -->
                            <button class="btn btn-primary btn-sm" style="font-size:12px" @click="printReports('letter'+index,'check'+index,'stamp'+index,invoice.invoice_id)" > Reports</button>

                            <!-- </a> -->
                        </td>
                         <td>
                            <!-- <a  :href="'/printPrismBillsByInvoice/'+invoice.invoice_id" target="_blank"> -->
                            <button class="btn btn-primary btn-sm" style="font-size:12px" @click="printInvoices('letter'+index,'check'+index,'stamp'+index,invoice.invoice_id)"> Invoices</button>

                            <!-- </a> -->
                        </td>
                         <td>
                            <!-- <a  :href="'/printPrismInvoice/'+invoice.invoice_id" target="_blank">
                            <button class="btn btn-primary btn-sm" > Invoice MIS</button>

                            </a> -->
                            <!-- <a  :href="'/printPrismInvoice/'+invoice.invoice_id" target="_blank"> -->
                            <button class="btn btn-primary btn-sm" style="font-size:12px" @click="printMIS('letter'+index,'check'+index,'stamp'+index,invoice.invoice_id)" > Invoice MIS</button>

                            <!-- </a> -->
                        </td>

                       
                        
                    </tr>
                </tbody>
                </table>
                    <div class="modal fade bd-example-modal-lg" id="pdfmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                            <iframe style=" width: 100%;height: 600px" :src="mypdf" ></iframe>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade bd-example-modal-lg" id="billsmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                             <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Invoice Bills : {{this.invoiceid}}</h5>
                                    <!-- <h5 class="modal-title" id="exampleModalLabel">Invoice Bills : </h5> -->
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div style="padding:0px 8px 12px 15px">
                                        <input class="form-control form-control-sm" v-model="newStax" style="height:32px" >

                                        </div>
                                        <div  style="padding-left:10px;padding-right:10px">
                                            <input  type="checkbox" v-model="taxOnTotal"> <label  >STAX on total ?</label>
                                        </div>
                                        <div >
                                            <button class="btn btn-primary" @click="changeTax()">Change Stax</button>

                                        </div>
                                        

                                        <div style="padding:0px 8px 12px 15px">
                                            <Select  label="text" style="width:200px ;font-size:13px" :options="branches" v-model="selectedBranch"></Select>
                                        </div>
                                        <div >
                                            <button class="btn btn-primary" @click="changeBranch()">Update Branch</button>

                                        </div>
                                    </div>

                                    <table  ref="mytable" class="table table-sm">
                                            <thead class="thead-dark" style="font-size:12px">
                                                <tr>
                                                <th scope="col">S #</th>
                                                <th scope="col">Job Id</th>
                                                <th scope="col">Owner Address</th>
                                                <th scope="col">Policy No.</th>
                                                <th scope="col">Engine No.</th>
                                                <th scope="col">Chassis No.</th>
                                                <th scope="col">Place of Inspection</th>
                                                <th scope="col">Pr.Fee</th>
                                                <th scope="col">Travelling</th>
                                                <th scope="col">%</th>
                                                <th scope="col">Tax</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="bill in bills" :key="bill.id">
                                                    <th  scope="row">{{bill.job_id}}</th>
                                                    <td>{{bill.bill_number}}</td>
                                                    <td>{{bill.owner_address}}</td>
                                                    <td>{{bill.policy_no}}</td>
                                                    <td>{{bill.engine_no}}</td>
                                                    <td>{{bill.chassis_no}}</td>
                                                    <td>
                                                        <!-- {{bill.place_of_survey}} -->
                                                        <input type="text"  style="font-size:11px !important;width: 250px;" name="" :value="bill.place_of_survey" class="form-control form-control-sm" :id="'placeofsurvey'+bill.id">
                                                        <input type="hidden" name="" :value="bill.place_of_survey" :id="'oldplaceofsurvey'+bill.id">
                                                    
                                                    </td>
                                                    <!-- <td>
                                                        <Select @input="updateType(bill.job_id,$event)" height="30px" label="text" style="font-size:11px" v-model="bill.product_type" :options="types" ></Select>
                                                    </td> -->
                                                    <td>
                                                        <input type="number"  style="font-size:11px !important;width:100px" name="" :value="Math.round(bill.service_charges)" class="form-control form-control-sm" :id="'servicecharges'+bill.id">
                                                        <input type="hidden" name="" :value="bill.service_charges" :id="'oldservicecharges'+bill.id">
                                                        
                                                        
                                                        </td>
                                                    <td>
                                                        <input type="number" style="font-size:11px !important;width:100px" name="" :value="Math.round(bill.travelling)"    class="form-control form-control-sm" :id="'travellingcharges'+bill.id">
                                                        <input type="hidden" name="" :value="bill.travelling" :id="'oldtravellingcharges'+bill.id">
                                                        
                                                        
                                                        </td>
                                                    <td>
                                                        <input type="hidden" name="" :value="bill.rate" :id="'taxrate'+bill.id">
                                                        <b>{{Math.round(bill.rate)}}%</b>
                                                        
                                                    </td>

                                                    <td>
                                                        <!-- {{bill.tax}} -->
                                                        <input type="number" style="font-size:11px !important;width:100px" name="" :value="bill.tax"  readonly  class="form-control form-control-sm" :id="'finaltax'+bill.id">
                                                        
                                                        </td>
                                                    <td>
                                                        <!-- {{bill.total_amount}} -->
                                                        <input type="number" style="font-size:11px !important;width:100px" name="" :value="bill.total_amount"  readonly  class="form-control form-control-sm" :id="'finaltotal'+bill.id">
                                                    
                                                    </td>
                                                    <td class="col-lg-12" style="text-align:center" >
                                                        <button class="btn btn-primary btn-sm" @click="changeServiceCharges(bill.id,bill.job_id,bill.bill_number,bill.rate)" style="font-size:10px">Update</button>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" @click="getOldData(bill.id)" style="font-size:10px">Cancel</button>

                                                    </td>
                   
                                                </tr>
                                            </tbody>
                                            </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden"  id="invid" v-model="invid">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>

</template>
<style scoped>
table{
    font-size: 12px;
}

tr{
    font-size: 12px;

}

td{
    font-size: 12px;

}
</style>
<script>
import axios from 'axios'
import vSelect from 'vue-select'
export default {
    data(){
        return{
            insurers:[],
            branches:[],
            invoices:[
            
            ],
            bills:[
            
            ],
            selectInsurer:'',
            selectedBranch:'',
            taxOnTotal:'',
            date:'',
            mypdf:'',
            newStax:'',
            invoiceid:'',
            invid:''
        }
    },
     components:{
          'Select':vSelect,
        },
        mounted(){
        
        this.getInsurers();

        },
   methods:{

    getBranches() {
               this.branches = [];

               axios
                   .get("/getInsurerBranch/" + this.selectInsurer.value) //with id
                   .then((res) => {
                       res.data.forEach((obj) => {
                           let text = "";
                           let value = "";
                           this.branches.push({
                               text: obj.name +" ("+obj.id+")",
                               value: obj.id
                           });
                       });
                   })
                   .catch((error) => {
                       console.log(error.response);
                   });
           },
       printInvoice: function(id){

        //  var string=this.$refs.ibrCompany.value;
        //  var cmpname=string.replace(/[{()}^0-9-]/g, "");

           axios.get('/printInvoice/',{       
               invoiceid:id
            })
      .then(res=>{


      })
      .catch(error=>{
          alert(error);
      });
   },
   changeTax(){
    // alert();

                const params={
                'newStax':this.newStax,
                'invoice_id':this.invoiceid,
                'is_on_total':this.taxOnTotal
            };
                    axios.post('/updateStaxInvoice',params)
                    .then(res=>{
                        // console.log(res.data.tax);
                        alert('Stax Updated');
                        this.getBills(document.getElementById('invid').value);

                    })
   },
   changeBranch(){
    // alert();

                const params={
                'invoice_id':this.invoiceid,
                'insurer':this.selectInsurer.value,
                'insurer_branch':this.selectedBranch.value,
            };
                    axios.post('/updateInvoiceBranch',params)
                    .then(res=>{
                        // console.log(res.data.tax);
                        alert('Branch Updated');
                        this.getBills(document.getElementById('invid').value);

                    })
   },
        getOldData(id){
            // alert(document.getElementById('oldservicecharges'+id).value);
        document.getElementById('servicecharges'+id).value=Math.round(document.getElementById('oldservicecharges'+id).value);
        document.getElementById('travellingcharges'+id).value=Math.round(document.getElementById('oldtravellingcharges'+id).value);
        document.getElementById('placeofsurvey'+id).value=document.getElementById('oldplaceofsurvey'+id).value;
        },
       changeServiceCharges(id,jid,billnumber){ 
            var newcharges = document.getElementById('servicecharges'+id).value;
            var oldcharges = document.getElementById('oldservicecharges'+id).value;
            var taxrate = document.getElementById('taxrate'+id).value;
            var newchargestravel = document.getElementById('travellingcharges'+id).value;
            var oldchargestravel = document.getElementById('oldtravellingcharges'+id).value;
            var newplaceofsurvey = document.getElementById('placeofsurvey'+id).value;
            var oldplaceofsurvey = document.getElementById('oldplaceofsurvey'+id).value;
            

            const params={
                'billnumber':billnumber,
                'jid':jid,
                'newcharges':newcharges,
                'oldcharges':oldcharges,
                'taxrate':taxrate,
                'newchargestravel':newchargestravel,
                'oldchargestravel':oldchargestravel,
                'newplaceofsurvey':newplaceofsurvey,
                'oldplaceofsurvey':oldplaceofsurvey
            };
                    axios.post('/updatePrismBillForInvoice/'+jid,params)
                    .then(res=>{
                        // console.log(res.data.tax);
                        alert('Bill Updated');
                        // this.getBills(document.getElementById('invid').value);
                         document.getElementById('oldservicecharges'+id).value=newcharges;
                         document.getElementById('oldtravellingcharges'+id).value=newchargestravel;
                         document.getElementById('finaltax'+id).value=res.data.tax;
                         document.getElementById('finaltotal'+id).value=res.data.total;
                    })

    },
      getBills(id)
   {

                $('#billsmodal').modal('show');
                this.newStax="";
                this.invoiceid=id;
                this.invid=id;

               this.bills=[];
               const params={
                'id':id
               };
                 axios.post('/getBillsOfInvoicePrism',params)
                    .then(res=>{
                        res.data.forEach((obj)=>{
                        // $('#billModal').modal('show');

                   this.bills.push(
                                {
                                    id:obj.id,
                                    job_id:obj.job_id,
                                    bill_number:obj.bill_number,
                                    owner_address:obj.owner_address,
                                    policy_no:obj.policy_no,
                                    chassis_no:obj.chassis_no,
                                    engine_no:obj.engine_no,
                                    reg_no:obj.reg_no,
                                    rate:obj.rate,
                                    place_of_survey:obj.place_of_survey,
                                    travelling:obj.travelling,
                                    service_charges:obj.service_charges,
                                    tax:obj.tax,
                                    total_amount:obj.total_amount
                                    
                                }
                                )



                        })
                    })


   },


     getInsurers() {
               this.insurers = [];
               axios.get("/getInsurers").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.insurers.push({
                           text: obj.name,
                           value: obj.id,
                           prefix: obj.prefix
                       });
                   });
               });
           },
           printMIS(letterhead,sbox,stamp,id){
 
             const istax =document.getElementById(sbox).checked;
             const isletter =document.getElementById(letterhead).checked;
             const isstamp =document.getElementById(stamp).checked;
            // console.log(field);
            const jobData={
                'stax':istax==true?1:0,
                'isletter':isletter==true?1:0,
                'isstamp':isstamp==true?1:0
            };
            axios.post("/printPrismInvoice/"+id,jobData,{responseType: 'arraybuffer'}).then(response =>{

                    $('#pdfmodal').modal('show');

                     var file = new Blob([response.data], {type: 'application/pdf'});
                        var fileURL = URL.createObjectURL(file);
                        this.mypdf=fileURL;

            }).catch(error=>{
                alert(error);
            })
           },
           printReports(letterhead,sbox,stamp,id){
 
             const istax =document.getElementById(sbox).checked;
             const isletter =document.getElementById(letterhead).checked;
             const isstamp =document.getElementById(stamp).checked;
            // console.log(field);
            const jobData={
                'stax':istax==true?1:0,
                'isletter':isletter==true?1:0,
                'isstamp':isstamp==true?1:0
            };
            axios.post("/printPrismReportsByInvoice/"+id,jobData,{responseType: 'arraybuffer'}).then(response =>{

                    $('#pdfmodal').modal('show');

                     var file = new Blob([response.data], {type: 'application/pdf'});
                        var fileURL = URL.createObjectURL(file);
                        this.mypdf=fileURL;

            }).catch(error=>{
                alert(error);
            })
           },
            printInvoices(letterhead,sbox,stamp,id){
 
             const istax =document.getElementById(sbox).checked;
             const isletter =document.getElementById(letterhead).checked;
             const isstamp =document.getElementById(stamp).checked;
            // console.log(field);
            const jobData={
                'stax':istax==true?1:0,
                'isletter':isletter==true?1:0,
                'isstamp':isstamp==true?1:0
            };
            axios.post("/printPrismBillsByInvoice/"+id,jobData,{responseType: 'arraybuffer'}).then(response =>{

                    $('#pdfmodal').modal('show');

                     var file = new Blob([response.data], {type: 'application/pdf'});
                        var fileURL = URL.createObjectURL(file);
                        this.mypdf=fileURL;

            }).catch(error=>{
                alert(error);
            })
           },


    searchInvoices(){
        const mydate =new Date(this.date);
      
            const params={
                year:mydate.getFullYear(),
                month:mydate.getMonth()+1,
                insurer_name:this.selectInsurer.value,
            };

         this.invoices=[];
                 axios.post('/getPrismInvoices',params)
                    .then(res=>{
                        res.data.forEach((obj)=>{
                            let text='';
                            let id='';
                            this.invoices.push(
                                {invoice_id:obj.invoice_id,insurer_branch:obj.insurer_branch}
                                )
                        })
                    })
    }

	}
}
</script>