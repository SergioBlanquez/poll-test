<div>
    <div>
        <canvas id="bar-chart-{{ $question->id }}" width="400" height="200"></canvas>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const Count0to20 = {{ $question->poll_question_answers->whereBetween('answer', [0, 20])->count() }};
            const Count21to40 = {{ $question->poll_question_answers->whereBetween('answer', [21, 40])->count() }};
            const Count41to60 = {{ $question->poll_question_answers->whereBetween('answer', [41, 60])->count() }};
            const Count61to80 = {{ $question->poll_question_answers->whereBetween('answer', [61, 80])->count() }};
            const Count81to100 = {{ $question->poll_question_answers->whereBetween('answer', [81, 100])->count() }};
            const total = Count0to20 + Count21to40 + Count41to60 + Count61to80 + Count81to100;
            const Count0to20Percentage = total > 0 ? Math.round((Count0to20 / total) * 100) : 0;
            const Count21to40Percentage = total > 0 ? Math.round((Count21to40 / total) * 100) : 0;
            const Count41to60Percentage = total > 0 ? Math.round((Count41to60 / total) * 100) : 0;
            const Count61to80Percentage = total > 0 ? Math.round((Count61to80 / total) * 100) : 0;
            const Count81to100Percentage = total > 0 ? Math.round((Count81to100 / total) * 100) : 0;
    
            new Chart(document.getElementById('bar-chart-{{ $question->id }}'), {
                type: 'bar',
                data: {
                    labels: [
                        `0-20 (${Count0to20} - ${Count0to20Percentage}%)`, 
                        `21-40 (${Count21to40} - ${Count21to40Percentage}%)`, 
                        `41-60 (${Count41to60} - ${Count41to60Percentage}%)`, 
                        `61-80 (${Count61to80} - ${Count61to80Percentage}%)`, 
                        `81-100 (${Count81to100} - ${Count81to100Percentage}%)`
                    ],
                    datasets: [{
                        label: 'Porcentaje de respuestas',
                        data: [
                            Count0to20Percentage, 
                            Count21to40Percentage, 
                            Count41to60Percentage, 
                            Count61to80Percentage, 
                            Count81to100Percentage
                        ],
                        backgroundColor: ['#4ade80', '#f87171', '#fbbf24', '#60a5fa', '#a78bfa'],
                        hoverOffset: 4
                    }]
                },
                options: {
                    plugins: {
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    const value = context.raw;
                                    return `${value}%`;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
    
    </div>
    
</div>
