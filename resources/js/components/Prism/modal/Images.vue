<template>
    <div>
        <div class="row" style="padding-top:10px">
            <div class="col-md-2">
                <a :href="/downloadAssets/+this.id"> <button class="btn btn-primary btn-sm " style="font-size:12px;margin:9px 0px 6px 4px">Download</button></a> 
                <button @click="getRecords()" class="btn btn-primary btn-sm " style="font-size:12px;margin:9px 4px 6px 4px">Reload</button>


            </div>

            <div class="col-md-3">
                <div class="row">
                    <input type="file" ref="files" style="font-size:10px;height:31px"  accept="image/jpeg" class="mt-2 form-control form-control-sm col" name="" id="">

                </div>
                    

            </div>
            <div class="col-md-3">
                <Select :options="titles" label="text"  style="font-size:12px;margin-top:10px" v-model="title"></Select>

            </div>
            <div class="col-md-2">
                    <button @click="addImages()" class="btn btn-primary btn-sm " style="font-size:12px;margin:9px 18px 6px 19px">Upload</button>


            </div>
       


            <!-- <i class="">Reload</i> -->

        </div>
          <table class="table table-sm" style="margin-top:10px;">
            <thead class="thead-dark">
                <tr>
                <th scope="col" style="padding-left:9px">S #</th>
                <th scope="col">Photo</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="rec in recs" :key="rec.id">
                    <td style="padding-left:9px">{{rec.id}}</td>
                    <td>
                        <!-- <Select :options="accessories" @input="changeName(rec.id,$event)" v-model="rec.name" label="text"></Select> -->
                       <a :href="rec.path" target="_blank" class="btn btn-primary btn-sm" style="font-size: 12px;">View</a> 
                    </td>
                    <td>
                        <!-- <Select :options="types" label="text" @input="changeType(rec.id,$event)" v-model="rec.type"></Select> -->
                        <input type="text" name="" @change="event => updateTitle(event,rec.id)" v-model="rec.title" class="form-control form-control-sm" id="">

                    </td>
                    <td>
                        <button @click="deleteAccessories(rec.id)" class="btn btn-danger btn-sm" style="font-size: 0.775rem;">Delete</button>
                    </td>
                </tr>
            </tbody>
            </table>

    </div>
</template>

<style scoped>
th{
    font-size: 13px;
}

.form-control{
    font-size: 12px;
}
</style>

<script>
   import vSelect from "vue-select";
   import axios from "axios";

    export default{
        mounted() {
            // this.getAccessories();
            this.getRecords();
        },
        props:{
            id:String
        },
        data(){
            return{
                titles:[
                    {text:'Back View'},
                    {text:'Front View'},
                    {text:'Video'}
                ],
                title:'',
                filesList:[],
                filename:'',
                recs:[],
                
            }
        },
        components:{
            Select: vSelect,
        },
        methods: {

                  addImages(){

          if(this.$refs.files.files.length==0)
          {
              alert('Please Select Some Files');
          }

          else
          {

            // alert('Uploaded');

            let formData = new FormData();
                let file = this.$refs.files.files[0];
                    formData.append('file', file);
                    formData.append('jid', this.id);
                    formData.append('type', this.title.text);

                    console.log(formData);

                axios.post('/uploadAssets',formData).then(res=>{

                    this.getRecords();
                    alert('Asset Uploaded Successfully');

                }).catch(error=>{
                alert("Something Went Wrong");



                });

         }
        },

        updateTitle(event,id)
        {
            console.log();

            let formData={
                title:event.target.value
            };

    axios.put('/changeAssetTitle/'+id,formData).then(res=>{
            // alert('Image Order Changed Successfully');
                // this.getRecords();

                alert('Title Updated');

        }).catch(error=>{
            alert(error);



        });
        },
           getRecords() {
        this.$forceUpdate();

            this.recs=[];
                axios.get('/getAssets/'+this.id).then((res) => {
                    res.data.forEach((obj) => {

                       this.recs.push({
                           id: obj.id,
                           title: obj.title,
                           path: window.location.origin+'/'+obj.path
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
            
            // let text = "Are You Sure?";
            // if (confirm(text) == true) {

                axios.post('/deleteAsset/'+id).then(res=>{
                        // alert('Asset Deleted Successfully');
                         this.getRecords();

                    }).catch(error=>{
                        alert(error);



                    });
            // }
    // let formData={
    //             image:image
    //         };

        },



        },
        // validations:{
        //     company: {
        //        required,
        //    },
        //    region: {
        //        required,
        //    },
        // }
 
    }
</script>