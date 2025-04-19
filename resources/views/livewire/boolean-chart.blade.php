<div>
    <canvas id="donut-chart-{{ $question->id }}" width="400" height="200"></canvas>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const trueCount = {{ $question->poll_question_answers->where('answer', true)->count() }};
        const falseCount = {{ $question->poll_question_answers->where('answer', false)->count() }};
        const total = trueCount + falseCount;
        const truePercentage = total > 0 ? Math.round((trueCount / total) * 100) : 0;
        const falsePercentage = total > 0 ? Math.round((falseCount / total) * 100) : 0;

        new Chart(document.getElementById('donut-chart-{{ $question->id }}'), {
            type: 'doughnut',
            data: {
                labels: [`Sí (${trueCount} - ${truePercentage}%)`, `No (${falseCount} - ${falsePercentage}%)`],
                datasets: [{
                    label: 'Boolean Chart',
                    data: [trueCount, falseCount],
                    backgroundColor: ['#4ade80', '#f87171'],
                    hoverOffset: 4
                }]
            },
            options: {
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const value = context.raw;
                                const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                return `${value} respuestas (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    });
</script>

</div>
