<h1 class="h3 mb-2 text-gray-800">System Resources</h1><!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">All</h6>
    </div>
    <p></p>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <form action="/resources/edit/" method="get">
                    <button type="submit" style="right-side" class="btn btn-primary"><i class="fas fa-edit"></i>&nbsp;Edit</button>
                </form>
            </div>
        </div>
    </div> 
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="50%" cellspacing="0">
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
                                <td width="25%"><?= $value["name"] ?>
                                </td>
                                <td width="5%">
                                    <?= $value["rate"] ?>                                    
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
