<div class="content-header">
	<div class="d-flex align-items-center">
		<div class="me-auto">
			<h3 class="page-title"><?= isset($breadcrumb) ? $breadcrumb : $title  ?></h3>
			<div class="d-inline-block align-items-center">
				<nav>
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
						<li class="breadcrumb-item" aria-current="page"><?= $title ?></li>
						<li class="breadcrumb-item active" aria-current="page">Tambah <?= $title ?></li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</div>

<section class="content">
	
	<div class="row">
		
		<div class="col-12">
			<div class="box">
				<div class="box-header">
					<h4 class="box-title">Form <?= $title ?></h4>
				</div>
				<div class="box-body">
					<div class="row">
						<?php $error = $this->session->flashdata('error') ?>
						    <form class="settings-form" method="post" action="<?= base_url('transactions/store') ?>">
						    	<div class="mb-3">
								    <label for="member_id" class="form-label">Member</label>
								    <select class="form-control" name="member_id" required id="member_id">
								    	<option selected disabled value="">Pilih Member</option>
								    	<?php foreach ($members as $value): ?>
								    		<option value="<?= $value->id ?>" <?= set_value('member_id') == $value->id ? 'selected' : '' ?>><?= $value->name ?> </option>
								    	<?php endforeach ?>
								    </select>
								    <?= isset($error['member_id']) ? $error['member_id'] : ''  ?>
								</div>
								<div class="row">
									<div class="col-6">
										<div class="mb-3">
										    <label for="due_date" class="form-label">Batas Waktu</label>
											<input type="date" min="<?= date("Y-m-d") ?>" class="form-control" name="due_date" value="<?= set_value("due_date",date("Y-m-d")) ?>" required id="due_date">
										    <?= isset($error['due_date']) ? $error['due_date'] : ''  ?>
										</div>
									</div>
									<div class="col-6">
										<div class="mb-3">
										    <label for="due_time" class="form-label">&nbsp;</label>
											<input type="time"  class="form-control" name="due_time" value="<?= set_value("due_time",date("H:i")) ?>" required id="due_time">
										    <?= isset($error['due_time']) ? $error['due_time'] : ''  ?>
										</div>
									</div>
								</div>
								<div class="bg-light p-3 b-2 border-primary">
									<!-- Multiple -->

									<div id="multiple-service">
						                <input type="hidden" name="number" id="number" value="0"> 
										<div class="row">
											<div class="col-lg-4">
											    <div class="mb-3">
												    <label for="service_detail_id_0" class="form-label">Jenis pelayanan</label>
												    <select class="form-control service_detail_id" name="service_detail_id[]" required id="service_detail_id_0">
												    	<option selected disabled value="">Pilih Jenis Pelayanan</option>
												    	<?php foreach ($services as $group): ?>
													    	<optgroup label="<?= $group->name ?>">
													    		<?php foreach ($group->detail as $opt): ?>
													    			<option value="<?= $opt->id ?>" <?= set_value('service_detail_id') == $opt->id ? 'selected' : '' ?> data-price="<?= $opt->price ?>" data-unit="<?= $opt->unit ?>"><?= $opt->name ?> [<?= $opt->price.'/'.$opt->unit ?>]</option>
													    		<?php endforeach ?>
													    	</optgroup>
												    		
												    	<?php endforeach ?>
												    </select>
												    <?= isset($error['service_detail_id']) ? $error['service_detail_id'] : ''  ?>
												</div>
											</div>
											<div class="col-lg-3">
												<div class="mb-2">
												    <label for="price_0" class="form-label">Harga / Unit</label>
													<div class="input-group">
													    <input type="hidden" class="form-control" id="price_0" readonly value="<?= set_value('price') ?>" name="price[]" required placeholder="10000">
													    <input type="text" class="form-control text-end" id="price_show_0" readonly value="<?= set_value('price') ?>" name="price_show" required placeholder="10000">
														<span class="input-group-text" id="unit-text-0"></span>
													</div>
												    <input type="hidden" class="form-control" id="unit_0" readonly value="<?= set_value('unit') ?>" name="unit" required placeholder="Pcs">
												    <?= isset($error['price']) ? $error['price'] : ''  ?>
												    <?= isset($error['unit']) ? $error['unit'] : ''  ?>
												</div>
											</div>
											<div class="col-lg-2">
												<div class="mb-3">
													
												    <label for="weight_0" class="form-label">Jumlah Berat/Satuan</label>
													<div class="input-group">
														<input type="number" step="0.5" min="1" class="form-control weight" name="weight[]" value="<?= set_value("weight",1) ?>" required id="weight_0">
														<span class="input-group-text" id="text-unit-0"></span>
													</div>
												    <?= isset($error['weight']) ? $error['weight'] : ''  ?>
												</div>
											</div>
											<div class="col-lg-2">
											    <div class="mb-3">
												    <label for="subtotal_0" class="form-label">Subtotal</label>
												    <input type="hidden" readonly class="form-control subtotal" id="subtotal_0" value="<?= set_value('subtotal'),0 ?>" name="subtotal[]" required placeholder="0">
												    <input type="text" readonly class="form-control text-end" id="subtotal_show_0" value="<?= set_value('subtotal'),0 ?>" name="subtotal_show" required placeholder="0">
												    <?= isset($error['subtotal']) ? $error['subtotal'] : ''  ?>
												</div>
											</div>
											<div class="col-lg-1">
											    <div class="mb-3">
												    <label class="form-label">&nbsp;</label> <br>
													<button type="button" class="btn btn-primary btn-sm" onclick="addRow()"><span class="fa fa-plus"></span></button>
												</div>
											</div>
										</div>
									</div>

									<!-- Side right -->
									<div class="row">
										<div class="col-lg-9">
										</div>
										<div class="col-lg-3">
											<div class="mb-3">
							    			    <label for="discount" class="form-label">Diskon</label>
							    			    <div class="input-group">
							    			    	<input type="number" class="form-control text-end" name="discount" id="discount" value="<?= set_value('discount',0) ?>">
							    			    	<span class="input-group-text">%</span>
							    			    </div>
							    			    <?= isset($error['discount']) ? $error['discount'] : ''  ?>
							    			</div>
										</div>
										<div class="col-lg-9">
										</div>
										<div class="col-lg-3">
											<div class="mb-3">
							    			    <label for="tax" class="form-label">Pajak</label>
							    			    <div class="input-group">
							    			    	<input type="number" class="form-control text-end" name="tax" id="tax" value="<?= set_value('tax',0) ?>">
							    			    	<span class="input-group-text">%</span>
							    			    </div>
							    			    <?= isset($error['tax']) ? $error['tax'] : ''  ?>
							    			</div>
										</div>
										<div class="col-lg-9">
										</div>
										<div class="col-lg-3">
							    		    <div class="mb-3">
							    			    <label for="total" class="form-label">Total</label>
							    			    <input type="hidden" readonly class="form-control" id="total" value="<?= set_value('total') ?>" name="total" required placeholder="0">
							    			    <input type="text" readonly class="form-control text-end" id="total_show" value="<?= set_value('total') ?>" name="total_show" required placeholder="0">
							    			    <?= isset($error['total']) ? $error['total'] : ''  ?>
							    			</div>
										</div>
									</div>
								</div>
							    <div class="mb-3">
								    <label for="gender" class="form-label">Status Pembayaran</label>

									<div class="form-check">
										<input class="form-check-input" type="radio" <?= set_value('payment_status') == 'sudah dibayar' ? 'checked' : '' ?> value="sudah dibayar" id="payment_status-1" name="payment_status" checked>
									 	<label class="form-check-label" for="payment_status-1">
									    	Sudah Dibayar
										</label>
										<input class="form-check-input" type="radio" <?= set_value('payment_status') == 'belum dibayar' ? 'checked' : '' ?> value="belum dibayar" id="payment_status-0" name="payment_status" >
									 	<label class="form-check-label" for="payment_status-0">
									    	Belum Dibayar
										</label>
									</div>
								    <?= isset($error['payment_status']) ? $error['payment_status'] : ''  ?>
								</div>
								<a href="<?= base_url('transactions') ?>" class="btn btn-secondary" >Kembali</a>
								<button type="submit" class="btn btn-primary" >Simpan</button>
						    </form>
					</div><!--//row-->
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	$(".service_detail_id, .weight").change(function(){
		var id = $(this).attr('id');
		var num = id.split('_');
	  	num = num[num.length - 1];
		const selected = $(`#service_detail_id_${num} option:selected`);
		const price = selected.data('price');
		const unit = selected.data('unit');
		const weight = $(`#weight_${num}`).val();
	  	console.log(price, weight)

		$(`#price_${num}`).val(price)
		$(`#price_show_${num}`).val(price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))
		$(`#unit_${num}`).val(unit)
		$(`#unit-text-${num}`).text(`/${unit}`)
		$(`#text-unit-${num}`).text(unit)
		$(`#subtotal_${num}`).val(parseInt(weight)*parseInt(price))
		$(`#subtotal_show_${num}`).val((parseInt(weight)*parseInt(price)).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))

		setTotal()
		// console.log(price,unit)

	})

	function addRow(data = null)
    {
      var number = parseInt($("#number").val())+1;
      var html =`
      <div class="row">
		<div class="col-lg-4">
		    <div class="mb-3">
			    <label for="service_detail_id_${number}" class="form-label">Jenis pelayanan</label>
			    <select class="form-control service_detail_id" name="service_detail_id[]" required id="service_detail_id_${number}">
			    	<option selected disabled value="">Pilih Jenis Pelayanan</option>
			    	<?php foreach ($services as $group): ?>
				    	<optgroup label="<?= $group->name ?>">
				    		<?php foreach ($group->detail as $opt): ?>
				    			<option value="<?= $opt->id ?>" <?= set_value('service_detail_id') == $opt->id ? 'selected' : '' ?> data-price="<?= $opt->price ?>" data-unit="<?= $opt->unit ?>"><?= $opt->name ?> [<?= $opt->price.'/'.$opt->unit ?>]</option>
				    		<?php endforeach ?>
				    	</optgroup>
			    		
			    	<?php endforeach ?>
			    </select>
			    <?= isset($error['service_detail_id']) ? $error['service_detail_id'] : ''  ?>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="mb-2">
			    <label for="price_${number}" class="form-label">Harga / Unit</label>
				<div class="input-group">
				    <input type="hidden" class="form-control" id="price_${number}" readonly value="" name="price[]" required placeholder="10000">
				    <input type="text" class="form-control text-end" id="price_show_${number}" readonly value="" name="price_show" required placeholder="10000">
					<span class="input-group-text" id="unit-text-${number}"></span>
				</div>
			    <input type="hidden" class="form-control" id="unit_${number}" readonly value="" name="unit" required placeholder="Pcs">
			    <?= isset($error['price']) ? $error['price'] : ''  ?>
			    <?= isset($error['unit']) ? $error['unit'] : ''  ?>
			</div>
		</div>
		<div class="col-lg-2">
			<div class="mb-3">
				
			    <label for="weight_${number}" class="form-label">Jumlah Berat/Satuan</label>
				<div class="input-group">
					<input type="number" step="0.5" min="1" class="form-control weight" name="weight[]" value="1" required id="weight_${number}">
					<span class="input-group-text" id="text-unit-${number}"></span>
				</div>
			    <?= isset($error['weight']) ? $error['weight'] : ''  ?>
			</div>
		</div>
		<div class="col-lg-2">
		    <div class="mb-3">
			    <label for="subtotal_${number}" class="form-label">Subtotal</label>
			    <input type="hidden" readonly class="form-control subtotal" id="subtotal_${number}" value="0" name="subtotal[]" required placeholder="0">
			    <input type="text" readonly class="form-control text-end" id="subtotal_show_${number}" value="0" name="subtotal_show" required placeholder="0">
			    <?= isset($error['subtotal']) ? $error['subtotal'] : ''  ?>
			</div>
		</div>
		<div class="col-lg-1">
		    <div class="mb-3">
			    <label class="form-label">&nbsp;</label> <br>
	            <button type="button" class="btn btn-danger btn-sm btn_remove_column"> <i class="fa fa-times"></i></button>
			</div>
		</div>
	</div>
      `;
      $("#multiple-service").append(html)
      $('#number').val(number)

      if (data) {
        fillForm()
      }
      // $(".select2").select2({
      //   theme: 'bootstrap4',
      //   width:'100%'
      // })

      $(".service_detail_id, .weight").change(function(){
      	var id = $(this).attr('id');
      	var num = id.split('_');
        	num = num[num.length - 1];
      	const selected = $(`#service_detail_id_${num} option:selected`);
      	const price = selected.data('price');
      	const unit = selected.data('unit');
      	const weight = $(`#weight_${num}`).val();
        	console.log(price, weight)

      	$(`#price_${num}`).val(price)
      	$(`#unit_${num}`).val(unit)
      	$(`#unit-text-${num}`).text(`/${unit}`)
      	$(`#text-unit-${num}`).text(unit)
      	$(`#subtotal_${num}`).val(parseInt(weight)*parseInt(price))
		$(`#price_show_${num}`).val(price.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))

		$(`#subtotal_show_${num}`).val((parseInt(weight)*parseInt(price)).toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))

      	setTotal()
      	// console.log(price,unit)

      })

      
    }
	// $('.service_detail_id').change(function(){
	//   var id = $(this).attr('id');
	//   var num = id.split('_');
	//   num = num[num.length - 1];
	//   const price = $(`#${id} option:selected`).attr('price');
	//   const stock = $(`#${id} option:selected`).attr('stock');
	//   $(`#qty_${num}`).val(1).attr('max', stock)
	//   $(`#price_${num}`).val(price)
	//   $(`#subtotal_${num}`).val(price*1)
	//   count()

	//   $(`#qty_${num}`).change(function(){
	//     var qty = $(this).val()
	//     var harga = $(`#price_${num}`).val()
	//     $(`#subtotal_${num}`).val(qty*harga)

	//     count()
	//   })

	// })

    $(document).on('click', '.btn_remove_column', function() {
          // console.log($(this).parent())
          $(this).parent().parent().parent().remove();
          var no = parseInt($("#number").val())-1;
          $('#number').text(no)
          setTotal()
      });

	$("#tax, #discount").change(function(){
		setTotal()
	})
	function setTotal()
	{
		
		var tax = $("#tax").val() ? $("#tax").val() : 0;
		tax = tax/100;
		var discount = $("#discount").val() ? $("#discount").val() : 0;
		discount = discount/100;

		var subtotal = 0;
        $(".subtotal").each(function (index, element) {
            subtotal += parseInt(element.value) || 0;
        });

        var total = subtotal+(tax*subtotal)-(discount*subtotal) 
        // $("#grand-total").text(gt.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))



		// $("#subtotal").val(prices*weight)

		// var subtotal = $("#subtotal").val() ? $("#subtotal").val() : 0;
		$("#total").val(total)
		$("#total_show").val(total.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' }))

	}
</script>