<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand viking" href="#">Mjolnir</a>
        </div>
        <ul class="nav navbar-nav">
            <?php
            $root = Functions::getInstance()->getRoot();
            $navtree = Functions::getInstance()->getSettings()->navigation->admintree;
            
            foreach($navtree->branch as $nav){
                if($nav->attributes()[0] == "button"){
                    $pageLink = $nav->pagelink;
                    $title = $nav->title;
                    $glyphicon = $nav->glyphicon;
                    $active = trim($_SERVER['PATH_INFO'], "/") == $pageLink ? "class='active'":"";
                    
                    print "<li $active><a href='$root/$pageLink'><span class='glyphicon glyphicon-$glyphicon'></span> $title</a></li>";
                } else if ($nav->attributes()[0] == "list"){
                    $title = $nav->title;
                    print
                    "<li class='dropdown'>
                <a class='dropdown-toggle' data-toggle='dropdown' href='#'> $title
                    <span class='caret'></span></a>
                <ul class='dropdown-menu'>";
                    foreach($nav->branch as $listitem){
                        $title = $listitem->title;
                        $pageLink = $listitem->pagelink;
                        print "<li><a href='$root/$pageLink'>$title</a></li>";
                    }
                    print
                    "                </ul>
            </li>";
                }
            }
            ?>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php print Functions::getInstance()->getRoot(); ?>/Dashboard/"><span class="glyphicon glyphicon-dashboard"></span> Staff Panel</a></li>
            <li><a data-toggle="modal" href="#logout"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
        </ul>
    </div>
</nav>
