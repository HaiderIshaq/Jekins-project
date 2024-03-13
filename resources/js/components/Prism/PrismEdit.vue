
 <style>

label{
font-size: 10px;
}

.form-inline {  
  display: flex;
  flex-flow: row wrap;
  align-items: center;
}

li a{
    font-size: 15px !important;
}

.form-inline label {
  margin: 5px 10px 5px 0;
}

.form-inline input {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  padding: 10px;
  background-color: #fff;
  border: 1px solid #ddd;
}

.form-inline select {
  vertical-align: middle;
  margin: 5px 10px 5px 0;
  /* padding: 10px; */
  background-color: #fff;
  border: 1px solid #ddd;
}


</style>
<template>
   <div class="container-fluid">
      <div class="bg-white border-radius-4 box-shadow mb-30" style="padding: 0px 15px 16px 15px">
         <div class="clearfix">
            <div class="row" style="background-color: #275129; padding-bottom: 15px">
               <div class="col-md-10">
                  <h4 class="text-white pt-3">New Prism Surveyors Job</h4>
               </div>
               <div class="col-md-2" style="text-align: right">
                  <a href="/prism" style="
                     margin-top: 12px;
                     margin-left: 50px;
                     color: black;
                     background-color: #ffffff;
                     border-color: #ffffff;
                     " class="btn btn-primary">Back</a>
               </div>
            </div>
            <br/>
            <!-- <p class="mb-30 font-14">New Inspection Job</p> -->
         </div>
         <div class="wizard-content">
          
                <div class="form-group row">

                        <label class="col-auto" for="job" style="width:90px"  >Job No. :</label>
                        <input class="col-auto form-control form-control-sm"  style="width:240px" readonly type="text" v-model="jobid" id="job"  name="job">
                        

                        <input class="dateElement" lang="en" type="text"  
  placeholder="dd-mm-yyyy" 
  min="1997-01-01" max="2030-12-31">

  <input class="dateElement" lang="en" type="text"  
  placeholder="dd-mm-yyyy" 
  min="1997-01-01" max="2030-12-31">
  
                        <label for="pwd"  class="col-auto"  style="width:150px">Request of Survey:</label>
                        <input type="date"  style="width:160px;margin-left:5px;margin-right:5px" v-model="requestedDate" class=" form-control form-control-sm col-auto">
                        <input type="time"   style="width:160px;height:30px" v-model="requestedTime" class=" form-control form-control-sm col-auto">
                        
                            <label for="pwd" class="col-auto"  style="width:116px">Delivered On:</label>
                            <input type="date" style="width:160px" v-model="deliveredOn" class="form-control form-control-sm col-auto">

                </div>    


        
                <div class="form-group row" style="padding-left:20px;padding-top:10px;padding-bottom:20px">
                        <div  style="width:110px">
                            <input  type="checkbox" style="padding:10px" v-model="isTakaful"> <label  >Takaful ?</label>
                        </div>
                        <div  style="width:150px">
                           <a :href="/downloadAssets/+this.id"> <button class="btn btn-primary">Download Images</button></a>              
                        </div>
                
                        <div  style="width:110px;padding-left:8px" v-if="!saveButton">
                            <input  type="checkbox" 
                             style="padding:10px"  v-model="isCompleted"> <label  >Completed</label>

                        </div>

                        <div  style="width:150px">
                            <hold 
                            :id="id" 
                            :jobid="jobid"
                            :common="common"
                            v-if="!saveButton"
                            v-on:holdJob="getPrismData()"

                            ></hold>
                        </div>
                    
                        <div  style="width:90px">
                            <cancel 
                            :id="id" 
                            :jobid="jobid"
                            :common="common"
                            v-if="!saveButton"
                            v-on:cancelJob="getPrismData()"
                            ></cancel>

                        </div>


                    
                </div>
                
                <div class="form-group row">
                    <label class="col-md-2" for="company">Company </label>
                    <div class="col-md-3 pl-0 pr-0">
                                <Select id="company" label="text"
                                :class="['mySelect']" v-model="company"
                                :options="companies"></Select>
                            
                        </div>
                        <label class="col-md-3">Branch Conducting Survey: </label>
                        <div class="col-md-3 pl-0 pr-0">
                            <Select  label="text"  :class="[
                            { 'date-invalid': $v.branchConduct.$error },
                            'mySelect',
                            ]" v-model="branchConduct"  :options="regions" ></Select>
                            <div v-if="$v.branchConduct.$error">
                            <p class="text-danger"
                            v-if="!$v.branchConduct.required">
                            Required
                            </p>
                        </div>
                        </div>
                </div>
                <div class="form-group row ">
                    <label class="col-md-2">Region: </label>
                    <div class="col-md-3 pl-0 pr-0">
                        <Select  label="text" :class="['mySelect']" v-model="region" disabled :options="regions" ></Select>
                        
                    </div>
                    <label class="col-md-3">Recovery Branch: </label>
                    <div class="col-md-3 pl-0 pr-0">
                        <Select   :class="[
                            { 'date-invalid': $v.recoveryBranch.$error },
                            'mySelect',
                            ]" label="text"  v-model="recoveryBranch"  :options="regions" ></Select>
                        <div v-if="$v.recoveryBranch.$error">
                            <p class="text-danger"
                            v-if="!$v.recoveryBranch.required">
                            Required
                            </p>
                        </div>
                    </div>
                </div>

                <hr>
                


                     


        <div class="tab-content" id="myTabContent">
            
           
            <div
                class="tab-pane fade active show active show"
                id="order"
                role="tabpanel"
                aria-labelledby="comment-tab"
                    >
                <div class="row">
                    <div class="col-md-6 col-sm-12" style="border-right: 1px solid rgb(100, 97, 97);">
                        
                        <h5>Ordering Insurer's Details</h5>
                           <br />
                          <div class="form-group row">
                              <label class="col-md-3 col-form-label">Insurer: </label>
                              <div class="col-md-9" style="padding-left: 0px">
                                 <Select label="text" @input="getBranches()" :class="[
                                    
                                    'mySelect',
                                    ]" :options="insurers" v-model="insurer"></Select>
                                

                              </div>
                            
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Branch:
                                </label>
                                <!-- <div class="col-md-1" style="padding-left:0px">
                                <input type="number" v-model="selectedBranch" id="branchId" :disabled="!insurer"  @input="getBranchById()"  class="form-control ">
                                </div> -->
                            <div class="col-md-7 pl-0">
                                <Select label="text" v-model="insurerBranch" @input="getAddress()" :class="[
                                
                                'mySelect',
                                ]" :disabled="!insurer" :options="branches"></Select>
                                <!--  -->
                                
                            </div>
                            <div class="col-md-2" style="padding-left: 0px !important">
                            <input type="button" value="Add" class="btn btn-primary branch-btn"
                            :disabled="!insurer" data-toggle="modal"
                            data-target=".bd-example-modal-lg" style="margin-left: 16px" />
                            </div>
                            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                            Add new Branch
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            <form enctype="multipart/form-data">
                            <!-- <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Bank:</label>
                            <Select :options="banks" v-model="branchBank" :class="{'date-invalid':$v.branchBank.$error}" label="text"></Select>
                            <div v-if="$v.branchBank.$error" >
                                <p class="text-danger" v-if="!$v.branchBank.required" >Please select some bank</p>
                            </div>
                            </div> -->
                             <div class="form-group row">
                                <div class="col-md-6">
                                        <label for="recipient-name"  class="col-form-label">Code:</label>
                                        <input type="number" v-model="branchCode"
                                        class="form-control" :class="{
                                        'date-invalid': $v.branchCode.$error,
                                        }" />
                                        <div v-if="$v.branchCode.$error">
                                        <p class="text-danger"
                                        v-if="!$v.branchCode.required">
                                        Please input branch code of bank
                                        </p>
                                        </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="recipient-name"
                                            class="col-form-label">Phone:</label>
                                         <input type="number" v-model="branchPhone"
                                            class="form-control" :class="{
                                            'date-invalid': $v.branchPhone.$error,
                                            }" />
                                    <div v-if="$v.branchPhone.$error">
                                    <p class="text-danger"
                                    v-if="!$v.branchPhone.required">
                                    Please input branch phone-number
                                    </p>
                                    </div>
                                  </div>
                                </div>
                             </div>
                            <div class="form-group">
                            <label for="recipient-name"
                            class="col-form-label">Branch Name / Branch
                            Address:</label>
                            <input type="text" v-model="branchName"
                            class="form-control" :class="{
                            'date-invalid': $v.branchName.$error,
                            }" />
                            <div v-if="$v.branchName.$error">
                            <p class="text-danger"
                            v-if="!$v.branchName.required">
                            Please input branch Name
                            </p>
                            </div>
                            </div>
                            <div class="form-group">
                            <label for="message-text"
                            class="col-form-label">City:</label>
                            <Select v-model="branchCity" label="text"
                            :options="cities" :class="[
                            { 'date-invalid': $v.branchCity.$error },
                            'mySelect',
                            ]"></Select>
                            <div v-if="$v.branchCity.$error">
                            <p class="text-danger"
                            v-if="!$v.branchCity.required">
                            Please select branch city
                            </p>
                            </div>
                            </div>
                            <div class="form-group pb-3">
                            <label for="recipient-name"
                            class="col-form-label">Complete Address:</label>
                            <input type="text" v-model="branchAddress"
                            class="form-control" :class="{
                            'date-invalid': $v.branchAddress.$error,
                            }" />
                            <div v-if="$v.branchAddress.$error">
                            <p class="text-danger"
                            v-if="!$v.branchAddress.required">
                            Please select branch complete address
                            </p>
                            </div>
                            </div>
                          
                           
                                <button type="button" data-dismiss="modal"
                                class="btn btn-secondary">
                                Close
                                </button>
                                <button type="button" @click="addBranch()"
                                class="btn btn-primary">
                                Add Branch
                                </button>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Billing Address</label>
                            <div class="col-md-8 pl-0 pr-0">
                            <textarea type="text" name="" v-model="billingAddress"
                            :class="{ 'date-invalid': $v.billingAddress.$error }" cols="30" rows="2"
                            class="form-control form-control-sm" style="height: 60px"></textarea>
                            <div v-if="$v.billingAddress.$error">
                            <p class="text-danger" v-if="!$v.billingAddress.required">
                            Please fill out billing address
                            </p>
                            </div>
                            </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Conc Officer:
                                </label>
                                <div class="col-md-8 pl-0 pr-0">
                                    <input class="form-control form-control-sm" v-model="concOfficer"
                                    :class="{
                                    'date-invalid': $v.concOfficer.$error,
                                    }" type="text" />
                                    <div v-if="$v.concOfficer.$error">
                                    <p class="text-danger" v-if="!$v.concOfficer.required">
                                    Please fill out officer
                                    </p>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Desig/Dept: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                <input class="form-control form-control-sm" v-model="insurerDesignation"
                                :class="{ 'date-invalid': $v.insurerDesignation.$error }" type="text" />
                                <div v-if="$v.insurerDesignation.$error">
                                <p class="text-danger" v-if="!$v.insurerDesignation.required">
                                Please fill out this field
                                </p>
                                </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                <input type="number" v-model="insurerPhone"
                                :class="{ 'date-invalid': $v.insurerPhone.$error }"
                                class="form-control form-control-sm" />
                                <div v-if="$v.insurerPhone.$error">
                                <p class="text-danger" v-if="!$v.insurerPhone.required">
                                Please fill out phone number
                                </p>
                                </div>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                <input type="email" v-model="insurerEmail" class="form-control form-control-sm"
                                :class="{ 'date-invalid': $v.insurerEmail.$error }" />
                                <div v-if="$v.insurerEmail.$error">
                                <p class="text-danger" v-if="!$v.insurerEmail.required">
                                Please fill out email address
                                </p>
                                <p class="text-danger" v-if="!$v.insurerEmail.email">
                                Please fill out valid email
                                </p>
                                </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-3">
                                <label class="form-label">Letter No: </label>
                                </div>
                                <div class="col-md-3 pl-0">
                                <input type="text" v-model="insurerletterNo"
                                class="form-control form-control-sm"
                                :class="{ 'date-invalid': $v.insurerletterNo.$error }" />
                                <div v-if="$v.insurerletterNo.$error">
                                <p class="text-danger" v-if="!$v.insurerletterNo.required">
                                Please fill out this field
                                </p>
                                </div>
                                </div>
                                <div class="col-md-1">
                                <label class="form-label mt-2">Date: </label>
                                </div>
                                <div class="col-md-3 pl-0">
                                <input class="form-control form-control-sm" v-model="insurerDate"
                                :class="{ 'date-invalid': $v.insurerDate.$error }"
                                style="margin-left: 18px; min-width: 152px" name="txtDate2"
                                type="date" />
                                <div v-if="$v.insurerDate.$error">
                                <p class="text-danger" style="margin-left: 20px"
                                v-if="!$v.insurerDate.required">
                                Please specify the date
                                </p>
                                </div>
                                </div>
                            </div> -->
                        <hr>
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <h5>Survey Details</h5>
                                </div>
                                <div class="col-md-4 text-right" v-show="surveyor.text!=null">
                                            
                                    <span v-if="surveyStatus==0" class="badge bg-warning text-dark">Un-Attended</span>
                                    <span  v-else-if="surveyStatus==1" class="badge bg-success text-white">Attended</span>
                                    <span v-else  class="badge bg-danger text-white">Cancelled</span>
                                </div>
                            </div>
                            <br/>
            
                            <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Surveyor:</label>
                            <div class="col-md-8 pl-0 pr-0">
                            <Select  class="mySelect" v-model="surveyor" :options="surveyors"  label="text"></Select>
                            </div>
                            
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Travelling Expence: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="number" v-model="travlingExpenses"  class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row pb-3" v-show="this.type.text=='Partial Loss'">
                                <label class="col-md-3 col-form-label">Pay To: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <div class="form-check">
                                        <input  type="radio" v-model="payTo" value="Insured">
                                        <label for="">
                                            Insured
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input  type="radio" v-model="payTo" value="Workshop" >
                                        <label for="">
                                             Workshop
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input  type="radio" v-model="payTo" value="Supplier & Workshop">
                                        <label for="">
                                            Supplier & Workshop
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input  type="radio" v-model="payTo" value="No Loss / No Claim">
                                        <label for="" >
                                            No Loss / No Claim
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Report Date: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="date" v-model="reportDate" class="form-control form-control-sm">
                            </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Date of Inspection: </label>
                                <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                                    <input type="date" v-model="dateOfInsp" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4 pl-2 pr-o" style="padding-left:0px">
                                    <input type="time" style="height:30px" v-model="timeOfInsp" class="form-control form-control-sm">
                                </div>
                            </div>  
                        

                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Place of Survey: </label>
                            <div class="col-md-9" style="padding-left:0px">
                            <textarea class="form-control " v-model="placeOfSurvey" col="1" row="1" name="" id="" style="height: 50px;"></textarea>
                            </div>
                            </div>

                            <div class="form-group row">
                                 <label class="col-md-3 col-form-label">Re-inspection Date: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="date" v-model="reInspDate" class="form-control form-control-sm">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                 <label class="col-md-3 col-form-label">Conducted On: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="text" readonly v-model="conductedDate" class="form-control form-control-sm">
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                 <label class="col-md-3 col-form-label">Location: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="text" readonly v-model="surveyLocation" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                 <label class="col-md-3 col-form-label">Cordinates: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="text" readonly v-model="surveyCordinates" class="form-control form-control-sm">
                                </div>
                            </div> -->
                            <div class="form-group row">
                                 <label class="col-md-3 col-form-label">Remarks: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input type="text" readonly v-model="surveyRemarks" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row" v-show="this.type.text=='Partial Loss'">
                                <label class="col-md-3 col-form-label">Place of Loss: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <input v-model="placeOfLoss" class="form-control form-control-sm" >
                                </div>
                            </div>  
                            <div class="form-group row" v-show="this.type.text=='Partial Loss'">
                                <label class="col-md-3 col-form-label">Date of Loss: </label>
                                <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                                    <input type="date" v-model="dateOfLoss" class="form-control form-control-sm">
                                </div>
                                <div class="col-md-4 pl-2 pr-0" style="padding-left:0px">
                                    <input type="time" style="height:30px" v-model="timeOfLoss" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row" v-show="this.type.text=='Partial Loss'">
                                 <label class="col-md-3 col-form-label">Circumstances: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                    <textarea v-model="circumstances" class="form-control form-control-sm" style="height:100px"></textarea>
                                </div>
                            </div>  
                        
                          <hr>
            


                             <h5>Job Details</h5>
                        <br/>
                        <div class="form-group row">
                            <label class="col-md-3" for="company">Underwriter: </label>
                            <div class="col-md-8 pl-0 pr-0">
                              <input type="text" v-model="underwriter" class="form-control form-control-sm">
                              
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="company">Development Officer: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <textarea style="height:40px" v-model="developOfficer" class="form-control form-control-sm"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3" for="company">Survey Type: </label>
                            <div class="col-md-8 pl-0 pr-0">
                               <Select id="task" label="text"
                              :class="['mySelect']" @input="getModes()" v-model="type" :options="types"></Select>
                              
                            </div>
                        </div>

                       <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Mode:</label>
                            <div class="col-md-8 pl-0 pr-0">
                            <Select :options="modes" class="mySelect" v-model="mode" label="text"></Select>
                            </div>
                            <div class="col-md-8 pl-0 pr-0 offset-md-3">
                                <input type="text" name="" class="form-control form-control-sm" v-model="otherMode"  v-show="mode.text=='Others' || mode.text=='Other' "  id="">
                            </div>
                        
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Item: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                <Select :options="items" class="mySelect" v-model="item" label="text"></Select>

                            </div>
                                <div class="col-md-8 pl-0 pr-0 offset-md-3">
                                    <input type="text" name="" class="form-control form-control-sm" v-model="otherItem"  v-show="item.text=='Other'"  id="">
                                </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Tracking ID: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="trackingId" class="form-control form-control-sm">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Name of Insured: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="nameOfInsured" class="form-control form-control-sm">
                        </div>
                        </div>
                    

                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Address: </label>
                        <div class="col-md-8" style="padding-left:0px;padding-right:0px">
                        <textarea class="form-control " v-model="address" col="1" row="1" name="" id="" style="height: 35px;"></textarea>
                        </div>
                        </div>

                        <div class="form-group row" v-if="type.text=='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">NIC of Insured: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="nicOfInsure" class="form-control form-control-sm">
                        </div>
                        </div>
                    
                        <div class="form-group row" v-if="type.text=='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">NTN of Insured: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="ntnOfInsured" class="form-control form-control-sm">
                        </div>
                        </div>
                       
                       <div class="form-group row">
                        <label class="col-md-3 col-form-label">C/No of Insured: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="cnoOfInsure" class="form-control form-control-sm">
                        </div>
                        </div>
                    
                        <div class="form-group row" v-if="type.text=='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Contact Person: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="contactPerson" class="form-control form-control-sm">
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Contact Nos: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="contactNos" class="form-control form-control-sm">
                        </div>
                        </div>
                    
                        <div class="form-group row" v-if="type.text=='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Service: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="service" class="form-control form-control-sm">
                        </div>
                        </div>
                    
                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Policy No.: </label>
                        <div class="col-md-8" style="padding-left:0px;padding-right:0px">
                        <textarea class="form-control " v-model="policyNo" col="1" row="1" name="" id="" style="height: 35px;"></textarea>
                        </div>
                        </div>

                        <div class="form-group row" v-if="type.text!='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Endrs. No.: </label>
                        <div class="col-md-9" style="padding-left:0px">
                        <textarea class="form-control " v-model="endrsNo" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                        </div>
                        </div>

                        <div class="form-group row" v-if="type.text!='Pre-Insurance'">
                            <label class="col-md-3 col-form-label">Validity From: </label>
                            <div class="col-md-3" style="padding-left:0px">
                                <input type="date" v-model="validityFrom" name="" class="form-control form-control-sm" id="">   
                            </div>
                            <label class="col-md-3 col-form-label">Validity To: </label>
                            <div class="col-md-3" style="padding-left:0px">
                                <input type="date" v-model="validityTo" name="" class="form-control form-control-sm" id="">   
                            </div>
                        </div>

                        <div class="form-group row"  v-if="type.text!='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Loss No: </label>
                        <div class="col-md-9" style="padding-left:0px">
                        <input type="text" v-model="lossNo" class="form-control form-control-sm" name="" id="">
                        </div>
                        </div>
                        <div class="form-group row" v-if="type.text!='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Nature of Loss: </label>
                        <div class="col-md-9" style="padding-left:0px">
                        <textarea class="form-control " v-model="natureOfLoss" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                        </div>
                        </div>

                        <div class="form-group row">
                        <label class="col-md-3 col-form-label">Sum Insured: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="number" v-model="sumInsured" class="form-control form-control-sm">
                        </div>
                        </div>

                         <div class="form-group row">
                        <label class="col-md-3 col-form-label">Market Value: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="number" v-model="marketValue" class="form-control form-control-sm">
                        </div>
                        </div>

                        <div class="form-group row"  v-if="type.text!='Pre-Insurance'">
                        <label class="col-md-3 col-form-label">Workshop: </label>
                        <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="workshop" class="form-control form-control-sm">
                        </div>
                        </div>

         
            


           
                    
                    </div>

                    <div class="col-md-6" >
                        <section >
                                <h5>Dents found at Inspection</h5>
                                <br>
                                
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">1): </label>
                                <div class="col-md-9" style="padding-left:0px">
                                <textarea class="form-control" v-model="dent1"  col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                </div>
                                </div>

                                
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">2): </label>
                                <div class="col-md-9" style="padding-left:0px">
                                <textarea class="form-control " v-model="dent2" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">3): </label>
                                <div class="col-md-9" style="padding-left:0px">
                                <textarea class="form-control " v-model="dent3" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                </div>
                                </div>
                                
                                <!-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">4): </label>
                                <div class="col-md-9" style="padding-left:0px">
                                <textarea class="form-control " v-model="dent4" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                </div>
                                </div>
                                
                            
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">5): </label>
                                <div class="col-md-9" style="padding-left:0px">
                                <textarea class="form-control " v-model="dent5" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                </div>
                                </div> -->
                                
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Remarks: </label>
                                    <div class="col-md-9" style="padding-left:0px">
                                    <textarea class="form-control " v-model="dentRemarks" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                                    </div>
                                </div>
                                        
                            <hr>

                        </section>
                       
                        <section  v-if="this.type.text=='Pre-Insurance' || this.type.text=='Partial Loss' ">
                        <h5>Vehicle Details</h5>
            
                            <br>

                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Reg No.: </label>
                            <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="regNo" class="form-control form-control-sm">
                            </div>

                            <div class="col-md-4 pl-2 pr-0" style="padding-left:0px">
                            <input type="date" v-model="regNoDate" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Manufacturer: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="manufacturer" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Make: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="make" class="form-control form-control-sm">
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Model: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="model" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Variant: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="variant" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Engine No.: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="engineNo" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Chassis No.: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="chassisNo" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Engine Capacity: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="engineCap" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Seating: </label>
                            <div class="col-md-2 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="seating" class="form-control form-control-sm">
                            </div>
                            <label class="col-md-3 col-form-label">Papers: </label>
                            <div class="col-md-1" style="padding:5px">
                            <input type="checkbox" v-model="paper" class="">
                            </div>
                            <label class="col-md-3 col-form-label">Availble? </label>
                            </div>

                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Color: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="color" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Odometer (KM): </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="odometer" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Body Type: </label>
                            <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                            <input type="text" v-model="bodyType" class="form-control form-control-sm">
                            </div>
                            </div>
                        
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select: </label>
                            <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                            <input type="radio" value="private" v-model="selectOne">
                            <label for="">Private</label>
                            </div>
                            <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                            <input type="radio" value="commercial" v-model="selectOne">
                            <label for="">Commercial</label>
                            </div>
                            </div>
                            
                            <div class="form-group row">
                            <label class="col-md-3 col-form-label">Select: </label>
                            <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                            <input type="radio" value="local assembled" v-model="selectTwo">
                            <label for="">Local<br> Assembled</label>
                            </div>
                            <div class="col-md-4 pl-0 pr-0" style="padding-left:0px">
                            <input type="radio" value="imported" v-model="selectTwo">
                            <label for="">Imported</label>
                            </div>
                            </div>
                            
                            <div v-show="this.type.text=='Pre-Insurance'">
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Value: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                <input type="text" v-model="value" class="form-control form-control-sm">
                                </div>
                                </div>
                            
                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Addtional Value: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                                <input type="text" v-model="addValue" class="form-control form-control-sm">
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                <label class="col-md-10 col-form-label">Copy of Reg Book (Exisiting Owner): </label>
                                <div class="col-md-2" style="padding:5px">
                                <input type="checkbox" v-model="copyOfReg" > <label for="">?</label>
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                <label class="col-md-10 col-form-label">Brand New Vehicle Copy of Sale Invoice: </label>
                                <div class="col-md-2" style="padding:5px">
                                <input type="checkbox" v-model="brandNew" > <label for="">?</label>
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                <label class="col-md-10 col-form-label">Copy of CNIC of Insured: </label>
                                <div class="col-md-2" style="padding:5px">
                                <input type="checkbox" v-model="copyOfCnic" > <label for="">?</label>
                                </div>
                                </div>

                                
                                <div class="form-group row">
                                <label class="col-md-10 col-form-label">Copy of Imported Documents: </label>
                                <div class="col-md-2" style="padding:5px">
                                <input type="checkbox" v-model="copyOfImportDoc" > <label for="">?</label>
                                </div>
                                </div>
                                
                                <div class="form-group row">
                                <label class="col-md-10 col-form-label">Bill of Entry, Bill of Lading, Importers Invoice: </label>
                                <div class="col-md-2" style="padding:5px">
                                <input type="checkbox" v-model="bill"> <label for="">?</label>
                                </div>
                                </div> 
                            </div>
                            <div v-show="this.type.text=='Partial Loss'">

                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Name of Driver: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding:5px">
                                <input type="text" v-model="nameOfDriver" class="form-control form-control-sm"> 
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Age of Driver: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding:5px">
                                <input type="number" v-model="ageOfDriver" class="form-control form-control-sm"> 
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">License No: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding:5px">
                                <input type="text" v-model="vehicleLicenseNo" class="form-control form-control-sm"> 
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Issued On: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding:5px">
                                <input type="date" v-model="vehicleLicenseIssuedOn" class="form-control form-control-sm"> 
                                </div>
                                </div>

                                <div class="form-group row">
                                <label class="col-md-3 col-form-label">Expired On: </label>
                                <div class="col-md-8 pl-0 pr-0" style="padding:5px">
                                <input type="date" v-model="vehicleLicenseExpiredOn" class="form-control form-control-sm"> 
                                </div>
                                </div>

                            </div>
                            <hr>  
                        </section>
                           
                
            <h5>Charges Details</h5>
                <br/>
            


                <div class="form-group row">

                    <label class="col-md-3 col-form-label">Final Draft: </label>
                    <div class="col-md-6">  
                        <input type="file"  class="form-control form-control-sm " @change="addFinal()" ref="final">

                    </div>
                    <button class="col-md-1 btn btn-primary btn-sm" @click="viewFinalReport()">....</button>
                       <!-- Final Draft Modal -->
                    <div class="modal fade bd-example-modal-2" tabindex="-1" role="dialog" id="finalDraftModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Final Draft </h5>
                                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="container" v-show="loading" >
                                        <div class="row justify-content-md-center">
                                                <img :src="loader">
                                        </div>

                                    </div>

                                    <div v-show="!loading">
                                        <iframe :src="finalDraft"  width="100%" v-show="!loading" height="550px" frameborder="0"></iframe>

                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Final Draft Modal-->
                </div>

           
            
            <div class="form-group row">
             

                 <label class="col-md-3 col-form-label">Other Documents: </label>
                   <div class="col-md-6">  
                        <input type="file"  class="form-control form-control-sm " @change="addDocuments()" ref="documents"  multiple="multiple" >

                    </div>
                    <button style="height:36px" class="col-md-1 btn btn-primary btn-sm" @click="viewOtherDocuments()">....</button>
           
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
                                    <div class="container-fluid" v-show="loading" >
                                        <div class="row">
                                            <a class="btn btn-primary" :href="/downloadDocuments/+this.id" style="color:white">Download All</a>

                                        </div>
                                        <div class="row " style="margin-top:20px;">
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
           
           </div>
           <div class="form-group row">
            <div class="col-md-3">
                <input type="checkbox" v-model="isSalesTax">
                <label>Sales Tax ?</label>
            </div>
            <div class="col-md-2">
                <input type="number" v-model="saleRate" class="form-control form-control-sm">
            </div>

           </div>
            <div class="form-group row">

            <label class="col-md-3 col-form-label">Services Charges: </label>
            <div class="col-md-3" style="padding-left:0px">
               <input type="number" v-model="serviceCharges" :class="[{ 'date-invalid': $v.serviceCharges.$error,},'form-control']">

                <div v-if="$v.serviceCharges.$error">
                    <p class="text-danger"
                    v-if="!$v.serviceCharges.required">
                    Required
                    </p>
                </div>

            </div>
            <label class="col-md-3 col-form-label">Snaps: </label>
            <div class="col-md-3"  style="padding-left:0px">
            <input type="text" v-model="snapCharges"  class="form-control ">
            </div>



            </div>

            <div class="form-group row">

            <label class="col-md-3 col-form-label">Re-Inspection: </label>
            <div class="col-md-3"  style="padding-left:0px">
            <input type="text" v-model="reInspectionCharges"   class="form-control ">

            </div>

            <label class="col-md-3 col-form-label">Extra Visit: </label>
            <div class="col-md-3"  style="padding-left:0px">
            <input type="text" v-model="extraVisitCharges"  class="form-control ">
            </div>

            
           
            </div>


            <div class="form-group row">

            <label class="col-md-3 col-form-label">Travelling: </label>
            <div class="col-md-3"  style="padding-left:0px">
            <input type="number" v-model="travelCharges" :class="[{ 'date-invalid': $v.serviceCharges.$error,},'form-control']"  class="form-control ">
                <div v-if="$v.travelCharges.$error">
                    <p class="text-danger"
                    v-if="!$v.travelCharges.required">
                    Required
                    </p>
                </div>
            </div>

            <label class="col-md-3 col-form-label">O/S Certificate: </label>
            <div class="col-md-3"  style="padding-left:0px">
            <input type="text" disabled  class="form-control ">
            </div>           
            </div>

            <div class="form-group row">
            <label class="col-md-3 col-form-label">T/Details: </label>
            <div class="col-md-9" style="padding-left:0px">
            <textarea class="form-control"  v-model="tsDetails"   col="1" row="1" name="" id="" style="height: 100px;"></textarea>
            </div>
            </div>

                <div class="form-group row">
            <label class="col-md-3 col-form-label">Print Bill(F/C): </label>
            <div class="col-md-9" style="padding-left:0px">
            <input type="checkbox" >
            
            </div>
            </div>
                    </div>
                    </div>
                </div>

                 <div class="row">
                    
                   
                </div>
                          
              
      

            

            
           
    

            <hr>

               <!-- Document & Accessories Modal -->
               <documents style=" overflow: auto;height: 400px;"
            :id="this.id"
            :type="this.type.text"
            ></documents>
            <!-- Document & Accessories Modal -->
        
        
        </div>
            <div class="form-group row" style="padding-right:30px" >
            <div class="col-md-12" >
            <input type="button"  style="margin:10px" v-if="!saveButton"  @click="onComplete()" class="btn btn-primary" value="Save">
            <a href="#"><input type="button"  class="btn btn-primary" style="margin:10px" value="Ignore"></a>
            <a :href="'/printPrismBill/'+this.id" target="_blank">
                <input type="button"  style="margin:10px"  class="btn btn-primary" value="Print Bill">        
            </a>
            <a :href="'/salesTaxInvoice/'+this.id" target="_blank">
            <input type="button"  style="margin:10px"  class="btn btn-primary" value="Print Sale Tax Invoice">
            </a>
            <label for="">
                <input type="checkbox" style="margin:10px" name="" @change="updateLetterHead()" v-model="isLetterHead" id=""> Letter Head?  
            </label>
            <label for="">
                <input type="checkbox" style="margin:10px" name="" @change="updateStamp()" id="" v-model="isStamp"> Stamp?  
            </label>
            <label for="">
                <input type="checkbox" style="margin:10px"  name="" v-model="isImages" @change="updateIsImages()" id=""> 4 Images/Pages?  
            </label><label for="">
                <input type="checkbox" style="margin:10px" name="" id="" v-model="isPartRates" @change="updatePartRates()"> Part Rates?  
            </label>
            </div>
            <div class="col-md-3" style="padding-left: 20px; margin: 10px 0px 0px 7px;">
            <Select  class="mySelect" :options="reportTypes" v-model="reportType" label="text" @input="updateReportType()"></Select>
                    <div class="modal fade bd-example-modal-lg" id="pdfmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Letter(s)</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <!-- <iframe style=" width: 100%;height: 600px" :src="mypdf" ></iframe> -->
                                <div class="modal-body">
                                    <letter
                                :usertoken="this.usertoken"
                                :jobid="this.id"
                                ></letter>
                                </div>

                        </div>
                        </div>
                    </div>
            </div>
            <!-- <a :href="'/printPrismReport/'+this.id" target="_blank"> -->
            <input type="button"   style="margin:10px" @click="printReport()"  class="btn btn-primary" value="Print Report">
           <!-- </a> -->
            <input type="button"  @click="copyJob()" style="margin:10px"  class="btn btn-primary" value="Job Copy">

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
    import Cancel from "./modal/Cancel.vue";
    import Hold from "./modal/Hold.vue";
    import Documents from "./modal/Documents.vue";
    import Letter from "./modal/Letter.vue";

   import vSelect from "vue-select";
   import vMultiselect from "vue-multiselect";
   import "vue-select/dist/vue-select.css";
   import Autocomplete from "@trevoreyre/autocomplete-vue";
   import "@trevoreyre/autocomplete-vue/dist/style.css";
   export default {
       props: {
          id:String,
          jobid:String,
          common:String,
          cmpny:String,
          usertoken:String
       },
       components: {
           Select: vSelect,
           'cancel':Cancel,
           'hold':Hold,
           'letter':Letter,
           'documents':Documents,
           MultiSelect: vMultiselect,
           Autocomplete,
       },
       data() {
           return {
                   insurer: "",
               selectedBranch: "",
               jid: "",
               insurerBranch: "",
               billingAddress: "",
               concOfficer: "",
               insurerDesignation: "",
               insurerPhone: "",
               ibrCustomerFax: "",
               insurerEmail: "",
               insurerletterNo: "",
               insurerDate: "",
               company: "",
               region: "",
               companies: [],
               insurers: [],
               regions: [],
               branches: [],
               cities: [],
               branchCity: "",
               branchName: "",
               surveyStatus: "",
               branchCode: "",
               branchAddress: "",
               branchPhone: "",
               edd: new Date(),               
               isSalesTax: true,
            //    isSalesTax: "",
               saleReg: "",
               saleRate: "",
               serviceCharges: "",
               snapCharges: "",
               reInspectionCharges: "",
               extraVisitCharges: "",
               saveButton: false,
               travelCharges: "",
               recoveryBranch:"",
               branchConduct:"",
               snapCharges:"",
               reInspection:"",
               extraVisit:"",
               osCerificates:"",
               tsDetails:"",
               SurveyPolicyNo:"",
               SurveyEndrNo:"",
               surveyors:[],
               surveyor:'',
               requestedDate:'',
               requestedTime:'',
               deliveredOn:'',
               finalDraft:'',
               loader:'',
               path:'',
               travlingExpenses:'',
               reportDate:'',
               dateOfInsp:'',
               timeOfInsp:'',
               placeOfSurvey:'',
               reInspDate:'',
               underwriter:'',
               developOfficer:'',
                types: [],
                type: '',
                items: [],
               modes: [],
               reportTypes: [
                   {text:'Final Report'},
                   {text:'Preliminary Report'},
                   {text:'Calculation Sheet'},
                   {text:'No Loss Letter'},
                   {text:'Complete Set'}
               ],
               reportType:'',
               mode: "",
               item: '',
               otherItem:'',
               trackingId:'',
               nameOfInsured:'',
               address:'',
               nicOfInsure:'',
               ntnOfInsured:'',
               cnoOfInsure:'',
               contactPerson:'',
               contactNos:'',
               service:'',
               policyNo:'',
               endrsNo:'',
               validityFrom:'',
               validityTo:'',
               lossNo:'',
               natureOfLoss:'',
               marketValue:'',
               workshop:'',
               sumInsured:'',
               dent1:'',
               dent2:'',
               dent3:'',
               dent4:'',
               dent5:'',
               otherMode:'',
               dentRemarks:'',              
                regNo:'',
                regNoDate:'',
                manufacturer:'',
                make:'',
                model:'',
                variant:'',
                engineNo:'',
                chassisNo:'',
                engineCap:'',
                seating:'',
                paper:'',
                color:'',
                odometer:'',
                bodyType:'',
                selectOne:'',
                selectTwo:'',
                value:'',
                addValue:'',
                copyOfReg:'',
                brandNew:'',
                copyOfCnic:'',
                conductedDate:'',
                copyOfImportDoc:'',
                surveyRemarks:'',
                surveyLocation:'',
                surveyCordinates:'',
                isJobCompleted:false,
                bill:'',
                payTo:'',
                placeOfLoss:'',
                dateOfLoss:'',
                timeOfLoss:'',
                circumstances:'',
                mypdf:'',
                nameOfDriver:'',
                ageOfDriver:'',
                vehicleLicenseNo:'',
                vehicleLicenseIssuedOn:'',
                vehicleLicenseExpiredOn:'',
                isLetterHead:false,
                isStamp:false,
                isImages:false,
                isPartRates:false,
               loading:true,
               isTakaful:false,
               isCompleted:false,
                documents:[],

           };
       },
       mounted() {
            this.getCompany();
            this.getRegion();
            this.getInsurers();
            this.getPrismTypes();
            this.getCity();
            this.getSurveyors();
            this.getPrismData();

              this.loader=document.location.origin+'/images/loader.gif';
        // this.getValuationJob();
        this.path=document.location.origin+'/Reports/Prism/'+this.id+'/Documents/';
       this.reportType={text:'Final Report'};
         
       },
       methods: {

        printReport(){
 
            if(this.reportType.text=="No Loss Letter")
            {

                $('#pdfmodal').modal('show');


            }

            else{
                window.open('/printPrismReport/'+this.id, '_blank');

            }
        //     // console.log(field);
        //     const jobData={
        //         'type':this.reportType.text
        //     };
        //     axios.post("/printPrismReport/"+this.id,jobData,{responseType: 'arraybuffer'}).then(response =>{

        //             $('#pdfmodal').modal('show');

        //             var file = new Blob([response.data], {type: 'application/pdf'});
        //                 var fileURL = URL.createObjectURL(file);
        //                 this.mypdf=fileURL;

        //     }).catch(error=>{
        //         alert(error);
        //     })
            },
        copyJob()
        {
            var id=this.jid+1;
            let text = "Are You Sure?";
            if (confirm(text) == true) {

                                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
            axios.post("/duplicateJob/"+this.id)
            .then((res)=>{
                alert('Job Created Successfully');
                // window.location='edit/'+res.data;
                window.open('/edit/'+res.data, '_blank');
            }).catch((error)=>{
                alert('Something went wrong please do not try again inform admin first');
            });



            }

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
    formData.append('jid', this.jobid);


        axios.post('/uploadDocumentsPrism',formData).then(res=>{
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
             axios.get('/getFilesPrism/' +this.id)
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
        
        getPrismData(){
            const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
            axios.get('/api/gePrismJobData/'+this.id,{
                headers:headers
            }).then((res)=>{
                // console.log(res.data);
                res.data.forEach((obj)=>{
                    // alert(obj.requested_date);
                    this.jid=obj.jid;
                    this.requestedDate=obj.requested_date;
                    this.requestedTime=obj.requested_time;
                    this.deliveredOn=obj.delivered_on;
                    this.isCompleted=obj.is_completed===1 ? true:false;
                    this.isJobCompleted=obj.is_completed===1 ? true:false;
                    this.isTakaful=obj.is_takaful===1 ? true:false;
                    this.company={text:obj.company_name,value:obj.company};
                    this.region={text:obj.region_name,value:obj.region};
                    this.branchConduct={text:obj.branch_conduct_city,value:obj.branch_conducting};
                    this.recoveryBranch={text:obj.recovery_branch_city,value:obj.recovery_branch};
                    this.insurer={text:obj.insurer_name,value:obj.insurer,prefix:obj.insurer_prefix};
                    this.insurerBranch={text:obj.insurer_branch_name,value:obj.insurer_branch};
                    this.surveyor={text:obj.surveyor_name,value:obj.surveyor_id};
                    this.travlingExpenses=obj.travelling_expenses;
                    this.reportDate=obj.report_date;
                    this.dateOfInsp=obj.date_of_inspection;
                    this.timeOfInsp=obj.time_of_inspection;
                    this.placeOfSurvey=obj.place_of_survey;
                    this.reInspDate=obj.re_inspecton_date;
                    // 
                    this.underwriter=obj.underwriter;
                    this.developOfficer=obj.development_officer;
                    this.type={text:obj.survey_type_name,value:obj.survey_type};
                    this.mode={text:obj.survey_mode,value:obj.survey_mode};
                    this.otherMode=obj.survey_mode_other;
                    this.otherItem=obj.survey_item_other;
                  
                    this.item={text:obj.survey_item,value:obj.survey_item};
                    // this.otherItem=obj.other_item;
                    this.trackingId=obj.tracking_id;
                    this.nameOfInsured=obj.name_of_insured;
                    this.address=obj.address;
                    this.nicOfInsure=obj.nic_of_insured;
                    this.ntnOfInsured=obj.ntn_of_insured;
                    this.cnoOfInsure=obj.c_no_of_insured;
                    this.contactPerson=obj.contact_person;
                    this.contactNos=obj.contact_nos;
                    this.service=obj.service;
                    this.policyNo=obj.policy_no;
                    this.endrsNo=obj.endors_no;
                    this.validityFrom=obj.validity_from;
                    this.validityTo=obj.validity_to;
                    this.lossNo=obj.loss_no;
                    this.natureOfLoss=obj.nature_of_loss;
                    this.marketValue=obj.market_value;
                    this.workshop=obj.workshop;
                    this.sumInsured=obj.sum_insured;
                    this.dent1=obj.dents_one;
                    this.dent2=obj.dents_two;
                    this.dent3=obj.dents_three;
                    this.dent4=obj.dents_four;
                    this.dent5=obj.dents_five;
                    this.dentRemarks=obj.dents_remarks;
                    this.regNo=obj.reg_no;
                    this.regNoDate=obj.reg_date;
                    this.manufacturer=obj.manufacture;
                    this.make=obj.make;
                    this.model=obj.model;
                    this.variant=obj.variant;
                    this.engineNo=obj.engine_no;
                    this.chassisNo=obj.chassis_no;
                    this.engineCap=obj.engine_capacity;
                    this.seating=obj.seating;
                    this.paper=obj.is_paper_available;
                    this.color=obj.color;
                    this.odometer=obj.odometer;
                    this.bodyType=obj.body_type;
                    this.selectOne=obj.select_type_one;
                    this.selectTwo=obj.select_type_two;
                    this.value=obj.value;
                    this.addValue=obj.additional_value;
                    this.copyOfReg=obj.copy_of_reg_book;
                    this.conductedDate=obj.conducted_on;
                    this.brandNew=obj.brand_new_vehicle;
                    this.copyOfCnic=obj.copy_of_cnic_insured;
                    this.copyOfImportDoc=obj.copy_of_import_documents;
                    this.bill=obj.bill_of_entry;
                    this.concOfficer=obj.insurer_conc_officer;
                    this.billingAddress=obj.insurer_billing_address;
                    this.insurerDesignation=obj.insurer_designation;
                    this.insurerPhone=obj.insurer_phone;
                    this.insurerEmail=obj.insurer_email;
                    this.insurerletterNo=obj.insurer_letter_no;
                    this.insurerDate=obj.insurer_letter_date;
                    this.serviceCharges=obj.service_charges;
                    this.travelCharges=obj.travelling;
                    this.snapCharges=obj.snaps;
                    this.reInspectionCharges=obj.re_inspection_charges;
                    this.extraVisitCharges=obj.extra_visit;
                    this.tsDetails=obj.ts_details;

                    this.surveyLocation=obj.survey_location;
                    this.surveyCordinates=obj.survey_cordinates;
                    this.surveyRemarks=obj.survey_remakrs;
                    this.surveyStatus=obj.survey_status;
                    this.isLetterHead=obj.letter_head===1 ? true:false;
                    this.isStamp=obj.stamp===1 ? true:false;
                    this.isImages=obj.is_images===1 ? true:false;
                    this.isPartRates=obj.part_rates===1 ? true:false;
                    this.isSalesTax=obj.is_tax===1 ? true:false;
                    this.payTo=obj.pay_to;
                    this.placeOfLoss=obj.place_of_loss;
                    this.dateOfLoss=obj.date_of_loss;
                    this.timeOfLoss=obj.time_of_loss;
                    this.circumstances=obj.circumstances;
                    this.nameOfDriver=obj.name_of_driver;
                    this.ageOfDriver=obj.age_of_driver;
                    this.vehicleLicenseNo=obj.license_no;
                    this.vehicleLicenseIssuedOn=obj.issued_on;
                    this.vehicleLicenseExpiredOn=obj.expired_on;

                    this.getBranches(obj.insurer_branch);

                    // if( obj.is_completed==3)
                    // {
                    // this.saveButton=true;
                    // }

                    // else if(obj.is_completed==1)
                    // {
                    // this.saveButton=true;

                    // }

                    this.getModes();


                });


            }).catch((error)=>alert(error));
        },
           onComplete: function() {
   
                if(this.isCompleted==true)
                {
                    if (this.$v.completeValidate.$invalid) {
                       this.$v.completeValidate.$touch();
                       var isValid = !this.$v.completeValidate.$invalid;
                       this.$emit("on-validate", this.$data, isValid);
                       return isValid;
                   } else {
                       this.postdata();
   
                   }
                }
                else{
                       this.postdata();

                }
           },
   
           
             viewFinalReport(){
        this.finalDraft="";
        this.loading=true;
        axios.get('/getFinalReportPrism/' +this.id)
                    .then(res=>{

                        if(res.data=='File does not exists')
                        {    this.loading=false;
                            alert('File Not Found');
                             this.finalDocument=false;

                        }

                        else{
                            $('#finalDraftModal').modal('show');
                            this.loading=false;
                            this.finalDraft=document.location.origin+res.data;
                            }


                    })

   },
   
           postdata() {

            // alert(this.usertoken);
               // this.saveButton = true;
   
               // var month = this.edd.getMonth() + 1;
               // var eddate =
               //     this.edd.getFullYear() + "-" + month + "-" + this.edd.getDate();
               //   var string=this.$refs.ibrCompany.value;
               //  var cmpname=string.replace(/[{()}^0-9-]/g, "");
   
               const jobData = {
                   job_by: this.company.value,
                   commonId: this.common,
                   company_prefix: this.company.prefix,
                   regional_prefix: this.region.prefix,
                   regional_id: this.region.value,
                   branch_conducting:this.branchConduct.value,
                   recovery_branch:this.recoveryBranch.value,
                   insurer_id: this.insurer.value,
                   insuer_prefix: this.insurer.prefix,
                   insurer_branch_id: this.insurerBranch.value,
                   insurer_address: this.billingAddress,
                   insurer_conc_officer: this.concOfficer,
                   insurer_designation: this.insurerDesignation,
                   insurer_phone: this.insurerPhone,
                   insurer_email: this.insurerEmail,
                   insurer_letter: this.insurerletterNo,
                   insurer_date: this.insurerDate,
                   survey_type: this.type.value,
                   survey_type_prefix: this.type.prefix,
                   survey_type_is: this.type.type,
                   survey_mode: this.mode.text,
                   survey_mode_other: this.otherMode,
                   survey_item: this.item.text,
                   survey_item_other: this.otherItem,
                   tracking_id: this.trackingId,
                //    name_of_insured: this.nameOfInsured,
                   surveyAddress: this.surveyAddress,
                   nic_of_insured: this.nicOfInsured,
                   ntn_of_insured: this.ntnOfInsured,
                   contact_person: this.contactPerson,
                   survey_service: this.surveyService,
                   survey_policy_no: this.SurveyPolicyNo,
                   survey_endr_no: this.SurveyEndrNo,
                   validity_from: this.validityFrom,
                   validity_to: this.validityTo,
                   loss: this.lossNo,
                   loss_no_due_to: this.lossNoDueTo,
                   workshop: this.workshop,
                   service_charges: this.serviceCharges,
                   is_sales_tax: this.isSalesTax,
                   snap_charges: this.snapCharges,
                   extra_visit:this.extraVisitCharges,
                   re_inspection_charges:this.reInspectionCharges,
                   travling_charges: this.travelCharges,
                   os_certificate: this.osCerificates,
                   ts_details: this.tsDetails,
                   requested_date: this.requestedDate,
                   requested_time: this.requestedTime,
                   delivered_on: this.deliveredOn,
                   is_completed: this.isCompleted,
                   is_takaful: this.isTakaful,
                   surveyor: this.surveyor.value,
                   travelling_expenses: this.travlingExpenses,
                   report_date: this.reportDate,
                   date_of_inspection: this.dateOfInsp,
                   time_of_inspection: this.timeOfInsp,
                   place_of_survey: this.placeOfSurvey,
                   re_inspecton_date: this.reInspDate,
                //    
                   underwriter: this.underwriter,
                   development_officer: this.developOfficer,
                   tracking_id: this.trackingId,
                   name_of_insured: this.nameOfInsured,
                   address: this.address,
                   nic_of_insured: this.nicOfInsure,
                   ntn_of_insured: this.ntnOfInsured,
                   c_no_of_insured: this.cnoOfInsure,
                   contact_person: this.contactPerson,
                   contact_nos: this.contactNos,
                   service: this.service,
                   policy_no: this.policyNo,
                   endors_no: this.endrsNo,
                   validity_from: this.validityFrom,
                   validity_to: this.validityTo,
                   loss_no: this.lossNo,
                   nature_of_loss: this.natureOfLoss,
                   market_value: this.marketValue,
                   workshop: this.workshop,
                   sum_insured: this.sumInsured,
                   dents_one:this.dent1,
                   dents_two:this.dent2,
                   dents_three:this.dent3,
                   dents_four:this.dent4,
                   dents_five:this.dent5,
                   dents_remarks:this.dentRemarks,
                   reg_no:this.regNo,
                    reg_date:this.regNoDate,
                    manufacture:this.manufacturer,
                    make:this.make,
                    model:this.model,
                    variant:this.variant,
                    engine_no:this.engineNo,
                    chassis_no:this.chassisNo,
                    engine_capacity:this.engineCap,
                    seating:this.seating,
                    is_paper_available:this.paper,
                    color:this.color,
                    odometer:this.odometer,
                    body_type:this.bodyType,
                    select_type_one:this.selectOne,
                    select_type_two:this.selectTwo,
                    value:this.value,
                    additional_value:this.addValue,
                    copy_of_reg_book:this.copyOfReg,
                    brand_new_vehicle:this.brandNew,
                    copy_of_cnic_insured:this.copyOfCnic,
                    copy_of_import_documents:this.copyOfImportDoc,
                    bill_of_entry:this.bill,
                    service_charges:this.serviceCharges,                  
                    travelling:this.travelCharges,                  
                    part_rates:this.isPartRates,                  
                    is_images:this.isImages,                  
                    stamp:this.isStamp,                  
                    letter_head:this.isLetterHead,                  
                    pay_to:this.payTo,                  
                    place_of_loss:this.placeOfLoss,                  
                    date_of_loss:this.dateOfLoss,                  
                    time_of_loss:this.timeOfLoss,                  
                    circumstances:this.circumstances,                  
                    name_of_driver:this.nameOfDriver,                  
                    age_of_driver:this.ageOfDriver,                  
                    license_no:this.vehicleLicenseNo,                  
                    issued_on:this.vehicleLicenseIssuedOn,                  
                    expired_on:this.vehicleLicenseExpiredOn                  
                    // circumstances:this.circumstances,                  
                   
               };
               console.log(jobData);
               const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
   
               axios
                   .put("/api/updatePrismJob/"+this.id, jobData, {
                       headers: headers,
                   })
                   .then((res) => {
                    //    this.saveButton = false;
   
                       alert("Job is successfully Updated");
                    //    console.log(jobData);
                    //    window.location.href = "/home";
                    //    return false;

                        if(this.isCompleted==true){

                            if(this.isJobCompleted==0){
                                this.updateBill();

                            }
                        }   

                        this.getPrismData();
                   })
                   .catch((error) => alert(error));
           },
          
           getCity() {
               axios.get("/getCities").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       this.cities.push({
                           text: obj.city_name,
                           value: obj.city_id
                       });
                   });  
               });
           },

            addFinal(){
                this.finalDraft="";

                    this.file = this.$refs.final.files[0];

                    let formData = new FormData();
                    formData.append('myfile', this.file);
                    formData.append('job_id', this.id);
                    formData.append('jid', this.jobid);

                    // this.loading=true;
                    axios.post('/uploadFinalPrism',formData).then(res=>{


                            if(res.data=="Unsupported")
                            {
                                alert('Unsupported');
                            }

                            else{
                            $('#finalDraftModal').modal('show');
                            this.loading=false;
                            // this.finalDocument=true;
                            this.finalDraft=document.location.origin  + res.data;

                            alert('File Uploaded Successfully');


                            }

                        }).catch(error=>{
                            alert("Please select some file");



                            });


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
                           text: obj.name+' ('+obj.city_name+')',
                           value: obj.id
                       });
                   });
               });
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
            getPrismTypes() 
           {
               this.types = [];
               axios.get("/gePrismTypes").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.types.push({
                           text: obj.name,
                           value: obj.id,
                           type: obj.type,
                           prefix: obj.prefix,
                       });
                   });
               });
           },

             getModes() {
                //  this.mode="";
                 this.modes=[];
               let id = this.type.value;
            //    alert(id);
               axios.get("/getModes/" + id) //with id
                   .then((res) => {
                       res.data.forEach((obj) => {
                           let text = "";
                            let value = "";
                            let prefix = "";
                            this.modes.push({
                                text: obj.name,
                                value: obj.id
                            });
                       });
                   })
                   .catch((error) => {

                       console.log(error.response);
                   });

                    // this.item="";
                    this.items=[];
                    let itd = this.type.value;
                    axios.get("/getItems/" + itd) //with id
                        .then((res) => {
                            res.data.forEach((obj) => {
                                let text = "";
                                    let value = "";
                                    let prefix = "";
                                    this.items.push({
                                        text: obj.name,
                                        value: obj.id
                                    });
                            });
                        })
                        .catch((error) => {

                            console.log(error.response);
                        });
           },
        
   
        
          
   
           getAddress() {
               let id = this.insurerBranch.value;
               axios
                   .get("/getInsurerBranchById/" + id) //with id
                   .then((res) => {
                       res.data.forEach((obj) => {
                           // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                           // this.branch=obj.branch_name;
                           this.billingAddress = obj.address;
                           this.insurerPhone = obj.phone;
                       });
                   })
                   .catch((error) => {
                       this.billingAddress == "";
                       console.log(error.response);
                   });
           },
   
          
           getCompany() {
               axios.get("/getCompany").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.companies.push({
                           text: obj.company_name,
                           value: obj.company_id,
                           prefix: obj.company_prefix,
                       });
                       this.company = {
                           text: this.usercompanyname,
                           value: this.usercompany,
                           prefix: this.usercompanyprefix,
                       };
                   });
               });
           },
           getRegion() {
               axios.get("/getRegion").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.regions.push({
                           text: obj.city_name,
                           value: obj.reg_id,
                           prefix: obj.reg_prefix,
                       });
                   });
               });
           },
            getBranches($id) {
               this.branches = [];
            //    this.insurerBranch = "";/
            //    this.billingAddress = "";
               this.block = false;
               let id = this.insurer.value;
               axios
                   .get("/getInsurerBranch/" + id) //with id
                   .then((res) => {
                       res.data.forEach((obj) => {
                           let text = "";
                           let value = "";
                           this.branches.push({
                               text: obj.name,
                               value: obj.id
                           });
                       });
                   })
                   .catch((error) => {
                       console.log(error.response);
                   });
           },
          
            updateLetterHead(){
            

                const jobData={
                    letter_head:this.isLetterHead==true?1:0
                    
                    };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updateLetterHead/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    // alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
 
            },
            updateStamp(){
            

                const jobData={
                    stamp:this.isStamp==true?1:0
                    
                    };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updateStamp/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    // alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
 
            },
            updateIsImages(){
            

                const jobData={
                    is_images:this.isImages==true?1:0
                    
                    };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updateIsImages/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    // alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
 
            },
            updatePartRates(){
            

                const jobData={
                    part_rates:this.isPartRates==true?1:0
                    
                    };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updatePartRates/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    // alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
 
            },
            updateReportType(){
            

                const jobData={
                    type:this.reportType.text
                    
                    };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updateReportType/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    // alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
 
            },
            updateBill(){
                const jobData={
                    service_charges:this.serviceCharges,
                    travelling:this.travelCharges,
                    snap_charges:this.snapCharges,
                    extra_visit:this.extraVisitCharges,
                    re_inspection_charges:this.reInspectionCharges,
                    job_id:this.jobid,
                    is_sales_tax:this.isSalesTax,
                    tax_rate:this.saleRate,
                    type:this.type.text,
                    region:this.region.value,
                    insurer:this.insurer.value,
                    insurer_branch:this.insurerBranch.value,
                    insurer_prefix:this.insurer.prefix,
                    // company:this.company.value,
                };

                const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
                axios.post('/api/updatePrismBill/'+this.id,jobData,{
                    headers:headers
                }).then((res)=>{
                    alert('Bill updated Successfully');
                }).catch((error)=>alert(error))
            },
           addBranch() {
               if (this.$v.branchModal.$invalid) {
                   this.$v.branchModal.$touch();
                   var isValid = !this.$v.branchModal.$invalid;
                   this.$emit("on-validate", this.$data, isValid);
                   return isValid;
               } else {
                   const branchData = {
                       branch_bank_id: this.insurer.value,
                       branch_city_id: this.branchCity.value,
                       branch_code: this.branchCode,
                       branch_name: this.branchName,
                       branch_address: this.branchAddress,
                       branch_phone: this.branchPhone
                   };
   
                   axios
                       .post("/addInsurerBranch", branchData)
                       .then((res) => {
                           this.branches = [];
                           this.getBranches();
                           alert("Branch Inserted");
                            this.branchCity = "";
                           this.branchCode = "";
                           this.branchName = "";
                           this.branchAddress = "";
                           this.branchPhone = "";
                           this.$v.branchModal.$reset();
                           $(".bd-example-modal-lg").modal("hide");
                          
                       })
                       .catch((error) => alert(error));
               }
           },
           
          
   
   
       },
       validations: {
           
           company: {
               required,
           },
           region: {
               required,
           },
           insurer: {
               required,
           },
           insurerBranch: {
               required,
           },
           billingAddress: {
               required,
           },
           concOfficer: {
               required,
           },
           insurerDesignation: {
               required,
           },
           insurerPhone: {
               required,
           },
           insurerEmail: {
               required,
               email,
           },
           insurerletterNo: {
               required,
           },
           insurerDate: {
               required,
           },
            branchName: {
               required,
           },
            branchCity: {
               required,
           },
            branchAddress: {
               required,
           },
            branchPhone: {
               required,
           },
            branchCode: {
               required,
           },
            serviceCharges: {
               required,
           },
           recoveryBranch: {
               required,
           },
           branchConduct: {
               required,
           },
            travelCharges: {
               required,
           },
           branchModal: [
               "branchName",
               "branchCity",
               "branchAddress",
               "branchPhone",
               "branchCode",
           ],
            completeValidate: [
               "serviceCharges"
            //    "branchConduct",
            //    "recoveryBranch"
            //    "travelCharges"
           ]
        //    form1: [
        //        "selected",
        //        "company",
        //        "region",
        //        "insurer",
        //        "insurerBranch",
        //        "billingAddress",
        //        "concOfficer",
        //        "insurerDesignation",
        //        "insurerPhone",
        //        "insurerEmail",
        //        "insurerletterNo",
        //        "insurerDate",
        //        "customerName",
        //        "customerPhone",
        //        // 'customerEmail',
        //        "customerDesignation",
        //        "customerRepresent"
   
        //    ],
          
       },
   
   };
</script>





<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
   label {
   font-size: 13px !important;
   }
   .mySelect {
   height: 30px !important;
   font-size: 12px !important;
   }
   input[type="text"],
   input[type="date"],
   input[type="number"] {
   height: 30px !important;
   font-size: 12px !important;
   }
   textarea {
   font-size: 12px !important;
   }
   .text-danger {
   font-size: 12px !important;
   }
   .btn {
   padding: 0.25rem 0.5rem;
   font-size: 0.875rem;
   line-height: 1.5;
   border-radius: 0.2rem;
   }
   .islamic-check {
   padding: 0px 0px 0px 0px !important;
   }
   .branch-btn {
   margin-left: 0px !important;
   }
   .vue-form-wizard {
   width: 65rem;
   }
   .invalid {
   border: #dc3545 0.4px solid;
   background-color: #ffc9aa;
   height: 30px !important;
   font-size: 12px !important;
   }
   .date-invalid {
   border: #dc3545 1px solid;
   background-color: #ffc9aa;
   height: 30px !important;
   font-size: 12px !important;
   }
   .wizard-icon-container {
   background-color: black !important;
   }
   .category {
   display: none;
   }
   .vue-form-wizard .wizard-title {
   display: none;
   }
   .form-group {
   margin-bottom: 0.3rem !important;
   }
   .multiselect {
   padding: 4px 0px 4px 0px;
   }
</style>