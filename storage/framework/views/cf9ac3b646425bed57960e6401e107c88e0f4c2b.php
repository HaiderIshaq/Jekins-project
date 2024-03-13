<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT Traders | Prism'); ?>
</title>

<style>
.badge{
    font-size: 12px;
    margin-top:8px
}

#myTable1 td{
    font-size: 12px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">



<div class="row pl-3">
    <div class="pr-1 pb-2">
        <a href="/prismCreate">
            <button class="btn btn-primary job-button job-button4 pt-2 pb-2">
                <i class="fa fa-plus-circle fa-2x text-white" style="font-size:0.9em" > </i><span style="font-size:15px" class="text-white ml-2" >Insurance survey</span>
            </button>
        </a>
    </div>
    <div class="pr-1 pb-2">
       
          <div id="app">
            <prism-vehicle
            usercompany="<?php echo e($user[0]); ?>"
            usertoken="<?php echo e($user[2]); ?>"
            usercompanyname="<?php echo e($user[1]->company_name); ?>"
            usercompanyprefix="<?php echo e($user[1]->company_prefix); ?>" 
            ></prism-vehicle>
          </div>
       
    </div> 
    
</div>
<!-- <a href="/verificationPending"><button class="btn btn-danger">Pending</button></a> -->



<table class="table display " id="myTable1" style="width:100%;" >
        <thead class="thead-dark" style="font-size:11.8px">
            <tr style="font-size:13px">
                <th scope="col">Id</th>
                <th scope="col">Job_Id</th>
                <th scope="col">Taken_on</th>
                <th scope="col">Region </th>
                <th scope="col">Insurer</th>
                <th scope="col">Branch</th>
                <th scope="col">Insured</th>
                <th scope="col">Category</th>
                <th scope="col">Mode</th>
                <th scope="col">Reg No</th>
                <th scope="col">Make</th>
                <th scope="col">Model</th>
                <th scope="col">Engine No</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
        </table>


        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>


<script  type="text/javascript">
    $(function(){
         $('#myTable1').DataTable({
        processing: true,
        // serverSide: true,

        "scrollX": true,
        ajax:"/prism",
        columns: [
            {
                data: 'id',
                name: 'id'
            },
             {
                data: 'job_id',
                name: 'job_id'
            }, {
                data: 'taken_on',
                name: 'taken_on'
            }, {
                data: 'region',
                name: 'region'
            }, {
                data: 'insurer_name',
                name: 'insurer_name'
            }, {
                data: 'insurer_branch',
                name: 'insurer_branch'
            }, {
                data: 'name_of_insured',
                name: 'name_of_insured'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'survey_mode',
                name: 'survey_mode'
            },
            {
                data: 'reg_no',
                name: 'reg_no'
            },
            {
                data: 'make',
                name: 'make'
            },
            {
                data: 'model',
                name: 'model'
            },
            {
                data: 'engine_no',
                name: 'engine_no'
            },
            {
                "mData": "status",
                "mRender": function (data, type, row) {
                    if(data=='1')
                    {
                        return "<span class='badge badge-success'>Completed</span>";

                    }
                    else if(data=='2'){
                        return "<span class='badge badge-info'>Delayed</span>";

                    }
                    else if(data=='3'){
                        return "<span class='badge badge-danger'>Cancalled</span>";

                    }
                    else{
                        return "<span class='badge badge-warning'>Active</span>";

                    }
                }
            },
            {data: 'action', name: 'action'}
        ],


        buttons: [
            {
                extend:'pdf',
                title: 'Data export',
                exportOptions: {
                    columns: [ 0,1,2,3,4,5,6,7]
                }

            }
        ],
        // order: [[0,'desc']]



    });



    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Prism/index.blade.php ENDPATH**/ ?>