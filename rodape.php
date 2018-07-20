<footer class="text-white">
    <div class="text-center bg-primaria py-3">
        <p class="mb-0"><b>CRUDE</b> © 2018. Desenvolvido por João Marcos.</p>
    </div>
</footer>
<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery.validate.js"></script>
<?php if(@$script){?>
<script defer>
$(function(){	
	<?=@$script?>
});
</script>
<?php }?>
</body>
</html>