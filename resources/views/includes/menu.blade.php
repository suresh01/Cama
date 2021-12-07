<ul>					
			<li><a style="{{ $page == 'dash' ? 'background-color: #95C9F5;' : '' }}" href="dashboard"><span class="stats_icon dashboard"></span><span class="label">{{__('menu.home')}}</span></a></li>
			<li class="dropdown-submenu dropdown"><a style="{{ $page == 'dataenquery' ? 'background-color: #95C9F5;' : '' }}" class="test" tabindex="-1" href="#"><span class="stats_icon data_enqury"></span><span class="label">{{__('menu.dataenquiry')}}</span></a>

				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('21','datasearch')" class="test" href="#">{{__('menu.propertysearch')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('21','termsearch')" class="test" href="#">{{__('menu.termsearch')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('21','officialsearch')" class="test" href="#">{{__('menu.officialsearch')}}<span class="caret"></span></a>
			        </li>			        
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style="width: 100%;{{ $page == 'datamaintenance' ? 'background-color: #95C9F5;' : '' }}"  href="#" class="test"><span class="stats_icon data_maintance"></span><span class="label">{{__('menu.datamaintenance')}}</span></a>
			{{-- <li class="dropdown-submenu dropdown"><a style="width: 100%;{{ $page == 'datamaintenance' ? 'background-color: #95C9F5;' : '' }}" class="test" tabindex="-1" href="#"><span class="stats_icon data_maintance"></span><span class="label">{{__('menu.datamaintenance')}}</span></a> --}}
				<ul class="mainNav dropdown-menu" style="display:none">
			        <li style="" class="dropdown-submenu">
			            <a style=""  onclick="check_access('31','codemaintenance')" class="test" href="#">{{__('menu.codemaintenance')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('32','propertybasket')" class="test" href="#">{{__('menu.masterlistregister')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('32','existspropertybasket')" class="test" href="#">{{__('menu.masterlistmaintenance')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('33','tenant')" class="test" href="#">{{__('menu.tenantreg')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('34','ratepayer')" class="test" href="#">{{__('menu.ratepayerreg')}}<span class="caret"></span></a>
			        </li>
			       <!-- <li class="dropdown-submenu">
			            <a style="" onclick="check_access('35','filemanager')" class="test" href="#">{{__('menu.dms')}}<span class="caret"></span></a>
			        </li>-->
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('36','term')" class="test" href="#">{{__('menu.term')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('37','evidentmgmt')" class="test" href="#">{{__('menu.evident')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('38','plan')" class="test" href="#">{{__('menu.planreg')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test" href="#">{{__('menu.ownermaintenance')}}...<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
							<li>
								<a style="" onclick="check_access('392','ownertransferapproval');" href="#">{{__('menu.transferapproval')}}</a>
							</li>
			                <li>					
								<a style="" onclick="check_access('391','ownerregister');" href="#">{{__('menu.transferreg')}}</a>							
							</li>
							<li>
								<a style="" onclick="check_access('392','ownertransfer?page=1');" href="#">{{__('menu.transferprocess')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('393','ownertransfer?page=2');" href="#">{{__('menu.addressprocess')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','ownerlog');" href="#">{{__('menu.transferlog')}}</a>
							</li>
			            </ul>
		          	</li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test " href="#">{{__('menu.maintenanceprocess')}}...<span class="caret" style=""></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('3101','propertyaddress');" href="#">{{__('menu.propertyaddress')}}</a>							
							</li>
							<li>
								<a style="" onclick="check_access('3102','propertylot');" href="#">{{__('menu.propertylot')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','addresslog');" href="#">{{__('menu.propertyaddresslog')}}</a>
							</li>
							<li>
								<a style="" onclick="check_access('394','nolotlog');" href="#">{{__('menu.propertylotlog')}}</a>
							</li>
			            </ul>
		          	</li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('38','remisi')" class="test" href="#">Remisi<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style="{{ $page == 'TOL' ? 'background-color: #95C9F5;' : '' }}"  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.tol')}}</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('41','tonebasket')" class="test" href="#">{{__('menu.tolbasket')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('42','ratebasket')" class="test" href="#">{{__('menu.tolratebasket')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('43','tonebldg')" class="test" href="#">{{__('menu.tolbulding')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('44','toneland')" class="test" href="#">{{__('menu.tolland')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('45','toneallowance')" class="test" href="#">{{__('menu.tolallownace')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('46','tonedepreciation')" class="test" href="#">{{__('menu.toldepreciation')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('47','tonelandstandart')" class="test" href="#">{{__('menu.standardlandarea')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('48','taxrate')" class="test" href="#">{{__('menu.tolrate')}}<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown"><a style="{{ $page == 'VP' ? 'background-color: #95C9F5;' : '' }}"  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.valuationprocess')}}</span></a>
				<ul class="dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style=""  onclick="check_access('51','valterm')" class="test" href="#">{{__('menu.valuationmgmt')}}<span class="caret"></span></a>
			        </li>
			        <!--<li class="dropdown-submenu">
			            <a style="" onclick="check_access('401','objection')" class="test" href="#">Approve Objection<span class="caret"></span></a>
			        </li>-->
		          	<li class="dropdown-submenu">
			            <a style="" onclick="check_access('52','meeting')" class="test" href="#">{{__('menu.objection')}}<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('53','deactive')" class="test" href="#">{{__('menu.defunct')}}<span class="caret"></span></a>
			        </li>
    			</ul>
			</li>
			<!--<li><a style="{{ $page == 'report' ? 'background-color: #95C9F5;' : '' }}" onclick="check_access('3','#')" href="#"><span class="stats_icon archives_sl"></span><span class="label">Report</span></a></li>-->
			<li class="dropdown-submenu dropdown"><a style="{{ $page == 'report' ? 'background-color: #95C9F5;' : '' }}"  href="#" class="test"><span class="stats_icon finished_work_sl"></span><span class="label">{{__('menu.report')}}</span></a>
				<ul class="mainNav dropdown-menu" style="display:none">
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('61','inspectionform')" class="test" href="#">Borang Lawat Periksa<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('62','valuationform')" class="test" href="#">Laporan Nilaian<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Valuation Data...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('631','valuationdata?page=1');" href="#">Senarai Nilaian(Bakul)</a>							
							</li>
							<li>
								<a style="" onclick="check_access('632','valuationdata?page=2');" href="#">Senarai Nilaian(Pada Penggal)</a>
							</li>
							<li>
								<a style="" onclick="check_access('633','valuationdata?page=3');" href="#">Senarai Nilaian(Sehingga Penggal)</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Laporan-Laporan Statistik...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('714','subzonesummary');" href="#">Senarai NT dan Kadar Mengikut Mukim/Kawasan</a>							
							</li>
							<!--<li>
								{{-- <a style="" onclick="check_access('714','subzonesummary');" href="#">Laporan Senarai Industri (Select by Property Categori)</a> --}}
								<a style="" onclick="check_access('714','zonebldgsummary');" href="#">Laporan Senarai Industri (Select by Property Categori)</a>
							</li>-->
							<li>
								<a style="" onclick="check_access('714','pivotreport?page=1');" href="#">Laporan Pivot (Property Status = Building)</a>
							</li>
			                <li>					
								<a style="" onclick="check_access('714','pivotreport?page=0');" href="#">Laporan Pivot (Property Status = Empty Lot)</a>							
							</li>
							<li>
								<a style="" onclick="check_access('714','racesummary');" href="#">Laporan Pivot Bangsa</a>
							</li>
							<li>
								<a style="" onclick="check_access('714','statisticsreport');" href="#">Laporan Statistik</a>
							</li>
			            </ul>
		          	</li>
		          	<!--<li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Statistical Report...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('714','subzonesummary');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="" onclick="check_access('714','zonebldgsummary');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
							<li>
								<a style="" onclick="check_access('714','racesummary');" href="#">Summary By Property Status and Building Categori vs Race</a>
							</li>
			            </ul>
		          	</li>
		          	<li class="dropdown-submenu">
			            <a style=""  class="test" href="#">Collection Report...<span class="caret"></span></a>
			            <ul class="dropdown-menu child" style="display:none;">
			                <li>					
								<a style="" onclick="check_access('714','subzonecollection');" href="#">Summary By Zone/Sub Zone</a>							
							</li>
							<li>
								<a style="" onclick="check_access('714','districtcollection');" href="#">Summary By District</a>
							</li>
							<li>
								<a style="" onclick="check_access('714','bldgcollection');" href="#">Summary By Zon and Property Status vs Bulding Category</a>
							</li>
			            </ul>
		          	</li>-->

			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','exportexcel')" class="test" href="#">Export Excel<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','borangc')" class="test" href="#">Borang C<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','borangb')" class="test" href="#">Borang B<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','r4cover')" class="test" href="#">Kulit R4<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','defunctreport')" class="test" href="#">Senarai Harta Batal<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','ownernotice')" class="test" href="#">Notis Kepada Pemlik<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','ownertransferlist')" class="test" href="#">Senarai Pindah Milik<span class="caret"></span></a>
			        </li>
			        <li class="dropdown-submenu">
			            <a style="" onclick="check_access('714','statistical')" class="test" href="#">Simulation Function<span class="caret"></span></a>
			        </li>
		          	
    			</ul>
			</li>
			<li class="dropdown-submenu dropdown">
       			 <a style="{{ $page == 'admin' ? 'background-color: #95C9F5;' : '' }}" class="test" tabindex="-1" href="#"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
		        <ul class="mainNav dropdown-menu" style="display:none">
		          <li class="dropdown-submenu">
		            <a style=""  class="test" href="#">Pengurusan Pengguna...<span class="caret"></span></a>
		            <ul class="dropdown-menu child" style="display:none;">
		                <li>					
							<a style="" onclick="check_access('711','user');" href="#">Senarai Pengguna</a>							
						</li>
						<li>
							<a style="" onclick="check_access('712','role');" href="#">Senarai Peranan</a>
						</li>
						<li>
							<a style="" onclick="return check_access('713','module');" href="#">Senarai Modul</a>
						</li>
						<li>
							<a style="" onclick="return check_access('714','access');" href="#">Capaian</a>
						</li>
		            </ul>
		          </li>
		          <li><a style="" tabindex="-1" onclick="return check_access('73','search');" href="#">Pengurusan Parameter Carian</a></li>
		        </ul>
      		</li>
			<!--<li class="dropdown-submenu"><a data-toggle="dropdown" style="/*background-color: #95C9F5;*/" class="dropdown-toggle active"><span class="stats_icon user_sl"></span><span class="label">Admin</span></a>
				<div style="width: 100%;" class="notification_list dropdown-menu blue_d">
					<div class="white_lin nlist_block">
						<ul  >
							<li >
								
							<div class="list_inf">
								<a onclick="check_access('106','user')" href="#">Users</a>								
							</div>
							</li>
							<li>
							<div class="list_inf">
								<a onclick="check_access('107','role')" href="#">Role</a>
							</div>

							</li>
							<li>
							<div class="list_inf">
								<a onclick="return check_access('108','module');" href="#">Module</a>
							</div>
							</li>
							<li>
							<div class="list_inf">
								<a onclick="return check_access('109','access');" href="#">Access</a>
							</div>
							</li>
							
						</ul>
					</div>
				</div>
				</li>-->
		</ul>