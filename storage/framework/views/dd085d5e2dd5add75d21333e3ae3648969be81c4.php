<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> Invoice</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
        rel="stylesheet">
  <link href="<?php echo e(asset('css/font-awesome.min.css')); ?>" rel="stylesheet" type="text/css"/> <!-- fontawsome css -->
  <!-- Admin (main) Style Sheet -->
  <link rel="stylesheet" href="<?php echo e(asset('css/admin.css')); ?>">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<!-- Main content -->

<?php if(isset($invoice) && $invoice != null): ?>
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> <?php echo e($w_title); ?>

        <small class="pull-right"><?php echo e(date("d/m/Y", $invoice->created)); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong><?php echo e($w_title); ?></strong><br>
        <?php echo e($invoice_add); ?>

        Email: <?php echo e($w_email); ?>

      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong><?php echo e(auth()->user()->name); ?></strong><br>
        Email: <?php echo e(auth()->user()->email); ?>

      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Invoice #<?php echo e($invoice->id); ?></b><br>
      <br>
      <b>Order ID:</b> <?php echo e($invoice->number); ?><br>
      <b>Payment Due:<?php echo e($invoice->paid == true ? 'N/A' : 'DUE'); ?></b><br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>Package Name</th>
          <th>Method</th>
          <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td><?php echo e(auth()->user()->name); ?></td>
          <td>
            <?php
              $plan = App\Package::where('plan_id',$invoice->lines->data[0]->plan->id)->first();
            ?>
            <?php echo e(ucfirst($plan->name)); ?></td>
          <td>Stripe</td>
          <td><?php echo e(strtoupper($currency_code)); ?> <?php echo e($invoice->lines->data[0]->plan->amount/100); ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Methods:</p>
      <img src="<?php echo e(asset('images/credit/visa.png')); ?>" alt="Visa">
      <img src="<?php echo e(asset('images/credit/mastercard.png')); ?>" alt="Mastercard">
      <img src="<?php echo e(asset('images/credit/american-express.png')); ?>" alt="American Express">
      <img src="<?php echo e(asset('images/credit/paypal2.png')); ?>" alt="Paypal">

      <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
        dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
      </p>
    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <div class="table-responsive">
        <h2 style="margin-top: 100px"> Total Amount: <?php echo e(strtoupper($currency_code)); ?> <?php echo e($invoice->lines->data[0]->plan->amount/100); ?></h2>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<?php elseif(isset($paypal_sub) && $paypal_sub != null): ?>
<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> <?php echo e($company_name); ?>

        <small class="pull-right"><?php echo e($paypal_sub->created_at->toDateString()); ?></small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
      From
      <address>
        <strong><?php echo e($company_name); ?></strong><br>
        <?php echo e($invoice_add); ?>

        Email: <?php echo e($w_email); ?>

      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      To
      <address>
        <strong><?php echo e(auth()->user()->name); ?></strong><br>
        Email: <?php echo e(auth()->user()->email); ?>

      </address>
    </div>
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
      <b>Invoice #<?php echo e($paypal_sub->id); ?></b><br>
      <br>
      <b>Order ID:</b> <?php echo e($paypal_sub->payment_id); ?><br>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive">
      <table class="table table-striped">
        <thead>
        <tr>
          <th>#</th>
          <th>User Name</th>
          <th>Package Name</th>
          <th>Method</th>
          <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>1</td>
          <td><?php echo e(auth()->user()->name); ?></td>
          <td><?php echo e($paypal_sub->plan->name); ?></td>
          <td><?php echo e($paypal_sub->method); ?></td>
          <td><?php echo e(strtoupper($currency_code)); ?> <?php echo e($paypal_sub->price); ?></td>
        </tr>
        </tbody>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <div class="row">
    <!-- accepted payments column -->
    <div class="col-xs-6">
      <p class="lead">Payment Methods:</p>
      <img src="<?php echo e(asset('images/credit/visa.png')); ?>" alt="Visa">
      <img src="<?php echo e(asset('images/credit/mastercard.png')); ?>" alt="Mastercard">
      <img src="<?php echo e(asset('images/credit/american-express.png')); ?>" alt="American Express">
      <img src="<?php echo e(asset('images/credit/paypal2.png')); ?>" alt="Paypal">


    </div>
    <!-- /.col -->
    <div class="col-xs-6">
      <div class="table-responsive">
        <h2 style="margin-top: 100px"> Total Amount: <?php echo e(strtoupper($currency_code)); ?> <?php echo e($paypal_sub->price); ?></h2>
      </div>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
</section>
<?php endif; ?>

<!-- /.content -->
<div class="clearfix"></div>
<!-- ./wrapper -->
<script src="<?php echo e(asset('js/jquery.min.js')); ?>" type="text/javascript"></script>
<script src="<?php echo e(asset('js/admin.js')); ?>" type="text/javascript"></script>
</body>
</html>
<?php /**PATH D:\xampp\htdocs\tv\resources\views/user/invoice.blade.php ENDPATH**/ ?>