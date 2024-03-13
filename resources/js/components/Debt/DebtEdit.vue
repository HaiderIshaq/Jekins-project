<template>
  <div class="container-fluid">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <a href="/Debt" class="btn btn-primary">Back</a>
        <div class="row">
            <div class="col-md-5">
                <h4 class="text-blue pt-3">Debt Collection Job</h4>
                <p class="mb-30 font-14">Edit Debt Collection Job : <b>{{id}}</b></p>    
            </div>
            <div class="col-md-4 offset-md-3" style="text-align: right;padding-right: 130px;">
                <span class="badge  mt-4" :class="{'badge-success':this.status=='Completed','badge-warning':this.status=='Running','badge-info':this.status=='Delayed By Customer','badge-danger':this.status=='Cancelled' }"  style="font-size: 1.3rem;">{{status}}</span>
            </div>
        </div>
      <div class="clearfix">
     </div>
      <div class="wizard-content">
        <form action=""  enctype="multipart/form-data">
            <div id="section1">
                <div class="form-group row">

                        <label class="col-md-3 form-label">Type: </label>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mb-5">
                                    <input type="radio" v-model.trim="type"  id="customRadio1" name="type" value="Local" class="custom-control-input field">
                                    <label class="custom-control-label" for="customRadio1">Local</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control  custom-radio mb-5">
                                    <input type="radio" style="background-color:red !important" v-model.trim="type" id="customRadio2" name="type" value="International"  class="custom-control-input field">
                                    <label class="custom-control-label"  for="customRadio2">International</label>
                                    </div>
                                </div>
                                
                            </div>
           
                        </div>

                    </div>
                    
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Name: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="clientName"    :class="{'date-invalid':$v.clientName.$error}"  type="text">
                           <div v-if="$v.clientName.$error" >
                                        <p class="text-danger" v-if="!$v.clientName.required">Please enter client name</p>
                                    </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Company: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="clientCompany"   :class="{'date-invalid':$v.clientCompany.$error}"   type="text">
                            <div v-if="$v.clientCompany.$error" >
                                <p class="text-danger" v-if="!$v.clientCompany.required">Please enter company name</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Phone: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="clientPhone"   :class="{'date-invalid':$v.clientPhone.$error}" type="text">
                            <div v-if="$v.clientPhone.$error" >
                                <p class="text-danger" v-if="!$v.clientPhone.required">Please enter phone number</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Email: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="clientEmail"  :class="{'date-invalid':$v.clientEmail.$error}" type="email">
                            <div v-if="$v.clientEmail.$error" >
                                <p class="text-danger" v-if="!$v.clientEmail.required">Please enter email address</p>
                                <p class="text-danger" v-if="!$v.clientEmail.email">Email address is not valid</p>
                            </div>
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Client's Address: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control field form-control-sm" v-model="clientAddress"  ></textarea>
                           
                        </div>  
                    </div>




                    <div class="form-group row ">
                        <label class="col-md-3">Client Country: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" v-model="clientCountry" class="field" :class="{'date-invalid':$v.clientCountry.$error}" :options="countries" ></Select>
                            <div v-if="$v.clientCountry.$error" >
                                 <p class="text-danger" v-if="!$v.clientCountry.required">Please select country</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Client City: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input  class="form-control field form-control-sm" :class="{'date-invalid':$v.clientCity.$error}"  v-model="clientCity"   >
                           <div v-if="$v.clientCity.$error" >
                                 <p class="text-danger" v-if="!$v.clientCity.required">Please enter city</p>
                            </div>
                        </div>
                    </div>
                 

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debt Amount:</label>
                        <div class="col-md-4 pl-0 pr-0">
                            <input type="number" v-model="debtAmount" :class="{'date-invalid':$v.debtAmount.$error}" class="form-control field form-control-sm">
                         <div v-if="$v.debtAmount.$error" >
                                 <p class="text-danger" v-if="!$v.debtAmount.required">Please enter debt amount</p>
                            </div>
                        </div>
                        <label class="col-md-2 pt-1">Currency: </label>
                        <div class="col-md-2 pl-0 pr-0">
                            <Select class="field"  v-model="currencyName" :class="{'date-invalid':$v.currencyName.$error}"  :options="currencies" ></Select>
                            <div v-if="$v.currencyName.$error" >
                                 <p class="text-danger" v-if="!$v.currencyName.required">Please select the currency</p>
                            </div>
                        </div>
                    </div>    

                    <div class="form-group row" >
                        <label class="col-md-3" for="company">Debtor's Company Name </label>

                        <div class="col-md-8 pl-0 pr-0">
                            <input id="company"  class="form-control field form-control-sm" :class="{'date-invalid':$v.debtorCompanyName.$error}" v-model="debtorCompanyName"  >
                             <div v-if="$v.debtorCompanyName.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyName.required">Please enter the company name</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Debtor's Company Country: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" v-model="debtorCompanyCountry"  :class="{'date-invalid':$v.debtorCompanyCountry.$error}" class="field" :options="countries" ></Select>
                           <div v-if="$v.debtorCompanyCountry.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyCountry.required">Please select the country</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Debtor's Company City: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input  class="form-control field form-control-sm"  :class="{'date-invalid':$v.debtorCompanyCity.$error}"  v-model="debtorCompanyCity"   >
                            <div v-if="$v.debtorCompanyCity.$error" >
                                 <p class="text-danger" v-if="!$v.debtorCompanyCity.required">Please eneter company city</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Company Address: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control field form-control-sm" v-model="debtorCompanyAddress"  ></textarea>
                    
                        </div>  
                    </div>


                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Representative: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="debtorCompanyRepresntative"   type="text">
                           
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debtor's Representative Designation: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input class="form-control field form-control-sm" v-model="debtorCompanyRepresntativeDesignation"   type="text">
                           
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Debt Time Period:</label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input type="number" v-model="debtTimePeriod"  :class="{'date-invalid':$v.debtTimePeriod.$error}" class="form-control field form-control-sm"  >
                             <div v-if="$v.debtTimePeriod.$error" >
                                 <p class="text-danger" v-if="!$v.debtTimePeriod.required">Please define the time period</p>
                            </div>
                        </div>
                    </div>   
                    <div class="form-group row ">
                        <label class="col-md-3">Legal Conflicts: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" class="field" v-model="isLegalConflict" :class="{'date-invalid':$v.isLegalConflict.$error}"  :options="[{text:'Yes',value:1},{text:'No',value:2}]" ></Select>
                             <div v-if="$v.isLegalConflict.$error" >
                                 <p class="text-danger" v-if="!$v.isLegalConflict.required">Please define if there is any legal conflicts</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Dispute's Details: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control field form-control-sm" v-model="disputeDetails"  ></textarea>
                         
                        </div>  
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Decided Comission:</label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input type="number" v-model="comission" class="form-control field form-control-sm" >
                          
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Agreement: </label>
                        <div class="col-md-7 pl-0 " >
                            <input type="file" class="form-control field form-control-sm"  @change="getImage()" ref="original"    >

                        </div>
                        <div class="col-md-1 pr-0">
                            <button class="btn btn-primary field" @click="viewReport()"  type="button">....</button>
                        </div>
                    </div>
                     <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Other Documents: </label>
                            <div class="col-md-7 pl-0 pr-0" >
                                <input class="form-control form-control-sm" @change="addDocuments()" ref="documents"  multiple="multiple" type="file">
                            </div>
                            <div class="col-md-1 pr-0" >
                                <input type="button" @click="viewOtherDocuments()" value="......" class="btn btn-primary">
                            </div>
                    </div>
                    <div class="modal fade bd-example-modal-2" id="ReportModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Agreement Viewer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" >
                                                                                      
                                        <iframe :src="pdf"  width="100%" height="550px" frameborder="0"></iframe>
                                        
                                        

                                        
                                        
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                    </div>
                     <!-- Other Documents Modal -->
                    <div class="modal fade bd-example-modal-2" tabindex="-1" role="dialog" id="otherDocumentsModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Other Documents Viewer </h5>
                                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container" >
                                        <div class="row ">
                                    
                                        <ul>

                                                <li v-for="value in documents" :key="value">
                                                    <a :href="path+value" target="_blank">{{value}}</a>
                                                </li>
                                        </ul>
                                        </div>
                                </div>                                                     
                                
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Other Documents Modal -->
                     <div class="form-group row ">
                        <label class="col-md-3 col-form-label">Completed: </label>
                        <div class="form-check col-md-2 " style="margin-top: 7px;">
                            <input type="checkbox"   class="form-check-input field" v-model="completed" id="completed"  name="type" value="Yes">
                            <label for="completed" class="form-check-label">Completed ?</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Remarks: </label>
                        
                        <div class="col-md-8 pl-0 pr-0" >
                        <textarea class="form-control field form-control-sm" v-model="remarks"  ></textarea>
                            
                        </div>  
                    </div>

                    

            </div>
           
          
            <input type="button" @click="onComplete()" class="btn btn-primary field" value="Submit">
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
          id:String

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
        countries:[],
        status:'',
        completed:false,
        file:'',
        pdf:'',
        path:'',
        documents:[]

        

        
       }
    },
    mounted(){
        this.path=document.location.origin+'/Reports/Debt/'+this.id+'/';

        this.getCountries();
        this.getDebt();

      
    },
    methods: {
   
   
    onComplete: function(){

     
            this.postdata();
        
            
    
   


   },
   postdata(){

       


           axios.put('/updateDebt/' + this.id ,{
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
        remarks:this.remarks,
        status:this.completed,
        pdf:this.pdf
    
        

  })
      .then(res=>{  
          alert('Job data updated Successfully');
          this.getDebt();
            // window.location.href="/home";
      })
      .catch(error=>{
      });  
    

   },
    viewReport(){
       this.pdf="";
        $('#ReportModal').modal('show');
            this.pdf=document.location.origin+'/Reports/Debt/'+this.id+'/agreement.pdf';

        
   },
    getImage(){
       this.pdf="";
        this.file = this.$refs.original.files[0];

         let formData = new FormData();
    formData.append('myfile', this.file);
    formData.append('id', this.id);
  

   axios.post('/uplaodAgreement',formData).then(res=>{
           

        if(res.data=="Unsupported")
        {
            alert('Unsupported');
        }
       

        else{
            
           

            if(res.data=='Invalid')
            {
                alert('File Version is not supported please upload pdf file with version 1.4');
            }

            else{

                if(res.data=='Limit Reached')
                {
                    alert('Plese upload smaller sized file limit is 3MB');
                }

                else{   
                     $('#ReportModal').modal('show');
                this.pdf=document.location.origin+'/Reports/Debt/'+this.id+'/' + res.data;
           
                }
               
                
            }


        }

       }).catch(error=>{
           alert("Please select some file");
         


        });


    },
    addDocuments(){
    //    this.pdf="";

         let formData = new FormData();
         for( var i = 0; i < this.$refs.documents.files.length; i++ ){
        let file = this.$refs.documents.files[i];
        console.log(file);
        formData.append('files[' + i + ']', file);
    }
    // formData.append('myfile', this.file);
    formData.append('job_id', this.id);
    

        axios.post('/uploadDebtDocuments',formData).then(res=>{
            alert('File Uploaded');
           

        // if(res.data=="Unsupported")
        // {
        //     alert('Unsupported');
        // }

        // else{
        // // $('#ReportModal').modal('show');
        // // this.pdf=document.location.origin+'/Reports/IBR/'+this.id+'/' + res.data;
        // }

       }).catch(error=>{
           alert("Please select some file");
         


        });


    },
    viewOtherDocuments(){
    //    this.finalDraft="";
            // this.finalDraft=document.location.origin+'/Reports/Valuation/'+this.id+'/final.pdf';
             axios.get('/getDebtFiles/' +this.id)
                    .then(res=>{
                        if(res.data=='No Files')
                        {
                            alert('Files not Found');
                        
                        
                        }

                        else{
                            $('#otherDocumentsModal').modal('show');

                             this.documents=res.data;
                        }

                    }) 
        
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
            getDebt(){
        axios.get('/getDebtJob/' + this.id)
        .then(res=>{
            console.log(res.data);
            res.data.forEach((obj)=>{
                this.type=obj.type;
                this.clientName=obj.client_name;
                this.clientName=obj.client_name;
                this.clientCompany=obj.company_name;
                this.clientPhone=obj.client_contanct_number;
                this.clientEmail=obj.client_comapany_email;
                this.clientCity=obj.client_comapany_city;
                this.clientAddress=obj.client_comapany_address;
                this.debtAmount=obj.amount;
                this.debtorCompanyName=obj.debtor_company_name;
                this.debtorCompanyCity=obj.debtor_comapany_city;
                this.debtorCompanyAddress=obj.debtor_comapany_address;
                this.debtorCompanyRepresntative=obj.debtor_comapany_representative;
                this.debtorCompanyRepresntativeDesignation=obj.debtor_comapany_representative_designation;
                this.debtTimePeriod=obj.debt_period;
                this.disputeDetails=obj.conflict_details;
                this.comission=obj.comission;
                this.status=obj.status;
                this.clientCountry={text:obj.country_name,value:obj.client_comapany_country};
                this.debtorCompanyCountry={text:obj.country_name_debt,value:obj.debtor_comapany_country};
                this.currencyName=obj.currency;
                this.remarks=obj.remarks;
                this.completed=obj.status==='Completed' ? true:false;
        
               if(obj.conflict==1)
                {
                    this.isLegalConflict={text:'Yes',value:1};
                }
                else{

                    this.isLegalConflict={text:'No',value:2};
                    
                }
                       if(obj.status==='Completed')
               {
                     let elems = document.getElementsByClassName('field');

                            console.log(elems);

                            for(let i = 0; i < elems.length; i++) {
                            elems[i].disabled = true;
                            }
               }


               
               
              
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
