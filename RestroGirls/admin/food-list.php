<?php require('layout/header.php'); ?>
<?php require('layout/left-sidebar-long.php'); ?>
<?php require('layout/topnav.php'); ?>
<?php require('layout/left-sidebar-short.php'); ?>


<?php
require('../backends/connection-pdo.php');
$sql = 'SELECT food.id, food.fname, food.description, categories.name
        FROM food
        LEFT JOIN categories
        ON food.cat_id = categories.id';
$query  = $pdoconn->prepare($sql);
$query->execute();
$arr_all = $query->fetchAll(PDO::FETCH_ASSOC);

?>
						

<div class="section white-text" style="background: #B35458;">

	<div class="section">
		<h3>Foods</h3>
	</div>

  <?php

    if (isset($_SESSION['msg'])) {
        echo '<div class="section center" style="margin: 5px 35px;"><div class="row" style="background: red; color: white;">
        <div class="col s12">
            <h6>'.$_SESSION['msg'].'</h6>
            </div>
        </div></div>';
        unset($_SESSION['msg']);
    }

    ?>

	<div class="section right" style="padding: 15px 25px;">
		<a href="food-add.php" class="waves-effect waves-light btn">Add New</a>
	</div>
	
	<div class="section center" style="padding: 20px;">
		<table class="centered responsive-table">
        <thead>
          <tr>
              <th>Name</th>
              <th>Description</th>
              <th>Category</th>
              <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$database = "mishtidb";
			$conn = new mysqli($servername, $username, $password, $database);
			if ($conn->connect_error) 
			{
				die("Connection failed: " . $conn->connect_error);
			}
			$per_page_record = isset($_POST["limit-records"]) ? $_POST["limit-records"] : 3;
			$page = isset($_GET['page']) ? $_GET['page'] : 1;
			if ($page > 0)
			{
				$start = ($page - 1) * $per_page_record;
				$result = $conn->query("SELECT food.id, food.fname, 
							food.description, categories.name
							FROM food LEFT JOIN categories
							ON food.cat_id = categories.id
							LIMIT $start, $per_page_record");
				$allRecords = $result->fetch_all(MYSQLI_ASSOC);
				$result1 = $conn->query("SELECT count(id) AS id FROM food");
				$totalRecords = $result1->fetch_all(MYSQLI_ASSOC);
				
				$total = $totalRecords[0]['id'];
				$pages = ceil( $total / $per_page_record );
				$Previous = $page - 1;
				$Next = $page + 1;
				$query = "SELECT COUNT(*) FROM food";     
				$rs_result = mysqli_query($conn, $query);     
				$row = mysqli_fetch_row($rs_result);     
				$total_records = $row[0];     
				$total_pages = ceil($total_records / $per_page_record);
			}
			mysqli_close($conn);
			if ($page > 0) 
			{
					foreach($allRecords as $columnName) :  
			?>
		        		<tr>
		        			<td><?= $columnName['fname']; ?></td>
		        			<td><?= $columnName['description']; ?></td>
		        			<td><?= $columnName['name']; ?></td>
							<td>
<a href="../backends/admin/food-delete.php?id=<?php echo $columnName['id']; ?>"><span class="new badge" data-badge-caption="">Delete</span></a></td>
		        		</tr>
	        <?php endforeach; }?>
          		
        </tbod>
		<h5>
		<?php if ($page >= 2) {?>
			  <a href="food-list.php?page=<?= $Previous; ?>" aria-label="Previous">
				<span aria-hidden="true">&laquo; Previous</span>
			  </a>
			<?php } ?>
		    <?php for($i = 1; $i<= $pages; $i++) : ?>
		    	&nbsp;&nbsp;
				<a href="food-list.php?page=<?= $i; ?>"><?= $i; ?></a>
				&nbsp;&nbsp;
		    <?php endfor; ?>
				    
			<?php if($page < $total_pages) {?>
		      <a href="food-list.php?page=<?= $Next; ?>" aria-label="Next">
		        <span aria-hidden="true">Next &raquo;</span>
		      </a>
		    <?php } ?>
      </table>
	</div>
</div>

<?php require('layout/about-modal.php'); ?>
<?php require('layout/footer.php'); ?>