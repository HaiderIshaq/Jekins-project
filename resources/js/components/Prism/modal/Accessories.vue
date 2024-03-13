<template>
    <div>
        <button @click="addAccessory()" class="btn btn-primary btn-sm mt-2 ml-2" style="font-size:12px">Add</button>
        <button @click="getRecords()" class="btn btn-primary btn-sm mt-2 ml-2" style="font-size:12px">Reload</button>
          <table class="table table-sm" style="margin-top:10px;">
            <thead class="thead-dark">
                <tr>
                <th scope="col" style="padding-left:9px">S #</th>
                <th scope="col">Accessory Name</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="rec in recs" :key="rec.id">
                    <td style="padding-left:9px">{{rec.id}}</td>
                    <td>
                        <Select taggable push-tags :options="accessories" @input="changeName(rec.id,$event)" v-model="rec.name" label="text"></Select>
                    </td>
                    <td>
                        <Select :options="types" label="text" @input="changeType(rec.id,$event)" v-model="rec.type"></Select>
                    </td>
                    <td>
                        <button @click="deleteAccessories(rec.id)" class="btn btn-danger btn-sm" style="font-size: 0.775rem;">Delete</button>
                    </td>
                </tr>
            </tbody>
            </table>

    </div>
</template>

<style>

</style>

<script>
   import vSelect from "vue-select";
   import axios from "axios";

    export default{
        mounted() {
            this.getAccessories();
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
                
            }
        },
        components:{
            Select: vSelect,
        },
        methods: {
           getRecords() {
        this.$forceUpdate();

            this.recs=[];
                axios.get('/getAccessoriesRecs/'+this.id).then((res) => {
                    res.data.forEach((obj) => {
                       let text = "";
                       let value = "";
                       let prefix = "";
                       this.recs.push({
                           id: obj.id,
                           name: obj.name,
                           type: obj.type
                       });
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
                       this.accessories.push({
                           text: obj.name,
                           value: obj.id
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

    axios.put('/changeName',formData).then(res=>{
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

    addAccessory()
    {
    // alert(rotate);
      let formData={
                job_id:this.id
            };

    axios.post('/addAccessory',formData).then(res=>{
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
            axios.post('/deleteAccessory/'+id).then(res=>{
                        // alert('Record Deleted Successfully');
                         this.getRecords();

                    }).catch(error=>{
                        alert(error);



                    });
        },



        },
 
    }
</script>