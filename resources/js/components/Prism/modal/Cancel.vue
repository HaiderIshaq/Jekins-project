<template>
    <div>
        <input type="button"   class="btn btn-primary btn-sm" value="Cancel" data-toggle="modal" data-target="#cancelModal">
        <div class="modal fade bd-example-modal-2" id="cancelModal"   tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cancelling the job .......</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" >

                            <form action="" >
                            <div class="row">


                            </div>
                            <label for="">Reason for Cancellation</label>
                                <textarea name="" id="" v-model="cancelRemarks"   class="form-control col-md-12"></textarea>


                        </form>

                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button v-show="saveButton" type="button" @click="cancelJob()" class="btn btn-primary" >Cancel Job</button>
                        <!-- <button  type="button" @click="cancelJob()" class="btn btn-primary" >Cancel Job</button> -->
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
            
            cancelRemarks:'',
            saveButton:true,
        }
    },
    mounted() {
        this.getData();
        
    },
    methods:{
    cancelJob: function(){

            axios.put('/cancelVerificationprism/' + this.id ,{
               remarks:this.cancelRemarks,
               jobid:this.jobid,
               commonId:this.common

           })
            .then(res=>{
                
                alert('Job Was successfully cancelled');
                this.getData();
               $('#cancelModal').modal('hide');

                this.$emit('cancelJob');





            })
            .catch(error=>{
            });


   },
        getData: function(){

            axios.get('/getCancelVerificationprism/' + this.id)
            .then(res=>{

                res.data.forEach((obj)=>{
                this.cancelRemarks=obj.cancelled_remarks;
                // this.isHold=obj.hold===1 ? true:false;
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