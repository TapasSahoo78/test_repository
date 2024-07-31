<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('tripStatusChart').getContext('2d');
        var tripStatusChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Booked', 'On going Trip', 'Completed Trips'],
                datasets: [{
                    label: 'Trip Status',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: ['#007bff', '#fd7e14', '#6c757d'],
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Trip Status'
                    }
                }
            }
        });

        var ctx2 = document.getElementById('paymentStatusChart').getContext('2d');
        var paymentStatusChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: {!! json_encode($paymentData['labels']) !!},
                datasets: [{
                    label: 'Payment Level',
                    data: {!! json_encode($paymentData['values']) !!},
                    backgroundColor: 'rgba(0, 123, 255, 0.5)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50000
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Payment Level'
                    }
                }
            }
        });

        $('#monthlyChart').change(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('ajax.get.get.chart.data') }}",
                data: { type: $(this).val() },
                success: function(response) {
                    tripStatusChart.data.datasets[0].data = response.chartData;
                    tripStatusChart.update();
                }
            });
        });

        $('#paymentChart').change(function() {
            $.ajax({
                type: 'GET',
                url: "{{ route('ajax.get.get.chart.data') }}",
                data: { type: $(this).val() },
                success: function(response) {
                    paymentStatusChart.data.labels = response.paymentData.labels;
                    paymentStatusChart.data.datasets[0].data = response.paymentData.values;
                    paymentStatusChart.update();
                }
            });
        });
    });
</script>