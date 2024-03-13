<template>
        <div>

            <!-- Report Modal | Vehicle's Details -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" value="Vehicle's Details">
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Surveyor:
                                                    </div>
                                                    <div class="col-md-7">
                                                        <Select v-model="surveyor" :options="surveyors" label="text"></Select>
                                                    </div>
                                                    <div class="col-md-3">
                                                            <div class="form-check mt-2 ml-4">
                                                                <input type="checkbox" class="form-check-input" v-model="isPrintSurveyor" >
                                                                <label for="form-check-label"> Print Surveyor?</label>
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Inspected On:
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" v-model="inspectedOnDate" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="time" v-model="inspectedOnTime" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check mt-2 ml-4">
                                                            <input type="checkbox"  v-model="isPrintTime" class="form-check-input"  >
                                                            <label for="form-check-label"> Print Time?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mt-2 check-label" style="max-width: 10%;">
                                                        Print Date:
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" v-model="printDate" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Inspected At:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="inspectedAt" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Title of Ownership:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="titleOfOwnership" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Make:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" v-model="modelCarMake" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Model:
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input type="text" v-model="modelCarModal" class="form-control">
                                                    </div>
                                                    <div class="col-md-3">
                                                    Manufacturing Year:
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="text" v-model="modelManufactringYear" class="form-control">
                                                    </div>


                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Color:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelCarColor">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Registration No:
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="form-control" v-model="modelCarRegistration">
                                                    </div>
                                                    <div class="col-md-1">
                                                        Date :
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input type="date" v-model="modelRegistrationDate" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row" v-show="bank !='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                    First Registration:
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" class="form-control" v-model="modelFirstRegistration">
                                                    </div>
                                                    <div class="col-md-8">
                                                    <input type="text" class="form-control" v-model="modelFirstRegistrationDate">
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group row">
                                                    <div class="col-md-2">

                                                            Air Conditioner:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check "  style="margin-left: 19px !important;">
                                                            <input type="checkbox" class="form-check-input"   v-model="modalAirConditionerAvailibility" >
                                                            <label  style="font-size:14px">Available?</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2"  v-if="modalAirConditionerAvailibility">
                                                        <div class="form-check " >
                                                            <input type="radio" v-model="isAirConditionWorking" value="Working" class="custom-radio"  >
                                                            <label for="form-input-radio"  style="font-size:14px">Working</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2"  v-if="modalAirConditionerAvailibility">
                                                        <div class="form-check ">
                                                            <input type="radio"  class="custom-radio" v-model="isAirConditionWorking" value="Not Working">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Working</label>
                                                        </div>
                                                    </div>


                                                </div> -->

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Engine No:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" v-model="modelEngineNo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row" v-show="bank=='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                        Genre:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" v-model="modelGenre" class="form-control">
                                                    </div>
                                                </div>
                                                 <div class="form-group row" v-show="bank=='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                      Body Type:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <Select v-model="bodyType" :options="bodyTypes" label="text"></Select>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Engine Capacity:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelEngineCapacity">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Chassis No:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelChassisNo">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Odometer Reading(KM):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelOdometerNo">
                                                    </div>
                                                </div>

                                                <div class="form-group row" v-show="bank!='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                        Grade:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelGrade">
                                                    </div>
                                                </div>
                                                <div class="form-group row" v-show="bank !='Askari Bank Limited'">
                                                    <div class="col-md-2">

                                                        Acquired:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="new"  value="New" v-model="acquired" >
                                                            <label for="form-input-radio" style="font-size:14px">New</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="used" value="Used" v-model="acquired" >
                                                            <label for="form-input-radio" style="font-size:14px">Used</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="none" value="None" v-model="acquired"  >
                                                            <label for="form-input-radio"  style="font-size:14px">None</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="custom-radio" v-model="isReconditioned"  >
                                                            <label for="form-check-input"  style="font-size:14px">Reconditioned?</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="custom-radio" v-model="isRopssessed"  >
                                                            <label for="form-check-input" style="font-size:14px">Repossessed?</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="form-group row" >
                                                    <div class="col-md-2">

                                                        Documents Seen:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="new"  value="Original" v-model="isDocument" >
                                                            <label for="form-input-radio" style="font-size:14px">Original</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="used" value="Copy" v-model="isDocument" >
                                                            <label for="form-input-radio" style="font-size:14px">Copy</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="none" value="None" v-model="isDocument"  >
                                                            <label for="form-input-radio"  style="font-size:14px">None</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="custom-radio" v-model="isPushStart"  >
                                                            <label for="form-check-input"  style="font-size:14px">Push Start?</label>

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="custom-radio" v-model="isKeyStart"  >
                                                            <label for="form-check-input" style="font-size:14px">Key Start?</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="form-group row" >
                                                    <div class="col-md-2">

                                                        Manufactured:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="locallyManufactured" value="Locally Manufactured" v-model="modelManufactured" >
                                                            <label for="form-input-radio"   style="font-size:14px">Locally Manufactured</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="foreignAssembled" value="Foreign Assembled" v-model="modelManufactured" >
                                                            <label for="form-input-radio"  style="font-size:14px">Foreign Assembled</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">

                                                        Transmission:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" value="Automatic" id="automatic" v-model="modelTransmission"  >
                                                            <label for="form-input-radio"   style="font-size:14px">Automatic</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" value="Manual" id="manual" v-model="modelTransmission"  >
                                                            <label for="form-input-radio" style="font-size:14px">Manual</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">

                                                        {{bank == 'Askari Bank Limited' ? 'Feul' :'Engine'}} Type:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" v-model="modelEngineType" value="Petrol" id="petrol">
                                                            <label for="form-input-radio" style="font-size:14px">Petrol</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  v-model="modelEngineType" value="Diesel" id="diesel">
                                                            <label for="form-input-radio"  style="font-size:14px">Diesel</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  v-model="modelEngineType" value="Diesel" id="diesel">
                                                            <label for="form-input-radio"  style="font-size:14px">Electric</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="custom-radio" v-model="isHybrid" >
                                                            <label for="form-input-radio"  style="font-size:14px">Hybrid?</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">

                                                        CNG Kit:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="companyFitted" v-model="modelCngKit" value="Company Fitted" >
                                                            <label for="form-input-radio" value="Fixed Perfectly"  style="font-size:14px">Company Fitted</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="selfInstalled" v-model="modelCngKit" value="Self Installed" >
                                                            <label for="form-input-radio" style="font-size:14px">Self Installed</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="na" v-model="modelCngKit" value="N/A">
                                                            <label for="form-input-radio" style="font-size:14px">N/A</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">

                                                        Drive:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"   id="rightHand" v-model="modelDrive" value="Right Hand">
                                                            <label for="form-input-radio" style="font-size:14px">Right Hand</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="leftHand" v-model="modelDrive" value="Left Hand">
                                                            <label for="form-input-radio" value="Somewhat loose" style="font-size:14px">Left Hand</label>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Report Modal |Physical  Condition | Askari Bank Limited -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseOne" value="Physical (Body) Conditions of Vehicle">
                                            </h5>
                                        </div>

                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding:20px 50px 10px 50px">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Right Side:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="max-width:11.666667%">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelRightSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Scratched" v-model="modelRightSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Dented" v-model="modelRightSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Original Paint" v-model="modelRightSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Original Paint</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Re-Painted" v-model="modelRightSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Re-Painted</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Left Side:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="max-width:11.666667%">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelLeftSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Scratched" v-model="modelLeftSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Dented" v-model="modelLeftSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Original Paint" v-model="modelLeftSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Original Paint</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Re-Painted" v-model="modelLeftSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Re-Painted</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Front Side & Bonnet:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="max-width:11.666667%">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelFrontSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Scratched" v-model="modelFrontSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Dented" v-model="modelFrontSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Original Paint" v-model="modelFrontSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Original Paint</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Re-Painted" v-model="modelFrontSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Re-Painted</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Rear Side & Trunk:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" style="max-width:11.666667%">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelRearSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Scratched" v-model="modelRearSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Dented" v-model="modelRearSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Original Paint" v-model="modelRearSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Original Paint</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Re-Painted" v-model="modelRearSide">
                                                            <label for="form-input-radio"  style="font-size:14px">Re-Painted</label>
                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Front Show Grill:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="In Good Condition" v-model="modelShowGrill">
                                                            <label for="form-input-radio"  style="font-size:14px">In Good Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Scratched" v-model="modelShowGrill">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Broken / Dented" v-model="modelShowGrill">
                                                            <label for="form-input-radio"  style="font-size:14px">Broken / Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Available" v-model="modelShowGrill">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Front Lower Shield:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="In Good Condition" v-model="modelFrontLowerShield">
                                                            <label for="form-input-radio"  style="font-size:14px">In Good Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Scratched" v-model="modelFrontLowerShield">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Broken / Dented" v-model="modelFrontLowerShield">
                                                            <label for="form-input-radio"  style="font-size:14px">Broken / Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Available" v-model="modelFrontLowerShield">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Front/Back Bumper:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="In Good Condition" v-model="modelFrontBackBumper">
                                                            <label for="form-input-radio"  style="font-size:14px">In Good Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Scratched" v-model="modelFrontBackBumper">
                                                            <label for="form-input-radio"  style="font-size:14px">Scratched</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Broken / Dented" v-model="modelFrontBackBumper">
                                                            <label for="form-input-radio"  style="font-size:14px">Broken / Dented</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Available" v-model="modelFrontBackBumper">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Wheel Caps:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Available" v-model="modelWheelCaps">
                                                            <label for="form-input-radio"  style="font-size:14px">Available</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Not Available" v-model="modelWheelCaps">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Missing" v-model="modelWheelCaps">
                                                            <label for="form-input-radio"  style="font-size:14px">Missing</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Alloy Rims" v-model="modelWheelCaps">
                                                            <label for="form-input-radio"  style="font-size:14px">Alloy Rims</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Monograms:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Available" v-model="modelMonograms">
                                                            <label for="form-input-radio"  style="font-size:14px">Available</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Not Available" v-model="modelMonograms">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Missing" v-model="modelMonograms">
                                                            <label for="form-input-radio"  style="font-size:14px">Missing</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Original Number Plates:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Available" v-model="modelNumberPlates">
                                                            <label for="form-input-radio"  style="font-size:14px">Available</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Not Available" v-model="modelNumberPlates">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Un-Registered" v-model="modelNumberPlates">
                                                            <label for="form-input-radio"  style="font-size:14px">Un-Registered</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Issued" v-model="modelNumberPlates">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Issued</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Suspensions / Shock Absorbers:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelShockAbsorbers">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Need Repair" v-model="modelShockAbsorbers">
                                                            <label for="form-input-radio"  style="font-size:14px">Need Repair</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs to be changed" v-model="modelShockAbsorbers">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs to be changed</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Assemblies / Mats / Upholsters:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fixed Perfectly" v-model="modelAssemblies">
                                                            <label for="form-input-radio"  style="font-size:14px">Fixed Perfectly</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Somewhat Loose" v-model="modelAssemblies">
                                                            <label for="form-input-radio"  style="font-size:14px">Somewhat loose</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Need Replacement" v-model="modelAssemblies">
                                                            <label for="form-input-radio"  style="font-size:14px">Need Replacement</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                        Tires:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good Working Condition" v-model="modelTires">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Working Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelTires">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Need Replacement" v-model="modelTires">
                                                            <label for="form-input-radio"  style="font-size:14px">Need Replacement</label>
                                                        </div>
                                                    </div>



                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Other Accessories:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" id="good" value="Spare Tire" v-model="modalSpareTire">
                                                            <label for="form-check-label"  style="font-size:14px">Spare Tire</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input"  id="average" value="Car Toolkit" v-model="modalCarToolkit">
                                                            <label for="form-check-label"  style="font-size:14px">Car Toolkit</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input"  id="poor" value="Tickli" v-model="modalTickli">
                                                            <label for="form-check-label"  style="font-size:14px">Tickli</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                        Seating Capacity Along with Driver:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="text" class="form-control" id="good" v-model="modelSeatingCapacity" >
                                                            </div>
                                                    </div>



                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                     <!-- Report Modal |External Condition | Askari Bank Limited -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseOne" value="Electro-Mechanical Conditions of Vehicle">
                                            </h5>
                                        </div>

                                        <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding:20px 50px 10px 50px">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Ignition Takes:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Half Self" v-model="modalIgnitionTakes">
                                                            <label for="form-input-radio"  style="font-size:14px">Half Self</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="One/Two or More" v-model="modalIgnitionTakes">
                                                            <label for="form-input-radio"  style="font-size:14px">One/Two or More</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Working" v-model="modalIgnitionTakes">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Working</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Battery Starts:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Half Self" v-model="modalBatteryStarts">
                                                            <label for="form-input-radio"  style="font-size:14px">Half Self</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="One/Two or More" v-model="modalBatteryStarts">
                                                            <label for="form-input-radio"  style="font-size:14px">One/Two or More</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Working" v-model="modalBatteryStarts">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Working</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Engine:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Original" v-model="modalEngine">
                                                            <label for="form-input-radio"  style="font-size:14px">Original</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Replaced" v-model="modalEngine">
                                                            <label for="form-input-radio"  style="font-size:14px">Replaced</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Overhauled" v-model="modalEngine">
                                                            <label for="form-input-radio"  style="font-size:14px">Overhauled</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Working" v-model="modalEngine">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Working</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Chassis:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good Condition" v-model="modalChassis">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Repaired" v-model="modalChassis">
                                                            <label for="form-input-radio"  style="font-size:14px">Repaired</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Accidental" v-model="modalChassis">
                                                            <label for="form-input-radio"  style="font-size:14px">Accidental</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalChassis">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Radiator:
                                                        </div>
                                                    </div>
                                                  <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good Condition" v-model="modalRadiator">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Repaired" v-model="modalRadiator">
                                                            <label for="form-input-radio"  style="font-size:14px">Repaired</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Accidental" v-model="modalRadiator">
                                                            <label for="form-input-radio"  style="font-size:14px">Accidental</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalRadiator">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>


                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Right Head Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalRightHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalRightHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalRightHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalRightHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Left Head Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalLeftHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalLeftHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalLeftHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"   value="Damaged/Broken" v-model="modalLeftHeadLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Right Tail Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalRightTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalRightTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalRightTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalRightTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Left Tail Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalLeftTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalLeftTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalLeftTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalLeftTailLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Right Indicator Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalRightIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalRightIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalRightIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalRightIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Left Indicator Light:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalLeftIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalLeftIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalLeftIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalLeftIndicatorLight">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Inner Lights:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Fully Working" v-model="modalInnerLights">
                                                            <label for="form-input-radio"  style="font-size:14px">Fully Working</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Partially Fused" v-model="modalInnerLights">
                                                            <label for="form-input-radio"  style="font-size:14px">Partially Fused</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="All Fused" v-model="modalInnerLights">
                                                            <label for="form-input-radio"  style="font-size:14px">All Fused</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Damaged/Broken" v-model="modalExDoors">
                                                            <label for="form-input-radio"  style="font-size:14px">Damaged/Broken</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Steering Control:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Good Condition" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Axle:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Good Condition" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Clutch:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Good Condition" v-model="modalClutch">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="modalClutch">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalClutch">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Not Available" v-model="modalClutch">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Brakes:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Good Condition" v-model="modalBrakes">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="modalBrakes">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalBrakes">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Suspension:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Good Condition" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Good Condition</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Air Conditioner:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input"  id="average"  v-model="modalAirConditionerAvailibility">
                                                            <label for="form-check-label"  style="font-size:14px">Available? </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2" >
                                                        <div class="form-check" v-show="modalAirConditionerAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="isAirConditionWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2" >
                                                        <div class="form-check " v-show="modalAirConditionerAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="isAirConditionWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Heater:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input"   v-model="modalHeaterAvailibility">
                                                            <label for="form-check-label"  style="font-size:14px">Available? </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalHeaterAvailibility==true" >
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="isHeaterWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalHeaterAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="isHeaterWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                   <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Bluetooth CD Player:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input"   v-model="modalCDPlayerAvailibility">
                                                            <label for="form-check-label"  style="font-size:14px">Available? </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalCDPlayerAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="isCDPlayerWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalCDPlayerAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="isCDPlayerWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Cameras/Sensors:
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check " >
                                                            <input type="checkbox" class="form-check-input"    v-model="modalCamerasAvailibility">
                                                            <label for="form-check-label"  style="font-size:14px">Available? </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalCamerasAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Repair" v-model="isCamerasWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Repair</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check " v-show="modalCamerasAvailibility==true">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Needs Replacement" v-model="isCamerasWorking">
                                                            <label for="form-input-radio"  style="font-size:14px">Needs Replacement</label>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">

                                            <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseOne" value="Others">
                                        </h5>
                                        </div>

                                        <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    1):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="other1" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    2):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="other2" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    3):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="other3" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    4):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="other4" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    5):
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="other5" style="height:80px" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">

                                            <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseOne" value="Valuation Trends">
                                        </h5>
                                        </div>

                                        <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Report Modal | Valuation Details -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">


                                            <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseOne" value="Valuation Details">
                                        </h5>
                                        </div>

                                        <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <fieldset>

                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">Total Assessed Value: </label>
                                                        <div class="col-md-8 pl-0 pr-0" >
                                                            <input class="form-control form-control-sm" v-model="totalAssesdValue"   type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6 pl-0 pr-0" >
                                                            <input class="form-control form-control-sm" v-model="fsvRate"   type="text">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox"  v-model="isPercentage" class="form-check-input ml-3 mt-2"   >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6 pl-0 pr-0" >
                                                            <input class="form-control form-control-sm" v-model="calaculatedFSV" type="text">
                                                        </div>
                                                        <!-- <div class="col-md-2"  >
                                                            <div class="form-check " style="margin-left: 19px !important;" >
                                                                <input type="checkbox" v-model="hideFSV" class="form-check-input">
                                                                <label  >Hide FSV?</label>
                                                            </div>
                                                        </div> -->
                                                    </div>

                                                </fieldset>
                                                <div class="form-group row">
                                                    <div class="col-md-3">
                                                            <div class="form-check mt-2 ml-4">
                                                                <input type="checkbox" class="form-check-input" v-model="isValSecond" >
                                                                <label for="form-check-label"> Valuation Details (Second)</label>
                                                            </div>
                                                    </div>
                                                </div>

                                                <fieldset v-show="isValSecond==true">


                                                <div class="form-group row">


                                                    <div class="col-md-8">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Documents / With Duplicate Documents"  v-model="modelDocumentDetails">
                                                            <label for="form-input-radio" style="font-size:14px">With Original Documents / With Duplicate Documents</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 ">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"   value="With Original Documents / Without Duplicate Documents"  v-model="modelDocumentDetails">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Documents / Without Original Documents</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 ">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Registration Book / Without Original Registration Book"  v-model="modelDocumentDetails">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Registration Book / Without Original Registration Book</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 ">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Registration Book / With Duplicate Registration Book"  v-model="modelDocumentDetails">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Registration Book / With Duplicate Registration Book</label>
                                                        </div>
                                                    </div>

                                                </div>

                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">Total Assessed Value: </label>
                                                        <div class="col-md-8" >
                                                            <input class="form-control form-control-sm" v-model="totalAssesdValueSecond"  type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6" >
                                                            <input class="form-control form-control-sm"  v-model="fsvRateSecond"  type="text">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox"  class="form-check-input ml-3 mt-2"   v-model="isPercentageSecond" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6 " >
                                                            <input class="form-control form-control-sm"  type="text" v-model="calaculatedFSVSecond">
                                                        </div>

                                                    </div>
                                                </fieldset>










                                            </div>
                                        </div>
                                    </div>
                                    <!-- Report Modal | Valuation Details (Second) -->
                                    <!-- <div class="card">
                                        <div class="card-header" id="headingOne">
                                        <h5 class="mb-0">

                                            <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseOne" value="Valuation Details (Second)">
                                        </h5>
                                        </div>

                                        <div id="collapseSeven" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">

                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="row" style="text-align: right;padding-right: 20px;">
                                        <div class="col-md-12">
                                            <input type="button" value="Save" class="btn btn-primary" @click="saveReportInfo()">
                                            <input type="button" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-primary ">
                                            <a :href="`/valuationReportBAH/`+this.id" target="_blank"><input type="button" value="Print Report" class="btn btn-primary "></a>
                                        </div>
                                    </div>

        </div>
</template>

<style scoped>
.card{
    margin-bottom: 15px !important;
}
</style>
<script>
import { required, minLength, between,email } from 'vuelidate/lib/validators'
import axios from 'axios'
import vSelect from 'vue-select'
import Autocomplete from '@trevoreyre/autocomplete-vue'
import '@trevoreyre/autocomplete-vue/dist/style.css'
import 'vue-select/dist/vue-select.css'

export default {
    props:{
        bank:String,
        token:String,
        id:String,
    },
    components:{
          'Select':vSelect,

    },
     data(){
        return{
        airCondition:'',
        surveyors:[],
        surveyor:'',
        inspectedOnDate:'',
        inspectedOnTime:'',
        isPrintTime:'',
        printDate:'',
        inspectedAt:'',
        titleOfOwnership:'',
        modelCarMake:'',
        modelCarModal:'',
        modelManufactringYear:'',
        modelCarColor:'',
        modelCarRegistration:'',
        modelRegistrationDate:'',
        modelFirstRegistration:'',
        modelFirstRegistrationDate:'',
        modelEngineNo:'',
        modelEngineCapacity:'',
        modelChassisNo:'',
        modelOdometerNo:'',
        modelGrade:'',
        isDocument:'',
        isPushStart:false,
        isKeyStart:false,
        acquired:'',
        isReconditioned:false,
        isRopssessed:false,
        modelManufactured:'',
        modelTransmission:'',
        modelEngineType:'',
        isHybrid:false,
        modelCngKit:'',
        modelDrive:'',
        isPrintSurveyor:'',
        modelRightSide:'',
        modelLeftSide:'',
        modelFrontSide:'',
        modelRearSide:'',
        modelShowGrill:'',
        modelFrontLowerShield:'',
        modelFrontBackBumper:'',
        modelWheelCaps:'',
        modelMonograms:'',
        modelNumberPlates:'',
        modelShockAbsorbers:'',
        modelAssemblies:'',
        modelTires:'',
        modalSpareTire:false,
        modalTickli:false,
        modalCarToolkit:false,
        modalCapacity:'',
        modalIgnitionTakes:'',
        modalBatteryStarts:'',
        modalEngine:'',
        modalChassis:'',
        modalRadiator:'',
        modalRightHeadLight:'',
        modalLeftHeadLight:'',
        modalRightHeadLight:'',
        modalLefttHeadLight:'',
        modalRightIndicatorLight:'',
        modalLeftIndicatorLight:'',
        modalRightTailLight:'',
        modalLeftTailLight:'',
        modalInnerLights:'',
        modalSteeringControl:'',
        modelAxle:'',
        modalClutch:'',
        modalBrakes:'',
        modalSuspension:'',
        modalAirConditionerAvailibility:false,
        isAirConditionWorking:'',
        modalHeaterAvailibility:false,
        isHeaterWorking:'',
        modalCDPlayerAvailibility:false,
        isCDPlayerWorking:'',
        modalCamerasAvailibility:false,
        isCamerasWorking:'',
        other1:'',
        other2:'',
        other3:'',
        other4:'',
        other5:'',
        modelSeatingCapacity:'',
        modelSelect:'',
        hideFSV:false,
        imagesComponent:true,
        representativeCNIC:'',
        vehicleClasses:[],
        vehicleClass:"",
        bodyTypes:[],
        bodyType:'',
        rims:[],
        rim:'',
        modelGenre:'',
        modelAccessories:false,
        modelBodyCondition:'',
        modelEngineCondition:'',
        modalTransmission:'',
        modalTransmissionSystem:'',
        modalElectricSystem:'',
        modalTyres:'',
        modalAnyLeaks:'',
        modalMajorDefects:'',
        modalChassisRepaired:'',
        modelExBody:'',
        modalExBonnet:'',
        modalExDoors:'',
        modalEx:'',
        modelDashboard:'',
        modalRoof:'',
        modalSeats:'',
        modalNegativeRemarks:'',
        modelOverallCondition:'',
        modelOriginalRegBook:'',
        modelCNICOwner:'',
        modelETO:'',
        isHypothecated:false,
        isDuplicatedRegBook:false,
        isVehicleTransferred:false,
        isVehicleStolen:false,
        totalAssesdValue:'',
        fsvRate:'',
        isPercentage:false,
        calaculatedFSV:'',
        modelDocumentDetails:'',
        isValSecond:false,
        totalAssesdValueSecond:'',
        fsvRateSecond:'',
        isPercentageSecond:false,
        calaculatedFSVSecond:'',
                }
    },
    methods:{
        getEmployeesById(){


            this.surveyors=[];


            axios.get("/api/getEmployeesById/" + 1,{
                      headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.surveyors.push(
                            {
                                text:obj.name,
                                value:obj.id

                                }
                            );

                    })
                })
                .catch(error => {

                console.log(error);


                });

        },
          getClasses(){


            this.vehicleClasses=[];


            axios.get("/api/getClasses" ,{
                      headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.vehicleClasses.push(
                            {
                                text:obj.name,
                                value:obj.id

                                }
                            );

                    })
                })
                .catch(error => {

                console.log(error);


                });

        },
         getRims(){


            this.rims=[];


            axios.get("/api/getRimTypes" ,{
                      headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.rims.push(
                            {
                                text:obj.name,
                                value:obj.id

                                }
                            );

                    })
                })
                .catch(error => {

                console.log(error);


                });

        },
         getBodyTypes(){


            this.bodyTypes=[];


            axios.get("/api/getBodyTypes" ,{
                      headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        let text='';
                        let value='';
                        this.bodyTypes.push(
                            {
                                text:obj.type,
                                value:obj.id

                                }
                            );

                    })
                })
                .catch(error => {

                console.log(error);


                });

        },
         getReportDetails(){


            this.bodyTypes=[];


            axios.get("/api/getReportDetails/"+this.id ,{
                      headers: {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'Accept': 'application/json'
                    }
                    })
                .then(res => {


                res.data.forEach((obj)=>{
                        this.surveyor={text:obj.surveyor_name,value:obj.surveyor};
                        this.isPrintSurveyor=obj.print_surveyor==1 ?true:false;
                        this.inspectedOnDate=obj.inspected_on;
                        this.inspectedOnTime=obj.inspected_on_time;
                        this.isPrintTime=obj.is_print_time==1 ?true:false;
                        this.printDate=obj.print_date;
                        this.inspectedAt=obj.inspected_at;
                        // this.representativeCNIC=obj.representative_cnic;
                        this.titleOfOwnership=obj.title_of_ownership;
                        this.modelCarMake=obj.make;
                        this.modelCarModal=obj.car_model;
                        this.modelManufactringYear=obj.	manufacturing_year;
                        // this.vehicleClass={text:obj.vehicle_class_name,value:obj.class};
                        this.modelCarColor=obj.color;
                        this.modelFirstRegistrationDate=obj.first_reg_date;
                        this.modelFirstRegistration=obj.first_reg_no;
                        this.modelCarRegistration=obj.reg_no;
                        this.modelRegistrationDate=obj.reg_date;
                        this.modelEngineNo=obj.engine_no;
                        this.modelEngineCapacity=obj.engine_capacity;
                        this.modelChassisNo=obj.chassis_no;
                        this.modelOdometerNo=obj.odometer_reading;
                        this.modelGrade=obj.grade;
                        this.acquired=obj.acquired;
                        this.isReconditioned=obj.acq_is_reconditioned==1 ?true:false;
                        this.isRopssessed=obj.acq_is_repossesed==1 ?true:false;
                        this.isDocument=obj.document_seen;
                        this.isPushStart=obj.document_seen_is_push_start==1 ?true:false;
                        this.isKeyStart=obj.document_seen_is_key_start==1 ?true:false;
                        this.modelManufactured=obj.manufactured;
                        this.modelTransmission=obj.transmission;
                        this.modelEngineType=obj.feul_type;
                        this.isHybrid=obj.is_hybrid==1 ? true : false;
                        this.modelCngKit=obj.cng_kit;
                        this.modelDrive=obj.drive_is;
                        this.modelRightSide=obj.right_side;
                        this.modelLeftSide=obj.left_side;
                        this.modelFrontSide=obj.front_side_bonnet;
                        this.modelRearSide=obj.rear_side_trunk;
                        this.modelShowGrill=obj.front_show_grill;
                        this.modelFrontLowerShield=obj.front_lower_shield;
                        this.modelFrontBackBumper=obj.front_back_bumper;
                        this.modelWheelCaps=obj.wheel_caps;
                        this.modelMonograms=obj.monograms;
                        this.modelNumberPlates=obj.original_num_plates;
                        this.modelShockAbsorbers=obj.shock_absorbers;
                        this.modelAssemblies=obj.assemblies;
                        this.modelTires=obj.tires;
                        this.modalSpareTire=obj.spare_tire==1 ? true : false;
                        this.modalCarToolkit=obj.car_toolkit==1 ? true : false;
                        this.modalTickli=obj.tickli==1 ? true : false;
                        this.modelSeatingCapacity=obj.seating_capacity;
                        this.modalIgnitionTakes=obj.ignition_takes;
                        this.modalBatteryStarts=obj.battery_starts;
                        this.modalEngine=obj.engine_is;
                        this.modalChassis=obj.chassis_is;
                        this.modalRadiator=obj.radiator;
                        this.modalRightHeadLight=obj.right_head_light;
                        this.modalLeftHeadLight=obj.left_head_light;
                        this.modalRightTailLight=obj.right_tail_light;
                        this.modalLeftTailLight=obj.left_tail_light;
                        this.modalRightIndicatorLight=obj.right_indicator_light;
                        this.modalLeftIndicatorLight=obj.left_indicator_light;
                        this.modalInnerLights=obj.inner_lights;
                        this.modalSteeringControl=obj.steering_control;
                        this.modelAxle=obj.axle;
                        this.modalClutch=obj.clutch;
                        this.modalBrakes=obj.brakes;
                        this.modalSuspension=obj.suspension;
                       this.modalAirConditionerAvailibility=obj.air_conditionar_avalibility==1 ?true:false;
                       this.isAirConditionWorking=obj.is_air_conditionar;
                       this.modalHeaterAvailibility=obj.heater_avalibility==1 ?true:false;
                       this.isHeaterWorking=obj.is_heater;
                       this.modalCDPlayerAvailibility=obj.bluetooth_avalibility==1 ?true:false;
                       this.isCDPlayerWorking=obj.is_bluetooth;
                       this.modalCamerasAvailibility=obj.cameras_avalibility==1 ?true:false;
                       this.isCamerasWorking=obj.is_cameras;
                       this.other1=obj.others1;
                       this.other2=obj.others2;
                       this.other3=obj.others3;
                       this.other4=obj.others4;
                       this.other5=obj.others5;







                    })

                })
                .catch(error => {

                console.log(error);


                });

        },
        saveReportInfo(){
        const formData={
            surveyor_id:this.surveyor.value,
            inspected_date:this.inspectedOnDate,
            print_date:this.printDate,
            inspected_time:this.inspectedOnTime,
            is_print_surveyor:this.isPrintSurveyor,
            is_print_time:this.isPrintTime,
            inspected_at:this.inspectedAt,
            bank_name:this.bank,
            title_of_ownership:this.titleOfOwnership,
            car_make:this.modelCarMake,
            car_model:this.modelCarModal,
            car_color:this.modelCarColor,
            manufacturing_year:this.modelManufactringYear,
            // car_class:this.vehicleClass.value,
            car_registration:this.modelCarRegistration,
            car_registration_date:this.modelRegistrationDate,
            first_reg_no:this.modelFirstRegistrationDate,
            first_reg_date:this.modelFirstRegistration,
            car_engine_no:this.modelEngineNo,
            car_engine_capacity:this.modelEngineCapacity,
            car_chassis_no:this.modelChassisNo,
            odometer_reading:this.modelOdometerNo,
            grade:this.modelGrade,
            acquired:this.acquired,
            reconditioned:this.isReconditioned=true ? '1' :'0',
            repossesed:this.isRopssessed=true ? '1' :'0',
            document_seen:this.isDocument,
            is_push_start:this.isPushStart=true ? '1' :'0',
            is_key_start:this.isKeyStart=true ? '1' :'0',
            manufactured:this.modelManufactured,
            transmission:this.modelTransmission,
            feul_type:this.modelEngineType,
            is_hybrid:this.isHybrid,
            car_cng_kit:this.modelCngKit,
            car_drive:this.modelDrive,
            right_side:this.modelRightSide,
            left_side:this.modelLeftSide,
            front_side:this.modelFrontSide,
            rear_side:this.modelRearSide,
            show_grill:this.modelShowGrill,
            front_lower_shield:this.modelFrontLowerShield,
            front_back_bumper:this.modelFrontBackBumper,
            wheel_caps:this.modelWheelCaps,
            monograms:this.modelMonograms,
            original_number_plates:this.modelNumberPlates,
            shock_absorbers:this.modelShockAbsorbers,
            assemblies:this.modelAssemblies,
            tires:this.modelTires,
            spare_tire:this.modalSpareTire,
            tool_kit:this.modalCarToolkit,
            tickli:this.modalTickli,
            seating_capacity:this.modelSeatingCapacity,
            // genre:this.modelGenre,
            // body_type:this.bodyType.value,
            // rim_type:this.rim.value,
            ignition_takes:this.modalIgnitionTakes,
            battery_starts:this.modalBatteryStarts,
            engine:this.modalEngine,
            chassis:this.modalChassis,
            radiator:this.modalRadiator,
            red_head_light:this.modalRightHeadLight,
            left_head_light:this.modalLeftHeadLight,
            right_tail_light:this.modalRightTailLight,
            left_tail_light:this.modalLeftTailLight,
            right_indicator_light:this.modalRightIndicatorLight,
            left_indicator_light:this.modalLeftIndicatorLight,
            inner_lights:this.modalInnerLights,
            steering_control:this.modalSteeringControl,
            axle:this.modelAxle,
            clutch:this.modalClutch,
            brakes:this.modalBrakes,
            air_conditionar_available:this.modalAirConditionerAvailibility,
            air_conditionar_working:this.isAirConditionWorking,
            heater_available:this.modalHeaterAvailibility,
            heater_working:this.isHeaterWorking,
            cd_player_available:this.modalCDPlayerAvailibility,
            cd_player_working:this.isCDPlayerWorking,
            cameras_available:this.modalCamerasAvailibility,
            cameras_working:this.isCamerasWorking,
            other1:this.other1,
            other2:this.other2,
            other3:this.other3,
            other4:this.other4,
            other5:this.other5,
            total_assessed_value:this.totalAssesdValue,
            fsv_rate:this.fsvRate,
            is_percentage:this.isPercentage,
            total_assessed_value2:this.totalAssesdValueSecond,
            fsv_rate2:this.fsvRateSecond,
            is_percentage2:this.isPercentageSecond,
            calculated_fsv:this.calaculatedFSVSecond,
            is_reg_book:this.modelDocumentDetails,
            second_val:this.isValSecond


        };
         const  headers= {
                    'Authorization': 'Bearer ' + this.token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'

                    };

        axios.put('/api/storeReportData/'+this.id,formData,{
            headers:headers
        })
      .then(res=>{
          alert('Report Data Saved Successfully');
            // window.location.href="/home";
            console.log(res.data);
      })
      .catch(error=>{
          alert(error);
      });

        console.log(formData);
    }

    },
     mounted(){
          this.getEmployeesById();
          this.getClasses();
          this.getRims();
          this.getBodyTypes();
          this.getReportDetails();


    }

}
</script>
