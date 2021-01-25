@extends('layouts.main')



    @section('head')
        <meta charset="utf-8"/>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Dashboard</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta content="" name="description"/>
        <meta content="" name="author"/>
        <meta name="MobileOptimized" content="320">
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/plugins/uniform/css/uniform.default.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        @if( Request::is('admin/dashboard') )
            <link href="{{asset('css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css"/>
        @elseif( Request::is('admin/tally') )
            <link href="{{asset('css/print.css')}}" rel="stylesheet" type="text/css" />
            <style>
                
                #printrest{    
                    font-size: 15px !important;
                    font-family: Bookman Old Style;
                }
                #printrest span{
                    padding-left: 7px;
                }
                .table_data th{
                text-transform: uppercase;
                }
                .table_data, .table_data th, .table_data td {
                    border: 1px solid black;
                    padding: 10px 20px 10px 20px;
                    text-align: center;
                    font-size: 15px !important;
                }
                .hder{
                    /* width: 500px; */
                    height: 70px;
                }
                .hder h4,.hder p,.hder h3{
                    text-align: center;
                }
                .hder h3{
                    padding-left: 10px;
                }
                .hder p{
                    padding: 26px 0px 0px 6px;
                }
                .content_rest{
                    margin-bottom: 30px;
                    padding-left: 7px;
                }
                .table_data{
                    margin-left: auto;
                    margin-right: auto;
                }
                .table_data, .table_data th, .table_data td {
                    border: 1px solid black;
                    padding: 10px 20px 10px 20px;
                    font-size: 20px;
                    text-align: center;
        
                }
                .content_rest{
                    padding-top: 50px !important;
                }
        
                body{
                    padding: 0px !important;
                    margin: 0px !important;
                }
        
                #copy{
                    color: #00000047;
                }
                .print-footer{
                    text-align: center;
                    float: right;
                    width: 330px;
                }
                .print-footer h3{
                    margin-bottom: 0px;
                }
        </style>
        @elseif( Request::is('admin/voters') || Request::is('admin/votes') || Request::is('admin/positions') || Request::is('admin/candidates'))
            <link href="{{asset('assets/plugins/data-tables/DT_bootstrap.css')}}" rel="stylesheet" type="text/css"/>
        @endif
        @if( Request::is('admin/candidates') ) 
       <style>
            #preview-pane {
                display: block;
                /* position: absolute; */
                margin-top: 5px;
                width: 261px;
                z-index: 2000;
                right: -280px;
                padding: 6px;
                border: 1px rgba(0,0,0,.4) solid;
                background-color: white;
                -webkit-border-radius: 6px;
                -moz-border-radius: 6px;
                border-radius: 6px;
                -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
                box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
            }
            #preview-pane .preview-container {
                width: 250px;
                height: 170px;
                overflow: hidden;
            }
        </style>
        @elseif( Request::is('admin/ballot_position') ) 
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/> 
        @elseif( Request::is('votersballot') ) 
        <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css"/> 
        @endif
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="{{asset('assets/css/style-conquer.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/style-responsive.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/pages/tasks.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('assets/css/themes/default.css')}}" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.html"/>
    @endsection



    @section('footer')
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{asset('assets/plugins/jquery-1.10.2.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-migrate-1.2.1.min.js')}}" type="text/javascript"></script>
    <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
    <script src="{{asset('assets/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery.blockui.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/jquery.cokie.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/plugins/uniform/jquery.uniform.min.js')}}" type="text/javascript"></script>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    @if( Request::is('admin/dashboard') )
    <script src="{{asset('js/chart.js/Chart.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/chart.js/Chart.HorizontalBar.js')}}" type="text/javascript"></script>
   
    @foreach($data as $position)
			
        @php
        $labels = array();
        $datas = array();
        $candidate_ids = array();

        $dash->setArray_of_votes($position['candidates']);
        @endphp

            
        
        @foreach($position['candidates'] as $candidate)
        @php
           
            $winner = $dash->getWinner() == $candidate['candidate_id'] ? "**" :"";

            array_push($labels, $candidate['lastname']);
            array_push($datas, count($candidate['votes']));
            array_push($candidate_ids, $candidate['candidate_id']);
                       
        @endphp
        @endforeach
        @php
            $labels = json_encode($labels);
            $datas = json_encode($datas);
        @endphp
        <script>
            $(function(){
               
                var description = '{{$dash->slugify($position['description'])}}';
                var barChartCanvas = $('#'+description).get(0).getContext('2d')
                var barChart = new Chart(barChartCanvas)
                var barChartData = {
                    labels  : @php echo $labels @endphp,
                    datasets: [
                        {
                            label               : 'Votes',
                            fillColor: "rgba(220,220,220,0.5)", 
                            strokeColor: "rgba(220,220,220,0.8)", 
                            highlightFill: "rgba(220,220,220,0.75)",
                            highlightStroke: "rgba(220,220,220,1)",
                            data                : {{ $datas }}
                        }
                    ]
                }
        
                var barChartOptions = {
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
                    legendTemplate          : '<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                    //Boolean - whether to make the chart responsive
                    responsive              : true,
                    maintainAspectRatio     : true,
                    showTooltips: false
                }
                
                barChartOptions.datasetFill = false
                var myChart = barChart.HorizontalBar(barChartData, barChartOptions)

                for(var inc = 0; inc < myChart.datasets[0].bars.length; inc++){
                    myChart.datasets[0].bars[inc].fillColor = colors(inc);
                }
                var re = 0;
                setInterval(function() {
                    re++;
                    setData()
                    myChart.update();
                    // console.log(re)
                    if( re == 40 ){
                        location.reload();
                    }
                }, 2000);
                
                
                
                function setData() {
                    $.post(
                        '../api/countvotes',
                        {
                            data:@php echo json_encode($candidate_ids) @endphp
                        }
                        ,
                        function(data){
                            // console.log(data)
                            for ( var i = 0; i < data.length; i++ ){
                                myChart.datasets[0].bars[i].value = data[i]
                                // myChart.datasets[0].bars[0].fillColor
                            }
                        }
                    )
                }

                function colors(index){
                    var color = ["#3366CC","#DC3912","#FF9900","#109618","#990099","#3B3EAC","#0099C6","#DD4477","#66AA00","#B82E2E","#316395","#994499","#22AA99","#AAAA11"];
                    return color[index];
                }
            });
        </script>
    
    @endforeach
    @elseif( Request::is('admin/tally') )
        <script type="text/javascript" src="{{asset('assets/scripts/print.js')}}"></script>
    @elseif( Request::is('admin/voters') )
    <script type="text/javascript" src="{{asset('assets/plugins/select2/select2.min.js')}}"></script>
    @elseif( Request::is('admin/votes') )
    <script type="text/javascript" src="{{asset('assets/plugins/data-tables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/plugins/data-tables/DT_bootstrap.js')}}"></script>
    
    @endif
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    
    <script src="{{ asset('assets/scripts/apps.js')}} " type="text/javascript"></script>

    <!-- END PAGE LEVEL SCRIPTS -->
    
    <script>

        jQuery(document).ready(function() {    
            App.init(); // initlayout and core plugins
        });
    </script>
    @endsection
