<form action="/event/create/" method="get">
  <button type="submit" class="btn btn-primary">New Event</button>
</form>
<hr />
<h1>All events</h1><!-- Have Mail Pending -->
<?php if($events && count($events) > 0) : ?>
<table class="table table-dark">
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Start</th>
      <th>End</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($events as $key => $value): ?>
    <tr>
      <td>
        <a href="/event/show/<?=$value['id']?>"><?= $value["id"]?>
        </a>
      </td>
      <td><?= $value["name"]?>
      </td>
      <td><?= $value["start_at"]?>
      </td>
      <td><?= $value["end_at"]?>
      </td>
    </tr><?php endforeach; ?>
  </tbody>
</table><?php endif; ?><!-- No Mail Pending -->
<?php if(!$events || count($events) == 0) : ?>No events! <?php endif; ?>
