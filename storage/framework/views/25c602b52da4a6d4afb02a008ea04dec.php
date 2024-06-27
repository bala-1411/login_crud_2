<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2> Show Role</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="<?php echo e(route('roles.index')); ?>"> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            <?php echo e($role->name); ?>

        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Permissions:</strong>

            <?php if($role->name == 'admin'): ?>
                <label class="label label-success">Manage Users, Manage Roles and Manage Products</label>
            <?php elseif($role->name == 'editor'): ?>
                <label class="label label-success">Manage Users and Manage Products</label>
            <?php else: ?>    
                <label class="label label-success">Manage Products</label>
            <?php endif; ?>                
                
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel-11-User-Roles-and-Permissions-main\resources\views/roles/show.blade.php ENDPATH**/ ?>