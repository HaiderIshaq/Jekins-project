<template>
   <div class="container-fluid">
      <div class="bg-white border-radius-4 box-shadow mb-30" style="padding: 0px 15px 16px 15px">
         <div class="clearfix">
            <div class="row" style="background-color: #275129; padding-bottom: 15px">
               <div class="col-md-10">
                  <h4 class="text-white pt-3">New Prism Surveyors Job : {{lastid}}</h4>
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
            <form action="">
               <div class="row">
                  <div class="col-md-6 col-sm-12" style="border-right: 1px solid #646161">
                    <div id="section1">
                        
                        <!-- <div class="form-group row">
                           <label class="col-md-3" for="company">Company </label>
                           <div class="col-md-8 pl-0 pr-0">
                                 <Select id="company" label="text"
                                 :class="[{ invalid: $v.company.$error }, 'mySelect']" v-model="company"
                                 :options="companies"></Select>
                                <div v-if="$v.company.$error">
                                    <p class="text-danger" v-if="!$v.company.required">
                                        Select some company
                                    </p>
                                </div>
                           </div>
                        </div> -->
                        <div class="form-group row ">
                           <label class="col-md-3">Region: </label>
                           <div class="col-md-8 pl-0 pr-0">
                              <Select  label="text" :class="[{'invalid':$v.region.$error},'mySelect']" v-model="region"  :options="regions" ></Select>
                              <div v-if="$v.region.$error" >
                                 <p class="text-danger" v-if="!$v.region.required">Select your region</p>
                              </div>
                           </div>
                        </div>
                     
                    </div>
                    <div id="section2">
                        <fieldset id="section1">
                            <h5>Ordering Insurer's Details</h5>
                            <br />
                            <div class="form-group row">
                              <label class="col-md-3 col-form-label">Insurer: </label>
                              <div class="col-md-9" style="padding-left: 0px">
                                 <Select label="text" @input="getBranches()" :class="[
                                    { 'date-invalid': $v.insurer.$error },
                                    'mySelect',
                                    ]" :options="insurers" v-model="insurer"></Select>
                                 <div v-if="$v.insurer.$error">
                                    <p class="text-danger" v-if="!$v.insurer.required">
                                       Please select some insurer
                                    </p>
                                 </div>

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
                                { 'date-invalid': $v.insurerBranch.$error },
                                'mySelect',
                                ]" :disabled="!insurer" :options="branches"></Select>
                                <!--  -->
                                <div v-if="$v.insurerBranch.$error">
                                    <p class="text-danger" v-if="!$v.insurerBranch.required">
                                    Please select some branch
                                    </p>
                                </div>
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
                            <div class="form-group row">
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
                            </div>
                            <hr style="background-color: black" />
                        </fieldset>
            
                    </div>
                </div>
            <!-- new form -->
            <div class="col-md-6 col-sm-12" style="padding: 0px 30px 0px 30px">
                <div class="form-group row">
                           <label class="col-md-3" for="company">Branch Conducting Survey: </label>
                           <div class="col-md-8 pl-0 pr-0">
                              <Select id="company" label="text"
                                 :class="[ 'mySelect']" v-model="branchConduct"
                                 :options="regions"></Select>
                              <!-- <div v-if="$v.company.$error">
                                 <p class="text-danger" v-if="!$v.company.required">
                                    Select some company
                                 </p>
                              </div> -->
                           </div>
                        </div>
                        <div class="form-group row ">
                           <label class="col-md-3">Recovery Branch: </label>
                           <div class="col-md-8 pl-0 pr-0">
                              <Select  label="text" :class="['mySelect']" v-model="recoveryBranch"  :options="regions" ></Select>
                            
                           </div>
                        </div>
                <h5>Job Details</h5>
                <br/>
            <div class="form-group row">
                <label class="col-md-3" for="company">Survey Type: </label>
                <div class="col-md-8 pl-0 pr-0">
                    <Select id="task" label="text"
                    :class="['mySelect']" @input="getModes()" v-model="type" :options="types"></Select>
                    <!-- <div v-if="$v.company.$error">
                        <p class="text-danger" v-if="!$v.company.required">
                        Select some company
                        </p>
                    </div> -->
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
                    <input type="text" name="" class="form-control form-control-sm" v-model="otherItem"  v-show="item.text=='Others' || item.text=='Other' "  id="">
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
            <div class="col-md-9" style="padding-left:0px">
            <textarea class="form-control " v-model="surveyAddress" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
            </div>
            </div>
            <fieldset v-if="type.text=='Pre-Insurance'">
                    
                <div class="form-group row">
                <label class="col-md-3 col-form-label">NIC of Insured: </label>
                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                <input type="text" v-model="nicOfInsured" class="form-control form-control-sm">
                </div>
                </div>
            
                <div class="form-group row">
                <label class="col-md-3 col-form-label">NTN of Insured: </label>
                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                <input type="text" v-model="ntnOfInsured" class="form-control form-control-sm">
                </div>
                </div>
            
                <div class="form-group row">
                <label class="col-md-3 col-form-label">Contact Person: </label>
                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                <input type="text" v-model="contactPerson" class="form-control form-control-sm">
                </div>
                </div>
            
                <div class="form-group row">
                <label class="col-md-3 col-form-label">Service: </label>
                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                <input type="text" v-model="surveyService" class="form-control form-control-sm">
                </div>
                </div>

            </fieldset>
            <fieldset v-else>
                <div class="form-group row">
                <label class="col-md-3 col-form-label">Policy No.: </label>
                <div class="col-md-9" style="padding-left:0px">
                <textarea class="form-control " v-model="SurveyPolicyNo" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                </div>
                </div>


                <div class="form-group row">
                <label class="col-md-3 col-form-label">Endrs. No.: </label>
                <div class="col-md-9" style="padding-left:0px">
                <textarea class="form-control " v-model="SurveyEndrNo" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                </div>
                </div>


        
                <div class="form-group row">

                <label class="col-md-3 col-form-label">Validity From: </label>
                <div class="col-md-4" style="padding-left:0px">
                <input type="date" v-model="validityFrom" class="form-control ">
                </div>

                <label class="col-md-1 col-form-label">To: </label>
                <div class="col-md-4" style="padding-left:0px">
                <input type="date" v-model="validityTo" class="form-control ">
                </div>

                </div>


                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Loss No.: </label>
                    <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="lossNo" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="form-group row">
                <label class="col-md-3 col-form-label">Loss Due To: </label>
                <div class="col-md-9" style="padding-left:0px">
                <textarea class="form-control " v-model="lossNoDueTo" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
                </div>
                </div>

                <div class="form-group row">
                <label class="col-md-3 col-form-label">Workshop: </label>
                <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                <input type="text" v-model="WorkshopNo" class="form-control form-control-sm">
                </div>
                </div>
            </fieldset>
            <br>

            <fieldset v-if="type.text=='Partial Loss'">
                <h5>Vehicle Details</h5>

                <div class="form-group row pt-3">
                    <label class="col-md-3 col-form-label">Reg. No: </label>
                    <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="regNo" class="form-control form-control-sm">
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
                <div class="form-group row pb-3">
                    <label class="col-md-3 col-form-label">Engine Capacity: </label>
                    <div class="col-md-8 pl-0 pr-0" style="padding-left:0px">
                        <input type="text" v-model="engineCapacity" class="form-control form-control-sm">
                    </div>
                </div>
            </fieldset>

            <h5>Charges Details</h5>
                <br/>

                
            <div class="form-group row">

            <label class="col-md-3 col-form-label">Services Charges: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text"  v-model="serviceCharges" :class="[{'date-invalid':$v.serviceCharges.$error},'form-control']">
            <div v-if="$v.serviceCharges.$error">
                            <p class="text-danger" v-if="!$v.serviceCharges.required">
                            Required
                            </p>
                            </div>
            </div>

            <div class="col-md-2" style="padding-left:0px">
            <input name="tax" id="tax" type="checkbox" v-model="isSalesTax"> <label for="tax" class="col-form-label">S/Tax?: </label>
            </div>
           
            <label class="col-md-2 col-form-label">Snaps: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text" v-model="snapCharges" class="form-control ">

            </div>
            </div>

            <div class="form-group row">

            <label class="col-md-3 col-form-label">Re-Inspection: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text" v-model="reInspection" class="form-control ">

            </div>

            <label class="col-md-3 col-form-label">Extra Visit: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text" v-model="extraVisit" class="form-control ">
            </div>

            
           
            </div>


            <div class="form-group row">

            <label class="col-md-3 col-form-label">Travelling: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text" v-model="travelCharges" class="form-control ">

            </div>

            <label class="col-md-3 col-form-label">O/S Certificate: </label>
            <div class="col-md-2" style="padding-left:0px">
            <input type="text" v-model="osCerificates" class="form-control ">
            </div>           
            </div>

            <div class="form-group row">
            <label class="col-md-3 col-form-label">T/Details: </label>
            <div class="col-md-9" style="padding-left:0px">
            <textarea class="form-control " v-model="tsDetails" col="1" row="1" name="" id="" style="height: 100px;"></textarea>
            </div>
            </div>


            <div class="form-group row" style="padding-right:30px" >
            <div class="col-md-12" >
            <a href="#"><input type="button"  class="btn btn-primary" style="float:right;margin:10px" value="Cancel"></a>
            <input type="button"  v-if="!saveButton" style="float:right;margin:10px" @click="onComplete()"  class="btn btn-primary" value="Save">
            </div>
            </div>
            </div>
            </div>
            </form>
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
   import vSelect from "vue-select";
   import vMultiselect from "vue-multiselect";
   import "vue-select/dist/vue-select.css";
   import Autocomplete from "@trevoreyre/autocomplete-vue";
   import "@trevoreyre/autocomplete-vue/dist/style.css";
   export default {
       props: {
           usercompany: String,
           usertoken: String,
           usercompanyname: String,
           usercompanyprefix: String,
       },
       components: {
           Select: vSelect,
           MultiSelect: vMultiselect,
           Autocomplete,
       },
       data() {
           return {
          
               insurer: "",
               selectedBranch: "",
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
               lastid: "",
               companies: [],
               insurers: [],
               regions: [],
               branches: [],
               cities: [],
               branchCity: "",
               branchName: "",
               branchCode: "",
               branchAddress: "",
               branchPhone: "",
               edd: new Date(),
               types: [],
               type: '',
                items: [],
               item: '',
               isSalesTax: false,
               isSalesTax: "",
               saleReg: "",
               serviceCharges: 0,
               saveButton: false,
               travelCharges: 0,
               modes: [],
               mode: "",
               recoveryBranch:"",
               branchConduct:"",
               otherItem:"",
               otherMode:"",
               trackingId:"",
               nameOfInsured:"",
               surveyAddress:"",
               nicOfInsured:"",
               ntnOfInsured:"",
               contactPerson:"",
               surveyService:"",
               validityFrom:"",
               validityTo:"",
               lossNo:"",
               regNo:"",
               make:"",
               model:"",
               engineNo:"",
               chassisNo:"",
               engineCapacity:"",
               lossNoDueTo:"",
               WorkshopNo:"",
               snapCharges:0,
               reInspection:0,
               extraVisit:0,
               osCerificates:0,
               tsDetails:"",
               SurveyPolicyNo:"",
               SurveyEndrNo:"",
           };
       },
       mounted() {
           this.getCompany();
           this.getRegion();
           this.getInsurers();
           this.getPrismTypes();
            this.getCity();
     
       },
       methods: {
           onComplete: function() {
   
                     if (this.$v.form1.$invalid) {
                       this.$v.form1.$touch();
                       var isValid = !this.$v.form1.$invalid;
                       this.$emit("on-validate", this.$data, isValid);
                       return isValid;
                   } else {
                    this.postdata();
   
                   }
           },
   
           
   
   
           postdata() {

            // alert(this.usertoken);
               this.saveButton = true;
   
               // var month = this.edd.getMonth() + 1;
               // var eddate =
               //     this.edd.getFullYear() + "-" + month + "-" + this.edd.getDate();
               //   var string=this.$refs.ibrCompany.value;
               //  var cmpname=string.replace(/[{()}^0-9-]/g, "");
   
               const jobData = {
                   job_by: this.company.value,
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
                   name_of_insured: this.nameOfInsured,
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
                   workshop: this.WorkshopNo,
                   service_charges: this.serviceCharges,
                   is_sales_tax: this.isSalesTax,
                   snap_charges: this.snapCharges,
                   re_inspection: this.reInspection,
                   extra_visit: this.extraVisit,
                   reg_no: this.regNo,
                   make: this.make,
                   model: this.model,
                   engine_no: this.engineNo,
                   chassis_no: this.chassisNo,
                   engine_capcity: this.engineCapacity,
                   travling_charges: this.travelCharges,
                   os_certificate: this.osCerificates,
                   ts_details: this.tsDetails

                   
               };
               console.log(jobData);
               const headers = {
                   Authorization: "Bearer " + this.usertoken,
                   "Content-Type": "application/json",
               };
   
               axios
                   .post("/api/addPrismJob", jobData, {
                       headers: headers,
                   })
                   .then((res) => {
                    this.saveButton = false;
   
                       alert("Job is successfully created");
                    //    console.log(jobData);
                        // window.location='edit/'+res.data;
                       window.location.href = "/prism";
                    //    return false;
                   })
                   .catch((error) =>{
                    this.saveButton=false;
                    alert(error)
                   });
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
                 this.mode="";
                 this.modes=[];
               let id = this.type.value;
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

                    this.item="";
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
           getBranches($id) {
               this.branches = [];
               this.insurerBranch = "";
               this.billingAddress = "";
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
           serviceCharges: {
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
           branchModal: [
               "branchName",
               "branchCity",
               "branchAddress",
               "branchPhone",
               "branchCode",
           ],
           form1: [

               "region",
               "serviceCharges",
   
           ],
          
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