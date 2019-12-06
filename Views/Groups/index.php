<h1 class="h3 mb-2 text-gray-800">My Groups</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">All Groups</h6>
  </div>
  <p></p>
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <div class="col-md-12">
          <form action="/groups/create/" method="get">
            <button type="submit" class="btn btn-primary">Create Group</button>
          </form>
        </div>
      </div>
    </div><?php if($groups && count($groups) > 0): ?>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Id</th>
              <th>Group Name</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($groups as $key => $value): ?>
            <tr>
              <td>
                <a href="/groups/show/<?= $value["group_id"]?>"><?= $value["group_id"]?></a>
                </a>
              </td>
              <td><?= $value["name"]?>
              </td>
            </tr><?php endforeach; ?>
          </tbody>
        </table><?php endif; ?><!-- No Mail Pending -->
        <?php if(!$groups || count($groups) == 0) : ?>You haven't joined any groups yet! <?php endif; ?>
        <table>
          <tfoot>
            <tr>
              <th>Id</th>
              <th>Group Name</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</div>
