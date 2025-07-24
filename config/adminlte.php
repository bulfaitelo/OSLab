<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'OSLab',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>OS</b>Lab',
    'logo_img' => 'vendor/oslab/imgs/oslab_logo-white.png',
    'logo_img_class' => 'brand-image',
    'logo_img_xl' => null,
    'logo_img_xl_class' => null,
    'logo_img_alt' => 'OSLAb',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'logo' => '',
        'img' => [
            'path' => 'vendor/oslab/imgs/oslab_logo_marca.png',
            'alt' => 'OSLAb',
            'class' => '',
            'width' => '',
            'height' => 180,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'img' => [
            'path' => 'vendor/oslab/imgs/oslab_logo.svg',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-oslab',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => ' btn-oslab',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => 'logo-font',
    'classes_brand_text' => 'logo-font',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-oslab elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'md',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => true,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------ad
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [

        [
            'text' => 'Perfil',
            'icon' => 'far fa-user',
            'route' => 'configuracao.user.perfil.index',
            'can' => 'config_perfil',
            'topnav_user' => true,
        ],
        // Navbar items:
        [
            'type' => 'navbar-search',
            'text' => 'Buscar',
            'topnav_right' => true,
            'url' => 'buscar',
            'method' => 'GET',
            'input_name' => 'busca',

        ],
        // [
        //     'text' => 'asd',
        //     'icon' => 'fa-regular fa-star',
        //     'topnav_right' => true,
        //     'route' => 'os.index',
        // ],
        // [
        //     'type'         => 'navbar-notification',
        //     'text' => '',
        //     'icon' => 'fa-regular fa-bell',
        //     'topnav_right' => true,
        //     'route' => 'os.index',
        //     'label' => 5,
        // ],
        [
            'type' => 'navbar-notification', // The menu item type => REQUIRED
            'key' => 'notifications',
            'id' => 'my-notification', // An ID attribute => REQUIRED
            'icon' => 'fas fa-bell', // A font awesome icon => REQUIRED
            'icon_color' => 'warning', // The initial icon color => OPTIONAL
            'label' => 12, // The initial label for the badge => OPTIONAL
            'label_color' => 'danger', // The initial badge color => OPTIONAL
            'url' => 'notifications/show', // Url for the click event => REQUIRED
            'dropdown_mode' => true, // Enable dropdown mode.
            'dropdown_flabel' => 'All notifications', // The label that will be used for the link to the configured url.
            'topnav_right' => true, // Or "'topnav' => true" to place on the left => REQUIRED
            // 'update_cfg' => [
            //     'url' => 'data/notifications/get', // Url to use for fetch new data => OPTIONAL
            //     'period' => 10, // The update period for get new data (in seconds) => OPTIONAL
            // ],
        ],

        [
            'type' => 'fullscreen-widget',
            'topnav_right' => true,
        ],
        // Sidebar items:
        [
            'type' => 'sidebar-menu-search',
            'text' => 'Buscar',
        ],
        // [
        //     'text'        => 'pages',
        //     'url'         => 'admin/pages',
        //     'icon'        => 'far fa-fw fa-file',
        //     'label'       => 5,
        //     'label_color' => 'success',
        // ],
        // ['header' => 'account_settings'],
        [
            'text' => 'Ordens de Serviço',
            'icon' => 'fa-regular fa-rectangle-list',
            'route' => 'os.index',
            'active' => ['os*'],
            'can' => 'os',
        ],
        [
            'text' => 'Vendas',
            'icon' => 'fa-solid fa-store',
            'route' => 'venda.index',
            'active' => ['venda*'],
            'can' => 'venda',
        ],
        [
            'text' => 'Clientes',
            'icon' => 'fa-solid fa-users',
            'route' => 'cliente.index',
            'active' => ['cliente*'],
            'can' => 'cliente',
        ],
        [
            'text' => 'Produtos',
            'icon' => 'fas fa-box-open',
            'route' => 'produto.index',
            'active' => ['produto*'],
            'can' => 'produto',
        ],
        [
            'text' => 'Serviços',
            'icon' => 'fas fa-hand-holding-usd',
            'route' => 'servico.index',
            'active' => ['servico*'],
            'can' => 'servico',
        ],
        [
            'text' => 'Financeiro',
            'icon' => 'fa-solid fa-chart-line',
            'can' => [
                'financeiro_receita', 'financeiro_despesa', 'financeiro_meta_contabil',
            ],
            'submenu' => [
                [
                    'text' => 'Receitas',
                    'icon' => 'fa-solid fa-money-bill',
                    'icon_color' => 'success',
                    'route' => 'financeiro.receita.index',
                    'active' => ['financeiro/receita*'],
                    'can' => 'financeiro_receita',

                ],
                [
                    'text' => 'Despesas',
                    'icon' => 'fa-solid fa-money-bill',
                    'icon_color' => 'danger',
                    'route' => 'financeiro.despesa.index',
                    'active' => ['financeiro/despesa*'],
                    'can' => 'financeiro_despesa',
                ],
                [
                    'text' => 'Metas Contábeis',
                    'icon' => 'fa-regular fa-chart-bar',
                    'route' => 'financeiro.meta_contabil.index',
                    'active' => ['financeiro/meta_contabil*'],
                    'can' => 'financeiro_meta_contabil',
                ],
            ],

        ],
        [
            'text' => 'Checklist',
            'icon' => 'fa-solid fa-list-check',
            'route' => 'checklist.index',
            'active' => ['checklist*'],
            'can' => 'checklist',
        ],
        [
            'text' => 'Wiki',
            'icon' => 'fa-solid fa-book',
            'route' => 'wiki.index',
            'active' => ['wiki*'],
            'can' => 'wiki',
        ],
        [
            'text' => 'Relatórios',
            'icon' => 'fa-regular fa-file-lines',
            'can' => [
                'relatorio_financeiro_balancete', 'relatorio_financeiro_receita_despesa', 'relatorio_financeiro_conta_aberta',
                'relatorio_sistema_log',
            ],
            'submenu' => [
                [
                    'text' => 'Financeiro',
                    'icon' => 'fa-solid fa-chart-line',
                    'can' => [
                        'relatorio_financeiro_balancete', 'relatorio_financeiro_receita_despesa', 'relatorio_financeiro_conta_aberta',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Balancete',
                            'icon' => 'fas fa-balance-scale',
                            'route' => 'relatorio.financeiro.balancete.index',
                            'active' => ['relatorio/financeiro/balancete*'],
                            'can' => 'relatorio_financeiro_balancete',
                        ],
                        [
                            'text' => 'Receitas / Despesas',
                            'icon' => 'fa-solid fa-money-bill',
                            'route' => 'relatorio.financeiro.despesa.index',
                            'active' => ['relatorio/financeiro/despesa*'],
                            'can' => 'relatorio_financeiro_receita_despesa',
                        ],
                        [
                            'text' => 'Contas Em Aberto',
                            'icon' => 'fa-solid fa-money-bill',
                            'route' => 'relatorio.financeiro.conta_aberta.index',
                            'active' => ['relatorio/financeiro/conta_aberta*'],
                            'can' => 'relatorio_financeiro_conta_aberta',
                        ],
                    ],
                ],
                [
                    'text' => 'Sistema',
                    'icon' => 'fa-solid fa-sitemap',
                    'can' => [
                        'relatorio_sistema_log',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Logs',
                            'icon' => 'fas fa-balance-scale',
                            'url' => 'relatorio/log-viewer',
                            'target' => '_blank',
                            'can' => 'relatorio_sistema_log',
                        ],
                    ],
                ],
            ],
        ],
        [
            // 'topnav' => true,
            'text' => '',
            'icon' => 'fas fa-cogs',
            'can' => [
                'config_users', 'config_roles', 'config_user_setor',
                'config_financeiro_centro_custo',
                'config_garantia', 'config_categoria',
                'config_wiki_fabricante', 'config_wiki_modelo',
                'config_sistema',
                'config_emitente',

            ],
            'submenu' => [
                [
                    'text' => 'Usuários',
                    'icon' => 'fas fa-users',
                    'can' => [
                        'config_roles',
                        'config_users',
                        'config_user_setor',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Usuários',
                            'icon' => 'fas fa-users',
                            'route' => 'configuracao.users.index',
                            'active' => ['configuracoes/users*'],
                            'can' => 'config_users',
                        ],
                        [
                            'text' => 'Perfis',
                            'icon' => 'fas fa-user-tag',
                            'route' => 'configuracao.roles.index',
                            'active' => ['configuracoes/roles*', 'configuracoes/permissions*'],
                            'can' => 'config_roles',
                        ],
                        [
                            'text' => 'Setores',
                            'icon' => 'fas fa-industry',
                            'route' => 'configuracao.user.setor.index',
                            'active' => ['configuracoes/user/setor*'],
                            'can' => 'config_user_setor',
                        ],
                    ],
                ],
                [
                    'text' => 'Financeiro',
                    'icon' => 'fas fa-landmark',
                    'can' => [
                        'config_financeiro_centro_custo',
                        'config_financeiro_forma_pagamento',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Centro de Custo',
                            'icon' => 'fas fa-cubes',
                            'route' => 'configuracao.financeiro.centro_custo.index',
                            'active' => ['configuracoes/financeiro/centro_custo*'],
                            'can' => 'config_financeiro_centro_custo',
                        ],
                        [
                            'text' => 'Forma de Pagamento',
                            'icon' => 'fa-solid fa-money-bill-transfer',
                            'route' => 'configuracao.financeiro.forma_pagamento.index',
                            'active' => ['configuracoes/financeiro/forma_pagamento*'],
                            'can' => 'config_financeiro_forma_pagamento',
                        ],
                    ],
                ],
                [
                    'text' => 'Parâmetros',
                    'icon' => 'fa-solid fa-sliders',
                    'can' => [
                        'config_categoria', 'config_status',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Status',
                            'icon' => 'fas fa-wave-square',
                            'route' => 'configuracao.parametro.status.index',
                            'active' => ['configuracoes/parametro/status*'],
                            'can' => 'config_status',
                        ],
                        [
                            'text' => 'Categoria',
                            'icon' => 'fas fa-clipboard-list',
                            'route' => 'configuracao.parametro.categoria.index',
                            'active' => ['configuracoes/parametro/categoria*'],
                            'can' => 'config_categoria',
                        ],
                    ],
                ],
                [
                    'text' => 'Wiki',
                    'icon' => 'fa-solid fa-book',
                    'can' => [
                        'config_wiki_fabricante', 'config_wiki_modelo',
                    ],
                    'submenu' => [
                        [
                            'text' => 'Fabricantes',
                            'icon' => 'fa-solid fa-book',
                            'route' => 'configuracao.wiki.fabricante.index',
                            'active' => ['configuracoes/wiki/fabricante*'],
                            'can' => 'config_wiki_fabricante',
                        ],
                        [
                            'text' => 'Modelos',
                            'icon' => 'fa-solid fa-book',
                            'route' => 'configuracao.wiki.modelo.index',
                            'active' => ['configuracoes/wiki/modelo*'],
                            'can' => 'config_wiki_modelo',
                        ],
                    ],
                ],
                [
                    'text' => 'Termos de Garantia',
                    'icon' => 'fas fa-shield-alt',
                    'route' => 'configuracao.garantia.index',
                    'active' => ['configuracoes/garantia*'],
                    'can' => 'config_garantia',
                ],
                [
                    'text' => 'Sistema',
                    'icon' => 'fa-solid fa-sitemap',
                    'route' => 'configuracao.sistema.index',
                    'active' => ['configuracoes/sistema*'],
                    'can' => 'config_sistema',
                ],
                [
                    'text' => 'Emitente',
                    'icon' => 'fa-solid fa-building',
                    'route' => 'configuracao.emitente.index',
                    'active' => ['configuracoes/emitente*'],
                    'can' => 'config_emitente',
                ],
                [
                    'text' => 'Backup',
                    'icon' => 'fa-solid fa-server',
                    'route' => 'configuracao.backup.index',
                    'active' => ['configuracoes/backup*'],
                    'can' => 'config_backup',
                ],
            ],

        ],

        [
            'text' => 'Links',
            'icon' => 'fas fa-external-link-square-alt',
            'can' => [
                'config_url',
            ],
            'submenu' => [
                [
                    'text' => 'Menu Config',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Laravel-permission',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://spatie.be/docs/laravel-permission/v4/introduction',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Laravel Documentation',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://laravel.com/docs/8.x',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Livewire Documentation',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://laravel-livewire.com/docs/',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'AdminLte 3v',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://adminlte.io/themes/v3/',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Laravel HTML (Spatie)',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://spatie.be/docs/laravel-html/v3/general-usage/element-classes',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Font Awesome',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://fontawesome.com/search',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'Laravel Auditing',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'http://www.laravel-auditing.com/',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'MCharts',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://www.amcharts.com/demos/',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'GDrive Rotas',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://github.com/ivanvermeyen/laravel-google-drive-demo/blob/master/routes/web.php',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
                [
                    'text' => 'GDrive Demo',
                    'icon' => 'fas fa-external-link-square-alt',
                    'url' => 'https://github.com/ivanvermeyen/laravel-google-drive-demo',
                    'target' => '_blank',
                    'can' => 'config_url',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => true,
];
