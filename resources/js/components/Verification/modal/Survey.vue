<template>
  <div>
       <hr style="background-color:black">
                            <h5 style="padding-bottom:20px">{{title}}</h5>
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label">Address: </label>
                                <div class="col-md-9">
                                    <textarea name="" v-model="address" class="form-control" id="" style="height:50px"></textarea>
                                </div>
                            </div>
                            <div class="form-group row mt-2">
                                <label class="col-md-3 col-form-label">City / Area: </label>
                                <div class="col-md-4">
                                    <Select  label="text" :class="['mySelect']" :options="cities" v-model="city"></Select>
                                    
                                </div>
                                <div class="col-md-5">
                                    <input type="text" v-model="area" class="form-control form-control-sm" name="" id="">
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-md-3 col-form-label">Surveyor: </label>
                                <div class="col-md-4">
                                    <Select  label="text"   :class="['mySelect']" :options="surveyors" v-model="surveyor"></Select>
                                    
                                </div>
                                <div class="col-md-5">
                                    <Select  label="text" :class="[{'invalid':$v.surType.$error},'mySelect']" :options="surTypes" v-model="surType"></Select>
                                   <!-- {{surType}} -->
                                    <div v-if="$v.surType.$error" >
                                        <p class="text-danger" v-if="!$v.surType.required">Required</p>
                                    </div>

                                    <div v-if="surType.text=='Extra Long'" >
                                       <input type="text" :class="[{'invalid':$v.surType.$error}]" v-model="extraLongCharges" class="form-control form-control-sm mt-2 mb-2" name="" id="">
                                        <div v-if="$v.extraLongCharges.$error" >
                                        <p class="text-danger" v-if="!$v.extraLongCharges.required">Required</p>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-md-3 col-form-label">Surveyor on Report: </label>
                                <div class="col-md-9">
                                    <Select  label="text" :class="['mySelect']" :options="surveyors" v-model="surveyorOnReport"></Select>
                                    
                                </div>
                               
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-md-3 col-form-label">GPS: </label>
                                   <label class="col-md-2 col-form-label" style="padding-left:10px">Longitude: </label>
                                <input type="text" v-model="lat"  class="form-control-sm form-control col-md-2" name="" id="">                              
                                
                                <label class="col-md-2 col-form-label">Latitude: </label>
                                <input type="text"  v-model="long" class="form-control-sm form-control col-md-2" name="" id="">                              
                                
                             
                               
                            </div>
                            <div class="form-group row" v-if="this.title=='Workplace' || this.title=='Workplace / Business'">
                                <label class="col-md-3 col-form-label"> </label>
                                <!-- <label class="col-md-2 col-form-label">Empl: </label>
                                <input type="text"  v-model="long" class="form-control-sm form-control col-md-2" name="" id="">                              
                                 -->
                                 <div class="col-md-3 ml-4">
                                     <input type="checkbox" name="" v-model="isEmployee" class="form-check-input" id="">
                                     <label class="form-check-label">Employee?</label>
                                 </div>
                                 <div class="col-md-3">
                                     <input type="checkbox" name="" v-model="isSalary" class="form-check-input" id="">
                                     <label class="form-check-label">Salary Slip?</label>
                                 </div>
                              
                               
                            </div>
                            <div class="form-group row mt-1">
                                <label class="col-md-3 col-form-label">Visited: </label>
                                <input type="text" style="margin-left:14px" v-model="visited"  class="form-control-sm form-control col-md-4" name="" id="">                              
                                <div class="col-md-1">
                                    <input type="button" @click="getImages()" class="btn btn-primary" data-toggle="modal" :data-target="'#md'+this.surveyid" value="...."> 

                                </div>
                           
                               
                            </div>
                            <!-- Small modal -->

                            <div class="modal fade images-modal" tabindex="-1" role="dialog" :id="'md'+this.surveyid" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Images</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="row">
                                                <div class="col-md-1">
                                                    File
                                                </div>
                                                <div class="col-md-6">
                                                    <input type="file"  ref="images"  accept="image/jpeg"  multiple="multiple"  >
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="button" :disabled="status==1 ||  status==2"  @click="addImages()" class="btn btn-primary"  value="Upload">
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="row">
                                                    <div class="col-md-12 ">
                                                       <table class="table mt-3">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                <th scope="col">Id</th>
                                                                <th scope="col">Action</th>
                                                                <th scope="col">Image</th>
                                                                <th scope="col">Title</th>
                                                                <th scope="col">Order</th>
                                                                <th scope="col">Rotate</th>

                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr v-for="image in images" :key="image.id">
                                                                <th scope="row">
                                                                    {{image.id}}
                                                                    
                                                                    </th>
                                                                <td>
                                                                    <input @click="deleteImage(image.id)" :disabled="status==1 ||  status==2" value="Delete" class="btn btn-danger">
                                                                        
                                                                    
                                                                </td>
                                                                <td>

                                                                    <a :href="baseUrl+'/'+image.path" target="_blank">
                                                                        <img :src="baseUrl+'/'+image.path" style="height:150px;width:200px" alt="">
                                                                    </a>    
                                                                </td>
                                                                <td>
                                                                    {{image.title}}
                                                                </td>
                                                                <td>
                                                                    <Select @input="OrderImg(image.id,$event)" :options="counter" v-model="image.order" label="text" ></Select>
                                                                </td>
                                                                <td>
                                                                    <Select @input="rotateImg(image.id,$event)" :options="rotatechoices" v-model="image.rotate" ></Select>
                                                                </td>
                                                                </tr>
                                                               
                                                            </tbody>
                                                            </table>

                                                      
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group row" style="margin:0px">
                                    <input @click="postData()" class="btn btn-primary btn-sm col" :disabled="status==1 ||  status==2" style="font-size:12px;margin:5px" value="Save">
                                    <input  @click="cancelSurvey()" :disabled="status==1 ||  status==2" class="btn btn-primary btn-sm col" style="font-size:12px;margin:5px" value="Cancel">
                                    <input @click="clearData()"  class="btn btn-primary btn-sm col" :disabled="status==1 ||  status==2" style="font-size:12px;margin:5px" value="Clear">
                                    <input @click="finalize()" :disabled="status==1 ||  status==2" style="font-size:12px;margin:5px" class="btn btn-primary btn-sm col" value="Finalize">

                                    <a :href="printurl" target="_blank" class="btn btn-primary btn-sm col"   :disabled="status==2" style="font-size:12px;margin:5px">Print</a>

                             
                            </div>
  </div>
</template>

<script>
import axios from 'axios'
import vSelect from 'vue-select'
import VerificationEdit from '../VerificationEdit.vue';
import { required, minLength, between,email } from 'vuelidate/lib/validators'
import 'vue-select/dist/vue-select.css'
import '@trevoreyre/autocomplete-vue/dist/style.css'

export default {
     props:{
          surveyid:Number,
          bankid:Number,
          jid:String

      },
      components:{
          'Select':vSelect,
          VerificationEdit
      },
data(){
    return{
        baseUrl:'',
        cities:[],
        counter:[],
        surveyors:[],
        images:[],
        rotatechoices:['Yes','No'],
        city:'',
        surveyor:'',
        surveyorOnReport:'',
        title:'',
        status:'',
        area:'',
        surType:'',
        extraLongCharges:'',
        surTypes:[
            {text:"Regular"},
            {text:"Long"},
            {text:"Extra Long"}
        ],
        long:'',
        lat:'',
        address:'',
        visited:'',
        printurl:'',
        printBtn:true,
        isEmployee:true,
        isSalary:true
    }
},
mounted(){
    this.getCities();
    this.getSurveyors();
    this.getData();
    this.getSurveyImages();

    this.baseUrl = window.location.origin;
   
},

methods:{

    getCities(){
        axios.get('/getCities')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.cities.push({ text:obj.city_name,value:obj.city_id})

                        })
                    })

    },
    
rotateImg(id,rotate)
{
    // alert(rotate);
      let formData={
                id:id,
                rotate:rotate
            };

    axios.put('/rotateImage',formData).then(res=>{
            alert('Image Rotated Successfully');
                this.getSurveyImages();

        }).catch(error=>{
            alert(error);



        });
},
OrderImg(id,rotate)
{
    // alert(rotate);
      let formData={
                id:id,
                order:rotate.text
            };

    axios.put('/orderImage',formData).then(res=>{
            alert('Image Order Changed Successfully');
                this.getSurveyImages();

        }).catch(error=>{
            alert(error);



        });
},
    getSurveyors(){
        axios.get('/getSurveyors')
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.surveyors.push({ text:obj.name+" - "+obj.city_name,value:obj.id})

                        })
                    })
    },

    deleteImage(id){
       
    // let formData={
    //             image:image
    //         };
            axios.post('/deleteSurveyImage/'+id).then(res=>{
                        alert('Image Deleted Successfully');
                         this.getSurveyImages();

                    }).catch(error=>{
                        alert(error);



                    });
        },

    getSurveyImages(){
        this.$forceUpdate();
        this.images=[];
        axios.get('/getSurveyImages/'+this.surveyid)
                    .then(res=>{
                         res.data.forEach((obj)=>{
                            let text="";
                            let value="";
                            this.images.push(
                                {id:obj.id,
                                path:obj.path,
                                title:obj.title,
                                rotate:obj.rotate,
                                order:obj.order_by

                                })

                        })

                          this.counter=[];

                    for(var i=1 ; i<=this.images.length; i++)
                    {
                        this.counter.push({
                       text:i
                       })

                    }

                        
                    })
    },
    getImages(){
        
        this.getSurveyImages();
    },
      addImages(){

          if(this.$refs.images.files.length==0)
          {
              alert('Please Select Some Files');
          }

          else{

         

         let formData = new FormData();
         for( var i = 0; i < this.$refs.images.files.length; i++ ){
                let file = this.$refs.images.files[i];
                console.log(file);

                formData.append('files[' + i + ']', file);
            }

          formData.append('jid', this.surveyid);



        axios.post('/uploadSurveyimages',formData).then(res=>{

            this.getSurveyImages();
            alert('Images Uploaded Successfully');

       }).catch(error=>{
           alert("Something Went Wrong");



        });

         }
    },
    getData(){
           
            axios.get("/getSurveysData/" + this.surveyid) //with id
                .then(res => {

                res.data.forEach((obj)=>{
                    this.title=obj.type;
                    this.status=obj.status;
                    this.address=obj.address;
                    if(obj.surveyor_billing==null ||obj.surveyor_billing=="null")
                    {
                 
                        this.surType='';

                    }
                    else{

                        this.surType={text:obj.surveyor_billing};

                    }
                    this.city={text:obj.survey_city,value:obj.city};
                    this.surveyor={ text:obj.surveyor_name+" - "+obj.region,value:obj.surveyor};   
                    this.surveyorOnReport={ text:obj.surveyor_on_report_name+" - "+obj.region_two,value:obj.surveyor_on_report};
                    this.long=obj.longitude;
                    this.lat=obj.latitiude;
                    this.area=obj.area;
                    this.extraLongCharges=obj.total_charges;
                    this.isEmployee=obj.is_employee===1 ? true:false;
                    this.isSalary=obj.salary_slip===1 ? true:false;

                    this.visited=obj.formatted_date;

                    if(this.bankid==12)
                    {
                        if(obj.type=="Residence" || obj.type=="Workplace" || obj.type=="Salary Slip" || obj.type=="Bank Statement")
                        {
                            this.printurl="/getsurveyreport/"+this.surveyid;
                        }

                        else{
                            this.printurl='';
                            this.printBtn=false;

                        }
                    }

                    else{
                        if(obj.type=="Residence" || obj.type=="Workplace")
                        {
                            this.printurl="/getsurveyreport/"+this.surveyid;
                        }

                        else{
                            this.printurl='';
                            this.printBtn=false;

                        }
                    }
                       
                    })
                })
                .catch(error => {
                console.log(error.response);


                });
        },
         postData(){

            const surdata={
                id:this.surveyid,
                address:this.address,
                city:this.city.value,
                surveyor:this.surveyor.value,
                surveyor_on_report:this.surveyorOnReport.value,
                surveyor_billing:this.surType.text,
                longitude:this.long,
                area:this.area,
                salary_slip:this.isSalary,
                is_employee:this.isEmployee,
                latitiude:this.lat
            };

            axios.put('/updateSurvey',surdata)
                .then(res=>{
                alert('Updated Successfully');
                this.getData();

                console.log(surdata);
                })
                .catch(error=>alert(error))
               
              
            
        },
         clearData(){

            const surdata={
                id:this.surveyid,
              
            };

            axios.put('/clearSurvey',surdata)
                .then(res=>{
                this.getData();
                alert('Cleared Successfully');
                this.getData();
                console.log(surdata);
                })
                .catch(error=>alert(error))
               
              
            
        },
         cancelSurvey(){

            const surdata={
                id:this.surveyid
                
            };

            axios.put('/cancelSurvey',surdata)
                .then(res=>{
                alert('Cancel Successfully');
                this.getData();

                })
                .catch(error=>alert(error))
               
              
            
        },
        finalize(){

            
        if(this.$v.sur.$invalid)
        {
            this.$v.sur.$touch();
            var isValid = !this.$v.sur.$invalid
            this.$emit('on-validate', this.$data, isValid)
            return isValid
        }
        else{

            if(this.surType.text=="Extra Long")
            {

                if(this.$v.surextra.$invalid)
                {
                    
                  this.$v.surextra.$touch();
                    var isValid = !this.$v.surextra.$invalid
                    this.$emit('on-validate', this.$data, isValid)
                    return isValid
                }

                else{
                    this.finalizeReport();
                    // alert('Submiited');
                }
            }

            else{
                    this.finalizeReport();

            // alert('Submitted');


            }
           

        }

            
          



        },
        finalizeReport(){

            let sercharges;
            let type= this.surType.text;
            let bank=this.bankid;


            // BANKISLAMI PAKISTAN LIMITED
            if(bank=="9" && type=="Regular")
            {
                sercharges=200;
                // alert(sercharges);
            }

            else if(bank=="9" && type=="Long")
            {
                sercharges=350;
                // alert(sercharges);
            }
            // Mezzan Bank Limited
            else if(bank=="5" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="5" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }

            // Habib Bank Limited
             else if(bank=="3" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="3" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }

            // Askari Bank Limited
             else if(bank=="4" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="4" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }

            // Al Baraka
             else if(bank=="6" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="6" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }

              // Bank Al Habib
             else if(bank=="7" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="7" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }

             // Bank Al Falah
             else if(bank=="8" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="8" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }


             // DUBAI ISLAMIC BANK PAKISTAN LIMITED
             else if(bank=="10" && type=="Regular")
            {
                sercharges=0;
                // alert(sercharges);
            }
            else if(bank=="10" && type=="Long")
            {
                sercharges=0;
                // alert(sercharges);
            }
            else if(bank=="10" && type=="Extra Long")
            {
                sercharges=0;
                // alert(sercharges);
            }
             // FAYSAL BANK LIMITED
             else if(bank=="11" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="11" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
             // Habib Metro
             else if(bank=="12" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="12" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
             // JS bANK
             else if(bank=="13" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="13" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
               // kasb Bank
             else if(bank=="14" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="14" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
              // Pak Libya
             else if(bank=="16" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="16" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
             // SONERI
             else if(bank=="17" && type=="Regular")
            {
                sercharges=350;
                // alert(sercharges);
            }
            else if(bank=="17" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
             // sumit bank
             else if(bank=="18" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="18" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
             // Pair
             else if(bank=="19" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="19" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
            // First Habib Moderaba
            else if(bank=="20" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="20" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
            // Habib Metro Moderaba
            else if(bank=="21" && type=="Regular")
            {
                sercharges=300;
                // alert(sercharges);
            }
            else if(bank=="21" && type=="Long")
            {
                sercharges=500;
                // alert(sercharges);
            }
            // National Bank Pakistan
            else if(bank=="15" && type=="Regular")
            {
                sercharges=400;
                // alert(sercharges);
            }
            else if(bank=="15" && type=="Long")
            {
                sercharges=600;
                // alert(sercharges);
            }
            // Trellis
            else if(bank=="22" && type=="Regular")
            {
                sercharges=0;
                // alert(sercharges);
            }
            else if(bank=="22" && type=="Long")
            {
                sercharges=0;
                // alert(sercharges);
            }
            else if(bank=="22" && type=="Extra Long")
            {
                sercharges=0;
                // alert(sercharges);
            }
            else{
                sercharges=this.extraLongCharges;
                // alert(sercharges);
            }
           
                const surdata={
                    id:this.surveyid,
                    title:this.title,
                    address:this.address,
                    city:this.city.value,
                    surveyor:this.surveyor.value,
                    surveyor_on_report:this.surveyorOnReport.value,
                    surveyor_billing:this.surType.text,
                    sercharges:sercharges,
                    longitude:this.long,
                    latitiude:this.lat,
                    bank:bank,
                    jid:this.jid
                                
                    };

                            axios.put('/completeSurvey',surdata)
                                .then(res=>{
                                alert('Completed Successfully');
                                this.getData();

                                this.$emit('finalizeReport');

                                })
                                .catch(error=>alert(error))
        }

},
validations:{
    surType:{
        required
    },
    extraLongCharges:{
        required
    },
    sur:[
        'surType',
        ],
    surextra:[
        'surType',
        'extraLongCharges',
        ]
}
}
</script>

<style>
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

</style>