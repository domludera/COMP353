<h1 class="h3 mb-2 text-gray-800">My Mail</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Inbox</h6>
  </div>
  <p></p>
<div class="container">
      <div class="col-xs-6">
        <div class="col-md-12">
		  <form action="/mails/create/" method="get">
    <button type="submit" style="right-side" class="btn btn-primary">New Mail</button>
  </form>
  </div>
      </div>
<div class="card-body">
    <div class="table-responsive">
        <?php if($mails && count($mails) > 0) : ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <colgroup>
              <col span="1" style="width: 10%;">
              <col span="1" style="width: 90%;">
          </colgroup>
          <thead>
          <tr>
              <th>From (user Id)</th>
            <th>Subject</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($mails as $key => $value): ?>
          <tr>
            <td><?= $value["from_user_id"]?>
            </td>
            <td>
                <a href="/mails/show/<?= $value["id"]?>">
                <?= $value["subject"]?>
                </a>
            </td>
          </tr><?php endforeach; ?>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
          <?php else : ?>
              <p> You have no mail </p>
        <?php endif; ?>
    </div>
  </div>
</div>
