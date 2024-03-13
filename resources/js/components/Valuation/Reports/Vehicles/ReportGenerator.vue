<template>
    <div  class="modal fade bd-example-modal-2"  tabindex="-1" role="dialog" id="reportModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 85% !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Vehicle Report </h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="container-fluid"  >


                        <div id="accordion" style="padding:10px 15px 10px 15px">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab1" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="nav-home" aria-selected="true">Report Details</a>
                                <a class="nav-item nav-link"  id="nav-profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="nav-profile" aria-selected="false">Images</a>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" style="padding-top:20px" id="home1" role="tabpanel" aria-labelledby="nav-home-tab">



                                    <template
                                    v-if="bank=='Askari Bank Limited'"
                                    >

                                    <askbl
                                    :bank="bank"
                                    :token="token"
                                    :id="id"></askbl>

                                    </template>

                                    <template
                                    v-if="bank!='Askari Bank Limited'"

                                    >

                                            <smbl
                                    :bank="bank"
                                    :token="token"
                                    :id="id"></smbl>

                                    </template>









                                </div>
                                <div class="tab-pane fade" id="profile1" style="padding-top:20px" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <valuation-vehicle-images  :id="id"></valuation-vehicle-images>
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
import ValuationVehicleImages from '../ValuationVehicleImages';
import SMBL from './Bank/SMBL';
import ASKBL from './Bank/ASKBL';


export default {
    props:{
        token:String,
        id:String,
        bank:String
    },
    components:{
        'valuation-vehicle-images':ValuationVehicleImages,
        'smbl':SMBL,
        'askbl':ASKBL
    },


}
</script>

<style  scoped>

</style>
