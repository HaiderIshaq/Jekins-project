<!DOCTYPE html>
<html>
<head>
	<?php echo $__env->make('layouts.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</head>

      
          

<title><?php echo $__env->yieldContent('title','KGT ERP '); ?></title>
<body>
	<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    

	
<div class="main-container">
    <div class="pd-ltr-20  customscroll-10-p height-100-p xs-pd-20-10">
  
    <?php echo $__env->yieldContent('content'); ?>
	<?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	
	</div>
</div>

		<?php if(Request::path() != '/home'): ?>
			<script src="<?php echo e(asset('js/app.js')); ?>"></script>
		<?php endif; ?>
		<script src="<?php echo e(asset('js/script.js')); ?>"></script>
	
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
		<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>    
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>    
        <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>    



</body>
</html>
<?php /**PATH C:\xampp\htdocs\kgt-erp\resources\views/layouts/app.blade.php ENDPATH**/ ?>