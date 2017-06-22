<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand">OvO Commissions</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            global $page;
            $root = Functions::getInstance()->getRoot();
            $navtree = Functions::getInstance()->getSettings()->navigation->tree;
            
            foreach($navtree->branch as $nav){
                if($nav->attributes()[0] == "button"){
                    if($nav->attributes()[1] == "false" ||
                            ($nav->attributes()[1] == "true" && isset($_SESSION['User']))){
                    $pageLink = $nav->pagelink;
                    $title = $nav->title;
                    $glyphicon = $nav->glyphicon;
                    $active = $page == $pageLink ? "class='active'":"";
                    
                    print "<li $active><a href='$root/$pageLink'><span class='glyphicon glyphicon-$glyphicon'></span> $title</a></li>";
                            }
                }
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <?php
            if (isset($_SESSION['User'])) {
                print "<li><a data-toggle='modal' href='#logout'><span class='glyphicon glyphicon-log-out'></span> Log Out</a></li>";
            } else {
                print "<li><a data-toggle='modal' href='#login'><span class='glyphicon glyphicon-log-in'></span> Log In</a></li>";
            }
            ?>
        </ul>
    </div>
</nav>
