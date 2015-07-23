<?php
/**
 * Created by PhpStorm.
 * User: egorov
 * Date: 14.04.2015
 * Time: 14:34
 */


// TODO: This code below has to be removed when all applications will upgrade

/**
 * @deprecated Old styled main page rendering, must be build on events
 */
function oldMainRenderer(&$html)
{
    // Render application main page block
    foreach (\samsoncms\Application::loaded() as $app) {
        // Show only visible apps
        if ($app->hide == false && $app->findView('sub_menu')) {
            $html .= $app->main();
        }
    }
}

/**
 * @deprecated All application should draw menu block via events
 */
function oldMenuRenderer(&$html, &$subMenu)
{
    // Iterate loaded samson\cms\application
    foreach (\samsoncms\Application::loaded() as $app) {
        // Show only visible apps
        if ($app->hide == false) {
            // Render application menu item
            $html .= m('template')
                ->view('menu/item')
                ->active(url()->module == $app->id() ? 'active' : '')
                ->app($app)
                ->icon($app->icon)
                ->name(isset($app->name{0}) ? $app->name : '')
                ->output();
        }
    }

    $subMenu = '';

    // Find current SamsonCMS application
    if (\samsoncms\Application::find(url()->module, $app/*@var $app App*/)) {
        // If module has sub_menu view - render it
        if ($app->findView('sub_menu')) {
            $subMenu .= $app->view('sub_menu')->output();
        }
    }
}

/**
 * @deprecated
 * @return string Page title
 */
function oldGetTitle()
{
    $local = m('local');
    $current = m();
    return isset($current['title']) ? $current['title'] :
        (isset($local['title']) ? $local['title'] : '');
}

// Old applications main page rendering
\samsonphp\event\Event::subscribe('template.main.rendered', 'oldMainRenderer');
// Old applications menu rendering
\samsonphp\event\Event::subscribe('template.menu.rendered', 'oldMenuRenderer');
