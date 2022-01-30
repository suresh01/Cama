<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width"/>
<title>Buliding Detail</title>
<style type="text/css">
  #bldgarea td.numericCol {
    text-align: right;
  }
  #bldgallowance td.numericCol {
    text-align: right;
  }
</style>
@include('includes.header-popup')
   <div id="content">
    <div class="grid_container">
      <div class="grid_12">
        <div class="widget_wrap">
          <div class="widget_top">
            <h6>{{__('valuation.Valuation')}}</h6> 
          </div>
          <div class="widget_content">
            <div class=" page_content"> 
              <div class="invoice_container"> 
                
                <fieldset>
                  <legend>{{__('valuation.Building_Detail')}}</legend>   
                      

    <span class="clear"></span>
          <div class="widget_wrap tabby">
             
            <div class="widget_top">
            
            <div id="widget_tab">
              <ul>
                <li><a href="#tab1" class="active_tab">{{__('valuation.Building_Detail')}}</a></li>
                <li><a href="#tab2">{{__('valuation.Allowance')}}</a></li>
              </ul>
            </div>
          </div>
          <div class="widget_content">
            <div id="tab1">
               <div class="grid_12 invoice_details">
                      <div class="invoice_tbl">
                        <table  id="bldgarea">
                        <thead>
                        <tr class=" gray_sai">
                          <th>
                            0: {{__('valuation.SNo')}}
                          </th>
                          <th>
                            1: {{__('valuation.Area_Type')}}
                          </th>
                          <th>
                            2: {{__('valuation.Area_Level')}}
                          </th>
                          <th>
                            3: {{__('valuation.Area_Category')}}
                          </th>
                          <th>
                            4: {{__('valuation.Area_Used')}}
                          </th>
                          <th>
                            5: {{__('valuation.Area')}}
                          </th>
                          <th>
                            6: {{__('valuation.Area_Rate')}}
                          </th>
                          <th >
                            7: {{__('valuation.Gross_Area_Value')}}
                          </th>
                          <th>
                            8: {{__('valuation.Rate')}}
                          </th>
                          <th>
                            9: {{__('valuation.Bldgarid')}}
                          </th>
                          <th>
                            10: {{__('valuation.Bldgid')}}
                          </th>
                        </tr>
                        </thead>
                        <tbody>                                                  
                        
                        </tbody>
                        <tr>
                          <td colspan="7" class="grand_total">                            
                            {{__('valuation.Total_Buliding_Value')}}:
                          </td>
                          <td>
                            <input type="text" readonly="true"  style="float: right; text-align: right;" class="tbl-total" id="bldgtotal">
                          </td>
                        </tr>
                        </table>
                      </div>
                    </div>
            </div>
            <div id="tab2">
               <div class="grid_12 invoice_details">
                      <div class="invoice_tbl">
                        <table id="bldgallowance">
                        <thead>
                        <tr class=" gray_sai">
                          <th>
                            0: {{__('valuation.SNo')}}
                          </th>
                          <th>
                            1: {{__('valuation.Description')}} ({{__('valuation.Allwoance_Cateory')}} ,  {{__('valuation.Allowance_Type')}})
                          </th>
                          <th>
                            2: {{__('valuation.Allowance_Type')}} ID
                          </th>
                          <th>
                            3: {{__('valuation.Calculation_Method')}}
                          </th>
                           <th>
                            4: {{__('valuation.Calculation_Method')}} ID
                          </th>
                          <th>
                            5: {{__('valuation.Percentage')}} / {{__('valuation.Value')}}
                          </th>
                          <th>
                            6: {{__('valuation.Gross_Allowance')}}
                          </th>
                          <th>
                            7: {{__('valuation.allowanceid')}}
                          </th>
                          <th>
                            8: {{__('valuation.bldgid')}}
                          </th>
                          <th>
                            9: {{__('valuation.Action')}}
                          </th>
                        </tr>
                        </thead>
                        <tbody>
                        
                         
                        
                        </tbody>
                         <tr>
                          <td colspan="4" class="grand_total">    
                          <button id="addadditional" onclick="openModal()" name="adduser" style="float: left; "  type="button" class=" basic-modal btn_small btn_blue "><span>{{__('valuation.Add_Allowance_value')}}</span></button>                        
                            {{__('valuation.Total_Allowance_Value')}} :
                          </td>
                          <td>
                            <input type="text" readonly="true"  style="float: right;text-align: right; " class="tbl-total" id="allowancetotal">
                          </td>
                        </tr>
                        </table>
                      </div>
                    </div>
            </div>
            </div>
                <span class="clear"></span>
                  
                      <div style="float:right;" class="grid_6 form_container left_label">
                    <ul>
                      <li>
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Total_Gross_Area')}}  + {{__('valuation.Allowance_Value')}}<span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text" value="" readonly="true" style="text-align:right;" id="totalbldgarea">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                      
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Depreciation_Rate')}} (%) 
                            <!--(<input type="text" value="0.00" style="text-align:right;" id="nilaitambah">%)--><span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text" onchange="bldgcal()" value="0" style="text-align:right;"  id="deprate">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                      <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Depreciation_Value')}} 
                            <!--(<input type="text" value="0.00" style="text-align:right;" id="nilaitambah">%)--><span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text" onchange="bldgcal()" style="text-align:right;" id="depvalue">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Net_Building_Value')}}<span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text"  readonly="true"  style="text-align:right;" id="netbldg">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                          <div class="form_grid_6">
                          <label class="field_title"  id="accnumberlbl" style="width: 100%;" for="username">{{__('valuation.Rounded_Building_Value')}}<span class="req">*</span></label>
                        </div>
                        <div class="form_grid_6">
                          <div  class="form_input">
                          <input type="text"  readonly="true" style="text-align:right;" id="roundbldg">
                          </div>
                          <span class=" label_intro"></span>
                        </div>
                      </li>
                    </ul>
                  </div>                 
                </div>
                 </div>
                <div style="height: 48px; float: right; " class="grid_12">
                
                  <div class="form_input">
                    <button id="addsubmit" name="adduser" style="float: right; "  onclick="updateCalculation()" type="button" class="btn_small btn_blue"><span>{{__('common.Update')}}</span></button>      
                              
                    <button id="close" name="close" type="button" onclick="closeWindow()"  class="btn_small btn_blue"><span>{{__('common.Close')}}</span></button>
                    <span class=" label_intro"></span>
                  </div>
                  
                  <span class="clear"></span>
                </div>
                 </fieldset>
                <span class="clear"></span>
              </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
    <span class="clear"></span>
    <div  id="basic-modal-content">
                  <h3>{{__('valuation.Allowance')}}</h3>
                  <div  class="grid_12 form_container left_label">
                    <ul>  
                      <li class="li">
                        <div class="form_grid_12">
                          <div class="form_grid_8">                 
                            <label class="field_title" id="luserid" for="userid">{{__('valuation.Allowance_Category')}}<span class="req">*</span></label>
                            <div class="form_input">
                            <select data-placeholder="Choose a Status..." style="width:100%" onchange="allowancetype(this.value)" class="cus-select"  id="allowancecateg" tabindex="4" name="lttt" tabindex="20">
                                <option></option>
                              @foreach ($allowancecategory as $rec)
                                  <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                              @endforeach 
                            </select>
                            </div>
                            <span class=" label_intro"></span>
                          </div>
                        </div>
                        <input type="hidden" id="allowancetableindex" >
                        <div class="form_grid_12">
                          <div class="form_grid_8">                 
                            <label class="field_title" id="luserid" for="userid">{{__('valuation.Allowance_Type')}}<span class="req">*</span></label>
                            <div class="form_input">
                              <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="allowancetype" tabindex="4" name="lttt" tabindex="20">
                                <option></option>
                              
                              </select>
                            </div>
                            <span class=" label_intro"></span>
                          </div>
                        </div>
                        <div class="form_grid_12">
                          <div class="form_grid_8">                 
                            <label class="field_title" id="luserid" for="userid">{{__('valuation.Allowance_Calculation_Method')}}<span class="req">*</span></label>
                            <div class="form_input">
                              <select data-placeholder="Choose a Status..." style="width:100%" class="cus-select"  id="calcmethod" tabindex="4" onchange="allowanceCal()" name="lttt" tabindex="20">
                                <option></option>
                                @foreach ($calcmethod as $rec)
                                    <option value='{{ $rec->tdi_key }}'>{{ $rec->tdi_value }}</option>
                                @endforeach 
                            </select>
                            </div>
                            <span class=" label_intro"></span>
                          </div>
                        </div>
                        <div class="form_grid_12">
                          <div class="form_grid_8">                 
                            <label class="field_title" id="luserid" for="userid">{{__('valuation.Drive_value')}}<span class="req">*</span></label>
                            <div class="form_input">
                              <input id="add_grossvalue" onchange="allowanceCal()"  name="add_grossvalue" type="text"  value="" />
                            </div>
                            <span class=" label_intro"></span>
                          </div>
                        </div>
                        <div class="form_grid_12">
                          <div class="form_grid_8">                 
                            <label class="field_title" id="luserid" for="userid">{{__('valuation.Gross_Allowance')}}<span class="req">*</span></label>
                            <div class="form_input">
                              <input id="add_roundvalue" readonly="true" name="add_roundvalue" type="text"  value="" />
                            </div>
                            <span class=" label_intro"></span>
                          </div>
                        </div>
                      </li>       
                    </ul> 
                  </div>
                  <span class="clear"></span>
                    <div class="btn_24_blue">
                      <a href="#" onclick="addAdditional()" class=""><span>{{__('common.Add')}} </span></a>
                    </div>
                    <div class="btn_24_blue">
                      <a href="#" class="simplemodal-close"><span>{{__('common.Close')}} </span></a>
                    </div>
                  
                </div>
</div>
<script>
  function openModal(){
    $('#basic-modal-content').modal();
  }
function allowanceCal(){
  var bldgtotal = removeCommas($('#bldgtotal').val());
  var grssvalue = removeCommas($('#add_grossvalue').val());
  var calcmethod = $("#calcmethod :selected").val();
//alert($("#calcmethod :selected").val()==1 );
  
  if (calcmethod == 2){
    $('#add_roundvalue').val(formatMoneyHas(grssvalue ));
   // alert(grssvalue);
  } else {
    $('#add_roundvalue').val(formatMoneyHas(bldgtotal * (grssvalue / 100)));
  //  alert(bldgtotal * (grssvalue / 100));
  }
    //$('#add_roundvalue').val(formatMoneyHas(bldgtotal * (value / 100)));
   // $('#add_roundvalue').val(add_roundvalue);
}
  function allowancetype(value){
    var param_value = $('#allowancecateg').val();
    $.ajax({
        url: "subCategory",
        cache: false,
        data:{param_value:param_value,param:'val'},
        success: function(data){
            createDropDownOptions(data.res_arr, 'allowancetype');         

        }
      });
  }

  function allowancaCaluation(){
    var t = $('#bldgallowance').DataTable();
    var roundtotal = 0;
    for (var i = 0;i<t.rows().count();i++){
      var ldata = t.row(i).data();
      if(ldata[0] !== 'Deleted'){
        roundtotal = roundtotal +  Number(removeCommas(ldata[6]));
      }
    }
    var totalbldggross1 = 0;
    for (var i = 0;i<$('#bldgarea').DataTable().rows().count();i++){
      var ldata = $('#bldgarea').DataTable().row(i).data();
      totalbldggross1 = totalbldggross1 + Number(removeCommas(ldata[7]));
        
    }
    $('#totalbldgarea').val(formatMoneyHas(roundtotal + totalbldggross1))
    $('#allowancetotal').val(formatMoneyHas(roundtotal));
    bldgcal();
  }

  function addAdditional(){
    var rate = $('#add_grossvalue').val();
    var allowancecateg = $("#allowancecateg :selected").text();
    var allowancetype = $("#allowancetype :selected").text();
    var allowancetypeid = $("#allowancetype :selected").val();
    var calcmethod = $("#calcmethod :selected").text();
    var calcmethodid = $("#calcmethod :selected").val();
    var add_roundvalue = $('#add_roundvalue').val();
    
    if (rate === '') {
          alert('Please enter rate');
          return false;
     
      } else {
        var t = $('#bldgallowance').DataTable();

        $('#additionaltable_filter').remove();
        $('#additionaltable_info').remove();
        $('#additionaltable_paginate').remove();
        $('#additionaltable_length').remove();
        t.row.add([ 'New',allowancecateg + ',' +  allowancetype, allowancetypeid, calcmethod, calcmethodid, rate, add_roundvalue, t.data().count() + 1,'{{$id}}' ,'<span><a onclick="" class="action-icons c-delete  deleteallowance" href="#" title="delete">Delete</a></span' ]).draw( false );
        
        allowancaCaluation();
        /*var roundtotal = 0;
      for (var i = 0;i<t.rows().count();i++){
            var ldata = t.row(i).data();
           // if(ldata[7] !== 'delete'){
              roundtotal = roundtotal +  Number(removeCommas(ldata[4]));
         // }
        }
      var totalbldggross1 = 0;
         for (var i = 0;i<$('#bldgarea').DataTable().rows().count();i++){
              var ldata = $('#bldgarea').DataTable().row(i).data();
              totalbldggross1 = totalbldggross1 + Number(removeCommas(ldata[7]));
               
        }
        $('#totalbldgarea').val(formatMoneyHas(roundtotal + totalbldggross1))
        $('#allowancetotal').val(formatMoneyHas(roundtotal));
       bldgcal();*/
      }
  }
$(document).ready(function(){
//alert( window.opener.$('#deprate_{{$id}}').val());
  if (window.opener.$('#deprate_{{$id}}').val()==""){
    $('#deprate').val(0);
  } else {
    $('#deprate').val( window.opener.$('#deprate_{{$id}}').val());
  }
   // $('#deprate').val( window.opener.$('#deprate_{{$id}}').val());
    $('#depvalue').val( window.opener.$('#depvalue_{{$id}}').val());
    $('#netbldg').val( window.opener.$('#netbldg_{{$id}}').val());
    $('#roundbldg').val( window.opener.$('#roundbldg_{{$id}}').val());

    var temderate = removeCommas(window.opener.$('#deprate_{{$id}}').val());
    var temdevalue = removeCommas(window.opener.$('#depvalue_{{$id}}').val());
    var temnetbldg = removeCommas(window.opener.$('#netbldg_{{$id}}').val());
    var temroundbldg = removeCommas(window.opener.$('#roundbldg_{{$id}}').val());


      var parenttable = window.opener.$('#bldgtable').DataTable();
      //var landtotal = 0;
      for (var m = 0;m < parenttable.rows().count() ;m++){
        var parenttableldata = parenttable.row(m).data();

        var parenttablerow = parenttable.row(m);

        var parenttabledata = parenttablerow.data();
       // if (parenttableldata[8] == {{$id}}) {        ;
        //  parenttabledata[5]=$('#depvalue').val();
        //  parenttabledata[11]=$('#deprate').val();
         // parenttablerow.data(parenttabledata);
        //}
      $('#deprate').val(parenttabledata[11]);
    $('#depvalue').val( parenttabledata[5]);

      }


    var bldgardata = [];
    @foreach ($bldgar as $rec)        
      bldgardata.push( [ '{{$loop->iteration}}',  '{{$rec->artype}}','{{$rec->arlvel}}','{{$rec->arcate}}','{{$rec->aruse}}','{{$rec->aba_totsize}}','<input type="text" class="editrate" style="text-align:right;" id="rate_{{$loop->iteration}}" value="0" name="rate">','0', '0','{{$rec->aba_id}}','{{$rec->aba_ab_id}}' ] );
    @endforeach

    $('#bldgarea').DataTable({
          data:           bldgardata,
      "columns":[ null, null, null, null, null, { className: "numericCol" }, null,  { className: "numericCol" }, { "visible": false }, { "visible": false }, { "visible": false}],
      // "columns":[ null, null, null, null, null, { className: "numericCol" }, null,  { className: "numericCol" }, null, null, null],
        "sPaginationType": "full_numbers",
        "iDisplayLength": 5,
        "oLanguage": {
          "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>", 
        },
        "bAutoWidth": false,
        "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'
    });

    $("div.table_top select").addClass('tbl_length');

    $(".tbl_length").chosen({
      disable_search_threshold: 4 
    });

    //$('#bldgarea_filter').remove();
    $('#bldgarea_info').remove();
    //$('#bldgarea_paginate').remove();
    //$('#bldgarea_length').remove();

    

     $('#bldgallowance').DataTable({
      "columns":[ null, null,{ "visible": false }, null, { "visible": false }, { className: "numericCol" }, { className: "numericCol" },  { "visible": false }, { "visible": false}, null],
        "sPaginationType": "full_numbers",
        "iDisplayLength": 5,
        "oLanguage": {
          "sLengthMenu": "<span class='lenghtMenu'> _MENU_</span><span class='lengthLabel'>Entries per page:</span>", 
        },
        "bAutoWidth": false,
        "sDom": '<"table_top"fl<"clear">>,<"table_content"t>,<"table_bottom"p<"clear">>'

    });

    $("div.table_top select").addClass('tbl_length');

    $(".tbl_length").chosen({
      disable_search_threshold: 4 
    });

    $('#bldgallowance_filter').remove();
    $('#bldgallowance_info').remove();
    $('#bldgallowance_paginate').remove();
    $('#bldgallowance_length').remove();

    $('#bldgallowance tbody').on( 'click', '.deleteallowance', function () {
       var table = $('#bldgallowance').DataTable();
      var row = table.row(table.row( $(this).parents('tr') ).index()),
        data = row.data();
        data[0]='Deleted';
        data[9]='';
        var noty_id = noty({
          layout : 'center',
          text: 'Are you want to delete?',
          modal : true,
          buttons: [
            {type: 'button pink', text: 'Delete', click: function($noty) {
                  row.data(data);
                  allowancaCaluation();
                $noty.close();
                }
            },
            {type: 'button blue', text: 'Cancel', click: function($noty) {
                $noty.close();
                }
            }
            ],
          type : 'success', 
        });
       // table.row($(this).parents('tr') ).remove().draw();
    });


    $('#bldgallowance tbody').on( 'click', '.editallowance', function () {

       var table = $('#bldgallowance').DataTable();
       var allowancetableindex = table.row( $(this).parents('tr') ).index();
      var row = table.row(allowancetableindex),
          data = row.data();
          
        
       
       // table.row($(this).parents('tr') ).remove().draw();
    });

    //copy row from parent
    var bldgareatable = window.opener.$("#hiddenbldgarea").DataTable();
    //var bldgareatable = window.opener.$("#hiddenbldgarea").DataTable();
   // var bldgallowancetable = window.opener.$("#hiddenbldgallowance").DataTable();
    var description, area, rate, calucatedrate, grossvalue, lotid, lotareaid;
    var totalgross = 0;
    //console.log(bldgareatable.rows().count());
    /*var sno = 0;
    for (var i = 0;i<bldgareatable.rows().count();i++){
          var ldata = bldgareatable.row(i).data();
          if (ldata[8] == {{$id}}){
            
            sno = sno + 1;
            rate = ldata[5];
             $('#bldgarea').DataTable().row.add([ sno, ldata[0], ldata[1], ldata[2], ldata[3], ldata[4],'<input type="text" class="editrate" style="text-align:right;" id="rate_'+sno+'" value="'+rate+'" name="rate">',ldata[6],rate,ldata[7],ldata[8] ]).draw( false );
              totalgross = totalgross + Number(removeCommas( ldata[6]));
          }
               
    }*/
    $('#bldgtotal').val(formatMoneyHas(totalgross));

    var totalallowancegross1 = 0;
    var totalbldggross1 = 0;
    for (var i = 0;i<bldgareatable.rows().count();i++){         
        var ldata = $('#bldgallowance').DataTable().row(i).data();   
        //console.log(ldata);    
        if (ldata != undefined) {   
          totalallowancegross1 = totalallowancegross1 + Number(removeCommas(ldata[6]));   
        }           
    }

          for (var i = 0;i<bldgareatable.rows().count();i++){
            console.log(bldgareatable);
              var ldata = bldgareatable.row(i).data();
              totalbldggross1 = totalbldggross1 + Number(removeCommas(ldata[7]));
               
        }
        // $('#bldgtotal').val(formatMoneyHas(totalbldggross1));
        var total = totalallowancegross1 + totalbldggross1;

         $('#totalbldgarea').val(formatMoneyHas(total));
      temderate =$('#deprate').val();
        var depvalue = total * ( Number(temderate) / 100 );

        // $('#depvalue').val(formatMoneyHas(depvalue));
         var res = total - depvalue;
       //  $('#netbldg').val(formatMoneyHas(res ));

        // $('#roundbldg').val(formatMoneyHas(Math.floor(res / 1000 ) * 1000));

      $('#bldgallowance_filter').remove();
      $('#bldgallowance_info').remove();
      $('#bldgallowance_paginate').remove();
      $('#bldgallowance_length').remove();

      var bldgareatable = window.opener.$("#hiddenbldgarea").DataTable();
     // var bldgallowancetable = window.opener.$("#hiddenbldgallowance").DataTable();
      var description, area, rate, calucatedrate, grossvalue, lotid, lotareaid;
      var totalgross = 0;
      //console.log(bldgareatable.rows().count());
      var sno = 0;

      var rmtable = $('#bldgarea').DataTable();
 
      
      for (var i = 0;i<bldgareatable.rows().count();i++){
          var ldata = bldgareatable.row(i).data();
         // if (ldata[8] == {{$id}}){
            if(sno==0){
              var rows = rmtable.rows().remove().draw();
            }
            sno = sno + 1;
            rate = ldata[5];
             $('#bldgarea').DataTable().row.add([ sno, ldata[0], ldata[1], ldata[2], ldata[3], ldata[4],'<input type="text" class="editrate" style="text-align:right;" id="rate_'+sno+'" value="'+rate+'" name="rate">',ldata[6],rate,ldata[7],ldata[8] ]).draw( false );
              totalgross = totalgross + Number(removeCommas( ldata[6]));
          //}
               
      }
    $('#bldgtotal').val(formatMoneyHas(totalgross));

    var table = $('#bldgarea').DataTable();

    $('#bldgarea tbody').on('change', '.editrate', function () {
        var row = table.row(table.row( $(this).parents('tr') ).index());
        var data = row.data();

        var r = true; //confirm("Allowance will be cleared!");
        if (r == true) {
         // txt = "You pressed OK!";
        


        var rowid =  data[0];
        var rate = $('#rate_'+rowid).val();
        var area =  data[5];
//alert($("#rate_"+rowid).val());
        //console.log(calucaterate);
        area = removeCommas(area);
        rate = removeCommas(rate);
       // calucaterate = removeCommas(calucaterate);

        var gross = area * rate;
        data[6] = '<input type="text" class="editrate" style="text-align:right;" id="rate_'+rowid+'" value="'+rate+'" name="rate">';
        data[7] = formatMoneyHas(gross);
        data[8] = rate;
        row.data(data);

        var totalallowancegross1 = 0;
        var totalbldggross1 = 0;
        //alert();

        for (var i = 0;i<$('#bldgarea').DataTable().rows().count();i++){
            var ldata = $('#bldgarea').DataTable().row(i).data();
            totalbldggross1 = totalbldggross1 + Number(removeCommas(ldata[7]));
               
        }

        var allowancetable = $('#bldgallowance').DataTable();
        var allowancedata;
        for (var i = 0;i<$('#bldgallowance').DataTable().rows().count();i++){

          var allowrow = allowancetable.row(i),
          allowancedata = allowrow.data();
          if (allowancedata[0] == 'Deleted'){

          }else if (allowancedata[0] == 'New'){
            if (allowancedata[4] == '1'){
              // alert(totalbldggross1 *  Number(removeCommas(allowancedata[5]))/100);
              allowancedata[6] = formatMoneyHas(totalbldggross1 *  Number(removeCommas(allowancedata[5]))/100);
              allowrow.data(allowancedata);
              // alert(totalbldggross1 *  Number(removeCommas(allowancedata[5]))/100);
            }
          }else{
            if (allowancedata[4] == '1'){
              allowancedata[0] = 'Updated';
              allowancedata[6] = formatMoneyHas(totalbldggross1 *  Number(removeCommas(allowancedata[5]))/100);
              allowrow.data(allowancedata);
            }
          }
          // allowancedata[0]='Deleted';
          // allowancedata[9]='';
        }
        
        for (var i = 0;i<$('#bldgallowance').DataTable().rows().count();i++){

            var ldata = $('#bldgallowance').DataTable().row(i).data();
            if(ldata[0] !== 'Deleted'){
              totalallowancegross1 = totalallowancegross1 + Number(removeCommas(ldata[6]));
            }
             
               
        }         // allowrow.data(allowancedata);
        allowancaCaluation();

         $('#bldgtotal').val(formatMoneyHas(totalbldggross1));
        var total = totalallowancegross1 + totalbldggross1;

         $('#totalbldgarea').val(formatMoneyHas(total));
        // temderate = 

        var depvalue = total * ( Number(temderate) / 100 );

         $('#depvalue').val(formatMoneyHas(depvalue));
         var res = total - depvalue;
         $('#netbldg').val(formatMoneyHas(res ));

         $('#roundbldg').val(formatMoneyHas(customround(res,3)));

        } 
    });



    //copy row from parent
    var bldgallowancetable = window.opener.$("#hiddenbldgallowance").DataTable();
    var description, area, rate, calucatedrate, grossvalue, lotid, lotareaid;
    var totalallowancegross = 0;
    console.log(bldgallowancetable.rows().count());
    for (var i = 0;i<bldgallowancetable.rows().count();i++){
          var ldata = bldgallowancetable.row(i).data();
         // if (ldata[6] == {{$id}}){
            
            var rowid = i+ 1;
             $('#bldgallowance').DataTable().row.add([ ldata[0],  ldata[1], ldata[2], ldata[3] , ldata[4],ldata[5],ldata[6],ldata[7] ,ldata[8] ,'<span><a onclick="" class="action-icons c-delete  deleteallowance" href="#" title="delete">Delete</a></span' ]).draw( false );      
             
              totalallowancegross = totalallowancegross + Number(removeCommas(ldata[6]));
        //  }
               
    }
//alert(totalgross);
//alert(totalallowancegross);
    $('#allowancetotal').val(formatMoneyHas(totalallowancegross));

    $('#totalbldgarea').val(formatMoneyHas( totalgross + totalallowancegross));

   
bldgcal();


});

function bldgcal() {

    var totalbldgar = removeCommas($('#totalbldgarea').val());
    var deprate = removeCommas($('#deprate').val()) || 0;
    var depvalue = removeCommas($('#depvalue').val());
    var netbldg = removeCommas($('#netbldg').val());
    var roundbldg = removeCommas($('#roundbldg').val());   
   // alert(deprate) 
    if($('#deprate').val() ==""){
      deprate=0;
    }
    var tdepvalue = Number(totalbldgar) * ( Number(deprate) / 100 );
// alert($('#totalbldgarea').val()) 
    $('#depvalue').val(formatMoneyHas(tdepvalue));
    var res =  Number(totalbldgar) - tdepvalue;
    $('#netbldg').val(formatMoneyHas(res ));
 //alert(res) 
    $('#roundbldg').val(formatMoneyHas(customround(res,3)));
    
}


function updateCalculation(){

    var totalbldgar = $('#totalbldgarea').val();
    var deprate = $('#deprate').val();
    var depvalue = $('#depvalue').val();
    var netbldg = $('#netbldg').val();
    var roundbldg = $('#roundbldg').val(); 
    
    var bldgareatable = window.opener.$("#hiddenbldgarea").DataTable();

   // var lotareatable = window.opener.$("#hiddenlandarea").DataTable();
    var bldgdetailtable = $("#bldgarea").DataTable();   
   
    var maintablecount = window.opener.$("#hiddenbldgarea").DataTable().rows().count();
    if (maintablecount == 0){
        for (var l = 0;l < bldgdetailtable.rows().count() ;l++){
          var ldata = bldgdetailtable.row(l).data();
          var row = bldgdetailtable.row(l);
          // var temptable = $("#bldgarea").DataTable();      

          if (ldata[10] == {{$id}}) {
            //var row = window.opener.$("#hiddenbldgarea").DataTable().row(l);
            //var data = row.data();
           // var temptable =  window.opener.$("#hiddenbldgarea").DataTable();

           
                  bldgareatable.row.add([ ldata[1], ldata[2],ldata[3], ldata[4], ldata[5], ldata[8],ldata[7],ldata[9],ldata[10],'new' ]).draw(false);  
               //lotareatable.row.add([ ldata[1], ldata[2], ldata[6], ldata[7], ldata[5],ldata[8],ldata[9] ]).draw(false);   
                        
          } /* else {
            bldgareatable.row.add([ ldata[1], ldata[2],ldata[3], ldata[4], ldata[5], ldata[8],ldata[7],ldata[9],ldata[10],'new' ]).draw(false);  
          }   */ 

           
      }
    } else {

      //var bldgareatable = window.opener.$("#hiddenbldgarea").DataTable();
    
      for (var l = 0;l < bldgdetailtable.rows().count() ;l++){
          var ldata = bldgdetailtable.row(l).data();
         
          if (ldata[10] == {{$id}}) {
             //  console.log(ldata[10]+"ddd" );
               //   console.log("{{$id}} _dfd" );
              var temptable = window.opener.$("#hiddenbldgarea").DataTable();
              for (var k = 0;k<temptable.rows().count() ;k++){
                  //var localdata = temptable.row(k).data();
                  var row = window.opener.$("#hiddenbldgarea").DataTable().row(l);
                  var data = row.data();
                 // console.log(data[7] +"_ test");
                 // console.log(ldata[9]  +"_ teest");
                  if (data[7] == ldata[9]) {
                    data[5] = ldata[8];
                    data[6] = ldata[7];
                    row.data(data);
                  }
                  //lotareatable.row.add([ ldata[1], ldata[2], ldata[6], ldata[7], ldata[5],ldata[8],ldata[9] ]).draw(false);   
              }            
          }
      }       
          
      
    }
    /*for (var l = 0;l < bldgdetailtable.rows().count() ;l++){
        var ldata = bldgdetailtable.row(l).data();
        var row = bldgdetailtable.row(l);
        // var temptable = $("#bldgarea").DataTable();      

        if (ldata[10] == {{$id}}) {
          var row = window.opener.$("#hiddenbldgarea").DataTable().row(l);
          var data = row.data();
          var temptable =  window.opener.$("#hiddenbldgarea").DataTable();

          for (var k = 0;k<temptable.rows().count() ;k++){
              var localdata = temptable.row(k).data();
              if (localdata[9] == ldata[7]) {
                data[5] = localdata[8];
                data[6] = localdata[7];
                row.data(data);
              } else {
                bldgareatable.row.add([ ldata[1], ldata[2],ldata[3], ldata[4], ldata[5], ldata[8],ldata[7],ldata[9],ldata[10],'new' ]).draw(false);  
              }  
              //lotareatable.row.add([ ldata[1], ldata[2], ldata[6], ldata[7], ldata[5],ldata[8],ldata[9] ]).draw(false);   
          }            
        } 
         
    }*/

    


//console.log(parenrowid);
    var parenttable = window.opener.$('#bldgtable').DataTable();
    var landtotal = 0;
    for (var m = 0;m < parenttable.rows().count() ;m++){
      var parenttableldata = parenttable.row(m).data();

      var parenttablerow = parenttable.row(m);

      var parenttabledata = parenttablerow.data();
     // if (parenttableldata[8] == {{$id}}) {        
        parenttabledata[3]=$('#bldgtotal').val();
        parenttabledata[4]=$('#allowancetotal').val();
        parenttabledata[5]=$('#depvalue').val();
        parenttabledata[6]=$('#netbldg').val();
        parenttabledata[7]=$('#roundbldg').val();
        parenttabledata[11]=$('#deprate').val();
        parenttablerow.data(parenttabledata);
      //}
    if (parenttabledata[6] != undefined)
      landtotal = landtotal + Number(removeCommas(parenttabledata[7]));

    }


    var allowancetable = window.opener.$("#hiddenbldgallowance").DataTable();
   
    for (var l = 0;l < $("#bldgallowance").DataTable() .rows().count() ;l++){
        var ldata = $("#bldgallowance").DataTable().row(l).data();
        var ldataexisted = '0';
         for (var i = 0;i < allowancetable.rows().count() ;i++){
            var allowancerow = allowancetable.row(i);
            var allowancedata = allowancerow.data();
           
            if (allowancedata[7] == ldata[7] ) {
              ldataexisted = '1';
              break;
            }
          }
          // alert("Popup:" + ldata[1] + "=" + ldata[2] + ", Main Window:" + allowancedata[2] + ", Jumpa=" + ldataexisted);
          if (ldataexisted != '1' ) {
            allowancetable.row.add([ "New",  ldata[1], ldata[2], ldata[3] , ldata[4], ldata[5], ldata[6], ldata[7] , ldata[8]  ]).draw( false );
          }else{
            allowancedata[0] = ldata[0];
            allowancedata[1] = ldata[1];
            allowancedata[2] = ldata[2];
            allowancedata[3] = ldata[3];
            allowancedata[4] = ldata[4];
            allowancedata[5] = ldata[5];
            allowancedata[6] = ldata[6];
            allowancedata[7] = ldata[7];
            allowancedata[8] = ldata[8];
            allowancerow.data(allowancedata);
          }
        
      }
     
    window.opener.$('#vd_bldgtotal').val( formatMoneyHas(landtotal));
    window.opener.$('#deprate_{{$id}}').val($('#deprate').val());
    window.opener.$('#depvalue_{{$id}}').val($('#depvalue').val());
    window.opener.$('#netbldg_{{$id}}').val($('#netbldg').val());
    window.opener.$('#roundbldg_{{$id}}').val($('#roundbldg').val());

    window.opener.taxDriveCalculation();
    window.close();
}

function closeWindow(){
  window.close();
}
</script>
</body>
</html>