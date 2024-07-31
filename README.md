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
                        responsive: false, // Disable responsive behavior
                        maintainAspectRatio: false, // Prevent chart resizing
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Trip Status'
                            }
                        }
                    },
                });

                var ctx = document.getElementById('paymentStatusChart').getContext('2d');
                var paymentStatusChart = new Chart(ctx, {
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
                        responsive: false, // Disable responsive behavior
                        maintainAspectRatio: false, // Prevent chart resizing
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
                    },
                });
            });
        </script>
        <script>
            $(document).on('change', '#monthlyChart', function() {
                // alert("111111111111111")
                $.ajax({
                    type: 'GET',
                    url: "{{ route('ajax.get.get.chart.data') }}",
                    data: {
                        type: $(this).val()
                    },
                    success: function(response) {
                        // alert("success")
                        var cttx = document.getElementById('tripStatusChart').getContext('2d');
                        var tripStatusChart = new Chart(cttx, {
                            type: 'pie',
                            data: {
                                labels: ['Booked', 'On going Trip', 'Completed Trips'],
                                datasets: [{
                                    label: 'Trip Status',
                                    data: [10, 20,
                                        70
                                    ],
                                    backgroundColor: ['#007bff', '#fd7e14', '#6c757d'],
                                }]
                            },
                            options: {
                                responsive: false, // Disable responsive behavior
                                maintainAspectRatio: false, // Prevent chart resizing
                                plugins: {
                                    legend: {
                                        position: 'top',
                                    },
                                    title: {
                                        display: true,
                                        text: 'Trip Status'
                                    }
                                }
                            },
                        });
                    }
                });
            });

            $(document).on('change', '#paymentChart', function() {
                alert("22222222")
                $.ajax({
                    type: 'GET',
                    url: "{{ route('ajax.get.get.chart.data') }}",
                    data: {
                        type: $(this).val()
                    },
                    success: function(response) {
                        alert("success");
                        var ctxx = document.getElementById('paymentStatusChart').getContext('2d');
                        var paymentStatusChart = new Chart(ctxx, {
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
                                responsive: false, // Disable responsive behavior
                                maintainAspectRatio: false, // Prevent chart resizing
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        max: 5
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
                            },
                        });
                    }
                });
            });
        </script>
