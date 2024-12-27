<div>
    <div class="card custom-border">
        <div class="card-header pb-0 border-0 pr-3 pl-3">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Receitas Recebidas</h3>
                {{-- <a href="http://oslab.teste/os/create">
                    <button type="button" class="btn btn-sm btn-oslab">
                        Ver Todas
                    </button>
                </a> --}}
            </div>
        </div>
        <div style="height:350px; " class="card-body pl-3 pr-3 pb-3 pt-1">
            <canvas id="receitasChart" ></canvas>
        </div>
    </div>
</div>

<script>
const ctx = document.getElementById('receitasChart');
document.addEventListener('livewire:init', function () {
    new Chart(ctx, {
        type: 'bar',
        data: {!! json_encode($data) !!},
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return "R$ "+(tooltipItem.parsed.y).toLocaleString('pt-BR');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        callback: function(value, index, values) {
                            return value.toLocaleString("pt-BR",{style:"currency", currency:"BRL"});
                        }
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
