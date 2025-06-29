@extends('Dashboard.master')
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
            @if ($showBadge == true)
                <span class="badge badge-success">🔥 You’re on a 3-day+ mood streak!</span>
            @endif
        </div>
    </div>

    <h3>Weekly Mood Summary</h3>
    <canvas id="weeklyMoodChart" height="120"></canvas>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <script>
        const ctx = document.getElementById('weeklyMoodChart').getContext('2d');

        const weeklyMoodChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($moodCounts)) !!},
                datasets: [{
                    label: 'Mood Count',
                    data: {!! json_encode(array_values($moodCounts)) !!},
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.7)', // Happy
                        'rgba(255, 99, 132, 0.7)', // Sad
                        'rgba(255, 159, 64, 0.7)', // Angry
                        'rgba(153, 102, 255, 0.7)' // Excited
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 5
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endsection
