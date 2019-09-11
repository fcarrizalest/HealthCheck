
<div class="container">
<ul class="list-group">
<?php foreach($rows as $row): ?>
	<?php $checksList = $row->getCheckList();  ?>
	<?php 
		if( empty( $checksList ) ){
			continue;
		}
	?>
	<li   class="list-group-item"> <label> <input class="parentCheck" type="checkbox" /> <?= $row->getName() ?> </label> 
		<ul id="<?= $row->getId() ?>" class="list-group ">
			<?php foreach($checksList as $check): ?>

			<li class="list-group-item"> <label> <input class="check" id="<?= $check->getId() ?>" type="checkbox" /><?= $check->getName() ?> </label> </li>
			<?php endforeach;?>
			
		</ul>
	</li>
<?php endforeach;?>

</ul>

<button id="runtest" class="btn btn-primary" >Run Test</button>


<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div id="result">
		</div>
	</div>
</div>
</div>