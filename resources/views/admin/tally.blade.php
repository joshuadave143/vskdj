<?php
	use voting_system\Http\Controllers\DashboardController; 
	use voting_system\Http\Controllers\adminController; 

	$dash = new DashboardController();
	$admin = new adminController();
?>

@extends('plugins.dashboardplugs')

@section('content')			
			<!-- BEGIN PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
            <h3 class="page-title">
            Election Tally <small>Results</small>
            </h3>
            <ul class="page-breadcrumb breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="/admin">Home</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="#">Election Tally Results</a>
                </li>
            </ul>
            <!-- END PAGE TITLE & BREADCRUMB-->
        </div>
    </div>
			<!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-edit"></i>Votes Tally
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="form-horizontal">
                        <div id="printrest" style="//display: none;">
                            <div class="hder">
                                <h3>{{ $admin->getconfig()[0] }}</h3>
                                <h4>Results of Tally from <?php echo date("Y-m-d h:ia"); ?></h4>
                            </div>
                            <div class="content_rest">
                                <table class="table_data">
                                    <th>Position</th>
                                    <th>lastname</th>
                                    <th>firstname</th>
                                    <th>MI</th>
                                    <th>votes</th>
                                    <th>winner</th>
                                    @php
                                        $data = json_decode($dash->get_all_data(), true)
                                    @endphp

                                    @foreach($data as $position)
                                
                                        @php
                                            $i = 0;            
                                            $dash->setArray_of_votes($position['candidates']);
                                            $candiList = "";
                                        @endphp
                                        @foreach($position['candidates'] as $candidate)
                                        @php
                                        
                                            $winner = $dash->getWinner() == $candidate['candidate_id'] ? "**" :"";
                                
                                            $rowspan = $i == 0 ? "rowspan='".count($position['candidates'])."'":"";
                                            $description = $i == 0 ? $position['description']:"";
                                            $td = $i == 0 ?  "<td  ".$rowspan." >".$description."</td>":"";
                                            $candiList .="
                                                <tr>
                                                    $td 
                                                    <td>".$candidate['lastname']."</td>
                                                    <td>".$candidate['firstname']."</td>
                                                    <td>".$candidate['MI']."</td>
                                                    <td>".count($candidate['votes'])."</td>
                                                    <td>".$winner. "</td>";
                                
                                            $candiList .= count($position['candidates']) > $i+1 ? "</tr>" : "</tr>";
                                            
                                                
                                            $i++;
                                        @endphp
                                        @endforeach
                                        {!!$candiList!!}
                                    @endforeach

                                </table>
                            </div>
                              
                            <div class="print-footer">
                                <h3>{{{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->email }}}</h3>
                                <p>Comelec Chairman</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <span class="pull-right">
                                    <a href="" onclick="printResult()" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
                                </span>
                            </div>
                        </div>
                    </div>               
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    
			

@endsection
