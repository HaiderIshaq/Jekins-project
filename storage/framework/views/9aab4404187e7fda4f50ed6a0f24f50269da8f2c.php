<?php $__env->startSection('content'); ?>
<title>
<?php $__env->startSection('title','KGT ERP | Bills'); ?>
</title>
<style>
    .dt-buttons{
        margin-left: 10px;
    }
</style>
<div class="container-fluid bg-white box-shadow  pt-4 pb-4" id="app">
        <form id="exceldownload" method="POST" action="<?php echo e(route('downloadexcel')); ?>" accept-charset="UTF-8">

        <div class="row">

            <div class="col-md-4">
                <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From Date" >
            </div>
            <div class="col-md-4">
                 <input type="date" name="to_date" id="to_date" class="form-control" placeholder="To Date" >

            </div>
            <div class="col-md-4">
                 <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                 <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
                    <input type="submit" name="refresh" id="download" class="btn btn-success"  value="Download">
                    <input name="_token" type="hidden" value="<?php echo e(csrf_token()); ?>"/>
                </div>
               <div class="col-md-4">
                <div class="row" style="padding: 17px;">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="In Progress">
                        <label class="form-check-label" for="inlineRadio1">In Progress</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="Pending">
                        <label class="form-check-label" for="inlineRadio1">Pending</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="Paid">
                        <label class="form-check-label" for="inlineRadio2">Paid</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="Receivable">
                        <label class="form-check-label" for="inlineRadio2">Receivable</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="status" id="status" value="Cancelled">
                        <label class="form-check-label" for="inlineRadio2">Cancelled</label>
                    </div>
                </div>
            </div>
            </form>

            <div class="col-md-4 pt-2">
                <select class="form-control form-control-sm" name="service"  id="service">
                    <option value="Livestock" selected>Livestock</option>
                    <option value="Verification">Verification</option>
                </select>

            </div>
        </div>

        <table class="table"  id="myTable" >
        <thead class="thead-dark">
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Bill ID </th>
            <th scope="col">Invoice ID </th>
            <th scope="col">Date </th>
            <th scope="col">Region</th>
            <th scope="col">Bank</th>
            <th scope="col">Branch</th>
            <th scope="col">Customer</th>
            <th scope="col">Service</th>
            <th scope="col" class="sum">Bill </th>
            <th scope="col">Tax</th>
            <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
        <tfoot>
        <tr>

            <th id="totalBill"  colspan="2" tyle="text-align:right">Total: </th>
            <th ></th>
            <th ></th>
            <th></th>
            <th></th> 
            <th></th> 
            <th></th> 
            <th></th> 
            <th></th> 
            <th></th> 
            <th></th> 

        </tr>
    </tfoot>
        </tbody>
        </table>


        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Receipt Viewer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form>
            <div class="row">
                <div class="col-md-8">
                    <label for="">  ID</label>
                    <input type="hidden" id="selectedReceipt" readonly class="form-control">

                </div>
                <div class="col-md-8">
                    <label for=""> Receipt ID</label>
                    <input type="text" id="receiptID" readonly class="form-control">

                </div>
                <div class="col-md-4">
                    <label for="">Generated On</label>
                    <input type="text" id="receipGenerated" readonly class="form-control">
                </div>
            </div><br>
            <div class="row">
                <div class="col-md-12">
                    <label for=""> Instrument</label>
                    <input type="text" readonly id="receiptInstrument" class="form-control">
                </div>
            </div> <br>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Bills</label>
                    <input type="hidden" readonly id="receiptBills" class="form-control">
                    <input type="text" readonly id="receiptJobs" class="form-control">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label for="">Net Amount</label>
                    <input type="text" readonly id="receiptNet" class="form-control">
                    <br>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="">Bill Amount</label>
                    <input type="text" readonly id="receiptBillAmount" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Sales Tax</label>
                    <input type="text" readonly id="receiptSalesTax" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Taxable Amount</label>
                    <input type="text" readonly id="receiptTaxableAmount" class="form-control">
                </div>
                <div class="col-md-3">
                    <label for="">Bank Charges</label>
                    <input type="text" readonly id="receiptBankCharges" class="form-control">
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">

                    <label for=""> Received On</label>
                    <input type="date" readonly id="receiptReceivedOn" class="form-control">
                    <br>
                    <label for=""> Instrument Number</label>
                    <input type="text" readonly id="receiptInstrumentNumber" class="form-control">
                    <br>
                    <label for=""> Instrument Date</label>
                    <input type="date" readonly id="receiptInstrumentDate" class="form-control">


                </div>
                <div class="col-md-6">


                    <label for="">Deposit Date</label>
                    <input type="date" readonly id="receiptDepositDate" class="form-control">
                    <br>
                    <label for="">Deposit In</label>
                    <input type="text" readonly id="receiptDepositIn" class="form-control">
                    <br>
                    <label for="">Slip No</label>
                    <input type="text" readonly id="receiptSlipNo" class="form-control">

                </div>

            </div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <label for=""> Remarks</label>
                    <textarea style="height:120px" readonly id="receiptRemarks" class="form-control"></textarea>
                </div>
            </div>
            <div class="row mt-3">
                <label for="" class="col-md-3"> Instrument Scan</label>
                <button type="button" class="col-md-3 btn btn-primary" data-toggle="modal" data-target="#modal1">.....</button>
            </div>
            <div class="row mt-3">
                <label for="" class="col-md-3"> Dep Slip Scan</label>
                <button type="button" class="col-md-3 btn btn-primary" data-toggle="modal" data-target="#modal2">.....</button>
            </div>

      </div>
      <div class="modal-footer">
        <button type="button" type="submit" class="btn btn-success" id="approve" onclick="approveReceipt()">Approve</button>
        <button type="button" class="btn btn-danger" id="reject"  onclick="rejectReceipt()">Reject</button>
        </form>

      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Instrument Scan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <iframe id="frame1" src="" style="width:100%;height:500px" frameborder="0">

        </iframe>
      </div>

    </div>
  </div>
</div>



<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Dep Slip Scan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <iframe id="frame2" src="" style="width:100%;height:500px" frameborder="0">

        </iframe>
      </div>

    </div>
  </div>
</div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script  type="text/javascript">
    $(function(){

        load_data();
       get_total();



      function load_data(from_date='',to_date='',status='',service='')
      {

        var table =$('#myTable').DataTable({
        serverSide: true,
        processing: true,
        ajax:{
          url: "/getAllBills",
          data:{
              from_date:from_date,
              to_date:to_date,
              status:status,
              service:service,
              
            }
        },

        dom: 'lBfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i> Excel',
                titleAttr: 'Export to Excel',
                title: 'Inspection Bills',
                exportOptions: {
                    columns: ['1','2','3','4','5','6','7','8','9'],
                }
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i> PDF',
                titleAttr: 'PDF',
                title: 'Inspection Bills',
                exportOptions: {
                    columns: ['1','2','3','4','5','6','7','8'],

                },
            },
        ],
           aLengthMenu: [
        [25, 50, 100, 200, -1],
        [25, 50, 100, 200, "All"]
    ],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'bill_number', name: 'bill_number'},
            {data: 'invoice_id', name: 'invoice_id'},
            {data: 'bill_date', name: 'bill_date'},
            {data: 'city_name', name: 'city_name'},
            {data: 'bank_name', name: 'bank_name'},
            {data: 'branch_name', name: 'branch_name'},
            {data: 'cust_name', name: 'cust_name'},
            {data: 'service', name: 'service'},
            {data: 'total_amount', name: 'total_amount'},
            {data: 'tax', name: 'tax'},
            {data: 'status',name:'status', className : "center",render:function(status){
               if(status=="Receivable"){
                return '<a href="#" class="badge badge-warning" style="font-size:15px;margin-top:5px">'+status+'</a>';
               }
               else if(status=="Paid"){
                return '<a href="#" class="badge badge-success" style="font-size:15px;margin-top:5px">'+status+'</a>';
               }
               else if(status=="Pending"){
                return '<a href="#" class="badge badge-primary" style="font-size:15px;margin-top:5px">'+status+'</a>';
               }
               else if(status=="Cancelled"){
                return '<a href="#" class="badge badge-danger" style="font-size:15px;margin-top:5px">'+status+'</a>';
               }
               else if(status=="In Progress"){
                return '<a href="#" class="badge badge-info" style="font-size:15px;margin-top:5px">'+status+'</a>';
               }


            }},
            


        ],
           order: [[0,'desc']],


          "footerCallback": function( tfoot, data, start, end, display ) {
           var api = this.api(), data;
           var intVal = function ( i ) {
               return typeof i === 'string' ?
                   i.replace(/[\$,]/g, '')*1 :
                   typeof i === 'number' ?
                       i : 0;
           };

        //    var amtTotal = api
        //        .column( 9 ,{ page: 'current'})
        //        .data()
        //        .reduce( function (a, b) {
        //            return intVal(a) + intVal(b);
        //        }, 0 );
        //    var amtTotal1 = api
        //        .column( 10 ,{ page: 'current'})
        //        .data()
        //        .reduce( function (a, b) {
        //            return intVal(a) + intVal(b);
        //        }, 0 );




        // $('#total').html("<span style='color:red'>"+Number((amtTotal).toFixed(1)).toLocaleString()+"</span>");
        // $('#tax').html("<span style='color:red'>"+Number((amtTotal1).toFixed(1)).toLocaleString()+"</span>");

           },







    });

      }


        $('#filter').click(function(){
          var from_date =$('#from_date').val();
          var to_date =$('#to_date').val();
          var status =$("#status:checked").val();
          var service=$("#service option:selected").val();

              $('#myTable').DataTable().destroy();
              load_data(from_date,to_date,status,service);
               get_total();




        });

        $('#refresh').click(function(){
            $('#from_date').val('');
            $('#to_date').val('');
            $("#status:checked").prop('checked', false);
            $('#myTable').DataTable().destroy();
            load_data();

       get_total();




        });


    });


</script>
<script>
 function getReceipt(id){
    $.ajax({
  url: "/getReceiptById/" + id,
  method:'GET',
  dataType:'json'
}).done(function(data) {
    $('#receiptID').val(data[0].receipt_id);
    $('#receipGenerated').val(data[0].created_at);
    $('#receiptInstrument').val(data[0].method);
    $('#selectedReceipt').val(data[0].id);
    $('#receiptBills').val(data[0].bills_id);
    $('#receiptJobs').val(data[0].jobs_number);
    $('#receiptNet').val(data[0].net);
    $('#receiptBillAmount').val(data[0].amount);
    $('#receiptSalesTax').val(data[0].sales_tax);
    $('#receiptTaxableAmount').val(data[0].taxable_amount);
    $('#receiptBankCharges').val(data[0].bank_charges);
    $('#receiptReceivedOn').val(data[0].receipt_date);
    $('#receiptDepositDate').val(data[0].deposit_date);
    $('#receiptDepositIn').val(data[0].bank_account);
    $('#receiptInstrumentNumber').val(data[0].instrument_number);
    $('#receiptInstrumentDate').val(data[0].instrument_date);
    $('#receiptSlipNo').val(data[0].slip_number);
    $('#receiptRemarks').val(data[0].remarks);
    $('#frame1').prop('src',data[0].client_copy);
    $('#frame2').prop('src',data[0].deposit_copy);

    var status=data[0].status;


    if(status=='Rejected' )
    {
        $('#approve').show();
        $('#reject').hide();
    }
    if(status=='Approved' )
    {
        $('#reject').show();
        $('#approve').hide();

    }

    if(status=='Pending' )
    {
        $('#reject').show();
        $('#approve').show();
    }

});

 }



</script>
<script>


       function get_total(){


           var from_date =$('#from_date').val();
          var to_date =$('#to_date').val();
          var service =$('#service option:selected').val();
          var status =$("#status:checked").val();
            $.ajax({
            url:"/getTotalofBill",
            type:'GET',
            data:{
                 from_date:from_date,
                 to_date:to_date,
                status:status,
                service:service 
            }
        }).done(function(data){
            console.log(data[0].total);
            $('#totalBill').html('Total : ' + data[0].total)
        });

       }
</script>
<script>

// function download_excel(){



// }

// $('#exceldownload').click(function(e){
//     e.preventDefault();
//     var from_date =$('#from_date').val();
// var to_date =$('#to_date').val();
// var service =$('#service option:selected').val();
// var status =$("#status:checked").val();
//  $.ajax({
//  url:"/getBillsExcel",
//  type:'POST',
//  data:{
//       from_date:from_date,
//       to_date:to_date,
//      status:status,
//      service:service 
//  }
// });

// });
</script>
<script>
function approveReceipt(){
    var rid=[];
    var bills=[];
    var receiptID=$('#selectedReceipt').val();
    var receiptBills=$('#receiptBills').val();

    rid.push(receiptID);
    bills.push(receiptBills);


    $.ajax({
  url: "/approveBill",
  method:'POST',
  data:{
      bills:bills,
      rid:rid,
      "_token": "<?php echo e(csrf_token()); ?>"

  }
}).done(function() {

    alert('Receipt Approved');
    $('#exampleModal').modal('hide');
    $('#myTable').DataTable().ajax.reload();

});

 }



 function rejectReceipt(){
    var rid=[];
    var bills=[];
    var receiptID=$('#selectedReceipt').val();
    var receiptBills=$('#receiptBills').val();

    rid.push(receiptID);
    bills.push(receiptBills);


    $.ajax({
  url: "/rejectBill",
  method:'POST',
  data:{
      bills:bills,
      rid:rid,
      "_token": "<?php echo e(csrf_token()); ?>"

  }
}).done(function() {

    alert('Receipt Approved');
    $('#exampleModal').modal('hide');
    $('#myTable').DataTable().ajax.reload();
});

 }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/Bill/bills.blade.php ENDPATH**/ ?>