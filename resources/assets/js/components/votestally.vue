<template>
    <div class="row">
        <!-- <div v-for="data in getData" v-bind:key="data.position_id" class='col-sm-6'> -->
        <div class='col-sm-6'>
            <div class='box box-solid'>
                <div class='box-header with-border'>
                    <h4 class='box-title'><b></b></h4>
                </div>
                <div class='box-body'>
                    <div class='chart'>
                        <span v-html="getData.canvas"></span>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            getData:[],            
            description:''
        }        
    },
    created(){
        this.fetchBallotDatas()
    },
    methods:{
        fetchBallotDatas(){
            let vm = this
            fetch('../api/get_all_data')
            .then(res => res.json())
            .then(res => {
                this.getData = res
                this.description=res.data[0].description
                // vm.init(this.getData.data[0])
            })
            .catch(err => console.log(err));
        },
        init(element){
            let vm = this;
            // this.getData.forEach(function(element) {
                
                var label=[];
                var data=[];
                element.candidates.forEach(function(candidate){
                    label.push(candidate.lastname+", "+candidate.firstname.charAt(0).toUpperCase()+candidate.firstname.charAt(1).toUpperCase())
                    data.push(candidate.votes.length)
                })
                
                vm.chart(label,data,element);
                
            // });
        },
        chart(label,data,element){
            
            var description = element.description;
            console.log($('#'+description))
                var barChartCanvas = $('#'+description).get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = {
                    labels  :JSON.stringify(label) ,
                    datasets: [
                        {
                            label               : 'Votes',
                            fillColor           : 'rgba(60,141,188,0.9)',
                            strokeColor         : 'rgba(60,141,188,0.8)',
                            pointColor          : '#3b8bba',
                            pointStrokeColor    : 'rgba(60,141,188,1)',
                            pointHighlightFill  : '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data                : JSON.stringify(data)
                        }
                    ]
                }
                var barChartOptions                  = {
                    //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                    scaleBeginAtZero        : true,
                    //Boolean - Whether grid lines are shown across the chart
                    scaleShowGridLines      : true,
                    //String - Colour of the grid lines
                    scaleGridLineColor      : 'rgba(0,0,0,.05)',
                    //Number - Width of the grid lines
                    scaleGridLineWidth      : 1,
                    //Boolean - Whether to show horizontal lines (except X axis)
                    scaleShowHorizontalLines: true,
                    //Boolean - Whether to show vertical lines (except Y axis)
                    scaleShowVerticalLines  : true,
                    //Boolean - If there is a stroke on each bar
                    barShowStroke           : true,
                    //Number - Pixel width of the bar stroke
                    barStrokeWidth          : 2,
                    //Number - Spacing between each of the X value sets
                    barValueSpacing         : 5,
                    //Number - Spacing between data sets within X values
                    barDatasetSpacing       : 1,
                    //String - A legend template
                    legendTemplate          : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive              : true,
                    maintainAspectRatio     : true
                }

                barChartOptions.datasetFill = false
                var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
        }
    }
}
</script>

