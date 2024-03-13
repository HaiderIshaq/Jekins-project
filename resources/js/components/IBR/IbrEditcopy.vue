<template>
  <div class="container">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <a href="/home" class="btn btn-primary">Back</a>
          
      <div class="clearfix">
         
        <h4 class="text-blue pt-3">International Business Report</h4>
        <p class="mb-30 font-14">Edit IBR Job : <b>{{jobid}}</b></p>
      </div>
      <div class="wizard-content">

      
                    <form>
                    <div class="form-group row" >
                        <label class="col-md-3" for="company">Company </label>

                        <div class="col-md-8">
                            <Select id="company"  label="text" :class="{'invalid':$v.company.$error}" v-model="company" :options="companies" ></Select>
                             <div v-if="$v.company.$error" >
                                <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Region: </label>
                        <div class="col-md-8">
                            <Select  label="text" :class="{'invalid':$v.region.$error}" v-model="region"  :options="regions" ></Select>
                            <div v-if="$v.region.$error" >
                                <p class="text-danger" v-if="!$v.region.required">Select your region</p>
                            </div>
                        </div>
                      
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Operational Branch: </label>
                        <div class="col-md-8">
                            <Select  label="text" :class="{'invalid':$v.branch.$error}"  v-model="branch" :options="regionsop" ></Select>
                            <div v-if="$v.branch.$error" >
                                <p class="text-danger" v-if="!$v.branch.required">Select your branch</p>
                            </div>
                          
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-3 ">Expiry: </label>
                        <div class="col-md-8">
                                <input class="form-control form-control-sm" :class="{'date-invalid':$v.date.$error}" v-model="date" placeholder="Select Date" name="txtDate" type="date"   >
                            <div v-if="$v.date.$error">
                            <p class="text-danger" v-if="!$v.date.required">Enter expiry date</p>
                            
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">

                        <label class="col-md-3 form-label">Type: </label>

                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mb-5">
                                    <input type="radio" v-model.trim="selected" id="customRadio1" name="type" value="Bank" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Bank</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control  custom-radio mb-5">
                                    <input type="radio" style="background-color:red !important" v-model.trim="selected" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                    <label class="custom-control-label"  for="customRadio2">Customer</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mb-5">
                                    <input type="radio" v-model.trim="selected" id="customRadio3" name="type" value="Vendors" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Vendor</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div v-if="$v.selected.$error">
                                    <p class=" text-danger" v-if="!$v.selected.required">Please Select this Option</p>
                                </div>
                        </div>

                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3 col-form-label">Completed: </label>
                        <div class="form-check col-md-2" style="margin-top:10px;padding-left: 2.25rem;">
                            <input type="checkbox"  class="form-check-input " style="margin-top:8px;" name="type" value="Yes">
                            <label for="" class="form-check-label input-sm"  value="Bank">Completed?</label>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 ">Delivered On: </label>
                        <div class="col-md-8">
                                <input class="form-control form-control-sm" :class="{'date-invalid':$v.date.$error}" placeholder="Select Date" name="txtDate" type="date"   >
                            <div v-if="$v.date.$error">
                            <p class="text-danger" v-if="!$v.date.required">Enter expiry date</p>
                            
                            </div>
                        </div>
                    </div>

                     <div class="form-group row ">
                        <label class="col-md-3 col-form-label">Delayed by Customer? </label>
                        <div class="form-check col-md-3" style="margin-top:10px;padding-left: 2.25rem;">
                            <input type="checkbox"  class="form-check-input " style="margin-top:8px;" name="type" value="Yes">
                            <label for="" class="form-check-label input-sm"  value="Bank">Delayed by Customer?</label>
                        </div>
                    </div>
           
                    <fieldset id="section3"  v-show="selected == 'Vendors'">
                                <h5>Vendor's Details</h5>
                                <br>
                                <div class="form-group row" >
                                    <label for="" class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-8 pl-0 pr-0">
                                    <Select  label="text"  v-model="vendor" :class="{'date-invalid':$v.vendor.$error}" @change="getVendorAddress()" :options="vendors" ></Select>
                                        <div v-if="$v.vendor.$error">
                                            <p class=" text-danger" v-if="!$v.vendor.required">Please Select some vendor</p>
                                        </div>  
                                    </div>
                                     <!-- <div class="col-md-1 pr-0">
                                    <input type="button" value="Add" class="btn btn-primary"  data-toggle="modal" data-target="#vendorModal" style="margin-left:10px">
                                    </div> -->
                            
                                </div>

                                <!-- <div class="modal fade bd-example-modal-2" id="vendorModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add new Vendor</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form enctype="multipart/form-data" >  
                                                
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                                        <input type="text" v-model="customerName" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    <div class="col-md-12 pl-0 pr-0">
                                                            <label for="recipient-name" class="col-form-label">Address:</label>
                                                        <input v-model="customerAddress" class="form-control">  
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                                            <input type="email" v-model="customerEmail" class="form-control">
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Phone:</label>
                                                            <input type="number" v-model="customerPhone" class="form-control">
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-12">
                                                    <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Fax:</label>
                                                            <input type="text" v-model="customerFax" class="form-control">
                                                        </div> 
                                                    </div>
                                                </div>
                                                
                                                
                                                

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" @click="addVendor()" class="btn btn-primary">Add Vendor</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Billing Address</label>
                                    <div class="col-md-8 pl-0 pr-0" >
                                    <textarea v-model="vendorAddress"  cols="30" rows="2" class="form-control form-control-sm" :class="{'date-invalid':$v.vendorAddress.$error}" ></textarea>
                                        <div v-if="$v.vendorAddress.$error">
                                            <p class=" text-danger" v-if="!$v.vendorAddress.required">Please input vendor billing address</p>
                                        </div> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Representative: </label>
                                    <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control  form-control-sm" v-model="vendorRepresent"  :class="{'date-invalid':$v.vendorRepresent.$error}"  type="text">
                                        <div v-if="$v.vendorRepresent.$error">
                                            <p class=" text-danger" v-if="!$v.vendorRepresent.required">Please input vendor representative</p>
                                        </div> 
                                    </div>  
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Designation/Dept: </label>
                                    <div class="col-md-8 pl-0 pr-0" >
                                        <input class="form-control  form-control-sm" v-model="vendorDesignation" :class="{'date-invalid':$v.vendorDesignation.$error}"  type="text">
                                            <div v-if="$v.vendorDesignation.$error">
                                            <p class=" text-danger" v-if="!$v.vendorDesignation.required">Please input vendor representative</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Phone: </label>
                                    <div class="col-md-8 pl-0 pr-0">
                                        <input type="number" class="form-control  form-control-sm" v-model="vendorPhone" :class="{'date-invalid':$v.vendorPhone.$error}"  >
                                        <div v-if="$v.vendorPhone.$error">
                                            <p class=" text-danger" v-if="!$v.vendorPhone.required">Please input vendor phone-number</p>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Fax: </label>
                                    <div class="col-md-8 pl-0 pr-0"  >
                                        <input  class="form-control  form-control-sm "  v-model="vendorFax"  type="text">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 col-form-label">Email: </label>
                                    <div class="col-md-8 pl-0 pr-0">
                                        <input type="email" class="form-control  form-control-sm" v-model="vendorEmail" :class="{'date-invalid':$v.vendorEmail.$error}" >
                                        <div v-if="$v.vendorEmail.$error">
                                            <p class=" text-danger" v-if="!$v.vendorEmail.required">Please input vendor email address</p>
                                            <p class="text-danger" v-if="!$v.vendorEmail.email">Please fill out valid email</p>     
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-label">Letter No: </label>
                                    <div class="col-md-4 pl-0" >
                                        <input type="text" class="form-control form-control-sm" :class="{'date-invalid':$v.vendorLetter.$error}" v-model="vendorLetter">
                                        <div v-if="$v.vendorLetter.$error">
                                            <p class=" text-danger" v-if="!$v.vendorLetter.required">Please input vendor letter</p>
                                        </div>
                                    </div>

                                    <label class="col-md-1 form-label">Expiry: </label>
                                    <div class="col-md-3" >
                                        <input class="form-control form-control-sm" v-model="vendorExpiry" :class="{'date-invalid':$v.vendorExpiry.$error}"  style="margin-left: 18px;min-width: 169px;" name="txtDate1" type="date">
                                        <div v-if="$v.vendorExpiry.$error" style="margin-left:20px">
                                            <p class=" text-danger" v-if="!$v.vendorExpiry.required">Please fill out the date</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                    </fieldset>
                    <fieldset id="section1" v-show="selected == 'Bank'">

                        <h5 style="padding-bottom:10px">Ordering Bank's Details</h5>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Bank: </label>
                            <div class="col-md-4" style="padding-left:0px">
                                <Select  label="text" @input="getBranches()"  :class="{'date-invalid':$v.selectedBank.$error}" :options="banks"  v-model="selectedBank"></Select>
                                <div v-if="$v.selectedBank.$error" >
                                    <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                                </div>
                            </div>
                            <div class=" col-md-2 " >
                                <div class="form-check mt-2 ml-4">
                                    <input type="checkbox" class="form-check-input" @change="getBanksByIslam()" v-model="btype" >
                                    <label for="form-check-label"> Islamic</label>
                                </div>
                            </div>
                            
                            <div class="col-md-1 pr-0">
                            <input type="button" value="Add" class="btn btn-primary"  data-toggle="modal" data-target="#bankModal" style="margin-left:10px">
                            </div>
                        </div>
                             <div class="modal fade bd-example-modal-2" id="bankModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add new Bank</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form enctype="multipart/form-data" >  
                                                
                                                <div class="form-group row">
                                                    <div class="col-md-12">
                                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                                        <input type="text" v-model="bankName1" :class="{'date-invalid':$v.bankName1.$error}" class="form-control">
                                                        <div v-if="$v.bankName1.$error" >
                                                            <p class="text-danger" v-if="!$v.bankName1.required">Please input bank name</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <div class="col-md-12">
                                                        <label for="message-text" class="col-form-label">Type:</label>
                                                        <!-- <input type="text" v-model="bankCode1" :class="{'date-invalid':$v.bankCode1.$error}" class="form-control"> -->
                                                       <Select :options="types" v-model="bankType"  :class="{'date-invalid':$v.bankType.$error}" label="text"></Select>
                                                    <div v-if="$v.bankType.$error" >
                                                            <p class="text-danger" v-if="!$v.bankType.required">Please select bank type</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                     <div class="col-md-12">
                                                        <label for="message-text" class="col-form-label">Code:</label>
                                                        <input type="text" v-model="bankCode1" :class="{'date-invalid':$v.bankCode1.$error}" class="form-control">
                                                        <div v-if="$v.bankCode1.$error" >
                                                            <p class="text-danger" v-if="!$v.bankCode1.required">Please input bank code</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="col-form-label">Bank Ibr Rate:</label>
                                                            <input type="number" v-model="bankIbr" :class="{'date-invalid':$v.bankIbr.$error}" class="form-control">
                                                            <div v-if="$v.bankIbr.$error" >
                                                            <p class="text-danger" v-if="!$v.bankIbr.required">Please input bank IBR rate</p>
                                                        </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                                

                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" @click="addBank()" class="btn btn-primary">Add Bank</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Branch: </label>

                            <!-- <div class="col-md-1" style="padding-left:0px">
                               <input type="number" v-model="selectedBranch" id="branchId" :disabled="!selectedBank"  @input="getBranchById()"  class="form-control ">
                            </div> -->

                            <div class="col-md-6 pl-0">
                            <Select  label="text" v-model="bankBranch" :class="{'date-invalid':$v.bankBranch.$error}" @input="getAddress()" :disabled="!selectedBank" :options="branches" ></Select>
                             
                                <div v-if="$v.bankBranch.$error" >
                                <p class="text-danger" v-if="!$v.bankBranch.required">Please select some branch</p>
                            </div>
                            </div>
                            <div class="col-md-3">
                            <input type="button" value="Add" class="btn btn-primary  " :disabled="!selectedBank" data-toggle="modal" data-target="#brModal" style="margin-left:10px">
                            </div>

                            <div class="modal fade bd-example-modal-lg" tabindex="-1"  id="brModal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add new Branch</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Bank:</label>
                                            <Select :options="banks" v-model="branchBank" :class="{'date-invalid':$v.branchBank.$error}" label="text"></Select>
                                            <div v-if="$v.branchBank.$error" >
                                                <p class="text-danger" v-if="!$v.branchBank.required">Please select some bank</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name"  class="col-form-label">Branch Name:</label>
                                            <input type="text" v-model="branchName" class="form-control" :class="{'date-invalid':$v.branchName.$error}">
                                            <div v-if="$v.branchName.$error" >
                                                <p class="text-danger" v-if="!$v.branchName.required">Please input branch Name</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">City:</label>
                                            <Select v-model="branchCity" label="text" :options="cities" :class="{'date-invalid':$v.branchCity.$error}"></Select>
                                             <div v-if="$v.branchCity.$error" >
                                                <p class="text-danger" v-if="!$v.branchCity.required">Please select branch city</p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Address:</label>
                                            <input type="text" v-model="branchAddress" class="form-control" :class="{'date-invalid':$v.branchAddress.$error}">
                                            <div v-if="$v.branchAddress.$error" >
                                                <p class="text-danger" v-if="!$v.branchAddress.required">Please select branch city</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="recipient-name"  class="col-form-label">Landline:</label>
                                                    <input type="number" v-model="branchPhone" class="form-control" :class="{'date-invalid':$v.branchPhone.$error}">
                                                    <div v-if="$v.branchPhone.$error" >
                                                        <p class="text-danger" v-if="!$v.branchPhone.required">Please input branch land-line</p>
                                                    </div>
                                                </div> 
                                            </div>
                                     
                                     <div class="row">
                                            <div class="col-md-4">
                                            
                                            </div>
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Fax:</label>
                                                    <input type="text" v-model="branchFax" class="form-control" :class="{'date-invalid':$v.branchFax.$error}">
                                                <div v-if="$v.branchFax.$error" >
                                                        <p class="text-danger" v-if="!$v.branchFax.required">Please input branch fax-number</p>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-4">
                                            <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Code:</label>
                                                    <input type="text" v-model="branchCode" class="form-control" :class="{'date-invalid':$v.branchCode.$error}">
                                                <div v-if="$v.branchCode.$error" >
                                                        <p class="text-danger" v-if="!$v.branchCode.required">Please input branch code of bank</p>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" @click="addBranch()" class="btn btn-primary">Add Branch</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Billing Address</label>
                        <div class="col-md-8 pl-0 pr-0">
                                <textarea type="text" name="" v-model="billingAddress" :class="{'date-invalid':$v.billingAddress.$error}"  cols="30" rows="2" class=" form-control form-control-sm" style="height:60px"></textarea>
                        <div v-if="$v.billingAddress.$error" >
                                <p class="text-danger" v-if="!$v.billingAddress.required">Please fill out billing address</p>
                            </div>
                        </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Representative: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input  class="form-control  form-control-sm" v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                <div v-if="$v.bankRepresentative.$error" >
                                    <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                </div>
                            </div>
                            
                            
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Designation/Dept: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <input class="form-control  form-control-sm" v-model="bankDesignation" :class="{'date-invalid':$v.bankDesignation.$error}"  type="text">
                                <div v-if="$v.bankDesignation.$error" >
                                    <p class="text-danger" v-if="!$v.bankDesignation.required">Please fill out designation and department</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Phone: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <input type="number" v-model="bankPhone" :class="{'date-invalid':$v.bankPhone.$error}" class="form-control form-control-sm" >
                                <div v-if="$v.bankPhone.$error" >
                                    <p class="text-danger" v-if="!$v.bankPhone.required">Please fill out phone number</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Fax: </label>
                            <input  class="form-control  form-control-sm col-md-8" v-model="ibrBranchFax" type="text">
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input type="email" v-model="bankEmail" class="form-control  form-control-sm"  :class="{'date-invalid':$v.bankEmail.$error}">
                                <div v-if="$v.bankEmail.$error" >
                                    <p class="text-danger" v-if="!$v.bankEmail.required">Please fill out email address</p>
                                    <p class="text-danger" v-if="!$v.bankEmail.email">Please fill out valid email</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-3">
                                <label class="form-label">Letter No: </label>
                            </div>
                            <div class="col-md-4 pl-0" >
                            <input type="text" v-model="bankletterNo" class="form-control form-control-sm"  :class="{'date-invalid':$v.bankletterNo.$error}">
                                <div v-if="$v.bankletterNo.$error" >
                                    <p class="text-danger" v-if="!$v.bankletterNo.required">Please fill out this field</p>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label mt-2">Date: </label>
                            </div>
                            <div class="col-md-3 pl-0 pr-0">
                                <input class="form-control  form-control-sm" v-model="bankDate" :class="{'date-invalid':$v.bankDate.$error}" style="margin-left: 18px;min-width: 169px;" name="txtDate2" type="date">
                                <div v-if="$v.bankDate.$error" >
                                    <p class="text-danger" style="margin-left:20px" v-if="!$v.bankDate.required">Please specify the date</p>
                                </div>
                            </div>
                        </div>

                        <hr>
                    </fieldset>
                    <fieldset id="section2"  v-show="selected == 'Customers' || 'Vendors' || 'Bank'">
                        <h5>Customer's Details</h5>
                        <br>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-6 pl-0">
                            <Select :options="customers" :class="{'date-invalid':$v.customerName.$error}" v-model="customerName" label="text" ></Select>
                            <div v-if="$v.customerName.$error" >
                                    <p class="text-danger" v-if="!$v.customerName.required">Please select Customer</p>
                            </div>
                                </div>
                                <div class="col-md-2">
                                   <button class="btn btn-primary  " data-toggle="modal" data-target="#customerModal" style="margin-left:10px">Add</button>
                                </div>
                        </div>
                        <div class="modal fade bd-example-modal-2" tabindex="-1" role="dialog" id="customerModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add new Customers</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form enctype="multipart/form-data" >  
                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">Name:</label>
                                                <input type="text" v-model="customerName1" :class="{'date-invalid':$v.customerName1.$error}" class="form-control">
                                                   <div v-if="$v.customerName1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerName1.required">Please input customer name</p>
                                                    </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="message-text" class="col-form-label">Code:</label>
                                                <input type="text" v-model="customerCode1" :class="{'date-invalid':$v.customerCode1.$error}" class="form-control">
                                                <div v-if="$v.customerCode1.$error" >
                                                    <p class="text-danger" v-if="!$v.customerCode1.required">Please input customer code</p>
                                                </div>
                                            </div> 
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="recipient-name"  class="col-form-label">City:</label>
                                            <Select :options="cities" label="text" v-model="customerCity" :class="{'date-invalid':$v.customerCity.$error}"></Select>
                                            <div v-if="$v.customerCity.$error" >
                                                    <p class="text-danger" v-if="!$v.customerCity.required">Please input customer city</p>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Address:</label>
                                            <input v-model="customerAddress1" class="form-control" :class="{'date-invalid':$v.customerAddress1.$error}">
                                            <div v-if="$v.customerAddress1.$error" >
                                                    <p class="text-danger" v-if="!$v.customerAddress1.required">Please input customer address</p>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Phone:</label>
                                                    <input type="number" v-model="customerPhone1" class="form-control" :class="{'date-invalid':$v.customerPhone1.$error}">
                                                     <div v-if="$v.customerPhone1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerPhone1.required">Please input customer phone number</p>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="col-md-6">
                                            <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Fax:</label>
                                                    <input type="text" v-model="customerFax1" :class="{'date-invalid':$v.customerFax1.$error}" class="form-control">
                                                    <div v-if="$v.customerFax1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerFax1.required">Please input customer fax number</p>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">N.T.N / CNIC:</label>
                                                <input type="text" v-model="customerCNIC" class="form-control" :class="{'date-invalid':$v.customerCNIC.$error}">
                                                <div v-if="$v.customerCNIC.$error" >
                                                    <p class="text-danger" v-if="!$v.customerCNIC.required">Please input customer N.T.N or CNIC</p>
                                                </div>
                                                 </div>
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">Sales Tax No:</label>
                                                <input type="text" v-model="customerGst" :class="{'date-invalid':$v.customerGst.$error}" class="form-control">
                                                <div v-if="$v.customerGst.$error" >
                                                    <p class="text-danger" v-if="!$v.customerGst.required">Please input tax no</p>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">Contact Person:</label>
                                                <input type="text" v-model="customerPerson" :class="{'date-invalid':$v.customerPerson.$error}" class="form-control">
                                            <div v-if="$v.customerPerson.$error" >
                                                    <p class="text-danger" v-if="!$v.customerPerson.required">Please input contact person</p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">Designation:</label>
                                                <input type="text" v-model="customerDesignation1" :class="{'date-invalid':$v.customerDesignation1.$error}" class="form-control">
                                            <div v-if="$v.customerDesignation1.$error" >
                                                    <p class="text-danger" v-if="!$v.customerDesignation1.required">Please input contact person designation</p>
                                                </div>
                                            </div>
                                        </div>
                                        

                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" @click="addCustomer()" class="btn btn-primary">Add Customers</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Representative</label>
                            <div class="col-md-8 pl-0 pr-0">
                                <input class="form-control form-control-sm" :class="{'date-invalid':$v.customerRepresent.$error}" type="text" v-model="customerRepresent">
                                <div v-if="$v.customerRepresent.$error" >
                                    <p class="text-danger" v-if="!$v.customerRepresent.required">Please input customer representative</p>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Designation/Dept</label>
                            <div class="col-md-8 pl-0 pr-0">
                            <input class="form-control form-control-sm"  :class="{'date-invalid':$v.customerDesignation.$error}"  v-model="customerDesignation" type="text">
                            <div v-if="$v.customerDesignation.$error" >
                                <p class="text-danger" v-if="!$v.customerDesignation.required">Please input customer designation</p>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Phone</label>
                            <div class="col-md-8 pl-0 pr-0" >
                            <input class="form-control form-control-sm" type="number" :class="{'date-invalid':$v.customerPhone.$error}" v-model="customerPhone">
                            <div v-if="$v.customerPhone.$error" >
                                <p class="text-danger" v-if="!$v.customerPhone.required">Please input customer phone-number</p>
                            </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Fax</label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="ibrCustomerFax" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Email</label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" type="email" :class="{'date-invalid':$v.customerEmail.$error}"  v-model="customerEmail">
                                <div v-if="$v.customerEmail.$error" >
                                    <p class="text-danger" v-if="!$v.customerEmail.required">Please input customer email address</p>
                                        <p class="text-danger" v-if="!$v.customerEmail.email">Please input valid email address</p>

                                </div>
                            </div>
                        </div>
                    </fieldset>
         
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Select Country: </label>
                    <div class="col-md-8 pl-0 pr-0">
                        <Select v-model="ibrCountry" :options="countries" :class="{'date-invalid':$v.ibrCountry.$error}" label="text" @input="getCompanies()"></Select>
                    <div v-if="$v.ibrCountry.$error" >
                                <p class="text-danger" v-if="!$v.ibrCountry.required">Please select some country</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">City: </label>
                    <div class="col-md-8 pl-0 pr-0">
                    <input v-model="city" type="text" :class="{'date-invalid':$v.city.$error}" class="form-control form-control-sm ">   
                        <div v-if="$v.city.$error" >
                                <p class="text-danger" v-if="!$v.city.required">Please select some city</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Select Company: </label>
                    <div class="col-md-7 pl-0 pr-0" >
                        <Select v-model="ibrCompany" :class="{'date-invalid':$v.ibrCompany.$error}" label="text" :options="ibrCompanies"></Select>
                        <div v-if="$v.ibrCompany.$error" >
                                <p class="text-danger" v-if="!$v.ibrCompany.required">Please select some city</p>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#companyModal">Add</button>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-2" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add new Company</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form enctype="multipart/form-data" >  
                                
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <label for="recipient-name" class="col-form-label">Name:</label>
                                        <input type="text" v-model="companyName1" :class="{'date-invalid':$v.companyName1.$error}" class="form-control">
                                        <div v-if="$v.companyName1.$error" >
                                            <p class="text-danger" v-if="!$v.companyName1.required">Please input company name</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 pl-0 pr-0">
                                            <label for="recipient-name" class="col-form-label">Country:</label>
                                        <Select v-model="companyCountry1" :options="countries" :class="{'date-invalid':$v.companyCountry1.$error}" label="text"></Select>
                                        <div v-if="$v.companyCountry1.$error" >
                                            <p class="text-danger" v-if="!$v.companyCountry1.required">Please input company's country</p>
                                        </div>
                                    </div> 
                                </div>  
                                <div class="form-group">
                                    <div class="col-md-12 pl-0 pr-0">
                                            <label for="recipient-name" class="col-form-label">Address:</label>
                                        <textarea name="" id="" v-model="companyAddress1" cols="30" rows="10" :class="{'date-invalid':$v.companyAddress1.$error}" class="form-control"></textarea>
                                        <div v-if="$v.companyAddress1.$error" >
                                            <p class="text-danger" v-if="!$v.companyAddress1.required">Please input company's country</p>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                            <label for="recipient-name" class="col-form-label">Street:</label>
                                            <input type="text" v-model="companyStreet1" :class="{'date-invalid':$v.companyStreet1.$error}" class="form-control">
                                            <div v-if="$v.companyStreet1.$error" >
                                                <p class="text-danger" v-if="!$v.companyStreet1.required">Please input company's street</p>
                                            </div>
                                    </div>
                                    <div class="col-md-6">
                                            <label for="recipient-name" class="col-form-label">P.O.Box:</label>
                                            <input type="text" v-model="companyPobox1" :class="{'date-invalid':$v.companyPobox1.$error}" class="form-control">
                                             <div v-if="$v.companyPobox1.$error" >
                                                <p class="text-danger" v-if="!$v.companyStreet1.required">Please input company's pobox number</p>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Email:</label>
                                            <input type="email" v-model="companyEmail1" :class="{'date-invalid':$v.companyEmail1.$error}" class="form-control">
                                            <div v-if="$v.companyEmail1.$error" >
                                                <p class="text-danger" v-if="!$v.companyEmail1.required">Please input company's email address</p>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Fax:</label>
                                            <input type="text" v-model="companyFax1" :class="{'date-invalid':$v.companyFax1.$error}" class="form-control">
                                            <div v-if="$v.companyFax1.$error" >
                                                <p class="text-danger" v-if="!$v.companyFax1.required">Please input company's fax</p>
                                            </div>
                                            
                                        </div> 
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Registration:</label>
                                            <input type="text" v-model="companyReg1" :class="{'date-invalid':$v.companyReg1.$error}" class="form-control">
                                             <div v-if="$v.companyReg1.$error" >
                                                <p class="text-danger" v-if="!$v.companyReg1.required">Please input company's registration ID</p>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="recipient-name" class="col-form-label">Website:</label>
                                            <input type="text" v-model="companyWebsite1" :class="{'date-invalid':$v.companyWebsite1.$error}" class="form-control">
                                             <div v-if="$v.companyWebsite1.$error" >
                                                <p class="text-danger" v-if="!$v.companyWebsite1.required">Please input company's website</p>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" @click="addCompany()" class="btn btn-primary">Add Comapny</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row ">
                    <div class="col-md-3">
                        <label class=" col-form-label">Duplicate: </label>
                    </div>
                    <div class="form-check col-md-2"  style="margin-top:10px">
                        <input type="checkbox" v-model="duplicate" class="form-check-input " style="margin-top:8px;" name="duplicate" value="Yes">
                        <label for="" class="form-check-label input-sm" value="Bank">Yes?</label>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                        <input type="text" style="margin-top:10px" v-show="duplicate" v-model=" duplicateId" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="" class="col-md-3 col-form-label">Address</label>
                    <div class="col-md-8" style="padding-left:0px;padding-right:0px">
                        <textarea type="text" name="" v-model="companyAddress" :class="{'date-invalid':$v.companyAddress.$error}"  cols="30" rows="2" class=" form-control form-control-sm" style="height:60px"></textarea>
                        <div v-if="$v.companyAddress.$error" >
                        <p class="text-danger" v-if="!$v.companyAddress.required">Please input company address</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Street: </label>
                    <input type="text"  v-model="companyStreet" class="form-control form-control-sm col-md-3">

                    <label class="col-md-2 col-form-label">P.O Box: </label>
                    <input class="form-control  form-control-sm col-md-3 pr-0" v-model="companyPobox"   type="text">
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Phone: </label>
                    <div class="col-md-8" style="padding-left:0px;padding-right:0px">
                        <input type="number" v-model="ibrPhone" class="form-control  form-control-sm" :class="{'date-invalid':$v.ibrPhone.$error}" >
                        <div v-if="$v.ibrPhone.$error" >
                            <p class="text-danger" v-if="!$v.ibrPhone.required">Please input phone number</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Fax: </label>
                    <input  class="form-control  form-control-sm col-md-8" v-model="ibrFax"  type="text">
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Email: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="email" class="form-control  form-control-sm" v-model="ibrEmail" :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Website: </label>
                    <input  class="form-control  form-control-sm col-md-8" v-model="companyUrl" type="text">
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Registration ID: </label>
                    <div class="col-md-8 pl-0 pr-0">
                        <input type="text" v-model="ibrRegistration" class="form-control  form-control-sm" :class="{'date-invalid':$v.ibrRegistration.$error}">
                        <div v-if="$v.ibrRegistration.$error" >
                            <p class="text-danger" v-if="!$v.ibrRegistration.required">Please input registration id</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-md-3 col-form-label">Additional Information</label>
                    <textarea type="text" v-model="ibrAddition" name=""  cols="30" rows="2" class="col-md-8 form-control form-control-sm" style="height:60px"></textarea>
                </div>
                <div class="form-group row">
                <label class="col-md-3 col-form-label">Vendor: </label>
                <div class="col-md-8 pl-0 pr-0" >
                    <Select :options="ibrVendors" label="text" v-model="vendorIbr" :class="{'date-invalid':$v.vendorIbr.$error}"></Select>
                    <div v-if="$v.vendorIbr.$error" >
                            <p class="text-danger" v-if="!$v.vendorIbr.required">Please select some vendors</p>
                    </div>
                    
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Type: </label>
                <div class="col-md-8 pl-0 pr-0" >
                        <Select :options="reportType" :class="{'date-invalid':$v.reportIbr.$error}" v-model="reportIbr"  label="text"></Select>
                        <div v-if="$v.reportIbr.$error" >
                                <p class="text-danger" v-if="!$v.reportIbr.required">Please select some report type</p>
                        </div>

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Delivery Time:</label>
                    <div class="col-md-4 pl-0 pr-0" >
                        <Select :options="deliveryTime" @input="getUrgentRate()" :class="{'date-invalid':$v.delivery.$error}" v-model="delivery" label="text" ></Select>
                        <div v-if="$v.delivery.$error" >
                                <p class="text-danger" v-if="!$v.delivery.required">Please define some time</p>
                        </div>
                    </div>
                    <label class="col-md-1 col-form-label">E.D.D: </label>
                    <div class="col-md-3 pr-0">
                        <input class="form-control form-control-sm" v-model="edd" placeholder="Select Date" :class="{'date-invalid':$v.edd.$error}" name="txtDate3"  type="date">
                        <div v-if="$v.edd.$error" >
                                <p class="text-danger ml-3"  v-if="!$v.edd.required">Please define some time</p>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Service Charges (USD):</label>
                    <div class="col-md-4 pl-0 pr-0">
                        <input type="number" v-model="serviceCharge" class="form-control form-control-sm" :class="{'date-invalid':$v.serviceCharge.$error}" >
                        <div v-if="$v.serviceCharge.$error" >
                                <p class="text-danger" v-if="!$v.serviceCharge.required">Please add service charges</p>
                        </div>
                    </div>
                        <label class="col-md-1 col-form-label">Ex.Rate: </label>
                        <div class="col-md-3 pr-0">
                        <input class="form-control  form-control-sm" v-model="exRates" :class="{'date-invalid':$v.exRates.$error}" type="number">
                            <div v-if="$v.exRates.$error" >
                                    <p class="text-danger" v-if="!$v.exRates.required">Please add exchange rates</p>
                            </div>
                        </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-3 col-form-label ">Sales Tax: </label>
                    <div class="col-md-1 form-check" style="margin-top:6px">
                        <input type="checkbox" v-model="regionSale"  class="form-check-input" style="margin-top:8px" name="sales" value="Yes">
                        <label for="" class="form-check-label input-sm " value="Bank">Yes?</label>
                    </div>

                    <label v-show="regionSale"  class="col-md-1 col-form-label region-label" >Region: </label>
                    <div class="col-md-6 pr-3" v-show="regionSale">
                        <Select :options="salesRegion" label="text" v-model="saleReg" @input="getTaxRate()"></Select>
                       {{saleReg}}
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-md-3 col-form-label">Tentative Report: </label>
                    <div class="form-check col-md-2" style="margin-top:10px">
                        <input type="checkbox" v-model="istentative"  class="form-check-input " style="margin-top:8px;" name="type" value="Yes">
                        <label for="" class="form-check-label input-sm"  value="Bank">Include Risk?</label>
                    </div>
                </div>

                <div class="form-group " v-show="istentative">
                    <div class="form-check col-md-3">
                        <input type="radio" v-model=" tentativeType" class="form-check-input "  value="Low">
                        <label for="" class="form-check-label input-sm" >Low</label>
                    </div>
                    <div class="form-check col-md-3">
                        <input type="radio"  class="form-check-input "  v-model=" tentativeType"  value="Medium">
                        <label for="" class="form-check-label input-sm ">Medium</label>
                    </div>
                    <div class="form-check col-md-3">
                        <input type="radio" class="form-check-input " v-model=" tentativeType"  value="High">
                        <label for="" class="form-check-label input-sm " >High</label>
                    </div>
                </div>

                <hr>
                <h5>Vendor's Details</h5><br>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Order Placed:</label>
                    <div class="col-md-3 pl-0 pr-0" >
                        <input class="form-control form-control-sm" placeholder="Select Date" :class="{'date-invalid':$v.edd.$error}" name="txtDate3"  type="date">
                        <div v-if="$v.edd.$error" >
                                <p class="text-danger ml-3"  v-if="!$v.edd.required">Please define some time</p>
                        </div>
                    </div>
                    <label class="col-md-2 col-form-label">Order Recieved: </label>
                    <div class="col-md-3 pr-0">
                        <input class="form-control form-control-sm"  placeholder="Select Date" :class="{'date-invalid':$v.edd.$error}" name="txtDate3"  type="date">
                        <div v-if="$v.edd.$error" >
                                <p class="text-danger ml-3"  v-if="!$v.edd.required">Please define some time</p>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Credit Rating: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="text" class="form-control form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Credit Limit: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="text" class="form-control  form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Litigation: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="text" class="form-control  form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Original Doc: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="file" class="form-control  form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Attach: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <!-- <input type="file" class="form-control  form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
                        </div> -->
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Client Copy: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="file" class="form-control  form-control-sm"  :class="{'date-invalid':$v.ibrEmail.$error}">
                        <div v-if="$v.ibrEmail.$error" >
                            <p class="text-danger" v-if="!$v.ibrEmail.required">Please input email address</p>
                            <p class="text-danger" v-if="!$v.ibrEmail.email">Please input valid email address</p>
                        
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
  export default {
      props:{
          id:String,
          jobid:String
  },
      components:{
          'Select':vSelect
      },
     data() {
       return {
        title:'',
        subtitle:'',
        name:'',
        btype:false,
        duplicate:'',
        duplicateId:'',
        selected:'',
        selectedBank:'',
        selectedBranch:'',
        branch:'',
        bankBranch:'',
        billingAddress:'',
        bankRepresentative:'',
        bankDesignation:'',
        customerDesignation:'',
        customerRepresent:'',
        bankPhone:'',
        ibrCustomerFax:'',
        bankEmail:'',
        bankType:'',
        bankletterNo:'',
        bankDate:'',
        company:'',
        block:true,
        date:'',
        region:'',
        companies:[],
        banks:[],
        regions:[],
        regionsop:[],
        branches:[],
        cities:[],
        customers:[],
        vendors:[],
        bankName1:'',
        bankCode1:'',
        bankIbr:'',
        branchBank:'',
        branchCity:'',
        branchName:'',
        branchCode:'',
        branchAddress:'',
        branchPhone:'',
        branchFax:'',
        customerName:'',
        customerName1:'',
        customerCode:'',
        customerCode1:'',
        customerAddress:'',
        customerAddress1:'',
        customerPhone:'',
        customerFax:'',
        customerFax1:'',
        customerEmail:'',
        customerCNIC:'',
        customerGst:'',
        customerPhone1:'',
        customerDesignation:'',
        customerDesignation1:'',
        customerPerson:'',
        customerCity:'',
        branchCell:'',
        vendor:'',
        hide:false,
        vendorRepresent:'',
        vendorDesignation:'',
        vendorPhone:'',
        vendorEmail:'',
        vendorFax:'',
        vendorLetter:'',
        vendorExpiry:'',
        vendorAddress:'',
        countries:[],
        ibrCompanies:[],
        ibrCountry:'',
        ibrRegistration:'',
        ibrAddition:'',
        ibrEmail:'',
        ibrFax:'',
        ibrPhone:'',
        city:'',
        ibrCompany:'',
        ibrBranchFax:'',
        companyUrl:'',
        ibrVendors:[],
        reportType:[],
        deliveryTime:[],
        salesRegion:[],
        exRates:100,
        serviceCharge:'',
        regionSale:'',
        delivery:'',
        taxRate:'',
        saleReg:'',
        istentative:'',
        tentativeType:'',
        companyAddress:'',
        companyStreet:'',
        companyPobox:'',
        reportIbr:'',
        vendorIbr:'',
        edd:'',
        types:['Islamic','Conventional'],
        companyName1:'',
        companyCountry1:'',
        companyAddress1:'',
        companyStreet1:'',
        companyPobox1:'',
        companyEmail1:'',
        companyFax1:'',
        companyReg1:'',
        companyWebsite1:''
        
       }
    },
    mounted(){
        this.getCompany();
        this.getRegion();
        this.getBanks(); 
        this.getCustomers();
        this.getCity();
        this.getVendors();
        this.getCountries();
        this.getReports();
        this.getDelivery();
        this.getTaxRegions();
        this.getJob();
       

        
    },
    methods: {
   
    onComplete: function(){

      axios.put('/updateIbr/' + this.id ,{
        job_by:this.company.value,
        regional_id:this.region.value,
        operational_branch:this.branch.value,
        expiry:this.date,
        given_by:this.selected,
        bank_id:this.selectedBank.value,
        branch_id:this.bankBranch.value,
        bank_address:this.billingAddress,
        bank_representative:this.bankRepresentative,
        bank_designation:this.bankDesignation,
        bank_phone:this.bankPhone,
        bank_fax:this.ibrBranchFax,
        bank_email:this.bankEmail,
        bank_letter:this.bankletterNo,
        letter_date:this.bankDate,
        ibr_vendor_id:this.vendor.value,
        ibr_billing_address:this.vendorAddress,
        ibr_vendor_representaive:this.vendorRepresent,
        ibr_vendor_designation:this.vendorDesignation,
        ibr_vendor_phone:this.vendorPhone,
        ibr_vendor_fax:this.vendorFax,
        ibr_vendor_email:this.vendorEmail,
        ibr_vendor_letter:this.vendorLetter,
        ibr_vendor_date:this.vendorExpiry,
        customer_id:this.customerName.value,
        customer_representative:this.customerRepresent,
        customer_designation:this.customerDesignation,
        customer_phone:this.customerPhone,
        customer_fax:this.ibrCustomerFax,
        customer_email:this.customerEmail,
        country_id:this.ibrCountry.value,
        city:this.city,
        company_id:this.ibrCompany.value,
        duplicate:this.duplicate,
        duplicate_id:this.duplicateId,
        company_address:this.companyAddress,
        company_street:this.companyStreet,
        company_pobox:this.companyPobox,
        company_phone:this.ibrPhone,
        company_fax:this.ibrFax,
        company_email:this.ibrEmail,
        company_url:this.companyUrl,
        registration_id:this.ibrRegistration,
        additionals:this.ibrAddition,
        vendor_id:this.vendorIbr.value,
        report_type:this.reportIbr.value,
        delivery_time:this.delivery.value,
        edd:this.edd,
        service_charges:this.serviceCharge,
        ex_rates:this.exRates,
        sales:this.regionSale,
        sales_tax:this.saleReg.value,
        tentative:this.istentative,
        tentativeReport:this.tentativeType
  })
      .then(res=>{  
          alert('Job data updated Successfully');
            window.location.href="/home";
      })
      .catch(error=>{
      });

   },
   getJob(){
        axios.get('/getIbrJob/' + this.id)
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            
                            this.company={text:obj.job_company,value:obj.job_by},
                            this.region={text:obj.region,value:obj.regional_id},
                            this.branch={text:obj.op_branch,value:obj.operational_branch},
                            this.date=obj.expiry,
                            this.selected=obj.given_by,
                            this.selectedBank={text:obj.bank_name,value:obj.bank_id},
                            this.bankBranch={text:obj.branch_name,value:obj.branch_id},
                            this.billingAddress=obj.bank_address,
                            this.bankRepresentative=obj.bank_representative,
                            this.bankDesignation=obj.bank_designation,
                            this.bankPhone=obj.bank_phone,
                            this.ibrBranchFax=obj.bank_fax,
                            this.bankletterNo=obj.bank_letter,
                            this.bankEmail=obj.bank_email,
                            this.bankDate=obj.bank_letter_date,
                            this.customerName={text:obj.cust_name,value:obj.customer_id},
                            this.customerRepresent=obj.customer_representative,
                            this.customerDesignation=obj.customer_designation,
                            this.customerPhone=obj.customer_phone,
                            this.ibrCustomerFax=obj.customer_fax,
                            this.customerEmail=obj.customer_email,
                            this.vendor={text:obj.name,value:obj.byvendor_id},
                            this.vendorRepresent=obj.byvendor_representative,
                            this.vendorDesignation=obj.byvendor_designation,
                            this.vendorPhone=obj.byvendor_phone,
                            this.vendorFax=obj.byvendor_fax,
                            this.vendorEmail=obj.byvendor_email,
                            this.vendorAddress=obj.byvendor_address,
                            this.vendorLetter=obj.byvendor_letter,
                            this.vendorExpiry=obj.vendor_letter_date,
                            this.ibrCountry={text:obj.country_name,value:obj.country_id},
                            this.city=obj.city,
                            this.ibrCompany={text:obj.company_name,value:obj.company_id},
                            this.companyAddress=obj.company_address,
                            this.companyStreet=obj.company_street,
                            this.companyPobox=obj.company_pobox,
                            this.ibrFax=obj.company_fax,
                            this.ibrEmail=obj.company_email,
                            this.ibrPhone=obj.company_phone,
                            this.companyUrl=obj.company_url,
                            this.ibrRegistration=obj.registration_id,
                            this.ibrAddition=obj.additionals,
                            this.duplicate=obj.duplicate ==1 ? true:false,
                            this.duplicateId=obj.duplicate_id,
                            this.vendorIbr={text:obj.vendor_name,value:obj.vendor_id},
                            this.reportIbr={text:obj.description,value:obj.report_type},
                            this.delivery={text:obj.delivery,value:obj.delivery_time},
                            this.edd=obj.EDID,
                            this.serviceCharge=obj.service_charges,
                            this.exRates=obj.exchange_rate,
                            this.regionSale=obj.sales===1 ? true:false,
                            this.saleReg={text:obj.tax_region,value:obj.sale_tax},
                            this.istentative=obj.tentative===1 ? true:false,
                            this.tentativeType=obj.tentativeReport
                         

                     
                            
                            
                           
                        })
                    })
   },
    getBanks(){
        this.banks=[];
                 axios.get('/getBanks')
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            let prefix="";
                            this.banks.push({text:obj.bank_name,value:obj.bank_id,prefix:obj.bank_code})
                        })
                    })
            },
    getCountries(){
        this.countries=[];
                 axios.get('/getCountries')
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            let region='';
                            this.countries.push({text:obj.name,value:obj.id,region:obj.region})
                        })
                    })
            },
   getReports(){
        this.reportType=[];
                 axios.get('/getReportType')
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            this.reportType.push({text:obj.description,value:obj.id})
                        })
                    })
            },
   getDelivery(){
        this.deliveryTime=[];
                axios.get('/getDeliveryType')
                .then(res=>{
                    console.log(res.data);
                    res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.deliveryTime.push({text:obj.description,value:obj.id})
                    })
                })
            },
    getIslamicBanks(){
    this.banks=[];
      this.branches=[];
        this.bankBranch='';
         this.billingAddress='';

            axios.get('/getIslamicBanks')
            .then(res=>{
                console.log(res.data);
                res.data.forEach((obj)=>{
                    let text='';
                    let value='';
                    let prefix="";
                    this.banks.push({text:obj.bank_name,value:obj.bank_id,prefix:obj.bank_code})
                })
            })
        },
    getBranches(id,bid){
        this.branches=[];
        this.bankBranch='';
        this.billingAddress="";
            this.block=false;
            // let id=this.selectedBank.value;
            axios.get("/getBranches/" + id) //with id
                .then(res => {
                console.log(res.data)
                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.branches.push({text:obj.branch_name,value:obj.branch_id})
                        this.bankBranch=this.branches[bid-3]
                        
                    })
                })
                .catch(error => {
                console.log(error.response);
                });

            },
        getBranchById(){
           
           if(this.selectedBranch=="")
           {
                this.bankBranch="";
                this.billingAddress='';
           }

           else{
            //    alert(this.selectedBranch);
            //    this.bankBranch=this.branches[this.selectedBranch];


                  let id=this.selectedBranch;
            
            axios.get("/getBranchById/" + id) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        this.bankBranch=obj.branch_name;
                        this.billingAddress=obj.branch_address;
                        
                    })
                })
                .catch(error => {

                console.log(error.response);
                this.branches=[];
                this.bankBranch.label='';
                this.billingAddress='';

                });
           }
           // this.branches=[];

           
        
        },
        getCompanies(){
            this.ibrCompanies=[];
            let id=this.ibrCountry.value;
            axios.get("/getCompanyByCountry/" + id) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.ibrCompanies.push({text:obj.name,value:obj.id});
                        
                    })
                })
                .catch(error => {

                console.log(error.response);
                

                });

            let id1=this.ibrCountry.region;
            axios.get("/getRates/" + id1) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        // let text='';
                        // let value='';
                        // this.ibrCompanies.push({text:obj.name,value:obj.id});
                        this.serviceCharge=obj.normal_rate;
                        
                    })
                })
                .catch(error => {

                console.log(error.response);
                

                });

        },
        getUrgentRate()
        {
            if(this.delivery.value==2)
            {
            let id1=this.ibrCountry.region;
            axios.get("/getRates/" + id1) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        // let text='';
                        // let value='';
                        // this.ibrCompanies.push({text:obj.name,value:obj.id});
                        this.serviceCharge=obj.urgent_rate;                   
                    })
                })
                .catch(error => {

                console.log(error.response);
                

                });

            }
            else{

                let id1=this.ibrCountry.region;
            axios.get("/getRates/" + id1) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        // let text='';
                        // let value='';
                        // this.ibrCompanies.push({text:obj.name,value:obj.id});
                        this.serviceCharge=obj.normal_rate;
                        
                    })
                })
                .catch(error => {

                console.log(error.response);
                

                });

            }
            
        },
        getTaxRegions(){
            axios.get("/getSalesRegion/") 
                .then(res => {
                console.log(res.data)  

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
       getTaxRate(){
            let id=this.saleReg.value;
           
            axios.get("/getSalesTaxByRegion/" + id) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        
                        // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        // this.branch=obj.branch_name;
                        this.taxRate=obj.region;
                        alert(obj.rate);
                    })
                })
                .catch(error => {
                this.billingAddress=='';
                console.log(error.response);
               

                });
        },
        getAddress(){
            let id=this.bankBranch.value;
            axios.get("/getBranchById/" + id) //with id
                .then(res => {
                console.log(res.data)  

                res.data.forEach((obj)=>{
                        
                        // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        // this.branch=obj.branch_name;
                        this.billingAddress=obj.branch_address;
                    })
                })
                .catch(error => {
                this.billingAddress=='';
                console.log(error.response);
               

                });
        },
   getCompany(){
         axios.get('/getCompany')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            let prefix="";
                            this.companies.push({ text: obj.company_name,value:obj.company_id,prefix:obj.company_prefix})
                            console.log(res.data);
                        })
                    })
   },
   getRegion(){
         axios.get('/getRegion')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            let prefix="";
                            this.regions.push({text: obj.city_name,value:obj.reg_id,prefix:obj.reg_prefix})
                            this.regionsop.push({text: obj.city_name,value:obj.reg_id,prefix:obj.reg_prefix})
                            console.log(res.data);
                        })
                    })
   },
   getBanksByIslam(){
      if(this.btype==true)
      {
        this.branches=[];
        this.selectedBank='';
        this.selectedBranch='';

        this.getIslamicBanks();
      }
      else
      {
        this.branches=[];
        this.selectedBank='';
        this.selectedBranch='';
     
        this.getBanks();
      }
   },
    validate1() {

      this.$v.form.$touch();
      var isValid = !this.$v.form.$invalid
      this.$emit('on-validate', this.$data, isValid)
      return isValid


    },
    getCity(){
        axios.get('/getCities')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.cities.push({ text:obj.city_name,value:obj.city_id})
                            console.log(res.data);
                        })
                    })

    },
    addBranch(){
        
        if(this.$v.branchModal.$invalid)
        {
             this.$v.branchModal.$touch();
            var isValid = !this.$v.branchModal.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }
       else
       {
            const branchData={
            branch_bank_id:this.branchBank.value,
            branch_city_id:this.branchCity.value,
            branch_code:this.branchCode,
            branch_name:this.branchName,
            branch_address:this.branchAddress,
            branch_fax:this.branchFax,
            branch_landline:this.branchPhone
             };

            axios.post('/addBranch',branchData)
            .then(res=>{
                this.branches=[];
                this.getBranches();
                alert('Branch Inserted');
                this.hide==true
            })
            .catch(error=>alert(error))
        }

       
    },
    addCustomer(){

        if(this.$v.customer.$invalid)
        {
            this.$v.customer.$touch();
            var isValid = !this.$v.customer.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else
        {
              const customerData={
            cust_city_id:this.customerCity.value,
            cust_name:this.customerName1,
            cust_phone:this.customerPhone1,
            cust_fax:this.customerFax1,
            cust_contact_person:this.customerPerson,
            cust_designation:this.customerDesignation1,
            cust_part_code:this.customerCode1,
            address:this.customerAddress1,
            ntn:this.customerCNIC,
            gst:this.customerGst

        };

        axios.post('/addCustomer',customerData)
        .then(res=>{
            this.customers=[];
            this.getCustomers();
            console.log(customerData);
            alert('Customer Created');

        })
        .catch(error=>alert(error))
        }
        

      
        
    },
    addBank(){
       

        if(this.$v.bank.$invalid)
        {
            this.$v.bank.$touch();
            var isValid = !this.$v.bank.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }
        else
        {
             const bankData={
            bank_name:this.bankName1,
            bank_code:this.bankCode1,
            bank_type:this.bankType,
            bank_ibr_rate:this.bankIbr
            };

            axios.post('/addBank',bankData)
            .then(res=>{
                this.banks=[];
                this.getBanks();
                alert('Bank Inserted');
            })
            .catch(error=>alert(error))

        } 
    },

    addCompany(){
       

       if(this.$v.companyModal.$invalid){
            this.$v.companyModal.$touch();
            var isValid = !this.$v.companyModal.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

       else
       {
            const cmpData={
            name:this.companyName1,
            address:this.companyAddress1,
            street:this.companyStreet1,
            po_box:this.companyStreet1,
            country_id:this.companyCountry1.value,
            email:this.companyEmail1,
            fax:this.companyFax1,
            website:this.companyWebsite1,
            registration_id:this.companyReg1
            };

            axios.post('/addCompany',cmpData)
            .then(res=>{
                this.ibrCompanies=[];
                this.ibrCountry="";
                alert('Company Inserted');
            })
            .catch(error=>alert(error))
        }
   
    },

    getCustomers(){
         axios.get('/getCustomers')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.customers.push({ text:obj.cust_name,value:obj.cust_id})
                            console.log(res.data);
                        })
                    })
    },
     getVendors(){
         axios.get('/getVendors')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.vendors.push({ text:obj.name,value:obj.id});
                            this.ibrVendors.push({ text:obj.name,value:obj.id});
                            console.log(res.data);
                        })
                    })
    },
    getVendorAddress(){
        let id=this.vendor.value;
        axios.get("/getVendor/" + id) //with id
            .then(res => {

            res.data.forEach((obj)=>{
                    
                    this.vendorAddress=obj.address;
                })
            })
            .catch(error => {
            console.log(error.response);
            

            });
    },
    validate2() {

        if(this.selected=="Bank")
        {
            this.$v.sec1.$touch();
            var isValid1 = !this.$v.sec1.$invalid
            this.$emit('on-validate', this.$data, isValid1)
            return isValid1
        }

        if(this.selected=="Vendors")
        {
             this.$v.sec3.$touch();
            var isValid2 = !this.$v.sec3.$invalid
            this.$emit('on-validate', this.$data, isValid2)
            return isValid2
        }

       if(this.selected=="Customers"){
             this.$v.sec2.$touch();
            var isValid3 = !this.$v.sec2.$invalid
            this.$emit('on-validate', this.$data, isValid3)
            return isValid3

        }

    },
    validate3() {

      this.$v.form3.$touch();
      var isValid = !this.$v.form3.$invalid
      this.$emit('on-validate', this.$data, isValid)
      return isValid
    },
    validate4() {

      this.$v.form4.$touch();
      var isValid = !this.$v.form4.$invalid
      this.$emit('on-validate', this.$data, isValid)
      return isValid
    }
  },
  validations: {
    name: {
      required,
      minLength: minLength(4)
    },
    selected:{
      required
    },
    company:{
      required
    },
    date:{
      required
    },
    region:{
      required
    },
    branch:{
      required
    },
   selectedBank:{
        required
    },
    bankBranch:{
        required
    },
    billingAddress:{
        required
    },
    bankRepresentative:{
        required
    },
    bankDesignation:{
        required
    },
    bankPhone:{
        required
    },
    bankEmail:{
        required,
        email
    },
    bankletterNo:{
        required
    },
    bankDate:{
        required
    },
    bankName1:{
        required
    },
    bankCode1:{
        required
    },
    bankType:{
        required
    },
    bankIbr:{
        required
    },
    customerName:{
        required
    },
    customerName1:{
        required
    },
    customerCode1:{
        required
    },
    customerPhone:{
        required
    },
    customerDesignation:{
        required
    },
    customerDesignation1:{
        required
    },
    customerRepresent:{
        required
    },
    customerPhone:{
        required
    },
    customerPhone1:{
        required
    },
    customerCNIC:{
        required
    },
    customerGst:{
        required
    },
    customerFax1:{
        required
    },
    customerEmail:{
        required,
         email
    },
    customerPerson:{
        required
    },
    customerAddress1:{
        required
    },
    customerCity:{
        required
    },
    vendor:{
        required
    },
    vendorAddress:{
        required
    },
    vendorRepresent:{
        required
    },
    vendorDesignation:{
        required
    },
    vendorPhone:{
        required
    },
    vendorEmail:{
        required,
         email
    },
    vendorLetter:{
        required
    },
    vendorExpiry:{
        required
    },
    ibrCountry:{
        required
    },
    city:{
        required
    },
    ibrCompany:{
        required
    },
    companyAddress:{
        required
    },
   ibrEmail:{
        required,
         email
    },
    ibrRegistration:{
        required
    },
    ibrPhone:{
        required
    },
    vendorIbr:{
        required
    },
    reportIbr:{
        required
    },
    delivery:{
        required
    },
    edd:{
        required
    },
    exRates:{
        required
    },
    serviceCharge:{
        required
    },
    branchBank:{
        required
    },
    branchName:{
        required
    },
    branchCity:{
        required
    },
    branchAddress:{
        required
    },
    branchPhone:{
        required
    },
    branchFax:{
        required
    },
    branchCode:{
        required
    },
    companyName1:{
        required
    },
    companyCountry1:{
        required
    },
    companyAddress1:{
        required
    },
    companyStreet1:{
        required
    },
    companyPobox1:{
        required
    },
    companyEmail1:{
        required
    },
    companyFax1:{
        required
    },
    companyReg1:{
        required
    },
    companyWebsite1:{
        required
    },
     form:[
        'selected',
        'company',
        'date',
        'region',
        'branch'],
     sec1:[
        'selectedBank',
        'bankBranch',
        'billingAddress',
        'bankRepresentative',
        'bankDesignation',
        'bankPhone','bankEmail',
        'bankletterNo',
        'bankDate',
        'customerDesignation',
        'customerRepresent',
        'customerName',
        'customerPhone',
        'customerEmail'
         
         ],
   sec2:[
        'customerDesignation',
        'customerRepresent',
        'customerName',
        'customerPhone',
        'customerEmail'
         ],
    sec3:[
        'vendor',
        'vendorAddress',
        'vendorRepresent',
        'vendorDesignation',
        'vendorPhone',
        'vendorEmail',
        'vendorLetter',
        'vendorExpiry',
        'customerDesignation',
        'customerRepresent',
        'customerName',
        'customerPhone',
        'customerEmail'
        ],
    form3:[
        'ibrCountry',
        'city',
        'ibrCompany', 
        'companyAddress',
        'ibrEmail',
        'ibrPhone',
        'ibrRegistration'
        ],
    form4:[
        'reportIbr',
        'vendorIbr',
        'delivery',
        'edd',
        'exRates',
        'serviceCharge'
    ],
    customer:[
        'customerName1',
        'customerCode1',
        'customerCity',
        'customerAddress1',
        'customerPhone1',
        'customerCNIC',
        'customerGst',
        'customerDesignation1',
        'customerPerson',
        'customerFax1'
    ],
    bank:[
        'bankName1',
        'bankCode1',
        'bankIbr',
        'bankType'
    ],
    branchModal:[
        'branchBank',
        'branchName',
        'branchCity',
        'branchAddress',
        'branchPhone',
        'branchFax',
        'branchCode'
    ],
    companyModal:[
        'companyName1',
        'companyCountry1',
        'companyAddress1',
        'companyStreet1',
        'companyPobox1',
        'companyEmail1',
        'companyFax1',
        'companyReg1',
        'companyWebsite1'
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
