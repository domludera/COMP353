<h1 class="h3 mb-2 text-gray-800">My Profile</h1><!-- DataTales Example -->
<hr>
<form action="/users/edit/" method="get">
    <button type="submit" style="right-side" class="btn btn-primary"><i class="fas fa-user-edit"></i>&nbsp; Edit profile</button>    
</form>

<br>
<br>
<div id="ProfilePage">
    <div id="Photo">User Photo
        <hr>
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="<?= "/uploads/" . $user['image'] ?>" alt="<?= $user['name'] ?>">            
        </div>
    </div>

    <div id="Info">
        <br>
        <p>
            <strong>Name:</strong>
            <span><?= $user['name'] ?></span>
        </p>
        <p>
            <strong>Email:</strong>
            <span><?= $user['email'] ?></span>
        </p>
        <p>
            <strong>Birth Date:</strong>
            <span><?= $user['dob'] ?></span>
        </p>
        <p>
            <strong>Region:</strong>
            <span><?= $user['region'] ?></span>
        </p>
        <p>
            <strong>Profession:</strong>
            <span><?= $user['profession'] ?></span>
        </p>
        <p>
            <strong>Update at:</strong>
            <span><?= $user['updated_at'] ?></span>
        </p>        
    </div>

</div>