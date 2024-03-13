<template>
    <div  class="modal fade bd-example-modal-2"  tabindex="-1" role="dialog" id="listingModal" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" style="max-width: 85% !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List of Bills </h5>
                    <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <div class="container-fluid"  >

                        <h5>{{columnis}}</h5>


                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
// import ValuationVehicleImages from '../ValuationVehicleImages';
// import SMBL from './Bank/SMBL';
// import ASKBL from './Bank/ASKBL';


export default {
    props:{
        columnis:String
        // id:String,
        // bank:String
    },
    components:{
        // 'valuation-vehicle-images':ValuationVehicleImages,
        // 'smbl':SMBL,
        // 'askbl':ASKBL
    },


}
</script>

<style  scoped>

</style>
