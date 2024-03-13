<template>
    <div>
        <div class="form-group row pl-2 pr-2">
                <button @click="addToBeReplaced()" style="font-size:12px" class="btn btn-primary btn-sm mt-2 ml-2">Add</button>
                <button @click="getRecords()" style="font-size:12px" class="btn btn-primary btn-sm mt-2 ml-2">Reload</button>
                <label class="col-sm-2 pt-3">Labour Demand:</label>
                <input class="col-sm-2 mt-2 form-control form-control-sm" v-model="labour" type="number">
                <label class="col-sm-1 pt-3">Assessed:</label>
                <input class="col-sm-2 mt-2 form-control form-control-sm" v-model="assessed" type="number">
                <div class="col-sm-1 mt-2">
                    <div class="form-check">
                        <input class="form-check-input position-static" v-model="isStax" type="checkbox" id="blankCheckbox" value="option1" aria-label="...">
                        <label for="">S/Tax?</label>
                    </div>
                </div>
                <div class="col-sm-2 mt-2">
                    <input type="text" class="form-control form-control-sm" v-model="saleRate">
                    <!-- <Select label="text" style="font-size:12px" :options="cities" v-model="saleReg"></Select> -->
                </div>
                <button @click="updateToBeRepaired()" style="font-size:12px" class="btn btn-primary btn-sm mt-2 ml-2">Update</button>


        </div>

            


          <table class="table table-sm" style="margin-top:10px">
            <thead class="thead-dark">
                <tr>
                <th scope="col" style="padding-left:9px">S #</th>
                <th scope="col">Accessory Name</th>
                <!-- <th scope="col">Status</th> -->
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <!-- <tr v-for="rec in recs" :key="rec.id"> -->
                  <tr v-for="(rec, index) in recs" :key="index">

                    <td style="padding-left:9px">{{index+1}}</td>
                    <td>
                        <!-- <Select :options="accessories" @input="changeName(rec.id,$event)" taggable push-tags v-model="rec.name" label="text"></Select> -->
                        <!-- <autocomplete :search="search"  :get-result-value="getResultValue" :default-value="rec.name" ref="ibrCompany"  ></autocomplete> -->
                        <vue-simple-suggest
                            v-model="rec.name"
                            :list="accessories"
                            :filter-by-query="true">
                        <!-- Filter by input text to only show the matching results -->
                        </vue-simple-suggest>
                    </td>
                    <td>
                        <button @click="deleteAccessories(rec.id)" class="btn btn-danger btn-sm" style="font-size: 0.775rem;">Delete</button>
                    </td>
                </tr>
            </tbody>
            </table>

    </div>
</template>

<style >
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
//    import '@trevoreyre/autocomplete-vue/dist/style.css'
    export default{
        mounted() {
            this.getAccessories();
            // this.getCities();
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
                labour:'',
                assessed:'',
                isStax:'',
                saleReg:'',
                saleRate:''
                
            }
        },
        components:{
            Select: vSelect,
            VueSimpleSuggest
        },
        methods: {
        
           getRecords() {
        this.$forceUpdate();

            this.recs=[];
                axios.get('/getAccessoriesToBeRepaired/'+this.id).then((res) => {
                    res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.recs.push({
                           id: obj.id,
                           name: obj.title
                       });
                    // alert(obj);
                   });
               });
               axios.get('/getToBeRepairedDetails/'+this.id).then((res) => {
                    res.data.forEach((obj) => {
                        this.labour=obj.to_be_repaired_labour;
                        this.assessed=obj.to_be_repaired_assessed;
                        this.isStax=obj.to_be_repaired_is_stax==1?true:false;
                        this.saleRate=obj.to_be_repaired_tax_rate;
                    // alert(ob/j);
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
        //    getCities() {
        //        axios.get("/getCities").then((res) => {
        //            res.data.forEach((obj) => {
        //                let text = "";
        //                let value = "";
        //                let prefix = "";
        //                this.cities.push({
        //                    text: obj.city_name,
        //                    value: obj.sales_tax_rate
        //                });
        //            });
        //        });
        //    },

   
    updateToBeRepaired()
    {
    console.log(this.recs);
      let formData={
                job_id:this.id,
                labour:this.labour,
                assessed:this.assessed,
                is_stax:this.isStax,
                // sale_reg:this.saleReg.value
                recs:this.recs,
                sale_tax_rate:this.saleRate
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
    // alert(rotate);
      let formData={
                job_id:this.id
            };

    axios.post('/addToBeRepaired',formData).then(res=>{
            // alert('Image Order Changed Successfully');
                this.getRecords();

        }).catch(error=>{
            alert(error);



        });
    },

        deleteAccessories(id){
       
    // let formData={
    //             image:image
    //         };

    // let text = "Are You Sure?";
    //         if (confirm(text) == true) {

                axios.post('/deleteAccessoryToBeRepaired/'+id).then(res=>{
                        alert('Record Deleted Successfully');
                         this.getRecords();

                    }).catch(error=>{
                        alert(error);



                    });
            // }
            
        },



        },
 
    }
</script>