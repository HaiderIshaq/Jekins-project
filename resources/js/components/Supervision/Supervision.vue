
<template>
    <div class="container-fluid">
        <div class="bg-white border-radius-4 box-shadow mb-30" style="padding:0px 15px 16px 15px">

            <div class="clearfix">
                <div class="row" style="background-color:#275129;padding-bottom:15px">
                    <div class="col-md-10">
                        <h4 class="text-white  pt-3">New Supervision Job</h4>
                    </div>
                    <div class="col-md-2" style="text-align: right;">
                        <a href="/supervision" style="margin-top: 12px;margin-left: 50px;
                      color: black;
                            background-color: #ffffff;
                            border-color: #ffffff;
                        " class="btn btn-primary">Back</a>
                    </div>
                </div>

                <br>
                <!-- <p class="mb-30 font-14">New Muccadum Job</p> -->

            </div>
            <div class="wizard-content">
                <form action="">
                    <div class="row">
                        <div class="col-md-6 col-sm-12" style="border-right:1px solid #646161">
                            <div id="section1">
                                <div class="form-group row">

                                    <label class="col-md-3 form-label">Type: </label>

                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" v-model.trim="selected" id="customRadio1"
                                                        name="type" value="Bank" @change="clear1()"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Bank</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control  custom-radio mb-5">
                                                    <input type="radio" style="background-color:red !important"
                                                        v-model.trim="selected" id="customRadio2" name="type"
                                                        value="Customers" @change="clear2()"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="customRadio2">Customer</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio mb-5">
                                                    <input type="radio" v-model.trim="selected" id="customRadio3"
                                                        name="type" value="Vendors" @change="clear3()"
                                                        class="custom-control-input">
                                                    <label class="custom-control-label"
                                                        for="customRadio3">Vendor</label>
                                                </div>
                                            </div>

                                        </div>
                                        <div v-if="$v.selected.$error">
                                            <p class=" text-danger" v-if="!$v.selected.required">Please Select this
                                                Option</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3" for="company">Company </label>

                                    <div class="col-md-8 pl-0 pr-0">
                                        <Select id="company" label="text"
                                            :class="[{'invalid':$v.company.$error},'mySelect']" v-model="company"
                                            :options="companies"></Select>
                                        <div v-if="$v.company.$error">
                                            <p class="text-danger" v-if="!$v.company.required">Select some company</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row ">
                                    <label class="col-md-3">Region: </label>
                                    <div class="col-md-8 pl-0 pr-0">
                                        <Select label="text" :class="[{'invalid':$v.region.$error},'mySelect']"
                                            v-model="region" :options="regions"></Select>
                                        <div v-if="$v.region.$error">
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
                                <fieldset id="section3" v-show="selected == 'Vendors'">
                                    <h5>Vendor's Details</h5>
                                    <br>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <Select label="text" v-model="vendor"
                                                :class="[{'date-invalid':$v.vendor.$error},'mySelect']"
                                                @input="getVendorAddress()" :options="vendors"></Select>
                                            <div v-if="$v.vendor.$error">
                                                <p class=" text-danger" v-if="!$v.vendor.required">Please Select some
                                                    vendor</p>
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
                                        <div class="col-md-8 pl-0 pr-0">
                                            <textarea v-model="vendorAddress" cols="30" rows="2"
                                                class="form-control form-control-sm"
                                                :class="{'date-invalid':$v.vendorAddress.$error}"></textarea>
                                            <div v-if="$v.vendorAddress.$error">
                                                <p class=" text-danger" v-if="!$v.vendorAddress.required">Please input
                                                    vendor billing address</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Representative: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control  form-control-sm" v-model="vendorRepresent"
                                                :class="{'date-invalid':$v.vendorRepresent.$error}" type="text">
                                            <div v-if="$v.vendorRepresent.$error">
                                                <p class=" text-danger" v-if="!$v.vendorRepresent.required">Please input
                                                    vendor representative</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Desig/Dept: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control  form-control-sm" v-model="vendorDesignation"
                                                :class="{'date-invalid':$v.vendorDesignation.$error}" type="text">
                                            <div v-if="$v.vendorDesignation.$error">
                                                <p class=" text-danger" v-if="!$v.vendorDesignation.required">Please
                                                    input vendor representative</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Phone: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input type="number" class="form-control  form-control-sm"
                                                v-model="vendorPhone" :class="{'date-invalid':$v.vendorPhone.$error}">
                                            <div v-if="$v.vendorPhone.$error">
                                                <p class=" text-danger" v-if="!$v.vendorPhone.required">Please input
                                                    vendor phone-number</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Fax: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control  form-control-sm " v-model="vendorFax"
                                                type="text">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input type="email" class="form-control  form-control-sm"
                                                v-model="vendorEmail" :class="{'date-invalid':$v.vendorEmail.$error}">
                                            <div v-if="$v.vendorEmail.$error">
                                                <p class=" text-danger" v-if="!$v.vendorEmail.required">Please input
                                                    vendor email address</p>
                                                <p class="text-danger" v-if="!$v.vendorEmail.email">Please fill out
                                                    valid email</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 form-label">Letter No: </label>
                                        <div class="col-md-3 pl-0">
                                            <input type="text" class="form-control form-control-sm"
                                                :class="{'date-invalid':$v.vendorLetter.$error}" v-model="vendorLetter">
                                            <div v-if="$v.vendorLetter.$error">
                                                <p class=" text-danger" v-if="!$v.vendorLetter.required">Please input
                                                    vendor letter</p>
                                            </div>
                                        </div>

                                        <label class="col-md-1 form-label">Date: </label>
                                        <div class="col-md-3">
                                            <input class="form-control form-control-sm" v-model="vendorExpiry"
                                                :class="{'date-invalid':$v.vendorExpiry.$error}"
                                                style="margin-left: 18px;min-width: 152px;" name="txtDate1" type="date">
                                            <div v-if="$v.vendorExpiry.$error" style="margin-left:20px">
                                                <p class=" text-danger" v-if="!$v.vendorExpiry.required">Please fill out
                                                    the date</p>
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="background-color:black">
                                </fieldset>
                                <fieldset id="section1" v-show="selected == 'Bank'">

                                    <h5>Ordering Bank's Details</h5>
                                    <br>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Bank: </label>
                                        <div class="col-md-4" style="padding-left:0px">
                                            <Select label="text" @input="getBranches()"
                                                :class="[{'date-invalid':$v.selectedBank.$error},'mySelect']"
                                                :options="banks" v-model="selectedBank"></Select>
                                            <div v-if="$v.selectedBank.$error">
                                                <p class="text-danger" v-if="!$v.selectedBank.required">Please select
                                                    some bank</p>
                                            </div>
                                        </div>
                                        <div class=" col-md-2 ">
                                            <div class="form-check ml-4 islamic-check">
                                                <input type="checkbox" class="form-check-input"
                                                    @change="getBanksByIslam()" v-model="btype">
                                                <label for="form-check-label"> Islamic</label>
                                            </div>
                                        </div>

                                        <div class="col-md-1 pr-0">
                                            <input type="button" value="Add" class="btn btn-primary "
                                                data-toggle="modal" data-target="#bankModal" style="margin-left:10px">
                                        </div>
                                    </div>
                                    <div class="modal fade bd-example-modal-2" id="bankModal" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new Bank</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form enctype="multipart/form-data">

                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Name:</label>
                                                                <input type="text" v-model="bankName1"
                                                                    :class="{'date-invalid':$v.bankName1.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.bankName1.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.bankName1.required">Please input bank
                                                                        name</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="message-text"
                                                                    class="col-form-label">Type:</label>
                                                                <!-- <input type="text" v-model="bankCode1" :class="{'date-invalid':$v.bankCode1.$error}" class="form-control"> -->
                                                                <Select :options="types" v-model="bankType"
                                                                    :class="[{'date-invalid':$v.bankType.$error},'mySelect']"
                                                                    label="text"></Select>
                                                                <div v-if="$v.bankType.$error">
                                                                    <p class="text-danger" v-if="!$v.bankType.required">
                                                                        Please select bank type</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label for="message-text"
                                                                    class="col-form-label">Code:</label>
                                                                <input type="text" v-model="bankCode1"
                                                                    :class="{'date-invalid':$v.bankCode1.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.bankCode1.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.bankCode1.required">Please input bank
                                                                        code</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Bank Ibr Rate:</label>
                                                                    <input type="number" v-model="bankIbr"
                                                                        :class="{'date-invalid':$v.bankIbr.$error}"
                                                                        class="form-control">
                                                                    <div v-if="$v.bankIbr.$error">
                                                                        <p class="text-danger"
                                                                            v-if="!$v.bankIbr.required">Please input
                                                                            bank IBR rate</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" @click="addBank()"
                                                            class="btn btn-primary">Add Bank</button>
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
                                            <Select label="text" v-model="bankBranch" @input="getAddress()"
                                                :class="[{'date-invalid':$v.bankBranch.$error},'mySelect']"
                                                :disabled="!selectedBank" :options="branches"></Select>
                                            <!--  -->
                                            <div v-if="$v.bankBranch.$error">
                                                <p class="text-danger" v-if="!$v.bankBranch.required">Please select some
                                                    branch</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-left:0px !important">
                                            <input type="button" value="Add" class="btn btn-primary branch-btn "
                                                :disabled="!selectedBank" data-toggle="modal"
                                                data-target=".bd-example-modal-lg" style="margin-left:16px">
                                        </div>

                                        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
                                            aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Add new Branch
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
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Branch Name / Branch
                                                                    Address:</label>
                                                                <input type="text" v-model="branchName"
                                                                    class="form-control"
                                                                    :class="{'date-invalid':$v.branchName.$error}">
                                                                <div v-if="$v.branchName.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.branchName.required">Please input
                                                                        branch Name</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="message-text"
                                                                    class="col-form-label">City:</label>
                                                                <Select v-model="branchCity" label="text"
                                                                    :options="cities"
                                                                    :class="[{'date-invalid':$v.branchCity.$error},'mySelect']"></Select>
                                                                <div v-if="$v.branchCity.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.branchCity.required">Please select
                                                                        branch city</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Complete Address:</label>
                                                                <input type="text" v-model="branchAddress"
                                                                    class="form-control"
                                                                    :class="{'date-invalid':$v.branchAddress.$error}">
                                                                <div v-if="$v.branchAddress.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.branchAddress.required">Please select
                                                                        branch complete address</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Landline Number:</label>
                                                                <input type="text" v-model="branchLandline"
                                                                    class="form-control"
                                                                    :class="{'date-invalid':$v.branchLandline.$error}">
                                                                <div v-if="$v.branchLandline.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.branchLandline.required">Please input
                                                                        landline number</p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="recipient-name"
                                                                            class="col-form-label">Phone:</label>
                                                                        <input type="number" v-model="branchPhone"
                                                                            class="form-control"
                                                                            :class="{'date-invalid':$v.branchPhone.$error}">
                                                                        <div v-if="$v.branchPhone.$error">
                                                                            <p class="text-danger"
                                                                                v-if="!$v.branchPhone.required">Please
                                                                                input branch phone-number</p>
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
                                                                        <label for="recipient-name"
                                                                            class="col-form-label">Code:</label>
                                                                        <input type="number" v-model="branchCode"
                                                                            class="form-control"
                                                                            :class="{'date-invalid':$v.branchCode.$error}">
                                                                        <div v-if="$v.branchCode.$error">
                                                                            <p class="text-danger"
                                                                                v-if="!$v.branchCode.required">Please
                                                                                input branch code of bank</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button" data-dismiss="modal"
                                                                class="btn btn-secondary">Close</button>
                                                            <button type="button" @click="addBranch()"
                                                                class="btn btn-primary">Add Branch</button>
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
                                                :class="{'date-invalid':$v.billingAddress.$error}" cols="30" rows="2"
                                                class=" form-control form-control-sm" style="height:60px"></textarea>
                                            <div v-if="$v.billingAddress.$error">
                                                <p class="text-danger" v-if="!$v.billingAddress.required">Please fill
                                                    out billing address</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Representative: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control  form-control-sm" v-model="bankRepresentative"
                                                :class="{'date-invalid':$v.bankRepresentative.$error}" type="text">
                                            <div v-if="$v.bankRepresentative.$error">
                                                <p class="text-danger" v-if="!$v.bankRepresentative.required">Please
                                                    fill out representative</p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Desig/Dept: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control  form-control-sm" v-model="bankDesignation"
                                                :class="{'date-invalid':$v.bankDesignation.$error}" type="text">
                                            <div v-if="$v.bankDesignation.$error">
                                                <p class="text-danger" v-if="!$v.bankDesignation.required">Please fill
                                                    out designation and department</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Phone: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input type="number" v-model="bankPhone"
                                                :class="{'date-invalid':$v.bankPhone.$error}"
                                                class="form-control form-control-sm">
                                            <div v-if="$v.bankPhone.$error">
                                                <p class="text-danger" v-if="!$v.bankPhone.required">Please fill out
                                                    phone number</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Fax: </label>
                                        <input class="form-control  form-control-sm col-md-8" v-model="ibrBranchFax"
                                            type="text">
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Email: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input type="email" v-model="bankEmail"
                                                class="form-control  form-control-sm"
                                                :class="{'date-invalid':$v.bankEmail.$error}">
                                            <div v-if="$v.bankEmail.$error">
                                                <p class="text-danger" v-if="!$v.bankEmail.required">Please fill out
                                                    email address</p>
                                                <p class="text-danger" v-if="!$v.bankEmail.email">Please fill out valid
                                                    email</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <div class="col-md-3">
                                            <label class="form-label">Letter No: </label>
                                        </div>
                                        <div class="col-md-3 pl-0">
                                            <input type="text" v-model="bankletterNo"
                                                class="form-control form-control-sm"
                                                :class="{'date-invalid':$v.bankletterNo.$error}">
                                            <div v-if="$v.bankletterNo.$error">
                                                <p class="text-danger" v-if="!$v.bankletterNo.required">Please fill out
                                                    this field</p>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <label class="form-label mt-2">Date: </label>
                                        </div>
                                        <div class="col-md-3 pl-0 ">
                                            <input class="form-control  form-control-sm" v-model="bankDate"
                                                :class="{'date-invalid':$v.bankDate.$error}"
                                                style="margin-left: 18px;min-width: 152px;" name="txtDate2" type="date">
                                            <div v-if="$v.bankDate.$error">
                                                <p class="text-danger" style="margin-left:20px"
                                                    v-if="!$v.bankDate.required">Please specify the date</p>
                                            </div>
                                        </div>

                                    </div>

                                    <hr style="background-color:black">
                                </fieldset>
                                <fieldset id="section2" v-show="selected == 'Customers' || 'Vendors' || 'Bank'">
                                    <h5>{{csTitle}}'s Details</h5>
                                    <br>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Name</label>
                                        <div class="col-md-7 pl-0">
                                            <Select :options="customers"
                                                :class="[{'date-invalid':$v.customerName.$error},'mySelect']"
                                                @input="getCustomer()" v-model="customerName" label="text"></Select>
                                            <div v-if="$v.customerName.$error">
                                                <p class="text-danger" v-if="!$v.customerName.required">Please select
                                                    Customer</p>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="padding-left:0px !important">
                                            <input type="button" class="btn btn-primary branch-btn" data-toggle="modal"
                                                data-target="#customerModal" style="margin-left:16px" value="Add">
                                        </div>
                                    </div>
                                    <div class="modal fade bd-example-modal-2" tabindex="-1" role="dialog"
                                        id="customerModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new Customers
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form enctype="multipart/form-data">

                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Name:</label>
                                                                <input type="text" v-model="customerName1"
                                                                    :class="{'date-invalid':$v.customerName1.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.customerName1.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerName1.required">Please input
                                                                        customer name</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="message-text"
                                                                    class="col-form-label">Code:</label>
                                                                <input type="text" v-model="customerCode1"
                                                                    :class="{'date-invalid':$v.customerCode1.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.customerCode1.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerCode1.required">Please input
                                                                        customer code</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">City:</label>
                                                            <Select :options="cities" label="text"
                                                                v-model="customerCity"
                                                                :class="{'date-invalid':$v.customerCity.$error}"></Select>
                                                            <div v-if="$v.customerCity.$error">
                                                                <p class="text-danger" v-if="!$v.customerCity.required">
                                                                    Please input customer city</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="recipient-name"
                                                                class="col-form-label">Address:</label>
                                                            <input v-model="customerAddress1" class="form-control"
                                                                :class="{'date-invalid':$v.customerAddress1.$error}">
                                                            <div v-if="$v.customerAddress1.$error">
                                                                <p class="text-danger"
                                                                    v-if="!$v.customerAddress1.required">Please input
                                                                    customer address</p>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Phone:</label>
                                                                    <input type="number" v-model="customerPhone1"
                                                                        class="form-control"
                                                                        :class="{'date-invalid':$v.customerPhone1.$error}">
                                                                    <div v-if="$v.customerPhone1.$error">
                                                                        <p class="text-danger"
                                                                            v-if="!$v.customerPhone1.required">Please
                                                                            input customer phone number</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="recipient-name"
                                                                        class="col-form-label">Fax:</label>
                                                                    <input type="text" v-model="customerFax1"
                                                                        :class="{'date-invalid':$v.customerFax1.$error}"
                                                                        class="form-control">
                                                                    <div v-if="$v.customerFax1.$error">
                                                                        <p class="text-danger"
                                                                            v-if="!$v.customerFax1.required">Please
                                                                            input customer fax number</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">N.T.N
                                                                    / CNIC:</label>
                                                                <input type="text" v-model="customerCNIC"
                                                                    class="form-control"
                                                                    :class="{'date-invalid':$v.customerCNIC.$error}">
                                                                <div v-if="$v.customerCNIC.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerCNIC.required">Please input
                                                                        customer N.T.N or CNIC</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name" class="col-form-label">Sales
                                                                    Tax No:</label>
                                                                <input type="text" v-model="customerGst"
                                                                    :class="{'date-invalid':$v.customerGst.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.customerGst.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerGst.required">Please input tax
                                                                        no</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Contact Person:</label>
                                                                <input type="text" v-model="customerPerson"
                                                                    :class="{'date-invalid':$v.customerPerson.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.customerPerson.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerPerson.required">Please input
                                                                        contact person</p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label for="recipient-name"
                                                                    class="col-form-label">Designation:</label>
                                                                <input type="text" v-model="customerDesignation1"
                                                                    :class="{'date-invalid':$v.customerDesignation1.$error}"
                                                                    class="form-control">
                                                                <div v-if="$v.customerDesignation1.$error">
                                                                    <p class="text-danger"
                                                                        v-if="!$v.customerDesignation1.required">Please
                                                                        input contact person designation</p>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="button" @click="addCustomer()"
                                                            class="btn btn-primary">Add Customers</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Representative</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm"
                                                :class="{'date-invalid':$v.customerRepresent.$error}" type="text"
                                                v-model="customerRepresent">
                                            <div v-if="$v.customerRepresent.$error">
                                                <p class="text-danger" v-if="!$v.customerRepresent.required">Please
                                                    input customer representative</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Design/Dept</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm"
                                                :class="{'date-invalid':$v.customerDesignation.$error}"
                                                v-model="customerDesignation" type="text">
                                            <div v-if="$v.customerDesignation.$error">
                                                <p class="text-danger" v-if="!$v.customerDesignation.required">Please
                                                    input customer designation</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Address: </label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <textarea style="height:50px" class="form-control  form-control-sm"
                                                v-model="customerLocation" type="text">
                                            </textarea>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Phone</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm" type="number"
                                                :class="{'date-invalid':$v.customerPhone.$error}"
                                                v-model="customerPhone">
                                            <div v-if="$v.customerPhone.$error">
                                                <p class="text-danger" v-if="!$v.customerPhone.required">Please input
                                                    customer phone-number</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">CNIC</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm" v-model="ibrCustomerNIC"
                                                type="text">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Email</label>
                                        <div class="col-md-8 pl-0 pr-0">
                                            <input class="form-control form-control-sm" type="email"
                                                :class="{'date-invalid':$v.customerEmail.$error}"
                                                v-model="customerEmail">
                                            <div v-if="$v.customerEmail.$error">
                                                <p class="text-danger" v-if="!$v.customerEmail.required">Please input
                                                    customer email address</p>
                                                <p class="text-danger" v-if="!$v.customerEmail.email">Please input valid
                                                    email address</p>

                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>


                        </div>
                        <div class="col-md-6 col-sm-12" style="padding: 0px 30px 0px 30px;">
                            <h5 style="padding-bottom:5px">From</h5>

                            <div class="">

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Operational Branch:</label>
                                    <div class="col-md-9">
                                        <Select class="mySelect" name="operational_branch" v-model="operationalBranch" :options="regions" label="text" id="operational_branch">
                                        </Select>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <input type="radio" name=" from_port_terminal " v-model.trim="fromIs" id=" from_port_terminal " value="Port/Terminal"> <label for="">Port/Terminal</label>
                                    </div>
                                    <div class="col-md-4 pl-0">
                                        <input type="radio" name="from_bonded_warehouse" v-model.trim="fromIs" id="from_bonded_warehouse" value="Bonded Warehouse"> <label for="">Bonded Warehouse</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name="from_party_premises" v-model.trim="fromIs" id="from_party_premises" value="Party Premises"> <label for="">Party Premises</label>
                                    </div>

                                </div>
                                <div class="form-group row" v-show="fromIs=='Port/Terminal'">
                                    <label for="" class="col-md-3 col-form-label">Terminal:</label>
                                    <div class="col-md-9">
                                         <Select class="mySelect" :options="terminals" v-model="fromTerminal" label="text" name="fpt_terminal" id="fpt_terminal">

                                        </Select>
                                    </div>
                                </div>
                                <div class="form-group row" v-show="fromIs=='Bonded Warehouse'">
                                    <label for="" class="col-md-3 col-form-label">Warehouse:</label>
                                    <div class="col-md-7">
                                         <Select class="mySelect"  v-model="fromWarehouse" @input="getWarehouseAddressForFrom" :options="warehouses" label="text" name="fpt_terminal" id="fpt_terminal">

                                        </Select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button" data-toggle="modal" data-target="#warehouseModal" class="btn btn-primary btn-sm">....</button>

                                          <!-- Modal -->

                                            <div class="modal fade" id="warehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Warehouse Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" >
                                                            <span aria-hidden="true">x</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <label for="" class="col-md-3 col-form-label">Name of Warehouse:</label>
                                                            <div class="col-md-8">
                                                            <input type="text"   :class="{'date-invalid':$v.warehouseName.$error}" name="" class="form-control from-control-sm"  v-model="warehouseName" id="">
                                                            </div>

                                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                                            <div class="col-md-8">
                                                            <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.warehouseAddress.$error}" style="height:80px" v-model="warehouseAddress"></textarea>
                                                            </div>
                                                        </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" @click="addWarehouse()" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                     <label for="" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-9">
                                        <textarea v-model="fromWarehouseAddress" class="form-control form-control-sm mt-2"></textarea>
                                    </div>

                                </div>
                                <div class="form-group row" v-show="fromIs=='Party Premises'">
                                    <label for="" class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-7">
                                         <Select class="mySelect"  @input="getGodownDataForFrom()" v-model="fromGodownLocation" :options="godowns" label="text" name="fpt_terminal" id="fpt_terminal">

                                        </Select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button"  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#godownModal">....</button>

                                        <!-- Modal -->

                                            <div class="modal fade" id="godownModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Godown Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" >
                                                            <span aria-hidden="true">x</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <label for="" class="col-md-3 col-form-label">Name:</label>
                                                            <div class="col-md-8">
                                                            <input type="text" name="" class="form-control from-control-sm" :class="{'date-invalid':$v.godownName.$error}"   v-model="godownName" id="">
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                                            <div class="col-md-5 pt-1">
                                                            <input type="text" name="" class="form-control from-control-sm"  v-model="godownNo" id="">
                                                            </div>
                                                            <div class="col-md-2 pt-2">
                                                            <input type="checkbox" class="form-check-input" name="" v-model="godownBond">
                                                            <label for="form-check-label"> Bond</label>
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                                            <div class="col-md-8">
                                                            <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.godownAddress.$error}"  style="height:80px" v-model="godownAddress"></textarea>
                                                            </div>
                                                        </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" @click="addGodown()" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                    <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                    <div class="col-md-7 mt-2 mb-2">
                                        <input type="text" name=""  class="form-control from-control-sm"  v-model="fromGodownNo" id="">
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <input type="checkbox" class="form-check-input" name="" v-model="isFromGodownBond">
                                         <label for="form-check-label"> Bond</label>
                                    </div>
                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control form-control-sm mt-2" style="height:80px" v-model="fromGodownAddress"></textarea>
                                    </div>
                                </div>
                                <hr>

                                <h5 style="padding-bottom:5px">To</h5>

                                <div class="form-group row">
                                    <div class="col-md-4">
                                        <input type="radio" name="to_bonded_warehouse" id="to_bonded_warehouse" v-model.trim="toIs" value="Bonded Warehouse"> <label for="">Bonded Warehouse</label>
                                    </div>
                                    <div class="col-md-4 pl-0">
                                        <input type="radio" name="to_party_premises" id="to_party_premises" v-model.trim="toIs" value="Party Premises"> <label for="">Party Premises</label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" name=" to_3rd_party_godown" id=" to_3rd_party_godown" v-model.trim="toIs" value="3rd Party Godown"> <label for="">3rd Party Godown</label>
                                    </div>
                                </div>
                                <div class="form-group row" v-show="toIs=='Bonded Warehouse'">
                                            <label for="" class="col-md-3 col-form-label">Warehouse:</label>
                                            <div class="col-md-7">
                                                <Select class="mySelect"  v-model="toWarehouse" @input="getWarehouseAddressForTo" :options="warehouses" label="text" name="fpt_terminal" id="fpt_terminal">

                                                </Select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" data-toggle="modal" data-target="#towarehouseModal" class="btn btn-primary btn-sm">....</button>

                                                <!-- Modal -->

                                                    <div class="modal fade" id="towarehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Warehouse Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <label for="" class="col-md-3 col-form-label">Name of Warehouse:</label>
                                                                    <div class="col-md-8">
                                                                    <input type="text"   :class="{'date-invalid':$v.warehouseName.$error}" name="" class="form-control from-control-sm"  v-model="warehouseName" id="">
                                                                    </div>

                                                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                                                    <div class="col-md-8">
                                                                    <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.warehouseAddress.$error}" style="height:80px" v-model="warehouseAddress"></textarea>
                                                                    </div>
                                                                </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="addWarehouse()" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                            <div class="col-md-9">
                                                <textarea v-model="toWarehouseAddress" class="form-control form-control-sm mt-2"></textarea>
                                            </div>

                                </div>
                                <div class="form-group row" v-show="toIs=='Party Premises'">
                                    <label for="" class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-7">
                                        <Select class="mySelect" @input="getGodownDataForTo()" v-model="toGodownLocation" :options="godowns" label="text" name="fpt_terminal" id="fpt_terminal">

                                        </Select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button"  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#godownModala">....</button>

                                        <!-- Modal -->

                                            <div class="modal fade" id="godownModala" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Godown Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" >
                                                            <span aria-hidden="true">x</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <label for="" class="col-md-3 col-form-label">Name:</label>
                                                            <div class="col-md-8">
                                                            <input type="text" name="" class="form-control from-control-sm" :class="{'date-invalid':$v.godownName.$error}"   v-model="godownName" id="">
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                                            <div class="col-md-5 pt-1">
                                                            <input type="text" name="" class="form-control from-control-sm"  v-model="godownNo" id="">
                                                            </div>
                                                            <div class="col-md-2 pt-2">
                                                            <input type="checkbox" class="form-check-input" name="" v-model="godownBond">
                                                            <label for="form-check-label"> Bond</label>
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                                            <div class="col-md-8">
                                                            <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.godownAddress.$error}"  style="height:80px" v-model="godownAddress"></textarea>
                                                            </div>
                                                        </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" @click="addGodown()" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                    <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                    <div class="col-md-7 mt-2 mb-2">
                                        <input type="text" name=""  class="form-control from-control-sm"  v-model="toGodownNo" id="">
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <input type="checkbox" class="form-check-input" name="" v-model="istoGodownBond">
                                        <label for="form-check-label"> Bond</label>
                                    </div>
                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control form-control-sm mt-2" style="height:80px" v-model="toGodownAddress"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row" v-show="toIs=='3rd Party Godown'">
                                    <label for="" class="col-md-3 col-form-label">Location:</label>
                                    <div class="col-md-7">
                                        <Select class="mySelect" @input="getGodownDataForthree" v-model="thGodownLocation" :options="godowns" label="text" name="fpt_terminal" id="fpt_terminal">

                                        </Select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="button"  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#godownModalb">....</button>

                                        <!-- Modal -->

                                            <div class="modal fade" id="godownModalb" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Godown Details</h5>
                                                        <button type="button" class="close" data-dismiss="modal" >
                                                            <span aria-hidden="true">x</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        <div class="row">
                                                            <label for="" class="col-md-3 col-form-label">Name:</label>
                                                            <div class="col-md-8">
                                                            <input type="text" name="" class="form-control from-control-sm" :class="{'date-invalid':$v.godownName.$error}"   v-model="godownName" id="">
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                                            <div class="col-md-5 pt-1">
                                                            <input type="text" name="" class="form-control from-control-sm"  v-model="godownNo" id="">
                                                            </div>
                                                            <div class="col-md-2 pt-2">
                                                            <input type="checkbox" class="form-check-input" name="" v-model="godownBond">
                                                            <label for="form-check-label"> Bond</label>
                                                            </div>
                                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                                            <div class="col-md-8">
                                                            <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.godownAddress.$error}"  style="height:80px" v-model="godownAddress"></textarea>
                                                            </div>
                                                        </div>


                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="button" @click="addGodown()" class="btn btn-primary">Save</button>
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>


                                    <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                    <div class="col-md-7 mt-2 mb-2">
                                        <input type="text" name=""  class="form-control from-control-sm"  v-model="thGodownNo" id="">
                                    </div>
                                    <div class="col-md-2 pt-2">
                                        <input type="checkbox" class="form-check-input" name="" v-model="isthGodownBond">
                                        <label for="form-check-label"> Bond</label>
                                    </div>
                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                    <div class="col-md-8">
                                        <textarea class="form-control form-control-sm mt-2" style="height:80px" v-model="thGodownAddress"></textarea>
                                    </div>
                                </div>




                                <hr> <input type="checkbox" name="another_destination" v-model="iSanotherDest" id="another_destination"> <label for="">Another Destination</label>

                                <div v-show="iSanotherDest==true">

                                        <div class="form-group row">
                                            <div class="col-md-4">
                                                <input type="radio" v-model.trim="anIs" value="Bonded Warehouse"> <label for="">Bonded Warehouse</label>
                                            </div>
                                            <div class="col-md-4 pl-0">
                                                <input type="radio"  v-model.trim="anIs" value="Party Premises"> <label for="">Party Premises</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="radio"  v-model.trim="anIs" value="3rd Party Godown"> <label for="">3rd Party Godown</label>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-show="anIs=='Bonded Warehouse'">
                                            <label for="" class="col-md-3 col-form-label">Warehouse:</label>
                                            <div class="col-md-7">
                                                <Select class="mySelect" v-model="anWarehouse" @input="getWarehouseAddressForAn" :options="warehouses" label="text" name="fpt_terminal" id="fpt_terminal">

                                                </Select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" data-toggle="modal" data-target="#anwarehouseModal" class="btn btn-primary btn-sm">....</button>

                                                <!-- Modal -->

                                                    <div class="modal fade" id="anwarehouseModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Warehouse Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <label for="" class="col-md-3 col-form-label">Name of Warehouse:</label>
                                                                    <div class="col-md-8">
                                                                    <input type="text"   :class="{'date-invalid':$v.warehouseName.$error}" name="" class="form-control from-control-sm"  v-model="warehouseName" id="">
                                                                    </div>

                                                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                                                    <div class="col-md-8">
                                                                    <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.warehouseAddress.$error}" style="height:80px" v-model="warehouseAddress"></textarea>
                                                                    </div>
                                                                </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="addWarehouse()" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                            <div class="col-md-9">
                                                <textarea v-model="anWarehouseAddress" class="form-control form-control-sm mt-2"></textarea>
                                            </div>

                                        </div>
                                        <div class="form-group row" v-show="anIs=='Party Premises'">
                                            <label for="" class="col-md-3 col-form-label">Location:</label>
                                            <div class="col-md-7">
                                                <Select class="mySelect" @input="getGodownDataForAn()" v-model="anGodownLocation" :options="godowns" label="text" name="fpt_terminal" id="fpt_terminal">

                                                </Select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#godownModalc">....</button>

                                                <!-- Modal -->

                                                    <div class="modal fade" id="godownModalc" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Godown Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <label for="" class="col-md-3 col-form-label">Name:</label>
                                                                    <div class="col-md-8">
                                                                    <input type="text" name="" class="form-control from-control-sm" :class="{'date-invalid':$v.godownName.$error}"   v-model="godownName" id="">
                                                                    </div>
                                                                    <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                                                    <div class="col-md-5 pt-1">
                                                                    <input type="text" name="" class="form-control from-control-sm"  v-model="godownNo" id="">
                                                                    </div>
                                                                    <div class="col-md-2 pt-2">
                                                                    <input type="checkbox" class="form-check-input" name="" v-model="godownBond">
                                                                    <label for="form-check-label"> Bond</label>
                                                                    </div>
                                                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                                                    <div class="col-md-8">
                                                                    <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.godownAddress.$error}"  style="height:80px" v-model="godownAddress"></textarea>
                                                                    </div>
                                                                </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="addGodown()" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>


                                            <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                            <div class="col-md-7 mt-2 mb-2">
                                                <input type="text" name=""  class="form-control from-control-sm"  v-model="anGodownNo" id="">
                                            </div>
                                            <div class="col-md-2 pt-2">
                                                <input type="checkbox" class="form-check-input" name="" v-model="isanGodownBond">
                                                <label for="form-check-label"> Bond</label>
                                            </div>
                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control form-control-sm mt-2" style="height:80px" v-model="anGodownAddress"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row" v-show="anIs=='3rd Party Godown'">
                                            <label for="" class="col-md-3 col-form-label">Location:</label>
                                            <div class="col-md-7">
                                                <Select class="mySelect" @input="getGodownDataForthreeAn" v-model="thanGodownLocation" :options="godowns" label="text" name="fpt_terminal" id="fpt_terminal">

                                                </Select>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button"  class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#godownModalv">....</button>

                                                <!-- Modal -->

                                                    <div class="modal fade" id="godownModalv" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Godown Details</h5>
                                                                <button type="button" class="close" data-dismiss="modal" >
                                                                    <span aria-hidden="true">x</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row">
                                                                    <label for="" class="col-md-3 col-form-label">Name:</label>
                                                                    <div class="col-md-8">
                                                                    <input type="text" name="" class="form-control from-control-sm" :class="{'date-invalid':$v.godownName.$error}"   v-model="godownName" id="">
                                                                    </div>
                                                                    <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                                                    <div class="col-md-5 pt-1">
                                                                    <input type="text" name="" class="form-control from-control-sm"  v-model="godownNo" id="">
                                                                    </div>
                                                                    <div class="col-md-2 pt-2">
                                                                    <input type="checkbox" class="form-check-input" name="" v-model="godownBond">
                                                                    <label for="form-check-label"> Bond</label>
                                                                    </div>
                                                                    <label for="" class="col-md-3 col-form-label">Address:</label>
                                                                    <div class="col-md-8">
                                                                    <textarea class="form-control form-control-sm mt-1" :class="{'date-invalid':$v.godownAddress.$error}"  style="height:80px" v-model="godownAddress"></textarea>
                                                                    </div>
                                                                </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="button" @click="addGodown()" class="btn btn-primary">Save</button>
                                                    </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>


                                            <label for="" class="col-md-3 col-form-label">Godown No:</label>
                                            <div class="col-md-7 mt-2 mb-2">
                                                <input type="text" name=""  class="form-control from-control-sm"  v-model="thanGodownNo" id="">
                                            </div>
                                            <div class="col-md-2 pt-2">
                                                <input type="checkbox" class="form-check-input" name="" v-model="isthanGodownBond">
                                                <label for="form-check-label"> Bond</label>
                                            </div>
                                            <label for="" class="col-md-3 col-form-label">Address:</label>
                                            <div class="col-md-8">
                                                <textarea class="form-control form-control-sm mt-2" style="height:80px" v-model="thanGodownAddress"></textarea>
                                            </div>
                                        </div>

                                </div>




                                <hr>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Clearing Agent:</label>
                                    <div class="col-md-7">
                                        <Select class="mySelect" label="text" v-model="clearingAgent" :options="agents" >

                                        </Select>
                                    </div>
                                    <div class="col-md-2">
                                            <button data-toggle="modal" type="button" data-target="#agentModal" class="btn btn-primary btn-sm">.....</button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Clearing Agent Details</h5>

                                                    <span aria-hidden="true" data-dismiss="modal" aria-label="Close">X</span>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="col-md-7">
                                                            <div class="row">

                                                            <label class="form-label col-md-2 mt-2 mb-2">Name</label>
                                                             <input v-model="agentName" class="form-control col-md-10 form-control-sm mt-2 mb-3" >
                                                            <label class="form-label col-md-2">Address</label>
                                                             <input v-model="agentAddress" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Phone</label>
                                                             <input v-model="agentPhone" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Contact Person</label>
                                                             <input v-model="agentContactPerson" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Designation</label>
                                                             <input v-model="agentDesignation" class="form-control col-md-10 form-control-sm mb-3">

                                                            <label class="form-label col-md-2 pt-3">City</label>

                                                            <div class="col-md-10 pt-3 pl-0 pr-0">
                                                                <Select name="location" v-model="agentCity"  label="text" :options="cities" id="location">

                                                                </Select>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" @click="addAgent()">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>


                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Consignment:</label>
                                    <div class="col-md-9">
                                        <Select label="text" class="mySelect" v-model="consigment" :options="consigments">
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Packages:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="" v-model="packageCount" class="form-control" id="">
                                    </div>
                                    <div class="col-md-3">
                                        <Select label="text" class="mySelect" v-model="package" :options="packages" name="location" id="location">

                                        </Select>
                                    </div>
                                    <label for="" class="col-md-2 form-label" style="margin-left: 0px;">Weight (Tons):</label>
                                    <div class="col-md-2">
                                        <input type="text" name="" v-model="packageWeight" class="form-control form-control-sm" id="">
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Containers</label>
                                    <div class="col-md-3">
                                        <input type="text" name="" v-model="contCount" class="form-control form-control-sm" id="">
                                    </div>

                                    <div class="col-md-6">
                                        <input type="text" name="" v-model="cont" class="form-control form-control-sm" id="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="" class="col-md-3 col-form-label">Inovice Value:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="" v-model="invoiceCount" class="form-control" id="">
                                    </div>
                                    <div class="col-md-3">
                                        <input type="text" name="" v-model="invoiceis" class="form-control" id="">
                                    </div>
                                    <label for="" class="col-md-2 form-label" style="margin-left: 0px;">Import Value:</label>
                                    <div class="col-md-2">
                                        <input type="text" name="" v-model="importValue" class="form-control" id="">
                                    </div>
                                </div>

                                <div class="form-group row">

                                    <label class="col-md-3 form-label">L/C No.: </label>
                                    <div class="col-md-4 pl-3">
                                        <input class="form-control form-control-sm" v-model="lcno" name="" type="text">

                                    </div>
                                    <label class="col-md-2 form-label">Date: </label>
                                    <div class="col-md-3 pl-0">
                                        <input class="form-control form-control-sm" v-model="lcdate" name="" type="date">

                                    </div>


                                </div>

                                <div class="form-group row">

                                    <label class="col-md-3 form-label">Vessel: </label>
                                    <div class="col-md-4 pl-3">
                                        <input class="form-control form-control-sm" v-model="vessel" name="" type="text">

                                    </div>
                                    <label class="col-md-2 form-label">Arrived: </label>
                                    <div class="col-md-3 pl-0">
                                        <input class="form-control form-control-sm" v-model="vesseldate" name="" type="date">

                                    </div>


                                </div>

                                <div class="form-group row">

                                    <label class="col-md-3 form-label">B/L No.: </label>
                                    <div class="col-md-4 pl-3">
                                        <input class="form-control form-control-sm" v-model="blno" name="" type="text">

                                    </div>
                                    <label class="col-md-2 form-label">Arrived: </label>
                                    <div class="col-md-3 pl-0">
                                        <input class="form-control form-control-sm" name="" v-model="bldate" type="date">

                                    </div>


                                </div>

                                <hr>

                            <h5 style="padding-bottom:5px">Mode of Transportation</h5>

                            <div class="form-group row">
                                <div class="col-md-6">
                                    <input type="radio" v-model.trim="modeIs" name="" id="" value="Rail Road"> <label for="">Rail Road</label>
                                </div>
                                 <div class="col-md-6">
                                    <input type="radio" name="" id="" v-model.trim="modeIs" value="Road Transport"> <label for="">Road Transport</label>
                                </div>
                            </div>

                            <div class="form-group row" v-show="modeIs=='Road Transport'">
                                    <label class="col-md-3 form-label">Transporter: </label>
                                <div class="col-md-7">
                                   <Select name="" class="mySelect" label="text" v-model="transporter" :options="transporters" id=""> </Select>
                                </div>
                                <div class="col-md-2">
                                            <button data-toggle="modal" type="button" data-target="#transporterModal" class="btn btn-primary btn-sm">.....</button>
                                            <!-- Modal -->
                                              <div class="modal fade" id="transporterModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Transporter Details</h5>

                                                    <span aria-hidden="true" data-dismiss="modal" aria-label="Close">X</span>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="col-md-7">
                                                            <div class="row">

                                                            <label class="form-label col-md-2 mt-2 mb-2">Name</label>
                                                             <input v-model="transporterName" class="form-control col-md-10 form-control-sm mt-2 mb-3" >
                                                            <label class="form-label col-md-2">Address</label>
                                                             <input v-model="transporterAddress" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Phone</label>
                                                             <input v-model="transporterPhone" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Contact Person</label>
                                                             <input v-model="transporterContactPerson" class="form-control col-md-10 form-control-sm mb-3">
                                                            <label class="form-label col-md-2">Designation</label>
                                                             <input v-model="transporterDesignation"  class="form-control col-md-10 form-control-sm mb-3">

                                                            <label class="form-label col-md-2 pt-3">City</label>

                                                            <div class="col-md-10 pt-3 pl-0 pr-0">
                                                                <Select name="location"  v-model="transporterCity" label="text" :options="cities" id="location">

                                                                </Select>
                                                            </div>
                                                        </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary" @click="addTransporter()">Save changes</button>
                                                </div>
                                                </div>
                                            </div>
                                            </div>


                                </div>
                            </div>


                                <div class="form-group row">

                                    <label class="col-md-3 form-label">Receipt No.: </label>
                                    <div class="col-md-4 pl-3">
                                        <input class="form-control form-control-sm" v-model="receiptNo" name="" type="text">

                                    </div>
                                    <label class="col-md-2 form-label">Date: </label>
                                    <div class="col-md-3 pl-0">
                                        <input class="form-control form-control-sm" name="" v-model="receiptDate" type="date">

                                    </div>


                                </div>

                                <hr>
                            <h5 style="padding-bottom:5px">Delivered To</h5>

                            <div class="form-group row">
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="delieveredTo" value="Bank"> <label class="form-label">Bank </label>
                                </div>
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="delieveredTo" value="Borrower"> <label class="form-label">Borrower </label>
                                </div>
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="delieveredTo" value="Muccadum"> <label class="form-label">Muccadum </label>
                                </div>
                            </div>

                            <div class="form-group row" v-show="delieveredTo=='Muccadum'">
                                    <label class="col-md-3">Muccadum</label>
                                    <div class="col-md-8">
                                        <Select label="text" v-model="mucName" class="mySelect" :options="muccaduums"></Select>
                                    </div>
                            </div>

                            <hr>
                            <h5 style="padding-bottom:5px">Services Charges</h5>

                            <div class="form-group row">
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="serviceChargeIs" value="Per Container"> <label class="form-label">Per Container </label>
                                </div>
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="serviceChargeIs" value="Break Bulk"> <label class="form-label">Break Bulk </label>
                                </div>
                                <div class="col-md-4">
                                   <input type="radio" name="" id="" v-model.trim="serviceChargeIs" value="Lumpsum"> <label class="form-label">Lumpsum </label>
                                </div>
                            </div>
                            <div class="form-group row" v-show="serviceChargeIs=='Per Container' || serviceChargeIs=='Break Bulk'  ">
                                    <label class="col-md-3 form-label">Rate: </label>
                                    <div class="col-md-6">
                                   <input oninput="this.value = Math.abs(this.value)" type="number" v-model="serviceRate" class="form-control" name="" id="">
                                </div>
                            </div>

                            <div class="form-group row">
                                    <label class="col-md-3 form-label">Service Charges: </label>
                                <div class="col-md-4">
                                   <input oninput="this.value = Math.abs(this.value)" type="number" v-model="serviceCharges"  name="" id="" class="form-control">
                                </div>
                                <div class="col-md-5">
                                   <input type="checkbox" v-model="isSalesTax"  name="" id="" > <label for="" class="form-label">Sales Tax?</label>
                                </div>
                            </div>

                             <hr>
                            <input type="checkbox" name="" id="" v-model="isReceieved"> <label for="" class="form-label" >Received</label>

                            <div class="form-group row" v-show="isReceieved">
                                    <label class="col-md-3 form-label">Received From: </label>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedFrom" value="Bank"  > <label for="" class="form-label">Bank</label>
                                </div>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedFrom" value="Borrower" > <label for="" class="form-label">Borrower</label>
                                </div>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedFrom" value="C&F Agent" > <label for="" class="form-label">C&F Agent</label>
                                </div>
                            </div>

                            <div class="form-group row" v-show="isReceieved">
                                    <label class="col-md-3 form-label">Received Via: </label>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedVia" value="Cash"> <label for="" class="form-label">Cash</label>
                                </div>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedVia" value="Cheque"> <label for="" class="form-label">Cheque</label>
                                </div>
                                <div class="col-md-3">
                                   <input type="radio" name="" id="" v-model.trim="recievedVia" value="P/O"> <label for="" class="form-label">P/O</label>
                                </div>
                            </div>
                            <div class="form-group row mt-2" v-show="recievedVia=='Cheque' || recievedVia=='P/O'">
                                <label class="col-md-3">No</label>
                                <div class="col-md-3">
                                    <input class="form-control form-control-sm"  type="text" v-model="recievedNo">
                                </div>
                                <label class="col-md-3">Date</label>
                                <div class="col-md-3">
                                    <input class="form-control form-control-sm" type="date"  v-model="recievedDate">
                                </div>
                            </div>

                            <hr>

                            <div class="form-group row">
                                    <label class="col-md-3 form-label">Remarks: </label>
                                    <div class="col-md-9">
                                        <textarea v-model="remarks" class="form-control" style="height: 50px;" name="" id="" cols="42"
                                            rows="1"></textarea>
                                    </div>
                            </div>


                                <div class="form-group row" style="padding-right:30px">
                                    <div class="col-md-12">
                                        <a href="/supervision"><input type="button" class="btn btn-primary"
                                                style="float:right;margin:10px" value="Cancel"></a>
                                        <input type="button" @click="onComplete()" v-if="!saveButton"
                                            style="float:right;margin:10px" class="btn btn-primary" value="Save">

                                    </div>
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
    } from 'vuelidate/lib/validators'
    import axios from 'axios'
    import vSelect from 'vue-select'
    import vMultiselect from 'vue-multiselect'
    import 'vue-select/dist/vue-select.css'
    import Autocomplete from '@trevoreyre/autocomplete-vue'
    import '@trevoreyre/autocomplete-vue/dist/style.css'
    export default {
        props: {
            usercompany: String,
            usertoken: String,
            usercompanyname: String,
            usercompanyprefix: String
        },
        components: {
            'Select': vSelect,
            'MultiSelect': vMultiselect,
            Autocomplete
        },
        data() {
            return {
                title: '',
                subtitle: '',
                csTitle: 'Borrower',
                name: '',
                btype: false,
                duplicate: '',
                duplicateIds: [],
                selected: 'Bank',
                selectedBank: '',
                selectedBranch: '',
                // branch:'',
                bankBranch: '',
                billingAddress: '',
                bankRepresentative: '',
                bankDesignation: '',
                customerDesignation: '',
                customerRepresent: '',
                bankPhone: '',
                ibrCustomerFax: '',
                bankEmail: '',
                bankType: '',
                bankletterNo: '',
                bankDate: '',
                company: '',
                block: true,
                region: '',
                companies: [],
                ibrVendors: [],
                banks: [],
                regions: [],
                branches: [],
                cities: [],
                customers: [],
                facilites: [],
                muccaduums: [],
                vendors: [],
                bankName1: '',
                bankCode1: '',
                bankIbr: '',
                // branchBank:'',
                branchCity: '',
                branchName: '',
                branchCode: '',
                branchAddress: '',
                branchPhone: '',
                branchFax: '',
                branchLandline: '',
                customerName: '',
                customerName1: '',
                customerCode: '',
                customerCode1: '',
                customerAddress: '',
                customerAddress1: '',
                customerPhone: '',
                customerFax: '',
                customerFax1: '',
                customerEmail: '',
                customerCNIC: '',
                customerLocation: '',
                customerGst: '',
                customerPhone1: '',
                customerDesignation: '',
                customerDesignation1: '',
                customerPerson: '',
                customerCity: '',
                vendor: '',
                vendorRepresent: '',
                vendorDesignation: '',
                vendorPhone: '',
                vendorEmail: '',
                vendorFax: '',
                vendorLetter: '',
                vendorExpiry: '',
                vendorAddress: '',
                ibrBranchFax: '',
                ibrCustomerNIC: '',
                edd: new Date(),
                types: ['Islamic', 'Conventional'],
                operationalBranch: '',
                saveButton: false,
                iSanotherDest:false,
                fromIs:'',
                terminals:[],
                warehouses:[],
                warehouseName:'',
                warehouseAddress:'',
                godowns:[],
                godownName:'',
                godownAddress:'',
                godownNo:'',
                godownBond:false,
                fromTerminal:'',
                fromWarehouse:'',
                fromWarehouseAddress:'',
                fromGodownLocation:'',
                fromGodownNo:'',
                fromGodownAddress:'',
                isFromGodownBond:false,
                toIs:'',
                toWarehouse:'',
                toWarehouseAddress:'',
                toGodownLocation:'',
                toGodownNo:'',
                toGodownAddress:'',
                istoGodownBond:false,
                thGodownLocation:'',
                thGodownNo:'',
                thGodownAddress:'',
                isthGodownBond:false,
                anIs:'',
                anWarehouse:'',
                anWarehouseAddress:'',
                anGodownLocation:'',
                anGodownNo:'',
                anGodownAddress:'',
                isanGodownBond:false,
                thanGodownLocation:'',
                thanGodownNo:'',
                thanGodownAddress:'',
                isthanGodownBond:false,
                agents:[],
                clearingAgent:'',
                consigments:[],
                consigment:'',
                packageCount:'',
                package:'',
                packages:[],
                packageWeight:'',
                contCount:'',
                cont:'',
                invoiceCount:'',
                invoiceis:'',
                importValue:'',
                lcno:'',
                lcdate:'',
                vessel:'',
                vesseldate:'',
                blno:'',
                bldate:'',
                modeIs:'',
                transporters:[],
                transporter:'',
                receiptNo:'',
                receiptDate:'',
                delieveredTo:'',
                mucName: '',
                serviceChargeIs:'',
                isSalesTax: false,
                serviceRate:'',
                serviceCharges:'',
                recievedFrom:'',
                recievedVia:'',
                remarks:'',
                isReceieved:'',
                recievedNo:'',
                recievedDate:'',
                transporterName:'',
                transporterAddress:'',
                transporterPhone:'',
                transporterContactPerson:'',
                transporterDesignation:'',
                transporterCity:'',
                agentName:'',
                agentAddress:'',
                agentPhone:'',
                agentContactPerson:'',
                agentDesignation:'',
                agentCity:''










            }
        },
        mounted() {
            this.getCompany();
            this.getRegion();
            this.getBanks();
            this.getMuccadums();
            this.getFacilities();
            this.getCity();
            this.getTerminals();
            this.getWarehouses();


            this.getCustomers();
            this.getVendors();
            this.getTaxRegions();
            this.getGodowns();
            this.getClearingAgents();
            this.getConsigments();
            this.getPackages();
            this.getTransporters();

        },
        methods: {


            onComplete: function() {


                        // this.postdata();




                if (this.selected == "Bank") {

                    if (this.$v.form1.$invalid) {
                        this.$v.form1.$touch();
                        var isValid = !this.$v.form1.$invalid
                        this.$emit('on-validate', this.$data, isValid)
                        return isValid
                    } else {
                        this.postdata();
                    }

                }

                if (this.selected == "Customers") {
                    if (this.$v.form2.$invalid) {
                        this.$v.form2.$touch();
                        var isValid = !this.$v.form2.$invalid
                        this.$emit('on-validate', this.$data, isValid)
                        return isValid
                    } else {
                        this.postdata();
                    }

                }

                if (this.selected == "Vendors") {

                    if (this.$v.form3.$invalid) {
                        this.$v.form3.$touch();
                        var isValid = !this.$v.form3.$invalid
                        this.$emit('on-validate', this.$data, isValid)
                        return isValid
                    } else {
                        this.postdata();
                    }

                }





            },
              updateStats: function(){

            axios.post('/updateStatsLog')
            .then(res=>{
                // alert('Stats Updated');


            })
            .catch(error=>{
            });


            },
            postdata() {

                this.saveButton = true;

                var month = this.edd.getMonth() + 1;
                var eddate = this.edd.getFullYear() + "-" + month + "-" + this.edd.getDate();
                //   var string=this.$refs.ibrCompany.value;
                //  var cmpname=string.replace(/[{()}^0-9-]/g, "");



                const jobData = {
                    regional_prefix: this.region.prefix,
                    company_prefix: this.company.prefix,
                    bank_prefix: this.selectedBank.prefix,
                    job_by: this.company.value,
                    given_by: this.selected,
                    regional_id: this.region.value,
                    bank_id: this.selectedBank.value,
                    branch_id: this.bankBranch.value,
                    bank_address: this.billingAddress,
                    bank_representative: this.bankRepresentative,
                    bank_designation: this.bankDesignation,
                    bank_phone: this.bankPhone,
                    bank_fax: this.ibrBranchFax,
                    bank_email: this.bankEmail,
                    bank_letter: this.bankletterNo,
                    letter_date: this.bankDate,
                    val_vendor_id: this.vendor.value,
                    val_billing_address: this.vendorAddress,
                    val_vendor_representaive: this.vendorRepresent,
                    val_vendor_designation: this.vendorDesignation,
                    val_vendor_phone: this.vendorPhone,
                    val_vendor_fax: this.vendorFax,
                    val_vendor_email: this.vendorEmail,
                    val_vendor_letter: this.vendorLetter,
                    val_vendor_date: this.vendorExpiry,
                    customer_id: this.customerName.value,
                    customer_representative: this.customerRepresent,
                    customer_designation: this.customerDesignation,
                    customer_phone: this.customerPhone,
                    customer_cnic: this.ibrCustomerNIC,
                    customer_location: this.customerLocation,
                    customer_email: this.customerEmail,
                    operationalBranch:this.operationalBranch.value,
                    from_is:this.fromIs,
                    fpt_terminal:this.fromTerminal.value,
                    fbw_warehouse:this.fromWarehouse.value,
                    fbw_address:this.fromWarehouseAddress,
                    fpp_location:this.fromGodownLocation.value,
                    fpp_godown_no:this.fromGodownNo,
                    fpp_address:this.fromGodownAddress,
                    fpp_bond:this.isFromGodownBond,
                    to_is:this.toIs,
                    tbw_warehouse:this.toWarehouse.value,
                    tbw_address:this.toWarehouseAddress,
                    tpp_location:this.toGodownLocation.value,
                    tpp_godwill:this.toGodownNo,
                    tpp_addresss:this.toGodownAddress,
                    tpp_bond:this.istoGodownBond,
                    th_godown_location:this.thGodownLocation.value,
                    th_godown_no:this.thGodownNo,
                    is_th_godown_bond:this.isthGodownBond,
                    th_godown_address:this.thGodownAddress,
                    is_another_destination:this.iSanotherDest,
                    another_is:this.anIs,
                    dbw_warehouse:this.anWarehouse.value,
                    dbw_address:this.anWarehouseAddress,
                    dpp_location:this.anGodownLocation.value,
                    dpp_godown_no:this.anGodownNo,
                    dpp_bond:this.isanGodownBond,
                    dpp_address:this.anGodownAddress,
                    dpg_location:this.thanGodownLocation.value,
                    dpg_godown_no:this.thanGodownNo,
                    dpg_bond:this.isthanGodownBond,
                    dpg_address:this.thanGodownAddress,
                    clearing_agent:this.clearingAgent.value,
                    consignment:this.consigment.value,
                    package_unit:this.packageCount,
                    package_is:this.package.value,
                    weight:this.packageWeight,
                    container_number:this.cont,
                    container_unit:this.contCount,
                    invoice_value:this.invoiceCount,
                    invoice_value_code:this.invoiceIs,
                    import_value_unit:this.importValue,
                    lc_no:this.lcno,
                    lc_date:this.lcdate,
                    vessel_no:this.vessel,
                    vessel_arrived:this.vesseldate,
                    bl_no:this.blno,
                    bl_date:this.bldate,
                    transportation_is:this.modeIs,
                    rr_receipt_no:this.receiptNo,
                    rr_date:this.receiptDate,
                    rt_transporter:this.transporter.value,
                    delivered_to:this.delieveredTo,
                    dtm_muccadum:this.mucName.value,
                    serv_chrg_is:this.serviceChargeIs,
                    service_rate:this.serviceRate,
                    service_charges:this.serviceCharges,
                    is_sales_tax:this.isSalesTax,
                    is_received:this.isReceieved,
                    rec_from:this.recievedFrom,
                    rec_via:this.recievedVia,
                    rec_via_date:this.recievedDate,
                    rec_via_no:this.recievedNo,
                    remarks:this.remarks,





                };
                console.log(jobData);
                const headers = {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/json'
                };



                axios.post('/api/addSupervisionjob', jobData, {
                        headers: headers
                    })
                    .then(res => {
                        this.saveButton = false;
                          this.updateStats();
                        alert('Job is successfully created')
                        window.location.href = "/home";
                        return false;
                    })
                    .catch(error =>{
                        this.saveButton = false;
                        alert(error);
                    })


            },
            getTaxRegions() {
                axios.get("/getSalesRegion")
                    .then(res => {

                            res.data.forEach((obj) => {
                            let text = '';
                            let value = '';
                            this.salesRegion.push({
                                text: obj.name,
                                value: obj.id
                            });
                        })
                    })
                    .catch(error => {

                        console.log(error.response);


                    });


            },
            getCity() {
                axios.get('/getCities')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.cities.push({
                                text: obj.city_name,
                                value: obj.city_id
                            })

                        })
                    })

            },
            getTerminals() {
                this.terminals=[];
                axios.get('/getTerminalsForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.terminals.push({
                                text: obj.terminal_name,
                                value: obj.id
                            })

                        })
                    })

            },
            getWarehouses() {
                this.warehouses=[];
                axios.get('/getWarehousesForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.warehouses.push({
                                text: obj.warehouse_name,
                                value: obj.id
                            })

                        })
                    })

            },
            getGodowns() {
                this.godowns=[];
                axios.get('/getGodownsForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.godowns.push({
                                text: obj.name,
                                value: obj.id
                            })

                        })
                    })

            },
            getWarehouseAddressForFrom() {

                 let id = this.fromWarehouse.value;
                axios.get("/getWarehouseAddressForFrom/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            // this.branch=obj.branch_name;

                           this.fromWarehouseAddress=obj.warehouse_address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },
            getWarehouseAddressForTo() {

                 let id = this.toWarehouse.value;
                axios.get("/getWarehouseAddressForFrom/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            // this.branch=obj.branch_name;

                           this.toWarehouseAddress=obj.warehouse_address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },
            getWarehouseAddressForAn() {

                 let id = this.anWarehouse.value;
                axios.get("/getWarehouseAddressForFrom/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            // this.branch=obj.branch_name;

                           this.anWarehouseAddress=obj.warehouse_address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },
            getGodownDataForFrom() {

                 let id = this.fromGodownLocation.value;
                axios.get("/getGodownData/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            this.fromGodownNo=obj.godown_no;
                            this.isFromGodownBond=obj.is_bond==0?false:true;
                           this.fromGodownAddress=obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },
            getGodownDataForTo() {

                 let id = this.toGodownLocation.value;
                axios.get("/getGodownData/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            this.toGodownNo=obj.godown_no;
                            this.istoGodownBond=obj.is_bond==0?false:true;
                           this.toGodownAddress=obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },
            getGodownDataForAn() {

                 let id = this.anGodownLocation.value;
                axios.get("/getGodownData/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            this.anGodownNo=obj.godown_no;
                            this.isanGodownBond=obj.is_bond==0?false:true;
                           this.anGodownAddress=obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },

            getGodownDataForthree() {

                 let id = this.thGodownLocation.value;
                axios.get("/getGodownData/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            this.thGodownNo=obj.godown_no;
                            this.isthGodownBond=obj.is_bond==0?false:true;
                           this.thGodownAddress=obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },

            getGodownDataForthreeAn() {

                 let id = this.thanGodownLocation.value;
                axios.get("/getGodownData/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            this.thanGodownNo=obj.godown_no;
                            this.isthanGodownBond=obj.is_bond==0?false:true;
                           this.thanGodownAddress=obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });

            },

             getClearingAgents() {
                this.agents=[];
                axios.get('/getAgentsForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.agents.push({
                                text: obj.name,
                                value: obj.id
                            })

                        })
                    })

            },
             getConsigments() {
                this.consigments=[];
                axios.get('/getConsigmentsForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.consigments.push({
                                text: obj.name,
                                value: obj.id
                            })

                        })
                    })

            },
             getPackages() {
                this.packages=[];
                axios.get('/getPackagesForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.packages.push({
                                text: obj.name,
                                value: obj.id
                            })

                        })
                    })

            },
             getTransporters() {
                this.transporters=[];
                axios.get('/getTransportersForSupervision')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.transporters.push({
                                text: obj.name,
                                value: obj.id
                            })

                        })
                    })

            },

            getBanks() {
                this.banks = [];
                axios.get('/getBanks')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = '';
                            let value = '';
                            let prefix = "";
                            this.banks.push({
                                text: obj.bank_name,
                                value: obj.bank_id,
                                prefix: obj.bank_code
                            })
                        })
                    })
            },
            getMuccadums() {
                this.muccaduums = [];
                axios.get('/api/getMuccadums', {
                        headers: {
                            'Authorization': 'Bearer ' + this.usertoken,
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = '';
                            let id = '';
                            this.muccaduums.push({
                                text: obj.muc_name,
                                value: obj.id
                            })
                        })
                    })
            },
            getFacilities() {
                this.facilites = [];
                axios.get('/api/getFacilities', {
                        headers: {
                            'Authorization': 'Bearer ' + this.usertoken,
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = '';
                            let id = '';
                            this.facilites.push({
                                text: obj.facility_name,
                                id: obj.id
                            })
                        })
                    })
            },


            getIslamicBanks() {
                this.banks = [];
                this.branches = [];
                this.bankBranch = '';
                this.billingAddress = '';

                axios.get('/getIslamicBanks')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = '';
                            let value = '';
                            let prefix = "";
                            this.banks.push({
                                text: obj.bank_name,
                                value: obj.bank_id,
                                prefix: obj.bank_code
                            })
                        })
                    })
            },
            getBranches($id) {
                this.branches = [];
                this.bankBranch = '';
                this.billingAddress = "";
                this.block = false;
                let id = this.selectedBank.value;
                axios.get("/getBranches/" + id) //with id
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = '';
                            let value = '';
                            this.branches.push({
                                text: obj.branch_name,
                                value: obj.branch_id
                            });


                        })
                    })
                    .catch(error => {
                        console.log(error.response);
                    });
            },
            getBranchById() {

                if (this.selectedBranch == "") {
                    this.bankBranch = "";
                    this.billingAddress = '';
                } else {
                    //    alert(this.selectedBranch);
                    //    this.bankBranch=this.branches[this.selectedBranch];


                    let id = this.selectedBranch;

                    axios.get("/getBranchById/" + id) //with id
                        .then(res => {

                            res.data.forEach((obj) => {
                                let text = '';
                                let value = '';
                                this.branches.push({
                                    text: obj.branch_name,
                                    value: obj.branch_id
                                });
                                this.bankBranch = obj.branch_name;
                                this.billingAddress = obj.branch_address;

                            })
                        })
                        .catch(error => {

                            console.log(error.response);
                            this.branches = [];
                            this.bankBranch.label = '';
                            this.billingAddress = '';

                        });
                }
                // this.branches=[];



            },




            getAddress() {
                let id = this.bankBranch.value;
                axios.get("/getBranchById/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            // this.branch=obj.branch_name;
                            this.billingAddress = obj.branch_address;
                            this.bankPhone = obj.branch_phone;
                        })
                    })
                    .catch(error => {
                        this.billingAddress == '';
                        console.log(error.response);


                    });
            },

            getCustomer() {
                let id = this.customerName.value;
                axios.get("/getCustomerById/" + id) //with id
                    .then(res => {

                        res.data.forEach((obj) => {

                            // this.branches.push({text:obj.branch_name,value:obj.branch_id});
                            // this.branch=obj.branch_name;

                            this.customerPhone = obj.cust_phone;
                            this.ibrCustomerNIC = obj.ntn;
                            this.customerRepresent = obj.cust_contact_person;
                            this.customerDesignation = obj.cust_designation;
                            this.customerLocation = obj.address;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });
            },
            getCompany() {
                axios.get('/getCompany')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            let prefix = "";
                            this.companies.push({
                                text: obj.company_name,
                                value: obj.company_id,
                                prefix: obj.company_prefix
                            })
                            this.company = {
                                text: this.usercompanyname,
                                value: this.usercompany,
                                prefix: this.usercompanyprefix
                            }

                        })
                    })
            },
            getRegion() {
                axios.get('/getRegion')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            let prefix = "";
                            this.regions.push({
                                text: obj.city_name,
                                value: obj.reg_id,
                                prefix: obj.reg_prefix
                            })

                        })
                    })
            },
            getBanksByIslam() {
                if (this.btype == true) {
                    this.branches = [];
                    this.selectedBank = '';
                    this.selectedBranch = '';

                    this.getIslamicBanks();
                } else {
                    this.branches = [];
                    this.selectedBank = '';
                    this.selectedBranch = '';

                    this.getBanks();
                }
            },

            addBranch() {

                if (this.$v.branchModal.$invalid) {
                    this.$v.branchModal.$touch();
                    var isValid = !this.$v.branchModal.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const branchData = {
                        branch_bank_id: this.selectedBank.value,
                        branch_city_id: this.branchCity.value,
                        branch_code: this.branchCode,
                        branch_name: this.branchName,
                        branch_address: this.branchAddress,
                        branch_phone: this.branchPhone,
                        branch_landline: this.branchLandline
                    };

                    axios.post('/addBranch', branchData)
                        .then(res => {
                            this.branches = [];
                            this.getBranches();
                            alert('Branch Inserted');
                            $('.bd-example-modal-lg').modal('hide');
                            this.branchCity = '';
                            this.branchCode = '';
                            this.branchName = '';
                            this.branchAddress = '';
                            this.branchPhone = '';
                            this.branchLandline = '';

                        })
                        .catch(error => alert(error))
                }


            },
            addCustomer() {

                if (this.$v.customer.$invalid) {
                    this.$v.customer.$touch();
                    var isValid = !this.$v.customer.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const customerData = {
                        cust_city_id: this.customerCity.value,
                        cust_name: this.customerName1,
                        cust_phone: this.customerPhone1,
                        cust_fax: this.customerFax1,
                        cust_contact_person: this.customerPerson,
                        cust_designation: this.customerDesignation1,
                        cust_part_code: this.customerCode1,
                        address: this.customerAddress1,
                        ntn: this.customerCNIC,
                        gst: this.customerGst,
                        service: "Supervision",

                    };

                    axios.post('/addCustomer', customerData)
                        .then(res => {
                            this.customers = [];
                            this.getCustomers();
                            alert('Customer Created');
                            $('#customerModal').modal('hide');
                            this.customerCity = '';
                            this.customerName1 = '';
                            this.customerPhone1 = '';
                            this.customerFax1 = '';
                            this.customerPerson = '';
                            this.customerDesignation1 = '';
                            this.customerCode1 = '';
                            this.customerAddress1 = '';
                            this.customerCNIC = '';
                            this.customerGst = '';


                        })
                        .catch(error => alert(error))
                }




            },
            addBank() {


                if (this.$v.bank.$invalid) {
                    this.$v.bank.$touch();
                    var isValid = !this.$v.bank.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const bankData = {
                        bank_name: this.bankName1,
                        bank_code: this.bankCode1,
                        bank_type: this.bankType,
                        bank_ibr_rate: this.bankIbr
                    };

                    axios.post('/addBank', bankData)
                        .then(res => {
                            this.banks = [];
                            this.getBanks();
                            alert('Bank Inserted');
                            $('#bankModal').modal('hide');
                            this.bankName1 = '';
                            this.bankCode1 = '';
                            this.bankType1 = '';
                            this.bankIbr = '';
                        })
                        .catch(error => alert(error))

                }
            },
            addWarehouse() {


                if (this.$v.warehouse.$invalid) {
                    this.$v.warehouse.$touch();
                    var isValid = !this.$v.warehouse.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const warehouse = {
                        warehouse_name: this.warehouseName,
                        warehouse_address: this.warehouseAddress
                    };

                    axios.post('/addWarehouse', warehouse)
                        .then(res => {
                            this.warehouses = [];
                            this.fromWarehouseAddress='';
                            this.getWarehouses();
                            alert('Warehouse Inserted');
                            $('#warehouseModal').modal('hide');

                        })
                        .catch(error => alert(error))

                }
            },
            addGodown() {


                if (this.$v.godown.$invalid) {
                    this.$v.godown.$touch();
                    var isValid = !this.$v.godown.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const godown = {
                        name: this.godownName,
                        godown_no: this.godownNo,
                        is_bond: this.godownBond,
                        godown_address: this.godownAddress
                    };

                    axios.post('/addGodown', godown)
                        .then(res => {
                            this.godown = [];

                            this.getGodowns();
                            alert('Godown Inserted');
                            $('#godownModal').modal('hide');

                        })
                        .catch(error => alert(error))

                }
            },
            addTransporter(){

                  const transporter = {
                        name: this.transporterName,
                        address: this.transporterAddress,
                        phone: this.transporterPhone,
                        contact_person: this.transporterContactPerson,
                        designation: this.transporterDesignation,
                        city: this.transporterCity.value
                    };

                    axios.post('/addTransporter', transporter)
                        .then(res => {
                            this.transporter = [];

                            this.getTransporters();
                            alert('Transporter Inserted');
                            $('#transporterModal').modal('hide');

                        })
                        .catch(error => alert(error))

            },
            addAgent(){
                const agent = {
                     name: this.agentName,
                        address: this.agentAddress,
                        phone: this.agentPhone,
                        contact_person: this.agentContactPerson,
                        designation: this.agentDesignation,
                        city: this.agentCity.value
                    };

                    axios.post('/addAgent', agent)
                        .then(res => {
                            this.agent = [];

                            this.getClearingAgents();
                            alert('Clearing Agent Inserted');
                            $('#agentModal').modal('hide');

                        })
                        .catch(error => alert(error))
            },

            addCompany() {


                if (this.$v.companyModal.$invalid) {
                    this.$v.companyModal.$touch();
                    var isValid = !this.$v.companyModal.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                } else {
                    const cmpData = {
                        name: this.companyName1,
                        address: this.companyAddress1,
                        street: this.companyStreet1,
                        po_box: this.companyPobox1,
                        country_id: this.companyCountry1.value,
                        email: this.companyEmail1,
                        fax: this.companyFax1,
                        website: this.companyWebsite1,
                        registration_id: this.companyReg1
                    };

                    axios.post('/addCompany', cmpData)
                        .then(res => {
                            this.ibrCompanies = [];
                            this.ibrCountry = "";
                            alert('Company Created');
                            $('#companyModal').modal('hide');
                            this.companyName1 = '';
                            this.companyAddress1 = '';
                            this.companyStreet1 = '';
                            this.companyPobox1 = '';
                            this.companyCountry1 = '';
                            this.companyEmail1 = '';
                            this.companyFax1 = '';
                            this.companyWebsite1 = '';
                            this.companyReg1 = '';

                        })
                        .catch(error => alert(error))
                }

            },

            getCustomers() {
                const params = {
                    service:"Supervision"
                }
                axios.get('/getCustomers',{params})
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.customers.push({
                                text: obj.cust_name,
                                value: obj.cust_id
                            })

                        })
                    })
            },
            getVendors() {
                axios.get('/getVendors')
                    .then(res => {
                        res.data.forEach((obj) => {
                            let text = "";
                            let value = "";
                            this.vendors.push({
                                text: obj.name,
                                value: obj.id
                            });
                            this.ibrVendors.push({
                                text: obj.name,
                                value: obj.id
                            });

                        })
                    })
            },
            getVendorAddress() {
                let id = this.vendor.value;
                axios.get("/getVendorById/" + id) //with id
                    .then(res => {
                        res.data.forEach((obj) => {

                            this.vendorAddress = obj.address;
                            this.vendorPhone = obj.phone_number;
                            this.vendorEmail = obj.email;
                            this.vendorFax = obj.fax;
                        })
                    })
                    .catch(error => {
                        console.log(error.response);


                    });
            },
            clear1() {
                this.csTitle = "Borrower";
                this.vendorAddress = "";
                this.vendor = "";
                this.vendorRepresent = "";
                this.vendorDesignation = "";
                this.vendorPhone = "";
                this.vendorEmail = "";
                this.vendorFax = "";
                this.vendorLetter = "";
                this.vendorExpiry = "";
            },
            clear2() {
                this.csTitle = "Customer";
                this.vendorAddress = "";
                this.vendor = "";
                this.vendorRepresent = "";
                this.vendorDesignation = "";
                this.vendorPhone = "";
                this.vendorEmail = "";
                this.vendorFax = "";
                this.vendorLetter = "";
                this.vendorExpiry = "";
                this.selectedBank = "";
                this.btype = false;
                this.selectedBranch = "";
                this.bankBranch = "";
                this.billingAddress = "";
                this.bankRepresentative = "";
                this.bankDesignation = "";
                this.bankPhone = "";
                this.ibrBranchFax = "";
                this.bankEmail = "";
                this.bankletterNo = "";
                this.bankDate = "";
            },
            clear3() {
                this.csTitle = "Borrower";
                this.selectedBank = "";
                this.btype = false;
                this.selectedBranch = "";
                this.bankBranch = "";
                this.billingAddress = "";
                this.bankRepresentative = "";
                this.bankDesignation = "";
                this.bankPhone = "";
                this.ibrBranchFax = "";
                this.bankEmail = "";
                this.bankletterNo = "";
                this.bankDate = "";
            }
        },
        validations: {
            name: {
                required,
                minLength: minLength(4)
            },
            selected: {
                required
            },
            company: {
                required
            },
            region: {
                required
            },
            // branch:{
            //   required
            // },
            selectedBank: {
                required
            },
            operationalBranch: {
                required
            },
            bankBranch: {
                required
            },
            billingAddress: {
                required
            },
            bankRepresentative: {
                required
            },
            bankDesignation: {
                required
            },
            bankPhone: {
                required
            },
            bankEmail: {
                required,
                email
            },
            bankletterNo: {
                required
            },
            bankDate: {
                required
            },
            bankName1: {
                required
            },
            bankCode1: {
                required
            },
            bankType: {
                required
            },
            bankIbr: {
                required
            },
            customerName: {
                required
            },
            customerName1: {
                required
            },
            customerCode1: {
                required
            },
            customerPhone: {
                required
            },
            customerDesignation: {
                required
            },
            customerDesignation1: {
                required
            },
            customerRepresent: {
                required
            },
            customerPhone: {
                required
            },
            customerPhone1: {
                required
            },
            customerCNIC: {
                required
            },
            customerGst: {
                required
            },
            customerFax1: {
                required
            },
            customerEmail: {
                required,
                email
            },
            customerPerson: {
                required
            },
            customerAddress1: {
                required
            },
            customerCity: {
                required
            },
            vendor: {
                required
            },
            vendorAddress: {
                required
            },
            vendorRepresent: {
                required
            },
            vendorDesignation: {
                required
            },
            vendorPhone: {
                required
            },
            vendorEmail: {
                required,
                email
            },
            vendorLetter: {
                required
            },
            vendorExpiry: {
                required
            },
            ibrCountry: {
                required
            },
            vaddress: {
                required
            },
            vendorIbr: {
                required
            },
            reportIbr: {
                required
            },
            delivery: {
                required
            },
            edd: {
                required
            },
            exRates: {
                required
            },
            serviceCharge: {
                required
            },
            branchName: {
                required
            },
            branchCity: {
                required
            },
            branchAddress: {
                required
            },
            branchPhone: {
                required
            },
            branchLandline: {
                required
            },
            branchCode: {
                required
            },
            companyName1: {
                required
            },
            companyCountry1: {
                required
            },
            companyAddress1: {
                required
            },
            category: {
                required
            },
            subcategory: {
                required
            },
            vcity: {
                required
            },
            district: {
                required
            },
            outOfPockets: {
                required
            },
            assetClass: {
                required
            },
            warehouseName: {
                required
            },
            warehouseAddress: {
                required
            },
            godownName:{
                required
            },
            godownAddress:{
                required
            },
            form1: [
                'selected',
                'company',
                'region',
                'selectedBank',
                'bankBranch',
                'billingAddress',
                'bankRepresentative',
                'bankDesignation',
                'bankPhone', 'bankEmail',
                'bankletterNo',
                'bankDate',
                'customerDesignation',
                'customerRepresent',
                'customerName',
                'customerPhone',
                // 'customerEmail',
                'operationalBranch',
            ],

            form2: [
                'selected',
                'company',
                'region',
                'customerName',
                'customerPhone',
                // 'customerEmail',
                'customerDesignation',
                'customerRepresent',
                'operationalBranch',

            ],

            form3: [
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
                // 'vendorEmail',
                'vendorLetter',
                'vendorExpiry',
                'customerDesignation',
                'customerRepresent',
                'customerName',
                'customerPhone',
                'customerEmail',
                'operationalBranch',

            ],


            customer: [
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
            bank: [
                'bankName1',
                // 'bankCode1',
                // 'bankIbr',
                'bankType'
            ],
           warehouse: [
                'warehouseName',
                // 'bankCode1',
                // 'bankIbr',
                'warehouseAddress'
            ],
           godown: [
                'godownName',
                // 'bankCode1',
                // 'bankIbr',
                'godownAddress'
            ],
            branchModal: [
                'branchName',
                'branchCity',
                'branchAddress',
                'branchPhone',
                'branchCode'
            ],
            companyModal: [
                'companyName1',
                'companyCountry1',
                'companyAddress1'
            ]


        }
    }
</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style scoped>
    label {
        font-size: 13px !important
    }

    .mySelect {
        height: 30px !important;
        font-size: 12px !important
    }

    input[type="text"],
    input[type="date"],
    input[type="number"] {
        height: 30px !important;
        font-size: 12px !important
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
        padding: 0px 0px 0px 0px !important
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
        font-size: 12px !important
    }

    .date-invalid {
        border: #dc3545 1px solid;
        background-color: #ffc9aa;
        height: 30px !important;
        font-size: 12px !important
    }

    .wizard-icon-container {
        background-color: black !important
    }

    .category {
        display: none
    }

    .vue-form-wizard .wizard-title {
        display: none
    }

    .form-group {
        margin-bottom: 0.3rem !important;
    }

    .multiselect {
        padding: 4px 0px 4px 0px;
    }

    .btn-sm{
        font-size:11px
    }
</style>
