<?php
/*-----------------------------------------------------
        Routing
-----------------------------------------------------*/
$_GET['route'] = isset($_GET['route']) ? $_GET['route'] : '';

$routeArrTmp = explode('/', $_GET['route']);
/*if ($routeArrTmp[0] != ''){
    $db_user  = trim(strip_tags($routeArrTmp[0])) ;
    unset($routeArrTmp[0]);
    $routeArrTmp = explode('/',implode('/',$routeArrTmp));;
}*/
/*-----------------------------------------------------
        Init
-----------------------------------------------------*/
include 'include/init.php';

$routeArr    = array();
foreach ($routeArrTmp as $route) {
    if ($route) {
        $routeArr[] = trim(strip_tags($route));
    }
}
try {




    if (!$auth->hasIdentity()) {
        /*-----------------------------------------------------
				Not Logged
		-----------------------------------------------------*/
        switch ($routeArr[0]){

            case  'reg' :
                require_once(PATHADM . "controllers/_reg.php");
                break;
            default:
                require_once(PATHADM . "controllers/login.php");

        }
        echo $routeArr[0];

        exit;

    } else {
        /*-----------------------------------------------------
				Logged
		-----------------------------------------------------*/
        $selectedPath = '';
        $selectedUrl = '';


        /*-----------------------------------------------------
				Routing
		-----------------------------------------------------*/
        if ($routeArr[0] == 'home' && !$routeArr[1] && !$routeArr[2]) {
            $selectedPath = PATHADM . 'controllers/home.php';
            $selectedUrl .= 'dashboard/';
        } elseif ($routeArr[0] == 'quit' && !$routeArr[1] && !$routeArr[2]) {
            $selectedPath = PATHADM . 'controllers/quit.php';
            $selectedUrl .= 'quit/';
        } elseif ($routeArr[0] == 'ajax') {
            $selectedPath = PATHADM . 'controllers/ajax.php';
            $selectedUrl .= 'ajax/';
        } else {
            // select 1 menu hierarchy
            if (!$routeArr[0]){
                $routeArr[0] = 'app';
            }
            if (!$routeArr[1]){
                $routeArr[1] = 'pdf';
            }


            foreach ($topMenu as $topMenuKey => $topMenuItem) {
                if ($topMenuKey == $routeArr[0]) {
                    $selectedTop = $topMenuKey;
                    if ($topMenuItem['controller']) {
                        $selectedPath = PATHADM . 'controllers/' . $topMenuItem['controller'];
                    } else {
                        $selectedPath = PATHADM . 'controllers/' . 'home.php';
                    }
                    $selectedUrl .= $topMenuKey . '/';
                    break;
                }
            }

            // select 2 menu hierarchy
            if ($selectedTop && $selectedTop == $routeArr[0] && $routeArr[1]) {
                foreach ($menu[$selectedTop] as $menuKey => $menuItem) {
                    if ($menuKey == $routeArr[1]) {
                        $selectedMenu = $menuKey;
                        $selectedPath = PATHADM . 'controllers/' . $menuItem['controller'];
                        $selectedUrl .= $menuKey . '/';
                        break;
                    }
                }
            }

            /*
			// select 3 menu hierarchy
			if ($selectedTop && $selectedMenu && $selectedTop == $routeArr[0] && $selectedMenu == $routeArr[1] && $routeArr[2]) {
				foreach($sub as $subKey => $subItem) {
					if ($subKey == $routeArr[2]) {
						$selectedSub     = $subKey;
						$selectedPath    = PATHADM . 'controllers/' . $subItem['url'];
						$selectedUrl    .= $subKey . '/';
						print($selectedPath . "-" . $routeArr[1] . "<br />");
						break;
					}
				}
			}
			*/
        }

        $smarty->assign('selectedTop', $selectedTop);
        $smarty->assign('selectedMenu', $selectedMenu);
        $smarty->assign('selectedSub', $selectedSub);
        $smarty->assign('selectedUrl', $selectedUrl);

        if (!empty($selectedPath) && is_file($selectedPath)) {
            require_once($selectedPath);
        } else {
            require_once(PATHADM . 'controllers/home.php');
        }

    }
}catch (Exception $err){
    $err->getMessage();
}

?>
