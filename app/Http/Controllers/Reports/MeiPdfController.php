<?php

declare(strict_types=1);

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Services\Relatorio\MeiReportService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MeiPdfController extends Controller
{
    public function __construct(
        private readonly MeiReportService $reportService
    ) {
        $this->middleware('permission:relatorio_financeiro_declaracao_mei', ['only' => ['index', '__invoke']]);
    }

    public function index()
    {
        return view('relatorio.financeiro.declaracao_mei.index');
    }

    public function __invoke(Request $request): Response
    {
        $validated = $request->validate([
            'type' => 'required|in:monthly,yearly',
            'year' => 'required|integer|min:2009|max:'.((int) now()->format('Y') + 1),
        ]);

        $year = (int) $validated['year'];
        $type = (string) $validated['type'];

        $report = $this->reportService->getReportData($type, $year);

        $pdf = Pdf::loadView('relatorio.financeiro.declaracao_mei.pdf', [
            'records' => $report['records'],
            'totals' => $report['totals'],
            'year' => $year,
            'type' => $type,
            'generatedAt' => now(),
        ])->setPaper('a4');

        return $pdf->stream('declaracao_mei_'.$year.'_'.$type.'.pdf');
    }
}
