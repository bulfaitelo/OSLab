<div>
    <div class="card custom-border">
        <div class="card-header pb-0 border-0 pr-3 pl-3">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Atendimentos Finalizados por Categoria</h3>
                {{-- <a href="http://oslab.teste/os/create">
                    <button type="button" class="btn btn-sm btn-oslab">
                        Ver Todas
                    </button>
                </a> --}}
            </div>
        </div>
        <div style="height: 285px;" class="card-body p-3">
            <canvas id="atendimentosCategoriaChart"></canvas>
        </div>
    </div>
</div>
<script>
const lines = document.getElementById('atendimentosCategoriaChart');

document.addEventListener('livewire:init', function () {
    new Chart(lines, {
        type: 'line',
        data: {
            labels: {!! $labels !!},
            datasets: {!! $data !!},            
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,            
            plugins: {
                legend: {
                    position: 'left'
                }
            },
            interaction: {
                mode: 'index',
                intersect: true
            },
            scales: {
                y: {
                    beginAtZero: false,
                    grid: {
                        display: false,
                    },
                    ticks: {
                        precision: 0
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
</script>

