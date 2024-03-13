<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT Traders | Address Verification'); ?>
</title>

<style>
.badge{
    font-size: 15px;
    margin-top:8px
}
</style>

<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
<a href="/home" class="btn btn-primary">Back</a>
<a href="/verificationCreate"><button class="btn btn-success"><i class="fa fa-plus pr-2"></i>New Verification Job</button></a>
<!-- <a href="/verificationPending"><button class="btn btn-danger">Pending</button></a> -->



<table class="table display" id="myTable1" style="width:100%" style="width:100%" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Job_Id</th>
            <th scope="col">Taken_on</th>
            <th scope="col">City</th>
            <th scope="col">Area</th>
            <th scope="col">Bank</th>
            <th scope="col">Customer</th>
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
        ajax:"/verification",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'job_id', name: 'job_id'},
            {data: 'taken_on', name: 'taken_on'},
            {data: 'city', name: 'city'},
            {data: 'area', name: 'area'},
            {data: 'bank_name', name: 'bank_name'},
            {data: 'cust_name', name: 'cust_name'},
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Verification/index.blade.php ENDPATH**/ ?>