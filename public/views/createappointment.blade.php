@extends('app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="{{ url('/') }}/public/css/jquery.timepicker.css" />
<script src="{{ url('/') }}/public/js/jquery-ui.js" type="text/javascript"></script>
<script src="{{ url('/') }}/public/js/jquery.timepicker.min.js" type="text/javascript"></script>	
<script src="{{ url('/') }}/public/js/jquery.nicescroll.min.js"></script>

<script type="text/javascript" charset="utf-8" src="{{ url('/') }}/public/js/quantize.js"></script>
<script type="text/javascript" charset="utf-8" src="{{ url('/') }}/public/js/color-thief.js"></script>
<script type='text/javascript' src="{{ url('/') }}/public/js/html2canvas.js"></script>
<script type="text/javascript" charset="utf-8" src="{{ url('/') }}/public/js/FileSaver.js"></script>
<script>
  $(document).ready(function() {    
	$(".divexample1").niceScroll();
  });
</script>	
<script type="text/javascript" src="http://github.com/DmitryBaranovskiy/raphael/raw/master/raphael-min.js"></script>
<script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/rgbcolor.js"></script> 
<script type="text/javascript" src="http://canvg.googlecode.com/svn/trunk/canvg.js"></script>
<script src="http://labelwriter.com/software/dls/sdk/js/DYMO.Label.Framework.latest.js" type="text/javascript" charset="UTF-8"> </script>

<!-- maincont Section -->
<section id="maincont">
	<div class="container" ng-app="visitorApp" ng-controller="visitorController">
		<div class="row">
			<div class="col-lg-8">
				<div class="row">
					<div class="col-lg-12 appline">
						<h4 ng-click="addAppointment();"><i class="fa fa-sort-desc"></i> Create Appointment</h4>
						<span><i class="fa fa-user"></i>No of Visitors<b><input type="text" ng-model="appointmentData.visitor_no" class="no_of_visitor"></b></span>
					</div>
				</div>
				<div class="row">
					<form method="post" role="form" class="appoinment" ng-submit="saveAppointment(appointmentData)">
					<div class="col-lg-6">
						<div class="row">
						
							<label class="col-sm-4">Card No:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.card_no='<% card_no %>'">
								<input type="text" readonly class="form-control" ng-model="appointmentData.card_no" name="card_no">
								
							</div> 
						</div>
						<div class="row">
							<label class="col-sm-4">Title:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.title=''">
								<select class="form-control" ng-model="appointmentData.title">
									<option value="">Select</option>
									<option value="Mr">Mr</option>
									<option value="Ms">Ms</option>
									<option value="Mrs">Mrs</option>
									<option value="Other">Other</option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">First Name:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.first_name=''">
								<input type="text" required class="form-control" ng-model="appointmentData.first_name" value="{{ old('first_name') }}">
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Last Name:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.last_name=''">
								<input type="text" required class="form-control" ng-model="appointmentData.last_name" value="{{ old('last_name') }}">
							</div> 
						</div>
						<div class="row">
							<label class="col-sm-4">Email:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.email=''">
								<input type="email" required class="form-control" ng-model="appointmentData.email" value="{{ old('email') }}">
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Company Name:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.company_name=''">
								<input type="text" class="form-control" ng-model="appointmentData.company_name" value="{{ old('company_name') }}">
							</div> 
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row">
							<label class="col-sm-4">Visitor Type:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.role_id=''">
								<select ng-model="appointmentData.role_id" class="form-control">
									<option value="">Select</option>
									<option ng-repeat="visitortype in visitortypes" value="<% visitortype.id %>"><% visitortype.name %></option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Host Name:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.host_name=''">
								<select ng-model="appointmentData.host_name" class="form-control" ng-change="getHostname(appointmentData.host_name);">
									<option value="">Select</option>
									<option ng-repeat="hostname in hostnames" value="<% hostname.id %>" ><% hostname.name %></option>
								</select>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Location:</label>
							<div class="col-sm-7 genbox" ng-init="location='<% location %>'">
								<input type="text" class="form-control" ng-model="location" readonly />
								<input type="hidden" name="location_id" ng-model="appointmentData.location_id" value="<% location_id %>">
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Arrival Date:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.arival_date='<% arival_date %>';">
								<input type="text" required class="form-control" ng-model="appointmentData.arival_date" id="date">
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">Arrival Time:</label>
							<div class="col-sm-7 genbox" ng-init="appointmentData.arival_time='<% arival_time %>'">
								<input type="text" required class="form-control" ng-model="appointmentData.arival_time" id="time">
							</div>
						</div>
						<div class="row" style="min-height: 35px;">
							<div class="col-sm-12" ng-init="appointmentData.image_url='{{ url('/') }}/public/uploads/avatar/<% appointmentData.image_url %>';base_image_path='{{ url('/') }}/public/uploads/avatar/';">
								<input type="hidden" id="image_url" name="image_url" ng-model="appointmentData.image_url">
								<input type="hidden" name="base_image_path" ng-model="base_image_path" value="{{ url('/') }}/public/uploads/avatar/">
								
								<div class="picturebadge" id="iosdiv">
									<span> <input type="file" capture="camera" accept="image/*" id="takePictureField" > <span><i class="fa fa-camera"></i>Take Picture</span>
									</span>
								</div>
								<div ng-app="mymodal" ng-controller="cameraController" class="picturebadge" id="noniosdiv">
								
									<span ng-click="toggleModal('Take Picture')"> <i class="fa fa-camera"></i>Take Picture</span>
									<modal visible="showModal" class="cameramodal">
										<div id="my_camera"></div>
										<a href="javascript:void(0);" data-dismiss="modal" ng-click="take_snapshot()" class="btn btn-default">Click</a>
									</modal>
								</div>
								
								<div ng-if="showflag == 1" class="picturebadge">
									<a href="javascript:void(0);" class="badgeedit checkinout" ng-if="visitor_status == 0 && appointmentData.departure_time == '0000-00-00 00:00:00'" ng-click="changeVisitorStatus(visitor_id, 1);">Check In</a>
									<a href="javascript:void(0);" class="badgeedit checkinout" ng-if="visitor_status == 1" ng-click="changeVisitorStatus(visitor_id, 0);">Check Out</a>
								</div>
							</div>
						</div>
						<div class="row">
							<label class="col-sm-4">&nbsp;</label>
							<div class="col-sm-7 padding0">
								<input type="hidden" name="_token" value="{!! csrf_token() !!}">
								<input type="submit" value="Submit" >
								
								<input type="hidden" name="status" ng-model="appointmentData.status">
								<div ng-app="mymodal">
									<modal visible="showCheckModal" class="checkmodal">
										<p>What would you like to do?</p>
										<a href="javascript:void(0);" data-dismiss="modal" ng-click="changeStatus(1)" class="btn btn-default">Check In Now</a>
										<a href="javascript:void(0);" data-dismiss="modal" ng-click="changeStatus(0)" class="btn btn-default">Check In Later</a>
									</modal>
								</div>
								<div ng-app="mymodal">
									<modal visible="showCheckModalUpdate" class="checkmodal">
										<p>What would you like to do?</p>
										<a href="javascript:void(0);" data-dismiss="modal" ng-click="changeStatusUpdate(1)" class="btn btn-default">Check In Now</a>
										<a href="javascript:void(0);" data-dismiss="modal" ng-click="changeStatusUpdate(0)" class="btn btn-default">Check In Later</a>
									</modal>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
				
				<script>
				var desiredWidth;
				$(document).ready(function() {
					console.log('onReady');
					$("#takePictureField").on("change",gotPic);
					desiredWidth = window.innerWidth;
					
					if(!("url" in window) && ("webkitURL" in window)) {
						window.URL = window.webkitURL;   
					}
					
					$("#btnSave").click(function() { 
						html2canvas($("#badge-to-print"), {
							onrendered: function(canvas) {
								var $printDiv = $('#previewcanvas');
								if ( $printDiv.length){
									$printDiv.remove();
								}
								theCanvas = canvas;
								
								//var win=window.open();
								//win.document.write("<br><img src='"+canvas.toDataURL()+"'/>");
								
								
								//window.print();
								
								var dataUrl = canvas.toDataURL('image/png');
								var pngBase64 = dataUrl.substr('data:image/png;base64,'.length);
								
								//document.body.appendChild(createPrintersTable(canvas.toDataURL()));
								
								try {
									var printerName = "";
									var printers = dymo.label.framework.getPrinters();
									
									if (printers.length == 0) {
										throw "No DYMO printers are installed. Install DYMO printers.";
									} 
									for (var i = 0; i < printers.length; ++i) {
										var printer = printers[i];
										if (printer.printerType == "LabelWriterPrinter") {
											printerName = printer.name;
											break;
										}
									}
									if (printerName == "") {
										throw "No LabelWriter printers found. Install LabelWriter printer";
									}
									
									var labelXml = '<DieCutLabel Version="8.0" Units="twips">\
													<PaperOrientation>Landscape</PaperOrientation>\
													 <Id>LargeShipping</Id>\
													 <PaperName>30256 Shipping</PaperName>\
													 <DrawCommands>\
														<RoundRectangle X="0" Y="0" Width="5630" Height="9420" Rx="0" Ry="0" />\
													 </DrawCommands>\
													 <ObjectInfo>\
													 <ImageObject>\
														 <Name>Graphic</Name>\
														 <ForeColor Alpha="255" Red="0" Green="0" Blue="0" />\
														 <BackColor Alpha="0" Red="255" Green="255" Blue="255" />\
														 <LinkedObjectName></LinkedObjectName>\
														 <Rotation>Rotation0</Rotation>\
														 <IsMirrored>False</IsMirrored>\
														 <IsVariable>False</IsVariable>\
														 <Image></Image>\
														 <ScaleMode>Uniform</ScaleMode>\
														 <BorderWidth>0</BorderWidth>\
														 <BorderColor Alpha="255" Red="0" Green="0" Blue="0" />\
														 <HorizontalAlignment>Left</HorizontalAlignment>\
														 <VerticalAlignment>Top</VerticalAlignment>\
													 </ImageObject>\
													 <Bounds X="0" Y="0" Width="5630" Height="9420" />\
													 </ObjectInfo>\
													 </DieCutLabel>';
									var label = dymo.label.framework.openLabelXml(labelXml);
									
									label.setObjectText("Graphic", pngBase64);
									label.print(printerName);
									
								} catch (e) {
									alert(e);
								}
								
								
								$("#previewcanvas").hide();
								//win.location.reload();	
								/*canvas.toBlob(function(blob) {
									saveAs(blob, "preview_badge.png"); 
								});*/
							}
						});
					});
					
				});
				
				
				function gotPic(event) {
					if(event.target.files.length == 1 && 
					   event.target.files[0].type.indexOf("image/") == 0) {
					   
						var reader = new FileReader();
						reader.onload = function (e) {
							$('#results img').attr('src', e.target.result);
						}

						reader.readAsDataURL(event.target.files[0]);
					   
						//$("#results img").attr("src",URL.createObjectURL(event.target.files[0]));
					}
				}
				
				
					
				</script>
				
				<div class="row">
					<div class="col-lg-12 appline">
						<h4><i class="fa fa-sort-desc"></i>  Preview badge</h4>
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-8 padding0" id="section-to-print">
						<div class="row boxwhite" id="badge-to-print">
							<div class="col-lg-4 padding0">
								
								<div id="results" class="badgeimg">
									<img src="{{ url('/') }}/public/uploads/avatar/<% appointmentData.image_url %>" alt=""/>
								</div>
								
								<span class="visiting">visiting</span>
								<span class="visitname"><% hostname %></span>
							</div>
							<div class="col-lg-8">
								<h2 class="bigheading"><% appointmentData.title %> <% appointmentData.first_name %> <% appointmentData.last_name %>
								<span class="subheaing"><% appointmentData.company_name %></span>
								</h2>
								
								<div class="badgeday">
									<span class="dayclass" ><% arival_day %></span>
									<span class="dateclass"><% appointmentData.arival_date %></span>
								</div>
								
								<div id="sign_results" class="badgesign">
									<img src="{{ url('/') }}/public/uploads/avatar/<% appointmentData.signature_url %>" alt=""/>
								</div>
								<br style="clear:both;">
								<ul class="timepass">
									<li>Time In: <% appointmentData.arival_time %></li>
									<li>Pass No: <% appointmentData.card_no %></li>
								</ul>
							</div>
						</div>
					</div>
					
					<div class="col-lg-4" ng-init="appointmentData.signature_url='{{ url('/') }}/public/uploads/avatar/<% appointmentData.signature_url %>'">
						<br>
						<span class="picturebadge"><a href="#" class="badgeedit" id="btnSave"><i class="fa fa-print"></i>Print Badge</a></span>
						<?php /*?><a href="#" class="badgeedit"><i class="fa fa-edit"></i>Edit</a><?php */?>
						<a href="javascript:void(0);" class="badgeedit" ng-click="addAppointment();"><i class="fa fa-close"></i>Cancel</a>
						
						<a href="javascript:void(0);" class="badgesignature"><i class="fa fa-pencil"></i>Signature</a>	
						
						<input type="hidden" id="signature_url" name="signature_url" ng-model="appointmentData.signature_url">
						<div id="signature-pad" class="m-signature-pad">
							<div class="m-signature-pad--body">
							  <canvas></canvas>
							</div>
							<div class="m-signature-pad--footer" ng-app="mymodal">
							  <div class="description">Sign above</div>
						
								<button ng-click="toggleSignatureModal('Terms & Conditions')" class="button save">Capture</button>
								<modal visible="showSignatureModal" class="termsmodal">
									<div id="termsConditions">{!! $site->terms_conditions !!}
									<input style="margin-right: 10px;" ng-init='agreeConditions=false' type="checkbox" ng-model="agreeConditions" id="agreeConditions"/><label for="agreeConditions">I have read and agree to the conditions</label></div>
									<button class="btn btn-default ng-scope" data-action="save" ng-click="captureSignature();">Submit</button>
								</modal>
						
								<?php /*?><button class="button save" data-action="save" ng-click="captureSignature();">Capture</button><?php */?>
								<button class="button clear" data-action="clear" ng-click="clearSignature();">Clear</button>
							</div>
						</div>
					</div>
				</div>
				
				
			</div>
			<div class="col-lg-4 latestvisitor paddingright">
			<div class="col-lg-12 paddingright">
				<div class="appline col-lg-12">
					<h4>latest visitors</h4>
					<a href="javascript:void(0);" ng-click="switchBool('isFormOpen')" class="searchBtn"><i class="fa fa-search"></i> Search</a>
				</div>
				<div class="searchinput" ng-show="isFormOpen">
					<input type="text" placeholder="Search by Name" value="" ng-model="searchText">
					<span class="resetsearch"><i class="fa"><img src="{{ url('/') }}/public/images/cross.png" alt="" height="14" width="14" ng-click="searchText = undefined; switchBool('isFormOpen')"></i></span>
				</div>
				<div class="clearfix"></div>
				<br>
				
				<div class="listbox">
                	<div class="divexample1">
						<div class="genbox" ng-repeat="visitor in visitors | filter:searchText">
						<img ng-if="visitor.avatar == 1 ? imgurl = visitor.card_no : imgurl = 'blank_face'" src="{{ url('/') }}/public/uploads/avatar/<% imgurl %>.jpg" class="visitorlerightpan" alt="" height="40" width="40">
						
						<a href="javascript:void(0);" class="badgeedit" ng-if="visitor.status == 0 && visitor.departure_time == '0000-00-00 00:00:00'" ng-click="changeVisitorStatus(visitor.id, 1);">Check In</a>
						<a href="javascript:void(0);" class="badgeedit" ng-if="visitor.status == 1" ng-click="changeVisitorStatus(visitor.id, 0);">Check Out</a>
						<span class="vname"><a href="javascript:void(0);" ng-click="editAppointment(visitor.id);" >
						<% visitor.title %> <% visitor.first_name %> <% visitor.last_name %></a></span>
						<label class="vlabel"><% visitor.visitor_type %>&nbsp;&nbsp;&nbsp;</label>
						<label class="vlabel vright"><span>visiting&nbsp;&nbsp;&nbsp;</span><% visitor.visitor_host %></label>
						
					</div>	
                    </div>
				</div>
				
				<div class="appline col-lg-12 margintop22px"><h4>Live visitors status</h4></div>
				<div class="clearfix"></div>
				<br>
				<span class="visitstatus" ng-repeat="visitor_count in visitor_counts"><b><% visitor_count.visitortype %> on Site : </b><% visitor_count.count %></span>
				  
			   </div>
			   <div class="clearfix"></div>
			</div>
		</div>
	</div>
</section>
<script>
  $(document).ready(function() {
	$( "#date" ).datepicker({
		dateFormat: "dd-mm-yy"
	});
	$('#time').timepicker({ 
		'timeFormat': 'H:i:s',
		'step': 5
	});
  });
</script>
<script src="{{ url('/') }}/public/js/signature_pad.js"></script>

@endsection
