<?php

/*
 * Хлебные крошки
 * https://snipp.ru/php/class-breadcrumb
 */

class breadcrumb {

    private static $_items = array();

    public static function add($url, $name) {
        self::$_items[] = array($url, $name);
    }

    public static function out() {
        $res = "<style>
            .breadcrumb {
                padding: 0;
                margin: 20px;    
            }
            .breadcrumb a {
                display: inline-block;
                font-size: 15px;
                vertical-align: top;
            }
            .breadcrumb_item:before {
                content: '';
                display: inline-block;
                width: 5px;
                height: 5px;
                margin: 7px 4px;
                vertical-align: top;
                background: #666;
                border-radius: 50%;
            } 
        </style>\n";


        $res .= '<div class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList" id="breadcrumbs">
			<span itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
				<a href="/" itemprop="item">
					Главная
					<meta itemprop="name" content="Главная">
				</a>
				<meta itemprop="position" content="1">
			</span>';

        $i = 1;
        foreach (self::$_items as $row) {
            $res .= '<span class="breadcrumb_item" itemscope="" itemprop="itemListElement" itemtype="http://schema.org/ListItem">
				<a href="' . $row[0] . '" itemprop="item">
					' . $row[1] . '
					<meta itemprop="name" content="' . $row[1] . '">
				</a>
				<meta itemprop="position" content="' . ++$i . '">
			</span>';
        }
        $res .= '</div>';

        return $res;
    }

}
