<template>

            <div class="modal fade " id="letterModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content container">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Letter(s)</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-12 col-sm-12" style="padding: 0px 30px 0px 30px;">
                                <!-- <h5 style="padding-bottom:5px">Job Details</h5> -->

                                <div class="">

                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Types of Letter:</label>
                                        <div class="col-md-3">
                                            <input type="radio" @change="getToData()" name="" id="" v-model.trim="typeofletter" value="Bank"> <label for="" class="col-form-label">Bank</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="" id="" @change="getToData()"  v-model.trim="typeofletter" value="Clearing Agent"> <label for="" class="col-form-label">Clearing Agent</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="" id="" @change="getToData()" disabled v-model.trim="typeofletter" value="Bonded Warehouse"> <label for="" class="col-form-label">Bonded Warehouse</label>
                                        </div>
                                    </div>

                                     <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">For:</label>
                                        <div class="col-md-2">
                                            <input type="radio" name="" id="" @change="getToData()" v-model.trim="forpurpose" value="First Letter"> <label for="" class="col-form-label">First Letter</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" name="" id="" @change="getToData()" v-model.trim="forpurpose" value="After Clearance"> <label for="" class="col-form-label" >After Clearance</label>
                                        </div>
                                        <div class="col-md-2">
                                            <input type="radio" name="" id="" @change="getToData()" v-model.trim="forpurpose" value="Delivery" > <label for="" class="col-form-label">Delivery</label>
                                        </div>
                                         <div class="col-md-2 ">
                                            <input type="radio" name="" id="" @change="getToData()" v-model.trim="forpurpose" value="Completion"> <label for="" class="col-form-label">Completion</label>
                                        </div>
                                    </div>

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
                                           <textarea class="form-control form-control-sm" v-model="address" style="height: 50px;" name="" id="" cols="42"
                                            rows="1"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Subject:</label>
                                        <div class="col-md-9">
                                            <textarea name="" id="" cols="42" rows="1" v-model="subject" class="form-control form-control-sm"
                                                style="height: 50px;"></textarea>
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Ref:</label>
                                        <div class="col-md-9">
                                            <input type="text" v-model="ref" name="" class="form-control form-control-sm" id="">
                                        </div>
                                    </div>
                                     <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Text of Letter:</label>
                                        <div class="col-md-9">
                                            <textarea type="text" name="" v-model="textofletter" class="form-control form-control-sm" id=""></textarea>
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
                                    <div class="form-group row">
                                        <label for="" class="col-md-3 col-form-label">Signed By:</label>
                                        <div class="col-md-9">
                                          <Select name="" v-model="signer" label="text" :class="[{'date-invalid':$v.signer.$error},'mySelect']" :options="signers" id="">

                                          </Select>
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
        signers:[
            {text:'Misbah Muhammad Sohail'},
            {text:'Muhammad Imran'}
        ],
        signer:'',
        typeofletter:'Bank',
        forpurpose:'First Letter',
        dateis:'',
        tois:'',
        address:'',
        subject:'',
        ref:'',
        textofletter:'',
        cc1:'',
        cc2:'',
        bank:'',
        branch:'',
        bankAddress:'',
        bankDate:'',
        bankLetter:'',
        clearingAgent:'',
        clearingAgentAddress:'',
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
    // this.getToData();
},
methods:{
    getToData(){

        if(this.typeofletter=="Bank" )
        {
            this.tois=this.bank; //Bank Name
            this.address=this.bankAddress; //Bank Billing Address
            this.ref='Your letter ' + this.bankLetter + ' dated: ' + this.bankDate;

            if(this.forpurpose=="First Letter")
            {
                alert('Bank & First Letter is selected');
                this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.cc1="M/S. " +this.toLocation+ "- for information";
                this.cc2="M/S. " +this.clearingAgent+ ", " +this.clearingAgentAddress+ " - for information";
            }
            else if(this.forpurpose=="After Clearance")
            {
                alert('Bank & After Clearance is selected');

                this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.cc1="M/S. " +this.toLocation+ "- for information";
                this.cc2="M/S. " +this.clearingAgent+ ", " +this.clearingAgentAddress+ " - for information";
                this.textofletter="With reference to the above, we are pleased to inform your goodself that the above mentioned consignment has been cleared from the Port by M/S. "+this.clearingAgent+", (C&F Agents) Karachi and despatched to the "+this.toOption1+" at "+this.toAddress+" under Bank's lien, as per instructions of the Bank. Photocopy of the Bill of Entry (GD-1) for Consumption is enclosed herewith as desired.\n\nIt is requested that insurance of the stocks as required under Bank mortgage clause may kindly be arranged. However, if the stocks are already insured a photocopy of the insurance policy may please be provided to us for our record.";

            }
            else if(this.forpurpose=="Delivery")
            {
                alert('Bank & After Delivery is selected');
                this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.cc1="M/S. " +this.toLocation+ "- for information";
                this.cc2="M/S. " +this.clearingAgent+ ", " +this.clearingAgentAddress+ " - for information";
                this.textofletter="With reference to the above, we are pleased to inform your goodself that the balance quantity out of the above mentioned consignment has also been cleared from the Port and despatched to the "+this.toOption1+" at "+this.toAddress+". through M/S. "+this.clearingAgent+" , Karachi, vide T.R / Bilty No. enclosed herewith in original for your record. The balance goods are under clearance and T.Rs/Bilties will follow when they are dispatched. \n\n It is requested that the authorized official of the Bank may please be advised to be present at the "+this.toOption1+" to take over the goods under their control. \n\n Please Note: Truck receipts/daily dispatch reports are sent to the Bank/Muccadum to enable them to post their representative before the Cargo reaches the premises. Note that the Cargo will be unloaded immediately on arrival at Site and we as Clearing Agent takes no responsibility for any mishap, shifting, or consumption of the Stocks occur due to non availability of the Banks/Muccadum representative at the time of unloading of stocks.";

            }
            else if(this.forpurpose=="Completion")
            {
                alert('Bank & After Completion is selected');
                 this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.cc1="M/S. " +this.toLocation+ "- for information";
                this.cc2="M/S. " +this.clearingAgent+ ", " +this.clearingAgentAddress+ " - for information";
                this.textofletter="Further to our letter dated: on the subject noted above, we are pleased to inform your goodself that the balance quantity out of the above mentioned consignment has also been cleared from the Port and despatched to the "+this.toOption+" at "+this.toAddress+". through M/S. "+this.clearingAgent+" , Karachi, vide T.R / Bilty No. enclosed herewith in original for your record.\nThus, the job now stands completed.\n\nIt is requested that the authorized official of the Bank may please be advised to be present at "+this.toOption1+" to take over the goods under their control.\nPlease Note: Truck receipts/daily dispatch reports are sent to the Bank/Muccadum to enable them to post their representative before the Cargo reaches the premises. Note that the Cargo will be unloaded immediately on arrival at Site and we as Clearing Agent takes no responsibility for any mishap, shifting, or consumption of the Stocks occur due to non availability of the Banks/Muccadum representative at the time of unloading of stocks.";

            }

        }

        else if(this.typeofletter="Clearing Agent")
        {
            this.tois=this.clearingAgent; //Clearing Agent Name
            this.address=this.clearingAgentAddress; //Clearing Agent Address
            this.ref='';

                if(this.forpurpose=="First Letter")
            {
                alert('Clearing Agent & First Letter is selected');

                this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.textofletter="Please be informed that the "+this.bank+", "+this.branch+", has forwarded original documents of title relating to the above consignment to us for its clearance and handling as per instructions of the said Bank.\n\nThe Bank has advised that the consignment will be cleared and handled by you under our supervision. Therefore, Bill of Lading No. "+this.blno+" dated: "+this.bldate+" is enclosed herewith in original to proceed further in the matter. After clearance from the Port the consignment is to be stored at Importer's premises, "+this.toAddress+", under lien/pledge of the said Bank.\n\nIn view of the above, please ensure that we are informed well in time to arrange for supervision. T.R/Bilty is to be made in favour of "+this.bank+", "+this.branch+" and forwarded to us immediately after despatch of the goods to destination so that the same could be transmitted to Bank for necessary action. Exchange Control Copy of the Bill of Entry (GD-1) for Consumption in original is also to be forwarded to us alongwith the T.R/Bilty";
                this.cc1="The Manager, "+this.bank+", "+this.branch+" - for information with reference to your letter dated: 10.08.2018";
                this.cc2="M/S. "+this.toLocation+" - for information.";

            }
            else if(this.forpurpose=="After Clearance")
            {
                alert('Clearing Agent & After Clearance is selected');

                this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.textofletter="";
                this.cc1="The Manager, "+this.bank+", "+this.branch+" - for information with reference to your letter dated: 10.08.2018";
                this.cc2="M/S. "+this.toLocation+" - for information.";

            }
            else if(this.forpurpose=="Delivery")
            {
                alert('Clearing Agent & After Delivery is selected');
                  this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.textofletter="";
                this.cc1="The Manager, "+this.bank+", "+this.branch+" - for information with reference to your letter dated: 10.08.2018";
                this.cc2="M/S. "+this.toLocation+" - for information.";

            }
            else if(this.forpurpose=="Completion")
            {
                alert('Clearing Agent & After Completion is selected');

                  this.subject="CLEARANCE UNDER OUR SUPERVISION & STORAGE AT "+this.toOption+" OF "+this.toAddress+" UNDER BANK'S LIEN OF "+this.bank+", "+this.bankAddress+" : "+this.containerCount+ "X"+this.containerNumber+" STC: "+this.packageCount+" "+this.packageNumber+" ("+this.weight+" M.TONS)  OF "+this.consignment+" IMPORTED UNDER L/C NO. "+this.lcno+" & ARRIVED PER "+this.vessel+" A/C M/S. "+this.toLocation+", .";
                this.textofletter="";
                this.cc1="The Manager, "+this.bank+", "+this.branch+" - for information with reference to your letter dated: 10.08.2018";
                this.cc2="M/S. "+this.toLocation+" - for information.";

            }
        }
    },
    getFromData(fromis)
    {
        // alert(fromis);
    },

     getReportData() {
                axios.get('/getLetterData/' + this.jobid)
                    .then(res => {
                        console.log(res.data);
                        res.data.job.forEach((obj) => {


                            // this.signer = {
                            //     text: obj.signed_by,
                            //     value: obj.signed_by
                            // };

                            this.typeofletter = obj.letter_type;
                            this.forpurpose = obj.for_purpose;
                            this.dateis = obj.date;
                            this.tois = obj.to_is_letter;
                            this.address = obj.address;
                            this.subject = obj.subject;
                            this.ref = obj.ref;
                            this.textofletter = obj.text_of_letter;
                            this.cc1 = obj.cc_one;
                            this.cc2 = obj.cc_two;
                            this.cc3 = obj.cc_three;
                            this.cc4 = obj.cc_four;
                            this.cc5 = obj.cc_five;
                            this.bank = obj.bank_name;
                            this.bankAddress = obj.bank_address;
                            this.bankDate = obj.bank_letter_date;
                            this.bankLetter = obj.bank_letter;
                            this.clearingAgent = obj.agent_name;
                            this.clearingAgentAddress = obj.agent_address;
                            this.toOption1 =obj.to_is;

                            if(obj.to_is=="Party Premises")
                            {
                                this.toOption ="PARTY WAREHOUSE";
                                this.toAddress =obj.to_party_address;
                                this.toLocation =obj.to_godown;
                            }
                            else if(obj.to_is=="Bonded Warehouse")
                            {
                                this.toOption ="Bonded WAREHOUSE";
                                this.toAddress =obj.to_bonded_address;
                                this.toLocation =obj.to_warehouse;
                            }
                            else if(obj.to_is=="3rd Party Godown")
                            {
                                this.toOption ="3rd Party WAREHOUSE";
                                this.toAddress =obj.to_three_address;
                                this.toLocation =obj.three_godown;
                            }

                            this.containerCount=obj.container_unit;
                            this.containerNumber=obj.container_number;
                            this.packageCount=obj.package_unit;
                            this.packageNumber=obj.package_name;
                            this.weight=obj.weight;
                            this.consignment=obj.consigment_name;
                            this.lcno=obj.lc_no;
                            this.vessel=obj.vessel_no;
                            this.branch=obj.branch_name;
                            this.blno=obj.bl_no;
                            this.bldate=obj.bl_date;

                            // containerCount:'',
                            // containerNumber:'',
                            // packageCount:'',
                            // packageNumber:'',
                            // weight:'',
                            // consignment:'',
                            // lcno:'',
                            // vessel:'',
                            // alert(obj.bank_name);
                        })

                    })

            },

    onComplete(){
         if (this.$v.form1.$invalid) {
                        this.$v.form1.$touch();
                        var isValid = !this.$v.form1.$invalid
                        this.$emit('on-validate', this.$data, isValid)
                        return isValid
                    } else {
                        this.postdata();
                    }
    },
    postdata(){

                  const jobData={
                      jobid:this.jobid,
                      letter_type:this.typeofletter,
                      for_purpose:this.forpurpose,
                      to_is:this.tois,
                      date:this.dateis,
                      address:this.address,
                      subject:this.subject,
                      ref:this.ref,
                      text_of_letter:this.textofletter,
                      cc_one:this.cc1,
                      cc_two:this.cc2,
                      cc_three:this.cc3,
                      cc_four:this.cc4,
                      cc_five:this.cc5,
                      signed_by:this.signer.text



                  };

                    const headers = {
                    'Authorization': 'Bearer ' + this.usertoken,
                    'Content-Type': 'application/json'
                };

                axios.put('/api/updateSupervisionLetterData/'+this.jobid, jobData, {
                        headers: headers
                    })
                    .then(res => {


                         alert('Data Submitted');

                         window.open(
                            "/printSupervisionLetter/"+this.jobid,
                            '_blank' // <- This is what makes it open in a new window.
                            );
                        // window.location.href = "/printSupervisionLetter/"+this.jobid    ;
                        return false;
                    })
                    .catch(error =>{

                        alert(error);
                    })
    }
},
validations:{
    signer:{
        required
    },
    form1: [
        'signer'
    ]
}

}
</script>
<style scoped>

</style>
