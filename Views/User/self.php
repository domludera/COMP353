<h1 class="h3 mb-2 text-gray-800">My Profile</h1><!-- DataTales Example -->
<div id="ProfilePage">
    <div id="Photo">User Photo</div>

    <div id="Info">
        <p>
            <strong>Name:</strong>
            <span><?= $user['name']?></span>
        </p>
        <p>
            <strong>Email:</strong>
            <span><?= $user['email']?></span>
        </p>
        <p>
            <strong>Birth Date:</strong>
            <span><?= $user['dob']?></span>
        </p>
        <p>
            <strong>Region:</strong>
            <span><?= $user['region']?></span>
        </p>
        <p>
            <strong>Profession:</strong>
            <span><?= $user['profession']?></span>
        </p>
    </div>

</div>