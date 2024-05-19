var list = null;

function pushState(value){
	var parurl = '', Url;
	if(value.page !== 'home'){
		if(value.data !== undefined){
			for (var key in value.data) {
				if(key != 's'){
					parurl = parurl+'/'+value.data[key];
				}
			}

			Url = site.url+'/'+value.page+parurl;
		}else{Url = site.url+'/'+value.page;}
	}else{
		Url = site.url;
	}
	history.pushState(value, "", Url);
}

function page(page, data, but){
	if(data == undefined){
		data = {};
	}

	$.ajax({
		type: 'post',
		url: `${site.url}/page/${page}.php`,
		data: data,
		beforeSend: function(){
			$('body').append($(`<div class="loadpage"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>`).hide().fadeIn('fast'));
		},
		error: function(){
			$('.page').load(`${site.url}/page/404.php`, function(r){
				$('.page').html($(r).hide().fadeIn('slow'));
			});
			site.pload.page = '404';site.pload.data = '';
			if(!but){history.pushState(site.pload, "", site.url+'/404');}
		},
		success: function(m){
			site.pload.page = page;site.pload.data = data;

			$('.page').html($(m).hide().fadeIn('slow'));

			if(!but){pushState(site.pload);}
		},
		complete: function(){
			$('.loadpage').fadeOut('fast', function(){
				$(this).remove();
			});
		}
	});
}
function pagemenu(page, data, but){
	if(data == undefined){
		data = {};
	}

	$.ajax({
		type: 'post',
		url: `${site.url}/page/panel/${page}.php`,
		data: data,
		beforeSend: function(){
			$('body').append($(`<div class="loadpage"><div class="lds-ring"><div></div><div></div><div></div><div></div></div></div>`).hide().fadeIn('fast'));
		},
		error: function(){
			$('.control-content .content').load(`${site.url}/page/panel/404.php`, function(r){
				$('.control-content .content').html($(r).hide().fadeIn('slow'));
			});
			site.pload.page = '404';site.pload.data = '';
			if(!but){history.pushState(site.pload, "", site.url+'/404');}
		},
		success: function(m){
			site.pload.page = page;site.pload.data = data;

			$('.control-content .content').html($(m).hide().fadeIn('slow'));

			if(!but){pushState(site.pload);}
		},
		complete: function(){
			$('.loadpage').fadeOut('fast', function(){
				$(this).remove();
			});
		}
	});
}

window.onpopstate = function(event) {pagemenu(event.state.page,event.state.data,true);};

function UploadPhoto(cb){
	$('body').append($(`
		<div class="upload">
			<div class="upload-content">
				<div style="text-align:center;">
					<button class="btn btn-primary upload-file">
						<form data-ajax="false" name="imgU">
							<input id="fileupload" type="file" name="image" accept="image/png, image/jpeg, image/jpg">
							Subir imagen
						</form>
					</button>
					<button class="btn btn-warning img-link">Imagen link</button>
				</div>

				<div class="upload-data"></div>
			</div>
		</div>
	`).hide().fadeIn('fast'));
	$(function () {
		$('.upload-file input').change(function() {
			$('.upload-file form[name="imgU"]').submit();
		});
		$('form[name="imgU"]').submit(function(e) {
			e.preventDefault();

			var data = new FormData();
    		data.append('image', $('#fileupload')[0].files[0]);

    		$('.upload-content').html($(`<div style="text-align: center;font-weight: 700;font-size: 17px;">Subiendo Imagen...</div>`).hide().fadeIn('fast'));

			$.ajax({
              url: site.url+'/system/actions/upload.php',
              type: 'post',
              data: data,
              contentType: false,
              processData: false,
              success: function(response){
              	if(response !== 'invalid')
              	{
              		$('.upload').fadeOut('fast', function() {
						$(this).remove();
					});
              		if (cb) {
						cb('upload', response);
					}
              	}
              	else
              	{
              		alert('Error al subir imagen');

              		$('.upload').fadeOut('fast', function() {
						$(this).remove();
					});
              	}
              },
           });
		});
	});


	$('.img-link').click(function() {
		var img;
		$('.upload-data').html(`
			<div style="margin: 20px">
				<input name="imgtt" class="form-control" type="text" placeholder="Link de la imagen">
			</div>

			<div style="margin: 20px">
				<img class="imgview" src="">
			</div>
			<div style="margin: 20px">
				<button class="btn btn-warning add">Agregar</button>
			</div>
		`);

		$('input[name="imgtt"]').change(function(){
			img = $(this).val();

			$('.imgview').attr('src',img);
		});

		$('.add').click(function(){
			if (img == null) return;
			$('.upload').fadeOut('fast', function() {
				$(this).remove();
			});

			if (cb) {
				cb('link', img)
			}
		})
	})

	$(document).on('mousedown', function(e){
		const modal = $('.upload').find('.upload-content');
		if(!modal.is(e.target) && modal.has(e.target).length === 0){
			$('.upload').fadeOut('fast', function() {
				$(this).remove();
			})}
	});
	
}

function currencyFormatter({currency, value}) {
  const formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    minimumFractionDigits: 2,
    currency
  });

  return formatter.format(value)
}

function lang_table() {
	return {
	    "decimal":        "",
	    "emptyTable":     "No hay datos disponibles en la tabla",
	    "info":           "Mostrando _START_ a _END_ de _TOTAL_ objetos ",
	    "infoEmpty":      "Mostrando 0 a 0 de 0 objetos ",
	    "infoFiltered":   "(filtrado de _MAX_ total de objetos)",
	    "infoPostFix":    "",
	    "thousands":      ",",
	    "lengthMenu":    "Mostrar _MENU_ objetos",
	    "loadingRecords": "Loading...",
	    "processing":     "",
	    "search":         "Buscar:",
	    "zeroRecords":    "No se encontraron registros",
	    "paginate": {
	        "first":      "Primero",
	        "last":       "Ultimo",
	        "next":       "Siguiente",
	        "previous":   "Atras"
	    },
	    "aria": {
	        "sortAscending": ": activate to sort column ascending",
	        "sortDescending": ": activate to sort column descending"
	    }
	}
}

function exportTableToExcel(tableID, filename = ''){
	var htmltabel = $('#'+tableID).clone();
	$(htmltabel).find('th').show();
	$(htmltabel).find('td').show();

	var column = $(htmltabel).find('thead tr').find('th').length;
	for (var i = 0; i < $(htmltabel).find('thead tr').length; i++) {
		if($($(htmltabel).find('tbody tr')[i]).find('td').length !== column) {
			$($(htmltabel).find('tbody tr')[i]).remove();
		}
	}
	$(htmltabel).find('.excel_clear').remove();

	filename = filename ? filename+'.xlsx' : 'excel_data.xlsx';
	
	var ws = XLSX.utils.table_to_sheet(htmltabel[0]);
	for (var i in ws) {
    if (typeof ws[i] != 'object') continue;
    let cell = XLSX.utils.decode_cell(i);
    if(cell.r == 0)
    {
			ws['!cols'][cell.c] = {wpx: 100};
    }
  }

	var wb = XLSX.utils.book_new();
	XLSX.utils.book_append_sheet(wb, ws, "Sheet 1");
	XLSX.writeFile(wb, filename);
}