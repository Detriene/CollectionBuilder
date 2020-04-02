<div class ="container-fluid">
<div class ="text-center">
<?= form_open_multipart('AddItem/add', 'class="input-group mb-3"') ?>
<?= form_fieldset("Add Item") ?>

<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Item Name:</span>
	<?= form_input(array('name' => 'name',
	'id' => 'name', 'value' => $itemname, 'required' => 'required', 'class' => 'form-control')); ?> <br>
</div>
 
<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Description</span>
	<?= form_input(array('name' => 'description',
	'id' => 'description', 'required' => 'required', 'class' => 'form-control')); ?> <br>
</div>
 
<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Year:</span>
	<?= form_input(array('name' => 'year',
	'id' => 'year', 'type' => 'number', 'class' => 'form-control')); ?> <br>
</div>
 
<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Condition</span>
	<?= form_input(array('name' => 'condition',
	'id' => 'condition', 'class' => 'form-control')); ?> <br>
</div>
 
<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Owned</span>
	<?= form_input(array('name' => 'owned',
	'id' => 'owned', 'type' => 'checkbox','value' => 1, 'class' => 'form-control')); ?> <br><br>
</div>
 
<div class="input-group-prepend">
	<span class="input-group-text" id="inputGroup-sizing-default">Photo:</span>
	<?= form_input(array('name' => 'photo',
	'id' => 'photo', 'type' => 'file', 'class' => 'form-control')); ?> 
</div><br>
 
<?= form_submit('submit', 'Submit'); ?>
<?= form_fieldset_close(); ?>
<?= form_close() ?>
</div>
</div>



<script>
$(document).ready(function(){
	$('#photo').change(function(){
			var extension = $('#photo').val().split('.').pop().toLowerCase();
			if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
			{
				alert('Invalid Image File');
				$('#photo').val('');
				return false;
			}
	});
});
</script>

