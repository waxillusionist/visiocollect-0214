/* =============================================================================
   Start jQuery Dollar Scope
   ========================================================================== */

(function($){
	'use strict';

	/* =============================================================================
	   Global vars
	   ========================================================================== */

	$.skrollr = null;

	$(window).load(function(){
		if( $.skrollr )
			$.skrollr.refresh();
	});


	/* =============================================================================
	   on DOM ready
	   ========================================================================== */

	$(document).ready(function(){



		/* =============================================================================
		   Main-NavBar Fixation
		   ========================================================================== */

		$('.main-navbar').each(function(){
			var el = $(this);
			$(document).on({
				'scroll.mainNavbarFix': function(ev) {
					el.removeClass('fixed fix-none fix-bottom fix-top dropup');
					var s = $(document).scrollTop(),
						el_top = el.offset().top,
						el_height = el.outerHeight(false),
						wh = $(window).height();
					// if navbar default position is not on top of document
					if( el_top > 0 ) {
						// if navbar position is after current visible section
						if( s <= el_top - wh + el_height )
							// fix navbar to bottom
							el.addClass('fix-bottom popup');
						// if navbar position is before current visible section
						else if( s > el_top )
							//fix navbar to top
							el.addClass('fix-top');
						// is navbar position is within current visible section
						else
							// do not fix navbar
							el.addClass('fix-none');
						// if navbar is near window bottom
						if( s <= el_top - wh + 80 )
							// Dropup submenus
							el.addClass('dropup');
					}
					// otherwise fix navbar to top
					else
						el.addClass('fix-top');
				}
			}).trigger('scroll.mainNavbarFix');
			$(window).on({
				'resize.mainNavbarFix': function(ev) {
					$(document).trigger('scroll.mainNavbarFix');
				}
			});
		});



		/* =============================================================================
		   Grid Gallery
		   ========================================================================== */

		$('.gallery-style-grid').each(function(){
			var gallery = $(this),
				items = gallery.find('.gallery-item'),
				w = $(window);
			w.on({
				'resize.gridGallery': function() {
					var ww = w.width(),
						colcount = ww<768 ? 1 : ( ww<992 ? 2 : 3 ),
						cols = [];
					items.detach();
					gallery.empty();
					items.each(function(){
						var shortest_col = 0;
						for( var c=0; c<colcount; c++ ) {
							if( !cols[c] ) {
								cols[c] = [ $('<ul class="col'+colcount+'"/>'), 0 ];
								gallery.append(cols[c][0]);
							}
							shortest_col = (shortest_col!=c) && ( cols[c][1]<cols[shortest_col][1] ) ? c : shortest_col;
						}
						cols[shortest_col][1] += parseInt( $(this).find('.gallery-icon img').attr('height') );
						cols[shortest_col][0].append( $('<li/>').append( $(this) ) );
					});
					if( $.skrollr )
						$.skrollr.refresh();
				}
			}).trigger('resize.gridGallery');
		});



		/* =============================================================================
		   ekko Lightbox
		   ========================================================================== */

		$(document).on({
			click: function(ev) {
				ev.preventDefault();
				$(this).ekkoLightbox();
			}
		},'*[data-toggle="lightbox"]');



		/* =============================================================================
		   Height fix for related containers
		   ========================================================================== */

		$(window).on({
			'resize.heightfix': function(ev){
				var els = $('[data-heightfix^="rel"]'),
					groups = {},
					xsDisplay = $(window).width()<768 ? true : false;
				els.each(function(){
					var el = $(this).css('min-height','auto'),
						elh = el.height(),
						rel = el.data('heightfix');
					if( !xsDisplay ) {
						if( groups[rel]===undefined ) {
							groups[rel] = {
								maxHeight: elh,
								els: [el]
							};
						}
						else {
							groups[rel].els.push(el);
							if( groups[rel].maxHeight < elh )
								groups[rel].maxHeight = elh;
						}
					}
				});
				if( !xsDisplay ) {
					$.each(groups,function(){
						var group = this;
						$.each(this.els,function(){
							this.css('min-height',group.maxHeight);
						});
					});
				}
			}
		}).trigger('resize.heightfix');



		/* =============================================================================
		   Fix footer to bottom if document is shorter than window
		   ========================================================================== */

		$(window).on({
			'resize.footerfix': function(ev){
				var f = $('.global-footer');
				if( f.length==1 ) {
					f.removeClass('fixed');
					var w = $(window),
						wh = w.height(),
						fh = f.removeClass('fixed').offset().top + f.outerHeight();
					if( wh>fh )
						f.addClass('fixed');
				}
			}
		}).trigger('resize.footerfix');



		/* =============================================================================
		   Smooth scrolling to anchors
		   ========================================================================== */

		$('.navbar-nav,.global-footer').on({
			click: function(ev) {
				if( location.pathname.replace(/^\//,'')==this.pathname.replace(/^\//,'') && location.hostname==this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
						$('html,body').animate({
							scrollTop: target.offset().top
						}, 500);
						return false;
					}
				}
			}
		},'a[href*=#]:not([href=#])');



		/* =============================================================================
		   Parallax preparation for Skrollr
		   ========================================================================== */

		$(window).on({
			'resize.parallax': function() {
				var els = $('.parallax');
				els.each(function(){
					var h = $(this).height(),
						m = $(this).data('parallax-multiplier') ? parseFloat($(this).data('parallax-multiplier')) : 0.5;
					$(this).attr({
						'data-bottom-top': 'background-position: 50% '+(h*m)+'px',
						'data-top-bottom': 'background-position: 50% -'+(h*m)+'px'
					});
				});
				if( $.skrollr )
					$.skrollr.refresh();
			}
		}).trigger('resize.parallax');



		/* =============================================================================
		   ScrollScale preparation for Skrollr
		   ========================================================================== */

		if( $(window).width()>=768 ) {
			$('.scrollscale').each(function(){
				var a = 0.75,
					b = 1.25;
				$(this).attr({
					'data-bottom-top':
						'-webkit-transform: scale('+a+', '+a+');'+
						    '-ms-transform: scale('+a+', '+a+');'+
						        'transform: scale('+a+', '+a+');',
					'data-top-bottom':
						'-webkit-transform: scale('+b+', '+b+');'+
						    '-ms-transform: scale('+b+', '+b+');'+
						        'transform: scale('+b+', '+b+');'
				});
			});
		}



		/* =============================================================================
		   Skrollr
		   ========================================================================== */

		$.skrollr = skrollr.init({
			smoothScrolling: false,
			forceHeight: false
		});



		/* =============================================================================
		   MixItUp Spektrum
		   ========================================================================== */

		$('.mixitup').each(function(){
			var mixitup = $(this);
			mixitup.find('.mix').each(function(){
				var img_url = $(this).find('.img img').attr('src');
				$(this).find('figure').append([
					$('<div class="curtain-top" style="background-image:url(\''+img_url+'\')">')[0],
					$('<div class="curtain-bottom" style="background-image:url(\''+img_url+'\')">')[0]
				]);
			});
			mixitup.mixItUp({
				callbacks: {
					onMixEnd: function() {
						if( $.skrollr )
							$.skrollr.refresh();
					}
				}
			});
			$('.mixitup-controls').find('a').on({
				click: function(ev) {
					ev.preventDefault();
				}
			});
		});



		/* =============================================================================
		   Contact form handler
		   ========================================================================== */

		$('form.form-contact').each(function(){
			var form = $(this);
			form.submit(function(ev){
				ev.preventDefault();
				$.ajax({
					type: 'POST',
					url: form.attr('action'),
					dataType: 'json',
					data: form.serialize()+'&cfd=1',
					beforeSend: function() {
						form.addClass('loading')
							.find('.form-group.has-error').removeClass('has-error')
							.end().find('.response,.alert').remove();
					},
					success: function(data){
						if( !data.success ) {
							$.each(data.errors,function(){
								if( this[0]=='#' )
									form.append('<div class="alert alert-danger"><span class="glyphicon glyphicon-remove pull-right"></span>'+this[1]+'</div>')
								else {
									var group = form.find('#cfd_'+this[0]).closest('.form-group').addClass('has-error');
									group.append( $(
										'<p class="response help-block">'+this[1]+'</p>'
									));
								}
							});
						}
						else {
							form.append('<div class="alert alert-success"><span class="glyphicon glyphicon-ok pull-right"></span>'+data.success+'</div>')
								.find('input[type="text"],input[type="tel"],input[type="email"],textarea').val('');
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown){
						console.debug(textStatus);
					},
					complete: function() {
						form.removeClass('loading');
					}
				})
			}).find('[type="submit"]').on({
				click: function(ev) {
					$(this).blur();
				}
			});
		});



		/* =============================================================================
		   OnePageScroller - prepare for Bootstrap scrollspy
		   ========================================================================== */

		$('body.page-template-custompage-onepagescroller-php').each(function(){
			var navas = $(this).find('.navbar-nav>li>a'),
				containers = $(this).find('[data-ops]');
			containers.each(function(i){
				var container = $(this),
					nava = navas.filter('[href="'+container.data('ops')+'"]:first');
				if( nava.length==1 ) {
					var id = nava.text().toLowerCase().replace(/[^a-z_]/,'');
					nava.attr('href','#'+id);
					container.attr('id',id);
				}
			});
		});



		/* =============================================================================
		   GoogleMaps Integration
		   ========================================================================== */

		$('.gmap').each(function(){
			var el = $(this),
				data = $(this).data(),
				map = {
					options: {
						mapTypeControlOptions: {},
						overviewMapControlOptions: {},
						panControlOptions: {},
						rotateControlOptions: {},
						scaleControlOptions: {},
						streetViewControlOptions: {},
						zoomControlOptions: {}
					}
				};
			$.each( data, function(key){
				var value = this.toString();
				switch(key) {
					case 'height':
					case 'width':
						el.css(key,value);
						break;
					case 'address':
						map.address = value;
						break;
					case 'center':
						var latlong = value.split(',');
						map.options[key] = [ parseFloat(latlong[0]), parseFloat(latlong[1]) ];
						break;
					case 'mapTypeId':
						map.options[key] = google.maps.MapTypeId[value.toUpperCase()];
						break;
					case 'mapTypeControlStyle':
						map.options.mapTypeControlOptions.style = google.maps.MapTypeControlStyle[value.toUpperCase()];
						break;
					case 'mapTypeControlPosition':
						map.options.mapTypeControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'panControlPosition':
						map.options.panControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'rotateControlPosition':
						map.options.rotateControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'scaleControlPosition':
						map.options.scaleControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'streetViewControlPosition':
						map.options.streetViewControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'zoomControlPosition':
						map.options.streetViewControlOptions.position = google.maps.ControlPosition[value.toUpperCase()];
						break;
					case 'zoomControlStyle':
						map.options.zoomControlOptions.style = google.maps.ZoomControlStyle[value.toUpperCase()];
						break;
					case 'overviewMapControlOpened':
						map.options.overviewMapControlOptions.opened = value==='true';
						break;
					case 'backgroundColor':
						map.options[key] = value;
						break;
					case 'heading':
					case 'zoom':
					case 'maxZoom':
					case 'minZoom':
					case 'tilt':
						map.options[key] = parseInt( value );
						break;
					case 'disableDefaultUI':
					case 'disableDoubleClickZoom':
					case 'draggable':
					case 'draggableCursor':
					case 'draggingCursor':
					case 'keyboardShortcuts':
					case 'mapMaker':
					case 'mapTypeControl':
					case 'noClear':
					case 'overviewMapControl':
					case 'panControl':
					case 'rotateControl':
					case 'scaleControl':
					case 'scrollwheel':
					case 'streetViewControl':
					case 'zoomControl':
						map.options[key] = value==='true';
						break;
				}
			});
			el.gmap3({ map: map });
		});



		/* =============================================================================
		   GMap Anfahrt
		   ========================================================================== */

		$('.map-anfahrt').each(function(){
			var address = $(this).data('address'),
				zoom = $(this).data('zoom');
			$(this).gmap3({
				map:{
					options:{
						styles: [{
							featureType: 'all',
							elementType: 'all',
							stylers: [
								{ hue: '#00B4FF' },
								{ saturation: -25 },
								{ lightness: -5 }
							]
						}]
					}
				},
				marker:{
					values:[{
						address: address,
						data: '<p style="font-weight:400;margin:.2em;letter-spacing:.1em;font-family:Gravur,sans-serif;font-size:16px;color:#000;white-space:nowrap;display:block;">'+
							'Visiocollect Areal<br>'+
							'<a style="color:#000;text-decoration:none;" href="http://maps.google.com/maps?'+
							'daddr='+encodeURIComponent(address)+
							'&z='+zoom+
							'" target="_blank">'+
							'&#x25b6; '+
							'ROUTE BERECHNEN</a></p>',
						options: {
							icon: 'http://visiocollect.com/wp-content/uploads/2014/01/marker.png'
						}
					}],
					options: {
						draggable: false
					},
					events:{
						click: function( marker, event, context ) {
							var map = $(this).gmap3('get'),
							infowindow = $(this).gmap3({ get: { name: 'infowindow' } });
							if( infowindow ) {
								infowindow.open( map, marker);
								infowindow.setContent( context.data );
							}
							else {
								$(this).gmap3({
									infowindow: {
										anchor: marker,
										options: { content: context.data }
									}
								});
							}
						}
					}
				}
			});

		});



	/* =============================================================================
	   End of DOMready
	   ========================================================================== */

	});



/* =============================================================================
   End jQuery Dollar Scope
   ========================================================================== */

})(jQuery);


