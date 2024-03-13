    <template>
    <div>
        <div class="form-group row pl-2 pr-2">

                <div>
                <button @click="addToBeReplaced()" style="font-size:12px" class="btn btn-primary btn-sm mt-2 ml-2">Add</button>

                </div>
                <div>
                    <button @click="getRecords()" style="font-size:12px" class="btn btn-primary btn-sm mt-2 ml-2">Reload</button>

                </div>
                <label class="col-sm-1 pt-3">Lumpsum:</label>
                <input class="col-sm-2 mt-2 form-control form-control-sm" v-model="lumpsum" type="number">
                
                <div class="col-sm-3 mt-2" style="padding-top:4px">
                    <div class="form-check">
                        <input class="form-check-input position-static" v-model="isStax" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                        <label for="">S/Tax Post Depreciation ?</label>
                    </div>

                </div>
                <div class="col-sm-1 ">
                    <button @click="saveData()" style="font-size:12px;margin-top:10px" class="btn btn-primary btn-sm ml-2" >Save</button>

                </div>

                <!-- <div style="padding-top:4px">
                    <button @click="updateToBeRepaired()" style="font-size:12px" class="btn btn-primary btn-sm mt-1 ml-2">Update</button>
                </div> -->
 


        </div>

            

        <div>
            <table class="table table-sm" style="margin-top:10px;font-size: 13px;">
              <thead class="thead-dark">
                  <tr>
                  <th scope="col" style="padding-left:9px">S.no</th>
                  <th scope="col" style="padding-left:9px">#</th>
                  <th scope="col" style="width: 26%;">Accessory Name</th>
                  <th scope="col">Amount</th>
                  <th scope="col">Disc.%</th>
                  <th scope="col">Dep.%</th>
                  <th scope="col">Salvage.%</th>
                  <th scope="col">GST.%</th>
                  <!-- <th scope="col">Action</th> -->
                  </tr>
              </thead>
              <tbody>
  
                  <tr v-for="(rec, index) in recs" :key="index">
                    <td style="padding:5px">
                        {{index+1}}
                    </td>
                      <td style="padding:10px">
                          <div >
                          <i class="fa fa-trash"  @click="deleteAccessories(index,rec.id)"></i>
                          <!-- <i class="fa fa-trash"  ></i> -->
  
                          </div>
                      </td>
                      <td>
                          <!-- <Select :options="accessories" taggable push-tags style="font-size:12px" :id="'accessoriesname'+rec.id" v-model="rec.name" ></Select> -->
                          <!-- <Select :options="accessories" taggable push-tags style="font-size:12px" @input="changeName(rec.id,$event)" v-model="rec.name" label="text"></Select> -->
                          <vue-simple-suggest
                            v-model="rec.name"
                            :list="accessories"
                            :filter-by-query="true">
                        <!-- Filter by input text to only show the matching results -->
                        </vue-simple-suggest>
                        </td>
                      <td>
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;"  @keyup.enter="changeVal(rec.id,$event,'Amount')" v-model="rec.amount" > -->
                          <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'amount'+rec.id"  v-model="rec.amount" >
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" type="hidden" :id="'oldamount'+rec.id"  :value="rec.amount" > -->
                      </td>
  
                      <td>
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" v-model="rec.disc" @keyup.enter="changeVal(rec.id,$event,'Disc')"> -->
                          <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'desc'+rec.id"  v-model="rec.disc" >
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;"  type="hidden" :id="'olddesc'+rec.id"  :value="rec.disc" > -->
                      </td>
                      <td>
                          <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'dep'+rec.id"  v-model="rec.dep">
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'olddep'+rec.id" type="hidden"  :value="rec.dep"> -->
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" v-model="rec.dep"  @keyup.enter="changeVal(rec.id,$event,'Dep')"> -->
                      </td>
                      <td>
                          <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'sal'+rec.id"  v-model="rec.salvage" >
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'oldsal'+rec.id" type="hidden"  :value="rec.salvage"> -->

                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" v-model="rec.salvage" @keyup.enter="changeVal(rec.id,$event,'Salvage')"> -->
                      </td>
                      <td>
                          <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'gst'+rec.id"  v-model="rec.gst" >
                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" :id="'oldgst'+rec.id" type="hidden"  :value="rec.gst"> -->

                          <!-- <input class="form-control form-control-sm" style="font-size:12px;height: 30px;" v-model="rec.gst" @keyup.enter="changeVal(rec.id,$event,'Gst')"> -->
                      </td>
  
                      <!-- <td class="row" style="padding:10px 22px">
                         
                          <div style="padding-left:3px !important"> -->
                          <!-- <i class="fa fa-redo"   @click="getRecords()"></i> -->
                          <!-- <i class="fa fa-redo"   @click="refresh(rec.id,rec.amount)"></i>
  
                          </div> -->
                          <!-- <i class="fa fa-arrows-rotate"></i> -->
                          
                      <!-- </td> -->
                  </tr>
              </tbody>
           </table>

        </div>
        <div>
         </div>


    </div>
        
</template>

<style scoped>
.vue-simple-suggest.designed .input-wrapper input {
    display: block;
    width: 100%;
    /* margin: 0px; */
    padding: 7px;
    font-size: 11px;
    border: 1px solid #ced1d4;
    border-radius: 4px;
    color: black;
    background: white;
}
</style>

<script>
   import vSelect from "vue-select";
   import axios from "axios";
   import VueSimpleSuggest from 'vue-simple-suggest'
  import 'vue-simple-suggest/dist/styles.css' // Optional CSS
    export default{
        mounted() {
            this.getAccessories();
            this.getCities();
            this.getRecords();
        },
        props:{
            id:String
        },
        data(){
            return{
                types:[
                    {text:'Factory Fitted'},
                    {text:'Self Fitted'},
                    {text:'Not Fitted'}
                ],
                accessories:[],
                recs:[],
                cities:[],
                lumpsum:'',
                assessed:'',
                isStax:'',
                saleReg:'',
                
            }
        },
        components:{
            Select: vSelect,
            VueSimpleSuggest
        },
        methods: {
            setSelected(value,id){

                return value;
                // alert(value);/
                // document.getElementById('accessoriesname'+id).value=value;
            
            },
            refresh(id){
                document.getElementById('amount'+id).value=document.getElementById('oldamount'+id).value;
                document.getElementById('desc'+id).value=document.getElementById('olddesc'+id).value;
                document.getElementById('dep'+id).value=document.getElementById('olddep'+id).value;
                document.getElementById('sal'+id).value=document.getElementById('oldsal'+id).value;
                document.getElementById('gst'+id).value=document.getElementById('oldgst'+id).value;

            },
            saveData(){
                // console.log(this.recs);

                    let formData1={
                    job_id:this.id,
                    is_tax:this.isStax,
                    lumpsum:this.lumpsum
                };

                axios.put('/updateReplacedControl',formData1).then(res=>{
                        // alert('Updated Successfully');
                            // this.getRecords();

                    }).catch(error=>{
                        alert(error);



                    });

               

                let formData={
                recs:this.recs,
                jid:this.id
                };

                axios.put('/updateReplcaed/'+this.id,formData).then(res=>{
                    // alert('Image Order Changed Successfully');
                        // this.getRecords();

                }).catch(error=>{
                    alert(error);



                });
            },
           getRecords() {
        this.$forceUpdate();

            this.recs=[];
                axios.get('/getAccessoriesToBeReplaced/'+this.id).then((res) => {
                    res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.recs.push({
                           id: obj.id,
                           name: obj.title,
                           amount: obj.amount,
                           disc: obj.disc,
                           dep: obj.dep,
                           salvage: obj.salvage,
                           gst: obj.gst
                       });
                    // alert(obj);
                   });
               });
               axios.get('/getToBeRepairedDetails/'+this.id).then((res) => {
                    res.data.forEach((obj) => {
                        this.lumpsum=obj.lumpsum;
                        this.isStax=obj.to_be_replaced_tax=="1"?true:false;
                    // alert(obj);
                   });
               });
           },
        getAccessories() {
               axios.get("/getAccessories").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.accessories.push(obj.name);
                   });
               });
           },
           getCities() {
               axios.get("/getCities").then((res) => {
                   res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.cities.push({
                           text: obj.city_name,
                           value: obj.sales_tax_rate
                       });
                   });
               });
           },

    changeName(id,acname)
    {
    // alert(rotate);
      let formData={
                id:id,
                name:acname.text
            };

        axios.put('/changeAccessoriesToBeReplaced',formData).then(res=>{
            // alert('Image Order Changed Successfully');
                this.getRecords();

        }).catch(error=>{
            alert(error);



        });
    },
    changeVal(id,acname,type)
    {
        // alert(acname.target.value);
    // alert(rotate);
      let formData={
                id:id,
                name:acname.target.value,
                type:type
            };

        axios.put('/changeValuesBeReplaced',formData).then(res=>{
            // alert('Image Order Changed Successfully');
                this.getRecords();

        }).catch(error=>{
            alert(error);



        });
    },
    changeType(id,actype)
    {
    // alert(rotate);
      let formData={
                id:id,
                name:actype.text
            };

    axios.put('/changeType',formData).then(res=>{
            // alert('Image Order Changed Successfully');
                this.getRecords();

        }).catch(error=>{
            alert(error);



        });
    },
    updateToBeRepaired()
    {
    // alert(rotate);
      let formData={
                job_id:this.id,
                labour:this.labour,
                assessed:this.assessed,
                is_stax:this.isStax,
                sale_reg:this.saleReg.value
            };

    axios.put('/updateToBeRepaired',formData).then(res=>{
            // alert('Updated Successfully');
                // this.getRecords();

        }).catch(error=>{
            alert(error);



        });
    },
    

    addToBeReplaced()
    {
        axios.post('/addToBeReplaced/'+this.id).then(res=>{
            // alert('Updated Successfully');
                // this.getRecords();
                // alert(res.data);
                this.recs.push({
                           id:res.data,
                           name: "",
                           amount: "",
                           disc: "",
                           dep: "",
                           salvage: "",
                           gst: ""
                       });

        }).catch(error=>{
            alert(error);



        });


    //   let formData={
    //             job_id:this.id
    //         };

    // axios.post('/addToBeReplaced',formData).then(res=>{
    //         // alert('Image Order Changed Successfully');
    //             this.getRecords();

    //     }).catch(error=>{+
    //         alert(error);



    //     });
    },

        deleteAccessories(index,id){
            
            this.recs.splice(index, 1);
            axios.post('/deleteAccessoryToBeReplaced/'+id).then(res=>{
                        // alert('Record Deleted Successfully');
                        //  this.getRecords();

                    }).catch(error=>{
                        alert(error);



                    });
            // let text = "Are You Sure?";
            // if (confirm(text) == true) {
            
               
            
            // }

        },



        },
 
    }
</script>