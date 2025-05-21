<<?php $this->load->view("partial/header"); ?>
	
	<?php if ($this->session->flashdata('success')) { ?>
	<script>
	show_feedback('success', <?php echo json_encode($this->session->flashdata('success')); ?>, <?php echo json_encode(lang('common_success')); ?>);
	</script>
	<?php } ?>
	
	<div class="row">
		<div class="col-md-12">
			<p>Container sale</p>
		</div>
<script type="text/javascript">
</script>
<?php $this->load->view("partial/footer"); ?>