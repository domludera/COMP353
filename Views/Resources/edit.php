<h1 class="h3 mb-2 text-gray-800">System Resources</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All</h6>
    </div>
    <p></p>
    <div class="container">
        <form action="/resources/edit" method="POST">
            <div class="row">
                <div class="col-sm-3">			

                    <button type="submit" style="right-side" class="btn btn-primary">Save Changes</button>

                </div>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Resource</th>
                                <th>Rate</th>
                            </tr>
                        </thead>
                        <?php if ($resources && count($resources) > 0) : ?>
                            <tbody>
                                <?php foreach ($resources as $key => $value): ?>
                                    <tr>
                                        <td><?= $value["name"] ?>
                                        </td>
                                        <td>         
                                            <!--Hidden field to hold the ids of the rates being edited.-->
                                            <input type="hidden" class="form-control" id="ids<?= $value["id"] ?>" name="resourceIds[]" value="<?= $value["id"]?>"/>                                            
                                            <input type="text" class="form-control" id="resourceId<?= $value["id"] ?>" name="rates[]" value="<?= $value["rate"]?>"/>                                            
                                        </td>
                                    </tr><?php endforeach; ?>
                            </tbody><?php endif; ?>
                        <tfoot>
                            <tr>
                                <th>Resource</th>
                                <th>Rate</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
    </div>
</form>

</div>
