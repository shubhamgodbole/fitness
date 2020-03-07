<?php
/*add_action( 'rest_api_init', function () {
  register_rest_route( 'myplugin/v1', '/author/(?P<id>\d+)', array(
    'methods' => 'GET',
    'callback' => 'my_awesome_func',
  ) );
} );*/

add_action( 'rest_api_init', function () {
    register_rest_route( 'myapi/v1', '/author/', array(
      'methods' => 'GET',
      'callback' => 'emp_list',
    ) );
  });
function emp_list()
{
?>

	<br><br><br>
	<div class="container">
    	<div><a class="btn btn-primary" style="float:right" href="<?php echo admin_url('/admin.php?page=Equipment_Insert') ?>"> Add New </a> </div>
    	<br><br>
	<table class="table" id="myTable">
		<thead>
			<tr>
				<th>Excercise</th>
				<th>Category</th>	
				<th>Sub Category</th>
				<th>Difficulty Level</th>
				<th>Equipments</th>
				<th>Streches</th>
				<th>Media</th>
			</tr>
		</thead>
		<?php
			global $wpdb;
		 	$table_name = $wpdb->prefix . 'custom_equipment';
		 	$result = $wpdb->get_results("SELECT * from $table_name");
		 	foreach ($result as $res) {
                $edit_url=admin_url('/admin.php?page=Employee_Update&id='.$res->id);
		 		echo "<tr>
		 				<td>$res->excercise</td>
		 				<td>$res->category</td>
		 				<td>$res->sub_category</td>
		 				<td>$res->difficulty_level</td>
		 				<td>$res->equipments</td>
		 				<td>$res->streches</td>
		 				<td><img src=../wp-content/uploads/2018/10/$res->media height=50 width=50></td>
		 		</tr>";
		 	}
  			return $response = new WP_REST_Response($result);
	?>
<tfoot>
		<tr>		
			<th>Excercise</th>
			<th>Category</th>	
			<th>Sub Category</th>
			<th>Difficulty Level</th>
			<th>Equipments</th>
			<th>Streches</th>
			<th>Media</th>
		</tr>
	</tfoot>


</table>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	    $('#myTable').DataTable();
	});
</script>
<?php
}