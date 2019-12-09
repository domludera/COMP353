<hr />
<h1>Managing Events</h1><!-- Have Mail Pending -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Active</h6>
  </div><?php if($events && count($events) > 0) : ?>
  <div class="card-body">
    <div class="row no-gutters align-items-center">
      <div class="col mr-2">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                    <a href="/events/show/<?=$value['id']?>"><?= $value["id"]?>
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
              <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Start</th>
                  <th>End</th>
                </tr>
              </tfoot>
            </table><?php endif; ?><!-- No Mail Pending -->
            <?php if(!$events || count($events) == 0) : ?>No events! <?php endif; ?>
          </div>
      </div>
    </div>
  </div>
</div>