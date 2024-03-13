<template>
    
    <div class="container-fluid">
        <div v-if="$v.filename.$error">
            <div class="form-group row">
                <div class="col-md-4">
                        <span class="alert alert-danger">Please Select the Type</span>
                </div>
            </div>
        </div>
        <div class="form-group row">
            
            <label class="col-md-2 col-form-label">Upload Photo: </label>
            <div class="col-md-4 " >
                <input  class="form-control  form-control-sm"  accept=".JPG,.jpg,.jpeg,.png,.PNG"  ref="image"   type="file">
                
            </div>
            <label class="col-md-2 col-form-label">Reference: </label>
            <div class="col-md-3 " >
                <Select name="" id="" v-model="filename" :options="references" label="text"></Select>
                <!-- <div v-if="$v.bankRepresentative.$error" >
                    <p class="text-danger" v-if="!$v.bankRepresentative.required">Please fill out representative</p>
                </div> -->
            </div>
            <div class="col-md-1">
                <input class="btn btn-primary" @click="uploadImages()" type="button"  value="Upload">
            </div>
        </div>
        
        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">?</th>
                <th scope="col">Bright</th>
                <th scope="col">Half Page</th>
                <th scope="col">Image</th>
                <th scope="col">title</th>
                </tr>
            </thead>
            <tbody>
                
                <template v-for="values, type in byType">
                    <tr>
                        <td colspan="5"><h6><b>Group: {{type}}</b></h6></td>
                    </tr>
                    <tr  v-for="rec in values">
                        
                        <td ><button class="btn btn-danger" type="button" @click="deleteImage(rec.id,rec.image)">Delete</button></td>
                        <td><input type="checkbox" :id="rec.rand"  @click="changeBright(rec.id,rec.rand)" :checked="rec.bright"></td>
                        <td><input type="checkbox"  :id="rec.rand+'asd'" @click="changeHalf(rec.id,rec.rand)" :checked="rec.half"></td>
                        <td ><a :href="rec.path" target="blank"><img  height="200" width="200" :src="rec.path" alt=""></a></td>
                        <td>{{rec.title}}</td>
                    </tr>
                </template> 

               
                
                
            </tbody>
        </table>

        
    </div>
</template>
<script>
import axios from 'axios'
import vSelect from 'vue-select'

import { required, minLength, between,email } from 'vuelidate/lib/validators'



export default {
    data(){
       
        return{
            references:[
                
            ],
            filename:'',
            images:[
                
            ]
            // bright:'',
            // half:''
        }
    },
    computed:{
        byType(){
      return this.images.reduce((acc, rec) => {
        (acc[rec.type] = acc[rec.type] || []).push(
            {
                id:rec.id,
                title:rec.title,
                path:document.location.origin+'/'+rec.path,
                bright:rec.bright,
                half:rec.half_page,
                rand:rec.rand,
                image:rec.path}
            )
        return acc
      }, {})
    }
    },
    validations:{
        filename:{
            required
        }
    },
    props:{
        id:String
    },
    components:{
        'Select':vSelect
    },
    mounted(){
        // alert('Working');
        this.getTypes();
        this.getFiles();
    },
    methods:{
       
        changeBright(id,i){
            var bstatus=document.getElementById(i).checked;
            
              
            
             let formData={
                 status:bstatus
            };
             axios.put('/updateBrightStatus/' + id,formData).then(res=>{
                        alert(res.data);
                        
                        // this.getFiles();
                         
                    }).catch(error=>{
                        alert(error);
                        


                    });
        },
        changeHalf(id,i){
             var bstatus=document.getElementById(i+'asd').checked;
           
             let formData={
                 status:bstatus
            };
             axios.put('/updateHalfStatus/' + id,formData).then(res=>{
                        alert(res.data);
                        //  this.getFiles();
                    }).catch(error=>{
                        alert(error);
                        


                    });
            // alert(bstatus);

        },
        getTypes(){
            axios.get('/getTypes').then(res=>{
                    res.data.forEach((element) => {
                         let text='';
                        let value='';
                        this.references.push(
                            {
                                text:element.description,
                                value:element.id
                              
                                }
                            ); 
                    });
                }).catch(error=>{
                    alert(error);
                    


                });
        },
        getFiles(){
            this.images=[];
            axios.get('/getImages/'+this.id).then(res=>{
                    res.data.forEach((element) => {
                         let text='';
                        let value='';
                        this.images.push(
                            {
                               id:element.id,
                               title:element.title,
                               path:element.path,
                               bright:element.bright,
                               half_page:element.half_page,
                               type:element.description,
                               rand:element.rand
                                
                                }
                            ); 
                    });
                }).catch(error=>{
                    alert(error);
                    


                });
        },
        uploadImages()
        {
            
            this.$v.$touch();
            if(!this.$v.filename.$invalid)
            {
                let file = this.$refs.image.files[0];
                if(file==null)
                {
                    alert('Please select some file');
                }
                else
                {
                
                    let formData = new FormData();
            
                    formData.append('myfile', file);
                    formData.append('filename', this.filename.value);
                    formData.append('job_id', this.id);


                    axios.post('/uploadValuationImages',formData).then(res=>{
                        alert(res.data);
                         this.getFiles();
                    }).catch(error=>{
                        alert(error);
                        


                    });
                
                }



                        
            }

        
            
        },
        deleteImage(id,image){
            let formData={
                image:image
            };
            axios.post('/deleteVehicleImage/'+id,formData).then(res=>{
                        alert(res.data);
                         this.getFiles();
                    }).catch(error=>{
                        alert(error);
                        


                    });
        }
    }

    
}
</script>

<style scoped>

</style>