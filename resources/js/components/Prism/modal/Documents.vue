<template>
    <div style="padding:15px 10px;">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active"  style="font-size:13px" v-if="this.type=='Pre-Insurance'" id="nav-home-tab" data-toggle="tab" data-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Accessories</button>
                <button class="nav-link active" style="font-size:13px" v-if="this.type=='Partial Loss'" id="nav-profile-tab" data-toggle="tab" data-target="#nav-repaired" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">To be Repaired</button>
                <button class="nav-link" id="nav-profile-tab" v-if="this.type=='Partial Loss'" style="font-size:13px" data-toggle="tab" data-target="#nav-replaced" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">To be Replaced</button>
                <button class="nav-link" id="nav-profile-tab" v-if="this.type=='Partial Loss'" style="font-size:13px" data-toggle="tab" data-target="#nav-dismantle" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Subject To Dismantle</button>
                <button class="nav-link" id="nav-profile-tab" style="font-size:13px" data-toggle="tab" data-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Images</button>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" v-if="this.type=='Pre-Insurance'"  style="font-size:14px" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                <accessories :id="this.id"></accessories>

            </div>
            <div class="tab-pane fade show active" v-if="this.type=='Partial Loss'" style="font-size:14px"  id="nav-repaired" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                <repaired :id="this.id"></repaired>

            </div>
            <div class="tab-pane fade show " style="font-size:14px" id="nav-replaced" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                <replaced :id="this.id"></replaced>

            </div>
            <div class="tab-pane fade show " style="font-size:14px" id="nav-dismantle" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">

                <dismantle :id="this.id"></dismantle>

            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" style="font-size:14px" aria-labelledby="nav-profile-tab" tabindex="0">
                
                <images :id="this.id"></images>
                
                </div>
        
        </div>
    </div>
</template>
<style>


</style>
<script>
    import Accessories from "./Accessories.vue";
    import Dismantle from "./Dismantle.vue";
    import Replaced from "./Replaced.vue";
    import Repaired from "./Repaired.vue";
    import Images from "./Images.vue";

export default{
    props:{
        id:String,
        type:String
    },
    components:{
        'accessories':Accessories,
        'dismantle':Dismantle,
        'replaced':Replaced,
        'repaired':Repaired,
        'images':Images
    },
    data(){
        return{
            pre:this.type=='Pre-Insurance',
            partial:this.type=='Partial Loss'
        }
    }
}
</script>