<?php

$data          = json_decode(file_get_contents('vendor/composer/installed.json'), true);
$bootstrapPath = 'vendor/twitter/bootstrap';
foreach ($data as $installed) {
    if ('twitter/bootstrap' === $installed['name']) {
        $bootstrapPath = 'vendor/' . $installed['name'];
        if (!empty($installed['target-dir'])) {
            $bootstrapPath .= '/' . $installed['target-dir'];
        }
        break;
    }
}

return array(
    'di' => array(
        'instance' => array(
            'Zend\Form\View\Helper\FormElementErrors' => array(
                'parameters' => array(
                    'messageCloseString'     => '</span>',
                    'messageOpenFormat'      => '<span%s>',
                    'messageSeparatorString' => '<br />',
                    'attributes'             => array(
                        'class' => 'help-inline',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'sxbForm'            => 'SxBootstrap\View\Helper\Bootstrap\Form',
            'sxbFormElement'     => 'SxBootstrap\View\Helper\Bootstrap\FormElement',
            'sxbFormDescription' => 'SxBootstrap\View\Helper\Bootstrap\FormDescription',
            'sxbTabs'            => 'SxBootstrap\View\Helper\Bootstrap\Tabs',
            'sxbAlert'           => 'SxBootstrap\View\Helper\Bootstrap\Alert',
            'sxbBadge'           => 'SxBootstrap\View\Helper\Bootstrap\Badge',
            'sxbLabel'           => 'SxBootstrap\View\Helper\Bootstrap\Label',
            'sxbFormColorpicker' => 'SxBootstrap\View\Helper\Bootstrap\FormColorPicker',
            'sxBootstrap'        => 'SxBootstrap\View\Helper\Bootstrap\Bootstrap',
        ),
    ),
    'asset_manager' => array(
        'resolvers' => array(
            'SxBootstrap\Service\BootstrapResolver' => 1200,
        ),
        'resolver_configs' => array(
            'map' => array(
                'css/colorpicker.css'                => __DIR__ . '/../public/css/colorpicker.css',
                'js/bootstrap-colorpicker.js'        => __DIR__ . '/../public/js/bootstrap-colorpicker.js',
                'img/alpha.png'                      => __DIR__ . '/../public/img/alpha.png',
                'img/hue.png'                        => __DIR__ . '/../public/img/hue.png',
                'img/saturation.png'                 => __DIR__ . '/../public/img/saturation.png',
                'img/glyphicons-halflings.png'       => $bootstrapPath . '/img/glyphicons-halflings.png',
                'img/glyphicons-halflings-white.png' => $bootstrapPath . '/img/glyphicons-halflings-white.png',
                'css/bootstrap.css'                  => $bootstrapPath . '/less/bootstrap.less',
            ),
            'paths' => array(
                $bootstrapPath,
            ),
        ),
        'filters' => array(
            'css/bootstrap.css' => array(
                array(
                    'service' => 'SxBootstrap\Service\BootstrapFilter',
                ),
            ),
        ),
    ),
    'twitter_bootstrap' => array(
        'makefile' => $bootstrapPath . '/Makefile',
        'filter'   => array(
            'node_bin'   => '/usr/bin/node',
            'node_paths' => array('node_modules'),
        ),
        'variables'    => array(),
        'plugin_alias' => 'js/bootstrap.js',
    ),
);
