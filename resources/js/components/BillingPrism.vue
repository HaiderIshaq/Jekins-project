    <template>
     <div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
        <a href="/home" class="btn btn-primary">Back</a><a href="/posts" class="btn btn-primary ml-2">Posts</a>    <br><br>
        <!-- <b>Bills Prism: </b>{{amounts}} <br>
        <b>Jobs: </b> {{jobs}} <br> -->

        <div class="row mt-3">
                <div class="col-md-6">
                    <div id="section1 ">

                        <div class="form-group row ">
                            <label class="col-md-3 ">Region: </label>
                            <div class="col-md-4 pl-0 pr-0">
                            <input type="text" class="form-control" v-model="region" readonly name="" id="">
                            </div>
                            <div class="col-md-5">
                                <div class="form-check">
                                    <input type="checkbox"  class="form-check-input input-sm"  v-model="isAdvance" id="advance"  name="type" value="Yes">
                                    <label for="advance" class="form-check-label input-sm mt-1" >Advance Receipt</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="col-md-3 ">Company: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" class="mySelect" v-model="company" :clearable="false" :options="companies"></Select>
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-md-3 ">Receviable For: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" class="mySelect" v-model="receivable" :reduce="regions => `${regions.value}`"  multiple :options="regions" ></Select>
                            </div>

                        </div>
                        <!-- <div class="form-group row ">
                            <label class="col-md-3 ">Select Service: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" class="mySelect" v-model="service" :clearable="false" :options="services" ></Select>
                            </div>
                        </div> -->
                        <div class="form-group row ">
                            <label class="col-md-3 ">Insurers: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" class="mySelect" v-model="bank" :options="banks"></Select>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="col-md-3 ">Customer: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" class="mySelect" :options="customers" v-model="customer" ></Select>
                            </div>
                        </div>
                        <div class="form-group row ">
                            <label class="col-md-3 ">Invoice No: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <input type="text" class="form-control" v-model="invoiceId">
                            </div>
                        </div>

<!-- :disabled-dates="disabledDates" -->
                        <div class="form-group row">
                            <label class="col-md-3 ">Recieved On: </label>
                            <div class="col-md-5 pl-0 ">
                               <datepicker  :input-class="[{'date-invalid':$v.recievedOn.$error},'form-control']"   valueType="format" :format="'d/M/yy'"   v-model="recievedOn" ></datepicker>
                                <div v-if="$v.recievedOn.$error">
                                        <p class=" text-danger" v-if="!$v.recievedOn.required">Please input date</p>
                                    </div>
                            </div>
                            <div class="col-md-4">
                                    <button class="btn btn-primary btn-sm " style="font-size:12px"  type="button" @click="filterResult"  >Show Bills</button>

                            </div>
                        </div>

                        <div class="form-group row ">
                            <label class="col-md-3 ">Instrument: </label>
                            <div class="col-md-8 pl-0 pr-0">
                                <Select  label="text" v-model="instrument" :class="{'date-invalid':$v.instrument.$error}" @input="showFields()" class="mySelect" :options="instruments"  ></Select>
                                <div v-if="$v.instrument.$error">
                                        <p class=" text-danger" v-if="!$v.instrument.required">Please select instrument</p>
                                    </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">Number: </label>
                            <div class="col-md-4 pl-0 pr-0">
                                <input class="form-control input-sm" :class="{'date-invalid':$v.instrumentNumber.$error}" v-model="instrumentNumber" id="instNum" type="text">
                                <div v-if="$v.instrumentNumber.$error">
                                    <p class=" text-danger" v-if="!$v.instrumentNumber.required">Please select instrument</p>
                                </div>

                            </div>

                            <div class="col-md-4  pr-0">
                               <datepicker  :input-class="[{'date-invalid':$v.instrumentDate.$error},'form-control']"  valueType="format" format="d/M/yy" v-model="instrumentDate" ></datepicker>
                            <div v-if="$v.instrumentDate.$error">
                                    <p class=" text-danger" v-if="!$v.instrumentDate.required">Please select instrument date</p>
                                </div>
                            </div>

                        </div>


                        <div class="form-group row ">
                            <label class="col-md-3 ">Deposited In: </label>
                            <div class="col-md-4 pl-0 pr-0">
                                <Select  label="text" :options="accounts" :class="{'date-invalid':$v.account.$error}" class="mySelect" v-model="account" ></Select>
                                <div v-if="$v.account.$error">
                                    <p class=" text-danger" v-if="!$v.account.required">Please select some option</p>
                                </div>
                            </div>
                            <div class="col-md-4  pr-0">
                               <datepicker  :input-class="[{'date-invalid':$v.instrumentDate.$error},'form-control']"  valueType="format" format="d/M/yy" v-model="depositOn" ></datepicker>
                                <div v-if="$v.depositOn.$error">
                                    <p class=" text-danger" v-if="!$v.depositOn.required">Please select deposit date</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 mt-1 ">Slip No: </label>

                            <div class="col-md-8 pl-0 pr-0">
                                    <input class="form-control input-sm" tabindex="1" :class="{'date-invalid':$v.slipNo.$error}" v-model="slipNo"  type="text"   >
                                    <div v-if="$v.slipNo.$error">
                                    <p class=" text-danger" v-if="!$v.slipNo.required">Please input slip number</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">Gross Amount: </label>
                            <div class="col-md-4 pl-0">
                                <input tabindex="2" class="form-control input-sm" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))" :class="{'date-invalid':$v.gross.$error}" v-model="gross"  name="txtDate" type="number" >
                                <div v-if="$v.gross.$error">
                                    <p class=" text-danger" v-if="!$v.gross.required">Please input gross number</p>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">I/Tax: </label>
                            <div class="col-md-8 pl-0">
                                <div class="row">

                                    <label class="col-md-2" >Value: </label>
                                    <input  class="form-control input-sm col-md-2" v-model="itamount"   type="text" tabindex="3" >
                                    <label class="col-md-1" >%: </label>
                                    <input tabindex="4" class="form-control input-sm col-md-2" v-model="itper"  type="number"   onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                                    <label class="col-md-2">Amount: </label>
                                    <input tabindex="5" class="form-control input-sm col-md-3" readonly v-model="itax"  type="number" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">

                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">S/Tax: </label>
                            <div class="col-md-8 pl-0">
                                <div class="row">
                                    <label class="col-md-2" >Value: </label>
                                    <input class="form-control input-sm col-md-2" tabindex="6" v-model="stamount" type="number"   onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                                    <label class="col-md-1" >%: </label>
                                    <input class="form-control input-sm col-md-2" tabindex="7" v-model="stper"   type="text"   >
                                    <label class="col-md-2">Amount: </label>
                                    <input class="form-control input-sm col-md-3 " tabindex="8" readonly  v-model="stax"  onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">Bank Charges: </label>
                            <div class="col-md-3 pl-0">
                                <input class="form-control input-sm" v-model="bcharges" tabindex="9" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                            </div>
                            <label class="col-md-2 mt-1 ">Excessive Amount: </label>

                            <div class="col-md-3  pr-0">
                                    <input class="form-control input-sm" v-model="extra" tabindex="10" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-3 ">Net Amount: </label>
                            <div class="col-md-3 pl-0">
                                <input class="form-control input-sm" tabindex="11"  v-model="net" readonly :class="{'date-invalid':$v.net.$error}">
                                <div v-if="$v.net.$error">
                                    <p class=" text-danger" v-if="!$v.net.required">It should not be left empty</p>
                                </div>
                            </div>
                            <label class="col-md-2 mt-1 ">Selected Bills: </label>

                            <div class="col-md-3  pr-0">
                                <input class="form-control input-sm" tabindex="12"  v-model="bill" readonly  type="number" :class="{'date-invalid':$v.bill.$error}">
                                <div v-if="$v.bill.$error">
                                    <p class=" text-danger" v-if="!$v.bill.required">It should not be left empty</p>
                                </div>
                            </div>
                        </div>


                        <div class="form-group row pb-3" v-show="insscan" >
                            <label class="col-md-3 col-form-label">Instrument Scan: </label>
                            <div class="col-md-7 pl-0 pr-0" >
                                <input type="file" class="form-control  form-control-sm" ref="instrumentScan" @change="getInstrumentFile" :class="{ 'date-invalid': $v.instrumentScan.$error }">
                                <div v-if="$v.instrumentScan.$error">
                                        <p class=" text-danger" v-if="!$v.instrumentScan.required">This file is required</p>
                                    </div>
                            </div>
                            <div class="col-md-1">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#instrumentScanModal">......</button>
                            </div>
                        </div>

                        <div class="modal fade" id="instrumentScanModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">

                            <div class="modal-body">
                                <img style="max-height:500px;max-width:100%" v-if="instrumentScanis" :src="instrumentScanis">

                            </div>

                            </div>
                        </div>

                        </div>
                        <div class="form-group row pb-3"  v-show="depscan">
                            <label class="col-md-3 col-form-label">Dep. Slip Scan: </label>
                            <div class="col-md-7 pl-0 pr-0" >
                                <input type="file" class="form-control  form-control-sm" ref="slipScan"  @change="getSlipScan" :class="{ 'date-invalid': $v.slipScan.$error }"  >
                                    <div v-if="$v.slipScan.$error">
                                        <p class=" text-danger" v-if="!$v.slipScan.required">This file is required</p>
                                    </div>
                                    <input type="checkbox" name="" id="back" class="mt-3">
                                    <label for="back">Back Date</label>
                            </div>

                             <div class="col-md-1">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#depScanModal">......</button>
                            </div>



                        </div>
                        <div class="modal fade" id="depScanModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                            <div class="modal-content">

                            <div class="modal-body">
                                <img style="max-height:500px;max-width:100%" v-if="depSlipScanis" :src="depSlipScanis">

                            </div>

                            </div>
                        </div>

                        </div>


                        <div class="form-group row">

                            <label class="col-md-3">Remarks</label>
                            <div class="col-md-8 pl-0 pr-0">
                                <textarea class="form-control input-sm" tabindex="13" name="" id="" :class="{'date-invalid':$v.remarks.$error}" v-model="remarks"  cols="30"  style="height:60px"></textarea>
                                <div v-if="$v.remarks.$error">
                                    <p class=" text-danger" v-if="!$v.remarks.required">It should not be left empty</p>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <div class="col-md-6">


                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bills Recievable</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Receipts</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <table id="myTable" class="table table-wrapper-scroll-y my-custom-scrollbar">
                                        <thead class="thead-dark">
                                            <tr>

                                                <th><input type="checkbox" @click="checkAll" v-model="allSelected"></th>
                                                <th>Bill No</th>
                                                <th >Date</th>
                                                <th>Branch</th>
                                                <th>PR. Fee</th>
                                                <th>Other</th>
                                                <th>S/Tax</th>

                                            </tr>
                                        </thead>

                                        <tbody>


                                            <tr v-for='(bill,b) in bills' :key="b" :title="'Total Bill: '+ Number(bill.total_amount)">

                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" @change="getAmount(b)" class="chkbox"  v-bind:id="'myCheck'+bill.id" :value="bill.id" v-model="chbill"     name="" >

                                                    </div>
                                                </td>


                                                <td >{{ bill.bill_number }}</td>
                                                <td >{{ bill.bill_date }}</td>
                                                <td >{{ bill.branch_name }}</td>
                                                <!-- <td >{{ bill.cust_name }}</td> -->
                                                <td  >
                                                    <input style="width:140px !important" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"  type="number" @input="showActionFields(bill.id)" v-bind:id="'totalBill'+bill.id" class="form-control form-control-sm"   :value="bill.prism_service_charges"   >
                                                        <div class="row">
                                                            <div class="col-md-12" style="padding: 10px 16px 6px 16px;text-align:left">
                                                                <select class="form-control" style="font-size:12px;visibility:hidden;margin-bottom:8px;height:30px" :id="'optionBtn'+bill.id">
                                                                    <option value="Outstanding">Outstanding</option>
                                                                    <option selected value="Discount">Discount</option>
                                                                </select>
                                                                <button :id="'updateBtn'+bill.id"   class="btn btn-primary btn-sm" style="font-size:11px;visibility:hidden" @click="updateBtn(bill.id,bill.total_amount,b,bill.tax,bill.bill_number)">Update</button>
                                                                <button  :id="'cancelBtn'+bill.id"  class="btn btn-primary btn-sm" style="font-size:11px;visibility:hidden" @click="cancelBtn(bill.id)">Cancel</button>
                                                                <input v-bind:id="'oldBill'+bill.id" readonly type="hidden"  :value="bill.prism_service_charges">
                                                                <!-- <input v-bind:id="'oldTotal'+bill.id" readonly type="hidden"  :value="bill.total_amount"> -->
                                                            </div>
                                                        </div>
                                                        </td>
                                                    <td  >
                                                        <input style="width:140px !important" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"  type="number" @input="showActionFields(bill.id)" v-bind:id="'totalOthers'+bill.id" class="form-control form-control-sm"   :value="bill.other_charges"   >
                                                        <input v-bind:id="'oldOthers'+bill.id" readonly type="hidden"  :value="bill.other_charges">
                                                        
                                                    </td>
                                                    <td >
                                                        <input style="width:120px !important" type="number" onkeydown="javascript: return event.keyCode === 8 || event.keyCode === 46 ? true : !isNaN(Number(event.key))"  v-bind:id="'myTax'+bill.id" @input="showActionFields(bill.id)" class="form-control form-control-sm" :value="bill.tax"  >
                                                        <input v-bind:id="'oldTax'+bill.id" readonly type="hidden"  :value="bill.tax">


                                                    </td>



                                            </tr>

                                        </tbody>
                                    </table>

                                     <br>
                                    <div class="row">
                                        <div class="col-md-12" style="text-align:right">
                                            <a href="/home"><button class="btn btn-primary input-sm"  >Cancel</button></a>
                                            <!-- @click="cancelBills()" -->
                                        <button v-if="!saveButton" class="btn btn-primary input-sm ml-2" @click="saveReceipt()" id="save">Save</button>
                                        </div>

                                    </div>
                    </div>
                     <div class="tab-pane fade show " style="display:none"  id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <!-- {{selectedReceipts}}{{selectedBills}} -->
                        <table class="table table-wrapper-scroll-y my-custom-scrollbar">
                                        <thead class="thead-dark">
                                            <tr>

                                                <th>?</th>
                                                <th>ID</th>
                                                <th>Receipt ID</th>
                                                <th>Reciept Date</th>
                                                <th>Region</th>
                                                <th>Instrument</th>
                                                <th>Amount</th>
                                                <th>Remarks</th>
                                                <th>Status</th>

                                            </tr>
                                        </thead>

                                        <tbody>


                                            <tr v-for='reciept in reciepts' :key="reciept.receipt_id" @click="showReceiptModal(reciept.receipt_id,reciept.created_at,reciept.method,reciept.jobs_number,reciept.amount,reciept.sales_tax,reciept.taxable_amount,reciept.bank_charges,reciept.receipt_date,reciept.deposit_date,reciept.instrument_number,reciept.bank_account,reciept.instrument_date,reciept.slip_number,reciept.remarks,reciept.status,reciept.net,reciept.client_copy,reciept.deposit_copy)"  >
                                               <!-- reciept.receipt_id,reciept.created_at,reciept.method,receipt.jobs_number,receipt.amount,receipt.sales_tax,receipt.taxable_amount,receipt.bank_charges,receipt.receipt_date,receipt.deposit_date,receipt.instrument_number,receipt.deposit_bank,receipt.instrument_date,receipt.slip_no,receipt.remarks -->
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" @change="getReceiptID(reciept.bills_id,reciept.id,event)"   :value="reciept.id" v-model="receipts"    class="form-check-input "   name="" >

                                                    </div>
                                                </td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.id }}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.receipt_id}}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.receipt_date }}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.city_name}}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.method }}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.net}}</td>
                                                <td data-toggle="modal" data-target="#receiptModal">{{ reciept.remarks}}</td>
                                                <td data-toggle="modal" data-target="#receiptModal"><span class="badge badge-primary" style="font-size:13px" :class="{'badge badge-success':reciept.status=='Approved','badge badge-danger':reciept.status=='Rejected'}">{{ reciept.status}}</span></td>
                                                <!-- <td><button class="btn btn-success btn-sm" @click="allowBill(reciept.bills_id,reciept.id)">Allow</button></td>
                                                <td><button class="btn btn-primary btn-sm" @click="revertBill(reciept.bills_id,reciept.id)">Reject</button></td> -->



                                            </tr>

                                            <div class="modal fade" id="receiptModal" role="dialog" aria-labelledby="receiptModal" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Receipt Viewer</h5>
                                                     <a><button type="button"  :class="{'btn btn-success':this.recieptStatus=='Approved','btn btn-danger':this.recieptStatus=='Rejected','btn btn-primary':this.recieptStatus=='Pending'}"  aria-label="View Job">
                                                    <span  aria-hidden="true">{{recieptStatus}}</span>
                                                    </button></a>

                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <label for=""> Receipt ID</label>
                                                                <input type="text" v-model="receiptID" readonly class="form-control">

                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="">Generated On</label>
                                                                <input type="text" v-model="receipGenerated" readonly class="form-control">
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for=""> Instrument</label>
                                                                <input type="text" readonly v-model="receiptInstrument" class="form-control">
                                                            </div>
                                                        </div> <br>
                                                        <div class="row" v-if="receiptInstrument!='Cash' && receiptInstrument!='OnLine Transfer'">
                                                            <div class="col-md-6 pb-3">
                                                                <label for="">Instrument Scan</label>
                                                                <br>
                                                                <a :href="receiptInstrumentScan" target="_blank">
                                                                    <img :src="receiptInstrumentScan" style="height:200px;width:350px" alt="">


                                                                </a>

                                                            </div>
                                                            <div class="col-md-6 pb-3">
                                                                <label for="">Dep. Slip Scan</label>
                                                                <br>
                                                                <a :href="receiptDepSlipScan" target="_blank">

                                                                    <img :src="receiptDepSlipScan" style="height:200px;width:350px" alt="">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Bills</label>
                                                                <input type="text" readonly v-model="receiptBills" class="form-control">
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label for="">Net Amount</label>
                                                                <input type="text" readonly v-model="receiptNet" class="form-control">
                                                                <br>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="">Bill Amount</label>
                                                                <input type="text" readonly v-model="receiptBillAmount" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="">Sales Tax</label>
                                                                <input type="text" readonly v-model="receiptSalesTax" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="">Taxable Amount</label>
                                                                <input type="text" readonly v-model="receiptTaxableAmount" class="form-control">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="">Bank Charges</label>
                                                                <input type="text" readonly v-model="receiptBankCharges" class="form-control">
                                                            </div>
                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                            <div class="col-md-6">

                                                                <label for=""> Received On</label>
                                                                <input type="date" readonly v-model="receiptReceivedOn" class="form-control">
                                                                <br>
                                                                <label for=""> Instrument Number</label>
                                                                <input type="text" readonly v-model="receiptInstrumentNumber" class="form-control">
                                                                <br>
                                                                <label for=""> Instrument Date</label>
                                                                <input type="date" readonly v-model="receiptInstrumentDate" class="form-control">


                                                            </div>
                                                            <div class="col-md-6">


                                                                <label for="">Deposit Date</label>
                                                                <input type="date" readonly v-model="receiptDepositDate" class="form-control">
                                                                <br>
                                                                <label for="">Deposit In</label>
                                                                <input type="text" readonly v-model="receiptDepositIn" class="form-control">
                                                                <br>
                                                                <label for="">Slip No</label>
                                                                <input type="text" readonly v-model="receiptSlipNo" class="form-control">

                                                            </div>

                                                        </div>
                                                        <br>
                                                        <div class="row">
                                                           <div class="col-md-12">
                                                                <label for=""> Remarks</label>
                                                                <textarea style="height:120px" readonly v-model="receiptRemarks" class="form-control"></textarea>
                                                           </div>
                                                        </div>

                                                    </div>
                                                    <!-- <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" @click="updateBill()" >Save changes</button>
                                                    </div> -->
                                                    </div>
                                                </div>
                                            </div>







                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-12 " style="text-align:right">
                                            <button class="btn btn-primary input-sm" @click="rejectReceipt()">Cancel</button>
                                        <button class="btn btn-primary input-sm ml-2" @click="saveReceipt()" id="save">Post</button>
                                        </div>

                                    </div>
                    </div>
                    </div>




                </div>
        </div>
    </div>
</template>

<style  scoped>

body{
    font-size: 12px !important
}

.my-custom-scrollbar {
position: relative;
height: 400px;
overflow: auto;
}
.table-wrapper-scroll-y {
display: block;
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
.mySelect{
    font-size:11px !important
}
.form-control{
    font-size:11px !important

}
input{
    font-size:12px

}
label{
    font-size:11px !important

}

table,th,tr,td{font-size: 11px !important}

</style>


<script>

       var ids=[];



       function removeA(arr,value) {
     var index = arr.indexOf(value);
        if (index > -1) {
            arr.splice(index, 1);
        }
        return arr;
        }





        // var myarray = [2500,2800];
        // function Update(key, value,myarray)
        // {
        //     for (var i = 0; i < myarray.length; i++) {
        //         if (myarray[i].Key == key) {
        //             myarray[i].Value = value;
        //             break;
        //         }
        //     }
        // }
        // console.log('Changed Value: '+ Update(2,22,myarray));

import { required, minLength, between,email,helpers } from 'vuelidate/lib/validators'

import axios from 'axios'
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import moment from 'moment';
import vSelect from 'vue-select'
import 'vue-select/dist/vue-select.css'


export default {
     props:{
          usercompany:String,
          usercompanyname:String,
          usercompanyprefix:String,
          useregion:String,
          useregionname:String,
          useregionprefix:String
      },

    mounted(){
        this.getInstruments();
        // this.getBills();
        this.getAccounts();
        this.getCompany();
        this.getRegion();
        this.getCustomers();
        this.getBanks();
        this.getReceipts();
        this.region=this.useregionname;
        this.company={text:this.usercompanyname,value:this.usercompany,prefix:this.usercompanyprefix};
        this.service={text:'All',value:0};
        this.bank={text:'All',value:0};
        this.customer={text:'All',value:0};

        this.updateStats();






    },

    components:{
          'Select':vSelect,
    'datepicker':Datepicker

      },
    data(){
        return{
            region:'',
            regions:[

            ],
            amounts:[],
            taxes:[],
            instruments:[],
            companies:[],
            en: en,
            es: es,
            company:'',
            services:[
                {text:'All',id:0},
                 {text:'Livestock',id:1},
                 {text:'Supervision',id:2},
                 {text:'Legal Service',id:3},
                 {text:'Verification',id:4}
            ],
            accounts:[],
            banks:[

                ],
            customers:[

            ],
            instrument:'',
            insscan:false,
            depscan:false,
            bills:[],
            jobs:[],
            reciepts:[],
            ids:[],
            bill:'',
            gross:0,
            bcharges:0,
            extra:0,
            event:'',
            option:false,
            itper:8,
            itamount:0,
            stper:20,
            stamount:0,
            allSelected:false,
            bid:'',
            billId:'',
            billBranch:'',
            billDate:'',
            billCustomer:'',
            billamount:'',
            billSales:'',
            myroute:'',
            account:'',
            recievedOn:'',
            instrumentNumber:'',
            instrumentDate:'',
            depositOn:'',
             slipScan:'',
            slipNo:'',
            remarks:'',
            prevBill:'',
            instrumentScan:'',
            receivable:[

            ],
            bank:'',
            service:'',
            customer:'',
            receipts:[],
            selectedReceipts:[],
            selectedBills:[],
            receiptID:'',
            receipGenerated:'',
            receiptInstrument:'',
            receiptBills:'',
            receiptBillAmount:'',
            receiptSalesTax:'',
            receiptTaxableAmount:'',
            receiptBankCharges:'',
            receiptReceivedOn:'',
            receiptInstrumentNumber:'',
            receiptInstrumentDate:'',
            receiptDepositDate:'',
            receiptDepositIn:'',
            receiptSlipNo:'',
            receiptRemarks:'',
            recieptStatus:'',
            receiptInstrumentScan:'',
            receiptDepSlipScan:'',
            receiptNet:'',
            totalbill:'',
            invoiceId:'',
            saveButton:false,
            isAdvance:false,
            selectedTax:[],
            chbill:[],
            instrumentScanis:null,
            depSlipScanis:null,
            itperStatus:0,
            selectedRow: {},
             disabledDates: {
            to:  new Date(Date.now() - 8640000)
            }

        }
    },
    computed:{
        itax:function(){

            if(this.itamount==0)
            {
                return 0;
            }

            else{
                var itaxamount=Number(this.itamount);
            var itper= Number(this.itper);
            var total=itper / 100;
            return total * itaxamount;
            }
        },
        stax:function(){

            if(this.stamount==0)
            {
                return 0;
            }

            else{
                var staxamount=Number(this.stamount);
            // var stper=100 - Number(this.stper);
            var stper= Number(this.stper);
            var total=stper / 100;
            return total * staxamount;
            }
        },
        net:function(){
            var gross=Number(this.gross);
            var stax=Number(this.stax);
            var itax=Number(this.itax);
            var extra=Number(this.extra);
            var bankCharges=Number(this.bcharges);
            var total = Number(gross + extra);
            var final=total - bankCharges ;


               return final - this.itax - stax;




        },
        leftAmount:function(){
            var net=Number(this.net);
            var bill=Number(this.bill);
            return bill - net;
        },
        calculate(){
            var net=Number(this.net);
            var bill=Number(this.bill);
             if(net > bill){
                this.option=false;
            }
            else{
                this.option=true;
            }
        }
    },
    methods:{

        updateStats: function(){

            axios.post('/updateStatsLog')
            .then(res=>{
                // alert('Stats Updated');


            })
            .catch(error=>{
            });


   },
        setSelected(value){
            this.receivable=value;
        },
        showActionFields(id){
            var x = document.getElementById("updateBtn"+id);
            x.style.visibility = 'visible';
            var y = document.getElementById("cancelBtn"+id);
            y.style.visibility = 'visible';
            var z = document.getElementById("optionBtn"+id);
            z.style.visibility = 'visible';


        },
        checkBoxCheck(id,key){
            document.getElementById("myCheck"+id).checked = false;
            removeA(this.ids, this.bills[key].id);
            removeA(this.jobs, this.bills[key].bill_number);
            removeA(this.amounts, Number(this.bills[key].total_amount));
            removeA(this.selectedTax, Number(this.bills[key].tax));
        },
        updateBtn(id,bill,b,tax,bid){



            var checkBox = document.getElementById("myCheck"+id);

            var total= document.getElementById('totalBill'+id).value;
            var totalothers= document.getElementById('totalOthers'+id).value;
            var taxis= document.getElementById('myTax'+id).value;

            var old = document.getElementById('oldBill'+id).value;
            var oldtax = document.getElementById('oldTax'+id).value;
            var oldothers = document.getElementById('oldOthers'+id).value;
            
            var optn = document.getElementById('optionBtn'+id).value;



            if(total < 1)
            {

                alert('Unauthorized Action ! You cannot writte off amount');
                document.getElementById('totalBill'+id).value=Number(old);
                document.getElementById('myTax'+id).value=Number(oldtax);
                document.getElementById('totalOthers'+id).value=Number(oldothers);

                var x = document.getElementById("updateBtn"+id);
                x.style.visibility = "hidden";
                var y = document.getElementById("cancelBtn"+id);
                y.style.visibility = "hidden";
                var z = document.getElementById("optionBtn"+id);
                z.style.visibility = "hidden";

            }

            // else if(total > old)
            // {
            //       alert('You are not Authorized To Increase Bill Amount !!');
            //     document.getElementById('totalBill'+id).value=Number(old);
            //     document.getElementById('myTax'+id).value=Number(oldtax);

            //     var x = document.getElementById("updateBtn"+id);
            //     x.style.visibility = "hidden";
            //     var y = document.getElementById("cancelBtn"+id);
            //     y.style.visibility = "hidden";
            //     var z = document.getElementById("optionBtn"+id);
            //     z.style.visibility = "hidden";

            // }
            else{


                if(checkBox.checked == true)
                {
                    // var tot=bill+tax+;
                    removeA(this.amounts, Number(old)+Number(oldothers)+Number(oldtax));
                    removeA(this.selectedTax, Number(oldtax));

                    this.amounts.push(Number(total)+Number(totalothers)+Number(taxis));
                    this.selectedTax.push(Number(taxis));


                }


                document.getElementById('totalBill'+id).value=Number(total);
                document.getElementById('totalOthers'+id).value=Number(totalothers);
                document.getElementById('myTax'+id).value=Number(taxis);
                this.bills[b].prism_service_charges=Number(total);
                this.bills[b].other_charges=Number(totalothers);
                this.bills[b].tax=Number(taxis);


                    // const arrSum = arr => arr.reduce((a,b) => a + b, 0);

                    // this.bill=arrSum(this.amounts);
                    // this.stamount=arrSum(this.selectedTax);


                    //                     var x = document.getElementById("updateBtn"+id);
                    // x.style.visibility = "hidden";
                    // var y = document.getElementById("cancelBtn"+id);
                    // y.style.visibility = "hidden";
                    // var z = document.getElementById("optionBtn"+id);
                    // z.style.visibility = "hidden";

                var totalamount=Number(total)+Number(totalothers)+Number(taxis);
            let reportData={
                bid:bid,
                service_charges:total,
                other_charges:totalothers,
                sales_tax:taxis,
                bill_amount:totalamount,
                choice:optn
            };
            console.log(reportData);

             axios.post('/updateBillPrism/' + id,reportData).then(res=>{

                // alert('Bill Updated Successfully');



                    const arrSum = arr => arr.reduce((a,b) => a + b, 0);

                    this.bill=arrSum(this.amounts);
                    this.stamount=arrSum(this.selectedTax);

                    var x = document.getElementById("updateBtn"+id);
                    x.style.visibility = "hidden";
                    var y = document.getElementById("cancelBtn"+id);
                    y.style.visibility = "hidden";
                    var z = document.getElementById("optionBtn"+id);
                    z.style.visibility = "hidden";
            });


            }





        },
        cancelBtn(id){

                var old = document.getElementById('oldBill'+id).value;
                document.getElementById('totalBill'+id).value=old;

             var oldtax = document.getElementById('oldTax'+id).value;
                document.getElementById('myTax'+id).value=oldtax;

                var oldOthers = document.getElementById('oldOthers'+id).value;
                document.getElementById('totalOthers'+id).value=oldOthers;

              var x = document.getElementById("updateBtn"+id);
            x.style.visibility = "hidden";
              var y = document.getElementById("cancelBtn"+id);
            y.style.visibility = "hidden";
              var z = document.getElementById("optionBtn"+id);
            z.style.visibility = "hidden";

            },

    getInstrumentFile(e){
         const file = e.target.files[0];
         this.instrumentScanis = URL.createObjectURL(file);
         this.instrumentScan = this.$refs.instrumentScan.files[0];

        //  let formData = new FormData();
        // formData.append('myfile', this.file);

        this.$v.instrumentScan.$touch();



    },
    handleEditRow(data) {
        this.selectedRow = {
          [data.index]: !this.selectedRow[data.index]
        }
    },
    getSlipScan(e){
         const file = e.target.files[0];
         this.depSlipScanis = URL.createObjectURL(file);
         this.slipScan = this.$refs.slipScan.files[0];

        //  let formData = new FormData();
        // formData.append('myfile', this.file);

        this.$v.slipScan.$touch();
    },
    getCompany(){
        axios.get('/getCompany')
        .then(res=>{
            res.data.forEach((obj)=>{
            let text="";
            let value="";
            let prefix="";
            this.companies.push({ text: obj.company_name,value:obj.company_id,prefix:obj.company_prefix});
                this.company={text:this.usercompanyname,value:this.usercompany}

        })
    })
   },
   filterResult(){
       this.getBills();
   },
   getBanks(){
        axios.get('/getInsurers')
        .then(res=>{
            this.banks.push({text:'All',value:0})

            res.data.forEach((obj)=>{
                let text='';
                let value='';
                this.banks.push({text:obj.name,value:obj.id})
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
     showModal(id,number,date,branch,customer,total,tax){
         this.bid=id;
         this.billId=number;
         this.billDate=date;
         this.billBranch=branch;
         this.billCustomer=customer;
         this.billamount=total;
         this.prevBill=total;
         this.billSales=tax;
         this.myroute='/jobView/' + id
      },
    //   receiptid,createdat,method,jobs,billamount,salestax,taxableamount,bankcharges,receivedon,depositdate,instrumentnumber,depositbank,instrumentdate,slipno,remarks
      showReceiptModal(id,generated,method,bills,amount,salestax,taxableamount,bankcharges,recieved,depositdate,instrumentnumber,bank,instrumentdate,slip,remarks,status,net,instrumentscan,depositcopy){
          this.receiptID=id;
          this.receipGenerated=generated;
          this.receiptInstrument=method;
          this.receiptBills=bills;
          this.receiptBillAmount=amount;
          this.receiptSalesTax=salestax;
          this.receiptTaxableAmount=taxableamount;
          this.receiptBankCharges=bankcharges;
          this.receiptReceivedOn=recieved;
          this.receiptDepositDate=depositdate;
          this.receiptInstrumentNumber=instrumentnumber;
          this.receiptDepositIn=bank;
          this.receiptInstrumentDate=instrumentdate;
          this.receiptSlipNo=slip;
          this.receiptRemarks=remarks;
          this.recieptStatus=status;
          this.receiptNet=net;
          this.receiptInstrumentScan=instrumentscan;
          this.receiptDepSlipScan=depositcopy;

      },

      postData(){
        // this.saveButton=true;

          if(this.itper!=8)
            {
                 this.itperStatus=0;

                // alert(this.itperStatus);
            }
            else{
                this.itperStatus=1;

                // alert(this.itperStatus);
            }

                this.instrumentScan = this.$refs.instrumentScan.files[0];
                this.slipScan = this.$refs.slipScan.files[0];

                 const reportData= new FormData();
                    reportData.append("instScan", this.instrumentScan);
                    reportData.append("slipScan", this.slipScan);
                    reportData.append("recieved_on",moment(this.recievedOn).format('YYYY/MM/DD'));
                    reportData.append("instrument_id",this.instrument.value);
                    reportData.append("instrument",this.instrument.text);
                    reportData.append("instrument_number",this.instrumentNumber);
                    reportData.append("instrument_date",moment(this.instrumentDate).format('YYYY/MM/DD'));
                    reportData.append("deposit_bank",this.account.value);
                    reportData.append("deposit_date",moment(this.depositOn).format('YYYY/MM/DD'));
                    reportData.append("it_per",this.itperStatus);
                    reportData.append("it_per_is",this.itper);
                    reportData.append("st_per",this.stper);
                    reportData.append("st_value",this.stamount);
                    reportData.append("it_value",this.itamount);
                    reportData.append("sales_tax_amount",this.stax);
                    reportData.append("income_tax_amount",this.itax);
                    reportData.append("deposit_slip",this.slipNo);
                    reportData.append("gross_amount",this.gross);
                    reportData.append("amounts",this.amounts);
                    reportData.append("sales_tax",this.taxes);
                    reportData.append("taxable_amount",this.itax + this.stax);
                    reportData.append("bank_charges",this.bcharges);
                    reportData.append("extra_charges",this.extra);
                    reportData.append("net_charges",this.net);
                    reportData.append("amount",this.net);
                    reportData.append("write_off",this.leftAmount);
                    reportData.append("bill",this.bill);
                    reportData.append("remarks",this.remarks);
                    reportData.append("ids",this.ids);
                    reportData.append("jobs",this.jobs);
                    reportData.append("company",this.company.prefix);
                    reportData.append("regprefix",this.useregionprefix);

                    console.log(reportData);

                    axios.post('/generateReceipt',reportData).then(res=>{

                    this.saveButton=false;

                    alert('Reciept [ '+res.data+' ] Generated Successfully');
                    this.updateStats();
                    window.location.href="/billing";
            //         this.bills=[];
            // this.amounts=[];
            // this.ids=[];
            // this.jobs=[];
            // this.selectedTax=[];
            // this.stamount=0;
            // this.gross=0;
            // this.bill=0;
            // this.allSelected=false;
            // this.chbill = [];


                    }).catch(error=>{

                    alert(error);

                    });


      },
        saveReceipt(){


            this.postData();

        //   if(this.ids =='')
        //   {
        //       alert('None Bills are selected');
        //   }
        //   else{

        //       if(this.gross > this.bill)
        //       {
        //           alert('Gross amount is grater than bill')
        //       }
        //       else if(this.gross < this.bill)
        //       {
        //           alert('Gross amount is less than bill');
        //       }

        //       else{


        //            const arrSum = arr => arr.reduce((a,b) => a + b, 0);
        //                 this.taxes=arrSum(this.selectedTax);

        //             if(this.instrument.text=='OnLine Transfer')
        //             {
        //                 if(this.$v.noDocumented.$invalid)
        //                 {
        //                     this.$v.noDocumented.$touch();
        //                     var isValid = !this.$v.noDocumented.$invalid
        //                     this.$emit('on-validate', this.$data, isValid)
        //                     return isValid
        //                 }

        //                 else
        //                 {

        //                 this.postData();
        //                 }


        //         }
        //         else if(this.instrument.text=='Cash')
        //             {

        //                 if(this.$v.cashed.$invalid)
        //                 {
        //                     this.$v.cashed.$touch();
        //                     var isValid = !this.$v.cashed.$invalid
        //                     this.$emit('on-validate', this.$data, isValid)
        //                     return isValid
        //                 }

        //                 else
        //                 {

        //                 this.postData();

        //                 }


        //         }

        //             else if(this.instrument.text!='Cash' || this.instrument.text!='OnLine Transfer')
        //             {
        //                 if(this.$v.documented.$invalid)
        //                 {
        //                     this.$v.documented.$touch();
        //                     var isValid = !this.$v.documented.$invalid
        //                     this.$emit('on-validate', this.$data, isValid)
        //                     return isValid
        //                 }

        //                 else
        //                 {


        //                     this.postData();
        //                 }

        //             }


        //         }



        //       }






        },
        cancelBills(){
            var bills =this.ids;
            alert(bills);
        },

        postReceipt(){


             let reportData={
                bills:this.selectedBills,
                rid:this.receipts
            };
            console.log(reportData);

             axios.post('/approveBill',reportData).then(res=>{

             this.getBills();
             this.getReceipts();
             this.selectedBills=[];
             this.selectedReceipts=[];
             alert('Receipt Approved');

       }).catch(error=>{

           alert(error);
       });
        },

       rejectReceipt(){



             let reportData={
                bills:this.selectedBills,
                rid:this.receipts
            };
            console.log(reportData);

             axios.post('/rejectBill',reportData).then(res=>{

             this.getBills();
             this.getReceipts();
            this.selectedBills=[];
             this.selectedReceipts=[];
             alert('Receipt Reject');

       }).catch(error=>{

           alert(error);
       });

        },
       updateBill(){

            let reportData={
                bill_id:this.bid,
                bid:this.billId,
                bill_amount:this.billamount,
                sales_tax:this.billSales,
                prev_amount:this.prevBill
            };
            console.log(reportData);

             axios.post('/updateBill/' + this.bid,reportData).then(res=>{
             alert('Bill Updated Successfully');
             $('#exampleModal').modal('hide');
             this.getBills();
             this.getReceipts();

       }).catch(error=>{


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
        showFields(){
            if(this.instrument.text=='Cheque' || this.instrument.text=='Demand Draft' || this.instrument.text=='Pay Order')
            {
                this.insscan=true;
                this.depscan=true;
            }
            else if(this.instrument.text=='Cash' )
            {
                this.insscan=false;
                this.depscan=true;
            }
            else
            {
                this.insscan=false;
                this.depscan=false;
            }
        },

        getBills(){
            this.bills=[];
            this.amounts=[];
            this.ids=[];
            this.jobs=[];
            this.selectedTax=[];
            this.stamount=0;
            this.gross=0;
            this.bill=0;
            this.allSelected=false;
            this.chbill = [];
            // this.allSelected==false;

            let reportData={
                company:this.company.value,
                service:this.service.text,
                bank:this.bank.value,
                customer:this.customer.value,
                isAdvance:this.isAdvance,
                regions:this.receivable,
                invoice_id:this.invoiceId,
            };
            console.log(reportData);
               axios.post('/getBillsPrism',reportData)
                    .then(res=>{
                        console.log(res.data);
                        if(res.data=='')
                        {
                            alert('No Bills Found');
                        }
                        else{
                        this.bills=res.data;

                        }
                    });

        },

        getReceipts(){
            this.reciepts=[];

               axios.get('/getReceipts')
                    .then(res=>{
                        console.log(res.data);
                        this.reciepts=res.data;
                    });

        },
         getCustomers(){
         axios.get('/getCustomers')
                    .then(res=>{
                        this.customers.push({text:'All',value:0})

                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.customers.push({ text:obj.cust_name,value:obj.cust_id})

                        })
                    })
    },
        getAmount(key){

            //   var total =  0;
            // for(var i=0;i<this.amounts.length;i++)
            //   {
            //     if(isNaN(this.amounts.length[i])){
            //     continue;
            //      }
            //       total += Number(this.amounts.length[i]);
            //    }

            const arrSum = arr => arr.reduce((a,b) => a + b, 0);

            if(event.target.checked) {

            this.ids.push(this.bills[key].id);
            this.jobs.push(this.bills[key].bill_number);
            this.amounts.push(Number(this.bills[key].prism_service_charges)+Number(this.bills[key].other_charges)+Number(this.bills[key].tax));
            this.selectedTax.push(Number(this.bills[key].tax));
            }
            else{
            removeA(this.ids, this.bills[key].id);
            removeA(this.jobs, this.bills[key].bill_number);
            removeA(this.amounts, Number(this.bills[key].prism_service_charges)+Number(this.bills[key].other_charges)+Number(this.bills[key].tax));
            removeA(this.selectedTax, Number(this.bills[key].tax));

            }

            this.bill=arrSum(this.amounts);
            this.itamount=arrSum(this.amounts);
            this.gross=arrSum(this.amounts);
            this.stamount=arrSum(this.selectedTax);



        },
        getReceiptID(bills,recID){


            //   var total =  0;
            // for(var i=0;i<this.amounts.length;i++)
            //   {
            //     if(isNaN(this.amounts.length[i])){
            //     continue;
            //      }
            //       total += Number(this.amounts.length[i]);
            //    }



            if(event.target.checked) {

            this.selectedReceipts.push(recID);
            this.selectedBills.push(bills);
            }
            else{
            removeA(this.selectedReceipts,recID);
            removeA(this.selectedBills,bills);

            }



        },
       getJob(id){
              axios.get('/getJobsView/' + id)
                    .then(res=>{
                        console.log(res.data);
                    })
        },
         getInstruments(){
        this.instruments=[];
                 axios.get('/getInstruments')
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            this.instruments.push({text:obj.description,value:obj.id})
                        })
                    })
            },
             getAccounts(){
        this.accounts=[];
                 axios.get('/getAccounts')
                    .then(res=>{
                        console.log(res.data);
                        res.data.forEach((obj)=>{
                            let text='';
                            let value='';
                            this.accounts.push({text:obj.description,value:obj.id})
                        })
                    })

            },
        revertBill(){
           let reportData={
                rid:this.receipts
            };
            console.log(reportData);

             axios.post('/rejectBill',reportData).then(res=>{
             alert('Receipt Rejected');
             this.getBills();
             this.getReceipts();

       }).catch(error=>{

           alert(error);
       });

        },
        allowBill(ids,id){
           let reportData={
                bills:ids,
                rid:id
            };
            console.log(reportData);

             axios.post('/approveBill',reportData).then(res=>{
             alert('Receipt Approved');
             this.getBills();
             this.getReceipts();

       }).catch(error=>{

           alert(error);
       });

        },
            checkAll: function(){


      this.allSelected = !this.allSelected;
      this.amounts = [];
      this.chbill = [];
        this.ids=[];
        this.jobs=[];
        this.selectedTax=[];

      if(this.allSelected){ // Check all
        for (var key in this.bills) {
          this.amounts.push(Number(this.bills[key].prism_service_charges)+Number(this.bills[key].other_charges)+Number(this.bills[key].tax));
          this.ids.push(this.bills[key].id);
          this.chbill.push(this.bills[key].id);
          this.jobs.push(this.bills[key].job_number);
          this.selectedTax.push(Number(this.bills[key].tax));

           const arrSum = arr => arr.reduce((a,b) => a + b, 0);

            this.bill=arrSum(this.amounts);
            this.gross=arrSum(this.amounts);
            this.itamount=arrSum(this.amounts);

            this.stamount=arrSum(this.selectedTax);
        }


      }

      else{
          this.bill=0;
          this.gross=0;
          this.ids=[];
          this.amounts=[];
          this.selectedTax=[];
      }
    },

    },
    validations:{
        recievedOn:{
            required
        },
        instrument:{
            required
        },
        instrumentNumber:{
            required
        },
        instrumentDate:{
            required
        },
        account:{
            required
        },
        depositOn:{
            required
        },
        slipNo:{
            required
        },
        gross:{
            required
        },
        net:{
            required
        },
        bill:{
            required
        },
        remarks:{
            required
        },
        instrumentScan:{
            required
        },
        slipScan:{
            required,
            //  imageRule
        },
        documented:[
            'recievedOn',
            'instrument',
            'account',
            'depositOn',
            'slipNo',
            'gross',
            'net',
            'bill',
            'remarks',
            'instrumentScan',
            'slipScan'
        ],
        cashed:[
            'recievedOn',
            'instrument',
            'account',
            'depositOn',
            'slipNo',
            'gross',
            'net',
            'bill',
            'remarks',
            'slipScan'
        ],
         noDocumented:[
            'recievedOn',
            'instrument',
            'account',
            'depositOn',
            'gross',
            'net',
            'bill'
        ]
    }
}
</script>
