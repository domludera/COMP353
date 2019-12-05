<h1 class="h3 mb-2 text-gray-800">My Mail</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Inbox</h6>
  </div>
  <form action="/mails/create/" method="get">
    <button type="submit" style="right-side" class="btn btn-primary">New Mail</button>
  </form>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Id</th>
            <th>From (user Id)</th>
            <th>Subject</th>
          </tr>
        </thead><?php if($mails && count($mails) > 0) : ?>
        <tbody>
          <?php foreach($mails as $key => $value): ?>
          <tr>
            <td>
              <a href="/mails/show/<?= $value["id"]?>"><?= $value["id"]?>
              </a>
            </td>
            <td><?= $value["from_user_id"]?>
            </td>
            <td><?= $value["subject"]?>
            </td>
          </tr><?php endforeach; ?>
        </tbody><?php endif; ?>
        <tfoot>
          <tr>
            <th>Id</th>
            <th>From (user Id)</th>
            <th>Subject</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
