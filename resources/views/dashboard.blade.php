    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight text-center">
                {{ __('Dashboard') }}
            </h2>
        </x-slot>

        <div class="py-12 m-2 flex flex-wrap">
            <div class="chart-container m-2" style="position: relative; width:25vw; height: 25vw;">
                <canvas id="myChart"></canvas>
            </div>

            <div class="chart-container m-2" style="position: relative; width:25vw; height: 25vw;">
                <canvas id="myChart2"></canvas>
            </div>

            <div class="chart-container m-2" style="position: relative; width:28vw; height: 25vw;">
                <canvas id="myChart3"></canvas>
            </div>

            <div class="chart-container m-2" style="position: relative; width:25vw; height: 25vw;">
                <canvas id="myChart4"></canvas>
            </div>

            <div class="d-flex" style="margin-right: 20px;">
                <div class="max-w-sm bg-yellow-500 border-gray-300 p-6 rounded-lg tracking-wide shadow-lg text-yellow-50" style="position: relative; width:25vw;">
                    <div id="header" class="flex items-center mb-4 text-2xl">
                        <strong>Perhitungan jumlah</strong>
                    </div>
                    <p style="max-height: 12vw; overflow-y: auto;">
                        <strong class="text-2xl">{{ $jemaat }}</strong> orang jemaat<br />
                        <strong class="text-2xl">{{ $keluarga }}</strong> Kepala keluarga<br />
                        <strong class="text-2xl">{{ $sintuaData->sum('jumlah_sintua') }}</strong> jumlah Sintua
                    </p>
                </div>
        </div>



            <script>
                let myChart = document.getElementById('myChart').getContext('2d');
                var count_jk = <?php echo json_encode($count_jk); ?>;

                var myDoughnutChart = new Chart(myChart, {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-Laki', 'Perempuan', 'Lainnya'],
                        datasets: [{
                            label: 'Jumlah Jenis Kelamin',
                            backgroundColor: ['#19AADE','#DB4CB2','rgb(100, 100, 255)'],
                            data: count_jk
                        }]
                    },
                    options: {}
                });

                let myChart2 = document.getElementById('myChart2').getContext('2d');
                var count_golda = <?php echo json_encode($count_golda); ?>;

                var myDoughnutChart2 = new Chart(myChart2, {
                    type: 'doughnut',
                    data: {
                        labels: ['A', 'B', 'AB', 'O', 'Lainnya'],
                        datasets: [{
                            label: 'Jumlah Golongan Darah',
                            backgroundColor: ['#19AADE','#DB4CB2','#1DE4BD', '#7D3AC1', 'rgb(100, 100, 255)'],
                            data: count_golda
                        }]
                    },
                    options: {}
                });

                let myChart3 = document.getElementById('myChart3').getContext('2d');
                var sektorData = <?php echo json_encode($sektorData); ?>;

                var sektorLabels = sektorData.map(item => 'KK ' + item.nama_sektor);
                var sektorJumlahKK = sektorData.map(item => item.jumlah_kk);

                var myDoughnutChart3 = new Chart(myChart3, {
                    type: 'doughnut',
                    data: {
                        labels: sektorLabels,
                        datasets: [{
                            label: 'Jumlah Kepala Keluarga',
                            backgroundColor: [
                                '#19AADE', '#DB4CB2', '#1DE4BD', '#7D3AC1', 'rgb(100, 100, 255)',
                                'red', 'green', 'blue', 'orange', 'purple', 'pink', 'brown', 'gray'
                            ],
                            data: sektorJumlahKK
                        }]
                    },
                    options: {}
                });

                let myChart4 = document.getElementById('myChart4').getContext('2d');
                var sintuaData = <?php echo json_encode($sintuaData); ?>;

                var sintuaLabels = sintuaData.map(item => 'Sintua ' + item.nama_sektor);
                var sintuaJumlahSintua = sintuaData.map(item => item.jumlah_sintua);

                var myDoughnutChart4 = new Chart(myChart4, {
                    type: 'doughnut',
                    data: {
                        labels: sintuaLabels,
                        datasets: [{
                            label: 'Jumlah Sintua',
                            backgroundColor: [
                                '#19AADE', '#DB4CB2', '#1DE4BD', '#7D3AC1', 'rgb(100, 100, 255)',
                                'red', 'green', 'blue', 'orange', 'purple', 'pink', 'brown', 'gray'
                            ],
                            data: sintuaJumlahSintua
                        }]
                    },
                    options: {}
                });
            </script>
        </div>
        <div>&nbsp;<br></div>
        <div class="py-12" style="clear: both">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>
