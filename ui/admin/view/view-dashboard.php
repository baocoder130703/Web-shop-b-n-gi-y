<div id="content">
  <div class="page-header">
    <div class="container-fluid">
<!--       <h1>Dashboard</h1> -->
      <ul class="breadcrumb">
        <li><a href="/admin.php">Quản Trị</a></li>
        <li><a href="/admin/dashboard.php">Dashboard</a></li>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
        <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng số đơn hàng <span class="pull-right"><i class="fa fa-caret-up"></i>...%</span></div>
  <div class="tile-body"><i class="fa fa-shopping-cart"></i>
    <h2 class="pull-right"><?php echo orderGetTotal();?></h2>
  </div>
  <div class="tile-footer"><a href="/admin/order.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng doanh số <span class="pull-right">
        <i class="fa fa-caret-up"></i>...% </span></div>
  <div class="tile-body"><i class="fa fa-credit-card"></i>
    <h2 class="pull-right"><?php echo orderGetTotalSalesWithFormat();?></h2>
  </div>
  <div class="tile-footer"><a href="/admin/order.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Tổng số khách hàng <span class="pull-right">
        <i class="fa fa-caret-down"></i>
        -...%</span></div>
  <div class="tile-body"><i class="fa fa-user"></i>
    <h2 class="pull-right">...</h2>
  </div>
  <div class="tile-footer"><a href="/admin/customer.php">Xem thêm ...</a></div>
</div>
</div>
      <div class="col-lg-3 col-md-3 col-sm-6"><div class="tile">
  <div class="tile-heading">Khách hàng Online</div>
  <div class="tile-body"><i class="fa fa-eye"></i>
    <h2 class="pull-right">...</h2>
  </div>
  <div class="tile-footer"><a href="#link-to-report-customer-online">Xem thêm ...</a></div>
</div>
</div>
    </div>
      <div class="col-lg-6 col-md-12 col-sx-12 col-sm-12">
       <div class="panel panel-default">
		  <div class="panel-heading">
		    <div class="pull-right"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-calendar"></i> <i class="caret"></i></a>
		      <ul id="range" class="dropdown-menu dropdown-menu-right">
		        <li><a href="http://demo.opencart.com/admin/day">Today</a></li>
		        <li><a href="http://demo.opencart.com/admin/week">Week</a></li>
		        <li class="active"><a href="http://demo.opencart.com/admin/month">Month</a></li>
		        <li><a href="http://demo.opencart.com/admin/year">Year</a></li>
		      </ul>
		    </div>
    		<h3 class="panel-title"><i class="fa fa-bar-chart-o"></i> Sales Analytics</h3>
          </div>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
          <canvas id="myChart" style="width:100%;max-width:600px">
        </canvas>

<script>
  // bieu do ===================
 var xValues =  <?php //ngay 
  
  date_default_timezone_get('Asia/Ho_Chi_Minh');
  $today = date('Y-m-d');
  $array_date = '"'.$today.'"';
  for($i =0 ;$i<5;$i++)
  {
    $today = explode('-',$today);
    $today = dayMonthYear($today[2],$today[1],$today[0]);
    $array_date = '"'.$today.'",'.$array_date;
  } 
  $today = explode('-',$today);//ham tach chuoi
  $today = dayMonthYear($today[2],$today[1],$today[0]);
  $array_date = '["'.$today.'",'.$array_date . ']';
  echo $array_date;

?>;

var yValues = <?php 

  date_default_timezone_get('Asia/Ho_Chi_Minh');
  $today = date('Y-m-d');
  $total =  orderGetTotalWithTime($today);
  $array_total = $total;
  for($i =0 ;$i<6;$i++)
  {
    $today = explode('-',$today);
    $today = dayMonthYear($today[2],$today[1],$today[0]);
    $total = orderGetTotalWithTime($today);
    $array_total = $total.','.$array_total  ;
  }
  $array_total = '['.$array_total.']' ;
  echo $array_total ;
 
?>;
console.log(yValues);

var barColors = ["red", "green","blue","orange","brown","aqua","yellow"];

new Chart("myChart", {
  type: "bar",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    legend: {display: false},
    title: {
      display: true,
      text: "World Wine Production 2018"
    }
  }
});
// bieu do ===================
</script>
<script type="text/javascript" src="/Templates/OpenCartAdmin_files//jquery_004.js"></script> 
<script type="text/javascript" src="/Templates/OpenCartAdmin_files//jquery_003.js"></script>
<script type="text/javascript">
//$('#range a').on('click', function(e) {
//	e.preventDefault();
//	
//	$(this).parent().parent().find('li').removeClass('active');
//	
//	$(this).parent().addClass('active');
//	
//	$.ajax({
//		type: 'get',
//		url: 'index.php?route=dashboard/chart/chart&token=c8e9256a500ecc7df571605f7be89958&range=' + $(this).attr('href'),
//		dataType: 'json',
//		success: function(json) {
//			var option = {	
//				shadowSize: 0,
//				colors: ['#9FD5F1', '#1065D2'],
//				bars: { 
//					show: true,
//					fill: true,
//					lineWidth: 1
//				},
//				grid: {
//					backgroundColor: '#FFFFFF',
//					hoverable: true
//				},
//				points: {
//					show: false
//				},
//				xaxis: {
//					show: true,
//            		ticks: json['xaxis']
//				}
//			}
//			
//			$.plot('#chart-sale', [json['order'], json['customer']], option);	
//					
//			$('#chart-sale').bind('plothover', function(event, pos, item) {
//				$('.tooltip').remove();
//			  
//				if (item) {
//					$('<div id="tooltip" class="tooltip top in"><div class="tooltip-arrow"></div><div class="tooltip-inner">' + item.datapoint[1].toFixed(2) + '</div></div>').prependTo('body');
//					
//					$('#tooltip').css({
//						position: 'absolute',
//						left: item.pageX - ($('#tooltip').outerWidth() / 2),
//						top: item.pageY - $('#tooltip').outerHeight(),
//						pointer: 'cusror'
//					}).fadeIn('slow');	
//					
//					$('#chart-sale').css('cursor', 'pointer');		
//			  	} else {
//					$('#chart-sale').css('cursor', 'auto');
//				}
//			});
//		},
//        error: function(xhr, ajaxOptions, thrownError) {
//           alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
//        }
//	});
//});
//
//$('#range .active a').trigger('click');
//--></script> </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-12 col-sm-12 col-sx-12"><div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-calendar"></i> Recent Activity</h3>
  </div>
  <ul class="list-group">
            <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 04:01:15</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 04:00:18</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:58:58</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:57:48</small></li>
        <li class="list-group-item"><a href="http://demo.opencart.com/admin/index.php?route=sale/customer/edit&amp;token=c8e9256a500ecc7df571605f7be89958&amp;customer_id=543">Performance p</a> logged in.<br>
      <small class="text-muted"><i class="fa fa-clock-o"></i> 23/01/2015 03:56:14</small></li>
          </ul>
</div></div>
      <div class="col-lg-8 col-md-12 col-sm-12 col-sx-12"> <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Đơn hàng mới nhất</h3>
  </div>
  <div class="table-responsive">
  <?php if(orderGetLatestForDashboard()) { ?>
    <table class="table">
      <thead>
        <tr>
          <td class="text-right">ID</td>
          <td>Khách Hàng</td>
          <td>Trạng Thái</td>
          <td>Ngày Tạo</td>
          <td class="text-right">Tổng Giá Trị</td>
          <td class="text-right">Hành Động</td>
        </tr>
      </thead>
      <tbody>
      
      <?php foreach(orderGetLatestForDashboard() as $order_detail) { ?>
      <tr>
          <td class="text-right"><?php echo $order_detail['order_id'] ;?></td>
          <td><?php echo $order_detail['customer'] ;?></td>
          <td><?php echo $order_detail['status'] ;?></td>
          <td><?php echo $order_detail['date_added'] ;?></td>
          <td class="text-right"><?php echo $order_detail['total'] ;?></td>
          <td class="text-right"><a data-original-title="View" href="<?php echo $order_detail['view'];?>" data-toggle="tooltip" title="" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
        </tr>
      <?php } ?>
      
      </tbody>
    </table>
   <?php } else { ?>
   <h3>Không có đơn hàng mới nào</h3>   	
   <?php } ?> 
  </div>
</div>
 </div>
    </div>
  </div>
</div>