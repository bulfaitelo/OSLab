
<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Os\StatusOs;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;




// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});


// Clientes
    Breadcrumbs::for('cliente.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Clientes', route('cliente.index'));
    });

    // Clientes > Novo Cliente
    Breadcrumbs::for('cliente.create', function (BreadcrumbTrail $trail) {
        $trail->parent('cliente.index');
        $trail->push('Novo Cliente', route('cliente.create'));
    });

    // Clientes > [Visualização de Cliente]
    Breadcrumbs::for('cliente.show', function (BreadcrumbTrail $trail, Cliente $item) {
        $trail->parent('cliente.index');
        $trail->push($item->name, route('cliente.show', $item));
    });

    // Clientes > [cliente Name] > Editar Cliente
    Breadcrumbs::for('cliente.edit', function (BreadcrumbTrail $trail, cliente $item) {
        $trail->parent('cliente.index');
        $trail->push('Editar Cliente', route('cliente.edit', $item));
    });
// FIM Clientes


// OS
    // Status OS
    Breadcrumbs::for('configuracao.os.status.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('OS');
        $trail->push('Status de OS', route('configuracao.os.status.index'));
    });

    // Status de Os > Novo Status de Os
    Breadcrumbs::for('configuracao.os.status.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.os.status.index');
        $trail->push('Novo Status de Os', route('configuracao.os.status.create'));
    });

    // Status de Os > [Visualização de Status de OS]
    Breadcrumbs::for('configuracao.os.status.show', function (BreadcrumbTrail $trail, StatusOs $item) {
        $trail->parent('configuracao.os.status.index');
        $trail->push($item->name, route('configuracao.os.status.show', $item));
    });

    // Status de Os > [Status de OS Name] > Editar Status de OS
    Breadcrumbs::for('configuracao.os.status.edit', function (BreadcrumbTrail $trail, StatusOs $item) {
        $trail->parent('configuracao.os.status.index');
        $trail->push('Editar Status de OS', route('configuracao.os.status.edit', $item));
    });

// Fim OS
