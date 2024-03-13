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
                                                    <div class="col-md-10">
                                                        <Select v-model="surveyor" :options="surveyors" label="text"></Select>
                                                    </div>

                                                    <!-- <div class="col-md-3">
                                                            <div class="form-check mt-2 ml-4">
                                                                <input type="checkbox" class="form-check-input" v-model="isPrintSurveyor" >
                                                                <label for="form-check-label"> Print Surveyor?</label>
                                                            </div>
                                                    </div> -->
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        Inspected On:
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="date" v-model="inspectedOnDate" class="form-control">
                                                    </div>
                                                    <!-- <div class="col-md-2">
                                                        <input type="time" v-model="inspectedOnTime" class="form-control">
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check mt-2 ml-4">
                                                            <input type="checkbox"  v-model="isPrintTime" class="form-check-input"  >
                                                            <label for="form-check-label"> Print Time?</label>
                                                        </div>
                                                    </div> -->
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
                                                        <textarea v-model="inspectedAt" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row" v-show="bank =='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                    Representative CNIC:
                                                    </div>
                                                    <div class="col-md-10">
                                                       <input type="text" class="form-control"  v-model="representativeCNIC">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Title of Ownership:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <textarea v-model="titleOfOwnership" class="form-control"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Maker:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" v-model="modelCarMake" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                    Model:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" v-model="modelCarModal" class="form-control">
                                                    </div>

                                                </div>
                                                 <div class="form-group row" v-show="bank=='Askari Bank Limited'">
                                                    <div class="col-md-2">
                                                       Class:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <Select v-model="vehicleClass" :options="vehicleClasses" label="text"></Select>
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
                                                <div class="form-group row" >
                                                    <div class="col-md-2">
                                                      Rim Type:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <Select v-model="rim" :options="rims" label="text"></Select>
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
                                                <div class="form-group row" v-if="bank=='Askari Bank Limited'">
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
                                                        Seating Capacity:
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" class="form-control" v-model="modelSeatingCapacity">
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
                                                            <input type="checkbox" class="custom-radio" v-model="isHybrid" >
                                                            <label for="form-input-radio"  style="font-size:14px">Hybrid?</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">

                                                            Accessories:

                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-check "  style="margin-left: 19px !important;">
                                                            <input type="checkbox" class="form-check-input"   v-model="modelAccessories" >
                                                            <label  style="font-size:14px">Available?</label>
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
                                                           Body Condition:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelBodyCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelBodyCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelBodyCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Engine:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelEngineCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelEngineCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelEngineCondition">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Steering Control:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalSteeringControl">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Axle:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelAxle">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Suspensions:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalSuspension">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Transmission System:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalTransmissionSystem">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalTransmissionSystem">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalTransmission">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Electric System:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalElectricSystem">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalElectricSystem">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalElectricSystem">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Tyres:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalTyres">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalTyres">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalTyres">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Any Leaks:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalAnyLeaks">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalAnyLeaks">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalAnyLeaks">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Engine Major Defects :
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalMajorDefects">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalMajorDefects">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalMajorDefects">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                        Chassis Repaired :
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalChassisRepaired">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalChassisRepaired">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalChassisRepaired">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
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

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseExternalCondition" aria-expanded="true" aria-controls="collapseOne" value="External Conditions of Vehicle">
                                            </h5>
                                        </div>

                                        <div id="collapseExternalCondition" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding:20px 50px 10px 50px">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Body:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelExBody">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelExBody">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelExBody">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Bonnet:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalExBonnet">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalExBonnet">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalExBonnet">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                          Doors:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalExDoors">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalExDoors">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalExDoors">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                     <!-- Report Modal |Internal Condition | Askari Bank Limited -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseInternalCondition" aria-expanded="true" aria-controls="collapseOne" value="Internal Conditions of Vehicle">
                                            </h5>
                                        </div>

                                        <div id="collapseInternalCondition" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding:20px 50px 10px 50px">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Dashboard:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelDashboard">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelDashboard">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelDashboard">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Roof:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalRoof">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalRoof">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalRoof">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                         Seats:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="good" value="Good" v-model="modalSeats">
                                                            <label for="form-input-radio"  style="font-size:14px">Good</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modalSeats">
                                                            <label for="form-input-radio"  style="font-size:14px">Average</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modalSeats">
                                                            <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                                        </div>
                                                    </div>



                                                </div>


                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row pt-4">
                                        <div class="col-md-2">

                                                Overall Condition:

                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check ">
                                                <input type="radio" class="custom-radio" id="good" value="Good" v-model="modelOverallCondition">
                                                <label for="form-input-radio"  style="font-size:14px">Good</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-check ">
                                                <input type="radio" class="custom-radio"  id="average" value="Average" v-model="modelOverallCondition">
                                                <label for="form-input-radio"  style="font-size:14px">Average</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-check ">
                                                <input type="radio" class="custom-radio"  id="poor" value="Poor" v-model="modelOverallCondition">
                                                <label for="form-input-radio"  style="font-size:14px">Poor</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-2">

                                               Negative Remarks:

                                        </div>
                                        <div class="col-md-10">
                                            <textarea name="" class="form-control" id="" cols="30" v-model="modalNegativeRemarks" rows="10"></textarea>
                                        </div>
                                    </div>

                                    <!-- Report Modal | Document Review | Askari Bank Limited -->
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">

                                                <input type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseDocumentReview" aria-expanded="true" aria-controls="collapseOne" value="Internal Conditions of Vehicle">
                                            </h5>
                                        </div>

                                        <div id="collapseDocumentReview" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding:20px 50px 10px 50px">
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Original Registration Book:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="seen" value="Seen" v-model="modelOriginalRegBook">
                                                            <label for="form-input-radio"  style="font-size:14px">Seen</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="notSeen" value="Not Seen" v-model="modelOriginalRegBook">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Seen</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="availabel" value="Not Available" v-model="modelOriginalRegBook">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Original CNIC Of Owner:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="seen" value="Seen" v-model="modelCNICOwner">
                                                            <label for="form-input-radio"  style="font-size:14px">Seen</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="notSeen" value="Not Seen" v-model="modelCNICOwner">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Seen</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="availabel" value="Not Available" v-model="modelCNICOwner">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Original ETO Certificate:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio" id="seen" value="Seen" v-model="modelETO">
                                                            <label for="form-input-radio"  style="font-size:14px">Seen</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="notSeen" value="Not Seen" v-model="modelETO">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Seen</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  id="availabel" value="Not Available" v-model="modelETO">
                                                            <label for="form-input-radio"  style="font-size:14px">Not Available</label>
                                                        </div>
                                                    </div>



                                                </div>
                                                 <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Hypothecated:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" v-model="isHypothecated">
                                                            <label for="">Yes?</label>

                                                         </div>
                                                    </div>




                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Duplicated Reg Book:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" v-model="isDuplicatedRegBook">
                                                            <label for="">Yes?</label>
                                                         </div>
                                                    </div>




                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Transferred Vehicle:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" v-model="isVehicleTransferred">
                                                            <label for="">Yes?</label>

                                                         </div>
                                                    </div>




                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-2">
                                                        <div class="form-group row">
                                                           Stolen Vehicle:
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-check ">
                                                            <input type="checkbox" class="form-check-input" v-model="isVehicleStolen">
                                                            <label for="">Yes?</label>
                                                         </div>
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
                                                <div class="form-group row">

                                                    <div class="col-md-3">
                                                        Select
                                                    </div>

                                                    <div class="col-md-8">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Documents / With Duplicate Documents"  v-model="modelSelect">
                                                            <label for="form-input-radio" style="font-size:14px">With Original Documents / With Duplicate Documents</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 offset-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"   value="With Original Documents / Without Duplicate Documents"  v-model="modelSelect">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Documents / Without Original Documents</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-8 offset-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Registration Book / Without Original Registration Book"  v-model="modelSelect">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Registration Book / Without Original Registration Book</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-3">
                                                        <div class="form-check ">
                                                            <input type="radio" class="custom-radio"  value="With Original Registration Book / With Duplicate Registration Book"  v-model="modelSelect">
                                                            <label for="form-input-radio"  style="font-size:14px">With Original Registration Book / With Duplicate Registration Book</label>
                                                        </div>
                                                    </div>

                                                </div>
                                                <fieldset>

                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">Total Assessed Value: </label>
                                                        <div class="col-md-8" >
                                                            <input class="form-control form-control-sm"   type="text">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6" >
                                                            <input class="form-control form-control-sm"  type="text">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="checkbox"  class="form-check-input ml-3 mt-2"   >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="" class="col-md-3 col-form-label">F.S.V: </label>
                                                        <div class="col-md-6 " >
                                                            <input class="form-control form-control-sm"  type="text">
                                                        </div>

                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div> -->


                                    <div class="row" style="text-align: right;padding-right: 20px;">
                                        <div class="col-md-12">
                                            <input type="button" value="Save" class="btn btn-primary" @click="saveReportInfo()">
                                            <input type="button" value="Cancel" data-dismiss="modal" aria-label="Close" class="btn btn-primary ">
                                            <a :href="`/valuationReportASKBL/`+this.id" target="_blank"><input type="button" value="Print Report" class="btn btn-primary "></a>

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
        modelSeatingCapacity:'',
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
        isPercentage:'',
        calaculatedFSV:''
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
                        this.inspectedOnDate=obj.inspected_on;
                        this.printDate=obj.print_date;
                        this.inspectedAt=obj.inspected_at;
                        this.representativeCNIC=obj.representative_cnic;
                        this.titleOfOwnership=obj.title_of_ownership;
                        this.modelCarMake=obj.make;
                        this.modelCarModal=obj.car_model;
                        this.vehicleClass={text:obj.vehicle_class_name,value:obj.class};
                        this.modelCarColor=obj.color;
                        this.modalAirConditionerAvailibility=obj.air_conditionar_avalibility==1 ?true:false;
                        this.isAirConditionWorking=obj.is_air_conditionar;
                        this.modelCngKit=obj.cng_kit;
                        this.modelCarRegistration=obj.reg_no;
                        this.modelRegistrationDate=obj.reg_date;
                        this.modelEngineNo=obj.engine_no;
                        this.modelGenre=obj.genre;
                        this.bodyType={text:obj.body_type_name,value:obj.body_type};
                        this.modelEngineCapacity=obj.engine_capacity;
                        this.modelChassisNo=obj.chassis_no;
                        this.modelOdometerNo=obj.odometer_reading;
                        this.rim={text:obj.rim_type_name,value:obj.rim_type};
                        this.modelSeatingCapacity=obj.seating_capacity;
                        this.modelManufactured=obj.manufactured;
                        this.modelTransmission=obj.transmission;
                        this.modelEngineType=obj.feul_type;
                        this.isHybrid=obj.is_hybrid==1 ? true : false;
                        this.modelAccessories=obj.accessories==1 ? true : false;
                        this.modelDrive=obj.drive_is;
                        this.modelBodyCondition=obj.body_condition;
                        this.modelEngineCondition=obj.engine_condition;
                        this.modalSteeringControl=obj.steering_control;
                        this.modelAxle=obj.axle;
                        this.modalSuspension=obj.suspension;
                        this.modalTransmissionSystem=obj.transmission_system;
                        this.modalElectricSystem=obj.electric_system;
                        this.modalTyres=obj.tyres;
                        this.modalAnyLeaks=obj.any_leaks;
                        this.modalMajorDefects=obj.engine_major_defects;
                        this.modalChassisRepaired=obj.chassis_repaired;
                        this.modelExBody=obj.external_body_condition;
                        this.modalExBonnet=obj.bonnet_condition;
                        this.modalExDoors=obj.doors_condition;
                        this.modelDashboard=obj.dashboard_condition;
                        this.modalRoof=obj.roof;
                        this.modalSeats=obj.seats;
                        this.modelOverallCondition=obj.overall_condition;
                        this.modalNegativeRemarks=obj.negative_remarks;
                        this.modelOriginalRegBook=obj.original_registration_book;
                        this.modelCNICOwner=obj.original_cnic_owner;
                        this.modelETO=obj.original_eto_certificate;
                        this.isHypothecated=obj.hypothecated==1 ? true : false;
                        this.isDuplicatedRegBook=obj.duplicated_reg_book==1 ? true : false;
                        this.isVehicleTransferred=obj.is_transferred==1 ? true : false;
                        this.isVehicleStolen=obj.is_stolen==1 ? true : false;





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
            representative_cnic:this.representativeCNIC,
            inspected_at:this.inspectedAt,
            title_of_ownership:this.titleOfOwnership,
            car_make:this.modelCarMake,
            car_model:this.modelCarModal,
            car_color:this.modelCarColor,
            bank_name:this.bank,
            car_class:this.vehicleClass.value,
            air_conditionar_available:this.modalAirConditionerAvailibility,
            air_conditionar_working:this.isAirConditionWorking,
            car_registration:this.modelCarRegistration,
            car_registration_date:this.modelRegistrationDate,
            car_cng_kit:this.modelCngKit,
            genre:this.modelGenre,
            car_engine_no:this.modelEngineNo,
            body_type:this.bodyType.value,
            car_engine_capacity:this.modelEngineCapacity,
            car_chassis_no:this.modelChassisNo,
            odometer_reading:this.modelOdometerNo,
            rim_type:this.rim.value,
            manufactured:this.modelManufactured,
            transmission:this.modelTransmission,
            feul_type:this.modelEngineType,
            accessories:this.modelAccessories,
            car_drive:this.modelDrive,
            is_hybrid:this.isHybrid,
            body_condition:this.modelBodyCondition,
            engine_condition:this.modelEngineCondition,
            steering_control:this.modalSteeringControl,
            axle:this.modelAxle,
            suspension:this.modalSuspension,
            seating_capacity:this.modelSeatingCapacity,
            transmission_system:this.modalTransmissionSystem,
            electric_system:this.modalElectricSystem,
            tyres:this.modalTyres,
            any_leaks:this.modalAnyLeaks,
            major_defects:this.modalMajorDefects,
            chassis_repaired:this.modalChassisRepaired,
            external_body:this.modelExBody,
            external_bonnet:this.modalExBonnet,
            external_doors:this.modalExDoors,
            internal_dashboard:this.modelDashboard,
            internal_roof:this.modalRoof,
            internal_seats:this.modalSeats,
            overall_condition:this.modelOverallCondition,
            negative_remarks:this.modalNegativeRemarks,
            original_reg_book:this.modelOriginalRegBook,
            original_cnic:this.modelCNICOwner,
            original_eto:this.modelETO,
            hypothecated:this.isHypothecated,
            duplicated_reg_book:this.isDuplicatedRegBook,
            vehicle_transfered:this.isVehicleTransferred,
            vehicle_stolen:this.isVehicleStolen,
            total_assessed_value:this.totalAssesdValue,
            fsv_rate:this.fsvRate,
            is_percentage:this.isPercentage,
            calculated_fsv:this.calaculatedFSV
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
