<?php
require_once(ROOT . 'Models/User.php');
$user = new User();
$id = $_SESSION['user'];
?>
<?php if ($user->isAdmin($id)) : ?>
    <form action="/events/create/" method="get">
        <button type="submit" class="btn btn-primary">New Event</button>
    </form>
    <p></p>
<?php endif; ?>
<hr />

<h1>Attending Events</h1><!-- Active Events -->
<div class="row">
    <?php if ($events && count($events) > 0): ?>
        <div class="col-xl-6 col-md-6 mb-4">
		
            <div class="card border-left-success shadow h-100 py-2">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Active</h6>
			</div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <ul class="nav-item active">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Start</th>
                                                <th>End</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($events as $key => $value): ?>
                                                <tr>
                                                    <td>
                                                        <a href="/events/show/<?= $value['id'] ?>"><?= $value["id"] ?> </a>
                                                    </td>
                                                    <td><?= $value["name"] ?>
                                                    </td>
                                                    <td><?= $value["start_at"] ?>
                                                    </td>
                                                    <td><?= $value["end_at"] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                <?php endif; ?>
                                <!-- No Active Events -->
                                <?php if (!$events || count($events) == 0): ?>No active events! 
                                <?php endif; ?>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php if ($events && count($events) > 0): ?>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Archived</h6>
			</div>
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <ul class="nav-item active">
                                <div class="table-responsive">
                                    <table class="table table-bordered dataTable"  width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Start</th>
                                                <th>End</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($archivedEvents as $key => $value): ?>
                                                <tr>
                                                    <td>
                                                        <a href="/events/show/<?= $value['id'] ?>"><?= $value["id"] ?> </a>
                                                    </td>
                                                    <td><?= $value["name"] ?>
                                                    </td>
                                                    <td><?= $value["start_at"] ?>
                                                    </td>
                                                    <td><?= $value["end_at"] ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>
                                    <!-- No archived Events -->
                                    <?php if (!$events || count($events) == 0): ?>No archived events! 
                                    <?php endif; ?>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

        </div>
    </div>
