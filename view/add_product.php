<?php $this->view('header'); ?>
					<p class="lead"><?php echo label('navAddProduct'); ?></p>
					
				<div class="well">
					<form class="form-horizontal" method="post" action="<?php echo lang(); ?>/product/save" role="form">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_name"><?php echo label('name'); ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product_name" id="product_name">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_description"><?php echo label('description'); ?></label>
							<div class="col-sm-10">
								<textarea type="text" class="form-control" name="product_description" id="product_description" rows="4"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_categories"><?php echo label('categories'); ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product_categories" id="product_categories">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_programminglanguages"><?php echo label('programmingLanguages'); ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product_programminglanguages" id="product_programminglanguages">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_tags"><?php echo label('tags'); ?></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" name="product_tags" id="product_tags">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="product_file"><?php echo label('codeFile'); ?></label>
							<div class="col-sm-10">
								<input type="file" class="form-control" name="product_file" id="product_file">
							</div>
						</div>
						<button type="submit" class="btn btn-default"><?php echo label('add'); ?></button>
					</form>
				</div>

<?php $this->view('footer'); ?> 
