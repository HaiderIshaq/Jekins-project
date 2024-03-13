<template>
    <div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
           <a href="/users" class="btn btn-primary">Back</a>
        <div class="clearfix">
            <h4 class="text-blue pt-3">Users</h4>
            <p class="mb-30 font-14">Add New User</p>
        </div>
        <div id="section1">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Name: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="text" class="form-control  form-control-sm" :class="{'invalid':$v.userFirstName.$error}" v-model="userFirstName">
                        <div v-if="$v.userFirstName.$error">
                            <p class=" text-danger" v-if="!$v.userFirstName.required">Please input user first name</p>
                        </div> 
                    </div>
                </div>
           
                  <div class="form-group row">
                    <label class="col-md-3 col-form-label">Phone Number: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                    <input type="number" class="form-control  form-control-sm" :class="{'invalid':$v.userPhone.$error}" v-model="userPhone" >
                        <div v-if="$v.userPhone.$error">
                            <p class=" text-danger" v-if="!$v.userPhone.required">Please input user phone number</p>
                             
                        </div> 
                    </div>
                </div>
                <div class="form-group row ">
                    <label class="col-md-3">Region: </label>
                    <div class="col-md-8 pl-0 pr-0">
                        <Select  label="text" :options="regions" v-model="userRegion" :class="{'invalid':$v.userRegion.$error}"></Select>
                         <div v-if="$v.userRegion.$error">
                            <p class=" text-danger" v-if="!$v.userRegion.required">Please select some user region</p>
                        </div> 
                        
                    </div>
                </div>
                <div class="form-group row" >
                    <label class="col-md-3" for="company">Role / Right </label>

                    <div class="col-md-8 pl-0 pr-0">
                        <Select id="company"  label="text" :options="roles" :class="{'invalid':$v.userRole.$error}" v-model="userRole"></Select>
                        <div v-if="$v.userRole.$error">
                            <p class=" text-danger" v-if="!$v.userRole.required">Please select some role</p>
                        </div> 
                    </div>
                </div>
                <div class="form-group row" >
                    <label class="col-md-3" for="company">Company </label>

                    <div class="col-md-8 pl-0 pr-0">
                        <Select id="company"  label="text" :options="companies" :class="{'invalid':$v.userCompany.$error}" v-model="userCompany"></Select>
                        <div v-if="$v.userCompany.$error">
                            <p class=" text-danger" v-if="!$v.userCompany.required">Please select some user company</p>
                        </div> 
                        
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Designation: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                         <input type="text" class="form-control  form-control-sm" v-model="userDesignation" :class="{'invalid':$v.userDesignation.$error}" > 
                            <div v-if="$v.userDesignation.$error">
                            <p class=" text-danger"  v-if="!$v.userDesignation.required">Please input user Designation</p>
                            </div> 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Username: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                        <input type="text" class="form-control  form-control-sm" v-model="userName" :class="{'invalid':$v.userName.$error}">
                        <div v-if="$v.userName.$error">
                            <p class=" text-danger"  v-if="!$v.userName.required">Username is required</p>
                            <p class=" text-danger"  v-if="!$v.userName.email">must be email</p>
                            </div> 
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label">Password: </label>
                    <div class="col-md-8 pl-0 pr-0" >
                        <input type="password" class="form-control  form-control-sm" v-model="userPassword" :class="{'invalid':$v.userPassword.$error}" > 
                        <div v-if="$v.userPassword.$error">
                            <p class=" text-danger"  v-if="!$v.userPassword.required">Password is required</p>
                            <p class=" text-danger"  v-if="!$v.userPassword.minLength">Password Length must be at least 8 Characters</p>

                        </div> 
                    </div>
                </div>
              
                <br>
                <button class="btn btn-primary"  @click="onComplete()">Register User</button>
               
               
        </div>     
    </div>
      
</template>

<script>
import { required, minLength, between,email } from 'vuelidate/lib/validators'
import axios from 'axios'
import Select from 'vue-select'
export default {
     components:{
          'Select':Select
      },
    data() {
        return{
            userFirstName:'',
            userName:'',
            userPhone:'',
            userCompany:'',
            userPassword:'',
            userRegion:'',
            userRole:'',
            userDesignation:'',
            regions:[],
            companies:[],
            roles:[]
        }
    },
    mounted(){
        this.getCompany();
        this.getRegion();
        this.getRoles();
    },
    methods:{
        onComplete(){
            if(this.$v.userForm.$invalid)
            {
                this.$v.userForm.$touch();
                var isValid = !this.$v.userForm.$invalid
                this.$emit('on-validate', this.$data, isValid)
                return isValid
            }
            else{

                const userData={
            firstname:this.userFirstName,
            username:this.userName,
            phone:this.userPhone,
            company:this.userCompany.value, 
            role:this.userRole.value, 
            region:this.userRegion.value,
            designation:this.userDesignation,
            password:this.userPassword
           
            };

            axios.post('/addUser',userData)
            .then(res=>{
              
                alert('User Created');
            //    this.companyName1='';
            //    this.companyAddress1='';
            //    this.companyStreet1='';
            //    this.companyPobox1='';
            //    this.companyCountry1='';
            //    this.companyEmail1='';
            //    this.companyFax1='';
            //    this.companyWebsite1='';
            //    this.companyReg1='';

            })
            .catch(error=>alert(error))

            }
          
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
        getRoles(){
            axios.get('/getUserRoles')
                        .then(res=>{
                                res.data.forEach((obj)=>{
                                let text="";
                                let value="";
                                this.roles.push({ text: obj.description,value:obj.id})
                                
                            })
                        })
        }
    },
    validations:{
        userFirstName:{
            required
        },
        userPhone:{
            required
            //   minLength: minLength(11),
            //   maxLength: maxLength(11)
        },
        userRegion:{
            required
        },
        userRole:{
            required
        },
        userCompany:{
            required
        },
        userName:{
            required,
            email
        },
        userDesignation:{
            required
        },
         userPassword:{
            required,
          minLength: minLength(8)

        },
         userForm:[
        'userFirstName',
        'userPhone',
        'userRole',
        'userRegion',
        'userCompany',
        'userName',
        'userDesignation',
        'userPassword'
        ]
    }
}
</script>
<style scoped>
.invalid{
    border: #dc3545 1px solid;
    background-color: #ffc9aa
}
</style>