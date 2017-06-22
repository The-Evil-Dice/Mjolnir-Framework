<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <p class="modal-title">Login</p>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form class="form-horizontal" style="margin: 0;" action="<?php print Functions::getInstance()->getRoot(); ?>/Internal_Functions/Functions.php" method="post">
                        <input class="form-control input-lg" style="margin: 0 0 10px;" type="text" placeholder="Username" name="username" required />
                        <div class="form-group" style="margin: 0;">
                            <div class="col-lg-9 col-xs-12" style="padding: 0;">
                                <input class="form-control input-lg" type="password" placeholder="Password" name="password" required />
                            </div>
                            <div class="col-md-3 hidden-xs hidden-sm hidden-md" style="padding: 0 0 0 10px;">
                                <button class="btn btn-primary btn-lg col-xs-12" type="submit" name="login">Enter</button>
                            </div>
                            <div class="col-xs-12 hidden-lg" style="margin-top: 10px; padding: 0;">
                                <div class="col-xs-4"></div>
                                <button class="btn btn-primary btn-lg col-xs-4" type="submit" name="login">Enter</button>
                                <div class="col-xs-4"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>