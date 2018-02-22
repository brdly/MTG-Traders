<?php
/**
 * Created by PhpStorm.
 * User: georgebroadley
 * Date: 14/02/2018
 * Time: 20:29
 */

class Paginate
{
    //Creates the pagination elements for pages
    public static function createLinks($page, $queryValues = "", $itemCount, $limit)
    {
        $last = ceil($itemCount / $limit);

        if (($page - 3) > 0) {
            $start = $page - 3;
        } else {
            $start = 1;
        }

        if (($page + 3) < $last) {
            $end = $page + 3;
        } else {
            $end = $last;
        }

        $html = '<ul class="pagination justify-content-center">';

        if ($page == 1) {
            $class = "disabled";
        } else {
            $class = "";
        }

        $html = $html . '<li class="page-item '.$class.'"><a class="page-link" href="?' . $queryValues . 'page=' . ($page - 1) . '">Previous</a></li>';

        if ($start > 1) {
            $html = $html . '<li class="page-item"><a class="page-link" href="?' . $queryValues . 'page=1">1</a></li>';
            $html = $html . '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ($page == $i) ? "active" : "";
            $html = $html . '<li class="page-item ' . $class . '"><a class="page-link" href="?' . $queryValues . 'page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html = $html . '<li class="page-item disabled"><a class="page-link" href="#">...</a></li>';
            $html = $html . '<li class="page-item"><a class="page-link" href="?' . $queryValues . 'page=' . $last . '">' . $last . '</a></li>';
        }

        if ($page == $last) {
            $class = "disabled";
        } else {
            $class = "";
        }

        $html = $html . '<li class="page-item ' . $class . '"><a class="page-link" href="?' . $queryValues . 'page=' . ($page + 1) . '">Next</a></li>';
        $html = $html . '</ul>';

        return $html;
    }
}