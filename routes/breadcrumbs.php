<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Checklist\Checklist;
use App\Models\Cliente\Cliente;
use App\Models\Configuracao\Financeiro\CentroCusto;
use App\Models\Configuracao\Financeiro\FormaPagamento;
use App\Models\Configuracao\Garantia\Garantia;
use App\Models\Configuracao\Parametro\Categoria;
use App\Models\Configuracao\Parametro\Status;
use App\Models\Configuracao\Sistema\Emitente;
use App\Models\Configuracao\Sistema\SistemaConfig;
use App\Models\Configuracao\User\Setor;
use App\Models\Configuracao\Wiki\Fabricante;
use App\Models\Configuracao\Wiki\Modelo;
use App\Models\Financeiro\Contas;
use App\Models\Financeiro\MetaContabil;
use App\Models\Os\Os;
use App\Models\Produto\Produto;
use App\Models\Servico\Servico;
use App\Models\User;
use App\Models\Venda\Venda;
use App\Models\Wiki\Wiki;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Permission;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home
Breadcrumbs::for('buscar', function (BreadcrumbTrail $trail) {
    $trail->push('Buscar', route('buscar'));
});

// teste
Breadcrumbs::for('teste.index', function (BreadcrumbTrail $trail) {
    $trail->push('teste.index', route('teste.index'));
});

// OS
Breadcrumbs::for('os.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('OS', route('os.index'));
});

// OS > Novo OS
Breadcrumbs::for('os.create', function (BreadcrumbTrail $trail) {
    $trail->parent('os.index');
    $trail->push('Nova OS', route('os.create'));
});

// OS > [Visualização de OS]
Breadcrumbs::for('os.show', function (BreadcrumbTrail $trail, Os $item) {
    $trail->parent('os.index');
    $trail->push('#'.$item->id, route('os.show', $item));
});

// OS > [OS Name] > Editar OS
Breadcrumbs::for('os.edit', function (BreadcrumbTrail $trail, Os $item) {
    $trail->parent('os.index');
    $trail->push('#'.$item->id, route('os.edit', $item));
});

// OS > [OS Name] > Editar OS
Breadcrumbs::for('os.despesa.create', function (BreadcrumbTrail $trail, Os $item) {
    $trail->parent('os.index');
    $trail->push('#'.$item->id, route('os.edit', $item));
    $trail->push('Nova despesa Os: #'.$item->id);
});
// FIM Os

// Venda
Breadcrumbs::for('venda.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Vendas', route('venda.index'));
});

// Venda > Novo Venda
Breadcrumbs::for('venda.create', function (BreadcrumbTrail $trail) {
    $trail->parent('venda.index');
    $trail->push('Nova Venda', route('venda.create'));
});

// Venda > [Visualização de Venda]
Breadcrumbs::for('venda.show', function (BreadcrumbTrail $trail, Venda $item) {
    $trail->parent('venda.index');
    $trail->push('#'.$item->id, route('venda.show', $item));
});

// Venda > [Venda Name] > Editar Venda
Breadcrumbs::for('venda.edit', function (BreadcrumbTrail $trail, Venda $item) {
    $trail->parent('venda.index');
    $trail->push('#'.$item->id, route('venda.edit', $item));
});

// Venda > [Venda Name] > Editar Venda
Breadcrumbs::for('venda.despesa.create', function (BreadcrumbTrail $trail, Venda $item) {
    $trail->parent('venda.index');
    $trail->push('#'.$item->id, route('venda.edit', $item));
    $trail->push('Nova despesa Os: #'.$item->id);
});
// FIM Venda

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

// Serviços
Breadcrumbs::for('servico.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Serviços', route('servico.index'));
});

// Serviços > Novo Servico
Breadcrumbs::for('servico.create', function (BreadcrumbTrail $trail) {
    $trail->parent('servico.index');
    $trail->push('Novo Serviço', route('servico.create'));
});

// Serviços > [Visualização de Servico]
Breadcrumbs::for('servico.show', function (BreadcrumbTrail $trail, Servico $item) {
    $trail->parent('servico.index');
    $trail->push($item->name, route('servico.show', $item));
});

// Serviços > [Servico Name] > Editar Servico
Breadcrumbs::for('servico.edit', function (BreadcrumbTrail $trail, Servico $item) {
    $trail->parent('servico.index');
    $trail->push('Editar Serviço', route('servico.edit', $item));
});
// FIM Serviços

// Wiki
Breadcrumbs::for('wiki.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Wiki', route('wiki.index'));
});

// Wiki > Novo Wiki
Breadcrumbs::for('wiki.create', function (BreadcrumbTrail $trail) {
    $trail->parent('wiki.index');
    $trail->push('Nova Wiki', route('wiki.create'));
});

// Wiki > [Visualização de Wiki]
Breadcrumbs::for('wiki.show', function (BreadcrumbTrail $trail, Wiki $item) {
    $trail->parent('wiki.index');
    $trail->push($item->name, route('wiki.show', $item));
});

// Wiki > [Wiki Name] > Editar Wiki
Breadcrumbs::for('wiki.edit', function (BreadcrumbTrail $trail, Wiki $item) {
    $trail->parent('wiki.index');
    $trail->push('Editar Wiki', route('wiki.edit', $item));
});
// FIM Wiki

// Financeiro
// Despesas
Breadcrumbs::for('financeiro.despesa.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Financeiro');
    $trail->push('Despesas', route('financeiro.despesa.index'));
});

// Financeiro > Nova Despesa
Breadcrumbs::for('financeiro.despesa.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financeiro.despesa.index');
    $trail->push('Nova Despesa', route('financeiro.despesa.create'));
});

// Financeiro > [Visualização de Lançamento]
Breadcrumbs::for('financeiro.despesa.show', function (BreadcrumbTrail $trail, Contas $item) {
    $trail->parent('financeiro.despesa.index');
    $trail->push($item->name, route('financeiro.despesa.show', $item));
});

// Financeiro > [Lançamento Name] > Editar Lançamento
Breadcrumbs::for('financeiro.despesa.edit', function (BreadcrumbTrail $trail, Contas $item) {
    $trail->parent('financeiro.despesa.index');
    $trail->push('Editar Despesa', route('financeiro.despesa.edit', $item));
});

// Receitas
Breadcrumbs::for('financeiro.receita.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Financeiro');
    $trail->push('Receitas', route('financeiro.receita.index'));
});

// Financeiro > Nova Receita
Breadcrumbs::for('financeiro.receita.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financeiro.receita.index');
    $trail->push('Nova Receita', route('financeiro.receita.create'));
});

// Financeiro > [Visualização de Lançamento]
Breadcrumbs::for('financeiro.receita.show', function (BreadcrumbTrail $trail, Contas $item) {
    $trail->parent('financeiro.receita.index');
    $trail->push($item->name, route('financeiro.receita.show', $item));
});

// Financeiro > [Lançamento Name] > Editar Lançamento
Breadcrumbs::for('financeiro.receita.edit', function (BreadcrumbTrail $trail, Contas $item) {
    $trail->parent('financeiro.receita.index');
    $trail->push('Editar Receita', route('financeiro.receita.edit', $item));
});

//Metas Contábeis
Breadcrumbs::for('financeiro.meta_contabil.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Financeiro');
    $trail->push('Metas Contábeis', route('financeiro.meta_contabil.index'));
});

// Financeiro > Nova Meta Contábil
Breadcrumbs::for('financeiro.meta_contabil.create', function (BreadcrumbTrail $trail) {
    $trail->parent('financeiro.meta_contabil.index');
    $trail->push('Nova Meta Contábil', route('financeiro.meta_contabil.create'));
});

// Financeiro > [Visualização de Meta Contábil]
Breadcrumbs::for('financeiro.meta_contabil.show', function (BreadcrumbTrail $trail, MetaContabil $item) {
    $trail->parent('financeiro.meta_contabil.index');
    $trail->push($item->name, route('financeiro.meta_contabil.show', $item));
});

// Financeiro > [Meta Contábil Name] > Editar Meta Contábil
Breadcrumbs::for('financeiro.meta_contabil.edit', function (BreadcrumbTrail $trail, MetaContabil $item) {
    $trail->parent('financeiro.meta_contabil.index');
    $trail->push('Editar Meta Contábil', route('financeiro.meta_contabil.edit', $item));
});
// FIM Financeiro

// Checklist
Breadcrumbs::for('checklist.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Checklist', route('checklist.index'));
});

// Checklist > Novo Checklist
Breadcrumbs::for('checklist.create', function (BreadcrumbTrail $trail) {
    $trail->parent('checklist.index');
    $trail->push('Nova Checklist', route('checklist.create'));
});

// Checklist > [Visualização de Checklist]
Breadcrumbs::for('checklist.show', function (BreadcrumbTrail $trail, Checklist $item) {
    $trail->parent('checklist.index');
    $trail->push($item->name, route('checklist.show', $item));
});

// Checklist > [Checklist Name] > Editar Checklist
Breadcrumbs::for('checklist.edit', function (BreadcrumbTrail $trail, Checklist $item) {
    $trail->parent('checklist.index');
    $trail->push('Editar Checklist', route('checklist.edit', $item));
});
// FIM Checklist

// Produtos
Breadcrumbs::for('produto.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Produtos', route('produto.index'));
});

// Produtos > Novo produto
Breadcrumbs::for('produto.create', function (BreadcrumbTrail $trail) {
    $trail->parent('produto.index');
    $trail->push('Novo Produto', route('produto.create'));
});

// Produtos > [Visualização de produto]
Breadcrumbs::for('produto.show', function (BreadcrumbTrail $trail, Produto $item) {
    $trail->parent('produto.index');
    $trail->push($item->name, route('produto.show', $item));
});

// Produtos > [produto Name] > Editar produto
Breadcrumbs::for('produto.edit', function (BreadcrumbTrail $trail, Produto $item) {
    $trail->parent('produto.index');
    $trail->push('Editar Produto', route('produto.edit', $item));
});

// Produtos > Movimentação
Breadcrumbs::for('movimentacao.index', function (BreadcrumbTrail $trail, Produto $item) {
    $trail->parent('produto.index');
    $trail->push($item->name, route('produto.show', $item));
    $trail->push('Movimentação');
});

// Produtos > Movimentação
Breadcrumbs::for('movimentacao.create', function (BreadcrumbTrail $trail, Produto $item) {
    $trail->parent('produto.index');
    $trail->push($item->name, route('produto.show', $item));
    $trail->push('Adicionado Estoque');
});
// FIM Produtos

// Configuração > PARÂMETROS
// Status
Breadcrumbs::for('configuracao.parametro.status.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Parâmetros');
    $trail->push('Status', route('configuracao.parametro.status.index'));
});

// Status > Novo Status
Breadcrumbs::for('configuracao.parametro.status.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.parametro.status.index');
    $trail->push('Novo Status', route('configuracao.parametro.status.create'));
});

// Status > [Visualização de Status]
Breadcrumbs::for('configuracao.parametro.status.show', function (BreadcrumbTrail $trail, Status $item) {
    $trail->parent('configuracao.parametro.status.index');
    $trail->push($item->name, route('configuracao.parametro.status.show', $item));
});

// Status > [Status Name] > Editar Status
Breadcrumbs::for('configuracao.parametro.status.edit', function (BreadcrumbTrail $trail, Status $item) {
    $trail->parent('configuracao.parametro.status.index');
    $trail->push('Editar Status', route('configuracao.parametro.status.edit', $item));
});

// Categoria
Breadcrumbs::for('configuracao.parametro.categoria.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Parâmetros');
    $trail->push('Categoria', route('configuracao.parametro.categoria.index'));
});

// Categoria > Novo Categoria
Breadcrumbs::for('configuracao.parametro.categoria.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.parametro.categoria.index');
    $trail->push('Nova Categoria', route('configuracao.parametro.categoria.create'));
});

// Categoria > [Visualização de Categoria]
Breadcrumbs::for('configuracao.parametro.categoria.show', function (BreadcrumbTrail $trail, Categoria $item) {
    $trail->parent('configuracao.parametro.categoria.index');
    $trail->push($item->name, route('configuracao.parametro.categoria.show', $item));
});

// Categoria > [Categoria Name] > Editar Categoria
Breadcrumbs::for('configuracao.parametro.categoria.edit', function (BreadcrumbTrail $trail, Categoria $item) {
    $trail->parent('configuracao.parametro.categoria.index');
    $trail->push('Editar Categoria', route('configuracao.parametro.categoria.edit', $item));
});
// FIM - Configuração > PARÂMETROS

// Termo de Garantia
Breadcrumbs::for('configuracao.garantia.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Termos de Garantia', route('configuracao.garantia.index'));
});

// Termo de Garantia > Novo Termo de Garantia
Breadcrumbs::for('configuracao.garantia.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.garantia.index');
    $trail->push('Novo Termo de Garantia', route('configuracao.garantia.create'));
});

// Termo de Garantia > [Visualização de Termo de Garantia]
Breadcrumbs::for('configuracao.garantia.show', function (BreadcrumbTrail $trail, Garantia $item) {
    $trail->parent('configuracao.garantia.index');
    $trail->push($item->name, route('configuracao.garantia.show', $item));
});

// Termo de Garantia > [Termo de Garantia Name] > Editar Termo de Garantia
Breadcrumbs::for('configuracao.garantia.edit', function (BreadcrumbTrail $trail, Garantia $item) {
    $trail->parent('configuracao.garantia.index');
    $trail->push('Editar Termo de Garantia', route('configuracao.garantia.edit', $item));
});

// Fim Configuração OS

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

// Forma de Pagamento
Breadcrumbs::for('configuracao.financeiro.forma_pagamento.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Financeiro');
    $trail->push('Forma de Pagamento', route('configuracao.financeiro.forma_pagamento.index'));
});

// Forma de Pagamento > Novo Forma de Pagamento
Breadcrumbs::for('configuracao.financeiro.forma_pagamento.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.financeiro.forma_pagamento.index');
    $trail->push('Nova Forma de Pagamento', route('configuracao.financeiro.forma_pagamento.create'));
});

// Forma de Pagamento > [Visualização de Forma de Pagamento]
Breadcrumbs::for('configuracao.financeiro.forma_pagamento.show', function (BreadcrumbTrail $trail, FormaPagamento $item) {
    $trail->parent('configuracao.financeiro.forma_pagamento.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.financeiro.forma_pagamento.show', $item));
});

// Forma de Pagamento > [Forma de Pagamento Name] > Editar Forma de Pagamento
Breadcrumbs::for('configuracao.financeiro.forma_pagamento.edit', function (BreadcrumbTrail $trail, FormaPagamento $item) {
    $trail->parent('configuracao.financeiro.forma_pagamento.index');
    $trail->push('Editar Forma de Pagamento', route('configuracao.financeiro.forma_pagamento.edit', $item));
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
    $trail->push('Novo Perfil', route('configuracao.roles.create'));
});

// Perfis > [Visualização de Perfis]
Breadcrumbs::for('configuracao.roles.show', function (BreadcrumbTrail $trail, Role $item) {
    $trail->parent('configuracao.roles.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.roles.show', $item));
});

// Perfis > [Perfis Name] > Editar Perfis
Breadcrumbs::for('configuracao.roles.edit', function (BreadcrumbTrail $trail, Role $item) {
    $trail->parent('configuracao.roles.index');
    $trail->push('Editar Perfil', route('configuracao.roles.edit', $item));
});

// Perfis > [Perfis Name] > Permissões
Breadcrumbs::for('configuracao.roles.assign', function (BreadcrumbTrail $trail, Role $item) {
    $trail->parent('configuracao.roles.index');
    $trail->push('Permissões: '.$item->name, route('configuracao.roles.assign', $item));
});

// Perfis > Permissões
Breadcrumbs::for('configuracao.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.roles.index');
    $trail->push('Permissões', route('configuracao.permissions.index'));
});

// Perfis > Nova Permissão
Breadcrumbs::for('configuracao.permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.permissions.index');
    $trail->push('Nova Permissão', route('configuracao.permissions.create'));
});

// Perfis > [Permissão Name] > Editar Permissão
Breadcrumbs::for('configuracao.permissions.edit', function (BreadcrumbTrail $trail, Permission $item) {
    $trail->parent('configuracao.permissions.index');
    $trail->push('Editar Permissões', route('configuracao.permissions.edit', $item));
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
    $trail->push('Permissões: '.$item->name, route('configuracao.users.permissions_edit', $item));
});

// Perfil
Breadcrumbs::for('configuracao.user.perfil.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Perfil', route('configuracao.user.perfil.index'));
});

// Perfil > [Usuário Name] > Editar perfil
Breadcrumbs::for('configuracao.user.perfil.edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Editar: '.Auth::user()->name, route('configuracao.user.perfil.edit'));
});

// FIM Configuração Usuários

// Configuração WIKI
// Fabricante
Breadcrumbs::for('configuracao.wiki.fabricante.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Wiki');
    $trail->push('Fabricante', route('configuracao.wiki.fabricante.index'));
});

// Fabricante > Novo Fabricante
Breadcrumbs::for('configuracao.wiki.fabricante.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.wiki.fabricante.index');
    $trail->push('Novo Fabricante', route('configuracao.wiki.fabricante.create'));
});

// Fabricante > [Visualização de Fabricante]
Breadcrumbs::for('configuracao.wiki.fabricante.show', function (BreadcrumbTrail $trail, Fabricante $item) {
    $trail->parent('configuracao.wiki.fabricante.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.wiki.fabricante.show', $item));
});

// Fabricante > [Fabricante Name] > Editar Fabricante
Breadcrumbs::for('configuracao.wiki.fabricante.edit', function (BreadcrumbTrail $trail, Fabricante $item) {
    $trail->parent('configuracao.wiki.fabricante.index');
    $trail->push('Editar Fabricante', route('configuracao.wiki.fabricante.edit', $item));
});

// Modelo
Breadcrumbs::for('configuracao.wiki.modelo.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Wiki');
    $trail->push('Modelo', route('configuracao.wiki.modelo.index'));
});

// Modelo > Novo Modelo
Breadcrumbs::for('configuracao.wiki.modelo.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.wiki.modelo.index');
    $trail->push('Novo Modelo', route('configuracao.wiki.modelo.create'));
});

// Modelo > [Visualização de Modelo]
Breadcrumbs::for('configuracao.wiki.modelo.show', function (BreadcrumbTrail $trail, Modelo $item) {
    $trail->parent('configuracao.wiki.modelo.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.wiki.modelo.show', $item));
});

// Modelo > [Modelo Name] > Editar Modelo
Breadcrumbs::for('configuracao.wiki.modelo.edit', function (BreadcrumbTrail $trail, Modelo $item) {
    $trail->parent('configuracao.wiki.modelo.index');
    $trail->push('Editar Modelo', route('configuracao.wiki.modelo.edit', $item));
});
// Fim Configuração WIKI

// Configuração Sistema
// Sistema
Breadcrumbs::for('configuracao.sistema.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Sistema', route('configuracao.sistema.index'));
});

// Sistema > Novo Sistema
Breadcrumbs::for('configuracao.sistema.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.sistema.index');
    $trail->push('Novo Sistema', route('configuracao.sistema.create'));
});

// Sistema > [Visualização de Sistema]
Breadcrumbs::for('configuracao.sistema.show', function (BreadcrumbTrail $trail, SistemaConfig $item) {
    $trail->parent('configuracao.sistema.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.sistema.show', $item));
});

// Sistema > [Sistema Name] > Editar Sistema
Breadcrumbs::for('configuracao.sistema.edit', function (BreadcrumbTrail $trail, SistemaConfig $item) {
    $trail->parent('configuracao.sistema.index');
    $trail->push('Editar Sistema', route('configuracao.sistema.edit', $item));
});
// Fim Configuração Sistema

// Configuração Emitente
// Emitente
Breadcrumbs::for('configuracao.emitente.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Emitente', route('configuracao.sistema.index'));
});

// Emitente > Novo Emitente
Breadcrumbs::for('configuracao.emitente.create', function (BreadcrumbTrail $trail) {
    $trail->parent('configuracao.emitente.index');
    $trail->push('Novo Emitente', route('configuracao.emitente.create'));
});

// Emitente > [Visualização de Emitente]
Breadcrumbs::for('configuracao.emitente.show', function (BreadcrumbTrail $trail, Emitente $item) {
    $trail->parent('configuracao.emitente.index');
    $trail->push(Str::limit($item->name, 20), route('configuracao.emitente.show', $item));
});

// Emitente > [Emitente Name] > Editar Emitente
Breadcrumbs::for('configuracao.emitente.edit', function (BreadcrumbTrail $trail, Emitente $item) {
    $trail->parent('configuracao.emitente.index');
    $trail->push('Editar Emitente', route('configuracao.emitente.edit', $item));
});
// Fim Configuração Emitente

// Configuração Backup
// Backup
Breadcrumbs::for('configuracao.backup.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Configurações');
    $trail->push('Backup', route('configuracao.backup.index'));
});
// Fim Configuração Backup

// Relatório
// Financeiro Balancete
Breadcrumbs::for('relatorio.financeiro.balancete.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Relatórios');
    $trail->push('Balancete', route('relatorio.financeiro.balancete.index'));
});
// Financeiro Despesa
Breadcrumbs::for('relatorio.financeiro.despesa.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Relatórios');
    $trail->push('Despesa', route('relatorio.financeiro.despesa.index'));
});
// Financeiro Contas em Aberto 
Breadcrumbs::for('relatorio.financeiro.conta_aberta.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Relatórios');
    $trail->push('Contas em Aberto', route('relatorio.financeiro.conta_aberta.index'));
});
// Relatório
