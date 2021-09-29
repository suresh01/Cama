<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Summary By Property Status and Building Categori vs Race</title>

@include('includes.header', ['page' => 'report'])
					
	<div id="content">
		<div class="grid_container">
			<div class="grid_12">	
					<br>
				<div class="breadCrumbHolder module">	
				<div id="breadCrumb3" style="/*float:right;*/" class="breadCrumb module grid_6">
					<ul>
						<li><a href="#">Home</a></li>
						<li><a href="#">Report</a></li>
						<li><a href="#">Statistcal</a></li>
						<li>Summary By Property Status and Building Categori vs Race</li>
					</ul>
				</div>
				</div>
				
				<div style="float:right;margin-right: 10px;"  class="btn_24_blue">	
					<a  href="#" onclick="deleteProperty()" >Generate Report</a>				
					@include('report.statistical.racesearch')
				</div>
				<br>
				
        
        
				<div class="widget_wrap">					
					<div class="widget_content">						
						<table id="proptble" class="display select">
							<thead style="text-align: left;">
								<tr>
									<th><input name="select_all" value="1" type="checkbox"></th>
									<th class="table_sno">
										S No
									</th>
									<th>
										BUILDING STATUS
									</th>
									<th>
										BUILDING CATEGORY
									</th>
									<th>
										MELAYU
									</th>
									<th>
										CINA
									</th>
									<th>
										INDIA
									</th>	
									<th>
										SYAIKAT
									</th>	
									<th>
										LAINLAIN
									</th>	
									<th>
										TOTAL
									</th>		
								</tr>
							</thead>
							<tbody>			
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<input type="hidden" name="termid" id="termid">
			
		<!-- <form style="display: hidden;" id="generateform" method="GET" action="generateinspectionreport">
            @csrf
            <input type="hidden" name="accounts" id="accounts">
		</form>-->
		
		
	</div>
	
	<span class="clear"></span>
	
	<script>
		
		function changeField(val){
			if(val == 'table'){
				$('#maxrow').removeAttr('style');
			} else {
				$('#maxrow').attr('style', "display:none;");
			}
		}


		function deleteProperty(){
			var table = $('#proptble').DataTable();
//console.log(table.rows('.selected').data()); 
			var tilte = prompt("Report Title", "STATISTIK HARTA MENGIKUT BANGSA SEHINGGA PENGGAL");

			if (tilte == null || tilte == "") {
				return;
			} else {
				var id = $('#termid').val();
				alert(id);
				window.location = "generatesummaryrace?title="+tilte+"&termid="+id;
			}
			
		}
	

		


		function updateDataTableSelectAllCtrl(table){
		   var $table             = table.table().node();
		   var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
		   var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
		   var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

			   // If none of the checkboxes are checked
		   if($chkbox_checked.length === 0){
		      chkbox_select_all.checked = false;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If all of the checkboxes are checked
		   } else if ($chkbox_checked.length === $chkbox_all.length){
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = false;
		      }

		   // If some of the checkboxes are checked
		   } else {
		      chkbox_select_all.checked = true;
		      if('indeterminate' in chkbox_select_all){
		         chkbox_select_all.indeterminate = true;
		      }
		   }
		}

$(document).ready(function (){
	var table = $('#proptble').DataTable({
		        "processing": false,
		        "serverSide": false,
		        "retrieve": true,
		        /*"dom": '<"toolbar">frtip',*/
				 
		        // ajax: '{{ url("inspectionproperty") }}',
		        /*"ajax": '/bookings/datatables',*/
		        "columns": [
			        {"data": null, "orderable": false, "searchable": false, "name":"_id" },
			        {"data": null, "name": "sno"},
			        {"data": "bldgstatus", "name": "account number"},
			        {"data": "bldgcategory", "name": "fileno"},
			        {"data": "MELAYU", "name": "zone","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" },
			        {"data": "CINA", "name": "subzone","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" },
			        {"data": "INDIA", "name": "owner","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" }, 
			        {"data": "SYAIKAT", "name": "ishasbldg","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" },
			        {"data": "LAINLAIN", "name": "owntype","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" }, 
			        {"data": "TOTAL", "name": "bldgcount","render": $.fn.dataTable.render.number( ',', '.', 0 ), "className": "number_algin" }
		   		],
		   		"fnRowCallback": function (nRow, aData, iDisplayIndex) {
		   			var oSettings = this.fnSettings();
  	
			        $("td:nth-child(2)", nRow).html(oSettings._iDisplayStart+iDisplayIndex +1);
			        return nRow;
			    },
			    "sPaginationType": "full_numbers",
			"iDisplayLength": 100,
			"oLanguage": {
		        "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>",	
		    },
		    'columnDefs': [{
         'targets': 0,
         'searchable': true,
         'orderable': false,
         'width': '1%',
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<input type="checkbox">';
         }
      }],
      'rowCallback': function(row, data, dataIndex){
         // Get row ID
         var rowId = data[0];

         // If row ID is in the list of selected row IDs
         if($.inArray(rowId, rows_selected) !== -1){
            $(row).find('input[type="checkbox"]').prop('checked', true);
            $(row).addClass('selected');
         }
      },
        	"bAutoWidth": false,
			"sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
			});
   // Array holding selected row IDs
   var rows_selected = [];
   
    
   

   // Handle click on checkbox
   $('#proptble tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = $('#proptble').DataTable().row($row).data();

      // Get row ID
      var rowId = data[0];

      // Determine whether row ID is in the list of selected row IDs
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
         rows_selected.push(rowId);

      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      } else if (!this.checked && index !== -1){
         rows_selected.splice(index, 1);
      }

      if(this.checked){
         $row.addClass('selected');
      } else {
         $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle click on table cells with checkboxes
   $('#proptble').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
   });

   // Handle click on "Select all" control
   $('thead input[name="select_all"]', $('#proptble').DataTable().table().container()).on('click', function(e){
      if(this.checked){
         $('#proptble tbody input[type="checkbox"]:not(:checked)').trigger('click');
      } else {
         $('#proptble tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
   });

   // Handle table draw event
   $('#proptble').DataTable().on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl($('#proptble').DataTable());
   });
   // Handle form submission event

});


	</script>
</div>
<div id="loader">
		
	</div>
</body>
</html>