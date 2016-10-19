<?php

if (!function_exists('ThomasBuildRoute')) {
    function ThomasBuildRoute( &$query )
    {
            //print_r($query);

           $segments = array();

           if(isset($query['view']))
           {
                    if ($query['view'] == 'video' || $query['view'] == 'audio' || $query['view'] == 'gallery')
                        $segments[] = $query['view'];

                    unset( $query['view'] );
           }

           if(isset($query['id']))
           {
                    $segments[] = $query['id'];
                    unset( $query['id'] );
           }

           if(isset($query['id2']))
           {
                    $segments[] = $query['id2'];
                    unset( $query['id2'] );
           }

           //print_r($segments);

           return $segments;
    }
}

if (!function_exists('ThomasParseRoute')) {
    function ThomasParseRoute( $segments )
    {
        $vars = array();

        $app = JFactory::getApplication();
        $menu = $app->getMenu();
        $item = $menu->getActive();

        $count = count($segments);

          // print_r($segments);
          // print_r($item);

        if (isset($item->query['view'])) {
            switch ($item->query['view']) {
                case 'glossary':
                    if ($count == 1) {
                        $vars['view'] = 'glossaryitem';
                        $vars['alias'] = (string) $segments[0];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    break;
                case 'arch':
                    if ($count == 1) {
                        $vars['view'] = 'architem';
                        $vars['alias'] = (string) $segments[0];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    break;
                case 'cat':
                    if ($count == 1) {
                        $vars['view'] = 'subcat';
                        $vars['alias'] = (string) $segments[0];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    if ($count == 2) {
                        $vars['view'] = 'subsubcat';
                        $vars['alias'] = (string) $segments[1];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    if ($count == 3) {
                        $vars['view'] = 'catalog';
                        $vars['alias'] = (string) $segments[2];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    if ($count == 4) {
                        $vars['view'] = 'catalogitem';
                        $vars['alias'] = (string) $segments[3];
                        $vars['alias'] = str_replace(":", "-", $vars['alias']);
                    }
                    break;
                case 'category':
                    if ($count == 1) {
                        $vars['view'] = 'excursion';
                        $vars['id_cat'] = (string) $segments[0];
                        $vars['id_cat'] = str_replace(":", "-", $vars['id_cat']);
                    }
                    if ($count == 2) {
                        $vars['view'] = 'excursion';
                        $vars['id_cat'] = (string) $segments[0];
                        $vars['id_cat'] = str_replace(":", "-", $vars['id_cat']);
                        $vars['id'] = (string) $segments[1];
                        $vars['id'] = str_replace(":", "-", $vars['id']);
                    }
                    break;
            }
        }

        return $vars;
    }
}

?>