<template>
     <div class="container-fluid">
    <div class="bg-white border-radius-4 box-shadow mb-30" style="padding:0px 15px 16px 15px">


        <div class="clearfix"  >
            <div class="row" style="background-color:#275129;padding-bottom:15px">
                <div class="col-md-10">
                    <h4 class="text-white  pt-3">Edit Verification Job</h4>
                </div>
                <div class="col-md-2" style="text-align: right;">
                      <a href="/verification" style="margin-top: 12px;margin-left: 50px;
                      color: black;
                    background-color: #ffffff;
                    border-color: #ffffff;
                " class="btn btn-primary">Back</a>
                </div>
            </div>

        <br>
        <!-- <p class="mb-30 font-14">New Inspection Job</p> -->

        </div>
        <div class="row" style="padding: 5px 5px 9px 5px;">

            <div class="col-md-12" style="text-align:left;">
                        <div class="row" style="float:left">
                            <!-- <input type="button" v-on:click="reportModalIs=false"  class="btn btn-primary " data-toggle="modal" data-target="#reportModal" style="margin-left: 10px;" value="Print Full Report"> -->
                            <a :href="/finalverificationreport/+this.id" target="_blank"><input type="button"   class="btn btn-primary"  style="margin-left: 10px;" value="Print Full Report"></a>
                           <!-- <div class="form-check  islamic-check  " style="margin-top: 4px;">
                                <input type="checkbox" class="form-check-input"  v-model="isShowValues" >
                                <label for="form-check-label" style="margin-right:13px;" > Show Value?</label>
                            </div>
                            <div class="form-check  islamic-check  " style="margin-left: 31px;margin-top: 4px;" >
                              <input type="checkbox" class="form-check-input"  v-model="isLetterHead" >
                              <label for="form-check-label"> Letter Head?</label>
                             </div> -->
                        <div class="ml-3">
                            <!-- <a href="/printInsBill" target="_blank">   </a> -->
                            <!-- <input @click="printInsBill()" type="button" v-if="printButton"  class="btn btn-primary" value="Print Bill"> -->

                        </div>
                        <div class="mr-3">
                            <input type="button"  v-if="!isCompleted "  class="btn btn-primary" value="Hold / Delayed" data-toggle="modal" data-target="#HoldModal">

                        </div>

                        <div class="mr-3">
                            <input type="button" v-if="!isCompleted "  class="btn btn-primary" value="Cancel Job" data-toggle="modal" data-target="#cancelModal">

                        </div>
                        <div class="modal fade bd-example-modal-2" id="cancelModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancelling the job .......</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >

                            <form action="" >
                            <div class="row">


                            </div>
                            <label for="">Reason for Cancellation</label>
                                <textarea name="" id="" v-model="cancelRemarks"   class="form-control col-md-12"></textarea>


                        </form>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" @click="cancelJob()" class="btn btn-primary" >Cancel Job</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bd-example-modal-2" id="HoldModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Holding / Delaying the job .......</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >

                            <form action="" >
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-check" style="margin-top: 4px;">
                                    <input type="checkbox" class="form-check-input"   v-model="isHold" >
                                    <label for="form-check-label"  style="margin-right:13px;" > Hold / Delayed</label>
                                    </div>
                                </div>
                            </div>
                            <label for="">Reason for Hold / Delaying</label>
                                <textarea name="" id="" v-model="HoldRemarks"   class="form-control col-md-12"></textarea>


                        </form>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button"  @click="holdJob()" class="btn btn-primary" >Save</button>
                    </div>
                </div>
            </div>
        </div>
                        <!-- <div class="mr-3">
                         <a href="/verification-perfoma">
                             
                               <input type="button"   class="btn btn-primary" value="Perfoma">
                             </a> 

                        </div> -->



                        </div>

            </div>

        </div>
        <div class="modal fade " id="reportModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Verification Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" v-if="!reportModalIs">

                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="padding: 5px 5px 9px 5px;">
            <div class="col-md-4">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Job No: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input class="form-control  form-control-sm" disabled v-model="jobid"    type="text">

                    </div>
                </div>

            </div>

            <div class="col-md-8" >
                <div class="row" >

                    <div class="col-md-2" v-if="isAllSurveyCompleted">
                        <div class="form-check" style="margin-top: 4px;" >
                            <input type="checkbox" class="form-check-input"  v-model="isCompleted" >
                            <label for="form-check-label" style="margin-right:13px;" > Completed?</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label">Delivered: </label>
                            <div class="col-md-6 pl-0 pr-0" >
                            <input class="form-control  form-control-sm"   v-model="delivedOn" type="date">

                            </div>
                        </div>

                    </div>
                    <!-- <div class="col-md-4 ml-auto">
                        <div class="form-check" style="margin-top: 4px;">
                            <input type="checkbox" class="form-check-input"  v-model="prepByCpu" >
                            <label for="form-check-label" style="margin-right:13px;" >Prepared by CPU?</label>
                        </div>
                    </div> -->

                </div>

            </div>

        </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Job Details</a>
            </li>
          


        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- General Information -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form action="" >
                    <div style="border: 2px solid #275129;margin: 0px;padding: 33px;" class="wizard-content pt-4">

                        <div class="row">
                            <div class="col-md-6 col-sm-12" style="border-right:1px solid #646161">
                                    <div id="section1">
                            <div class="form-group row">

                                    <label class="col-md-3 form-label">Type: </label>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio mb-5">
                                                <input type="radio" v-model.trim="selected" disabled  id="customRadio1" name="type" value="Bank" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadio1">Bank</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control  custom-radio mb-5">
                                                <input type="radio" disabled  style="background-color:red !important" v-model.trim="selected" id="customRadio2" name="type" value="Customers"  class="custom-control-input">
                                                <label class="custom-control-label"  for="customRadio2">Customer</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio mb-5">
                                                <input type="radio" disabled v-model.trim="selected" id="customRadio3" name="type" value="Vendors"  class="custom-control-input">
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
                                        <Select id="company"  label="text"  :class="[{'invalid':$v.company.$error},'mySelect']" v-model="company" :options="companies" ></Select>
                                        <div v-if="$v.company.$error" >
                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-md-3">Region: </label>
                                    <div class="col-md-8 pl-0 pr-0">
                                        <Select  label="text" :class="[{'invalid':$v.region.$error},'mySelect']" v-model="region"  :options="regions" ></Select>
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
                                                    <Select  label="text"  v-model="vendor" :class="[{'date-invalid':$v.vendor.$error},'mySelect']" @input="getVendorAddress()" :options="vendors" ></Select>
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
                                                    <label class="col-md-3 col-form-label">Desig/Dept: </label>
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
                                                    <div class="col-md-3 pl-0" >
                                                        <input type="text" class="form-control form-control-sm" :class="{'date-invalid':$v.vendorLetter.$error}" v-model="vendorLetter">
                                                        <div v-if="$v.vendorLetter.$error">
                                                            <p class=" text-danger" v-if="!$v.vendorLetter.required">Please input vendor letter</p>
                                                        </div>
                                                    </div>

                                                    <label class="col-md-1 form-label">Date: </label>
                                                    <div class="col-md-3" >
                                                        <input class="form-control form-control-sm" v-model="vendorExpiry" :class="{'date-invalid':$v.vendorExpiry.$error}"  style="margin-left: 18px;min-width: 152px;" name="txtDate1" type="date">
                                                        <div v-if="$v.vendorExpiry.$error" style="margin-left:20px">
                                                            <p class=" text-danger" v-if="!$v.vendorExpiry.required">Please fill out the date</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr style="background-color:#275129">
                                    </fieldset>
                                    <fieldset id="section1" v-show="selected == 'Bank'">

                                        <h5 >Ordering Bank's Details</h5>
                                        <br>
                                            <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Bank: </label>
                                            <div class="col-md-5" style="padding-left:0px">
                                                <Select disabled  label="text" @input="getBranches()"  :class="[{'date-invalid':$v.selectedBank.$error},'mySelect']" :options="banks"  v-model="selectedBank"></Select>
                                                <div v-if="$v.selectedBank.$error" >
                                                    <p class="text-danger" v-if="!$v.selectedBank.required">Please select some bank</p>
                                                </div>
                                            </div>
                                            <div class=" col-md-2 " >
                                                <div class="form-check  ml-4 islamic-check">
                                                    <input disabled type="checkbox" class="form-check-input" @change="getBanksByIslam()" v-model="btype" >
                                                    <label for="form-check-label"> Islamic</label>
                                                </div>
                                            </div>

                                            <div class="col-md-1 pr-0">
                                            <input type="button" disabled value="Add" class="btn btn-primary "  data-toggle="modal" data-target="#bankModal" style="font-size:12px" >
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
                                                                    <Select :options="types" v-model="bankType"  :class="[{'date-invalid':$v.bankType.$error},'mySelect']" label="text"></Select>
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

                                            <div class="col-md-7 pl-0 pr-0">
                                            <Select disabled label="text" v-model="bankBranch" @input="getAddress()" :class="[{'date-invalid':$v.bankBranch.$error},'mySelect']"  :options="branches" ></Select>
                                            <!--  -->
                                                <div v-if="$v.bankBranch.$error" >
                                                <p class="text-danger" v-if="!$v.bankBranch.required">Please select some branch</p>
                                                </div>
                                            </div>
                                            <div class="col-md-2" style="padding-left:15px !important">
                                                <input disabled type="button" value="Add" class="btn btn-primary branch-btn " data-toggle="modal" data-target=".bd-example-modal-lg" style="margin-left:16px;font-size:12px">
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
                                                            <Select v-model="branchCity"   label="text" :options="cities" :class="[{'date-invalid':$v.branchCity.$error},'mySelect']"></Select>
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
                                            <label class="col-md-3 col-form-label">Desig/Dept: </label>
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
                                            <div class="col-md-3 pl-0" >
                                            <input type="text" v-model="bankletterNo" class="form-control form-control-sm"  :class="{'date-invalid':$v.bankletterNo.$error}">
                                                <div v-if="$v.bankletterNo.$error" >
                                                    <p class="text-danger" v-if="!$v.bankletterNo.required">Please fill out this field</p>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <label class="form-label mt-2">Date: </label>
                                            </div>
                                            <div class="col-md-3 pl-0 ">
                                                <input class="form-control  form-control-sm" v-model="bankDate" :class="{'date-invalid':$v.bankDate.$error}" style="margin-left: 18px;min-width: 152px;" name="txtDate2" type="date">
                                                <div v-if="$v.bankDate.$error" >
                                                    <p class="text-danger" style="margin-left:20px" v-if="!$v.bankDate.required">Please specify the date</p>
                                                </div>
                                            </div>

                                        </div>

                                        <hr style="background-color:#275129">
                                    </fieldset>
                                    <fieldset id="section2"  v-show="selected == 'Customers' || 'Vendors' || 'Bank'">
                                        <h5>{{csTitle}}'s Details</h5>
                                        <br>
                                        <div class="form-group row">
                                            <label for="" class="col-md-3 col-form-label">Name</label>
                                                <div class="col-md-7 pl-0">
                                            <Select :options="customers" disabled :class="[{'date-invalid':$v.customerName.$error},'mySelect']" @input="getCustomer()" v-model="customerName" label="text" ></Select>
                                            <div v-if="$v.customerName.$error" >
                                                    <p class="text-danger" v-if="!$v.customerName.required">Please select Customer</p>
                                            </div>
                                                </div>
                                                <div class="col-md-2" style="padding-left:0px !important">
                                                <input type="button" disabled class="btn btn-primary branch-btn" data-toggle="modal" data-target="#customerModal" style="margin-left:16px;font-size:12px" value="Add">
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
                                            <label for="" class="col-md-3 col-form-label">Design/Dept</label>
                                            <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm"  :class="{'date-invalid':$v.customerDesignation.$error}"  v-model="customerDesignation" type="text">
                                            <div v-if="$v.customerDesignation.$error" >
                                                <p class="text-danger" v-if="!$v.customerDesignation.required">Please input customer designation</p>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 col-form-label">Address: </label>
                                            <div class="col-md-8 pl-0 pr-0" >
                                                <textarea style="height:50px" class="form-control  form-control-sm" v-model="customerLocation"   type="text">
                                                </textarea>

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
                                            <label for="" class="col-md-3 col-form-label">CNIC</label>
                                            <div class="col-md-8 pl-0 pr-0" >
                                                <input class="form-control form-control-sm" v-model="ibrCustomerNIC" type="text">
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


                            </div>
                            <div class="col-md-6 col-sm-12" style="padding: 0px 30px 0px 30px;">
                        <div class="form-group row ">
                            <label class="col-md-3">Operational Branch: </label>
                            <div class="col-md-9 pl-0">
                                <Select  label="text"  v-model="operationalBranch"  :class="[{'invalid':$v.operationalBranch.$error},'mySelect']" :options="regions" ></Select>
                                <div v-if="$v.operationalBranch.$error">
                                        <p class=" text-danger" v-if="!$v.operationalBranch.required">Please Select the branch</p>
                                    </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="col-md-3">Documents: </label>
                            <div class="col-md-5 pl-0">
                                <Select  label="text"  v-model="documentType"  :class="[{'invalid':$v.documentType.$error},'mySelect']" :options="documentTypes" ></Select>
                                <div v-if="$v.documentType.$error">
                                        <p class=" text-danger" v-if="!$v.documentType.required">Required</p>
                                    </div>
                            </div>
                            <div class="col-md-2 ">
                                    <input type="text" v-model="documentCount" :class="[{'invalid':$v.documentCount.$error}]" class="form-control form-control-sm" id="">
                                    <div v-if="$v.documentCount.$error">
                                        <p class=" text-danger" v-if="!$v.documentCount.required">Required</p>
                                    </div>
                            </div>
                            <div class="co1-md-1 pr-0">
                                    <input type="button" class="btn btn-primary" @click="addDocuments()" style="font-size:12px" value="Add">

                            </div>
                         
                        </div>
                        <div class="form-group row ">
                            <label class="col-md-3">Product Type: </label>
                            <div class="col-md-9 pl-0">
                               
                                <div class="row">
                                        <div class="col-md-4">
                                            <div class="custom-control custom-radio mb-5">
                                            <input type="radio" v-model.trim="productType"  id="t1" name="protype" value="Auto" class="custom-control-input">
                                            <label class="custom-control-label"  for="t1">Auto</label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="custom-control  custom-radio mb-5">
                                            <input type="radio" style="background-color:red !important" v-model.trim="productType" id="t2" name="protype" value="Home" class="custom-control-input">
                                            <label class="custom-control-label" for="t2" >Home</label>
                                            </div>
                                        </div>
                                       

                                </div>
                            </div>
                            
                        </div>
                        <!-- <div class="form-group row " v-show="productType=='Home'">
                            <label class="col-md-3">Applicant Is: </label>
                            <div class="col-md-9 pl-0">
                                <Select  label="text"  v-model="applicantIs"  :class="['mySelect']" :options="applicantTypes" ></Select>
 
                            </div>

                        </div> -->


                    <div class="section-2">
                        <h5 style="padding-bottom:20px">Applicant Details</h5>

                        <!--


                        </div>
                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Facility: </label>
                                <div class="col-md-6" style="padding-left:0px">
                                    <MultiSelect  label="text" class="mySelect"  :multiple="true"
                                        :close-on-select="false"
                                        :clear-on-select="false"
                                        :preserve-search="true"
                                        placeholder="Select some options"
                                        :max-height="100"
                                        track-by="text"
                                        :options="facilites"  v-model="facility">
                                    </MultiSelect>

                                </div>
                                <div class=" col-md-3 " >
                                    <div class="form-check mt-2 ml-4 islamic-check">
                                        <input type="checkbox" class="form-check-input" v-model="isPrintFacility" >
                                        <label for="form-check-label"> Print ?</label>
                                    </div>
                                </div>

                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Sanctioned Limit(s): </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="sanctionedNo" type="number">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-md-3 form-label">Scope: </label>

                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-5">
                                        <div class=" mb-5">
                                        <input type="radio" v-model="scopeIs" value="Report / Records" >
                                        <label class="" for="customRadio1">Report / Records</label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class=" mb-5">
                                        <input type="radio" style="background-color:red !important" v-model="scopeIs"   value="Stock Register">
                                        <label class=""  for="customRadio2">Stock Register</label>
                                        </div>
                                    </div>


                                </div>
                                <div v-if="$v.selected.$error">
                                        <p class=" text-danger" v-if="!$v.selected.required">Please Select this Option</p>
                                    </div>
                            </div>





                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Collateral: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="collateral" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Quantity: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="quantity" type="text">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-md-3 col-form-label">Ownership Evidence: </label>
                            <div class="col-md-8 pl-0 pr-0" >
                                <input class="form-control form-control-sm" v-model="ownershipEvidence" type="text">
                            </div>
                        </div> -->
                        <!-- <div class="form-group row">

                               <label class="col-md-3 form-label">Requested On: </label>
                                <div class="col-md-9 pl-0" >
                                    <input class="form-control form-control-sm" v-model="requestedOn" :class="{'date-invalid':$v.vendorExpiry.$error}"   name="txtDate1" type="date">
                                    <div v-if="$v.vendorExpiry.$error" style="margin-left:20px">
                                        <p class=" text-danger" v-if="!$v.vendorExpiry.required">Please fill out the date</p>
                                    </div>
                                </div>
                        </div> -->

                        <div class="form-group row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Name</label>

                                <div class="col-sm-9 pl-0">
                                    <input type="text" v-model="applicantName" class="form-control form-control-sm mt-2" id="applicantName">
                                </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Father's Name</label>

                                <div class="col-sm-9 pl-0">
                                    <input type="text" class="form-control form-control-sm" v-model="applicantFather" id="applicantContact">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">CNIC</label>

                                <div class="col-sm-9 pl-0">
                                    <input type="text" v-model="applicantCNIC" class="form-control form-control-sm" id="applicantCNIC">
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">

                                <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Date Of Birth</label>

                                <div class="col-sm-9 pl-0 pb-2">
                                    <input type="date" v-model="applicantDOB" class="form-control form-control-sm" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Phone (Res)</label>

                                 <div class="col-sm-9 pl-0 pb-2">
                                    <input type="text" v-model="applicantRes" class="form-control form-control-sm" >
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Phone (Work)</label>

                                <div class="col-sm-9 pl-0 pb-2 ">
                                    <input type="text" v-model="applicantWork" class="form-control form-control-sm" >

                                </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <div class="form-group row">
                                <label for="staticEmail" class="col-sm-3 col-form-label">Cell#</label>

                                <div class="col-sm-9 pl-0">
                                    <input type="text" v-model="applicantCell" class="form-control form-control-sm" >

                                </div>
                                </div>
                            </div>
                        </div>
                        <hr style="background-color:black">
                         <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="form-check">
                                <input class="form-check-input" v-model="isHoldByCustomer" type="checkbox" id="gridCheck1">
                                <label class="form-check-label" for="gridCheck1">
                                    Hold By Bank/Customer
                                </label>
                            </div>
                        </div>
                        </div>
                        <div class="form-group row" v-show="isHoldByCustomer==true">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="Hold By Bank">
                                    <label class="form-check-label" for="gridRadios1">
                                        Hold By Bank
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="In-correct / Unreachable Phone Number of Applicant">
                                    <label class="form-check-label" for="gridRadios1">
                                        In-correct / Unreachable Phone Number of Applicant
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="Hold By Applicant">
                                    <label class="form-check-label" for="gridRadios1">
                                        Hold By Applicant
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="Applicant is Not Giving Time">
                                    <label class="form-check-label" for="gridRadios1">
                                     Applicant is Not Giving Time
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="Applicant has Given Time After">
                                    <label class="form-check-label" for="gridRadios1">
                                    Applicant has Given Time After
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-check">
                                    <input class="form-check-input" v-model="HoldByCustomerValue" type="radio" name="gridRadios" id="gridRadios1" value="Applicant is No more interested">
                                    <label class="form-check-label" for="gridRadios1">
                                   Applicant is No more interested
                                    </label>
                                </div>
                            </div>
                        </div>


                       <survey v-for="survey in surveyes" :surveyid="survey.survey_id"  :jid="id" :bankid="selectedBank.value" :key="survey.survey_id" v-on:finalizeReport="updateit()" style="padding-bottom:10px"></survey>

                       
                       
                        <h5 style="padding-bottom:20px">Report Details</h5>
                       
                        <div class="form-group row">
                                <!-- <label class="col-md-3 col-form-label">Service Charges: </label> -->
                                <div class="col-md-3" style="padding-left:0px;display:none">
                                    <input type="number" v-model="serviceCharge" class="form-control form-control-sm">
                                </div>
                                <label class="col-md-3 col-form-label">Attention: </label>

                                 <div class="col-md-9" style="padding-left:0px">
                                    <Select  label="text"   :class="[{'date-invalid':$v.atten.$error},'mySelect']" :clearable="false" :options="attens" v-model="atten"></Select>
                                    <div v-if="$v.atten.$error">
                                        <p class=" text-danger" v-if="!$v.atten.required">Required</p>
                                    </div>
                                    <!-- {{atten}} -->

                                </div>
                                <!-- <div class=" col-md-4" >
                                    <div class="form-check mt-2 ml-4 islamic-check">
                                        <input type="checkbox" class="form-check-input" v-model="isCorporate" >
                                        <label for="form-check-label"> Corporate ?</label>
                                    </div>
                                </div> -->

                        </div>
                       
                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Q/C Officer: </label>
                          
                                <div class="col-md-9" style="padding-left:0px">
                                    <Select  label="text"    :class="[{'date-invalid':$v.qcofficer.$error},'mySelect']" :clearable="false" :options="qcofficers" v-model="qcofficer"></Select>
                                     <div v-if="$v.qcofficer.$error">
                                        <p class=" text-danger" v-if="!$v.qcofficer.required">Required</p>
                                    </div>
                                    <!-- {{qcofficer}} -->
                                </div>


                        </div>
                       
                   
                        <div class="form-group row">
                                <label class="col-md-3 col-form-label">Charges: </label>
                                <div class="col-md-3"  style="padding:0px">
                                    <div class="">
                                        <input type="text" readonly class="form-control form-control-sm" v-model="serviceCharge" >
                                      
                                    </div>
                                </div>
                                  <!-- <div class="col-md-3" >
                                    <Select  label="text"   :class="['mySelect']" disabled :options="salesRegion" v-model="saleReg"></Select>

                                </div> -->
                        </div>

                        <!-- <div class="form-group row" >
                            <div class="col-md-12" >


                            <a href="/valuation"><input type="button"  class="btn btn-primary" style="float:right;margin:10px" value="Cancel"></a>
                            <input type="button" @click="onComplete()" v-if="!saveButton" style="float:right;margin:10px"  class="btn btn-primary" value="Save">

                            </div>
                        </div> -->

                    </div>
                </div>
                        </div>


                    </div>
                </form>
                 <div class="modal fade bd-example-modal-2" id="billModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Bill Viewer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" >
                                    <div class="container" v-show="loading" >
                                        <div class="row justify-content-md-center">
                                                <img :src="loader">

                                        </div>
                                    </div>
                                    <iframe :src="bill"  width="100%" v-show="!loading" height="550px" frameborder="0"></iframe>





                                </div>
                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
          
        </div>
       
  

        <div class="row">

            <div class="col-md-12" style="text-align:right;margin-top:10px">
                        <input type="button" @click="onComplete()" class="btn btn-primary" v-if="!saveButton" value="Save">
                        <a href="/inspection"><input type="button"  class="btn btn-primary" value="Ignore"></a>
                        <a href="#"><input type="button"  class="btn btn-primary" value="Rate Confirmed?"></a>
            </div>

        </div>

        </div>
    </div>
</template>

<script>

import { required, minLength, between,email } from 'vuelidate/lib/validators'
import axios from 'axios'
import vSelect from 'vue-select'
import vMultiselect from 'vue-multiselect'
import Survey from './modal/Survey.vue';
import 'vue-select/dist/vue-select.css'
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'
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
          'survey':Survey,
          'MultiSelect':vMultiselect,
            Autocomplete
      },
     data() {
       return {
        title:'',
        subtitle:'',
        csTitle:'Borrower',
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
        ibrCustomerNIC:'',
        bankEmail:'',
        bankType:'',
        bankletterNo:'',
        bankDate:'',
        company:'',
        block:true,
        region:'',
        companies:[],
        ibrVendors:[],
        banks:[],
        regions:[],
        branches:[],
        cities:[],
        customers:[],
        facilites:[],
        muccaduums:[],
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
        customerLocation:'',
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
        ibrBranchFax:'',
        edd:new Date(),
        types:['Islamic','Conventional'],
        isSalesTax:false,
        requestedOn:'',
        isCorporate:false,
        salesRegion:[],
        saleReg:'',
        isCompleted:false,
        delivedOn:'',
        bill:0,
        loading:false,
        saveButton:false,
        printButton:false,
        reportModalIs:true,
        siteAddress:'',
        loader:'',
        isHold:false,
        isCancalled:false,
        cancelRemarks:'',
        HoldRemarks:'',
         operationalBranch:'',
        serviceCharge:'',
        saveButton:false,
        documentTypes:[],
        qcofficers:[],
        qcofficer:'',
        documentType:'',
        documentCount:'',
        applicantName:'',
        applicantFather:'',
        applicantCell:'',
        applicantCNIC:'',
        applicantDOB:'',
        applicantRes:'',
        applicantWork:'',
        HoldByCustomerValue:'',
        isHoldByCustomer:false,
        isAllSurveyCompleted:false,
        surveyes:[],
        attens:[],
        atten:'',
        serv:'',
        snap:'',
        productType:'Auto',
         applicantIs:{text:'Applicant'},
        applicantTypes:[
              {"text":"Applicant"},
              {"text":"Co-Applicant"},
              {"text":"Reference"},
        ]



       }
    },
    mounted(){
        this.loader=document.location.origin+'/images/loader.gif';

       this.getInspectionJob();
        this.updateit();

        this.updateStats();
    },
    methods: {

        updateit(){
            this.checkSurveys();
            this.getServiceCharges();

            
        },
     getInspectionJob(){
        axios.get('/getVerificationJob/' + this.id)
        .then(res=>{
            console.log(res.data);
            res.data.job.forEach((obj)=>{

                this.company={text:obj.job_company,value:obj.job_by};
                this.region={text:obj.region,value:obj.region_id};
                this.operationalBranch={text:obj.op_branch,value:obj.operational_branch};
                // this.date=obj.expiry,
                // this.reqdate=obj.requested_date,
                this.selected=obj.given_by;
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
                this.customerLocation=obj.customer_address;
                this.customerPhone=obj.customer_phone;
                this.ibrCustomerNIC=obj.customer_cnic;
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
                // this.isShowValues=obj.show_values===1 ? true:false;
                // this.isLetterHead=obj.letter_head===1 ? true:false;
                this.isCompleted=obj.completed===1 ? true:false;
                this.delivedOn=obj.delivered_on;
                // this.prepByCpu=obj.prepared_by_cpu===1 ? true:false;
                this.isHold=obj.customer_delay===1 ? true:false;


                this.requestedOn=obj.request_date;

                // this.serviceCharge=obj.service_charges;
                this.isSalesTax=obj.is_sales_tax===1 ? true:false;
                // this.isCancalled=obj.cancalled===1 ? true:false;
                this.saleReg={text:obj.tax_region,value:obj.sale_reg};

                this.atten={text:obj.atten_name,value:obj.atten};

                this.qcofficer={text:obj.officer_name,value:obj.qc_officer};

                this.cancelRemarks=obj.cancallation_remarks;
                this.productType=obj.product_type;
                this.applicantIs={text:obj.product_sub_type};
                
                this.HoldRemarks=obj.delayed_remarks;
                this.getCompany();
                // this.getEmployees();
                this.getRegion();
                this.getBanks();
                this.getCity();

                this.getCustomers();
                this.getVendors();
                this.getTaxRegions();
             

                this.getSurveys();
               this.getDocuments();

                if(obj.qc_officer==null)
                {
                    this.qcofficer='';
                }

                if(obj.atten==null){
                    this.atten='';
                }

                this.getOfficers();
                this.getAtten();

                if( obj.completed==3)
                {
                   this.saveButton=true;
                }

                else if(obj.completed==1)
                {
                   this.saveButton=true;
                   this.printButton=true;

                }





                // else{
                //     this.status='Running';
                // }



                // if(obj.cancalled==1){
                //     this.status="Cancelled";
                // }






            })

        })


          axios.get('/getVerificationDetails/' + this.id)
        .then(res=>{
            console.log(res.data);
            res.data.job.forEach((obj)=>{



                this.applicantName=obj.applicant_name;
                this.applicantFather=obj.applicant_father;
                this.applicantCell=obj.applicant_contact;
                this.applicantCNIC=obj.applicant_cnic;
                this.applicantDOB=obj.applicant_dob;
                this.applicantRes=obj.applicant_res_phone;
                this.applicantWork=obj.applicant_work_phone;
           




            })

        })

   },

   updateStats: function(){

            axios.post('/updateStatsLog')
            .then(res=>{
                // alert('Stats Updated');


            })
            .catch(error=>{
            });


   },
   onComplete: function(){

       if(this.isCompleted==true)
       {
            if(this.$v.iscmp.$invalid)
            {
                this.$v.iscmp.$touch();
                var isValid = !this.$v.iscmp.$invalid
                this.$emit('on-validate', this.$data, isValid)
                return isValid
            }

            else
            {
                if(this.serviceCharge==0 || this.serviceCharge=='')
                {

                    if(this.selectedBank.value==22)
                    {
                        this.postData();
                    }
                    else if(this.selectedBank.value==10)
                    {
                        this.postData();

                    }
                    else{
                          alert('Bill amount is 0 job completion is not allowed');

                    }
                }

                else{
                this.postData();

                }
            }
       }
       else{
            this.postData();

       }

      

      

       
   },
    postData(){


         //  var string=this.$refs.ibrCompany.value;
        //  var cmpname=string.replace(/[{()}^0-9-]/g, "");

           axios.put('/updateVerification/' + this.id ,{
        job_by:this.company.value,
        regional_id:this.region.value,
        operational_branch:this.operationalBranch.value,
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
        ins_vendor_id:this.vendor.value,
        ins_billing_address:this.vendorAddress,
        ins_vendor_representaive:this.vendorRepresent,
        ins_vendor_designation:this.vendorDesignation,
        ins_vendor_phone:this.vendorPhone,
        ins_vendor_fax:this.vendorFax,
        ins_vendor_email:this.vendorEmail,
        ins_vendor_letter:this.vendorLetter,
        ins_vendor_date:this.vendorExpiry,
        customer_id:this.customerName.value,
        customer_representative:this.customerRepresent,
        customer_designation:this.customerDesignation,
        customer_phone:this.customerPhone,
        customer_cnic:this.ibrCustomerNIC,
        customer_email:this.customerEmail,
        customer_address:this.customerLocation,
        completed:this.isCompleted,
        delivered_on:this.delivedOn,
        requested_on:this.requestedOn,
        service_charges:this.serviceCharge,
        is_sales_tax:this.isSalesTax,
        sale_reg:this.saleReg.value,
        applicant_name:this.applicantName,
        applicant_father:this.applicantFather,
        applicant_contact:this.applicantCell,
        applicant_cnic:this.applicantCNIC,
        applicant_dob:this.applicantDOB,
        applicant_res_phone:this.applicantRes,
        applicant_work_phone:this.applicantWork,
        atten:this.atten.value,
        qcofficer:this.qcofficer.value,
        product_type:this.productType,
        product_sub_type:this.applicantIs.text,
        commonId:this.common






  })
      .then(res=>{
          alert('Job data updated Successfully');
            // window.location.href="/home";
            console.log(res.data);

            if(this.isCompleted==true)
            {   
                    
                    this.printInsBill();
                    alert('Job Completed Successfully');
                    this.saveButton=true;
                    // this.getVerificationBill();
             }
            this.updateStats();
            this.updateit();

           this.getInspectionJob();

      })
      .catch(error=>{
          alert(error);
      });
    },

   getOfficers(){
       this.qcofficers=[];
            axios.get("/getQCOfficers")
                .then(res => {

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.qcofficers.push({text:obj.name,value:obj.id});
                    })

                })
                .catch(error => {

                console.log(error.response);


                });


        },

    getServiceCharges(){
                       
               const params={
                    id:this.id,
                    jid:this.jobid,
                    bank_id:this.selectedBank.value,
                };
        axios.get("/getVerificationChargesTotal",{params})
                .then(res => {
                        this.serviceCharge=res.data;                

                // res.data.forEach((obj)=>{
                     
                //         // serv=obj.total_charges;
                //         // alert(serv);

                //     })
                    // console.log(res.data);
                })
                .catch(error => {

                console.log(error.response);


                });

        //         const params={
        //             id:this.id,
        //             bank_id:this.selectedBank.value,
        //         };
        // axios.get("/getVerificationSnapCharges",{params})
        //         .then(res => {


        //         })
        //         .catch(error => {

        //         console.log(error.response);


        //         });

    },

    checkSurveys(){
                       
               const params={
                    jid:this.id
                };
        axios.get("/checkSurveys",{params})
                .then(res => {
                        // alert(res.data);                
                    var surcount=res.data;

                    if(surcount>0)
                    {
                        this.isAllSurveyCompleted=false;
                    }

                    else{
                        this.isAllSurveyCompleted=true;
                    }
                
                })
                .catch(error => {

                console.log(error.response);


                });

       

    },
   
   getSurveys(){

            this.surveyes=[];
            axios.get("/getSurveysForERP/"+ this.id)
                .then(res => {

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.surveyes.push({survey_id:obj.id});
                    })
                })
                .catch(error => {

                console.log(error.response);


                });

                this.checkSurveys();


        },
   getAtten(){

            this.attens=[];
            axios.get("/getAtten/"+ this.selectedBank.value)
                .then(res => {

                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.attens.push({text:obj.name,value:obj.id});
                    })
                   

                })
                .catch(error => {

                console.log(error.response);


                });


        },
    checkSaleReg(){

        var saleReg=this.isSalesTax;

        if(saleReg==false)
        {
            // alert('Checked');
        }

        else{
            // alert('Unchecked');
            this.saleReg.text='';
            this.saleReg.value='';
        }
    },
  cancelJob: function(){

            axios.put('/cancelVerification/' + this.id ,{
               remarks:this.cancelRemarks,
               jobid:this.jobid,
               commonId:this.common

           })
            .then(res=>{
                alert('Job Was successfully cancelled');
                this.getInspectionJob();



            })
            .catch(error=>{
            });


   },
  holdJob: function(){

            axios.put('/holdVerification/' + this.id ,{
               remarks:this.HoldRemarks,
               is_hold:this.isHold,
               jobid:this.jobid,
               commonId:this.common

           })
            .then(res=>{
                alert('Job status is changed to delayed');
                this.getInspectionJob();



            })
            .catch(error=>{
            });


   },
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

        getDocuments(){
        axios.get('/getDocumentsList')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.documentTypes.push({text:obj.name})

                        })
                    })

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
    getEmployees(){
        this.conducters=[];
                 axios.get('/api/getEmployees',{
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

                            this.conducters.push({text:obj.name,value:obj.id})
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

    getCustomer(){
            let id=this.customerName.value;
            axios.get("/getCustomerById/" + id) //with id
                .then(res => {

                res.data.forEach((obj)=>{

                        // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                        // this.branch=obj.branch_name;

                        this.customerPhone=obj.cust_phone;
                        this.ibrCustomerCNIC=obj.cust_ntn;
                        this.customerRepresent=obj.cust_contact_person;
                        this.customerDesignation=obj.cust_designation;
                        this.customerLocation=obj.address;
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

    addDocuments()
    {

        if(this.$v.survey.$invalid)
        {
            this.$v.survey.$touch();
            var isValid = !this.$v.survey.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }
        {

            if (confirm('Are you sure to add this Document?')) {

                   const surdata={
            jobid:this.id,
            surType:this.documentType.text,
            surveyCount:this.documentCount
            };
        axios.post('/addSurvey',surdata)
            .then(res=>{
              this.getSurveys();
            })
            .catch(error=>alert(error))
               
                } else {
                   
                    this.documentCount="";
                    this.documentType={text:''};
                    this.$v.$reset()
                
                }
         

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
    },

    printInsBill(){
         var billData={
            id:this.id,
            jobid:this.jobid,
            bank:this.selectedBank.text,
            address:this.billingAddress,
            // company_address:this.companyAddress,
            bank_letter:this.bankletterNo,
            bank_date:this.bankDate,
            service:this.serviceCharge,
            sales:this.saleReg.value,
            customer:this.customerName.text,
            vendor:this.vendor.text,
            customerAddress:this.customerAddress,
            vendorAddress:this.vendorAddress,
            region:this.region.value,
            customerIs:this.customerName.value,
            branch:this.bankBranch.value,
            // vendorletter:this.vendorLetter,
            // vendordate:this.vendorDate,
            givenby:this.selected,
            bankID:this.selectedBank.value,
            companyID:this.company.value,
            companyPrefix:this.company.prefix,
            BankPrefix:this.selectedBank.prefix,
            atten:this.atten.value




             };

        //     this.bill='';
        //  $('#billModal').modal('show');
        // this.loading=true;
        axios.post('/printVerBill',billData,{responseType: 'arraybuffer'}).then(res=>{
            console.log(billData);
            // this.loading=false;
            // this.bill=document.location.origin+'/Reports/IBR/'+this.id+'/bill.pdf';
            //  var file = new Blob([res.data], {type: 'application/pdf'});
            // var fileURL = URL.createObjectURL(file);
            // this.bill=fileURL;
            // this.printButton=true;

       }).catch(error=>{
        //    alert('Please complete the info before priniing the bill');
        alert(error);
        // this.loading=false;


       });
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
   operationalBranch:{
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
    documentType:{
        required
    },
    documentCount:{
        required
    },
    atten:{
        required
    },
    qcofficer:{
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
        'operationalBranch',
        ],

          form2:[
        'selected',
        'company',
        'region',
        'customerName',
        'customerPhone',
        'customerEmail',
        'customerDesignation',
        'customerRepresent',
        'operationalBranch',

        ],

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
        'operationalBranch',

        ],


    customer:[
        'customerName1',
        // 'customerCode1',
        'customerCity',
        'customerAddress1',
        'customerPhone1',
        // 'customerCNIC',
        // 'customerGst',
        // 'customerDesignation1',
        'customerPerson',
        // 'customerFax1'
    ],
    bank:[
        'bankName1',
        // 'bankCode1',
        // 'bankIbr',
        'bankType'
    ],
   survey:[
        'documentType',
        'documentCount'
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
    ],
    iscmp:[
        'atten',
        'qcofficer'
        ]


  }
  }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style >

label{
    font-size:13px !important
}
.mySelect{
      height:30px !important;
    font-size:12px !important
}

input[type="text"],input[type="date"],input[type="number"]{
      height:30px !important;
    font-size:12px !important
}
textarea{
    font-size:12px !important;
}
.text-danger{
    font-size:12px !important;
}
.btn{
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
    line-height: 1.5;
    border-radius: 0.2rem;
}
.islamic-check{
    padding:0px 0px 0px 0px !important
}
.branch-btn{
    margin-left:0px !important;


}
.vs--single .vs__selected{
    margin-left: 11px;
    margin-top: 4px;
}

.vue-form-wizard{
width: 65rem;
}

.invalid{
    border: #dc3545 0.4px solid;
    background-color: #ffc9aa;
     height:30px !important;
    font-size:12px !important
}

.date-invalid{
    border: #dc3545 1px solid;
    background-color: #ffc9aa;
     height:30px !important;
    font-size:12px !important
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
.form-group {
    margin-bottom: 0.3rem !important;
}

.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    color: #fcfdff;
    background-color: #275129 !important;
}

.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link {
    border-color: #275129 #275129 #275129 !important;
}

.btn-primary {
    color: #fff;
    background-color: #275129;
    border-color: #275129;
}



.btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open>.dropdown-toggle.btn-primary {
    color: #fff;
    background-color: #275129 ;
    border-color: #275129 ; /*set the color you want here*/

}
.btn-primary.disabled, .btn-primary:disabled {
    color: #fff;
    background-color: #275129;
    border-color: #275129;
}

.custom-control-label::before {
    border: 2px solid #275129 !important;
}

.custom-radio .custom-control-input:checked ~ .custom-control-label::before {
    background-color: #275129;
}



</style>

