<?php include('../../../templates/headerconstructora.php') ?>

<title>Gráficos con Búsqueda en Chart.js y Bootstrap 5</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>





<div class="container my-4">
    <h2 class="text-center">Gráfico por Proyecto o Radicado</h2>
    </br>
    </br>
    <!-- Formulario de Búsqueda -->
    <form id="searchForm" class="row g-3">
        <div class="col-md-3">
            <label for="startDate" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="startDate">
        </div>
        <div class="col-md-3">
            <label for="endDate" class="form-label">Fecha Final</label>
            <input type="date" class="form-control" id="endDate">
        </div>
        <div class="col-md-3">
            <label for="project" class="form-label">Proyecto</label>
            <select class="form-select" id="project">
                <option selected>Seleccione...</option>
                <option value="1">Proyecto 1</option>
                <option value="2">Proyecto 2</option>
                <option value="3">Proyecto 3</option>
            </select>
        </div>        
        <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="filterData()">Buscar</button>
        </div>
    </form>

    <!-- Contenedor del Gráfico -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-8">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    
    <!-- Título y Botones de Descarga -->
    <div class="row justify-content-center mt-4">
        <div class="col-12 text-center">
            <h3>Descarga el informe consultado</h3>
            <p>Para poder descargar el informe debe agregar un rango de fecha y proyecto</p>
        </div>
        <div class="col-12 text-center">
            <div class="btn-group" role="group" aria-label="Botones de descarga">
                <button type="button" class="btn btn-outline-primary">Radicación</button>
                <button type="button" class="btn btn-outline-primary">Digitación</button>
                <button type="button" class="btn btn-outline-primary">Facturación</button>
                <button type="button" class="btn btn-outline-primary">Informe 4</button>
                <button type="button" class="btn btn-outline-primary">Informe 5</button>
                <button type="button" class="btn btn-outline-primary">Informe 6</button>
                <button type="button" class="btn btn-outline-primary">Informe 7</button>
                <button type="button" class="btn btn-outline-primary">Informe 8</button>
                <button type="button" class="btn btn-outline-primary">Informe 9</button>
                <button type="button" class="btn btn-outline-primary">Informe 10</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Datos de ejemplo
    const rawData = [
        { date: '2024-01-01', project: '1', radicado: 'A123', value: 12 },
        { date: '2024-01-02', project: '2', radicado: 'B456', value: 19 },
        { date: '2024-01-03', project: '3', radicado: 'C789', value: 3 },
        { date: '2024-01-04', project: '1', radicado: 'D101', value: 5 },
        { date: '2024-01-05', project: '2', radicado: 'E112', value: 2 },
        { date: '2024-01-06', project: '3', radicado: 'F131', value: 3 },
    ];

    const ctx = document.getElementById('myChart').getContext('2d');
    let myChart;

    function renderChart(data) {
        const labels = data.map(item => item.date);
        const values = data.map(item => item.value);

        if (myChart) {
            myChart.destroy();
        }

        myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Ventas',
                    data: values,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    function filterData() {
        const startDate = document.getElementById('startDate').value;
        const endDate = document.getElementById('endDate').value;
        const project = document.getElementById('project').value;
        const radicado = document.getElementById('radicado').value.toLowerCase();

        const filteredData = rawData.filter(item => {
            const itemDate = new Date(item.date);
            const isWithinDateRange = (!startDate || new Date(startDate) <= itemDate) && (!endDate || itemDate <= new Date(endDate));
            const isMatchingProject = !project || item.project === project;
            const isMatchingRadicado = !radicado || item.radicado.toLowerCase().includes(radicado);

            return isWithinDateRange && isMatchingProject && isMatchingRadicado;
        });

        renderChart(filteredData);
    }

    // Renderizar gráfico inicial con todos los datos
    renderChart(rawData);
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>





<?php include('../../../templates/footerconstructora.php') ?>