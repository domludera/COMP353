<div class="row" style="width:100%">
  <div class="col-md-6 col-sm-12">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Inbox</h5>
        <p class="card-text">Mail client</p><a href="/mails" class="btn btn-primary">Proceed</a>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-sm-12">
	<div class="card" style="width: 18rem;">
		<div class="card-body">
			<h5 class="card-title">Groups</h5>
			<p class="card-text">My Groups</p>
			<a href="/groups" class="btn btn-primary">View</a>
		</div>
	</div>
	</div>
  <div class="col-md-6 col-sm-12">
    <div class="card" style="width: 18rem;">
      <div class="card-body">
        <h5 class="card-title">Events</h5>
        <p class="card-text">Upcomming Events</p>
		<?php foreach($currentEvents as $key => $value): ?>
			<a href="/events/show/<?= $value["id"]?>">
				<strong><?= $value["name"]?></strong>
			</a>
			<?= $value["start_at"]?>
		<p></p>
		<?php endforeach; ?>
		<a href="/events" class="btn btn-primary">All Events</a>
      </div>
    </div>
  </div>
</div>

