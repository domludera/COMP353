<?php
require_once(ROOT . 'Models/Event.php');
$eventManager = new Event();
$id = $_SESSION['user'];

require_once(ROOT . 'Models/User.php');
$currentUser = new User();

?>

<h1>Event Details</h1>
<div class="form-group">
  <label for="name">Name</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["name"]?>" disabled/>
</div>

<div class="form-group">
  <label for="name">Manager</label> <input type="text" class="form-control" id="manager" name="manager" placeholder="<?= $event["manager_email"]?>" disabled/>
</div>

<div class="form-group">
  <label for="name">Event Type</label> <input type="text" class="form-control" id="name" name="name" placeholder="<?= $event["type"]?>" disabled/>
</div>
<div class="form-group">
  <label for="start">Start Date:</label> <input type="text" class="form-control" id="content" name="start" placeholder="<?= $event["start_at"]?>" disabled/>
</div>
<div class="form-group">
  <label for="end">End Date:</label> <input type="text" class="form-control" id="content" name="end" placeholder="<?= $event["end_at"]?>" disabled required/>
</div>
<div class="form-group">
  <label for="end">Reoccuring</label> <?php if($event["reoccuring"]) : ?>
    <input id="id" type="checkbox" name="reoccuring" checked="checked" disabled="disabled" />
  <?php endif; ?>
  <?php if(!$event["reoccuring"]) : ?>
      <input id="id" type="checkbox" name="reoccuring" disabled="disabled" />
  <?php endif; ?>
</div>
<hr>

<h2>Event Groups</h2>

<?php if($eventManager->isAttending($event["id"],$id)) : ?>
  <a class="btn btn-primary col-12" href="/groups/create/<?= $event["id"]?>" role="button">New</a>
<?php endif; ?>
<p></p>
<ul class="list-group">
  <?php foreach($groups as $key => $group): ?>
    <a href="/groups/show/<?= $group["id"]?>"><li class="list-group-item"><?= $group["name"]?></li></a>
  <?php endforeach; ?>
</ul>

<hr>

<h2>Attendees</h2>
<ul class="list-group">
  <?php foreach($attendees as $key => $user): ?>
    <li class="list-group-item"><?= $user["email"]?></li> 
  <?php endforeach; ?>
</ul>

<hr>

<?php if($currentUser->isController($id) || $currentUser->isAdmin($id)) : ?>

<h2>Event Resources</h2>
<div class="card shadow mb-4">
	<div class="card-header py-3">
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
						<?php foreach($eventResources as $key => $eventResource): ?>
							<tr>
								<td width="25%"><?= $eventResource["resource_name"]?>
								</td>
								<td width="5%">
									<?= $eventResource["rate"]?>                                   
								</td>
							</tr><?php endforeach; ?>
					</tbody>
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>
<hr>

<h2>Billing</h2>
<div class="card shadow mb-4">
	<div class="card-header py-3">
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
				<?php if ($billedEventResources && count($billedEventResources) > 0) : ?>
				<tbody>
					<?php foreach($billedEventResources as $key => $billedEventResource): ?>
						<tr>
							<td width="5%"><a href="/bills/show/<?= $billedEventResource["bill_id"]?>"><?= $billedEventResource["bill_id"]?></td></a>
							<td width="5%"><?= $billedEventResource["start_at"]?></td>
							<td width="5%"><?= $billedEventResource["end_at"]?></td>
							<td width="5%"><?= $billedEventResource["total"]?></td>
						</tr>
					<?php endforeach; ?>
				</tbody> 
				<?php endif; ?>
			</table>
		</div>
	</div>
</div>



<?php endif; ?>