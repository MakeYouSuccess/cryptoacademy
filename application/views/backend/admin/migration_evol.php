<div class="row ">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="page-title"> <i class="mdi mdi-apple-keyboard-command title_icon"></i> <?php echo get_phrase('migrated_data') ?></h4>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="row w-100">
                    <div class="col-xl-12">
                        <?php if (count($res) == 0):?>
                        Nothing to migrate
                        <?php else:?>
                            <table style="width:100%; text-align:center;">
                            <?php foreach($res as $enrol) { ?>
                                <tr style="border-bottom: 1px solid grey; border-top: 1px solid grey">
                                    <td>
                                        <?php echo $enrol['name'] . ' ' . $enrol['lastname'];?>
                                        <br/>
                                        <?=$enrol['email']?>
                                    </td>
                                    <td>
                                        <?php foreach($enrol['enroll'] as $course) {?>
                                            <div><?=$course['study']?> ( <?=$course['completedpercent']?>% ) </div>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </table>
                        <?php endif;?>
                    </div>
                </form>
            </div>
        </div><!-- end row-->
    </div> <!-- end card-body-->
</div> <!-- end card-->
</div>
</div>
