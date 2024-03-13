<template>
 <div class="modal-content">
     <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Upload Excel Sheet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                     <div class="form-group row">
                        <label class="col-md-1 col-form-label">Region: </label>
                        <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <Select  label="text" @input="getBranches()"  :class="[{'date-invalid':$v.selectedBank.$error},'mySelect']" :options="regions"  v-model="region"></Select>
                            <div v-if="$v.selectedBank.$error" >
                                <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row">
                        <label class="col-md-1 col-form-label">Sales Tax: </label>
                        <div class="col-md-4" style="padding-left:0px" >
                            <Select  label="text"   :class="['mySelect']" :options="salesRegion" v-model="saleReg"></Select>

                        </div>
                    </div> -->
                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Bank: </label>
                        <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <Select  label="text" @input="getBranches()"  :class="[{'date-invalid':$v.selectedBank.$error},'mySelect']" :options="banks"  v-model="selectedBank"></Select>
                            <div v-if="$v.selectedBank.$error" >
                                <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                            <label for="" class="col-md-1 col-form-label">Branch: </label>
                            <!-- <div class="col-md-1" style="padding-left:0px">
                            <input type="number" v-model="selectedBranch" id="branchId" :disabled="!selectedBank"  @input="getBranchById()"  class="form-control ">
                            </div> -->
                            <div class="col-md-4 pl-0">
                            <Select  label="text" v-model="bankBranch" :class="[{'date-invalid':$v.bankBranch.$error},'mySelect']"  :disabled="!selectedBank" :options="branches" ></Select>
                            <!--  -->
                                <div v-if="$v.bankBranch.$error" >
                                <p class="text-danger" v-if="!$v.bankBranch.required">Please select some branch</p>
                                </div>
                            </div>
                            
                    </div>
                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Op. Branch: </label>
                        <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <Select  label="text"  :class="[{'date-invalid':$v.selectedBank.$error},'mySelect']" :options="regions"  v-model="operationalBranch"></Select>
                            <div v-if="$v.selectedBank.$error" >
                                <p class="text-danger" v-if="!$v.selectedBank.required">Please select operational branch</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-1 col-form-label">Select: </label>
                        <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model.trim="proType" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Auto">
                            <label class="form-check-label" for="inlineRadio1">Auto</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model.trim="proType"  type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Home">
                            <label class="form-check-label" for="inlineRadio2">Home</label>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row" v-show="proType=='Home'">
                        <label class="col-md-1 col-form-label">Format: </label>
                        <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model.trim="formatType" type="radio" name="inlineRadioOptions1" id="inlineRadio3" value="Horizontal">
                            <label class="form-check-label" for="inlineRadio3">Horizontal</label>
                            </div>
                            <div class="form-check form-check-inline">
                            <input class="form-check-input" v-model.trim="formatType"  type="radio" name="inlineRadioOptions1" id="inlineRadio4" value="Vertical">
                            <label class="form-check-label" for="inlineRadio3">Vertical</label>
                            </div>
                        </div>
                    </div> -->

                    <div class="form-group row">
                        <label class="col-md-1 col-form-label pt-3">Select File: </label>
                         <div class="col-md-4" style="padding-left:0px;padding-top:10px">
                            <input type="file" ref="final" class="input-sm" style="padding-left:0px;">

                        </div>

                    </div>
                   </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" @click="postData()">Save changes</button>
                </div>


</div>
</template>

<script>
import { required, minLength, between,email } from 'vuelidate/lib/validators'
import vSelect from 'vue-select'
import axios from 'axios'
import 'vue-select/dist/vue-select.css'


export default {

    data(){
        return{
            region:'',
            selectedBank:'',
            bankBranch:'',
            operationalBranch:'',
            branches:[],
            salesRegion:[],
            saleReg:'',
            file:'',
            proType:'Auto',
            formatType:''
        }
    },
    props:{
        regions:Array,
        banks:Array,
    },
    components:{
         'Select':vSelect,
    },
    mounted(){
        this.getTaxRegions();
    },
    methods:{
        getTaxRegions(){
            axios.get("/getSalesRegion")
                .then(res => {

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.salesRegion.push({text:obj.name,value:obj.id});
                    })
                })
                .catch(error => {

                console.log(error.response);


                });


        },
        getBranches(){
        this.branches=[];
        this.bankBranch='';
        this.billingAddress="";
            this.block=false;
            let id=this.selectedBank.value;
            axios.get("/getBranches/" + id) //with id
                .then(res => {
                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.branches.push({text:obj.branch_name,value:obj.branch_id});


                    })
                })
                .catch(error => {
                console.log(error.response);
                });
            },

            postData(){

                // if(this.$v.form1.$invalid)
                // {
                //     this.$v.form1.$touch();
                //     var isValid = !this.$v.form1.$invalid
                //     this.$emit('on-validate', this.$data, isValid)
                //     return isValid
                // }

                // else{
                    
                    this.file = this.$refs.final.files[0];

                let formData = new FormData();
                formData.append('myfile', this.file);
                formData.append('bank_id', this.selectedBank.value);
                formData.append('regional_id', this.region.value);
                formData.append('regional_prefix', this.region.prefix);
                formData.append('company_prefix','KGT');
                formData.append('given_by',"Bank");
                formData.append('job_by',1);
                formData.append('bank_prefix',this.selectedBank.prefix);
                formData.append('product_type',this.proType);
                // formData.append('sales_reg',this.saleReg.value);
                formData.append('format_type',this.formatType);
                formData.append('branch_id', this.bankBranch.value);
                formData.append('opbranch', this.operationalBranch.value);

                axios.post('/addVerificationJobsBulk',formData).then(res=>{

                        alert('Uploaded');

                    }).catch(error=>{
                        alert(error);



                        });


                // }
                

        










            }
    },

    validations: {

    region:{
      required
    },
    // branch:{
    //   required
    // },
   selectedBank:{
        required
    },
   operationalBranch:{
        required
    },
    bankBranch:{
        required
    },
  
     form1:[
       
        'region',
        'selectedBank',
        'bankBranch',
        'operationalBranch',
        ],

     


  }

}
</script>

<style>

</style>