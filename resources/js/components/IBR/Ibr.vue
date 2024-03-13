<template>
  <div class="container">
    <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
      <a href="/Ibr" class="btn btn-primary">Back</a>

      <div class="clearfix">
        <h4 class="text-blue pt-3">International Business Report</h4>
        <p class="mb-30 font-14">New IBR Job</p>
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
                                    <input type="radio" v-model.trim="selected"  id="customRadio1" name="type" value="Bank" @change="clear1()" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio1">Bank</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control  custom-radio mb-5">
                                    <input type="radio" style="background-color:red !important" v-model.trim="selected" id="customRadio2" name="type" value="Customers" @change="clear2()" class="custom-control-input">
                                    <label class="custom-control-label"  for="customRadio2">Customer</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="custom-control custom-radio mb-5">
                                    <input type="radio" v-model.trim="selected" id="customRadio3" name="type" value="Vendors" @change="clear3()" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio3">Vendor</label>
                                    </div>
                                </div>
                                
                            </div>
                            <div v-if="$v.selected.$error">
                                    <p class=" text-danger" v-if="!$v.selected.required">Please Select this Option</p>
                                </div>
                        </div>

                    </div>
                <div class="form-group row" >
                        <label class="col-md-3" for="company">Company </label>

                        <div class="col-md-8 pl-0 pr-0">
                            <Select id="company"  label="text" :class="{'invalid':$v.company.$error}" v-model="company" :options="companies" ></Select>
                            <div v-if="$v.company.$error" >
                                <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label class="col-md-3">Region: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <Select  label="text" :class="{'invalid':$v.region.$error}" v-model="region"  :options="regions" ></Select>
                            <div v-if="$v.region.$error" >
                                <p class="text-danger" v-if="!$v.region.required">Select your region</p>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group row ">
                        <label class="col-md-3">Operational Branch: </label>
                        <div class="col-md-8">
                            <Select  label="text" :class="{'invalid':$v.branch.$error}"  v-model="branch" :options="regions" ></Select>
                            <div v-if="$v.branch.$error" >
                                <p class="text-danger" v-if="!$v.branch.required">Select your branch</p>
                            </div>
                        </div>
                    </div> -->
                   
                    

            </div>
            <div id="section2">
                <fieldset id="section3"  v-show="selected == 'Vendors'">
                                    <h5>Vendor's Details</h5>
                                    <br>
                                    <div class="form-group row" >
                                        <label for="" class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                        <Select  label="text"  v-model="vendor" :class="{'date-invalid':$v.vendor.$error}" @input="getVendorAddress()" :options="vendors" ></Select>
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

                                        <label class="col-md-1 form-label">Date: </label>
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

                            <h5 >Ordering Bank's Details</h5>
                            <br>
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

                                <div class="col-md-7 pl-0">
                                <Select  label="text" v-model="bankBranch" @input="getAddress()" :class="{'date-invalid':$v.bankBranch.$error}"  :disabled="!selectedBank" :options="branches" ></Select>
                                <!--  -->
                                    <div v-if="$v.bankBranch.$error" >
                                    <p class="text-danger" v-if="!$v.bankBranch.required">Please select some branch</p>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <input type="button" value="Add" class="btn btn-primary  " :disabled="!selectedBank" data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-left:16px">
                                </div>

                                <div class="modal fade bd-example-modal-lg" tabindex="-1"   role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new Branch</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                                            <div class="form-group">
                                                <label for="recipient-name"  class="col-form-label">Branch Name / Branch Address:</label>
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
                                                <label for="recipient-name" class="col-form-label">Complete Address:</label>
                                                <input type="text" v-model="branchAddress" class="form-control" :class="{'date-invalid':$v.branchAddress.$error}">
                                                <div v-if="$v.branchAddress.$error" >
                                                    <p class="text-danger" v-if="!$v.branchAddress.required">Please select branch complete address</p>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Landline Number:</label>
                                                <input type="text" v-model="branchLandline" class="form-control" :class="{'date-invalid':$v.branchLandline.$error}">
                                                <div v-if="$v.branchLandline.$error" >
                                                    <p class="text-danger" v-if="!$v.branchLandline.required">Please input landline number</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="recipient-name"  class="col-form-label">Phone:</label>
                                                        <input type="number" v-model="branchPhone" class="form-control" :class="{'date-invalid':$v.branchPhone.$error}">
                                                        <div v-if="$v.branchPhone.$error" >
                                                            <p class="text-danger" v-if="!$v.branchPhone.required">Please input branch phone-number</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <!-- <div class="col-md-4">
                                                <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Fax:</label>
                                                        <input type="text" v-model="branchFax" class="form-control" :class="{'date-invalid':$v.branchFax.$error}">
                                                    <div v-if="$v.branchFax.$error" >
                                                            <p class="text-danger" v-if="!$v.branchFax.required">Please input branch fax-number</p>
                                                        </div>
                                                    </div> 
                                                </div> -->
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Code:</label>
                                                        <input type="number" v-model="branchCode" class="form-control" :class="{'date-invalid':$v.branchCode.$error}">
                                                    <div v-if="$v.branchCode.$error" >
                                                            <p class="text-danger" v-if="!$v.branchCode.required">Please input branch code of bank</p>
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>

                                            <button type="button"  data-dismiss="modal" class="btn btn-secondary">Close</button>
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
                                <div class="col-md-3 pl-0 ">
                                    <input class="form-control  form-control-sm" v-model="bankDate" :class="{'date-invalid':$v.bankDate.$error}" style="margin-left: 18px;min-width: 169px;" name="txtDate2" type="date">
                                    <div v-if="$v.bankDate.$error" >
                                        <p class="text-danger" style="margin-left:20px" v-if="!$v.bankDate.required">Please specify the date</p>
                                    </div>
                                </div>
                            </div>

                            <hr>
                        </fieldset>
                        <fieldset id="section2"  v-show="selected == 'Customers' || 'Vendors' || 'Bank'">
                            <h5>{{csTitle}}'s Details</h5>
                            <br>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-7 pl-0">
                                <Select :options="customers" :class="{'date-invalid':$v.customerName.$error}" @input="getCustomer()" v-model="customerName" label="text" ></Select>
                                <div v-if="$v.customerName.$error" >
                                        <p class="text-danger" v-if="!$v.customerName.required">Please select Customer</p>
                                </div>
                                    </div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerModal" style="margin-left:16px" value="Add">
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
            </div>
            <div id="section3">
                <hr>
                <h5>Target Company</h5>
                <br>
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
                        <input v-model="city" type="text" class="form-control form-control-sm ">   
                           
                        </div>
                    </div>


                    <div class="row form-group">
                        <label class="col-md-3 col-form-label">Select Company: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <autocomplete  :search="search" @submit="handleSubmit" ref="ibrCompany" @input="setCompany($event.target.value)"  :get-result-value="getResultValue"></autocomplete>
                        <div class="text-danger" v-if="!$v.ibrCompany.required">This field is required</div>
                        </div>
                        
                    </div>
                    <!-- <div class="modal fade bd-example-modal-2" id="companyModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                            <textarea name="" id="" v-model="companyAddress1" cols="30" rows="8" :class="{'date-invalid':$v.companyAddress1.$error}" class="form-control" style="height:110px"></textarea>
                                            <div v-if="$v.companyAddress1.$error" >
                                                <p class="text-danger" v-if="!$v.companyAddress1.required">Please input company's country</p>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">Street:</label>
                                                <input type="text" v-model="companyStreet1"  class="form-control">
                                               
                                        </div>
                                        <div class="col-md-6">
                                                <label for="recipient-name" class="col-form-label">P.O.Box:</label>
                                                <input type="text" v-model="companyPobox1"  class="form-control">
                                                
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Email:</label>
                                                <input type="email" v-model="companyEmail1"  class="form-control">
                                                
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Fax:</label>
                                                <input type="text" v-model="companyFax1"  class="form-control">
                                               
                                                
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Registration:</label>
                                                <input type="text" v-model="companyReg1"  class="form-control">
                                               
                                            </div> 
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Website:</label>
                                                <input type="text" v-model="companyWebsite1"  class="form-control">
                
                                            </div> 
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" @click="addCompany()" class="btn btn-primary">Add Comapny</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group row " v-show="duplicate">
                        <div class="col-md-3">
                            <label class=" col-form-label">Duplicate: </label>
                        </div>
                        <div class="form-check col-md-2"  style="margin-top:10px">
                            <input type="checkbox" v-model="duplicate" class="form-check-input " id="duplicate" @change="emptyDuplicate()"  name="duplicate" value="Yes">
                            <label for="duplicate" class="form-check-label " value="Bank">Yes?</label>
                        </div>
                        <div class="col-md-6 ">
                            <input class="form-control" v-model="dupJob" disabled>
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
                            <input type="number" v-model="ibrPhone" class="form-control  form-control-sm"  >
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Fax: </label>
                        <input  class="form-control  form-control-sm col-md-8" v-model="ibrFax"  type="text">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Email: </label>
                        <div class="col-md-8 pl-0 pr-0" >
                        <input type="email" class="form-control  form-control-sm" v-model="ibrEmail" >
                            
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Website: </label>
                        <input  class="form-control  form-control-sm col-md-8" v-model="companyUrl" type="text">
                    </div>

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label">Registration ID: </label>
                        <div class="col-md-8 pl-0 pr-0">
                            <input type="text" v-model="ibrRegistration" class="form-control  form-control-sm" >
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="" class="col-md-3 col-form-label">Additional Information</label>
                        <textarea type="text" v-model="ibrAddition" name=""  cols="30" rows="2" class="col-md-8 form-control form-control-sm" style="height:60px"></textarea>
                    </div>
            </div>
            <div id="section4">
                <hr>
                <h5>Report's Details</h5>
                <br>
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
                            <input class="form-control form-control-sm" v-model="edd && edd.toISOString().split('T')[0]" placeholder="Select Date" :class="{'date-invalid':$v.edd.$error}" name="txtDate3"   type="date">
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
                            <input type="checkbox" v-model="regionSale"  class="form-check-input" @change="emptyRegion()" name="sales" value="Yes">
                            <label for="" class="form-check-label" value="Bank">Yes?</label>
                           
                        </div>

                        <label v-show="regionSale"  class="col-md-1 col-form-label region-label" >Region: </label>
                        <div class="col-md-6 pr-3" v-show="regionSale">
                            <Select :options="salesRegion" label="text" v-model="saleReg" @input="getTaxRate()"></Select>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label class="col-md-3 col-form-label">Tentative Report: </label>
                        <div class="form-check col-md-2" style="margin-top:10px">
                            <input type="checkbox" v-model="istentative"  class="form-check-input " @change="emptyType()" name="type" value="Yes">
                            <label for="" class="form-check-label"  value="Bank">Include Risk?</label>
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
          usercompany:String,
          usercompanyname:String,
          usercompanyprefix:String
      },
      components:{
          'Select':vSelect,
            Autocomplete
      },
     data() {
       return {
        title:'',
        subtitle:'',
        name:'',
        btype:false,
        duplicate:'',
        duplicateIds:[],
        selected:'Bank',
        selectedBank:'',
        selectedBranch:'',
        // branch:'',
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
        region:'',
        companies:[],
        banks:[],
        regions:[],
        branches:[],
        cities:[],
        customers:[],
        vendors:[],
        bankName1:'',
        bankCode1:'',
        bankIbr:'',
        // branchBank:'',
        branchCity:'',
        branchName:'',
        branchCode:'',
        branchAddress:'',
        branchPhone:'',
        branchFax:'',
        branchLandline:'',
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
        vendor:'',
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
        ibrBranchFax:'',
        companyUrl:'',
        ibrVendors:[],
        reportType:[],
        deliveryTime:[],
        salesRegion:[],
        exRates:157,
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
        edd:new Date(),
        types:['Islamic','Conventional'],
        companyName1:'',
        companyCountry1:'',
        companyAddress1:'',
        companyStreet1:'',
        companyPobox1:'',
        companyEmail1:'',
        companyFax1:'',
        companyReg1:'',
        companyWebsite1:'',
        csTitle:'Borrower',
        toBeDuplicated:'',
        dupJobs:[],
        dupJob:'',
        folderID:'',
        ibrCompany:''

        
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


        
    },
    methods: {
       setCompany(value){
           this.ibrCompany=value;
           this.$v.ibrCompany.$touch();
       },
   
    onComplete: function(){

    




    if(this.selected=="Bank")
    {
        
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

    }

    if(this.selected=="Customers")
    {
     if(this.$v.form2.$invalid)
        {
            this.$v.form2.$touch();
            var isValid = !this.$v.form2.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else
        {
            this.postdata();
        }

    }

   if(this.selected=="Vendors")
    {
        
      if(this.$v.form3.$invalid)
        {
            this.$v.form3.$touch();
            var isValid = !this.$v.form3.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else
        {
            this.postdata();
        }
    
    }
  
    
   


   },
   emptyRegion(){
       this.saleReg='';
   },
   emptyType(){
       this.tentativeType=''
   },
   postdata(){

       var month=this.edd.getMonth() + 1;
       var eddate=this.edd.getFullYear()+"-"+month+"-"+this.edd.getDate();
          var string=this.$refs.ibrCompany.value;
         var cmpname=string.replace(/[{()}^0-9-]/g, "");
        
  

        const jobData={
        job_by:this.company.value,
        regional_id:this.region.value,
        // operational_branch:this.branch.value,
        // expiry:this.date,
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
        company_id:cmpname,
        duplicate:this.duplicate,
        duplicate_id:this.dupJob,
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
        edd:eddate,
        service_charges:this.serviceCharge,
        ex_rates:this.exRates,
        sales:this.regionSale,
        sales_tax:this.taxRate,
        tentative:this.istentative,
        tentativeReport:this.tentativeType,
        regional_prefix:this.region.prefix,
        company_prefix:this.company.prefix,
        bank_prefix:this.selectedBank.prefix,
        given_by:this.selected,
        reportFolder:this.folderID
        };
            console.log(jobData);

        axios.post('/postJob',jobData)
            .then(res=>{
           alert('Job is successfully created')
            window.location.href="/home";
            return false;
            })
            .catch(error=>alert(error))    
    

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

            emptyDuplicate(){
       this.dupJobs=[];
       this.dupJob='';
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
   getReports(){
        this.reportType=[];
                 axios.get('/getReportType')
                    .then(res=>{
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
                res.data.forEach((obj)=>{
                    let text='';
                    let value='';
                    let prefix="";
                    this.banks.push({text:obj.bank_name,value:obj.bank_id,prefix:obj.bank_code})
                })
            })
        },
    getBranches($id){
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
            // this.duplicate=false;
            // this.duplicateId="";
            let id=this.ibrCountry.value;
            axios.get("/getCompanyByCountry/" + id) //with id
                .then(res => {
                   
                 
                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.ibrCompanies.push(
                            {
                                name:obj.company_id,
                                id:obj.id,
                                job_id:obj.job_id,
                                expiry:obj.expiry,
                                street:obj.company_street,
                                address:obj.company_address,
                                pobox:obj.company_pobox,
                                phone:obj.company_phone,
                                fax:obj.company_fax,
                                email:obj.company_email,
                                website:obj.company_url,
                                registration:obj.registration_id,
                                add:obj.additionals
                                }
                            );
                        console.log(this.ibrCompanies);    
                    })
                })
                .catch(error => {

                console.log(error.response);
                

                });

            let id1=this.ibrCountry.region;
            axios.get("/getRates/" + id1) //with id
                .then(res => {

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

        search(input) {
                 if (input.length < 1) { return [] }
                 return this.ibrCompanies.filter(res => {
                return res.name.toLowerCase()
                .match(input.toLowerCase())
            })
            },

             getResultValue(result) {
                 var expiry=result.expiry==null ? '' : result.expiry;
                return result.name + ' ('+expiry+')';
                },

        handleSubmit(result) {
             this.companyAddress=result.address;
             this.companyStreet=result.street;
             this.companyPobox=result.pobox;
             this.ibrPhone=result.phone;
             this.ibrFax=result.fax;
             this.ibrEmail=result.email;
             this.companyUrl=result.website;
             this.ibrRegistration=result.registration;
             this.ibrAddition=result.add;
             this.duplicate=true;
             this.dupJob=result.job_id;
             this.folderID=result.id

            },    

         

        getUrgentRate()
        {
            this.edd = new Date()


            if(this.delivery.value==2)
            {
                  this.edd = new Date()

            let id1=this.ibrCountry.region;
            axios.get("/getRates/" + id1) //with id
                .then(res => {

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

                if(this.delivery.value==1)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 5))

                }
                else if(this.delivery.value==3)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 3))

                }
                else if(this.delivery.value==4)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 2))

                }
                else if(this.delivery.value==10)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 5))

                }
                else if(this.delivery.value==11)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 6))

                }
                else if(this.delivery.value==17)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 7))

                }
                else if(this.delivery.value==18)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 6))

                }
                else if(this.delivery.value==19)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 7))

                }
                else if(this.delivery.value==20)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 8))

                }
                else if(this.delivery.value==21)
                {
                  this.edd = new Date(this.edd.setDate(this.edd.getDate() + 9))

                }

            }
            
        },
        getTaxRegions(){
            axios.get("/getSalesRegion/") 
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
       getTaxRate(){
            let id=this.saleReg.value;
           
            axios.get("/getSalesTaxByRegion/" + id) //with id
                .then(res => {  

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

                res.data.forEach((obj)=>{
                        
                        // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        // this.branch=obj.branch_name;
                        this.billingAddress=obj.branch_address;
                        this.bankPhone=obj.branch_phone;
                    })
                })
                .catch(error => {
                this.billingAddress=='';
                console.log(error.response);
               

                });
        },

        getCustomer(){
            let id=this.customerName.value;
            axios.get("/getCustomerById/" + id) //with id
                .then(res => {

                res.data.forEach((obj)=>{
                        
                        // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        // this.branch=obj.branch_name;
                       
                        this.customerPhone=obj.cust_phone;
                        this.ibrCustomerFax=obj.cust_fax;
                        this.customerRepresent=obj.cust_contact_person;
                        this.customerDesignation=obj.cust_designation;
                    })
                })
                .catch(error => {
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
                            this.company={text:this.usercompanyname,value:this.usercompany,prefix:this.usercompanyprefix}
                            
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
                            this.regions.push({ text: obj.city_name,value:obj.reg_id,prefix:obj.reg_prefix})
                            
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
    getCity(){
        axios.get('/getCities')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.cities.push({ text:obj.city_name,value:obj.city_id})
                          
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
            branch_bank_id:this.selectedBank.value,
            branch_city_id:this.branchCity.value,
            branch_code:this.branchCode,
            branch_name:this.branchName,
            branch_address:this.branchAddress,
            branch_phone:this.branchPhone,
            branch_landline:this.branchLandline
             };

            axios.post('/addBranch',branchData)
            .then(res=>{
                this.branches=[];
                this.getBranches();
                alert('Branch Inserted');
                $('.bd-example-modal-lg').modal('hide');
                this.branchCity='';
                this.branchCode='';
                this.branchName='';
                this.branchAddress='';
                this.branchPhone='';
                this.branchLandline='';

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
            alert('Customer Created');
            $('#customerModal').modal('hide');
            this.customerCity='';
            this.customerName1='';
            this.customerPhone1='';
            this.customerFax1='';
            this.customerPerson='';
            this.customerDesignation1='';
            this.customerCode1='';
            this.customerAddress1='';
            this.customerCNIC='';
            this.customerGst='';


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
                $('#bankModal').modal('hide');
                this.bankName1='';
                this.bankCode1='';
                this.bankType1='';
                this.bankIbr='';
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
            po_box:this.companyPobox1,
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
                alert('Company Created');
               $('#companyModal').modal('hide');
               this.companyName1='';
               this.companyAddress1='';
               this.companyStreet1='';
               this.companyPobox1='';
               this.companyCountry1='';
               this.companyEmail1='';
               this.companyFax1='';
               this.companyWebsite1='';
               this.companyReg1='';

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
                           
                        })
                    })
    },
    getVendorAddress(){
        let id=this.vendor.value;
        axios.get("/getVendorById/" + id) //with id
            .then(res => {
            res.data.forEach((obj)=>{
                    
                    this.vendorAddress=obj.address;
                    this.vendorPhone=obj.phone_number;
                    this.vendorEmail=obj.email;
                    this.vendorFax=obj.fax;
                })
            })
            .catch(error => {
            console.log(error.response);
            

            });
    },
    clear1(){
        this.csTitle="Borrower";
        this.vendorAddress="";
        this.vendor="";
        this.vendorRepresent="";
        this.vendorDesignation="";
        this.vendorPhone="";
        this.vendorEmail="";
        this.vendorFax="";
        this.vendorLetter="";
        this.vendorExpiry="";
    },
    clear2(){
        this.csTitle="Customer";
        this.vendorAddress="";
        this.vendor="";
        this.vendorRepresent="";
        this.vendorDesignation="";
        this.vendorPhone="";
        this.vendorEmail="";
        this.vendorFax="";
        this.vendorLetter="";
        this.vendorExpiry="";
        this.selectedBank="";
        this.btype=false;
        this.selectedBranch="";
        this.bankBranch="";
        this.billingAddress="";
        this.bankRepresentative="";
        this.bankDesignation="";
        this.bankPhone="";
        this.ibrBranchFax="";
        this.bankEmail="";
        this.bankletterNo="";
        this.bankDate="";
    },
    clear3(){
        this.csTitle="Borrower";
         this.selectedBank="";
        this.btype=false;
        this.selectedBranch="";
        this.bankBranch="";
        this.billingAddress="";
        this.bankRepresentative="";
        this.bankDesignation="";
        this.bankPhone="";
        this.ibrBranchFax="";
        this.bankEmail="";
        this.bankletterNo="";
        this.bankDate="";
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
    region:{
      required
    },
    // branch:{
    //   required
    // },
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
    companyAddress:{
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
    branchLandline:{
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
    ibrCompany:{
        required
    },
     form1:[
        'selected',
        'company',
        // 'date',
        'region',
        // 'branch',
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
        'customerEmail',
        'ibrCountry',
        'ibrCompany',
        'companyAddress',
        'reportIbr',
        'vendorIbr',
        'delivery',
        'edd',
        'exRates',
        'serviceCharge'],

          form2:[
        'selected',
        'company',
        // 'date',
        'region',
        // 'branch',
        'customerName',
        'customerPhone',
        'customerEmail',
        'customerDesignation',
        'customerRepresent',
        'ibrCountry',
         'ibrCompany',
        'companyAddress',
        'reportIbr',
        'vendorIbr',
        'delivery',
        'edd',
        'exRates',
        'serviceCharge'],

          form3:[
        'selected',
        'company',
        // 'date',
        'region',
        // 'branch',
        'customerDesignation',
        'customerRepresent',
        'customerName',
        'customerPhone',
        'ibrCompany',
        'customerEmail',
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
        'customerEmail',
        'ibrCountry',
        'companyAddress',
        'reportIbr',
        'vendorIbr',
        'delivery',
        'edd',
        'exRates',
        'serviceCharge'],
    

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
        'branchName',
        'branchCity',
        'branchAddress',
        'branchPhone',
        'branchCode'
    ],
    companyModal:[
        'companyName1',
        'companyCountry1',
        'companyAddress1'
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
