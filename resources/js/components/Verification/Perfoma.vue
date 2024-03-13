<template>


<div class="container-fluid">

    <div class="row" style="padding:10px">
    <h5>Address Verification Form</h5>


    </div>
    <div class="row">
              <button class="btn btn-primary " @click="showResidence()" style="margin:10px">Residence</button>
        <button class="btn btn-primary"  @click="showWorkplace()" style="margin:10px">Workplace</button>
    </div>

    <div v-show="workplace==true" class="workplace">
         <div class="row">
      <div class="col-md-12">
        <hr style="padding:10px 0px 10px 0px">
        <div class="accordion" id="accordionExample">
          <div class="card">
            <!-- First Card -->
            <div class="card-header" id="headingOne">
              <h4 class="mb-0">
                <button class="btn btn-link" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Applicant's Details
                </button>
              </h4>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Applicant Name</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="applicantName" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Applicant Contact</label>

                      <div class="col-sm-8">
                        <input type="number" class="form-control form-control-sm" id="applicantContact">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Applicant CNIC #</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="applicantCNIC">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">

                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Residence Address</label>

                      <div class="col-sm-10">
                        <textarea name="" id="applicantResidenceAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Nearest Landmark</label>

                      <div class="col-sm-10">
                        <textarea name="" id="applicantLandmark" style="height: 80px" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">GPS Location</label>

                      <div class="col-sm-10">
                        <textarea name="" id="applicantGPS" style="height: 80px" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">GPS URL</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="applicantURL">
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>


          <div class="card">
            <!-- Second Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  Residence Details
                </button>
              </h2>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Was Applicant Available</label>

                      <div class="col-sm-8">
                        <select name="" id="wasApplicantAvailable" class="form-control form-control-sm">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Name of Person Met</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="nameOfPersonMet">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Relation with Applicant</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="relationWithApplicant" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Was Actual Address same:</label>

                      <div class="col-sm-8">
                        <select name="" id="wasActualAddressSame" class="form-control form-control-sm">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Complete Address</label>

                      <div class="col-sm-10">
                        <textarea name="" id="completeAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Contact #</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="residenceContact" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">CNIC #</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="residenceCNIC">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Lives at Given Address</label>

                      <div class="col-sm-8">
                        <select name="" id="listOfGivenAddress" class="form-control form-control-sm">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Residing Since</label>

                      <div class="col-sm-8">
                        <select name="" id="residingSince" class="form-control form-control-sm"></select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Permanent Address</label>

                      <div class="col-sm-10">
                        <textarea name="" id="residencePermanentAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card">
            <!-- Third Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                  Residence Profile
                </button>
              </h2>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Type of Residence</label>

                      <div class="col-sm-8">
                        <select name="" id="typeOfResidence" class="form-control form-control-sm">
                          <option value="House / Bunglow">House / Bunglow</option>
                          <option value="Flat">Flat</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Applicant is :</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="applicantIs">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Mention Other</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="mentionOther" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Mention Rent:</label>

                      <div class="col-sm-8">
                        <input type="text" id="mentionRent" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-6 col-form-label">Size (Approx Area)</label>

                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-sm" id="sizeIs" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-6 col-form-label">Utilization of Residence</label>

                      <div class="col-sm-6">
                        <input type="text" id="utilizationOfResidence" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-5 col-form-label">Rent Deed Verified</label>

                      <div class="col-sm-7">
                        <select class="form-control form-control-sm" name="" id="rentDeedVerified">
                          <option selected value="" disabled></option>
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
          <div class="card">
            <!-- Four Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseTwo">
                  Neighborhood Check
                </button>
              </h2>
            </div>
            <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Neighborhood</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="neighborIs">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Area Accessibility :</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="areaAccessibility">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Resident belong to</label>

                      <div class="col-sm-8">
                        <input type="text" class="form-control form-control-sm" id="residentBelongsTo" value="">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Repossession in the Area:</label>

                      <div class="col-sm-8">
                        <input type="text" id="repossessionInTheArea" class="form-control form-control-sm">
                      </div>
                    </div>
                  </div>
                </div>




              </div>
            </div>
          </div>
          <div class="card">
            <!-- Fifth Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseFifth" aria-expanded="false" aria-controls="collapseTwo">
                  Neighborhood Check One
                </button>
              </h2>
            </div>
            <div id="collapseFifth" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Name</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="firstNeighborIs">
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Address</label>

                      <div class="col-sm-10">
                        <textarea name="" id="firstNeighborAddress" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant</label>

                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" id="firstKnowsApplicant">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant Since</label>

                      <div class="col-sm-8">
                        <select name="" class="form-control form-control-sm" id="firstKnowsApplicantSince">
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Comments</label>

                      <div class="col-sm-10">
                        <textarea id="firstNeighborComments" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>

                </div>




              </div>
            </div>
          </div>
          <div class="card">
            <!-- Six Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseTwo">
                  Neighborhood Check Two
                </button>
              </h2>
            </div>
            <div id="collapseSix" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Name</label>

                      <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="secondNeighborIs">
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Address</label>

                      <div class="col-sm-10">
                        <textarea name="" id="secondNeighborAddress" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>

                </div>

                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant</label>

                      <div class="col-sm-8">
                        <select class="form-control form-control-sm" id="secondKnowsApplicant">
                          <option value="Yes">Yes</option>
                          <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant Since</label>

                      <div class="col-sm-8">
                        <select name="" class="form-control form-control-sm" id="secondKnowsApplicantSince">
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">
                      <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Comments</label>

                      <div class="col-sm-10">
                        <textarea id="secondNeighborComments" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>

                </div>




              </div>
            </div>
          </div>
          <div class="card">
            <!-- Seven Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseTwo">
                  General Comments
                </button>
              </h2>
            </div>
            <div id="collapseSeven" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">


                <div class="row">
                  <div class="col-md-12 col-sm-12">
                    <div class="form-group row">

                      <div class="col-md-12 col-sm-12">
                        <textarea name="" id="generalComments" class="form-control form-control-sm" style="height: 150px" cols="30" rows="10"></textarea>
                      </div>
                    </div>
                  </div>

                </div>





              </div>
            </div>
          </div>
          <div class="card">
            <!-- Seven Card -->
            <div class="card-header" id="headingTwo">
              <h2 class="mb-0">
                <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#collapseEight" aria-expanded="false" aria-controls="collapseTwo">
                  Verification Images
                </button>
              </h2>
            </div>
            <div id="collapseEight" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
              <div class="card-body">

                <div class="row">

                  <div style='padding:14px'>
                    <label for="files">Select multiple files: </label>
                    <input style="font-size:13px" id="files" type="file" multiple />
                    <button class="btn btn-primary btn-sm" id="clearBtn">Clear</button>
                  </div>
                  <div style='padding:14px; margin:auto'>

                  </div>

                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div id="sortableImgThumbnailPreview">

                    </div>
                  </div>

                </div>




              </div>
            </div>
          </div>

        </div>
      </div>


    </div>
    <div class="row mt-3">
      <div class="col-md-12" style="text-align:right">
        <button id="saveBtn" class="btn btn-primary">Save</button>

      </div>
    </div>
    </div>

    <div  v-show="residence==true" class="residenceForm">
        <div class="row">
              <div class="col-md-12">
                <hr style="padding:10px 0px 10px 0px">
                <div class="accordion" id="accordionExample">
                  <div class="card">
                    <!-- First Card -->
                    <div class="card-header" id="headingOne">
                      <h4 class="mb-0">
                        <button class="btn btn-link" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r1" aria-expanded="true" aria-controls="r1">
                          Applicant's Details
                        </button>
                      </h4>
                    </div>

                    <div id="r1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Applicant Name</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="applicantName" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Applicant Contact</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="applicantContact">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Applicant CNIC #</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="applicantCNIC">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">

                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Residence Address</label>

                              <div class="col-sm-10">
                                <textarea name="" id="applicantResidenceAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Nearest Landmark</label>

                              <div class="col-sm-10">
                                <textarea name="" id="applicantLandmark" style="height: 80px" class="form-control form-control-sm"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">GPS Location</label>

                              <div class="col-sm-10">
                                <textarea name="" id="applicantGPS" style="height: 80px" class="form-control form-control-sm"></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">GPS URL</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="applicantURL">
                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <!-- Second Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r2" aria-expanded="false" aria-controls="r2">
                        Office Address Details
                        </button>
                      </h2>
                    </div>
                    <div id="r2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Was Applicant Available</label>

                              <div class="col-sm-8">
                                <select name="" id="wasApplicantAvailable" class="form-control form-control-sm">
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Name of Person Met</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="nameOfPersonMet">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Relation with Applicant</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="relationWithApplicant" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Was Actual Address same:</label>

                              <div class="col-sm-8">
                                <select name="" id="wasActualAddressSame" class="form-control form-control-sm">
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Complete Address</label>

                              <div class="col-sm-10">
                                <textarea name="" id="completeAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Contact #</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="residenceContact" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">CNIC #</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="residenceCNIC">
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Lives at Given Address</label>

                              <div class="col-sm-8">
                                <select name="" id="listOfGivenAddress" class="form-control form-control-sm">
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Residing Since</label>

                              <div class="col-sm-8">
                                <select name="" id="residingSince" class="form-control form-control-sm"></select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Permanent Address</label>

                              <div class="col-sm-10">
                                <textarea name="" id="residencePermanentAddress" style="height: 80px" class="form-control form-control-sm"></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Third Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r3" aria-expanded="false" aria-controls="r3">
                          Work Office Details
                        </button>
                      </h2>
                    </div>
                    <div id="r3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Type of Residence</label>

                              <div class="col-sm-8">
                                <select name="" id="typeOfResidence" class="form-control form-control-sm">
                                  <option value="House / Bunglow">House / Bunglow</option>
                                  <option value="Flat">Flat</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Applicant is :</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="applicantIs">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Mention Other</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="mentionOther" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Mention Rent:</label>

                              <div class="col-sm-8">
                                <input type="text" id="mentionRent" class="form-control form-control-sm">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">Size (Approx Area)</label>

                              <div class="col-sm-6">
                                <input type="text" class="form-control form-control-sm" id="sizeIs" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-6 col-form-label">Utilization of Residence</label>

                              <div class="col-sm-6">
                                <input type="text" id="utilizationOfResidence" class="form-control form-control-sm">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-5 col-form-label">Rent Deed Verified</label>

                              <div class="col-sm-7">
                                <select class="form-control form-control-sm" name="" id="rentDeedVerified">
                                  <option selected value="" disabled></option>
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Four Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r4" aria-expanded="false" aria-controls="r4">
                        Market Check One
                        </button>
                      </h2>
                    </div>
                    <div id="r4" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Neighborhood</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="neighborIs">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Area Accessibility :</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="areaAccessibility">
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Resident belong to</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="residentBelongsTo" value="">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Repossession in the Area:</label>

                              <div class="col-sm-8">
                                <input type="text" id="repossessionInTheArea" class="form-control form-control-sm">
                              </div>
                            </div>
                          </div>
                        </div>




                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Fifth Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r5" aria-expanded="false" aria-controls="r5">
                            Market Check Two
                        </button>
                      </h2>
                    </div>
                    <div id="r5" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Name</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="firstNeighborIs">
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Address</label>

                              <div class="col-sm-10">
                                <textarea name="" id="firstNeighborAddress" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant</label>

                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="firstKnowsApplicant">
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant Since</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="firstKnowsApplicantSince">

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Comments</label>

                              <div class="col-sm-10">
                                <textarea id="firstNeighborComments" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>




                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Six Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r6" aria-expanded="false" aria-controls="r6">
                                          Office HR Details
                        </button>
                      </h2>
                    </div>
                    <div id="r6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Name</label>

                              <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" id="secondNeighborIs">
                              </div>
                            </div>
                          </div>

                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Address</label>

                              <div class="col-sm-10">
                                <textarea name="" id="secondNeighborAddress" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>

                        <div class="row">
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant</label>

                              <div class="col-sm-8">
                                <select class="form-control form-control-sm" id="secondKnowsApplicant">
                                  <option value="Yes">Yes</option>
                                  <option value="No">No</option>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-6 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-4 col-form-label">Knows Applicant Since</label>

                              <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="secondKnowsApplicantSince">

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">
                              <label for="staticEmail" class="col-sm-2 col-form-label">Neighbor's Comments</label>

                              <div class="col-sm-10">
                                <textarea id="secondNeighborComments" class="form-control form-control-sm" style="height: 80px" cols="30" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>




                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Seven Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r7" aria-expanded="false" aria-controls="r7">
                          General Comments
                        </button>
                      </h2>
                    </div>
                    <div id="r7" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">


                        <div class="row">
                          <div class="col-md-12 col-sm-12">
                            <div class="form-group row">

                              <div class="col-md-12 col-sm-12">
                                <textarea name="" id="generalComments" class="form-control form-control-sm" style="height: 150px" cols="30" rows="10"></textarea>
                              </div>
                            </div>
                          </div>

                        </div>





                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Seven Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r8" aria-expanded="false" aria-controls="r8">
                          Verification Images
                        </button>
                      </h2>
                    </div>
                    <div id="r8" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">

                          <div style='padding:14px'>
                            <label for="files">Select multiple files: </label>
                            <input style="font-size:13px" id="files" type="file" multiple />
                            <button class="btn btn-primary btn-sm" id="clearBtn">Clear</button>
                          </div>
                          <div style='padding:14px; margin:auto'>

                          </div>

                        </div>

                        <div class="row">
                          <div class="col-md-12">
                            <div id="sortableImgThumbnailPreview">

                            </div>
                          </div>

                        </div>




                      </div>
                    </div>
                  </div>
                  <div class="card">
                    <!-- Seven Card -->
                    <div class="card-header" id="headingTwo">
                      <h2 class="mb-0">
                        <button class="btn btn-link collapsed" style="text-decoration:none !important" type="button" data-toggle="collapse" data-target="#r9" aria-expanded="false">
                          Result Of Verification
                        </button>
                      </h2>
                    </div>
                    <div id="r9" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                      <div class="card-body">

                        <div class="row">
                          <div class="col-md-12">
                            <input type="text" class="form-control form-control-sm" id="resultOfverification">

                          </div>
                        </div>



                      </div>
                    </div>
                  </div>

                </div>
              </div>


            </div>
            <div class="row mt-3">
              <div class="col-md-12" style="text-align:right">
                <button id="saveBtn" class="btn btn-primary">Save</button>

              </div>
            </div>

    </div>
</div>

</template>
<script>
import axios from 'axios';
import vSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
export default {
    props:{
          id:String,
          jobid:String,
          common:String,
          cmpny:String,
          usertoken:String
  },
    data() {
       return {
           residence:true,
           workplace:false,
       }},


   components:{
          'Select':vSelect,
   },
   methods:{
       showResidence(){
           this.residence=true;
           this.workplace=false;
       },
       showWorkplace(){
        this.residence=false;
           this.workplace=true;
       },
   }
}
</script>
<style scoped>

</style>
