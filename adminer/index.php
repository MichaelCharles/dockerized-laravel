<?php
namespace docker {
    function adminer_object()
    {
        require_once 'plugins/plugin.php';

        class Adminer extends \AdminerPlugin
        {
            function _callParent($function, $args)
            {
                if ($function === 'loginForm') {
                    ob_start();
                    $return = \Adminer::loginForm();
                    $form = ob_get_clean();
                    /* This uses str_replace() to put the environment variables
                    specified by docker-compose.yml into the login form on
                    Adminer's login page. It is ugly, but it is modeled after the
                    way that the official Adminer Docker image does it. I've expanded
                    it to incorporate additional environment variables. */
                    $stageOne = str_replace('name="auth[server]" value="" title="hostname[:port]"', 'name="auth[server]" value="'
                        . ($_ENV['ADMINER_DEFAULT_SERVER'] ?: 'db')
                        . '" title="hostname[:port]"', $form);
                    $stageTwo = str_replace('name="auth[username]" id="username" value=""', 'name="auth[username]" id="username" value="'
                        . ($_ENV['ADMINER_DEFAULT_USERNAME'] ?: '')
                        . '"', $stageOne);
                    $stageThree = str_replace('<option value="server" selected>MySQL', '<option value="server">MySQL', $stageTwo);
                    $stageFour = str_replace('<option value="'
                        . ($_ENV['ADMINER_DEFAULT_SYSTEM'] ?: 'server')
                        . '">', '<option value="'
                        . ($_ENV['ADMINER_DEFAULT_SYSTEM'] ?: 'server')
                        . '" selected>', $stageThree);
                    $stageFive = str_replace('<input type="password" name="auth[password]"', '<input type="password" name="auth[password]" value="'
                        . ($_ENV['ADMINER_DEFAULT_PASSWORD'] ?: '')
                        . '"', $stageFour);
                    echo str_replace('name="auth[db]" value=""', 'name="auth[db]" value="'
                        . ($_ENV['ADMINER_DEFAULT_DATABASE'] ?: '')
                        . '"', $stageFive);

                    return $return;
                }

                return parent::_callParent($function, $args);
            }
        }

        $plugins = [];
        foreach (glob('plugins-enabled/*.php') as $plugin) {
            $plugins[] = require $plugin;
        }

        return new Adminer($plugins);
    }
}

namespace {
    if (basename($_SERVER['REQUEST_URI']) === 'adminer.css' && is_readable('adminer.css')) {
        header('Content-Type: text/css');
        readfile('adminer.css');
        exit;
    }

    function adminer_object()
    {
        return \docker\adminer_object();
    }

    require 'adminer.php';
}