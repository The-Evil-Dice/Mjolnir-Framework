<?php

class PageBuilder {

    protected static $_instance;

    public static final function getInstance() {
        if (!self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }
    
    public function getPages(){
        return simplexml_load_file(__DIR__ . '/PAGES.xml');
    }

    public function getPage($pageTitle) {
        foreach ($this->getPages()->page as $page) {
            if ($page->title == $pageTitle) {
                return $page;
            }
        }
    }
    
    public function getMainPage() {
        foreach ($this->getPages()->page as $page) {
            if(isset($page->main)) {
                return $page->title;
                break;
            }
        }
        return "";
    }

    public function getPageElements($page) {
        $elements = array();
        foreach ($page->element as $element) {
            array_push($elements, $element);
        }
        return $elements;
    }

    public function buildHeader() {
        include __DIR__ . '/Elements/Core/Header.php';
    }

    public function getNavbar($page) {
        include __DIR__ . "/Elements/Navbars/$page->navbar.php";
    }

    public function buildContent($page) {
        $elements = $this->getPageElements($page);
        
        foreach($elements as $element){
            include __DIR__ . "/Elements/$element->name.php";
        }
    }

    public function buildPage($pageTitle) {
        $page = $this->getPage($pageTitle);
        
        $this->buildHeader();
        
        print "
    <body>
        <div class='container-fluid' style='height: 100%'>";
        
        $this->getNavbar($page);
        $this->buildContent($page);
        
        print "
        </div>
    </body>
</html>";
    }

}
