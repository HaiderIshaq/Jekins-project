<template>
  <div class="container-fluid">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <a href="/Debt" class="btn btn-primary">Back</a>

      <div class="clearfix">
        <h4 class="text-blue pt-3">Debt Collection</h4>
        <p class="mb-30 font-14">New Debt Collection Job</p>
      </div>
      <div class="wizard-content">
        <form action="" >
            <div id="section1">
                <div class="form-group row">

                        <label class="col-md-3 form-label">Type: </label>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mb-5">
                                    <input type="radio" v-model.trim="type"  id="customRadio1" name="type" value="Local" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Local</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control  custom-radio mb-5">
                                    <input type="radio" style="background-color:red !important" v-model.trim="type" id="customRadio2" name="type" value="International"  class="custom-control-input">
                                    <label class="custom-control-label"  for="customRadio2">International</label>
                                    </div>
                                </div>
                                
                            </div>
           
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Name: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="clientName"    :class="{'date-invalid':$v.clientName.$error}"  type="text">
                           <div v-if="$v.clientName.$error" >
                                        <p class="text-danger" v-if="!$v.clientName.required">Please enter client name</p>
                                    </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Company: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="clientCompany"   :class="{'date-invalid':$v.clientCompany.$error}"   type="text">
                            <div v-if="$v.clientCompany.$error" >
                                <p class="text-danger" v-if="!$v.clientCompany.required">Please enter company name</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Phone: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="clientPhone"   :class="{'date-invalid':$v.clientPhone.$error}" type="text">
                            <div v-if="$v.clientPhone.$error" >
                                <p class="text-danger" v-if="!$v.clientPhone.required">Please enter phone number</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Email: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="clientEmail"  :class="{'date-invalid':$v.clientEmail.$error}" type="email">
                            <div v-if="$v.clientEmail.$error" >
                                <p class="text-danger" v-if="!$v.clientEmail.required">Please enter email address</p>
                                <p class="text-danger" v-if="!$v.clientEmail.email">Email address is not valid</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Address: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control  form-control-sm" v-model="clientAddress"  ></textarea>
                           
                        </div>  
                    </div>




                    <div class="form-group row ">
                        <label class="col-md-3">Client Country: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" v-model="clientCountry" :class="{'date-invalid':$v.clientCountry.$error}" :options="countries" ></Select>
                            <div v-if="$v.clientCountry.$error" >
                                 <p class="text-danger" v-if="!$v.clientCountry.required">Please select country</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Client City: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input  class="form-control form-control-sm" :class="{'date-invalid':$v.clientCity.$error}"  v-model="clientCity"   >
                           <div v-if="$v.clientCity.$error" >
                                 <p class="text-danger" v-if="!$v.clientCity.required">Please enter city</p>
                            </div>
                        </div>
                    </div>
                 

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debt Amount:</label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input type="number" v-model="debtAmount" :class="{'date-invalid':$v.debtAmount.$error}" class="form-control form-control-sm">
                         <div v-if="$v.debtAmount.$error" >
                                 <p class="text-danger" v-if="!$v.debtAmount.required">Please enter debt amount</p>
                            </div>
                        </div>
                        <label class="col-md-2 pt-1">Currency: </label>
                        <div class="col-md-2 pl-0 pr-0">
                            <Select   v-model="currencyName" :class="{'date-invalid':$v.currencyName.$error}"  :options="currencies" ></Select>
                            <div v-if="$v.currencyName.$error" >
                                 <p class="text-danger" v-if="!$v.currencyName.required">Please select the currency</p>
                            </div>
                        </div>
                    </div>    

                    <div class="form-group row" >
                        <label class="col-md-3" for="company">Debtor's Company Name </label>

                        <div class="col-md-8 pl-0 pr-0">
                            <input id="company"  class="form-control form-control-sm" :class="{'date-invalid':$v.debtorCompanyName.$error}" v-model="debtorCompanyName"  >
                             <div v-if="$v.debtorCompanyName.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyName.required">Please enter the company name</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Debtor's Company Country: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" v-model="debtorCompanyCountry"  :class="{'date-invalid':$v.debtorCompanyCountry.$error}" :options="countries" ></Select>
                           <div v-if="$v.debtorCompanyCountry.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyCountry.required">Please select the country</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Debtor's Company City: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input  class="form-control form-control-sm"  :class="{'date-invalid':$v.debtorCompanyCity.$error}"  v-model="debtorCompanyCity"   >
                            <div v-if="$v.debtorCompanyCity.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyCity.required">Please eneter company city</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Company Address: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control  form-control-sm" v-model="debtorCompanyAddress"  ></textarea>
                    
                        </div>  
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Representative: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="debtorCompanyRepresntative"   type="text">
                           
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Representative Designation: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control  form-control-sm" v-model="debtorCompanyRepresntativeDesignation"   type="text">
                           
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debt Time Period:</label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input type="number" v-model="debtTimePeriod" :class="{'date-invalid':$v.debtTimePeriod.$error}" class="form-control form-control-sm"  >
                             <div v-if="$v.debtTimePeriod.$error" >
                                 <p class="text-danger" v-if="!$v.debtTimePeriod.required">Please define the time period</p>
                            </div>
                        </div>
                    </div>   
                    <div class="form-group row ">
                        <label class="col-md-3">Legal Conflicts: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" v-model="isLegalConflict" :class="{'date-invalid':$v.isLegalConflict.$error}"  :options="[{text:'Yes',value:1},{text:'No',value:2}]" ></Select>
                             <div v-if="$v.isLegalConflict.$error" >
                                 <p class="text-danger" v-if="!$v.isLegalConflict.required">Please define if there is any legal conflicts</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Dispute's Details: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control  form-control-sm" v-model="disputeDetails"  ></textarea>
                         
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Decided Comission:</label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input type="number" v-model="comission" class="form-control form-control-sm" >
                          
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Remarks: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control  form-control-sm" v-model="remarks"  ></textarea>
                            
                        </div>  
                    </div>

                    

            </div>
           
          
            <input type="button" @click="onComplete()" class="btn btn-primary" value="Submit">
        </form>  
      </div>
    </div>
  </div>
</template>

<script>

import { required, minLength, between,email } from 'vuelidate/lib/validators'
import axios from 'axios'
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'
  export default {
      props:{
          id:String,
          jobid:String,
          common:String,
          cmpny:String

      },
      components:{
          'Select':vSelect,
            Autocomplete
      },
     data() {
       return {
 


        type:'Local',
        clientName:'',
        clientCompany:'',
        clientPhone:'',
        clientEmail:'',
        clientAddress:'',
        clientCountry:'',
        clientCity:'',
        debtAmount:'',
        currencyName:'',
        debtorCompanyName:'',
        debtorCompanyCountry:'',
        debtorCompanyCity:'',
        debtorCompanyAddress:'',
        debtorCompanyRepresntative:'',
        debtorCompanyRepresntativeDesignation:'',
        debtTimePeriod:'',
        isLegalConflict:'',
        disputeDetails:'',
        comission:0,
        remarks:'',
        currencies:[
            'USD',
            'YAN'
        ],
        countries:[]

      

        
       }
    },
    mounted(){
        this.getCountries();


        
    },
    methods: {
   
   
    onComplete: function(){

     if(this.$v.form1.$invalid)
        {
            this.$v.form1.$touch();
            var isValid = !this.$v.form1.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else
        {
            this.postdata();
        }
            
    
   


   },
   postdata(){

       
  

        const jobData={
        type:this.type,
        client_name:this.clientName,
        client_company:this.clientCompany,
        client_phone:this.clientPhone,
        client_address:this.clientAddress,
        client_email:this.clientEmail,
        client_country:this.clientCountry.value,
        client_city:this.clientCity,
        debt_amount:this.debtAmount,
        currency_name:this.currencyName,
        debtor_company_name:this.debtorCompanyName,
        debtor_company_country:this.debtorCompanyCountry.value,
        debtor_company_city:this.debtorCompanyCity,
        debtor_company_address:this.debtorCompanyAddress,
        debtor_company_representative:this.debtorCompanyRepresntative,
        debtor_company_representative_designation:this.debtorCompanyRepresntativeDesignation,
        debt_time_period:this.debtTimePeriod,
        is_legal_conflict:this.isLegalConflict.value,
        dispute_details:this.disputeDetails,
        decided_comission:this.comission,
        remarks:this.remarks

        };
            console.log(jobData);

        axios.post('/addDebtCollectionJob',jobData)
            .then(res=>{
           alert('Job is successfully created')
            window.location.href="/Debt";
            return false;
            })
            .catch(error=>alert(error))    
    

   },
    getCountries(){
        this.countries=[];
                 axios.get('/getCountries')
                    .then(res=>{
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            let region='';
                            this.countries.push({text:obj.name,value:obj.id,region:obj.region})
                        })
                    })
            },
  },
  validations: {
    clientName: {
      required
    },
    clientCompany: {
      required
    },
    clientPhone: {
      required
    },
    clientEmail: {
      required,
      email
    },
    clientPhone: {
      required
    },
    clientCountry: {
      required
    },
    clientCity: {
      required
    },
    debtAmount: {
      required
    },
    currencyName: {
      required
    },
    debtorCompanyName: {
      required
    },
    debtorCompanyCountry: {
      required
    },
    debtorCompanyCity: {
      required
    },
    debtTimePeriod:{
        required
     },
    isLegalConflict:{
        required
        },
     form1:[
        'clientName',
        'clientPhone',
        'clientCompany',
        'clientEmail',
        'clientPhone',
        'clientCountry',
        'clientCity',
        'debtAmount',
        'currencyName',
        'debtorCompanyName',
        'debtorCompanyCountry',
        'debtorCompanyCity',
        'debtTimePeriod',
        'isLegalConflict'
        
        ]

        
         

  }
  }
</script>

<style scoped>
.vue-form-wizard{
width: 65rem;
}

.invalid{
    border: #dc3545 0.4px solid;
    background-color: #ffc9aa
}

.date-invalid{
    border: #dc3545 1px solid;
    background-color: #ffc9aa
}

.wizard-icon-container{
    background-color: black !important
}

.category{
    display: none
}

.vue-form-wizard .wizard-title {
    display: none
}

</style>
