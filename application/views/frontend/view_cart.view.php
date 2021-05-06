<?php include(dirname(__FILE__)."/includes/f_head.php"); ?>
<body id="courses-list-sidebar" class="page">
<?php include(dirname(__FILE__)."/includes/f_header.php"); ?>

<main>
	<div class="page-heading text-center">
		<div class="container">
			<h2>VIEW CART</h2>
		</div>
	</div>
	<div class="container view-cart">
		<div class="table-responsive">
			<table id="cart" class="table table-hover table-condensed">
				<thead>
					<tr>
						<th style="width:50%">Product</th>
						<th style="width:10%">Price</th>
						<th style="width:8%">Quantity</th>
						<th style="width:22%" class="text-center">Subtotal</th>
						<th style="width:10%"></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td data-th="Product">
							<div class="row">
								<div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
								<div class="col-sm-10">
									<h4 class="nomargin">Product 1</h4>
									<p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
								</div>
							</div>
						</td>
						<td data-th="Price">$1.99</td>
						<td data-th="Quantity">
							<input type="number" class="form-control text-center" value="1">
						</td>
						<td data-th="Subtotal" class="text-center">1.99</td>
						<td class="actions" data-th="">
							<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>
							<button class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></button>								
						</td>
					</tr>
				</tbody>
				<tfoot>
					<tr class="visible-xs">
						<td class="text-center"><strong>Total 1.99</strong></td>
					</tr>
					<tr>
						<td><a href="#" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
						<td colspan="2" class="hidden-xs"></td>
						<td class="hidden-xs text-center"><strong>Total $1.99</strong></td>
						<td><a href="<?php echo base_url('checkout/'); ?>" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</main>
<?php include(dirname(__FILE__)."/includes/f_footer.php"); ?>
