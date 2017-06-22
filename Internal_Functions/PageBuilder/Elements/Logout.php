<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="logout" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title">Are you sure you want to logout?</p>
            </div>
            <div class="modal-body">
                <div style="text-align: center;">
                    <form method="post" action="<?php print Functions::getInstance()->getRoot(); ?>/Internal_Functions/Functions.php">
                        <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>