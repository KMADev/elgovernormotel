<div class="search-bar-container">
    <form class="form-inline" method="get" >

			<div class="col-md-6">
                <select class="area-select form-control" name="AREA[]" id="id-area-select" multiple="multiple">
                </select>
			</div>
			<div class="col-md-6 col-lg-3">
                <select class="prop-type-input form-control" name="PROP_TYPE[]" multiple="multiple">
                </select>
			</div>
            <div class="col">
                <div class="button-group">
                    <button type="button" class="btn btn-default dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="toggler('advanced-menu');">Advanced</button>
                    <button type="submit" class="btn btn-primary " >Search</button>
                </div>
            </div>

	    </div>
    </form>

<div id="advanced-menu" class="advanced-menu hidden">
		<div class="row">
			<div class="col-md-4 col-lg-6">
				<div class="row">
				<div class="col-xs-6 col-md-12 col-lg-6">
					<label>Min Price</label>
					<select name="PRICE_MIN" id="pricemin" class="form-control select-price" >
					<option value="any" >Any</option>
					<?php foreach($mls->priceArray as $key => $value){
						if($key == $mls->variables['PRICE_MIN'] && $mls->variables['PRICE_MIN']!=''){
							echo '<option value="'.$key.'" selected>'.$value.'</option>';
						}else{
							echo '<option value="'.$key.'" >'.$value.'</option>';
						}
					} ?>
					</select>
					<div class="clearfix">&nbsp;</div>
				</div>
				<div class="col-xs-6 col-md-12 col-lg-6">
					<label>Max Price</label>
					<select name="PRICE_MAX" id="pricemin" class="form-control select-price" >
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
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<label>Beds</label>
					<?php foreach($mls->bedArray as $key => $value){
						echo '<div class="checkbox">';
						if($key == $mls->variables['BEDROOMS']){
							echo '<label><input type="radio" name="num_bedrooms" value="'.$key.'" checked >'.$value.'</label>';
						}else{
							echo '<label><input type="radio" name="num_bedrooms" value="'.$key.'" >'.$value.'</label>';
						}
						echo '</div>';
					} ?>
			</div>
			<div class="col-sm-6 col-md-4 col-lg-3">
				<label>Baths</label>
					<?php foreach($mls->bathArray as $key => $value){
						echo '<div class="checkbox">';
						if($key == $mls->variables['BATHS']){
							echo '<label><input type="radio" name="num_baths" value="'.$key.'" checked >'.$value.'</label>';
						}else{
							echo '<label><input type="radio" name="num_baths" value="'.$key.'" >'.$value.'</label>';
						}
						echo '</div>';
					} ?>
			</div>
		</div>

</div>

<script type="text/javascript">
	window.onload = function(){

		$('.prop-type-input').select2({
			placeholder: 'Property Type',
            width: '100%',
            data: [
            <?php
                foreach($mls->typeArray as $key => $value){
                    if(is_array($mls->variables['PROP_TYPE'])){
                        if(in_array($key,$mls->variables['PROP_TYPE'])){
                            echo '{ id: \''.$key.'\', text: \''.$value.'\', elment: HTMLOptionElement, class: \'selected\' },';
                        }else{
                            echo '{ id: \''.$key.'\', text: \''.$value.'\', elment: HTMLOptionElement, class: \'notselected\' },';
                        }
                    }else{
                        echo '{ id: \''.$key.'\', text: \''.$value.'\', elment: HTMLOptionElement, class: \'notselected\' },';
                    }
                }
            ?> 
            ]
		});

		$(".select-price").select2();
	}

</script>
</div>
