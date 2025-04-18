<div>
    <canvas id="donut-chart-{{ $question->id }}" width="400" height="200"></canvas>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Chart(document.getElementById('donut-chart-{{ $question->id }}'), {
            type: 'doughnut',
            data: {
                labels: ['Sí', 'No'],
                datasets: [{
                    data: [
                        {{ $question->answers->where('value', true)->count() }},
                        {{ $question->answers->where('value', false)->count() }}
                    ],
                    backgroundColor: ['#4ade80', '#f87171'],
                }]
            },
        });
    });
</script>

</div>
