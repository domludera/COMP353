<h1 class="h3 mb-2 text-gray-800">Bill</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Information</h6>
    </div>
        <div class="card-body">
        <div class="table-responsive">
						
						
		        <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
                <thead>
                    <tr>
						<th>Bill Number</th>
						<th>Starting Period</th>
						<th>Ending Period</th>
						<th>Total</th>
                    </tr>
                </thead>
               	<tbody>
					<tr>
						<td width="5%"><?= $bills["id"]?></td>
						<td width="5%"><?= $bills["start_at"]?></td>
						<td width="5%"><?= $bills["end_at"]?></td>
						<td width="5%"><?= $bills["total"]?></td>
					</tr>
				</tbody>
				</table>
			 <div class="card-body">
				<div class="table-responsive">		
		        <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">				
					<thead>
                    <tr>
                        <th>Resource</th>
                        <th>Rate</th>
                    </tr>
                </thead>
                <?php if ($eventResources && count($eventResources) > 0) : ?>
				<tbody>
					<?php foreach ($eventResources as $key => $eventResource): ?>
						<tr>
							<td width="10%"><?= $eventResource["resource_name"] ?></td>
							<td width="10%"><?= $eventResource["rate"] ?> </td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<?php endif; ?>
				
            </table>
        </div>
    </div>
</div>
