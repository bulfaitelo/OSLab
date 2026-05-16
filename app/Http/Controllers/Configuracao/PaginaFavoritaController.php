<?php

namespace App\Http\Controllers\Configuracao;

use App\Http\Controllers\Controller;
use App\Models\OsLab\PaginaFavorita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaginaFavoritaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $favoritas = PaginaFavorita::where('user_id', $user->id)
            ->orderBy('order')
            ->get();

        return view('configuracao.pagina-favorita.index', [
            'favoritas' => $favoritas,
            'colors' => PaginaFavorita::AVAILABLE_COLORS,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaginaFavorita $paginaFavorita)
    {
        $this->authorize('update', $paginaFavorita);

        return view('configuracao.pagina-favorita.edit', [
            'favorita' => $paginaFavorita,
            'colors' => PaginaFavorita::AVAILABLE_COLORS,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaginaFavorita $paginaFavorita)
    {
        $this->authorize('update', $paginaFavorita);

        $validated = $request->validate([
            'text' => 'required|string|max:255',
            'color' => 'required|in:'.implode(',', array_keys(PaginaFavorita::AVAILABLE_COLORS)),
        ]);

        $paginaFavorita->update($validated);

        return redirect()->route('configuracao.pagina-favorita.index')
            ->with('success', 'Página favorita atualizada com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaginaFavorita $paginaFavorita)
    {
        $this->authorize('delete', $paginaFavorita);

        $paginaFavorita->delete();

        return redirect()->route('configuracao.pagina-favorita.index')
            ->with('success', 'Página favorita removida com sucesso!');
    }

    /**
     * Update the order of favorites via AJAX.
     */
    public function updateOrder(Request $request)
    {
        $user = Auth::user();
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            PaginaFavorita::where('id', $id)
                ->where('user_id', $user->id)
                ->update(['order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
