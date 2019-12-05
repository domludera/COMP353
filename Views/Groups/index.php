<form action="/groups/create/" method="get">
    <button type="submit" class="btn btn-primary">Create Group</button>
</form>

<hr/>
<h1>My Groups</h1>



<?php if($groups && count($groups) > 0): ?>

    <table class="table table-dark">
        <thead>
        <tr>
            <th>Id</th>
            <th>Group Name</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($groups as $key => $value): ?>
            <tr>
                <td><a href="/groups/show/<?= $value["group_id"]?>"><?= $value["group_id"]?></a></td>
                <td><?= $value["name"]?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>


<!-- No Mail Pending -->
<?php if(!$groups || count($groups) == 0) : ?>
    You haven't joined any groups yet!
<?php endif; ?>

<form action="/groups/join/" method="get">
    <button type="submit" class="btn btn-primary">Join Group</button>
</form>

