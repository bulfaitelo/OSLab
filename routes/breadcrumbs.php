
<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Configuracao\Os\CategoriaOs;
use App\Models\Configuracao\Os\Garantia;
use App\Models\Configuracao\Os\StatusOs;
use App\Models\Configuracao\User\Setor;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

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


// Configuração OS
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

    // Termo de Garantia
    Breadcrumbs::for('configuracao.os.garantia.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('OS');
        $trail->push('Termo de Garantia', route('configuracao.os.garantia.index'));
    });

    // Termo de Garantia > Novo Termo de Garantia
    Breadcrumbs::for('configuracao.os.garantia.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.os.garantia.index');
        $trail->push('Novo Termo de Garantia', route('configuracao.os.garantia.create'));
    });

    // Termo de Garantia > [Visualização de Termo de Garantia]
    Breadcrumbs::for('configuracao.os.garantia.show', function (BreadcrumbTrail $trail, Garantia $item) {
        $trail->parent('configuracao.os.garantia.index');
        $trail->push($item->name, route('configuracao.os.garantia.show', $item));
    });

    // Termo de Garantia > [Termo de Garantia Name] > Editar Termo de Garantia
    Breadcrumbs::for('configuracao.os.garantia.edit', function (BreadcrumbTrail $trail, Garantia $item) {
        $trail->parent('configuracao.os.garantia.index');
        $trail->push('Editar Termo de Garantia', route('configuracao.os.garantia.edit', $item));
    });

    // Categoria
    Breadcrumbs::for('configuracao.os.categoria.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('OS');
        $trail->push('Categoria', route('configuracao.os.categoria.index'));
    });

    // Categoria > Novo Categoria
    Breadcrumbs::for('configuracao.os.categoria.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.os.categoria.index');
        $trail->push('Novo Categoria', route('configuracao.os.categoria.create'));
    });

    // Categoria > [Visualização de Categoria]
    Breadcrumbs::for('configuracao.os.categoria.show', function (BreadcrumbTrail $trail, CategoriaOs $item) {
        $trail->parent('configuracao.os.categoria.index');
        $trail->push($item->name, route('configuracao.os.categoria.show', $item));
    });

    // Categoria > [Categoria Name] > Editar Categoria
    Breadcrumbs::for('configuracao.os.categoria.edit', function (BreadcrumbTrail $trail, CategoriaOs $item) {
        $trail->parent('configuracao.os.categoria.index');
        $trail->push('Editar Categoria', route('configuracao.os.categoria.edit', $item));
    });

// Fim Condiguração OS

// Configuração FINANCEIRO
    // Centro de Custo
    Breadcrumbs::for('configuracao.financeiro.centro_custo.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('Financeiro');
        $trail->push('Centro de Custo', route('configuracao.financeiro.centro_custo.index'));
    });

    // Centro de Custo > Novo Centro de Custo
    Breadcrumbs::for('configuracao.financeiro.centro_custo.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.financeiro.centro_custo.index');
        $trail->push('Novo Centro de Custo', route('configuracao.financeiro.centro_custo.create'));
    });

    // Centro de Custo > [Visualização de Centro de Custo]
    Breadcrumbs::for('configuracao.financeiro.centro_custo.show', function (BreadcrumbTrail $trail, CentroCusto $item) {
        $trail->parent('configuracao.financeiro.centro_custo.index');
        $trail->push(Str::limit($item->name, 20), route('configuracao.financeiro.centro_custo.show', $item));
    });

    // Centro de Custo > [Centro de Custo Name] > Editar Centro de Custo
    Breadcrumbs::for('configuracao.financeiro.centro_custo.edit', function (BreadcrumbTrail $trail, CentroCusto $item) {
        $trail->parent('configuracao.financeiro.centro_custo.index');
        $trail->push('Editar Centro de Custo', route('configuracao.financeiro.centro_custo.edit', $item));
    });
// Fim Configuração FINANCEIRO


// Configuração Usuários
    // Setor
    Breadcrumbs::for('configuracao.user.setor.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('Usuários');
        $trail->push('Setor', route('configuracao.user.setor.index'));
    });

    // Setor > Novo Setor
    Breadcrumbs::for('configuracao.user.setor.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.user.setor.index');
        $trail->push('Novo Setor', route('configuracao.user.setor.create'));
    });

    // Setor > [Visualização de Setor]
    Breadcrumbs::for('configuracao.user.setor.show', function (BreadcrumbTrail $trail, Setor $item) {
        $trail->parent('configuracao.user.setor.index');
        $trail->push(Str::limit($item->name, 20), route('configuracao.user.setor.show', $item));
    });

    // Setor > [Setor Name] > Editar Setor
    Breadcrumbs::for('configuracao.user.setor.edit', function (BreadcrumbTrail $trail, Setor $item) {
        $trail->parent('configuracao.user.setor.index');
        $trail->push('Editar Setor', route('configuracao.user.setor.edit', $item));
    });

    // Perfis
    Breadcrumbs::for('configuracao.roles.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('Usuários');
        $trail->push('Perfis', route('configuracao.roles.index'));
    });

    // Perfis > Novo Perfis
    Breadcrumbs::for('configuracao.roles.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.roles.index');
        $trail->push('Novo Perfis', route('configuracao.roles.create'));
    });

    // Perfis > [Visualização de Perfis]
    Breadcrumbs::for('configuracao.roles.show', function (BreadcrumbTrail $trail, Role $item) {
        $trail->parent('configuracao.roles.index');
        $trail->push(Str::limit($item->name, 20), route('configuracao.roles.show', $item));
    });

    // Perfis > [Perfis Name] > Editar Perfis
    Breadcrumbs::for('configuracao.roles.edit', function (BreadcrumbTrail $trail, Role $item) {
        $trail->parent('configuracao.roles.index');
        $trail->push('Editar Perfis', route('configuracao.roles.edit', $item));
    });

    // Perfis > [Perfis Name] > Permissões
    Breadcrumbs::for('configuracao.roles.assign', function (BreadcrumbTrail $trail, Role $item) {
        $trail->parent('configuracao.roles.index');
        $trail->push('Permissões: '. $item->name, route('configuracao.roles.assign', $item));
    });

    // Usuários
    Breadcrumbs::for('configuracao.users.index', function (BreadcrumbTrail $trail) {
        $trail->parent('home');
        $trail->push('Configurações');
        $trail->push('Usuários');
        $trail->push('Usuário', route('configuracao.users.index'));
    });

    // Usuário > Novo Usuário
    Breadcrumbs::for('configuracao.users.create', function (BreadcrumbTrail $trail) {
        $trail->parent('configuracao.users.index');
        $trail->push('Novo Usuário', route('configuracao.users.create'));
    });

    // Usuário > [Visualização de Usuário]
    Breadcrumbs::for('configuracao.users.show', function (BreadcrumbTrail $trail, User $item) {
        $trail->parent('configuracao.users.index');
        $trail->push(Str::limit($item->name, 20), route('configuracao.users.show', $item));
    });

    // Usuário > [Usuário Name] > Editar Usuário
    Breadcrumbs::for('configuracao.users.edit', function (BreadcrumbTrail $trail, User $item) {
        $trail->parent('configuracao.users.index');
        $trail->push('Editar Usuário', route('configuracao.users.edit', $item));
    });

    // Perfis > [Perfis Name] > Permissões
    Breadcrumbs::for('configuracao.users.permissions_edit', function (BreadcrumbTrail $trail, User $item) {
        $trail->parent('configuracao.roles.index');
        $trail->push('Permissões: '. $item->name, route('configuracao.users.permissions_edit', $item));
    });
