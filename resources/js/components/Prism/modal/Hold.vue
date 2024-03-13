<template>
    <div>
        <input type="button"    class="btn btn-primary btn-sm" value="Hold / Delayed" data-toggle="modal" data-target="#HoldModal">
        <div class="modal fade bd-example-modal-2" id="HoldModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Holding / Delaying the job .......</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >

                            <form action="" >
                            <div class="row">

                                <div class="col-md-3">
                                    <div class="form-check" style="margin-top: 4px;">
                                    <input type="checkbox" class="form-check-input"   v-model="isHold" >
                                    <label for="form-check-label"  style="margin-right:13px;" > Hold / Delayed</label>
                                    </div>
                                </div>
                            </div>
                            <label for="">Reason for Hold / Delaying</label>
                                <textarea name="" id="" v-model="HoldRemarks"   class="form-control col-md-12"></textarea>


                        </form>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" v-show="saveButton"  @click="holdJob()" class="btn btn-primary" >Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   import axios from "axios"; 

export default {
    props:{
         id:String,
          jobid:String,
          common:String
    },
    data(){
        return{
            isHold:false,
            HoldRemarks:'',
            saveButton:true,
       
       }
    },
    mounted() {
        this.getData();
    },
    methods:{
        holdJob: function(){


            axios.put('/holdVerificationprism/' + this.id ,{
               remarks:this.HoldRemarks,
               is_hold:this.isHold,
               jobid:this.jobid,
               commonId:this.common

           })
            .then(res=>{
                alert('Job status is changed to delayed');
                // this.getInspectionJob();

            this.getData();
                $('#HoldModal').modal('hide');

                this.$emit('holdJob');


            })
            .catch(error=>{
            });


     },
            getData: function(){

            axios.get('/getHoldVerificationprism/' + this.id)
            .then(res=>{

                res.data.forEach((obj)=>{
                this.HoldRemarks=obj.hold_remarks;
                this.isHold=obj.hold===1 ? true:false;
                if(obj.cancelled==1)
                {
                    this.saveButton=false;
                }
                

                });



            })
            .catch(error=>{
            });


     }
    }
    
}
</script>

<style>

</style>