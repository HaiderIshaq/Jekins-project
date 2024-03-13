<template>

    <div>
        <div class="col-md-12 col-sm-12" style="padding: 0px 30px 0px 30px;">
                        <!-- <h5 style="padding-bottom:5px">Job Details</h5> -->

                        <div class="">

                           

                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Date:</label>
                                <div class="col-md-9">
                                    <input type="date" name="" v-model="dateis" class="form-control form-control-sm" id="">
                                </div>
                            </div>
                              <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">To:</label>
                                <div class="col-md-9">
                                    <input type="text" name="" v-model="tois" class="form-control form-control-sm" id="">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Address:</label>
                                <div class="col-md-9">
                                   <textarea class="form-control form-control-sm" v-model="address"  style="height: 50px;" name="" id="" cols="42"
                                    rows="1"></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Subject:</label>
                                <div class="col-md-9">
                                    <textarea name="" id="" cols="42" rows="1"  v-model="subject" class="form-control form-control-sm"
                                        style="height: 50px;"></textarea>
                                </div>
                            </div>
                             
                             <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">Text of Letter:</label>
                                <div class="col-md-9">
                                    <textarea type="text" name=""  @click="getToData()" v-model="textofletter" class="form-control form-control-sm" id=""></textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label">CC:</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cc1" class="form-control form-control-sm" name="" id="" placeholder="1) :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cc2" class="form-control form-control-sm" name="" id="" placeholder="2) :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cc3" class="form-control form-control-sm" name="" id="" placeholder="3) :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cc4" class="form-control form-control-sm" name="" id="" placeholder="4) :">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="" class="col-md-3 col-form-label"></label>
                                <div class="col-md-9">
                                    <input type="text" v-model="cc5" class="form-control form-control-sm" name="" id="" placeholder="5) :">
                                </div>
                            </div>
                         


                            <div class="form-group row" style="padding-right:30px">
                                <div class="col-md-12">


                                    <!-- <a href="#"><input type="button" class="btn btn-primary"
                                            style="float:right;margin:10px" value="Cancel"></a> -->
                                    <input type="button" @click="onComplete()"
                                        style="float:right;margin:10px" class="btn btn-primary" value="Print">

                                </div>
                            </div>

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
    export default {
    props: {

        usertoken: String,
        jobid: String,

    },
    components: {
        'Select': vSelect,
    },
    data(){
    return{

    dateis:'',
    tois:'',
    address:'',
    subject:'',
    textofletter:'',
    cc1:'',
    cc2:'',
    cc3:'',
    cc4:'',
    cc5:'',
    toOption:'',
    toOption1:'',
    toAddress:'',
    containerCount:'',
    containerNumber:'',
    packageCount:'',
    packageNumber:'',
    weight:'',
    consignment:'',
    lcno:'',
    blno:'',
    bldate:'',
    vessel:'',
    toLocation:'',
    }
    },
    mounted(){
    this.getReportData();
    this.getToData();
    },
    methods:{

        getToData(){
            this.textofletter="Reference to the particulars of the claim, explained below. We the surveyor visited at workshop of M/s. Burney Autos, Karachi on _________________________. We carefully checked & examined the said vehicle. After taking photographs we also settled matter with the repairer. However the isnured drove away the vehicle stating that he will get it repiared later. Since then we are continuously contacting him thourgh cell calls but he is not responding.";

        },

    getReportData() {
            axios.get('/getPartialData/' + this.jobid)
                .then(res => {
                    console.log(res.data);
                    res.data.forEach((obj) => {


                        // this.signer = {
                        //     text: obj.signed_by,
                        //     value: obj.signed_by
                        // };

                        this.dateis = obj.date;
                        // this.tois = obj.to_is_letter;
                        this.address = obj.address;
                        this.subject = obj.subject;
                        this.textofletter = obj.text_of_letter;
                        this.cc1 = obj.cc_one;
                        this.cc2 = obj.cc_two;
                        this.cc3 = obj.cc_three;
                        this.cc4 = obj.cc_four;
                        this.cc5 = obj.cc_five;
                    
                    })

                })

        },

    onComplete(){

                    this.postdata();
                
    },
    postdata(){

            const jobData={
                jobid:this.jobid,
                to_is:this.tois,
                date:this.dateis,
                address:this.address,
                subject:this.subject,
                text_of_letter:this.textofletter,
                cc_one:this.cc1,
                cc_two:this.cc2,
                cc_three:this.cc3,
                cc_four:this.cc4,
                cc_five:this.cc5,



            };

                const headers = {
                'Authorization': 'Bearer ' + this.usertoken,
                'Content-Type': 'application/json'
            };

            axios.put('/api/updatePrismLetterData/'+this.jobid, jobData, {
                    headers: headers
                })
                .then(res => {


                    //  alert('Data Submitted');

                    window.open(
                        "/NoLossReport/"+this.jobid,
                        '_blank' // <- This is what makes it open in a new window.
                        );
                    // window.location.href = "/printPrismLetter/"+this.jobid    ;
                    return false;
                })
                .catch(error =>{

                    alert(error);
                })
    }
}

}
</script>
<style scoped>

</style>
