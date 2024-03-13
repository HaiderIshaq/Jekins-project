<template>
   <form enctype="multipart/form-data"  >
        <div class="form-group row" style="padding: 12px 52px 0px 30px;">
            <div class="col-md-5">
                <div class="form-check  islamic-check  " style="margin-left: 22px" >
                    <input type="checkbox" class="form-check-input"  v-model="isBranchCode" >
                    <label for="form-check-label"> Print Code?</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="isBranchCode" style="padding: 0px 52px 0px 30px;">

            <div class="col-md-3">
                <input type="text" name="" v-model="reportBranchCode" class="form-control" id="">

            </div>
        </div>
        <div class="form-group row" style="padding: 12px 52px 0px 30px;">
            <div class="col-md-5">
                <div class="form-check  islamic-check  " style="margin-left: 22px" >
                    <input type="checkbox" class="form-check-input"  v-model="isNote" >
                    <label for="form-check-label"> Print Note?</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="isNote" style="padding: 0px 52px 0px 30px;">

            <div class="col-md-12">
                <textarea name="" id="" v-model="reportNote" class="form-control" style="height:50px"></textarea>


            </div>
        </div>
        <div class="form-group row" style="padding: 12px 52px 20px 30px;">
            <div class="col-md-12">
                <div class="row" style="padding-left:15px;padding-bottom:20px">
                        <h5><b>Site Address</b></h5>

                </div>
                <textarea name="" class="form-control" style="height:50px" v-model="siteAddress" cols="30" rows="10"></textarea>

            </div>
        </div>
        <div class="form-group row" style="padding: 12px 52px 0px 30px;">
            <div class="col-md-5">
                <div class="form-check  islamic-check  " style="margin-left: 22px" >
                    <input type="checkbox" class="form-check-input"  v-model="isSecondAddress" >
                    <label for="form-check-label"> is Second Address?</label>
                </div>
            </div>
        </div>
        <div class="form-group row" v-show="isSecondAddress" style="padding: 0px 52px 0px 30px;">

            <div class="col-md-12">
                <textarea name="" id="" v-model="secondAddress" class="form-control" style="height:50px"></textarea>


            </div>
        </div>
        <div class="form-group row" style="padding: 12px 52px 20px 30px;">
            <div class="col-md-12">
                <div class="row" style="padding-left:15px;padding-bottom:20px">
                        <h5><b>Inspection Details</b></h5>

                </div>
            </div>
            <div class="col-md-4">
                <label for="">Stock Inspector</label>
                <input class="form-control form-control-sm " v-model="siteInspector" type="text" >

            </div>


        </div>
          <div class="form-group row" style="padding: 12px 52px 0px 30px;">
            <div class="col-md-5">
                <div class="form-check  islamic-check  " style="margin-left: 22px" >
                    <input type="checkbox" class="form-check-input"  v-model="isAfo" >
                    <label for="form-check-label"> AFO Details ?</label>
                </div>
            </div>
        </div>
          <div class="form-group row" v-show="isAfo" style="padding: 0px 52px 10px 30px;">
            <div class="col-md-3">
                <label for="form-check-label"> Name of AFO</label>
                <input class="form-control form-control-sm" v-model="afoName">
            </div>
            <div class="col-md-3">
                <label for="form-check-label"> Contact Details</label>
                <input class="form-control form-control-sm" v-model="afoContact">
            </div>
            <div class="col-md-3">
                <label for="form-check-label">Branch Code</label>
                <input class="form-control form-control-sm" v-model="afoBranch">
            </div>
        </div>


        <!-- Details of Animal -->
         <div class="row">


            <div class="col-lg-12 col-md-12">
                <div class="row" style="padding-left: 45px;">
                        <h5><b>Detail of Animals</b></h5>

                </div>
                <div class="row" style="margin:10px">
                      <tr v-for="(invoice_product, k) in invoice_products" :key="k">
                        <td scope="row" class="trashIconContainer " >
                            <i class="far fa-trash-alt" @click="deleteRow(k, invoice_product)"></i>
                        </td>

                        <td >
                                <div style="position:relative;top:10px" >
                             <Select  style="float:right;width:175px;padding-left:10px;padding-right:10px;font-size:10px"   taggable push-tags v-model="invoice_product.description" placeholder="Descritption" @input="checkDescription(invoice_product)" :options="titles" ></Select>


                                </div>
                        </td>

                        <td>

                            <div class="row" v-for="(type_product,j) in invoice_product.type_products" :key="j" style="position:relative;padding-left:10px;padding-right:10px;padding-bottom:10px" >
                                {{typeTotal(invoice_product.type_products,invoice_product)}}

                                <div class="" style="padding:3px 10px 10px 10px;float:right">
                                       <i class="far fa-trash-alt" v-show="invoice_product.mainType!=''" @click="deleteRowType(j, invoice_product,type_product)"></i>
                                </div>
                                    <Select  style="float:right;width:130px;padding-left:10px;padding-right:10px;font-size:10px"  v-model="type_product.mainType"  :options="mainTypes"></Select>

                                    <Select v-model="type_product.secondType" style="float:right;width:140px;padding-left:10px;padding-right:10px;font-size:10px"  taggable  push-tags  v-if="invoice_product.description=='Cow Milking' || invoice_product.description=='Cow Dry' || invoice_product.description=='Calves Cow'" :options="cowTypes"></Select>
                                    <Select v-model="type_product.secondType" style="float:right;width:140px;font-size:10px"  taggable  push-tags  v-else-if="invoice_product.description=='Buffalo Milking' ||  invoice_product.description=='Buffalo Dry' ||  invoice_product.description=='Calves Buffalow'" :options="buffalowTypes"></Select>
                                    <Select v-model="type_product.secondType" style="float:right;width:140px;font-size:10px"  taggable  push-tags  v-else-if="invoice_product.description!='Buffalo Milking' ||  invoice_product.description!='Buffalo Dry' ||  invoice_product.description!='Calves Buffalow' || invoice_product.description!='Cow Milking' || invoice_product.description!='Cow Dry' || invoice_product.description!='Calves Cow'" :options="allanimalTypes"></Select>
                                    <!-- <Select v-model="type_product.secondType"  taggable push-tags @input="checkType(type_product)" v-if="type_product.mainType=='Local' && invoice_product.description=='Cow Milking'" :options="cowMilkinglocalTypes"></Select>           -->


                                    <input class="form-control" style="font-size: 10px !important;height: 27px !important;float:right;width:80px;margin-left:10px;margin-right:10px"    type="number" placeholder="Quantity"  v-model="type_product.quantity" />

                                    <input style="float:right;width:70px;margin-left:10px;margin-right:10px;font-size: 10px !important;height: 27px !important;"  class="form-control" type="text"  placeholder="Age" v-model="type_product.age" />


                                <Select  style="float:right;width:130px;padding-left:10px;padding-right:10px;font-size: 10px !important;" taggable push-tags v-model="type_product.time" placeholder="Time" :options="['Years','Month']" ></Select>

                                    <Select style="float:right;width:210px;padding-left:10px;padding-right:10px;font-size: 10px !important;"  taggable push-tags v-model="type_product.remarks" :options="remarks"></Select>

                                 <!-- var sum =   this.invoice_products.reduce((acc, item) => acc.type_products + item.quantity, 0) -->
                            </div>

                              <div class="row" style="padding-left: 15px;padding-right:15px">
                                <button type='button' style="font-size: 12px;" class="btn btn-info" @click="addNewType(invoice_product)">
                                    <i class="fas fa-plus-circle"> Add</i>
                                </button>


                            </div>

                        </td>


                        <td>
                            <input type="number" class="form-control" id="myTotal"
                            style="font-size: 10px !important; height: 27px !important;"
                            v-model="invoice_product.totalCount"

                             readonly >
                        </td>
                    </tr>

                </div>

                 <div class="row" style="padding-left:45px">
                    <button type='button' style="font-size: 12px;" class="btn btn-info" @click="addNewRow">
                        <i class="fas fa-plus-circle"> Add</i>
                    </button>


                </div>

            </div>
        </div>
        <!-- Details of Animal -->

        <!-- Conclustion -->
        <div class="row" style="padding-left:45px;padding-top:20px">
            <h5><b>Conclusion / Observation / Comments</b></h5>

        </div>
        <div class="form-group row" style="padding: 12px 52px 0px 30px;">
            <div class="col-md-4">
                <label for="">Availability of Diagnostic Lab & Veterinary</label>
                <Select :options="doctorChoices"  taggable push-tags style="height:30px"  v-model="doctorsStatus"></Select>
                <!-- <input name="" type="text" class="form-control" v-model="doctorsStatus" id="" > -->
            </div>
            <div class="col-md-4">
                <label for="">Premesis:</label>
                <Select name="" type="text" :options="premChoices"   id="" v-model="food" ></Select>
            </div>
            <div class="col-md-4">
                <label for="">Security Arrangements (No of Caretakers):</label>
                <input name="" type="number" class="form-control"  id="" v-model="careTakers" >
            </div>
        </div>

        <div class="row">


            <div class="col-lg-12 col-md-12">

                <div class="row" style="margin:10px">
                      <tr v-for="(conclustion_item, j) in conclustion_item" :key="j">
                        <td scope="row" class="trashIconContainer " style="margin:10px">
                            <i class="far fa-trash-alt" @click="deleteRowConc(j, conclustion_item)"></i>
                        </td>
                        <td>
                            <Select   :options="remarksTitleChoices"   taggable push-tags style="height:30px;width:250px"  v-model="conclustion_item.title"></Select>

                        </td>
                        <td>

                            <Select :options="remarksChoicesTrac" v-if="conclustion_item.title=='Traceability' "   taggable push-tags style="height:30px;width:250px"  v-model="conclustion_item.firstItemName"></Select>
                            <Select :options="remarksChoicesPhy" v-if="conclustion_item.title=='Physical Barrier'"   taggable push-tags style="height:30px;width:250px"  v-model="conclustion_item.firstItemName"></Select>
                            <Select :options="remarksChoicesProp" v-if="conclustion_item.title=='Property Status'"   taggable push-tags style="height:30px;width:250px"  v-model="conclustion_item.firstItemName"></Select>

                    </td>
                        <td>
                            <input type="checkbox" style="margin: 7px 7px 9px -4px;" class="form-check-input" v-model="conclustion_item.firstItemCheck">

                        </td>
                        <td>
                          <Select :options="remarksChoicesTrac" v-if="conclustion_item.title=='Traceability'"   taggable push-tags style="height:30px;width:250px"   v-model="conclustion_item.secondItemName"></Select>
                          <Select :options="remarksChoicesPhy" v-if="conclustion_item.title=='Physical Barrier'"    taggable push-tags style="height:30px;width:250px"   v-model="conclustion_item.secondItemName"></Select>
                          <Select :options="remarksChoicesProp" v-if="conclustion_item.title=='Property Status'"     taggable push-tags style="height:30px;width:250px"   v-model="conclustion_item.secondItemName"></Select>

                        </td>
                         <td>
                            <input type="checkbox" class="form-check-input" style="margin: 7px 7px 9px -4px;" v-model="conclustion_item.secondItemCheck">

                        </td>
                    </tr>

                </div>

                 <div class="row" style="padding-left:45px">
                    <button type='button'  class="btn btn-info" @click="addNewRowConc">
                        <i class="fas fa-plus-circle"> Add</i>
                    </button>


                </div>

            </div>
        </div>
        <!-- Conclustion -->

        <!-- Images -->
        <div class="row" style="padding-left:45px;padding-top:20px">
            <h5><b>Images</b></h5>

        </div>
        <div class="row" style="padding-left:30px;padding-top:20px">
             <div class="col-md-4">
                <label for="">Image Header</label>
                <input class="form-control form-control-sm " v-model="imageHeader" type="text" >
            </div>

        </div>
        <div class="row" style="padding-left:45px;padding-top:20px">
            <label for="">Select images:</label>


        </div>
        <div class="form-group row" style="padding: 12px 52px 0px 30px;">

            <div class="col-md-12">
            <input type="file"  @change="addImages()" ref="images"  accept="image/jpeg"  multiple="multiple"  name="" id="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" style="padding: 12px 52px 0px 30px;">
                <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">Action</th>
                    <th scope="col">Order</th>
                    <th scope="col">Image</th>
                    <th scope="col">Title</th>

                    </tr>
                </thead>
                <tbody>
                    <tr  v-for="livestockImage in livestockImages" :key="livestockImage.id">
                    <td >

                        <button class="btn btn-danger" type="button" @click="deleteImage(livestockImage.id,livestockImage.path)">Delete</button>

                        </td>


                    <td>
                        <Select :options="counter" v-model="livestockImage.print_order" @input="updateOrder(livestockImage.id,$event)" label="text" style="width:80px" ></Select>
                        </td>
                    <td>
                        <img :src="baseUrl+'/'+livestockImage.path" height="100" width="100" alt="">
                    </td>

                    <th scope="row">{{livestockImage.title}}</th>


                    </tr>

                </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="padding-left:45px;padding-top:20px">
            <div class="col-md-2">
                <label for="">Report Date</label>
                <input class="form-control form-control-sm " v-model="reportDate" type="date" >

            </div>
            <div class="col-md-2">
                <label for="">Bill Date</label>
                <!-- <input class="form-control form-control-sm " min="currentDateWithFormat" v-model="billDate" type="date" > -->
                <datepicker  :input-class="['form-control']"  :disabled-dates="disabledDates"  valueType="format" :format="'d/M/yy'"   v-model="billDate" ></datepicker>

            </div>
            <div class="col-md-2">
                <label for="">Inspection Date</label>
                <input class="form-control form-control-sm " v-model="inspectionDate" type="date" >

            </div>
            <div class="col-md-5">
                <div class="form-check  islamic-check  " style="margin-left: 31px;margin-top: 40px;" >
                    <input type="checkbox" class="form-check-input"  v-model="isPrintSign" >
                    <label for="form-check-label"> Print Sign?</label>
                </div>
            </div>

        </div>
        <!-- Images -->

        <div class="row" style="text-align: right;padding-top: 6px;">
            <div class="col-md-12 ml-auto">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button"  @click="saveInvoice" class="btn btn-primary">Save</button>
                <a :href="'/printInsReport/'+ this.jobid" target="_blank"><button type="button"  class="btn btn-primary">Print Report</button></a>
            </div>
        </div>

    </form>
</template>
<script>
      var currentDate = new Date();
      var currentDateWithFormat = new Date()
        .toJSON()
        .slice(0, 10)
        .replace(/-/g, "-");
      console.log(currentDateWithFormat);
</script>
<script>
import axios from 'axios';
import vSelect from 'vue-select'
import Datepicker from 'vuejs-datepicker';
import {en, es} from 'vuejs-datepicker/dist/locale'
import vMultiselect from 'vue-multiselect'

export default {
    props:{
        jobid:String,
        custlocation:String
    },
     components:{
          'Select':vSelect,
          'MultiSelect':vMultiselect,
    'datepicker':Datepicker


              },



    data(){
        return{
            baseUrl:'',
            counter:[],
            remarksTitleChoices:[
                'Traceability',
                'Physical Barrier',
                'Property Status',
            ],
            premChoices:[
                'Inside Farm',
                'Outside Farm',
                'Inside & Outside Farm',
            ],
            remarksChoices:[
                'Ear Tag',
                'Skin Marks',
                'Yes',
                'No',
                'Owned',
                'Rented'
                            ],
            remarksChoicesTrac:[
                'Ear Tag',
                'Skin Marks',
                            ],
            remarksChoicesPhy:[
                'Yes',
                'No',
                            ],
            remarksChoicesProp:[
                'Owned',
                'Rented',
                            ],
            doctorChoices:[
                'once in a month',
                'twice in a month',
                '3 times in a month',
                '4 times in a month',
            ],
            titles:[
                'Cow Milking',
                'Cow Dry',
                'Buffalo Milking',
                'Buffalo Dry',
                'Calves Cow',
                'Calves Buffalow',
            ],
            mainTypes:[
                'Local',
                'Imported',

            ],
            remarks:[
                'Active & Healthy',
                'Not Healthy',

            ],
            livestockImages:[],
            livestockOrder:'',
            allanimalTypes:['Freisian','Jersey','Sahiwali','Sindhri','Cholistani','Neeli','Ravi','Neli Ravi','Azkheli','Kundi','Cross'],
            buffalowTypes:['Neeli','Ravi','Neli Ravi','Azkheli','Kundi','Cross'],
            cowTypes:['Freisian','Jersey','Sahiwali','Sindhri','Cholistani','Cross'],
            siteAddress:'',
            careTakers:'',
            totalQuantity:'',
            doctorsStatus:'',
            reportDate:'',
            imageHeader:'',
            isPrintSign:'',
            billDate:'',
            siteInspector:'',
            inspectionDate:'',
            food:'',
            invoice_products: [],
            conclustion_item: [],
            isBranchCode:false,
            reportBranchCode:'',
            isNote:false,
            reportNote:'',
            isSecondAddress:false,
            secondAddress:'',
            isAfo:false,
            afoName:'',
            afoContact:'',
            afoBranch:'',
             disabledDates: {
            to:  new Date(Date.now() - 8640000)
            }


        }
    },
    mounted(){
        this.baseUrl = window.location.origin;
        // alert(this.custlocation);

         axios.get('/getLiveStockDetails/' + this.jobid).then(res=>{
            res.data.forEach((obj)=>{
                var siteis=obj.site_address;
                    if(siteis===null)
                    { this.siteAddress=this.custlocation;


                    }
                    else{
                        this.siteAddress=obj.site_address;

                    }
                   this.careTakers=obj.caretakers_no;
                   this.doctorsStatus=obj.doctors;
                   this.reportDate=obj.report_date;
                   this.billDate=obj.bill_date;
                   this.siteInspector=obj.stock_inspector;
                   this.inspectionDate=obj.inspection_date;
                   this.food=obj.food;
                   this.imageHeader=obj.image_header;
                   this.isPrintSign=obj.is_print_sign===1 ? true : false;
                   this.isBranchCode=obj.is_branch_code===1 ? true : false;
                   this.reportBranchCode=obj.branch_code;
                   this.isNote=obj.is_note===1 ? true : false;
                   this.reportNote=obj.note;
                   this.isSecondAddress=obj.is_site_address_second===1 ? true : false;
                   this.secondAddress=obj.site_address_second;
                   this.isAfo=obj.is_afo===1 ? true : false;
                   this.afoName=obj.afo_name;
                   this.afoContact=obj.afo_contact;
                   this.afoBranch=obj.afo_branch_code;



                   });


        }).catch(error=>{
            alert(error);
        });

        axios.get('/getDetailsofanimals/' + this.jobid).then(res=>{
            res.data.forEach((obj)=>{
                    this.invoice_products.push({
                                id:obj.id,
                                description: obj.description_of_stocks,
                                type_products:JSON.parse(obj.breed),
                                totalCount:0
                    });
                            console.log(obj.breed);
                        })
                   console.log(res.data);


        }).catch(error=>{
            alert(error);
        });


         axios.get('/getRemarksDetails/' + this.jobid).then(res=>{
            res.data.forEach((obj)=>{
                    this.conclustion_item.push({
                                id:obj.id,
                                title:obj.title,
                                firstItemName:obj.option_first_name,
                                secondItemName:obj.option_second_name,
                                firstItemCheck:obj.option_first_status==1 ? true:false,
                                secondItemCheck:obj.option_second_status==1 ? true:false,
                    });
                            console.log(obj.breed);
                        })
                   console.log(res.data);


        }).catch(error=>{
            alert(error);
        });
        this.getLivestockImages();
    },

     methods:{
         deleteImage(id,image){
            let formData={
                image:image
            };
            axios.post('/deleteLivestockImage/'+id,formData).then(res=>{

                         this.getLivestockImages();

                    }).catch(error=>{
                        alert(error);



                    });
        },
//         checkRemarks(value){
// //   'Traceability',
// //                 'Physical Barrier',
// //                 'Property Status',
//             // this.remarksChoices=[];
//             // if(value=='Traceability')
//             // {
//             //     this.remarksChoices=['Hello','World'];
//             // }
//             alert(value)
//         },
        updateOrder(id,order){



            let formData={
                rowId:id,
                orderID:order.text
            };

            axios.put('/updateOrder/'+this.jobid,formData).then(res=>{


                    }).catch(error=>{
                        alert(error);



                    });

        },
         getLivestockImages(){
         this.livestockImages=[];

              axios.get('/getLivestockImages/' + this.jobid).then(res=>{
            res.data.forEach((obj)=>{
                    this.livestockImages.push({
                                id:obj.id,
                                title:obj.title,
                                print_order:obj.print_order,
                                path:obj.path,
                    });

                        })
                       console.log(res.data);
                       this.counter=[];

                    for(var i=1 ; i<=this.livestockImages.length; i++)
                    {
                        this.counter.push({
                       text:i
                       })

                    }

        }).catch(error=>{
            alert(error);
        });

         },
         addImages(){



         let formData = new FormData();
         for( var i = 0; i < this.$refs.images.files.length; i++ ){
                let file = this.$refs.images.files[i];
                console.log(file);

                formData.append('files[' + i + ']', file);
            }

          formData.append('jid', this.jobid);


        axios.post('/uploadLivestockimages',formData).then(res=>{

            this.getLivestockImages();

       }).catch(error=>{
           alert("Please select some file");



        });


    },
          typeTotal(type_products,total)
        {
            var sum =  type_products.reduce((acc, item) => acc + Number(item.quantity), 0);
            total.totalCount=sum;

        },
         checkDescription(value){


             if(value.description!='Other')
             {
                 value.descriptionOther='';
             }
         },
          checkType(value){


             if(value.secondType!='Add New')
             {
                 value.secondOther='';
             }
         },
             saveInvoice() {
            console.log(JSON.stringify(this.invoice_products,null,'\t'));


            // console.log(JSON.stringify(this.conclustion_item));

            axios.put('/saveInsReport/' + this.jobid,{
                site_address:this.siteAddress,
                care_takers:this.careTakers,
                doctor_status:this.doctorsStatus,
                report_date:this.reportDate,
                is_print_sign:this.isPrintSign,
                stock_inspector:this.siteInspector,
                inspection_date:this.inspectionDate,
                food:this.food,
                image_header:this.imageHeader,
                bill_date:this.billDate,
                is_branch_code:this.isBranchCode,
                branch_code:this.reportBranchCode,
                is_note:this.isNote,
                note:this.reportNote,
                is_site_address_second:this.isSecondAddress,
                site_address_second:this.secondAddress,
                is_afo:this.isAfo,
                afo_name:this.afoName,
                afo_contact:this.afoContact,
                afo_branch_code:this.afoBranch

            }).then(res=>{
                console.log(res.data);

                 axios.put('/saveDetailsofanimals/'+this.jobid,{
              data:this.invoice_products
            //     care_takers:this.careTakers,
            //     doctor_status:this.doctorsStatus,
            }).then(res=>{

                console.log(res);

                    axios.put('/saveDetailsofRemarks/'+this.jobid,{
                    data:this.conclustion_item
                    //     care_takers:this.careTakers,
                    //     doctor_status:this.doctorsStatus,
                    }).then(res=>{
                        console.log(res);
                    }).catch(error=>alert(error));

                alert('Report Data Saved');

            }).catch(error=>alert(error));


            }).catch(error=>alert(error));


        },

        calculateTotal() {




        },

        calculateLineTotal(invoice_product) {
            // var total = parseFloat(invoice_product.type) * parseFloat(invoice_product.quantity);
            // if (!isNaN(total)) {
            //     invoice_product.remarks = total.toFixed(2);
            // }
            this.calculateTotal();
        },
        deleteRow(index, invoice_product) {

           axios.post('/deleteInspectionDetailsItem/'+this.jobid,{
               rowId:invoice_product.id
            }).then(res=>{
            var idx = this.invoice_products.indexOf(invoice_product);
            console.log(idx, index);
            alert('Row Deleted');

            if (idx > -1) {
                this.invoice_products.splice(idx, 1);
            }
           }).catch(error=>{
               alert(error);
           });


       },
        deleteRowConc(index, conclustion_item) {

            axios.post('/deleteInspectionDetailsRemarks/'+this.jobid,{
               rowId:conclustion_item.id
            }).then(res=>{

           var idx = this.conclustion_item.indexOf(conclustion_item);
            console.log(idx, index);
            if (idx > -1) {
                this.conclustion_item.splice(idx, 1);
            }
             alert('Row Removed');
           }).catch(error=>{
               alert(error);
           });



        },
        deleteRowType(index, invoice_product,type_product) {
            var idx = invoice_product.type_products.indexOf(type_product);
            console.log(index);
            console.log(idx);

           if (idx > -1) {
                invoice_product.type_products.splice(idx, 1);
            }
            // this.calculateTotal();
        },
        addNewRow() {

             axios.post('/addDetailsofanimalsRow/'+this.jobid,{

            //     care_takers:this.careTakers,
            //     doctor_status:this.doctorsStatus,
            }).then(res=>{
               this.invoice_products.push({
                id:res.data,
                description: '',
                type_products:[{
                   mainType:'',
                   secondType:'',
                   quantity: '',
                   age: '',
                   time: '',
                    remarks: '',

                },
                ],
                totalCount:0
            });
            }).catch(error=>alert(error));



        },
        addNewType(invoice_product){
            invoice_product.type_products.push({
                    mainType:'',
                    secondType:'',
                   quantity: '',
                   age: '',
                   time: '',
                    remarks: '',

            });
        },
        addNewRowConc() {
            axios.post('/addDetailsofanimalsRemark/'+this.jobid,{

            //     care_takers:this.careTakers,
            //     doctor_status:this.doctorsStatus,
            }).then(res=>{


                this.conclustion_item.push({
                id:res.data,
                title:'',
                firstItemName:'',
                secondItemName:'',
                firstItemCheck:false,
                secondItemCheck:false,
            });
            }).catch(error=>alert(error));

        }
    }
}
</script>

<style >
td{
    padding:10px
}


.modal {
  padding: 0 !important;
}
.modal .modal-dialog {
  width: 100%;
  max-width: none;
  height: 100%;
  margin: 0;
  padding: 20px !important;

}
.modal .modal-content {
  height: auto;
  border: 0;
  border-radius: 0;
}
.modal .modal-body {
  overflow-y: auto;
}
.multiselect {
        font-size: 12px;
}
  .vs__selected-options {
  flex-wrap: nowrap;
  max-width: calc(100% - 41px);
}

.vs__selected {
  display: block;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 100%;
  overflow: hidden;
}

.vs__search {
  position: absolute;
}

.vs--open .vs__search {
  position: static;
}

.vs__dropdown-option {
  white-space: normal;
}

</style>
