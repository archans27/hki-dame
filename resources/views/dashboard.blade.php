<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 m-2">
            <div class="grid-cols-6 chart-container" style="position: relative; width:25vw; float:left;">
                <canvas id="myChart"></canvas>
            </div>
            <div class="grid-cols-6 chart-container" style="position: relative; width:25vw; float:left;">
                <canvas id="myChart2"></canvas>
            </div>
            <div class="max-w-sm bg-yellow-500 border-gray-300 p-6 rounded-lg tracking-wide shadow-lg text-yellow-50" style="position: relative; width:25vw; float:left;">
                <div id="header" class="flex items-center mb-4 text-2xl"> 
                    <strong>Perhitungan jumlah</strong>
                </div>
                <p class="">
                    <strong class="text-2xl">2045</strong> orang jemaat<br/> <strong class="text-2xl">403</strong> Kepala keluarga
                </p>
             </div>

            <div>

        <script>
            let myChart = document.getElementById('myChart').getContext('2d');
            
            var myDoughnutChart = new Chart(myChart, {
                type: 'doughnut',
                data: {
                    labels: ['Laki-Laki', 'Perempuan', 'Lainnya'],
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: ['#19AADE','#DB4CB2','rgb(100, 100, 255)'],
                        data: [55, 57, 5]
                    }]
                },
               options:{} 
            });

            let myChart2 = document.getElementById('myChart2').getContext('2d');
            
            var myDoughnutChart = new Chart(myChart2, {
                type: 'doughnut',
                data: {
                    labels: [ 'SMP', 'SMA', 'Kuliah', 'Bekerja'],
                    datasets: [{
                        label: 'My First dataset',
                        backgroundColor: ['#DB4CB2','#1DE4BD', '#7D3AC1', '#EE9A3A'],
                        data: [ 10, 5, 2, 20]
                    }]
                },
               options:{} 
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
