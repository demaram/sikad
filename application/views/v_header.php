<!doctype html>
<html lang="en" class="fullscreen-bg">
<head>
	<title><?=$title?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<!-- CSS -->
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/vendor/icon-sets.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/main.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">

<!--JAVASCRIPT-->
	<script type="text/javascript" src="<?=base_url()?>/assets/plugins/tinymce/js/tinymce/tinymce.min.js"></script>

<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>


<script type="text/javascript">
tinymce.init({
     selector: '.tinymce',
     height: 200,
     theme: 'modern',
     plugins: [
          'advlist autolink lists link image charmap print preview hr anchor pagebreak',
          'searchreplace wordcount visualblocks visualchars code fullscreen',
          'insertdatetime media nonbreaking save table contextmenu directionality',
          'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
     ],
     toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
     toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
     image_advtab: true,
     templates: [
     { title: 'Test template 1', content: 'Test 1' },
     { title: 'Test template 2', content: 'Test 2' }
     ],
     content_css: [
     '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
     '//www.tinymce.com/css/codepen.min.css'
     ]
});
</script>
