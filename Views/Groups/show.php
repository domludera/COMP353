<?php
require_once(ROOT . 'Models/User.php');
require_once(ROOT . 'Models/Group.php');
$user = new User();
$groupManager = new Group();
$id = $_SESSION['user'];
?>

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


    
    <?php if(!$groupManager->isMembers($group["id"],$id)) : ?>
    <hr>
        <?php if(!$groupManager->hasPendingRequest($group["id"],$id)) : ?>
            <a class="btn btn-primary col-12" href="/groups/request/<?= $group["id"]?>" role="button">Request Join</a>
        <?php else: ?>
            <div class="form-group text-center">
                <h3>Your request is pending</h3>
                <a class="btn btn-warning col-12" href="/groups/cancel/<?= $group["id"]?>" role="button">Request Cancel</a>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if($groupManager->isOwner($group["id"],$id)) : ?>

    <hr>
        <?php

        echo "<iframe src=\"https://kiwiirc.com/client/irc.kiwiirc.com/#com353SCCgroup" . $group["id"] . "\"" . " style=\"border:0; width:100%; height:450px;\"></iframe>";
        ?>
    <hr>
        <div class="form-group text-center">    
       <h3>Pending Requests</h3>
       <ul class="list-group">
        <?php foreach($requests as $key => $request): ?>
            <li class="list-group-item">
                <?= $request["email"]?>
                <a class="btn btn-success" href="/groups/approve/<?= $group["id"]?>/<?= $request["user_id"]?>" role="button">approve</a>
                <a class="btn btn-danger" href="/groups/deny/<?= $group["id"]?>/<?= $request["user_id"]?>" role="button">deny</a>
            </li> 
        <?php endforeach; ?>
        </ul>
        </div>
    <?php endif; ?>
<hr>
    <h2>Members</h2>
    <ul class="list-group">
    <?php foreach($members as $key => $user): ?>
        <li class="list-group-item"><?= $user["email"]?></li> 
    <?php endforeach; ?>
    </ul>
</form>