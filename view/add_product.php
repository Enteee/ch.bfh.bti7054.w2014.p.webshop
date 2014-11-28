<?php $this->view('header'); ?>
					<p class="lead"><?php echo label('navAddProduct'); ?></p>
					
				<div class="well">
					<form class="form-horizontal" enctype="multipart/form-data" method="post" action="<?php echo lang(); ?>/product/save" role="form">
						<input type="hidden" class="form-control" name="product_name" id="product_name">
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_id"><?php echo label('name'); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_id" id="product_id" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_description"><?php echo label('description'); ?></label>
							<div class="col-sm-9">
								<textarea type="text" class="form-control" name="product_description" id="product_description" rows="4" required="required"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_categories"><?php echo label('categories'); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_categories" id="product_categories" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_programminglanguages"><?php echo label('programmingLanguages'); ?></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="product_programminglanguages" id="product_programminglanguages" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_file"><?php echo label('codeFile'); ?></label>
							<div class="col-sm-9">
								<input type="hidden" name="MAX_FILE_SIZE" value="2097152"><!-- 2 MB -->
								<input type="file" class="form-control" name="product_file" id="product_file" required="required">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label" for="product_price"><?php echo label('price'); ?></label>
							<div class="col-sm-2">
								<input type="number" class="form-control" name="product_price" id="product_price" required="required">
							</div>
							<div class="col-sm-7 clearfix">
								<button type="submit" class="btn btn-default pull-right"><?php echo label('add'); ?></button>
							</div>
						</div>
					</form>
				</div>

<?php $this->view('footer'); ?> 
