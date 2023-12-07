@extends('admin.layouts.app')

@section('content')
@php   $contactdetails_head =  DB::table('manage_domain')->get()->first(); @endphp
   <!-- partial -->
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card text-black"> 
                <div class="card-body">
                  <h4 class="card-title">Monthly Statistics</h4>
                  <div class="row mt-5">
                    <div class="col-6">
                      <div class="wrapper">
                        <h5 class="mb-1">Bounce Rate</h5>
                        <h4 class="mb-1"><strong>23.32%</strong></h4>
                        <small class="mb-0 mt-3 text-danger">2.7% increased</small>
                      </div>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                      <div class="wrapper">
                        <h5 class="mb-1">Page Views</h5>
                        <h4 class="mb-1"><strong>42.32%</strong></h4>
                        <small class="mb-0 mt-3 text-primary">1.5% decreased</small>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="chart-container">
                  <canvas id="chart-activity" height="250"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin d-flex align-items-stretch">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Revenue</h4>
                      <div class="row d-flex justify-content-between align-items-end mb-3">
                        <div class="col-5">
                          <p class="mb-0">Purchases</p>
                          <h4 class="mb-0"><strong>20.89%</strong></h4>
                        </div>
                        <div class="col-7">
                          <div class="float-right">
                            <div id="purchase-chart">
                              6, 5, 7, 10, 9, 3, 5, 9, 7, 3, 5 ,2, 5, 7, 6, 8, 6, 3, 9, 7, 9, 2, 8
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row d-flex justify-content-between align-items-end">
                        <div class="col-5">
                          <p class="mb-0">Time on site</p>
                          <h4 class="mb-0"><strong>83.32%</strong></h4>
                        </div>
                        <div class="col-7">
                          <div class="float-right">
                            <div id="time-chart">
                              6, 5, 7, 10, 3, 9, 5, 9, 7, 9, 5 ,2, 5, 7, 9, 8, 6, 11, 9, 7, 7, 6, 5
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-12 stretch-card">
                  <div class="card">
                    <div class="card-body py-4">
                      <h4 class="card-title">Revenue</h4>
                      <div class="row d-flex justify-content-center align-items-center">
                        <div class="col-6 col-md-6 grid-margin grid-margin-md-0 d-flex flex-column align-items-center justify-content-center">
                          <div class="w-75 mx-auto">
                            <div id="revenueCircle1" class="progressbar-js-circle"></div>
                          </div>
                          <p class="mb-0 mt-2">Sales</p>
                          <h4 class="mb-0"><strong>65.00%</strong></h4>
                        </div>
                        <div class="col-6 col-md-6 grid-margin grid-margin-md-0 d-flex flex-column align-items-center justify-content-center border-left">
                          <div class="w-75 mx-auto">
                            <div id="revenueCircle2" class="progressbar-js-circle"></div>
                          </div>
                          <p class="mb-0 mt-2">Purchases</p>
                          <h4 class="mb-0"><strong>80.26%</strong></h4>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card"> 
								<div class="card-body">
									<h4 class="card-title">Todo list</h4>
                  
                  <form id="baseForm" name="baseForm" class="forms-sample" method="POST" action="{{ route('admin.store')}}"
        enctype="multipart/form-data"> 
        @csrf
									<div class="add-items d-flex">
										<input type="text" class="form-control todo-list-input" name="todo_name"  placeholder="What do you need to do today?"/>
                    <button type="submit" class="btn btn-success mr-2">Add</button>									</div>
                         </form>
									<div class="list-wrapper">
										<ul class="d-flex flex-column-reverse todo-list">
                    @if($todolist)
                        @foreach($todolist as $todo)
                        @if($todo->status == 1)

											<li class="completed">
												<div class="form-check">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" checked="checked" value="{{$todo->status}}"  name="status" id="statusId" onclick="getajaxdata('{{$todo->status}}','{{$todo->id}}')">
														{{$todo->todo_name}}
													</label>
												</div>
                        <span>
                                <form method="POST" action="{{ route('admin.destroy',$todo->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-trash"><i class=" mdi mdi-close-circle-outline text-danger"></i></button>
                                 </form>
                            </span>
											</li>
                      @else
                      <li>
												<div class="form-check">
													<label class="form-check-label">
														<input class="checkbox" type="checkbox" value="{{$todo->status}}"  name="status" id="statusId" onclick="getajaxdata('{{$todo->status}}','{{$todo->id}}')">
														{{$todo->todo_name}}
													</label>
												</div>
                        <span>
                                <form method="POST" action="{{ route('admin.destroy',$todo->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-trash"><i class=" mdi mdi-close-circle-outline text-danger"></i></button>
                                 </form>
                            </span>
											</li>
                      @endif
                      @endforeach
                        @endif
										</ul>
									</div>
								</div>
							</div>
            </div>
          </div>
          </div>
          <div class="row">
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Marketer</h4>
                  @if($totalmarketers)
                  @foreach($totalmarketers as $totalmarke)
                  <div class="wrapper d-flex align-items-center py-2 border-bottom">
                    <img class="img-sm rounded-circle" src="https://placehold.it/100x100" alt="profile">
                    <div class="wrapper ml-3">
                      <h6 class="mb-0"><strong>{{$totalmarke->full_name}}</strong></h6>
                      <small class="text-muted mb-0">{{$totalmarke->email}}, {{$totalmarke->country}}</small>
                    </div>
                    <div class="badge badge-pill badge-primary ml-auto px-1 py-1"><i class="mdi mdi-check font-weight-bold"></i></div>
                  </div>
                  @endforeach
                  @endif
                </div>
              </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex align-items-center mb-3">
                    <h4 class="card-title">Revenue</h4>
                    <p class="text-muted ml-auto">17 February 2018</p>
                  </div>
                  <div class="row">
                    <div class="col-md-7">
                      <div class="alert alert-outline-primary d-flex justify-content-between" role="alert">
                        <p class="mb-0 d-inline-block">Added API call to update track!</p><i class="mdi mdi-alert-circle-outline mr-0"></i>
                      </div>
                      <div class="list">
                        <span class="text-small"><strong>@Michael</strong> Cras sit amet nibh libero, in gravida nulla.</span>
                        <div class="d-flex justify-content-between pb-3 mt-2 border-bottom">
                          <span class="text-small text-muted">17 February 2018 08:48 PM</span>
                          <span class="text-small text-muted">Reply</span>
                        </div>
                      </div>
                      <div class="list pt-2">
                        <span class="text-small"><strong>@Doyle</strong> Bell Cras sit amet nibh libero, in gravida nulla, Nulla vel metus.</span>
                        <div class="d-flex justify-content-between pb-3 mt-2 border-bottom">
                          <span class="text-small text-muted">19 March 2018 10:21 PM</span>
                          <span class="text-small text-muted">Reply</span>
                        </div>
                      </div>
                      <div class="list pt-2">
                        <span class="text-small"><strong>@Maxine</strong> Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque.</span>
                        <div class="d-flex justify-content-between pb-3 mt-2">
                          <span class="text-small text-muted">02 May 2018 03:31 AM</span>
                          <span class="text-small text-muted">Reply</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-5 pl-md-4">
                      <img class="rounded img-lg" src="https://placehold.it/100x100" alt="profile image">
                      <h4 class="font-weight-bold mt-3">Phyllis K. Maciel</h4>
                      <p class="text-small">An UI/UX Designer living in Jakarta,Indonesia.</p>
                      <div class="d-flex mt-4">
                        <span class="text-primary mr-4"><i class="mdi mdi-map-marker-outline mr-1"></i>Indonesia</span>
                        <span class="text-primary"><i class="mdi mdi-email-outline mr-1"></i>Hire Me</span>
                      </div>
                      <small class="text-muted">Let me know if you want to get in touch.</small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body"> 
                  <div class="row">
                    <div class="col-12 col-md-3 col-sm-6 mb-4 mb-md-0 border-right-md d-flex justify-content-between justify-content-md-center">
                      <div class="wrapper d-flex align-items-center justify-content-center">
                        <div class="btn social-btn btn-twitter btn-rounded d-inline-block"></div>
                        <div class="wrapper d-flex flex-column ml-4">
                          <p class="font-weight-bold mb-2">Total Project</p>
                          <p class="mb-0 text-muted">{{$totalprojects}} Project</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-6 mb-4 mb-md-0 border-right-md d-flex justify-content-between justify-content-md-center">
                      <div class="wrapper d-flex align-items-center justify-content-center">
                        <div class="btn social-btn btn-facebook btn-rounded d-inline-block"></div>
                        <div class="wrapper d-flex flex-column ml-4">
                          <p class="font-weight-bold mb-2">Complete Project</p>
                          <p class="mb-0 text-muted">{{$totalcompleteproject}} Project</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-6 mb-4 mb-md-0 border-right-md d-flex justify-content-between justify-content-md-center">
                      <div class="wrapper d-flex align-items-center justify-content-center">
                        <div class="btn social-btn btn-google btn-rounded d-inline-block"></div>
                        <div class="wrapper d-flex flex-column ml-4">
                          <p class="font-weight-bold mb-2">New Project</p>
                          <p class="mb-0 text-muted">{{$totalnewproject}} Project</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 col-md-3 col-sm-6 d-flex justify-content-between justify-content-md-center">
                      <div class="wrapper d-flex align-items-center justify-content-center">
                        <div class="btn social-btn btn-warning btn-rounded d-inline-block"></div>
                        <div class="wrapper d-flex flex-column ml-4">
                          <p class="font-weight-bold mb-2">Total Marketer</p>
                          <p class="mb-0 text-muted">{{ $totalmarketer}} Marketers</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total Projects</h4>
                <canvas id="barChartproject" style="height:230px"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Total Donations</h4>
                <canvas id="barChart" style="height:230px"></canvas>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total New and complete Projects</h4>
                    <canvas id="areachart-multi" style="height:250px"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Total Users as Type</h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div> 
          <div class="row">
           <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Project</h4>
                  <div class="table-responsive">
                    <table class="table">
                     
                      <tr>
                        <th>Project Name</th>
                        <th>Progress</th>
                        <th>Total Amount</th>
                        <th>Donate Amount</th>
                        <th>Residual</th>
                      </tr>
                      <tr>
                        @if($totalnewprojectshow)
                      @foreach($totalnewprojectshow as $newprojectshow)
                        <td>
                          <div class="d-flex align-items-center">
                            <div>
                            <img src="{{ asset('uploads/projectimage/'.$newprojectshow->image) }}"
                                style="height: 30px;width:30px;">
                          </div>
                            <div class="ml-3">
                              <p class="mb-1">{{$newprojectshow->project_name}}</p>
                              <small class="text-muted">{{$newprojectshow->title}}</small>
                            </div>
                          </div>
                        </td>
                        <td>
                            <div class="progress progress_1" role="progressbar" aria-label="Animated striped example" aria-valuenow="{{$newprojectshow->donated/$newprojectshow->target_amount * 100}}" aria-valuemin="0" aria-valuemax="100">
                              <div class="progress-bar progress-bar-striped progress-bar-animated bg-success33 " style="width: {{$newprojectshow->donated/$newprojectshow->target_amount * 100}}%;">{{round($newprojectshow->donated/$newprojectshow->target_amount * 100)}}%</div>
                            </div>
                      </td>
                        <td>{{$newprojectshow->target_amount}} KD</td>	
                        <td>{{$newprojectshow->donated}} KD</td>
                        <td>{{$newprojectshow->residual}} KD</td>
                      </tr>
                      <tr>
                      </tr>
                      @endforeach
                      @endif
                    </table>
                    <div class="text-center mt-3 "> <a href="{{ route('project.index') }}" class="btn btn-outline-primary w-25">All Project</a></div>
                  </div>
                </div>
              </div>

            </div>
          <div class="row">
 
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Admin Dept</h4>
                  <div class="w-50 mt-5 mb-4 mx-auto">
                    <div id="revenueCircle3" class="progressbar-js-circle"></div>
                  </div>
                  <h4 class="text-center"><strong>Storage Size</strong></h4>
                  <h4 class="text-center"><strong>1.98TB</strong></h4>
                  <div class="d-flex row mt-5">
                    <div class="col">
                      <p class="text-left mb-2">1.30 GB free</p>
                      <h4 class="text-left"><strong>35.4%</strong></h4>
                    </div>
                    <div class="col">
                      <p class="text-right mb-2">1.30 GB free</p>
                      <h4 class="text-right"><strong>35.4%</strong></h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Recent Transaction</h4>
                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th>Project Name</th>
                        <th>Transaction Status</th>
                        <th>Donate Amount</th>
                        <th>DateTime</th>
                      </tr>
                      <tr>
                      @if($transac)
                      @foreach($transac as $transacstion)
                        <td>
                          <div class="d-flex align-items-center">
                            <div><img src="https://placehold.it/100x100" alt="profile image"></div>
                            <div class="ml-3">
                              <p class="mb-1">{{$transacstion->p_name}}</p>
                              <small class="text-muted">{{$transacstion->category}}</small>
                            </div>
                          </div>
                        </td>
                        <td>
                        {{$transacstion->payment_status}}
                      </td>
                        <td>{{$transacstion->donate_amount}} KD</td>
                        <td>
                        {{$transacstion->created_date}}
                        </td>
                      </tr>
                      
                      @endforeach
                      @endif
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

    @php
    $totalcount ='';
    $years ='';
    $i=0;
    if($totalproject){
    foreach ($totalproject as $rows)
    {
    if($i== 0)
    {
    $totalcount .= $rows->totalproject;
    $years .= $rows->year;
    }
    else{
    $totalcount .= ','.$rows->totalproject;
    $years .= ','.$rows->year;
    }

    $i++;
    }

    }
    @endphp
    @php
    $totaldonationcount ='';
    $months ='';
    $i=0;
    if($totaldonation){
    foreach ($totaldonation as $rows)
    {
    if($i== 0)
    {
    $totaldonationcount .= $rows->totaldonation;
    $months .= $rows->month;
    }
    else{
    $totaldonationcount .= ','.$rows->totaldonation;
    $months .= ','.$rows->month;
    }

    $i++;
    }


    }


    @endphp
    @php
    $totalnewprojecscount ='';
    $monthsnew ='';
    $i=0;
    if($totalnewprojects){
    foreach ($totalnewprojects as $rows)
    {
    if($i== 0)
    {
    $totalnewprojecscount .= $rows->totalproject;
    $monthsnew .= $rows->month;
    }
    else{
    $totalnewprojecscount .= ','.$rows->totalproject;
    $monthsnew .= ','.$rows->month;
    }

    $i++;
    }
    }

    $totalcompleteprojecscount ='';
    $monthscomplete ='';
    $i=0;
    if($totalcompleteprojects){
    foreach ($totalcompleteprojects as $rows)
    {
    if($i== 0)
    {
    $totalcompleteprojecscount .= $rows->totalproject;
    $monthscomplete .= $rows->month;
    }
    else{
    $totalcompleteprojecscount .= ','.$rows->totalproject;
    $monthscomplete .= ','.$rows->month;
    }

    $i++;
    }
    }

    @endphp
    

    <!--<script src="js/chart.js"></script>-->
    <script type="text/javascript">

function getajaxdata(status,id) {
    // var statusId = $('#statusId').val();
// console.log(id);
    $.ajax({
        url: "{{ route('changeStatusTodo') }}",
        method: 'POST',
        data: {
                'id': id,
            'status': status,
            _token: '{{ csrf_token() }}'
        
        },
        dataType: 'html',
        success: function(data) {
          location.reload();
            // $('#projectlist').empty().html(data);
            // location.hash = page;
        }
    })
}
         
    $(function() {
        /* ChartJS
         * -------
         * Data and config for chartjs
         */
        var mons = '{{$months}}'.replace("[", "").replace("]", "").split(',');
        'use strict';
        var data = {
            labels: mons,
            datasets: [{
                label: 'KD Total Donations',
                data: [{{$totaldonationcount}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        };

        var dataproject = {
            labels: [{{$years}}],
            datasets: [{
                label: '# Total Projects',
                data: [{{ $totalcount}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: false
            }]
        };

        var multiLineData = {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [{
                    label: 'Dataset 1',
                    data: [12, 19, 3, 5, 2, 3],
                    borderColor: [
                        '#587ce4'
                    ],
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Dataset 2',
                    data: [5, 23, 7, 12, 42, 23],
                    borderColor: [
                        '#ede190'
                    ],
                    borderWidth: 2,
                    fill: false
                },
                {
                    label: 'Dataset 3',
                    data: [15, 10, 21, 32, 12, 33],
                    borderColor: [
                        '#f44252'
                    ],
                    borderWidth: 2,
                    fill: false
                }
            ]
        };
        var options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            elements: {
                point: {
                    radius: 0
                }
            }

        };
        var doughnutPieData2 = {
            datasets: [{
                data: [{{$totalusers}}, {{$totalmarketer}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(0,128,0, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(0,128,0, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Users',
                'Marketer',

            ]
        };
        var doughnutPieData = {
            datasets: [{
                data: [<?php echo round(3) ?>, <?php echo  round(4) ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(0,128,0, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(0,128,0, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Andorid Duration Minute',
                'Ios Duration Minute',

            ]
        };
        var doughnutPieOptions = {
            responsive: true,
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };
        var browserTrafficData = {
            datasets: [{
                data: [<?php echo round(5)  ?>, 6],
                backgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(0,128,0, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 117, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(0,128,0, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(75, 192, 117, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [
                'Total Duration Minute',
                'Total Unique Launches',

            ]
        };
        var areaData = {
            labels: [2020, 2021, 2022],
            datasets: [{
                label: '# of Launch',
                data: [10, 20, 30],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1,
                fill: true, // 3: no fill
            }]
        };

        var areaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            }
        }
        var monss = '{{$monthsnew}}'.replace("[", "").replace("]", "").split(',');
        var multiAreaData = {
            labels: monss,
            datasets: [{
                    label: 'New Project',
                    data: [{{$totalnewprojecscount}}],
                    borderColor: ['rgba(255, 99, 132, 0.5)'],
                    backgroundColor: ['rgba(255, 99, 132, 0.5)'],
                    borderWidth: 1,
                    fill: false
                },
                {
                    label: 'Complete Project',
                    data: [{{$totalcompleteprojecscount}}],
                    borderColor: ['rgba(54, 162, 235, 0.5)'],
                    backgroundColor: ['rgba(54, 162, 235, 0.5)'],
                    borderWidth: 1,
                    fill: false
                },

            ]
        };

        var multiAreaOptions = {
            plugins: {
                filler: {
                    propagate: true
                }
            },
            elements: {
                point: {
                    radius: 0
                }
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }

        var scatterChartData = {
            datasets: [{
                    label: 'First Dataset',
                    data: [{
                            x: -10,
                            y: 0
                        },
                        {
                            x: 0,
                            y: 3
                        },
                        {
                            x: -25,
                            y: 5
                        },
                        {
                            x: 40,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)'
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Second Dataset',
                    data: [{
                            x: 10,
                            y: 5
                        },
                        {
                            x: 20,
                            y: -30
                        },
                        {
                            x: -25,
                            y: 15
                        },
                        {
                            x: -10,
                            y: 5
                        }
                    ],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }
            ]
        }

        var scatterChartOptions = {
            scales: {
                xAxes: [{
                    type: 'linear',
                    position: 'bottom'
                }]
            }
        }
        // Get context with jQuery - using jQuery's .get() method.
        if ($("#barChart").length) {
            var barChartCanvas = $("#barChart").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: data,
                options: options
            });
        }
        if ($("#barChartproject").length) {
            var barChartCanvas = $("#barChartproject").get(0).getContext("2d");
            // This will get the first returned node in the jQuery collection.
            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: dataproject,
                options: options
            });
        }


        if ($("#linechart-multi").length) {
            var multiLineCanvas = $("#linechart-multi").get(0).getContext("2d");
            var lineChart = new Chart(multiLineCanvas, {
                type: 'line',
                data: multiLineData,
                options: options
            });
        }

        if ($("#areachart-multi").length) {
            var multiAreaCanvas = $("#areachart-multi").get(0).getContext("2d");
            var multiAreaChart = new Chart(multiAreaCanvas, {
                type: 'line',
                data: multiAreaData,
                options: multiAreaOptions
            });
        }

        if ($("#doughnutChart").length) {
            var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: doughnutPieData2,
                options: doughnutPieOptions
            });
        }

        if ($("#pieChart").length) {
            var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
            var pieChart = new Chart(pieChartCanvas, {
                type: 'pie',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        }

        if ($("#areaChart").length) {
            var areaChartCanvas = $("#areaChart").get(0).getContext("2d");
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaData,
                options: areaOptions
            });
        }

        if ($("#scatterChart").length) {
            var scatterChartCanvas = $("#scatterChart").get(0).getContext("2d");
            var scatterChart = new Chart(scatterChartCanvas, {
                type: 'scatter',
                data: scatterChartData,
                options: scatterChartOptions
            });
        }

        if ($("#browserTrafficChart").length) {
            var doughnutChartCanvas = $("#browserTrafficChart").get(0).getContext("2d");
            var doughnutChart = new Chart(doughnutChartCanvas, {
                type: 'doughnut',
                data: browserTrafficData,
                options: doughnutPieOptions
            });
        }
    });
    </script>


    @endsection