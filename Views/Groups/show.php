<h1>Group</h1>
<form action="/groups/create" method="post">


    <?php if($event) : ?>
        <div class="form-group">
            <label for="text">Parent Event</label>
            <input type="text" class="form-control" id="name" name="owner" placeholder="<?=$event["name"]?>" required disabled>
            <a href="/events/show/<?=$event["id"]?>">Link to event</a>
        </div>
    <?php endif; ?>

    <div class="form-group">
        <label for="text">Owner</label>
        <input type="text" class="form-control" id="name" name="owner" placeholder="<?=$group["owner"] ?>" required disabled>
    </div>

    <div class="form-group">
        <label for="text">Group name</label>
        <input type="text" class="form-control" id="name" name="groupname" placeholder="<?=$group["name"] ?>" required disabled>
    </div>

    <hr>
    
    <h2>Members</h2>
    <ul class="list-group">
    <?php foreach($members as $key => $user): ?>
        <li class="list-group-item"><?= $user["email"]?></li> 
    <?php endforeach; ?>
</ul>
</form>