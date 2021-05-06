<?php include(dirname(__FILE__)."/includes/head.php"); ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/css/app.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/css/core/menu/menu-types/vertical-compact-menu.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/vendors/css/charts/jquery-jvectormap-2.0.3.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/vendors/css/charts/morris.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/fonts/simple-line-icons/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/css/core/colors/palette-gradient.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/app-assets/css/style.css">
</head>
<?php error_reporting(0);?>
<body class="vertical-layout vertical-compact-menu 2-columns   menu-expanded fixed-navbar" data-open="click" data-menu="vertical-compact-menu" data-col="2-columns">
	<?php include(dirname(__FILE__)."/includes/header.php"); ?>
	<?php include(dirname(__FILE__)."/includes/sidebar.php"); ?>
	<div class="app-content content">
		<div class="content-wrapper">
			<div class="content-header row"></div>
			<div class="content-body">
				<div class="row">
					<div class="col-xl-3 col-lg-6 col-12">
						<a href="<?php echo base_url('instructor/list'); ?>"><div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="info"><?php echo $TotalInstructors; ?></h3>
											<h6>Total Instructors</h6>
										</div>
										<div>
											<i class="icon-users info font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
										<div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%"
											aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div></a>
					</div>
					<div class="col-xl-3 col-lg-6 col-12">
						<a href="<?php echo base_url('reports/sales'); ?>"><div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="warning"><i class="la la-rupee"></i><?php $netprofitval = round($netProfit);
												echo number_format($netprofitval);
												?></h3>
											<h6>Net Profit</h6>
										</div>
										<div>
											<i class="icon-pie-chart warning font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
										<div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div></a>
					</div>
					<div class="col-xl-3 col-lg-6 col-12">
						<a href="<?php echo base_url('student/list'); ?>"><div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="success"><?php echo $TotalStudents; ?></h3>
											<h6>Total Students</h6>
										</div>
										<div>
											<i class="icon-user-follow success font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
										<div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div></a>
					</div>
					<div class="col-xl-3 col-lg-6 col-12">
						<a href="<?php echo base_url('complete-package/list'); ?>"><div class="card pull-up">
							<div class="card-content">
								<div class="card-body">
									<div class="media d-flex">
										<div class="media-body text-left">
											<h3 class="danger"><?php echo $totalSales; ?></h3>
											<h6>Total Sales</h6>
										</div>
										<div>
											<i class="icon-tag danger font-large-2 float-right"></i>
										</div>
									</div>
									<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
										<div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
									</div>
								</div>
							</div>
						</div></a>
					</div>
				</div>
				<section id="ecommerce-stats">
					<div class="row">
						<div class="statics-title-row pull-up">
							<button type="button" class="btn btn-info btn-block btn-glow">
								Instructor Activity Forum
							</button>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="card text-white bg-success bg-lighten-1">
								<div class="card-content collapse show">
									<div class="card-body">
										<div id="TopsellingModules" class="height-400 echart-container"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-6 col-12">
							<div class="row">
								<div class="col-lg-6 col-12">
									<a href="<?php echo base_url('enquery/list'); ?>"><div class="card pull-up">
										<div class="card-content">
											<div class="card-body">
												<div class="media d-flex">
													<div class="media-body text-left">
														<h6 class="text-muted">Total Enquiry Requests</h6>
														<h3><?php echo $TotalEnquiries; ?></h3>
													</div>
													<div class="align-self-center">
														<i class="icon-trophy success font-large-2 float-right"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</a>
								</div>
								<div class="col-lg-6 col-12">
									<div class="card pull-up">
										<div class="card-content">
											<div class="card-body">
												<div class="media d-flex">
													<div class="media-body text-left">
														<h6 class="text-muted">Completed Skype Interviews</h6>
														<h3><?php echo $CompletedSkypeInterviews; ?></h3>
													</div>
													<div class="align-self-center">
														<i class="icon-call-in danger font-large-2 float-right"></i>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-12 activity" style="height: 300px !important;">
									<div class="card">
										<div class="card-header bg-info">
											<h4 class="card-title">Activity Log</h4>
											<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
											<div class="heading-elements">
												<ul class="list-inline mb-0">
													<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="card-content collapse show bg-hexagons">
											<div id="new-orders" class="media-list position-relative">
												<div class="table-responsive">
													<table id="new-orders-table" class="table table-striped table-xl mb-0">
														<tbody>
															<?php if (!empty($activities)) {
															 foreach ($activities as $single_activity) { ?>
															<tr>
																<td class="text-truncate">
																	<?php echo $single_activity['title'] ?>
																</td>
																<td class="text-truncate"><small><?php echo $single_activity['time']; ?> ago</small></td>
															</tr>
														<?php } }?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="statics-title-row pull-up">
							<button type="button" class="btn btn-warning btn-block btn-glow">
							Payment Statistic
							</button>
						</div>
						<div class="col-md-6 col-sm-12">
							<div class="card bg-blue-grey bg-lighten-1 text-white">
								<div class="card-content collapse show">
									<div class="card-body">
										<div id="MonthlySalesChart" class="height-400 echart-container"></div>
									</div>
								</div>
							</div>
						</div>
						<div id="recent-sales" class="col-sm-6 col-12 col-md-6">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Recent Sales</h4>
									<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
									<div class="heading-elements">
										<ul class="list-inline mb-0">
											<li><a class="btn btn-sm btn-warning box-shadow-2 round btn-min-width pull-right mt-1"
												href="<?php echo base_url('reports/transaction'); ?>">View all</a></li>
										</ul>
									</div>
								</div>
								<div class="card-content mt-1">
									<div class="table-responsive">
										<table id="recent-orders" class="table table-hover table-xl mb-0">
											<thead>
												<tr>
													<th class="border-top-0">Module Title</th>
													<th class="border-top-0">Popularity</th>
													<th class="border-top-0">Amount</th>
												</tr>
											</thead>
											<tbody>
												<?php if(empty($RecentSales)){
													echo '<tr><td colspan="3">No Data Found.!</td></tr>';
												}else{
													foreach ($RecentSales as $singleModuleDetails)
													{
														$total_module_sales = $singleModuleDetails['total_module_sales'];
														$progressbar = round($total_module_sales/$totalSales*100);

														if ($progressbar<='33') { $progressbarClass = 'danger'; } 
														if ($progressbar>='33' && $progressbar<='66') { $progressbarClass = 'primary'; } 
														if ($progressbar>='66') { $progressbarClass = 'success'; }
													echo '<tr>
														<td class="">'.$singleModuleDetails['course_title'].'</td>
														<td>
															<div class="progress progress-sm mt-1 mb-0 box-shadow-2">
																<div class="progress-bar bg-gradient-x-'.$progressbarClass.'" role="progressbar" style="width: '.$progressbar.'%"
																	aria-valuenow="'.$progressbar.'" aria-valuemin="0" aria-valuemax="100"></div>
															</div>
														</td>
														<td class="text-truncate"><i class="la la-rupee"></i>'.$singleModuleDetails['fee'].'</td>
													</tr>';
													}
												}?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				<div class="row">
					<div class="statics-title-row pull-up">
						<button type="button" class="btn btn-success btn-block btn-glow">
						Students Statistic
						</button>
					</div>
					<div class="col-12 col-md-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Top Modules</h4>
								<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
								<div class="heading-elements mt-1">
									<ul class="list-inline mb-0">
										<li><a class="btn btn-sm btn-success box-shadow-2 round btn-min-width pull-right" href="<?php echo base_url('module/list'); ?>">Show all</a></li>
									</ul>
								</div>
							</div>
							<div class="card-content collapse show">
								<div class="card-body p-0">
									<div class="table-responsive">
										<table class="table mb-0">
											<tbody><?php if(!empty($topModules)) {
												foreach ($topModules as $value) {
												echo '<tr>
														<th scope="row" class="border-top-0">'.$value['course_title'].'</th>
														<td class="border-top-0">'.$value['fee'].'</td>
													</tr>';
												}
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title text-center">Paid Modules Stats</h4>
							</div>
							<?php $bought_modules = $CompletedModulesStats['total_bought_modules'];
							$completed_modules = $CompletedModulesStats['total_completed_modules'];
							$pending_modules  = $bought_modules-$completed_modules;
							$completed_modulesper  = ($bought_modules > 0) ? round($completed_modules/$bought_modules*100) : 0 ;
							$pending_modulesper  = ($bought_modules > 0) ? round($pending_modules/$bought_modules*100) : 0 ; ?>
							<div class="card-content collapse show">
								<div class="card-body pt-0">
									<div class="row">
										<div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
											<h6 class="<?php echo ($completed_modulesper>0) ? 'success' : 'danger'; ?> text-bold-600"><?php echo $completed_modulesper; ?>%</h6>
											<h4 class="font-large-2 text-bold-400"><?php echo $completed_modules; ?></h4>
											<p class="blue-grey lighten-2 mb-0">Completed</p>
										</div>
										<div class="col-md-6 col-12 text-center">
											<h6 class="<?php echo ($pending_modulesper<0) ? 'danger' : 'success'; ?> text-bold-600">
												<?php echo $pending_modulesper; ?>%</h6>
											<h4 class="font-large-2 text-bold-400"><?php echo $pending_modules; ?></h4>
											<p class="blue-grey lighten-2 mb-0">Pending</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="statics-title-row pull-up">
						<button type="button" class="btn btn-danger btn-block btn-glow">Sales Statistic</button>
					</div>
					<div class="col-12">
						<div class="card box-shadow-0">
							<div class="card-content">
								<div class="card-body">
                  <div id="markers" class="height-400"></div>
                </div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="statics-title-row pull-up">
						<button type="button" class="btn btn-primary btn-block btn-glow">
						Skype Interview Statistic
						</button>
					</div>
					<div class="col-12 col-md-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title text-center">Completed Skype Interviews</h4>
							</div>
							<div class="card-content collapse show">
								<div class="card-body pt-0">
									<div class="row">
										<div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
											<h4 class="font-large-2 text-bold-400"><?php echo $CSILast28days; ?></h4>
											<p class="blue-grey lighten-2 mb-0">Last 28 days</p>
										</div>
										<div class="col-md-6 col-12 text-center">
											<h4 class="font-large-2 text-bold-400"><?php echo $CSILast7days; ?></h4>
											<p class="blue-grey lighten-2 mb-0">Last 7 days</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title text-center">Upcoming Skype Interviews</h4>
							</div>
							<div class="card-content collapse show">
								<div class="card-body pt-0">
									<div class="row">
										<div class="col-md-6 col-12 border-right-blue-grey border-right-lighten-5 text-center">
											<h4 class="font-large-2 text-bold-400"><?php echo $upcomingSInextweek; ?></h4>
											<p class="blue-grey lighten-2 mb-0">Next week</p>
										</div>
										<div class="col-md-6 col-12 text-center">
											<h4 class="font-large-2 text-bold-400"><?php echo $upcomingSIthismonth; ?></h4>
											<p class="blue-grey lighten-2 mb-0">This Month</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyBDkKetQwosod2SZ7ZGCpxuJdxY3kxo5Po" type="text/javascript"></script>
  <script src="/app-assets/vendors/js/charts/gmaps.min.js" type="text/javascript"></script>
	<?php include(dirname(__FILE__)."/includes/footer.php"); ?>
	<script src="/app-assets/vendors/js/charts/echarts/echarts.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/charts/chart.min.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/charts/raphael-min.js" type="text/javascript"></script>
	<script src="/app-assets/vendors/js/charts/morris.min.js" type="text/javascript"></script>
	<script type="text/javascript">
	$(document).ready(function(){

    map = new GMaps({
        div: '#markers',
        lat: 31.1471,
        lng: 75.3412,
        zoom: 7,
        styles: [{"featureType":"administrative.locality","elementType":"all","stylers":[{"hue":"#2c2e33"},{"saturation":7},{"lightness":19},{"visibility":"on"}]},
        {"featureType":"landscape","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"simplified"}]},
        {"featureType":"poi","elementType":"all","stylers":[{"hue":"#ffffff"},{"saturation":-100},{"lightness":100},{"visibility":"off"}]},
        {"featureType":"road","elementType":"geometry","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"simplified"}]},
        {"featureType":"road","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":31},{"visibility":"on"}]},
        {"featureType":"road.arterial","elementType":"labels","stylers":[{"hue":"#bbc0c4"},{"saturation":-93},{"lightness":-2},{"visibility":"simplified"}]},
        {"featureType":"road.local","elementType":"geometry","stylers":[{"hue":"#e9ebed"},{"saturation":-90},{"lightness":-8},{"visibility":"simplified"}]},
        {"featureType":"transit","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":10},{"lightness":69},{"visibility":"on"}]},
        {"featureType":"water","elementType":"all","stylers":[{"hue":"#e9ebed"},{"saturation":-78},{"lightness":67},{"visibility":"simplified"}]}
        ]
    });
    <?php echo $existingLocations; ?>

	});
</script>
	<script type="text/javascript">
(function(window, document, $)
{
  'use strict';

	require.config({
    paths: {
      echarts: '/app-assets/vendors/js/charts/echarts'
    }
	});

	require(
	[
	  'echarts',
	  'echarts/chart/pie',
	  'echarts/chart/funnel'
	],

	// Charts setup
	function (ec) {
	  /****************************************
	  *              Monthly Sales            *
	  ****************************************/
	  var myChart = ec.init(document.getElementById('MonthlySalesChart'));
	  var chartOptions = {
	      title: {
          text: 'Monthly Sales',
          //subtext: 'product sales on monthly basis',
          x: 'center',
          textStyle: {
            color: '#FFF'
          },
          // subtextStyle: {
          //   color: '#FFF'
          // }
	      },
	      tooltip: {
          trigger: 'item',
          formatter: "{a} <br/>Month: {b} <br/> Total Sales: {c} <br/> {d}%"
	      },
	      color: ['#ffd775', '#ff847c', '#e84a5f', '#2a363b', '#7fd5c3', '#61a781', '#f0c75e', '#df8c7d', '#e8ed8a', '#55bcbb', '#e974b9', '#2f9395'],
	      calculable: true,
	      series: [
          {
            name: 'Increase',
            type: 'pie',
            radius: ['15%', '73%'],
            center: ['50%', '57%'],
            roseType: 'area',
            itemStyle: {
              normal: {
                label: {
                  textStyle: {
                    color: '#FFF'
                  }
                },
                labelLine: {
                  lineStyle: {
                    color: '#FFF'
                  }
                }
              }
            },
            width: '40%',
            height: '78%',
            x: '30%',
            y: '17.5%',
            max: 450,
            sort: 'ascending',
            data: [
              <?php echo $MonthlysalesModules; ?>
            ],
          }
	      ]
	  	};

		  myChart.setOption(chartOptions);
		  $(function () {
		      $(window).on('resize', resize);
		      $(".menu-toggle").on('click', resize);
		      function resize() {
		        setTimeout(function() {
		          myChart.resize();
		        }, 200);
		      }
		  });

	  /************************************
	  *       Top Selling Modules      *
	  ************************************/

	  var topCategoryChart = ec.init(document.getElementById('TopsellingModules'));

	  var topCategoryChartOptions = {
	      title: {
          text: '5 Top Selling Modules',
          x: 'center',
          textStyle: {
            color: '#000'
          },
	      },
	      color: ['#474747', '#8590f2', '#e89805', '#ff847c', '#75919b'],
	      calculable: true,
	      series: [
          {
            name: 'Top Categories',
            type: 'pie',
            radius: ['50%', '70%'],
            center: ['50%', '57.5%'],
            itemStyle: {
              normal: {
                  label: {
                    show: true,
                    textStyle: {
                      color: '#000'
                    }
                  },
                  labelLine: {
                    show: true,
                    lineStyle: {
                      color: '#000'
                    }
                  }
              },
              emphasis: {
                label: {
                  show: true,
                  formatter: '{b}' + '\n\n' + '{c} ({d}%)',
                  position: 'center',
                  textStyle: {
                    fontSize: '17',
                    fontWeight: '500'
                  }
                }
              }
            },
            data: [
              <?php echo $TopsellingModules; ?>
            ]
          }
	      ]
	  };
	  topCategoryChart.setOption(topCategoryChartOptions);
	  $(function () 
	  {
      $(window).on('resize', resize);
      $(".menu-toggle").on('click', resize);
      function resize() {
        setTimeout(function() {
          topCategoryChart.resize();
        }, 200);
      }
	  });
	}
	);
})(window, document, jQuery);
	</script>
</body>
</html>