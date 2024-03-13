<template>
    <div class="container-fluid" >
        <div  class="bg-white border-radius-4 box-shadow mb-30" style="padding:25px 25px 26px 25px">
            <h3><b>Verification Invoices</b></h3>
            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="">Bank</label>
                </div>
                <div class="col-md-5">
                    
                    <Select label="text" :options="banks" v-model="selectedBank"></Select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <label for="">Date</label>
                </div>
                <div class="col-md-5">
                    <input type="date" v-model="date" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-2">
                    <button class="btn btn-primary" @click="searchInvoices()">Search</button>
                </div>
                
            </div>

            <div class="">
                <table class="table display" id="myTable1" style="width:100%;margin-top:30px" >
                    <thead class="thead-dark">
                        <tr>
                        
                        <th scope="col">Branch</th>
                        <th scope="col">Invoice No.</th>
                        <th scope="col">Action</th>
                        <th scope="col">Action</th>

                        </tr>
                    </thead>
                <tbody>
                    <tr v-for="invoice in invoices" :key="invoice.id" >
   
                        <td role="button" @click="getBills(invoice.invoice_id)">{{invoice.name}}</td>
                        <td role="button" @click="getBills(invoice.invoice_id)">{{invoice.invoice_id}}</td>
                        <td>
                            <a target="_blank" :href="'/printInvoice/'+invoice.invoice_id">
                            <button class="btn btn-primary btn-sm" > Print Invoice</button>

                            </a>
                            <!-- <button class="btn btn-primary btn-sm"  @click="printInvoice(invoice.invoice_id)"> Print Invoice</button> -->
                        </td>
                        <td>
                            <a  :href="'/getInvoiceDetails/'+invoice.invoice_id">
                            <button class="btn btn-primary btn-sm" > Print Excel</button>

                            </a>
                            <!-- <button class="btn btn-primary btn-sm"> Print Excel</button> -->
                        </td>
                        
                    </tr>
                </tbody>
                </table>
                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="billModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                 <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Invoice Bills : {{this.invoiceid}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table  ref="mytable" class="table table-sm" style="font-size: 13px;">
                                            <thead class="thead-dark" >
                                                <tr>
                                                <th scope="col">S #</th>
                                                <th scope="col">Job Id</th>
                                                <th scope="col">Bank</th>
                                                <th scope="col">Branch</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Service Charges</th>
                                                <th scope="col">Snap Charges</th>
                                                <th scope="col">Tax</th>
                                                <th scope="col">%</th>
                                                <th scope="col">Total</th>
                                                <th scope="col">Attention</th>
                                                <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="bill in bills" :key="bill.id">
                                                    <th  scope="row">{{bill.job_id}}</th>
                                                    <td>{{bill.bill_number}}</td>
                                                    <td>{{bill.bank_name}}</td>
                                                    <td>{{bill.branch_name}}</td>
                                                    <td>
                                                        <Select @input="updateType(bill.job_id,$event)" height="30px" label="text" style="font-size:11px" v-model="bill.product_type" :options="types" ></Select>
                                                    </td>
                                                    <td>
                                                        <input type="number" style="font-size:11px;width:100px" name="" :value="bill.service_charges"    class="form-control form-control-sm" :id="'servicecharges'+bill.id">
                                                        <input type="hidden" name="" :value="bill.service_charges" :id="'oldservicecharges'+bill.id">
                                                        
                                                        
                                                        </td>
                                                    <td>
                                                        <input type="number" style="font-size:11px;width:100px" name="" :value="bill.snap_charges" class="form-control form-control-sm" :id="'snapcharges'+bill.id">
                                                        <input type="hidden" name="" :value="bill.snap_charges" :id="'oldsnapcharges'+bill.id">
                                                        
                                                        
                                                        </td>
                                                    <td>{{bill.tax}}</td>

                                                    <td>
                                                        <b>{{bill.rate}}%</b>
                                                    </td>
                                                    <td>{{bill.total_amount}}</td>
                                                    <td>
                                                        <!-- {{bill.attention_name}} -->
                                                        <Select :options="attens" v-model="bill.attention" :ref="'atten'+bill.job_id" @input="changeAttention(bill.id,bill.job_id,$event)"  label="text" ></Select>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-primary btn-sm" @click="changeServiceCharges(bill.id,bill.job_id,bill.bill_number)" style="font-size:11px">Update</button>
                                                    </td>
                   
                                                </tr>
                                            </tbody>
                                            </table>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden"  id="invid" v-model="invid">
                                    <a :href="'printInvoice/'+invoiceid" target="_blank"><button class="btn btn-priamry btn-sm">Invoice</button></a>
                                    <a :href="'getInvoiceDetails/'+invoiceid"  class="btn btn-priamry btn-sm"><button class="btn btn-priamry btn-sm">Excel</button></a>
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

<script>
import axios from 'axios'
import vSelect from 'vue-select'
export default {
    data(){
        return{
            banks:[],
            attens:[],
            types:[
                {text:'Home'},
                {text:'Auto'}
                ],
            invoices:[],
            bills:[],
            selectedBank:'',
            date:'',
            mypdf:'',
            atten:'',
            invoiceid:'',
            invid:'',
        }
    },
     components:{
          'Select':vSelect,
        },
        mounted(){
        this.getBanks();

        },
   methods:{


        getAtten(){

            this.attens=[];
            axios.get("/getAtten/"+ this.selectedBank.value)
            .then(res => {

            res.data.forEach((obj)=>{
                    let text='';
                    let value='';
                    this.attens.push({text:obj.name,value:obj.id});
                })

                // console.log(res.data);
                

            })
            .catch(error => {

            console.log(error.response);


            });


        },
       printInvoice: function(id){

        //  var string=this.$refs.ibrCompany.value;
        //  var cmpname=string.replace(/[{()}^0-9-]/g, "");

           axios.g('/printInvoice/',{       
               invoiceid:id
            })
      .then(res=>{


      })
      .catch(error=>{
          alert(error);
      });
   },

   getBills(id)
   {


    // alert(id);
                //  this.renderComponent = false;
                this.invoiceid=id;
                this.invid=id;

               this.bills=[];
               const params={
                'id':id
               };
                 axios.post('/getBillsOfInvoice',params)
                    .then(res=>{
                        this.getAtten();

                        res.data.forEach((obj)=>{
                        $('#billModal').modal('show');

                   this.bills.push(
                                {
                                    id:obj.id,
                                    job_id:obj.job_id,
                                    bill_number:obj.bill_number,
                                    bank_name:obj.bank_name,
                                    branch_name:obj.branch_name,
                                    product_type:obj.product_type,
                                    service_charges:obj.service_charges,
                                    snap_charges:obj.snap_charges,
                                    rate:obj.rate,
                                    tax:obj.tax,
                                    total_amount:obj.total_amount,
                                    attention:{text:obj.attention_name,value:obj.attention_value}
                                    
                                }
                                )

                                //  this.renderComponent = true;


                        })
                    })


   },

    getBanks(){
        this.banks=[];
                 axios.get('/getBanks')
                    .then(res=>{
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            let prefix="";
                            this.banks.push({text:obj.bank_name,value:obj.bank_id,prefix:obj.bank_code})
                        })
                    })
            },

    searchInvoices(){
        const mydate =new Date(this.date);
      
            const params={
                year:mydate.getFullYear(),
                month:mydate.getMonth()+1,
                bank:this.selectedBank.value,
            };

         this.invoices=[];
                 axios.post('/getInvoices',params)
                    .then(res=>{
                        res.data.forEach((obj)=>{
                            let text='';
                            let id='';
                            this.invoices.push(
                                {name:obj.att_name,invoice_id:obj.invoice_id}
                                )
                        })
                    })
    },
    updateType(id,type){
        // alert(type.text);

            const params={
                product_type:type.text,
            };
                    axios.post('/updateType/'+id,params)
                    .then(res=>{

                        alert('Product Type Updated');
                    })

    },

    changeAttention(billid,jid,event){
        // var atten = document.getElementById('atten'+id).value;
        // alert(value);

        // var jid='atten'+value;
        // console.log(event.value);
        const params={
                attention:event.value,
                jid:jid
            };
            axios.post('/updateAttention/'+billid,params)
            .then(res=>{
                alert('Product Attention Updated');

                this.getBills(document.getElementById('invid').value);

            })


    // ale
    // console.log(this.$refs.atten3153.value);

    

    },
    changeServiceCharges(id,jid,billnumber){


                  var newcharges = document.getElementById('servicecharges'+id).value;
            var oldcharges = document.getElementById('oldservicecharges'+id).value;
            var newchargessnap = document.getElementById('snapcharges'+id).value;
            var oldchargessnap = document.getElementById('oldsnapcharges'+id).value;
            

            const params={
                'billnumber':billnumber,
                'newcharges':newcharges,
                'oldcharges':oldcharges,
                'newchargessnap':newchargessnap,
                'oldchargessnap':oldchargessnap,
            };
                    axios.post('/updateVerificationServiceCharges/'+jid,params)
                    .then(res=>{

                        alert('Product Type Updated');
                        this.getBills(document.getElementById('invid').value);
                         document.getElementById('oldservicecharges'+id).value=newcharges;
                         document.getElementById('oldsnapcharges'+id).value=newchargessnap;
                    })

    }

	}
}
</script>