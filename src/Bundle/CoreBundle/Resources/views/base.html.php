<!DOCTYPE html>
<html class="no-js" lang="">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="icon" type="image/x-icon">
    <link href="<?= $view['assets']->getUrl('css/demo_table.css') ?>" rel="stylesheet" type="text/css" />

    <script src="<?= $view['assets']->getUrl('js/jquery-1.6.2.min.js') ?>"></script>
    <script src="<?= $view['assets']->getUrl('js/jquery.dataTables.min.js') ?>"></script>
    <script src="<?= $view['assets']->getUrl('js/app.js') ?>"></script>
    <script>
    $(document).ready( function () {
            $('.display').dataTable();
    } );
</script>

</head>
<body data-controller="<?=$view['request']->getParameter('controllerName');?>" data-method="<?=$view['request']->getParameter('methodName');?>">
	
    <? $view['slots']->output('_content') ?>
</body>
</html>
