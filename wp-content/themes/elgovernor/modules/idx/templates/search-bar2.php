<form class="navbar-form form-inline" method="post">
		  <ul class="nav navbar-nav">
			<!--<li><a class="modal-open" data-toggle="modal" data-target="#MLSLocation" data-backdrop="false">Select City / Area <span class="caret"></span></a></li>-->
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="false">Areas <span class="caret"></span></a>
			  <ul id="areas">
				<div class="form-group">
					<!--<button class="btn btn-default btn-sm pull-right" id="areaCheckAll" >Check/Uncheck All</button>-->
					<div class="checkbox"><label class="all"><input type="checkbox" value="all" name="AREA[]" <?php
					if($mls->variables['AREA'] == '' || $mls->variables['AREA'][0] == 'all'){ echo 'checked'; }
					?> id="checkallarea" <?php if(!is_array($mls->variables['AREA'])){ ?>checked<?php } ?> > All Areas</label>
					</div>
					<?php
						foreach($mls->areaArray as $areaname => $value){
							echo '<div class="checkbox">';
							if(is_array($mls->variables['AREA'])){
								if(in_array($areaname,$mls->variables['AREA'])){
									echo '<label class="parentoption"><input type="checkbox" value="'.$areaname.'" name="AREA[]" checked class="checkarea" > '.$areaname.'</label>';
								}else{
									echo '<label class="parentoption"><input type="checkbox" value="'.$areaname.'" name="AREA[]" class="checkarea" > '.$areaname.'</label>';
								}
							}else{
								echo '<label class="parentoption"><input type="checkbox" value="'.$areaname.'" name="AREA[]" class="checkarea" > '.$areaname.'</label>';
							}
							if(is_array($value)){
								echo '<div class="subgroup">';
								foreach($value as $subareaname){
									if(is_array($mls->variables['AREA'])){
										if(in_array($subareaname,$mls->variables['AREA'])){
											echo '<label><input type="checkbox" value="'.$subareaname.'" name="AREA[]" checked class="checkarea" > '.$subareaname.'</label>';
										}else{
											echo '<label><input type="checkbox" value="'.$subareaname.'" name="AREA[]" class="checkarea" > '.$subareaname.'</label>';
										}
									}else{
										echo '<label><input type="checkbox" value="'.$subareaname.'" name="AREA[]" class="checkarea" > '.$subareaname.'</label>';
									}
								}
								echo '</div>';
							}
							echo '</div>';
						} ?>
					</div>
				</ul>
			</li>
			<li class="dropdown">
			  <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="true">Property Type <span class="caret"></span></a>
			  <ul id="listingtype">
				<!--<button class="btn btn-default btn-sm pull-right" id="typeCheckAll" >Check/Uncheck All</button>-->
				<div class="checkbox"><label class="all"><input type="checkbox" value="all" name="listingtype[]" <?php
					if($mls->variables['PROP_TYPE'] == '' || $mls->variables['PROP_TYPE'][0] == 'all'){ echo 'checked'; }
				?> id="checkalltype" <?php if(!is_array($mls->variables['PROP_TYPE'])){ ?>checked<?php } ?> > All Property Types</label>
				</div>
				<?php
					foreach($mls->typeArray as $key => $value){
						echo '<div class="checkbox">';
						if(is_array($mls->variables['PROP_TYPE'])){
							if(in_array($key,$mls->variables['PROP_TYPE'])){
								echo '<label><input type="checkbox" value="'.$key.'" name="listingtype[]" class="checktype" checked > '.$value.'</label>';
							}else{
								echo '<label><input type="checkbox" value="'.$key.'" name="listingtype[]" class="checktype" > '.$value.'</label>';
							}
						}else{
							echo '<label><input type="checkbox" value="'.$key.'" name="listingtype[]" class="checktype" > '.$value.'</label>';
						}
						echo '</div>';
					}
				?>
				<!--</select>-->
			  </ul>
			</li>

			<li>
			  <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="true">Price Range <span class="caret"></span></a>
			  <ul id="price">
				<div class="row">
				<div class="col-sm-6">
					<label>Min Price</label>
					<select name="PRICE_MIN" id="pricemin" class="form-control" >
					<option value="any" >Any</option>
					<?php foreach($mls->priceArray as $key => $value){
						if($key == $mls->variables['PRICE_MIN'] && $mls->variables['PRICE_MIN']!=''){
							echo '<option value="'.$key.'" selected>'.$value.'</option>';
						}else{
							echo '<option value="'.$key.'" >'.$value.'</option>';
						}
					} ?>
					</select>
				</div>
				<div class="col-sm-6">
					<label>Max Price</label>
					<select name="PRICE_MAX" id="pricemin" class="form-control" >
					<option value="any" >Any</option>
					<?php foreach($mls->priceArray as $key => $value){
						if($key == $mls->variables['PRICE_MAX'] && $mls->variables['PRICE_MAX']!=''){
							echo '<option value="'.$key.'" selected>'.$value.'</option>';
						}else{
							echo '<option value="'.$key.'" >'.$value.'</option>';
						}
					} ?>
					</select>

				</div>
				</div>
			  </ul>
			</li>
			<li>
			  <a href="#" class="dropdown-toggle" role="button" aria-haspopup="true" aria-expanded="true">Bed/Bath <span class="caret"></span></a>
			  <ul id="bedbath">
				<div class="row">
					<div class=" col-sm-6">
					<label>Beds</label>
						<?php foreach($mls->bedArray as $key => $value){
							echo '<div class="checkbox">';
							if($key == $mls->variables['NUM_BEDROOMS']){
								echo '<label><input type="radio" name="num_bedrooms" value="'.$key.'" checked >'.$value.'</label>';
							}else{
								echo '<label><input type="radio" name="num_bedrooms" value="'.$key.'" >'.$value.'</label>';
							}
							echo '</div>';
						} ?>
					</div>
					<div class=" col-sm-6">
					<label>Baths</label>
						<?php foreach($mls->bathArray as $key => $value){
							echo '<div class="checkbox">';
							if($key == $mls->variables['NUM_BATHROOMS']){
								echo '<label><input type="radio" name="num_baths" value="'.$key.'" checked >'.$value.'</label>';
							}else{
								echo '<label><input type="radio" name="num_baths" value="'.$key.'" >'.$value.'</label>';
							}
							echo '</div>';
						} ?>
					</div>
				</div>
			  </ul>
			</li>
		  </ul>
		<button type="submit" class="btn btn-primary btn-sm pull-right">Search <span class="glyphicon glyphicon-chevron-right"></span></button>
</form>

<div class="searchVars" >
<?php 
	foreach($hiddenVars as $var => $data){
		echo '<button class="btn btn-default btn-sm '.$var.'" >'.$var.'</button>';
	}
?></div>
