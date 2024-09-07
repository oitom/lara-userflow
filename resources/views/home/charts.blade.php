<div class="row">
  <div class="col-md-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Número de Usuários por Estado</h5>
        <canvas id="usersByStateChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Distribuição de Idade dos Usuários</h5>
        <canvas id="ageDistributionChart"></canvas>
      </div>
    </div>
  </div>

  <div class="col-md-4 mb-4">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Número de Usuários por Cidade</h5>
        <canvas id="usersByCityChart"></canvas>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  // Gráfico de usuários por estado
  const usersByStateData = @json($usersByState);
  const stateLabels = Object.keys(usersByStateData);
  const stateCounts = Object.values(usersByStateData);

  new Chart(document.getElementById('usersByStateChart'), {
    type: 'bar',
    data: {
      labels: stateLabels,
      datasets: [{
        label: 'Número de Usuários',
        data: stateCounts,
        backgroundColor: 'rgba(54, 162, 235, 0.2)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
          }
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Estado'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Número de Usuários',
            beginAtZero: true
          }
        }
      }
    }
  });

  // Gráfico de distribuição de idade
  const ageDistributionData = @json($ageDistributionData);
  const ageLabels = Object.keys(ageDistributionData);
  const ageCounts = Object.values(ageDistributionData);

  new Chart(document.getElementById('ageDistributionChart'), {
    type: 'pie',
    data: {
      labels: ageLabels,
      datasets: [{
        label: 'Distribuição de Idade',
        data: ageCounts,
        backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(255, 206, 86, 0.2)', 'rgba(75, 192, 192, 0.2)', 'rgba(153, 102, 255, 0.2)'],
        borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)'],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
          }
        }
      }
    }
  });

  // Gráfico de usuários por cidade
  const usersByCityData = @json($usersByCity);
  const cityLabels = Object.keys(usersByCityData);
  const cityCounts = Object.values(usersByCityData);

  new Chart(document.getElementById('usersByCityChart'), {
    type: 'bar',
    data: {
      labels: cityLabels,
      datasets: [{
        label: 'Número de Usuários',
        data: cityCounts,
        backgroundColor: 'rgba(255, 159, 64, 0.2)',
        borderColor: 'rgba(255, 159, 64, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: true
        },
        tooltip: {
          callbacks: {
            label: function(tooltipItem) {
              return tooltipItem.label + ': ' + tooltipItem.raw;
            }
          }
        }
      },
      scales: {
        x: {
          title: {
            display: true,
            text: 'Cidade'
          }
        },
        y: {
          title: {
            display: true,
            text: 'Número de Usuários',
            beginAtZero: true
          }
        }
      }
    }
  });
</script>
@endpush
