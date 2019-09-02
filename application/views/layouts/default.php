<!DOCTYPE html>
<html>

<head>
  <?php $this->load->view('includes/head') ?>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
  <div class="wrapper">

    <header class="main-header">
      <?php $this->load->view('includes/header') ?>
    </header>
    <aside class="main-sidebar">
      <?php $this->load->view('includes/aside') ?>
    </aside>

    <div class="content-wrapper">
      <section class="content-header">
        <h1>
          <?php echo $header ?>
          <small><?php echo $description ?></small>
        </h1>
        <ol class="breadcrumb">
          <?php foreach ($breadcrumb as $key => $value) : ?>
            <li <?php echo ($value['is_active'] == true ? 'class="active"' : '') ?>><a href="<?php echo ($value['target'] != null ? $value['target'] : 'javascript:void(0)') ?>"><?php echo ($value['icon'] != null ? '<i class="' . $value['icon'] . '"></i>' : '') ?> <?php echo $value['text'] ?></a></li>
          <?php endforeach ?>
        </ol>
      </section>

      <section class="content container-fluid">

        <?php $this->load->view('pages/' . $pages) ?>

      </section>
    </div>


    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        CC
      </div>
      <strong>Copyright &copy; 2016 <a href="#">Company</a>.</strong> All rights reserved.
    </footer>

    </div>

    <?php $this->load->view('includes/foot') ?>

</body>

</html>