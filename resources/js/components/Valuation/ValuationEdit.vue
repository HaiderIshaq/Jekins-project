<template>
    <div class="container" style="max-width:100%">
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <a href="/home" class="btn btn-primary">Back</a>


            <!--Header Job Details  -->
            <div class="row">
                <div class="col-md-4">
                <h4 class="text-blue pt-3">Valuation</h4>
                <p class="mb-30 font-14">Edit Valuation Job : <b>{{jobid}}</b></p>
                </div>


                <div class="col-md-2 offset-md-6">
                <span class="badge  mt-4" :class="{'badge-success':this.status=='Completed','badge-warning':this.status=='Running','badge-info':this.status=='Delayed By Customer','badge-danger':this.status=='Cancelled' }"  style="font-size: 1.3rem;">{{status}}</span>

                </div>

            </div>
            <!--Header Job Details  -->

            <!--Header Buttons  -->
            <div class="row">
                <div class="col-md-3 pb-3">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#reportModal">Update Extracted Details</a>
                </div>
                <div class="col-md-3 pb-3" style="margin-left:0px">
                    <a href="#" class="btn btn-primary">Print Original Report</a>
                </div>
                <div class="col-md-3 pb-3">
                    <a href="#" class="btn btn-primary">Print Duplicate Report</a>
                </div>
                <div class="col-md-3 pb-3" style="margin-left:0px">
                    <a href="#" class="btn  btn-primary">Print Office Copy</a>
                </div>

            </div>
            <div class="row">
                <div class="col-md-2 pb-3">
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input"  :disabled=" isCompleted || cancelled" v-model="btype" >
                        <label for="form-check-label"> Print for Email?</label>
                    </div>
                </div>

                <div class="col-md-2 pb-3">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input"  :disabled=" isCompleted || cancelled" v-model="completed" >
                            <label for="form-check-label"> Completed</label>
                        </div>
                </div>

                <div class="col-md-3 pb-3">
                        <div class="form-check mt-2">
                            <input type="checkbox" class="form-check-input" :disabled=" isCompleted || cancelled" v-model="delayed" >
                            <label for="form-check-label">Delayed By Customer?</label>
                        </div>
                </div>

                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-3">
                    <label for="">Bill Date</label>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group row">
                        <input type="date" v-model="billDate" class="form-control form-control-sm" name="" id="">
                        </div>
                    </div>
                    </div>
                </div>

            </div>
            <!--Header Buttons  -->

            <div class="clearfix"></div>


            <!-- Requested & Delivered On-->
            <div class="row ">
                <div class="col-md-2">
                    <label for="">Requested On</label>
                </div>
                <div class="col-md-4">
                    <div class="form-group row">
                    <input type="date" v-model="requestedDate" class="form-control form-control-sm" name="" id="">
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="">Delivered On</label>
                </div>
                <div class="col-md-3">
                    <div class="form-group row">
                    <input type="date" v-model="deliverOn" class="form-control form-control-sm" name="" id="">
                    </div>
                </div>

            </div>
            <hr>
            <!-- Requested & Delivered On-->


            <!-- Main Detail Fields -->
            <div class="wizard-content">
                <form action=""  enctype="multipart/form-data">

                    <!-- Type & Company & Region -->
                    <div id="section1">
                        <div class="form-group row">

                                <label class="col-md-3 form-label">Type: </label>

                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio mb-5">
                                            <input type="radio" v-model.trim="isSelected"  id="customRadio1" @change="clear1()" name="iselected" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control  custom-radio mb-5">
                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="isSelected" :disabled=" isCompleted || cancelled" id="customRadio2" name="iselected" value="Customers"  class="custom-control-input">
                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="custom-control custom-radio mb-5">
                                            <input type="radio" v-model.trim="isSelected" id="customRadio3" @change="clear3()" name="iselected" value="Vendors" :disabled=" isCompleted || cancelled" class="custom-control-input">
                                            <label class="custom-control-label" for="customRadio3">Vendor</label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div v-if="$v.selected.$error">
                                            <p class=" text-danger" v-if="!$v.selected.required">Please Select this Option</p>
                                        </div> -->
                                </div>

                            </div>
                        <div class="form-group row" >
                                <label class="col-md-3" for="company">Company </label>

                                <div class="col-md-8 pl-0 pr-0">
                                    <Select id="company"  label="text" :class="{'invalid':$v.company.$error}" v-model="company" :disabled=" isCompleted || cancelled" :options="companies" ></Select>
                                    <!-- <div v-if="$v.company.$error" >
                                        <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group row ">
                                <label class="col-md-3 ">Region: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                    <Select  label="text" :class="{'invalid':$v.region.$error}" v-model="region" :disabled=" isCompleted || cancelled"  :options="regions" ></Select>
                                    <!-- <div v-if="$v.region.$error" >
                                        <p class="text-danger" v-if="!$v.region.required">Select your region</p>
                                    </div> -->

                                </div>
                            </div>



                    </div>
                    <!-- Type & Company & Region -->

                    <!-- Bank, Customer & Vendor Details -->
                    <div id="section2">
                        <fieldset id="section3"  v-show="isSelected == 'Vendors'" >
                                            <h5>Vendor's Details</h5>
                                            <br>
                                            <div class="form-group row" >
                                                <label for="" class="col-md-3 col-form-label">Name</label>
                                                <div class="col-md-8 pl-0 pr-0">
                                                <Select  label="text" :disabled=" isCompleted || cancelled"  v-model="vendor" :class="{'date-invalid':$v.vendor.$error}" @change="getVendorAddress()" :options="vendors" ></Select>
                                                    <!-- <div v-if="$v.vendor.$error">
                                                        <p class=" text-danger" v-if="!$v.vendor.required">Please Select some vendor</p>
                                                    </div>   -->
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
                                                <textarea v-model="vendorAddress" :disabled=" isCompleted || cancelled"  cols="30" rows="2" class="form-control form-control-sm" :class="{'date-invalid':$v.vendorAddress.$error}" ></textarea>
                                                    <!-- <div v-if="$v.vendorAddress.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorAddress.required">Please input vendor billing address</p>
                                                    </div>  -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Representative: </label>
                                                <div class="col-md-8 pl-0 pr-0" >
                                                <input class="form-control  form-control-sm" v-model="vendorRepresent" :disabled=" cancelled"  :class="{'date-invalid':$v.vendorRepresent.$error}"  type="text">
                                                    <!-- <div v-if="$v.vendorRepresent.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorRepresent.required">Please input vendor representative</p>
                                                    </div>  -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Designation/Dept: </label>
                                                <div class="col-md-8 pl-0 pr-0" >
                                                    <input class="form-control  form-control-sm" v-model="vendorDesignation" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.vendorDesignation.$error}"  type="text">
                                                        <!-- <div v-if="$v.vendorDesignation.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorDesignation.required">Please input vendor representative</p>
                                                        </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Phone: </label>
                                                <div class="col-md-8 pl-0 pr-0">
                                                    <input type="number" class="form-control  form-control-sm" :disabled=" isCompleted || cancelled" v-model="vendorPhone" :class="{'date-invalid':$v.vendorPhone.$error}"  >
                                                    <!-- <div v-if="$v.vendorPhone.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorPhone.required">Please input vendor phone-number</p>
                                                    </div> -->
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Fax: </label>
                                                <div class="col-md-8 pl-0 pr-0"  >
                                                    <input  class="form-control  form-control-sm " :disabled=" isCompleted || cancelled"  v-model="vendorFax"  type="text">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 col-form-label">Email: </label>
                                                <div class="col-md-8 pl-0 pr-0">
                                                    <input type="email" class="form-control  form-control-sm" v-model="vendorEmail" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.vendorEmail.$error}" >
                                                    <!-- <div v-if="$v.vendorEmail.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorEmail.required">Please input vendor email address</p>
                                                        <p class="text-danger" v-if="!$v.vendorEmail.email">Please fill out valid email</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-3 form-label">Letter No: </label>
                                                <div class="col-md-4 pl-0" >
                                                    <input type="text" class="form-control form-control-sm" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.vendorLetter.$error}" v-model="vendorLetter">
                                                    <!-- <div v-if="$v.vendorLetter.$error">
                                                        <p class=" text-danger" v-if="!$v.vendorLetter.required">Please input vendor letter</p>
                                                    </div> -->
                                                </div>

                                                <label class="col-md-1 form-label">Date: </label>
                                                <div class="col-md-3" >
                                                    <input class="form-control form-control-sm" v-model="vendorExpiry" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.vendorExpiry.$error}"  style="margin-left: 18px;min-width: 169px;" name="txtDate1" type="date">
                                                    <!-- <div v-if="$v.vendorExpiry.$error" style="margin-left:20px">
                                                        <p class=" text-danger" v-if="!$v.vendorExpiry.required">Please fill out the date</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <hr>
                        </fieldset>
                        <fieldset id="section1" v-show="isSelected == 'Bank'">

                            <h5 >Ordering Bank's Details</h5>
                            <br>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Bank: </label>
                                <div class="col-md-4" style="padding-left:0px">
                                    <Select  label="text" @input="getBranches"  :class="{'date-invalid':$v.selectedBank.$error}" :disabled=" isCompleted || cancelled" :options="banks"  v-model="selectedBank"></Select>
                                    <!-- <div v-if="$v.selectedBank.$error" >
                                        <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                                    </div> -->
                                </div>
                                <div class=" col-md-2 " >
                                    <div class="form-check mt-2 ml-4">
                                        <input type="checkbox" class="form-check-input" @change="getBanksByIslam()" :disabled=" isCompleted || cancelled" v-model="btype" >
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
                                                    <button type="button" class="close" :disabled=" isCompleted || cancelled" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form enctype="multipart/form-data" >

                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="recipient-name" class="col-form-label">Name:</label>
                                                            <input type="text" v-model="bankName1" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.bankName1.$error}" class="form-control">
                                                            <!-- <div v-if="$v.bankName1.$error" >
                                                                <p class="text-danger" v-if="!$v.bankName1.required">Please input bank name</p>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="message-text" class="col-form-label">Type:</label>
                                                            <!-- <input type="text" v-model="bankCode1" :class="{'date-invalid':$v.bankCode1.$error}" class="form-control"> -->
                                                        <Select :options="types" v-model="bankType" :disabled=" isCompleted || cancelled"  :class="{'date-invalid':$v.bankType.$error}" label="text"></Select>
                                                        <!-- <div v-if="$v.bankType.$error" >
                                                                <p class="text-danger" v-if="!$v.bankType.required">Please select bank type</p>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-md-12">
                                                            <label for="message-text" class="col-form-label">Code:</label>
                                                            <input type="text" v-model="bankCode1" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.bankCode1.$error}" class="form-control">
                                                            <!-- <div v-if="$v.bankCode1.$error" >
                                                                <p class="text-danger" v-if="!$v.bankCode1.required">Please input bank code</p>
                                                            </div> -->
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="recipient-name" class="col-form-label">Bank Ibr Rate:</label>
                                                                <input type="number" v-model="bankIbr" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.bankIbr.$error}" class="form-control">
                                                                <!-- <div v-if="$v.bankIbr.$error" >
                                                                <p class="text-danger" v-if="!$v.bankIbr.required">Please input bank IBR rate</p>
                                                            </div> -->
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
                                <Select  label="text" v-model="bankBranch" @input="getAddress()" :disabled=" cancelled || !selectedBank" :class="{'date-invalid':$v.bankBranch.$error}"   :options="branches" ></Select>
                                <!--  -->
                                    <!-- <div v-if="$v.bankBranch.$error" >
                                    <p class="text-danger" v-if="!$v.bankBranch.required">Please select some branch</p>
                                </div> -->
                                </div>
                                <div class="col-md-2">
                                <input type="button" value="Add" class="btn btn-primary"  :disabled="!selectedBank ||  cancelled" data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-left:16px">
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
                                                    <input type="text" v-model="branchName" :disabled="isCompleted || cancelled" class="form-control" :class="{'date-invalid':$v.branchName.$error}">
                                                    <!-- <div v-if="$v.branchName.$error" >
                                                        <p class="text-danger" v-if="!$v.branchName.required">Please input branch Name</p>
                                                    </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">City:</label>
                                                    <Select v-model="branchCity" label="text" :disabled="isCompleted || cancelled" :options="cities" :class="{'date-invalid':$v.branchCity.$error}"></Select>
                                                    <!-- <div v-if="$v.branchCity.$error" >
                                                        <p class="text-danger" v-if="!$v.branchCity.required">Please select branch city</p>
                                                    </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Complete Address:</label>
                                                    <input type="text" v-model="branchAddress" :disabled=" cancelled" class="form-control" :class="{'date-invalid':$v.branchAddress.$error}">
                                                    <!-- <div v-if="$v.branchAddress.$error" >
                                                        <p class="text-danger" v-if="!$v.branchAddress.required">Please select branch city</p>
                                                    </div> -->
                                                </div>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="col-form-label">Landline Number:</label>
                                                    <input type="text" v-model="branchLandline" :disabled="isCompleted || cancelled" class="form-control" >

                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                            <label for="recipient-name"  class="col-form-label">Phone:</label>
                                                            <input type="number" v-model="branchPhone" :disabled= "isCompleted || cancelled"  class="form-control" :class="{'date-invalid':$v.branchPhone.$error}">
                                                            <!-- <div v-if="$v.branchPhone.$error" >
                                                                <p class="text-danger" v-if="!$v.branchPhone.required">Please input branch phone-number</p>
                                                            </div> -->
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
                                                            <input type="text" v-model="branchCode" :disabled="isCompleted || cancelled" class="form-control" :class="{'date-invalid':$v.branchCode.$error}">
                                                        <!-- <div v-if="$v.branchCode.$error" >
                                                                <p class="text-danger" v-if="!$v.branchCode.required">Please input branch code of bank</p>
                                                            </div> -->
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
                                    <textarea type="text" name="" v-model="billingAddress" :disabled="isCompleted || cancelled"  :class="{'date-invalid':$v.billingAddress.$error}"  cols="30" rows="2" class=" form-control form-control-sm" style="height:60px"></textarea>
                            <!-- <div v-if="$v.billingAddress.$error" >
                                    <p class="text-danger" v-if="!$v.billingAddress.required">Please fill out billing address</p>
                                </div> -->
                            </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Representative: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input  class="form-control  form-control-sm" :disabled="isCompleted || cancelled" v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                    </div> -->
                                </div>


                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Designation/Dept: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                    <input class="form-control  form-control-sm" :disabled="isCompleted || cancelled" v-model="bankDesignation" :class="{'date-invalid':$v.bankDesignation.$error}"  type="text">
                                    <!-- <div v-if="$v.bankDesignation.$error" >
                                        <p class="text-danger" v-if="!$v.bankDesignation.required">Please fill out designation and department</p>
                                    </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Phone: </label>
                                <div class="col-md-8 pl-0 pr-0">
                                    <input type="number" v-model="bankPhone" :disabled="isCompleted || cancelled" :class="{'date-invalid':$v.bankPhone.$error}" class="form-control form-control-sm" >
                                    <!-- <div v-if="$v.bankPhone.$error" >
                                        <p class="text-danger" v-if="!$v.bankPhone.required">Please fill out phone number</p>
                                    </div> -->
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Fax: </label>
                                <input  class="form-control  form-control-sm col-md-8" :disabled=" isCompleted || cancelled" v-model="ibrBranchFax" type="text">
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Email: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input type="email" v-model="bankEmail" class="form-control  form-control-sm" :disabled=" isCompleted || cancelled"  :class="{'date-invalid':$v.bankEmail.$error}">
                                    <!-- <div v-if="$v.bankEmail.$error" >
                                        <p class="text-danger" v-if="!$v.bankEmail.required">Please fill out email address</p>
                                        <p class="text-danger" v-if="!$v.bankEmail.email">Please fill out valid email</p>
                                    </div> -->
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-3">
                                    <label class="form-label">Letter No: </label>
                                </div>
                                <div class="col-md-4 pl-0" >
                                <input type="text" v-model="bankletterNo" class="form-control form-control-sm" :disabled=" isCompleted || cancelled"  :class="{'date-invalid':$v.bankletterNo.$error}">
                                    <!-- <div v-if="$v.bankletterNo.$error" >
                                        <p class="text-danger" v-if="!$v.bankletterNo.required">Please fill out this field</p>
                                    </div> -->
                                </div>
                                <div class="col-md-1">
                                    <label class="form-label mt-2">Date: </label>
                                </div>
                                <div class="col-md-3 pl-0">
                                    <input class="form-control  form-control-sm" v-model="bankDate" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.bankDate.$error}" style="margin-left: 18px;min-width: 169px;" name="txtDate2" type="date">
                                    <!-- <div v-if="$v.bankDate.$error" >
                                        <p class="text-danger" style="margin-left:20px" v-if="!$v.bankDate.required">Please specify the date</p>
                                    </div> -->
                                </div>
                            </div>

                            <hr>
                        </fieldset>
                        <fieldset id="section2"  v-show="isSelected == 'Customers' || 'Vendors' || 'Bank'">
                            <h5>Customer Details</h5>
                            <br>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Name</label>
                                    <div class="col-md-6 pl-0">
                                <Select :options="customers" :class="{'date-invalid':$v.customerName.$error}" @input="getCustomer()" :disabled=" isCompleted || cancelled" v-model="customerName" label="text" ></Select>
                                <!-- <div v-if="$v.customerName.$error" >
                                        <p class="text-danger" v-if="!$v.customerName.required">Please select Customer</p>
                                </div> -->
                                    </div>
                                    <div class="col-md-2">
                                    <input type="button" class="btn btn-primary" data-toggle="modal" data-target="#customerModal" :disabled=" isCompleted || cancelled" style="margin-left:10px" value="Add">
                                    </div>
                            </div>
                            <div class="modal fade bd-example-modal-2" tabindex="-1" role="dialog" id="customerModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add new Customers</h5>
                                            <button :disabled=" isCompleted || cancelled" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form enctype="multipart/form-data" >

                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="recipient-name" class="col-form-label">Name:</label>
                                                    <input type="text" v-model="customerName1" :class="{'date-invalid':$v.customerName1.$error}" :disabled=" isCompleted || cancelled" class="form-control">
                                                    <!-- <div v-if="$v.customerName1.$error" >
                                                            <p class="text-danger" v-if="!$v.customerName1.required">Please input customer name</p>
                                                        </div> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="message-text" class="col-form-label">Code:</label>
                                                    <input type="text" v-model="customerCode1" :class="{'date-invalid':$v.customerCode1.$error}" :disabled=" isCompleted || cancelled" class="form-control">
                                                    <!-- <div v-if="$v.customerCode1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerCode1.required">Please input customer code</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="recipient-name"  class="col-form-label">City:</label>
                                                <Select :options="cities" label="text" v-model="customerCity" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerCity.$error}"></Select>
                                                <!-- <div v-if="$v.customerCity.$error" >
                                                        <p class="text-danger" v-if="!$v.customerCity.required">Please input customer city</p>
                                                    </div> -->
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Address:</label>
                                                <input v-model="customerAddress1" class="form-control" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerAddress1.$error}">
                                                <!-- <div v-if="$v.customerAddress1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerAddress1.required">Please input customer address</p>
                                                    </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Phone:</label>
                                                        <input type="number" v-model="customerPhone1" :disabled=" isCompleted || cancelled" class="form-control" :class="{'date-invalid':$v.customerPhone1.$error}">
                                                        <!-- <div v-if="$v.customerPhone1.$error" >
                                                            <p class="text-danger" v-if="!$v.customerPhone1.required">Please input customer phone number</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="recipient-name" class="col-form-label">Fax:</label>
                                                        <input type="text" v-model="customerFax1" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerFax1.$error}" class="form-control">
                                                        <!-- <div v-if="$v.customerFax1.$error" >
                                                            <p class="text-danger" v-if="!$v.customerFax1.required">Please input customer fax number</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="recipient-name" class="col-form-label">N.T.N / CNIC:</label>
                                                    <input type="text" v-model="customerCNIC" :disabled=" isCompleted || cancelled" class="form-control" :class="{'date-invalid':$v.customerCNIC.$error}">
                                                    <!-- <div v-if="$v.customerCNIC.$error" >
                                                        <p class="text-danger" v-if="!$v.customerCNIC.required">Please input customer N.T.N or CNIC</p>
                                                    </div> -->
                                                    </div>
                                                <div class="col-md-6">
                                                    <label for="recipient-name" class="col-form-label">Sales Tax No:</label>
                                                    <input type="text" v-model="customerGst" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerGst.$error}" @change="emptyRegion()"  class="form-control">
                                                    <!-- <div v-if="$v.customerGst.$error" >
                                                        <p class="text-danger" v-if="!$v.customerGst.required">Please input tax no</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="recipient-name" class="col-form-label">Contact Person:</label>
                                                    <input type="text" v-model="customerPerson" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerPerson.$error}" class="form-control">
                                                <!-- <div v-if="$v.customerPerson.$error" >
                                                        <p class="text-danger" v-if="!$v.customerPerson.required">Please input contact person</p>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="recipient-name" class="col-form-label">Designation:</label>
                                                    <input type="text" v-model="customerDesignation1" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerDesignation1.$error}" class="form-control">
                                                <!-- <div v-if="$v.customerDesignation1.$error" >
                                                        <p class="text-danger" v-if="!$v.customerDesignation1.required">Please input contact person designation</p>
                                                    </div> -->
                                                </div>
                                            </div>


                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" @click="addCustomer()" :disabled=" isCompleted || cancelled" class="btn btn-primary">Add Customers</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Representative</label>
                                <div class="col-md-8 pl-0 pr-0">
                                    <input class="form-control form-control-sm" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerRepresent.$error}" type="text" v-model="customerRepresent">
                                    <!-- <div v-if="$v.customerRepresent.$error" >
                                        <p class="text-danger" v-if="!$v.customerRepresent.required">Please input customer representative</p>
                                </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Designation/Dept</label>
                                <div class="col-md-8 pl-0 pr-0">
                                <input class="form-control form-control-sm" :disabled=" isCompleted || cancelled"  :class="{'date-invalid':$v.customerDesignation.$error}"  v-model="customerDesignation" type="text">
                                <!-- <div v-if="$v.customerDesignation.$error" >
                                    <p class="text-danger" v-if="!$v.customerDesignation.required">Please input customer designation</p>
                                </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Phone</label>
                                <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" :disabled=" isCompleted || cancelled" type="number" :class="{'date-invalid':$v.customerPhone.$error}" v-model="customerPhone">
                                <!-- <div v-if="$v.customerPhone.$error" >
                                    <p class="text-danger" v-if="!$v.customerPhone.required">Please input customer phone-number</p>
                                </div> -->
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Fax</label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" :disabled=" isCompleted || cancelled" v-model="ibrCustomerFax" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Email</label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" :disabled=" isCompleted || cancelled" type="email" :class="{'date-invalid':$v.customerEmail.$error}"  v-model="customerEmail">
                                    <!-- <div v-if="$v.customerEmail.$error" >
                                        <p class="text-danger" v-if="!$v.customerEmail.required">Please input customer email address</p>
                                            <p class="text-danger" v-if="!$v.customerEmail.email">Please input valid email address</p>

                                    </div> -->
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <!-- Bank, Customer & Vendor Details -->

                    <!-- Job Details -->
                    <div id="jobDetails">
                        <hr>
                        <h5>Job Details</h5>
                        <br>
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Main Category: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select v-model="category" :options="categories" :class="{'date-invalid':$v.category.$error}" label="text" @input="getSubcategory()"></Select>
                            <!-- <div v-if="$v.category.$error" >
                                        <p class="text-danger" v-if="!$v.category.required">Please select main category</p>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Category: </label>
                                    <div class="col-md-6 pl-0 pr-0">
                                        <Select  label="text"   :class="{'date-invalid':$v.subcategory.$error}" :options="subcategories"  v-model="subcategory"></Select>
                                        <!-- <div v-if="$v.subcategory.$error" >
                                            <p class="text-danger" v-if="!$v.subcategory.required">Please select category</p>
                                        </div> -->
                                    </div>
                                    <div class=" col-md-2 " >
                                        <div class="form-check mt-2 ml-4">
                                            <input type="checkbox" class="form-check-input" v-model="isCorporate" >
                                            <label for="form-check-label"> Corporate</label>
                                        </div>
                                    </div>
                        </div>

                        <fieldset v-show="subcategory.text == 'Land, Building, Plant & Machinery' || subcategory.text == 'Plant, Machinery & Equipment'">
                                <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio mb-5">
                                            <input type="radio" v-model.trim="selectedCatType"  id="custRadio1" name="cat" value="Done By Branch"  class="custom-control-input">
                                            <label class="custom-control-label" for="custRadio1">Done By Branch</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control  custom-radio mb-5">
                                            <input type="radio" style="background-color:red !important" v-model.trim="selectedCatType" id="custRadio2" name="cat" value="Finalized By PET"  class="custom-control-input">
                                            <label class="custom-control-label"  for="custRadio2">Finalized by PET</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio mb-5">
                                            <input type="radio" v-model.trim="selectedCatType" id="custRadio3" name="cat" value="Done By PET"  class="custom-control-input">
                                            <label class="custom-control-label" for="custRadio3">Done by PET</label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- <div v-if="$v.selected.$error">
                                        <p class=" text-danger" v-if="!$v.selected.required">Please Select this Option</p>
                                    </div> -->
                                </div>
                            </div>

                        </fieldset>

                        <fieldset v-show="subcategory.text == 'Desktop' || subcategory.text == 'Drive By'">

                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Sub Category: </label>
                                    <div class="col-md-8 pl-0 pr-0">
                                        <Select  label="text"  :class="{'date-invalid':$v.selectedBank.$error}" :options="subsubcategories"  v-model="subsubcategory"></Select>
                                        <!-- <div v-if="$v.selectedBank.$error" >
                                            <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                                        </div> -->
                                    </div>

                            </div>

                        </fieldset>




                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Address</label>
                            <div class="col-md-8" style="padding-left:0px;padding-right:0px">
                                <textarea type="text" name="" v-model="vaddress" :class="{'date-invalid':$v.vaddress.$error}"  cols="30" rows="2" class=" form-control form-control-sm" style="height:60px"></textarea>
                                <!-- <div v-if="$v.vaddress.$error" >
                                <p class="text-danger" v-if="!$v.vaddress.required">Please input address</p>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Street: </label>
                            <input type="text" v-model="vstreet"  class="form-control form-control-sm col-md-3">

                            <label class="col-md-2 col-form-label">P.O Box: </label>
                            <input class="form-control  form-control-sm col-md-3 pr-0" v-model="vpobox"   type="text">
                        </div>
                        <div class="form-group row">


                            <label class="col-md-3 col-form-label">City: </label>
                            <input type="text"  v-model="vcity"  :class="{'date-invalid':$v.vcity.$error}" class="form-control form-control-sm col-md-3">

                            <label class="col-md-2 col-form-label">Postal Code: </label>
                            <input class="form-control  form-control-sm col-md-3 pr-0" v-model="vpostalcode"  type="text">
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">District: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select v-model="district" :class="{'date-invalid':$v.district.$error}" :options="districts" label="text" ></Select>
                            <!-- <div v-if="$v.district.$error" >
                                        <p class="text-danger" v-if="!$v.district.required">Please select some district</p>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Operational Branch: </label>
                            <div class="col-md-6 pl-0 pr-0">
                                <Select  label="text"   :options="regions"   v-model="operationalBranch"></Select>
                            </div>
                            <div class=" col-md-2 " >
                                <div class="form-check mt-2 ml-4">
                                    <input type="checkbox" class="form-check-input" v-model="isConsultancy" >
                                    <label for="form-check-label"> Consultancy</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Consultant: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select v-model="consultant" :options="consultants" :class="{'date-invalid':$v.ibrCountry.$error}" label="text" ></Select>
                            <!-- <div v-if="$v.ibrCountry.$error" >
                                        <p class="text-danger" v-if="!$v.ibrCountry.required">Please select some country</p>
                                </div> -->
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Service Charges: </label>
                            <div class="col-md-4 pl-0 pr-0">
                                <input  class="form-control form-control-sm"   :class="{'date-invalid':$v.serviceCharge.$error}"   v-model="serviceCharge" type="number">
                                <!-- <div v-if="$v.serviceCharge.$error" >
                                    <p class="text-danger" v-if="!$v.serviceCharge.required">Please select services charges</p>
                                </div> -->
                            </div>
                            <div class=" col-md-2 " >
                                <div class="form-check mt-2 ml-4">
                                    <input type="checkbox" class="form-check-input"  v-model="isSalesTax" >
                                    <label for="form-check-label"> Sales Tax?</label>
                                </div>
                            </div>
                            <div class=" col-md-2 " v-show="isSalesTax == true" >
                                <div class="form-check mt-2 ml-4">
                                    <input type="checkbox" class="form-check-input" @change="getBanksByIslam()" v-model="isFull" >
                                    <label for="form-check-label"> On Full?</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Out of Pockets: </label>
                            <div class="col-md-5 pl-0 pr-0">
                                <input   class="form-control form-control-sm"  :class="{'date-invalid':$v.outOfPockets.$error}"  v-model="outOfPockets" type="number">
                                <!-- <div v-if="$v.outOfPockets.$error" >
                                    <p class="text-danger" v-if="!$v.outOfPockets.required">Please input out of pocket charges</p>
                                </div> -->
                            </div>
                            <div class=" col-md-3 " >
                                <div class="form-check mt-2 ml-4">
                                    <input type="checkbox" class="form-check-input" @change="getBanksByIslam()" v-model="isBycpu" >
                                    <label for="form-check-label"> Prepared By CPU?</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">

                            <div class="col-md-3">
                                <label class="form-label">Asset Class: </label>
                            </div>
                            <div class="col-md-3 pl-0" >
                            <input type="text" v-model="assetClass" class="form-control form-control-sm"  :class="{'date-invalid':$v.assetClass.$error}">
                                <!-- <div v-if="$v.assetClass.$error" >
                                    <p class="text-danger" v-if="!$v.assetClass.required">Please input asset class</p>
                                </div> -->
                            </div>

                            <div class="col-md-2">
                                <label class="form-label mt-2">No of Pages: </label>
                            </div>
                            <div class="col-md-3 pl-0 ">
                                <input class="form-control  form-control-sm" v-model="noOfPages"  style="margin-left: 18px;min-width: 169px;" name="txtDate2" type="number">

                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label class="form-label">Conducted By: </label>
                            </div>
                            <div class="col-md-8 pl-0" >
                                <Select :options="employees" v-model="employee" :disabled=" isCompleted || cancelled"   label="text"></Select>
                            </div>

                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Survey Team: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="surveyTeam" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">D/C Team: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="dcTeam" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Signing Team: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="signTeam" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Final Draft: </label>
                            <div class="col-md-7 pl-0 pr-0" >
                                <input class="form-control form-control-sm" @change="addFinal()" ref="final"  type="file">
                            </div>
                            <div class="col-md-1 pr-0" >
                                <input type="button" class="btn btn-primary" :disabled="!finalDocument"  @click="viewFinalReport()" value="......">
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


                        <!-- Vehicle Details Details -->
                        <fieldset v-show="category.text == 'Vehicle'">
                            <hr>
                            <h5>Vehicle's Details</h5>
                            <br>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Make: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" v-model="carMake"  type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Reg No: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm"  v-model="carRegNo" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Engine No: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" v-model="carEngineNo" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Chassis No: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" v-model="carChassisNo" type="text">
                                </div>
                            </div>
                        </fieldset>
                        <!-- Vehicle Details Details -->


                        <!-- Valuation Details -->
                        <fieldset>
                            <hr>
                            <h5>Valuation Details</h5>
                            <br>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Total Assessed Value: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" v-model="totalAssesedValue"  type="number">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                <div class="col-md-6 pl-0 pr-0" >
                                    <input class="form-control form-control-sm"  v-model="totalAssessPercent" type="number">
                                </div>
                                <div class="col-md-2">
                                    <input type="checkbox" v-model="inPercentage" class="form-check-input ml-3 mt-2"  style="width: 20px; height: 20px;" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                <div class="col-md-8 pl-0 pr-0" >
                                    <input class="form-control form-control-sm" v-model="calculatedFSV" type="number">
                                </div>
                            </div>
                        </fieldset>
                        <!-- Valuation Details -->

                    </div>
                    <!-- Job Details -->

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
                                    <div class="container" v-show="loading" >
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
                    <!-- Final Draft Modal -->

                    <!-- Report Generate Modal -->

                    <component

                        :is="'report-generator'"
                        :token="usertoken"
                        :id="id"
                        :bank="selectedBank.text"
                      ></component>

                    <!-- Report Generate Modal -->

                    <!--Extract Details  -->
                    <div class="modal fade" id="extractedDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" style="max-width:95%" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Update Extract Information</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="recipient-name"  class="col-form-label">For Report Generation, Move this Job to:</label>
                                        <Select :options="cities" Class="ml-3" label="text" v-model="customerCity" :disabled=" isCompleted || cancelled" :class="{'date-invalid':$v.customerCity.$error}"></Select>
                                        <!-- <div v-if="$v.customerCity.$error" >
                                                <p class="text-danger" v-if="!$v.customerCity.required">Please input customer city</p>
                                            </div> -->
                                    </div>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">General Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Documents Extract</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Market Search</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="false">Uploads</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="images-tab" data-toggle="tab" href="#images" role="tab" aria-controls="images" aria-selected="false">Images</a>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <!-- General Information -->
                                        <div class="tab-pane fade show active" style="padding:20px 10px 5px 10px" id="home" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Account Name: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Name of Bank: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Concerned Bank: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Request Date: </label>
                                                <div class="col-md-4 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label">Reference: </label>
                                                <div class="col-md-4 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Survey Date: </label>
                                                <div class="col-md-4 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label">Apprised By: </label>
                                                <div class="col-md-4 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Property Address: </label>
                                                <div class="col-md-10 " >
                                                <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Property Category: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Property Status: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Occupation Status: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Compiled By: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Reviewd By: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Data Collection Team: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                        </div>

                                        <!-- Document Expired -->
                                        <div class="tab-pane fade" id="profile" style="padding:20px 10px 5px 10px" role="tabpanel" aria-labelledby="profile-tab">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Account Name: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">List of Documents: </label>


                                                <div class="col-md-1" style="max-width: 2.333333%;">
                                                <label for="" style=" margin-top: 4px;font-size: 18px;"><b> 1:)</b></label>
                                                </div>
                                                <div class="col-md-3 " >
                                                <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-1 col-form-label">Date: </label>
                                                <div class="col-md-2 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label" style="max-width:10.666667%;">Provided By: </label>
                                                <div class="col-md-2 " >
                                                <div class="row" style="margin-top:10px">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" v-model.trim="selected"  id="customRadio1" @change="clear1()" name="type" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control  custom-radio mb-5">
                                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="selected" :disabled=" isCompleted || cancelled" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label"> </label>


                                                <div class="col-md-1" style="max-width: 2.333333%;">
                                                <label for="" style=" margin-top: 4px;font-size: 18px;"><b> 2:)</b></label>
                                                </div>
                                                <div class="col-md-3 " >
                                                <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-1 col-form-label">Date: </label>
                                                <div class="col-md-2 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label" style="max-width:10.666667%;">Provided By: </label>
                                                <div class="col-md-2 " >
                                                <div class="row" style="margin-top:10px">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" v-model.trim="selected"  id="customRadio1" @change="clear1()" name="type" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control  custom-radio mb-5">
                                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="selected" :disabled=" isCompleted || cancelled" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label"> </label>


                                                <div class="col-md-1" style="max-width: 2.333333%;">
                                                <label for="" style=" margin-top: 4px;font-size: 18px;"><b> 3:)</b></label>
                                                </div>
                                                <div class="col-md-3 " >
                                                <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-1 col-form-label">Date: </label>
                                                <div class="col-md-2 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label" style="max-width:10.666667%;">Provided By: </label>
                                                <div class="col-md-2 " >
                                                <div class="row" style="margin-top:10px">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" v-model.trim="selected"  id="customRadio1" @change="clear1()" name="type" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control  custom-radio mb-5">
                                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="selected" :disabled=" isCompleted || cancelled" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label"> </label>


                                                <div class="col-md-1" style="max-width: 2.333333%;">
                                                <label for="" style=" margin-top: 4px;font-size: 18px;"><b> 4:)</b></label>
                                                </div>
                                                <div class="col-md-3 " >
                                                <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-1 col-form-label">Date: </label>
                                                <div class="col-md-2 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label" style="max-width:10.666667%;">Provided By: </label>
                                                <div class="col-md-2 " >
                                                <div class="row" style="margin-top:10px">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" v-model.trim="selected"  id="customRadio1" @change="clear1()" name="type" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control  custom-radio mb-5">
                                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="selected" :disabled=" isCompleted || cancelled" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label"> </label>


                                                <div class="col-md-1" style="max-width: 2.333333%;">
                                                <label for="" style=" margin-top: 4px;font-size: 18px;"><b> 5:)</b></label>
                                                </div>
                                                <div class="col-md-3 " >
                                                <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-1 col-form-label">Date: </label>
                                                <div class="col-md-2 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="date">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label" style="max-width:10.666667%;">Provided By: </label>
                                                <div class="col-md-2 " >
                                                <div class="row" style="margin-top:10px">
                                                        <div class="col-md-6">
                                                            <div class="custom-control custom-radio mb-5">
                                                            <input type="radio" v-model.trim="selected"  id="customRadio1" @change="clear1()" name="type" value="Bank" :disabled=" isCompleted || cancelled"  class="custom-control-input">
                                                            <label class="custom-control-label" for="customRadio1">Bank</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="custom-control  custom-radio mb-5">
                                                            <input type="radio" style="background-color:red !important" @change="clear2()" v-model.trim="selected" :disabled=" isCompleted || cancelled" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                            <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Total Land Area: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Total Covered Area: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Ownership: </label>
                                                <div class="col-md-10 " >
                                                <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>

                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Property Type: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Details of Covered Area: </label>
                                                <div class="col-md-10 " >
                                                <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>

                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Reviewd By: </label>
                                                <div class="col-md-10 " >
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                            </div>


                                        </div>

                                        <!-- Market Search -->
                                        <div class="tab-pane fade" id="contact" role="tabpane3" style="padding:20px 10px 5px 10px" aria-labelledby="contact-tab">

                                            <fieldset style="border:1px solid #e9ecef;;padding:20px 10px 5px 10px">
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Surveyor:  </label>

                                                    <div class="col-md-8 pl-0 pr-0">
                                                        <Select id="company"  label="text" :class="{'invalid':$v.company.$error}" v-model="company" :disabled=" isCompleted || cancelled" :options="companies" ></Select>
                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Mark Search Finalized by: </label>

                                                    <div class="col-md-8 pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Final Value: </label>

                                                    <div class="col-md-3     pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset style="border:1px solid #e9ecef;;padding:20px 10px 5px 10px;margin-top:25px" >
                                            <h5 class="pb-3">Illustration (1)</h5>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Estate Agent: </label>

                                                    <div class="col-md-8 pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Contact No: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Current Market: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (A): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (B): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Last Transaction: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Remarks: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset style="border:1px solid #e9ecef;;padding:20px 10px 5px 10px;margin-top:25px" >
                                            <h5 class="pb-3">Illustration (2)</h5>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Estate Agent: </label>

                                                    <div class="col-md-8 pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Contact No: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Current Market: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (A): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (B): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Last Transaction: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Remarks: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <fieldset style="border:1px solid #e9ecef;;padding:20px 10px 5px 10px;margin-top:25px" >
                                            <h5 class="pb-3">Illustration (3)</h5>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Estate Agent: </label>

                                                    <div class="col-md-8 pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Contact No: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <input  class="form-control  form-control-sm"  v-model="bankRepresentative" :class="{'date-invalid':$v.bankRepresentative.$error}"   type="text">

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Current Market: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:100px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (A): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Availability (B): </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Last Transaction: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" >
                                                    <label class="col-md-3" for="company">Remarks: </label>

                                                    <div class="col-md-8     pl-0 pr-0">
                                                    <textarea name="" id="" class="form-control" cols="30" rows="9" style="height:50px"></textarea>

                                                        <!-- <div v-if="$v.company.$error" >
                                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            </fieldset>
                                        </div>
                                        <!-- Upload -->
                                        <div class="tab-pane fade" id="upload" style="padding:20px 10px 5px 10px" role="tabpane4" aria-labelledby="upload-tab">

                                            <div class="form-group row" >
                                                <label class="col-md-2" for="company">Survey Profoma: </label>

                                                <div class="col-md-9 pl-0 pr-0">
                                                <input  class="form-control  form-control-sm"  :class="{'date-invalid':$v.bankRepresentative.$error}"   type="file">

                                                </div>
                                            </div>

                                            <div class="form-group row" >
                                                <label class="col-md-2" for="company">Other Documents: </label>

                                                <div class="col-md-9 pl-0 pr-0">
                                                <input  class="form-control  form-control-sm"   :class="{'date-invalid':$v.bankRepresentative.$error}"   type="file">

                                                </div>
                                            </div>


                                        </div>

                                        <!-- Images -->
                                        <div class="tab-pane fade" id="images" style="padding:20px 10px 5px 10px" role="tabpane5" aria-labelledby="images-tab">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Upload Photo: </label>
                                                <div class="col-md-4 " >
                                                    <input  class="form-control  form-control-sm"  :class="{'date-invalid':$v.bankRepresentative.$error}"   type="file">
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <label class="col-md-2 col-form-label">Reference: </label>
                                                <div class="col-md-3 " >
                                                    <Select name="" id=""></Select>
                                                    <!-- <div v-if="$v.bankRepresentative.$error" >
                                                        <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-1">
                                                    <button class="btn btn-primary">Upload</button>
                                                </div>
                                            </div>

                                            <table class="table">
                                                <thead class="thead-dark">
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            <table class="table">
                                                <thead class="thead-light">
                                                    <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">First</th>
                                                    <th scope="col">Last</th>
                                                    <th scope="col">Handle</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                    <th scope="row">1</th>
                                                    <td>Mark</td>
                                                    <td>Otto</td>
                                                    <td>@mdo</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">2</th>
                                                    <td>Jacob</td>
                                                    <td>Thornton</td>
                                                    <td>@fat</td>
                                                    </tr>
                                                    <tr>
                                                    <th scope="row">3</th>
                                                    <td>Larry</td>
                                                    <td>the Bird</td>
                                                    <td>@twitter</td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Extract Details  -->


                    <!-- Buttons -->
                    <div class="form-check mt-2">
                        <input type="checkbox" class="form-check-input"  :disabled=" isCompleted || cancelled" v-model="btype" >
                        <label for="form-check-label">Letter Head?</label>
                    </div>
                    <input type="button" @click="onComplete()" class="btn btn-primary mb-1"   value="Save">
                    <a href="/home"><input type="button"  class="btn btn-primary mb-1" value="Ignore"></a>
                    <input type="button"  class="btn btn-primary mb-1"  :disabled="isCompleted || cancelled" data-toggle="modal" data-target="#commentsModal" value="Comments">
                    <input type="button"  @click="getReportModal()" class="btn btn-primary mb-1" value="Generate Report">
                    <input type="button" @click="printBill()" v-show="completed" class="btn btn-primary mb-1" value="Print Bill">
                    <input type="button"  class="btn btn-primary mb-1" disabled value="Print Sales Tax Invoice">
                    <input type="button"  class="btn btn-primary mb-1" disabled value="Send Confirmation Email">
                    <input type="button"  class="btn btn-primary mb-1" :disabled=" isCompleted || cancelled" value="Cancel Job" data-toggle="modal" data-target="#cancelModal">
                    <!-- Buttons -->

                </form>
            </div>
            <!-- Main Detail Fields -->


        </div>
    </div>
</template>
<script>
var today = new Date().toISOString().split('T')[0];
document.getElementsByName("txtDate")[0].setAttribute('min', today);
document.getElementsByName("txtDate3")[0].setAttribute('min', today);
</script>
<script>

import { required, minLength, between,email } from 'vuelidate/lib/validators'
import axios from 'axios'
import vSelect from 'vue-select'
import Autocomplete from '@trevoreyre/autocomplete-vue'
import ReportGenerator from './Reports/Vehicles/ReportGenerator.vue';
import '@trevoreyre/autocomplete-vue/dist/style.css'
import 'vue-select/dist/vue-select.css'
  export default {
        props:{
          id:String,
          jobid:String,
          common:String,
          cmpny:String,
          usertoken:String
  },
      components:{
          'Select':vSelect,
          Autocomplete,
          'report-generator':ReportGenerator
      },
     data() {
       return {
        title:'',
        subtitle:'',
        name:'',
        btype:false,
        duplicate:'',
        duplicateIds:[],
        selected:'',
        isSelected:'',
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
        categories:[],
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
        serviceCharge:0,
        regionSale:'',
        delivery:'',
        taxRate:'',
        saleReg:'',
        istentative:'',
        tentativeType:'',
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
        ibrCompany:'',
        subcategories:[],
        subcategory:'',
        category:'',
        operationalBranch:'',
        consultants:[],
        consultant:'',
        districts:[],
        district:'',
        outOfPockets:0,
        subsubcategory:'',
        subsubcategories:[
            {text:'Bungalow'},
            {text:'Flat'},
            {text:'House'},
            {text:'Land & Building'},
            {text:'Land, Building, Plant & Machinery'},
            {text:'Office'},
            {text:'Plot/Land'},
            {text:'Shop'}
        ],
        employees:[],
        employee:'',
        isCorporate:false,
        isConsultancy:false,
        isCompleted:false,
        cancelled:false,
        isSalesTax:false,
        isFull:false,
        isBycpu:false,
        assetClass:'',
        selectedCatType:'',
        vstreet:'',
        vaddress:'',
        vpobox:'',
        vpostalcode:'',
        vcity:'',
        noOfPages:'',
        surveyTeam:'',
        dcTeam:'',
        signTeam:'',
        carMake:'',
        carRegNo:'',
        carEngineNo:'',
        carChassisNo:'',
        status:'',
        valuator:'',
        totalAssesedValue:'',
        totalAssessPercent:'',
        delayed:'',
        loading:true,
        finalDocument:true,
        completed:'',
        requestedDate:'',
        deliverOn:'',
        file:'',
        inPercentage:false,
        reportComponent:false,
        loader:'',
        finalDraft:'',
        documents:[],
        path:'',
        token:'',
        billDate:'',
        selectedComponent:false





       }
    },
    mounted(){


        this.loader=document.location.origin+'/images/loader.gif';
        this.getValuationJob();
        this.path=document.location.origin+'/Reports/Valuation/'+this.id+'/';



    },
    computed:{
        calculatedFSV(){
            if(this.inPercentage==true)
            {
                let totalAmount= this.totalAssesedValue;
                var hnd=100;
                let percent = this.totalAssessPercent;

                let finalAmount=percent / hnd * totalAmount;
                return  totalAmount - finalAmount;

            }
            else
            {
                return this.totalAssesedValue - this.totalAssessPercent;

            }
        }
    },
    methods: {
        getValuationJob(){
        axios.get('/getValuationJob/' + this.id)
        .then(res=>{
            console.log(res.data);
            res.data.job.forEach((obj)=>{

                this.company={text:obj.job_company,value:obj.job_by};
                this.region={text:obj.region,value:obj.region_id};
                this.branch={text:obj.op_branch,value:obj.operational_branch};
                // this.date=obj.expiry,
                // this.reqdate=obj.requested_date,
                this.isSelected=obj.given_by;
                this.selectedBank={text:obj.bank_name,value:obj.bank_id};
                this.bankBranch={text:obj.branch_name,value:obj.branch_id};
                this.billingAddress=obj.bank_address;
                this.bankRepresentative=obj.bank_representative;
                this.bankDesignation=obj.bank_designation;
                this.bankPhone=obj.bank_phone;
                this.ibrBranchFax=obj.bank_fax;
                this.bankletterNo=obj.bank_letter;
                this.bankEmail=obj.bank_email;
                this.bankDate=obj.bank_letter_date;
                this.customerName={text:obj.cust_name,value:obj.customer_id};
                this.customerRepresent=obj.customer_representative;
                this.customerDesignation=obj.customer_designation;
                this.customerPhone=obj.customer_phone;
                this.ibrCustomerFax=obj.customer_fax;
                this.customerEmail=obj.customer_email;
                this.vendor={text:obj.name,value:obj.byvendor_id};
                this.vendorRepresent=obj.byvendor_representative;
                this.vendorDesignation=obj.byvendor_designation;
                this.vendorPhone=obj.byvendor_phone;
                this.vendorFax=obj.byvendor_fax;
                this.vendorEmail=obj.byvendor_email;
                this.vendorAddress=obj.byvendor_address;
                this.vendorLetter=obj.byvendor_letter;
                this.vendorExpiry=obj.vendor_letter_date;
                this.category={text:obj.valuation_description,value:obj.main_category};
                this.subcategory={text:obj.subcat_description,value:obj.category};
                this.selectedCatType=obj.sub_cat_type;
                this.subsubcategory=obj.sub_category;
                this.vaddress=obj.address;
                this.vstreet=obj.street;
                this.vpobox=obj.pobox;
                this.vcity=obj.city;
                this.vpostalcode=obj.postalcode;
                this.district={text:obj.district_name,value:obj.district};
                this.operationalBranch={text:obj.op_branch,value:obj.operational_branch};
                this.isConsultancy=obj.consultancy ==1 ? true:false;
                this.isCorporate=obj.corporate ==1 ? true:false;
                this.consultant={text:obj.consultant_name,value:obj.consultant};
                this.isSalesTax=obj.isSales ==1 ? true:false;
                this.isFull=obj.STonfull ==1 ? true:false;
                this.isBycpu=obj.cpu ==1 ? true:false;
                this.finalDocument=obj.final;
                this.serviceCharge=obj.service_charges;
                this.outOfPockets=obj.pocket;
                this.assetClass=obj.asset_class;
                this.noOfPages=obj.pages;
                this.employee={text:obj.employee_name,value:obj.employee};
                this.valuator=obj.valuator;
                this.surveyTeam=obj.survey_team;
                this.signTeam=obj.signing_team;
                this.dcTeam=obj.dc_team;
                this.totalAssesedValue=obj.value;
                this.totalAssessPercent=obj.fsv_rate;
                this.inPercentage=obj.fsv_type;
                this.calculateAsses=obj.fsv_calculated;
                this.completed=obj.completed===1 ? true:false;
                this.delayed=obj.customer_delay===1 ? true:false;
                this.dcTeam=obj.dc_team;
                this.requestedDate=obj.request_date;
                this.deliverOn=obj.delivery_date;
                this.selectedCatType=obj.sub_cat_type;
                this.subsubcategory={text:obj.sub_category};

                this.getCompany();
                this.getRegion();
                this.getBanks();
                this.getCustomers();
                this.getCity();
                this.getVendors();
                this.getCategories();
                this.getSubcategory();
                this.getConsultants();
                this.getDistricts();
                this.getEmployees();



                if(obj.completed==1)
                {
                   this.status='Completed';
                }

                else{
                    this.status='Running';
                }

                if(obj.customer_delay==1)
                {
                   this.status='Delayed By Customer';

                }

                if(obj.cancalled==1){
                    this.status="Cancelled";
                }






            })
             res.data.vehicle.forEach((obj)=>{
                    this.carMake=obj.make;
                    this.carRegNo=obj.reg_no;
                    this.carEngineNo=obj.engine_no;
                    this.carChassisNo=obj.chassis_no ;
                })
        })

   },
 addFinal(){
       this.finalDraft="";

        this.file = this.$refs.final.files[0];

         let formData = new FormData();
        formData.append('myfile', this.file);
        formData.append('job_id', this.id);
        formData.append('jid', this.jobid);

        this.loading=true;
        axios.post('/uploadFinal',formData).then(res=>{


                if(res.data=="Unsupported")
                {
                    alert('Unsupported');
                }

                else{
                $('#finalDraftModal').modal('show');
                this.loading=false;
                this.finalDocument=true;
                this.finalDraft=document.location.origin  + res.data;




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
    formData.append('jid', this.jobid);


        axios.post('/uploadDocuments',formData).then(res=>{
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
    getConsultants(){


            this.consultants=[];


            axios.get("/api/getConsultants/",{
                      headers: {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.consultants.push(
                            {
                                text:obj.description,
                                value:obj.id

                                }
                            );
                    })
                })
                .catch(error => {

                console.log(error.response);


                });

        },

        getEmployees(){


            this.employees=[];


            axios.get("/api/getEmployees/",{
                      headers: {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.employees.push(
                            {
                                text:obj.name,
                                value:obj.id

                                }
                            );
                    })
                })
                .catch(error => {

                console.log(error.response);


                });

        },

            getDistricts(){
        axios.get('/api/getDistricts',{
                      headers: {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.districts.push({ text:obj.description,value:obj.id})

                        })
                    })

    },


    addComment(){
         if(this.$v.comment.$invalid)
        {
            this.$v.comment.$touch();
            var isValid = !this.$v.comment.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else{
     let formData={
         jobid:this.jobid,
         message:this.jobMessage,
         date:this.jobDate,
         activity:this.jobActivity,
         client:this.isClient
     };

    axios.post('/addComment',formData).then(res=>{
        alert("Job Progress Updated");
         $('#commentsModal').modal('hide');
       }).catch(error=>{
           alert('Something Went Wrong Please Check');



       });

        }

    },

    viewFinalReport(){
        this.finalDraft="";
        this.loading=true;
        axios.get('/getFinalReport/' +this.id)
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

    viewOtherDocuments(){
    //    this.finalDraft="";
            // this.finalDraft=document.location.origin+'/Reports/Valuation/'+this.id+'/final.pdf';
             axios.get('/getFiles/' +this.id)
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
    getReportModal(){

            $('#reportModal').modal('show');




            // this.finalDraft=document.location.origin+'/Reports/Valuation/'+this.id+'/final.pdf';
            // this.getDocuments();

   },
    getImage(){
       this.pdf="";
        this.file = this.$refs.original.files[0];

         let formData = new FormData();
    formData.append('myfile', this.file);
    formData.append('job_id', this.id);
    formData.append('jid', this.jobid);


    axios.post('/printReport',formData).then(res=>{


            if(res.data=="Unsupported")
            {
                alert('File is not supported');
            }

            else{
                    $('#ReportModal').modal('show');
                    this.pdf=document.location.origin+'/Reports/IBR/'+this.id+'/' + res.data;
            }

       }).catch(error=>{
           alert("File Type is not supported");



       });

    },


    printBill(){


         var billData={
            id:this.id,
            jobid:this.jobid,
            bank:this.selectedBank.text,
            address:this.billingAddress,
            company_address:this.companyAddress,
            bank_letter:this.bankletterNo,
            bank_date:this.bankDate,
            service:this.serviceCharge,
            exchange:this.exRates,
            sales:this.saleReg.value,
            customer:this.customerName.text,
            vendor:this.vendor.text,
            customerAddress:this.customerAddress,
            vendorAddress:this.vendorAddress,
            region:this.region.value,
            customerIs:this.customerName.value,
            branch:this.bankBranch.value,
            vendorletter:this.vendorLetter,
            vendordate:this.vendorDate,
            givenby:this.selected,
            bankID:this.selectedBank.value,
            companyID:this.company.value,
            billDate:this.billDate




             };

             console.log(billData);

        this.bill='';
         $('#billModal').modal('show');
        this.loading=true;
    //     axios.post('/printValBill',billData,{responseType: 'arraybuffer'}).then(res=>{
    //         console.log(billData);
    //         this.loading=false;
    //         // this.bill=document.location.origin+'/Reports/IBR/'+this.id+'/bill.pdf';
    //          var file = new Blob([res.data], {type: 'application/pdf'});
    //         var fileURL = URL.createObjectURL(file);
    //         this.bill=fileURL;

    //    }).catch(error=>{
    //     //    alert('Please complete the info before priniing the bill');
    //     alert(error);
    //     this.loading=false;


    //    });

        axios.post('/printValBill',billData).then(res=>{
            console.log(billData);
            // this.loading=false;
            alert('Bill Generated');

       }).catch(error=>{
        //    alert('Please complete the info before priniing the bill');
        // alert(error);
        // this.loading=false;
        alert('Something Went Wrong');


       });
   },

    onComplete: function(){

        //  var string=this.$refs.ibrCompany.value;
        //  var cmpname=string.replace(/[{()}^0-9-]/g, "");

           axios.put('/updateValuation/' + this.id ,{
        job_by:this.company.value,
        jobid:this.jobid,
        regional_id:this.region.value,
        operational_branch:this.operationalBranch.value,
        expiry:this.date,
        given_by:this.isSelected,
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
        customer_email:this.customerEmail,
        main_category:this.category.value,
        main_category_text:this.category.text,
        category:this.subcategory.value,
        corporate:this.isCorporate,
        sub_cat_type:this.selectedCatType,
        sub_category:this.subsubcategory.text,
        address:this.vaddress,
        street:this.vstreet,
        pobox:this.vpobox,
        city:this.vcity,
        postal_code:this.vpostalcode,
        district:this.district.value,
        is_consultancy:this.isConsultancy,
        consultant:this.consultant.value,
        service_charges:this.serviceCharge,
        is_sales:this.isSalesTax,
        stonfull:this.isFull,
        out_of_pocket:this.outOfPockets,
        cpu:this.isBycpu,
        asset_class:this.assetClass,
        no_of_pages:this.noOfPages,
        employee:this.employee.value,
        survey_team:this.surveyTeam,
        dc_team:this.dcTeam,
        signing_team:this.signTeam,
        total_value:this.totalAssesedValue,
        fsv_rate:this.totalAssessPercent,
        fsv_type:this.inPercentage,
        fsv_calculated:this.calculatedFSV,
        is_completed:this.completed,
        delayed:this.delayed,
        requested_date:this.requestedDate,
        delivery_date:this.deliverOn,
        commonId:this.common,
        jobid:this.jobid,
        car_make:this.carMake,
        reg_no:this.carRegNo,
        engine_no:this.carEngineNo,
        chassis_no:this.carChassisNo




  })
      .then(res=>{
          alert('Job data updated Successfully');
            // window.location.href="/home";
            console.log(res.data);
            // alert(this.completed);
      })
      .catch(error=>{
          alert(error);
      });
   },
    cancelJob: function(){
        if(this.$v.cancel.$invalid)
        {
            this.$v.cancel.$touch();
            var isValid = !this.$v.cancel.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }

        else{

            axios.put('/cancelIbr/' + this.id ,{
               remarks:this.remarks,
               jobid:this.jobid

           })
            .then(res=>{
                alert('Job Was successfully cancelled');
                    window.location.href="/home";


            })
            .catch(error=>{
            });

        }

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
             getCategories(){
                 axios.get('/api/getCategory',{
                      headers: {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                    .then(res=>{
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            this.categories.push({text:obj.description,value:obj.id})
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
        getSubcategory(){
            this.subcategories=[];


                let id=this.category.value;
            axios.get("/api/getSubcategory/" + id,{
                      headers: {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })//with id
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.subcategories.push(
                            {
                                text:obj.description,
                                value:obj.id

                                }
                            );
                    })
                })
                .catch(error => {

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
    vaddress:{
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
    category:{
        required
    },
    subcategory:{
        required
    },
    vcity:{
        required
    },
    district:{
        required
    },
    outOfPockets:{
        required
    },
    assetClass:{
        required
    },
     form1:[
        'selected',
        'company',
        'region',
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
        'category',
        'assetClass',
        'outOfPockets',
        'subcategory',
        'vaddress',
        'district',
        'vcity',
        'serviceCharge'],

          form2:[
        'selected',
        'company',
        'region',
        'customerName',
        'customerPhone',
        'customerEmail',
        'customerDesignation',
        'customerRepresent',
        'category',
        'subcategory',
        'outOfPockets',
        'vaddress',
        'assetClass',
        'vcity',
        'district',
        'serviceCharge'],

          form3:[
        'selected',
        'company',
        'region',
        'customerDesignation',
        'customerRepresent',
        'customerName',
        'customerPhone',
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
        'category',
        'outOfPockets',
        'district',
        'subcategory',
        'vaddress',
        'vcity',
        'assetClass',
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





textarea{
    height:auto;
    max-height:80px
}
.card{
    margin-bottom: 15px !important;
}
</style>
