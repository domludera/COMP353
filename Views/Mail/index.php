

<form action="/mail/create/" method="get">
    <button type="submit" class="btn btn-primary">New Mail</button>
</form>

<hr/>
<h1> My Mail </h1>

<!-- Have Mail Pending -->
<?php if($mails && count($mails) > 0) : ?>
<table class="table table-dark">
  <thead>
    <tr>
        <th>From</th>
        <th>Subject</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($mails as $key => $value): ?>
        <tr>
            <td><a href="/mail/<?= $value["id"]?>"><?= $value["from_user_id"]?></a></td>
            <td><?= $value["subject"]?></td>
        </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php endif; ?>


<!-- No Mail Pending -->
<?php if(!$mails || count($mails) == 0) : ?>
    Nothing in your inbox!
<?php endif; ?>


